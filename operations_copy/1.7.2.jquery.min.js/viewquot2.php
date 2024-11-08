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
		  var dept=document.getElementById('dept').value;
		  var serv=document.getElementById('service').value;
		var desig=document.getElementById('desig').value;
		var br=document.getElementById('br').value;
		var sup=document.getElementById('sup').value;
			var cid=document.getElementById('cid').value;//alert(cid);
			 if(a!="Loading"){
			 var pstat=document.getElementById('pstat').value;
			 var sdate=document.getElementById('sdate').value;//alert(sdate);
			var edate=document.getElementById('edate').value;//alert(edate);
			var atmid=document.getElementById('atmid').value;
			var app=escape(document.getElementById('appby').value);
			var qtype=escape(document.getElementById('qtype').value);
			  }
		
			var url = 'searchquot.php';
	var pmeters="";
	if(a!="Loading"){ 
			 pmeters = 'cid='+cid+'&Page='+b+'&perpg='+ppg+'&sdate='+sdate+'&edate='+edate+'&desig='+desig+'&service='+serv+'&dept='+dept+'&pstat='+pstat+"&br="+br+"&atmid="+atmid+"&app="+app+"&sup="+sup+"&qtype="+qtype;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg+'&desig='+desig+'&service='+serv+'&dept='+dept+"&br="+br+"&sup="+sup+"&qtype="+qtype;	
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
	else
	 alert("Some Error Occurred");
    }
  }
 var rem=document.getElementById("rem"+cnt).value;
  //alert("approvequot.php?id="+id+"&stat="+stat+"&rem="+rem);
xmlhttp.open("GET","approvequot.php?id="+id+"&stat="+stat+"&rem="+rem,true);
xmlhttp.send();
}
function sendtobill(id)
{
alert(id);

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
	
alert(xmlhttp.responseText);
	if(xmlhttp.responseText=='1')
	{
	alert("Sorry your session has Expired. Please login again continue");
	
	}
	else if(xmlhttp.responseText=='4')
	 alert("Some Error Occurred");
	 else if(xmlhttp.responseText=='2')
	 document.getElementById("bill"+id).innerHTML="Sended for Billing";
    }
  }
 
xmlhttp.open("GET","sendtornmbill.php?id="+id,true);
xmlhttp.send();
}

 function financeapprove(cnt,id,stat)
{
//alert(cnt+" "+id+" "+stat);
//alert(tkdt);
var amt=document.getElementById("appamt"+cnt).value
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
xmlhttp.open("GET","approvequot.php?id="+id+"&stat="+stat+"&rem="+rem+'&amt='+amt,true);
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
 // alert("approvefund.php?id="+id+"&stat="+stat+"&rem="+rem+'&amt='+amt+"&chk="+chkno);
xmlhttp.open("GET","approvequot.php?id="+id+"&stat="+stat+"&rem="+rem+'&amt='+amt+"&chk="+chkno,true);
xmlhttp.send();
}
function showrem(id)
{
if(document.getElementById(id).style.display=='none')
document.getElementById(id).style.display='block';
else
document.getElementById(id).style.display='none';
}
function newwin(url,winname)
{
//alert("hi");
  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
 }
</script>
</head>

<body onload="searchById('Listing','1','');" >
<div class="">
<center>
<?php  include("menubar.php"); ?>

<h2 class="h2color">Quotation request</h2>

<!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />-->
<table  border="0" cellpadding="0" cellspacing="0">

<tr>
<th >
<input type="hidden" name="br" id="br" value="<?php echo $_SESSION['branch']; ?>" readonly/>
<input type="hidden" name="dept" id="dept" value="<?php echo $_SESSION['dept']; ?>" readonly/>
<input type="hidden" name="service" id="service" value="<?php echo $_SESSION['serviceauth']; ?>" readonly/>
<input type="hidden" name="desig" id="desig" value="<?php echo $_SESSION['designation']; ?>" readonly/>
<?php 
include("config.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept']." ".$_SESSION['serviceauth']." ".$_SESSION['custid'];
//echo "cust id ".$_SESSION['custid'];
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
//echo $cl;
//echo $_SESSION['user']." ".$_SESSION['custid'];
$sql2="select distinct `cust_id` from quotation where 1";
if($_SESSION['custid']!='all')
$sql2.=" and `cust_id` in (".$cl.")";
else
{
$locarr=array();
$loc=mysqli_query($con,"select location from cssbranch where id in (".$_SESSION['branch'].")");
while($locr=mysqli_fetch_array($loc))
{
$locarr[]=$locr[0];
}
$lo=implode(",",$locarr);
$lo=str_replace(",","','",$lo);
$lo="'".$lo."'";
$sql2.=" and csslocalbranch in ($lo) ";

}

//echo $sql2;
$sql="select `short_name`,`contact_first` from contacts where `type`='c' ";
if($_SESSION['custid']!='all')
$sql.=" and `short_name` in ($sql2)";
//echo $sql;
$qry=mysqli_query($con,$sql);
//$qry=mysqli_query($con,"Select short_name,contact_first from contacts where type='c' and short_name='".$_SESSION['custid']."'");

 ?>
 <select  name="cid" id="cid" onchange="searchById('Listing','1','');">

<?php
if($_SESSION['custid']=='all')
{
?>
<option value="">All</option>
<?php
}
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php
}
?>
</select> </th>
<th width="75">
<select name="pstat" id="pstat" onChange="searchById('Listing','1','');">

<option value="-1">Pending</option>
<option value="8">Paid</option>
<option value="0">Rejected</option>
</select>
</th>
<th width="75">
<select name="qtype" id="qtype" onChange="searchById('Listing','1','');">
<option value="">Quote Type</option>
<option value="fixed">Fixed Cost</option>
<option value="R&M">Approval Basis</option>
</select>
</th>
<th width="75">
<?php 
//echo $_SESSION['designation'];
$supervisor="select distinct(supervisor) from quotation where 1";
if($_SESSION['designation']!='8')
$supervisor.=" and supervisor='".$_SESSION['user']."'";
if($_SESSION['custid']!='all'){
$supervisor.=" and cust_id in ($cl)";

}
//echo $supervisor;
$sup=mysqli_query($con,$supervisor); ?>
<select name="sup" id="sup" onChange="searchById('Listing','1','');">
<?php if($_SESSION['designation']!='11'){ ?>
<option value="-1">Supervisor</option>
<?php
}
while($supro=mysqli_fetch_array($sup))
{
?>
<option value="<?php echo $supro[0]; ?>"><?php echo $supro[0]; ?></option>
<?php
}
?>
</select>
</th>
<th width="75" valign="top">
<select name="appby" id="appby" onChange="searchById('Listing','1','');">

<option value="">Approved by</option>
<option value="100">waiting for Approval</option>
<?php
$app=mysqli_query($con,"select description,statuslevel,id from designation where statuslevel<>0 and statuslevel<>5 order by statuslevel ASC");
while($appr=mysqli_fetch_array($app))
{
?>
<option value="<?php echo $appr[1]; ?>" ><?php echo $appr[0]; ?></option>
<?php
}
?>
</select>

</th>
<th width="75"><input type="text" name="atmid" id="atmid" placeholder="AtmID" onkeyup"searchById('Listing','1','');"/></th>
<th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" readonly="readonly" placeholder="From Date"/></th>
<th width="75"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');" readonly="readonly" placeholder="To Date"/></th>
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