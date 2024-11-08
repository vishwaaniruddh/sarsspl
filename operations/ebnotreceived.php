<?php
	
	include("access.php");	 
	include("config.php");	
	$str="SELECT * FROM `ebillfundrequests` where reqstatus='8' and pstat=0 ";
	/*if(isset($_REQUEST['invstat']) && $_REQUEST['invstat']!='')
		$str.="and print='".$_REQUEST['invstat']."' ";
	else*/
	$branchmgr=0;
	if($_SESSION['designation']==9 && $_SESSION['branch']!="all" && $_SESSION['branch']!="")
		$branchmgr=1;
	if($branchmgr)
		$str.=" and supervisor in (select distinct(hname) from fundaccounts where srno in (SELECT srno FROM `login` where branch in (".$_SESSION['branch'].")))";
	if(isset($_SESSION['custid']) && $_SESSION['custid']!="all" && $_SESSION['custid']!="")
	{
		$cust=explode(",",$_SESSION['custid']);
		$cust=implode("','",$cust);
        	$str.=" and cust_id in ('".$cust."') ";
        }
	$str.="and print='n'";
	$months=2;
	if(isset($_REQUEST['months']) && $_REQUEST['months']!='')
		$months=$_REQUEST['months'];
	$str.="and req_no in (select reqid from ebfundtransfers where pdate<'".date('Y-m-d',strtotime(date('Y-m-d')." -".$months." months"))."') ";
	if(isset($_REQUEST['cust']) && $_REQUEST['cust']!='')
		$str.="and cust_id like '".$_REQUEST['cust']."' ";
	//echo $str;
	$ebf_qry = mysqli_query($con,$str);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="excel.js" type="text/javascript"></script>
<title>View Transactions</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">
function getproject(val,type)
{
	//alert(val);
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
document.getElementById('proj').innerHTML='';
	document.getElementById('proj').innerHTML=xmlhttp.responseText;
	
	
    }
  }

//alert("getebillproj.php?val="+val+"&type="+type);
xmlhttp.open("GET","getebillproj.php?val="+val+"&type="+type,true);
xmlhttp.send();

	
}
</script>
</head>
<body >
<?php print_r($SESSION); ?>
<center>
	<?php 
        include("menubar.php");
    //echo $_SESSION['branch'];
     ?>
</center>
<center>
	<form name="myform" method="post" action="<?php $_SERVER['PHP-SELF']; ?>">
    	<!--<select name="invstat">
        	<option value="n">Invoice Not generated</option>
            <option value="y">Invoice generated</option>
        </select>-->
        <select name="months">
        	<option value="">Month Before</option>
        	<option value="0" <?php if(isset($_REQUEST['months']) && $_REQUEST['months']!='' && $_REQUEST['months']==0) echo "selected"?>>All Pending</option>
        	<?php
            		for($i=1;$i<7;$i++)
			{
		?>
            	<option value="<?php echo $i; ?>" <?php if(isset($_REQUEST['months']) && $_REQUEST['months']!='' && $_REQUEST['months']==$i) echo "selected"?> ><?php echo $i; ?> month old</option>
            	<?php
			}
		?>
        </select>
        <select name="cust" onchange="getproject(this.value,'projectid');">
        	<option value="">Select Customer</option>
        	<?php
        		$str_ebfr="select distinct(cust_id) from ebillfundrequests where 1";
        		if(isset($_SESSION['custid']) && $_SESSION['custid']!="all" && $_SESSION['custid']!="")
			{
				$cust=explode(",",$_SESSION['custid']);
				$cust=implode("','",$cust);
		        	$str_ebfr.=" and cust_id in ('".$cust."') ";
		        }
        		$str_ebfr.=" order by cust_id";
        		
        		$cust_qry=mysqli_query($con,$str_ebfr);
        		while($cust_row=mysqli_fetch_array($cust_qry))
        		{
        			if(trim($cust_row[0])!="")
        			{
        	?>
        		<option value="<?php echo $cust_row[0]; ?>" <?php if(isset($_REQUEST['cust']) && $_REQUEST['cust']!='' && $_REQUEST['cust']==$cust_row[0]) echo "selected"?>><?php echo $cust_row[0]; ?></option>
        	<?php
        			}
        		}
        	?>
        </select>
        <select name="projectid" id="proj">
        	<option value="">select Project</option>
        </select>
        <?php //echo $str_ebfr; ?>
        <select name="supervisor">
        	<option value="">Select Supervisor</option>
        	<?php
        		$sup_str="select distinct(hname) from fundaccounts where 1 ";
			if($branchmgr)
				$sup_str.=" and srno in (SELECT srno FROM `login` where branch in (".$_SESSION['branch']."))";
			$sup_str.=" order by hname";
        		$supervisor_qry=mysqli_query($con,$sup_str);
        		while($supervisor_row=mysqli_fetch_array($supervisor_qry))
        		{
        			if(trim($supervisor_row[0])!="" && trim($supervisor_row[0])!=-1)
        			{
        	?>
        		<option value="<?php echo $supervisor_row[0]; ?>" <?php if(isset($_REQUEST['supervisor']) && $_REQUEST['supervisor']!='' && $_REQUEST['supervisor']==$supervisor_row[0]) echo "selected"?>><?php echo $supervisor_row[0]; ?></option>
        	<?php
        			}
        		}
        	?>
        </select>
        <input type="submit" name="submit" value="Search"/>
    </form>
