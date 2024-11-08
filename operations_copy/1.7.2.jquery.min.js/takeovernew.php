	<?php ini_set( "display_errors", 0);
	
	include("access.php");
	if(!isset($_SESSION['user']))
{
?>
<script type="text/javascript">
alert("Sorry, your session has Expired");
window.location='index.php';
</script>
<?php
}	
	// header('Location:managesite1.php?id='.$id); 
	 
	include("config.php");
			       $cust=array();
$cust=explode(",",$_SESSION['custid']);
$cl='';
//print_r($cust);

for($i=0;$i<count($cust);$i++)
{
//echo $cust[i]." ".$i."<br>";
if($i==0)
$cl="'".$cust[$i]."'";
elseif($i==(count($cust)-1))
$cl.=",'".$cust[$i]."'";
else
$cl.=",'".$cust[$i]."'";

//echo $cl;
}
$client="SELECT contact_first, short_name FROM contacts where type='c'";
if($_SESSION['custid'])
$client.=" and short_name in($cl)";

$client.="  order by short_name ASC";

	$result1 = mysqli_query($con,$client);		
	//$result2 = mysqli_query($con,"SELECT DISTINCT bank FROM sites");		
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
	
	<script src="datepicker/datepick_js.js" type="text/javascript"></script>
	
	<script type="text/javascript">
	///////////////////////////////search 
	function showebdet(id){
	//alert(id)
	if(document.getElementById(id).checked==true)
	{
	document.getElementById('ebdet1').style.display='block';
	//document.getElementById('ebdet2').style.display='block';
	}
	else{
	document.getElementById('ebdet1').style.display='none';
	//document.getElementById('ebdet2').style.display='none';
	}
	}
	  
	</script>
	
<script>
function checkcb(id)
{
//alert(id);
	if (document.getElementById(id).checked==true)
	  {
		 document.getElementById('t1').value=Number(document.getElementById('t1').value)+1;
		 
        }
		 else 
		 {
            document.getElementById('t1').value=Number(document.getElementById('t1').value)-1;
        }
	
	
}
function validateform()
{
//alert("hi");
if(document.getElementById('cid').value=='')
{
	alert("Please Select Client");
	document.getElementById('cid').focus();
	return false;
}		
if(document.getElementById('atmid').value=='')
{
	alert("Please Enter ATM ID");
	document.getElementById('atmid').focus();
	return false;
}

if(document.getElementById('takeoverdate').value=='')
{
	alert("Please Select Takeover Date");
	document.getElementById('takeoverdate').focus();
	return false;
}
if(document.getElementById('t1').value=='0')
{
	alert("Please Select Service for this site");
	document.getElementById('c1').focus();
	return false;
}
if(document.getElementById('project').value=='')
{
	document.getElementById('project').value='Other Bank';
}	
if(document.getElementById('siteaddress').value=='')
{
	alert("Please Enter Address");
	document.getElementById('siteaddress').focus();
	return false;
}
if(document.getElementById('bank').value=='')
{
	alert("Please Select Bank");
	document.getElementById('bank').focus();
	return false;
}
/*if(document.getElementById('c4').checked==true){
//cons,dist,land,meter
if(document.getElementById('cons').value=='')
{
alert("Please Enter Consumer Number");
	document.getElementById('cons').focus();
	return false;
}
if(document.getElementById('land').value=='')
{
alert("Please Enter Landlord Name");
	document.getElementById('land').focus();
	return false;
}
if(document.getElementById('meter').value=='')
{
alert("Please Enter Meter Number");
	document.getElementById('meter').focus();
	return false;
}
}*/
return true;
}
function gethistory(field,val)
{
//alert(field+" "+val);
if(val!=''){
var xmlhttp;
document.getElementById("atmhistory").innerHTML="Please wait while we generate history report for this Atm";
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	
//alert(xmlhttp.responseText);
document.getElementById("atmhistory").innerHTML=xmlhttp.responseText;	
    }
  }
 //var rem=document.getElementById("rem"+cnt).value;
