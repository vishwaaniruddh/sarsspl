<?php
include ('config.php');
//echo $materialid;
$zone=$_POST['zone'];
$data=array();
$sql="select country from India_structure where Taluka='".$zone."' and star='Taluka'";
//echo $sql;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['modelno'=>$row['country'],'ids'=>$row['country']];
}
echo json_encode($data);
?>