<?php require_once 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Warranty Report</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<div class="page-container">
    <div class="page-card">

<h2>Warranty Report</h2>
<p>Warranty sales and policy details</p>

<?php
$sql = "SELECT
            ws.warranty_sale_id,
            ws.sale_id,
            ws.vehicle_id,
            v.make,
            v.model,
            v.year,
            ws.customer_id,
            c.first_name AS customer_first_name,
            c.last_name AS customer_last_name,
            ws.salesperson_id,
            sp.first_name AS salesperson_first_name,
            sp.last_name AS salesperson_last_name,
            ws.policy_id,
            wp.policy_name,
            wp.component_type,
            ws.warranty_sale_date,
            ws.warranty_start_date,
            ws.warranty_length,
            ws.deductible,
            ws.total_cost,
            ws.monthly_cost,
            ws.paid_upfront_flag
        FROM Warranty_Sale ws
        JOIN Warranty_Policy wp ON ws.policy_id = wp.policy_id
        JOIN Vehicle v ON ws.vehicle_id = v.vehicle_id
        JOIN Customer c ON ws.customer_id = c.customer_id
        JOIN Salesperson sp ON ws.salesperson_id = sp.salesperson_id
        ORDER BY ws.warranty_sale_date DESC, ws.warranty_sale_id DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr>
            <th>Warranty Sale ID</th>
            <th>Sale ID</th>
            <th>Vehicle ID</th>
            <th>Vehicle</th>
            <th>Customer</th>
            <th>Salesperson</th>
            <th>Policy ID</th>
            <th>Policy Name</th>
            <th>Component Type</th>
            <th>Sale Date</th>
            <th>Start Date</th>
            <th>Length</th>
            <th>Deductible</th>
            <th>Total Cost</th>
            <th>Monthly Cost</th>
            <th>Paid Upfront</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['warranty_sale_id'] . "</td>";
        echo "<td>" . $row['sale_id'] . "</td>";
        echo "<td>" . $row['vehicle_id'] . "</td>";
        echo "<td>" . $row['make'] . " " . $row['model'] . " (" . $row['year'] . ")</td>";
        echo "<td>" . $row['customer_first_name'] . " " . $row['customer_last_name'] . "</td>";
        echo "<td>" . $row['salesperson_first_name'] . " " . $row['salesperson_last_name'] . "</td>";
        echo "<td>" . $row['policy_id'] . "</td>";
        echo "<td>" . $row['policy_name'] . "</td>";
        echo "<td>" . $row['component_type'] . "</td>";
        echo "<td>" . $row['warranty_sale_date'] . "</td>";
        echo "<td>" . ($row['warranty_start_date'] === null ? "-" : $row['warranty_start_date']) . "</td>";
        echo "<td>" . ($row['warranty_length'] === null ? "-" : $row['warranty_length']) . "</td>";
        echo "<td>$" . ($row['deductible'] === null ? "0.00" : $row['deductible']) . "</td>";
        echo "<td>$" . $row['total_cost'] . "</td>";
        echo "<td>$" . ($row['monthly_cost'] === null ? "0.00" : $row['monthly_cost']) . "</td>";
        echo "<td>" . ($row['paid_upfront_flag'] ? "Yes" : "No") . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No warranty sales found.</p>";
}
?>

    </div>
</div>
</body>
</html>