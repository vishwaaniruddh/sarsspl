<?php
include("access.php");

session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{


$sendid=$_GET['sendId'];




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
<script type="text/javascript" src="script.js"></script>
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

</head>

<body  >
<form name="frm1" id="frm1" method="post">

<div class="">
<center>
<?php  include("menubar.php"); ?>

<h2 class="h2color">View Quotation Invoice Details</h2>



<?php 
include("config.php");
?>

</center>


</div>



<center>

<table  border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 


<th>Sr No</th>
   <th>Customer</th>
   <th>Project</th>
   <th>Bank</th>
   <th>Atm ID</th>
   <th>Site ID</th>
   <th>City</th>
   <th>State</th>
   <th>Location</th>
   <th>Work Details</th>
   <th>Month</th>
   <th>Approval Date</th>
   <th>Approval Amount</th>
   <th>Approved By</th>
  
   <?php 
   
   $getinvm=mysqli_query($con,"select * from  rnm_invoice where send_id='".$sendid."'");
   $mnrow=mysqli_fetch_array($getinvm);
   
   
   
   $getanexdets=mysqli_query($con,"select * from  rnm_invoice_details where send_id='".$sendid."'");
             $getanexdets_NumRows=mysqli_num_rows($getanexdets);
             
             
   $srno=1;
   $ttmt=0;
   $bk="";
   while($annexrows=mysqli_fetch_array($getanexdets))
   {
       
       $gtdetsfrmquot=mysqli_query($con,"select * from quotation1 where id='".$annexrows["qid"]."'");
       $gdtsrwss=mysqli_fetch_array($gtdetsfrmquot);
       
      $bk= $gdtsrwss["bank"];
       
       //echo "select * from ".$gdtsrwss["cust"]."_sites where atm_id1='".$gdtsrwss["atm"]."'";
       $stts=mysqli_query($con,"select * from ".$gdtsrwss["cust"]."_sites where atm_id1='".$gdtsrwss["atm"]."'");
       $sttsrws=mysqli_fetch_array($stts);
       
      // echo "Select * from quotation_approve_details where qid='".$gdtsrwss[0]."'";
       $gapdet=mysqli_query($con,"Select * from quotation_approve_details where qid='".$gdtsrwss[0]."'");
$nurws=mysqli_num_rows($gapdet);

if($nurws>0)
{
$approw=mysqli_fetch_array($gapdet);


}
   ?>
   
   <tr>
       <td><?php echo $srno; ?></td>
   <td><?php echo $gdtsrwss["cust"];?></td>
   <td><?php echo $gdtsrwss["project"];?></td>
   <td><?php echo $gdtsrwss["bank"];?></td>
   <td><?php echo $gdtsrwss["atm"];?></td>
   <td><?php echo $sttsrws["site_id"];?></td>
   <td><?php echo $gdtsrwss["city"];?></td>
   <td><?php echo $gdtsrwss["state"];?></td>
   <td><?php echo $gdtsrwss["location"];?></td>
   	       <td  align="left" width="300">
	     
<?php

if($gdtsrwss[2]=='ICICI' || $gdtsrwss[2]=='RATNAKAR' || $gdtsrwss[2]=='ICICI_Direct' || $gdtsrwss[2]=='Knight_Frank' || $gdtsrwss[2]=='BajajFinance' || $gdtsrwss[2]=='kotak')
{
?>
<table border='1'>
<?php
$qdetici=mysqli_query($con,"select * from icici_quot_details where qid='".$gdtsrwss[0]."'");
 while($gdetca2=mysqli_fetch_array($qdetici))
 {
 ?>
<tr>

  <td width="100"><?php echo $gdetca2[2];?></td>
  <td width="100"><?php echo $gdetca2[3];?></td>
<td width="200"><?php echo $gdetca2[4];?></td>
<td width="100"><?php echo $gdetca2[5];?></td>
<td width="100"><?php echo $gdetca2[6];?></td>
<td width="100"><?php echo $gdetca2[7];?></td>
<td width="100"><?php echo $gdetca2[8];?></td>
<td width="100"><?php echo $gdetca2[9];?></td>


</tr>
<?php
}
?>
</table>
<?php
 } 
 else
{
 ?>
 <table >
<?php
 
$qdetc=mysqli_query($con,"select distinct(particular) from quotation_details where qid='".$gdtsrwss[0]."'");
 while($gdetca=mysqli_fetch_array($qdetc))
 {
?>
<tr><td colspan="2" align="center"><b><?php echo $gdetca[0];?></b></td></tr>
<?php
  $gpart=mysqli_query($con,"select * from quotation_details where particular='".$gdetca[0]."' and qid='".$gdtsrwss[0]."'");
$str='a';
while($gparta=mysqli_fetch_array($gpart))
 {
?>
  <tr><td width=""><?php echo "(".$str.")".$gparta[3];?></td>
<td  align="left"><?php echo "(".$gparta[4]."*".round($gparta[5]).")" ;?></td>
</tr>

<?
$str++;
 }

  
 }
?>
</table>
<?php
}?>
</td>

   <td><?php echo date("M-Y",strtotime($approw["approved_date"]));?></td>
   <td><?php
   $mnth=date("M-Y",strtotime($approw["approved_date"]));
   if($approw["approved_date"]!="0000-00-00"){ echo date("d-M-Y",strtotime($approw["approved_date"])); } ?></td>
   <td align="right"><?php echo $approw["app_amt"]; $ttmt=$ttmt+$approw["app_amt"];?></td>
   <td ><?php echo $approw["app_by"]; ?></td>
   </tr>
   <?php
   $srno++;
   } ?>
   <tr>
      <td colspan="12" align="center">Total Amount</td>
      <td colspan="" align="right"><?php echo $ttmt;?></td>
      <td></td>
       </tr>
   </table>
</div> 
</center>
</form>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php 
}
?>