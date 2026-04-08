<?php require_once '../config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Vehicle</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<div class="page-container">
    <div class="page-card">

<h2>Add Vehicle</h2>

<form method="POST">
    Make: <input type="text" name="make" required><br><br>
    Model: <input type="text" name="model" required><br><br>
    Year: <input type="number" name="year" required><br><br>
    Color: <input type="text" name="color"><br><br>
    Miles: <input type="number" name="miles"><br><br>
    Condition: <input type="text" name="condition"><br><br>
    Book Price: <input type="number" step="0.01" name="book_price"><br><br>
    Style: <input type="text" name="style"><br><br>
    Interior Color: <input type="text" name="interior_color"><br><br>

    Status:
    <select name="status" required>
        <option value="Available">Available</option>
        <option value="Sold">Sold</option>
        <option value="In Repair">In Repair</option>
    </select>
    <br><br>

    <input type="submit" name="submit" value="Add Vehicle">
</form>

<?php
if (isset($_POST['submit'])) {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $color = $_POST['color'];
    $miles = $_POST['miles'];
    $condition = $_POST['condition'];
    $book_price = $_POST['book_price'];
    $style = $_POST['style'];
    $interior_color = $_POST['interior_color'];
    $status = $_POST['status'];

    $sql = "INSERT INTO Vehicle
            (make, model, year, color, miles, `condition`, book_price, style, interior_color, status)
            VALUES
            ('$make', '$model', $year,
             " . ($color === '' ? "NULL" : "'$color'") . ",
             " . ($miles === '' ? "NULL" : $miles) . ",
             " . ($condition === '' ? "NULL" : "'$condition'") . ",
             " . ($book_price === '' ? "NULL" : $book_price) . ",
             " . ($style === '' ? "NULL" : "'$style'") . ",
             " . ($interior_color === '' ? "NULL" : "'$interior_color'") . ",
             '$status'
            )";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Vehicle added successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>
    </div>
</div>
    </div>
</div>
</body>
</html>