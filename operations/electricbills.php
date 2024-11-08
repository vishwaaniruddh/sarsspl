<?php ini_set( "display_errors", 0);

include("access.php");
if(!$_SESSION['user']){
?>
<script type="text/javascript">
alert("Sorry your session has been expired");
window.location="index.php";
</script>
<?php

}

// header('Location:managesite1.php?id='.$id); 
 
include("config.php");

		
		
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Electric Bills</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">
function getbank(val,type)
{
	//alert(val);

//alert(num);
//	document.getElementById('image').innerHTML="<img src='loading.gif' width='100px' height='50px'>";
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
document.getElementById('bank').innerHTML='';
	document.getElementById('bank').innerHTML=xmlhttp.responseText;
	
	
    }
  }
  //alert("getcustbank.php?val="+val);
xmlhttp.open("GET","getcustbank.php?val="+val+"&type="+type,true);
xmlhttp.send();

	
}
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='50';
else
ppg=document.getElementById(perpg).value;
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
		 // var br=document.getElementById('br').value;
		  var service=document.getElementById('service').value;
		//  var calltype=document.getElementById('calltype').value;
	
			 if(a!="Loading"){
			 var id=document.getElementById('atmid').value;//alert(id);
			 var cid=document.getElementById('cid').value;//alert(cid);
			 var bank=document.getElementById('bank').value;//alert(bank);
			// var address=document.getElementById('address').value;
			 var address='';
			 var area='';
			 //var area=document.getElementById('area').value;//alert(area);
			 var zone=document.getElementById('zone').value;
			  var dt=document.getElementById('date').value;
			 var dt2=document.getElementById('date2').value;
			  var opts = document.getElementById('state').options;
    var i = 0, len = opts.length, a = [];
    for (i; i<len; i++) {
if(opts[i].selected==true)
        a.push(opts[i].value);
    }
    var state = a.join(',');
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'manageebill_data.php'; 
		//  }
 	//alert(br);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&cid='+cid+'&area='+area+'&bank='+bank+'&Page='+b+'&perpg='+ppg+'&service='+service+"&address="+address+"&zone="+zone+"&dt="+dt+"&dt2="+dt2+"&state="+state;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'br='+br+'&Page='+b+'&perpg='+ppg+'&service='+service;
			}
			//alert(pmeters);
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
				  document.getElementById("search").innerHTML = response;
			  }
		}
  }
</script>
</head>

<body>

<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>
<table>
	<tr>
    	<td valign="top">
           <select name="cid" id="cid" onchange="getbank(this.value,'ebill');" ><option value="">select Client</option>
           <?php
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
          // $result1 = mysqli_query($con,"SELECT DISTINCT cust_name, cust_id FROM sites where atm_id1 in (select ATM_ID from ebill where Active='Y')");
          $sql="SELECT contact_first, short_name FROM contacts where type='c' and short_name in (select distinct(cust_id) from ebillfundrequests)";
          if($_SESSION['custid']!='all' && $_SESSION['custid']!=''){
          $sql.=" and short_name in ($cl1)";
          }
          $sql.=" order by contact_first ASC";
          $result1 = mysqli_query($con,$sql);
          // $result1 = mysqli_query($con,"SELECT DISTINCT s.cust_name, s.cust_id FROM sites s,ebill e where s.atm_id1 =e.ATM_ID and e.Active='Y'");
            while($row1 = mysqli_fetch_row($result1)){ ?>
                                           <option value="<?php echo $row1[1]; ?>" ><?php echo $row1[0]; ?></option>
           <?php } ?>   </select></td><td valign="top">
          <select name="bank" id="bank" onchange="searchById('Listing','1','');" ><option value="">select Bank</option>
           </select></td><td valign="top">
          
    <input type="text" name="atmid" id="atmid" onkeyup="searchById('Listing','1','');" placeholder="ATM"/>
   </td><td valign="top">
   <select name="state" id="state" multiple onblur="searchById('Listing','1','');">
   <option value="">Select state</option>
   <?php
   $state=mysqli_query($con,"select state from state");
   while($stro=mysqli_fetch_array($state))
   {
   ?>
   <option value="<?php echo $stro[0]; ?>"><?php echo $stro[0]; ?></option>
   <?php
   }
   ?>
   </select></td>
   <td valign="top">
    <input type="text" name="zone" id="zone" onkeyup="searchById('Listing','1','');" placeholder="Zone"/>       </td><td valign="top">  
    <input type="hidden" name="service" id="service" onkeyup="searchById('Listing','1','');" placeholder="Service"/></td><td valign="top">
     <input type="text" name="date" id="date" placeholder="From date" onclick="displayDatePicker('date');"  /></td><td valign="top">
    <input type="text" name="date2" id="date2" placeholder="To date" onclick="displayDatePicker('date2');"  />  </td><td valign="top">
      <input type="button" onclick="searchById('Listing','1','');" value="Search"></td></tr></table>
   

</center>


<div id="search" style="padding-top:-100px;"><?php //print_r($_SESSION)."hi"; ?></div>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>