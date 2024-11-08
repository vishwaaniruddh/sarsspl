<?php
include("../access.php");
include("../config.php");

session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='../index.php';</script>";
}
else
{


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript" src="../1.7.2.jquery.min.js"></script>
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

var WindowObjectReference;
function myFunc(num)
{
if(WindowObjectReference == null || WindowObjectReference.closed)
{
  var left = (screen.width/2)-250;
  var top = (screen.height/2)-125;

 WindowObjectReference=window.open('edit_caretakersalary.php?send_id='+num,'MyWindow','scrollbars,width=500,height=250,left='+left+',top='+top);
}
else
{
	WindowObjectReference=window.open('edit_caretakersalary.php?send_id='+num,'MyWindow','width=500,height=250,left='+left+',top='+top);
    	WindowObjectReference.focus();
   
 
  }
}


function func(strpg,perpg)
{



var atmid=document.getElementById('atmid').value;//alert(atmid);
			
			


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
url:'search_salarydet.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=../loader.gif></center>";
                  },
data:'atmid='+atmid+'&perpg='+perp+'&Page='+Page,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;
 
         }
     });





}



</script>
</head>

<body  >
<form name="frm1" id="frm1" method="post">
<div class="">
<center>
<?php  include("../menubar.php"); ?>

<h2 class="h2color"></h2>

<!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />-->
<table  border="0" cellpadding="0" cellspacing="0">

<tr>


<th width="75"><input type="text" name="atmid" id="atmid" placeholder="AtmID" /></th>

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