//alert("atmhistory.php?val="+val+"&field="+field);
xmlhttp.open("GET","atmhistory.php?val="+val+"&field="+field,true);
xmlhttp.send();
}
}
</script>

	</head>
	<body >
	
	
	<center>
	<?php  include("menubar.php"); ?>
	
	<form name="frm1" method="post" action="processtakeover1.php" onsubmit="return validateform();" enctype="multipart/form-data">
	  <h2 class="style1">TAKEOVER FORM</h2>
	
	
	<table border="1">
	
	<tr><td colspan='4' id="atmhistory"></td></tr>
	<tr><td align="center" colspan="4">
	<center>ATM ID: <input type="text" maxlength="50" size="30" name="atmid" id="atmid" onblur="gethistory('atm_id1',this.value);">&nbsp;&nbsp;&nbsp;    ATM ID2: <input type="text" maxlength="50" size="30" name="atmid2">&nbsp;</center></tr><tr><td>
			 Client :<?php //echo $_SESSION['custid']; ?>
			  <select name="cid" id="cid" onchange="searchById('Listing','1','');getproj(this.value);" >
			  <?php if($_SESSION['custid']=='all'){ ?><option value="">select Client</option><?php } ?>
			   <?php
				while($row1 = mysqli_fetch_row($result1))
				{ ?>
				   <option value="<?php echo $row1[1]; ?>" ><?php echo $row1[0]; ?></option>
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
$bb='';
for($i=0;$i<count($bank);$i++)
				{ 
if($i==0)
$bb=$bb."".$bank[$i];
else
$bb=$bb.",".$bank[$i];
 }
//echo $bb;
			   ?>
			   <select name="bank" id="bank" >  <option value="" >Select Bank</option>
			   
				<?php
				$bkk="select bank_name,bank from bank order by bank ASC";
			   //echo $pojct;
			  $bkkr=mysqli_query($con,$bkk);
 while($bkkro=mysqli_fetch_array($bkkr))
			  {
			  ?>
			  <option value="<?php echo $bkkro[0];  ?>" title="<?php echo $bkkro[1]."(".$bkkro[0].")";  ?>"><?php echo $bkkro[1]."(".$bkkro[0].")";  ?></option>
			  <?php
			  }
				/*for($i=0;$i<count($bank);$i++)
				{ ?>
				   <option value="<?php echo $bank[$i]; ?>"><?php echo $bank[$i]; ?></option>
			   <?php }*/ ?> 
			   <option value="">Other Bank</option> 
											 
			   </select></td><td colspan="2" align="center">Project :
			   <?php 
			   
			   $pojct="select project from projects where project<>'Other Bank' and status=0";
			   //echo $pojct;
			  $pro=mysqli_query($con,$pojct);
			  if(!$pro)
			  echo mysqli_error();
			    ?>
			  <select name="project" id="project"><option value="Other Bank">Other Bank</option>
			  <?php
			  
			  
			  while($proj=mysqli_fetch_array($pro))
			  {
			  ?>
			  <option value="<?php echo $proj[0];  ?>"><?php echo $proj[0];  ?></option>
			  <?php
			  }
			  ?>
			  </select></td></tr>
			   
		   <tr><td height="64" colspan="4"> <input type="hidden" id="t1" value="0" readonly />
	<center><input type="checkbox" name="checkbox1" id="c1" onclick="checkcb(this.id);">Care Taker&nbsp;&nbsp;
			   <input type="checkbox" name="checkbox2" id="c2" onclick="checkcb(this.id);">House Keeping&nbsp;&nbsp;
			   <input type="checkbox" name="checkbox3" id="c3" onclick="checkcb(this.id);">Maintenance&nbsp;&nbsp;
				<input type="checkbox" name="checkbox4" id="c4" onclick="checkcb(this.id);showebdet(this.id);">Ebill&nbsp;&nbsp;
				</center>
			   </td></tr>
			   <tr><td>City category:</td><td>
				<select name="citycat" style="width=200px">
				<option value="">NA</option>
				<option value="A">A</option>
				<option value="B">B</option>
				<option value="C">C</option>
				
				</select></td>
				<td>Sub category</td>
				<td>
				<select name="subcat" style="width=200px">
				<option value="">NA</option>
				<option value="24 HR">24 HR</option>
				<option value="16 HR">16 HR</option>
				
				</select>
				</td>
				</tr>
			   <tr><td valign="middle" align="right">Remarks:</td><td colspan="3"> <textarea rows="8" cols="120" name="remarks"></textarea></td></tr>
				
			   <tr><td>
				
				</td><td>
				 Local Branch: <select name="localbranch" id="localbranch">
<option value="">Local branch</option>
<?php $localbr=mysqli_query($con,"select distinct(csslocalbranch) from csslocalbranch order by csslocalbranch ASC");
while($localbrro=mysqli_fetch_array($localbr))
{
?>
<option value="<?php echo $localbrro[0]; ?>"><?php echo $localbrro[0]; ?></option>
<?php
}
 ?>
</select></td><td width="252">
				&nbsp;Site ID: 
				<input type="text" name="siteid"></td><td width="260"> Site Type: 
				  <input type="text" name="sitetype">&nbsp;</td></tr>
				 
			   <tr><td valign="middle" align="right" colspan="1">
				 
				 Site Address: </td><td colspan="3"><textarea rows="8" cols="120" name="siteaddress" id="siteaddress" ></textarea>&nbsp;</td></tr>
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
				<tr><td colspan="1" align="center"> Region:</td><td>
<select name="region" id="region">
<option value="">Select Region</option>
<?php $reg=mysqli_query($con,"select distinct(area) from csslocalbranch order by area ASC");
while($regro=mysqli_fetch_array($reg))
{
?>
<option value="<?php echo $regro[0]; ?>"><?php echo $regro[0]; ?></option>
<?php
}
 ?>
</select>
 <!--<input type="text" name="region">--></td><td colspan="1" align="left">Location:<input type="text" name="location"></td>
				<td>Takeover Date: <input type="text" name="takeoverdate" id="takeoverdate" readonly onclick="displayDatePicker('takeoverdate')" required /></td>
				</tr><tr><td>CSS Local Supervisor Name:</td><td> <input type="text" name="clsn"></td><td>CSS Local Supervisor Number:</td><td> <input type="text" name="clsp"></td></tr>
				
				
				
				<tr><td colspan="4"><table id="ebdet1" style="display:none">
				<tr><td>Consumer Number</td><td><input type="text" name="cons" id="cons"></td>
				<td>Distributor</td><td><input type="text" name="dist" id="dist"></td></tr>
				<tr><td>Landlord</td><td><input type="text" name="land" id="land"></td>
				<td>Meter Number</td><td><input type="text" name="meter" id="meter"></td></tr>
				
				</td></tr>
				
				
				
				
				
				</table>
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
							   <tr><td colspan="4" align="center"><input type="submit" value="submit" name="submit"  /></td></tr>
				 </table>
				 
				 
				
				  
					 
					
								</form>
								  
	
	
	
	</center>
	
	<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
	
	</body>
	</html>