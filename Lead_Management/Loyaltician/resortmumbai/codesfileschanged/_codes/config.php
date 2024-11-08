<?php 
date_default_timezone_set('Asia/Kolkata');

$host="localhost";
$user="sarmicrosystems_newhotel";
$pass="SARsar@@2021";
$dbname="sarmicrosystems_newhotel";
$conn = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
echo "Connected succesfull";
   
}

$host="localhost";
$user="sarmicrosystems_newhotel";
$pass="SARsar@@2021";
$dbname="sarmicrosystems_newhotelbeta";
$contest = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($contest->connect_error) {
    die("Connection failed: " . $contest->connect_error);
} else {
// echo "Connected succesfull";
   
}



$host="localhost";
$user="sarmicro_LeadMg";
$pass="sar1234";
$dbname="sarmicro_LeadManagementNew";
$con3 = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($con3->connect_error) {
    die("Connection failed: " . $con3->connect_error);
} else {
// echo "Connected succesfull";
   
}





$host1="localhost";
$user1="sarmicrosystems_newhotel";
$pass1="SARsar@@2021";
$dbname1="sarmicrosystems_newhotel";
$con2 = new mysqli($host1, $user1, $pass1, $dbname1);
// Check connection
if ($con2->connect_error) {
    die("Connection failed: " . $con2->connect_error);
} else {
// echo "Connected succesfull";
   
}
?>