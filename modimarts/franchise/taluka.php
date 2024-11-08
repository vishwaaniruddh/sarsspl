<?php
include ('config.php');
//echo $materialid;
$Taluka=$_POST['Taluka'];
$data=array();
//$sql="select Taluka from India_structure where District  LIKE '".$Taluka."' and star='Taluka'";
$sql="select id,taluka from taluka where district_id =".$Taluka;
//echo $sql;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['modelno'=>$row['taluka'],'ids'=>$row['id']];
}
echo json_encode($data);
?>