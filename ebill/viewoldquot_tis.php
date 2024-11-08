<?php 

include("config.php");
$qid=$_GET['qid'];
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


   
 $qry1=mysqli_query($con,"select cust,quot_id from quotation1_tis where id='".$qid."'");
$qrrow=mysqli_fetch_array($qry1);   


//echo "select cust_name from ".$qrrow[0]."_sites where cust_id='".$qrrow[0]."' ";
$qrynm=mysqli_query($con,"select cust_name from .$qrrow[0]_sites where cust_id='".$qrrow[0]."' ");
$qname=mysqli_fetch_array($qrynm);

//$qryh=mysqli_query($con,"select * from quotation_edit_history where id='".$qid."'");
$str="select * from quotation_edit_history_tis where qid='".$qid."'";
$strqry=mysqli_query($con,$str);
//echo mysqli_error();



?>
<div id="exptexcl" ><br><br><br><br><br><br><br><br><br>

<table><tr><td colspan="13" align="center"><?php echo $qrrow[1]; ?></td></tr></table>




<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 
<th width="10">Sr NO</th>
<th width="550">Particulars</th>
<th width="550">Description</th>
<th width="200">Rate</th>
<th width="60">Qnt / Sqt</th>
<th width="200">Amount</th>
<th width="200">Quotation Amount</th>
<th width="200">Remark</th>
<th width="200">File</th>
<th width="200">Update By</th>
<th width="200">Date</th>
<?php	
        $total=0;
     
   
//echo "select * from quotation1 where qid='".$qid."'";   


//print_r($rowh);
$srn=1;
while($hrow=mysqli_fetch_array($strqry))
{
?>

<tr>
 <td align="center"><?php echo $srn;?></td>
 <td align="center"><?php echo $hrow[3];?></td>
 <td align="center"><?php echo $hrow[4];?></td>
  <td align="center"><?php echo $hrow[6];?></td>
 <td align="center"  ><?php echo $hrow[5];?></td>

 <td align="center"><?php echo round($hrow[7]);?></td>
 <td align="center"><?php echo round($hrow[8]);?></td>
 <td align="center"><?php echo $hrow[9];?></td>
 <td align="center"><?php if($hrow[10]==""){ echo "";}else
  {
 ?>
 <a href='../operations/quotuploads_tis/<?php echo $hrow[10]; ?>' download>Download</a>
 <?php
 }
 ?>
 </td>

 <?php
 $srqry=mysqli_query($con,"select username from login where srno='".$hrow[12]."'");
			$srno=mysqli_fetch_array($srqry);
                   ?>
 <td align="center"><?php echo $srno[0];?></td>
 <td align="center"><?php echo date('d/m/Y',strtotime($hrow[13]));?></td>

</tr>
<?php
$srn++;
}
?>

<tr>
<td colspan="12"></td>
</tr>
</table>

	<input type="button" id="exp" onclick="tableToExcel('exptexcl', 'Table Export Example')" value="Export To Excel"/>								
</div>
      
</center>
</body>
</head>
</html>