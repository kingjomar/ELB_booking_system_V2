<?php
session_start();
include 'db_connect.php'; // Connect to MySQL database
include 'auth.php';

// Fetch statistics
$stats_query = "
    SELECT 
        COUNT(*) AS total, 
        SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) AS total_approved, 
        SUM(CASE WHEN status = 'Checked_out' THEN 1 ELSE 0 END) AS total_checked_out 
    FROM bookings";
$stats_result = $conn->query($stats_query);
$stats = $stats_result->fetch_assoc();

$total_bookings = $stats['total'] ?? 0;
$total_approved = $stats['total_approved'] ?? 0;
$total_checked_out = $stats['total_checked_out'] ?? 0;

// Fetch all bookings
$query = "SELECT * FROM bookings WHERE status IN ('Pending', 'approved', 'Checked_out')";
$result = $conn->query($query);

// Check if request is POST and has required parameters
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['booking_id'], $_POST['actionType'])) {
    header('Content-Type: application/json'); // Set JSON response
    $response = ['success' => false]; // Default response
    $booking_id = intval($_POST['booking_id']);

    if ($booking_id > 0) {
        date_default_timezone_set('Asia/Manila'); // Ensure Philippine Time

        if ($_POST['actionType'] === 'approve') {
            $status = 'approved';
            $current_date = date('Y-m-d');
            $current_time = date('H:i:s');

            $update_query = "UPDATE bookings SET status = ?, check_in_date = ?, check_in_time = ? WHERE id = ?";
            $stmt = $conn->prepare($update_query);
            if ($stmt) {
                $stmt->bind_param("sssi", $status, $current_date, $current_time, $booking_id);
                if ($stmt->execute()) {
                    $response = ['success' => true, 'message' => "Booking approved successfully!"];
                } else {
                    $response['message'] = "Error approving booking: " . $stmt->error;
                }
                $stmt->close();
            }
        } elseif ($_POST['actionType'] === 'checkout') {
            // Check if booking is approved
            $status_check_query = "SELECT status FROM bookings WHERE id = ?";
            $stmt_check = $conn->prepare($status_check_query);
            $stmt_check->bind_param("i", $booking_id);
            $stmt_check->execute();
            $stmt_check->bind_result($current_status);
            $stmt_check->fetch();
            $stmt_check->close();

            if ($current_status === 'approved') {
                $status = 'Checked_out';
                $current_date = date('Y-m-d');
                $current_time = date('H:i:s');

                $update_query = "UPDATE bookings SET status = ?, check_out_date = ?, check_out_time = ? WHERE id = ?";
                $stmt = $conn->prepare($update_query);
                if ($stmt) {
                    $stmt->bind_param("sssi", $status, $current_date, $current_time, $booking_id);
                    if ($stmt->execute()) {
                        $response = ['success' => true, 'message' => "Booking checked out successfully!"];
                    } else {
                        $response['message'] = "Error checking out booking: " . $stmt->error;
                    }
                    $stmt->close();
                }
            } else {
                $response['message'] = "Only approved bookings can be checked out.";
            }
        }
    } else {
        $response['message'] = "Invalid booking ID.";
    }
    echo json_encode($response);
    exit();
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: admin_login.php"); // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Booking Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-light">
    <div class="container mt-4">
        <h2 class="text-center mb-4">Admin Dashboard</h2>

        <!-- Logout Button -->
        <div class="text-end mb-3">
            <a href="?logout=true" class="btn btn-danger">Logout</a>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div id="success-alert" class="alert alert-success">
                <?php echo htmlspecialchars($_SESSION['success']);
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div id="error-alert" class="alert alert-danger">
                <?php echo htmlspecialchars($_SESSION['error']);
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Total Bookings</h5>
                        <h2><?php echo $total_bookings; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Approved Bookings</h5>
                        <h2><?php echo $total_approved; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5>Checked-Out Bookings</h5>
                        <h2><?php echo $total_checked_out; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <h3>Bookings</h3>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Booking No.</th>
                    <th>Status</th>
                    <th>Check-In Date & Time</th>
                    <th>Check-Out Date & Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['firstname']. ' ' .$row['lastname']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact']); ?></td>
                        <td><?php echo htmlspecialchars($row['booking_number']); ?></td>
                        <td>
                            <span
                                class="badge 
                                <?php echo ($row['status'] == 'approved') ? 'bg-success' : (($row['status'] == 'Checked_out') ? 'bg-secondary' : 'bg-warning text-dark'); ?>">
                                <?php echo htmlspecialchars($row['status']); ?>
                            </span>
                        </td>
                        <td><?php
                            echo !empty($row['check_in_date']) && !empty($row['check_in_time'])
                                ? date("l, F j, Y, g:i A", strtotime($row['check_in_date'] . ' ' . substr($row['check_in_time'], 0, 5)))
                                : 'N/A';
                            ?>
                        </td>
                        <td> <?php
                                echo !empty($row['check_out_date']) && !empty($row['check_out_time'])
                                    ? date("l, F j, Y, g:i A", strtotime($row['check_out_date'] . ' ' . substr($row['check_out_time'], 0, 5)))
                                    : 'N/A';
                                ?>
                        </td>
                        <td>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">

                                <?php if ($row['status'] == 'pending') { ?>
                                    <button class="btn btn-success btn-sm"
                                        onclick="confirmAction(event, 'approve', <?php echo $row['id']; ?>, '<?php echo $row['status']; ?>')">Approve</button>
                                <?php } elseif ($row['status'] == 'approved') { ?>
                                    <button type="submit" name="checkout" class="btn btn-danger btn-sm"
                                        onclick="return confirmAction(event, 'checkout', <?php echo $row['id']; ?>, '<?php echo $row['status']; ?>')">Check-Out</button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-secondary btn-sm" disabled>Checked Out</button>
                                <?php } ?>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        setTimeout(function() {
            let successAlert = document.getElementById('success-alert');
            let errorAlert = document.getElementById('error-alert');
            if (successAlert) successAlert.style.display = 'none';
            if (errorAlert) errorAlert.style.display = 'none';
        }, 3000);
    </script>
    <script>
        function confirmAction(event, actionType, bookingId, bookingStatus) {
            event.preventDefault();

            if (actionType === 'checkout' && bookingStatus !== 'approved') {
                Swal.fire("Action Not Allowed", "Only approved bookings can be checked out.", "error");
                return;
            }

            Swal.fire({
                title: `Are you sure?`,
                text: `Do you want to ${actionType} this booking?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, proceed!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('admin.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                actionType,
                                booking_id: bookingId
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error("Network response was not OK");
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                Swal.fire("Success!", data.message, "success").then(() => location.reload());
                            } else {
                                Swal.fire("Error!", data.message || "Something went wrong!", "error");
                            }
                        })
                        .catch(error => {
                            Swal.fire("Error!", "Server Error: " + error.message, "error");
                        });
                }
            });
        }
    </script>
</body>

</html>