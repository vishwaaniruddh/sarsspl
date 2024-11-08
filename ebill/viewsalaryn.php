<?php

session_start();
include("access.php");
include("config.php");

if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{


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




function func(strpg,perpg)
{


var strdt=document.getElementById('dt1').value;
var endt=document.getElementById('dt2').value;


var exnm=[];

$('#excust').each(function() {
    
    exnm.push($(this).val());
   
});




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






//alert(accname);

//alert(atm);
$.ajax({
   type: 'POST',    
url:'gsaldet_new.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'strdt='+strdt+'&endt='+endt+'&perpg='+perp+'&Page='+Page,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;



     lcalc();
 
         }
     });





}





</script>
</head>
<body  >
<form id='frm1' method="post" >

<center>
<?php  include("menubar.php"); ?>
<h2 class="h2color">View Salary</h2>


	<br />
<table  border="0" cellpadding="0" cellspacing="0">

<tr>
<th><input type="text" name="dt1" id="dt1"  onclick="displayDatePicker('dt1');"/> </th>
<th><input type="text" name="dt2" id="dt2"  onclick="displayDatePicker('dt2');"/> </th>

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
}
?>