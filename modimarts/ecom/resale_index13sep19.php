<?php
session_start();
$regid= $_SESSION['gids'];
 $loginstats=$_SESSION['loginstats'];
 //echo $regid.$loginstats;
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
 /*  @font-face { font-family: 'Roboto-Black'; src: url('Roboto-Black.ttf'); src: url('Roboto-Black.ttf') 
format('embedded-opentype'), url('Roboto-Black.ttf') format('woff'), url('Roboto-Black.ttf') format('truetype');
font-weight: normal; font-style: normal;}
body {
font-family: 'Roboto-Black', Arial, Helvetica, san-serif;
}
  
  .container {
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
      filter: grayscale(90%); /* make all photos black and white */ 
  /*    width: 100%; 
     margin: auto;
  }
  .carousel-caption h3 {
      color: #fff !important;
  }
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; /* Hide the carousel text when the screen is less than 600 pixels wide */
    }
  }
/*  .bg-1 {
      background:white;
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
<body >
<header id="header-layout" class="header-v2">
       <div id="header-main">
        <div class="">
            <div class="row">
            <?php include('resale_menu.php')?>
            </div>
        </div>
    </div>
</header>
<!-- Ruchi -->
<a href="resale_AddProduct.php"><button style="top:82px;width: 10% !important;right: 9%;" class="btnreqmt" >Upload Resale Product</button></a>
<a href="index.php"> <img src="image/back-button.png" class="btnreqmt" style="width: 80px;height: 33px;left: 1156px;top: 82px;"/></a>
<a class="img" style="color:white" title="<?php echo 'Mobiles';?>" href="resale_ViewAll.php?cat=1&Heading=Mobile">
    <button style="top:82px;" class="btnreqmt" >View All</button>
</a>

<h3  style="margin-left: 58px;margin-top: 7px;margin-bottom: 5px;heigth:24px">Mobile</h3>
<!-- Container (TOUR Section) -->
<!--<div class="bg-1">-->
<div class="hover01 column">
  <div class="container" style="height:280px;width:1307px;padding-top: 3px;">
  <div class="row text-center">
<?php
 /*  and product_type='Mobile'*/
$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where category='1' and status='1'  and product_type='MOBILE' ORDER BY code DESC ");
//echo "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `products` where category='".$gt[0]."' and code='".$gt[1]."'  and product_type='Mobile'  ";
$id=1;
$num=mysqli_num_rows($qrylatf);
if($num>=1){
while($Resale = mysqli_fetch_array($qrylatf)){
$qryimg=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='".$Resale["code"]."' and category='".$Resale["category"]."' order by id asc limit 0,1");
$Resaleimg = mysqli_fetch_array($qryimg); 
//echo $Resale[0];
// echo $Resaleimg[0];
$id++;
//echo $id;
if($id<=6){
?>
<div class="col-lg-2">
    <div class="thumbnail" style="margin-bottom:0px">
        <figure>         <a title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"> <img class="hover13 column" src="<? echo $Resaleimg[0];?>" alt="Paris" style="width:180px;height:164px"/></a></figure>
    <p class="b"><strong><?php echo $Resale["name"]; ?></strong></p>
        
          <p><i class="fa fa-inr "></i><?php echo $Resale["price"]; ?></p>
        <a class="img" style="color:white" title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"><button class="btn" style="background-color:#63bcf9"> BuyNow  </button> </a>
           </div>
     </div>
<?
}
}
}

?>
</div></div></div> 

<!--=====================================Mobile End======================================-->
<a class="img" style="color:white" title="<?php echo 'Vehicles';?>" href="resale_ViewAll.php?cat=2&Heading=Vehicles"><button style="top:382px;" class="btnreqmt">View All</button></a>

<h3  style="margin-left: 58px;margin-top: 5px;margin-bottom: 5px;height: 24px;">Vehicles</h3>
<!-- Container (TOUR Section) -->
<div class="hover01 column">
<!--<div class="bg-1">-->
    
  <div class="container" style="height:280px;width:1307px;padding-top: 3px;">
 <div class="row text-center">
