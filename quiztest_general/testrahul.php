<?php
if (!isset($_SESSION)) session_start();
//echo getcwd();
?>

<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <title>Quiz2shine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    
    <?php include("includeinallpages.php");?>
    <script>
    function fn()
    {
        
        
        //$("#show").load("indexslider");
    }
    
    </script>
</head>

<body onload="">
    
    <div class="pre-loader">
        <div class="load-con">
            <img src="assets/img/freeze/logo.png" class="animated fadeInDown" alt="">
            <div class="spinner">
              <div class="bounce1"></div>
              <div class="bounce2"></div>
              <div class="bounce3"></div>
            </div>
        </div>
    </div>
   
    <header>
        
      <?php include('menu.php');?>  
      
      
      
        <div id="show">
            
            
        <?php include("indexslider.php");?>

</div>
    </header>


    <div class="wrapper">

        

      <section id="about">
            <div class="container">
                
                <div class="section-heading scrollpoint sp-effect3">
                    <h1>About Us</h1>
                    <div class="divider"></div>
                    <p>Oleose Beautiful App Landing Page</p>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="about-item scrollpoint sp-effect2">
                            <i class="fa fa-download fa-2x"></i>
                            <h3>Easy setup</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6" >
                        <div class="about-item scrollpoint sp-effect5">
                            <i class="fa fa-mobile fa-2x"></i>
                            <h3>On-the-go</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6" >
                        <div class="about-item scrollpoint sp-effect5">
                            <i class="fa fa-users fa-2x"></i>
                            <h3>Social connect</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6" >
                        <div class="about-item scrollpoint sp-effect1">
                            <i class="fa fa-sliders fa-2x"></i>
                            <h3>Dedicated support</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features">
            <div class="container">
                <div class="section-heading scrollpoint sp-effect3">
                    <h1>Features</h1>
                    <div class="divider"></div>
                    <p>Learn more about this feature packed App</p>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4 scrollpoint sp-effect1">
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-cogs fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">User Settings</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-envelope fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Messages Inbox</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-users fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Friends List</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-comments fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Live Chat Messages</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-calendar fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Calendar / Planner</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4" >
                        <img src="assets/img/freeze/iphone-freeze.png" class="img-responsive scrollpoint sp-effect5" alt="">
                    </div>
                    <div class="col-md-4 col-sm-4 scrollpoint sp-effect2">
                        <div class="media feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-map-marker fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">My Places</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-film fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Media Player™</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-compass fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Intuitive Statistics</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-picture-o fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Weather on-the-go</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media active feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-plus fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">And much more!</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="reviews">
            <div class="container">
                <div class="section-heading inverse scrollpoint sp-effect3">
                    <h1>Reviews</h1>
                    <div class="divider"></div>
                    <p>Read What's The People Are Saying About Us</p>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-push-1 scrollpoint sp-effect3">
                        <div class="review-filtering">
                            <div class="review">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="review-person">
                                            <img src="http://api.randomuser.me/portraits/women/94.jpg" alt="" class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="review-comment">
                                            <h3>“I love Oleose, I highly rfreezemmend it, Everyone Try It Now”</h3>
                                            <p>
                                                - Krin Fox
                                                <span>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star-o fa-lg"></i>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review rollitin">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="review-person">
                                            <img src="http://api.randomuser.me/portraits/men/70.jpg" alt="" class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="review-comment">
                                            <h3>“Oleaose Is The Best Stable, Fast App I Have Ever Experienced”</h3>
                                            <p>
                                                - Theodore Willis
                                                <span>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star-half-o fa-lg"></i>
                                                    <i class="fa fa-star-o fa-lg"></i>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review rollitin">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="review-person">
                                            <img src="http://api.randomuser.me/portraits/men/93.jpg" alt="" class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="review-comment">
                                            <h3>“Keep It Up Guys Your Work Rules, Cheers :)”</h3>
                                            <p>
                                                - Ricky Grant
                                                <span>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star-half-o fa-lg"></i>
                                                    <i class="fa fa-star-o fa-lg"></i>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="screens">
            <div class="container">

                <div class="section-heading scrollpoint sp-effect3">
                    <h1>Screens</h1>
                    <div class="divider"></div>
                    <p>See what’s included in the App</p>
                </div>

                <div class="filter scrollpoint sp-effect3">
                    <a href="javascript:void(0)" class="button js-filter-all active">All Screens</a>
                    <a href="javascript:void(0)" class="button js-filter-one">User Access</a>
                    <a href="javascript:void(0)" class="button js-filter-two">Social Network</a>
                    <a href="javascript:void(0)" class="button js-filter-three">Media Players</a>
                </div>
                <div class="slider filtering scrollpoint sp-effect5" >
                    <div class="one">
                        <img src="assets/img/freeze/screens/profile.jpg" alt="">
                        <h4>Profile Page</h4>
                    </div>
                    <div class="two">
                        <img src="assets/img/freeze/screens/menu.jpg" alt="">
                        <h4>Toggel Menu</h4>
                    </div>
                    <div class="three">
                        <img src="assets/img/freeze/screens/weather.jpg" alt="">
                        <h4>Weather Forcast</h4>
                    </div>
                    <div class="one">
                        <img src="assets/img/freeze/screens/signup.jpg" alt="">
                        <h4>Sign Up</h4>
                    </div>
                    <div class="one">
                        <img src="assets/img/freeze/screens/calendar.jpg" alt="">
                        <h4>Event Calendar</h4>
                    </div>
                    <div class="two">
                        <img src="assets/img/freeze/screens/options.jpg" alt="">
                        <h4>Some Options</h4>
                    </div>
                    <div class="three">
                        <img src="assets/img/freeze/screens/sales.jpg" alt="">
                        <h4>Sales Analysis</h4>
                    </div>
                </div>
            </div>
        </section>

        <section id="demo">
            <div class="container">
                <div class="section-heading scrollpoint sp-effect3">
                    <h1>Demo</h1>
                    <div class="divider"></div>
                    <p>Take a closer look in more detail</p>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 scrollpoint sp-effect2">
                        <div class="video-container" >
                            <iframe src="http://player.vimeo.com/video/70984663"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="getApp">
            <div class="container-fluid">
                <div class="section-heading inverse scrollpoint sp-effect3">
                    <h1>Get App</h1>
                    <div class="divider"></div>
                    <p>Choose your native platform and get started!</p>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="hanging-phone scrollpoint sp-effect2 hidden-xs">
                            <img src="assets/img/freeze/freeze-angled2.png" alt="">
                        </div>
                        <div class="platforms">
                            <a href="#" class="btn btn-primary inverse scrollpoint sp-effect1">
                                <i class="fa fa-android fa-3x pull-left"></i>
                                <span>Download for</span><br>
                                <b>Android</b>
                            </a>
                            
                                <a href="#" class="btn btn-primary inverse scrollpoint sp-effect2">
                                    <i class="fa fa-apple fa-3x pull-left"></i>
                                    <span>Download for</span><br>
                                    <b>Apple IOS</b>
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="support" class="doublediagonal">
            <div class="container">
                <div class="section-heading scrollpoint sp-effect3">
                    <h1>Support</h1>
                    <div class="divider"></div>
                    <p>For more info and support, contact us!</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8 col-sm-8 scrollpoint sp-effect1">
                                <form role="form">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your email">
                                    </div>
                                    <div class="form-group">
                                        <textarea cols="30" rows="10" class="form-control" placeholder="Your message"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                </form>
                            </div>
                            <div class="col-md-4 col-sm-4 contact-details scrollpoint sp-effect2">
                                <div class="media">
                                    <a class="pull-left" href="#" >
                                        <i class="fa fa-map-marker fa-2x"></i>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">4, Some street, California, USA</h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a class="pull-left" href="#" >
                                        <i class="fa fa-envelope fa-2x"></i>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="mailto:support@oleose.com">support@oleose.com</a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a class="pull-left" href="#" >
                                        <i class="fa fa-phone fa-2x"></i>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">+1 234 567890</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        
 <?php include("footer.php");?>
       

    </div>
    
    
      
</body>

</html>
