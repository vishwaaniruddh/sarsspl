<?php
include("access.php");
include("config.php");


$custr=$_GET['cr'];
$acmr=$_GET['acmr'];
$catr=$_GET['crcatr'];
$typr=$_GET['typr'];
$atmr=$_GET['atmr'];
$fr=$_GET['fr'];
$er=$_GET['er'];

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


function func()
{
//alert("hello");

var strdt=document.getElementById('frmdt').value;
var endt=document.getElementById('todt').value;



//alert(accname);

//alert(atm);
$.ajax({
   type: 'POST',    
url:'search_quottrans_tis.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'strdt='+strdt+'&endt='+endt,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;
         }
     });





}






</script>


</head>
<body onload="func();">
<form  method="post" >
<center>
<?php  include("menubar.php"); ?>
<h2 class="h2color"></h2>


	
<table  border="0" cellpadding="0" cellspacing="0">

<tr>
<th>From: <input type="text" name="frmdt" id="frmdt" onclick="displayDatePicker('frmdt')" >&nbsp;
</th>

<th>From: <input type="text" name="todt" id="todt" onclick="displayDatePicker('todt')" >&nbsp;
</th>
<th><input type="button" name="search"  value="search" onclick="func();"/></td>
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