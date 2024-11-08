<?php
include("config.php");
include("access.php");

$tid=$_GET['id'];
//echo "Select reqid from ebfundtransfers where chqno='".$tid."' and status=0";
//echo "Select reqid from ebfundtransfers where tid='".$tid."'";
//echo "Select qid from quotation1ftransfers where tid='".$tid."' and status!=0";


$queryamt=mysqli_query($con,"Select sum(tamount) from quotation1ftransfers_tis where tid='".$tid."' and status!=0");
$qrrow=mysqli_fetch_array($queryamt);


$query=mysqli_query($con,"Select qid from quotation1ftransfers_tis where tid='".$tid."' and status!=0");
$reqarr=array();
while($row=mysqli_fetch_row($query))
{
	$reqarr[]=$row[0];
}
//print_r($reqarr);
 $reqid=implode(",",$reqarr);
//echo "Select * from ebillfundrequests where req_no in($reqid)";


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>View Tis Transactions</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="menu.css" rel="stylesheet" type="text/css" />
	<!--datepicker-->
	<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
	
	<script src="datepicker/datepick_js.js" type="text/javascript"></script>
	<script src="excel.js" type="text/javascript"></script>
	
	</head>
	<body >
	<center>
	<?php
	include("menubar.php");
	?>
	<h2 class="style1" align="center">VIEW DETAILS</h2>
	<br>
	<input type="button" id="exp" onclick="tableToExcel('exptexcl', 'Table Export Example')" value="Export To Excel"/>	
	<div id="exptexcl" align="center"><br>
 
	<table  border="2" align="center" cellspacing="10" cellpadding="10">
	
				<tr><center>
				<th>Sr No</th>
				
				<th>ATM ID</th>
				<th>Supervisor</th>
				<th>Custid</th>
				 <th>Approved Amount</th>
				  <th>Cheque NO:</th>
				
				
				</center>
				</tr>
				<?php
				$cnt=0;
				$qrydata=mysqli_query($con,"Select * from quotation1_tis where id in($reqid)");
				while($rowdata=mysqli_fetch_row($qrydata))
				{
				$cnt=$cnt+1;
				
				
				$qrys=mysqli_query($con,"Select tamount,chqno,accid,chq_name from quotation1ftransfers_tis where qid='".$rowdata[0]."'");
				$srrow=mysqli_fetch_array($qrys);
				
				$supname="";
				if($srrow[2]!='-1')
				{
				$querycust=mysqli_query($con,"Select hname from fundaccounts where aid='".$srrow[2]."'");
				$custres=mysqli_fetch_row($querycust);
				$supname=$custres[0];
				}
				else
				{
				$supname=$srrow[3];
				}
				
				?><tr>
				<td align="center"><?php echo $cnt; ?></td>
				<td align="center"><?php echo $rowdata[3]; ?></td>
					<td align="center"><?php echo $supname; ?></td>
					<td align="center"><?php echo $rowdata[2]; ?></td>
					<td align="center"><?php echo round($srrow[0]); ?></td>
					<td align="center"><?php echo $srrow[1]; ?></td>
					
					</tr>
					<?php
				}
				?>
				<tr><td colspan="4" ></td><td align="center"><?php echo round($qrrow[0]);?></td></tr>
				</table>
				</div>
				
				</center>
				
				
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
				</body>
				</html>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				