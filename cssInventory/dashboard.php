<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
<html>
<head>

<?php include ('header.php');

include ('config.php');

?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Dash Board</title>
<style>
    .panel-heading {
    padding: 19px 26px;
    border-bottom: 2px solid transparent;}
</style>
<style>
html *
{
   font-family: "Yatra One" !important;
}
body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: #ffd942;
}
.footer {
    background-image: url("download.jpg");
   
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: red;
   color: white;
   text-align: center;
}
</style>
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
            function search(){
                
            $.ajax({
   type: 'POST',    
   url:'dashboard_process.php',
  
    //data:'DVR='+DVR+'&camera='+camera+'&HDD=',+HDD,
    success: function(msg){
    var arr=msg.split("@#");
    
   document.getElementById("DVR").value=arr[0];
   document.getElementById("camera").value=arr[1];
   document.getElementById("HDD").value=arr[2];
    
   //alert(msg);
  // document.getElementById("show").innerHTML=msg;
   
   
   
} })
stockIN();
stockout();
            }
            
             function stockout(){
            
            $.ajax({
   type: 'POST',    
   url:'dashboard_out_process.php',
  
    //data:'DVR='+DVR+'&camera='+camera+'&HDD=',+HDD,
    

   success: function(msg){
    var arr=msg.split("@#");
    
    document.getElementById("DVR2").value=arr[0];
   document.getElementById("camera2").value=arr[1];
   document.getElementById("HDD2").value=arr[2];
    
   //alert(msg);
  // document.getElementById("show").innerHTML=msg;
   
   
   
} })
            }
            
            function stockIN(){
            
            $.ajax({
   type: 'POST',    
   url:'dashboardIN_process.php',
  
    //data:'DVR='+DVR+'&camera='+camera+'&HDD=',+HDD,
    

   success: function(msg){
    var arr=msg.split("@#");
    
    document.getElementById("DVR1").value=arr[0];
   document.getElementById("camera1").value=arr[1];
   document.getElementById("HDD1").value=arr[2];
    
   //alert(msg);
  // document.getElementById("show").innerHTML=msg;
   
   
   
} })
            }
        </script>
</head>



<body style="background-color: #3498db;" onload="search()">
<?php include 'menu.php';?>
<div class="footer" background-image:"download.jpg" style="font-size: 25px;">
  <p style="padding-top: 9px;margin-left: 17px;" align="left">css</p>
</div>


<div class="container" style="
    padding-top: 17px;
">
  <div class="panel panel-primary">
    <div class="panel-heading" style="font-size: 27px;" align="center">Dash Board</div>
  </div>
</div>
<div>
    <div class="container"><div class="well" style="height: 2164px;width: 1146px;">
       <!--------------------------------->
<table align="left" style="width:20%;margin-left:83px;">
 <tr><h5 style="margin-left:173px;font-size: 25;">Stock In</h5></tr>   
<tr>
<td><leble><b>DVR:<b/></td>
<td><input type="text" name="DVR1" id="DVR1" readonly></td>
</tr>
<tr>
<td><leble><b>Camera:</b></td>
<td><input type="text" name="camera1" id="camera1" readonly></td>
</tr>
<tr>
<td><leble><b>HDD:</b></td>
<td><input type="text" name="HDD1" id="HDD1" readonly></td>
</tr>
</table>

<table align="center" style="width:20%;margin-left:83px;">
 <tr><h5 style="margin-left: 475px;font-size: 25;width: 104px;margin-top: -36;">Available</h5></tr> 
 <div>
<tr><td><leble><b>DVR:<b/></td><td><input type="text" name="DVR" id="DVR" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>Camera:</b></td><td><input type="text" name="camera" id="camera" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>HDD:</b></td><td><input type="text" name="HDD" id="HDD" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>ANTEENA:<b/></td><td><input type="text" name="ANTEENA" id="ANTEENA" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>ATM Machine Thermal Sensor:</b></td><td><input type="text" name="ThermalSensor" id="ThermalSensor" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>BATTERY:</b></td><td><input type="text" name="BATTERY" id="BATTERY" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>BULLET CAMERA :<b/></td><td><input type="text" name="BULLETCAMERA " id="BULLETCAMERA" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>DOOME CAMERA :</b></td><td><input type="text" name="DOOMECAMERA " id="DOOMECAMERA" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>EML LOCK:</b></td><td><input type="text" name="EMLLOCK" id="EMLLOCK" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>Filter Board:<b/></td><td><input type="text" name="FilterBoard" id="FilterBoard" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>GIGABIT SWITCH:</b></td><td><input type="text" name="GIGABITSWITCH" id="GIGABITSWITCH" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>GLASS BREAKING SENSOR :</b></td><td><input type="text" name="GLASSBREAKINGSENSOR " id="GLASSBREAKINGSENSOR" style="width: 69px;" readonly></td></tr>

