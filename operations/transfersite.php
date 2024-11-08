<?php 
include("access.php");
include("config.php");
 $atmid=$_GET['atmid'];
 $cid=$_GET['cid'];
 $trackerid=$_GET['trackid'];
//echo "select cid,po,bankname,state,atmid,area,pincode,address from Amc where amcid='".$tpid."'";
$sql="select * from ".$cid."_sites where atm_id1='".$atmid."'";
$qry=mysqli_query($con,$sql);
$qryrow=mysqli_fetch_row($qry);
//echo "select startdt from amcpurchaseorder where amcsiteid='".$tpid."'";

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Transfer Site</title>
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
<?php include("menubar.php"); ?>
<?php // include("menubar.php"); ?>
<h2>Transfer Site</h2>
<?php
//$id=$_GET['id'];
//include_once('class_files/select.php');
//$sel_obj=new select();
//$atm=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"atm","track_id",$id,array(""),"y","state","a");
//$arow=mysqli_fetch_row($atm);
?>
<div id="header">
<?php if(isset($_GET['error']) || isset($_GET['success'])){  ?><div class="status"><?php echo $_GET['error']; ?><?php echo $_GET['success']; ?></div><?php } ?>
<form action="processtransfer.php" method="post" name="form" enctype="multipart/form-data">
<table>
<tr>
<td>Handover Date:</td><td><input type="text" name="hoverdt" id="hoverdt" onclick="displayDatePicker('hoverdt');" readonly="readonly" /></td>
</tr>
<tr>
<td width="126" height="35"> Customer : </td>
<td width="221"><select name="tcid" id="tcid"><option value="">Select Client</option>
<?php
$qry2=mysqli_query($con,"select short_name,contact_first from contacts where type='c' order by contact_first ASC");
while($qry2row=mysqli_fetch_row($qry2))
{
?>
<option value="<?php echo $qry2row[0]; ?>"><?php echo $qry2row[1]; ?></option>
<?php
}
//echo $qry2row[0];
?></select>
</td>
</tr>

<tr>
<td>Takeover Date:</td><td><input type="text" name="toverdt" id="toverdt"	 onclick="displayDatePicker('toverdt');" readonly="readonly" /></td>
</tr>
<tr>
<td>Remarks:</td><td><textarea name="rem" id="rem"></textarea></td>
</tr>
<tr>
<td>TakeOver Agreement Form:</td><td><input type="file" name="toverfrm" id="toverfrm" /></td>
</tr>
<tr>
<td>Handover Agreement Form:</td><td><input type="file" name="hoverfrm" id="hoverfrm" /></td>
</tr>
<tr>
<td height="35" colspan="2" align="center">
<input type="hidden" name="atmid" value="<?php echo $atmid; ?>" /><input type="hidden" name="fcid" value="<?php echo $cid; ?>" />
<input type="hidden" name="trackerid" value="<?php echo $trackerid; ?>" />
<input type="submit" value="submit" name="submit" class="readbutton" /></td>
</tr>
</table>
</form>
</div>
</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>