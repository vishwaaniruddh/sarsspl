<?php
if (!isset($_SESSION)) session_start();
include("config.php");
$std= $_SESSION['std'];


$maketemp = "CREATE TEMPORARY TABLE temp(`student_id` int NOT NULL, `points` varchar(1000))"; 

mysqli_query( $con,$maketemp);


$qrtmn=mysqli_query($con,"select distinct(student_id) from points_details where date(entrydt)>='".date("Y-m-d")."' and date(entrydt)<='".date("Y-m-d")."'");

while($rws=mysqli_fetch_array($qrtmn))
{

$qrt=mysqli_query($con,"select sum(points) from points_details where date(entrydt)>='".date("Y-m-d")."' and date(entrydt)<='".date("Y-m-d")."' and student_id='".$rws[0]."'");

$rfrws=mysqli_feth_array($qrt);

$insqr=mysqli_query($con,"Insert into temp(student_id,points)values('".$rws[0]."','".$rfrws[0]."')");



}


?>