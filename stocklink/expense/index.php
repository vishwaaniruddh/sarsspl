<?php
include 'db.php';

// Handle form submission to add a new expense
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $expense_date = $_POST['expense_date'];

    $sql = "INSERT INTO expenses (description, amount, category, expense_date) 
            VALUES ('$description', '$amount', '$category', '$expense_date')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect to the same page to refresh the expense list
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all expenses ordered by date
$sql = "SELECT * FROM expenses ORDER BY id DESC";
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
    <title>Expense Management</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body>
    
    <div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
    <h1>Expense Management</h1>
    
    <!-- Add Expense Form -->
    <form action="" method="post">
        <label for="description">Description:</label>
        <input type="text" name="description" id="description" required><br>
        
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" step="0.01" required><br>
        
        <label for="category">Category:</label>
        <input type="text" name="category" id="category"><br>
        
        <label for="expense_date">Date:</label>
        <input type="date" name="expense_date" id="expense_date" required><br>
        
        <button type="submit">Add Expense</button>
    </form>
    <br>
            
        </div>
        <div class="col-sm-6">
            <br><br><br>
                        <a href="https://stocklink.sarsspl.com/expense/view_expenses_by_day.php">View Daily Expense</a>
            
            <br><br><br><br>
            
            <a href="https://stocklink.sarsspl.com/expense/view_expenses.php">View In new page</a>
              <!-- View Expenses Table -->
    <h2>View Expenses</h2>
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
        </div>
    </div>

        
    </div>
  
</body>
</html>

<?php
$conn->close();
?>
