<?php

include("access.php");

include('config.php');







?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>New Temporary Site</title>

<link href="style.css" rel="stylesheet" type="text/css" />

<link href="menu.css" rel="stylesheet" type="text/css" />



<!--datepicker-->

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<!--validation-->

<script>



function validate1(form1){

 with(form1)

 {



 var numbers = /^[0-9]+$/;

var namePattern = /^[A-Za-z()_ ]/;

if(cust.value==0)

{

	alert("Please Select Customer.");

	cust.focus();

	return false;

}



if(atmid.value==0)

{

	alert("Please Enter Atmid.");

	atmid.focus();

	return false;

}



if(servicetp.value=='')

{

	alert("Please select service type.");

	servicetp.focus();

	return false;

}

if(bank.value==0)

{

	alert("Please Enter Bank Name.");

	bank.focus();

	return false;

}

if(area.value==0)

{

	alert("Please Enter Area.");

	area.focus();

	return false;

}

if(city.value==0)

{

	alert("Please Enter City.");

	city.focus();

	return false;

}

if(pincode.value==0)

{

	alert("Please Enter Pincode.");

	pincode.focus();

	return false;

}

if(state.value==0)

{

	alert("Please Enter State.");

	state.focus();

	return false;

}

if(address.value==0)

{

	alert("Please Enter Address.");

	address.focus();

	return false;

}

if(prob.value==0)

{

	alert("Please Enter Requirements.");

	prob.focus();

	return false;

}

if(cname.value.search(/[a-z]+$/)== -1 && cname.value.search(/[A-Z]+$/)== -1 )

{

	alert("Please Enter  Contact Person Name in letters");

	cname.focus();

	return false;

}

if(cphone.value.length!=10)

 {

alert("Please Enter 10 Digits Contact Number.");

cphone.focus();

return false;

}

if(!cphone.value.match(numbers))

  {

alert("Please Enter Contact No. to continue.");

cphone.focus();

return false;

}

 

if(cemail.value.search(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)==-1)

{

alert("Invalid E-mail Address! Please re-enter.")

cemail.focus();

return false;

}

}





 return true;

 }

 

  



/////for city

function getXMLHttp()



{



  var xmlHttp



 //alert("hi1");



  try



  {



    //Firefox, Opera 8.0+, Safari

 xmlHttp = new XMLHttpRequest();

  }



  catch(e)

  {

    //Internet Explorer

    try

    {

      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");

    }

   catch(e)

    {

      try

      {

        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

      }

      catch(e)

      {

        alert("Your browser does not support AJAX!")

       return false;

      }

   }

 }

  return xmlHttp;

}

function MakeRequest()



{ 

  var xmlHttp = getXMLHttp();

 



  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {



      HandleResponse3(xmlHttp.responseText);

    }

  }



 //alert("hi2");



  //alert("getarea.php?ccode="+document.forms[0].city.value);

var str=document.getElementById('state').value;

//alert(str);

  xmlHmysqli_query($con,T", "get_city.php?state="+str, true);



  xmlHttp.send(null);



}



function HandleResponse3(response)



{



  document.getElementById('res').innerHTML = response;



}

mysqli_query($con,



//////atm id data

function atmid()

{ //alert("h");

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

    var s=xmlhttp.responseText;

  ////alert(s);

	 document.getElementById('asset_div').innerHTML = s;	
mysqli_query($con,
    }

  }

   var cust=document.getElementById('cust').value;

    var po=document.getElementById('po').value;

  var ref=document.getElementById('ref_id').value;

  

 //////alert("get_data.php?cust="+cust+"&po="+po+"&ref="+ref);

  

xmlhttp.open("GET","get_data.php?cust="+cust+"&po="+po+"&ref="+ref,true);



xmlhttp.send();

}







///////////type of alert

function alert_type(){

if(document.getElementById('call').value=='new')

{

	document.getElementById('assets').style.display='block';

}



else

{

	document.getElementById('assets').style.display='none';

	

}

}



////assets

function addThem()

{

var a = document.form.asset;

var add = a.value+',';

document.form.asset_box.value += add;

return true;

}



///////Assets

function assets()



{ 

  var xmlHttp = getXMLHttp();

 



  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {



      HandleResponse5(xmlHttp.responseText);

    }

  }



 //alert("hi2");



  //alert("getarea.php?ccode="+document.forms[0].city.value);

var str=document.getElementById('po').value;

/////alert(str);

  xmlHttp.open("GET", "get_asset.php?po="+str, true);



  xmlHttp.send(null);



}



function HandleResponse5(response)



{



  document.getElementById('ref_id1').innerHTML = response;



}

///////get po no.

function po_no()



{ 

  var xmlHttp = getXMLHttp();

 



  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {





      HandleResponse4(xmlHttp.responseText);

    }

  }



 //alert("hi2");



  //alert("getarea.php?ccode="+document.forms[0].city.value);

