<?php require_once '../config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Form</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<div class="page-container">
    <div class="page-card">

<h2>Record Customer Payment</h2>

<form method="POST">
    Customer ID:
    <select name="customer_id" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
    <br><br>

    Sale ID:
    <select name="sale_id" required>
        <option value="1">1</option>
    </select>
    <br><br>

    Payment Date: <input type="date" name="payment_date" required><br><br>
    Due Date: <input type="date" name="due_date" required><br><br>
    Paid Date: <input type="date" name="paid_date"><br><br>
    Amount: <input type="number" step="0.01" name="amount" required><br><br>
    Bank Account: <input type="text" name="bank_account"><br><br>

    <input type="submit" name="submit" value="Record Payment">
</form>

<?php
if (isset($_POST['submit'])) {
    $customer_id = $_POST['customer_id'];
    $sale_id = $_POST['sale_id'];
    $payment_date = $_POST['payment_date'];
    $due_date = $_POST['due_date'];
    $paid_date = $_POST['paid_date'];
    $amount = $_POST['amount'];
    $bank_account = $_POST['bank_account'];

    $sql = "INSERT INTO Payment
            (customer_id, sale_id, warranty_sale_id, payment_date, due_date, paid_date, amount, bank_account)
            VALUES
            (
                $customer_id,
                $sale_id,
                NULL,
                '$payment_date',
                '$due_date',
                " . ($paid_date === '' ? "NULL" : "'$paid_date'") . ",
                $amount,
                " . ($bank_account === '' ? "NULL" : "'$bank_account'") . "
            )";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Payment recorded successfully!</p>";
    } else {
        echo "<p>Error recording payment: " . $conn->error . "</p>";
    }
}
?>

    </div>
</div>
</body>
</html>