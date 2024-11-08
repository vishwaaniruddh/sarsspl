<?php
$host="198.38.84.10";
$user="smartsco_smart";
$pass="smart123*";
$dbname="smartsco_smartscore";
$con = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($con->connect_error) {
    // die("Connection failed: " . $con->connect_error);
} else {
// echo "Connected succesfull";
   
}





$urlp="http://sarmicrosystems.in/quiztest/";
  $imgs="img/download.png";
?>