<?php
include("config.php");
include("access.php");

$tid=$_GET['id'];
//echo "Select reqid from ebfundtransfers where chqno='".$tid."' and status=0";
//echo "Select reqid from ebfundtransfers where tid='".$tid."'";
//echo "Select qid from quotation1ftransfers where tid='".$tid."' and status!=0";




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
				<th>Fund Transfer To</th>
				  <th>Amount</th>
				  <th>Cheque No:</th>
				
				
				</center>
				</tr>
				<?php
				$cnt=0;
				$qrydata=mysqli_query($con,"Select * from salary_generate_details where tid='".$tid."'");
                                 $saltot='0';
				while($rowdata=mysqli_fetch_row($qrydata))
				{
				$cnt=$cnt+1;
			
				
		
				$querycust=mysqli_query($con,"Select name from salary_acc where id='".$rowdata[15]."'");
				$custres=mysqli_fetch_row($querycust);
				$supname=$custres[0];
				
				
				?><tr>
				<td align="center"><?php echo $cnt; ?></td>
				
					<td align="center"><?php echo $supname; ?></td>
					<td align="center"><?php echo round($rowdata[14]); $saltot=$saltot+$rowdata[14]; ?></td>
					<td align="center"><?php echo $rowdata[6]; ?></td>
					
					</tr>
					<?php
				}
				?>
				<tr><td colspan="2" ></td><td align="center"><?php echo round($saltot);?></td></tr>
				</table>
				</div>
				
				</center>
				
				
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
				</body>
				</html>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				