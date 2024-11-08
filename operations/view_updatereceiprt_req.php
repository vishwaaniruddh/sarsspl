<?php 
	include("access.php");
	include("config.php");	
	$accmgr=0;
	if($_SESSION['designation']==8 && $_SESSION['dept']==4 && $_SESSION['serviceauth']==2)
		$accmgr=1;	
	$supv_stat=0;
	if($_SESSION['designation']==11)
		$supv_stat=1;
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--Slide down div  -->
<script src="js/jquery.min.js.js" type="text/javascript"></script>
<script src="php_calendar/scripts.js" type="text/javascript"></script>
<script type="text/javascript">
function searchById(a,b,perpg) {
	//alert(a+" "+b+" "+perpg);
	var ppg='';
	if(perpg=='')
	ppg='50';
	else
	ppg=document.getElementById(perpg).value;

//alert(ppg);
	document.getElementById("datahere").innerHTML ="<center><img src=loader.gif></center>";

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
	var atmid=document.getElementById('atmid').value;
	var reqid=document.getElementById('reqid').value;
	var sup1=document.getElementById('sup').value;
	var sdate=document.getElementById('sdate').value;
	var edate=document.getElementById('edate').value;
	
	var url = 'get_updatereceiprt_req.php';
	var pmeters="";
	if(a!="Loading"){ 
		pmeters = 'Page='+b+'&perpg='+ppg+'&reqid='+reqid+'&sup='+sup1+'&sdate='+sdate+'&edate='+edate+'&atmid='+atmid;
	}
	else
	{
		pmeters = 'Page='+b+'&perpg='+ppg+'&sup='+sup1;	
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
			document.getElementById("datahere").innerHTML = response;
		}
	}
}
function showrem(id)
{

if(document.getElementById(id).style.display=='none')
document.getElementById(id).style.display='block';
else
document.getElementById(id).style.display='none';
}

 function approve(cnt,id)
{
//alert(cnt+" "+id);
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
   // alert("Fund Approved");
	document.getElementById("app"+cnt).innerHTML='Updated';
	showrem('scnscpy'+cnt);
	}
	else
	 alert("Failed please try again.");
    }
  }
 	var rem=document.getElementById("rem"+cnt).value;
	var amt=Number(document.getElementById("amt"+cnt).value);
	var pdate=document.getElementById("pdate"+cnt).value;
	var parts =pdate.split('/');
	var mydate = new Date(parts[2],parts[1]-1,parts[0]);
	var today= new Date();
	if(rem=='' || amt=='' || pdate=='')
	{
		alert("Please provide remarks,amount,pdate.");
	}
	else if(mydate>today)
	{
		alert('Paid Date should be equal to or less than today\'s date.');
	}
	else if(mydate.getDay()==0)
	{
		alert('Paid date cannot be sunday.');
	}
	else if(amt<1)
	{
		alert('Invalid Amount.');
	}
	else
	{
		xmlhttp.open("GET","process_updatereceipt_req.php?rem="+rem+"&reqid="+id+"&amt="+amt+"&pdate="+pdate,true);
		xmlhttp.send();
	}
}
function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode;
if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
return false;
 
return true;
}
</script>
</head>

<body onload="searchById('Loading','1','');" >
<center>
<?php include("menubar.php"); ?>
<?php
	if(isset($_SESSION['success']))
	{
		if($_SESSION['success']==0)	
		{
			$result="Database problem please try again.";
		}
		else if($_SESSION['success']==1)	
		{
			$result="Request submited sucessfully.";
		}
?>
<script>
alert('<?php echo $result; ?>');
</script>
<?php
		unset($_SESSION['success']);
	}
?>
<h2>Raise Request</h2>
<table>
<?php
	$sup_str="select * from fundaccounts where 1 ";
if($_SESSION['designation']==9 && $_SESSION['branch']!="all" && $_SESSION['branch']!="")
	$sup_str.="and srno in (SELECT srno FROM `login` where branch in (".$_SESSION['branch'].")) ";
if($accmgr)
{
	$cust=array();
	$cust=explode(",",$_SESSION['custid']);
	$cl='';
	//print_r($cust);
	
	for($i=0;$i<count($cust);$i++)
	{
	//echo $cust[i]." ".$i."<br>";
	if($i==0)
	$cl="'".$cust[$i]."'";
	elseif($i==(count($cust)-1))
	$cl.=",'".$cust[$i]."'";
	else
	$cl.=",'".$cust[$i]."'";
	
	//echo $cl;
	}
	$sup_str.="and hname in (select distinct(supervisor) from ebillfundrequests where supervisor<>'-1' and supervisor<>'0' and chqno<>'0' and cust_id in (".$cl.")) ";
}
if($supv_stat)
{
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
	$sup_str.="and srno='".$srno[0]."'";
}
$sup_str.="order by hname ASC";
//echo $sup_str;
$sup=mysqli_query($con,$sup_str);
?>
<td>
<select name="sup" id="sup">
<option value="-1">Select Supervisor</option>
<?php
while($supro=mysqli_fetch_array($sup))
{
?>
<option value="<?php echo $supro[1]; ?>" <?php if($_SESSION['supv']==$supro[1]){ echo "selected"; }?> ><?php echo $supro[1]."/ ".$supro[4]; ?></option>
<?php
}
?>
</select>
</td>
	<td>Atm ID:<input type="text" name="atmid" id="atmid" placeholder="AtmID"/></td>
	<td>Request ID:<input type="text" name="reqid" id="reqid" placeholder="Request ID"/></td>
    <td>
    	<input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" readonly="readonly" placeholder="From Date"/>
		<input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');" readonly="readonly" placeholder="To Date"/>
    </td>
    <td><input type="button" name="dt" onclick="searchById('Listing','1','');" value="search" /></td>
</table>
</center>
<div id="datahere" style="margin-top:25px"></div>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>