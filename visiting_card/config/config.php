<?php

date_default_timezone_set('Asia/Kolkata');

$username = "u444388293_rajesh";
$db = "u444388293_visiting_card";
$password = "SARVisit@2024";
$host = "localhost";

$con = new mysqli($host, $username, $password, $db);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    //echo "Connected succesfull";
}


?>