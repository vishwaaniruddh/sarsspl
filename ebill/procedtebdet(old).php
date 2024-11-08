<?php
session_start();
if(!$_SESSION['user'])
{
header('location:index.php');
}
else
{
include("config.php");
$dt=date('Y-m-d H:i:s');
$recon_chrg=round($_POST['recon_chrg'],2);
$discon_chrg=round($_POST['discon_chrg'],2);
$sd=round($_POST['sd'],2);
$after_duedt_chrg=round($_POST['after_duedt_chrg'],2);
$str="INSERT INTO `ebillfundreqhistory` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `cust_id`, `reqby`, `trackerid`, `reqstatus`, `approvedamt`, `chqno`, `entrydate`, `memo`, `print`, `pstat`, `extrachrg`, `priority`, `updatetime`,`arrearstatus`,`bill_from`,`type`,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`) select `req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `cust_id`, '".$_SESSION['user']."', `trackerid`, `reqstatus`, `approvedamt`, `chqno`, '".$dt."', `memo`, `print`, `pstat`, `extrachrg`, `priority`, `updatetime`,`arrearstatus`,`billfrom`,`type`,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg` from ebillfundrequests where req_no='".$_POST['reqno']."'";
$qry1=mysqli_query($con,$str);
if(!$qry1)
	echo mysqli_error();
$str2="UPDATE `ebillfundrequests` SET `bill_date`=STR_TO_DATE('".$_POST['billdt']."','%d/%m/%Y'),`billfrom`=STR_TO_DATE('".$_POST['billfrmdt']."','%d/%m/%Y'),`unit`='".$_POST['unit']."',`start_date`=STR_TO_DATE('".$_POST['stdt']."','%d/%m/%Y'),`end_date`=STR_TO_DATE('".$_POST['enddt']."','%d/%m/%Y'),`due_date`=STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'),`opening_reading`='".$_POST['openread']."',`closing_reading`='".$_POST['closeread']."',`pstat`='1',`extrachrg`='".$_POST['xtrachrg']."',`recon_chrg`='".$recon_chrg."',`discon_chrg`='".$discon_chrg."',`sd`='".$sd."',`after_duedt_chrg`='".$after_duedt_chrg."',bill_amt='".$_POST['bamt']."',afdt_amt='".$_POST['adtamt']."',trans_id='".$_POST['trsid']."'";
if(isset($_REQUEST['extrachrg_stat']))
$str2.=",extrachrg_stat=1";
else
$str2.=",extrachrg_stat=0";
if(isset($_REQUEST['recon_chrg_stat']))
$str2.=",recon_chrg_stat=1";
else
$str2.=",recon_chrg_stat=0";
if(isset($_REQUEST['discon_chrg_stat']))
$str2.=",discon_chrg_stat=1";
else
$str2.=",discon_chrg_stat=0";
if(isset($_REQUEST['sd_stat']))
$str2.=",sd_stat=1";
else
$str2.=",sd_stat=0";
if(isset($_REQUEST['after_duedt_chrg_stat']))
$str2.=",after_duedt_chrg_stat=1";
else
$str2.=",after_duedt_chrg_stat=0";
$str2.=" WHERE req_no='".$_POST['reqno']."'";
//echo $str2;
$qry=mysqli_query($con,$str2);
if($qry)
{
if(isset($_POST['fundid']))
{
for($i=0;$i<count($_POST['fundid']);$i++)
{
$ins="INSERT INTO `ebillfundcancinv` (`id`, `reqid`, `entrydt`, `updtby`, `status`) VALUES (NULL, '".$_POST['fundid'][$i]."', '".$dt."', '".$_SESSION['user']."', '0')";
$insqry=mysqli_query($con,$ins);
}
}

$memo=str_replace("'","\'",$_POST['memo']);
$pdt=str_replace('/','-',$_POST['paiddt']);
$pdt2=date('Y-m-d',strtotime($pdt));
$dt=date('Y-m-d H:i:s');
$se=mysqli_query($con,"select * from ebpayment where Bill_No='".$_POST['reqno']."'");
if(mysqli_num_rows($se)>0)
{
$row=mysqli_fetch_array($se);
$qry=mysqli_query($con,"INSERT INTO `ebpayment_history` (`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`, `upby`, `status`, `extrachrg`, `incintax`,`entrydate`) VALUES ('".$row['Bill_No']."', '".$row['Paid_Amount']."', '".$row['Paid_Date']."'', '".$row['memo']."', '".$row['entrydt']."', '".$row['upby']."', '".$row['status']."', '".$row['extrachrg']."', '".$row['incintax']."','$dt')");
$up=mysqli_query($con,"Update ebpayment set Paid_Amount='".$_POST['paidamt']."',Paid_Date='".$pdt2."',memo='".$memo."',`upby`='".$_SESSION['user']."',extrachrg='".$_POST['xtrachrg']."',status='".$_POST['paid']."',entrydt='".$dt."' where Bill_No='".$_POST['reqno']."'");
}
else
{

$qr=mysqli_query($con,"INSERT INTO `ebpayment` (`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`,`upby`,`status`,`extrachrg`) VALUES ('".$_POST['reqno']."', '".$_POST['paidamt']."','".$pdt2."', '".$memo."','".$dt."','".$_SESSION['user']."','".$_POST['paid']."','".$_POST['xtrachrg']."')");
}
if(isset($_POST['page']) && $_POST['page']=='update')
header('location:viewpaidebill.php?cid='.$_POST['cid']);
else
header('location:generateEbill.php?cid='.$_POST['cid']);
}
else
echo "Error Updating data".mysqli_error();
}
?>