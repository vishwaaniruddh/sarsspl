<?php
include 'db.php';

// Fetch all expenses ordered by date
$sql = "SELECT * FROM expenses ORDER BY expense_date DESC";
$result = $conn->query($sql);

// Calculate the total amount
$total_sql = "SELECT SUM(amount) as total_amount FROM expenses";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_amount = $total_row['total_amount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Expenses</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>View Expenses</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Category</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td><?= $row['amount'] ?></td>
                    <td><?= $row['category'] ?></td>
                    <td><?= $row['expense_date'] ?></td>
                    <td>
                        <a href="delete_expense.php?id=<?= $row['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            <tr>
                <td colspan="6"><strong>Total Amount: ₹<?= number_format($total_amount, 2) ?></strong></td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="6">No expenses recorded yet.</td>
            </tr>
        <?php endif; ?>
    </table>
    <br>
    <a href="index.php">Add New Expense</a>
</body>
</html>

<?php
$conn->close();
?>
