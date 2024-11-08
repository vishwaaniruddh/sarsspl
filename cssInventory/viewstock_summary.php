<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';

?> 

<html>
<head>
<title>view stock summary</title>
<script src="jquery-1.8.3.js"></script>
<script>
var tableToExcel = (function() {
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

<?php
include 'header.php';
?>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            function search(strPage,perpg){
                
                var oit=document.getElementById("oit").value;
                var fromdt=document.getElementById("fromdt").value;
                var todt=document.getElementById("todt").value;
                var ATMID=document.getElementById("ATMID").value;
                var Handover=document.getElementById("Handover").value;
         perp='10000';

var Page="";
if(strPage!="")
{
Page=strPage;
}

$('#loadingmessage').show();
            $.ajax({
   type: 'POST',    
   url:'viewstocksummary_process.php',
  
    data:'oit='+oit+'&fromdt='+fromdt+'&todt='+todt+'&ATMID='+ATMID+'&Handover='+Handover+'&Page='+Page+'&perpg='+perp,

   success: function(msg){
    $('#loadingmessage').hide();
    
   //alert(msg);
   document.getElementById("show").innerHTML=msg;
   
   
   
} })
            }
        </script>
</head>



<!--<body onload="search('','')">-->
    <body>
<?php include('menu.php')?>
<h2 align="center">View Stock Summary</h2>
<tr>&nbsp;&nbsp;
<leble><b>Sr No<b/>:
<td><input type="text" name="oit" id="oit" placeholder="Sr No" /></td>
<leble><b>ATM ID<b/>:
<td><input type="text" name="ATMID" id="ATMID" placeholder="ATM ID" /></td>
<leble><b>Handover Person Name<b/>:
<td><input type="text" name="Handover" id="Handover" placeholder="Handover Person Name" /></td>

<leble><b>FROM DATE<b/>:
<td><input type="date" name="fromdt" id="fromdt" placeholder="from date" /></td>
<leble><b>TO DATE<b/>:
<td><input type="date" name="todt" id="todt" placeholder="To date" /></td>
<td><input type="button" name="submit" onclick="search('','')"value="search"></button></td>
<td><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;" ></td>
</tr>

            <div id="show"></div>
            <div id='loadingmessage' style='display:none;' >
                <img src='loding.gif' style="position:center;left:50%;margin-left:550px; "/>
            </div>
   
</body>
</html>

<?php
}else
{ 
 header("location: login.php");
}
?>

