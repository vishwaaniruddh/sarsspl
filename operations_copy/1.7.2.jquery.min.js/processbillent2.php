<?php
session_start();
if(!isset($_SESSION['user'])){
?>
<script type="text/javascript">
alert("Sorry, Your Session Has been Expired");
window.location="index.php";
</script>
<?php
}
include("config.php");
$status=0;
//$sr=mysqli_query($con,"select username from login where srno='".$_SESSION['user']."'");
//$srn=mysqli_fetch_row($sr);
if(isset($_POST['cmdsub']))
{
//echo "hi";
/*if($_POST['cust']=='FSS04' && $_POST['bank']=='ICICI' && $_POST['amount']>'10000')
	$stat='w';
	elseif($_POST['cust']=='FSS04' && $_POST['bank']!='ICICI' && $_POST['amount']>'8000')
	$stat='w';
	else*/
	$stat='n';

$srno=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$sr=mysqli_fetch_row($srno);
$frmdt=str_replace('/','-',$_POST['fromdt']);
$billdt=str_replace('/','-',$_POST['bill_date']);
$todt=str_replace('/','-',$_POST['todt']);
$duedt=str_replace('/','-',$_POST['duedt']);
$paiddt=str_replace('/','-',$_POST['paiddt']);

 $frmdt2=date('Y-m-',strtotime($frmdt));
//echo "<br>";
$billdt2=date('Y-m-',strtotime($billdt));//echo "<br>";
 $todt2=date('Y-m-',strtotime($todt));//echo "<br>";
 $duedt2=date('Y-m-',strtotime($duedt));//echo "<br>";
 $paiddt2=date('Y-m-',strtotime($paiddt));//echo "<br>";
$ebchk="select * from ebillfundrequests where reqstatus<>'0' and cust_id='".$_POST['cust']."' and atmid='".$_POST['atmid']."' and trackerid='".$_POST['trackid']."' and (due_date like '".$duedt2."%' OR start_date like '".$frmdt2."%' or end_date like '".$todt2."%' or bill_date like '".$billdt2."%' )";
//echo $ebchk;
$get=mysqli_query($con,$ebchk);
if(mysqli_num_rows($get)>0)
$status= "It seems entry for this month is already made";
else
{
//echo "INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$sv."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', Now(), '".$_POST['cust']."', '".$sr[0]."', '".$_POST['trackid']."','3','".$_POST['memo']."','".$stat."','".$_POST['cases']."')";
/*$qry=mysqli_query($con,"INSERT INTO `ebdetails` (`bill_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `print`, `due_date`, `opening_reading`, `closing_reading`, `extracharge`, `entrydt`, `cust_id`, `ebid`, `trackerid`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$stat."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$_POST['extra']."', Now(), '".$_POST['cust']."', '0', '".$_POST['trackid']."')");*/
$qry=mysqli_query($con,"INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$sv."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".date('Y-m-d H:i:s')."', '".$_POST['cust']."', '".$sr[0]."', '".$_POST['trackid']."','3','".$_POST['memo']."','".$stat."','".$_POST['cases']."')");
if(!$qry)
echo mysqli_error();
$id=mysqli_insert_id();
//$qr=mysqli_query($con,"INSERT INTO `ebpayment` (`Bill_No`, `Paid_Amount`, `Paid_Date`) VALUES ('".$id."', '".$_POST['amount']."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'))");
if($qry)
$status='Entry made Successfully';
else
$status=mysqli_error();

}
}
if(isset($_POST['cmdapp']))
{
if(isset($_POST['cons']))
$cons=$_POST['newcons'];
else
$cons=$_POST['con_no'];

$qry=mysqli_query($con,"INSERT INTO `uploadedebillerr` (`id`, `atmid`, `consumerno`, `frmdt`, `todt`, `billdt`, `duedt`, `paiddt`, `openreading`, `closereading`, `units`, `paidamt`, `extracharge`, `totalamt`, `error`, `cid`, `entrydt`, `status`) VALUES (NULL, '".$_POST['atmid']."','".$cons."',  STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'),STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'),STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$_POST['billunit']."', '".$_POST['amount']."', '".$_POST['extra']."', '".($_POST['amount'])."', '".$_POST['err']."', '".$_POST['cust']."', Now(), '0')");
if($qry)
$status='Entry Made Successfully';
else
$status="Some Error Occurred";
}

$_SESSION['success']=$status;
//header('location:ebillfundrequest.php');

?>