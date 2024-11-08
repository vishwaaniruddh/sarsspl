<?php

include("access.php");
include('config.php');


$ctid=$_POST['ctsalid'];
$ctpay=$_POST['ctpay'];
$paymm=$_POST['paymm'];
$typ=$_POST['typ'];
$mnth=$_POST['mnth'];
$yr=$_POST['yr']; 


$ctsalid=explode(',',$ctid);
$ctpayment=explode(',',$ctpay);
$ctmain=explode(',',$paymm);

$cntt=count($ctsalid);
//echo $cntt;



?>
<html>
<head>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>

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

function subfunc()
{

var paytyps=document.getElementById('paytyps').value;
var chqname=document.getElementById('chqname').value;
var chqno=document.getElementById('chqno').value;
var tdt=document.getElementById('tdt').value;
var dbtacc=document.getElementById('dbtacc').value;
var mbody=document.getElementById('mbody').value;
var mby=document.getElementById('mby').value;
var ctyp='<?php echo $typ; ?>';
var mnth='<?php echo $mnth; ?>';
var yr='<?php echo $yr; ?>';


var ctsalid=[];
		var fields = document.getElementsByName("ctsid[]");
		for(var i = 0; i < fields.length; i++) 
                   {
			ctsalid.push(fields[i].value);
			}


var paymsel=[];
		var fields1= document.getElementsByName("amt[]");
		for(var i = 0; i < fields1.length; i++) 
                   {
			paymsel.push(fields1[i].value);
	       }

if(Validate())
{

var conf=confirm('Do you really want to Approve?');
    

if(conf==true)
{

$.ajax({
   type:'POST',    
url:'process_salary_final.php',
data:{paymsel:paymsel,paytyps:paytyps,chqname:chqname,chqno:chqno,tdt:tdt,dbtacc:dbtacc,mbody:mbody,mby:mby,ctsalid:ctsalid,ctyp:ctyp,mnth:mnth,yr:yr},
success: function(msg){
//alert(msg);
if(msg=='Error')
{
alert(msg);
window.open('salary_fr.php?typf='+typ+'&mnf='+mnth+'&yf='+yr,'_self');
}
 else
{
window.open('salary_genpdf.php?tid='+msg,'_self');

}
         }
     });
}
}
}

</script>
</head>
<body>
<form  method='post' onsubmit="return Validate(this)" >
<center>
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 
<th width="25">Sr NO</th>
<th width="200">Account Name</th>	
<th width="200">Account No</th>	
<th width="200">IFSC</th>	
<th width="200">Bank Name</th>	
<th width="75">Amount</th>
<th width="75">Type</th>

<?php	
        $total=0;
        $stt=="0";
$c=1;
$sttmain='0';
	for($x=0;$x<$cntt;$x++)
       {
	//echo $app[$x];
	$qry1=mysqli_query($con,"select * from ct_salaryimport where id='".$ctsalid[$x]."'");
       $qrrow1=mysqli_fetch_array($qry1);

//echo "select * from ct_salaryimport where id='".$ctsalid[$x]."'"."<br>";
       $svdet=mysqli_query($con,"select * from salary_acc where id='".$qrrow1[1]."'");
       $svdrow=mysqli_fetch_array($svdet);
       //echo "select *salary_acc where id='".$qrrow1[1]."'";

?>
<tr>
<td><?php echo $c;?></td>
<td style="display:none;"><input type="text" name="ctsid[]" id="ctsid<?php echo $c?>" value="<?php echo $ctsalid[$x];?>" readonly></td>
<td><?php echo $svdrow[1];?></td>
<td><?php echo $svdrow[2];?></td>
<td><?php echo $svdrow[3];?></td>
<td><?php echo $svdrow[4];?></td>
<td style="display:none;"><input type="amt" name="amtmain[]" id="amtmain<?php echo $c?>" value="<?php echo round($ctmain[$x]); $sttmain=$sttmain+$ctmain[$x];?>" readonly></td>
<td><input type="amt" name="amt[]" id="amt<?php echo $c?>" value="<?php echo round($ctpayment[$x]); $stt=$stt+$ctpayment[$x];?>" readonly></td>
<td><?php echo $typ;?></td>

<tr>

<?php
$c++;
 } ?>
<tr><td colspan=5 align='right' >TOTAL AMOUNT</td><td align='CENTER' ><?php echo round($stt); ?></td></tr>



<tr><td colspan=2 align='right' >Payment Type</td><td colspan=5 align='left' ><select name="paytyps" id="paytyps">
<option value="">Select </option>
<option value="Cash">Cash</option>
<option value="Cheque">Cheque</option>

</select>
</td>
</tr>


<tr><td colspan=2 align='right' >Name </td><td colspan=5 align='left' ><input type="text" name="chqname" id="chqname" size="60"/></td></tr>

<tr><td colspan=2 align='right' >CHEQUE NUMBER </td><td colspan=5 align='left' ><input type="text" name="chqno" id="chqno" size="40"/></td></tr>
<tr><td colspan=2 align='right' >CHEQUE Date(dd/mm/yyyy)</td><td colspan=5 align='left' ><input type="text" name="tdt" id="tdt" size="40" onclick="displayDatePicker('tdt');" readonly="readonly"/></td></tr>

<tr><td colspan=2 align='right' >Debit Acc/no </td><td colspan=5 align='left' ><select name="dbtacc" id="dbtacc">
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


<tr><td colspan=2 align='right' >Email Body </td><td colspan=5 align='left' ><input type="text" name="mbody" id="mbody" /></td></tr>

<tr><td colspan=2 align='right' >Mail By </td><td colspan=5 align='left' ><input type="text" name="mby" id="mby" /></td></tr>



<tr><td colspan=6 align='CENTER' ><input type="button" name="GENERATE" id="GENERATE" value="GENERATE PDF" onclick="subfunc();"/></td></tr>
</table></center></form>
</table>
</form>
</body>
</html>
