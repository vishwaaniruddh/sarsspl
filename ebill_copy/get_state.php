<?php

include("config.php");
include("access.php");

$qrs=mysqli_query($con,"select * from quotation1statedet order by state ASC");

?>
<option value="">Select bank</option>
<?php
while($strws=mysqli_fetch_array($qrs))
{
?>
<option value='<?php echo $strws[1];?>'><?php echo $strws[1];?></option>
<?php } ?>

?>