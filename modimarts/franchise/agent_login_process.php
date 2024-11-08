<?php 

include_once('ani_config.php');


$email=$_POST['email'];
$password=$_POST['password'];

$sql = "SELECT email, password FROM agent_register";
$result = mysqli_query($conn, $sql);
var_dump($result);
die();
