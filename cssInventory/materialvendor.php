<?php
include 'config.php';
$vendorname=$_POST['vendorname'];
//echo $materialid;
$data=array();
$sql="select * from material where Vendorname_id='".$vendorname."'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['material'=>$row['Name'],'ids'=>$row['id']];
}
echo json_encode($data);
?>