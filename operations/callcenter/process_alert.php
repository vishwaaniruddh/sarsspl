<?php
$atm=$_GET['atm'];
$cust=$_GET['cust'];
$bank=$_GET['bank'];
$state=$_GET['state'];
$city=$_GET['city'];
$area=$_GET['area'];
$add=$_GET['add'];
$pin=$_GET['pin'];
$adate=$_GET['adate'];
///$cdate=$_GET['cdate'];
$prob=$_GET['prob'];
$cname=$_GET['cname'];
$cphone=$_GET['cphone'];
$cemail=$_GET['cemail'];

require_once('class_files/insert.php');
$in_obj=new insert();
$in_obj->insert_into('localhost','site','site','atm_site','alert',array("cust_id","atm_id","bank_name","area","address","city","state","pincode","problem","caller_name","caller_phone","caller_email","alert_date"),array($cust,$atm,$bank,$area,$add,$city,$state,$pin,$prob,$cname,$cphone,$cemail,$adate));

if($in_obj)
{
	header('Location:newalert.php');
}
else
echo "Error Creating Alert";
?>