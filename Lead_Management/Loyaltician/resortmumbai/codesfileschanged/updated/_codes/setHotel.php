<?php
include ('config.php');

$Brand=$_POST['Brand'];
$data=array();
$sql="select * from Hotel_Creation where Brand='".$Brand."'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['hotel_id'=>$row['hotel_id'],'Hotel_Name'=>$row['Hotel_Name']];
}
echo json_encode($data);
?>