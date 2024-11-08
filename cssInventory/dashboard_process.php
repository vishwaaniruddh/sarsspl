<?php
include 'config.php';
/*
$sql="SELECT COUNT(material),material
FROM enventory_Stock
GROUP BY material";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
   echo $row[0]; 
   
}
*/
/*
$sql="select material,id from Inventory_IN";
$result=mysqli_query($conn,$sql);
$dvr=mysqli_num_rows($result);
$row=mysqli_fetch_array($result);


$sql1="select * from enventory_Stock where Status='Active'and Inventory_IN='".$row[1]."'";
$result1=mysqli_query($conn,$sql1);
$dvr1=mysqli_num_rows($result1);
$row1=mysqli_fetch_array($result1);

echo $sql1;
*/


$sql="select material from enventory_Stock where Status='Active' and material='dvr'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$dvr=mysqli_num_rows($result);

$sql2="select material from enventory_Stock where Status='Active' and material='camera'";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_array($result2);
$camera=mysqli_num_rows($result2);

$sql3="select material from enventory_Stock where Status='Active' and material='hdd'";
$result3=mysqli_query($conn,$sql3);
$row3=mysqli_fetch_array($result3);
$hdd=mysqli_num_rows($result3);

echo $dvr."@#".$camera."@#".$hdd;


?>