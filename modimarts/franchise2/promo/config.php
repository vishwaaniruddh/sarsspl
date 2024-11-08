<?php 
date_default_timezone_set('Asia/Kolkata');
$host="localhost";
$user="allmart_sarmicro";
$pass="SARsar@@2020";
 $dbname="allmart_web";
$dbname="allmart_franchiseweb2";
$con = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
// echo "Connected succesfull";
   
}

//$con1=mysqli_connect("localhost", "allmart_ecomm20", "AZk=8fzX2s!3","allmart_ecommerce");