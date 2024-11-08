<?php session_start();


include('../config.php');
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title> Allmart </title>
	<!-- Favicon -->
	<!--<link rel="icon" type="image/png" href="images/favicon.png">-->
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  
	<!-- Bootstrap -->
	<link rel="stylesheet" href="../css/bootstrap.css">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="../css/magnific-popup.min.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="../css/font-awesome.css">
	<!-- Fancybox -->
	<link rel="stylesheet" href="../css/jquery.fancybox.min.css">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="../css/themify-icons.css">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="../css/niceselect.css">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="../css/animate.css">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="../css/flex-slider.min.css">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="../css/owl-carousel.css">
	<!-- Slicknav -->
    <link rel="stylesheet" href="../css/slicknav.min.css">
	
	<!-- Allmart StyleSheet -->
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/img-slide.css">
    
    <script src="../requiredfunctions.js"></script>
    
    <style >
		menu {
    width: 100%;
}
.menu-container {
  margin: 0 auto;
  background: #e9e9e9;
}
.menu a.logo {
    display: inline-block;
    padding: 1.5em 3em;
    width: 19%;
    float: left;
}
.menu img {
    max-width: 100%;
}
.menu-mobile {
  display: none;
  padding: 20px;
}
.menu-mobile:after {
  content: "\f394";
  font-family: "Ionicons";
  font-size: 2.5rem;
  padding: 0;
  float: right;
  position: relative;
  top: 50%;
  -webkit-transform: translateY(-25%);
          transform: translateY(-25%);
}
.menu-dropdown-icon:before {
  content: "\f489";
  font-family: "Ionicons";
  display: none;
  cursor: pointer;
  float: right;
  padding: 1.5em 2em;
  background: #fff;
  color: #333;
}
.menu > ul {
  margin: 0 auto;
  /*width: 80%;*/
  list-style: none;
  padding: 0;
  position: relative;
  /* IF .menu position=relative -> ul = container width, ELSE ul = 100% width */
  box-sizing: border-box;
      clear: right;
}
.menu > ul:before,
.menu > ul:after {
  content: "";
  display: table;
}
.menu > ul:after {
  clear: both;
}
.menu > ul > li {
  float: left;
  background: #e9e9e9;
  padding: 0;
  margin: 0;
}
.menu > ul > li a {
    text-decoration: none;
    padding: 1.5em 2em;
    display: block;
}
.menu > ul > li:hover {
  /*background: #f0f0f0;#de412e*/
  background: #de412e;
  
}
.menu > ul > li > ul {
  display: none;
  width: 100%;
  background: #f0f0f0;
  padding: 20px;
  position: absolute;
  z-index: 99;
  left: 0;
  margin: 0;
  list-style: none;
  box-sizing: border-box;
}
.menu > ul > li > ul:before,
.menu > ul > li > ul:after {
  content: "";
  display: table;
}
.menu > ul > li > ul:after {
  clear: both;
}
.menu > ul > li > ul > li {
  margin: 0;
  padding-bottom: 0;
  list-style: none;
  width: 25%;
  background: none;
  float: left;
}
.menu > ul > li > ul > li a {
  color: #777;
  padding: .2em 0;
  width: 95%;
  display: block;
  border-bottom: 1px solid #ccc;
}
.menu > ul > li > ul > li a:hover{
	/*color:#03a9f4;*/
	color : #de412e;
}
.menu > ul > li > ul > li > ul {
  display: block;
  padding: 0;
  margin: 10px 0 0;
  list-style: none;
  box-sizing: border-box;
}
.menu > ul > li > ul > li > ul:before,
.menu > ul > li > ul > li > ul:after {
  content: "";
  display: table;
}
.menu > ul > li > ul > li > ul:after {
  clear: both;
}
.menu > ul > li > ul > li > ul > li {
  float: left;
  width: 100%;
  padding: 10px 0;
  margin: 0;
  font-size: .8em;
}
.menu > ul > li > ul > li > ul > li a {
  border: 0;    
  font-size: 14px;
}
.menu > ul > li > ul.normal-sub {
  width: 300px;
  left: auto;
  padding: 10px 20px;
}
.menu > ul > li > ul.normal-sub > li {
  width: 100%;
}
.menu > ul > li > ul.normal-sub > li a {
  border: 0;
  padding: 1em 0;
}
/* ––––––––––––––––––––––––––––––––––––––––––––––––––
Mobile style's
–––––––––––––––––––––––––––––––––––––––––––––––––– */
@media only screen and (max-width: 959px) {
  .menu-container {
    width: 100%;
  }
  .menu-container .menu{
	display:inline-block;
   }
  .menu-mobile {
    display: block;    
    float: right;    
    padding: 20px 20px 0;
  }
  .menu-dropdown-icon:before {
    display: block;
  }
  .menu > ul {
    display: none;
    width:100%;
  }
  .menu > ul > li {
    width: 100%;
    float: none;
    display: block;
  }
  .menu > ul > li a {
    padding: 1.5em;
    width: 100%;
    display: block;
  }
  .menu > ul > li > ul {
    position: relative;    
    padding: 0 40px;
  }
  .menu > ul > li > ul.normal-sub {
    width: 100%;
  }
  .menu > ul > li > ul > li {
    float: none;
    width: 100%;
    margin-top: 20px;
  }
  .menu > ul > li > ul > li:first-child {
    margin: 0;
  }
  .menu > ul > li > ul > li > ul {
    position: relative;
  }
  .menu > ul > li > ul > li > ul > li {
    float: none;
  }
  .menu .show-on-mobile {
    display: block;
  }
}

