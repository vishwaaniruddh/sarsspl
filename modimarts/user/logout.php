<?php session_start();

unset($_SESSION['adminuser']);
unset($_SESSION['id']);
header("location: index.php");
?>
