<?php
include("access.php");
include("config.php");


$custr=$_GET['cr'];
$acmr=$_GET['acmr'];
$catr=$_GET['crcatr'];
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


function getaccm(cst)
{

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

window.open('viewfisquotdetails.php?qid='+qid,'_blank');
}
else if(ct=="Tata")
{

window.open('viewtataquotdetails.php?qid='+qid,'_blank');
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


function func()
{

var cust=document.getElementById('cust1').value;
var stat=document.getElementById('stat').value;
var strdt=document.getElementById('sdate').value;
var endt=document.getElementById('edate').value;
var atm=document.getElementById('atmid').value;
var accname=document.getElementById('accname').value;
var type=document.getElementById('type').value;


//alert(accname);

//alert(atm);
$.ajax({
   type: 'POST',    
url:'search_trvijay.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'cust='+cust+'&strdt='+strdt+'&endt='+endt+'&atm='+atm+'&stat='+stat+'&accname='+accname+'&type='+type,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;
         }
     });





}







function transdiv(id)
{


var counts= id.replace( /^\D+/g, '').trim();
//alert(counts);
document.getElementById("trdiv"+counts).style.display = 'block';


}



function transfunc(id)
{

var cust=document.getElementById('cust1').value;
var stat=document.getElementById('stat').value;
var strdt=document.getElementById('sdate').value;
var endt=document.getElementById('edate').value;
var atm=document.getElementById('atmid').value;
var accname=document.getElementById('accname').value;
var type=document.getElementById('type').value;



//alert("hrllo");

var counts=id.replace( /^\D+/g, '').trim();
var qid=document.getElementById('qid'+counts).value;
var tramt=document.getElementById('trreqamt'+counts).value;
var vcno=document.getElementById('vcno'+counts).value;
var supe=document.getElementById('sv'+counts).value;

var conf=confirm('Do you really want to transfer the quotation?');
    
 

if(conf==true)
{
$.ajax({
            type: "POST",
            url: "process_quotation_transfer.php",
            data: 'qid='+qid+'&tramt='+tramt+'&vcno='+vcno+'&sup='+supe,
             beforeSend: function()
                   {
        
                document.getElementById(id).disabled=true;
                 document.getElementById(id).value="please wait";
                  },
            success: function(msg){
               
                 
                alert(msg);
                   
                window.open('view_transfervijay.php?&cr='+cust+'&acmr='+accname+'&catr='+type+'&typr='+stat+'&atmr='+atm+'&fr='+strdt+'&er='+endt,'_self')

                
            }
        });
}






}









</script>
</head>
<body>
<form  method="post" >
<center>
<?php  include("menubar.php"); ?>
<h2 class="h2color">RNM FUND TRANSFER</h2>


	<br />
<table  border="0" cellpadding="0" cellspacing="0">

<tr>
<th >

<input type="hidden" name="dept" id="dept" value="<?php echo $_SESSION['dept']; ?>"/>
<input type="hidden" name="service" id="service" value="<?php echo $_SESSION['serviceauth']; ?>"/>
<input type="hidden" name="desig" id="desig" value="<?php echo $_SESSION['designation']; ?>"/>
<?php

$sql="Select short_name,contact_first from contacts where type='c' ";
if($_SESSION['custid']!='all')
$sql.=" and short_name='".$_SESSION['custid']."'";
//echo $sql;
$qry=mysqli_query($con,$sql);

 ?>
 <select  name="cust1" id="cust1" onchange="getaccm(this.value);" >
<option value="">Select Client</option>
<?php
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>" <?php if($_SESSION['custid']==$clro[0]){ echo "selected"; } ?>><?php echo $clro[1]; ?></option>
<?php
}
?>
</select> </th>




<th><select id="accname" name="accname" onchange="func();">
<option value="-1">select made by</option>
<?php 

$qrs=mysqli_query($con,"select srno,username from login where designation='8' and serviceauth='2' and deptid='4' ");

while($qrsrow=mysqli_fetch_array($qrs))
{

?>

<option value="<?php echo $qrsrow[0];?>"><?php echo $qrsrow[1];?></option>
<?php } ?>
</select>
</th>


<th><select id="type" name="type" onchange="func();">
<option value="-1">select category</option>


<option value="f">Fixed Cost</option>
<option value="a">Approval Basis</option>

</select>
</th>






<th><select id="stat" onchange="func();">


<!--<option value="-1">status</option>-->

<?php if($_SESSION['designation']=="6" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='5')

{
?>

<option value="1">Local</option>
<?php } ?>

</select></th>





<th width="75"><input type="text" name="atmid" id="atmid" placeholder="AtmID"/></th>
<th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" placeholder="From Date"/></th>
<th width="75"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');" placeholder="To Date"/></th>


<th><input type="button" name="search"  value="search" onclick="func();"/></td>
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