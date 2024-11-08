<?php
include("access.php");
include("config.php");


if(!$_SESSION['user'])
{
?>
<script type="text/javascript">
alert("Sorry Your session has Expired");
window.location="index.php";
</script>
<?php
}


$custr=$_GET['custr'];
$mnthr=$_GET['mnthr'];
$yrr=$_GET['yrr'];
$sttr=$_GET['sttr'];
$qutr=$_GET['qutr'];
$bnkr=$_GET['bnkr'];

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

<script>





function sfunc(strpg,perpg)
{
//alert("ok");
var cust=document.getElementById('cust').value;
var mnth=document.getElementById('mnth').value;
var yr=document.getElementById('yr').value;
var bnk=document.getElementById('bnk').value;
var state=document.getElementById('state').value;
var quotid=document.getElementById('quotid').value;




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
url:'get_frbilling.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'cust='+cust+'&mnth='+mnth+'&yr='+yr+'&bnk='+bnk+'&Page='+Page+'&state='+state+'&quotid='+quotid+'&perpg='+perp,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;



  
 
         },
            error: function (request, status, error) {
        alert(request.responseText);
    }
     });




}






function validate()
{

var invno=document.getElementById('invno').value;
if(invno=="")
{
alert("Enter invoice Number");
return false;
}
return true;
}





function subfunc()
{

var cust=document.getElementById('cust').value;
var mnth=document.getElementById('mnth').value;
var yr=document.getElementById('yr').value;
var bnk=document.getElementById('bnk').value;
var state=document.getElementById('state').value;
var quotid=document.getElementById('quotid').value;
var invno=document.getElementById('invno').value;

if(validate())
{
   var payd=[];
$("input:checkbox[name=qidsel[]]:checked").each(function(){
    payd.push($(this).val());
});
//alert(payd.length);

$.ajax({
   type: 'POST',    
url:'process_quotbillupdate.php',
data:{qidarrs:payd,invno:invno},
success: function(msg){

alert(msg);
window.open('quotationbillingupdate.php?custr='+cust+'&mnthr='+mnth+'&yrr='+yr+'&sttr='+state+'&qutr='+quotid+'&bnkr='+bnk,'_self');
         },
            error: function (request, status, error) {
        alert(request.responseText);
    }
     });

}

}

</script>
</head>
<body  <?php if($custr!="" || $acmr!="" || $catr!="" || $typr!="" || $atmr!="" || $fr!="" || $er!="" ) {?>onload='func('','');' <?php }?> >
<form id='frm1' method="post" >
<center>
<?php  include("menubar.php"); ?>
<h2 class="h2color"> </h2>


	<br />
<table cellspacing="4" cellpadding="19" border="2" id="tab">

<tr>

<td><select name='cust' id='cust' style='width:115px'>
<option value=''>Select Customer</option>
<?php 
$gcust=mysqli_query($con,"select distinct(cust) from quotation1");

while($custrow=mysqli_fetch_array($gcust))
{
$cstname=mysqli_query($con,"select cust_name from ".$custrow[0]."_sites where cust_id='".$custrow[0]."' ");
$cstrs=mysqli_fetch_array($cstname);
?>
<option value="<?php echo $custrow[0]; ?>" <?php if($custr==$custrow[0]){echo "selected";}?>><?php echo $cstrs[0]; ?></option>
<?php } ?>
</select>
</td>






<td><select name='mnth' id='mnth' style='width:115px'>
<option value=''>Select Month</option>
<?php 
$gmnth=mysqli_query($con,"select distinct(month) from quotation1");

while($gmnthrow=mysqli_fetch_array($gmnth))
{
?>
<option value="<?php echo $gmnthrow[0]; ?>" <?php if($mnthr==$gmnthrow[0]){echo "selected";}?>><?php echo $gmnthrow[0]; ?></option>
<?php } ?>
</select>
</td>


<td>
<select name='yr' id='yr' style='width:100px'>
<option value=''>Select Year</option>
<?php $gyr=mysqli_query($con,"select distinct(year) from quotation1");

while($yrrow=mysqli_fetch_array($gyr))
{
?>
<option value='<?php echo $yrrow[0]; ?>' <?php if($yrr==$yrrow[0]){echo "selected";}?>><?php echo $yrrow[0]; ?></option>
<?php } ?>
</select>
</td>
<td>

<select name='bnk' id='bnk' style='width:215px'>

<option value=''>Select Bank</option>
<?php $gbank=mysqli_query($con,"select distinct(bank) from quotation1");

while($bnkrow=mysqli_fetch_array($gbank))
{
?>
<option value='<?php echo $bnkrow[0]; ?>'  <?php if($bnkr==$bnkrow[0]){echo "selected";}?>><?php echo $bnkrow[0]; ?></option>
<?php } ?>
</select>

</td>

<td>

<select name='state' id='state' style='width:215px'>

<option value=''>Select state</option>
<?php $stqr=mysqli_query($con,"select state from quotation1statedet");

while($stqrws=mysqli_fetch_array($stqr))
{
?>
<option value='<?php echo $stqrws[0]; ?>'<?php if($sttr==$stqrws[0]){echo "selected";}?>><?php echo $stqrws[0]; ?></option>
<?php } ?>
</select>

</td>

<td  align="center">
Quotation Id
<input type='text' name="quotid" id="quotid"  placeholder="Quotation Id" value="<?php echo $qutr;?>"/>
</td>

<td  align="center">
<input type='button' name="srbtn" id="srbtn"  onclick="sfunc('','');" value="Search">
</td>

</tr>


<!--<tr>
<td  align="center">Invoice Number
<input type='text' name="invno" id="invno" />
</td>
</tr>-->




</table>
</center>



<center>
<div id="search"></div>

</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php 

?>