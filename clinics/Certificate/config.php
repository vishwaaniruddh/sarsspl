<?php

error_reporting(0);
$server = "localhost";
$username = "root";
$password = "";
$dbname = "medical_fitness_certificate";
$port = "3306";

$con = mysqli_connect("localhost","root","","medical_fitness_certificate","3306");
date_default_timezone_set('Asia/Calcutta');
if(!$con){
    die("Connection Failed : " .mysqli_connect_error());
}
?>