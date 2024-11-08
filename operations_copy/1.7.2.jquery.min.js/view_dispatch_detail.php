<?php
	include("config.php");
	session_start();
	$sql="SELECT * FROM `update_receipt` WHERE `did` = '".$_REQUEST['did']."'";
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

<body>
<center>
<?php include("menubar.php"); ?>
<h2>View Dispatched Detail</h2>
<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Dispatch Detail')">Export Table data into Excel</button>
 <table id="custtable" border="1">
	<tr>
    	<th>Sr. no.</th>
        <th>Reqid</th>
        <th>Atm</th>
        <th>Bank</th>
        <th width="200px">Address</th>
        <th>Amount</th>
        <th>Updated Amount</th>
        <th>Difference</th>
        <th>Remarks</th>
        <th>Scanned Bill</th>
    </tr>
<?php
	$update_receipt_qry=mysqli_query($con,$sql);
	$i=1;
	$tot1=0;
	$tot2=0;
	while($update_receipt=mysqli_fetch_array($update_receipt_qry))
	{
		$sql="SELECT *  FROM `ebillfundrequests` WHERE `req_no` = '".$update_receipt['reqid']."'";
		//echo $sql;
		$ebfundreq_qry=mysqli_query($con,$sql);
		$ebfundreq=mysqli_fetch_array($ebfundreq_qry);
		if(mysqli_num_rows($ebfundreq_qry)>0)
		{
		
		$atm_detail_qry=mysqli_query($con,"select bank,atmsite_address from ".$ebfundreq['cust_id']."_sites where trackerid='".$ebfundreq['trackerid']."'");
		$atm_detail=mysqli_fetch_array($atm_detail_qry);
?>
	<tr>
    	<td><?php echo $i;?></td>
        <td><?php echo $ebfundreq['req_no'];?></td>
        <td><?php echo $ebfundreq['atmid'];?></td>
        <td><?php echo $atm_detail['bank'];?></td>
        <td><?php echo $atm_detail['atmsite_address'];?></td>
        <td><?php echo $ebfundreq['approvedamt']; $tot1+=$ebfundreq['approvedamt']; ?></td>
        <td><?php echo $update_receipt['amt'];  $tot2+=$update_receipt['amt']; ?></td>
        <td><?php echo $update_receipt['amt']-$ebfundreq['approvedamt']; ?></td>
        <td width="150px"><?php echo $update_receipt['remark']; ?></td>
        <td>
        	<?php if($update_receipt['scncpy']!=""){ ?>
        	<a href="javascript:void(0);" onclick="newwin('update_scannedbill.php?reqid=<?php echo $update_receipt['scncpy']; ?>','display',900,400)">View Scanned Bill</a>
        	<?php
        		}
        		else
        			echo "Bill Not uploaded";
        	?>
        </td>
    </tr>
<?php
		$i++;
		}
	}
?>
<tr>
	<th colspan="5">Total</th>
    <th><?php echo $tot1; ?></th>
    <th><?php echo $tot2; ?></th>
    <th><?php echo $tot2-$tot1; ?></th>
</table>
<button><a href="view_dispatch_raised.php">Back</a></button>
</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>