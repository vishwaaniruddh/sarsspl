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
	var sdate=document.getElementById('sdate').value;
	var edate=document.getElementById('edate').value;
	var atmid=document.getElementById('atmid').value;
	var trans_type=document.getElementById('trans_type').value;
	<?php
    	if($accmgr || $branchmgr)
		{
	?>
	var supv=document.getElementById('supv').value;
    <?php
		}
	?>
	var url = 'get_ebfundtrans_sv.php';
	var pmeters="";
	if(a!="Loading"){ 
		pmeters = 'Page='+b+'&perpg='+ppg+'&trans_type='+trans_type+'&reqid='+reqid+'&chqno='+chqno+'&sdate='+sdate+'&edate='+edate+'&atmid='+atmid;
	}
	else
	{
		pmeters = 'Page='+b+'&perpg='+ppg+'&trans_type='+trans_type;	
	}
	<?php
		if($accmgr || $branchmgr)
		{
	?>
	pmeters+='&supv='+supv;
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
<h2>Raise Reversal</h2>
<table>
	<td>
    	Type:
        <select name="trans_type" id="trans_type" onchange="searchById('Listing','1','');"><option value="reversal">Reversal</option><option value="transfer">Transfer</option></select>
	</td>
    <?php
    $sup_str="select distinct(supervisor) from ebillfundrequests where supervisor<>'-1' and supervisor<>'0' and chqno<>'0'";
    		if($accmgr || $branchmgr)
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
			if($accmgr)
				$sup_str.=" and cust_id in (".$cl.")";
			$sup_str.=" and supervisor in (select distinct(hname) from fundaccounts where 1";
			if($branchmgr)
				$sup_str.=" and srno in (SELECT srno FROM `login` where branch in (".$_SESSION['branch']."))";			
			$sup_str.=") order by supervisor ASC";
			//echo $sup_str;
			$sup=mysqli_query($con,$sup_str);
	?>
    <td>
		<select name="supv" id="supv" style="width:150px"><option value="">Select Supervisor</option>
		<?php
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
		}
	?>
	<td><input type="text" size="10" name="reqid" id="reqid" placeholder="Request ID"/></td>
    <td><input type="text" name="atmid" id="atmid" placeholder="ATM ID"/></td>
    <td><input type="text" name="chqno" id="chqno" placeholder="Cheque No."/></td>
    <td>
    	<input type="text" size="10" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" readonly="readonly" placeholder="From Date"/>
		<input type="text" size="10" name="edate" id="edate"  onclick="displayDatePicker('edate');" readonly="readonly" placeholder="To Date"/>
    </td>
    <td><input type="button" name="dt" onclick="searchById('Listing','1','');" value="search" /></td>
</table>
</center>
<div id="datahere" style="margin-top:25px"></div>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>