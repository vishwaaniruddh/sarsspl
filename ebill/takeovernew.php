	<?php ini_set( "display_errors", 0);
	
	include("access.php");
	
	
	// header('Location:managesite1.php?id='.$id); 
	 
	include("config.php");
	
	$result1 = mysqli_query($con,"SELECT contact_first, short_name FROM contacts where type='c' order by short_name ASC");		
	$result2 = mysqli_query($con,"SELECT DISTINCT bank FROM sites");		
	 ?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Sites</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="menu.css" rel="stylesheet" type="text/css" />
	<!--datepicker-->
	<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
	
	
	</script>
	<script src="datepicker/datepick_js.js" type="text/javascript"></script>
	
	<script type="text/javascript">
	///////////////////////////////search 
	
	  
	</script>
	</head>
	<body >
	
	
	<center>
	<?php
	//echo $_SESSION['branch'];
	 ?>
	
	<form name="frm1" method="post" action="processtakeover1.php" enctype="multipart/form-data">
	  <h2 class="style1">TAKEOVER FORM</h2>
	
	
	<table border="1"><tr><td width="209" align="center">
			 Client :
			  <select name="cid" id="cid" onchange="searchById('Listing','1','');getproj(this.value);" ><option value="">select Client</option>
			   <?php
				while($row1 = mysqli_fetch_row($result1))
				{ ?>
				   <option value="<?php echo $row1[1]; ?>"<?php //if(isset($_GET['cid'])){ if($_GET['cid']==$row1[0]){ echo "selected"; } } ?> ><?php echo $row1[0]; ?></option>
			   <?php } ?>   </select></td><td width="244" align="center"> Bank :
			   <?php
			   $bank=array();
			   $zone=array();
				$cid=mysqli_query($con,"Select short_name from contacts where type='c'");
				if(!$cid)
				echo mysqli_error();
				$ar=0;
				$ab=0;
				while($cro=mysqli_fetch_row($cid))
				{
			//	echo "SHOW TABLES LIKE '".$cro[0]."_sites'";
			$chk=mysqli_query($con,"SHOW TABLES LIKE '".$cro[0]."_sites'");
				//echo mysqli_num_rows($chk)."<br>";
				if(mysqli_num_rows($chk)>0)
				{
				$ab=$ab+1;
				
				//echo "select distinct(bank) from ".$cro[0]."_sites where bank<>'' order by bank ASC";
				$pr=mysqli_query($con,"select distinct(bank) from ".$cro[0]."_sites where bank<>'' order by bank ASC");
				//echo "select distinct(bank) from ".$cro[0]."_sites order by bank ASC";
				if(mysqli_num_rows($pr)>0){
				
				while($pro=mysqli_fetch_array($pr))
				{
				//echo $pr[0];
				if(in_array($pro[0],$bank))
				{
				}
				else
				$bank[]=$pro[0];
				//echo "<br>";
				
				}
				}
				
				$zn=mysqli_query($con,"select distinct(zone) from ".$cro[0]."_sites where zone<>'' order by zone ASC");
				//echo "select distinct(bank) from ".$cro[0]."_sites order by bank ASC";
				if(mysqli_num_rows($zn)>0){
				
				while($znr=mysqli_fetch_array($zn))
				{
				//echo $pr[0];
				if(in_array($znr[0],$zone))
				{
				}
				else
				$zone[]=$znr[0];
				//echo "<br>";
				
				}
				}
				}
				}
			   ?>
			   <select name="bank" id="bank" >  <option value="" >Select Bank</option>
			   
				<?php
				
				for($i=0;$i<count($bank);$i++)
				{ ?>
				   <option value="<?php echo $bank[$i]; ?>"><?php echo $bank[$i]; ?></option>
			   <?php } ?> 
			   <option value="">Other Bank</option> 
											 
			   </select></td><td colspan="2" align="center">Project :
			  <input type="text" name="project" id="project" ></td></tr>
			   
		   <tr><td height="64" colspan="4">
	<center><input type="checkbox" name="checkbox1">Care Taker&nbsp;&nbsp;
			   <input type="checkbox" name="checkbox2">House Keeping&nbsp;&nbsp;
			   <input type="checkbox" name="checkbox3">Maintenance&nbsp;&nbsp;
				<input type="checkbox" name="checkbox4">Ebill&nbsp;&nbsp;
				</center>
			   </td></tr><tr><td>
				<center>
				 ATM ID: <input type="text" name="atmid">&nbsp;</center></td><td>
				 Local Branch: <input type="text" name="localbranch">&nbsp;</td><td width="252">
				&nbsp;Site ID: 
				<input type="text" name="siteid"></td><td width="260"> Site Type: 
				  <input type="text" name="sitetype">&nbsp;</td></tr>
				 
			   <tr><td valign="middle" align="right" colspan="1">
				 
				 Site Address: </td><td colspan="3"><textarea rows="8" cols="120" name="siteaddress"></textarea>&nbsp;</td></tr>
				 <tr><td align="center"> State: <select name="state" id="state"    ><option value="">select State</option>
				 
				 
				   <?php 
	
			   $sqlstate = "SELECT distinct state FROM state";
	
		   $resultstate = mysqli_query($con,$sqlstate);
	
			   while($rowstate = mysqli_fetch_row($resultstate))
	
			{
	
					   ?>            <option value="<?php echo $rowstate[0] ; ?>" ><?php echo $rowstate[0] ; ?></option>
	
					   <?php } ?></select></td><td align="center"> City: <select name="city" id="city"    ><option value="">select City</option>
				   
					<?php 
	
			   $sqlcity = "SELECT distinct city FROM sites";
	
		   $resultcity = mysqli_query($con,$sqlcity );
	
			   while($rowcity = mysqli_fetch_row($resultcity ))
	
			{
	
					   ?>            <option value="<?php echo $rowcity [0] ; ?>" ><?php echo $rowcity [0] ; ?></option>
	
					   <?php } ?></select></td><td colspan="" align="left">Zone: <select name="zone" id="zone"    ><option value="">select Zone</option>
					   <?php
					   for($i=0;$i<count($zone);$i++)
					   {
					   ?>
				   <option value="<?php echo $zone[$i]; ?>"><?php echo $zone[$i]; ?></option>
			   <?php
					   }
					   ?>
					   <option value="">Other</option>
					   </select></td><td></td></tr>
				<tr><td colspan="1" align="center"> Region:</td><td> <input type="text" name="region"></td><td colspan="1" align="left">Location:<input type="text" name="location"></td>
				<td>Takeover Date: <input type="text" name="takeoverdate" id="takeoverdate"  onclick="displayDatePicker('takeoverdate')" /></td>
				</tr><tr><td>CSS Local Supervisor Name:</td><td> <input type="text" name="clsn"></td><td>CSS Local Supervisor Number:</td><td> <input type="text" name="clsp"></td></tr>
				<tr><td valign="middle" align="right">Remarks:</td><td colspan="3"> <textarea rows="8" cols="120" name="remarks"></textarea></td></tr>
				<tr><td colspan="4" align="center"><h2 class="style1">ASSETS</h2></td></tr>
				<tr>
				<td colspan="2" align="left"> NUMBER OF ATM :<input type="text" name="noatm"></td>
				<td colspan="2" align="left">PHONE: <input type="text" name="phone"></td>
				</tr>
				<tr><td colspan="4">A/C: <input type="text" maxlength="5" size="8" name="ac">&nbsp;
						 FIRE EXTINGUISHER: <input type="text" maxlength="5" size="8" name="fire">&nbsp;
						 EXHAUST FAN :<input type="text" maxlength="5" size="8" name="exhaustfan">&nbsp;
					   UPS:<input type="text" maxlength="5" size="8" name="ups">&nbsp;
						 NUMBER OF BATTERY: <input type="text" maxlength="5" size="8" name="nobattery">&nbsp;
						  I D U: <input type="text" maxlength="5" size="8" name="idu">&nbsp;
						   STABILIZER: <input type="text" maxlength="5" size="8" name="stabilizer">&nbsp;
							IMUERTER: <input type="text" maxlength="5" size="8" name="imuerter"></td></tr>
							<tr><td colspan="4">DUSTBIN: <input type="text" maxlength="5" size="8" name="dustbin">&nbsp;
							  DOORMAT: <input type="text" maxlength="5" size="8" name="doormat">&nbsp;
							   CHAIR: <input type="text" maxlength="5" size="8" name="chair">&nbsp;</td></tr>
							   <tr><td colspan="1" align="center"> OTHER DETAILS:</td><td colspan="3" align="center"> <textarea rows="8" cols="120" name="otherdetails"></textarea></td></tr>
							   <tr><td colspan="4">Choose File : <input type="file" name="userfile" id="userfile" /></td></tr>
							   <tr><td colspan="4" align="center"><input type="submit" value="submit" name="submit" /></td></tr>
				 </table>
				 
				 
				
				  
					 
					
								</form>
								  
	
	
	
	</center>
	
	
	
	</body>
	</html>