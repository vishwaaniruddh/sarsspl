<?php ini_set( "display_errors", 0);
	
	include("access.php");
	
	
	// header('Location:managesite1.php?id='.$id); 
	 
	include("config.php");
	
	$result1 = mysqli_query($con,"SELECT contact_first, short_name FROM contacts where type='c' order by short_name ASC");		
	//$result2 = mysqli_query($con,"SELECT DISTINCT bank FROM sites");		
	 ?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>RNM Transactions</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="menu.css" rel="stylesheet" type="text/css" />
	<!--datepicker-->
	<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
	
	<script src="datepicker/datepick_js.js" type="text/javascript"></script>
	
	
	</head>
	<body >
	<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?></center>
	<center>
	<form name="frm1" method="post" action="<?php $_SERVER['PHP-SELF']; ?>"  enctype="multipart/form-data" align="center">
	<h2 class="style1" align="center">RNM TRANSACTIONS</h2>
	<table border="3" align="center"><tr><!--<td width="209" align="center">
		 Client :
			  <select name="cid" id="cid" onchange="searchById('Listing','1','');getproj(this.value);" ><option value="">select Client</option>
			   <?php
				while($row1 = mysqli_fetch_row($result1))
				{ ?>
				   <option value="<?php echo $row1[1]; ?>"<?php if(isset($_POST['cid']) && $_POST['cid']==$row1[1]){ echo "selected"; }  ?> ><?php echo $row1[0]; ?></option>
			   <?php } ?>   </select></td>-->
			   <td>
			    From: <input type="text" name="frmdt" id="frmdt" value="<?php if(isset($_POST['frmdt'])){ echo $_POST['frmdt']; } ?>"  onclick="displayDatePicker('frmdt')" >&nbsp;
			    </td>
			    <td>
			    TO:<input type="text" name="todt" id="todt"  onclick="displayDatePicker('todt')" value="<?php if(isset($_POST['todt'])){ echo $_POST['todt']; } ?>" >&nbsp;
			    </td>
			   <td>
			  <input type="submit" name="sub" id="sub" value="Done" >
			   </td>
			  
			   </tr>
			   </table>
			   </form>
			   </center>
			     </br>
			     </br>
			     </br> 
			    <?php
			    include("config.php");
 			if(isset($_POST['sub']))
				 {
					?>
					
					<table  border="3" align="center" cellspacing="10" cellpadding="10">
					<tr><center>
				<th>Transactions ID</th>
				 <th>Amount</th>
				
				<th>View</th>
				
				
				</center>
				</tr>
				<?php
				 
				// $client=$_POST['cid'];
					 $frm=$_POST['frmdt'];
					 $to=$_POST['todt'];
		//echo "select * from siteinvoice where custid='".$client."' and billdate between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') ";
				$query=mysqli_query($con,"select distinct(tid) from rnmfundtransfers where status='0'  and pdate between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y')");
				$tidarr=array();
					while($row=mysqli_fetch_row($query))
					{
					$tidarr[]=$row[0];
					}
					//print_r($tidarr);
					for($i=0;$i<count($tidarr);$i++)
					{
					//echo "Select sum(approvedamt) from ebillfundrequests where req_no in(Select reqid from ebfundtransfers where tid='".$tidarr[$i]."')";
					$qryamt=mysqli_query($con,"Select sum(approvedamt) from quotation where quotid in(Select reqid from rnmfundtransfers where tid='".$tidarr[$i]."')");
					$amtres=mysqli_fetch_row($qryamt);
					?>
					<tr>
					<td><?php echo $tidarr[$i]; ?></td>
					<td><?php echo $amtres[0]; ?></td>
					<td><a href="viewrnmtransdet.php?id=<?php echo $tidarr[$i]; ?>" target="_blank"><input type='button' name="view" id="view" value="View Details" /></td>
					<td><a href="viewrnmtrans.php?transid=<?php echo $tidarr[$i]; ?>" target="_blank"><input type='button' name="view" id="view" value="View Bank Statement" /></td>
					</tr>
					<?php
					}
					?>	
					
				</table>
				</center>
				<?php	
				}
				?>
				
				
				
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>		
			</body>
			   </html>
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   