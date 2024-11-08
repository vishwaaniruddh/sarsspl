<?php
session_start();
//echo $_SESSION['designation']." ".$_SESSION['custid'];
include("config.php");
  $sql=$_POST['qry'];
 $cid=$_POST['cid'];
	$table=mysqli_query($con,$sql);
	//echo $sql;
if(!$table)
echo mysqli_error();
$count=0;

 $result=mysqli_query($con,"select id from contacts where short_name='$cid'");
                $row=mysqli_fetch_row($result); 
                $uid=$row[0];
//echo "select * from address_book where ref_id='$uid'";
                $result=mysqli_query($con,"select * from address_book where ref_id='$uid'");
                $addrow=mysqli_fetch_row($result); 
                $result=mysqli_query($con,"select billname from billcompany where cust_id='$cid'");
                $brow=mysqli_fetch_row($result); 
			
$cl=mysqli_query($con,"select contact_first from contacts where type='c' and short_name='$cid'");
$clr=mysqli_fetch_row($cl);	
$result = mysqli_query($con,$sql);
if(!$result)
echo mysqli_error();
		$num=mysqli_num_rows($result); ?>
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
//include("");
?>
      <div id="annexure"><br><br><br><br><br><br><br> 
		<!--<b>Total Number Of Records:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $Num_Rows; ?></b>-->
<table width="921" height="53" align="center" cellpadding="0" cellspacing="0" border="0">
  <col width="151" />
  <col width="72" />
  <tr height="50"><td width="50%" valign="top"><?php echo "<b>".$addrow[3]."</b><br>";
if($addrow[18]!=''){
echo nl2br($addrow[18]);
}
else{
echo $addrow[5]."<br>".$addrow[6]."<br>".$addrow[7]."<br>".$addrow[8]."<br>".$addrow[11]; } ?></td><td width="50%" valign="top" align="center"> Date: <?php echo date("d-M-Y"); ?></td></tr>
<tr><td colspan="2" align="center"><br><b>Subject:- <?php echo $clr[0]; ?> Submitted Bills Receiving Copy.<br><br></b></td></tr>
  <tr><td colspan="2" align="left">
<table border="1" align="center"  id="tblebill" cellspacing="0" cellpadding="0" width="100%" style="font-size:13px;">
	<tr style="background:grey" align="center">
		<th>Sr No.</th>
		<th>EB Invoice Number</th>
		<th>EB Invoice Date</th>
		<th>EB Invoice Amount</th>
		<th>Service Invoice Number</th>
		<th>Service Invoice Date</th>
		<th>Service Invoice Amount</th>
		<th>Vendor Name</th>
		<th>Category (E-Bills/Site Imprest)</th>
		<th>Billing Month</th>
		<th>Project</th>
		
	</tr>
  
          
	
	<?php	
$cnt=0;
$totamt=0;
while($row = mysqli_fetch_array($result))
		{
		if($row[4]>0){
		$totamt1+=+$row[4];
		$totamt2+=$row[11];
			?>
	<tr>
		<td align="right"><?php echo $cnt+1; ?></td>
		<td align="center" width="20%"><?php echo $row[5]; ?></td>
		<td align="center" width="10%"><?php echo date('d-M-y',strtotime($row[8])); ?></td>
		<td align="right"><?php echo number_format($row[4],2); ?></td>
		<td align="center" width="20%"><?php echo $row[9]; ?></td>
		<td align="center" width="10%"><?php echo date('d-M-y',strtotime($row[8])); ?></td>
		<td align="right"><?php echo number_format($row[11],2); ?></td>
		<td align="center">CSS</td>
		<td align="center">E-Bill</td>
		<td align="center"  width="8%"><?php echo date('M-Y'); ?></td>
		<td align="center"><?php echo $row['projectid']; ?></td>
		<td align="center"><?php echo $row['bank']; ?></td>
	</tr>
		
		<?php
		$cnt=$cnt+1;
}
/*
if($row[11]>0){
$totamt=$totamt+$row[11];
?>
		 <tr>
		<td align="right"><?php echo $cnt+1; ?></td>
         <td align="center"><?php echo date('d-M-y',strtotime($row[8])); ?></td>
		 <td align="center"><?php echo $row[9]; ?></td>
    <td align="center"><?php if($row[2]!='-1'){ echo $row[2]; }else{ echo $row[7]; } ?></td>
    <td align="right"><?php echo number_format($row[11],2); ?></td>
    <td align="center">SC</td>
    
		</tr>
		
		<?php
$cnt=$cnt+1;
}*/
		}
	
?>
<tr style="background:">
	<td>&nbsp;</td>
	<td colspan="2">Total</td>
	<td align="right"><?php echo number_format($totamt1,2); ?></td>
	<td colspan="2">&nbsp;</td>
	<td align="right"><?php echo number_format($totamt2,2); ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</table></td></tr>
<tr height="150px"><td colspan="2"><div align="right" style="padding-right:40px"> <b>Receiver Signature</b></div></td></tr>
</table>



</div>
<form name="frm" method="post" action="<?php if($cid=='FSS04'){ echo "fsssoftcpy.php"; }elseif($cid=='Tata05'){ echo "tatasoftcpy1.php"; }elseif($cid=='PRIZM07'){ echo "prizmsoftcpy.php"; }elseif($cid=='AGS01'){ echo "agssoftcpy.php"; }else{ echo "epssoftcpy.php"; } ?>" target="_blank">
<input type="hidden" id="cid" name="cid" value="<?php echo $cid; ?>">
<input type="hidden" id="qr" name="qr" value="<?php echo $sql; ?>"><input type="submit" name="cmd" value="Get Soft Copy in EXCEL">
</form>
<a onClick="PrintDiv('annexure');" href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Copy</font></a>