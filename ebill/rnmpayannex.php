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
$sup=mysqli_query($con,"select * from rnmfundaccounts order by hname ASC");
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


<th width="75">SR. NO.</th>
<th width="75">CUSTOMER</th>
<th width="75">BANK</th>
<th width="75">1st ATM ID</th>
<th width="75">SITE ID</th>
<th width="75">STATE</th>
<th width="75">CITY</th>
<th width="75">LOCATION ADDRESS</th>
<th width="75">Location</th>
<th width="75">NATURE OF WORK</th>
<th width="75">NATURE OF WORK (Material)</th>
<th width="75">FIXED COST / APPROVAL WORK</th>
<th width="75">REQUEST DATE</th>
<th width="75">APPROVAL AMOUNT </th>
<th width="75">REQUIRED WORK AMOUNT </th>
<th width="75">Cheque No.</th>
<th width="75">NAME OF SUPERVISOR</th>
<th width="75">SUPERVISOR A/C NO.</th>
<th width="75">MOBILE NO.</td>
<th width="75">FUND REQUIRMENT STATUS</th>
<th width="75">FUND TRANSFER DATE</th>
<th width="75">MONTH</th>
<th width="75">MAIL FROM</th>
<th width="75">DESCRIPTION</th>
<th width="75">APPROVAL PERSON NAME</th>
<th width="75">APPROVAL DATE </th></tr>
<?php	
        $total=0;$x=0;
        $str="SELECT * FROM `rnmfundtransfers` where reqid in (select quotid from quotation where status<>0) and pdate>='2014-04-01' and status=0";
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
	$sql="Select * from quotation where quotid='".$app[1]."'";
		
        $table=mysqli_query($con,$sql);    
        $row=mysqli_fetch_row($table);
//echo $app[18];
if($row[18]=="sites")
$site="select bank,atmsite_address,location,atm_id1,atm_id2,atm_id3,site_id,state,city,csslocalbranch from ".$row[3]."_sites where trackerid='".$row[4]."'";
if($row[18]=="rnmsites")
$site="select bank,atmsite_address,location,atm_id1,atm_id2,atm_id3,site_id,state,city,csslocalbranch from rnmsites where id='".$row[4]."'";

$cust=mysqli_query($con,"select contact_first from contacts where short_name='".$row[3]."'");
$custro=mysqli_fetch_row($cust);
//echo $site;
$qry1=mysqli_query($con,$site);
$qrrow=mysqli_fetch_array($qry1);

$accs=mysqli_query($con,"select * from rnmfundaccounts where aid='".$app[2]."'");
$rx=mysqli_fetch_row($accs);

$chk=mysqli_query($con,"select chqno from rnmfundtransfers where reqid='".$row[1]."'");
$chkro=mysqli_fetch_row($chk);
?><div class=article>
<div class=title><tr>

<td width="25"><?php echo ++$x; ?></td>
<td width="25"><?php echo $custro[0]; ?></td>
<td width="75"><?php echo $qrrow[0]; ?></td>
<td width="75"><?php echo $qrrow[3]; ?></td>
<td width="75"><?php echo $qrrow[6]; ?></td>
<td width="75"><?php echo $qrrow[7]; ?></td>
<td width="75"><?php echo $qrrow[8]; ?></td>
<td width="200"><?php echo $qrrow[1]; ?></td>
<td width="200"><?php echo $qrrow[9]; ?></td>	

 <td><?php
 $cnn=0;
 $det2=mysqli_query($con,"select distinct(now) from quot_details where quotid='".$app[1]."'  and status='0' order by component,material ASC");
while($detro2=mysqli_fetch_array($det2))
{
if($cnn==0)
echo $detro2[0];
else
echo ", ".$detro2[0];

$cnn=$cnn+1;
}
 ?></td>
	

 <td>
<?php
$stat=0;
$tot=0;
$num=0;
$asst=array();

//echo "select * from quot_details where quotid='".$row[0]."'  and status='0' order by component,material ASC";
$det=mysqli_query($con,"select * from quot_details where quotid='".$app[1]."'  and status='0' order by component,material ASC");
while($detro=mysqli_fetch_array($det))
{
//echo "select * from atmassets where now='".$detro[9]."' and problem='".$detro[7]."' and description='".$detro[2]."' and incquot=1";
$ck=mysqli_query($con,"select * from atmassets where now='".$detro[9]."' and problem='".$detro[7]."' and description='".$detro[2]."' and incquot=1");
if(mysqli_num_rows($ck)>0){
$stat=$stat+1;

  if(in_array($detro[7],$asst)){  $num=$num+1;
 echo $detro[2]." ".$detro[12]."(".$detro[3]." ".$detro[4]." -RS ".$detro[3]*$detro[8].")";
 }else{ 
$num=$num+1;
echo "<b><u>".$detro[7]." :</u></b>".$detro[2]." ".$detro[12]."(".$detro[3]." ".$detro[4]." -RS ".$detro[3]*$detro[8].")";$asst[]=$detro[7]; } 
}
}
?>
</td>
	

 <td width="75"><?php if($row[12]=='R&M'){ echo "Fixed Cost Work"; }else{ echo "Approval Basis Work";} ?></td>
<td width="75"><?php echo date("d/m/Y",strtotime($row[9])); ?></td>
<td width="75"><?php echo $row[8]; ?></td>
<td width="75"><?php echo $row[16];$total=$total+$row[16]; ?></td>
<td width="75"><?php echo $chkro[0]; ?></td>
<td width="75">
<?php echo $rx[1]; ?>
</td>
<td width="75">
<?php echo $rx[2]; ?>
</td>	
<td><?php  ?></td>
	
<td>Transferred</td>
<td width="75"><?php echo date('d/m/Y',strtotime($app[3])); ?></td>
<td width="75"><?php echo date('F',strtotime($app[3])); ?></td>
<td><?php
$srno=mysqli_query($con,"select username from login where srno='".$row[2]."'");
$sr=mysqli_fetch_row($srno);
 echo $sr[0]; ?></td>
<td>
</td>
	

 <td width="75"><?php echo $row[15]; ?></td>
	<td>

<?php if($row[23]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[23])); }else{ echo date('d/m/Y',strtotime($row[9])); } ?></td>
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