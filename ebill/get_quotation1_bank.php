<?php

include("config.php");
include("access.php");

$qrs=mysqli_query($con,"select distinct(bank) from quotation1 where cust='".$_POST['cust']."'");

?>
<option value="">Select bank</option>
<?php

while($qrsrow=mysqli_fetch_array($qrs))
{

?>

<option value="<?php echo $qrsrow[0];?>"><?php echo $qrsrow[1];?></option>
<?php } 

?>