<?php
session_start();
include ('config.php');
ini_set('display_errors', 1);


if(isset($_SESSION['id']))
{
      $usrid=$_SESSION['id'];
      $selcteddata = array_keys($_POST['product_ids']);
      $total_amount=0;
      for ($i=0; $i < count($selcteddata); $i++) { 
            $proiddata=explode('/',$selcteddata[$i]);
            $pid=trim($proiddata[0]);
           $price[]= $_POST['price'][$pid];
           $quntity[]= $_POST['quntity'][$pid];
           $total_amount+=$_POST['price'][$pid]*$_POST['quntity'][$pid];
      
      }

      if($total_amount<=5000){

      
      $product_id = implode(', ', array_keys($_POST['product_ids']));
      $prices = implode(', ', $price);
      $quntitys = implode(', ', $quntity);

      $todaydate=date("Y-m-d");

      $sql="INSERT INTO `franchise_product`( `franchise_id`, `product_ids`,`quantities`,`amounts`,`total_amount`, `date`) VALUES ('".$usrid."','$product_id','$quntitys','$prices','$total_amount','".$todaydate."')";
      $runsql=mysqli_query($con,$sql) or  die(mysqli_error($con));
      $IsSuccess = 1;
      $last_id = mysqli_insert_id($con);

if($runsql)
{      
      ?>
<script> 
      alert('Success');
      window.location.href = 'franchise_products.php';
      </script>
  <?php    
}
else
{
      ?>
      <script>
      alert('Total Amount Is greater Then 5000');
      // update member purchase product
      window.location.href = 'franchise_products.php';
      </script>
      <?php
      
}
 }
 else
 { ?>
<script>
  alert("error");
  window.location.href = "home.php";
</script>
 <?php
  }
}
else
{
      ?>
      <script>
      alert("Session Expired Please Login");
      window.open("home.php","_self");
      </script>
<?php


}


?>
