<?php
//session_start();
?>
<script src="excel.js" type="text/javascript"></script>
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


include("config.php");

$id = $_GET['invid'];
$yr= $_GET['yr'];


$sql=mysqli_query($con,"select * from send_bill_detail  where send_id='".$id."' ");

$sqlginv=mysqli_query($con,"select invoice2,date from send_bill  where send_id='".$id."' ");
$rwsinvno=mysqli_fetch_array($sqlginv);

//echo "select * from send_bill_detail  where send_id='".$id."' ";

?>
<br><br>
<div id="exptexcl">
<table align="center" border='1' cellspacin="20" id="custtable" name="custtable">
<th>Sr No</th>
<th>Bank</th>
<th>Atm</th>
<th>Site Name</th>
<th>Month</th>
<th>Service Charge Amount</th>
<th>Invoice No</th>
<th>Date</th>


<?php
$srn=1;
$svamtt=0;
while($rw=mysqli_fetch_array($sql))
{

$custarr=explode("_",$rw[2]);
//print_r($custarr);
//$cstnm=$custarr[0];
//echo $cstnm;
//echo "select atm_id1,bank,location from ".$custarr[0]."_sites  where trackerid='".$rw[2]."' ";
$sqlqr1=mysqli_query($con,"select atm_id1,bank,location from ".$custarr[0]."_sites  where trackerid='".$rw[2]."' ");
$srws=mysqli_fetch_array($sqlqr1);
//echo $rw[6];
$strdtmnth=date('M-Y', strtotime($rw[6]));
$endmnt=date('M-Y', strtotime($rw[7]));
//echo $strdtmnth;

?>
<tr>
<td align="center" ><?php echo $srn;?></td>
<td align="center" width="175"><?php echo $srws[1];?></td>
<td align="center" width="175"><?php echo $srws[0];?></td>
<td align="center" width="175"><?php echo $srws[2];?></td>
<td align="center" width="175"><?php echo $strdtmnth." to ".$endmnt;?></td>
<td align="center" width="175"><?php echo round($rw[15]); $svamtt=$svamtt+$rw[15];?></td>
<td align="center" width="175"><?php echo $rwsinvno[0]; ?></td>
<td align="center" width="175"><?php echo date('d-m-Y', strtotime($rwsinvno[1]));?> </td>


</tr>
<?php 
$srn++;
 } ?>
<tr><td colspan="5" align="right">Total</td><td align="center"><?php echo round($svamtt);?></td></tr>
</table>
</div>
<br><br>
<center>
<input type="button" name="GENERATE" id="GENERATE" value="PRINT PDF" onclick="PrintDiv('exptexcl');" />
<input type="button" id="exp" onclick="tableToExcel('exptexcl', 'Table Export Example')" value="Export To Excel"/>	

</center>							