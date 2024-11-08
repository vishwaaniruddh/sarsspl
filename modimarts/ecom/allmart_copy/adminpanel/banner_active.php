<?php
session_start();
include('config.php');
$errors=0;

$jsonstring = $_POST['dat'];
$array = json_decode($jsonstring,true);

$bannerid=$array['id'];
$typ=$array['status'];

for($a=0;$a<count($bannerid);$a++)
{
if($typ==1){
//echo "UPDATE `banners` SET `active`=1 WHERE id='".$bannerid."'";
$updtqry=mysqli_query($con3,"UPDATE `oc_pavosliderlayers` SET `status`=1 WHERE id='".$bannerid."'");
$atyp=1;
}
else{

//echo "UPDATE `banners` SET `active`=0 WHERE id='".$bannerid."'";
//echo "UPDATE `oc_pavosliderlayers` SET `status`=0 WHERE id='".$bannerid."'";
$updtqry=mysqli_query($con3,"UPDATE `oc_pavosliderlayers` SET `status`=0 WHERE id='".$bannerid."'");
$atyp=2;
}

$curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','CheckBox','Active/Deactive Carousel Slider Image','".$curr_dt."','".$_SESSION['lastSubID']."','". $bannerid." ','oc_pavosliderlayers') ");
		
	


if(!$updtqry){
 $errors++;
}

}
if($errors==0)
{
echo $atyp;

}
else{
echo "error";
}
?>