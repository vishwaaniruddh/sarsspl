<?php
date_default_timezone_set('Asia/Kolkata');

// $con = mysqli_connect("localhost","allmart_ecomm20","AZk=8fzX2s!3","allmart_web");
$con = mysqli_connect("localhost", "u444388293_allmart_web", "SARsar@@2020","u444388293_allmart_web");

// $con1 = mysqli_connect("localhost", "allmart_ecomm20", "AZk=8fzX2s!3","allmart_ecommerce");
$con1 = mysqli_connect("localhost", "u444388293_allmart_ecomm", "SARsar@@2020","u444388293_allmart_ecomm");

// $con = mysql_connect("localhost","allmart_ecomm20","AZk=8fzX2s!3");
//mysql_select_db("allmart_ecommerce",$con);

// $con3=mysqli_connect("localhost", "allmart_ecomm20", "AZk=8fzX2s!3","allmart_ecommerce");
$con3 = mysqli_connect("localhost", "u444388293_allmart_ecomm", "SARsar@@2020","u444388293_allmart_ecomm");

// $con4=mysqli_connect("localhost", "allmart_ecomm20", "AZk=8fzX2s!3","allmart_accounts");
$con4 = mysqli_connect("localhost", "u444388293_modimart", "SARsar@@2020","u444388293_allmart_accoun");

$ocimagepath="images/";

$prodimgpth="";

//$mainpath="../";

$roundupto=2;
$adstotaltym=1800;
$tyms=40;

$noproductimg="images/noproduct.jpg";
?>