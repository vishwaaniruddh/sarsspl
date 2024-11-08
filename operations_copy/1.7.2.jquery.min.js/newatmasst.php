<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<title>CSS-<?php echo $_SESSION['user']; ?></title>
</head>
<script type="text/javascript">
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
  document.getElementById('br_no').value=s;
  if(s==3){
  
  document.getElementById('detail').style.display='none';
  document.getElementById('msg').style.display='block';
 //// alert("done");
  }else{
  document.getElementById('detail').style.display='block';
  document.getElementById('msg').style.display='none';
  }
	 ///document.getElementById('asset_div').innerHTML = s;	
    }
  }
   var city=document.getElementById('city').value;
   
  
 //////alert("get_data.php?cust="+cust+"&po="+po+"&ref="+ref);
  
xmlhttp.open("GET","get_branch.php?city="+city,true);

xmlhttp.send();
}


//////////////////////////////site type function

function validate1(){
var a=document.getElementById("form1");
//alert(a);
 with(a)
 {
if(now2.value=='')
{
alert("Please Enter Nature of Work");
	now2.focus();
	return;
}
if(asst2.value=='')
{
alert("Please Enter Problem");
	asst2.focus();
	return;
}
if(material2.value=='')
{
alert("Please Enter Issue Description");
	material2.focus();
	return;
}
if(now.value==now2.value && asst2.value==asst2.value && material.value==material2.value)
{
	alert("Entry Already Exists");
	state.focus();
	return;
}


a.submit();

 
 }
 }
 function incre(id)
 
 {
 if(document.getElementById(id).checked==true)
 document.getElementById("chk").value=Number(document.getElementById("chk").value)+1;
 else if(document.getElementById(id).checked==false)
 document.getElementById("chk").value=Number(document.getElementById("chk").value)-1;
 }
function getmat(id,id2,id3,type)
{
//alert(id+" "+id2+" "+id3);
document.getElementById('mater2').innerHTML="<center><img src=loader.gif></center>";
//alert(document.getElementById('cust').value);
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
	//alert(xmlhttp.responseText);
	
	document.getElementById(id3).innerHTML=xmlhttp.responseText;
	document.getElementById('mater2').innerHTML="";
    }
  }
//alert("getmaterial.php?val="+val);
var val='';
var val2='';
if(document.getElementById(id).value!='-1')
val=document.getElementById(id).value;
if(document.getElementById(id2).value!='-1')
val2=document.getElementById(id2).value;
xmlhttp.open("GET","getmaterial.php?val="+val+"&val2="+val2+"&type="+type,true);
xmlhttp.send();
	//alert("getmaterial.php?val="+val+"&val2="+val2+"&type="+type);
}

function fillmat(id)
{
//alert(id);
var x=document.getElementById(id).value;
document.getElementById(id+"2").value=x;
}
</script>
<body>
<center>
<?php include("menubar.php");include('config.php'); ?>

<h2> New Site Issue</h2>
<div id="header">
<form action="process_siteissue.php" method="post" name="form"  id="form1" >
<table>
<tr><td colspan="2" id="mater2">
    </td></tr>
<tr>
<td width="174" height="35">Select Nature of Work : </td>
<td width="293" colspan=2>
<?php
$st=mysqli_query($con,"select distinct(now) from atmassets order by now ASC");
?>
<select name="now" id="now" onchange="getmat('now','asst','asst','asset');fillmat(this.id);">
<option value="">Select Nature of Work</option>
<?php
while($stro=mysqli_fetch_array($st))
{
?>
<option value="<?php echo $stro[0]; ?>"><?php echo $stro[0]; ?></option>
<?php
}
?>
</select>
</td>
</tr>
<tr>
<td width="174" height="35">Enter Nature of Work : </td>
<td width="293" colspan=2>
<input type="text" name="now2" id="now2">

</td>
</tr>
<tr>
<td width="174" height="35">Select problem : </td>
<td width="293" colspan=2>
<?php
$comp=mysqli_query($con,"select distinct(problem) from atmassets order by component ASC");
?>
<select name="asst" id="asst" onchange="getmat('now','asst','material','material');fillmat(this.id);">
<option value="">Select problem</option>
<?php
while($compro=mysqli_fetch_array($comp))
{
?>
<option value="<?php echo $compro[0]; ?>"><?php echo $compro[0]; ?></option>
<?php
}
?>
</select>
</td>
</tr>
<tr>
<td width="174" height="35">Enter problem : </td>
<td width="293" colspan=2>
<input type="text" name="asst2" id="asst2">

</td>
</tr>

<tr>
<td width="174" height="35">Select Description : </td>
<td width="293" colspan=2>
<?php
$desc=mysqli_query($con,"select distinct(description) from atmassets order by  description ASC");
?>
<select name="material" id="material" onchange="fillmat(this.id);">
<option value="">Select Description</option>
<?php
while($descro=mysqli_fetch_array($desc))
{
?>
<option value="<?php echo $descro[0]; ?>"><?php echo $descro[0]; ?></option>
<?php
}
?>
</select>
</td>
</tr>
<tr>
<td width="174" height="35">Enter Description: </td>
<td width="293" colspan=2>
<input type="text" name="material2" id="material2">

</td>
</tr>
<tr>
<td width="174" height="35">Include in Client Quotation : </td>
<td width="293" colspan=2>

<select name="inc" id="inc">
<option value="1">YES</option>
<option value="0">NO</option>

</select>
</td>
</tr>
</table>
</fieldset>
</td></tr>
<tr>
<td height="35" colspan=3><input type="hidden" name="chk" id="chk" value="0" /><input type="button" value="submit" class="readbutton" onclick="validate1()"/></td>
</tr>
</table>
<div id="msg" style="display:none;">No More Coordinator's Can be added on this branch </div>
</form>
</div>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</center>
</body>
</html>