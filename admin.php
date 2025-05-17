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
    <!-- Bootstrap 5.3.0 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <style>
        /* General body styling */
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: row;
            background-color: #f8f9fa;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Sidebar styling */
        .sidebar {
            background-color: #ffffff;
            color: #495057;
            width: 250px;
            height: 100%;
            padding-top: 30px;
            border-right: 1px solid #ddd;
            position: fixed;
            transition: width 0.3s ease-in-out;
        }

        /* Sidebar header */
        .sidebar h4 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Sidebar links */
        .sidebar a {
            color: #495057;
            text-decoration: none;
            padding: 15px;
            display: block;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 1rem;
        }

        .sidebar a:hover {
            background-color: #f1f3f5;
            color: #007bff;
        }

        /* Accordion button styling */
        .sidebar .accordion-button {
            font-size: 1rem;
            text-align: left;
            background-color: #f8f9fa;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            width: 100%;
        }

        /* Remove box-shadow on focus */
        .sidebar .accordion-button:focus {
            box-shadow: none;
        }

        /* When the accordion is expanded */
        .sidebar .accordion-button:not(.collapsed) {
            background-color: #e9ecef;
            color: #007bff;
        }

        /* Hover effect for accordion button */
        .sidebar .accordion-button:hover {
            background-color: #f1f3f5;
        }

        /* Accordion body styling (optional) */
        .sidebar .accordion-body {
            padding: 15px;
        }

        /* Accordion collapse animation */
        /* .collapse {
            transition: all 0.3s ease;
        } */

        /* Accordion expanded state */
        .sidebar .accordion-button:not(.collapsed) {
            background-color: #e9ecef;
            color: #007bff;
        }

        /* Hover effects for accordion buttons */
        .sidebar .accordion-button:hover {
            background-color: #e2e6ea;
        }

        /* Content area styling */
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            background-color: #f8f9fa;
        }

        /* Header styling */
        .header {
            background-color: #007bff;
            padding: 15px 30px;
            border-bottom: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: #fff;
        }

        .header h1 {
            font-size: 1.75rem;
            margin: 0;
            font-weight: bold;
        }

        /* Sidebar and content responsive behavior */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
                padding-top: 20px;
            }

            .content {
                margin-left: 0;
                padding: 15px;
            }

            .header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <?php include('sidebar.php'); ?>

    <!-- Content Area -->
    <div class="content">
        <h2 class="text-center mb-4">Booking Management</h2>

        <!-- Statistics Cards -->
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

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Bookings</h3>
        </div>

        <!-- Bookings Table -->
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
                        <td><?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?></td>
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
                                        onclick="confirmAction(event, 'approve', <?php echo $row['id']; ?>, '<?php echo $row['firstname']; ?>')">Approve</button>
                                <?php } ?>
                                <?php if ($row['status'] == 'approved') { ?>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="confirmAction(event, 'checkout', <?php echo $row['id']; ?>, '<?php echo $row['firstname']; ?>')">Checkout</button>
                                <?php } ?>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script>
        function confirmAction(event, actionType, bookingId, firstName) {
            event.preventDefault();
            Swal.fire({
                title: `Are you sure you want to ${actionType} this booking?`,
                text: `${firstName}'s booking will be marked as ${actionType}.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `${actionType.charAt(0).toUpperCase() + actionType.slice(1)}`
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send the action request via AJAX
                    fetch('', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: new URLSearchParams({
                                booking_id: bookingId,
                                actionType: actionType,
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire('Success!', data.message, 'success');
                            setTimeout(() => {
                                window.location.reload(); // Refresh the page after the action
                            }, 1000);
                        })
                        .catch(error => {
                            Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                        });
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>