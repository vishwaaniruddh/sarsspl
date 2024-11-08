<?php
include ('config.php');
//echo $materialid;
$taluka=$_POST['taluka'];
$data=array();
//$sql="select Taluka from India_structure where District  LIKE '".$Taluka."' and star='Taluka'";
$sql="select id,ward from ward where taluka_id =".$taluka;
//echo $sql;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['modelno'=>$row['ward'],'ids'=>$row['id']];
}
echo json_encode($data);
?>