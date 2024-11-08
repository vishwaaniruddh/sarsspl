<?php
include("access.php");
include("config.php");


$yrr=$_GET['yrr'];
$mnf=$_GET['mntr'];
$typr=$_GET['typr'];


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

var mnth=document.getElementById('mnth').value;
var yr=document.getElementById('yr').value;
var typ=document.getElementById('typ').value;



//alert(accname);

//alert(atm);
$.ajax({
   type: 'POST',    
url:'search_salarytrans.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'mnth='+mnth+'&yr='+yr+'&typ='+typ,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;
         }
     });





}






</script>


</head>
<body <?php if($mnf!=""){ ?> onload="func();" <?php } ?>>
<form  method="post" >
<center>
<?php  include("menubar.php"); ?>
<h2 class="h2color"></h2>


	
<table  border="0" cellpadding="0" cellspacing="0">

<tr>
<th>Type:
<select name="typ" id="typ">
<option value="">select type</option>
<option value="Off Roll" <?php if($typr=='Off Roll'){ echo "selected";}?>>Off Roll</option>
<option value="On Roll" <?php if($typr=='On Rolll'){ echo "selected";}?>>On Roll</option>
</select>
</th>
<th>
Month
<select id="mnth" name="mnth" style="width:200px">

<option value="">select month</option>
<option value="01"   <?php if($mnf=='1'){ echo "selected";} ?>>January</option>
 <option value="02" <?php if($mnf=='2'){ echo "selected";} ?>>February</option>
 <option value="03" <?php if($mnf=='3'){ echo "selected";} ?>>March</option>
 <option value="04" <?php if($mnf=='4'){ echo "selected";} ?>>April</option>
 <option value="05" <?php if($mnf=='5'){ echo "selected";} ?>>May</option>
 <option value="06" <?php if($mnf=='6'){ echo "selected";} ?>>June</option>
 <option value="07" <?php if($mnf=='7'){ echo "selected";} ?>>July</option>
 <option value="08" <?php if($mnf=='8'){ echo "selected";} ?>>August</option>
 <option value="09" <?php if($mnf=='9'){ echo "selected";} ?>>September</option>
 <option value="10" <?php if($mnf=='10'){ echo "selected";} ?>>October</option>
 <option value="11" <?php if($mnf=='11'){ echo "selected";} ?>>November</option>
 <option value="12" <?php if($mnf=='12'){ echo "selected";} ?>>December</option>
</select>

</th>
<th>Year:
<select name="yr" id="yr">
 <option value="" >select year</option>
<?php $year="2000";
$cyr=date('Y');
for($i=1;$i<50;$i++)
{

?>
<option value="<?php echo $year;?>" <?php  if($yrr=="") {if($cyr==$year){ echo "selected";}}else{ if($yrr==$year){ echo "selected";}  }   ?> ><?php echo $year; $year=$year+1; ?></option>

<?php } ?>
</select>
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