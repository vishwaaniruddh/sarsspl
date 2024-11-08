<?php
include ('config.php');
//echo $materialid;
$state=$_POST['state'];
$data=array();
$sql="select id,city from city where state_id=".$state;
$result=mysqli_query($conn,$sql);
if($result!=''){
while($row=mysqli_fetch_array($result))
{
$data[0][]=['modelno'=>$row['city'],'ids'=>$row['id']];
}
$sql="select c.*,d.* from city c join district d on c.id=d.city_id where c.state_id=".$state;

$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[1][]=['city'=>$row['city'],'district'=>$row['district']];
}

} else {
    $data=array();
}
echo json_encode($data);
?>