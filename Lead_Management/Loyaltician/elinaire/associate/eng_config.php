<?php  date_default_timezone_set('Asia/Kolkata');
$host="198.38.84.103";
$user="sarmicro_english";
$pass="english";
$dbname="sarmicro_englishpointmarina";
$eng_con = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($eng_con->connect_error) {
    die("Connection failed: " . $eng_con->connect_error);
} else {
// echo "Connected succesfull";
   
}
