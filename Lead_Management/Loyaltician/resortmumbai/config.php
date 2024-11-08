<?php 
date_default_timezone_set('Asia/Kolkata');

$host="localhost";
$user="u444388293_newhotel";
$pass="SARsar@@2021";
$dbname="u444388293_newhotel";
// $conn = new mysqli($host, $user, $pass, $dbname);
$conn = mysqli_connect("localhost","u444388293_newhotel","SARsar@@2021","u444388293_newhotel");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
// echo "Connected succesfull";
   
}

// $host="localhost";
// $user="u444388293_newhotel";
// $pass="SARsar@@2021";
// $dbname="u444388293_newhotelbeta";
// $contest = new mysqli($host, $user, $pass, $dbname);
// // Check connection
// if ($contest->connect_error) {
//     die("Connection failed: " . $contest->connect_error);
// } else {
// // echo "Connected succesfull";
   
// }



$host="localhost";
$user="u444388293_orchid";
$pass="Sar1234!*";
$dbname="u444388293_application";
// $con3 = new mysqli($host, $user, $pass, $dbname);
$con3 = mysqli_connect("localhost","u444388293_orchid","Sar1234!*","u444388293_application");
// Check connection
if ($con3->connect_error) {
    die("Connection failed: " . $con3->connect_error);
} else {
// echo "Connected succesfull";
   
}





$host1="localhost";
$user1="u444388293_newhotel";
$pass1="SARsar@@2021";
$dbname1="u444388293_newhotel";
// $con2 = new mysqli($host1, $user1, $pass1, $dbname1);
$con2 = mysqli_connect("localhost","u444388293_newhotel","SARsar@@2021","u444388293_newhotel");
// Check connection
if ($con2->connect_error) {
    die("Connection failed: " . $con2->connect_error);
} else {
// echo "Connected succesfull";
   
}
?>