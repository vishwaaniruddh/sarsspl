<?php
session_start();
if(!$_SESSION['user']){
echo "0";
}else{
include("config.php");
$pamt=$_GET['pamt'];
$recon_chrg=round($_GET['recon_chrg'],2);
$discon_chrg=round($_GET['discon_chrg'],2);
$sd=round($_GET['sd'],2);
$after_duedt_chrg=round($_GET['after_duedt_chrg'],2);
$pdt=date('Y-m-d',strtotime(str_replace("/","-",$_GET['pdt'])));
$memo=$_GET['memo'];
$reqid=$_GET['reqid'];
$paid=$_GET['paid'];
$dt=date('Y-m-d H:i:s');
$se=mysqli_query($con,"select * from ebpayment where Bill_No='".$reqid."'");
if(mysqli_num_rows($se)>0)
{
$row=mysqli_fetch_array($se);
$qry=mysqli_query($con,"INSERT INTO `ebpayment_history` (`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`, `upby`, `status`, `extrachrg`, `incintax`,`entrydate`) VALUES ('".$row['Bill_No']."', '".$row['Paid_Amount']."', '".$row['Paid_Date']."'', '".$row['memo']."', '".$row['entrydt']."', '".$row['upby']."', '".$row['status']."', '".$row['extrachrg']."', '".$row['incintax']."','$dt')");
$qr=mysqli_query($con,"Update ebpayment set Paid_Amount='".$pamt."',Paid_Date='".$pdt."',memo='".$memo."',`upby`='".$_SESSION['user']."',status='".$paid."' where Bill_No='".$reqid."'");
}
else
{
$qr=mysqli_query($con,"INSERT INTO `ebpayment` (`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`,`upby`,`status`) VALUES ('".$reqid."', '".$pamt."','".$pdt."', '".$memo."','".$dt."','".$_SESSION['user']."','".$paid."')");
}
if($qr)
{
$str="INSERT INTO `ebillfundreqhistory` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `cust_id`, `reqby`, `trackerid`, `reqstatus`, `approvedamt`, `chqno`, `entrydate`, `memo`, `print`, `pstat`, `extrachrg`, `priority`, `updatetime`,`arrearstatus`,`bill_from`,`type`,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`) select `req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `cust_id`, '".$_SESSION['user']."', `trackerid`, `reqstatus`, `approvedamt`, `chqno`, '".$dt."', `memo`, `print`, `pstat`, `extrachrg`, `priority`, `updatetime`,`arrearstatus`,`billfrom`,`type`,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg` from ebillfundrequests where req_no='".$reqid."'";
$qry1=mysqli_query($con,$str);
if(!$qry1)
 echo mysqli_error();
$up=mysqli_query($con,"update ebillfundrequests set pstat='1',`recon_chrg`='".$recon_chrg."',`discon_chrg`='".$discon_chrg."',`sd`='".$sd."',`after_duedt_chrg`='".$after_duedt_chrg."' where req_no='".$reqid."'");
echo "1";

}
else
	echo "0";
//echo mysqli_error();
}
?>