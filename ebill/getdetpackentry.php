<?php
include('config.php');
$type=$_GET['type'];
$val=$_GET['val'];

$error='';
$str2="select cust_id from mastersites where ".$type."='".$val."' and status='0'";
//echo $str2;
$atm=mysqli_query($con,$str2);

$atmro=mysqli_fetch_row($atm);
$str="select e.Consumer_No,s.atm_id1,s.atmsite_address,s.trackerid,s.cust_id,s.bank,s.state from ".$atmro[0]."_ebill e,".$atmro[0]."_sites s where s.active='Y' and e.atmtrackid=s.trackerid";
if($type=='atm_id1' && $val!='')
{


$str.=" and (s.atm_id1='".$val."' or s.atm_id2='".$val."' or s.atm_id3='".$val."')";

}
elseif($type=='atmtrackid')
$str.=" and e.atmtrackid='".$val."'";
elseif($type=='address')
$str.=" and s.atmsite_address like '%".$val."%'";
elseif($type=='Consumer_No')
$str.=" and e.Consumer_No = '".$val."'";
elseif($type=='meter_no')
$str.=" and e.meter_no = '".$val."'";

$str.=" order by e.id DESC";
//echo $str;
$qry=mysqli_query($con,$str);
if(mysqli_num_rows($qry)>0)
{
$row=mysqli_fetch_row($qry);
$ebf=mysqli_query($con,"select max(req_no),supervisor from ebillfundrequests where trackerid='".$row[3]."' and reqstatus<>0");
$ebfro=mysqli_fetch_row($ebf);
$op="<option value=''>select Provider</option>";
//echo "select code,provider from eserviceprovider where state='-1' or state='".$row[6]."'";
$sp=mysqli_query($con,"select code,provider from eserviceprovider where state='-1' or state='".$row[6]."' order by provider ASC");
while($spro=mysqli_fetch_array($sp))
{
$op=$op."<option value='$spro[0]' "; 
if($spro[0]==$row[1] || $spro[1]==$row[1]){ $op=$op."selected='selected'"; }
$op=$op.">$spro[1]<option>";
}


echo $row[0]."###$$$".$row[2]."###$$$".$row[3]."###$$$".$row[4]."###$$$".$row[5]."###$$$".$row[1];

}
else
{
$error="NA";
$error.="###$$$";
if($type=='atm_id1')
$error.="Atm ID Not Found";
elseif($type=='atmtrackid' || $type=='address')
$error.="Site Not Found";
elseif($type=='Consumer_No')
$error.="Consumer Number Not Found";
elseif($type=='meter_no')
$error.="Meter Number Not Found";
echo $error;
}
?>