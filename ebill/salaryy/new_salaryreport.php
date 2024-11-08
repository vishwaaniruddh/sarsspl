<?php
include("../access.php");
include("../config.php");


if(!$_SESSION['user'])
{
?>
<script type="text/javascript">
alert("Sorry Your session has Expired");
window.location="../index.php";
</script>
<?php
}



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




function func()
{
//alert("hello");
var mnth=document.getElementById('mnth').value;
var yr=document.getElementById('yr').value;
var typ=document.getElementById('typ').value;



if(typ=="")
{
alert("Please select type");
}
else if(yr=="")
{
alert("Please select Year");
}
else if(mnth=="")
{
alert("Please select Month");

}
else
{
//alert(accname);

//alert(atm);
$.ajax({
   type: 'POST',    
url:'search_salaryreport.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=../loader.gif></center>";
                  },
data:'mnth='+mnth+'&yr='+yr+'&typ='+typ,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;



  
 
         }
     });



}

}


</script>
</head>
<body>
<form id='frm1' method="post" >
<center>
<?php  include("../menubar.php"); ?>
<h2 class="h2color"></h2>


<br/>
<table  border="0" cellpadding="0" cellspacing="0">

<th>Type:
<select name="typ" id="typ">
<option value="">select type</option>
<option value="offroll">Off Roll</option>
<option value="onroll">On Roll</option>
</select>
</th>
<th>
Month
<select id="mnth" name="mnth" style="width:200px">
<?php 

	/*
for ($i = 0; $i < 12; $i++)
 { 
 $date_str = date('M', strtotime("+ $i months"));
  $new_i = $i+1; 
  echo "<option value=$new_i>".$date_str ."</option>"; 
  
  }
*/

?>
<option value="">select month</option>
<option value="01">January</option>
 <option value="02">February</option>
 <option value="03">March</option>
 <option value="04">April</option>
 <option value="05">May</option>
 <option value="06">June</option>
 <option value="07">July</option>
 <option value="08">August</option>
 <option value="09">September</option>
 <option value="10">October</option>
 <option value="11">November</option>
 <option value="12" >December</option>
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
<option value="<?php echo $year;?>" <?php if($cyr==$year){ echo "selected";}?> ><?php echo $year; $year=$year+1; ?></option>

<?php } ?>
</select>
</th>

<th><input type="button" name="search"  value="search" onclick="func();"/></th>
</tr>
</table>
</center>



<center>
<div id="search"></div>

</center>
</form>
<script type="text/javascript" src="../1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="../script.js"></script>
</body>
</html>
<?php 

?>