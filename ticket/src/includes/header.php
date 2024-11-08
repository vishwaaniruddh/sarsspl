<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$logged_in_user_role_id = $_SESSION['role_id'] ?? null;
$logged_in_user_id = $userid = $_SESSION['user_id'] ?? null;
$client_id = $global_client_id = $_SESSION['client_id'];
$username = $_SESSION['username'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>


            <?php
            
            if($logged_in_user_role_id == 1 ){
?>
                <li><a href="create_client.php">Clients</a></li>
                <li><a href="create_project.php">Projects</a></li>
  <?php }
            
            ?>
            <li><a href="create_user.php">Users</a></li>
            <li><a href="create_ticket.php">Ticket</a></li>
            
            <li><a href="logout.php">Logout</a></li>
            
            <li>Hello, <?php echo $username ; ?> </li>
        </ul>
    </div>
