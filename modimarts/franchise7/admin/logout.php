<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["user_name"]);
unset($_SESSION["user_id"]);
unset($_SESSION["user_name"]);
if(isset($_COOKIE['remember_me'])){
	setcookie ("remember_me","", time() - ($days * 24 * 60 * 60 * 1000));
	setcookie ("user_password","", time() - ($days * 24 * 60 * 60 * 1000));
} 
session_destroy();
session_unset();
header("Location:login_form.php");
?>