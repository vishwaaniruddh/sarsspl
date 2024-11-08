<?php
include "config.php";?>

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>Merabazaar</title>
 <link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
               	  <link href="catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />
                   
<!-- Bootstrap Core CSS -->

<!-- Customizable CSS -->

<link rel="stylesheet" href="loginPopCss.css"  />
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/blue.css">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="css/font-awesome.css">

<!-- Fonts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
  @media (max-width:600px) {
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
  

  </style>


<style>
     p.b {
    white-space: nowrap; 
    width: 179px; 
    margin-top:5px;
    margin-bottom:4px;
    overflow: hidden;
    text-overflow: ellipsis; 
    text-align:center;
   /* border: 1px solid #000000;*/
}
.btnreqmt{
    position: absolute;
    right: 23px;
    color:white;
    background-color: #2874f0;
    padding-right: 12px;
    border-right-width: 1px;
    width: 75px;
    border-radius:17px;
    outline:none !important;
    height: 33px;
}

 </style>

<style>
.btn {
   /* background-color: DodgerBlue;*/
  background-color: #0f6cb2;
    border: none;
    color: white;
    padding: 6px 10px;
    border-radius: 20px;
    outline:none !important;
    cursor: pointer;
    
}

/* Darker background on mouse-over */
.btn:hover {
    background-color: DodgerBlue;
}
</style>


</head>
<script>

//var position=null;
$(document).ready(function(){
    try
    {
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
        
    }else{ 
        alert('Geolocation is not supported by this browser.');
    }
    var strr='<?php echo $stsss;?>';
//0 is index page 1 is product page
//alert(strr);

/*if(strr=="0")
{
    showtoprigthslider();
}*/
}catch(ex)
{
    alert(ex);
}
});

function showLocation(position)
{

try
{
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
 
 document.getElementById("latitude").value=latitude;
 
 document.getElementById("longitude").value=longitude;
 
// alert(latitude+"---"+longitude);
var strr='<?php echo $stsss;?>';
//0 is index page 1 is product page
//alert(strr);

if(strr=="1")
{
    
    funcs('','');
}

if(strr=="2")//SELL.PHP
{
    
document.getElementById("Latitude").value=latitude;
 
 document.getElementById("Longitude").value=longitude;
 }

if(strr=="0")
{

 showtoprigthslider();
    
}
}catch(ex)
{
    alert(ex);
}    
    
}
</script>
   <script>
       
       function fnnn()
{
    
   var latitide= document.getElementById("latitude").value;
  var longitude= document.getElementById("longitude").value;
  
  
  document.getElementById("frmsrchsub").submit();
    
}
       
       </script>
              
<body class="cnt-home">
<?php 

$frstlev=0;
/*
 function category_tree3($catid){
//global $conn;

global $con3;
global $frstlev;
$sql2 = "select * from main_cat where under ='".$catid."'";
//echo $sql2;
$result = $con3->query($sql2);

while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0)?>
 <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                          <!--  <h2 class="title">Men</h2>-->
<?php
$idc=$row->id;

$chku=mysqli_query($con3,"select * from main_cat where id ='".$idc."' order by name asc");

 $chkufr=mysqli_fetch_array($chku);
$chkqrnrprodcts=mysqli_query($con3,"select * from products where category ='".$idc."'");
//echo "select * from products where category ='".$idc."'";
 $cprodexs=mysqli_num_rows($chkqrnrprodcts);
//echo "gdgdfg".$idc;

$chkundrexs=mysqli_query($con3,"select * from main_cat where under ='".$idc."' order by name asc");
 $chkundrexsrws=mysqli_num_rows($chkundrexs);

 $chkqrnr=mysqli_query($con3,"select * from main_cat where id ='".$chkufr[2]."' ");
 $chkissubcat=mysqli_fetch_array($chkqrnr);
echo mysqli_error($con3);
?>
<?php

if($chkissubcat[2]==0 or $chkundrexsrws>0)
    {
       ?>
<h2> <?php echo $row->name; $frstlev++;?><img style="width:15px;height:15px;" src="image/iconrightarrow.png"/> </h2>

<?php 
        
    }else
{
?>
<ul class="links">
 
<li name="<?php echo $chkufr[2];?>" > <a href="javascript:void(0);">
   
    <?php
    echo $row->name;
    ?>
</a>
<?php } ?>




<?php 
 
 category_tree($row->id);
  if($chkissubcat[2]==0 or $chkundrexsrws>0)
    {
    }else
    {
 echo '</li></ul>';
    }
 //echo $catids2;
  $frstlev=0;
$i++;
 if ($i > 0) echo '</div>';
endwhile;
}
          
    
  */
  
 function category_tree3($catid){
//global $conn;

global $con3;
global $frstlev;
$sql2 = "select * from main_cat where under ='".$catid."'";
//echo $sql2;
$result = $con3->query($sql2);

while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0)?>
 <div class="col-xs-12 col-sm-6 col-md-3 col-menu">
                          <!--  <h2 class="title">Men</h2>-->
