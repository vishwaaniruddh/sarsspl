<?php 

include("config.php");
$hid=$_GET['hid'];
//echo $qid;

?>
<html>
<head>
<script src="excel.js" type="text/javascript"></script>
<script type="text/javascript">     

</script>
</head>
<body>


	



<center>

<?php 


   
 $qry1=mysqli_query($con,"select * from salary_edit_history where detail_id='".$hid."'"); 

?>
<div id="exptexcl" ><br><br><br><br><br><br><br><br><br>

<table><tr><td colspan="13" align="center"><?php echo $qrrow[1]; ?></td></tr></table>

<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 
<th width="10">Sr NO</th>
<th width="10">Earned Salary</th>
<th width="550">Cleaning Materials (Other Cust.)</th>
<th width="550">Cleaning Materials (NON Other Cust.)</th>
<th width="200">Disputed</th>
<th width="60">Advance Salary</th>
<th width="200">Uniform Recovery Amt.</th>
<th width="200">Customer Impose the Penalty Amt.</th>
<th width="200">WF</th>
<th width="200">Hold Salary</th>
<th width="200">Total Salary</th>
<th width="200">Update By</th>
<th width="200">Edit Date</th>
<th width="200">Remark</th>
<?php	
        $total=0;
     
   
//echo "select * from quotation1 where qid='".$qid."'";   


//print_r($rowh);
$srn=1;
while($hrow=mysqli_fetch_array($qry1))
{
//echo "select username from login where srno='".$qrrow[19]."' ";
$qrynm=mysqli_query($con,"select username from login where srno='".$hrow[19]."' ");
$qname=mysqli_fetch_array($qrynm);
?>

<tr>
 <td align="center"><?php echo $srn;?></td>
 <td align="center"><?php echo round($hrow[17]);?></td>
 <td align="center"><?php echo round($hrow[3]);?></td>
  <td align="center"><?php echo round($hrow[4]);?></td>
 <td align="center"  ><?php echo round($hrow[5]);?></td>
<td align="center"  ><?php echo round($hrow[6]);?></td>
 <td align="center"><?php echo round($hrow[7]);?></td>
 <td align="center"><?php echo round($hrow[8]);?></td>
 <td align="center"><?php echo round($hrow[9]);?></td>
 <td align="center"  ><?php echo round($hrow[10]);?></td>
 <td align="center"  ><?php echo round($hrow[11]);?></td>
 <td align="center"><?php echo $qname[0];?></td>
 <td align="center"><?php echo date('d/m/Y',strtotime($hrow[18]));?></td>
 <td align="center"><?php echo $hrow[20];?></td>

</tr>
<?php
$srn++;
}
?>

<tr>
<td colspan="14"></td>
</tr>
</table>

	<input type="button" id="exp" onclick="tableToExcel('exptexcl', 'Table Export Example')" value="Export To Excel"/>								
</div>
      
</center>
</body>
</head>
</html>