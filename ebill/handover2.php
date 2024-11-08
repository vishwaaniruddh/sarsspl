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
	function getdata(val) {
//alert(val);
if(document.getElementById('cid').value=='')
{
//alert("Please select Client");
document.getElementById('err').innerHTML="<h2>Please select Client</h2>";
}
else
{
document.getElementById('err').innerHTML="";
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
 
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
		 // var br=document.getElementById('br').value;
		  var cid=document.getElementById('cid').value;
		  var atm=document.getElementById('atmid').value;
		//  var calltype=document.getElementById('calltype').value;
	
			
			var url = 'getsitedata.php'; 
	
		    var pmeters="";
			
			
				 pmeters = 'cid='+cid+'&atmid='+atm;
			
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert(pmeters); 
			HttPRequest.onreadystatechange = function()
			{
 
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
		//alert(response);
		if(response!='0'){
 var str=response.split("****");
 //alert(str[0]+" "+str[1]);
 document.getElementById('bank').value=str[0];
 document.getElementById('project').value=str[1];
 document.getElementById('localbranch').value=str[6];
 document.getElementById('siteid').value=str[7];
 document.getElementById('sitetype').value=str[8];
 document.getElementById('siteaddress').value=str[9];
 document.getElementById('state').value=str[10];
 document.getElementById('city').value=str[11];
 document.getElementById('zone').value=str[12];
 document.getElementById('region').value=str[13];
 document.getElementById('location').value=str[14];
 document.getElementById('takeoverdate').value=str[15];
 document.getElementById('clsn').value=str[16];
 document.getElementById('clsp').value=str[17];
 document.getElementById('remarks').value=str[18];
  document.getElementById('trackerid').value=str[19];
 if(str[2]=='Y')
  document.getElementById('checkbox1').checked=true;
  if(str[3]=='Y')
  document.getElementById('checkbox2').checked=true;
  if(str[4]=='Y')
  document.getElementById('checkbox3').checked=true;
  if(str[5]=='Y')
  document.getElementById('checkbox4').checked=true;
 }
 else
 {
 document.getElementById('err').innerHTML="Invalid Atm ID";
 document.getElementById('bank').value='';
 document.getElementById('project').value='';
 document.getElementById('localbranch').value='';
 document.getElementById('siteid').value='';
 document.getElementById('sitetype').value='';
 document.getElementById('siteaddress').value='';
 document.getElementById('state').value='';
 document.getElementById('city').value='';
 document.getElementById('zone').value='';
 document.getElementById('region').value='';
 document.getElementById('location').value='';
 document.getElementById('takeoverdate').value='';
 document.getElementById('clsn').value='';
 document.getElementById('clsp').value='';
 document.getElementById('remarks').value='';
  document.getElementById('trackerid').value='';

  document.getElementById('checkbox1').checked=false;
  
  document.getElementById('checkbox2').checked=false;
 
  document.getElementById('checkbox3').checked=false;
  
  document.getElementById('checkbox4').checked=false;
 }
				  //document.getElementById("search").innerHTML = response;
			  }
		}
		}
  }
  
  function validate()
  {
  if(document.getElementById('trackerid').value=='')
  {
  alert("This site has no tracker id ");
  return false;
  }
  return true;
  }
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
	
	<form name="frm1" method="post" action="processhandover1.php" enctype="multipart/form-data" onsubmit="return validate()">
	  <h2 class="style1">HANDOVER FORM</h2>
	
	<p align="center" id="err"></p>
	<table border="1"><tr><td width="209" align="center">
			 Client :
			  <select name="cid" id="cid" ><option value="">select Client</option>
			   <?php
				while($row1 = mysqli_fetch_row($result1))
				{ ?>
				   <option value="<?php echo $row1[1]; ?>"<?php //if(isset($_GET['cid'])){ if($_GET['cid']==$row1[0]){ echo "selected"; } } ?> ><?php echo $row1[0]; ?></option>
			   <?php } ?>   </select></td>
               <td>ATM ID: <input type="text" name="atmid" id="atmid" onblur="getdata(this.value)">&nbsp;</td>
               <td width="244" align="center"> Bank :
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
               <input type="text" name="bank" id="bank" readonly="readonly" />
			   <!--<select name="bank" id="bank" >  <option value="" >Select Bank</option>
			   
				<?php
				
				for($i=0;$i<count($bank);$i++)
				{ ?>
				   <option value="<?php echo $bank[$i]; ?>"><?php echo $bank[$i]; ?></option>
			   <?php } ?> 
			   <option value="">Other Bank</option> 
											 
			   </select>--></td><td colspan="1" align="center">Project :
			  <input type="text" name="project" id="project"  readonly="readonly"></td></tr>
			   
		   <tr><td height="64" colspan="4">
	<center>
	<input type="hidden" name="ct" id="ct">
	<input type="hidden" name="hk" id="hk">
	<input type="hidden" name="mn" id="mn">
	<input type="hidden" name="eb" id="eb">
	<input type="checkbox" name="checkbox1" id="checkbox1" onclick="return false">Care Taker&nbsp;&nbsp;
			   <input type="checkbox" name="checkbox2" id="checkbox2" onclick="return false">House Keeping&nbsp;&nbsp;
			   <input type="checkbox" name="checkbox3" id="checkbox3" onclick="return false">Maintenance&nbsp;&nbsp;
				<input type="checkbox" name="checkbox4" id="checkbox4" onclick="return false">Ebill&nbsp;&nbsp;
				</center>
			   </td></tr><tr><td>
				<center>
				&nbsp;</center></td><td>
				 Local Branch: <input type="text" name="localbranch" id="localbranch" readonly="readonly">&nbsp;</td><td width="252">
				&nbsp;Site ID: 
				<input type="text" name="siteid" id="siteid" readonly="readonly"></td><td width="260"> Site Type: 
				  <input type="text" name="sitetype" id="sitetype" readonly="readonly">&nbsp;</td></tr>
				 
			   <tr><td valign="middle" align="right" colspan="1">
				 
				 Site Address: </td><td colspan="3"><textarea rows="8" cols="120" name="siteaddress" id="siteaddress"  readonly></textarea>&nbsp;</td></tr>
				 <tr><td align="center"> State: <input type="text" name="state" id="state" readonly="readonly"    ><!--<option value="">select State</option>
				 
				 
				   <?php 
	
			   $sqlstate = "SELECT distinct state FROM state";
	
		   $resultstate = mysqli_query($con,$sqlstate);
	
			   while($rowstate = mysqli_fetch_row($resultstate))
	
			{
	
					   ?>            <option value="<?php echo $rowstate[0] ; ?>" ><?php echo $rowstate[0] ; ?></option>
	
					   <?php } ?></select>--></td><td align="center"> City: <input type="text" name="city" id="city" ><!--<option value="">select City</option>
				   
					<?php 
	
			   $sqlcity = "SELECT distinct city FROM sites";
	
		   $resultcity = mysqli_query($con,$sqlcity );
	
			   while($rowcity = mysqli_fetch_row($resultcity ))
	
			{
	
					   ?>            <option value="<?php echo $rowcity [0] ; ?>" ><?php echo $rowcity [0] ; ?></option>
	
					   <?php } ?></select>--></td><td colspan="" align="left">Zone: <input type="text" name="zone" id="zone" readonly="readonly" /><!--<select name="zone" id="zone"    ><option value="">select Zone</option>
					   <?php
					   for($i=0;$i<count($zone);$i++)
					   {
					   ?>
				   <option value="<?php echo $zone[$i]; ?>"><?php echo $zone[$i]; ?></option>
			   <?php
					   }
					   ?>
					   <option value="">Other</option>
					   </select>--></td><td></td></tr>
				<tr><td colspan="1" align="center"> Region:</td><td> <input type="text" name="region" id="region" readonly="readonly"></td><td colspan="1" align="left">Location:<input type="text" id="location" name="location"></td>
				<td>Takeover Date: <input type="text" name="takeoverdate" id="takeoverdate" readonly="readonly"  /></td>
				</tr><tr><td>CSS Local Supervisor Name:</td><td> <input type="text" name="clsn" id="clsn" readonly="readonly"></td><td>CSS Local Supervisor Number:</td><td> <input type="text" name="clsp" id="clsp" readonly="readonly"></td></tr>
				<tr><td valign="middle" align="right">Remarks:</td><td colspan="3"> <textarea rows="8" cols="120" name="remarks" id="remarks"  readonly></textarea></td></tr>
				<tr><td colspan="4" align="center"><h2 class="style1">ASSETS</h2></td></tr>
				<tr>
				<td colspan="2" align="left"> NUMBER OF ATM :<input type="text" name="noatm" value="0"></td>
				<td colspan="2" align="left">PHONE: <input type="text" name="phone"></td>
				</tr>
				<tr><td colspan="4">A/C: <input type="text" maxlength="5" size="8" name="ac" value="0">&nbsp;
						 FIRE EXTINGUISHER: <input type="text" maxlength="5" size="8" name="fire" value="0">&nbsp;
						 EXHAUST FAN :<input type="text" maxlength="5" size="8" name="exhaustfan" value="0">&nbsp;
					   UPS:<input type="text" maxlength="5" size="8" name="ups" value="0">&nbsp;
						 NUMBER OF BATTERY: <input type="text" maxlength="5" size="8" name="nobattery" value="0">&nbsp;
						  I D U: <input type="text" maxlength="5" size="8" name="idu" value="0">&nbsp;
						   STABILIZER: <input type="text" maxlength="5" size="8" name="stabilizer" value="0">&nbsp;
							IMUERTER: <input type="text" maxlength="5" size="8" name="imuerter" value="0"></td></tr>
							<tr><td colspan="4">DUSTBIN: <input type="text" maxlength="5" size="8" name="dustbin" value="0">&nbsp;
							  DOORMAT: <input type="text" maxlength="5" size="8" name="doormat" value="0">&nbsp;
							   CHAIR: <input type="text" maxlength="5" size="8" name="chair" value="0">&nbsp;</td></tr>
							   <tr><td colspan="1" align="center"> OTHER DETAILS:</td><td colspan="3" align="center"> <textarea rows="8" cols="120" name="otherdetails"></textarea></td></tr>
							   <tr><td colspan="2">Choose File : <input type="file" name="userfile" id="userfile" /></td>
							  <td>HandOver Date</td><td><input type="text" name="handoverdate" id="handoverdate"  onclick="displayDatePicker('handoverdate')" /></td>
							   </tr>
							   <tr><td colspan="4" align="center"><input type="text" readonly="readonly" id="trackerid" name="trackerid" /><input type="submit" value="submit" name="submit" /></td></tr>
				 </table>
				 
				 
				
				  
					 
					
								</form>
								  
	
	
	
	</center>
	
	
	
	</body>
	</html>