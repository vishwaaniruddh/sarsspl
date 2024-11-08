<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Area Engineer</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
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

function validate()
{
//alert("hello");
var form=document.getElementById('engform');
with(form)
{
//alert("hello");

if(area.value=='')
{
alert("Please Select State");
area.focus();
return;
}
if(name.value=='')
{
alert("Please Enter Engineer Name");
name.focus();
return;
}
if(cont.value=='')
{
alert("Please Enter Engineer Contact Number");
cont.focus();
return;
}
if(cont.value!='')
{
//alert("hello");
 var y = cont.value;
 if(isNaN(y)||y.indexOf(" ")!=-1)
           {
              alert("Enter numeric value for Phone ");
              cont.value='';
              cont.focus();
              return;
           }
           if (y.length>11)
           {
                alert("Enter 11 characters starting with 0");
               cont.focus();
                return;
           }
           if (y.charAt(0)!="0")
           {
           cont.value='0'+y;
               // alert("Phone1 should start with 0 ");
                //ph1.focus();
              //  return;
           }
}
if(email.value=='')
{
alert("Please Enter Email ID");
email.focus();
return;
}
if(email.value!='')
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
if(!email.value.match(mailformat))  
{   
alert("You have entered an invalid email address!");  
email.focus();  
return;  
}  

}

form.submit();
}
}
</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>


<h2>Add New Supervisor</h2>
<div id="header">
<form action="process_areaengg.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>
<tr>
<td height="35">Select Branch : </td>
<td id="res">
<?php
include("config.php");
$loc="select id,location from cssbranch where status=1 ";
if($_SESSION['branch']!='all')
$loc.=" and id in (".$_SESSION['branch'].")";
//echo $loc;
$state=mysqli_query($con,$loc);
?>
<select name='area' id='area'>
<option value=''>select Branch</option>
<?php

while($stro=mysqli_fetch_row($state))
{
?>
<option value="<?php echo $stro[0];  ?>"><?php echo $stro[1];  ?></option>
<?php
}
?></select>
</td>
</tr>

<tr>
<td height="35">Name : </td>
<td><input type="text" name="name" id="name" /></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td><input type="text" name="cont" id="cont" /></td>
</tr>

<tr>
<td height="35">Email : </td>
<td><input type="text" name="email" id="email" /></td>
</tr>
<tr>
<td height="35">Upload Resume : </td>
<td><input type="file" name="resume" id="resume" /></td>
</tr>
<tr>
<td height="35" colspan="2"><input  type="button" value="submit" class="readbutton" onclick="validate();"/></td>
</tr>
</table>
</form>
</div>
</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>