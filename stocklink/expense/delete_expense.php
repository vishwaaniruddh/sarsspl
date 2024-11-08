<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM expenses WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Expense deleted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
    header("Location: view_expenses.php");
    exit;
}
?>
