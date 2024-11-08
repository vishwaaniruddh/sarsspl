<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $expense_date = $_POST['expense_date'];

    $sql = "INSERT INTO expenses (description, amount, category, expense_date) 
            VALUES ('$description', '$amount', '$category', '$expense_date')";

    if ($conn->query($sql) === TRUE) {
        echo "New expense recorded successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: view_expenses.php");
    exit;
}
?>
