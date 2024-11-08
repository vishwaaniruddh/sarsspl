<?php 
date_default_timezone_set('Asia/Kolkata');
$host="localhost";
$user="sarmicro_LeadMg";
$pass="sar1234";
$dbname="sarmicro_LeadManagementNew";
$conn = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
// echo "Connected succesfull";
   
}

?>