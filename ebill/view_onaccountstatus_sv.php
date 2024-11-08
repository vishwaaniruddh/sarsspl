<?php 
	include("access.php");
	include("config.php");
	
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
var sup="";
	var reqid=document.getElementById('reqid').value;
	var chqno=document.getElementById('chqno').value;
	//var csschqno=document.getElementById('csschqno').value;
	var type1=document.getElementById('type').value;
	var status=document.getElementById('status').value;
	var atmid=document.getElementById('atmid').value;
	var sdate=document.getElementById('sdate').value;
	var edate=document.getElementById('edate').value;
	
	
	sup=document.getElementById('supv').value;
 
	
	
	var url;
	//var sup1;
	
		url = 'get_onacc_status_reversal_sv.php';
		sup1=document.getElementById('dbtacc').value;
	
	var pmeters="";
if(a!="Loading"){ 
		pmeters = 'Page='+b+'&perpg='+ppg+'&status='+status+'&reqid='+reqid+'&chqno='+chqno+'&sup='+sup+'&atmid='+atmid+'&sdate='+sdate+'&edate='+edate+'&sup='+sup;;
	}
	else
	{
		pmeters = 'Page='+b+'&perpg='+ppg+'&status='+status;
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
	}
	else
	 alert("Failed please try again.");
    }
  }
 	var rem=document.getElementById("rem"+cnt).value;
	if(rem=='')
	{
		alert("Please give some remarks");
	}
	else
	{
		var url="";
		var type1=document.getElementById('type').value;
		/*if(type1=="reversal")
		{
			url = 'update_reversal_rem.php';
		}
		else
		{
			url = 'update_transfer_rem.php';
		}*/
		xmlhttp.open("GET",url+"?rem="+rem+"&reqid="+id,true);
		xmlhttp.send();
	}
}

</script>
</head>

<body onload="searchById('Loading','1','');" >
<center>
<?php include("menubar.php"); ?>

	



<h2>View Status</h2>
<table>
	<td><select id="status"><option value="8">Approval</option></td>
	<td><select id="type"><option value="reversal">Reversal</option></select></td>
<?php
	
		$sup_str="select * from fundaccounts order by hname ";
		
		$sup=mysqli_query($con,$sup_str);
?>
    <td>From:
        <select name="supv" id="supv" style="width:150px"><option value="">Select Supervisor</option>
        <?php
        while($supro=mysqli_fetch_array($sup))
        {
        ?>	
            <option value="<?php echo $supro[0]; ?>"><?php echo $supro[1]; ?></option>
        <?php
        }
        ?>
        </select>
    </td>

   
    <td id="reversal_ac">
        <select name="dbtacc" id="dbtacc" required >
            <option value="">Select Credit Acc/no</option>
            <option value="074005000336">074005000336</option>
            <option value="074005000588">074005000588</option>
            <option value="074005000745">074005000745</option>
            <option value="074051000006">074051000006</option>
        </select>
    </td>

    <td>Atm ID: <input type="text" name="atmid" id="atmid" size="15" placeholder="Atm"/></td>
    <td>
    	<input type="text" name="sdate" id="sdate" size="10" onclick="displayDatePicker('sdate');" placeholder="From Date"/>
		<input type="text" name="edate" id="edate" size="10"  onclick="displayDatePicker('edate');" placeholder="To Date"/>
    </td>
    <td>Request ID:<input type="text" size="10" name="reqid" id="reqid" placeholder="Request ID"/></td>
    <td>Cheque No. :<input type="text" size="10" name="chqno" id="chqno" placeholder="Cheque No."/></td>
    <td><input type="button" name="dt" onclick="searchById('Listing','1','');" value="search" /></td></table>
</center>
<div id="datahere" style="margin-top:25px"></div>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>