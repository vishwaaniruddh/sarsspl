<?php
include('config.php');
$type=$_GET['type'];
$val=$_GET['val'];
$cid=$_GET['cid'];
//$sv=$_GET['sv'];
$error='';
$str2="select cust_id from mastersites where ".$type."='".$val."' and status='0'";
//echo $str2;
$atm=mysqli_query($con,$str2);
$atmro=mysqli_fetch_row($atm);
/*if(!$atmro)
	echo mysqli_error();*/
$str="select e.Consumer_No,e.Distributor,s.atm_id1,e.Due_date,e.landlord,e.billing_unit,e.meter_no,e.averagebill,s.atmsite_address,s.trackerid,s.cust_id,s.bank,s.projectid,s.state from ".$atmro[0]."_ebill e,".$atmro[0]."_sites s where s.active='Y' and e.atmtrackid=s.trackerid";
if($type=='atm_id1')
{
	$str.=" and s.atm_id1='".$val."'";
}
/*elseif($type=='atmtrackid')
$str.=" and e.atmtrackid='".$val."'";
elseif($type=='address')
$str.=" and s.atmsite_address like '%".$val."%'";
elseif($type=='Consumer_No')
$str.=" and e.Consumer_No = '".$val."'";
elseif($type=='meter_no')
$str.=" and e.meter_no = '".$val."'";*/

$str.=" order by e.id DESC";
//echo "<br/>".$str;
$qry=mysqli_query($con,$str);
/*if(!$qry)
	echo mysqli_error();*/
if(mysqli_num_rows($qry)>0)
{
$row=mysqli_fetch_row($qry);
echo "true###$$$".$row[9];
/*
//echo "select max(req_no),supervisor from ebillfundrequests where trackerid='".$row[9]."' and reqstatus<>0";
$ebf=mysqli_query($con,"select max(req_no),supervisor from ebillfundrequests where trackerid='".$row[9]."' and reqstatus<>0");
$ebfro=mysqli_fetch_row($ebf);
$op="<select name='distributor' id='distributor' style='width:150px'><option value='' width='60px'>select Provider</option>";
//echo "select code,provider from eserviceprovider where state='-1' or state='".$row[13]."'";
$sp=mysqli_query($con,"select code,provider from eserviceprovider where state='-1' or state='".$row[13]."' order by provider ASC");
while($spro=mysqli_fetch_array($sp))
{
$op=$op."<option value='$spro[0]' "; if($spro[0]==$row[1] || $spro[1]==$row[1]){ $op=$op."selected='selected'"; }$op=$op.">$spro[1]<option>";
}
$op=$op."<select>";

echo $row[0]."###$$$".$op."###$$$".$row[2]."###$$$".$row[3]."###$$$".$row[4]."###$$$".$row[5]."###$$$".$row[6]."###$$$".$row[7]."###$$$".$row[8]."###$$$".$row[9]."###$$$".$row[10]."###$$$".$ebfro[1]."###$$$".$row[11]."###$$$".$row[12];
*/
}
else
{
$error="false";
$error.="###$$$";
if($type=='atm_id1')
$error.="Atm ID Not Found";
/*
elseif($type=='atmtrackid' || $type=='address')
$error.="Site Not Found";
elseif($type=='Consumer_No')
$error.="Consumer Number Not Found";
elseif($type=='meter_no')
$error.="Meter Number Not Found";
*/
echo $error;
}
?>