<?php
include("config.php");
$val=$_GET['val'];


$sql="Select Distinct(projectid) from ".$val."_sites  order by projectid ASC";

echo $sql;
$qry=mysqli_query($con,$sql);


?>
<!--<select id='proj' name='proj'>--><option value="">Select Project</option>
<?php
while($row=mysqli_fetch_array($qry))
{
if($row[0]!=''){
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
}
?><!--</select>-->