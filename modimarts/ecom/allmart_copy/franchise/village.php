<?php
include ('config.php');
$pincode=$_POST['pincode'];
$data=array();
$sql="select id,village from village where pincode =".$pincode;
//echo $sql;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['modelno'=>$row['village'],'ids'=>$row['id']];
}
echo json_encode($data);
?>