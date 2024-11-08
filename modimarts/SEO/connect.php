<?php
date_default_timezone_set('Asia/Kolkata');

$con = mysqli_connect("localhost","allmart_ecomm20","AZk=8fzX2s!3","allmart_web");
$con1 = mysqli_connect("localhost", "allmart_ecomm20", "AZk=8fzX2s!3","allmart_ecommerce");
// $con = mysql_connect("localhost","allmart_ecomm20","AZk=8fzX2s!3");
//mysql_select_db("allmart_ecommerce",$con);
$con3=mysqli_connect("localhost", "allmart_ecomm20", "AZk=8fzX2s!3","allmart_ecommerce");

$ocimagepath="images/";

$prodimgpth="";

//$mainpath="../";

$roundupto=2;
$adstotaltym=1800;
$tyms=40;

$noproductimg="images/noproduct.jpg";
?>