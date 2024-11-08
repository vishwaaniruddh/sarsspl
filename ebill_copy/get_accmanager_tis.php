<?php

include("config.php");
include("access.php");

$qrs=mysqli_query($con,"select srno,username from login where designation='8' and serviceauth='2' and deptid='4' and custid like '"."%".$_POST['cust']."%"."'");

?>
<option value="-1">Select made by</option>
<?php

while($qrsrow=mysqli_fetch_array($qrs))
{

?>

<option value="<?php echo $qrsrow[0];?>"><?php echo $qrsrow[1];?></option>
<?php } 



$qrs2=mysqli_query($con,"select srno,username from login where designation='11' and serviceauth='3' and deptid='4' and srno in(select reqby from quotation1_tis where cust='".$_POST['cust']."') ");

while($qrsrow2=mysqli_fetch_array($qrs2))
{

?>

<option value="<?php echo $qrsrow2[0];?>" ><?php echo $qrsrow2[1];?></option>
<?php } 


$qrs3=mysqli_query($con,"select srno,username from login where designation='22' and serviceauth='2' and deptid='6' and custid like '"."%".$_POST['cust']."%"."'");

while($qrsrow3=mysqli_fetch_array($qrs3))
{



?>

<option value="<?php echo $qrsrow3[0];?>" ><?php echo $qrsrow3[1];?></option>
<?php } 





?>