</style> 
</head>
<body class="js">
	<!-- Preloader -->
	<!--<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>-->
	<!-- End Preloader -->
	
	<!-- Header -->
	

	<header class="header shop">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
								<!--<li><i class="ti-headphone-alt"></i> +060 (800) 801-582</li>
								<li><i class="ti-email"></i> support@shophub.com</li>-->
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-8 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content">
							<ul class="list-main">
								<li><i class="ti-location-pin"></i> Merchant Login</li>
								<li><i class="ti-alarm-clock"></i> <a href="#">Merchant Registration</a></li>
								<li><i class="ti-user"></i> <a href="#">My account</a></li>
								<li><i class="ti-power-off"></i><a href="#">Customer Registration</a></li>
								<li><i class="ti-power-off"></i><a href="#">Customer Login</a></li>
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="index.php"><img src="images/allmart.png" alt="logo" class="logo-image"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form class="search-form">
									<input type="text" placeholder="Search here..." name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-8 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								<select>
									<option selected="selected">All Category</option>
									<?php 
									$sql_category = mysqli_query($con1,"select * from main_cat where under =0 and id!=482");
									while($row = mysqli_fetch_assoc($sql_category)) { ?>
									    <option id="<?php echo $row['id'];?>" value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
									<?php } ?>
								</select>
								<form>
									<input name="search" placeholder="Search Products Here....." type="search">
									<button class="btnn"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
							
							<div id="cartshowid"></div>
							<div class="sinlge-bar">
								<a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar">
								<a href="https://allmart.world/allmart/account/my-account.php" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar shopping">
								<!--<a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count">2</span></a>
								
								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span>2 Items</span>
										<a href="#">View Cart</a>
									</div>
									<ul class="shopping-list">
										<li>
											<a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
											<a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
											<h4><a href="#">Woman Ring</a></h4>
											<p class="quantity">1x - <span class="amount">$99.00</span></p>
										</li>
										<li>
											<a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
											<a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
											<h4><a href="#">Woman Necklace</a></h4>
											<p class="quantity">1x - <span class="amount">$35.00</span></p>
										</li>
									</ul>
									<div class="bottom">
										<div class="total">
											<span>Total</span>
											<span class="total-amount">$134.00</span>
										</div>
										<a href="checkout.html" class="btn animate">Checkout</a>
									</div>
								</div>-->
								<!--/ End Shopping Item -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>