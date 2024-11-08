<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';

?> 

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    
</style>
<style>
.footer {
   background-image: url("download.jpg");
color: #FFFFFF;
font-size:.8em;
margin-top:25px;
padding-top: 15px;
padding-bottom: 10px;
position:fixed;
left:0;
bottom:0;
width:100%;
}

</style>
    <style>
    
body {
    display: flex;
  flex-direction: column;
    
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: #ffd942;
}

</style>
<title>Dash Board</title>
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
        
var Page="";
if(strPage!="")
{
Page=strPage;
}

var perp='';
if(perpg=='')
perp='50';
else
perp=document.getElementById(perpg).value;



            $.ajax({
   type: 'POST',    
   url:'dashboard1_process.php',
  
    //data:'oit='+oit+'&Page='+Page+'&perpg='+perp,
    data:'oit='+oit+'&Page='+Page+'&perpg='+perp,

   success: function(msg){
    
    
   //alert(msg);
   document.getElementById("show").innerHTML=msg;
   
   
   
} })
            }
        </script>
</head>



<body style="background-color: #e0fde0;" onload="search('','')">
  <div class="container">  <div class="footer">
  <p align="left" style="
     margin-bottom: 2px;
    padding-left: 18px;
">CSS</p>
</div></div>
<?php include('menu.php')?>
<div class="panel panel-primary" style="background-color: #e0fde0;">
    <div class="panel-heading" style="font-size: 27px;margin-top: 21px;border-top-width: 0px;" align="center">Dash Board</div>
  </div>
  <div class="container">
<table style="width:50%" align="center";>
<tr>&nbsp;&nbsp;
<td><leble><b>OUT ID<b/>:</td>
<td><input type="text" name="oit" id="oit" placeholder="out id" /></td>
<td><input type="button" style="
    background-color: #82c5f3;
" name="submit" onclick="search('','')"value="search"></button></td>
<td><input type="button" style="
    background-color: #82c5f3;
" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;" >
</tr>
</table></div>
            <div id="show"></div>
          
</body>
</html>
<?php
}else
{ 
 header("location: login.php");

}
?>


