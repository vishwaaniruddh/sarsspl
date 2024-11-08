<?php
include 'config.php';


$sql="select Material from InventoryOUT_Stock where Status='L' and Material='dvr'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$dvr=mysqli_num_rows($result);

$sql2="select Material from InventoryOUT_Stock where Status='L' and Material='camera'";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_array($result2);
$camera=mysqli_num_rows($result2);

$sql3="select Material from InventoryOUT_Stock where Status='L' and Material='hdd'";
$result3=mysqli_query($conn,$sql3);
$row3=mysqli_fetch_array($result3);
$hdd=mysqli_num_rows($result3);

echo $dvr."@#".$camera."@#".$hdd;


?>