</center>
<?php 
	//echo $str; 
	//echo $sup_str;
?>
<button id="myButtonControlID" onClick="tableToExcel('custtable', 'EB not received')">Export Table data into Excel</button>
<table border="1" id="custtable">
	<tr>
        <th width="75">Sr NO</th>
        <th width="75">Req no</th>
        <th>Customer</th>
        <th>Project ID</th>
        <th width="75">Requesting Person</th>
        <th width="75">ATM ID</th>
        <th width="75">Bank</th>
        <th width="200px">Address</th>
        <th width="75px">Bill Date</th>
        <th width="75px">Due Date</th>
        <th width="75px">From</th>
        <th width="75px">To</th>
        <th width="75">Units</th>
        <th width="75">Amount</th>
        <th width="75">Supervisor</th>
        <th width="75">Transfer Date</th>
        <th width="75">Cheque No.</th>
        <th width="75">Transfered Amount</th>
    </tr>
    <?php
		$i=1;
	    	while($ebf=mysqli_fetch_array($ebf_qry))
		{
			$cust_name_qry = mysqli_query($con,"SELECT contact_first FROM contacts where short_name ='".$ebf['cust_id']."'");
			$cust_name_row=mysqli_fetch_array($cust_name_qry);
			$atm_detail_str="select bank,atmsite_address,projectid from ".$ebf['cust_id']."_sites where trackerid='".$ebf['trackerid']."'";
			if(isset($_REQUEST['projectid']) && $_REQUEST['projectid']!='')
				$atm_detail_str.=" and projectid like ('".$_POST['projectid']."')";
			$atm_detail_qry=mysqli_query($con,$atm_detail_str);
			if(mysqli_num_rows($atm_detail_qry)>0)
			{
				$atm_detail=mysqli_fetch_array($atm_detail_qry);
				$ebtrans_qry=mysqli_query($con,"SELECT * FROM `ebfundtransfers` WHERE `reqid` = '".$ebf['req_no']."'");
				$ebtrans=mysqli_fetch_array($ebtrans_qry);
				$reqby_qry=mysqli_query($con,"select username from login where srno='".$ebf['reqby']."'");
				$reqby=mysqli_fetch_array($reqby_qry);
				$super_str="SELECT * FROM `fundaccounts` where aid = '".$ebtrans['accid']."' ";
				if(isset($_REQUEST['supervisor']) && $_REQUEST['supervisor']!='')
					$super_str.="and hname like '".$_REQUEST['supervisor']."' ";
				$fundaccounts_qry=mysqli_query($con,$super_str);
				if(mysqli_num_rows($fundaccounts_qry)>0)
				{
					$fundaccounts=mysqli_fetch_array($fundaccounts_qry);
		?>
	    <tr>
	    	<td><?php echo $i; ?></td>
	        <td><?php echo $ebf['req_no']; ?></td>
	        <td><?php echo $cust_name_row[0]; ?></td>
        	<td><?php echo $atm_detail['projectid']; ?></td>
	        <td><?php echo $reqby['username']; ?></td>
	        <td><?php echo $ebf['atmid']; ?></td>
	        <td><?php echo $atm_detail['bank']; ?></td>
	        <td><?php echo $atm_detail['atmsite_address']; ?></td>
	        <td><?php echo date('d-m-Y',strtotime($ebf['bill_date'])); ?></td>
	        <td><?php echo date('d-m-Y',strtotime($ebf['due_date'])); ?></td>
	        <td><?php echo date('d-m-Y',strtotime($ebf['start_date'])); ?></td>
	        <td><?php echo date('d-m-Y',strtotime($ebf['end_date'])); ?></td>
	        <td><?php echo $ebf['unit']; ?></td>
	        <td><?php echo $ebf['amount']; ?></td>
	        <td><?php echo $fundaccounts['hname']; ?></td>
	        <td><?php echo date('d-m-Y',strtotime($ebtrans['pdate'])); ?></td>
	        <td><?php echo $ebtrans['chqno']; ?></td>
	        <td><?php echo $ebf['approvedamt']; ?></td>
	    <?php
					$i++;
				}
			}
		}
	?>
</table>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>