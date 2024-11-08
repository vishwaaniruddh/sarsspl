<?php 
date_default_timezone_set('Asia/Kolkata');
$host="localhost";
$user="allmart_sarmicro";
$pass="SARsar@@2020";
$dbname="allmart_web";
$con = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
// echo "Connected succesfull";
   
}
?>