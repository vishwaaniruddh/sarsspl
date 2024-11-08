<?php 
date_default_timezone_set('Asia/Kolkata');

$host="localhost";
$user="u444388293_radissons";
$pass="SARsar@@2021";
$dbname="u444388293_radissons";
// $conn = new mysqli($host, $user, $pass, $dbname);
$conn = mysqli_connect("localhost","u444388293_radissons","SARsar@@2021","u444388293_radissons");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
// echo "Connected succesfull";
   
}


// $host="localhost";
// $user="u444388293_radissons";
// $pass="sarmicrosystems_radisson";
// $dbname="sarmicrosystems_radissons_test";
// $conn1 = new mysqli($host, $user, $pass, $dbname);
// // Check connection
// if ($conn1->connect_error) {
//     die("Connection failed: " . $conn1->connect_error);
// } else {
// // echo "Connected succesfull";
   
// }

?>