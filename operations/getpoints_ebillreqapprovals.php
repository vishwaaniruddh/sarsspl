<ol>
<?php
	include("config.php");
	$desig=$_REQUEST['desig'];
    $service=$_REQUEST['service'];
    $dept=$_REQUEST['dept'];
    if($_REQUEST['pointof']=="approve")
		$type=1;
	else
		$type=0;
	$count=$_REQUEST['count'];
	//echo "SELECT id,reason FROM `rejection_reasons` WHERE `type` = '$type' AND `desig` = '$desig' AND `service_auth` = '$service' AND `dept` = '$dept' AND `status` = 1";
	$qry1=mysqli_query($con,"SELECT reason FROM `rejection_reasons` WHERE `type` = '$type' AND `desig` = '$desig' AND `service_auth` = '$service' AND `dept` = '$dept' AND `status` = 1");
	$row1=mysqli_fetch_array($qry1);
	$qry=mysqli_query($con,"SELECT * FROM `rejection_reasons_detail` WHERE `id` IN ($row1[0])");
	$i=0;
	while($row=mysqli_fetch_array($qry))
	{
?>
<li><input type="checkbox" name="reason[]" id="reason_<?php echo $count; ?>_<?php echo $i; ?>" value="<?php echo $row[0]; ?>" onchange="reasonCheck(this.id,<?php echo $count; ?>)"/><b><?php echo $row[1]; ?></b><br /></li>
<?php
		$i++;
	}
?>
</ol>
<input type="hidden" id="totreason_<?php echo $count; ?>" value="<?php echo $i; ?>"/>