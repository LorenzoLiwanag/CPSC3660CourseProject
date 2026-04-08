<?php require_once '../config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Sale Form</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<div class="page-container">
    <div class="page-card">

<h2>Record Vehicle Sale</h2>

<form method="POST">
    Vehicle ID: <input type="number" name="vehicle_id" required><br><br>

    Customer ID:
    <select name="customer_id" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
    <br><br>

    Salesperson ID:
    <select name="salesperson_id" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    <br><br>

    Sale Date: <input type="date" name="sale_date" required><br><br>
    Total Due: <input type="number" step="0.01" name="total_due" required><br><br>
    Down Payment: <input type="number" step="0.01" name="down_payment" required><br><br>
    Financed Amount: <input type="number" step="0.01" name="financed_amount" required><br><br>
    Sale Price: <input type="number" step="0.01" name="sale_price" required><br><br>
    Salesperson Commission: <input type="number" step="0.01" name="salesperson_commission"><br><br>

    <input type="submit" name="submit" value="Record Sale">
</form>

<?php
if (isset($_POST['submit'])) {
    $vehicle_id = $_POST['vehicle_id'];
    $customer_id = $_POST['customer_id'];
    $salesperson_id = $_POST['salesperson_id'];
    $sale_date = $_POST['sale_date'];
    $total_due = $_POST['total_due'];
    $down_payment = $_POST['down_payment'];
    $financed_amount = $_POST['financed_amount'];
    $sale_price = $_POST['sale_price'];
    $salesperson_commission = $_POST['salesperson_commission'];

    $sale_sql = "INSERT INTO Sale
        (vehicle_id, customer_id, salesperson_id, sale_date, total_due, down_payment, financed_amount, sale_price, salesperson_commission)
        VALUES
        (
            $vehicle_id,
            $customer_id,
            $salesperson_id,
            '$sale_date',
            $total_due,
            $down_payment,
            $financed_amount,
            $sale_price,
            " . ($salesperson_commission === '' ? "NULL" : $salesperson_commission) . "
        )";

    if ($conn->query($sale_sql) === TRUE) {
        $update_sql = "UPDATE Vehicle
                       SET status = 'Sold'
                       WHERE vehicle_id = $vehicle_id";

        if ($conn->query($update_sql) === TRUE) {
            echo "<p>Sale recorded successfully and vehicle marked as Sold.</p>";
        } else {
            echo "<p>Sale recorded, but vehicle status was not updated: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>Error recording sale: " . $conn->error . "</p>";
    }
}
?>

    </div>
</div>
</body>
</html>