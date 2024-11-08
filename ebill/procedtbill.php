<?php
session_start();
if(!isset($_SESSION['user']))
header('location:index.php');
else
{
include("config.php");
if(isset($_POST['cmdsub']))
{
$invid=$_POST['invid'];
$detid=$_POST['detid'];
$reqid=$_POST['reqid'];
$pamt=$_POST['pamt'];
$exchrg=$_POST['exchrg'];
$rcchrg=$_POST['rcchrg'];
$dcchrg=$_POST['dcchrg'];
$sdchrg=$_POST['sdchrg'];
$adcchrg=$_POST['adcchrg'];
$fisyr=$_POST['fisyr'];
for($i=0;$i<count($reqid);$i++)
{
//echo $reqid[$i];
$sbd1_qry=mysqli_query($con,"select * from send_bill_detail where `detail_id`='".$detid[$i]."' and `paid_amount`='".$pamt[$i]."' AND `extrachrg` = '".$exchrg[$i]."' AND `recon_chrg` = '".$rcchrg[$i]."' AND `discon_chrg` = '".$dcchrg[$i]."' AND `sd` = '".$sdchrg[$i]."' AND `after_duedt_chrg` = '".$adcchrg[$i]."' ");
if(mysqli_num_rows($sbd1_qry)==0)
{
$sbd_qry=mysqli_query($con,"select * from send_bill_detail where `detail_id`='".$detid[$i]."'");
$sbd_row=mysqli_fetch_array($sbd_qry);
mysqli_query($con,"INSERT INTO `send_bill_detail_history`( `detail_id`, `send_id`, `paid_amount`, `updtby`, `reqid`, `extrachrg`, `recon_chrg`, `discon_chrg`, `sd`, `after_duedt_chrg`, `updt`) VALUES ('".$sbd_row['detail_id']."','".$sbd_row['send_id']."','".$sbd_row['paid_amount']."','".$_SESSION['user']."','".$sbd_row['reqid']."','".$sbd_row['extrachrg']."','".$sbd_row['recon_chrg']."','".$sbd_row['discon_chrg']."','".$sbd_row['sd']."','".$sbd_row['after_duedt_chrg']."','".date('Y-m-d H:i:s')."')");
//echo "update send_bill_detail set paid_amount='".$pamt[$i]."',extrachrg='".$exchrg[$i]."',recon_chrg='".$rcchrg[$i]."',discon_chrg='".$dcchrg[$i]."',sd='".$sdchrg[$i]."',after_duedt_chrg='".$adcchrg[$i]."' where detail_id='".$detid[$i]."'";
$up=mysqli_query($con,"update send_bill_detail set paid_amount='".$pamt[$i]."',extrachrg='".$exchrg[$i]."',recon_chrg='".$rcchrg[$i]."',discon_chrg='".$dcchrg[$i]."',sd='".$sdchrg[$i]."',after_duedt_chrg='".$adcchrg[$i]."' where detail_id='".$detid[$i]."'");
if(!$up)
echo mysqli_error();
/*
$sql2="update ebpayment set Paid_Amount='".$pamt[$i]."' where Bill_No='".$reqid[$i]."'";
$up2=mysqli_query($con,"update ebpayment set Paid_Amount='".$pamt[$i]."' where Bill_No='".$reqid[$i]."'");
if(!$up2)
echo mysqli_error();*/
//echo $sql1."<br>".$sql2."<br>";
}
}
//echo "select sum(paid_amount) from send_bill_detail where send_id='".$invid."' and fiscalyr='".$fisyr."'";
$sql3=mysqli_query($con,"select sum(paid_amount) from send_bill_detail where send_id='".$invid."' and fiscalyr='".$fisyr."' and status=0");
$sql3ro=mysqli_fetch_row($sql3);

$sql4="update send_bill set amount='".$sql3ro[0]."' where send_id='".$invid."' and fiscalyr='".$fisyr."'";
$up3=mysqli_query($con,"update send_bill set amount='".$sql3ro[0]."' where send_id='".$invid."' and fiscalyr='".$fisyr."'");
//echo $sql4;
}
header('location:oldeinvoice.php');

}
?>