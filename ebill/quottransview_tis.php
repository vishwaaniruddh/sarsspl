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

<?php } ?>
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


function getaccm(cst)
{

//alert("test");



//alert(cst);
$.ajax({
   type: 'POST',    
url:'get_accmanager_tis.php',
data:'cust='+cst,
success: function(msg){

//alert(msg);
document.getElementById('accname').innerHTML=msg;

 
         }
     });

func('','');
}




function func(strpg,perpg)
{

var sup=document.getElementById('sup').value;
var strdt=document.getElementById('frmdt').value;
var endt=document.getElementById('todt').value;
var accname=document.getElementById('accname').value;
var custr=document.getElementById('cust1').value;
var atm=document.getElementById('atm').value;

var fdtyp=document.getElementById('fdtyp').value;

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


//alert(atm);

$.ajax({
   type: 'POST',    
url:'getquotdfr_tis.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'sup='+sup+'&strdt='+strdt+'&endt='+endt+'&perpg='+perp+'&Page='+Page+'&accname='+accname+'&custr='+custr+'&atm='+atm+'&fdtyp='+fdtyp,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;
         }
     });





}


function vdtefunc(qid,ct)
{
//lert(id);
//var count= id.replace( /^\D+/g, '').trim();
//lert(count);
//var qid=document.getElementById('qid'+count).value;

//var ct=document.getElementById('customer'+count).value.trim();
//alert(qid);
//alert(ct);
if(ct=="Fidility")
{

window.open('viewfisquotdetails_tis.php?qid='+qid,'_blank');
}
else if(ct=="Tata")
{

window.open('viewtataquotdetails_tis.php?qid='+qid,'_blank');
}
else if(ct=="ICICI"  || ct=="RATNAKAR" || ct=="ICICI Direct" || ct=="Knight Frank" )
{
window.open('viewiciciquot_tis.php?qid='+qid,'_blank');

}
else
{



 window.open('viewquotdetails_tis.php?qid='+qid,'_blank');
  } 



}





</script>
</head>
<body onload="func('','');">
<form method="post" action="quotransfer_export_tis.php" target='_blank'>
<center>
<?php  include("menubar.php"); ?>
<h2 class="h2color">RNM FUND REQUESTS </h2>

<input type="hidden" id="acccust" value="<?php echo $_SESSION['custid'];?>" readonly/>
	<br />
<table>

<th>

<?php $sql="Select short_name,contact_first from contacts where type='c' ";
$qry=mysqli_query($con,$sql);

?>
 <select  name="cust1" id="cust1" onchange="getaccm(this.value);" >
<option value="">Select Client</option>
<?php
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>" <?php if($custr==$clro[0]){ echo "selected"; } ?>><?php echo $clro[1]; ?></option>
<?php
}
?>
</select> </th>











<th><select id="accname" name="accname" >
<option value="-1">select made by</option>
<?php 

$qrs="select srno,username from login  where srno in(select reqby from quotation1_tis) ";
$qrsy=mysqli_query($con,$qrs);
while($qrsrow=mysqli_fetch_array($qrsy))
{

?>

<option value="<?php echo $qrsrow[0];?>" ><?php echo $qrsrow[1];?></option>
<?php }

 ?>






</select>
</th>
<th>
<?php
$fqr="select * from fundaccounts where status=0";

if($_SESSION['dept']=='7') { 

$fqr.=" and hname='Vikrant Enterprises'";
}

$fqr.=" order by hname ASC";

//echo $fqr;
$sup=mysqli_query($con,$fqr);
?>
<select name="sup" id="sup">
<?php if($_SESSION['dept']!='7') { ?>


<option value="-1">Select Supervisor</option>

<?php } ?>

<?php
while($supro=mysqli_fetch_array($sup))
{
?>
<option value="<?php echo $supro[0]; ?>" <?php if($_POST['sup']==$supro[0]){ echo "selected"; } ?>><?php echo $supro[1]."/ ".$supro[4]; ?></option>
<?php
}
?>
</select>
</th>
<th>From Date:- <input type="text" name="frmdt" id="frmdt" value="<?php if(isset($_POST['frmdt'])){ echo $_POST['frmdt']; }else{ echo date('d/m/Y',strtotime('-2 days'));} ?>" onclick="displayDatePicker('frmdt');" ></th>
<th>
To Date:- <input type="text" name="todt" id="todt" value="<?php  if(isset($_POST['todt'])){ echo $_POST['todt']; }else{ echo date('d/m/Y'); } ?>" onclick="displayDatePicker('todt');" >
</th>

<th>
<input type="text" name="atm" id="atm" placeholder="search by Atm">
</th>

<th>
<select name="fdtyp" id="fdtyp"><option value="">Select type</option>
<option value="f">Fixed Cost</option>
<option value="a">Approval Basis</option>
</select>
</th>



<th>
<input type="button" value="Search" name="cmdsearch" onclick="func('','');">
</th>



</table>
<center>
<div id="search"></div>

</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php 

?>