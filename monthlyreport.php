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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Monthly Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0 text-center fs-3">Monthly Report</h5>
            </div>
            <div class="card-body table-responsive">
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
                        ?>
                        <tr>
                            <td><?= $formattedDate ?></td>
                            <td><?= $summary['total_bookings'] ?></td>
                            <td><?= $summary['total_pax'] ?></td>
                            <td><?= $summary['total_kids'] ?></td>
                            <td><?= $summary['total_adults'] ?></td>
                            <td><?= $summary['total_senior_pwd'] ?></td>
                            <td>₱<?= number_format($summary['total_entrance'], 2) ?></td>
                            <td>₱<?= number_format($summary['total_unit_rate'], 2) ?></td>
                            <td><strong>₱<?= number_format($summary['total_amount'], 2) ?></strong></td>
                        </tr>
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

</body>

</html>