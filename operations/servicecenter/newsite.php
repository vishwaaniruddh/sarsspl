<?php
session_start();
if(isset($_SESSION['user']) && $_SESSION['branch']!="")
{
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
</script>
</head>

<body>
<center>
<ul id="menu-bar">
 <li class="current"><a href="#">Home</a></li>
 <li><a href="#">Site</a>
  <ul>
   <li><a href="newsite.php">Add New</a></li>
   <li><a href="view_site.php">View Site</a></li>
   
  </ul>
 </li>
 <li><a href="#">Branch Head</a>
  <ul>
   <li><a href="newcty_head.php">Add New</a></li>
   <li><a href="view_cityhead.php">View Head</a></li>
 
  </ul>
 </li>
 <li><a href="#">Engineer</a>
  <ul>
   <li><a href="new_areaeng.php">Add New</a></li>
   <li><a href="view_areaeng.php">View Records</a></li>
   <li><a href="eng_alert.php">View Alerts</a></li>
   
  </ul>
 </li>
 <li><a href="newalert.php">Alert</a></li>
 <li><a href="logout.php">Logout</a></li>
</ul>

<h2>Add New Site</h2>
<div id="header">
<form action="process_newsite.php" method="get" name="form" onSubmit="return validate(this)">
<table>
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
	//echo $row[0];
?>

<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php } ?>

</select>
</td>
</tr>

<tr>
<td height="35">City : </td>
<td id="res"></td>
</tr>

<tr>
<td height="35">Address : </td>
<td><textarea rows="4" cols="28" name="add" id="add"></textarea></td>
</tr>

<tr>
<td height="35">Pincode : </td>
<td><input type="text" name="pin" id="pin" /></td>
</tr>

<tr>
<td height="35">ATM ID : </td>
<td><input type="text" name="atm" id="atm" /></td>
</tr>

<tr>
<td height="35">ATM Start Date : </td>
<td><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');"/></td>
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
<?php 
}else
{ 
 header("location: login.html");
}

?>