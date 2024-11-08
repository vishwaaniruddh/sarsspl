<?php
session_start();
include_once('config.php');

$id = $_REQUEST['id'];

//echo $id;

$sql = "SELECT mobile FROM member where id= $id";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$mobile = $row['mobile'];
$_SESSION["user_name"] = $mobile;
//echo $row['mobile'];

if($mobile!=null||$mobile!="")
    echo '1';
else
    echo '0';
?>