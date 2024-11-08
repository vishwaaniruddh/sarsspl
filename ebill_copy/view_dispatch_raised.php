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
<script src="excel.js" type="text/javascript"></script>
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--Slide down div  -->
<script src="js/jquery.min.js.js" type="text/javascript"></script>
<script src="php_calendar/scripts.js" type="text/javascript"></script>
<script>
function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode;
if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
return false;
 
return true;
}
</script>
</head>
<body>
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
			$result="Approved sucessfully. ";
		}
?>
<script>
alert('<?php echo $result; ?>');
</script>
<?php
		unset($_SESSION['success']);
	}
?>
<h2>View Dispatched </h2>
<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Dispatch Detail')">Export Table data into Excel</button>
<center>
	<table>
		<form method="post" action="<?php $_SERVER["PHP_SELF"] ?>"/>
			<input type="text" name="didno" placeholder="DID Number" onKeyPress="return isNumberKey(event);" value="<?php if(isset($_REQUEST['didno'])){ echo $_REQUEST['didno']; }?>" size="10"/>
			<input type="submit" value="Submit"/>
		</form>
	</table>
</center>
<table  id="custtable" border="1">
	<tr>
    	<th>Sr. No.</th>
        <th>Dispatch ID</th>
        <th>Count of Atm</th>
        <th>Sum of Fund Transfered</th>
        <th>Sum of Fund Updated</th>
        <th>Difference</th>
        <th>Dispatch Date</th>
        <th>View Detail</th>
        <th>PO Number</th>
        <th>To Whom</th>
        <th>HO Approval</th>
        <th>Approval Date</th>
        <?php
        //echo $_SESSION['designation'].$_SESSION['dept'].$_SESSION['serviceauth'];
        	if($_SESSION['designation']==7 && $_SESSION['dept']==2)
 			{
		?>
        <th>Approve</th>
        <?php
			}
		?>
	</tr>
<?php
	$str="SELECT did,sum(amt),count(*),req_status,ddate,adate,entrby  FROM `update_receipt` where dstatus=1";
	if(isset($_REQUEST['didno']) && $_REQUEST['didno']!='')
	$str.=" and did='".$_REQUEST['didno']."'";
	$str.=" group by did order by did desc";
	//echo $str;
	$qry=mysqli_query($con,$str);
	$i=1;
	while($row=mysqli_fetch_array($qry))
	{
		$trans_qry=mysqli_query($con,"select sum(approvedamt) from `ebillfundrequests` where req_no in (SELECT reqid FROM `update_receipt` WHERE `did` = $row[0])");
		$trans=mysqli_fetch_array($trans_qry);
		$pod_qry=mysqli_query($con,"SELECT * FROM `pod_receipt` WHERE `did` = $row[0]");
		$pod=mysqli_fetch_array($pod_qry);
		$entrby_qry=mysqli_query($con,"select username from login where srno='".$row['entrby']."'");
		$entrby=mysqli_fetch_row($entrby_qry);
		$did=$row[0];
		if($did<=9)
		$did ="000".$did ;
		if($did>9 && $did <=99)
		$did = "00".$did ;
		if($did>99 && $did <=999)
		$did = "0".$did ;
	?>
	<tr style="text-align:center">
    	<td><?php echo $i; ?></td>
        <td><?php echo "CSS_".$entrby[0]."_".$did; ?></td>
        <td><?php echo $row[2]; ?></td>
        <td><?php echo $trans[0]; ?></td>
        <td><?php echo $row[1]; ?></td>
        <td><?php echo $row[1]-$trans[0]; ?></td>
        <td><?php if($row[4]!='0000-00-00'){echo date('d-m-Y',strtotime($row[4]));}  ?></td>
        <td><a href="view_dispatch_detail.php?did=<?php echo $row[0]; ?>">View</a></td>
        <td id="app<?php echo $i; ?>">
        	<?php echo $pod['pod']; ?>
        </td>
        <td id="towhom<?php echo $i; ?>"><?php echo $pod['to_whom']; ?></td>
        <td><?php if($row[3]==0){ echo "Not Received";}else if($row[3]==1){ echo "Received"; }?></td>
        <td><?php if($row[5]!='0000-00-00'){ echo date('d-m-Y',strtotime($row[5])); } ?></td>
        <?php
			if($row[3]==0)
			{
				if($_SESSION['designation']==7 && $_SESSION['dept']==2)
				{
		?>
        <td>
        <form method="post" action="process_dispatch_app.php">
        	<input type="hidden" name="did" value="<?php echo $row[0]; ?>"/>
            <input type="submit" value="Approve"/>
        </form>
        </td>
        <?php
				}
			}
		?>
<?php
		$i++;
	}
?>
</table>
</center>
<div id="datahere" style="margin-top:25px"></div>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>