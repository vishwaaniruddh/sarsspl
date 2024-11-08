<?php
session_start();
if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{	
$id=$_SESSION['id'];
include "config.php"; 
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
  <title> Sold Products</title>
  <?php include('header.php'); ?>  
    <!-- Title & Sitemap -->
    <div class="title-sitemap grid-12">
        <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to User Panel</span></h1>
        <div class="sitemap grid-6">
            <ul>
              <!--<li><span>1click</span><i>/</i></li>-->
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
              <h3 class="widget-header-title"><strong>Sold Products</strong></h3>
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
              <td class="text-left">Product Name</td>
              <td class="text-right">No. of Products</td>
              <td class="text-left">Status</td>
              <td class="text-right">Total</td>
              <td class="text-left">Date Added</td>
              <td></td>
            </tr>
          </thead>
          <tbody style="background-color: white;"> 
<?php    
    $query = mysqli_query($con1,"SELECT r.Firstname,o.user_id,od.oid,od.date as order_date,od.status as order_status,od.qty as quantity,od.total_amt,pd.category,pm.product_model FROM Registration r join Orders o on r.id = o.user_id join order_details od on o.id = od.oid join Productviewtable pd on od.item_id = pd.code join product_model pm on pd.name = pm.id WHERE od.mrc_id ='".$_SESSION['id']."' and od.status=1");
    //echo "SELECT r.Firstname,o.user_id,od.oid,od.date as order_date,od.status as order_status,od.qty as quantity,od.total_amt,pd.category,pm.product_model FROM Registration r join orders o on r.id = o.user_id join order_details od on o.id = od.oid join Productviewtable pd on od.item_id = pd.code join product_model pm on pd.name = pm.id WHERE od.mrc_id ='".$_SESSION['id']."' and od.status=1";
    $cnt=1;
    while($rows = mysqli_fetch_array($query)){
        //var_dump($rows);exit;
        
        /*$query1 = mysqli_query($con1,"SELECT Firstname FROM Registration WHERE id ='".$rows[1]."'  ");
        $rows1 = mysqli_fetch_array($query1);*/
        /*$query2 = mysqli_query($con1,"SELECT qty FROM order_details WHERE oid ='".$rows[0]."'  ");
        $rows2 = mysqli_fetch_array($query2);*/
?>
            <tr >
              <td class="text-center" ><?php echo $cnt;?></td>
              <td class="text-center" ><?php echo $rows['Firstname'];?></td>
              <td class="text-center" ><?php echo $rows['product_model'];?></td>
              <td class="text-center" ><?php echo $rows['quantity'];?></td>
              <td class="text-center" ><?php echo $rows['order_status'];?></td>
              <td class="text-center"><?php echo $rows['total_amt'];?></td>
              <td class="text-center"><?php echo $rows['date'];?></td>
            
           </tr><?php $cnt++ ; }?>
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
          <li>Sold Products</li>
        </ul>
        <div class="copyright grid-12">
          Copyright © 2019 . All rights Reserved!
        </div>
    </footer>
    </div>
  </div>
 
  <!-- Go top -->
 
</body>
</html>
<?php
}else
{ 
 header("location: index.php");
}
?>