<?php

include("config.php");
include("access.php");

$cust_ids = $_POST['cust']; 
// $cust_ids = implode(",", $cust_ids);

$cust_ids = json_encode($cust_ids);
$cust_ids = str_replace(array('[', ']', '"'), '', $cust_ids);
$cust_ids = explode(',', $cust_ids);
$cust_ids = "'" . implode("', '", $cust_ids) . "'";

// var_dump($branch); 
$qrs=mysqli_query($con,"select srno,username from login where designation='8' and serviceauth='2' and deptid='4' and cust IN ($cust_ids)) ");
// echo "select srno,username from login where designation='8' and serviceauth='2' and deptid='4' and cust IN ($cust_ids)"."<br>";
?>
<option value="-1">Select made by</option>
<?php

while($qrsrow=mysqli_fetch_array($qrs))
{

?>

<option value="<?php echo $qrsrow[0];?>"><?php echo $qrsrow[1];?></option>
<?php } 



$qrs2=mysqli_query($con,"select srno,username from login where designation='11' and serviceauth='3' and deptid='4' and srno in(select reqby from quotation1 where cust IN ($cust_ids)) ");

while($qrsrow2=mysqli_fetch_array($qrs2))
{

?>

<option value="<?php echo $qrsrow2[0];?>" ><?php echo $qrsrow2[1];?></option>
<?php } 


$qrs3=mysqli_query($con,"select srno,username from login where designation='22' and serviceauth='2' and deptid='6' and cust IN ($cust_ids)) ");

while($qrsrow3=mysqli_fetch_array($qrs3))
{



?>

<option value="<?php echo $qrsrow3[0];?>" ><?php echo $qrsrow3[1];?></option>
<?php } 

?>


