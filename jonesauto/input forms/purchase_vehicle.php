<?php require_once '../config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Purchase Vehicle</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<div class="page-container">
    <div class="page-card">

<h2>Record Vehicle Purchase</h2>

<form method="POST">
    <h3>Vehicle Information</h3>

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
        <option value="In Repair">In Repair</option>
    </select>
    <br><br>

    <h3>Purchase Information</h3>

    Buyer ID:
    <select name="buyer_id" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    <br><br>

    Seller ID:
    <select name="seller_id" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    <br><br>

    Purchase Date: <input type="date" name="purchase_date" required><br><br>
    Location: <input type="text" name="location"><br><br>

    Auction:
    <select name="is_auction" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
    <br><br>

    Price Paid: <input type="number" step="0.01" name="price_paid" required><br><br>

    <input type="submit" name="submit" value="Record Purchase">
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

    $buyer_id = $_POST['buyer_id'];
    $seller_id = $_POST['seller_id'];
    $purchase_date = $_POST['purchase_date'];
    $location = $_POST['location'];
    $is_auction = $_POST['is_auction'];
    $price_paid = $_POST['price_paid'];

    $vehicle_sql = "INSERT INTO Vehicle
        (make, model, year, color, miles, `condition`, book_price, style, interior_color, status)
        VALUES
        (
            '$make',
            '$model',
            $year,
            " . ($color === '' ? "NULL" : "'$color'") . ",
            " . ($miles === '' ? "NULL" : $miles) . ",
            " . ($condition === '' ? "NULL" : "'$condition'") . ",
            " . ($book_price === '' ? "NULL" : $book_price) . ",
            " . ($style === '' ? "NULL" : "'$style'") . ",
            " . ($interior_color === '' ? "NULL" : "'$interior_color'") . ",
            '$status'
        )";

    if ($conn->query($vehicle_sql) === TRUE) {
        $vehicle_id = $conn->insert_id;

        $purchase_sql = "INSERT INTO Purchase
            (vehicle_id, buyer_id, seller_id, purchase_date, location, is_auction, price_paid)
            VALUES
            (
                $vehicle_id,
                $buyer_id,
                $seller_id,
                '$purchase_date',
                " . ($location === '' ? "NULL" : "'$location'") . ",
                $is_auction,
                $price_paid
            )";

        if ($conn->query($purchase_sql) === TRUE) {
            echo "<p>Vehicle purchase recorded successfully!</p>";
            echo "<p>New Vehicle ID: " . $vehicle_id . "</p>";
        } else {
            echo "<p>Vehicle was added, but purchase record failed: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>Error adding vehicle: " . $conn->error . "</p>";
    }
}
?>

    </div>
</div>
</body>
</html>