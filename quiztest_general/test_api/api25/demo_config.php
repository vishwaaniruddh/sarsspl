<?php
date_default_timezone_set('Asia/Kolkata');
$con= mysql_connect("localhost","sarmicro_test2","test2123*");
mysql_select_db("sarmicro_test2shine",$con);

global $con;

// error_reporting(0);
if($con)
{
// echo "done";
}

$urlp="http://sarmicrosystems.in/quiztest/";
  
  
  $imgs="img/download.png";

?>