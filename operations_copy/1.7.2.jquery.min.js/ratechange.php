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
function getcat(val)
{
//alert(val);
var xmlhttp;
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
alert(xmlhttp.responseText);
var str=xmlhttp.responseText;
var st2=str.split("******");
alert(st2[2]);
   // document.getElementById("citycat").innerHTML=st2[0];
    document.getElementById("citycat2").innerHTML=st2[0];
  //  document.getElementById("bank").innerHTML=st2[1];
    
    //document.getElementById("subcat").innerHTML=st2[2];
document.getElementById("newsubcat").innerHTML=st2[2];
//document.getElementById("oldsubcat").innerHTML=st2[2];
document.getElementById("zone").innerHTML=st2[3];
document.getElementById("project").innerHTML=st2[4];
    }
  }
  //alert("getcitycat.php?cid="+val);
  alert("http://cssmumbai.sarmicrosystems.com/ebill/getcitycat.php?cid="+val);
xmlhttp.open("GET","http://cssmumbai.sarmicrosystems.com/ebill/getcitycat.php?cid="+val,true);
xmlhttp.send();
}

	function getdata(cid,cat,bank,subcat) {
//alert(val);
if(document.getElementById(cid).value=='' || document.getElementById(cat).value=='-1')
{
//alert("Please select Client");
document.getElementById('err').innerHTML="<h2>Please select Client</h2>";
}
else
{
var xmlhttp;
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
    document.getElementById("atm").innerHTML=xmlhttp.responseText;
    }
  }
  var cid=document.getElementById(cid).value;
  var cat=document.getElementById(cat).value;
  var bank=document.getElementById(bank).value;
  var subcat=document.getElementById(subcat).value;
			//var url = 'getsiteatm.php'; 
		
			//var pmeters = 'cid='+cid+'&cat='+val;
	//alert("getsiteatm.php?cid="+cid+"&cat="+cat+"&bank="+bank+"&subcat+"+subcat);	
xmlhttp.open("GET","getsiteatm.php?cid="+cid+"&cat="+cat+"&bank="+bank+"&subcat="+subcat,true);
xmlhttp.send();

		  	
			
		}
  }
  
  function validate()
  {
  if(document.getElementById('cid').value=='')
  {
  alert("Please Select Client ");
  return false;
  }
  if(document.getElementById('citycat').value=='-1')
  {
  alert("Please Select Old City Category ");
  return false;
  }
  if(document.getElementById("atm").innerHTML=='')
  {
  alert("Atm ID's cannot be blank ");
  return false;
  }
   if(document.getElementById('citycat2').value=='-1')
  {
  alert("Please Select New City Category ");
  return false;
  }
   if(document.getElementById('service').value=='')
  {
  alert("Please select Service ");
  return false;
  }
   if(document.getElementById('newrate').value=='0' || document.getElementById('newrate').value=='' )
  {
  alert("Please Enter New Rate ");
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
	include("menubar.php");
	 ?>
	
	<form name="frm1" method="post" action="processratechange.php" enctype="multipart/form-data" onsubmit="return validate()">
	  <h2 class="style1">Site rate Change Form</h2>
	
	<p align="center" id="err"></p>
	<table><tr><td valign="top">
	<table border="1"><tr><td width="209" align="center">
			 Client :</td><td>
			  <select name="cid" id="cid" onchange="getcat(this.value);"><option value="">select Client</option>
			   <?php
				while($row1 = mysqli_fetch_row($result1))
				{ ?>
				   <option value="<?php echo $row1[1]; ?>"<?php //if(isset($_GET['cid'])){ if($_GET['cid']==$row1[0]){ echo "selected"; } } ?> ><?php echo $row1[0]; ?></option>
			   <?php } ?>   </select></td>
              </tr>
<!--<tr><td align="center">City Category</td><td><select name="citycat" id="citycat" onchange="getdata('cid','citycat','bank','subcat');">
<option value="-1">City Category</option>
</select></td></tr>
				 <tr><td>Select Bank</td><td>
				 <select name="bank" id="bank" onchange="getdata('cid','citycat','bank','subcat');">
				 <option value="-1">Select Bank</option>
				 </select>
				 </td></tr>
				 <tr><td>Select Subcategory</td><td>
				 <select name="subcat" id="subcat" onchange="getdata('cid','citycat','bank','subcat');">
				 <option value="-1">Select Subcategory</option>
				 </select>
				 </td></tr>-->
			   <tr><td valign="middle" align="center" colspan="1">
				 
				 Atm ID: </td><td colspan=""><textarea rows="8" cols="80" name="atm" id="atm"></textarea>&nbsp;</td></tr>
				<tr><td align="center">Zone</td><td><select name="zone" id="zone">
<option value="-1">Zone</option>

</select></td></tr>
<tr><td align="center">Project ID</td><td><select name="project" id="project">
<option value="-1">Select Project</option>
</select></td></tr>
				
				<tr><td align="center">Change City Category To</td><td><select name="citycat2" id="citycat2">
<option value="-1">City Category</option>
</select></td></tr>
<tr><td align="center">Select Services</td><td><select name="service" id="service">
<option value="-1">Services</option>
<option value="caretaker">Caretaker</option>
<option value="maintenance">Maintenance</option>
<option value="housekeeping">Housekeeping</option>
</select></td></tr>
<tr><td align="center">Active/Inactive</td><td><select name="act" id="act">
<option value="-1">No Change</option>
<option value="Y">Active</option>
<option value="N">Inactive</option>

</select></td></tr>
<tr><td>Takeover date</td><td><input type="text" name="tkdt" id="tkdt" value="00/00/0000"></td></tr>
<tr><td>Handover date</td><td><input type="text" name="hodt" id="hodt" value="00/00/0000"></td></tr>
<tr><td>New Subcategory</td><td>
				 <select name="newsubcat" id="newsubcat">
				 <option value="-1">Select Subcategory</option>
				 </select>
				 </td></tr>
<!--<tr><td>New Rate</td><td><input type="text" name="rate" id="rate" value=""></td></tr>-->

	  
				 </table></td><!--<td valign="top">
				 <table>
				 <tr><td colspan=2 align="center"><h2>Previous Rates</h2></td></tr>
<tr><td>Old Subcategory</td><td>
				 <select name="oldsubcat" id="oldsubcat">
				 <option value="-1">Select Old Subcategory</option>
				 </select>
				 </td></tr>
<tr><td>Old Rate Till Date</td><td><input type="text" name="rtdt" id="rtdt" value="00/00/0000"></td></tr>
<tr><td>Previous Rate</td><td><input type="text" name="chngrate" id="chngrate" value=""></td></tr>
				 
				 </td></tr></table>--></td></tr>
				  <tr><td colspan="6" align="center">
	 <input type="submit" value="submit" name="submit" onclick="return validate();" /></td></tr>
				 </table>
				 
				 
				
				  
					 
					
								</form>
								  
	
	
	
	</center>
	
	
	<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
	</body>
	</html>