<?php 
session_start();
include('config.php');
include('adminaccess.php');
$totalamt=$_POST['totalamt'];
$charge=$_POST['charge'];
$user_type=$_POST['user_type'];
$id=$_POST['id'];
$franchise_type=$_POST['franchise_type'];
$first_price=$_POST['first_price'];
$Product_type=$_POST['Product_type'];
$weight=$_POST['weight'];

if(isset($_POST['addcharge']))
{
	$addcharge=mysqli_query($con1,"UPDATE `courier_charge` SET `total_amt`='".$totalamt."',`charge`='".$charge."',`user_type`='".$user_type."',`franchise_type`='".$franchise_type."',`first_price`='".$first_price."',`Product_type`='".$Product_type."',`weight`='".$weight."' WHERE  id='".$id."'");
	if($addcharge)
	{
         ?>
       <script>
         window.location.href="SetcourierData.php?status=success";
       </script>
       <?php  
	}
	else
	{
       ?>
       <script>
         window.location.href="SetcourierData.php?status=failed";
       </script>
       <?php  
	}

}
 ?>
