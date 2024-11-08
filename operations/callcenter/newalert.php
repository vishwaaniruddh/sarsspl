<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>
function validate(form){
 with(form)
 {
var numbers = /^[0-9]+$/;  

if(atm.value=="")
{
alert("Please Enter ATM ID");
atm.focus();
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
    alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		document.getElementById("cust").value=s1[0];
		document.getElementById("bank").value=s1[1];
		document.getElementById("state").value=s1[2];
		document.getElementById("city").value=s1[3];
		document.getElementById("add").value=s1[4];
		document.getElementById("pin").value=s1[5];
		document.getElementById("area").value=s1[6];
   //alert(s1[4]);
    }
  }
  
  var str=document.getElementById('atm').value;
  
xmlhttp.open("GET","get_data.php?atm="+str,true);
///alert("get_ref.php?docref="+str+"&ref=df");
xmlhttp.send();
}

</script>
</head>

<body>
<center>
<h2>Add New Alert</h2>
<div id="header">
<form action="process_alert.php" method="get" name="form" >
<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" />
<table>
<?php
include_once('class_files/select.php');
$sel_obj=new select();
$atm=$sel_obj->select_rows('localhost','site','site','atm_site',array("atm_id"),"atm","","",array(""),"y","atm_id","a");
?>
<tr>
<td height="35">ATM ID : </td>
<td>
<select name="atm" id="atm" onchange="atmid();">
<option value="0">select</option>
<?php
while($atmrow=mysql_fetch_row($atm)){ 
?>
<option value="<?php echo $atmrow[0]; ?>"><?php echo $atmrow[0]; ?></option>
<?php
}
?>
</select>
</td>
</tr>

<tr>
<td width="126" height="35">Select Customer : </td>
<td width="221">
<select name="cust" id="cust">
<option value="0">select</option>
<option value="1">Miti Modi</option>
<option value="2">Jay Sanghrajka</option>
</select>
</td>
</tr>

<tr>
<td height="35">Select Bank : </td>
<td>
<select name="bank" id="bank">
<?php
include_once('class_files/select.php');
$sel_obj=new select();
$bank_tab=$sel_obj->select_rows('localhost','site','site','atm_site',array("bank_id","bank_name"),"bank","","",array(""),"y","bank_name","a");
?>
<option value="0">select</option>
<?php
while($row1=mysql_fetch_row($bank_tab)){ 
//echo $row1[0]."".$row1[1];
?>
<option value="<?php echo $row1[1]; ?>"><?php echo $row1[1]; ?></option>
<?php
}
?>
</select>
</td>
</tr>

<tr>
<td height="35"> State : </td>
<td>
<select name="state" id="state" onchange="MakeRequest()">
<option value="0">select</option>
<?php
include_once('class_files/select.php');
$sel_obj=new select();
$state=$sel_obj->select_rows('localhost','site','site','atm_site',array("state","state_id"),"state","","",array(""),"y","state","a");
?>
<?php
while($row=mysql_fetch_row($state))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php } ?>

</select>
</td>
</tr>

<tr>
<td height="35">City : </td>
<td id="res"><input type="text" id="city" name="city"/></td>
</tr>

<tr>
<td height="35">Address : </td>
<td><textarea rows="4" cols="28" name="add" id="add"></textarea></td>
</tr>

<tr>
<td height="35">Area : </td>
<td><input type="text" name="area" id="area" /></td>
</tr>

<tr>
<td height="35">Pincode : </td>
<td><input type="text" name="pin" id="pin" /></td>
</tr>

<tr>
<td height="35">Alert Date : </td>
<td><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" /></td>
</tr>

<tr>
<td height="35">Problem : </td>
<td><textarea rows="4" cols="28" name="prob" id="prob"></textarea></td>
</tr>

<tr>
<td height="35">Caller Name : </td>
<td><input type="text" name="cname" id="cname"/></td>
</tr>

<tr>
<td height="35">Caller Contact : </td>
<td><input type="text" name="cphone" id="cphone"/></td>
</tr>

<tr>
<td height="35">Caller Email : </td>
<td><input type="text" name="cemail" id="cemail"/></td>
</tr>

<tr>
<td height="35"><input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>