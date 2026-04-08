<?php require_once '../config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Report</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<div class="page-container">
    <div class="page-card">

<h2>Inventory Report</h2>
<p>Vehicles currently available for sale</p>

<?php
$sql = "SELECT vehicle_id, make, model, year, color, miles, `condition`, book_price, style, interior_color, status
        FROM Vehicle
        WHERE status = 'Available'
        ORDER BY make, model, year";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr>
            <th>Vehicle ID</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Color</th>
            <th>Miles</th>
            <th>Condition</th>
            <th>Book Price</th>
            <th>Style</th>
            <th>Interior Color</th>
            <th>Status</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['vehicle_id'] . "</td>";
        echo "<td>" . $row['make'] . "</td>";
        echo "<td>" . $row['model'] . "</td>";
        echo "<td>" . $row['year'] . "</td>";
        echo "<td>" . $row['color'] . "</td>";
        echo "<td>" . $row['miles'] . "</td>";
        echo "<td>" . $row['condition'] . "</td>";
        echo "<td>$" . $row['book_price'] . "</td>";
        echo "<td>" . $row['style'] . "</td>";
        echo "<td>" . $row['interior_color'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No available vehicles found.</p>";
}
?>

    </div>
</div>
</body>
</html>