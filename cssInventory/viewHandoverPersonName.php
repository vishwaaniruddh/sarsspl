<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';

?> 

<html>
<head>
<title></title>
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
                
                var Handover=document.getElementById("Handover").value;
                var City=document.getElementById("City").value;
          
                perp='10';

var Page="";
if(strPage!="")
{
Page=strPage;
}
            
            $.ajax({
   type: 'POST',    
   url:'viewHandoverPersonName_process.php',
    data:'Handover='+Handover+'&City='+City+'&Page='+Page+'&perpg='+perp,
   success: function(msg){
   //alert(msg);
   document.getElementById("show").innerHTML=msg;
   
} })
            }
        </script>
</head>



<body onload="search('','')">
<?php include('menu.php')?>
<h2 align="center">Handover Person View</h2>
<tr>&nbsp;&nbsp;
<leble><b>Handover Person Name<b/>:
<td><input type="text" name="Handover" id="Handover" placeholder="Handover Name" /></td>
<td>
      <label>City:</label></td>
      <td><select name="City" id="Handover">
  <option value="Mumbai">Mumbai</option>
  <option value="Punjab">Punjab</option>
  <option value="Maharashtra">Maharashtra</option>
</select>
    </td>
<leble><b>FROM DATE<b/>:
<td><input type="date" name="fromdt" id="fromdt" placeholder="from date" /></td>
<leble><b>TO DATE<b/>:
<td><input type="date" name="todt" id="todt" placeholder="To date" /></td>
<input type="button" value="search" onclick="search('','')"/>
<td><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;" >
</tr>

            <div id="show"></div>
            <table align="right" style="border:0px solid #fff;margin-top:-110px">
		<tr>
</body>
</html>
<?php
}else
{ 
 header("location: login.php");
}
?>


