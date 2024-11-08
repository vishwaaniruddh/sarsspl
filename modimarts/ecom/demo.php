<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$con = mysql_connect("localhost","allmart_ecomm20","AZk=8fzX2s!3");
mysql_select_db("allmart_ecommerce",$con);


// $link = mysql_connect('localhost', 'mysql_user', 'mysql_password');
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
mysql_close($con);
?>