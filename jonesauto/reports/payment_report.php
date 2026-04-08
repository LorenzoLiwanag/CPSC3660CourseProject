<?php require_once '../config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Report</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<div class="page-container">
    <div class="page-card">

<h2>Payment Report</h2>
<p>Customer payment history</p>

<?php
$sql = "SELECT
            p.payment_id,
            p.customer_id,
            c.first_name AS customer_first_name,
            c.last_name AS customer_last_name,
            p.sale_id,
            p.payment_date,
            p.due_date,
            p.paid_date,
            p.amount,
            p.bank_account
        FROM Payment p
        JOIN Customer c ON p.customer_id = c.customer_id
        ORDER BY p.payment_date DESC, p.payment_id DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr>
            <th>Payment ID</th>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Sale ID</th>
            <th>Payment Date</th>
            <th>Due Date</th>
            <th>Paid Date</th>
            <th>Amount</th>
            <th>Bank Account</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['payment_id'] . "</td>";
        echo "<td>" . $row['customer_id'] . "</td>";
        echo "<td>" . $row['customer_first_name'] . " " . $row['customer_last_name'] . "</td>";
        echo "<td>" . $row['sale_id'] . "</td>";
        echo "<td>" . $row['payment_date'] . "</td>";
        echo "<td>" . $row['due_date'] . "</td>";
        echo "<td>" . ($row['paid_date'] === null ? "Not Paid Yet" : $row['paid_date']) . "</td>";
        echo "<td>$" . $row['amount'] . "</td>";
        echo "<td>" . ($row['bank_account'] === null ? "-" : $row['bank_account']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No payments found.</p>";
}
?>

    </div>
</div>
</body>
</html>