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
	<title>View Bill</title>
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
	<h2 class="style1" align="center">VIEW BILL</h2>
	<table border="3" align="center"><tr>
	<td>
	<?php $cop=mysqli_query($con,"select * from company_details");
	
	 ?><select name="comp" id="comp"><?php while($compro=mysqli_fetch_array($cop)){ ?>
	 <option value="<?php echo $compro[0]; ?>" <?php if($_POST['comp']==$compro[0]){ echo "selected"; } ?>><?php echo $compro[1]; ?></option><?php } ?>
	 </select>
	</td>
	<td width="209" align="center">
		 Client :
			  <select name="cid" id="cid" onchange="searchById('Listing','1','');getproj(this.value);" ><option value="">select Client</option>
			   
<?php
				while($row1 = mysqli_fetch_row($result1))
				{ ?>
				   <option value="<?php echo $row1[1]; ?>"<?php if(isset($_POST['cid']) && $_POST['cid']==$row1[1]){ echo "selected"; }  ?> ><?php echo $row1[0]; ?></option>
			   <?php } ?>   </select></td>
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
				<th>Invoice ID</th>
				 <th>ATM ID</th>
				<th>Bank</th>
				<th>Amount</th>
				<th>View Annexure</th>
				
				
				</center>
				</tr>
				<?php
				 
				 $client=$_POST['cid'];
					 $frm=$_POST['frmdt'];
					 $to=$_POST['todt'];
		//echo "select * from siteinvoice where custid='".$client."' and billdate between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') ";
$siteinv="select * from siteinvoice where  billdate between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') ";
if(isset($_POST['cid']) && $_POST['cid']!='' && $_POST['cid']!='-1')
$siteinv.=" and custid='".$client."'";
if(isset($_POST['comp']) && $_POST['comp']!='' && $_POST['comp']!='-1')
$siteinv.=" and compid='".$_POST[comp]."'";

				$query=mysqli_query($con,$siteinv);
					while($row=mysqli_fetch_row($query))
					{
					
					$service=$row[6];	
					?><tr>
					<td>
					<?php if($row[1]=='1'){ echo "CSS"; }elseif($row[1]=='2'){ echo "C&C"; }elseif($row[1]=='3'){ echo "CS"; }?>/<?php if($service=='caretaker'){ echo "CT"; }elseif($service=='housekeeping'){ echo "HK"; }elseif($service=='maintenance' || $service=='maintenance HK' || $service=='maintenance CT'){ echo "FM"; }elseif($service=='Repair&Maintenance'){ echo "RNM"; } ?>/<?php echo $row[0]; ?>/<?php echo $row[16]; ?>
					<?php //echo $row[0]; ?></td>
					<td><?php echo $row[2]; ?></td>
					<td> <?php if($row[3]==-1) echo "All" ; else echo $row[3]; ?></td>
					<td><?php echo $row[7]; ?></td>
					
			<td><?php if($row[9]=='10'){ echo "cancelled"; }elseif($row[9]=='0'){ ?><a href="viewannexureme.php?id=<?php echo $row[0]; ?>&compid=<?php echo $_POST['comp']; ?>" target="_blank"><input type='button' name="view" id="view" value="View Annexure" /></a><?php } ?></td>
			
			
			
						</tr><?php
					}
					
					?>
				</table>
				</center><?php	
				}
				?>
				
				
				
		<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>		
			</body>
			   </html>
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   