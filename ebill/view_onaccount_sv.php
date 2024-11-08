<?php 
	include("access.php");
	include("config.php");
	$accmgr=0;
	
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
	var sdate=document.getElementById('sdate').value;
	var edate=document.getElementById('edate').value;
	var atmid=document.getElementById('atmid').value;
	var trans_type=document.getElementById('trans_type').value;

	var supv=document.getElementById('supv').value;

	var url = 'get_onaccount_sv.php';
	var pmeters="";
	if(a!="Loading"){ 
		pmeters = 'Page='+b+'&perpg='+ppg+'&trans_type='+trans_type+'&reqid='+reqid+'&chqno='+chqno+'&sdate='+sdate+'&edate='+edate+'&atmid='+atmid+'&supv='+supv;
	}
	else
	{
		pmeters = 'Page='+b+'&perpg='+ppg+'&trans_type='+trans_type;	
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
</script>
</head>

<body onload="searchById('Loading','1','');">
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
<h2>Raise Reversal</h2>
<table>
	<td>
    	Type:
        <select name="trans_type" id="trans_type" onchange="searchById('Listing','1','');"><option value="reversal">Reversal</option></select>
	</td>
   
    <td>
		<select name="supv" id="supv" style="width:150px">
<option value="">Select Name</option>
		<?php
$sup=mysqli_query($con,"Select hname from fundaccounts ");
		while($supro=mysqli_fetch_array($sup))
		{
		?>	
			<option value="<?php echo $supro[0]; ?>"><?php echo $supro[0]; ?></option>
		<?php
		}
		?>
		</select>
    </td>
    <?php
		//}
	?>



	<td><input type="text" size="10" name="reqid" id="reqid" placeholder="Request ID"/></td>
    <td><input type="text" name="atmid" id="atmid" placeholder="ATM ID"/></td>
    <td><input type="text" name="chqno" id="chqno" placeholder="Cheque No."/></td>
    <td>
    	<input type="text" size="10" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" readonly="readonly" placeholder="From Date"/>
		<input type="text" size="10" name="edate" id="edate" onclick="displayDatePicker('edate');" readonly="readonly" placeholder="To Date"/>
    </td>
    <td><input type="button" name="dt" onclick="searchById('Listing','1','');" value="search" /></td>
</table>
</center>
<div id="datahere" style="margin-top:25px"></div>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>