<?php
include("access.php");
include('config.php');
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['service'];
// print_r($_SESSION['branch']);
$ser=mysqli_query($con,"select serviceauth,branch from login where username='".$_SESSION['user']."'");
$serro=mysqli_fetch_row($ser);
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<script src="popup.js" type="text/jscript" language="javascript"> </script>
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
///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='10';
else
ppg=document.getElementById(perpg).value;
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
		  var br=document.getElementById('br').value;
		  var brnch=document.getElementById('brnch').value;
		  var service=document.getElementById('service').value;
		  var calltype=document.getElementById('calltype').value;
		var cid=document.getElementById('cid').value;//alert(cid);
			 if(a!="Loading"){
			 var id=document.getElementById('atmid').value;//alert(id);
			 
			 var bank=document.getElementById('bank').value;//alert(bank);
			 var edate=document.getElementById('edate').value;
			 var sdate=document.getElementById('sdate').value;
			 var area=document.getElementById('area').value;//alert(area);
			 
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'search_callalert.php'; 
		//  }
 	//alert(br);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&cid='+cid+'&area='+area+'&bank='+bank+'&br='+br+'&Page='+b+"&calltype="+calltype+'&perpg='+ppg+'&service='+service+'&brnch='+brnch+'&sdt='+sdate+'&edt='+edate;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'br='+br+"&Page="+b+"&calltype="+calltype+'&perpg='+ppg+'&service='+service+"&cid="+cid+'&brnch='+brnch;
			}
			//alert(pmeters);
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert(pmeters); 
			HttPRequest.onreadystatechange = function()
			{
 /*
			if(HttPRequest.readyState == 3)  // Loading Request
				  {
	document.getElementById("listingAJAX").innerHTML = '<img src="loader.gif" align="center" />';
				  }
 */
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
 //alert(response);
				  document.getElementById("search").innerHTML = response;
			  }
		}
  }


function newwin(url,winname,w,h)
{

var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (url, winname, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=1, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
 // mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
 }
</script>
</head>

<body onLoad="searchById('Loading','1','')">
<div style="height:30px;">

<input type="hidden" name="br" id="br" value="<?php echo $_SESSION['branch']; ?>"/>
<input type="hidden" name="dept" id="dept" value="<?php echo $_SESSION['dept']; ?>"/>
<input type="hidden" name="service" id="service" value="<?php echo $_SESSION['serviceauth']; ?>"/>
<input type="hidden" name="desig" id="desig" value="<?php echo $_SESSION['designation']; ?>"/>
<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>

<h2>MIS Report</h2>
 <button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />
<table cellpadding="" cellspacing="0" >
  <tr>
    <th width="77" colspan="5"><select name="calltype" id="calltype" onchange="searchById('Listing','1','');">
      <option value="open">Open call</option>
      <option value="Done">Closed call</option>
      <!--<option value="onhold">Call On Hold</option>-->
      <option value="Rejected">Rejected</option>
      <option value="">All Calls</option>
    </select></th>
    <th width="77"><?php
    $sql="Select short_name,contact_first from contacts where type='c' ";
if($_SESSION['custid']!='all')
{
$custo=str_replace(",","','",$_SESSION['custid']);
$custo="'".$custo."'";
$sql.=" and short_name in ($custo)";
}
$qry=mysqli_query($con,$sql);

 ?>
 <select  name="cid" id="cid" onchange="searchById('Listing','1','');">
<option value="">Select Client</option>
<?php
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>" <?php if($_SESSION['custid']==$clro[0]){ echo "selected"; } ?>><?php echo $clro[1]; ?></option>
<?php
}
?>
</select>
    </th>
    <th width="75"><select name="brnch" id="brnch" onchange="searchById('Listing','1','');"><option value="-1">All</option>
    <?php
    $brn="select location from cssbranch where 1 ";
    if($_SESSION['branch']!='all' && $_SESSION['branch']!='All')
    $brn.=" and id in (".$_SESSION['branch'].")";
    
    $brn.=" order by location ASC";
    $br=mysqli_query($con,$brn);
    while($brro=mysqli_fetch_array($br))
    { ?>
    <option value="<?php echo $brro[0]; ?>"><?php echo $brro[0]; ?></option><?php }
    ?>
    </select></th>
    <th width="75"><input type="text" name="atmid" id="atmid" onkeyup="searchById('Listing','1','');" placeholder="ATM"/></th>
    <th width="75"><input type="text" name="bank" id="bank" onkeyup="searchById('Listing','1','');" placeholder="Bank"/></th>
    <th width="75"><input type="text" name="area" id="area" onkeyup="searchById('Listing','1','');" placeholder="Address"/></th>
      <th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" readonly="readonly" placeholder="From Date"/></th>
<th width="75"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');" readonly="readonly" placeholder="To Date"/></th>
    <th width="75"><input type="button" onclick="searchById('Listing','1','');" class="readbutton" value="Search" style="width:120px;"/></th>
  
  </tr>
  <tr>
    
  </tr>
</table>
</center>
</div>

<center>
<div id="search" style="padding-top:-100px"></div>


</center>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>