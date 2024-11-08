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
<title>All Mart</title>
<!-- favicon -->
<link rel="shortcut icon" href="image/favicon.ico">
<!-- Bootstrap Core CSS -->

<!-- Customizable CSS -->
<link rel="stylesheet" href="loginPopCss.css"  />
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/blue.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
<!-- Icons/Glyphs -->
<!--<link rel="stylesheet" href="css/font-awesome.css">-->
<!-- Fonts -->
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
            document.getElementById("Latitude").value=latitude
            document.getElementById("Longitude").value=longitude;
        }
        if(strr=="0")
        {
            showtoprigthslider();
        }
    }catch(ex)
    {

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
    global $con1;
    global $frstlev;
    $sql2 = "select * from main_cat where under ='".$catid."'";
    //echo $sql2;
    $result = $con1->query($sql2);
    while($row = mysqli_fetch_object($result)):
    $i = 0;
    if ($i == 0)?>
        <div class="col-xs-12 col-sm-6 col-md-3 col-menu">
        <!--  <h2 class="title">Men</h2>-->
        <?php
        $idc=$row->id;
        $chku=mysqli_query($con1,"select * from main_cat where id ='".$idc."' order by name asc");
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
        $chkqrnrprodcts=mysqli_query($con1,"select * from fashion where category ='".$idc."'");
        //echo "select * from fashion where category ='".$idc."'";
    }
    else if($Maincate==190){
        $chkqrnrprodcts=mysqli_query($con1,"select * from electronics where category ='".$idc."'");
    }
    else if($Maincate==218){
        $chkqrnrprodcts=mysqli_query($con1,"select * from grocery where category ='".$idc."'");
        //echo "select * from grocery where category ='".$idc."'";
    } else {
        $chkqrnrprodcts=mysqli_query($con1,"select * from products where category ='".$idc."'");
        //echo "select * from products where category ='".$idc."'";
    }
    $cprodexs=mysqli_num_rows($chkqrnrprodcts);
    //echo "gdgdfg".$idc;

    $chkundrexs=mysqli_query($con1,"select * from main_cat where under ='".$idc."' order by name asc");
    $chkundrexsrws=mysqli_num_rows($chkundrexs);

    $chkqrnr=mysqli_query($con1,"select * from main_cat where id ='".$chkufr[2]."' ");
    $chkissubcat=mysqli_fetch_array($chkqrnr);
    echo mysqli_error($con1);
