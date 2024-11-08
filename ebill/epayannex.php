<?php session_start();
if(!$_SESSION['user'])
header('location:index.php');
//echo $_SESSION['user'];
//$desig=$_POST['desig'];
//$service=$_POST['service'];
//$dept=$_POST['dept'];
//$app=$_POST['apps'];
//echo count($app);
include('config.php');

?><html><head><title>Paid Ebill Fund</title>
<script src="excel.js" type="text/javascript"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
</head><body>
<center>
<?php include("menubar.php"); ?>
</center>
<div align="right"><a href="logout.php">Logout</a></div>
<form name="frm1" method="post" action="<?php $_SERVER['PHP-SELF'] ?>">
<?php
$sup=mysqli_query($con,"select * from fundaccounts order by hname ASC");
?>
<select name="sup"><option value="-1">Select Supervisor</option>
<?php
while($supro=mysqli_fetch_array($sup))
{
?>
<option value="<?php echo $supro[0]; ?>" <?php if($_POST['sup']==$supro[0]){ echo "selected"; } ?>><?php echo $supro[1]."/ ".$supro[4]; ?></option>
<?php
}
?>
</select>
From Date:- <input type="text" name="frmdt" id="frmdt" value="<?php if(isset($_POST['frmdt'])){ echo $_POST['frmdt']; }else{ echo date('d/m/Y',strtotime('-2 days'));} ?>" onclick="displayDatePicker('frmdt');" >
To Date:- <input type="text" name="todt" id="todt" value="<?php  if(isset($_POST['todt'])){ echo $_POST['todt']; }else{ echo date('d/m/Y'); } ?>" onclick="displayDatePicker('todt');" >
<input type="submit" value="Search" name="cmdsearch">
</form><button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
<?php //echo $_SESSION['designation']; ?>
<form action='generatePayPDF.php' method='post' >
<center>
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 
<th width="25">Sr NO</th>
<th width="200">Name/Account No.</th>	
<th width="75">Amount</th>
<?php //if($_SESSION['designation']=='7' || $_SESSION['designation']=='2'){ ?>
<th>Bill Paid Amt</th>
<th width="75">Invoice No</th>
<?php // } ?>
<th width="200">Site Address</th>
<th width="75">CUSTOMER NAME</th>
<th width="75">Bank Name</th>
<th width="75">Atm Id</th>
<th width="75">From Date</th>
<th width="75">To Date</th>
<th width="75">Due Date</th>

<th width="75">Supervisor Name</th>
<th width="75">Location</th>
<th width="75">Cheque No</th>
<th width="75">Cheque Date</th>

<?php	
        $total=0;$x=0;
        $str="SELECT * FROM `ebfundtransfers` where reqid in (select req_no from ebillfundrequests ) and pdate>='2014-04-01' and status=0";
if(isset($_POST['sup']) && $_POST['sup']!='-1' && $_POST['sup']!='')
$str.=" and accid='".$_POST['sup']."'";
if(isset($_POST['frmdt']) && isset($_POST['todt']) && $_POST['frmdt']!='' && $_POST['todt']!='')
$str.=" and pdate>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND pdate<=STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y') ";
else
$str.=" and pdate>='".date('Y-m-d',strtotime('-2 days'))."' AND pdate<='".date('Y-m-d')."' ";

$str.="  order by pdate DESC,chqno ASC";
//echo $str;
        $tablex=mysqli_query($con,$str);
        if(mysqli_num_rows($tablex)>0){
	while($app=mysqli_fetch_row($tablex)){
	//echo $app[$x];
	$sql="Select * from ebillfundrequests where req_no='".$app[1]."'";
		
        $table=mysqli_query($con,$sql);    
        $row=mysqli_fetch_array($table);
$qry1=mysqli_query($con,"select bank,atmsite_address,location from ".$row[12]."_sites where trackerid='".$row[14]."'");
$qrrow=mysqli_fetch_array($qry1);

//$branch=mysqli_query($con,"select username from login where srno='".$row[13]."'");
//$brro=mysqli_fetch_row($branch);
//$deptde=mysqli_query($con,"select `desc` from department where deptid='2'");
//$dtro=mysqli_fetch_row($deptde);
//$crow=mysqli_fetch_row($qry1);	
$accs=mysqli_query($con,"select * from fundaccounts where aid='".$app[2]."'");
$rx=mysqli_fetch_row($accs);


?><div class=article>
<div class=title><tr>
<td width="25"><?php echo ++$x; ?></td>
<td width="200">
<?php echo $rx[1]."/".$rx[2]; ?>
</td>
<td width="75" align='CENTER'><?php echo $row[16]; $total=$total+$row[16]; ?></td>
<?php //if($_SESSION['designation']=='7' || $_SESSION['designation']=='2'){ 
$ebp=mysqli_query($con,"select paid_amount from ebpayment where Bill_No='".$app[1]."'");
$ebr=mysqli_fetch_row($ebp);

$inv=mysqli_query($con,"select s.send_id from send_bill s,send_bill_detail d where s.status='0' and s.send_id=d.send_id and d.status=0 and d.reqid='".$app[1]."'");
$invro=mysqli_fetch_row($inv);

$cust_name_qry = mysqli_query($con,"SELECT contact_first FROM contacts where short_name ='".$row[12]."'");
$cust_name_row=mysqli_fetch_array($cust_name_qry);
?>
<td width="75"><?php 
if(mysqli_num_rows($inv)==0)
{
$club=mysqli_query($con,"select * from ebillfundcancinv where reqid='".$app[1]."' and status=0");
if(mysqli_num_rows($club)>0)
echo "Clubed with next Bill";
}
echo $ebr[0]; ?></td>
<td width="75"><?php echo $invro[0]; ?></td>
<?php
//}  ?>
<td width="200"><?php echo $qrrow[1]; ?></td>
<td width="75"><?php echo $cust_name_row[0]; ?></td>
<td width="75"><?php echo $qrrow[0]; ?></td>
<td width="75"><?php echo $row[1]; ?></td>
<td width="75"><?php echo date('d/m/Y',strtotime($row['start_date'])); ?></td>
<td width="75"><?php echo date('d/m/Y',strtotime($row['end_date'])); ?></td>
<td width="75"><?php echo date('d/m/Y',strtotime($row['due_date'])); ?></td>

<td width="75"><?php echo $row[8]; ?></td>
<td width="75"><?php echo $qrrow[2]; ?></td>
<td width="75"><?php echo $row[17]; ?></td>
<td width="75"><?php echo date('d/m/Y',strtotime($app[3])); ?></td>
</tr></div></div>
<?php
}
?>
<tr><td colspan=2 align='right' >TOTAL AMOUNT</td><td align='CENTER' ><?php echo $total; ?></td><td colspan=9 align='right' >&nbsp;</td></tr>
<?php

}
?>
<!--<tr><td colspan=10 align='CENTER' ><input type="submit" name="GENERATE" id="GENERATE" value="GENERATE PDF" /></td></tr>-->
</table></center></form>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script></body></html>