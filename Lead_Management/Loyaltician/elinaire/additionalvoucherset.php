<?php
include ('config.php');
//echo $materialid;
$Program=$_POST['Program'];
$data=array();
$sql="select * from voucher_issued_code where Program_ID='".$Program."'";
//echo $sql;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['vouchername'=>$row['voucher_name'],'ids'=>$row['voucher_code']];
}
echo json_encode($data);
?>