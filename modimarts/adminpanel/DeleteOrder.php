<?php 
session_start();
include('config.php');
include('adminaccess.php');


if (isset($_GET['orderid'])) {
	$orderid=$_GET['orderid'];
	$deletedate=date('Y-m-d H:i:s');

	$deleteorder=mysqli_query($con1,"UPDATE `Order_ent` SET `deleted_at`='".$deletedate."' WHERE id='".$orderid."'");

	if($deleteorder)
	{
		

		?>

<script>
    alert("Order Delete AND Save into Trash Successfully !");    
    // setTimeout(function(){
        window.location.href='/adminpanel/Order.php';        
    // }, 1500);
</script>

<?php

	}
	else
	{
		?>

<script>
    alert("Order Not Deleted !");    
    // setTimeout(function(){
        window.location.href='/adminpanel/Order.php';        
    // }, 1500);
</script>

<?php

	}
}
else
{
	?>

<script>
    alert("Order Not Deleted !");    
    // setTimeout(function(){
        window.location.href='/adminpanel/Order.php';        
    // }, 1500);
</script>

<?php

 }
 ?>
