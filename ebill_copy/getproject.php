<?php
include("config.php");
$qry=mysqli_query($con,"Select distinct(projectid) from ".$_GET['cid']."_sites where projectid<>''");
?>
<option value="">Select Project</option>
<?php
while($row=mysqli_fetch_array($qry))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
?>
<option value="">All</option>