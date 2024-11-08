<?php
	session_start();
	
error_reporting(E_ALL);
// $server = "localhost";
// $username = "root";
// $password = "";
// $dbname = "sarmicro_clinicmgt";

// $con = mysqli_connect("localhost","root","","sarmicro_clinicmgt");
// date_default_timezone_set('Asia/Calcutta');
// if(!$con){
//     die("Connection Failed : " .mysqli_connect_error());
// }

$host = "localhost";
$username = "u444388293_clinics";
$password = "Clinics@2024!*";
$dbname = "u444388293_clinics";

$con = mysqli_connect($host,$username,$password,$dbname);
date_default_timezone_set('Asia/Calcutta');
if(!$con){
    die("Connection Failed : " .mysqli_connect_error());
}

