<?php include("access.php");

include("config.php");

$type=$_GET['type'];

$tpid=$_GET['id'];

//echo "select cid,po,bankname,state,atmid,area,pincode,address from Amc where amcid='".$tpid."'";

if($tmysqli_query($con,

$sql="select cid,po,bankname,state,atmid,area,pincode,address from Amc where amcid='".$tpid."'";

elseif($type=='new')

$sql="select cust_id,po,bank_name,state,atm_id,area,pincode,address from atm where track_id='".$tpid."'";
mysqli_query($con,


$qry=mysqli_query($con,$sql);

$qryrow=mysqli_fetch_row($qry);

//echo "select startdt from amcpurchaseorder where amcsiteid='".$tpid."'";

if($type=='amc')

$sql2="select startdt from amcpurchaseorder where amcsiteid='".$tpid."'";

elseif($type=='new')

$sql2="select podate from atm where track_id='".$tpid."'";

$qry2=mysqli_query($con,$sql2);

$qryro2=mysqli_fetch_row($qry2);



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

      mysqli_query($con,w ActiveXObject("Msxml2.XMLHTTP");

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

<h2>Edit Site</h2>

<?php

//$id=$_GET['id'];

//include_once('class_files/select.php');

//$sel_obj=new select();

//$atm=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"atm","track_id",$id,array(""),"y","state","a");

//$arow=mysqli_fetch_row($atm);

?>

<div id="header">

<form action="update_site.php" method="post" name="form">

<table>

<tr>

<td width="126" height="35"> Customer : </td>

<td width="221">

<?php

$qry2=mysqli_query($con,"select cust_name from customer where cust_id='".$qryrow[0]."'");

$qry2row=mysqli_fetch_row($qry2);

echo $qry2row[0];

?>

</td>

</tr>

<tr>

<td width="126" height="35"> PO : </td>

<td width="221">

<?php

echo $qryrow[1];

?>

</td>

</tr>

<tr>

<td height="35">ATM ID : </td>

<td><input type="text" name="atmid" value="<?php echo $qryrow[4]; ?>" /></td>

</tr>



<tr>

<td height="35"> Bank : </td>

<td>

<?php

echo $qryrow[2];

?>

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

$state=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("state","state_id"),"state","","",array(""),"y","state","a");

?>

<?php

while($row=mysqli_fetch_row($state))

{

	//echo $row[0];

?>



<option value="<?php echo $row[0]; ?>"<?php if($qryrow[3]==$row[0]){ echo "selected"; } ?>><?php echo $row[0]; ?></option>

<?php } ?>



</select>

</td>

</tr>



<tr>

<td height="35">City : </td>

<td id="res"><select id="city" name="city"><option value="<?php echo $qryrow[5]; ?>"><?php echo $qryrow[5]; ?></option></select></td>

</tr>



<tr>

<td height="35">Address : </td>

<td><textarea rows="4" cols="28" name="add" ><?php echo $qryrow[7]; ?></textarea></td>

</tr>



<tr>

<td height="35">Pincode : </td>

<td><input type="text" name="pin" id="pin" value="<?php echo $qryrow[6]; ?>"/></td>

</tr>

<tr>

<td height="35">Start Date : </td>

<td><input type="text" name="startdt" id="startdt" value="<?php echo date('d/m/Y',strtotime($qryro2[0])); ?>" onclick="displayDatePicker('startdt');" readonly="readonly" /></td>

</tr>







<tr>

<td height="35" colspan="2" align="center">

<input type="hidden" name="id" value="<?php echo $tpid; ?>" /><input type="hidden" name="type" value="<?php echo $type; ?>" />

<input type="submit" value="submit" class="readbutton" /></td>

</tr>

</table>

</form>

</div>

</center>

</body>

</html>