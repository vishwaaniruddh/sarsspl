<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';

?> 

<html>
<head>
<title>view stock</title>
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
                var vid=document.getElementById("vid").value;
         perp='20';

var Page="";
if(strPage!="")
{
Page=strPage;
}
            $.ajax({
   type: 'POST',    
   url:'view_stock_out_process.php',
  
    data:'oit='+oit+'&vid='+vid+'&Page='+Page+'&perpg='+perp,

   success: function(msg){
    
    
   //alert(msg);
   document.getElementById("show").innerHTML=msg;
   
   
   
} })
            }
        </script>
</head>



<body onload="search()">
<?php include('menu.php');
$id=$_REQUEST['srno'];
?>
<h2 align="center">View Stock Out Inventory</h2>
<tr>&nbsp;&nbsp;
<leble><b>OUT ID<b/>:
<td><!--<input type="text" name="oit" id="oit" placeholder="out id" />--></td>
<input type="hidden" name="vid" id="vid" value="<?php echo $id;?>"/>
<td><input type="button" name="submit" onclick="search('','')"value="search"></button></td>
<td><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;" ></td>
</tr>

            <div id="show"></div>
            
   
</body>
</html>

<?php
}else
{ 
 header("location: login.php");
}
?>

