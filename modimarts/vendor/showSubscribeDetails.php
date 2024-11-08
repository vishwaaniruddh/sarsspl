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
  <title>Merchant-Welcome</title>
  </script>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}
</style>
  <script>
  function a(){
      <?php $Q="select tilldate from Subscription where mid='".$id."'";
                                    
                $ret = mysqli_query($con1,$Q);
                $rows = mysqli_fetch_array($ret);
                                
                $sdate=date("Y-m-d");
                $mont=$rows[0];
                                        
                $date1=date_create("$sdate");
                $date2=date_create("$mont");
                $diff=date_diff($date1,$date2);
                 $diffck= $diff->format("%R%a ");
                 
                $txt="";
                if($diffck==+2){$txt = "Subscription expire after two days"; }
                if($diffck==+1){$txt = "Subscription expire after one days";}

               if($txt!=""){
            ?>
            
                  alert("<?php echo $txt ?>");<?php }?>
  }
  
  </script>
  
  </head>
  <body onload="a();">
<?php
include('header.php');
?>        
        <!-- Title & Sitemap -->
        <div class="title-sitemap grid-12">
          <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to User Panel</span></h1>
         <!-- <div class="sitemap grid-6">
            <ul>
              <li><span>1click</span><i>/</i></li>
              <li><a href="index.php">User Panel</a></li>
            </ul>
          </div>-->
        </div>
      </header>
      <!-- Data -->
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div class="grid-12">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Subscription details</strong></h3>
            </header>
            <div class="widget-body">
             <div>
       
  
   <table align="center" >
  <tr>
    <th>Merchant Name</th>
    <th style="text-align:center">Email</th>
    <th>Package Subscription Month</th>
    <th style="width: 85px;">Expiry Date</th>
    <th>Price</th>
    <th>Status</th>
  </tr>
  
      <?php $Q1="select month,tilldate,amount,status from Subscription where mid='".$id."'";
                $ret1 = mysqli_query($con1,$Q1);
                 while($row1 = mysqli_fetch_array($ret1)){ 
     
      $Q="select name,email from clients where code='".$id."'";
                $ret = mysqli_query($con1,$Q);
               $row = mysqli_fetch_array($ret);
                 
           

      ?><tr>
    <td><?php echo $row[0];?></td>
    <td><?php echo $row[1];?></td>
    <td style="text-align:center"><?php echo $row1[0];?></td>
    <td><?php  echo $row1[1];?></td>
     <td><?php echo $row1[2];?></td>
    <td><?php echo $row1[3];?></td>
    <?php }?>
  </tr>
</table>
</div>
 
</div>
          </div>
        </div>
      </div>
    
        
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