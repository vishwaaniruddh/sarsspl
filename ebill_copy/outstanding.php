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
	<title>Outstanding</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="menu.css" rel="stylesheet" type="text/css" />
	<!--datepicker-->
	<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
	
	<script src="datepicker/datepick_js.js" type="text/javascript"></script>
	
	
	</head>
	<body >
	<center>
	<?php include("menubar.php");?>
	<form name="frm1" method="post" action="<?php $_SERVER['PHP-SELF']; ?>"  enctype="multipart/form-data" align="center">
	<h2 class="style1" align="center">OUTSTANDING</h2>
	<table border="3" align="center"><tr><td width="209" align="center">
		 Client :
			  <select name="cid" id="cid" onchange="searchById('Listing','1','');getproj(this.value);" ><option value="">select 

Client</option>
		<option value="-1" <?php if(isset($_POST['cid']) && $_POST['cid']==-1){ echo 

"selected"; }  ?>>ALL</option>
			   <?php
				while($row1 = mysqli_fetch_row($result1))
				{
				
				
				 ?>
				   <option value="<?php echo $row1[1]; ?>"<?php if(isset($_POST['cid']) && $_POST['cid']==$row1[1]){ echo 

"selected"; }  ?> ><?php echo $row1[0]; ?></option>
			   <?php } ?>   </select></td>
			   <td>
			    From: <input type="text" name="frmdt" id="frmdt" value="<?php if(isset($_POST['frmdt'])){ echo $_POST['frmdt']; } ?>"  

onclick="displayDatePicker('frmdt')" >&nbsp;
			    </td>
			    <td>
			    TO:<input type="text" name="todt" id="todt"  onclick="displayDatePicker('todt')" value="<?php if(isset($_POST['todt'])){ 

echo $_POST['todt']; } ?>" >&nbsp;
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
				
				<th>Customer</th>
				<th>Balance</th>
			
				</center>
				</tr>
				<?php
				 
				 $client=$_POST['cid'];
				  $frm=$_POST['frmdt'];
					 $to=$_POST['todt'];
				 
				 if($client=='-1')
				 {
				 /*echo  "select sum(amt),custid from siteinvoice where  billdate between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') group by custid ";*/
				  $query=mysqli_query($con,"select sum(amt),custid from siteinvoice where  billdate between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') group by custid ");
				 }
				 else
				 {
				 $query=mysqli_query($con, "select sum(amt),custid from siteinvoice where custid='".$client."' and billdate between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') ");
				 }
					 
		//echo "select * from siteinvoice where custid='".$client."' and billdate between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') ";
				
					while($row=mysqli_fetch_row($query))
					{
					//echo "Select contact_first FROM contacts where short_name='".$row[1]."' and type='c'";
					$qry=mysqli_query($con,"Select contact_first FROM contacts where short_name='".$row[1]."' and type='c'");
				 $res=mysqli_fetch_row($qry);
						
					?><tr>
					
					<td><?php echo $res[0]; ?></td>
					<td><?php echo $row[0]; ?></td>
					
				
			<!--<td><a href="viewannexureme.php?id=<?php echo $row[0]; ?>" target="_blank"><input type='button' name="view" 

id="view" value="View Annexure" /></td>
			
			<td> <input type="button" name="edit" id="edit" value="Edit"></td>-->
			
						</tr><?php
					}
					
					?>
				</table>
				</center><?php	
				}
				?>
				
				<div id="search">

</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
				
				
			</body>
			   </html>
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   