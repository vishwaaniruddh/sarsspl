<?php session_start();
if(!$_SESSION['user'])
header('location:index.php');
//echo $_SESSION['user'];
//$desig=$_POST['desig'];
//$service=$_POST['service'];
//$dept=$_POST['dept'];
//$app=$_POST['apps'];
//echo count($app);
include('config.php');

?><html><head><title>Paid Ebill Fund</title>
<script src="excel.js" type="text/javascript"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script>
function consolidet()
{
	if(document.getElementById('report_type').value=="consolidate")
	{
	  document.getElementById("datahere").innerHTML ="<center><img src=loader.gif></center>";
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
		document.getElementById("datahere").innerHTML='';
		document.getElementById("datahere").innerHTML=xmlhttp.responseText;
		
		
	    }
	  }
	  	var sup=document.getElementById('sup').value;
		var frmdt=document.getElementById('frmdt').value;
		var todt=document.getElementById('todt').value;
		var dat="sup="+sup+"&frmdt="+frmdt+"&todt="+todt;
		//alert(dat);
		
		xmlhttp.open("POST","consolidate_sup2.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(dat);
	}
	else
		document.getElementById("frm1").submit();
}
</script>
</head>
<body>
<center>
<?php include("menubar.php"); ?>
<form name="frm1" id="frm1" method="post" action="<?php $_SERVER['PHP-SELF'] ?>">
<table>
	<tr>
    	<!--<td>
        	<select name="cust">
            	<option value="">Select Customer</option>
                <?php
                	$cust_qry=mysqli_query($con,"SELECT * FROM `contacts` where short_name in (SELECT distinct(cust_id) FROM `ebillfundrequests`) order by contact_first");
					while($cust_row=mysqli_fetch_array($cust_qry))
					{
?>
						<option value="<?php echo $cust_row['short_name'] ?>"><?php echo $cust_row['contact_first'] ?></option>
<?php
					}
				?>
            </select>
        </td>-->
        <td>
			<input type="text" name="frmdt" placeholder="From Date" id="frmdt" value="<?php if(isset($_POST['frmdt'])){ echo $_POST['frmdt']; }?>" onclick="displayDatePicker('frmdt');" >
        </td>
        <td>
			<input type="text" name="todt"  placeholder="To Date" id="todt" value="<?php  if(isset($_POST['todt'])){ echo $_POST['todt']; }?>" onclick="displayDatePicker('todt');" >
        </td>
        <td>
        	<input type="submit" value="Search"/>
        </td>
    </tr>
</table>
<table  border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;">
	<tr>
    	<th>Sr. No.</th>
        <th>Customer</th>
        <th>Extra Charge</th>
        <th>Reconnection Charge</th>
        <th>Disconnection Charage</th>
        <th>Security Deposit</th>
        <th>Total</th>
    </tr>
