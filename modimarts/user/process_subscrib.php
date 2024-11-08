<?php
session_start();
include('config.php');

$mont=$_POST['month'];
$price=$_POST['price'];
$sdate=date("Y-m-d");
$ccode=$_SESSION['id'];

$effectiveDate = strtotime("+$mont months", strtotime(date("y-m-d")));
$tilldt = date("y-m-d", $effectiveDate);  

$sql2="INSERT INTO Subscription(mid,sdate,tilldate,month,status,amount) values('".$ccode."','".$sdate."','".$tilldt."','".$mont."','Active','".$price."')";
$result2 = mysqli_query($con1,$sql2);
$sql1="update clients set subscribe='Active' where code='".$ccode."'";
$result1 = mysqli_query($con1,$sql1);

/*
$date1=date_create("$sdate");
$date2=date_create("$tilldt");
$diff=date_diff($date1,$date2);
$diffs= $diff->format("%R%a days");

if($diffs=="0"){
    
// echo "hiii";
    
$sql1="update clients set subscribe='Expire' where code='".$ccode."'";
$result1 = mysql_query($sql1);
//echo $result1;
}
*/

if($result2) {
    echo "Subscribe successfully";
}
?>