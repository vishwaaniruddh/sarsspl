<?php
session_start();
if(!isset($_SESSION['user']))
{
header('location:index.php');
}
else{
include('config.php');
?>
<html>
<head>
<script src="excel.js" type="text/javascript"></script>
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
</head>
<body>
<center>
<form name="frm" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
<select name="cust" id="cust">
<?php
$cust=mysqli_query($con,"select short_name,contact_first from contacts where type='c' and short_name in(select distinct(cust_id) from mastersites) order by contact_first ASC");
while($custro=mysqli_fetch_row($cust))
{
?>
<option value="<?php echo $custro[0]; ?>" <?php if($custro[0]==$_POST['cust']){ echo "selected"; } ?>><?php echo $custro[1]; ?></option>
<?php
}
?></select>
<input type="text" name="sdate" id="sdate" placeholder="From date" value="<?php if(isset($_REQUEST['sdate'])){ echo $_REQUEST['sdate']; }?>" onClick="displayDatePicker('sdate');"  />
<input type="text" name="edate" id="edate" placeholder="To date" value="<?php if(isset($_REQUEST['edate'])){ echo $_REQUEST['edate']; }?>" onClick="displayDatePicker('edate');"  />  
<input type="submit" value="Submit" >
</form>
</center>
<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
<?php
if(isset($_POST['cust']) && $_POST['cust']!='')
$cid=$_POST['cust'];
else
$cid="EUR08";
$q=mysqli_query($con,"select distinct(atmid) from ebillfundrequests where cust_id='".$cid."' and atmid<>'-'  and atmid<>'' order by atmid ASC");
$atm=array();
while($qrro=mysqli_fetch_row($q))
{
$atm[]=trim($qrro[0]);
}

?>
<table border="1" id="custtable">
<tr>
<th>Request ID</th>
<th>Atm ID</th>
<th>Invoice No.</th>
<th>Last Paid Date</th>
<th>Due Date</th>
<th>Start Date</th>
<th>End Date</th>
<th>Paid Amount</th>
<th>Consumer Number</th>
<th>Bill Date</th>
<th>Project Id</th>
<th>Bank</th>

<!--<th>Site Type</th>-->
</tr>
<?php
for($i=0;$i<count($atm);$i++)
{
$qr=mysqli_query($con,"select max(bill_date) from ebillfundrequests where atmid='".$atm[$i]."' and pstat='1'");
$qrro=mysqli_fetch_row($qr);
$dt='';
if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='' && isset($_REQUEST['edate']) && $_REQUEST['edate']!='')
{
	$sdate=date('Y-m-d',strtotime(str_replace("/","-",$_REQUEST['sdate'])));
	$edate=date('Y-m-d',strtotime(str_replace("/","-",$_REQUEST['edate'])));
	if($_REQUEST['sdate']!=$_REQUEST['edate'])
	$dt=" and p.Paid_Date between '".$sdate."' and '".$edate."'";
	else
	$dt=" and p.Paid_Date like '".$sdate."'";
	//$dt=" and DATE(p.entrydt) between '".strtotime(str_replace("/","-",$_REQUEST['sdate']))."' and '".strtotime(str_replace("/","-",$_REQUEST['edate']))."'";
	/*$dt=" and p.entrydt between '".$sdate." 00:00:00' and '".$edate." 23:59:59'";
	else
	$dt=" and p.entrydt like '".$sdate."%'";*/
}
//echo "select p.Paid_Date,p.Paid_Amount,p.Bill_No,f.bill_date,f.due_date,f.req_no,f.cust_id,f.trackerid from ebpayment p,ebillfundrequests f where p.Bill_No=f.req_no and f.atmid = '".$atm[$i]."' and f.bill_date ='".$qrro[0]."'".$dt."<br>";
$duedt=mysqli_query($con,"select p.Paid_Date,p.Paid_Amount,p.Bill_No,f.bill_date,f.due_date,f.req_no,f.cust_id,f.trackerid,f.start_date,f.end_date from ebpayment p,ebillfundrequests f where p.Bill_No=f.req_no and f.atmid = '".$atm[$i]."' and f.bill_date ='".$qrro[0]."'".$dt);
$duedtro=mysqli_fetch_row($duedt);
if($duedtro[0]!=''){
$bill_no_str.=$duedtro[2].",";
//echo $duedtro[2]." ".$duedtro[5]."<br>";
//echo "select bank,site_type from ".$duedtro[6]."_sites where trackerid='".$duedtro[7]."' and bank like 'CORPORATION'";
$site=mysqli_query($con,"select bank,site_type from ".$duedtro[6]."_sites where trackerid='".$duedtro[7]."'");
//if(mysqli_num_rows($site)>0){

$sitero=mysqli_fetch_row($site);
$cust_sites_qry=mysqli_query($con,"SELECT projectid FROM `".$cid."_sites` WHERE trackerid='".$duedtro[7]."'");
$cust_sites=mysqli_fetch_array($cust_sites_qry);
$cons=mysqli_query($con,"select Consumer_No from mastersites where trackerid='".$duedtro[7]."'");
$consro=mysqli_fetch_row($cons);
?>
<tr>
<td><?php echo $duedtro[2]; ?>
<td><?php echo $atm[$i]; ?></td>
<?php
$reqid_qry=mysqli_query($con,"select invoice_no from send_bill where send_id=(SELECT send_id FROM `send_bill_detail` WHERE reqid='".$duedtro[2]."')");
$reqidro=mysqli_fetch_row($reqid_qry);
echo "<td>".$reqidro[0]."</td>";
?>
<td>
<?php
//echo $duedtro[2]."<br>";
if($duedtro[0]!='null')
echo date('d/m/Y',strtotime($duedtro[0]))."";
else
echo "00/00/0000";
//echo "<br>select max(Paid_Date),Paid_Amount,Bill_No from ebpayment where Bill_No in (select req_no from ebillfundrequests where atmid = '".$atm[$i]."')";
?></td>
<td><?php 
if($duedtro[4]!='0000-00-00' && $duedtro[4]!='null' && $duedtro[4]!='')
echo date('d/m/Y',strtotime($duedtro[4]));
else
echo "00/00/0000";
 ?></td>


<!---Show date --->
<td><?php echo date('d/m/y',strtotime($duedtro[8])); ?></td>
<td><?php echo date('d/m/y',strtotime($duedtro[9])); ?></td>

<td><?php echo $duedtro[1]; ?></td>


<td><?php
//echo "select max(Paid_Date),Paid_Amount,Bill_No from ebpayment where Bill_No in (select req_no from ebillfundrequests where atmid = '".$atm[$i]."')<br>";
//echo "select Consumer_No from mastersites where trackerid=(select trackerid from ebillfundrequests where req_no='".$duedtro[2]."')<br>";
 if(mysqli_num_rows($cons)>0){ echo $consro[0]; } ?></td>
 <td>
<?php
//echo "select bill_date from ebillfundrequests where req_no='".$duedtro[2]."'";
if($duedtro[3]!='0000-00-00' && $duedtro[3]!='null' && $duedtro[3]!='')
echo date('d/m/Y',strtotime($duedtro[3]))."";
else
echo "00/00/0000";
?></td>
<td><?php echo $cust_sites[0]; ?></td>
<td><?php echo $sitero[0]; ?></td>


<!--<td><?php echo $sitero[1]; ?></td>-->
</tr>
<?php
//}
}
}
//echo $bill_no_str;

