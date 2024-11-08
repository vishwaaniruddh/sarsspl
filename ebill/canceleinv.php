<?php
session_start();
if(!isset($_SESSION['user']))
header('location:index.php');
else
{
include('config.php');
$cid=$_GET['cid'];
$invid=$_GET['eid'];
$reqid=array();
//echo "select reqid from send_bill where send_id='".$invid."' and status=0";
$qry2=mysqli_query($con,"select * from send_bill where send_id='".$invid."' and status=0");
if(mysqli_num_rows($qry2)>0)
{
$qry=mysqli_query($con,"select reqid,detail_id from send_bill_detail where send_id='".$invid."' and status=0");
while($row=mysqli_fetch_row($qry))
{
$reqid[]=$row[0];
}
$req=implode(',',$reqid);
$req=str_replace(",","','",$req);
$req="'".$req."'";
//echo $req;

$detail_id=implode(',',$detailid);
$detail_id=str_replace(",","','",$detail_id);
$detail_id="'".$detail_id."'";
//echo $detail_id;
$reqqr=mysqli_query($con,"update ebillfundrequests set print='n' where req_no in ($req)");
if($reqqr)
{
$up=mysqli_query($con,"update send_bill set status='1',cancelledby='".$_SESSION['user']."' where send_id='".$invid."'");
if($up)
{
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
	mysqli_query($con,"update invscncpy set status='0',cancby='".$srno[0]."',cancdt='".date('Y-m-d H:i:s')."' where detail_id in ($detail_id)");
	echo "<script type='text/javascript'>alert('Invoice Cancelled Successfully'); window.close();</script>";
}
}
else
echo "<script type='text/javascript'>alert('Some Error Occurred'); window.close();</script>";
}
else
echo "<script type='text/javascript'>alert('Invalid Request'); window.close();</script>";
}
?>