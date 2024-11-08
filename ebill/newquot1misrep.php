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

function getaccm(cst)
{

$.ajax({
   type: 'POST',    
url:'get_accmanager.php',
data:'cust='+cst,
success: function(msg){

//alert(msg);
document.getElementById('accname').innerHTML=msg;

 
         }
     });



}





function func()
{

var cust=document.getElementById('cust1').value;
var strdt=document.getElementById('sdate').value;
var endt=document.getElementById('edate').value;





//alert(accname);

//alert(typ);
$.ajax({
   type: 'POST',    
url:'searchnewquot1mis.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'cust='+cust+'&strdt='+strdt+'&endt='+endt,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;



  
 
         },
    error: function (request, status, error) {
        alert(request.responseText);
    }
     });





}
























</script>
</head>
<body onload="func();">
<form id='frm1' method="post" >
<center>
<?php  include("menubar.php"); ?>
<h2 class="h2color">RNM FUND MIS REPORT </h2>


<br/>
<table  border="0" cellpadding="0" cellspacing="0">

<tr>

<th>Customer:
<select  name="cust1" id="cust1" onchange="getaccm(this.value);" >
<option value="">Select Customer</option>
<?php
$sql="Select short_name,contact_first from contacts where type='c' ";
$qry=mysqli_query($con,$sql);
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>" <?php if($custr==$clro[0]){ echo "selected"; } ?>><?php echo $clro[1]; ?></option>
<?php
}
?>
</select> </th>



</th>
<!--<th>Made By:
<select id="accname" name="accname" >

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

<option value="<?php echo $qrsrow2[0];?>" ><?php echo $qrsrow2[1];?></option>
<?php } ?>




</select>
</th>-->







<th width="75">From Date:<input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');"  /></th>
<th width="75">To Date<input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');" /></th>

<th><input type="button" name="search"  value="search" onclick="func('','');"/></td>
</tr>
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