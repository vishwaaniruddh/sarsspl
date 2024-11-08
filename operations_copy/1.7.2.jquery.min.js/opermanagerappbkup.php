<?php
include("access.php");
include('config.php');
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
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
<script src="js/ajaxfileupload.js" type="text/javascript"></script>
<script type="text/javascript">
function savepic(takeoverdt,fileid)
{
alert(takeoverdt+" "+fileid)
//can perform client side field required checking for "fileToUpload" field
$.ajaxFileUpload
(
{
url:'doajaxfileupload.php',
secureuri:false,
fileElementId:fileid,
dataType: 'json',
success: function (data, status)
{
if(typeof(data.error) != 'undefined')
{
if(data.error != '')
{
alert(data.error);
}else
{
alert(msg); // returns location of uploaded file
}
}
},
error: function (data, status, e)
{
alert(e);
}
}
)
return false;
}
function app(div,id,stat)
{
if (confirm("Are you sure you want to approve this site?"))
	{

//alert(tkdt);
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	
	//alert(xmlhttp.responseText);
	if(xmlhttp.responseText=='1')
    document.getElementById(div).innerHTML="approved";
	else
	 document.getElementById(div).innerHTML="Some Error Occured";
    }
  }
 //alert("approvelevel2.php?id="+id);
  //alert("uploadaggrement.php?tkdt="+tkdt+"field=takeover_date&id="+id);
xmlhttp.open("GET","approvelevel2.php?id="+id+"&stat="+stat,true);
xmlhttp.send();
}
}
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
var cid=document.getElementById('cid').value;//alert(cid);
		if(cid!='')
		{
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
		 
		
			 if(a!="Loading"){
			 var id=document.getElementById('id').value;//alert(id);
			  var proj=document.getElementById('project').value;
			 var bank=document.getElementById('bank').value;//alert(bank);
			 var city=document.getElementById('city').value;//alert(city);
			 var area=document.getElementById('area').value;//alert(area);
			 var state=document.getElementById('state').value;//alert(state);
			// var pin=document.getElementById('pin').value;//alert(pin);
			 var sdate=document.getElementById('sdate').value;//alert(sdate);
			 var edate=document.getElementById('edate').value;//alert(edate);
			  }
			////alert(document.getElementById('type').value);
			
			var url = 'searchopermanagerapp.php';
			
 	
		var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'id='+id+'&cid='+cid+'&city='+city+'&state='+state+'&area='+area+'&bank='+bank+'&Page='+b+'&perpg='+ppg+'&dt='+sdate+'&proj='+proj+'&dt2='+edate;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg+'&cid='+cid;	
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
  else
  alert("PLease Select Client First");
  }
 
</script>
</head>

<body>
<div class="fixed">
<center>
<?php include("menubar.php"); ?>

<h2> Level 1 approval</h2>

<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />
<table  border="0" cellpadding="0" cellspacing="0">
<tr>

</tr>
<tr>

<th width="77"><?php //echo "select distinct(cust_id),cust_name from newtempsites order by cust_name ASC"; ?>
<select name="cid" id="cid" onchange="searchById('Listing','1','');"/><option value="">Select Client</option>
<?php
include("config.php");
//	echo $_SESSION['custid'];
$cust=explode(",",$_SESSION['custid']);
$cl1='';
for($i=0;$i<count($cust);$i++)
{

if($i==0)
$cl1="'".$cust[$i]."'";
elseif($i==(count($i)-1))
$cl1.=",'".$cust[$i]."'";
else
$cl1.=",'".$cust[$i]."'";

}
$cl="select distinct(cust_id),cust_name from newtempsites where 1";
if($_SESSION['custid']!='all')
$cl.=" and cust_id in ($cl1)";

$cl.= " order by cust_name ASC";

echo $cl;
?>
<?php

$cust=mysqli_query($con,"select distinct(cust_id),cust_name from newtempsites where cust_id<>'' order by cust_name ASC");
while($custro=mysqli_fetch_array($cust))
{
?>
<option value="<?php echo $custro[0]; ?>"><?php echo $custro[1]; ?></option>
<?php
}
  ?>
</select>
</th>
<th > 
<input type="text" size="15" name="project" id="project" onkeyup="searchById('Listing','1','');" placeholder="Project ID"/>
<!--<select  name="project" id="project" onchange="searchById('Listing','1','');"><option value="">Select Project</option>
<?php
$proj=mysqli_query($con,"select distinct(project) from newtempsites where active='1'");

while($projro=mysqli_fetch_array($proj))
{
?>
<option value="<?php echo $projro[0]; ?>"><?php echo $projro[0]; ?></option>
<?php
}
?>

</select>--> </th>
<th width="75"><input type="text" size="15" name="id" id="id" onkeyup="searchById('Listing','1','');" placeholder="ATM"/><br /></th>
<th width="145"><input type="text" size="15" name="bank" id="bank" onkeyup="searchById('Listing','1','');" placeholder="Bank"/></th>

<th width="75"><input type="text" size="15" name="city" id="city" onkeyup="searchById('Listing','1','');" placeholder="City"/></th>
<th width="75"><input type="text" size="15" name="state" id="state" onkeyup="searchById('Listing','1','');" placeholder="State"/></th>
<!--<th width="75"><input type="text" size="15" name="pin" id="pin" onkeyup="searchById('Listing','1','');" placeholder="Pincode"/></th>-->
<th width="75"><input type="text" size="15" name="area" id="area" onkeyup="searchById('Listing','1','');" placeholder="Address"/></th>



<th width="75"><input type="text" size="10" name="sdate" id="sdate" onkeyup="searchById('Listing','1','');" onclick="displayDatePicker('sdate');" placeholder="From Date"/></th>
<th width="75"><input type="text" size="10" name="edate" id="edate" onclick="displayDatePicker('edate');"  placeholder="To Date"/></th>
<th width="75"><input type="button" name="but" onclick="searchById('Listing','1','');" value="search"/></th>
</tr>
</table>
</center>
</div>



<center>
<div id="search" align="left"></div>

</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>