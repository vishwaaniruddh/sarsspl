<?php
include ('config.php');
$check_value='';
$col_name='';
if($_POST['country']!=''){
    $check_value=$_POST['country'];
    $col_name='country';
}
if(isset($_POST['zone'])){
    $check_value=$_POST['zone'];
    $col_name='zone';
}
if(isset($_POST['state'])){
   $col_name='s.state';
   $check_value=$_POST['state'];
}
if(isset($_POST['city'])){
    $col_name='ct.city';
    $check_value=$_POST['city'];
}
if(isset($_POST['district'])){
    $col_name='d.district';
    $check_value=$_POST['district'];
}
if(isset($_POST['taluka'])){
    $col_name='t.taluka';
    $check_value=$_POST['taluka'];
}
if(isset($_POST['pincode'])){
    $col_name='p.pincode';
    $check_value=$_POST['pincode'];
}
/*if(isset($_POST['ward'])){
    $col_name='ward';
    $check_value=$_POST['ward'];
}*/
if(isset($_POST['village'])){
    $col_name='village';
    $check_value=$_POST['village'];
}
//echo 'col = '.$col_name.'   val='.$check_value;

$data=array();
$sql = "SELECT s.id as sid,z.id as zid,c.id as cid,ct.id as cityid,t.id as tid,d.id as did,p.id as pid, p.Village as village".
        //" ,w.id as wid,v.id as vid ".
        " FROM country c join zone z on c.id=z.country_id ".
        "JOIN state s on z.id=s.zone_id JOIN city ct on s.id=ct.state_id ".
        "JOIN district d on ct.id=d.city_id JOIN taluka t on d.id=t.district_id ".
        "JOIN pincode p on p.taluka_id=t.id ".
        //"JOIN ward w on t.id=w.taluka_id JOIN village v on w.id=v.ward_id".
        " WHERE ". $col_name."='$check_value'";
       // echo $sql;
        
//var_dump($sql);
$result=mysqli_query($conn,$sql);
if($result!=''){
while($row=mysqli_fetch_array($result))
{
/*$data[]=['state'=>$row['sid'],'zone'=>$row['zid'],'country'=>$row['cid'],'city'=>$row['cityid'],'district'=>$row['did'],'taluka'=>$row['tid'],'ward'=>$row['wid'],'village'=>$row['vid']];*/
$data[]=['state'=>$row['sid'],'zone'=>$row['zid'],'country'=>$row['cid'],'city'=>$row['cityid'],'district'=>$row['did'],'taluka'=>$row['tid'],'pincode'=>$row['pid'],'village'=>$row['village']];
    
}
} else {
    $data=array();
}
echo json_encode($data);
//echo $data;

?>