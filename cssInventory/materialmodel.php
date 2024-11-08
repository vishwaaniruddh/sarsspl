<?php
include 'config.php';
$materialid=$_POST['material'];
//echo $materialid;
$data=array();
$sql="select * from model_no where material_id='".$materialid."'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['modelno'=>$row['modelno'],'ids'=>$row['id'],'pono'=>$row['pono'],'project'=>$row['project']];
}
echo json_encode($data);
?>