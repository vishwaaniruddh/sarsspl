<?php
date_default_timezone_set('Asia/Kolkata');
// $con= mysql_connect("localhost","sarmicro_test2","test2123*");
// mysql_select_db("sarmicro_test2shine",$con); 

//$con = mysqli_connect("localhost","sarmicro_test2","test2123*","sarmicro_test2shine");
/*
$dbhost = "localhost";
 $dbuser = "sarmicrosystems_prabir";
 $dbpass = "prabir@1986";
 $db = "sarmicrosystems_q2sGeneral"; */
 
 $dbhost = "195.35.7.83";
 $dbuser = "quiz2shine";
 $dbpass = "Uuw0XlVgezCBPMnAFCgy";
 $db = "quiz2shine";
 
 $con = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $con -> error);
?>