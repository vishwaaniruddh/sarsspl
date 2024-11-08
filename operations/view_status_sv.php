<?php 
	include("access.php");
	include("config.php");
	$accmgr=0;
	if($_SESSION['designation']==8 && $_SESSION['dept']==4 && $_SESSION['serviceauth']==2)
		$accmgr=1;	
	$branchmgr=0;
	if($_SESSION['designation']==9 && $_SESSION['branch']!="all" && $_SESSION['branch']!="")
		$branchmgr=1;
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
	var reqid=document.getElementById('reqid').value;
	var chqno=document.getElementById('chqno').value;
	//var csschqno=document.getElementById('csschqno').value;
	var type1=document.getElementById('type').value;
	var status=document.getElementById('status').value;
	var atmid=document.getElementById('atmid').value;
	var sdate=document.getElementById('sdate').value;
	var edate=document.getElementById('edate').value;
	
	<?php
    	if($accmgr || $branchmgr)
		{
	?>
	var from_supv=document.getElementById('from_supv').value;
    <?php
		}
	?>
	
	var url;
	var sup1;
	if(type1=="reversal")
	{
		url = 'get_status_reversal_sv.php';
		sup1=document.getElementById('dbtacc').value;
	}
	else
	{
		url = 'get_status_transfer_sv.php';
		sup1=document.getElementById('sup').value;
	}
	var pmeters="";
	if(a!="Loading"){ 
		pmeters = 'Page='+b+'&perpg='+ppg+'&status='+status+'&reqid='+reqid+'&chqno='+chqno+'&sup='+sup1+'&atmid='+atmid+'&sdate='+sdate+'&edate='+edate;
	}
	else
	{
		pmeters = 'Page='+b+'&perpg='+ppg+'&status='+status;
	}
	<?php
		if($accmgr || $branchmgr)
		{
	?>
	pmeters+='&from_supv='+from_supv;
	<?php
		}
	?>
	
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
		if(type1=="reversal")
		{
			url = 'update_reversal_rem.php';
		}
		else
		{
			url = 'update_transfer_rem.php';
		}
		xmlhttp.open("GET",url+"?rem="+rem+"&reqid="+id,true);
		xmlhttp.send();
	}
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
</script>
</head>

<body onload="showrem('transfer_sv');searchById('Loading','1','');" >
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
			$result="Request approved sucessfully.";
		}
		else if($_SESSION['success']==2)	
		{
			$result="Request rejected sucessfully.";
		}
?>
<script>
alert('<?php echo $result; ?>');
</script>
<?php
		unset($_SESSION['success']);
	}
?>
<h2>View Status</h2>
<table>
	<td><select id="status"><option value="2">Approval</option><option value="1">Approved</option><option value="0">Rejected</option></select></td>
	<td><select id="type" onchange="showrem('transfer_sv');showrem('reversal_ac');"><option value="reversal">Reversal</option><option value="transfer">Transfer</option></select></td>
<?php
	if($accmgr || $branchmgr)
	{
		$sup_str="select * from fundaccounts where hname in (select distinct(supervisor) from ebillfundrequests where supervisor<>'-1' and supervisor<>'0' and chqno<>'0'";
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
			$sup_str.=" and cust_id in (".$cl.")";
		}
		$sup_str.=")";
		if($branchmgr)
			$sup_str.=" and srno in (SELECT srno FROM `login` where branch in (".$_SESSION['branch']."))";
		$sup_str.=" order by hname";
		//echo $sup_str;
		$sup=mysqli_query($con,$sup_str);
?>
    <td>From:
        <select name="from_supv" id="from_supv" style="width:150px"><option value="">Select Supervisor</option>
        <?php
        while($supro=mysqli_fetch_array($sup))
        {
        ?>	
            <option value="<?php echo $supro[0]; ?>"><?php echo $supro[1]."/ ".$supro[4]; ?></option>
        <?php
        }
        ?>
        </select>
    </td>
<?php
	}
?>
    <td id="transfer_sv">
		<?php
		$sup=mysqli_query($con,"select * from fundaccounts order by hname ASC");
		?>
		<select name="sup" id="sup" style="width:150px"><option value="">Select Supervisor</option>
		<?php
		while($supro=mysqli_fetch_array($sup))
		{
			$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_row($sr);
			if($supro['srno']!=$srno[0])
			{
		?>
		<option value="<?php echo $supro[0]; ?>"><?php echo $supro[1]."/ ".$supro[4]; ?></option>
		<?php
			}
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