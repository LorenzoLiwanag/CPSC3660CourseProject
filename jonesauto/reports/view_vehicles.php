<?php require_once '../config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Vehicles</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<div class="page-container">
    <div class="page-card">

<h2>Vehicle Inventory</h2>

<?php
$sql = "SELECT vehicle_id, make, model, year, color, miles, `condition`, book_price, style, interior_color, status
        FROM Vehicle";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Vehicle ID: " . $row['vehicle_id'] . "<br>";
        echo "Make: " . $row['make'] . "<br>";
        echo "Model: " . $row['model'] . "<br>";
        echo "Year: " . $row['year'] . "<br>";
        echo "Color: " . $row['color'] . "<br>";
        echo "Miles: " . $row['miles'] . "<br>";
        echo "Condition: " . $row['condition'] . "<br>";
        echo "Book Price: $" . $row['book_price'] . "<br>";
        echo "Style: " . $row['style'] . "<br>";
        echo "Interior Color: " . $row['interior_color'] . "<br>";
        echo "Status: " . $row['status'] . "<br><br>";
    }
} else {
    echo "No vehicles found.";
}
?>

    </div>
</div>
</body>
</html>