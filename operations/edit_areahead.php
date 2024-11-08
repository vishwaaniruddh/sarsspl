<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>window.location='index.php'</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script>
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
var str=document.getElementById('city').value;
//alert(str);
  xmlHttp.open("GET", "get_area.php?city="+str, true);

  xmlHttp.send(null);

}

function HandleResponse3(response)

{

  document.getElementById('res').innerHTML = response;

}
</script>
<link href="menu.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
include('menubar.php');
?>
<center>
<h2>Edit Branch Manager Details</h2>
<?php
include('config.php');
$id=$_GET['id'];

$area_head=mysqli_query($con,"select * from branch_head where head_id='".$id."'");
$arow=mysqli_fetch_row($area_head);
?>
<div id="header">
<form action="update_areahead.php" method="post" name="form">
<table>
<tr>
<td width="99" height="35">CSS Local Branch : </td>
<td width="189">
<select name="city" id="city">
<?php

$city_tab=mysqli_query($con,"select id,location from cssbranch where id in(".$arow[1].")");
?>
<option value="0">select</option>
<?php while ($row=mysqli_fetch_row($city_tab)) { ?>
<option value="<?php echo $row[0];?>"<?php if($arow[1]==$row[0]){ echo "selected"; } ?>><?php echo $row[1]; ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td height="35">Name : </td>
<td><input type="text" name="name" id="name" value="<?php echo $arow[2]; ?>"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td><input type="text" name="cont" id="cont" value="<?php echo $arow[4]; ?>"/></td>
</tr>

<tr>
<td height="35">Email : </td>
<td><input type="text" name="email" id="email" value="<?php echo $arow[3]; ?>"/></td>
</tr>

<tr>
<td height="35">
<input type="hidden" name="id" value="<?php echo $arow[0]; ?>" />
<input type="submit" value="submit" class="readbutton"/></td>
</tr>
</table>
</form>
</div>
</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>