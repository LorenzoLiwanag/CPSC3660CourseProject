<?php require_once '../config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Warranty Form</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<div class="page-container">
    <div class="page-card">

<h2>Record Warranty Sale</h2>

<form method="POST">
    Sale ID:
    <select name="sale_id" required>
        <option value="1">1</option>
    </select>
    <br><br>

    Policy ID:
    <select name="policy_id" required>
        <option value="1">1 - Basic Powertrain</option>
        <option value="2">2 - Premium Protection</option>
        <option value="3">3 - Safety Systems</option>
    </select>
    <br><br>

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

    Warranty Sale Date: <input type="date" name="warranty_sale_date" required><br><br>
    Warranty Start Date: <input type="date" name="warranty_start_date"><br><br>
    Warranty Length (months): <input type="number" name="warranty_length"><br><br>
    Deductible: <input type="number" step="0.01" name="deductible"><br><br>
    Total Cost: <input type="number" step="0.01" name="total_cost" required><br><br>
    Monthly Cost: <input type="number" step="0.01" name="monthly_cost"><br><br>

    Paid Upfront:
    <select name="paid_upfront_flag" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
    <br><br>

    <input type="submit" name="submit" value="Record Warranty Sale">
</form>

<?php
if (isset($_POST['submit'])) {
    $sale_id = $_POST['sale_id'];
    $policy_id = $_POST['policy_id'];
    $vehicle_id = $_POST['vehicle_id'];
    $customer_id = $_POST['customer_id'];
    $salesperson_id = $_POST['salesperson_id'];
    $warranty_sale_date = $_POST['warranty_sale_date'];
    $warranty_start_date = $_POST['warranty_start_date'];
    $warranty_length = $_POST['warranty_length'];
    $deductible = $_POST['deductible'];
    $total_cost = $_POST['total_cost'];
    $monthly_cost = $_POST['monthly_cost'];
    $paid_upfront_flag = $_POST['paid_upfront_flag'];

    $sql = "INSERT INTO Warranty_Sale
            (sale_id, policy_id, vehicle_id, customer_id, salesperson_id, warranty_sale_date, warranty_start_date, warranty_length, deductible, total_cost, monthly_cost, paid_upfront_flag)
            VALUES
            (
                $sale_id,
                $policy_id,
                $vehicle_id,
                $customer_id,
                $salesperson_id,
                '$warranty_sale_date',
                " . ($warranty_start_date === '' ? "NULL" : "'$warranty_start_date'") . ",
                " . ($warranty_length === '' ? "NULL" : $warranty_length) . ",
                " . ($deductible === '' ? "NULL" : $deductible) . ",
                $total_cost,
                " . ($monthly_cost === '' ? "NULL" : $monthly_cost) . ",
                $paid_upfront_flag
            )";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Warranty sale recorded successfully!</p>";
    } else {
        echo "<p>Error recording warranty sale: " . $conn->error . "</p>";
    }
}
?>

    </div>
</div>
</body>
</html>