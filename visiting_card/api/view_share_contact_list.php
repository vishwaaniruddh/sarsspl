<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();

include($_SERVER['DOCUMENT_ROOT'].'/visiting_card/config/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); 


?>