<?php


  /*  and product_type='Mobile'*/
$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where category='2'  and status='1'  and  product_type='VEHICLES' ORDER BY code DESC ");
//echo "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `products` where category='".$gt[0]."' and code='".$gt[1]."'  and product_type='Mobile'  ";
$id3=1;
$num=mysqli_num_rows($qrylatf);
if($num>=1){
  while($Resale = mysqli_fetch_array($qrylatf)){
$qryimg=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='".$Resale["code"]."' and category='".$Resale["category"]."' order by id asc limit 0,1");
$Resaleimg = mysqli_fetch_array($qryimg); 

         //echo $Resale[0];
         // echo $Resaleimg[0];
$id3++;
//echo $id;
if($id3<=6){
?>
  
     
      <div class="col-lg-2">
        <div class="thumbnail" style="margin-bottom:0px" >
           <figure>
               <a  title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"> 
               <img class="hover13 column"  src="<? echo $Resaleimg[0];?>" alt="Paris" style="width:180px; height:165px">
               </a>   
           </figure>
          <p class="b"><strong><?php echo $Resale["name"] ?></strong></p>
          <p><i class="fa fa-inr "></i><?php echo $Resale["price"]; ?></p>
     <a class="img" style="color:white"  title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>">   <button class="btn" style="background-color:#63bcf9"> BuyNow </button></a> 
           </div>
      </div>


 
      
<?
}
}
    
}
?>
</div></div></div>

<!--================================= CAR =========================================-->

<!--================================= HOME furniture Start =========================================-->
<a class="img" style="color:white" title="<?php echo 'Mobiles';?>" href="resale_ViewAll.php?cat=3&Heading=Home & Furniture"><button style="top:696px;" class="btnreqmt"  >View All</button></a>

<h3  style="margin-left: 58px;margin-top: 5px;margin-bottom: 5px;height: 24px;">Home & Furniture</h3>
<!-- Container (TOUR Section) -->
<div class="hover01 column">
  <div class="container" style="height:280px;width:1307px;padding-top: 3px;">
 <div class="row text-center">
<?php


  /*  and product_type='Mobile'*/
/* Ruchi 
$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where category='3' and status='1'  and product_type='HOME & FURNITURE' ORDER BY code DESC ");
*/
$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where category='3' and status='1'  and product_type='Home & Furniture' ORDER BY code DESC ");
$num=mysqli_num_rows($qrylatf);
$id4=1;
if($num>=1){
    while($Resale = mysqli_fetch_array($qrylatf)){

$qryimg=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='".$Resale["code"]."' and category='".$Resale["category"]."' order by id asc limit 0,1");
$Resaleimg = mysqli_fetch_array($qryimg); 

         //echo $Resale[0];
         // echo $Resaleimg[0];
$id4++;
//echo $id;
if($id4<=6){
?>
      <div class="col-lg-2">
        <div class="thumbnail" style="margin-bottom:0px">
         <figure> 
          <a class="img" style="color:white"  title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>">
         <img class="hover13 column" src="<? echo $Resaleimg[0];?>" alt="Paris" style="width:180px; height:165px">
         </a>
         </figure>
          <p class="b"><strong><?php echo $Resale["name"]; ?></strong></p>
          <p ><i class="fa fa-inr "></i><?php echo $Resale["price"]; ?></p>
       <a class="img" style="color:white"  title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"> <button class="btn" style="background-color:#63bcf9"> BuyNow </button> </a> 
           </div>
      </div>
<?
}
}
}
?>
            </div>
        </div>
    </div>

<!--================================= HOME furniture END =========================================-->

<!--================================= Appliances Start =========================================-->
<a class="img" style="color:white" title="<?php echo 'Mobiles';?>" href="resale_ViewAll.php?cat=4&Heading=Appliances"><button style="top:1011px;" class="btnreqmt" >View All</button></a>

