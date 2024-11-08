<?php
include("config.php");
include("access.php");

$tid=$_GET['id'];
//echo "Select reqid from ebfundtransfers where chqno='".$tid."' and status=0";
//echo "Select reqid from ebfundtransfers where tid='".$tid."'";
$query=mysqli_query($con,"Select reqid from ebfundtransfers where chqno='".$tid."' and status=0");
$reqarr=array();
while($row=mysqli_fetch_row($query))
{
	$reqarr[]=$row[0];
}
print_r($reqarr);
 $reqid=implode(",",$reqarr);
//echo "Select * from ebillfundrequests where req_no in($reqid)";


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>View Transactions</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="menu.css" rel="stylesheet" type="text/css" />
	<!--datepicker-->
	<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
	
	<script src="datepicker/datepick_js.js" type="text/javascript"></script>
	
	
	</head>
	<body >
	<center>
	<?php
	include("menubar.php");
	?>
	<form name="frm1" method="post" action=""  enctype="multipart/form-data" align="center">
 <h2 class="style1" align="center">VIEW DETAILS</h2>
	<table  border="3" align="center" cellspacing="10" cellpadding="10">
	
				<tr><center>
				<th>Sr No</th>
				<th>Docket No</th>
				<th>ATM ID</th>
				<th>Supervisor</th>
				<th>Custid</th>
				 <th>Approved Amount</th>
				  <th>Cheque NO:</th>
				
				
				</center>
				</tr>
				<?php
				$cnt=0;
				$qrydata=mysqli_query($con,"Select * from ebillfundrequests where req_no in($reqid)");
				while($rowdata=mysqli_fetch_row($qrydata))
				{
				$cnt=$cnt+1;
				//echo "Select contact_first from contacts where short_name='".$rowdata[12]."'";
				$querycust=mysqli_query($con,"Select contact_first from contacts where short_name='".$rowdata[12]."'");
				$custres=mysqli_fetch_row($querycust);
				?><tr>
				<td><?php echo $cnt; ?></td>
				<td><?php echo $rowdata[0]; ?></td>
					<td><?php echo $rowdata[1]; ?></td>
					<td><?php echo $rowdata[8]; ?></td>
					<td><?php echo $custres[0]; ?></td>
					<td><?php echo $rowdata[16]; ?></td>
					<td><?php echo $rowdata[17]; ?></td>
					</tr>
					<?php
				}
				?>
				</table>
				</form>
				</center>
				
				
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
				</body>
				</html>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				