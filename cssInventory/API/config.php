<?php 
$host="localhost";
$user="sarmicro_root";
$pass="s@r1234";
$dbname="sarmicro_esurv";
$con = new mysqli($host, $user, $pass, $dbname);
// Check connection

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    
    // var_dump($con);
    
    // echo "Connected succesfull";
}
?>
