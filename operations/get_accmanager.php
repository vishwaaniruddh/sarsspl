<?php

include("config.php");
include("access.php");

$qrs=mysqli_query($con,"select srno,username from login where designation='8' and serviceauth='2' and deptid='4' and custid='".$_POST['cust']."'");

?>
<option value="-1">Select made by</option>
<?php

while($qrsrow=mysqli_fetch_array($qrs))
{

?>

<option value="<?php echo $qrsrow[0];?>"><?php echo $qrsrow[1];?></option>
<?php } ?>







?>