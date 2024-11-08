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
<form action='generatePayrnmPDF.php' method='post' onsubmit="return Validate(this)" >
<center>
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 
<th width="25">Sr NO</th>
<th width="200">Account Name/Account No./Bank Name</th>	
<th width="75">Amount</th>
<th width="200">Site Address</th>
<th width="75">CUSTOMER NAME</th>
<th width="75">Bank Name</th>
<th width="75">Atm Id</th>
<th width="75">Mail By</th>
<th width="75">Supervisor Name</th>
<th width="75">Location</th>
<?php	
        $total=0;
	for($x=0;$x<count($app);$x++){
	//echo $app[$x];
	$sql="Select * from quotation where quotid='".$app[$x]."'";
		
        $table=mysqli_query($con,$sql);    
        $row=mysqli_fetch_row($table);
        if($row[18]=='rnmsites')
$str="select atmsite_address,bank,atm_id1,csslocalbranch from rnmsites where id='".$row[4]."'";
else
$str="select atmsite_address,bank,atm_id1,csslocalbranch from ".$row[3]."_sites where trackerid='".$row[4]."'";
$qry1=mysqli_query($con,$str);
$qrrow=mysqli_fetch_array($qry1);

$branch=mysqli_query($con,"select username from login where srno='".$row[13]."'");
$brro=mysqli_fetch_row($branch);
//$deptde=mysqli_query($con,"select `desc` from department where deptid='2'");
//$dtro=mysqli_fetch_row($deptde);
//$crow=mysqli_fetch_row($qry1);	
$accs=mysqli_query($con,"select * from rnmfundaccounts where status=0");
?><div class=article>
<div class=title><tr>
<td width="25"><?php echo $x+1; ?></td>
<td width="200"><?php //echo $row[19]; ?><select name='accname[]' ><option value="-1">Exclude from Here</option>
<?php while($accr=mysqli_fetch_array($accs)){ ?>
<option value="<?php echo $accr[0]; ?>" <?php if(strcasecmp($row[19],$accr[1])==0)echo "selected"; ?> ><?php echo $accr[5]." / ".$accr[2]." / ".$accr[3]; ?></option>
<?php } ?></select>
<input type='hidden' name='reqs[]' value='<?php echo $app[$x]; ?>' />
</td>
<td width="75" align='CENTER'><?php echo $row[16]; $total=$total+$row[16]; ?></td>
<td width="200"><?php echo $qrrow[0]; ?></td>
<td width="75"><?php echo $row[3]; ?></td>
<td width="75"><?php echo $qrrow[1]; ?></td>
<td width="75"><?php echo $qrrow[2]; ?></td>
<td width="75"><?php echo $row[15]; ?></td>
<td width="75"><?php echo $row[19]; ?></td>
<td width="75"><?php echo $qrrow[3]; ?></td>
</tr></div></div>
<?php
}
?>
<tr><td colspan=2 align='right' >TOTAL AMOUNT</td><td align='CENTER' ><?php echo $total; ?></td><td colspan=7 align='right' >&nbsp;</td></tr>

<tr><td colspan=4 align='right' >CHEQUE IN FAVOUR OF </td><td colspan=6 align='CENTER' ><input type="text" name="chqname" id="chqname" size="60"/></td></tr>
<tr><td colspan=4 align='right' >Debit Acc/no </td><td colspan=6 align='CENTER' ><select name="dbtacc" id="dbtacc">
<option value="">Select Dedit Acc/no</option>
<option value="074005000336">074005000336</option>
<option value="074005000588">074005000588</option>
<option value="074005000745">074005000745</option>
<option value="074051000006">074051000006</option>
</select></td></tr>
<tr><td colspan=4 align='right' >CHEQUE NUMBER </td><td colspan=6 align='CENTER' ><input type="text" name="chqno" id="chqno" size="40"/></td></tr>
<tr><td colspan=10 align='CENTER' ><input type="submit" name="GENERATE" id="GENERATE" value="GENERATE PDF" /></td></tr>
</table></center></form>
<?php
}
?>