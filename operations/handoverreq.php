<?php
include("access.php");
 echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept'];
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
<script src="js/opener.js" type="text/javascript"></script>
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
function confirm_delete(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_site.php?id="+id;
	}
	
}

function approve(cnt,id,stat)
{
//alert("count="+cnt+" id="+id+" stat="+stat);
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
	{
	var st;
	if(stat=='0')
	st='Rejected';
	else
	st="Approved";
   // alert("Fund Approved");
	document.getElementById("block"+cnt).innerHTML=st;
	}
	else
	 alert("Some Error Occurred");
    }
  }
// var rem=document.getElementById("rem"+cnt).value;
  //alert("apptransferreq.php?id="+id+"&stat="+stat);
xmlhttp.open("GET","apptransferreq.php?id="+id+"&stat="+stat,true);
xmlhttp.send();
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
		  var dept=document.getElementById('dept').value;
		  var serv=document.getElementById('service').value;
		var desig=document.getElementById('desig').value;
		
			 if(a!="Loading"){
			 var id=document.getElementById('id').value;//alert(id);
			 
			 var bank=document.getElementById('bank').value;//alert(bank);
			 var city=document.getElementById('city').value;//alert(city);
			 var area=document.getElementById('area').value;//alert(area);
			 var state=document.getElementById('state').value;//alert(state);
			  var project=document.getElementById('project').value;//alert(state);
			// var pin=document.getElementById('pin').value;//alert(pin);
			var add=document.getElementById('address').value;
			 var sdate=document.getElementById('sdate').value;//alert(sdate);
			 //var edate=document.getElementById('edate').value;//alert(edate);
			  }
			////alert(document.getElementById('type').value);
			
			var url = 'srchhandoverreq.php';
			
 	
		var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank+'&desig='+desig+'&service='+serv+'&dept='+dept; 
			if(a!="Loading"){ 
			 pmeters = 'id='+id+'&cid='+cid+'&city='+city+'&state='+state+'&area='+area+'&bank='+bank+'&Page='+b+'&perpg='+ppg+'&sdate='+sdate+'&proj='+project+"&add="+add+'&desig='+desig+'&service='+serv+'&dept='+dept;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg+'&cid='+cid+'&desig='+desig+'&service='+serv+'&dept='+dept;	
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
  alert("Please Select Client");
 }
</script>
</head>

<body>
<div class="fixed">
<center>
<?php include("menubar.php");?>

<h2 class="h2color">Level 1 approval</h2>

<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />
<table  border="0" cellpadding="0" cellspacing="0">
<tr>

</tr>
<tr>

<th width="77"><input type="hidden" name="dept" id="dept" value="<?php echo $_SESSION['dept']; ?>"/>
<input type="hidden" name="service" id="service" value="<?php echo $_SESSION['serviceauth']; ?>"/>
<input type="hidden" name="desig" id="desig" value="<?php echo $_SESSION['designation']; ?>"/>
<?php
include("config.php");
	//echo $_SESSION['custid'];
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

//echo $cl;
?>
<select name="cid" id="cid" onchange="searchById('Listing','1','');"/><option value="">Select Client</option>
<?php

$cust=mysqli_query($con,$cl);
if(!$cust)
echo mysqli_error();
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
$pro="select distinct(project) from newtempsites where 1";
if($_SESSION['custid']!='all')
$pro.=" and cust_id='".$_SESSION['custid']."'";
$proj=mysqli_query($con,$pro);
while($projro=mysqli_fetch_array($proj))
{
?>
<option value="<?php echo $projro[0]; ?>"><?php echo $projro[0]; ?></option>
<?php
}
?>

</select> --></th>
<th width="75"><input type="text" size="15" name="id" id="id" onkeyup="searchById('Listing','1','');" placeholder="ATM"/><br /></th>
<th width="145"><input type="text" size="15" name="bank" id="bank" onkeyup="searchById('Listing','1','');" placeholder="Bank"/></th>

<th width="75"><input type="text" size="15" name="city" id="city" onkeyup="searchById('Listing','1','');" placeholder="City"/></th>
<th width="75"><input type="text" size="15" name="state" id="state" onkeyup="searchById('Listing','1','');" placeholder="State"/></th>
<!--<th width="75"><input type="text" size="15" name="pin" id="pin" onkeyup="searchById('Listing','1','');" placeholder="Pincode"/></th>-->
<th width="75"><input type="text" size="15" name="area" id="area" onkeyup="searchById('Listing','1','');" placeholder="CSS localbranch"/></th>
<th width="75"><input type="text" size="15" name="address" id="address" onkeyup="searchById('Listing','1','');" placeholder="Address"/></th>


<th width="75"><input type="text" name="sdate" id="sdate" onblur="searchById('Listing','1','');" onkeyup="searchById('Listing','1','');" onclick="displayDatePicker('sdate');" placeholder="Entry Date"/></th>
<!--<td width="75"><input type="text" name="edate" id="edate"  onkeyup="searchById('Listing','1');" placeholder="To Date"/></td>-->
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