<h3  style="margin-left: 58px;margin-top: 5px;margin-bottom: 5px;height: 24px;">Appliances</h3>
<!-- Container (TOUR Section) -->
<div class="hover01 column">
  <div class="container" style="height:280px;width:1307px;padding-top: 3px;">
 <div class="row text-center">
<?php
  /*  and product_type='Mobile'*/
/* Ruchi : 
$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where category='4' and status='1'  and product_type='APPLIANCES' ORDER BY code DESC ");
*/
$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where category='4' and status='1'  ORDER BY code DESC ");
//echo "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `products` where category='".$gt[0]."' and code='".$gt[1]."'  and product_type='Mobile'  ";
$num=mysqli_num_rows($qrylatf);
$id5=1;
if($num>=1){
while($Resale = mysqli_fetch_array($qrylatf)){

$qryimg=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='".$Resale["code"]."' and category='".$Resale["category"]."' order by id asc limit 0,1");
$Resaleimg = mysqli_fetch_array($qryimg);

$id5++;
//echo $id;
if($id5<=6){
?>
  
     
      <div class="col-lg-2">
        <div class="thumbnail" style="margin-bottom:0px">
        <figure>
             <a class="img" style="color:white"  title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"> 
              <img  class="hover13 column" src="<? echo $Resaleimg[0];?>" alt="Paris" style="width:180px; height:165px">
             </a>
        </figure>
          <p class="b"><strong><?php echo $Resale["name"] ?></strong></p>
          <p><i class="fa fa-inr "></i><?php echo $Resale["price"]; ?></p>
       <a class="img" style="color:white"  title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"> <button class="btn" style="background-color:#63bcf9"> BuyNow </button> </a> 
           </div>
      </div>

      
<?
}
}
}

?>
</div></div></div>




<!--================================= Appliances END =========================================-->










<!--================================= Fashion Start =========================================-->
<a class="img" style="color:white" title="<?php echo 'Mobiles';?>" href="resale_ViewAll.php?pduct=5&Heading=Others"><button style="top:1325px;" class="btnreqmt" >View All</button></a>


<h3  style="margin-left: 58px;margin-top: 5px;margin-bottom: 5px;height: 24px;">Others</h3>
<!-- Container (TOUR Section) -->
<div class="hover01 column">
  <div class="container" style="height:280px;width:1307px;padding-top: 3px;">
 <div class="row text-center">
<?php

/* Ruchi
$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where  category='5' and status='1' and product_type='others' ORDER BY code DESC");
*/
$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where  category='5' and status='1' and product_type='Others' ORDER BY code DESC");
//echo  "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where  category='5' and status='1' and product_type='others' ORDER BY code DESC";
$num=mysqli_num_rows($qrylatf);
$id6=1;
if($num>=1){
while($Resale = mysqli_fetch_array($qrylatf)){

$qryimg=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='".$Resale["code"]."' and category='".$Resale["category"]."' order by id asc limit 0,1");
//echo "SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='".$Resale["code"]."' and category='".$Resale["category"]."' order by id asc limit 0,1";
$Resaleimg = mysqli_fetch_array($qryimg); 

         
$id6++;
//echo $id;
if($id6<=6){
?>
  
     
      <div class="col-lg-2">
        <div class="thumbnail" style="margin-bottom:0px">
          <figure>
               <a class="img" style="color:white"  title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"> 
               <img class="hover13 column" src="<? echo $Resaleimg[0];?>" alt="Paris" style="width:180px; height:165px">
               </a>
          </figure>
          <p class="b"><strong><?php echo $Resale["name"] ?></strong></p>
          <p><i class="fa fa-inr "></i><?php echo $Resale["price"]; ?></p>
            <a class="img" style="color:white"  title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>">  <button class="btn" style="background-color:#63bcf9"> BuyNow  </button></a> 
           </div>
      </div>


 
      
<?
}
}
}

?>
</div></div></div>


<footer id="footer" class="nostylingboxs">
 <?php include("resale_footer.php")?>
</footer>
 
 
<div id="powered">
  <?php include('footerbottom.php')?>

</div>

 


</body>

</html>