<?php
$idc=$row->id;

$chku=mysqli_query($con3,"select * from main_cat where id ='".$idc."' order by name asc");

//echo "select * from main_cat where id ='".$idc."' order by name asc";

 $chkufr=mysqli_fetch_array($chku);
 
 
 

$aa=$chkufr[2];

   
if($aa!=0){
    
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysqli_query($con1,$qrya1);
 $rowa1 = mysqli_fetch_row($resulta1);
    $Maincate= $rowa1[4];
   
} 
 
 //echo $Maincate;
 if($Maincate==1){
$chkqrnrprodcts=mysqli_query($con3,"select * from fashion where category ='".$idc."'");
//echo "select * from fashion where category ='".$idc."'";
 }
 else if($Maincate==190){
$chkqrnrprodcts=mysqli_query($con3,"select * from electronics where category ='".$idc."'");

 }
else if($Maincate==218){
$chkqrnrprodcts=mysqli_query($con3,"select * from grocery where category ='".$idc."'");
//echo "select * from grocery where category ='".$idc."'";
 }
 else if($Maincate==482){
$chkqrnrprodcts=mysqli_query($con3,"select * from Resale where category ='".$idc."'");
//echo "select * from grocery where category ='".$idc."'";
 }
else {

$chkqrnrprodcts=mysqli_query($con3,"select * from products where category ='".$idc."'");
//echo "select * from products where category ='".$idc."'";

 }

 

 $cprodexs=mysqli_num_rows($chkqrnrprodcts);

//echo "gdgdfg".$idc;

$chkundrexs=mysqli_query($con3,"select * from main_cat where under ='".$idc."' order by name asc");
 $chkundrexsrws=mysqli_num_rows($chkundrexs);

 $chkqrnr=mysqli_query($con3,"select * from main_cat where id ='".$chkufr[2]."' ");
 $chkissubcat=mysqli_fetch_array($chkqrnr);
echo mysqli_error($con3);
?>
<?php

if($chkissubcat[2]==0 or $chkundrexsrws>0)
    {
       ?>
   <a href="product.php?mdi=<?php echo $idc;?>&st=1">    
 <font size='2' style="color:#212121;"><b><?php echo $row->name; $frstlev++;?></b></font><img style="width:13px;height:13px;" src="image/iconrightarrow.png"/> 
 </a>

<?php
}else
{
?>

<a href="product.php?mdi=<?php echo $idc;?>&st=1">
  <font size='2' style="margin-left:-15px;"> 
    <?php
    echo $row->name;
    ?>
    </font>
</a>
<?php } ?>

<?php 
 category_tree3($row->id);
 //echo $catids2;
  $frstlev=0;
$i++;
 if ($i > 0) echo '</div>';
endwhile;
}
    
    ?>
