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

		//var urgency=document.getElementById('urgency').value;

		/*alert(document.getElementById('urgency').options.length);

		for(i=0;i<count(document.getElementById('urgency').options.length);i++){

		if(document.getElementById('urgency').option[i].selected==true)

		{

		alert(document.getElementById('urgency').option[i].value);

		if(i==0)

		 urgency=document.getElementById('urgency').option[i].value;

		else

		 urgency=urgency+','+document.getElementById('urgency').options[i].value;

		}

		

		}*/

		//alert(urgency);

			var cid=document.getElementById('cid').value;//alert(cid);

			 if(a!="Loading"){

			  var atm=document.getElementById('atm').value;//alert(atm);

			 var pstat=document.getElementById('pstat').value;

			 var sdate=document.getElementById('sdate').value;//alert(sdate);

			var edate=document.getElementById('edate').value;//alert(edate);

			//var superv=document.getElementById('superv').value;

			var app=document.getElementById('appby').value;

			//alert(superv);

			  }

		

			var url = 'searchiniebfund.php';

	var pmeters="";

	if(a!="Loading"){ 

			 pmeters = 'cid='+cid+'&Page='+b+'&perpg='+ppg+'&sdate='+sdate+'&edate='+edate+'&desig='+desig+'&service='+serv+'&dept='+dept+'&pstat='+pstat+'&atm='+atm+"&app="+app;

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

    mysqli_
mysqli_
  }

 var rem=document.getElementById("rem"+cnt).value;

 // alert("approveebfund.php?id="+id+"&stat="+stat+"&rem="+rem);

 if(document.getElementById("arrear"+cnt).value=='1' && rem=='')

  {mysqli_
mysqli_
  alert(message);

  }

  else{
mysqli_
 

  //alert("apparrear.php?id="+id+"&stat="+stat+"&rem="+rem+'&tbl=arrearstatus&amt='+amt);

xmlhttp.open("GET","apparrear.php?id="+id+"&stat="+stat+"&rem="+rem+'&tbl=arrearstatus&amt='+amt,true);

xmlhttp.send();}

}



function cancpay(cnt,id,stat)

{

//alert(cnt+" "+id+" "+stat);



var xmlhttp;

if (wmysqli_XMLHttpRequest)
mysqli_
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

xmlhttp.open("GET","approveiniebfund.php?id="+id+"&stat="+stat+"&rem="+rem+'&amt='+amt,true);

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

function newwin(url,winname)

{

//alert("hi");

  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");

  

 }

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

if($_SESSION['custid']!='all')

{

if($_SESSION['designation']!="11")

$sql2.=" and `cust_id` in (".$cl.")";

else

{

$sr=mysql_query("select srno from login where username='".$_SESSION['user']."'");

$srro=mysql_fetch_row($sr);

$sql2.=" and `reqby` in (".$srro[0].")";

}



}



$sql="select `short_name`,`contact_first` from contacts where `type`='c' and `short_name` in ($sql2) order by contact_first ASC ";

//$sql="select `short_name`,`contact_first` from contacts where `type`='c' order by contact_first ASC ";

//echo $sql;

$qry=mysql_query($sql);

//$qry=mysql_query("Select short_name,contact_first from contacts where type='c' and short_name='".$_SESSION['custid']."'");



 ?>

 <select  name="cid" id="cid"><option value="">All</option>



<?php

while($clro=mysql_fetch_row($qry))

{

?>

<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>

<?php

}

?>

</select> </th>

<th width="75">

<select name="pstat" id="pstat">



<option value="">Pending</option>

<option value="8">Paid</option>

<option value="0">Rejected</option>

</select>



</th>



<th width="75">

<select name="appby" id="appby">



<option value="">Approved by</option>

<?php

$app=mysql_query("select description,statuslevel from designation where statuslevel<>0 order by statuslevel DESC");

while($appr=mysql_fetch_array($app))

{

?>

<option value="<?php echo $appr[1]; ?>"><?php echo $appr[0]; ?></option>

<?php

}

?>

</select>



</th>



<th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" readonly="readonly" placeholder="From Date"/></th>

<th width="75"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');" readonly="readonly" placeholder="To Date"/></th>

<th width="75"><input type="text" name="atm" id="atm" placeholder="ATM ID"/></th>

<th><input type="button" name="dt" onclick="searchById('Listing','1','');" value="search" /></td>

</tr>

</table>

</center>









<center>

<div id="search"></div>



</center>

<script type="text/javascript" src="1.7.2.jquery.min.js"></script>

<script type="text/javascript" src="script.js"></script>

</body>

</html>