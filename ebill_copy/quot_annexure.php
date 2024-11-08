<?php
include("access.php");

session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{


$cidr=$_GET['cidr'];
$sdater=$_GET['sdater'];
$edater=$_GET['edater'];
$atmr=$_GET['atmr'];
$qidr=$_GET['qidr'];
$bankr=$_GET['bankr'];
$acmr=$_GET['accnamer'];
$billtyp=$_GET['billtyp'];
$refr=$_GET['refr'];



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript">

var tableToExcel = (function() {
//alert("hii");
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
<script type="text/javascript">

function getaccm(cst)
{

$.ajax({
   type: 'POST',    
url:'get_accmanager.php',
data:'cust='+cst,
success: function(msg){

//alert(msg);
document.getElementById('accname').innerHTML=msg;
//getbank(cst);
 
         }
     });



}


function expfunc()
{
$('#frm1').attr('action', 'quotation1_annexexport.php').attr('target','_blank');
$('#frm1').submit();
}
function getbank(cust)
{
alrt(cust);
$.ajax({
   type: 'POST',    
url:'get_quotation1_bank.php',
data:'cust='+cust,
success: function(msg){

alert(msg);
document.getElementById('bank').innerHTML=msg;

 
         }
     });



}

function dattach()
{

var paymsel=[];
		var fields = document.getElementsByName("dnref[]"); //alert("h"+fields.length);
		for(var i = 0; i < fields.length; i++) 
                   {
			paymsel.push(fields[i].value);
			}

//alert(paymsel);
document.getElementById("dnref1").value=paymsel;
$('#frm1').attr('action', 'quotation1_dwallattach.php').attr('target','_blank');
$('#frm1').submit();

}

function Closedattach()
{

var Close=[];
		var fields1 = document.getElementsByName("cls[]"); //alert("h"+fields.length);
		for(var i = 0; i < fields1.length; i++) 
                   {
			Close.push(fields1[i].value);
			}

//alert(Close);
document.getElementById("cls1").value=Close;
$('#frm1').attr('action', 'quotation1_Closedwallattach.php').attr('target','_blank');
$('#frm1').submit();

}
function func(strpg,perpg)
{



var cid=document.getElementById('cid').value;//alert(cid);
	
			
			 var sdate=document.getElementById('sdate').value;//alert(sdate);
			var edate=document.getElementById('edate').value;//alert(edate);
			var atmid=document.getElementById('atmid').value;//alert(atmid);
			var qid=document.getElementById('qid').value;//alert(qid);
			var bank=document.getElementById('bank').value;//alert(qid);
			var accname=document.getElementById('accname').value;//alert(qid);
			var billtyp=document.getElementById('billtyp').value;//alert(qid);


//alert(accname);
if(perpg=="")
{
perp='50';
}
else
{
perp=document.getElementById(perpg).value;
}



var Page="";
if(strpg!="")
{
Page=strpg;
}

$.ajax({
   type: 'POST',    
url:'search_quotationannex.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'cid='+cid+'&sdate='+sdate+'&edate='+edate+"&atmid="+atmid+"&qid="+qid+'&perpg='+perp+'&Page='+Page+'&bank='+bank+'&accname='+accname+'&billtyp='+billtyp,
success: function(msg){

// alert(msg);
  document.getElementById('search').innerHTML=msg;
 
         }
     });





}


function subpfunc()
{
var cid=document.getElementById('cid').value;//alert(cid);
var sdate=document.getElementById('sdate').value;//alert(sdate);
var edate=document.getElementById('edate').value;//alert(edate);
var atmid=document.getElementById('atmid').value;//alert(atmid);
var qid=document.getElementById('qid').value;//alert(qid);
var bank=document.getElementById('bank').value;//alert(qid);
var accname=document.getElementById('accname').value;//alert(qid);
var billtyp=document.getElementById('billtyp').value;//alert(qid);





var qrrarry=[];
$("input:checkbox[name=clbillqid[]]:checked").each(function(){
    qrrarry.push($(this).val());
});

//alert(qrrarry);

if(qrrarry.length=='0')
{
alert('please select a quotation to submit ' );

}
else
{

$.ajax({
   type: 'POST',    
url:'chngqt1topending.php',
data:{qrrarry:qrrarry},
success: function(msg){

alert(msg);
 window.open('quot_annexure.php?cidr='+cid+'&sdater='+sdate+'&edater='+edate+'&atmr='+atmid+'&qidr='+qid+'&bankr='+bank+'&accnamer='+accname+'&billtyp='+billtyp+'&refr=rel','_self');
         }
     });

}
}
</script>
</head>

<body <?php if($refr!=""){ ?> onload="func('','');" <?php } ?> >
<form name="frm1" id="frm1" method="post">
<input type="hidden" name="dnref1" id="dnref1" /> 
<input type="hidden" name="cls1" id="cls1" /> 
<div class="">
<center>
<?php  include("menubar.php"); ?>

<h2 class="h2color">Annexure</h2>

<!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />-->
<table  border="0" cellpadding="0" cellspacing="0">

<tr>
<th>

<?php 
include("config.php");
?>
<th width="75">
<select name="cid" id="cid" onchange="getaccm(this.value);">
<option value="-1">Select</option>



<?php 
$qr=mysqli_query($con,"select short_name,contact_first from contacts");
while($qra=mysqli_fetch_array($qr))
{
?>


<option value="<?php echo $qra[0]; ?>"   <?php if($cidr==$qra[0]){ echo "selected"; } ?>     ><?php echo $qra[1]; ?></option>


<?php 

}
?>

</select>

</th>


<th>

<?php // echo "select srno,username from login where designation='11' and serviceauth='3' and deptid='4' and srno in(select reqby in quotation1) "; ?>
<select id="accname" name="accname" onchange="func();">

<option value="-1">select made by</option>
<?php 

$qrs=mysqli_query($con,"select srno,username from login where designation='8' and serviceauth='2' and deptid='4' ");

while($qrsrow=mysqli_fetch_array($qrs))
{

?>

<option value="<?php echo $qrsrow[0];?>"  <?php if($acmr==$qrsrow[0]){ echo "selected"; } ?>><?php echo $qrsrow[1];?></option>
<?php } 

$qrs2=mysqli_query($con,"select srno,username from login where designation='11' and serviceauth='3' and deptid='4' and srno in(select reqby from quotation1) ");

while($qrsrow2=mysqli_fetch_array($qrs2))
{

?>

<option value="<?php echo $qrsrow2[0];?>" <?php if($acmr==$qrsrow2[0]){ echo "selected"; } ?>><?php echo $qrsrow2[1];?></option>
<?php } ?>




</select>
</th>



<th width="75">
<select name="bank" id="bank">
<option value="" >select bank</option>
<?php 
$bnqr=mysqli_query($con,"select distinct(bank) from quotation1");

while($bnrow=mysqli_fetch_array($bnqr))
{
?>

<option value="<?php echo $bnrow[0];?>" <?php if($bankr==$bnrow[0]){ echo "selected"; } ?>><?php echo $bnrow[0];?></option>



<?php } ?>
</select>
</th>


<th width="75"><input type="text" name="qid" id="qid" placeholder="Quotation Id"    value="<?php if($qidr!=""){echo $qidr;}?>"/></th>
<th width="75"><input type="text" name="atmid" id="atmid" placeholder="AtmID"    value="<?php if($atmr!=""){echo $atmr;}?>"/></th>
<th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');"  placeholder="From Date" value="<?php if($sdater!=""){echo $sdater;}?>"/></th>
<th width="75"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');"  placeholder="To Date"  value="<?php if($edater!=""){echo $edater;}?>"/></th>

<th width="75"><select name="billtyp" id="billtyp">
<option value="n">Pending</option>
<option value="p">Processing</option>
<option value="y">Invoice Done</option>
</th>
<th><input type="button" name="search" onclick="func('','');" value="search" /></td>
</tr>
</table>
</center>


</div>



<center>
<div id="search"></div>

</center>
</form>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php 
}
?>