<?php
include ('config.php');
//echo $materialid;
$state=$_POST['state'];
$data=array();
$sql="select location_name from India_structure where Level='".$state."'";
//echo $sql;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['modelno'=>$row['location_name'],'ids'=>$row['location_name']];
}
echo json_encode($data);
?>