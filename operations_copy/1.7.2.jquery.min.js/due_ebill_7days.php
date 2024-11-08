	<?php 
	 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept'];
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>CSS-<?php echo $_SESSION['user']; ?></title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="menu.css" rel="stylesheet" type="text/css" />
	<!--datepicker-->
	<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
	<script src="datepicker/datepick_js.js" type="text/javascript"></script>
	<script src="js/opener.js" type="text/javascript"></script>
	<script src="excel.js" type="text/javascript"></script>
	<script src="js/ajaxfileupload.js" type="text/javascript"></script>
	<script type="text/javascript">
	
	
	///////////////////////////////search 
	function searchById(a,b,perpg) {
		//alert("hii");
	/*var cid=document.getElementById('cid').value;//alert(cid);
			if(cid!='')
			{*/
	//alert(a+" "+b+" "+perpg);
	var ppg='';
	if(perpg=='')
	ppg='20';
	else
	ppg=document.getElementById(perpg).value;
	
	//alert(ppg);
	document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
	
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
			 
			//var sttype=document.getElementById('sttype').value;
				 if(a!="Loading"){
				 //var id=document.getElementById('id').value; //alert(id);
				var cid=document.getElementById('cid').value; //alert(cid);
				 //var bank=document.getElementById('bank').value;//alert(bank);
				 //var city=document.getElementById('city').value;//alert(city);
				// var area=document.getElementById('area').value;//alert(area);
				// var state=document.getElementById('state').value;//alert(state);
				 // var project=document.getElementById('project').value;//alert(state);
				// var pin=document.getElementById('pin').value;//alert(pin);
				//var add=document.getElementById('address').value;
				// var sdate=document.getElementById('sdate').value;//alert(sdate);
				 
				 //var edate=document.getElementById('edate').value;//alert(edate);
				  }
				////alert(document.getElementById('type').value);
				
				var url = 'search_ebll7.php';
				
		
			var pmeters="";
				//alert(url);
				//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
				if(a!="Loading"){ 
				pmeters = 'Page='+b+'&perpg='+ppg+'&cid'+cid;	
				}//alert("gg");
				else
				{
				pmeters = 'Page='+b+'&perpg='+ppg+'&cid'+cid;	
				}
				//alert(pmeters);
				HttPRequest.open('POST',url,true);
	
				HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				HttPRequest.setRequestHeader("Content-length", pmeters.length);
				HttPRequest.setRequestHeader("Connection", "close");
				HttPRequest.send(pmeters);
	 
	//alert("gg"); 
				HttPRequest.onreadystatechange = function()
				{
	 
				if(HttPRequest.readyState == 3)  // Loading Request
					  {
		document.getElementById("listingAJAX").innerHTML = '<img src="loader.gif" align="center" />';
					  }
	 
					 if(HttPRequest.readyState == 4) // Return Request
					  {
			var response = HttPRequest.responseText;
	 
	// alert(response);
					  document.getElementById("search").innerHTML = response;
				  }
			}
	/*  }
	  else
	  alert("Please Select Client");*/
	 }
	 
	
	</script>
	</head>
	
	<body onload="searchById('Listing','1','');" >
	
	<center>
	<?php 
	
	
	include("menubar.php");
	include("access.php");
	?>
	
	<h2 class="h2color">ELECTRIC BILLS TO BE PAID WITHIN SEVEN DAYS</h2>
	
	<!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>-->
		<br />
	<table  border="0" cellpadding="0" cellspacing="0">
	<tr>
	
	</tr>
	<tr>
	
	<th width="77">
	<?php
	    include("config.php");
        //$_SESSION['custid'];
	$cust=explode(",",$_SESSION['custid']);
	$cl1='';
	for($i=0;$i<count($cust);$i++)
	{
	
	if($i==0)
	$cl1="'".$cust[$i]."'";
	elseif($i==(count($i)-1))
	$cl1.=",'".$cust[$i]."'";
	else
	$cl1.=",'".$cust[$i]."'";
	
	}
	$cl="select distinct(cust_id),cust_name from newtempsites where 1";
	if($_SESSION['custid']!='all')
	$cl.=" and cust_id in ($cl1)";
	
	$cl.= " order by cust_name ASC";
	
	//echo $cl;
	?>
	<select name="cid" id="cid" onchange="searchById('Listing','1','');"/>
    
	<?php
	
	$cust=mysqli_query($con,$cl);
	if(!$cust)
	echo mysqli_error();
	while($custro=mysqli_fetch_array($cust))
	{
	?>
	<option value="<?php echo $custro[1]; ?>"<?php if(isset($_GET['cid']) && $_GET['cid']==$custro[0]){ ?> selected <?php }  ?> ><?php echo $custro[1]; ?></option>
	<?php
	}
	  ?>
	</select>
	</th>
	<th >
	
	<!--<input type="text" size="15" name="project" id="project" onkeyup="searchById('Listing','1','');" placeholder="Project ID"/>-->
	 <!--<select  name="project" id="project" onchange="searchById('Listing','1','');"><option value="">Select Project</option>
	<?php
	$pro="select distinct(project) from newtempsites where 1";
	if($_SESSION['custid']!='all')
	$pro.=" and cust_id='".$_SESSION['custid']."'";
	$proj=mysqli_query($con,$pro);
	while($projro=mysqli_fetch_array($proj))
	{
	?>
	<option value="<?php echo $projro[0]; ?>"><?php echo $projro[0]; ?></option>
	<?php
	}
	?>
	
	</select> --></th>
	<!--<th width="75">
	<input type="text" size="15" name="id" id="id" onkeyup="searchById('Listing','1','');" placeholder="ATM"/><br /></th>
	
	<th width="145"><input type="text" size="15" name="bank" id="bank" onkeyup="searchById('Listing','1','');" placeholder="Bank"/></th>
	<th><select name="sttype" id="sttype" onchange="searchById('Listing','1','');">
	<option value="ebill">Ebill Sites</option>
	<option value="">All Sites</option></select></th>
	<th width="75"><input type="text" size="15" name="city" id="city" onkeyup="searchById('Listing','1','');" placeholder="City"/></th>
	<th width="75"><input type="text" size="15" name="state" id="state" onkeyup="searchById('Listing','1','');" placeholder="State"/></th>
	
	<th width="75"><input type="text" size="15" name="area" id="area" onkeyup="searchById('Listing','1','');" placeholder="CSS localbranch"/></th>
	<th width="75"><input type="text" size="15" name="address" id="address" onkeyup="searchById('Listing','1','');" placeholder="Address"/></th>
	
	
	<th width="75"><input type="text" name="sdate" id="sdate" onblur="searchById('Listing','1','');" onkeyup="searchById('Listing','1','');" onclick="displayDatePicker('sdate');" placeholder="Entry Date"/></th>-->
	
	</tr>
	</table>
	</center>
	
	
	
	<center>
	
	<div id="search" align="left"></div>
	
	</center>
	
	<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
	
	</body>
	</html>