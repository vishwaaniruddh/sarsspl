<?php
include 'config.php';

$sql="select material from enventory_Stock where  material='dvr'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$dvr=mysqli_num_rows($result);

$sql2="select material from enventory_Stock where  material='camera'";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_array($result2);
$camera=mysqli_num_rows($result2);

$sql3="select material from enventory_Stock where material='hdd'";
$result3=mysqli_query($conn,$sql3);
$row3=mysqli_fetch_array($result3);
$hdd=mysqli_num_rows($result3);

echo $dvr."@#".$camera."@#".$hdd;


?>