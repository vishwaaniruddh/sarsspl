<?php
include ('config.php');


$Pincode=$_POST['Pincode'];

$data=array();
$sql="select City,State from Pincode where Pincode='".$Pincode."' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

    $data[]=['City'=>$row['City'],'State'=>$row['State']];


echo json_encode($data);
?>