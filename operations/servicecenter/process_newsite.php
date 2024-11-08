<?php
$cust=$_GET['cust'];
$bank=$_GET['bank'];
$state=$_GET['state'];
$city=$_GET['city'];
$add=$_GET['add'];
$pin=$_GET['pin'];
$atm=$_GET['atm'];
$sdate=$_GET['sdate'];
require_once('class_files/new_site.php');
$newsite_obj=new new_site();
$newsite_obj->create_new($atm,$cust,$bank,$pin,$city,$state,$sdate,$add);

if($newsite_obj)
{ 
	header('Location:view_site.php');
}
else
echo "Error Creating Site";
?>