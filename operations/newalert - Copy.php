<?php

include("access.php");

include('config.php');



if($_SESSION['user']=='Sneha' || $_SESSION['user']=='masteradmin'){



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

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

if(po.value==0)

{

	alert("Please Select Purchase.");

	po.focus();

	return false;

}



if(ref_id.value==0)

{

	alert("Please Select Reference No.");

	ref_id.focus();

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

  xmlHttp.open("GET", "get_city.php?state="+str, true);



  xmlHttp.send(null);



}



function HandleResponse3(response)



{



  document.getElementById('res').innerHTML = response;



}





//////atm id data

function atmid()

{ //alert("h");
mysqli_query($con,
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



</script>

</head>



<body>

<center>

<?php include("menubar.php"); ?>



<h2 class="h2color">Add New Alert</h2>



<div id="header" class="res">



<form action="process_alert.php" method="post" name="form" onSubmit="return validate1(this)">



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

  <tr><td width="145">

Select Customer : </td><td width="131">



<select name="cust" id="cust" onchange="po_no();">

<option value="0">select</option>

<?php

$qry1=mysqli_query($con,"select * from customer");

while($row=mysqli_fetch_row($qry1)){

?>

<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>





<?php } ?>

</select>

</td>

<td width="59"> PO No :

<td width="180" id="po_no"> 

<select name="po" id="po" onchange="assets();">

<option value="0">select</option>

</select>

</td></tr></table>







<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" />

<table width="500">

<?php

include_once('class_files/select.php');

$sel_obj=new select();

$atm=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("tracker_id"),"atm","","",array(""),"y","tracker_id","a");

?>



<tr>

<td width="118" height="35">Atm Id : </td>

<td width="305" id="ref_id1">

<select name="ref_id" id="ref_id" onchange="atmid();">

<option value="0">select</option>

<?php

while($atmrow=mysqli_fetch_row($atm)){ 

?>

<option value="<?php echo $atmrow[0]; ?>"><?php echo $atmrow[0]; ?></option>

<?php

}

?>

</select></td>

</tr>

</table>

<div id="asset_div"></div>

<table width="500"><tr>

<td height="35">Preffered Date : </td>

<td><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" value="<?php echo date('d/m/Y'); ?>" /></td>

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

<?php } ?>