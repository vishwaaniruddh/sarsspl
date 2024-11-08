<?php
//session_start();
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="excel.js" type="text/javascript"></script>

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
		  var dept=document.getElementById('dept').value;
		  var serv=document.getElementById('service').value;
		var desig=document.getElementById('desig').value;
		if(a!="Loading"){
			 
			var superv=document.getElementById('superv').value;
			
			  }
		
			var url = 'seachclientos.php';
	var pmeters="";
	if(a!="Loading"){ 
			 pmeters = 'Page='+b+'&perpg='+ppg+'&desig='+desig+'&service='+serv+'&dept='+dept+'&superv='+superv;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg+'&desig='+desig+'&service='+serv+'&dept='+dept;	
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
  function addamt(amt,id)
  {
 // alert(amt+" "+id);
  if(document.getElementById(id).checked==true)
  document.getElementById('seltot').value=Number(document.getElementById('seltot').value)+Number(amt);
  else
  document.getElementById('seltot').value=Number(document.getElementById('seltot').value)-Number(amt);
  }
 function approve(cnt,id,stat)
{
//alert(cnt+" "+id+" "+stat);
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
	document.getElementById("app"+cnt).innerHTML=st;
	}
	else if(xmlhttp.responseText=='0')
	 alert("Some Error Occurred");
	 else
	 alert(xmlhttp.responseText);
    }
  }
 var rem=document.getElementById("rem"+cnt).value;
 // alert(document.getElementById("arrear"+cnt).value);
 if(document.getElementById("arrear"+cnt).value=='1' && rem=='')
  {
  alert("Sorry, This is Arrear Case. Your Feedback is required");
  }
  else{
xmlhttp.open("GET","approveebfund.php?id="+id+"&stat="+stat+"&rem="+rem,true);
xmlhttp.send();}
}

 function arrearapprove(cnt,id,stat,message)
{
//alert(cnt+" "+id+" "+stat+" "+message);
//alert(tkdt);
var amt=document.getElementById("appamt"+cnt).value;
//alert(amt);
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
	document.getElementById("app"+cnt).innerHTML=st;
	}
	else if(xmlhttp.responseText=='0')
	 alert("Some Error Occurred");
	 else if(xmlhttp.responseText=='0')
	 alert("Some Error Occurred");
	 else
	 alert(xmlhttp.responseText);
    }
  }
 var rem=document.getElementById("rem"+cnt).value;
 // alert("approveebfund.php?id="+id+"&stat="+stat+"&rem="+rem);
 if(document.getElementById("arrear"+cnt).value=='1' && rem=='')
  {
  alert(message);
  }
  else{
 
  //alert("apparrear.php?id="+id+"&stat="+stat+"&rem="+rem+'&tbl=arrearstatus&amt='+amt);
xmlhttp.open("GET","apparrear.php?id="+id+"&stat="+stat+"&rem="+rem+'&tbl=arrearstatus&amt='+amt,true);
xmlhttp.send();}
}

function cancpay(cnt,id,stat)
{
//alert(cnt+" "+id+" "+stat);

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
	if(xmlhttp.responseText=='0')
	alert("sorry, Your session has Expired. Please login again and retry");
	else
	{
	
	st="Cancelled";
   // alert("Fund Approved");
   if(xmlhttp.responseText=='1')
	document.getElementById("app"+cnt).innerHTML=st;
	else
	alert(xmlhttp.responseText);
	}
	
    }
  }
 var rem=document.getElementById("rem"+cnt).value;
 // alert("approveebfund.php?id="+id+"&stat="+stat+"&rem="+rem);
 if(rem=='')
  {
  alert("Sorry Reason is required for this cancellation");
  }
  else{
 
 // alert("canctranspay.php?id="+id+"&stat="+stat+"&rem="+rem);
xmlhttp.open("GET","canctranspay.php?id="+id+"&stat="+stat+"&rem="+rem,true);
xmlhttp.send();}
}


 function financeapprove(cnt,id,stat)
{
//alert(cnt+" "+id+" "+stat);
//alert(tkdt);
var amt=document.getElementById("appamt"+cnt).value;
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
	document.getElementById("app"+cnt).innerHTML=st;
	}
	else
	 alert("Some Error Occurred");
    }
  }
 var rem=document.getElementById("rem"+cnt).value;
  //alert("approvefund.php?id="+id+"&stat="+stat+"&rem="+rem+'&amt='+amt);
  //alert("approveebfund.php?id="+id+"&stat="+stat+"&rem="+rem+'&amt='+amt);
xmlhttp.open("GET","approveebfund.php?id="+id+"&stat="+stat+"&rem="+rem+'&amt='+amt,true);
xmlhttp.send();
}

function financepayment(cnt,id,stat)
{
//alert(cnt+" "+id+" "+stat);
//alert(tkdt);
var amt=document.getElementById("appamt"+cnt).value;
var chkno=document.getElementById("chkno"+cnt).value
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
	document.getElementById("app"+cnt).innerHTML=st;
	}
	else
	 alert("Some Error Occurred");
    }
  }
 var rem=document.getElementById("rem"+cnt).value;
 //alert("approvefund.php?id="+id+"&stat="+stat+"&rem="+rem+'&amt='+amt+"&chk="+chkno);
xmlhttp.open("GET","approveebfund.php?id="+id+"&stat="+stat+"&rem="+rem+'&amt='+amt+"&chk="+chkno,true);
xmlhttp.send();
}

function showrem(id)
{
if(document.getElementById(id).style.display=='none')
document.getElementById(id).style.display='block';
else
document.getElementById(id).style.display='none';
}
function newwin(url,winname,w,h)
{
//alert("hi");
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (url, winname, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=1, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  //mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
 }
</script>
</head>

<body onload="searchById('Listing','1','');" >

<center>
<?php include("menubar.php");
include('config.php');
 ?>

<h2 class="h2color">Customer Outstanding</h2>


<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />
<table  border="0" cellpadding="0" cellspacing="0">

<tr>
<th >

<input type="hidden" name="dept" id="dept" value="<?php echo $_SESSION['dept']; ?>"/>
<input type="hidden" name="service" id="service" value="<?php echo $_SESSION['serviceauth']; ?>"/>
<input type="hidden" name="desig" id="desig" value="<?php echo $_SESSION['designation']; ?>"/>

 <?php
$clnt=mysqli_query($con,"select short_name,contact_first from contacts where type='c' order by contact_first ASC");

?>
<select name="superv" id="superv"><option value="">Client</option>
<?php
while($clntr=mysqli_fetch_array($clnt))
{
?>
<option value="<?php echo $clntr[0]; ?>"><?php echo $clntr[1]; ?></option>
<?php
}
?>
</select>
</th>

<th><input type="button" name="dt" onclick="searchById('Listing','1','');" value="search" /></td>
</tr>
</table>
</center>




<center>
<div id="search" style="padding-top:-100px;"></div>

</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>