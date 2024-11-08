<?php 
session_start();
include("access.php");
include("config.php");

$id=$_GET['id'];
//echo "select cid,po,bankname,state,atmid,area,pincode,address from Amc where amcid='".$tpid."'";


$sql="select customer,bank,takeoverdate,numberofatm,phone,ac,fire,exhaustfan,ups,numberofbattery,idu,stabilizer,imuerter,dustbin,doormat,chair,otherdetails,photo from Takeoverform where id='".$id."'";
//echo $sql;
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
<h2>Site Assets</h2>
<?php
//$id=$_GET['id'];
//include_once('class_files/select.php');
//$sel_obj=new select();
//$atm=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"atm","track_id",$id,array(""),"y","state","a");
//$arow=mysqli_fetch_row($atm);
?>
<div id="header">
<table style="width:800px">
<tr><td>Customer</td><td><?php echo $_GET['cid']; ?></td><td>Bank</td><td><?php echo $qryrow[1]; ?></td></tr>
<tr><td>TakeOver Date</td><td><?php echo $qryrow[2]; ?></td><td>Number of Atm</td><td><?php echo $qryrow[3]; ?></td></tr>
<tr><td>AC</td><td><?php echo $qryrow[5]; ?></td><td>Fire</td><td><?php echo $qryrow[6]; ?></td></tr>
<tr><td>Exhaust Fan</td><td><?php echo $qryrow[7]; ?></td><td>UPS</td><td><?php echo $qryrow[8]; ?></td></tr>
<tr><td>Number of battery</td><td><?php echo $qryrow[9]; ?></td><td>IDU</td><td><?php echo $qryrow[10]; ?></td></tr>
<tr><td>stabilizer</td><td><?php echo $qryrow[11]; ?></td><td>imuerter</td><td><?php echo $qryrow[12]; ?></td></tr>
<tr><td>Dustbin</td><td><?php echo $qryrow[13]; ?></td><td>Doormet</td><td><?php echo $qryrow[14]; ?></td></tr>
<tr><td>Chair</td><td><?php echo $qryrow[15]; ?></td><td></td><td></td></tr>
<tr><td colspan='4'>Other Details: <?php echo $qryrow[16]; ?></td></tr>
<tr><td colspan='4'><img src="sitepic/<?php echo $qryrow[17];  ?>" height="200px" width="200px"></td></tr>

</table>
</div>
</center>
</body>
</html>