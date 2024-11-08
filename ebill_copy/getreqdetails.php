<?php
	include("config.php");
	include("access.php");
	
	$reqid=$_POST['reqid'];
	//echo $reqid;
	
	$qrm=mysqli_query($con,"select * from ebillfundcancinv where reqid='".$reqid."'");
	$qrws=mysqli_num_rows($qrm);
	
	if($qrws>0)
	{
	
	$qry=mysqli_query($con,"select * from ebpayment where bill_no='".$reqid."'");
	$ncnt=mysqli_num_rows($qry);
	$row=mysqli_fetch_array($qry);
	
	
	if($ncnt>0)
	{
?>

<table>
<th>Request Id</th>
<th>Paid Amount</th>
<th>Paid Date</th>
<th>Update By</th>
<th></th>
<tr>
  <td> <input type="text" name="reid" id="reid" value="<?php echo $row[0]; ?>" readonly="readonly"/>  </td>
  <td> <?php echo $row[1]; ?> </td>
  <td> <?php echo $row[2]; ?></td>
  <td> <?php echo $row[5]; ?></td>
<td><input type="button" name="submit" id="submit" onclick="delfunc();" value="Unclub"/></td>

</tr>
</table>
<?php 
}

} ?>