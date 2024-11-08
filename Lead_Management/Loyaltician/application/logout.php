<?php
include ('config.php');

session_start(); //to ensure you are using same session
//destroy the session

$_SESSION['user'] = "";
$_SESSION['id'] = "";
$_SESSION['designation'] = "";
session_destroy();

//header('Location:index.php');
//header('Location: http://www.sarmicrosystems.in/test2shine/index.php/'); //to redirect back to "index.php" after logging out

?>
<script>
   window.open('login.php', '_self');
</script>