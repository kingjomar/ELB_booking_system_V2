<?php
include('db_connect.php');

// Handle pagination
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

// Fetch distinct months
$monthsQuery = "SELECT DISTINCT DATE_FORMAT(date_of_reservation, '%Y-%m') AS month FROM bookings ORDER BY month DESC LIMIT $start_from, $limit";
$monthsResult = $conn->query($monthsQuery);

// Get total rows for pagination
$totalRowsQuery = "SELECT COUNT(DISTINCT DATE_FORMAT(date_of_reservation, '%Y-%m')) AS total FROM bookings";
$totalRowsResult = $conn->query($totalRowsQuery);
$totalRows = $totalRowsResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Handle form submission for updating monthly report
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $month = $_POST['month'];
    $bcoh = $_POST['bcoh'];
    $expenses = $_POST['expenses'];
    $salary = $_POST['salary'];
    $rem = $_POST['rem'];
    $ecoh = $_POST['ecoh'];

    // Update the monthly report in the database
    $updateQuery = "
        UPDATE monthly_report SET 
            bcoh = ?, 
            expenses = ?, 
            salary = ?, 
            rem = ?, 
            ecoh = ?
        WHERE month = ?";

    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('ddddds', $bcoh, $expenses, $salary, $rem, $ecoh, $month);

    if ($stmt->execute()) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Report updated successfully!',
                    confirmButtonColor: '#3085d6'
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to update report. Please try again.',
                    confirmButtonColor: '#d33'
                });
            });
        </script>";
    }
    
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Monthly Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 CDN -->
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0 text-center fs-3">Monthly Report</h5>
            </div>
            <div class="card-body table-responsive">
                <a href="export_monthly_report.php" class="btn btn-outline-success mb-3">Download Excel</a>

                <table class="table table-hover table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Total Bookings</th>
                            <th scope="col">Total Pax</th>
                            <th scope="col">Kids</th>
                            <th scope="col">Adults</th>
                            <th scope="col">Senior/PWD</th>
                            <th scope="col">Entrance Fee (₱)</th>
                            <th scope="col">Unit Rate (₱)</th>
                            <th scope="col">Total Amount (₱)</th>
                            <th scope="col">BCOH (₱)</th>
                            <th scope="col">Expenses (₱)</th>
                            <th scope="col">Salary (₱)</th>
                            <th scope="col">REM (₱)</th>
                            <th scope="col">ECOH (₱)</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($monthRow = $monthsResult->fetch_assoc()):
                            $currentMonth = $monthRow['month'];
                            $formattedDate = date('l, F j, Y', strtotime($currentMonth . '-01'));

                            $summaryQuery = "
            SELECT 
              COUNT(*) AS total_bookings,
              SUM(3yrs_old_below) AS total_kids,
              SUM(adults) AS total_adults,
              SUM(kids_seniors_pwds) AS total_senior_pwd,
              SUM(3yrs_old_below + adults + kids_seniors_pwds) AS total_pax,
              SUM(entrance_fee) AS total_entrance,
              SUM(cottage_room_fee) AS total_unit_rate,
              SUM(total_amount) AS total_amount
            FROM bookings
            WHERE DATE_FORMAT(date_of_reservation, '%Y-%m') = '$currentMonth'";

                            $summaryResult = $conn->query($summaryQuery);
                            $summary = $summaryResult->fetch_assoc();
                            // Transfer monthly summary to monthly_report
                            $total_bookings = $summary['total_bookings'] ?? 0;
                            $total_pax = $summary['total_pax'] ?? 0;
                            $total_kids = $summary['total_kids'] ?? 0;
                            $total_adults = $summary['total_adults'] ?? 0;
                            $total_senior_pwd = $summary['total_senior_pwd'] ?? 0;
                            $total_entrance = $summary['total_entrance'] ?? 0.00;
                            $total_unit_rate = $summary['total_unit_rate'] ?? 0.00;
                            $total_amount = $summary['total_amount'] ?? 0.00;

                            $insertOrUpdate = "
                                INSERT INTO monthly_report 
                                    (month, total_bookings, total_pax, total_kids, total_adults, total_senior_pwd, total_entrance, total_unit_rate, total_amount)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
                                ON DUPLICATE KEY UPDATE
                                    total_bookings = VALUES(total_bookings),
                                    total_pax = VALUES(total_pax),
                                    total_kids = VALUES(total_kids),
                                    total_adults = VALUES(total_adults),
                                    total_senior_pwd = VALUES(total_senior_pwd),
                                    total_entrance = VALUES(total_entrance),
                                    total_unit_rate = VALUES(total_unit_rate),
                                    total_amount = VALUES(total_amount)
                            ";

                            $stmt = $conn->prepare($insertOrUpdate);
                            $stmt->bind_param(
                                'siiiiiddd',
                                $currentMonth,
                                $total_bookings,
                                $total_pax,
                                $total_kids,
                                $total_adults,
                                $total_senior_pwd,
                                $total_entrance,
                                $total_unit_rate,
                                $total_amount
                            );
                            $stmt->execute();

                        ?>
                        <form method="POST" action="monthlyreport.php">
                            <tr>
                                <td><?= $formattedDate ?></td>
                                <td><?= $summary['total_bookings'] ?></td>
                                <td><?= $summary['total_pax'] ?></td>
                                <td><?= $summary['total_kids'] ?></td>
                                <td><?= $summary['total_adults'] ?></td>
                                <td><?= $summary['total_senior_pwd'] ?></td>
                                <td>₱<?= number_format($summary['total_entrance'], 2) ?></td>
                                <td>₱<?= number_format($summary['total_unit_rate'], 2) ?></td>
                                <td>
                                    <strong>₱<span class="total-amount"><?= number_format($summary['total_amount'], 2) ?></span></strong>
                                    <input type="hidden" class="totalAmountRaw" value="<?= $summary['total_amount'] ?>">
                                </td>
                                <td><input type="number" class="form-control form-control-sm bcoh" name="bcoh" step="0.01" value="0.00"></td>
                                <td><input type="number" class="form-control form-control-sm expenses" name="expenses" step="0.01" value="0.00"></td>
                                <td><input type="number" class="form-control form-control-sm salary" name="salary" step="0.01" value="0.00"></td>
                                <td><input type="text" class="form-control form-control-sm rem" name="rem" readonly></td>
                                <td><input type="text" class="form-control form-control-sm ecoh" name="ecoh" readonly></td>
                                <td>
                                    <input type="hidden" name="month" value="<?= $currentMonth ?>">
                                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                                </td>
                            </tr>
                        </form>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </nav>

            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('tr').forEach(row => {
            const totalAmount = parseFloat(row.querySelector('.totalAmountRaw')?.value || 0);
            const bcohInput = row.querySelector('.bcoh');
            const expensesInput = row.querySelector('.expenses');
            const salaryInput = row.querySelector('.salary');
            const remInput = row.querySelector('.rem');
            const ecohInput = row.querySelector('.ecoh');

            if (bcohInput && expensesInput && salaryInput) {
                [bcohInput, expensesInput, salaryInput].forEach(input => {
                    input.addEventListener('input', () => {
                        const bcoh = parseFloat(bcohInput.value) || 0;
                        const expenses = parseFloat(expensesInput.value) || 0;
                        const salary = parseFloat(salaryInput.value) || 0;
                        const rem = totalAmount - expenses - salary;
                        const ecoh = bcoh + rem;

                        remInput.value = rem.toFixed(2);
                        ecohInput.value = ecoh.toFixed(2);
                    });
                });
            }
        });
    });
    
    </script>
    

</body>

</html>
