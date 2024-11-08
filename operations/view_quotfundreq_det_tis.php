<?php
include("access.php");
include("config.php");


if(!$_SESSION['user'])
{
?>
<script type="text/javascript">
alert("Sorry Your session has Expired");
window.location="index.php";
</script>
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
<script type="text/javascript">

var tableToExcel = (function() {
//alert("hii");
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>

<script>



function expex()
{


$('#frm1').attr('action', 'frexport_tis.php').attr('target','_blank');
$('#frm1').submit();

}


function getaccm()
{


$cst=document.getElementById('cust1').value;
$.ajax({
   type: 'POST',    
url:'get_accmanager.php',
data:'cust='+cst,
success: function(msg){

//alert(msg);
document.getElementById('accname').innerHTML=msg;

 
         }
     });



}





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

window.open('viewfisquotdetails_tis.php?qid='+qid,'_blank');
}
else if(ct=="Tata")
{

window.open('viewtataquotdetails_tis.php?qid='+qid,'_blank');
}

else if(ct=="ICICI" || ct=="RATNAKAR" ||ct=="ICICI Direct" ||ct=="Knight Frank" )
{

window.open('viewiciciquot_tis.php?qid='+qid,'_blank');
}
else
{

 window.open('viewquotdetails_tis.php?qid='+qid,'_blank');
  } 



}
function vhisfunc(id)
{

var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;

//alert(qid);

 window.open('viewoldquot_tis.php?qid='+qid,'_blank');
   



}


function func(strpg,perpg)
{

var cust=document.getElementById('cust1').value;

var type=document.getElementById('type').value;
var benf=document.getElementById('benf').value;
var strdt=document.getElementById('sdate').value;
var endt=document.getElementById('edate').value;
var atm=document.getElementById('atmid').value;




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
url:'get_quotfund_det_tis.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'cust='+cust+'&strdt='+strdt+'&endt='+endt+'&atm='+atm+'&type='+type+'&perpg='+perp+'&Page='+Page+'&benf='+benf,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;



     lcalc();
 
         }
     });





}






</script>
</head>
<body  onload="getaccm();" >
<form id='frm1' method="post" >
<center>
<?php  include("menubar.php"); ?>
<h2 class="h2color">RNM FUND REQUESTS </h2>


	<br />
<table  border="0" cellpadding="0" cellspacing="0">

<tr>
<th >

<input type="hidden" name="dept" id="dept" value="<?php echo $_SESSION['dept']; ?>"/>
<input type="hidden" name="service" id="service" value="<?php echo $_SESSION['serviceauth']; ?>"/>
<input type="hidden" name="desig" id="desig" value="<?php echo $_SESSION['designation']; ?>"/>
<?php

$sql="Select short_name,contact_first from contacts where type='c' ";
if($_SESSION['custid']!=all)
{


$carr=explode(',',$_SESSION['custid']);

$cnt=count($carr);

for($i=0;$i<$cnt;$i++)
{
 if($i==0)
{


$sql.=" and short_name='".$carr[$i]."'";
}
else
{
$sql.=" or short_name='".$carr[$i]."'";

}

}
}
$qry=mysqli_query($con,$sql);

 ?>

 <select  name="cust1" id="cust1" onchange="getaccm(this.value);" >
<?php
if($_SESSION['designation']=='11')
{
?>
<option value="">select customer</option>
<?php
}

while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>" <?php if($custr==$clro[0]){ echo "selected"; }if($_SESSION['custid']==$clro[0]){ echo "selected"; } ?>><?php echo $clro[1]; ?></option>
<?php
}
?>
</select> </th>





<th><select id="type" name="type" >
<option value="-1">select category</option>

<option value="f"  <?php if($catr=='f'){ echo "selected"; } ?>>Fixed Cost</option>
<option value="a" <?php if($catr=='a'){ echo "selected"; } ?>>Approval Basis</option>

</select>
</th>



<th>

<select id="benf" name="benf" >

<?php
$sup="";
if($_SESSION['designation']=='11')
{

$sup="select hname,aid,accno from fundaccounts where status=0 and hname='".$_SESSION['user']."' order by hname ASC ";
}
else
{
$sup="select hname,aid,accno from fundaccounts where status=0 order by hname ASC";
?>
<option value="0" >select beneficiary</option>
<?php
}
$supq=mysqli_query($con,$sup);


   
	 while($supro=mysqli_fetch_array($supq))
	{ ?>
	   <option value="<?php echo $supro[1]; ?>"  ><?php echo $supro[0]."/".$supro[2]; ?></option>
   <?php } ?>  
    </select>

</th>






<th width="75"><input type="text" name="atmid" id="atmid" placeholder="AtmID" value="<?php if($atmr!=""){ echo $atmr; }?>"/></th>
<th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" value="<?php if($fr!=""){ echo $fr; }?>"  placeholder="From Date"/></th>
<th width="75"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');" value="<?php if($er!=""){ echo $er; }?>" placeholder="To Date"/></th>


<th><input type="button" name="search"  value="search" onclick="func('','');"/></td>
</tr>
</table>
</center>



<center>
<div id="search"></div>

</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php 

?>