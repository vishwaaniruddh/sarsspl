<?php 

$host="localhost";
$user="shyambab_Temp";
$pass="sar@123";
$dbname="shyambab_Temple";
$conn = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//echo "Connected succesfull";
   
}



?>