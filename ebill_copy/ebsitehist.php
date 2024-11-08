<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "Sorry your session has Expired. Please Login and try again to view History of this Atm";
}
else{
?>
<style>
table {
    border-collapse: collapse;
}

td {
    position: relative;
    padding: 5px 10px;
}

tr.strikeout td:before {
    content: " ";
    position: absolute;
    top: 50%;
    left: 0;
    border-bottom: 1px solid #111;
    width: 100%;
    background-colr:red;
}
</style>
<?php
include("config.php");
 $trackid=$_GET['trackid'];
 $atm=$_GET['atmid'];
 $custid=$_GET['custid'];
//echo "select bill_date,start_date,end_date,due_date,amount,req_no,approvedamt,supervisor,reqby,billfrom,reqstatus from ebillfundrequests where (atmid='".$atm."' or trackerid='".$trackid."') and cust_id='".$custid."'  and req_no not in (select alert_id from ebfundtranscanc where status=0) order by due_date DESC";
$qry=mysqli_query($con,"select bill_date,start_date,end_date,due_date,amount,req_no,approvedamt,supervisor,reqby,billfrom,reqstatus from ebillfundrequests where (atmid='".$atm."' or trackerid='".$trackid."') and cust_id='".$custid."'  and req_no not in (select alert_id from ebfundtranscanc where status=0) order by due_date DESC");
//echo $qry;
?>
<table border="1">
<?php
if(mysqli_num_rows($qry)>0)
{
?>
<tr><th><b>Request ID</b></th><th>Request Status</th><th><b>Start date</b><th><b>Bill From</b></th><th><b>End Date</b></th><th><b>Bill Date</b></th><th><b>Due Date</b></th><th><b>Supervisor</b></th><th><b>Requested Amount</b></th><th><b>Transferred Amount</b></th><th><b>Transferred Date</b></th><th><b>Last Remark BY</b></th><th><b>Paid Date</b></th><th><b>Remarks</b></th><th><b>Amount</b></th><th><b>Updated By</b></th><th><b>Updated time</b></th><th><b>Inv No</b></th></tr>
<?php
while($row=mysqli_fetch_array($qry)){
//echo "select * from ebpayment where Bill_no='".$row[5]."'";
$qr=mysqli_query($con,"select * from ebpayment where Bill_no='".$row[5]."'");
$ro=mysqli_fetch_row($qr);
//echo "select t.pdate,t.accid,a.hname from ebfundtransfers t,fundaccounts a where t.reqid='".$row[5]."' and a.aid=t.accid";
$transfer=mysqli_query($con,"select t.pdate,t.accid,a.hname from ebfundtransfers t,fundaccounts a where t.reqid='".$row[5]."' and a.aid=t.accid");
$transro=mysqli_fetch_row($transfer);

$srno=mysqli_query($con,"select username from login where srno='".$row[8]."'");
$sr=mysqli_fetch_row($srno);
$inv=mysqli_query($con,"select send_id from send_bill_detail where reqid='".$row[5]."' and status=0 and send_id in (select send_id from send_bill where status=0)");
$invro=mysqli_fetch_row($inv);
$send_id_qry=mysqli_query($con,"select * from send_bill where send_id='".$invro[0]."'");
$send_id_row=mysqli_fetch_array($send_id_qry);
$canc=mysqli_query($con,"select * from ebillfundcancinv where reqid='".$row[5]."'");
?>

<tr <?php if($row[10]=='0'){ echo  "class='strikeout' style='background:red; color:white'";} ?> >

<td><?php   echo $row[5];  ?></td>
<td><?php  if($row[10]=='0'){ echo  "Cancelled";}elseif($row[10]=='8'){ echo "Paid"; }else{ echo "IN Process"; }  ?></td>
<td><?php if($row[1]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[1])); }else{echo "NA"; } ?></td>
<td><?php if($row[9]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[9])); }else{echo "NA"; } ?></td>
<td><?php   if($row[2]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[2])); }else{echo "NA"; }  ?></td>
<td><?php if($row[0]!='0000-00-00'){echo date('d/m/Y',strtotime($row[0])); }else{echo "NA"; }  ?></td>
<td><?php if($row[3]!='0000-00-00'){echo date('d/m/Y',strtotime($row[3]));}else{echo "NA"; }  ?></td>
<td><?php if(mysqli_num_rows($transfer)>0){ echo $transro[2]; }else { if($row[7]!='-1'){ echo $row[7]; }else{echo "NA"; } }  ?></td>
<td><?php echo $row[4];  ?></td>
<td><?php echo $row[6]; ?></td>

<td><?php  if($transro[0]!=''){echo date("d/m/Y",strtotime($transro[0]));}else{ echo "NA"; } ?></td>

<td><?php echo $sr[0];  ?></td>
<td><?php if($ro[2]!=''){ echo date('d/m/Y',strtotime($ro[2]));}else{ if(mysqli_num_rows($canc)>0){ echo "Clubbed"; }else{ echo "NA"; }}  ?></td>
<td><?php echo nl2br($ro[3]);  ?></td>
<td><?php echo $ro[1];  ?></td>
<td><?php echo $ro[5];  ?></td>
<td><?php if(mysqli_num_rows($qr)>0){ echo date('d/m/Y H:i:s',strtotime($ro[4])); } ?></td>
<td><?php echo $send_id_row['inv_no'];  ?></td>

</tr>
<?php
}
}
else
echo "<th>no Record Found</td></tr>";

?></table>
<?php
}
?>