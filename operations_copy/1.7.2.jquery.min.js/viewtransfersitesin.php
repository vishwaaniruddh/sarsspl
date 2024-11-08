<?php

include("access.php");

// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>

<link href="style.css" rel="stylesheet" type="text/css" />

<link href="menu.css" rel="stylesheet" type="text/css" />

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script type="text/javascript">



var tableToExcel = (function() {

//alert("hii");

  var uri = 'data:application/vnd.ms-excel;base64,'

    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'

    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }

    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }

  return function(table, name) {

    if (!table.nodeType) table = document.getElementById(table)

    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}

    window.location.href = uri + base64(format(template, ctx))

  }

})()

</script>

<script type="text/javascript">

function confirm_delete(id)

{

	if (confirm("Are you sure you want to delete this entry?"))

	{

		document.location="delete_site.php?id="+id;

	}

	

}





///////////////////////////////search 

function searchById(a,b,perpg) {

//alert(a+" "+b+" "+perpg);

var ppg='';

if(perpg=='')

ppg='50';

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

		 /* if(document.getElementById('idd').value=="" && document.getElementById('fname22').value=="")

		  {

			  var url = 'get_docID.php';

		  }else   if(document.getElementById('fname22').value==""){

			  

			  var s=document.getElementById('idd').value;

			var url = 'get_docID.php?id='+s;

		  } else if(document.getElementById('idd').value==""){

			  

			   var s=document.getElementById('fname22').value;

			var url = 'get_docID.php?fname='+s;

		  } else{*/

			 // var id=document.getElementById('idd').value;//alert(id);

			var desig=document.getElementById('desig').value;

			 if(a!="Loading"){

			 var id=document.getElementById('id').value;//alert(id);

			 var cid=document.getElementById('cid').value;//alert(cid);

			 var bank=document.getElementById('bank').value;//alert(bank);

			 var city=document.getElementById('city').value;//alert(city);

			 var area=document.getElementById('area').value;//alert(area);

			 var state=document.getElementById('state').value;//alert(state);

			// var pin=document.getElementById('pin').value;//alert(pin);

			 var sdate=document.getElementById('sdate').value;//alert(sdate);

			var edate=document.getElementById('edate').value;//alert(edate);

			  }

			////alert(document.getElementById('type').value);

			

			var url = 'showintransfer.php';

			



 	

		var pmeters="";

			//alert(url);

			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 

			if(a!="Loading"){ 

			 pmeters = 'id='+id+'&cid='+cid+'&city='+city+'&state='+state+'&area='+area+'&bank='+bank+'&Page='+b+'&perpg='+ppg+'&sdate='+sdate+'&edate='+edate+'&desig='+desig;

			}/mysqli_query($con,;
mysqli_query($con,
			else

			{

			pmeters = 'Page='+b+'&perpg='+ppg+'&desig='+desig;	

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

 /*

			if(HttPRequest.readyState == 3)  // Loading Request

				  {

	document.getElementById("listingAJAX").innerHTML = '<img src="loader.gif" align="center" />';

				  }

 */

				 if(HttPRequest.readyState == 4) // Return Request

				  {

		var response = HttPRequest.responseText;

 

 //alert(response);

				  document.getElementById("search").innerHTML = response;

			  }

		}

  }

 function approvetransfer(cnt,id,stat)

{

//alert(tkdt);

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

	if(xmlhttp.responseText=='1')

	{

    alert("Site Transfer Successfull");

	document.getElementById("app"+cnt).innerHTML='Approved';

	}

	else

	 alert("Some Error Occurred");

    }

  }

 

  //alert("uploadaggrement.php?tkdt="+tkdt+"field=takeover_date&id="+id);

xmlhttp.open("GET","allowtransfer.php?id="+id+"&stat="+stat,true);

xmlhttp.send();

}

</script>

</head>



<body onload="searchById('Listing','1','');" >

<div class="fixed">

<center>

<?php include("menubar.php"); ?>



<h2 class="h2color">View Transferred (IN) Sites</h2>



<?php if(isset($_GET['success'])){ ?> <h2 align="center"><?php echo $_GET['success']; ?></h2><?php } ?>

<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>

	<br />

<table  border="0" cellpadding="0" cellspacing="0">

<tr>



</tr>

<tr>

<th >

<input type="hidden" name="desig" id="desig" value="<?php echo $_SESSION['designation']; ?>"/>

<?php 

include("config.php");



//echo "cust id ".$_SESSION['custid'];



$cust=explode(",",$_SESSION['custid']);

$cl='';

for($i=0;$i<count($cust);$i++)

{

if($i==0)

$cl="'".$cust[0]."'";

elseif($i==(count($cust)-1))

$cl.=",'".$cust[0]."'";

else

$cl.=",'".$cust[0]."'";

}

//echo $cl;

$sql2="select distinct `to` from transfer_req where 1";

if($_SESSION['custid']!='all')

$sql2.=" and `to` in (".$cl.")";



$sql="select `short_name`,`contact_first` from contacts where `type`='c' and `short_name` in ($sql2)";



//echo $sql;

$qry=mysqli_query($con,$sql);

//$qry=mysqli_query($con,"Select short_name,contact_first from contacts where type='c' and short_name='".$_SESSION['custid']."'");



 ?>

 <select  name="cid" id="cid" onchange="searchById('Listing','1','');">



<?php

while($clro=mysqli_fetch_row($qry))

{

?>

<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>

<?php

}

?>

</select> </th>



<th width="145"><input type="text" size="15" name="bank" id="bank" onkeyup="searchById('Listing','1','');" placeholder="Bank"/></th>



<th width="75"><input type="text" size="15" name="city" id="city" onkeyup="searchById('Listing','1','');" placeholder="City"/></th>

<th width="75"><input type="text" size="15" name="state" id="state" onkeyup="searchById('Listing','1','');" placeholder="State"/></th>

<!--<th width="75"><input type="text" size="15" name="pin" id="pin" onkeyup="searchById('Listing','1','');" placeholder="Pincode"/></th>-->

<th width="75"><input type="text" size="15" name="area" id="area" onkeyup="searchById('Listing','1','');" placeholder="Address"/></th>

<th width="75"><input type="text" size="15" name="id" id="id" onkeyup="searchById('Listing','1','');" placeholder="ATM"/><br /></th>





<th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" readonly="readonly" placeholder="From Date"/></th>

<th width="75"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');" readonly="readonly" placeholder="To Date"/></th>

<th><input type="button" name="dt" onclick="searchById('Listing','1','');" value="search" /></td>

</tr>

</table>

</center>

</div>







<center>

<div id="search"></div>



</center>

<script type="text/javascript" src="1.7.2.jquery.min.js"></script>

<script type="text/javascript" src="script.js"></script>

</body>

</html>