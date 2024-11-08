<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "Sorry Your session has Expired. You need to login Again";
}
else
{
include("config.php");
 $trackid=$_GET['trackid'];
 $atm=$_GET['atmid'];
 $custid=$_GET['custid'];
//echo "select bill_date,start_date,end_date,due_date,amount,req_no,approvedamt,supervisor,reqby from ebillfundrequests where atmid='".$atm."' and cust_id='".$custid."' and trackerid='".$trackid."' and reqstatus<>'0' order by due_date DESC limit 10";
$qry=mysqli_query($con,"select bill_date,start_date,end_date,due_date,amount,req_no,approvedamt,supervisor,reqby from ebillfundrequests where atmid='".$atm."' and cust_id='".$custid."' and trackerid='".$trackid."' and reqstatus<>'0' order by due_date DESC limit 10");
//echo $qry;
?>

<table width="100px">
<?php
if(mysqli_num_rows($qry)>0)
{
while($row=mysqli_fetch_array($qry)){
//echo "select * from ebpayment where Bill_no='".$row[5]."'";
$qr=mysqli_query($con,"select * from ebpayment where Bill_no='".$row[5]."'");
$ro=mysqli_fetch_row($qr);
$transfer=mysqli_query($con,"select * from ebillfundapp where reqid='".$row[5]."' and level='8'");
$srno=mysqli_query($con,"select username,designation from login where srno='".$row[8]."'");
$sr=mysqli_fetch_row($srno);
$inv=mysqli_query($con,"select send_id from send_bill_detail where reqid='".$row[5]."'");
$invro=mysqli_fetch_row($inv);
$send_bill_qry=mysqli_query($con,"select * from send_bill where send_id='$invro[0]'");
$send_bill=mysqli_fetch_array($send_bill_qry);
?>
<tr><th colspan="2">Fund Request</th></tr>
<tr>
<td><b>Requset Id : </b></td><td><?php echo $row['req_no']; ?></td></tr>
<td><b>Bill Date</b></td><td><?php   if($row[0]!='0000-00-00'){ echo date('d, M Y',strtotime($row[0])); }  ?></td></tr>
<tr><td><b>Start Date</b></td><td><?php if($row[1]!='0000-00-00'){ echo date('d, M Y',strtotime($row[1])); } ?></td></tr>
<tr><td><b>End Date</b></td><td><?php if($row[2]!='0000-00-00'){echo date('d, M Y',strtotime($row[2])); }  ?></td></tr>
<tr><td><b>Due Date</b></td><td><?php if($row[3]!='0000-00-00'){echo date('d, M Y',strtotime($row[3]));}  ?></td></tr>
<tr><td><b>Supervisor</b></td><td><?php if($row[7]!='-1'){ echo $row[7]; }  ?></td></tr>
<tr><td><b>Requested Amount</b></td><td><?php echo $row[4];  ?></td></tr>
<?php if(mysqli_num_rows($transfer)>0){ $transro=mysqli_fetch_row($transfer); ?><tr style="background-color:#98AFC7"><td><b>Transferred Amount</b></td><td><?php echo $row[6]; ?></td></tr>

<tr style="background-color:#98AFC7"><td><b>Transferred Date</b></td><td><?php echo date("d, M Y",strtotime($transro[3])); ?></td></tr>
<?php  } ?>
<tr><td><b>Entered By</b></td><td><?php echo $sr[0];  ?></td></tr>
<tr><th colspan="2">Paid Details</th></tr>
<tr><td><b>Paid Date</b></td><td><?php if(mysqli_num_rows($qr)>0){ if($ro[2]!='0000-00-00'){echo date('d, M Y',strtotime($ro[2]));} }  ?></td></tr>
<tr><td><b>Remarks</b></td><td><?php echo nl2br($ro[3]);  ?></td></tr>
<tr><td><b>Amount</b></td><td><?php echo $ro[1];  ?></td></tr>
<tr><td><b>Updated By</b></td><td><?php echo $ro[5];  ?></td></tr>
<tr><td><b>Inv No</b></td><td><?php echo $send_bill['inv_no'];  ?></td></tr>
<tr><td><b>Invoicing Done By</b></td><td><?php echo $send_bill['createdby'];  ?></td></tr>
<!--<tr><td colspan="2"><?php //echo $row[8];
if($sr[1]=='7' && $_SESSION['designation']=='8' && $row[8]!='231')
{
$oldreq=mysqli_query($con,"select * from oldebreq where reqid='".$row[5]."'");
if(mysqli_num_rows($oldreq)==0){
//$old=mysqli_fetch_row($oldreq);
?>
<input type="button" onclick="showdiv('<?php echo $row[5]; ?>')" id="ini<?php echo $row[5]; ?>" value="Initiate Fund">
<div id="initiate<?php echo $row[5]; ?>" class="ini" style='display:none;'>
Amount: <input type="text" name="amt<?php echo $row[5]; ?>" id="amt<?php echo $row[5]; ?>" value="<?php echo $row[4]; ?>"><br>
Remark: <input type="text" name="rem<?php echo $row[5]; ?>" id="rem<?php echo $row[5]; ?>">
<input type="button" value="Initialise" onclick="inifund('<?php echo $row[5]; ?>');">&nbsp;&nbsp;<input type="button" name="canc<?php echo $row[5]; ?>" id="canc<?php echo $row[5]; ?>"  onclick="showdiv('<?php echo $row[5]; ?>')" value="cancel">
</div>
<?php
}
else
echo "<td>Initiated</td>";
}
?></td></tr>-->
<tr><td colspan="2"><hr size='3px'></td></tr>
<?php
}
}
else
echo "<tr><td>no Record Found</td></tr>";

?></table>
<?php
} ?>