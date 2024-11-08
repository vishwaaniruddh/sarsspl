<?php
include("config.php");
$val=$_GET['val'];
//echo "Select Distinct(project) from newtempsites where cust_id='".$val."' and active='0' ";
$qry=mysqli_query($con,"Select Distinct(project) from newtempsites where cust_id='".$val."' and active<'5' ");
?>
<!--<select id='bank' name='bank'>--><option value="">Select Project</option>
<?php
while($row=mysqli_fetch_array($qry))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
?><!--</select>-->