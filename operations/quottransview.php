<?php
include("access.php");
include("config.php");
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{
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
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
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


function getaccm()
{

<?php if($_SESSION['designation']!='22' || $_SESSION['designation']!='11')
{
?>

var cst=document.getElementById('cust1').value;
//alert(cst);
$.ajax({
   type: 'POST',    
url:'get_accmanager.php',
data:'cust='+cst,
success: function(msg){

//alert(msg);
document.getElementById('accname').innerHTML=msg;

 
         }
     });

<?php } ?>
func('','');
}




function func(strpg,perpg)
{
var accname="";
var bank=document.getElementById('bank').value;
var sup=document.getElementById('sup').value;
var strdt=document.getElementById('frmdt').value;
var endt=document.getElementById('todt').value;
var cst=document.getElementById('cust1').value;
var atms=document.getElementById('atms').value;
<?php if($_SESSION['designation']!='11')
{
?>
var accname=document.getElementById('accname').value;
<?php } ?>

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


//alert(atm);

$.ajax({
   type: 'POST',    
url:'getquotdfr.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'sup='+sup+'&strdt='+strdt+'&endt='+endt+'&perpg='+perp+'&Page='+Page+'&accname='+accname+'&cst='+cst+'&atms='+atms+'&bank='+bank,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;
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

window.open('viewfisquotdetails.php?qid='+qid,'_blank');
}
else if(ct=="Tata")
{

window.open('viewtataquotdetails.php?qid='+qid,'_blank');
}
else if(ct=="ICICI" || ct=="RATNAKAR" ||ct=="ICICI Direct" ||ct=="Knight Frank" )
{

window.open('viewiciciquot.php?qid='+qid,'_blank');
}
else
{



 window.open('viewquotdetails.php?qid='+qid,'_blank');
  } 



}





function getbank()
{
	//alert(val);



  var cst=document.getElementById('cust1').value;
//alert(cst);



	if (window.XMLHttpRequest)
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
           xmlhttp=new XMLHttpRequest();
        }
      else
       {
           // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
       }
       xmlhttp.onreadystatechange=function()
       {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
		
            //alert(xmlhttp.responseText);
            document.getElementById('bank').innerHTML='';
	    document.getElementById('bank').innerHTML=xmlhttp.responseText;
	

	    
	
          }
       }
       xmlhttp.open("GET","getbank.php?val="+cst,true);
       xmlhttp.send();
      
	
}



</script>
</head>
<body onload="getaccm();">
<form method="post" action="quotransfer_export.php" target='_blank'>
<center>
<?php  include("menubar.php"); ?>
<h2 class="h2color">RNM FUND REQUESTS </h2>

<input type="hidden" id="acccust" value="<?php echo $_SESSION['custid'];?>" readonly/>
	<br />
<table>

<th>

<?php

$sql="Select short_name,contact_first from contacts where type='c' ";
$cnt="";
if($_SESSION['custid']!='all')
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
 <select  name="cust1" id="cust1" onchange="getbank();" >
<?php
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>" <?php if($_SESSION['custid']==$clro[0]){ echo "selected"; } ?>><?php echo $clro[1]; ?></option>
<?php
}
?>
</select> </th>



<th>
<select style="width:150px" name="bank" id="bank" >
<option value="0">Select Bank</option>

</select>
</th>


<?php if($_SESSION['designation']!='11')
{
?>
<th><select id="accname" name="accname" style="width:100px" onchange="func();">

<?php 


$qrs="";
if($_SESSION['designation']=='8')
{
$qrs="select srno,username from login where designation='8' and serviceauth='2' and deptid='4'  ";

?>
<option value="-1">select made by</option>
<?php
//echo $qrs;
$gqr=mysqli_query($con,$qrs);


while($qrsrow=mysqli_fetch_array($gqr))
{

?>

<option value="<?php echo $qrsrow[0];?>"  <?php if($acmr==$qrsrow[0]){ echo "selected"; } ?>><?php echo $qrsrow[1];?></option>
<?php } 
}


else
{
    
$qrs="select srno,username from login where designation='22' and serviceauth='2' and deptid='6' ";


//echo $qrs;
$gqr=mysqli_query($con,$qrs);


while($qrsrow=mysqli_fetch_array($gqr))
{
?>
<option value="<?php echo $qrsrow[0];?>"><?php echo $qrsrow[1];?></option>

<?php
}

}
?>
</select>
</th>

<?php } ?>



<th>

<?php
$sup="";
if($_SESSION['designation']=='11')
{
$sup=mysqli_query($con,"select aid,hname,accno from fundaccounts where status=0 and srno='".$_SESSION['id']."' order by hname ASC ");
}
else
{

$sup=mysqli_query($con,"select * from fundaccounts order by hname ASC");
}


?>
<select name="sup" id="sup">
<?php
if($_SESSION['designation']!='11')
{
?>
<option value="-1">Select Supervisor</option>
<?php }

while($supro=mysqli_fetch_array($sup))
{
?>
<option value="<?php echo $supro[0]; ?>" <?php if($_POST['sup']==$supro[0]){ echo "selected"; } ?>><?php echo $supro[1]."/ ".$supro[2]; ?></option>
<?php
}
?>
</select>
</th>
<th>From Date:- <input type="text" name="frmdt" id="frmdt" value="<?php if(isset($_POST['frmdt'])){ echo $_POST['frmdt']; }else{ echo date('d/m/Y',strtotime('-2 days'));} ?>" onclick="displayDatePicker('frmdt');" ></th>
<th>
To Date:- <input type="text" name="todt" id="todt" value="<?php  if(isset($_POST['todt'])){ echo $_POST['todt']; }else{ echo date('d/m/Y'); } ?>" onclick="displayDatePicker('todt');" >
</th>

<th>
<input type="text" value="" name="atms" id="atms" placeholder="Atm Id">
</th>
<th>
<input type="button" value="Search" name="cmdsearch" onclick="func('','');">
</th>
</table>
<center>
<div id="search"></div>

</center>

<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php 
}
?>