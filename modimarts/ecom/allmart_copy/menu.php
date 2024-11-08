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
<title>All mart</title>

<!-- Bootstrap Core CSS -->
<?php //echo $result23[1];?>
<!-- Customizable CSS -->
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/blue.css">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="css/font-awesome.css">
<!-- Fonts -->
</head>
<script>
//var position=null;
$(document).ready(function(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
    }else{ 
        alert('Geolocation is not supported by this browser.');
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
    //alert(latitude+"---"+longitude);
    var strr='<?php echo $stsss;?>';
    //alert(strr); 
    if(strr=="1")
    {
        funcs('','');
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
<!-- ================= HEADER ============== -->
<header class="header-style-1"> 
    <!-- ================ TOP MENU =============== -->
    <!-- ============= TOP MENU : END ============ -->
  <div class="main-header">
    <div class="container"> 
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
          <!-- ============ LOGO ===========-->
          <div class="logo"> <a href="http://www.themesground.com/flipmart-demo/HTML/home.html"> 
		  <img src="image/newlogo.png" alt="logo"> </a> </div>
          <!-- /.logo --> 
          <!-- ======== LOGO : END =========== --> </div>
        <!-- /.logo-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder"> 
          <!-- /.contact-row --> 
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area">
            <form id="frmsrchsub" method="post" action="product_search.php">
              <div class="control-group">
                <ul class="categories-filter animate-dropdown">
                  <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                      <li class="menu-header">Computer
                      </li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Clothing</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Electronics</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Shoes</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Watches</a></li>
                    </ul>
                  </li>
                </ul>
        <input type="hidden" name="latitude" id="latitude" readonly>
          <input type="hidden" name="longitude" id="longitude" readonly>
                <input type="text" name="srchtxt" id="srchtxt" value="<?php echo $_POST["srchtxt"];?>" class="search-field" placeholder="Search here..." />
                <a class="search-button" href="javascript:void(0);" onclick="fnnn();"></a> </div>
                </form>
            </form>
          </div>
          <!-- /.search-area --> 
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row"> 
          <!-- ================== SHOPPING CART DROPDOWN ================== -->

          <!-- /.dropdown-cart -->
          <!-- ================= SHOPPING CART DROPDOWN : END=========== --> 
          </div>
        <!-- /.top-cart-row --> 
      </div>
      <!-- /.row --> 
      
    </div>
    <!-- /.container --> 
    
  </div>
  <!-- /.main-header --> 
  
  <!-- ============================================== NAVBAR ============================================== -->
  <div class="header-nav animate-dropdown">
    <div class="container">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
                <li class="active dropdown yamm-fw"> <a href="http://www.themesground.com/flipmart-demo/HTML/home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Home</a> </li>
                <li class="dropdown yamm mega-menu"> <a href="http://www.themesground.com/flipmart-demo/HTML/home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Clothing</a>
                  <ul class="dropdown-menu container">
                    <li>
                      <div class="yamm-content ">
                        <div class="row">
                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <h2 class="title">Men</h2>
                            <ul class="links">
                              <li><a href="#">Dresses</a></li>
                              <li><a href="#">Shoes </a></li>
                              <li><a href="#">Jackets</a></li>
                              <li><a href="#">Sunglasses</a></li>
                              <li><a href="#">Sport Wear</a></li>
                              <li><a href="#">Blazers</a></li>
                              <li><a href="#">Shirts</a></li>
                            </ul>
                            <h2 class="title">Men</h2>
                            <ul class="links">
                              <li><a href="#">Dresses</a></li>
                             
                            </ul>
                          </div>
                          <!-- /.col -->
                          
                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <h2 class="title">Women</h2>
                            <ul class="links">
                              <li><a href="#">Handbags</a></li>
                              <li><a href="#">Jwellery</a></li>
                              <li><a href="#">Swimwear </a></li>
                              <li><a href="#">Tops</a></li>
                              <li><a href="#">Flats</a></li>
                              <li><a href="#">Shoes</a></li>
                              <li><a href="#">Winter Wear</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          
                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <h2 class="title">Boys</h2>
                            <ul class="links">
                              <li><a href="#">Toys &amp; Games</a></li>
                              <li><a href="#">Jeans</a></li>
                              <li><a href="#">Shirts</a></li>
                              <li><a href="#">Shoes</a></li>
                              <li><a href="#">School Bags</a></li>
                              <li><a href="#">Lunch Box</a></li>
                              <li><a href="#">Footwear</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          
                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <h2 class="title">Girls</h2>
                            <ul class="links">
                              <li><a href="#">Sandals </a></li>
                              <li><a href="#">Shorts</a></li>
                              <li><a href="#">Dresses</a></li>
                              <li><a href="#">Jwellery</a></li>
                              <li><a href="#">Bags</a></li>
                              <li><a href="#">Night Dress</a></li>
                              <li><a href="#">Swim Wear</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          
                          <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="Flipmart%20premium%20HTML5%20&amp;%20CSS3%20Template_files/top-menu-banner.jpg" alt=""> </div>
                          <!-- /.yamm-content --> 
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li class="dropdown mega-menu"> 
                <a href="http://www.themesground.com/flipmart-demo/HTML/category.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Electronics <span class="menu-label hot-menu hidden-xs">hot</span> </a>
                  <ul class="dropdown-menu container">
                    <li>
                      <div class="yamm-content">
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Laptops</h2>
                            <ul class="links">
                              <li><a href="#">Gaming</a></li>
                              <li><a href="#">Laptop Skins</a></li>
                              <li><a href="#">Apple</a></li>
                              <li><a href="#">Dell</a></li>
                              <li><a href="#">Lenovo</a></li>
                              <li><a href="#">Microsoft</a></li>
                              <li><a href="#">Asus</a></li>
                              <li><a href="#">Adapters</a></li>
                              <li><a href="#">Batteries</a></li>
                              <li><a href="#">Cooling Pads</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          
                          <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Desktops</h2>
                            <ul class="links">
                              <li><a href="#">Routers &amp; Modems</a></li>
                              <li><a href="#">CPUs, Processors</a></li>
                              <li><a href="#">PC Gaming Store</a></li>
                              <li><a href="#">Graphics Cards</a></li>
                              <li><a href="#">Components</a></li>
                              <li><a href="#">Webcam</a></li>
                              <li><a href="#">Memory (RAM)</a></li>
                              <li><a href="#">Motherboards</a></li>
                              <li><a href="#">Keyboards</a></li>
                              <li><a href="#">Headphones</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          
                          <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Cameras</h2>
                            <ul class="links">
                              <li><a href="#">Accessories</a></li>
                              <li><a href="#">Binoculars</a></li>
                              <li><a href="#">Telescopes</a></li>
                              <li><a href="#">Camcorders</a></li>
                              <li><a href="#">Digital</a></li>
                              <li><a href="#">Film Cameras</a></li>
                              <li><a href="#">Flashes</a></li>
                              <li><a href="#">Lenses</a></li>
                              <li><a href="#">Surveillance</a></li>
                              <li><a href="#">Tripods</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Mobile Phones</h2>
                            <ul class="links">
                              <li><a href="#">Apple</a></li>
                              <li><a href="#">Samsung</a></li>
                              <li><a href="#">Lenovo</a></li>
                              <li><a href="#">Motorola</a></li>
                              <li><a href="#">LeEco</a></li>
                              <li><a href="#">Asus</a></li>
                              <li><a href="#">Acer</a></li>
                              <li><a href="#">Accessories</a></li>
                              <li><a href="#">Headphones</a></li>
                              <li><a href="#">Memory Cards</a></li>
                            </ul>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-4 col-menu custom-banner"> <a href="#"><img alt="" src="Flipmart%20premium%20HTML5%20&amp;%20CSS3%20Template_files/banner-side.png"></a> </div>
                        </div>
                        <!-- /.row --> 
                      </div>
                      <!-- /.yamm-content --> </li>
                  </ul>
                </li>
                <li class="dropdown hidden-sm"> <a href="http://www.themesground.com/flipmart-demo/HTML/category.html">Health &amp; Beauty <span class="menu-label new-menu hidden-xs">new</span> </a> </li>
                <li class="dropdown hidden-sm"> <a href="http://www.themesground.com/flipmart-demo/HTML/category.html">Watches</a> </li>
                <li class="dropdown"> <a href="http://www.themesground.com/flipmart-demo/HTML/contact.html">Jewellery</a> </li>
                <li class="dropdown"> <a href="http://www.themesground.com/flipmart-demo/HTML/contact.html">Shoes</a> </li>
                <li class="dropdown"> <a href="http://www.themesground.com/flipmart-demo/HTML/contact.html">Kids &amp; Girls</a> </li>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Pages</a>
                  <ul class="dropdown-menu pages">
                    <li>
                      <div class="yamm-content">
                        <div class="row">
                          <div class="col-xs-12 col-menu">
                            <ul class="links">
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/home.html">Home</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/category.html">Category</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/detail.html">Detail</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/shopping-cart.html">Shopping Cart Summary</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/checkout.html">Checkout</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/blog.html">Blog</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/blog-details.html">Blog Detail</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/contact.html">Contact</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/sign-in.html">Sign In</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/my-wishlist.html">Wishlist</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/terms-conditions.html">Terms and Condition</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/track-orders.html">Track Orders</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/product-comparison.html">Product-Comparison</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/faq.html">FAQ</a></li>
                              <li><a href="http://www.themesground.com/flipmart-demo/HTML/404.html">404</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li class="dropdown  navbar-right special-menu" id="cartshowid"> <a href="#">Todays offer</a> </li>
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
         
             
                    
                    
                     
<!-- ============================================== HEADER : END ============================================== -->
            <!-- /.item -->
            
            
            <!-- /.item -->
            
            
            <!-- /.item -->
            
            
            <!-- /.item -->
            
            
            <!-- /.item --> 
         
 
<!-- ============================================================= FOOTER ============================================================= -->

<!-- ============================================================= FOOTER : END============================================================= --> 

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.js"></script> 
<script src="js/bootstrap-hover-dropdown.js"></script> 




</body></html>