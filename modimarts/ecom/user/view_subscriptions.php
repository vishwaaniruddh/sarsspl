<?php
session_start();
if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{	
$id=$_SESSION['id'];
include "config.php"; 
$qry =mysqli_query($con1,"SELECT s.id as sid,s.period,s.type,sd.rate,sd.discount FROM subscriptions s join  subscription_details sd on s.id=sd.subscription_id where sd.status!=2");
/* $result = mysqli_fetch_array($qry);*/
$num_rows = mysqli_num_rows($qry);

?>
<?php /*
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
    */?>
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
        <div class="grid-12">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Manage Subscriptions </strong></h3>
            </header>
            <div class="widget-body">
             <div>
                <div>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Sr no</th>
                          <th scope="col">Type</th>
                          <th scope="col">Period</th>
                          <th scope="col">Rate</th>
                          <th scope="col">Discount</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $cnt = 1;
                            while($row=mysqli_fetch_assoc($qry)) { 
                            /*var_dump($row);*/
                        ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $cnt ;?>
                                    <input type="hidden" name="id" value="<?php echo $row['sid'] ;?>" >
                                </th>
                                <td>
                                    <?php echo $row['type'] ;?>
                                </td>
                                <td>
                                    <?php echo $row['period'] ;?>
                                </td>
                                <td>
                                    <?php echo $row['rate'] ;?>
                                </td>
                                <td>
                                    <?php echo $row['discount'] ;?>
                                </td>
                                <td>
                                    <?php /*<?php if($row['status'] == 1){ ?>
                                        <input type="hidden" name="status" id="status" value="">
                                        <a href="add_subscription_process.php?id=<?php echo $row['sid'];?>&st=0" >
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                        </a> 
                                    <?php } else { ?>
                                    <input type="hidden" name="status" id="status" value="">
                                    <a href="add_subscription_process.php?id=<?php echo $row['sid'];?>&st=1" > 
                                        <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                                     </a> 
                                    <?php } ?> */ ?>
                                    <a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        <?php $cnt++; } ?>
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
          <li><a href="http://www.1clickguide.org">Home</a><span>/</span></li>
          <li><a href="http://www.1clickguide.org/contact.php">Contact</a><span>/</span></li>
        </ul>
        <div class="copyright grid-12">
          Copyright © 2012-2013 1clickguide.org. All rights Reserved!
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