?>
<?php
if($chkissubcat[2]==0 or $chkundrexsrws>0)
{
?>
   <a href="product.php?mdi=<?php echo $idc;?>&st=1">    
    <font size='2' style="color:#212121;"><b><?php echo $row->name; $frstlev++;?></b></font>
    <img style="width:13px;height:13px;" src="image/iconrightarrow.png"/> 
    </a>
<?php
}else
{
?>
<a href="product.php?mdi=<?php echo $idc;?>&st=1">
  <!--<font size='2' style="margin-left:-15px;"> -->
  <font size='2' style="margin-left:-15%;"> 
    <?php
     // Ruchi : 12 aug 19 'echo $row->name;'
    if(strlen($row->name)>20){ ?>
         <span href="#" data-toggle="tooltip" title="<?php echo $row->name;?>"><?php   echo substr($row->name,0,15).'....';?></span>
    <?php  // echo substr($row->name,0,15).'....';
    } else {
        echo $row->name;
    }
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
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1"> 
  <!-- ============================================== TOP MENU ============================================== -->
  <!-- ============================================== TOP MENU : END ============================================== -->
  <div class="main-header" style="padding-bottom: 0px;">
    <div class="container" >
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 logo-holder" style="width: 372px;"> 
          <!-- ============================================================= LOGO ============================================================= -->
          <div class="logo row">
                <div class="col-md-1">
                  <a href="https://allmart.world">
		            <!--<img  src="image/shopping-cart.png" style="width:100px;height: 43px;" alt="logo"/> -->
		        </div>
                <div class="col-md-2">
                    <!-- <img src="image/merabazaar.png" style="width:200px;height: 63px;margin-top: -12px;margin-left:52px;" alt="logo"> --> 
                    <img src="image/Merabaz.png" style="width:100px;" alt="logo"> 
                  </a>
		      </div>
             <!--  <a href="https://sarmicrosystems.in/oc1">
		   <img  src="image/shopping_cart_PNG73.png" style="width:100px;height: 43px;margin-top: -12px;" alt="logo"/> 
		   <img src="image/merabazaar.png" style="width:200px;height: 63px;margin-top: -12px;" alt="logo"> </a>--> </div>
          <!-- /.logo --> 
          <!-- ============================================================= LOGO : END ============================================================= --> </div>
        <!-- /.logo-holder -->
        <div class="col-xs-12 col-sm-12 col-md-5 top-search-holder" style="width: 470px;top:2px;padding-right: 0px;"> 
          <!-- /.contact-row --> 
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area" style="width: 448px;">
            <form id="frmsrchsub" method="post" action="product_search.php">
              <div class="control-group" style="width: 456px;">
                <!--<ul class="categories-filter animate-dropdown">
                  <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                      <li class="menu-header">Computer</li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Clothing</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Electronics</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Shoes</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Watches</a></li>
                    </ul>
                  </li>
                </ul>-->
                <input type="hidden" name="latitude" id="latitude" readonly>
                <input type="hidden" name="longitude" id="longitude" readonly>
                <input type="text" name="srchtxt" id="srchtxt" value="<?php if(isset($_POST["srchtxt"])){ echo $_POST["srchtxt"]; } ?>" class="search-field" placeholder="Search for products, brands & more..." style="width: 401px;"/>
                <!--<a class="search-button" href="javascript:void(0);" onclick="fnnn();" style="height: 47px;padding-top: 12px;"></a>-->
                <a class="search-button" href="javascript:void(0);" onclick="fnnn();"></a> 
              </div>
            </form>
            <!--</form>-->
          </div>
          <!-- /.search-area --> 
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->
        <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row" id="cartshowid" style="left: 309px;width: 140px;margin-top: 9px;height: 62px;right: 0px;padding-right: 0px;">  
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
          <!-- /.dropdown-cart --> 
          <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> 
        </div>
          <!-- /.top-cart-row --> 
     <!-- </div>-->
    </div>
    <div id="topbar" >
    <div class="current-lang pull-right" style="margin-top: -58px;margin-right: 19px;margin-bottom: -35px;">
    <div class="btn-group box-language"> </div>
    <div class="btn-group box-setting">   
        <div class="btn-group dropdown " >
            <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown" style ="margin-right: 127px;padding-left: 0px;   padding-right: 0px;">
            <i class="fa fa-cog"></i>
              <span class="text-label hidden-xs hidden-sm hidden-md">Setting</span> 
              <i class="fa fa-angle-down"></i>            
            </button>
            <ul class="dropdown-menu">
              <?php if(isset($_SESSION['loginstats']) && !empty($_SESSION['loginstats'])!=""){?>
              <li><a class="" href="myaccount.php"><i class="fa fa-user"></i>My Account</a></li>
              <li><a class="wishlist" href="WishList.php"><i class="fa fa-list-alt"></i> <span id="wishlist-total">Wish List</span></a></li>
              <?php }else{ ?>
               <li><a class="" onclick="popup('1','myaccount')" style="cursor:pointer"><i class="fa fa-user"></i>My Account</a></li>
              <?php } ?>
              <li><a class="last" href="compare.php"><i class="fa fa-share"></i>Compare</a></li>
              <li><a class="last" href="cart.php"><i class="fa fa-share"></i>Cart</a></li>
              <li><a class="last" href="paymentProcess.php"><i class="fa fa-share"></i>Checkout</a></li>
              <?php if(isset($_SESSION['loginstats']) && $_SESSION['loginstats']!="") { ?>
              <li><a class="last" href="logout.php"><i class="fa fa-share"></i>Logout</a></li>
             <?php } ?>
            </ul>
        </div>
    </div>
    <div class="login pull-left ">
        <ol class="breadcrumb" style="padding-left: 0px;padding-right: 0px;">
            <li ><a href="working.php">How It Works</a></li>
            <li ><a  href="trackorder.php">Track Order </a></li>
            <li>
              <?php 
              
              if(isset($_SESSION['loginstats']) && !empty($_SESSION['loginstats'])){
              $slctqry=mysqli_query($con1,"SELECT Firstname FROM `Registration` WHERE id='".$_SESSION['gid']."'");
              $sltqryftch=mysqli_fetch_array($slctqry);
              if($sltqryftch[0]!=""){
              ?>
              <a  href=""><?php echo "Hi, ".$sltqryftch[0]; ?></a>
             </li>
              <?php }} ?>
         </ol>
    </div>
  </div>
  </div>
    <div>
      <!-- /.row --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.main-header --> 
  <!-- ============================================== NAVBAR ============================================== -->
  <div class="header-nav animate-dropdown">
    <!--<div class="container" style="margin-right: 0px;margin-left: 55px;width: 1341px;">-->
    <div class="container" style="margin-left: 3%;width: 98%;">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
               <li class="active dropdown yamm-fw"> <a href="index.php" style="padding-left: 15px;" class="dropdown-toggle">Home</a> </li>
                <?php
                    $sql23 = mysqli_query($con1,"select * from main_cat where under ='0' and name!='Resale' order by name"); 
                    while($result23 =mysqli_fetch_array($sql23))
                    {

                    ?>
                    <li class="dropdown yamm mega-menu"> <a href="https://sarmicrosystems.in/oc1" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown"><?php echo $result23[1];?></a>
                        <ul class="dropdown-menu container">
                            <li>
                                <!--<div class="yamm-content" style="min-height: 110px; max-height:350px;width:1300px;overflow: auto;" >-->
                                <div class="yamm-content" style="min-height: 110px; max-height:350px;overflow: auto;" >
                                    <?php  category_tree3($result23[0]); ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <!--<li class="active dropdown yamm-fw"> <a href="resale_index.php" class="dropdown-toggle">RESALE</a> </li>-->
                        <div class="login pull-right ">
                            <ol class="breadcrumb" style="padding-right: 34px;">
                                <li><a class="upper-class" style="color:#fff; " href="https://allmart.world/franchise/">Franchise Filter Login</a></li>
                             <?php if(!isset($_SESSION['loginstats']) && $_SESSION['loginstats']==""){?>
                                <li class="active dropdown yamm-fw">  <a href="user/index.php" style="color:#fff;" class="upper-class">Merchant Login /</a><a href="Sell.php" style="color:#fff;" class="upper-class"> Register</a></li>
                                <li> 
                                    <!-- <a href="login.php" style="color:#fff;">Login /</a>-->
                                    <a href="#" onclick="popup('1','')" style="color:#fff;" class="upper-class"> Customer Login /</a>
                                    <a href="Register.php" style="color:#fff;" class="upper-class">Customer Register</a> 
                                </li>
                                <?php } ?>
                                <!--<li>  <a href="Register.php">Register</a>  </li>-->
                            </ol>
                        </div>
                    </ul>
                    <!-- /.navbar-nav -->
                <div class="clearfix"></div>
            </div>
            <!-- /.nav-outer --> 
          </div>
          <!-- /.navbar-collapse --> 
        </div>
        <!-- /.nav-bg-class --> 
      </div>
      <!-- /.navbar-default --> 
    </div>
    <!-- /.container-class --> 
  </div>
  <!-- /.header-nav --> 
  <!-- ============================================== NAVBAR : END ============================================== --> 
</header>
<!-- ============================================================= FOOTER ============================================================= -->
<!-- ============================================================= FOOTER : END============================================================= --> 

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.js"></script> 
<script src="js/bootstrap-hover-dropdown.js"></script> 
<!-- Ruchi :  -->
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</body></html>