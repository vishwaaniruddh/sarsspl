<?php

$servername = "localhost";
$username = "u444388293_csDBPanel"; // replace with your database username
$password = "AVav@@2024"; // replace with your database password
$dbname = "u444388293_capitalsoftDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
