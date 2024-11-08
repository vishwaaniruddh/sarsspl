<?php 
date_default_timezone_set('Asia/Kolkata');
$host="localhost";
$user="sarmicrosystems_modimart";
$pass="SARsar@@2020";
//  $dbname="allmart_web";
$dbname="sarmicrosystems_allmart_franchiseweb5";
// $con = new mysqli($host, $user, $pass, $dbname);
$con = mysqli_connect("localhost", "u444388293_franchiseweb5", "SARsar@@2020","u444388293_franchiseweb5");
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
// echo "Connected succesfull";
   
}

//$con1=mysqli_connect("localhost", "allmart_ecomm20", "AZk=8fzX2s!3","allmart_ecommerce");