<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="keywords" content=""> -->
    <meta name="description" content="Allmart, your single destination for everything you need.">

    <title>Allmart</title>
    
    <!-- Loading Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Template CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="css/pe-icon-7-stroke.css">
    <link href="css/style-magnific-popup.css" rel="stylesheet">


    <!-- Awsome Fonts -->
    <link rel="stylesheet" href="css/all.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700&amp;display=swap" rel="stylesheet">

    <!-- Font Favicon -->
    <link rel="shortcut icon" href="https://allmart.world/assets/logo.png" type="image/png" />
    <style>
      button.register-submit {
    background: #0678b5;
    border: none;
    color: #fff;
    letter-spacing: 1px;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    font-weight: 700;
    width: 100%;
    max-width: 535px;
    padding: 16px 0;
    text-transform: uppercase;
    -webkit-border-radius: 3px 3px;
    -moz-border-radius: 3px 3px;
    border-radius: 3px 3px;
    transition: all .50s ease-in-out;
    -moz-transition: all .50s ease-in-out;
    -webkit-transition: all .50s ease-in-out;
}
    </style>
    
</head>

<body>

    <!--begin header -->
    <header class="header">

        <!--begin navbar-fixed-top -->
        <nav class="navbar navbar-expand-lg navbar-default navbar-fixed-top">
            
            <!--begin container -->
            <div class="container">

                    <!--begin logo -->
                    <a class="navbar-brand" href="https://www.allmart.world/"><img src="images/allmart.png" width="40%" alt=""></a>
                    <!--end logo -->

                    <!--begin navbar-toggler -->
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>
                    <!--end navbar-toggler -->

                    <!--begin navbar-collapse -->
                    <div class="navbar-collapse collapse" id="navbarCollapse" style="">
                        
                        <!--begin navbar-nav -->
                        <ul class="navbar-nav ml-auto">

                            <li><a href="#home">Home</a></li>

                            <li><a href="#about">About</a></li>

                            <li><a href="#testimonials">Testimonials</a></li>

                            <!--<li><a href="#portfolio">Work</a></li>-->

                            <li><a href="#team">Media Coverage</a></li>

                            <!--<li><a href="#features">Features</a></li>-->

                            <li><a href="#pricing">Pricing</a></li>

                            <li class="discover-link"><a href="https://wa.me/919892384666" class="discover-btn">Contact Now</a></li>

                        </ul>
                        <!--end navbar-nav -->

                    </div>
                    <!--end navbar-collapse -->

            </div>
            <!--end container -->
            
        </nav>
        <!--end navbar-fixed-top -->
        
    </header>
    <!--end header -->

    <!--begin home section -->
    <section class="home-section" id="home">

        <div class="home-section-overlay"></div>

        <!--begin container -->
        <div class="container">

            <!--begin row -->
            <div class="row">
              
                <!--begin col-md-6-->
                <div class="col-md-7 padding-top-60">

                    <h3>Register !
                        <br><span class="red">Create Your Profile to become Franchisee !</span>
                        <br>Get your Business</h3>

                    <p class="hero-text">Thousands Of Franchisee are looking for fresh Business !</p>

                    <!--begin popup-video-wrapper-->
                    <div class="popup-gallery-wrapper">
                        
                        <!--begin popup-video-->
                        <div class="popup-gallery hero-gallery">
                            
                            <a class="popup4 video-icon" href="https://www.youtube.com/watch?v=xNpQfcs8fa8">
                                <i class="fas fa-play"></i>
                            </a>

                        </div>
                        <!--end popup-video-->

                        <p class="popup-video-text">Watch Presentation Video</p>

                    </div>
                    <!--end popup-video-wrapper-->

                </div>
                <!--end col-md-6-->

                <!--begin col-md-5-->
                <div class="col-md-5  margin-top-20">

                    <!--begin register-form-wrapper-->
                    <div class="register-form-wrapper wow bounceIn" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: bounceIn;">

                        <h3 class="red">Inquire now to avail special offers  </h3>

                        <p>Start Your Profile to become Franchisee with Filling This Form</p>

                        <!--begin form-->
                        <div>
                             
                            <!--begin success message -->
                            <p class="register_success_box" style="display:none;">We received your message and you will hear from us soon. Thank You!</p>
                            <!--end success message -->
                            
                            <!--begin register form -->
                            <form id="register-form" class="register-form register" action="register-form.php" method="post">
                                
                    
                                <input class="register-input name-input white-input" required="" name="register_names"  placeholder="Full Name*" type="text">
                            
                                <input class="register-input name-email white-input" required="" name="register_email" placeholder="Email Address*" type="email">
                                 <input class="register-input name-number white-input" required="" name="register_number" placeholder="Number*" type="number">

                                <!-- <select class="register-input white-input" required="" name="register_ticket">

                                    <option value="">Select Category</option>

                                    <option value="Model">Model</option>
                                    <option value="Singer">Singer</option>
                                    <option value="Photographer">Photographer</option>
                                    <option value="Musician">Musician</option>
                                    <option value="Dancer">Dancer</option>
                                    <option value="Anchor">Anchor</option>
                                    <option value="StandUp Comedian">StandUp Comedian</option>
                                    <option value="Magician">Magician</option>
                                    <option value="MakeUp Artist /Stylist">MakeUp Artist /Stylist</option>
                                    <option value="">Unique Talent</option>
                                    <option value="Junior Talent (Below 14)">Kids (Junior Talent )Below 14 Yrs</option>
                                    <option value="">Baby Talent (below 5 yrs)</option>
                                   
                                   

                                </select> -->
                                <input class="register-input name-number white-input" required="" name="register_ticket" placeholder="Enter Pincode" list="pincode" type="number">
                                <datalist id="pincode">
                                    <?php 
                                    $pindata=mysqli_query($con1,"SELECT * FROM `new_pincode`");
                                    while ($sql_result = mysqli_fetch_assoc($pindata)) {
                                       ?>
                                  <option value="<?=$sql_result['pincode']?>">
                                  <?php } ?>
                                </datalist>
                               
                               <!--<input class="register-submit" name="send" type="submit" value="Let's Begin Your Journey">-->
                                <button class="register-submit" id="send" name="send" type="button">Let's Begin Your Journey</button>
                                    
                            </form>
                            <!--end register form -->

                            <p class="register-form-terms"><a href="https://www.allmart.world/privacy_policy.php">Privacy-Policy</a> &#8226; <a href="https://www.allmart.world/terms.php">Terms Conditions</a></p>
                            
                        </div>
                        <!--end form-->

                    </div>
                    <!--end register-form-wrapper-->

                </div>
                <!--end col-md-5-->

            </div>
            <!--end row -->

        </div>
        <!--end container -->

    </section>
    <!--end home section -->

    

    <!--begin section-grey -->
    
    <!--end section-grey -->

    <!--begin section-white -->
    <section class="section-white">
        
        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row align-items-center" id="about">
            
                <!--begin col-md-6-->
                <div class="col-md-6 wow slideInLeft" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: slideInLeft;">

                    <div class="margin-right-15">

                        <img src="https://www.talentdhundo.com/assets/gif/actor%20photography.gif" class="width-100 image-shadow bottom-margins-images" alt="pic">

                    </div>
                    
                </div>
                <!--end col-sm-6-->
                
                <!--begin col-md-6-->
                <div class="col-md-6">

                    <h3>About Allmart</h3>

                    <p>We Talent Dhundo are an online Platform where Artists register themselves ,create profiles and upload their Talent in their categories so that they are visible to Talent Hunters who are on constant search for raw Talent or Veteran talent which has not yet received its stardom ,We put them across platforms (TV industry /Cinemas/Realty Shows/Events /Public Functions/Shows /Brands basis your category and your talent for auditions followed by selections and assignments.</p>
                    
                  <!--   <ul class="benefits">
                        <li><i class="fas fa-check"></i> Quias netus magni netsum eos qui ratione sequi.</li>
                        <li><i class="fas fa-check"></i> Venis ratione sequi netus enim quia tempor magni.</li>
                        <li><i class="fas fa-check"></i> Enim ipsam netus voluptatem quia voluptas.</li>
                    </ul> -->

                    <a href="https://wa.me/02249245249?text=Hi%2C%20%20%0AI%20would%20like%20to%20apply%20for%20Urgent%20Artist%20Required%20Category.%0APlease%20contact%20me" class="btn-red small scrool">Let's Begin Your Journey</a>

                </div>
                <!--end col-md-6-->
            
            </div>
            <!--end row-->
    
        </div>
        <!--end container-->
    
    </section>
    <!--end section-white-->

    <!--begin section-grey -->
    <section class="section-grey">
        
        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row ">
            
              <!--begin col-md-12 -->
                <div class="col-md-12 text-center">

                    <h2 class="section-title">Urgent Artists Required (Bulletin)</h2>

                    
                </div>
                <!--end col-md-12 -->
                
                <!--begin team-item -->
                <div class="col-sm-12 col-md-4 margin-top-30">

                   
                   
                    <div style="text-align: left;" class="team-item">
                    
                       <ul>
<li><b>Category :</b>Punjabi Actor and actresses </li>
<li><b>Age : </b>18-28 </li>
<li><b>Work Type: </b>Crime Show </li>
<li><b>Location: </b>Mumbai</li>
 <a href="https://wa.me/02249245249?text=Hi%2C%20%20%0AI%20would%20like%20to%20apply%20for%20Urgent%20Artist%20Required%20Category.%0APlease%20contact%20me" class="btn-red1 small scrool">Apply Now</a>  
</ul>
                 
                    </div>

                </div>
                <!--end team-item -->

                 <!--begin team-item -->
                <div class="col-sm-12 col-md-4 margin-top-30">

                   
                   
                    <div style="text-align: left;" class="team-item">
                    
                <ul>
<li><b>Category :</b>Modeling for Ad campaigns</li>
<li><b>Age : </b>18-30</li>
<li><b>Work Type: </b>photo shoots</li>
<li><b>Location: </b>Delhi </li>
   <a href="https://wa.me/02249245249?text=Hi%2C%20%20%0AI%20would%20like%20to%20apply%20for%20Urgent%20Artist%20Required%20Category.%0APlease%20contact%20me" class="btn-red1 small scrool">Apply Now</a>      
</ul>
                    
           </div>

                </div>
                <!--end team-item -->


                 <!--begin team-item -->
                <div class="col-sm-12 col-md-4 margin-top-30">

                   
                   
                    <div style="text-align: left;" class="team-item">
                    
              <ul>
<li><b>Category :</b>  casting call ( male &amp; female )</li>
<li><b>Age : </b>25 - 55</li>
<li><b>Work Type: </b>Crime Show</li>
<li><b>Location: </b>Mumbai</li>
<a href="https://wa.me/02249245249?text=Hi%2C%20%20%0AI%20would%20like%20to%20apply%20for%20Urgent%20Artist%20Required%20Category.%0APlease%20contact%20me" class="btn-red1 small scrool">Apply Now</a> 
</ul>
                   
                    </div>

                </div>
                <!--end team-item -->
  <!--begin team-item -->
                <div class="col-sm-12 col-md-4 margin-top-30">

                   
                   
                    <div style="text-align: left;" class="team-item">
                    
             <ul>
<li><b>Category:</b>Male, Female Models Wanted for Modeling</li>
<li><b>Age : </b>16-30</li>
<li><b>Work Type: </b> photo shoots 
</li>
<li><b>Location: </b>Delhi</li>
<a href="https://wa.me/02249245249?text=Hi%2C%20%20%0AI%20would%20like%20to%20apply%20for%20Urgent%20Artist%20Required%20Category.%0APlease%20contact%20me" class="btn-red1 small scrool">Apply Now</a>
</ul>

                    
                    </div>

                </div>
                <!--end team-item -->
                 <!--begin team-item -->
                <div class="col-sm-12 col-md-4 margin-top-30">

                   
                   
                    <div style="text-align: left;" class="team-item">
                    
          <ul>
<li><b>Category:</b> Sasural Simar Season 2</li>
<li><b>Age : </b>16-40 ( Male &amp;, Female)</li>
<li><b>Work Type: </b>TV Serial ( supporting role, side role )</li>
<li><b>Location: </b>Mumbai</li>
<a href="https://wa.me/02249245249?text=Hi%2C%20%20%0AI%20would%20like%20to%20apply%20for%20Urgent%20Artist%20Required%20Category.%0APlease%20contact%20me" class="btn-red1 small scrool">Apply Now</a>
</ul>
                    
                    </div>

                </div>
                <!--end team-item -->

                 <!--begin team-item -->
                <div class="col-sm-12 col-md-4 margin-top-30">

                   
                   
                    <div style="text-align: left;" class="team-item">
                    
        <ul>
<li><b>Category:</b> Casting call serial. EK HI RISHTA (ZEE T..V)</li>
<li><b>Age : </b>19-25</li>
<li><b>Work Type: </b>TV serial</li>
<li><b>Location: </b>Mumbai</li>
<a href="https://wa.me/02249245249?text=Hi%2C%20%20%0AI%20would%20like%20to%20apply%20for%20Urgent%20Artist%20Required%20Category.%0APlease%20contact%20me" class="btn-red1 small scrool">Apply Now</a>
</ul>

                    
                    </div>

                </div>
                <!--end team-item -->
            </div>
            <!--end row-->
    
        </div>
        <!--end container-->
    
    </section>
    <!--end section-grey-->

    <!--begin section-bg-1 -->
    <section class="section-bg-1">
        
        <div class="section-bg-overlay"></div>

        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row">
            
                <!--begin col md 7 -->
                <div class="col-md-7 mx-auto margin-bottom-20 text-center">

                    <h2 class="white-text">Fun Facts About Our Agency</h2>

                </div>
                <!--end col md 7-->
            
            </div>
            <!--end row-->
    
            <!--begin row-->
            <div class="row">
        
                <!--begin fun-facts-box -->
                <div class="col-md-3 offset-md-2 fun-facts-box text-center">
                    
                    <i class="far fa-gem"></i>
                    
                    <p class="fun-facts-title"><span class="facts-numbers">1492+</span><br>Live Talent Hunters Searches</p>
                    
                </div>
                <!--end fun-facts-box -->

                <!--begin fun-facts-box -->
                <div class="col-md-3 fun-facts-box text-center">
                    
                    <i class="far fa-heart"></i>
                                               
                    <p class="fun-facts-title"><span class="facts-numbers">12982+</span><br>Talent Hunters Viewing Profiles</p>
                        
                </div>
                <!--end fun-facts-box -->

                <!--begin fun-facts-box -->
                <div class="col-md-3 fun-facts-box text-center">
                    
                    <i class="fas fa-award"></i>
                                               
                    <p class="fun-facts-title"><span class="facts-numbers">436+</span><br>Agreements Assigned</p>
                        
                </div>
                <!--end fun-facts-box -->

                <!--begin fun-facts-box -->
                
                <!--end fun-facts-box -->

            </div>
            <!--end row-->
    
        </div>
        <!--end container-->
    
    </section>
    <!--end section-bg-1 -->

    <!--begin testimonials section -->
    <section class="section-grey" id="testimonials">

        <!--begin container -->
        <div class="container">

            <!--begin row -->
            <div class="row align-items-center">

                <!--begin col-md-5 -->
                <div class="col-md-5 col-sm-12">

                    <h2>What People Are Saying.</h2>
 <p>We are a professional platform , we concentrate on Raw /Fresh talent , groom them , promote them so that they get a chance to showcase their talent .</p>
                    
                        <!--begin row-->
                        <div class="row">
                        
                            <!--begin col-md-4-->
                            <div class="col-md-4 col-sm-6">

                                <!--begin testim-platform-->
                                <div class="testim-platform first">

                                    <p>Mid-Day</p>

                                    <div class="testim-rating">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                       <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>

                                </div>
                                <!--end testim-platform-->
                                
                            </div>
                            <!--end col-sm-4-->
                            
                            <!--begin col-md-4-->
                            <div class="col-md-4 col-sm-6">

                                <!--begin testim-platform-->
                                <div class="testim-platform">

                                    <p>Daily Hunt</p>

                                    <div class="testim-rating">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>

                                </div>
                                <!--end testim-platform-->
                                
                            </div>
                            <!--end col-sm-4-->
                            
                        </div>
                        <!--end row-->
                        
                </div>
                <!--end col-md-5 -->

                <!--begin col-md-1 -->
                <div class="col-md-1"></div>
                <!--end col-md-1 -->

                <!--begin col-md-6-->
                <div class="col-md-6">

                    <!--begin accordion -->
                    <div class="accordion" id="accordionFAQ">

                        <!--begin card -->
                        <div class="card">
                            
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionFAQ">
                                <div class="card-body">
                                <video width="100%" height="300" controls>
  <source src="https://www.talentdhundo.com/assets/test_video/Shruti_Singer.mp4" type="video/mp4">
 
</video>
                                </div>
                            </div>

                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  <!-- <img src="images/testimonials3.jpg" alt="testimonials" class="testim-img"> -->
                                  <p class="testim-name">Shruti / <span>Singer</span></p>
                                </button>
                                </h5>
                            </div>

                        </div>
                        <!--end card -->

                        <!--begin card -->
                        <div class="card">

                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFAQ">
                                <div class="card-body">
                              <video width="100%" height="300" controls>
  <source src="https://www.talentdhundo.com/assets/test_video/Romi%20mukherjee-singer.mp4" type="video/mp4">
 
</video>
                                </div>
                            </div>

                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  <!-- <img src="images/testimonials2.jpg" alt="testimonials" class="testim-img"> -->
                                  <p class="testim-name">Romi Mukherjee / <span>Singer</span></p>
                                </button>
                                </h5>
                            </div>

                        </div>
                        <!--end card -->

                        <!--begin card -->
                        <div class="card">

                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionFAQ">
                                <div class="card-body">
                               <video width="100%" height="300" controls>
  <source src="https://www.talentdhundo.com/assets/test_video/Sunny_Rampal_Anchor.mp4" type="video/mp4">
 
</video>
                                </div>
                            </div>

                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                  <!-- <img src="images/testimonials1.jpg" alt="testimonials" class="testim-img"> -->
                                  <p class="testim-name">Sunny Rampal / <span>Anchor</span></p>
                                </button>
                                </h5>
                            </div>

                        </div>
                        <!--end card -->

                    </div>
                    <!--end accordion -->

                </div>
                <!--end col-md-6-->

            </div>
            <!--end row -->

        </div>
        <!--end container -->

    </section>
    <!--end testimonials section -->

    <!--begin section-white -->
    
    <!--end section-white -->

    <!--begin team section -->
    <section class="section-grey" id="team">

        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row">
          
                <!--begin col-md-12 -->
                <div class="col-md-12 text-center">

                    <h2 class="section-title">Media Coverage</h2>

                    <p class="section-subtitle">Discover more about our Media Coverage.</p>
                    
                </div>
                <!--end col-md-12 -->
                
                <!--begin team-item -->
                <div class="col-sm-12 col-md-4 margin-top-30">

                    <a href="https://www.mid-day.com/lifestyle/infotainment/article/talent-dhundo-indias-largest-talent-portal-makes-an-historic-launch-by-out-breaking-registrations-23178120"><img src="https://www.talentdhundo.com/assets/images/pr/midday.jpg" class="team-img width-100" alt="pic"></a>
                   
                    <div class="team-item">
                    
                       <div class="team-info geen">  <h3><a href="https://www.mid-day.com/lifestyle/infotainment/article/talent-dhundo-indias-largest-talent-portal-makes-an-historic-launch-by-out-breaking-registrations-23178120">Mid-Day </a></h3></div>
                        
                       

                        <p><a href="https://www.mid-day.com/lifestyle/infotainment/article/talent-dhundo-indias-largest-talent-portal-makes-an-historic-launch-by-out-breaking-registrations-23178120">Talent Dhundo India's largest Talent Portal makes an historic launch by out breaking registrations</a></p>
                    
                    </div>

                </div>
                <!--end team-item -->
                 
                <!--begin team-item -->
                <div class="col-sm-12 col-md-4 margin-top-30">

                    <a href="https://thetimesnews.co.in/talent-dhundo-indias-largest-talent-portal-has-made-a-heroic-entry-into-the-industry/"><img src="https://www.talentdhundo.com/assets/images/pr/thetimesnews.jpg" class="team-img width-100" alt="pic"></a>
                   
                    <div class="team-item">
                    
                       <div class="team-info geen">  <h3><a href="https://thetimesnews.co.in/talent-dhundo-indias-largest-talent-portal-has-made-a-heroic-entry-into-the-industry/">TheTimesNews </a></h3></div>
                        
                       

                                <p><a href="https://thetimesnews.co.in/talent-dhundo-indias-largest-talent-portal-has-made-a-heroic-entry-into-the-industry/">Talent Dhundo, India’s largest talent portal has made a heroic entry into the industry.</a></p>
                    
                    </div>

                </div>
                <!--end team-item -->
                               
                <!--begin team-item -->
                <div class="col-sm-12 col-md-4 margin-top-30">

                    <a href="https://m.dailyhunt.in/news/india/english/times+applaud-epaper-dh3fdc39065ea14dfaa13f0787941cee2d/talent+dhundo+india+s+largest+talent+portal+has+made+a+heroic+entry+into+the+industry-newsid-dh3fdc39065ea14dfaa13f0787941cee2d_3771d670ca9411ebbde73a18f64382f0"><img src="https://www.talentdhundo.com/assets/images/pr/dailyhunt.jpg" class="team-img width-100" alt="pic"></a>
                   
                    <div class="team-item">
                    
                      <div class="team-info geen">  <h3><a href="https://m.dailyhunt.in/news/india/english/times+applaud-epaper-dh3fdc39065ea14dfaa13f0787941cee2d/talent+dhundo+india+s+largest+talent+portal+has+made+a+heroic+entry+into+the+industry-newsid-dh3fdc39065ea14dfaa13f0787941cee2d_3771d670ca9411ebbde73a18f64382f0">DailyHunt </a></h3></div>

                             <p><a href="https://m.dailyhunt.in/news/india/english/times+applaud-epaper-dh3fdc39065ea14dfaa13f0787941cee2d/talent+dhundo+india+s+largest+talent+portal+has+made+a+heroic+entry+into+the+industry-newsid-dh3fdc39065ea14dfaa13f0787941cee2d_3771d670ca9411ebbde73a18f64382f0">Talent Dhundo India's largest Talent Portal makes an historic launch by out breaking registrations</a></p>
                    </div>

                </div>
                <!--end team-item -->
            
            </div>
            <!--end row-->
        
        </div>
        <!--end container-->

    </section>
    <!--end team section-->

    <!--begin section-bg-2 -->
    <section class="section-bg-2">
        
        <div class="section-bg-overlay"></div>

        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row">
            
                <!--begin col md 7 -->
                <div class="col-md-12 mx-auto text-center">

                    <h2 class="white-text">Stay With Us by Downloading Our Mobile App</h2>

                    <!-- <p class="white-text">Stay With Us by Downloading Our Mobile App</p> -->
                
                    <a href="https://play.google.com/store/apps/details?id=com.talentdhundo" class="btn-white small scrool">Download Now</a>

                    <a href="https://wa.me/02249245249?text=Hi%2C%20%20%0AI%20would%20like%20to%20apply%20for%20Urgent%20Artist%20Required%20Category.%0APlease%20contact%20me" class="btn-white-border small scrool">Get In Touch</a>

                </div>
                <!--end col md 7-->
            
            </div>
            <!--end row-->
    
        </div>
        <!--end container-->
    
    </section>
    <!--end section-bg-2 -->

    <!--begin features section -->
    
    <!--end features section -->

    <!--begin pricing section -->
    <section class="section-grey" id="pricing">

        <!--begin container -->
        <div class="container">

            <!--begin row -->
            <div class="row align-items-center">

                <!--begin col-md-4 -->
                <div class="col-md-4 col-sm-12">

                    <h3>Membership Plan</h3>

                    <p>The said Membership is a Lifetime Membership and the Applicant can Make a decision basis the Benefits of the Membership</p>
                    
                </div>
                <!--end col-md-4 -->

                <!--begin col-md-4-->
                <div class="col-md-4 col-sm-6 wow bounceIn" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: bounceIn;">

                    <div class="price-box-white">

                        <ul class="pricing-list">

                            <li class="price-title">Sliver</li>

                            <li class="price-value">?199</li>

                            <li class="price-subtitle">Lifetime</li>

                            <li class="price-tag" >
                                <a href="https://wa.me/message/SKY6W3KQYD3NF1" style="
    background: #0678b5;
    color: #fff;
">GET STARTED</a></li>

                           <!--  <li class="price-text">First two weeks free.</li>
                            
                            <li class="price-text">Amazing freatures.</li> -->

                        </ul>

                    </div>

                </div>
                <!--end col-md-4 -->

                <!--begin col-md-4 -->
                <div class="col-md-4 col-sm-6 wow bounceIn" data-wow-delay="0.75s" style="visibility: visible; animation-delay: 0.75s; animation-name: bounceIn;">

                    <div class="price-box-grey">

                        <ul class="pricing-list">

                            <li class="price-title">Platinum</li>

                            <li class="price-value">?999</li>

                            <li class="price-subtitle">Lifetime</li>

                            <li class="price-tag"><a href="https://wa.me/message/SKY6W3KQYD3NF1">GET STARTED</a></li>

                           <!--  <li class="price-text">First two weeks free.</li>
                            
                            <li class="price-text">Save 45% with this plan</li>

                            <li class="price-text">Amazing freatures.</li> -->

                        </ul>

                    </div>

                </div>
                <!--end col-md-4 -->

            </div>
            <!--end row -->

        </div>
        <!--end container -->

    </section>
    <!--end pricing section -->

    <!--begin faq section -->
    <section class="section-white" id="faq">

        <!--begin container -->
        <div class="container">

            <!--begin row -->
            <div class="row">

                <!--begin col-md-12-->
                <div class="col-md-12 text-center padding-bottom-10">

                    <h2 class="section-title">Frequently Asked Questions</h2>

                  
                </div>
                <!--end col-md-12 -->

            </div>
            <!--end row -->

            <!--begin row -->
            <div class="row">

                <!--begin accordion -->
                    <div class="accordion col-md-12" id="accordionFAQ">

                        <!--begin card -->
                        <div class="card ">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#One" aria-expanded="true" aria-controls="collapseOne">
                                  <!-- <img src="images/testimonials3.jpg" alt="testimonials" class="testim-img"> -->
                                  <p class="testim-name">Why Talent Dhundo ?</p>
                                </button>
                                </h5>
                            </div>
                            <div id="One" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionFAQ">
                                <div class="card-body">
                                <p>Please go through our About us , how does it work , why choose us write up</p>
                                </div>
                            </div>

                            

                        </div>
                        <!--end card -->
                        <!--begin card -->
                        <div class="card ">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#Two" aria-expanded="true" aria-controls="collapseOne">
                                  <!-- <img src="images/testimonials3.jpg" alt="testimonials" class="testim-img"> -->
                                  <p class="testim-name">While registering why so many details are asked ?</p>
                                </button>
                                </h5>
                            </div>
                            <div id="Two" class="collapse " aria-labelledby="headingOne" data-parent="#accordionFAQ">
                                <div class="card-body">
                                <p>The reason for we asking basic questions is to provide maximum details to the talent hunter at one go so that we avoid wasting time coordinating to get basics</p>
                                </div>
                            </div>

                            

                        </div>
                        <!--end card -->


                        <!--begin card -->
                        <div class="card ">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#three" aria-expanded="true" aria-controls="collapseOne">
                                  <!-- <img src="images/testimonials3.jpg" alt="testimonials" class="testim-img"> -->
                                  <p class="testim-name">My Talent is not listed in the categories ?</p>
                                </button>
                                </h5>
                            </div>
                            <div id="three" class="collapse " aria-labelledby="headingOne" data-parent="#accordionFAQ">
                                <div class="card-body">
                                <p>Problem </p>
                                </div>
                            </div>

                            

                        </div>
                        <!--end card -->

                       

                    </div>
                    <!--end accordion -->

            </div>
            <!--end row -->

        </div>
        <!--end container -->

    </section>
    <!--end faq section -->

    <!--begin section-bg-2 -->
    <section class="section-bg-2" id="contact">
        
        <div class="section-bg-overlay"></div>

        <!--begin container-->
        <div class="container">

            <!--begin row -->
            <div class="row">

                <!--begin col-md-12-->
                <div class="col-md-12 text-center padding-bottom-10">

                    <h2 class="section-title white-text">Contact Us</h2>

                    <p class="section-subtitle white">Have any queries? Get in touch today.</p>

                </div>
                <!--end col-md-12 -->

            </div>
            <!--end row -->

            <!--begin row-->
            <div class="row justify-content-md-center">
            
                <!--begin col-md-8-->
                <div class="col-md-8 text-center margin-top-10">

                    <!--begin contact-form-wrapper-->
                    <div class="contact-form-wrapper wow bounceIn" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: bounceIn;">

                        <!--begin form-->
                        <div>
                             
                            <!--begin success message -->
                            <p class="contact_success_box" style="display:none;">We received your message and you will hear from us soon. Thank You!</p>
                            <!--end success message -->
                            
                            <!--begin contact form -->
                            <form id="contact-form" class="row contact-form contact" action="contact_form.php" method="post">
                                    
                                <!--begin col-md-6-->
                                <div class="col-md-6">

                                    <input class="contact-input" required="" name="contact_names" placeholder="Your Name*" type="text">
                                
                                    <input class="contact-input" required="" name="contact_phone" placeholder="Phone Number*" type="text">
                                
                                </div>
                                <!--end col-md-6-->
        
                                <!--begin col-md-6-->
                                <div class="col-md-6">

                                    <input class="contact-input" required="" name="contact_email" placeholder="Email Adress*" type="email">
                              
                                   <!--  <select class="contact-input" required="" name="contact_ticket">

                                         <option value="">Select Category</option>

                                    <option value="Model">Model</option>
                                    <option value="Singer">Singer</option>
                                    <option value="Photographer">Photographer</option>
                                    <option value="Musician">Musician</option>
                                    <option value="Dancer">Dancer</option>
                                    <option value="Anchor">Anchor</option>
                                    <option value="StandUp Comedian">StandUp Comedian</option>
                                    <option value="Magician">Magician</option>
                                    <option value="MakeUp Artist /Stylist">MakeUp Artist /Stylist</option>
                                    <option value="">Unique Talent</option>
                                    <option value="Junior Talent (Below 14)">Kids (Junior Talent )Below 14 Yrs</option>
                                    <option value="">Baby Talent (below 5 yrs)</option>

                                    </select> -->

                                       <input class="contact-input" required="" name="register_ticket" placeholder="Enter Pincode" list="pincode" type="number">
                                <datalist id="pincode">
                                    <?php 
                                    $pindata=mysqli_query($con1,"SELECT * FROM `new_pincode`");
                                    while ($sql_result = mysqli_fetch_assoc($pindata)) {
                                       ?>
                                  <option value="<?=$sql_result['pincode']?>">
                                  <?php } ?>
                                </datalist>
                                
                                </div>
                                <!--end col-md-6-->
        
                                <!--begin col-md-12-->
                                <div class="col-md-12">

                                    <textarea class="contact-input" rows="2" cols="20" name="contact_message" placeholder="Your Message..."></textarea>

                                    <input value="Get In Touch" name="send" class="contact-submit" type="submit">
                                
                                </div>
                                <!--end col-md-12-->
                
                            </form>
                            <!--end contact form -->

                        </div>
                        <!--end form-->

                    </div>
                    <!--end contact-form-wrapper-->

                </div>
                <!--end col-md-8-->
            
            </div>
            <!--end row-->
    
        </div>
        <!--end container-->
    
    </section>
    <!--end section-bg-2 -->
<div class="sticky-ftr-btn" rs_id="1729">

      <ul> 
          <li class="custmize_btn">
              <!-- <a href="tel:+919930808548
  " rs_id="1732">Call Now</a> -->
  <p class="text-bottom">Fast-track Your Business In The Industry  </p>
          </li> 
          <li class="bulkorder_btn">
              <a href="https://wa.me/919892384666?text=I'm Interested">Apply Now</a>
          </li> 
      </ul> 
    </div>
    <!--<a class="whatsapp-button disnone1" target="_blank" href="https://wa.me/message/SKY6W3KQYD3NF1" rs_id="1727">
          <i class="fab fa-whatsapp" aria-hidden="true" rs_id="1728"></i>
      </a>-->
    <a class="whatsapp-button disnone1" target="_blank" href="https://wa.me/919892384666?text=I'm Interested">
          <i class="fab fa-whatsapp" aria-hidden="true"></i>
      </a>  
    <!--begin footer -->
    <div class="footer">
            
        <!--begin container -->
        <div class="container">
        
            <!--begin row -->
            <div class="row">
            
                <!--begin col-md-5 -->
                <div class="col-md-5">
                   
                    <p>© 2021 Allmart</p>
                    
                </div>
                <!--end col-md-5 -->
                
                <!--begin col-md-2 -->
                <div class="col-md-2"></div>
                <!--end col-md-2 -->
                
                <!--begin col-md-5 -->
                <div class="col-md-5">
                                         
                    <!--begin footer_social -->
                    <ul class="footer_social">

                        <li>Follow us:</li>

                        <li><a href="https://twitter.com/AllMart_World"><i class="fab fa-twitter"></i></a></li>

                        

                        <li><a href="https://www.facebook.com/AllmartWorld-111946707234321"><i class="fab fa-facebook-square"></i></a></li>

                        <li><a href="https://www.instagram.com/allmart.world"><i class="fab fa-instagram"></i></a></li>

                        <!--<li><a href="https://www.linkedin.com/company/talent-dhundo"><i class="fab fa-linkedin"></i></a></li>-->
                        <li><a href="https://wa.me/919892384666"><i class="fab fa-whatsapp"></i></a></li>

                       

                    </ul>
                    <!--end footer_social -->
                    
                </div>
                <!--end col-md-5 -->
                
            </div>
            <!--end row -->

        </div>
        <!--end container -->
               
    </div>
    <!--end footer -->


<!-- Load JS here for greater good =============================-->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollTo-min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery.nav.js"></script>
<script src="js/wow.js"></script>
<script src="js/plugins.js"></script>
<script src="js/custom.js"></script>
<script type="text/javascript">

$('#send').click(function(event){ debugger;
   $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'register-form.php',
        data: $('form').serialize(),
        success: function (msg) {
            if(msg==1){
                $(".register_success_box").css("display","block");
            }
        }
    });
});
</script>
</body>


</html>