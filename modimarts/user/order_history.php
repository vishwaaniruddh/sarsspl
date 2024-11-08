<?php
session_start();
if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{	
$id=$_SESSION['id'];
include "config.php"; 
//$qry =mysql_query("SELECT s.id as sid,s.period,s.type,sd.rate,sd.discount,sb.sdate,sb.tilldate,sb.s_purchase_date FROM subscriptions s join  subscription_details sd on s.id=sd.subscription_id join Subscription sb on sd.subscription_id=sb.sid where sd.status!=2 and sb.mid=".$id);
$qry =mysqli_query($con1,"SELECT o.* ,mo.mid,mo.of_date,mo.tilldate,mo.of_purchase_date FROM merchant_offers o join  merchant_purchased_offers mo on o.id=mo.of_id  where o.status!=2 and mo.mid=".$id);

$num_rows = mysqli_num_rows($qry);
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="author" content="Acura">
    <meta name="description" content="Acura - A Real Admin Template">
    <meta name="keywords" content="Acura, Admin Template, Admin, Premium, ThemeForest, Clean, Modern, Responsive">
    <!-- Responsive viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Title -->
    <title>View My Orders</title>
    <?php include('header.php'); ?>
    <!-- Title & Sitemap -->
    <div class="title-sitemap grid-12">
        <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to User Panel</span></h1>
        <div class="sitemap grid-6">
            <ul>
              <li><a href="index.php">User Panel</a></li>
            </ul>
        </div>
    </div>
    <!-- Data -->
    <div class="data grid-12">
        <!-- Simple Chart -->
        <div class="grid-10">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Order History</strong></h3>
            </header>
            <div class="widget-body">
                <div>
                    <div>
                        <table class="table table-bordered table-hover" >
                            <thead style="background-color: #15527f;color: white;">
                                <tr>
                                    <!--id rate start_date end_date type period content content_file file_type city creation_date status mid of_date tilldate of_purchase_date-->
                                    <td class="text-right">Order ID</td>
                                    <td class="text-left">Customer</td>
                                    <td class="text-right">No. of Products</td>
                                    <td class="text-left">Status</td>
                                    <td class="text-right">Total</td>
                                    <td class="text-left">Date Added</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody style="background-color: white;"> 
                                <?php
                                    $query = mysqli_query($con1,"SELECT * FROM Order_ent WHERE mrc_id ='".$_SESSION['id']."' ");
                                    
                                    while($rows = mysqli_fetch_array($query)){
                                        
                                        $query1 = mysqli_query($con1,"SELECT name FROM clients WHERE code ='".$rows[14]."'  ");
                                        $rows1 = mysqli_fetch_array($query1);
                                        $query2 = mysqli_query($con1,"SELECT qty FROM order_details WHERE oid ='".$rows[0]."'  ");
                                        $rows2 = mysqli_fetch_array($query2);
                                        ?>
                                        <tr>
                                            <td class="text-center" ><?php echo $rows['id']; ?></td>
                                            <td class="text-center" ><?php echo $rows1[0];?></td>
                                            <td class="text-center" ><?php echo $rows2[0];?></td>
                                            <td class="text-center" ><?php echo $rows['status'];?></td>
                                            <td class="text-center"><?php echo $rows['amount'];?></td>
                                            <td class="text-center"><?php echo $rows['date'];?></td>
                                            <td class="text-center"><a href="order_details.php?id=<?php echo $rows[0];?>"><i class="fa fa-eye"></i></a></td>
                                       </tr>
                                <?php } ?>
                            </tbody>
                        </table> 
                        <script>
                            function confirm_delete(id)
                        	{
                        		document.location="deleteoffer.php?offid="+id;	
                        	}
                        </script>
                    </div>
                </div>
            </div>
           </div>
        </div>
    </div>
    <!-- Footer -->
    <!-- Footer -->
    <footer class="footer grid-12">
        <ul class="footer-sitemap grid-12">
          <li><a href="index.php">Home</a><span>/</span></li>
          <li>Order History</li>
        </ul>
        <div class="copyright grid-12">
          Copyright © 2020 . All rights Reserved!
        </div>
    </footer>
    </div>
  </div>
 
</body>
</html>
<?php
}else
{ 
    header("location: index.php");
}
?>