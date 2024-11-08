<?php
include("access.php");


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
<script type="text/javascript">
function confirm_delete(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_site.php?id="+id;
	}
	
}


///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='50';
else
ppg=document.getElementById(perpg).value;

//alert(ppg);
document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";

		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
 
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
		  
		       
			var cid=document.getElementById('cid').value;//alert(cid);
			 if(a!="Loading"){
			
			 var sdate=document.getElementById('sdate').value;//alert(sdate);
			var edate=document.getElementById('edate').value;//alert(edate);
			var atmid=document.getElementById('atmid').value;//alert(atmid);
			var qid=document.getElementById('qid').value;//alert(qid);
			  }
		
			var url = 'search_quotationannex.php';
	var pmeters="";
	if(a!="Loading"){ 
			 pmeters = 'cid='+cid+'&Page='+b+'&perpg='+ppg+'&sdate='+sdate+'&edate='+edate+"&atmid="+atmid+"&qid="+qid;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg;	
			}
			//alert(pmeters);
		 		HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert("gg"); 
			HttPRequest.onreadystatechange = function()
			{
 
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
 //alert(response);
				  document.getElementById("search").innerHTML = response;
			  	  }
		    }
  }




</script>
</head>

<body  >
<div class="">
<center>
<?php  include("menubar.php"); ?>

<h2 class="h2color">Annexure</h2>

<!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />-->
<table  border="0" cellpadding="0" cellspacing="0">

<tr>
<th>

<?php 
include("config.php");
?>
<th width="75">
<select name="cid" id="cid" onchange="searchById('Listing','1','');">
<option value="-1">Select</option>
<?php 
$qr=mysqli_query($con,"select short_name,contact_first from contacts");
while($qra=mysqli_fetch_array($qr))
{
?>


<option value="<?php echo $qra[0]; ?>"><?php echo $qra[1]; ?></option>


<?php 

}
?>

</select>

</th>
<th width="75"><input type="text" name="qid" id="qid" placeholder="Quotation Id"/></th>
<th width="75"><input type="text" name="atmid" id="atmid" placeholder="AtmID" onkeyup"searchById('Listing','1','');"/></th>
<th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');"  placeholder="From Date"/></th>
<th width="75"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');"  placeholder="To Date"/></th>
<th><input type="button" name="dt" onclick="searchById('Listing','1','');" value="search" /></td>
</tr>
</table>
</center>
<?php if(isset($_GET['success'])){ ?><center><?php echo $_GET['success']; unset($_GET['success']); ?></center><?php } ?>

</div>



<center>
<div id="search"></div>

</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php 

?>