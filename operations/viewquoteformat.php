<?php
session_start();
if(!$_SESSION['user'])
{
echo "<script type='text/javascript'>alert('Sorry, Your Session has Expired. Please Login again');window.close();</script>";
}
//echo $_SESSION['user']."".$_SESSION['designation']." ".$_SESSION['dept']." ".$_SESSION['serviceauth'];
?>
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
<script type="text/javascript">     
        function PrintDiv(id) {   
       <!-- document.getElementById('hide').style.display='none';--> 
           var divToPrint = document.getElementById(id);
           
           var popupWin = window.open('', '_blank', 'width=800,height=400');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
</script>
<?php
if($_SESSION['designation']=='8' && $_SESSION['dept']=='4' && ($_SESSION['serviceauth']=='2' || $_SESSION['serviceauth']=='3' || $_SESSION['serviceauth']=='1'))
{
?>
<!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>-->
Use Chrome for printing into pdf
<input type="button" name="GENERATE" id="GENERATE" value="PRINT PDF" onclick="PrintDiv('ppdf');" />
<?php
}
include("config.php");
$quot=$_GET['quotid'];
$qry=mysqli_query($con,"select * from quotation where quotid='".$quot."'");
$row=mysqli_fetch_row($qry);
$site='';
if($row[18]=='rnmsites')
$site="select cust_id,atmsite_address,bank,atm_id1 from rnmsites where id='".$row[4]."'";
else
$site="select cust_id,atmsite_address,bank,atm_id1 from ".$row[3]."_sites where trackerid='".$row[4]."'";

$resul3=mysqli_query($con,$site);
                $ro3=mysqli_fetch_row($resul3); 
                $cust_id1=$cid;
			$srn=mysqli_query($con,"select designation from login where username='".$_SESSION['user']."'");
			$sr=mysqli_fetch_row($srn);	
						
				$resul4=mysqli_query($con,"select id from contacts where short_name='$row[3]'");
                $ro4=mysqli_fetch_row($resul4); 
                $uid1=$ro4[0];
				
                $resul5=mysqli_query($con,"select * from address_book where ref_id='$uid1'");
                $addrow1=mysqli_fetch_row($resul5); 
                $resul6=mysqli_query($con,"select billname from billcompany where cust_id='$cust_id1'");
                $brow1=mysqli_fetch_row($resul6); 
 $nwords = array("Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen", "Twenty", 30 => "Thirty", 40 => "Forty", 50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eighty", 90 => "Ninety" ); 
function int_to_words($x)
       {
	   //echo $x;
           global $nwords;
           if(!is_numeric($x))
           {
               $w = '#';
           }else if(fmod($x, 1) != 0)
           {
               $w = '#'; 
           }else{
               if($x < 0)
               {
                   $w = 'minus ';
                   $x = -$x;
               }else{
                   $w = '';
               } 
               if($x < 21)
               {
                   $w .= $nwords[$x];
               }else if($x < 100)
               {
                   $w .= $nwords[10 * floor($x/10)];
                   $r = fmod($x, 10); 
                   if($r > 0)
                   {
                       $w .= '-'. $nwords[$r];
                   }
               } else if($x < 1000)
               {
                   $w .= $nwords[floor($x/100)] .' Hundred'; 
                   $r = fmod($x, 100);
                   if($r > 0)
                   {
                       $w .= ' and '. int_to_words($r);
                   }
               } else if($x < 100000) 
               {
                   $w .= int_to_words(floor($x/1000)) .' Thousand';
                   $r = fmod($x, 1000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $w .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               } else if($x < 10000000){
                   $w .= int_to_words(floor($x/100000)) .' Lakh';
                   $r = fmod($x, 100000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $word .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               }else {
                   $w .= int_to_words(floor($x/10000000)) .' Crore';
                   $r = fmod($x, 10000000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $word .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               }
           }
           return $w;
       }
?><div id="ppdf" >
<table width="80%" align="center" id="custtable">
<?php  if($row[3]!='EUR08') { ?>
<tr height="100px"><td align="center" colspan="2">Om Sai Ram<br>
Clear Secured Service Pvt. Lid.<br>
D-201,Runwal & Omkar E-Square, Sion (East),Mumbai 400 022. Tel : 022 24022435</td></tr>
<?php }else{
 ?>
<tr height="100px"><td align="center" colspan="2">
<h2><font color="red">Clean & Clear</font></h2>
<font color="blue">Rajgir Sadan Opp Sion Railway St Sion East Mumbai-22.</font></td></tr>
<?php 

} ?>
<tr><td valign="top" width="50%">
<table width="997" cellpadding="0" cellspacing="0" border="0">
 
  <tr height="17">
    <td height="17" width="393"><b>To,</b></td>
    <td width="300">&nbsp;</td>
     </td><td colspan="4" align="right" style="padding-right:20px">Date : <?php echo date("d M,Y"); ?></td>
    
  </tr>
  <tr><td>Ref. No.<?php echo date('d.m.Y'); ?>/M-<?php echo $quot; ?></td></tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[3]; ?></td>
    </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[5]; ?></td>
    </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[6]; ?></td>
    </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[7]."-".$addrow1[9]; ?></td>
    </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[8].",".$addrow1[10]; ?></td>
    </tr>
    <tr height="18">
    <td height="18" colspan="2">&nbsp;</td>
    </tr>
<tr height="18">
    <td height="18" colspan="2" <?php if($row[3]=='EUR08') { ?> align=center<?php } ?> ><u><b>Kind Atten :</b> <?php echo $row[15]; ?></u></td>
    </tr>
    <tr height="18">
    <td height="18" colspan="2" <?php if($row[3]=='EUR08') { ?> align=center<?php } ?>><u><b>Sub:-</b> <?php echo $row[11]; ?></u></td>
    </tr>
</table>
</td></tr>
<tr height="80px"><td valign="bottom" align="<?php if($row[3]=='EUR08') { ?> left<?php }else{ echo "center"; } ?>"><u>We would like to quote the following Rate:-</u></td></tr>
<tr><td colspan="2">
<table width="100%" border="1" style="border-color-light:black;border-spacing:1px"><tr><th>Sr. No.</th><th>Bank</th><th>ATM ID</th><th style="width:250px; overflow:hidden">Location</th><?php if($row[3]!='EUR08'){ ?><th>Description</th><th>Material</th><?php }else{ ?><th>Description</th><?php  } ?><th>Qty.</th><?php if($_SESSION['designation']<=8){ ?><th>Rate</th><th>Amount</th><?php } ?></tr>
<?php
$stat=0;
$tot=0;
$num=0;
$asst=array();
//echo "select * from quot_details where quotid='".$quot."'  and status='0' order by component,material ASC";
$det=mysqli_query($con,"select * from quot_details where quotid='".$quot."'  and status='0' order by component,material ASC");
while($detro=mysqli_fetch_array($det))
{
//echo "select * from atmassets where now='".$detro[9]."' and problem='".$detro[7]."' and description='".$detro[2]."' and incquot='1' and status='0'";
$ck=mysqli_query($con,"select * from atmassets where now='".$detro[9]."' and problem='".$detro[7]."' and description='".$detro[2]."' and incquot='1' and status='0'");
if(!$ck)
echo mysqli_error();
if(mysqli_num_rows($ck)>0){
$stat=$stat+1;
?>
<tr><td>&nbsp;<?php if($stat=='1'){ echo $stat; } ?></td><td>&nbsp;<?php if($stat=='1'){ echo $ro3[2]; } ?></td><td>&nbsp;<?php if($stat=='1'){ echo $ro3[3]; } ?></td>
<td style="width:250px; overflow:hidden; font-size:small;">&nbsp;<?php if($stat=='1'){ echo $ro3[1]; } ?></td>
<?php if($row[3]!='EUR08'){  ?>
<td align="center" valign="top"><b><u><?php  if(in_array($detro[7],$asst)){  }else{ echo $detro[7];$asst[]=$detro[7]; } ?></u></b></td>

<td style="width:200px; padding-left:30px;">&nbsp;<?php  echo $detro[2]." ".$detro[12]; ?></td>
<?php }else
{
?>
<td style="padding-left:30px;" valign="top"><?php  if(in_array($detro[7],$asst)){  $num=$num+1;
 echo $num.". ".$detro[2]." ".$detro[12]."<br>";
 }else{ 
$num=$num+1;
echo "<b><u>".$detro[7]."</u></b><br>".$num.". ".$detro[2]." ".$detro[12]."<br>";$asst[]=$detro[7]; } ?></td>
<?php
}
 ?>
<td>&nbsp;<?php echo $detro[3]." ".$detro[4]; ?></td><?php /*if($_SESSION['designation']<=8){ */ ?><td align="right">&nbsp;<?php if($_SESSION['designation']<=8){ echo $detro[5];}else{ echo $detro[8]; } ?></td><td align="right">&nbsp;
<?php 
if($_SESSION['designation']<=8){
$tot=$tot+($detro[5]*$detro[3]);
echo number_format(($detro[5]*$detro[3]),2);
}
else
{
$tot=$tot+($detro[8]*$detro[3]);
echo number_format(($detro[8]*$detro[3]),2);
}
 ?></td><?php //} ?>
 </tr>
<?php
}
}
?>
<?php if($_SESSION['designation']<=8){ ?><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;<b>Total Cost</b></td><td>&nbsp;</td><td>&nbsp;</td><?php if($row[3]!='EUR08'){  ?><td>&nbsp;</td><?php } ?><td align="right"><?php echo number_format($tot,2); ?></td></tr>
<?php if($row[20]>0){  ?><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;<b>Discount</b></td><?php if($row[3]!='EUR08'){  ?><td>&nbsp;</td><?php } ?><td>&nbsp;</td><td>&nbsp;</td><td align="right"><?php echo number_format($row[20],2); ?></td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;<b>Net Total</b></td><?php if($row[3]!='EUR08'){  ?><td>&nbsp;</td><?php } ?><td>&nbsp;</td><td>&nbsp;</td><td align="right"><b><?php echo number_format($row[8],2); ?></b></td></tr><?php } ?>
<?php }
else
{
if($tot>0){

?>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;<b>Total Cost</b></td><td>&nbsp;</td><td>&nbsp;</td><td align="right"><b><?php echo number_format($tot,2); ?></b></td></tr>
<?php
}
}
 ?>

</table></td></tr>
<tr><td colspan="2"><?php if($_SESSION['designation']<=8){ ?><b>[Rs:-<?php  $gtot=int_to_words(round($row[8])); echo $gtot." only"; ?>]</b><?php }else{ if($tot>0){   ?><b>[Rs:-<?php $gtot=int_to_words($row[21]); echo $gtot." only"; ?>]</b><?php  }} ?></td></tr>
<tr height="80px"><td colspan="2" valign="bottom" align="left">Thank You</td></tr>
<tr height="80px"><td colspan="2" valign="bottom" align="left"><?php if($row[3]!='EUR08') { ?> For Clear Secured Services Pvt. Ltd.<?php }else{ ?>CLEAN & CLEAR<?php } ?></td></tr>
</table></div><br>
