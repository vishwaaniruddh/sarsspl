<?php
include ('config.php');
//echo $materialid;
$country=$_POST['country'];
$data=array();
//$sql="select distinct(z.Zone),c.country,s.state from zone z inner join country c on z.country_id=c.id and z.country_id=".$country." left join state s on s.zone_id=c.id";
$sql="select id,Zone from zone where country_id=".$country;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[0][]=['modelno'=>$row['Zone'],'zone'=>$row['Zone'],'ids'=>$row['id']];
}

$sql="select z.*,s.* from zone z join state s on z.id=s.zone_id where z.country_id=".$country;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[1][]=['state'=>$row['state'],'zone'=>$row['zone']];
}
//var_dump($data);exit;
echo json_encode($data);
?>