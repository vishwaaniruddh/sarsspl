<?php
include 'db.php';

// Fetch unique expense dates
$date_sql = "SELECT DISTINCT expense_date FROM expenses ORDER BY expense_date DESC";
$date_result = $conn->query($date_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Expenses by Day</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }
        .tab button:hover {
            background-color: #ddd;
        }
        .tab button.active {
            background-color: #ccc;
        }
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>
</head>
<body>
    <h1>View Expenses by Day</h1>
    
    <!-- Tab buttons -->
    <div class="tab">
        <?php if ($date_result->num_rows > 0): ?>
            <?php $first = true; ?>
            <?php while ($date_row = $date_result->fetch_assoc()): ?>
                <button class="tablinks" onclick="openTab(event, '<?= $date_row['expense_date'] ?>')" <?php if ($first) { echo 'id="defaultOpen"'; $first = false; } ?>>
                    <?= $date_row['expense_date'] ?>
                </button>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No expenses recorded yet.</p>
        <?php endif; ?>
    </div>

    <!-- Tab content -->
    <?php
    $date_result->data_seek(0); // Reset result pointer to loop again

    while ($date_row = $date_result->fetch_assoc()) {
        $date = $date_row['expense_date'];

        // Fetch expenses for the specific date
        $expense_sql = "SELECT * FROM expenses WHERE expense_date='$date'";
        $expense_result = $conn->query($expense_sql);

        // Calculate total amount for the date
        $total_sql = "SELECT SUM(amount) as total_amount FROM expenses WHERE expense_date='$date'";
        $total_result = $conn->query($total_sql);
        $total_row = $total_result->fetch_assoc();
        $total_amount = $total_row['total_amount'];
    ?>
        <div id="<?= $date ?>" class="tabcontent">
            <h3>Expenses for <?= $date ?></h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                <?php while($row = $expense_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['amount'] ?></td>
                        <td><?= $row['category'] ?></td>
                        <td>
                            <a href="delete_expense.php?id=<?= $row['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="5"><strong>Total Amount: ₹<?= number_format($total_amount, 2) ?></strong></td>
                </tr>
            </table>
        </div>
    <?php
    }
    ?>

    <script>
        function openTab(evt, dateName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(dateName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Open the first tab by default
        document.getElementById("defaultOpen").click();
    </script>
</body>
</html>

<?php
$conn->close();
?>
