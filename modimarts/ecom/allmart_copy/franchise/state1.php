<?php
include ('config.php');
//echo $materialid;
$zone=$_POST['zone'];
$data=array();
$sql="select id,state from state where  zone_id=".$zone;
//echo $sql;
$result=mysqli_query($conn,$sql);
if($result!=''){
while($row=mysqli_fetch_array($result))
{
    $data[0][]=['modelno'=>$row['state'],'ids'=>$row['id']];
}

$sql="select s.*,c.* from state s join city c on s.id=c.state_id where s.zone_id=".$zone;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[1][]=['state'=>$row['state'],'city'=>$row['city']];
}
} else{
    $data=array();
}
echo json_encode($data);
?>