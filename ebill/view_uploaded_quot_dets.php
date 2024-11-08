<?php
include("access.php");
include("config.php");


if(!$_SESSION['user'])
{
?>
<script type="text/javascript">
alert("Sorry Your session has Expired");
window.location="index.php";
</script>n 
<?php
}


$custr=$_GET['cr'];
$acmr=$_GET['acmr'];
$catr=$_GET['catr'];
$typr=$_GET['typr'];
$atmr=$_GET['atmr'];
$fr=$_GET['fr'];
$er=$_GET['er'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script>





function vdtefunc(id)
{
//lert(id);
var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;

var ct=document.getElementById('customer'+count).value.trim();
//alert(qid);
//alert(ct);
if(ct=="Fidility")
{

window.open('viewfisquotdetails.php?qid='+qid,'_blank');
}
else if(ct=="Tata")
{

window.open('viewtataquotdetails.php?qid='+qid,'_blank');
}
else if(ct=="ICICI"  || ct=="RATNAKAR" || ct=="ICICI Direct" || ct=="Knight Frank"  || ct=='BajajFinance' || ct=='kotak' )
{
window.open('viewiciciquot.php?qid='+qid,'_blank');

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


function func(strpg,perpg)
{

var cust=document.getElementById('cust1').value;
var strdt=document.getElementById('sdate').value;
var endt=document.getElementById('edate').value;
var atm=document.getElementById('atmid').value;
var accname=document.getElementById('accname').value;
var type=document.getElementById('type').value;
var rnmtyp=document.getElementById('rnmtyp').value;
var benf=document.getElementById('benf').value;
var qid=document.getElementById('reqid').value;


var exnm=[];

$('#excust').each(function() {
    
    exnm.push($(this).val());
   
});




if(perpg=="")
{
perp='50';
}
else
{
perp=document.getElementById(perpg).value;
}



var Page="";
if(strpg!="")
{
Page=strpg;
}






//alert(accname);

//alert(atm);
$.ajax({
   type: 'POST',    
url:'uploaded_quot_dets_search.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'cust='+cust+'&strdt='+strdt+'&endt='+endt+'&atm='+atm+'&accname='+accname+'&type='+type+'&perpg='+perp+'&Page='+Page+'&rnmtyp='+rnmtyp+'&benf='+benf+'&exnm='+exnm+'&qid='+qid,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;



   
         }
     });





}


</script>
</head>
<body  <?php if($custr!="" || $acmr!="" || $catr!="" || $typr!="" || $atmr!="" || $fr!="" || $er!="" ) {?>onload='func('','');' <?php }?> >
<form id='frm1' method="post" >
<input type="text" name="payarr" id="payarr" readonly>
<center>
<?php  include("menubar.php"); ?>
<h2 class="h2color">RNM FUND REQUESTS </h2>


	<br />
<table  border="0" cellpadding="0" cellspacing="0">

<tr>

<?php

$sql="Select short_name,contact_first from contacts where type='c' ";
if($_SESSION['custid']!='all')
$sql.=" and short_name='".$_SESSION['custid']."'";
//echo $sql;
$qry=mysqli_query($con,$sql);

 ?>
<th >

<input type="hidden" name="dept" id="dept" value="<?php echo $_SESSION['dept']; ?>"/>
<input type="hidden" name="service" id="service" value="<?php echo $_SESSION['serviceauth']; ?>"/>
<input type="hidden" name="desig" id="desig" value="<?php echo $_SESSION['designation']; ?>"/>

 <select  name="cust1" id="cust1" onchange="getaccm(this.value);" >
<option value="">Select Client</option>
<?php
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>" <?php if($custr==$clro[0]){ echo "selected"; } ?>><?php echo $clro[1]; ?></option>
<?php
}
?>
</select> </th>


<th>
<?
$sql2="Select short_name,contact_first from contacts where type='c' ";
$qry2=mysqli_query($con,$sql2);
 ?>

 <select  multiple name="excust[]" id="excust" style="height:85px;" >
<option value="">exclude Client</option>
<?php
while($clro1=mysqli_fetch_row($qry2))
{
?>
<option value="<?php echo $clro1[0]; ?>" ><?php echo $clro1[1]; ?></option>
<?php
}
?>
</select> </th>


<th>
<?php // echo "select srno,username from login where designation='11' and serviceauth='3' and deptid='4' and srno in(select reqby in quotation1) "; ?>
<select id="accname" name="accname" onchange="func();">

<option value="-1">select made by</option>
<?php 

$qrs=mysqli_query($con,"select srno,username from login where designation='8' and serviceauth='2' and deptid='4' ");

while($qrsrow=mysqli_fetch_array($qrs))
{

?>

<option value="<?php echo $qrsrow[0];?>"  <?php if($acmr==$qrsrow[0]){ echo "selected"; } ?>><?php echo $qrsrow[1];?></option>
<?php } 

$qrs2=mysqli_query($con,"select srno,username from login where designation='11' and serviceauth='3' and deptid='4' and srno in(select reqby from quotation1) ");

while($qrsrow2=mysqli_fetch_array($qrs2))
{

?>

<option value="<?php echo $qrsrow2[0];?>" ><?php echo $qrsrow2[1];?></option>
<?php } ?>




</select>
</th>


<th><select id="type" name="type" onchange="func();">
<option value="-1">select category</option>

<option value="f"  <?php if($catr=='f'){ echo "selected"; } ?>>Fixed Cost</option>
<option value="a" <?php if($catr=='a'){ echo "selected"; } ?>>Approval Basis</option>

</select>
</th>



<th><select id="benf" name="benf" onchange="func();">

<?php if($_SESSION['dept']!='7') { ?>

<option value="0" >select beneficiary</option>

<?php } ?>
<?php
$fqr="select hname,aid,accno from fundaccounts where status=0 ";

if($_SESSION['designation']=="20" & $_SESSION['dept']=='7') { 

$fqr.=" and hname='Vikrant Enterprises'";
}

$fqr.=" order by hname ASC";
 $sup=mysqli_query($con,$fqr);
 
    
	 while($supro=mysqli_fetch_array($sup))
	{ ?>
	   <option value="<?php echo $supro[1]; ?>" ><?php echo $supro[0]."/".$supro[2]; ?></option>
   <?php } ?>  
    </select>

</th>







<th><select id="rnmtyp"  onchange="func();">

<option value="" >All</option>

<option value="556" >rnmfund</option>

<option value="558" >rnmnorth</option>

</select></th>




<th width="75"><input type="text" name="atmid" id="atmid" placeholder="AtmID" value="<?php if($atmr!=""){ echo $atmr; }?>"/></th>
<th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" value="<?php if($fr!=""){ echo $fr; }?>"  placeholder="From Date"/></th>

<th width="75"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');" value="<?php if($er!=""){ echo $er; }?>" placeholder="To Date"/></th>

<th><textarea style="height:70px" name="reqid" id="reqid" placeholder="Qid" rows="1"></textarea></th>
<th><input type="button" name="search"  value="search" onclick="func('','');"/></td>
</tr>
</table>
</center>



<center>
<div id="search"></div>

</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script src="excel.js" type="text/javascript"></script>

</body>
</html>
<?php 

?>