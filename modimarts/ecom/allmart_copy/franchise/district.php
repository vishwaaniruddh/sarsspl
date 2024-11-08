<?php
include ('config.php');
//echo $materialid;
$city=$_POST['city'];
$data=array();
//$sql="select District from India_structure where City='".$dist."' and star='district'";
$sql="select id,district from district where city_id=".$city;
//echo $sql;
$result=mysqli_query($conn,$sql);
if($result!=''){
while($row=mysqli_fetch_array($result))
{
$data[]=['modelno'=>$row['district'],'ids'=>$row['id']];
}
} else {
    $data=array();
}
echo json_encode($data);
?>