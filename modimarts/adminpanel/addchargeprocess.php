<?php 
session_start();
include('config.php');
include('adminaccess.php');
$totalamt=$_POST['totalamt'];
$charge=$_POST['charge'];
$user_type=$_POST['user_type'];
$franchise_type=$_POST['franchise_type'];
$first_price=$_POST['first_price'];
$Product_type=$_POST['Product_type'];
$weight=$_POST['weight'];

if(isset($_POST['addcharge']))
{
	$addcharge=mysqli_query($con1,"INSERT INTO `courier_charge`(`total_amt`, `charge`,`user_type`,`franchise_type`,`first_price`,`Product_type`,`weight`) VALUES ($totalamt,$charge,$user_type,$franchise_type,$first_price,$Product_type,$weight)");
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
