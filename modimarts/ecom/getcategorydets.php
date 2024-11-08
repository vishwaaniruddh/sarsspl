<?php
session_start();
include('config.php');
$catid = $_POST['mdi'];
$st=$_POST['st'];



if($st=="1")
{

$View="SELECT * FROM `main_cat` where id=''";

}

?>