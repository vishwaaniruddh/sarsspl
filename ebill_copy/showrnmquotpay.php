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
$app1=$_POST['payarr'];
$app=explode(',',$app1);
//echo count($app);




// var_dump($_POST);

//echo count($app);
include('config.php');
?>
<script type="text/javascript">
function Validate()
{
var dbno=document.getElementById('dbtacc').value;


if(dbno=='')
{
alert("Please select account no");

return false;
}


return true;

}

function detfunc()
{
if(Validate())
{
var dbno=document.getElementById('dbtacc').value;
document.getElementById('dbno').value=dbno;

var mbd=document.getElementById('mbody').value;
document.getElementById('mb').value=mbd;

var mby=document.getElementById('mby').value;
document.getElementById('mailby').value=mby;

return true;
}
return false;
}
</script>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<form action='generatequotrnmPDF.php' method='post' onsubmit="return detfunc();" >
<input type="hidden" name="quotidt" id="quotidt" value="<?php echo $app1;?>" readonly>
<input type="hidden" name="dbno" id="dbno"  readonly>
<input type="hidden" name="mb" id="mb"  readonly>
<input type="hidden" name="mailby" id="mailby"  readonly>
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
	$sql="Select * from quotation1 where id='".$app[$x]."'";
		
// 		echo $sql;  
        $table=mysqli_query($con,$sql);    
        $row=mysqli_fetch_row($table);
        
        // var_dump($row);
        
     /*   if($row[18]=='rnmsites')
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
*/


 $amtqry=mysqli_query($con,"select app_amt from quotation_approve_details where qid='".$app[$x]."'");
	      $rowamt=mysqli_fetch_array($amtqry);
	     // echo round($rowamt[0]);


$qrynm=mysqli_query($con,"select cust_name from  ".$row[2]."_sites where cust_id='".$row[2]."' ");
                  $qname=mysqli_fetch_array($qrynm);

//echo "select location  from  ".$row[2]."_sites where atm_id1='".$row[3]."' ";
$qrynm1=mysqli_query($con,"select location from  ".$row[2]."_sites where atm_id1='".$row[3]."' ");
                  $qname1=mysqli_fetch_array($qrynm1);

$snm=mysqli_query($con,"select hname,accno,aid from  fundaccounts where aid='".$row[17]."' ");
                  $supname=mysqli_fetch_array($snm);

$snmall=mysqli_query($con,"select hname,accno,aid from  fundaccounts where aid='".$row[17]."'");
$accr=mysqli_fetch_array($snmall);
                  //$supall=mysqli_fetch_array($snmall);

 $greamt=mysqli_query($con,"select req_amt from quotation1_req where qid='".$app[$x]."'");
            $reqamtw=mysqli_fetch_array($greamt);
              // echo round($reqamtw[0]); 


?><div class=article>
<div class=title><tr>
<td width="25"><?php echo $x+1; ?></td>
<td width="200">
<select name='accname[]' >
<?php if($row[17]=="" || $row[17]=="-1")
{
?>
<option value="-1">Exclude from Here</option>
<?php
}
else
{
?>

<option value="<?php echo $accr[2]; ?>"  ><?php echo $accr[0]."/".$accr[1]; ?></option>

<?php } ?></select>
<input type='hidden' name='reqs[]' value='<?php echo $app[$x]; ?>' />
</td>
<td width="75" align='CENTER'><?php echo round($reqamtw[0]); $total=$total+round($reqamtw[0]); ?></td>
<td style="display:none;"><input type="hidden" name="aptamt[]" value="<?php echo round($reqamtw[0]);?>" readonly="readonly"/></td>
<td width="200"><?php echo $row[6]; ?></td>
<td width="75"><?php echo $qname[0]; ?></td>
<td width="75"><?php echo $row[4]; ?></td>
<td width="75"><?php echo $row[3]; ?></td>
<td width="75"><?php echo ""; ?></td>
<td width="75"><?php echo  $supname[0]; ?></td>
<td width="75"><?php echo $qname1[0]; ?></td>
</tr></div></div>
<?php
}
?>
<tr><td colspan=2 align='right' >TOTAL AMOUNT</td><td align='CENTER' ><?php echo $total; ?></td><td colspan=7 align='right' >&nbsp;</td></tr>

<tr><td colspan=4 align='right' >Payment Type</td><td colspan=6 align='CENTER' ><select name="paytyps" id="paytyps">
<option value="">Select </option>
<option value="Cash">Cash</option>
<option value="Cheque">Cheque</option>

</select>
</td>
</tr>


<tr><td colspan=4 align='right' >Name </td><td colspan=6 align='CENTER' ><input type="text" name="chqname" id="chqname" size="60"/></td></tr>

<tr><td colspan=4 align='right' >CHEQUE NUMBER </td><td colspan=6 align='CENTER' ><input type="text" name="chqno" id="chqno" size="40"/></td></tr>
<tr><td colspan=4 align='right' >CHEQUE Date(dd/mm/yyyy)</td><td colspan=6 align='CENTER' ><input type="text" name="tdt" id="tdt" size="40" onclick="displayDatePicker('tdt');" readonly="readonly"/></td></tr>

<tr><td colspan=4 align='right' >Debit Acc/no </td><td colspan=6 align='CENTER' ><select name="dbtacc" id="dbtacc">
<option value="">Select Dedit Acc/no</option>
<option value="074005000336">074005000336</option>
<option value="074005000588">074005000588</option>
<option value="074005000745">074005000745</option>
<option value="074051000006">074051000006</option>
<option value="661010200003490">661010200003490</option>
<option value="913020029323536">913020029323536</option>
<option value="01632320002399">01632320002399</option>



</select>


</td></tr>


<tr><td colspan=4 align='right' >Email Body </td><td colspan=6 align='CENTER' ><input type="text" name="mbody" id="mbody" /></td></tr>

<tr><td colspan=4 align='right' >Mail By </td><td colspan=6 align='CENTER' ><input type="text" name="mby" id="mby" /></td></tr>




<tr><td colspan=10 align='CENTER' ><input type="submit" name="GENERATE" id="GENERATE" value="GENERATE PDF" /></td></tr>
</table></center></form>
<?php
}
?>