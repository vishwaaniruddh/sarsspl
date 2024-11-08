<?php
session_start();
include("config.php");
$id=$_GET['id'];
$tbl=$_GET['tbl'];
$stat=$_GET['stat'];
$field=$_GET['field'];
if(isset($tbl) && $tbl=='send_bill_detail')
{



$qr=mysqli_query($con,"select reqid,send_id,paid_amount,srvchrg from ".$tbl." where ".$field."='".$id."'");
$qrr=mysqli_fetch_row($qr);
/*$st=0.12*$qrr[3];
$ed=0.02*$st;
$hed=0.01*$st;
$totsv=$qrr[3]+$st+$ed+$hed;
*/


$gtgstdets=mysqli_query($con,"select * from send_bill where send_id='".$qrr[1]."'");
$gstrws=mysqli_fetch_array($gtgstdets);

if($gstrws['state']=="")
{
$to=$qrr[3];
$svt=$to*0.14;
$svt1=$to*0.005;
$svt2=$to*0.005;
$totsv=$svt+$svt1+$svt2+$to;

}
else
{
    
    
 $totsv=$qrr[3];   
    
}



$srvhiv=$qrr[3];
$sgstot=$gstrws['sgst'];
$cgstot=$gstrws['cgst'];
$igstot=$gstrws['igst'];




if($igstot>0.00)
{
$srvmttominus=$srvhiv*0.18;
$igstot=$igstot-$srvmttominus;
}


if($sgstot>0.00)
{
$srvmttominus=$srvhiv*0.09;
$sgstot=$sgstot-$srvmttominus;
$cgstot=$cgstot-$srvmttominus;
}


$oldgstmt=$gstrws["sgst"]+$gstrws["cgst"]+$gstrws["igst"];

$fnewgst=$sgstot+$cgstot+$igstot;


if($gstrws['state']!="")
{
$diff=$oldgstmt-$fnewgst;
$totsv=$totsv+$diff;
}

    

$up=mysqli_query($con,"update ebillfundrequests set print='n' where req_no='".$qrr[0]."'");

$up2=mysqli_query($con,"update send_bill set amount=amount-".$qrr[2].", servchrg=servchrg-".$totsv.",sgst='".$sgstot."',cgst='".$cgstot."',igst='".$igstot."' where send_id='".$qrr[1]."'");
}
$qry=mysqli_query($con,"update ".$tbl." set status='".$stat."',updtby='".$_SESSION['user']."' where ".$field."='".$id."'");
if($qry)
{
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
	if($field=="detail_id")
	mysqli_query($con,"update invscncpy set status='0',cancby='".$srno[0]."',cancdt='".date('Y-m-d H:i:s')."' where ".$field."='".$id."'");
	echo 1;
}
else
echo 0;

?>