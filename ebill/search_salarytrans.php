<?php
 include("config.php");

$mnth=$_POST['mnth'];
$yr=$_POST['yr'];
$typ=$_POST['typ'];
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
				 
			$srno=0;

//echo "select sum(tamount),chqno,count(chqno) from quotation1ftransfers status!=0 and group by tid order by qid ASC";
	$sql=mysqli_query($con,"select sum(tamount),chq_no,tid,count(chq_no),pdate from salary_generate_details where  month='".$mnth."' and year='".$yr."' and type='".$typ."' group by tid order by tid ASC");

 $tot="";
                               while($row=mysqli_fetch_array($sql))
				{
				$srno=$srno+1;
				 $gdts=mysqli_query($con,"select pdate from salary_generate_details where tid='".$row[2]."'  ");  
                                 $gdtsrow=mysqli_fetch_array($gdts);

				?>
                                 <tr>
					<td><?php echo $srno; ?></td>
					 <td><?php echo $row[1]; ?></td>
                                         <td><?php echo $row[3]; ?></td>
                                  <td><?php if($gdtsrow[0]!='0000-00-00'){ echo date('d-m-Y',strtotime($gdtsrow[0])); } ?></td>
                                     	<td><?php echo round($row[0]); $tot=$tot+round($row[0]); ?> </td>

				<td><a href="viewsalarytransdet.php?id=<?php echo $row[2]; ?>" target="_blank"><input type='button' name="view" id="view" value="View Details" /></a></td>

<td>
<?php if($row[1]=="")
{
?>
<input type="button" name="edit" id="edit" value="Edit" onclick="window.open('salaryfedit.php?tid=<?php echo $row[2]; ?>&mnth=<?php echo $mnth; ?>&yr=<?php echo $yr; ?>&typ=<?php echo $typ; ?>','_self');" />
<?php }?>
</td>


<td>
<a href="salary_genpdf.php?tid=<?php echo $row[2]; ?>" target="_blank"><input type='button' name="view" id="view" value="View Bank Statement" />

</td>

<td>
<input type="button" name="excl" id="excl" value="Export to Excel" onclick="window.open('salaryexp.php?tid=<?php echo $row[2]; ?>','_blank');" />

</td>



                           <?php } ?>

	</tr>
<tr>
<td colspan="4" align="center">Total</td>
<td ><?php echo $tot; ?> </td> 
</tr>
</table>

