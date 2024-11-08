<?php session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{
include('config.php');
$error=0;

$reqid=$_POST['reqid'];



$qry2=mysqli_query($con,"select * from ebillfundrequests where req_no='".$reqid."'");
$qrws2=mysqli_fetch_array($qry2);

$qry4=mysqli_query($con,"select * from ebpayment where bill_no='".$reqid."'");
$epcnt=mysqli_num_rows($qry4);
$qrws4=mysqli_fetch_array($qry4);
if($epcnt==0)
{
$error++;
}



if($qrws2[20]=='n' & $qrws2[21]=='0')
{
$error++;
}



if($qrws2[20]=='y' & $qrws2[21]=='1')
{
$qry=mysqli_query($con,"select * from send_bill_detail where reqid='".$reqid."'");
$qrws=mysqli_fetch_array($qry);
if($qrws[14]!=1)
{
$error++;
}
}


if($error==0)
{
$cstname=explode('_',$qrws[2]);


?>

<table border="2" cellspacing='2'>
<th>Customer</th>
<th>Atmid</th>
<th>Paid Amount</th>
<th></th>


<tr>
<td><?php echo $qrws2[12];?></td>
<td><?php echo $qrws2[1];?></td>
<td><?php echo round($qrws4[1]);?></td>
<td><input type="button" name="subm" id="subm" value="Submit" onclick="subfunc();"></td>
</tr>


</table>
<?php
}
else
{
echo "cannot remove this record";
}
}
?>