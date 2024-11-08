<?php
session_start();
include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Resale</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


  <style>
 /* .container {
      padding: 0px 0px;
  }
  .person {
      border: 10px solid transparent;
      margin-bottom: 25px;
      width: 80%;
      height: 80%;
      opacity: 0.7;
  }
  .person:hover {
      border-color: #f1f1f1;
  }
  .carousel-inner img {
      -webkit-filter: grayscale(90%);
      filter: grayscale(90%); 
      width: 100%;
      margin: auto;
  }
  .carousel-caption h3 {
      color: #fff !important;
  }
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  .bg-1 {
    

      color: #080808;
  }
  .bg-1 h3 {color: #fff;}
  .bg-1 p {font-style: italic;}*/
  </style>
  <script>

 
 
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
  </script>
 
  
</head>
<body style="background-color:white">
<header id="header-layout" class="header-v2">
       <div id="header-main">
        <div class="">
            <div class="row">
            <?php include('resale_menu.php')?>
            </div>
        </div>
    </div>
    
</header>

<div style="background-color:white;height:50px;">
<h3  style="margin-left: 58px;margin-top:0px;height: 50px;padding-top: 12px;"><?php echo $_GET['Heading'];?><input type="button" style="margin-left:1100px;font-size:17px" class="btnreqmt" value="Back" onclick="location.href='resale_index.php';">  </h3>
</div>
<br />
<!-- Container (TOUR Section) -->
<div class="hover01 column">
  <div class="container" style="width:1307px;margin-top:-21px;">
 <div class="row text-center">
<?php


$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where category='".$_GET['cat']."' and product_type ='".$_GET['Heading']."' ");
//echo "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where category='".$_GET['cat']."' and product_type ='".$_GET['Heading']."' ";
$num=mysqli_num_rows($qrylatf);
if($num>=1){
while($Resale = mysqli_fetch_array($qrylatf)){

$qryimg=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='".$Resale["code"]."' and category='".$Resale["category"]."' order by id asc limit 0,1");
//echo "SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='".$Resale["code"]."' and category='".$Resale["category"]."' order by id asc limit 0,1";
$Resaleimg = mysqli_fetch_array($qryimg); 

         //echo $Resale[0];
         // echo $Resaleimg[0];
$id++;
//echo $id;

?>
  
     
      <div class="col-lg-2">
        <div class="thumbnail" >
         <figure> 
         
          <a class="img" style="color:white"  title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"> 
          <img src="<? echo $Resaleimg[0];?>" class="hover13 column" alt="Paris" style="width:180px; height:164px"> 
          </a>
          </figure>
          <p class="b"><strong><?php echo $Resale["name"] ?></strong></p>
          <p><i class="fa fa-inr "></i><?php echo $Resale["price"]; ?></p>
          <a class="img" style="color:white" title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"> <button class="btn" style="background-color:#63bcf9"> BuyNow </button> </a> 
        </div>
      </div>


 
      
<?

}
}

?>
</div></div></div>

<!--=====================================Mobile======================================-->





<footer id="footer" class="nostylingboxs">
 
  

  <?php include("resale_footer.php")?>

</footer>
 
 
<div id="powered">
  <?php include('footerbottom.php')?>

</div>




</body>


</html>