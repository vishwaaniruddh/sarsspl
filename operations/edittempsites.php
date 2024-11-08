<?php 
session_start();
include("access.php");
include("config.php");

$id=$_GET['id'];
//echo "select cid,po,bankname,state,atmid,area,pincode,address from Amc where amcid='".$tpid."'";


$sql="select * from newtempsites where id='".$id."'";

$qry=mysqli_query($con,$sql);
$qryrow=mysqli_fetch_row($qry);

 ?>
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

if(tkdt.value=="")
{
alert("Please Enter Takeover Date");
tkdt.focus();
return false;
}
if(local.value=='')
{
alert("Please Enter CSS local Branch Name");
local.focus();
return false;
}

if(bank.value=='')
{
alert("Please Enter Bank Name");
bank.focus();
return false;
}

if(city.value=='')
{
alert("Please Enter City");
city.focus();
return false;
}
if(state.value=='')
{
alert("Please Enter State");
state.focus();
return false;
}
if(state.value=='')
{
alert("Please Enter State");
state.focus();
return false;
}


if(rem.value=='')
{
alert("Please Enter Remarks");
rem.focus();
return false;
}

if(agree2.val!='')
{
if(agree.val!=''){
if (confirm("Agreement form already available. Do you really want to change this agreement form?"))
	{
		return true;
	}
	else
	agree.val='';
	}
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
<?php // include("menubar.php"); ?>
<h2>Edit Temporary Site</h2>
<?php
//$id=$_GET['id'];
//include_once('class_files/select.php');
//$sel_obj=new select();
//$atm=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"atm","track_id",$id,array(""),"y","state","a");
//$arow=mysqli_fetch_row($atm);
?>
<div id="header">
<form action="processedittempsites.php" method="post" name="form" enctype="multipart/form-data" onsubmit="return validate()">
<table>
<tr>
<td width="126" height="35"> Customer : </td>
<td width="221">
<?php
echo $qryrow[2];
?>
</td>
</tr>
<tr>
<td width="126" height="35"> Project id : </td>
<td width="221">
<input type="text" name="project" id="project" value="<?php echo $qryrow[52]; ?>" />
</td>
</tr>
<tr>
<td height="35">Site ID : </td>
<td><input type="text" name="siteid" id="siteid" value="<?php echo $qryrow[16]; ?>" /></td>
</tr>


<tr>
<td height="35">ATM ID : </td>
<td><input type="text" name="atmid" id="atmid" value="<?php echo $qryrow[17]; ?>" readonly="readonly" /></td>
</tr>
<tr>
<td height="35">caretaker : </td>
<td><input type="checkbox" name="ct" id="ct" value="Y" <?php if($qryrow[7]=='Y'){ echo "checked"; } ?> /><input type="text" name="cttkdt" id="cttkdt" value="<?php if($qryrow[29]!='' && $qryrow[29]!='0000-00-00'){ echo date('d/m/Y',strtotime($qryrow[29]));} ?>" onclick="displayDatePicker('cttkdt');" /></td>
</tr>
<tr>
<td height="35">Housekeeping : </td>
<td><input type="checkbox" name="hk" id="hk" value="Y" <?php if($qryrow[5]=='Y'){ echo "checked"; } ?> />
<input type="text" name="hktkdt" id="hktkdt" value="<?php if($qryrow[61]!='0000-00-00'){ echo  date('d/m/Y',strtotime($qryrow[61]));}else{ if($qryrow[29]!='' && $qryrow[29]!='0000-00-00'){ echo  date('d/m/Y',strtotime($qryrow[29]));} } ?>" onclick="displayDatePicker('hktkdt');" />
</td>
</tr>


<tr>
<td height="35">Maintenance : </td>
<td><input type="checkbox" name="rnm" id="rnm" value="Y" <?php if($qryrow[9]=='Y'){ echo "checked"; } ?>/>
<input type="text" name="rnmtkdt" id="rnmtkdt" value="<?php if($qryrow[62]!='0000-00-00'){ echo  date('d/m/Y',strtotime($qryrow[62]));}else{ if($qryrow[29]!='' && $qryrow[29]!='0000-00-00'){ echo  date('d/m/Y',strtotime($qryrow[29]));} } ?>" onclick="displayDatePicker('rnmtkdt');" />
</td>
</tr>
<tr>
<td height="35">Ebill: </td>
<td><input type="checkbox" name="eb" id="eb" value="Y" <?php if($qryrow[53]=='Y'){ echo "checked"; } ?> />
<input type="text" name="ebtkdt" id="ebtkdt" value="<?php if($qryrow[63]!='0000-00-00'){ echo  date('d/m/Y',strtotime($qryrow[63]));}else{ if($qryrow[29]!='' && $qryrow[29]!='0000-00-00'){ echo  date('d/m/Y',strtotime($qryrow[29]));} } ?>" onclick="displayDatePicker('ebtkdt');" />
</td>
</tr>
<tr>
<td height="35">City Category : </td>
<td id="res"><input type="text" name="citycat" id="citycat" value="<?php echo $qryrow[24]; ?>" /></td>
</tr>
<tr>
<td height="35"> CSS Local Branch : </td>
<td>
<input type="text" name="local" id="local" value="<?php echo $qryrow[12]; ?>" />
</td>
</tr>
<tr>
<td height="35"> Bank : </td>
<td>
<input type="text" name="bank" id="bank" value="<?php echo $qryrow[11]; ?>" />
</td>
</tr>

<tr>
<td height="35"> State : </td>
<td>
<input type="text" name="state" id="state" value="<?php echo $qryrow[14]; ?>" />
</td>
</tr>

<tr>
<td height="35">City : </td>
<td id="res"><input type="text" name="city" id="city" value="<?php echo $qryrow[24]; ?>" /></td>
</tr>

<tr>
<td height="35">Address : </td>
<td><textarea rows="4" cols="28" name="add" ><?php echo $qryrow[26]; ?></textarea></td>
</tr>

<!--<tr>
<td height="35">Takeover Date : </td>
<td><?php
$yr=date('Y',strtotime($qryrow[29]));
 if($qryrow[29]=='0000-00-00' || $qryrow[29]=='1970' || $qryrow[51]=='0' || $qryrow[51]=='1'){ ?><input type="text" name="tkdt" id="tkdt" value="<?php if($qryrow[29]!='0000-00-00'){ echo date('d/m/Y',strtotime($qryrow[29]));} ?>" onclick="displayDatePicker('tkdt');" readonly="readonly" /><?php }else{ ?><input type="text" name="tkdt" id="tkdt" value="<?php if($qryrow[29]!='0000-00-00'){ echo date('d/m/Y',strtotime($qryrow[29]));} ?>" readonly="readonly" /><?php } ?></td>
</tr>-->
<tr>
<td height="35"> Takeover Agreement : </td>
<td>
<input type="file" name="agree" id="agree" value="" /><?php if($qryrow[55]!=''){ echo "(".$qryrow[55].")"; }else{ echo "(Agreement Form not uploaded)"; } ?>
<input type="hidden" name="agree2" id="agree2" value="<?php echo $qryrow[55]; ?>" />
</td>
</tr>
<tr>
<td height="35">Remarks : </td>
<td><textarea rows="4" cols="28" name="rem" id="rem" ><?php echo $qryrow[48]; ?></textarea></td>
</tr>

<tr>
<td height="35" colspan="2" align="center">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>