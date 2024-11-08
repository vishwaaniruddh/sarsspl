<?php

//session_start();

include("access.php");

 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>CSS<?php echo $_SESSION['user']; ?></title>

<link href="style.css" rel="stylesheet" type="text/css" />

<link href="menu.css" rel="stylesheet" type="text/css" />

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script src="excel.js" type="text/javascript"></script>

<script type="text/javascript">

///////////////////////////////search 

function searchById(a,b,perpg) {

//alert(a+" "+b+" "+perpg);

//var ppg='';

//if(perpg=='')

//ppg='50';

//else

//ppg=document.getElementById(perpg).value;



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

		var sv=document.getElementById('sv').value;

			var cid=document.getElementById('cid').value;//alert(cid);

			  var atm=document.getElementById('atm').value;//alert(atm);

			  var url='get_attach_email_pending.php';

			 pmeters = 'cid='+cid+'&atm='+atm+'&sv='+sv;

			//alert(pmeters);

		 		HttPRequest.open('POST',url,true);



			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

			HttPRequest.setRequestHeader("Content-length", pmeters.length);

			HttPRequest.setRequestHeader("Connection", "close");

			HttPRequest.send(pmeters);

 

//alert("gg"); 

			HttPRequest.onreadystatechange = function()

			{

 

				mysqli_tPRequest.readyState == 4) // Return Request
mysqli_
				  {

		var response = HttPRequest.responseText;

 

 //alert(response);

				 mysqli_ent.getElementById("search").innerHTML = response;
mysqli_
			  	  }

		    }

  }
mysqli_
function newwin(url,winname,w,h)

{

//var pos = $('#'+id).offset();

//alert(pos.);

var left = (screen.width/2)-(w/2);

var top = (screen.height/2)-(h/2);
mysqli_
var targemysqli_ window.open (url, winname, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=1, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
mysqli_
//mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");



}

  </script>

</head>



<body>



<center>

<?php include("menubar.php"); ?>



<h2 class="h2color">View Email Attachment Pending</h2>





<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>

	<br />

<table  border="0" cellpadding="0" cellspacing="0">



<tr>

<th >

<?php 

include("config.php");



//echo "cust id ".$_SESSION['custid'];

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

//echo $cl;

$sql2="select distinct `cust_id` from ebillfundrequests where 1";

if($_SESSION['custid']!='all')

{

if($_SESSION['designation']!="11")

$sql2.=" and `cust_id` in (".$cl.")";

else

{

$sr=mysql_query("select srno from login where username='".$_SESSION['user']."'");

$srro=mysql_fetch_row($sr);

$sql2.=" and (`reqby` in (".$srro[0].") or supervisor ='".$_SESSION['user']."')";

}



}



$sql="select `short_name`,`contact_first` from contacts where `type`='c' and `short_name` in ($sql2) order by contact_first";

//$sql="select `short_name`,`contact_first` from contacts where `type`='c' order by contact_first ASC";

//echo $sql;

$qry=mysql_query($sql);

//$qry=mysql_query("Select short_name,contact_first from contacts where type='c' and short_name='".$_SESSION['custid']."'");



 ?>

 <select  name="cid" id="cid">

<!--<option value="-1">Select Client</option>-->

<?php

while($clro=mysql_fetch_row($qry))

{

?>

<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>

<?php

}

?>

</select> 

</th>

<th>

<select name="sv" id="sv"><option value="">Select</option>

			   <?php

			 //  $sup=mysql_query("select username from login where designation='11' and serviceauth='3' and deptid='4' order by username ASC");

			 $sup=mysql_query("select distinct(hname) from fundaccounts order by hname ASC");

				 while($supro=mysql_fetch_array($sup))

				{ ?>

				   <option value="<?php echo $supro[0]; ?>" <?php if(($_SESSION['user']==$supro[0])){ echo "selected";}  ?> ><?php echo $supro[0]; ?></option>

			   <?php } ?>  

			    </select>

</th>

<th width="75"><input type="text" name="atm" id="atm"  placeholder="ATM ID"/></th>

<th><input type="button" name="dt" onclick="searchById('Listing','1','');" value="search" /></td>

</tr>

</table>

</center>

<center>

<div id="search"></div>



</center>

<script type="text/javascript" src="1.7.2.jquery.min.js"></script>

<script type="text/javascript" src="script.js"></script>

</body>

</html>