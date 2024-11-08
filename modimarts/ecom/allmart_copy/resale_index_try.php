<?php
session_start();
$regid= $_SESSION['gid'];
 $loginstats=$_SESSION['loginstats'];
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
   <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:600" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

  <style>
  
body {
font-family: 'Roboto', sans-serif;
}

h3{
    font-family: 'Roboto Condensed', sans-serif;
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
      width: 100%; /* Set width to 100% */
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
/* Zoom In #1 */
.hover01 figure img {
	-webkit-transform: scale(1);
	transform: scale(1);
	-webkit-transition: .1s ease-in-out;
	transition: .1s ease-in-out;
}
.hover01 figure:hover img {
	-webkit-transform: scale(1.1);
	transform: scale(1.04);
}

 .hover01 {
      background:white;
      color: #080808;
  }
  .hover01 column h3 {color: #fff; font-style: Roboto Condensed, sans-serif;}
  .hover01 p {font-style: Roboto Condensed, sans-serif;}
  
body {
  background: white;
  font-size: 62.5%;
}

.container {
  padding: 2em;
}

/* GENERAL BUTTON STYLING */
button,
button::after {
  -webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
  -o-transition: all 0.3s;
	transition: all 0.3s;
}

button {
  background: none;
  border: 3px solid red;
  border-radius: 5px;
  color: black;
  display: block;
  font-size: 1.6em;
  font-weight: bold;
  margin: 1em auto;
  padding: 0.3em 0.3em;
  position: relative;
  text-transform: uppercase;
}

button::before,
button::after {
  background: red;
  content: '';
  position: absolute;
  z-index: -1;
}

button:hover {
  color: red;
}
/* BUTTON 5 */
.btn-5 {
  overflow: hidden;
}

.btn-5::after {
  /*background-color: #f00;*/
  height: 100%;
  left: -35%;
  top: 0;
  transform: skew(50deg);
  transition-duration: 0.6s;
  transform-origin: top left;
  width: 0;
}

.btn-5:hover:after {
  height: 100%;
  width: 135%;
}  
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








<button style="position: absolute;right: 23px;color:red;top:72px;background-color: #2874f0;padding-right: 12px;border-right-width: 1px;width: 108px;height: 42px;" class="btn" ><a class="img" style="color:white" title="<?php echo 'Mobiles';?>" href="resale_ViewAll.php?pduct=485&Heading=Mobile">View All</a></button>

<h3  style="margin-left: 58px;margin-top: 14px;margin-bottom: 18px;">MOBILE</h3>

<!-- Container (TOUR Section) -->
<div class="hover01 column">
   

  <div class="container" style="height:280px;width:1307px;padding-top: 9px;font-family: 'Roboto Condensed', sans-serif;">
 
  <div class="row text-center">
<?php

$qryAllProd=mysqli_query($con1,"select category,code from Resale where 1=1");
 $id=0;
 while($gt=mysqli_fetch_array($qryAllProd)){
//================query for get category which under 0 =============
$qrya="select * from main_cat where id='".$gt[0]."'";
 $resulta=mysqli_query($con1,$qrya);
 $rowa = mysqli_fetch_row($resulta);
$aa=$rowa[2];

   
if($aa!=0){
    
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysqli_query($con1,$qrya1);
 $rowa1 = mysqli_fetch_row($resulta1);
    $Maincate= $rowa1[4];
   
} 
//==============================================================

if($Maincate==482)
{
  /*  and product_type='Mobile'*/
$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where category='".$gt[0]."'  and code='".$gt[1]."' and status='1'  and product_type='Mobile'  ");
//echo "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `products` where category='".$gt[0]."' and code='".$gt[1]."'  and product_type='Mobile'  ";
$Resale = mysqli_fetch_array($qrylatf);
$num=mysqli_num_rows($qrylatf);
if($num>=1){
$qryimg=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='".$Resale["code"]."' and category='".$Resale["category"]."' order by id asc limit 0,1");
$Resaleimg = mysqli_fetch_array($qryimg); 

         //echo $Resale[0];
         // echo $Resaleimg[0];
$id++;
//echo $id;
if($id<=6){
?>
  
     
         <div class="col-lg-2">
        <div class="thumbnail" >
            <figure><img class="hover13 column" src="<? echo $Resaleimg[0];?>" alt="Paris" style="width:180px; height:164px"></figure>
          <p><strong><?php echo $Resale["name"] ?></strong></p>
          <p><?php echo $Resale["price"]." RS." ?></p>
       
         
  <a  title="<?php echo $Resale['name'];?>"href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"><button class="btn-5"> BuyNow </button> </a> 

           </div>
     </div>




 
      
<?
}
}
}
}
?>
</div></div></div> 

<!--=====================================Mobile End======================================-->
<button style="position: absolute; right:23px;color:red;top:437px;background-color:#a50606;padding-right: 12px;border-right-width: 1px;width: 108px;height: 42px; "class="btn" ><a class="img" style="color:white" title="<?php echo 'Vehicles';?>" href="resale_ViewAll.php?pduct=518&Heading=Vehicles">View All</a></button>

<h3  style="margin-left: 58px;">VEHICLES</h3>
<!-- Container (TOUR Section) -->
<div class="hover01 column">
  <div class="container" style="height:280px;width:1307px;padding-top: 9px;font-family: 'Roboto Condensed', sans-serif;">
 <div class="row text-center">
<?php

$qryAllProd=mysqli_query($con1,"select category,code from Resale where 1=1");
 $id=0;
 while($gt=mysqli_fetch_array($qryAllProd)){
//================query for get category which under 0 =============
$qrya="select * from main_cat where id='".$gt[0]."'";
 $resulta=mysqli_query($con1,$qrya);
 $rowa = mysqli_fetch_row($resulta);
$aa=$rowa[2];

   
if($aa!=0){
    
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysqli_query($con1,$qrya1);
 $rowa1 = mysqli_fetch_row($resulta1);
    $Maincate= $rowa1[4];
   
} 
//==============================================================

if($Maincate==482)
{
  /*  and product_type='Mobile'*/
$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where category='".$gt[0]."' and code='".$gt[1]."' and status='1'  and (product_type='2 wheeler vehicle' or product_type='3 wheeler vehicle' or product_type='4 wheeler vehicle' or product_type='vehicles')  ");
//echo "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `products` where category='".$gt[0]."' and code='".$gt[1]."'  and product_type='Mobile'  ";
$Resale = mysqli_fetch_array($qrylatf);
$num=mysqli_num_rows($qrylatf);
if($num>=1){
$qryimg=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='".$Resale["code"]."' and category='".$Resale["category"]."' order by id asc limit 0,1");
$Resaleimg = mysqli_fetch_array($qryimg); 

         //echo $Resale[0];
         // echo $Resaleimg[0];
$id++;
//echo $id;
if($id<=6){
?>
  
     
      <div class="col-lg-2">
        <div class="thumbnail" >
          <figure><img src="<? echo $Resaleimg[0];?>" alt="Paris" style="width:180px; height:165px"></figure>
          <p><strong><?php echo $Resale["name"] ?></strong></p>
          <p><?php echo $Resale["price"]." RS." ?></p>
       <button class="btn" style="background-color:#a50606"> <a class="img" style="color:white"  title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"> BuyNow  </a> </button>
           </div>
      </div>


 
      
<?
}
}
}
}
?>
</div></div></div>













<!--================================= CAR =========================================-->







<!--================================= HOME furniture Start =========================================-->
<button style="position: absolute; right:23px;color:red;top:774px;background-color:#a50606;padding-right: 12px;border-right-width: 1px;width: 108px;height: 42px; "class="btn" ><a class="img" style="color:white" title="<?php echo 'Mobiles';?>" href="resale_ViewAll.php?pduct=503&Heading=Vehicles">View All</a></button>

<h3  style="margin-left: 58px;">HOME & FURNITURE</h3>
<!-- Container (TOUR Section) -->
<div class="hover01 column">
  <div class="container" style="height:280px;width:1307px;padding-top: 9px;font-family: 'Roboto Condensed', sans-serif;">
 <div class="row text-center">
<?php

$qryAllProd=mysqli_query($con1,"select category,code from Resale where 1=1");
 $id=0;
 while($gt=mysqli_fetch_array($qryAllProd)){
//================query for get category which under 0 =============
$qrya="select * from main_cat where id='".$gt[0]."'";
 $resulta=mysqli_query($con1,$qrya);
 $rowa = mysqli_fetch_row($resulta);
$aa=$rowa[2];

   
if($aa!=0){
    
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysqli_query($con1,$qrya1);
 $rowa1 = mysqli_fetch_row($resulta1);
    $Maincate= $rowa1[4];
   
} 
//==============================================================

if($Maincate==482)
{
  /*  and product_type='Mobile'*/
$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where category='".$gt[0]."' and code='".$gt[1]."' and status='1'  and product_type='Home and Furniture'  ");
//echo "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `products` where category='".$gt[0]."' and code='".$gt[1]."'  and product_type='Mobile'  ";
$Resale = mysqli_fetch_array($qrylatf);
$num=mysqli_num_rows($qrylatf);
if($num>=1){
$qryimg=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='".$Resale["code"]."' and category='".$Resale["category"]."' order by id asc limit 0,1");
$Resaleimg = mysqli_fetch_array($qryimg); 

         //echo $Resale[0];
         // echo $Resaleimg[0];
$id++;
//echo $id;
if($id<=6){
?>
  
     
      <div class="col-lg-2">
        <div class="thumbnail" >
          <figure><img src="<? echo $Resaleimg[0];?>" alt="Paris" style="width:180px; height:165px"></figure>
          <p><strong><?php echo $Resale["name"] ?></strong></p>
          <p><?php echo $Resale["price"]." RS." ?></p>
       <button class="btn" style="background-color:#a50606"> <a class="img" style="color:white"  title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"> BuyNow  </a> </button>
           </div>
      </div>


 
      
<?
}
}
}
}
?>
</div></div></div>





<!--================================= HOME furniture END =========================================-->









<!--================================= Appliances Start =========================================-->
<button style="position: absolute; right:23px;color:red;top:1109px;background-color:#a50606;padding-right: 12px;border-right-width: 1px;width: 108px;height: 42px; "class="btn" ><a class="img" style="color:white" title="<?php echo 'Mobiles';?>" href="resale_ViewAll.php?pduct=511&Heading=Appliances">View All</a></button>

<h3  style="margin-left: 58px;">Appliances</h3>
<!-- Container (TOUR Section) -->
<div class="hover01 column">
  <div class="container" style="height:280px;width:1307px;padding-top: 9px;font-family: 'Roboto Condensed', sans-serif;">
 <div class="row text-center">
<?php

$qryAllProd=mysqli_query($con1,"select category,code from Resale where 1=1");
 $id=0;
 while($gt=mysqli_fetch_array($qryAllProd)){
//================query for get category which under 0 =============
$qrya="select * from main_cat where id='".$gt[0]."'";
 $resulta=mysqli_query($con1,$qrya);
 $rowa = mysqli_fetch_row($resulta);
$aa=$rowa[2];

   
if($aa!=0){
    
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysqli_query($con1,$qrya1);
 $rowa1 = mysqli_fetch_row($resulta1);
    $Maincate= $rowa1[4];
   
} 
//==============================================================

if($Maincate==482)
{
  /*  and product_type='Mobile'*/
$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where category='".$gt[0]."' and code='".$gt[1]."' and status='1'  and product_type='Appliances'  ");
//echo "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `products` where category='".$gt[0]."' and code='".$gt[1]."'  and product_type='Mobile'  ";
$Resale = mysqli_fetch_array($qrylatf);
$num=mysqli_num_rows($qrylatf);
if($num>=1){
$qryimg=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='".$Resale["code"]."' and category='".$Resale["category"]."' order by id asc limit 0,1");
$Resaleimg = mysqli_fetch_array($qryimg); 

         //echo $Resale[0];
         // echo $Resaleimg[0];
$id++;
//echo $id;
if($id<=6){
?>
  
     
      <div class="col-lg-2">
        <div class="thumbnail" >
          <figure><img src="<? echo $Resaleimg[0];?>" alt="Paris" style="width:180px; height:165px"></figure>
          <p><strong><?php echo $Resale["name"] ?></strong></p>
          <p><?php echo $Resale["price"]." RS." ?></p>
       <button class="btn" style="background-color:#a50606"> <a class="img" style="color:white"  title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"> BuyNow  </a> </button>
           </div>
      </div>


 
      
<?
}
}
}
}
?>
</div></div></div>




<!--================================= Appliances END =========================================-->










<!--================================= Fashion Start =========================================-->
<button style="position: absolute; right:23px;color:red;top:1446px;background-color:#a50606;padding-right: 12px;border-right-width: 1px;width: 108px;height: 42px; "class="btn" ><a class="img" style="color:white" title="<?php echo 'Mobiles';?>" href="resale_ViewAll.php?pduct=488&Heading=Fashion">View All</a></button>


<h3  style="margin-left: 58px;">OTHORS</h3>
<!-- Container (TOUR Section) -->
<div class="hover01 column">
  <div class="container" style="height:280px;width:1307px;padding-top: 9px;font-family: 'Roboto Condensed', sans-serif;">
 <div class="row text-center">
<?php

$qryAllProd=mysqli_query($con1,"select category,code from Resale where 1=1");
 $id=0;
 while($gt=mysqli_fetch_array($qryAllProd)){
//================query for get category which under 0 =============
$qrya="select * from main_cat where id='".$gt[0]."'";
 $resulta=mysqli_query($con1,$qrya);
 $rowa = mysqli_fetch_row($resulta);
$aa=$rowa[2];

   
if($aa!=0){
    
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysqli_query($con1,$qrya1);
 $rowa1 = mysqli_fetch_row($resulta1);
    $Maincate= $rowa1[4];
   
} 
//==============================================================

if($Maincate==482)
{
  /*  and product_type='Mobile'*/
$qrylatf=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `Resale` where category='".$gt[0]."' and code='".$gt[1]."' and status='1'  and (product_type='Fashion' OR product_type='Mens' OR product_type='Womens')  ");
//echo "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `products` where category='".$gt[0]."' and code='".$gt[1]."'  and product_type='Mobile'  ";
$Resale = mysqli_fetch_array($qrylatf);
$num=mysqli_num_rows($qrylatf);
if($num>=1){
$qryimg=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='".$Resale["code"]."' and category='".$Resale["category"]."' order by id asc limit 0,1");
$Resaleimg = mysqli_fetch_array($qryimg); 

         //echo $Resale[0];
         // echo $Resaleimg[0];
$id++;
//echo $id;
if($id<=6){
?>
  
     
      <div class="col-lg-2">
        <div class="thumbnail" >
          <figure><img src="<? echo $Resaleimg[0];?>" alt="Paris" style="width:180px; height:165px"></figure>
          <p><strong><?php echo $Resale["name"] ?></strong></p>
          <p><?php echo $Resale["price"]." RS." ?></p>
       <button class="btn" style="background-color:#a50606"> <a class="img" style="color:white"  title="<?php echo $Resale['name'];?>" href="resale_Details.php?prid=<?php echo $Resale['code'];?>&catid=<?php echo $Resale['category'];?>"> BuyNow  </a> </button>
           </div>
      </div>


 
      
<?
}
}
}
}
?>
</div></div></div>



<!--================================= Fashion END =========================================-->


<!--
<h3  style="margin-left: 58px;">MOBILE</h3>

<div class="bg-1">
  <div class="container" style="height:335px;width:1307px;padding-top: 24px;">
 
    
    <div class="row text-center">
      <div class="col-lg-2">
        <div class="thumbnail">
          <img src="userfiles/0/img/2018/04/15227539060.png" alt="Paris" style="width:400px; height:185px">
          <p><strong>Paris</strong></p>
          <p>Fri. 27 November 2015</p>
          <button class="btn" id="myBtn">Contact Seller</button>
        </div>
      </div>
      <div class="col-lg-2">
        <div class="thumbnail">
          <img src="userfiles/0/img/2018/04/15229074380.jpeg" alt="New York" style="width:400px; height:185px">
          <p><strong>New York</strong></p>
          <p>Sat. 28 November 2015</p>
          <button class="btn" id="myBtn"> <a class="img" title="<?php echo $detsarr[$itr]['name'];?>" href="resale_Details.php?prid=<?php echo $detsarr[$itr]['code'];?>&catid=<?php echo $detsarr[$itr]['category'];?>"> View  </a> </button>
            
       
        </div>
      </div>
      <div class="col-lg-2">
        <div class="thumbnail">
          <img src="userfiles/434/img/2018/06/15287242893.jpg" alt="San Francisco" style="width:400px; height:185px">
          <p><strong>San Francisco</strong></p>
          <p>Sun. 29 November 2015</p>
          <button class="btn">Contact Seller</button>
        </div>
      </div>
        <div class="col-lg-2">
        <div class="thumbnail">
          <img src="userfiles/434/img/2018/06/15287242882.jpeg" alt="San Francisco" style="width:400px; height:185px">
          <p><strong>San Francisco</strong></p>
          <p>Sun. 29 November 2015</p>
          <button class="btn">Contact Seller</button>
        </div>
      </div>
              <div class="col-lg-2">
        <div class="thumbnail">
          <img src="userfiles/434/midsize/2018/06/15287242882.jpeg" alt="San Francisco" style="width:400px; height:185px">
          <p><strong>San Francisco</strong></p>
          <p>Sun. 29 November 2015</p>
          <button class="btn">Contact Seller</button>
        </div>
      </div>
       <div class="col-lg-2">
        <div class="thumbnail">
          <img src="userfiles/416/largeSize/2018/06/15282690490.jpg" alt="San Francisco" style="width:400px; height:185px">
          <p><strong>San Francisco</strong></p>
          <p>Sun. 29 November 2015</p>
          <button class="btn">Contact Seller</button>
        </div>
      </div>
         
      
    </div>
  </div>
</div>
 <button style="position: absolute; right: 0;color:red" class="btn">View All</button>


<h3 style="margin-left: 58px;">CAR</h3>

<div class="bg-1">
  <div class="container" style="height: 335px;width: 1307px;padding-top: 24px;">
 
    
    <div class="row text-center">
      <div class="col-lg-2">
        <div class="thumbnail">
          <img src="userfiles/0/img/2018/04/15227539060.png" alt="Paris" style="width:400px; height:185px">
          <p><strong>Paris</strong></p>
          <p>Fri. 27 November 2015</p>
          <button class="btn">Contact Seller</button>
        </div>
      </div>
      <div class="col-lg-2">
        <div class="thumbnail">
          <img src="userfiles/0/img/2018/04/15229074380.jpeg" alt="New York" style="width:400px; height:185px">
          <p><strong>New York</strong></p>
          <p>Sat. 28 November 2015</p>
          <button class="btn">Contact Seller</button>
        </div>
      </div>
      <div class="col-lg-2">
        <div class="thumbnail">
          <img src="userfiles/434/img/2018/06/15287242893.jpg" alt="San Francisco" style="width:400px; height:185px">
          <p><strong>San Francisco</strong></p>
          <p>Sun. 29 November 2015</p>
          <button class="btn">Contact Seller</button>
        </div>
      </div>
        <div class="col-lg-2">
        <div class="thumbnail">
          <img src="userfiles/434/img/2018/06/15287242882.jpeg" alt="San Francisco" style="width:400px; height:185px">
          <p><strong>San Francisco</strong></p>
          <p>Sun. 29 November 2015</p>
          <button class="btn">Contact Seller</button>
        </div>
      </div>
              <div class="col-lg-2">
        <div class="thumbnail">
          <img src="userfiles/434/midsize/2018/06/15287242882.jpeg" alt="San Francisco" style="width:400px; height:185px">
          <p><strong>San Francisco</strong></p>
          <p>Sun. 29 November 2015</p>
          <button class="btn">Contact Seller</button>
        </div>
      </div>
       <div class="col-lg-2">
        <div class="thumbnail">
          <img src="userfiles/416/largeSize/2018/06/15282690490.jpg" alt="San Francisco" style="width:400px; height:185px">
          <p><strong>San Francisco</strong></p>
          <p>Sun. 29 November 2015</p>
          <button class="btn">Contact Seller/button>
        </div>
      </div>
      
      
    </div>
  </div>
</div>
 <button style="position: absolute; right: 0;color:red" class="btn">View All</button>
-->







</body>
</html>