/*for($i=0;$i<count($atm);$i++)
{
//echo "select max(p.Paid_Date),p.Paid_Amount,p.Bill_No,f.bill_date,f.due_date,f.req_no from ebpayment p,ebillfundrequests f where p.Bill_No=f.req_no and f.atmid = '".$atm[$i]."'";
$duedt=mysqli_query($con,"select max(p.Paid_Date),p.Paid_Amount,p.Bill_No,f.bill_date,f.due_date,f.req_no from ebpayment p,ebillfundrequests f where p.Bill_No=f.req_no and f.atmid = '".$atm[$i]."'");

$duedtro=mysqli_fetch_row($duedt);
if($duedtro[0]!=''){
$cons=mysqli_query($con,"select Consumer_No from mastersites where trackerid=(select trackerid from ebillfundrequests where req_no='".$duedtro[2]."')");
$consro=mysqli_fetch_row($cons);

?>
<tr>
<td><?php echo $duedtro[2]; ?>
<td><?php echo $atm[$i]; ?></td><td>
<?php
//echo $duedtro[2]."<br>";
if($duedtro[0]!='null')
echo date('d/m/Y',strtotime($duedtro[0]))."";
else
echo "00/00/0000";
//echo "<br>select max(Paid_Date),Paid_Amount,Bill_No from ebpayment where Bill_No in (select req_no from ebillfundrequests where atmid = '".$atm[$i]."')";
?></td>
<td><?php 
if($duedtro[4]!='0000-00-00' && $duedtro[4]!='null' && $duedtro[4]!='')
echo date('d/m/Y',strtotime($duedtro[4]));
else
echo "00/00/0000";
 ?></td>
<td><?php echo $duedtro[1]; ?></td>
<td><?php
//echo "select max(Paid_Date),Paid_Amount,Bill_No from ebpayment where Bill_No in (select req_no from ebillfundrequests where atmid = '".$atm[$i]."')<br>";
//echo "select Consumer_No from mastersites where trackerid=(select trackerid from ebillfundrequests where req_no='".$duedtro[2]."')<br>";
 if(mysqli_num_rows($cons)>0){ echo $consro[0]; } ?></td>
 <td>
<?php
//echo "select bill_date from ebillfundrequests where req_no='".$duedtro[2]."'";
if($duedtro[3]!='0000-00-00' && $duedtro[3]!='null' && $duedtro[3]!='')
echo date('d/m/Y',strtotime($duedtro[3]))."";
else
echo "00/00/0000";
?></td>
</tr>
<?php
}
}*/
if($cid=='FSS04'){
$q2=mysqli_query($con,"select distinct(`ATM ID`) from `TABLE 349` where cust_id='".$cid."' and `ATM ID`<>'-'  and `ATM ID`<>'' order by `ATM ID` ASC");
$atm2=array();
while($qrro2=mysqli_fetch_row($q2))
{
$atm2[]=trim($qrro2[0]);
}


?>
<tr><td colspan=4>From New Data</td></tr>

<?php
for($i=0;$i<count($atm2);$i++)
{

$duedt2=mysqli_query($con,"select max(`PAID DATE`),AMT,`SR NO`,`CONSUMER NO`,`BILL DATE`,`DUE DATE` from `TABLE 349` where `ATM ID` = '".$atm2[$i]."'");
$duedtro2=mysqli_fetch_row($duedt2);

?>
<tr>
<td><?php echo $duedtro2[2]; ?>
<td><?php echo $atm2[$i]; ?></td><td>
<?php
//echo $duedtro[2]."<br>";

echo $duedtro2[0];

//echo "<br>select max(Paid_Date),Paid_Amount,Bill_No from ebpayment where Bill_No in (select req_no from ebillfundrequests where atmid = '".$atm[$i]."')";
?></td>
<td><?php 

echo $duedtro2[5];

 ?></td>
<td><?php echo $duedtro[1]; ?></td>
<td><?php
//echo "select max(Paid_Date),Paid_Amount,Bill_No from ebpayment where Bill_No in (select req_no from ebillfundrequests where atmid = '".$atm[$i]."')<br>";
//echo "select Consumer_No from mastersites where trackerid=(select trackerid from ebillfundrequests where req_no='".$duedtro[2]."')<br>";
 echo $duedtro2[3]; ?></td>
 <td>
<?php
//echo "select bill_date from ebillfundrequests where req_no='".$duedtro[2]."'";

echo $duedtro2[4];

?></td>
</tr>
<?php
}
}
?>

</table>
<?php  } ?>
</body>