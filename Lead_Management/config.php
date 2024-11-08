<?php 
date_default_timezone_set('Asia/Kolkata');
$host="localhost";
$user="u444388293_LeadMng";
$pass="Sar1234!*";
$dbname="u444388293_LeadManagement";
$conn = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
// echo "Connected succesfull";
   
}

?>