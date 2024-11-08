<?php
include('config.php');
$type=$_GET['type'];
$val=$_GET['val'];
$cid=$_GET['cid'];
$error='';
$str2="select cust_id from mastersites where ".$type."='".$val."' and status='0'";
//echo $str2;
$atm=mysqli_query($con,$str2);

$atmro=mysqli_fetch_row($atm);
$str="select e.Consumer_No,e.Distributor,s.atm_id1,e.Due_date,e.landlord,e.billing_unit,e.meter_no,e.averagebill,s.atmsite_address,s.trackerid,s.cust_id,s.bank,s.projectid,s.state from ".$atmro[0]."_ebill e,".$atmro[0]."_sites s where s.active='Y' and e.atmtrackid=s.trackerid";
if($type=='atm_id1')
{
$str.=" and s.atm_id1='".$val."'";

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
$row=mysqli_fetch_array($qry);
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

$pending_req=array();
$reject_reason_str='';
$back_pending=0;
$threshhold_qry=mysqli_query($con,"SELECT threshhold FROM `threshhold` WHERE `cust_id` LIKE '".$row['cust_id']."' AND `project_id` LIKE '".$row['projectid']."' AND `bank` LIKE '".$qrrow[1]."'");
if(mysqli_num_rows($threshhold_qry)>0)
{
	$threshhold=mysqli_fetch_array($threshhold_qry);
	$threshhold_val=intval($threshhold[0]);
$th_chck_qry=mysqli_query($con,"select * from ebillfundrequests f where f.reqstatus<>100 and f.reqstatus<>0 and f.req_no not in (select alert_id from ebfundtranscanc where status=0) and f.req_no not in (select reqid from ebillfundcancinv where status=0)  and f.atmid like ('".$val."') and f.print='n' and f.req_no>41220 order by f.req_no");
while($th_chck=mysqli_fetch_array($th_chck_qry))
{
	$amtToComp=$th_chck['amount'];
	$ebpay_qry=mysqli_query($con,"select Paid_Amount from ebpayment where Bill_No='".$th_chck['req_no']."'");
	if(mysqli_num_rows($ebpay_qry)>0)
	{
		$ebpay_row=mysqli_fetch_array($ebpay_qry);
		$amtToComp=$ebpay_row[0];
	}
	$nod1=floor((strtotime($th_chck['end_date'])-strtotime($th_chck['start_date'])) / 86400);
	$chck_amt=intval($amtToComp*30.0/$nod1,2);
	//echo $chck_amt.">".$threshhold_val." ".$th_chck['req_no']."<br/>";
	if($chck_amt>$threshhold_val)
	{
		$email_attach_chck_qry1=mysqli_query($con,"select copy from ebillemailcpy where reqid='".$th_chck[0]."' and status='0'");
		if(mysqli_num_rows($email_attach_chck_qry1)==0)
		{
			$back_pending++;
			$pending_req[]=$th_chck[0];
		}
	}
}
}
if($back_pending>0)
{
	$reject_reason_str="Previous Email not attached. Request ids are ".implode(",", $pending_req);
}
 $str=$row[0]."###$$$".$op."###$$$".$row[2]."###$$$".$row[3]."###$$$".$row[4]."###$$$".$row[5]."###$$$".$row[6]."###$$$".$row[7]."###$$$".$row[8]."###$$$".$row[9]."###$$$".$row[10]."###$$$".$ebfro[1]."###$$$".$row[11]."###$$$".$row[12]."###$$$".$back_pending."###$$$".$reject_reason_str;

$ebx=mysqli_query($con,"select * from EBILL_WEBLINKS where TRACKER_ID='".$row[9]."'");
if(mysqli_num_rows($ebx)>0){
$ebxr=mysqli_fetch_row($ebx);
$str=$str."###$$$".$ebxr[2]."###$$$".$ebxr[3]."###$$$".$ebxr[4];
}
echo $str;
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