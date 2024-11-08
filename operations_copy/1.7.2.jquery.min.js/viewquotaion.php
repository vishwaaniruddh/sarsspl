<?php 
	include("access.php");
	include("config.php");	
	
	session_start();
//include("access.php");
if(!$_SESSION['user'])
{
?>
<script type="text/javascript">
alert("Sorry Your session has Expired");
window.location="index.php";
</script>
<?php
}
	
	
	
	

$qoid=$_GET['qoid'];
$sts=$_GET['strdt'];
$ends=$_GET['endt'];
$oatm=$_GET['oatm'];

   

   
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<script src="excel.js" type="text/javascript"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>


<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script type="text/javascript">









function vdtefunc(id)
{
//lert(id);
var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;

//alert(qid);

var ct=document.getElementById('customer'+count).value.trim();
//alert(qid);
//alert(ct);
if(ct=="Fidility")
{

window.open('viewfisquotdetails.php?qid='+qid,'_blank');
}
else
{



 window.open('viewquotdetails.php?qid='+qid,'_blank');
  } 



}
function vhisfunc(id)
{

var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;

//alert(qid);

 window.open('viewoldquot.php?qid='+qid,'_blank');
   



}

function vpdffunc(id)
{
//lert(id);
var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;

//alert(qid);

 window.open('savequotpdf.php?qid='+qid,'_blank');
   



}


function editfunc(id)
{


var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;

var qoid=document.getElementById('quot').value;
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
var atm=document.getElementById('atm').value;


//alert(qid);

 window.open('editquotation.php?qid='+qid+'&qoid='+qoid+'&strdt='+strdt+'&endt='+endt+'&atm='+atm,'_self');


}





function func()
{

var qid=document.getElementById('quot').value;
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
var atm=document.getElementById('atm').value;
var pnxt=document.getElementById('nxtpg').value;
alert(pnxt);
var frnxt=parseInt(pnxt)+50;

document.getElementById('nxtpg').value=frnxt;

//alert(qid);
$.ajax({
   type: 'POST',    
url:'getquotdetails.php',
data:'qid='+qid+'&strdt='+strdt+'&endt='+endt+'&atm='+atm+'&pnxt='+pnxt,
success: function(msg){

//alert(msg);
  document.getElementById('show').innerHTML=msg;
         }
     });

}


</script>
<style>


</style>
</head>
<body onload="func();" >
<center>
<?php include("menubar.php"); ?>
<h2>Edit Quotation</h2>
<form id="frmup" name="frmup"  method="post" action="expquot.php" target="_blank" >

<div id="mdiv" align="center" ><label>Quotation ID</label><input type="text" id="quot" name="quot" value="<?php echo $qoid;?>"/>

<label>Atm ID</label><input type="text" id="atm" name="atm" value="<?php echo $oatm;?>"/>
 <label>From Date</label><input type="text" name="date" id="date"  onclick="displayDatePicker('date');"  value="<?php echo $sts;?>"/>
  <label>To Date</label>  <input type="text" name="date2" id="date2"  onclick="displayDatePicker('date2');"  value="<?php echo $ends;?>"/> 
       
 <input type="button" name ="search" id="search" value="Search" onclick="func()"/></div><br>

<div id="show"></div>
<input type="text" name="nxp" id="nxtpg" value="0">


<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</form>
</center>
</body>

</html>





