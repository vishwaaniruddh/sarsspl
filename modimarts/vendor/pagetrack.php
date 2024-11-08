<?php
session_start();

 if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{ 
$id=$_SESSION['id'];
include "config.php"; 
$sql = mysqli_query($con1,"SELECT * FROM `clients` WHERE code ='$id'");
$row = mysqli_fetch_array($sql);
//echo $row[0];               
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
  <!-- Title -->
  <title>Welcome</title>
<?php
include('header.php');
?>        
        <!-- Title & Sitemap -->
        <div class="title-sitemap grid-12">
          <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to Merchant Panel</span></h1>
          <div class="sitemap grid-6">
            <ul>
              <li><span>1click</span><i>/</i></li>
              <li><a href="index.php">Merchant Panel</a></li>
            </ul>
          </div>
        </div>
      </header>
      <!-- Data -->
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div class="grid-12">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>WelCome To  Merchant Panel</strong></h3>
            </header>
            <div class="widget-body">
             <div>
       
  
    <table class="tables" align="center" cellpadding="4" cellspacing="0">
    <?php $pgtrakqry=mysqli_query($con1,"select * from page_track where cid='".$cid."' order by srno desc  LIMIT 0,10 "); 
        $numpg=mysqli_num_rows($pgtrakqry); $i=1;
        if($numpg>0){
    ?>
            <tbody><tr>
      <th>Sr no</th><th>TEMPLATE NAME</th><th>IP ADDRESS</th><th>BROWSER</th><th>TIMESTAMP</th></tr>
            <?php 
        while($pgtrak=mysqli_fetch_row($pgtrakqry)){?>
            <tr><td><?php echo $i; ?></td>
            <td><?php echo $pgtrak[2];  ?></td>
            <td><?php echo $pgtrak[3]; ?></td>
            <td><?php echo $pgtrak[6]; ?></td>
            <td><?php echo $pgtrak[4]; $i++;?></td></tr>
            
             <?php } //end while?></tbody><?php }
       else echo "No Page Views";
       ?>

                </table>

              </div>
 
</div>
          </div>
        </div>
      </div>
    
        
       
      <!-- Footer -->
      <footer class="footer grid-12" >
        <ul class="footer-sitemap grid-12" >
          <li><a href="http://www.1clickguide.org">Home</a><span>/</span></li>
          
          <li><a href="http://www.1clickguide.org/contact.php">Contact</a><span>/</span></li>
        </ul>
        <div class="copyright grid-12">
          Copyright © 2012-2013 1clickguide.org. All rights Reserved!
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