var str=document.getElementById('cust').value;

////alert(str);

  xmlHttp.open("GET", "get_po.php?cust="+str, true);



  xmlHttp.send(null);



}



function HandleResponse4(response)



{



  document.getElementById('po_no').innerHTML = response;



}

function filladd(id)

{

if(document.getElementById('address').value=='')

document.getElementById('address').value=id.value;

else

document.getElementById('address').value=document.getElementById('address').value+","+id.value;

}

</script>

</head>



<body>

<center>

<?php include("menubar.php"); ?>



<h2>New Temporary Site Alert</h2>



<div id="header">



<form action="processtempsite.php" method="post" name="form" onSubmit="return validate1(this)">



<br/>



<!--

<select name="call" id="call" onchange="alert_type();" style="border:2px #fff solid;">

<option value="0">Select Alert</option>

<option value="new">New Installation</option>

<option value="service">Service Alert</option>



</select>-->



<br /><br />



<div id="assets" style="display:block;">

<table width="500">

  <tr><td width="155">

Select Customer : </td><td width="131">



<select name="cust" id="cust">

<option value="0">select</option>

<?php

$qry1=mysqli_query($con,"select * from customer");

while($row=mysqli_fetch_row($qry1)){

?>

<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>





<?php } ?>

</select>

</td></tr>

<tr>

<td width="59"> PO No :</td>

<td width="180" id="po_no"> 

<input type="text" name="po" id="po" /><input type="hidden" name="cdate" value="<?php echo date('Y-m-d h:i:s'); ?>" /></td>



</tr>



<tr>

<td width="115" height="35">Atm Id : </td>

<td width="305">

<input type="text" name="atmid" id="atmid" />

</td>

</tr>

<tr><td>Service Type</td><td>



<select name="servicetp" id="servicetp" ><option value="">-service type-</option>

<?php 

$service=mysqli_query($con,"select * from servicetype order by servicetype ASC");



while($serrow=mysqli_fetch_row($service))

{

?>

<option value="<?php  echo $serrow[0]; ?>"><?php  echo $serrow[1]; ?></option>

<?php

}

?>

</select></td></tr>

<tr>

<td width="115" height="35">Bank Name : </td>

<td width="305">

<input type="text" name="bank" id="bank" />

</td>

</tr>

<tr>

<td width="115" height="35">Area : </td>

<td width="305">

<input type="text" name="area" id="area" onblur="filladd(this);" />

</td>

</tr>

<tr>

<td width="115" height="35">City : </td>

<td width="305">

<input type="text" name="city" id="city" onblur="filladd(this);" />

</td>

</tr>



<tr>

<td width="115" height="35">Pincode : </td>

<td width="305">

<input type="text" name="pincode" id="pincode" onblur="filladd(this);" />

</td>

</tr>

<tr>

<td width="115" height="35">State : </td>

<td width="305">

<!--<input type="text" name="state" id="state" onblur="filladd(this);" />-->

<select name="state" id="state" onchange="filladd(this);">

<?php

$state=mysqli_query($con,"select * from state order by state ASC");

while($stro=mysqli_fetch_array($state))

{

?>

<option value="<?php echo $stro[1]; ?>"><?php echo $stro[1]; ?></option>

<?php

}

?>

</select>

</td>

</tr>

<tr>

<td width="115" height="35">Address : </td>

<td width="305">

<textarea name="address" id="address" rows="4" cols="28" /></textarea>

</td>

</tr>



<!--<tr>

<td width="115" height="35">Select Type: </td>

<td width="305">

<input type="radio" name="type" id="type" value="temp" checked="checked" />&nbsp;Temporary Site<br />

<input type="radio" name="type" id="type" value="amc" />&nbsp;AMC Site<br />

<input type="radio" name="type" id="type" value="new" />&nbsp;New Site<br />

</td>

</tr>-->

<tr>

<td height="35"> Date : </td>

<td><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" value="<?php echo date('d/m/Y h:i:s'); ?>" /></td>

</tr>



<tr>

<td height="35">Requirement : </td>

<td><textarea rows="4" cols="28" name="prob" id="prob"></textarea></td>

</tr>



<tr>

<td height="35">Contact Person : </td>

<td><input type="text" name="cname" id="cname"/></td>

</tr>



<tr>

<td height="35">Contact : </td>

<td><input type="text" name="cphone" id="cphone"/></td>

</tr>



<tr>

<td height="35">Email : </td>

<td><input type="text" name="cemail" id="cemail"/></td>

</tr>



<tr>

<td colspan="2" height="35"><input type="submit" value="submit" class="readbutton" /></td>

</tr>

</table>

</div>

</form>



</div>

</center>

</body>

</html>