<?php
	if(isset($_REQUEST['frmdt']) && $_REQUEST['frmdt']!="" && isset($_REQUEST['todt']) && $_REQUEST['todt']!="")
	{
		$i=1;
		$cust_qry=mysqli_query($con,"SELECT * FROM `contacts` where short_name in (SELECT distinct(cust_id) FROM `ebillfundrequests`) order by contact_first");
		while($cust_row=mysqli_fetch_array($cust_qry))
		{
			// Extra Charge
			
			$sbd_ec_qry=mysqli_query($con,"SELECT GROUP_CONCAT(reqid) FROM `send_bill_detail` WHERE extrachrg<>0 and status=0");
			$sbd_ec_row=mysqli_fetch_array($sbd_ec_qry);
			$ec_str="SELECT sum(extrachrg) FROM `ebillfundrequests` WHERE cust_id='".$cust_row['short_name']."' and entrydate BETWEEN str_to_date('".$_REQUEST['frmdt']."','%d/%m/%Y') and str_to_date('".$_REQUEST['todt']."','%d/%m/%Y') and pstat=1 and reqstatus<>0";
			if($sbd_ec_row[0]!="")
			$ec_str.=" and req_no not in ($sbd_ec_row[0])";
			//echo $ec_str."<br/>";
			$ec_chrg_qry=mysqli_query($con,$ec_str);
			$ec_chrg_row=mysqli_fetch_array($ec_chrg_qry);
			
			// Reconnection Charge
			$sbd_rc_qry=mysqli_query($con,"SELECT GROUP_CONCAT(reqid) FROM `send_bill_detail` WHERE recon_chrg<>0 and status=0");
			$sbd_rc_row=mysqli_fetch_array($sbd_rc_qry);
			$rc_str="SELECT sum(recon_chrg) FROM `ebillfundrequests` WHERE cust_id='".$cust_row['short_name']."' and entrydate BETWEEN str_to_date('".$_REQUEST['frmdt']."','%d/%m/%Y') and str_to_date('".$_REQUEST['todt']."','%d/%m/%Y') and pstat=1 and reqstatus<>0";
			if($sbd_rc_row[0]!="")
			$rc_str.=" and req_no not in ($sbd_rc_row[0])";
			//echo $rc_str."<br/>";
			$recon_chrg_qry=mysqli_query($con,$rc_str);
			$recon_chrg_row=mysqli_fetch_array($recon_chrg_qry);
			//echo "Customer: ".$cust_row['contact_first']." Reconnection Charge: ".$recon_chrg_row[0]." ".$sbd_rc_row[0]."<br/>";
			
			// Disconnection Charge
			$sbd_dc_qry=mysqli_query($con,"SELECT GROUP_CONCAT(reqid) FROM `send_bill_detail` WHERE discon_chrg<>0 and status=0");
			$sbd_dc_row=mysqli_fetch_array($sbd_dc_qry);
			$dc_str="SELECT sum(discon_chrg) FROM `ebillfundrequests` WHERE cust_id='".$cust_row['short_name']."' and entrydate BETWEEN str_to_date('".$_REQUEST['frmdt']."','%d/%m/%Y') and str_to_date('".$_REQUEST['todt']."','%d/%m/%Y') and pstat=1 and reqstatus<>0";			
			if($sbd_dc_row[0]!="")
			$dc_str.=" and req_no not in ($sbd_dc_row[0])";
			//echo $dc_str."<br/>";
			$dc_chrg_qry=mysqli_query($con,$dc_str);
			$dc_chrg_row=mysqli_fetch_array($dc_chrg_qry);
			
			// Security Deposit
			$sbd_sd_qry=mysqli_query($con,"SELECT GROUP_CONCAT(reqid) FROM `send_bill_detail` WHERE sd<>0 and status=0");
			$sbd_sd_row=mysqli_fetch_array($sbd_sd_qry);
			$sd_str="SELECT sum(sd) FROM `ebillfundrequests` WHERE cust_id='".$cust_row['short_name']."' and entrydate BETWEEN str_to_date('".$_REQUEST['frmdt']."','%d/%m/%Y') and str_to_date('".$_REQUEST['todt']."','%d/%m/%Y') and pstat=1 and reqstatus<>0";		
			if($sbd_sd_row[0]!="")
			$sd_str.=" and req_no not in ($sbd_sd_row[0])";			
			//echo $sd_str."<br/>";
			$sd_chrg_qry=mysqli_query($con,$sd_str);
			$sd_chrg_row=mysqli_fetch_array($sd_chrg_qry);
			
			$cust_tot=$ec_chrg_row[0]+$recon_chrg_row[0]+$dc_chrg_row[0]+$sd_chrg_row[0];
			$ec_tot+=$ec_chrg_row[0];
			$rc_tot+=$recon_chrg_row[0];
			$dc_tot+=$dc_chrg_row[0];
			$sd_tot+=$sd_chrg_row[0];
?>
	<tr>
    	<td><?php echo $i; ?></td>
    	<td><?php echo $cust_row['contact_first']; ?></td>
    	<td><?php if($ec_chrg_row[0]==""){ echo "0.00"; }else{ echo $ec_chrg_row[0]; } ?></td>
    	<td><?php if($recon_chrg_row[0]==""){ echo "0.00"; }else{ echo $recon_chrg_row[0]; } ?></td>
    	<td><?php if($dc_chrg_row[0]==""){ echo "0.00"; }else{ echo $dc_chrg_row[0]; } ?></td>
    	<td><?php if($sd_chrg_row[0]==""){ echo "0.00"; }else{ echo $sd_chrg_row[0]; } ?></td>
    	<td><?php echo $cust_tot; ?></td>
	</tr>
<?php
			$i++;
		}
	}
?>
<tr>
	<th colspan="2">Total</th>
	<td><?php echo $ec_tot; ?></td>
	<td><?php echo $rc_tot; ?></td>
	<td><?php echo $dc_tot; ?></td>
	<td><?php echo $sd_tot; ?></td>
	<td><?php echo ($ec_tot+$rc_tot+$dc_tot+$sd_tot)?>
</tr>
</table>
</center>
</form>
</div>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script></body></html>