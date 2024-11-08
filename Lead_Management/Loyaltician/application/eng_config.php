<?php date_default_timezone_set('Asia/Kolkata');
$host = "198.38.84.103";
$user = "u444388293_english";
$pass = "English2024!*";
$dbname = "u444388293_englishpointma";
// $eng_con = new mysqli($host, $user, $pass, $dbname);
$eng_con = mysqli_connect("lovalhost","u444388293_english","English2024!*","u444388293_englishpointma");
// Check connection
if ($eng_con->connect_error) {
    die("Connection failed: " . $eng_con->connect_error);
} else {
    // echo "Connected succesfull";

}