<tr><td><leble><b>HDD 1TB:<b/></td><td><input type="text" name="HDD1TB" id="HDD1TB" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>HDD 2TB:</b></td><td><input type="text" name="HDD2TB" id="HDD2TB" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>HEAT SENSOR:</b></td><td><input type="text" name="HEATSENSOR" id="HEATSENSOR" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>HOOTER:<b/></td><td><input type="text" name="HOOTER" id="HOOTER" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>KEY PAD:</b></td><td><input type="text" name="KEYPAD" id="KEYPAD" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>MAGENTIC SENSOR:</b></td><td><input type="text" name="MAGENTICSENSOR" id="MAGENTICSENSOR" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>MOTHER BOARD:<b/></td><td><input type="text" name="MOTHERBOARD " id="MOTHERBOARD" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>MULTI FUNCTION DETECTOR:</b></td><td><input type="text" name="MULTIDETECTOR" id="MULTIDETECTOR" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>Panel  Board:</b></td><td><input type="text" name="PanelBoard" id="PanelBoard" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>PANIC SWITCH:<b/></td><td><input type="text" name="PANICSWITCH" id="PANICSWITCH" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>PCB BOARD:</b></td><td><input type="text" name="PCBBOARD" id="PCBBOARD" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>PIR MOTION SENSOR:</b></td><td><input type="text" name="PIRMOTIONSENSOR " id="PIRMOTIONSENSOR" style="width: 69px;" readonly></td></tr>

<tr><td><leble><b>ROUTER:<b/></td><td><input type="text" name="ROUTER" id="ROUTER" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>SHUTTER SENSOR WIRED:</b></td><td><input type="text" name="SHUTTERSENSORWIRED" id="SHUTTERSENSORWIRED" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>SIANGE:</b></td><td><input type="text" name="SIANGE" id="SIANGE" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>SMOKE SENSOR:<b/></td><td><input type="text" name="SMOKESENSOR" id="SMOKESENSOR" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>SMPS:</b></td><td><input type="text" name="SMPS" id="SMPS" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>SOUDER:</b></td><td><input type="text" name="SOUDER" id="SOUDER" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>SPK-MIC:<b/></td><td><input type="text" name="SPKMIC " id="SPKMIC" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>TEMPERATURES:</b></td><td><input type="text" name="TEMPERATURES" id="TEMPERATURES" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>THERMAL SENSOR:</b></td><td><input type="text" name="PanelBoard" id="PanelBoard" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>PANIC SWITCH:<b/></td><td><input type="text" name="THERMALSENSOR" id="THERMALSENSOR" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>THERMOSTAE :</b></td><td><input type="text" name="THERMOSTAE" id="THERMOSTAE" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>VIBRATION SENSOR:</b></td><td><input type="text" name="VIBRATIONSENSOR " id="VIBRATIONSENSOR" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>YAGIANTEENA:</b></td><td><input type="text" name="YAGIANTEENA" id="YAGIANTEENA" style="width: 69px;" readonly></td></tr>
<tr><td><leble><b>ZONE BOARD:</b></td><td><input type="text" name="ZONEBOARD " id="ZONEBOARD" style="width: 69px;" readonly></td></tr></div>
</table>

<!--------------second table----->
<table align="right" style="width:20%;margin-right: 83px;height: 87px;border-top-width: 0px;margin-bottom: 0px;">
 <tr><h5 style="margin-left: 816px;font-size: 25;margin-top: ‒50;margin-top: -2067;">Stock out</tr>   
<tr>
<td><leble><b>DVR:<b/></td>
<td><input type="text" readonly name="DVR2" id="DVR2" readonly></td>
</tr>
<tr>
<td><leble><b>Camera:</b></td>
<td><input type="text" readonly name="camera2" id="camera2" readonly></td>
</tr>
<tr>
<td><leble><b>HDD:</b></td>
<td><input type="text" readonly name="HDD2" id="HDD2" readonly></td>
</tr>

</table></div></div></div>



            <!--<div id="show"></div>-->
          
           <!-- <table align="right" style="border:0px solid #fff;margin-top:-150px">
		<tr><td><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;" >
		</table>-->
</body>
</html>

<?php
}else
{ 
 header("location: login.php");
}
?>


