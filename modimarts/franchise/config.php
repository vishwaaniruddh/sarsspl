<?php 
date_default_timezone_set('Asia/Kolkata');
$host="localhost";
// $user="sarmicrosystems_modimart";
$user = "u444388293_allmart_web";
$pass="SARsar@@2020";
// $dbname="sarmicrosystems_allmart_web";
$dbname="u444388293_allmart_web";
// $con = new mysqli($host, $user, $pass, $dbname);


$con = mysqli_connect("localhost", "u444388293_allmart_web", "SARsar@@2020","u444388293_allmart_web");
$con1=mysqli_connect("localhost", "u444388293_allmart_ecomm", "SARsar@@2020","u444388293_allmart_ecommerce");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
// echo "Connected succesfull";
   
}

//$con1=mysqli_connect("localhost", "allmart_ecomm20", "AZk=8fzX2s!3","allmart_ecommerce");