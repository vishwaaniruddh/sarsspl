<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry Session Expired'); window.location='index.php';</script>";
}
else
{
include("config.php");
$aid=$_GET['aid'];
$hname=$_GET['hname'];
//echo "select debit,credit from fundaccounts where aid='".$aid."'";
$outstand=mysqli_query($con,"select debit,credit from fundaccounts where aid='".$aid."'");
$outstandro=mysqli_fetch_row($outstand);
?>
<center>
<table><tr><td valign="top">
<h2>Payment Mode: Cheque  <br>Service: Ebill    </h2>
<table border=1><tr><th>Sr No</th><th>Type</th><th>Docket Number</th><th>Client</th><th>Atm ID</th><th>CSS Local Branch</th><th>Bill Date</th><th>Paid Date</th><th>Transferred Amount</th><th>Paid Amount</th></tr>

<td colspan="8">Opening Balance</td>
<td align="right"><?php echo number_format($outstandro[0],2); ?></td>
<td align="right"><?php echo number_format($outstandro[1],2); ?></td>
</tr>
<?php
$srno=0;
$trans2=$outstandro[0];
$pmt2=$outstandro[1];
$cnt=0;
$year=array();
$pmt=$outstandro[1];
$trans=$outstandro[0];
if($outstandro[0]>0)
 $tot1=$outstandro[0];
else
 $tot1=$outstandro[1];;
$str="SELECT p.Paid_Amount,p.Bill_no,p.Paid_Date,'Payment',r.atmid,r.bill_date,r.cust_id,r.trackerid FROM `ebpayment` p,ebillfundrequests r where p.Paid_Date!='0000-00-00' and p.Bill_No=r.req_no and r.supervisor='".$hname."' union All select f.approvedamt,f.req_no,t.pdate,'Transferred',f.atmid,f.bill_date,f.cust_id,f.trackerid from ebillfundrequests f,ebfundtransfers t where f.req_no=t.reqid and f.supervisor='".$hname."' and f.chqno not like 'online%' order by Paid_Date ASC";
//echo $str;
$qry=mysqli_query($con,$str);
if(!$qry)
echo mysqli_error();
while($row=mysqli_fetch_array($qry))
{

$site=mysqli_query($con,"select atmsite_address from ".$row[6]."_sites where trackerid='".$row[7]."'");
$sitero=mysqli_fetch_row($site);
if($row[3]=="Transferred")
$trans2=$trans2+$row[0];
if($row[3]=="Payment")
$pmt2=$pmt2+$row[0];
$srno=$srno+1;
if($row[2]<'2014-04-01')
{
if($outstandro[0]>0){


if($row[3]=='Transferred')
{
$trans=$trans+$row[0];
$tot1=$tot1+$row[0];
}
if($row[3]=='Payment')
{
$pmt=$pmt+$row[0];
$tot1=$tot1-$row[0];
}
}
else
{
if($row[3]=='Transferred')
{
$trans=$trans+$row[0];
$tot1=$tot1-$row[0];
}
if($row[3]=='Payment')
{
$pmt=$pmt+$row[0];
$tot1=$tot1+$row[0];
}
}
}
if($row[2]>'2014-03-31' && $cnt==0)
{
$balance=$tot1;
$balance2=$tot2+$balance; ?>
<tr><td colspan="8">Total</td>
<td align="right"><?php echo number_format($trans,2); ?></td>
<td align="right"><?php echo number_format($pmt,2); ?></td></tr>
<tr><td colspan="8">Balance Carried Forward (Closing Balance)</td>

<td align="right"><?php if(($trans-$pmt)<0){ echo number_format(abs($trans-$pmt),2); } ?></td>
<td align="right"><?php if(($trans-$pmt)>0){ echo number_format(abs($trans-$pmt),2); } ?></td></tr>
<tr><td colspan="7">Opening Balance</td>
<td align="right"><?php if(($trans-$pmt)>0){ echo number_format(abs($trans-$pmt),2); } ?></td></td>
<td align="right"><?php if(($trans-$pmt)<0){ echo number_format(abs($trans-$pmt),2); } ?></td></tr>
<?php
$cnt=1;
}
?>
<tr>
<td><?php echo $srno; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[1]; ?></td>
<td><?php echo $row[6]; ?></td>
<td><?php echo $row[4]; ?></td><td><?php echo $sitero[0]; ?></td><td><?php if($row[5]!='0000-00-00' && date('Y',strtotime($row[5]))!='1970'){ echo date('d/m/Y',strtotime($row[5])); } ?></td>
<td><?php if($row[2]!='0000-00-00' && date('Y',strtotime($row[2]))!='1970'){ echo date('d/m/Y',strtotime($row[2])); }else{ echo "&nbsp;"; } ?></td><td align="right"><?php if($row[3]=='Transferred'){ echo $row[0]; }else{ echo "&nbsp";} ?></td>
<td align="right"><?php if($row[3]=='Payment'){ echo $row[0]; }else{ echo "&nbsp";} ?></td>
</tr>
<?php
}
?>
<tr><td colspan=8>Total</td><td align="right"><?php echo number_format($trans2,2); $transferredamt=$trans2; ?></td><td align="right"><?php echo number_format($pmt2,2); ?></td></tr>
</table></td><td valign="top">
<h2>Payment Mode : Onaccount Transfer <br>Service: Ebill  </h2>
<table border=1><tr><th>Sr No</th><th>Transferred Date</th><th>Transferred Amount</th></tr>
<?php
$tot=0;
$onacc=mysqli_query($con,"select approvedamt,transdt from onacctransfer where aid='".$aid."' and reqstatus='8'");
while($accro=mysqli_fetch_array($onacc))
{

$tot=$tot+$accro[0];
$srno=$srno+1;
?>
<tr><td><?php echo $srno; ?></td><td><?php echo date('d/m/Y',strtotime($accro[1])); ?></td><td align="right"><?php echo number_format($accro[0],2); ?></td></tr>
<?php
}
?>
<tr><td colspan=2>Total</td><td align="right"><?php echo number_format($tot,2); $trans2=$trans2+$tot; ?></td></tr></table>

<h1>Outstanding : <?php echo number_format($trans2-$pmt2,2); ?></h1>
</td></tr></table>
<table width="600">
<tr><th align="right">Total Amount transferred through Cheque :</th><td align="left"><?php echo number_format($transferredamt,2); ?></td></tr>
<tr><th align="right">Total Amount transferred Onaccount :</th><td align="left"><?php echo number_format($tot,2); ?></td></tr>
<tr><th align="right">Total Bill Paid :</th><td align="left"><?php echo number_format($pmt2,2); ?></td></tr>
<tr><th align="right">Total Balance Amt :</th><td align="left"><?php echo number_format($trans2-$pmt2,2); ?> /-</td></tr>
</table>
</center>
<?php
}
?>