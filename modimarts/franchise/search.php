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
    $col_name='pincode';
    $check_value=$_POST['pincode'];
}

if(isset($_POST['village'])){
    $col_name='village';
    $check_value=$_POST['village'];
}
// echo 'col = '.$col_name.'   val='.$check_value;

$data=array();
$sql = "
select country.id as cid , zone.id as zid , state.id as sid , division.id as division_id , district.id district_id ,taluka.id taluka_id , pincode.id pincode_id,country.country as country , zone.zone as zone , state.state as state , division.division as division , district.district district ,taluka.taluka taluka , pincode.pincode pincode   from 
new_country country JOIN new_zone zone on country.id = zone.country 
JOIN new_state state on zone.id = state.zone
JOIN new_division division on state.id = division.state
JOIN new_district district on division.id = district.division
JOIN new_taluka taluka on district.id = taluka.district
JOIN new_pincode pincode on taluka.id = pincode.taluka".
        " WHERE ". $col_name."='$check_value'";


echo $sql;

$result=mysqli_query($con,$sql);
if($result!=''){
while($row=mysqli_fetch_array($result))
{

$data[]=['state'=>$row['sid'],'zone'=>$row['zid'],'country'=>$row['cid'],'division'=>$row['division_id'],'district'=>$row['district_id'],'taluka'=>$row['taluka_id'],'pincode'=>$row['pincode_id']];
    
}
} else {
    $data='not found';
}
echo json_encode($data);

?>