<?php
//session_start();
include("access.php");
include('config.php');
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept'];
 $reqid=$_REQUEST['reqid'];
$ebonacc_qry=mysqli_query($con,"SELECT * FROM `ebonacctransfers` WHERE `reqid` = '".$reqid."'");
$ebonacc_row=mysqli_fetch_array($ebonacc_qry);
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
</head>
<body>

<center>
<?php include("menubar.php"); ?>

<h2 class="h2color">Onaccount Transfer</h2>

<table>
	<tr>
		<th>Sr.no</th>
		<th>Name/Accno</th>
		<th>Amount</th>
		<th>Cheque Name</th>
		<th>Cheque No.</th>
		<th>Debit Account</th>
		<th>Remarks</th>
	</tr>
<?php
	//echo $reqid;
	$fundacc_qry=mysqli_query($con,"SELECT * FROM `fundaccounts` WHERE `aid` = '".$ebonacc_row['accid']."'");
	$fundacc_row=mysqli_fetch_array($fundacc_qry);
	$login_qry=mysqli_query($con,"select * from login where srno='".$fundacc_row['srno']."'");
	$login_row=mysqli_fetch_array($login_qry);
	echo "select * from ebillfundrequests  where (reqby='".$fundacc_row['srno']."' or supervisor like '".$fundacc_row['hname']."' or supervisor like '".$login_row['username']."') and reqstatus<>'8' and reqstatus<>'0' and reqstatus<>'100' and approvedamt=0";
	$ebfundreq_qry=mysqli_query($con,"select * from ebillfundrequests  where (reqby='".$fundacc_row['srno']."' or supervisor like '".$fundacc_row['hname']."' or supervisor like '".$login_row['username']."') and reqstatus<>'8' and reqstatus<>'0' and reqstatus<>'100' and approvedamt=0");
	$cnt=1;
	while($ebfundreq_row=mysqli_fetch_array($ebfundreq_qry))
	{
	
?>
	<tr>
		<td><?php echo $cnt; ?></td>
		<td><?php echo $ebfundreq_row['ebfundreq_row']; ?></td>
		<!--<td><?php echo $onacc_row['approvedamt']; ?></td>
		<td><?php echo $ebonacc_row['chqname']; ?></td>
		<td><?php echo $ebonacc_row['chqno']; ?></td>
		<td><?php echo $ebonacc_row['dbtaccno']; ?></td>
		<td><?php echo $ebonacc_row['remark']; ?></td>
		<td><a href="alloc_onacc.php?reqid=<?php echo $ebonacc_row['reqid']; ?>">Edit</a></td>-->
	</tr>
<?php
		$cnt++;
	}
?>
</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>