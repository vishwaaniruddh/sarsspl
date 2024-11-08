<?php
date_default_timezone_set('Asia/Kolkata');

$dbhost = "localhost";
 $dbuser = "sarmicrosystems_prabir";
 $dbpass = "prabir@1986";
 $db = "sarmicrosystems_q2sGeneral";
 $con = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $con -> error);
 
// echo $con;
//$con= mysql_connect("localhost","sarmicro_test2","test2123*");
//mysql_select_db("sarmicro_test2shine",$con);
//$con = mysqli_connect("localhost","sarmicro_test2","test2123*","sarmicro_test2shine");
//header('Access-Control-Allow-Origin: *');
/*$con2=mysql_connect("localhost", "smartsco_smart", "smart123*","");
mysql_select_db("smartsco_smartscore",$con)*/
 error_reporting(0);
/*if($con)
{
echo "done";
}*/

$urlp="https://sarmicrosystems.in/quiztest_general/";
  
  
  $imgs="img/download.png";

?>