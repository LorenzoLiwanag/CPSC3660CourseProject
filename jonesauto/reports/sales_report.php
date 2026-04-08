<?php require_once '../config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<div class="page-container">
    <div class="page-card">

<h2>Sales Report</h2>
<p>Vehicles that have been sold</p>

<?php
$sql = "SELECT 
            s.sale_id,
            s.vehicle_id,
            v.make,
            v.model,
            v.year,
            c.customer_id,
            c.first_name AS customer_first_name,
            c.last_name AS customer_last_name,
            sp.salesperson_id,
            sp.first_name AS salesperson_first_name,
            sp.last_name AS salesperson_last_name,
            s.sale_date,
            s.total_due,
            s.down_payment,
            s.financed_amount,
            s.sale_price,
            s.salesperson_commission
        FROM Sale s
        JOIN Vehicle v ON s.vehicle_id = v.vehicle_id
        JOIN Customer c ON s.customer_id = c.customer_id
        JOIN Salesperson sp ON s.salesperson_id = sp.salesperson_id
        ORDER BY s.sale_date DESC, s.sale_id DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr>
            <th>Sale ID</th>
            <th>Vehicle ID</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Salesperson ID</th>
            <th>Salesperson Name</th>
            <th>Sale Date</th>
            <th>Total Due</th>
            <th>Down Payment</th>
            <th>Financed Amount</th>
            <th>Sale Price</th>
            <th>Commission</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['sale_id'] . "</td>";
        echo "<td>" . $row['vehicle_id'] . "</td>";
        echo "<td>" . $row['make'] . "</td>";
        echo "<td>" . $row['model'] . "</td>";
        echo "<td>" . $row['year'] . "</td>";
        echo "<td>" . $row['customer_id'] . "</td>";
        echo "<td>" . $row['customer_first_name'] . " " . $row['customer_last_name'] . "</td>";
        echo "<td>" . $row['salesperson_id'] . "</td>";
        echo "<td>" . $row['salesperson_first_name'] . " " . $row['salesperson_last_name'] . "</td>";
        echo "<td>" . $row['sale_date'] . "</td>";
        echo "<td>$" . $row['total_due'] . "</td>";
        echo "<td>$" . $row['down_payment'] . "</td>";
        echo "<td>$" . $row['financed_amount'] . "</td>";
        echo "<td>$" . $row['sale_price'] . "</td>";
        echo "<td>$" . $row['salesperson_commission'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No sales found.</p>";
}
?>

    </div>
</div>
</body>
</html>