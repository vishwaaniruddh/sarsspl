<?php
$host = '98.70.112.244';//dummy ip 
$user = 'phpmyadmin';
$pass = 'admMarch@2024';
$dbname = 'captainindia_captainindiauat';


$link = mysqli_connect($host, $user, $pass,$dbname);
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}else {
    echo "success" . PHP_EOL;
}

?>