<!-- =========
===================================== HEADER ============================================== -->
<header class="header-style-1"> 
  
  <!-- ============================================== TOP MENU ============================================== -->
 
  <!-- ============================================== TOP MENU : END ============================================== -->
  <div class="main-header" style="padding-top: 0px;padding-bottom: 0px; ">
    <div class="container" style="width:1241px;height: 64px;" >
      <div class="row" >
        <div class="col-xs-12 col-sm-12 col-md-3 logo-holder" style="margin-top:0px"> 
          <!-- ============================================================= LOGO ============================================================= -->
        
           <div class="logo row">
              <div class="col-md-1">
                  <a href="https://sarmicrosystems.in/oc1">
		  <!--   <img  src="image/shopping-cart.png" style="width:100px;height: 43px;margin-top: 14px;" alt="logo"/> 
		  -->   </div>
              <div class="col-md-2">
              <!--    <img src="image/merabazaar.png" style="width:200px;height: 63px;margin-left:52px;" alt="logo">
              -->     <img src="image/Merabaz.png" style="width:200px;height: 63px;margin-top: -1px;" alt="logo"> 
                 
                  </a>
		      </div>
         </div>
        
        
        
        
        
        
        
         <!-- <div class="logo"> <a href="https://sarmicrosystems.in/oc1"> 
		  <img src="image/merabazaar.png" style="width:200px;height: 63px;" alt="logo"> </a> </div>-->
         
          
          
          
          
          
          
          
          
          
          <!-- ============================================================= LOGO : END ============================================================= --> </div>
        <!-- /.logo-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-5 top-search-holder" style="padding-right: 0px;width: 550px;padding-left: 87px;"> 
          <!-- /.contact-row --> 
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area">
            <form id="frmsrchsub" method="post" action="resale_productSearch.php">
              <div class="control-group">
                <input type="hidden" name="latitude" id="latitude" readonly>
                    <input type="hidden" name="longitude" id="longitude" readonly>
                    <input type="text" name="srchtxt" id="srchtxt" value="<?php echo $_POST["srchtxt"];?>" class="search-field" style="width: 407px;" placeholder="Search for products, brands & more..." />
                    <a class="search-button" href="javascript:void(0);" onclick="fnnn();"></a>  </div>
                </form>
            </form>
          </div>  
          <!-- /.search-area --> 
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row"  style="left:9px;"> 
        
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

        <div class="btn-group box-language" style="width:469px;top:3px;">
         <div class="login pull-right hidden-xs hidden-sm" style="margin-left: 14px;">
   <!-- <ol class="breadcrumb" style="background-color:#0f6cb2">
               <li>--><a href="index.php" class="" style="color:#fff;"> <button class="btn" style="border-radius: 57px;width: 112px;font-size: 16px;"><i class="fa fa-home"> </i>Home </button> </a><!--  </li>
            </ol>-->
        </div>
        <div id="topbar" >
  <div class="current-lang pull-right" style="margin-top: -58px;margin-right: 99px;margin-bottom: -35px;">
    <div class="btn-group box-language">
            </div>
    <div class="btn-group box-setting" style="top: 25px;right: 69px;">   
        <div class="btn-group dropdown " >
             
            <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown" style ="margin-right: 0px;padding-left: 0px;padding-right: 0px;width: 99px;margin-top: -11px;border-right-width: 16px;">
            <i class="fa fa-cog"></i>
              <span class="text-label hidden-xs hidden-sm hidden-md">Setting</span> 
              <i class="fa fa-angle-down"></i>                  
              
              
            </button>
            <ul class="dropdown-menu">
              
              <?php if(isset($_SESSION['loginstats']) && $_SESSION['loginstats']!=""){?>
              <li><a class="" href="#"><i class="fa fa-user"></i>My Account</a></li>
              <li><a class="wishlist" href="resale_AddProduct.php"><i class="fa fa-list-alt"></i> <span id="AddProduct">AddProduct</span></a></li>
              <?php }else{ ?>
               <li><a class="" onclick="popup('1')"><i class="fa fa-user"></i>My Account</a></li>
              <?php } ?>
              
              <?php if(isset($_SESSION['loginstats']) && $_SESSION['loginstats']!=""){?>
              <li><a class="last" href="logout.php"><i class="fa fa-share"></i>Logout</a></li>
             <?php } ?>
              
            </ul>
            
            
            
        </div>
        
        <?php 
                      if( isset($_SESSION['loginstats']) && $_SESSION['loginstats']!=""){
                      $slctqry=mysqli_query($con1,"SELECT Firstname FROM `Registration` WHERE id='".$_SESSION['gids']."'");
                      $sltqryftch=mysqli_fetch_array($slctqry);
                      
                      if($sltqryftch[0]!=""){
                      ?>
                      
                      <a  href="" style="margin-right: 139px;margin-top: 1px;padding-top: 1px;border-top-width: 0px;height: 0px;"><?php echo "Hi, ".$sltqryftch[0]; ?></a>
                      <?php }} ?>
    </div>
   
                     
                 
                 
  </div>
  </div> 
       
             <div class="login pull-right hidden-xs hidden-sm" >
            <?php if(!isset($_SESSION['loginstats']) && $_SESSION['loginstats']==""){?>
            <ol class="breadcrumb" style="background-color:#0f6cb2;height: 39px;border-radius: 34px;">
        
        <li> 
            <!-- <a href="login.php" style="color:#fff;">Login /</a>--> 
            <?php /* <a onclick="popup('1')" style="color:#fff;cursor: pointer;">Login /</a> <a href="resale_Register.php" style="color:#fff;">Register</a>*/?>
            <a onclick="popup('1')" style="color:#fff;cursor: pointer;">Login /</a> <a href="resale_registration.php" style="color:#fff;">Register</a>  </li>
            </li>
        
      
            </ol><?php } else{?>
            <ol class="breadcrumb" style="background-color:#0f6cb2;height: 39px;border-radius: 34px;">
            <li>  <a href="logout.php" style="color:#fff;"> <img src="images\shutdown.png" style="height: 21px;margin-right: 9px;"/>Logout</a>  </li>
            </ol>
            
          <?  } ?>
  </div>
            </div>
   
  
  </div>
  

      
      <!-- /.row --> 
      
    </div>
    <!-- /.container --> 
     
          
          <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
        <!-- /.top-cart-row --> 
      </div>
     
          
  <div class="current-lang pull-right" style="margin-top:-30px; margin-right:-11px; margin-bottom:-30px;">
    
  </div>
  <!-- /.main-header --> 
  
  <!-- ============================================== NAVBAR ============================================== -->
 <!-- <div class="header-nav animate-dropdown">
    <div class="container" style="margin-right: 0px;margin-left: 45px;width: 1273px;height: 43px;">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
               
               <li class="active dropdown yamm-fw"> <a href="index.php" class="dropdown-toggle">Home</a> </li>
                  
      
      
                           <li class="active dropdown yamm-fw"> <a href="resale_index.php" class="dropdown-toggle">RESALE</a> </li>
                          <div class="login pull-right hidden-xs hidden-sm" >
    <ol class="breadcrumb" style="background-color:#0f6cb2">
        
         <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?>
        <li>  <a href="login.php" style="color:#fff;">Login /</a> <a href="Register.php" style="color:#fff;">Register</a>  </li>
        <?php } ?>
  
      
            </ol>
  </div>
                          
 
              </ul>
             
              <div class="clearfix"></div>
            </div>
           
          </div>
         
          
        </div>
        
      </div>
     
    </div>
   
    
  </div>
 -->
  <!-- ============================================== NAVBAR : END ============================================== --> 
  
</header>
         
             
                    
                    

 
<!-- ============================================================= FOOTER ============================================================= -->

<!-- ============================================================= FOOTER : END============================================================= --> 

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.js"></script> 
<script src="js/bootstrap-hover-dropdown.js"></script> 




</body></html>