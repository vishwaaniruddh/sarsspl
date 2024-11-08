<?php

include("access.php");



// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

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

<script src="js/ajaxfileupload.js" type="text/javascript"></script>

<script type="text/javascript">

function savepic(takeoverdt,fileid)

{

alert(takeoverdt+" "+fileid)

//can perform client side field required checking for "fileToUpload" field

$.ajaxFileUpload

(

{

url:'doajaxfileupload.php',

secureuri:false,

fileElementId:fileid,

dataType: 'json',

success: function (data, status)

{

if(typeof(data.error) != 'undefined')

{

if(data.error != '')

{

alert(data.error);

}else

{

alert(msg); // returns location of uploaded file

}

}

},

error: function (data, status, e)

{

alert(e);

}

}

)

return false;

}

function save(tkdt,div,id)

{



var tkdt=document.getElementById(tkdt).value;

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

	

	//alert(xmlhttp.responseText);

	if(xmlhttp.responseText=='1')

    document.getElementById(div).innerHTML=tkdt;

	else

	 document.getElementById(div).innerHTML="Some Error Occured"+xmlhttp.responseText;

    }

  }

 

  //alert("uploadaggrement.php?tkdt="+tkdt+"field=takeover_date&id="+id);

xmlhttp.open("GET","uploadagreement.php?tkdt="+tkdt+"&field=takeover_date&id="+id,true);

xmlhttp.send();

}

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

		 

		
mysqli_
			 if(a!="Loading"){

			  var custid=document.getElementById('cid').value;

			 var id=docmysqli_getElementById('id').value;//alert(id);

			 

			 var sdate=document.getElementById('sdate').value;//alert(sdate);

			 //var edate=document.getElementById('edate').value;//alert(edate);

			  }

			////alert(document.getElementById('type').value);

			

			var url = 'errsite_data.php';

			

 	

		var pmeters="";

			//alert(url);

			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 

			if(a!="Loading"){ 

			 pmeters = 'consumer='+id+'&Page='+b+'&perpg='+ppg+'&dt='+sdate+"&custid="+custid;

			}//alert("gg");

			else

			{

			pmeters = 'Page='+b+'&perpg='+ppg;	

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

 

 

 function saveedt(cnt,id,stat)

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

    alert("Updated Successfully And waiting for Operation Manager Approval");

	document.getElementById("edt"+cnt).innerHTML='';

	}

	else

	 alert("Some Error Occurred");

    }

  }

// alert("updateerr.php?atm="+atm+"&cons="+cons+"&fdt="+fdt+"&tdt="+tdt+"&bdt="+bdt+"&ddt="+ddt+"&pdt="+pdt+"&openr="+openr+"&closer="+closer+"&units="+units+"&pamt="+pamt+"&xtra="+xtra+"&tamt="+tamt+"&id="+id+"&cid="+cid+"&stat="+stat);

  //alert("uploadaggrement.php?tkdt="+tkdt+"field=takeover_date&id="+id);

  alert("updateerr.php?id="+id+"&stat="+stat);

xmlhttp.open("GET","updateerr.php?id="+id+"&stat="+stat,true);

xmlhttp.send();

}







function approve(cnt,id,stat)

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

	

	//alert(xmlhttp.responseText);

	if(xmlhttp.responseText=='1')

	{

    alert("Updated Successfully And waiting for Operation Manager Approval");

	document.getElementById("edt"+cnt).innerHTML='';

	}

	else

	 alert("Some Error Occurred");

    }

  }

 

  //alert("uploadaggrement.php?tkdt="+tkdt+"field=takeover_date&id="+id);

xmlhttp.open("GET","updateerr.php?id="+id+"&stat="+stat,true);

xmlhttp.send();

}

</script>

</head>



<body onLoad="searchById('Loading','1','')">

<div class="fixed">

<center>

<?php include("menubar.php"); ?>



<h2>Level 1 approval</h2>



<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>

	<br />

<table  border="0" cellpadding="0" cellspacing="0">

<tr>



</tr>

<tr>

<th width="75">

<?php

include("config.php");

//echo "select short_name,contact_first from contacts where short_name in (select distinct(cid) from uploadedebillerr where status='2') and type='c'";

$cl=mysql_query("select short_name,contact_first from contacts where short_name in (select distinct(cid) from uploadedebillerr where status='2') and type='c'");



?>

<select name="cid" id="cid" onchange="searchById('Listing','1','');"><option value="">Select Client</option>

<?php

while($client=mysql_fetch_array($cl))

{



?>

<option value="<?php echo $client[0]; ?>"><?php echo $client[1]; ?></option>

<?php

}

?></select>

</th>





<th width="75"><input type="text" size="15" name="id" id="id" onkeyup="searchById('Listing','1','');" placeholder="consumer no"/></th>







<th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" placeholder="Entry Date"/>

</th><th><input type="button" onclick="searchById('Listing','1','');" value="Search"></th>

<!--<td width="75"><input type="text" name="edate" id="edate"  onkeyup="searchById('Listing','1');" placeholder="To Date"/></td>-->

</tr>

</table>

</center>

</div>







<center>

<div id="search" align="left"></div>



</center>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="script.js"></script>

</body>

</html>