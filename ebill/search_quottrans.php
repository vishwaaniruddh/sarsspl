<?php
 include("config.php");

 include("access.php");




?>

					
<table  border="3" align="center" cellspacing="10" cellpadding="10">

<th>Sr No</th>
<th>Cheque No</th>
 <th>Request Count</th>
 <th>Transferred Date</th>
<th>Amount</th>			
<th>View</th>
<th></th>
<th></th>
<th></th>
				
	

<?php
			$today = date('Y-m-d');	 
			$srno=0;

//echo "select sum(tamount),chqno,count(chqno) from quotation1ftransfers status!=0 and group by tid order by qid ASC";
				$sql=mysqli_query($con,"select sum(tamount),chqno,count(chqno),tid from quotation1ftransfers where status!=0 AND CAST(entrydt AS DATE)>='2023-01-01' AND CAST(entrydt AS DATE)<='".$today."' group by tid order by tid ASC");

 $tot="";
                               while($row=mysqli_fetch_array($sql))
				{
				$srno=$srno+1;
				
				$req=mysqli_query($con,"select pdate from quotation1ftransfers where chqno='".$row[1]."' and tid='".$row[3]."'  AND CAST(entrydt AS DATE)>='2023-01-01' AND CAST(entrydt AS DATE)<='".$today."'");
				$reqro=mysqli_fetch_row($req);
				?>
                                 <tr>
					<td><?php echo $srno; ?></td>
					<td><?php echo $row[1]; ?></td>
                                           <td><?php echo $row[2]; ?></td>
                                  <td><?php if($reqro[0]!='0000-00-00'){ echo date('d-m-Y',strtotime($reqro[0])); } ?></td>
                                     	<td><?php echo round($row[0]); $tot=$tot+round($row[0]); ?> </td>
				<td><?php if(mysqli_num_rows($req)>0){ ?><a href="viewquottransdet.php?id=<?php echo $row[3]; ?>" target="_blank"><input type='button' name="view" id="view" value="View Details" /></a><?php } ?></td>

<td>
<?php if($row[1]=="")
{
?>
<input type="button" name="edit" id="edit" value="Edit" onclick="window.open('cmsedit.php?tid=<?php echo $row[3]; ?>','_self');" />
<?php }?>
</td>


<td>
<a href="viewequotbtrans.php?transid=<?php echo $row[3]; ?>" target="_blank"><input type='button' name="view" id="view" value="View Bank Statement" />

</td>

<td>
<input type="button" name="excl" id="excl" value="Export to Excel" onclick="window.open('cmsexp.php?tid=<?php echo $row[3]; ?>','_blank');" />

</td>



                           <?php } ?>

	</tr>
<tr>
<td colspan="4" align="center">Total</td>
<td ><?php echo $tot; ?> </td> 
</tr>
</table>

