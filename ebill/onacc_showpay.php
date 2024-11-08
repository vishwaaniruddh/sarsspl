<?php session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{
//echo $_SESSION['user'];
$desig=$_POST['desig'];
$service=$_POST['service'];
$dept=$_POST['dept'];
$app=$_POST['apps'];
//echo count($app);
include('config.php');
?>
<script type="text/javascript">
function Validate(form)
{
with(form)
{
if(chqname=='')
{
alert("Please provide Chq name");
chqname.focus();
return false;
}
if(chqno=='')
{
alert("Please provide Chq number");
chqno.focus();
return false;
}
}
return true;
}
</script>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<form action='onacc_generatePayPDF.php' method='post' onsubmit="return Validate(this)">
<center>
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 
<tr>
<th width="75">Sr NO</th>
<th width="75">SuperVisor</th>
<th width="75">Account Number</th>
<th width="75">Bank</th>
<th width="75px">Branch</th>
<th width="75">Request Date</th>
<th width="75">Amount</th>
</tr>
<?php	
	
    $total=0;
	for($x=0;$x<count($app);$x++){
		$table=mysqli_query($con,"Select * from onacctransfer where reqid='".$app[$x]."'");
		$row= mysqli_fetch_array($table);
		$qry1=mysqli_query($con,"select hname,accno,bank,branch from fundaccounts where aid='".$row[1]."'");
		$qrrow=mysqli_fetch_array($qry1);
?>
<tr>
<td width="75" align="center"><?php echo $x+1; ?></td>
<td width="75"><?php echo $qrrow[0]; ?></td>
<td width="75"><?php echo $qrrow[1]; ?></td>
<td width="75"><?php if($_POST['pstat']=='8'){ echo $qrrow[7]; }else{  echo $qrrow[2]; } ?></td>
<td width="75"><?php echo $qrrow[3]; ?></td>
<td width="75"><?php echo date('d/m/Y',strtotime($row[6])); ?></td>
<td width="75" align='right'>
	<?php echo $row[7]; $total+=$row[7]; ?>
    <input type="hidden" name="reqid[]" value="<?php echo $app[$x]; ?>"/>
</td>
</tr>
<?php
	}
?>
<tr><td colspan=6 align='right' ><b>TOTAL AMOUNT</b></td><td align='right' ><?php echo $total; ?></td></tr>

<tr><td colspan=3 align='right' >CHEQUE IN FAVOUR OF </td><td colspan=4 align='CENTER' ><input type="text" name="chqname" id="chqname" size="60"/></td></tr>
<tr><td colspan=3 align='right' >Debit Acc/no </td><td colspan=4 align='CENTER' ><select name="dbtacc" id="dbtacc">
<option value="">Select Dedit Acc/no</option>
<option value="074005000336">074005000336</option>
<option value="074005000588">074005000588</option>
<option value="074005000745">074005000745</option>
<option value="074051000006">074051000006</option>
</select></td></tr>
<tr><td colspan=3 align='right' >CHEQUE NUMBER </td><td colspan=4 align='CENTER' >
<input type="text" name="chqno" required id="chqno" size="60"/></td></tr>
<tr><td colspan=3 align='right' >Paid Date(dd/mm/yyyy) </td><td colspan=4 align='CENTER' ><input type="text" name="pdate" id="pdate" size="60" value="<?php echo date('d/m/Y'); ?>" onclick="displayDatePicker('pdate');" readonly/></td></tr>
<tr><td colspan=3 align='right' >Remarks </td><td colspan=4 align='CENTER' >
<input type="text" name="remarks" id="remarks" size="60"/></td></tr>

<tr><td colspan=3 align='right' >Email Body</td><td colspan=4 align='CENTER' >
<input type="text" name="mbdy" id="mbdy" size="60"/></td></tr>

<tr><td colspan=3 align='right' >Mail By</td><td colspan=4 align='CENTER' >
<input type="text" name="mby" id="mby" size="60"/></td></tr>

<tr><td colspan=7 align='CENTER' ><input type="submit" name="submit" id="submit" value="Submit" /></td></tr>
</table></center></form>
<?php
}
?>