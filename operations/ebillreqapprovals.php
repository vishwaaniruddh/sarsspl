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
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
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
function searchById(a,b,perpg) { debugger;
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='50';
else
ppg=document.getElementById(perpg).value;

//alert(ppg);
//document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";

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
		var sv=document.getElementById('sv').value;
			var cid=document.getElementById('cid').value;//alert(cid);
			 if(a!="Loading"){
			  var atm=document.getElementById('atm').value;//alert(atm);
			 var pstat=document.getElementById('pstat').value;
			 var sdate=document.getElementById('sdate').value;//alert(sdate);
			var edate=document.getElementById('edate').value;//alert(edate);
			var app=document.getElementById('appby').value;
			  }
		
			var url = 'viewebfundlevel1.php';
	var pmeters="";
	if(a!="Loading"){ 
			 pmeters = 'cid='+cid+'&Page='+b+'&perpg='+ppg+'&sdate='+sdate+'&edate='+edate+'&desig='+desig+'&service='+serv+'&dept='+dept+'&pstat='+pstat+'&atm='+atm+'&sv='+sv+'&app='+app;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg+'&desig='+desig+'&service='+serv+'&dept='+dept+'&sv='+sv;	
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
  //alert("approveebfund.php?id="+id+"&stat="+stat+"&rem="+rem);
  //alert("hi");
  //alert(document.getElementById("arrear"+cnt).value);
  if(document.getElementById("arrear"+cnt).value=='1' && rem=='')
  {
  alert("Sorry, This is Arrear Case. Your Feedback is required");
  }
  else{
xmlhttp.open("GET","approveebfund.php?id="+id+"&stat="+stat+"&rem="+rem,true);
xmlhttp.send();}
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
//var pos = $('#'+id).offset();
//alert(pos.);
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (url, winname, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=1, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  //mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
 }
 
 function approve1(cnt,id)
{
	var stat;
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
	
	var rem=document.getElementById("remarks_"+cnt).value;
	if(rem=='')
	{
		alert("Remark is required");
	}
	else
	{
		if(document.getElementById("count_"+cnt).value=='0')
		{
			alert("Please select atleast one point.");
		}
		else
		{
			stat=document.getElementById("stat_"+cnt).value;
			//alert(stat);
			var amount=document.getElementById("amount_"+cnt).value;
			var rem=document.getElementById("remarks_"+cnt).value;
			var totreason=Number(document.getElementById("totreason_"+cnt).value);
			var reason="";
			for(i=0;i<totreason;i++)
			{
				if(document.getElementById("reason_"+cnt+"_"+i).checked)
				{
					if(i==0)
						reason+=document.getElementById("reason_"+cnt+"_"+i).value;
					else
						reason+=","+document.getElementById("reason_"+cnt+"_"+i).value;
				}
			}
			//alert(id+stat+rem+reason);
			var url="approveebfund.php";
			//alert("id="+id+"&stat="+stat+"&rem="+rem+"&reasons="+reason+"&amount="+amount);
			var pmeters="id="+id+"&stat="+stat+"&rem="+rem+"&reasons="+reason+"&amount="+amount;
			HttPRequest.open('POST',url,true);
	
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
			
			HttPRequest.onreadystatechange = function()
			{
				if(HttPRequest.readyState == 4) // Return Request
				{
					if(HttPRequest.responseText=='1')
					{
						var st;
						if(stat=='0')
						st='Rejected';
						else
						st="Approved";
						// alert("Fund Approved");
						document.getElementById("app"+cnt).innerHTML=st;
						document.getElementById("app"+(cnt-2)).scrollIntoView();
					}
					else
						//alert(HttPRequest.responseText);
						document.getElementById("app"+cnt).innerHTML=HttPRequest.responseText;
						//alert("Some Error Occurred");
				}
			}
		}
	}
}
 function getPoints(count,stat)
{
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
	var url = 'getpoints_ebillreqapprovals.php';
	var pmeters="";
	var pointof="";
	var dept=document.getElementById('dept').value;
	var service=document.getElementById('service').value;
	var desig=document.getElementById('desig').value;
	if(document.getElementById('approve_'+count).checked) {
		document.getElementById('count_'+count).value=0;
		pointof="approve";
	}else if(document.getElementById('reject_'+count).checked) {
		document.getElementById('count_'+count).value=0;
		pointof="reject";
	}
	document.getElementById('stat_'+count).value=stat;
	pmeters = 'pointof='+pointof+'&desig='+desig+'&service='+service+'&dept='+dept+'&count='+count;
	HttPRequest.open('POST',url,true);

	HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	HttPRequest.setRequestHeader("Content-length", pmeters.length);
	HttPRequest.setRequestHeader("Connection", "close");
	HttPRequest.send(pmeters);
	HttPRequest.onreadystatechange = function()
	{

		 if(HttPRequest.readyState == 4) // Return Request
		  {
				var response = HttPRequest.responseText; 
				//alert(response);
				document.getElementById("points_"+count).innerHTML = response;
		  }
	}
}
function reasonCheck(rid,count)
{
	if(document.getElementById(rid).checked)
	{
		var cnt=Number(document.getElementById("count_"+count).value);
		document.getElementById("count_"+count).value=(cnt+1);
	}
	else
	{
		var cnt=Number(document.getElementById("count_"+count).value);
		document.getElementById("count_"+count).value=(cnt-1);
	}
}
function scrollto(count)
{
	$('html, body').animate({ scrollTop: $('#app'+(count-2)).offset().top }, 'fast');
}
</script>
<style>
	html, body {margin:0;padding:0;height:100%;}
	.ontop {
		z-index: 999;
		width: 140%;
		height:100%;
		top: 0;
		left: 0;
		display: none;
		position: absolute;				
		background-color: #000;
		color: #000;
		opacity: 0.9;
		filter: alpha(opacity = 50);
	}
	.popup {
		width: 300px;
		height: 200px;
		position: absolute;
		color: #000;
		opacity: 0.9;
		//background-color: #ffffff;
		/* To align popup window at the center of screen*/
		top: 25%;
		left: 50%;
	}
</style>
<script type="text/javascript">
	function pop(div) {
		document.getElementById(div).style.display = 'block';
	}
	function hide(div) {
		document.getElementById(div).style.display = 'none';
	}
	//To detect escape button
	document.onkeydown = function(evt) {
		evt = evt || window.event;
		if (evt.keyCode == 27) {
			hide('popDiv');
		}
	};
</script>

</head>

<body onload="searchById('Listing','1','');" >

<center>
<?php include("menubar.php"); ?>

<h2 class="h2color">Fund Transfer Request</h2>


<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />
<table  border="0" cellpadding="0" cellspacing="0">

<tr>
<th >

<input type="hidden" name="dept" id="dept" value="<?php echo $_SESSION['dept']; ?>"/>
<input type="hidden" name="service" id="service" value="<?php echo $_SESSION['serviceauth']; ?>"/>
<input type="hidden" name="desig" id="desig" value="<?php echo $_SESSION['designation']; ?>"/>
<?php 
include("config.php");

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
$sql2="select distinct `cust_id` from ebillfundrequests where 1";
if(strcasecmp($_SESSION['custid'],"all")!=0 && $_SESSION['custid']!='')
{
if($_SESSION['designation']!="11")
$sql2.=" and `cust_id` in (".$cl.")";
else
{
$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$srro=mysqli_fetch_row($sr);
$sql2.=" and (`reqby` in (".$srro[0].") or supervisor ='".$_SESSION['user']."')";
}

}

$sql="select `short_name`,`contact_first` from contacts where `type`='c' and `short_name` in ($sql2) order by contact_first";
//$sql="select `short_name`,`contact_first` from contacts where `type`='c' order by contact_first ASC";
//echo $sql;
$qry=mysqli_query($con,$sql);
//$qry=mysqli_query($con,"Select short_name,contact_first from contacts where type='c' and short_name='".$_SESSION['custid']."'");

 ?>
 <select  name="cid" id="cid" onchange="searchById('Listing','1','');">
 <?php
 	if($_SESSION['designation']==8 && $_SESSION['dept']==4 && $_SESSION['serviceauth']==2)
 	{}
 	else{
 ?>
<option value="-1">All Client</option>
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

<option value="">Pending</option>
<option value="8">Paid</option>
<option value="0">Rejected</option>
</select>
</th>

<th width="75" valign="top">
<select name="appby" id="appby">

<option value="">Approved by</option>
<?php if($_SESSION['designation']=='2'){ ?><option value="arrear">Arrear Approval</option><?php } ?>
<?php
$app=mysqli_query($con,"select description,statuslevel from designation where statuslevel<>0 order by statuslevel DESC");
while($appr=mysqli_fetch_array($app))
{
?>
<option value="<?php echo $appr[1]; ?>"><?php echo $appr[0]; ?></option>
<?php
}
?>
</select>

</th>
<?php
//echo $_SESSION['user'];
if($_SESSION['designation']!="11")
{
?>
<th>
<select name="sv" id="sv" onChange="searchById('Listing','1','');"><option value="">Select</option>
   <?php
 //  $sup=mysqli_query($con,"select username from login where designation='11' and serviceauth='3' and deptid='4' order by username ASC");
// $sup=mysqli_query($con,"select distinct(hname) from fundaccounts order by hname ASC");
 $sup_str="select distinct(hname)  from fundaccounts where 1 ";
if($_SESSION['designation']==9 && $_SESSION['branch']!="all" && $_SESSION['branch']!="")
	$sup_str.="and srno in (SELECT srno FROM `login` where branch in (".$_SESSION['branch']."))";
$sup_str.="order by hname ASC";
 $sup=mysqli_query($con,$sup_str);
	 while($supro=mysqli_fetch_array($sup))
	{ ?>
	   <option value="<?php echo $supro[0]; ?>" <?php if(($_SESSION['user']==$supro[0])){ echo "selected";}  ?> ><?php echo $supro[0]; ?></option>
   <?php } ?>  
    </select>
</th>
<?php
}
else
{
?>
<th style="display:none;">
<select name="sv" id="sv" onChange="searchById('Listing','1','');"><option value="">Select</option>
   <?php
 //  $sup=mysqli_query($con,"select username from login where designation='11' and serviceauth='3' and deptid='4' order by username ASC");
// $sup=mysqli_query($con,"select distinct(hname) from fundaccounts order by hname ASC");
 $sup_str="select distinct(hname)  from fundaccounts where 1 ";
if($_SESSION['designation']==9 && $_SESSION['branch']!="all" && $_SESSION['branch']!="")
	$sup_str.="and srno in (SELECT srno FROM `login` where branch in (".$_SESSION['branch']."))";
$sup_str.="order by hname ASC";
 $sup=mysqli_query($con,$sup_str);
	 while($supro=mysqli_fetch_array($sup))
	{ ?>
	   <option value="<?php echo $supro[0]; ?>" <?php if(($_SESSION['user']==$supro[0])){ echo "selected";}  ?> ><?php echo $supro[0]; ?></option>
   <?php } ?>  
    </select>
</th>
<?php
}
?>
<th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" readonly="readonly" placeholder="From Date"/></th>
<th width="75"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');" readonly="readonly" placeholder="To Date"/></th>
<th width="75"><input type="text" name="atm" onkeyup="searchById('Listing','1','');" id="atm"  placeholder="ATM ID"/></th>
<th><input type="button" name="dt" onclick="searchById('Listing','1','');" value="search" /></td>
</tr>
</table>
</center>




<center>
<div id="search"></div>

</center>

<script type="text/javascript" src="script.js"></script>
</body>
</html>