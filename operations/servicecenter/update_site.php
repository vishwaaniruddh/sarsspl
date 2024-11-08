<?php
$cust=$_POST['cust'];
$id=$_POST['id'];
$bank=$_POST['bank'];
$state=$_POST['state'];
$city=$_POST['city'];
$pin=$_POST['pin'];
$atm=$_POST['atm'];
$sdate=$_POST['sdate'];
$add=$_POST['add'];


require_once('class_files/update.php');
$update=new update();
$update->update_table('localhost','site','site','atm_site','atm',array("atm_id","cust_id","bank_name","pincode","city","state","start_date","address"),array($atm,$cust,$bank,$pin,$city,$state,$sdate,$add),'track_id',$id);

if($update)
{
	header('Location:view_site.php');
}
else
echo "Error Updating City Head";
?>