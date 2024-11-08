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
function searchById(a,b,perpg) 
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
		var urgency=document.getElementById('urgency').value;
		 var opts = document.getElementById('urgency').options;
    var i = 0, len = opts.length, a = [];
    for (i; i<len; i++) {
if(opts[i].selected==true)
        a.push(opts[i].value);
    }
    var urg = a.join(',');
//alert(bk);
		//alert(urgency);
			var cid=document.getElementById('cid').value;//alert(cid);
			 if(a!="Loading"){
			  var atm=document.getElementById('atm').value;//alert(atm);
			  var reqid=document.getElementById('reqid').value;
			 var pstat=document.getElementById('pstat').value;
			 var sdate=document.getElementById('sdate').value;//alert(sdate);
			var edate=document.getElementById('edate').value;//alert(edate);
			var superv=document.getElementById('superv').value;
			var app=document.getElementById('appby').value;
			var acc=document.getElementById('acctype').value;
			//alert(superv);
			  }
		
			var url = 'viewebfundlevel1.php';
	var pmeters="";
	if(a!="Loading"){ 
			 pmeters = 'cid='+cid+'&Page='+b+'&perpg='+ppg+'&sdate='+sdate+'&edate='+edate+'&desig='+desig+'&service='+serv+'&dept='+dept+'&pstat='+pstat+'&atm='+atm+'&superv='+superv+"&app="+app+"&urgen="+urgency+"&urg="+urg+"&actype="+acc+"&reqid="+reqid;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg+'&desig='+desig+'&service='+serv+'&dept='+dept+"&urgen="+urgency;	
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
var status="Approve";
if(stat==0)
status="Reject";
//alert(cnt+" "+id+" "+stat);
//alert(tkdt);
var answer=true;
if(stat==0)
var answer = confirm ("Do you really want to "+status+" this entry?");

if (answer)
{
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
}

 function arrearapprove(cnt,id,stat,message)
{
var status="Approve";
if(stat==0)
status="Reject";
//alert(cnt+" "+id+" "+stat);
//alert(tkdt);
var answer=true;
if(stat==0)
answer = confirm ("Do you really want to "+status+" this entry?");

if (answer)
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
}

function cancpay(cnt,id,stat)
{
//alert(cnt+" "+id+" "+stat);
var status="Approve";
if(stat==0)
status="Reject";
//alert(cnt+" "+id+" "+stat);
//alert(tkdt);
var answer=true;
if(stat==0)
answer = confirm ("Do you really want to "+status+" this entry?");

if (answer)
{
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
}

 function financeapprove(cnt,id,stat)
{
//alert(cnt+" "+id+" "+stat);
//alert(tkdt);
var status="Approve";
if(stat==0)
status="Reject";

var answer=true;
if(stat==0)
answer = confirm ("Do you really want to "+status+" this entry?");
var sup="";
if(answer){
var amt=document.getElementById("appamt"+cnt).value;
if(stat==7)
sup=document.getElementById("sv"+cnt).value;

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
xmlhttp.open("GET","approveebfund.php?id="+id+"&stat="+stat+"&rem="+rem+'&amount='+amt+'&sup='+sup,true);
xmlhttp.send();
}
}

function financepayment(cnt,id,stat)
{
//alert(cnt+" "+id+" "+stat);
//alert(tkdt);
var status="Approve";
if(stat==0)
status="Reject";
//alert(cnt+" "+id+" "+stat);
//alert(tkdt);
var answer = confirm ("Do you really want to "+status+" this entry?");
if(answer){
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
	if(document.getElementById("arrear"+cnt).value=='1' && rem=='')
	{
		alert("Sorry, This is Arrear Case. Your Feedback is required");
	}
	else if(rem=='')
	{
		alert("Remark is required.");
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
			var status="Approve";
			if(stat==0)
			status="Reject";
			//alert(cnt+" "+id+" "+stat);
			//alert(tkdt);
			if(confirm ("Do you really want to "+status+" this entry?"))
			{
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
							//document.getElementById("app"+cnt).innerHTML=HttPRequest.responseText;
							alert("Some Error Occurred");
					}
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
<?php
if($_SESSION['designation']=="1" && $_SESSION['serviceauth']=="1" && $_SESSION['dept']=="1")
{
?>
function chckmastapp(id)
{
	if(document.getElementById(id).checked)
	{
		var cnt=Number(document.getElementById("chcktot").value);
		document.getElementById("chcktot").value=(cnt+1);
	}
	else
	{
		var cnt=Number(document.getElementById("chcktot").value);
		document.getElementById("chcktot").value=(cnt-1);
	}
	var cnt1=Number(document.getElementById("chcktot").value);
	if(cnt1>0)
	{
		document.getElementById("mast_sub").disabled=false;
	}
	else
	{
		document.getElementById("mast_sub").disabled=true;
	}
}
function typealert()
{
	if(document.getElementById("rej_stat").checked==true)
	{
		if(confirm("Are you sure you want to Reject these request"))
		return true;
		else
		return false;
	}
	return true;
}
<?php
}
?>
function scrollto(count)
{
	$('html, body').animate({ scrollTop: $('#app'+(count-2)).offset().top }, 'fast');
}
</script>
		<style>
			.ontop {
				z-index: 999;
				width: 115%;
				height: 110%;
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
				background-color: #ffffff;
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

<?php
	if(isset($_SESSION['success']))
	{
		if($_SESSION['success']==0)	
		{
			$result="Problem please try again.";
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

<h2 class="h2color">EBILL Fund Request</h2>


<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />
<table  border="0" cellpadding="0" cellspacing="0">

<tr>
<th valign="top">

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
if($_SESSION['custid']!='all')
{
if($_SESSION['designation']!="11")
$sql2.=" and `cust_id` in (".$cl.")";
else
{
$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$srro=mysqli_fetch_row($sr);
$sql2.=" and `reqby` in (".$srro[0].")";
}

}

$sql="select `short_name`,`contact_first` from contacts where `type`='c' and `short_name` in ($sql2) order by contact_first ASC ";
//$sql="select `short_name`,`contact_first` from contacts where `type`='c' order by contact_first ASC ";
//echo $sql;
$qry=mysqli_query($con,$sql);
//$qry=mysqli_query($con,"Select short_name,contact_first from contacts where type='c' and short_name='".$_SESSION['custid']."'");

 ?>
 <select  name="cid" id="cid"><option value="">All</option>

<?php
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php
}
?>
</select> </th>
<th width="75" valign="top">
<select name="pstat" id="pstat">

<option value="">Pending</option>
<option value="8">Paid</option>
<option value="0">Rejected</option>
</select>

</th>
<th width="75" valign="top">
<select name="urgency[]" id="urgency" multiple>

     <option value="Disconnection" selected >Disconnection</option>
     <option value="Very Urgent" >Very Urgent</option>     
     <!--<option value="All" >All</option>-->
     <option value="Normal" >Normal</option>
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
<th valign="top">
<?php
$sup=mysqli_query($con,"select distinct(supervisor) from ebillfundrequests where supervisor<>'-1' and chqno<>'0' order by supervisor ASC");

?>
<select name="superv" id="superv"><option value="">Supervisor</option>
<?php
while($supr=mysqli_fetch_array($sup))
{
?>
<option value="<?php echo $supr[0]; ?>"><?php echo $supr[0]; ?></option>
<?php
}
?>
</select>
</th>

<th valign="top">
<?php
$acctp=mysqli_query($con,"select distinct(type) from fundaccounts order by type ASC");

?>
<select name="acctype" id="acctype"><option value="">Account type</option>
<?php
while($accro=mysqli_fetch_array($acctp))
{
?>
<option value="<?php echo $accro[0]; ?>"><?php echo $accro[0]; ?></option>
<?php
}
?>
</select>
</th>
<th width="75" valign="top"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" readonly="readonly" placeholder="From Date"/></th>
<th width="75" valign="top"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');" readonly="readonly" placeholder="To Date"/></th>
<th width="75" valign="top"><textarea name="atm" id="atm" placeholder="ATM ID" rows="1"></textarea>
<textarea name="reqid" id="reqid" placeholder="REQ ID" rows="1"></textarea></th>
<th valign="top"><input type="button" name="dt" onclick="searchById('Listing','1','');" value="search" /></td>
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