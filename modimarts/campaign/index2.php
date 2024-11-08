<?php

include("newpart.php");

include('config.php');
    $zone = zone_cal();
    $state    = state_cal();
    $division = div_cal();
    $district = district_cal();
    $taluka = taluka_cal();
    $pincode = pincode_cal();
    $village = village_cal();
    
    $country_qualified= country_qualified();
    $zone_qualified = zone_qualified();
    $state_qualified = state_qualified();
    $division_qualified = division_qualified();
    $district_qualified = district_qualified();
    $taluka_qualified = taluka_qualified();
    $pincode_qualified = pincode_qualified();
    $village_qualified = village_qualified();

?>
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
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

    <!-- Font Favicon -->
    <link rel="shortcut icon" href="https://allmart.world/assets/logo.png" type="image/png" />
    <link href="css/campaign.css" rel="stylesheet">
    
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

                            <!--<li><a href="#team">Media Coverage</a></li>-->

                            <!--<li><a href="#features">Features</a></li>-->

                            <!--<li><a href="#pricing">Pricing</a></li>-->
                            
                            <li><a href="#faq">FAQ</a></li>

                            <li class="discover-link">
                               <!-- <a href="https://wa.me/919892384666?text=Hi%2C%20%20%0AI%20would%20like%20to%20apply%20for%20Franchisee." class="discover-btn">Contact Now</a></li>-->
                               <a href="#contact" class="discover-btn">Contact Now</a></li>

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

       <!-- <div class="home-section-overlay blur"></div>-->
        <div class="section-bg-overlay"></div>
        <!--begin container -->
        <div class="container">

            <!--begin row -->
            <div class="row">
              
                <!--begin col-md-6-->
                <div class="col-md-7 padding-top-60">

                    <h3>
                        <br><span class="red-color">Chance to get associated with India's leading E-commerce Store!</span>
                        <br><font color="black"> Golden opportunity to get associated with us </font></h3>

                    <p class="hero-text red-color">Get a ready platform to work and earn!</p>

                    <!--begin popup-video-wrapper-->
                    <div class="popup-gallery-wrapper">
                        
                        <!--begin popup-video-->
                        <div class="popup-gallery hero-gallery">
                            
                            <a class="popup4 video-icon" href="https://www.youtube.com/watch?v=dziRsVFcnSM">
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

                      <!--  <h3 class="red">Inquire now to avail special offers   </h3> -->

                        <p class="red-color" >Fill up your details to know more about the exclusive Income Opportunity</p>

                        <!--begin form-->
                        <div>
                             
                            <!--begin success message -->
                            <p class="register_success_box" style="display:none;">We received your message and you will hear from us soon. Thank You!</p>
                            <!--end success message -->
                            
                            <!--begin register form -->
                            <form id="register-form" class="register-form register" action="javascript:void(0)" method="post">
                                
                    
                                <input class="register-input name-input white-input" required="" name="register_names"  placeholder="Full Name*" type="text">
                            
                                <input class="register-input name-email white-input" required="" name="register_email" placeholder="Email Address*" type="email">
                                 <input class="register-input name-number white-input" required="" id="register_number" name="register_number" placeholder="Mobile Number*" type="text" pattern="[7-9]{1}[0-9]{9}" maxlength="10">

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
                                <input class="register-input name-number white-input" required="" maxlength="6"  name="register_ticket" placeholder="Area Pincode" list="pincode" type="number">
                                
                                <datalist id="pincode">
                                    <?php 
                                    $pindata=mysqli_query($con1,"SELECT * FROM `new_pincode`");
                                    while ($sql_result = mysqli_fetch_assoc($pindata)) {
                                       ?>
                                  <option value="<?=$sql_result['pincode']?>">
                                  <?php } ?>
                                </datalist>
                               
                               <!--<input class="register-submit" name="send" type="submit" value="Let's Begin Your Journey">-->
                                <button class="register-submit" id="send" name="send" type="button">Join Now</button>
                                    
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

                        <img src="images/aboutleft.jpg" class="width-100 image-shadow bottom-margins-images" alt="pic">

                    </div>
                    
                </div>
                <!--end col-sm-6-->
                
                <!--begin col-md-6-->
                <div class="col-md-6">

                    <h3>About Allmart</h3>

                    <p>Allmart.world is a technologically driven Indian e-commerce platform for buyers to browse and buy the best products at the best deal as well as for sellers to list their products and make it available.</p>
<p>We have a wide range of products available like- FMCG, Electronics, Apparel, Accessories,Furniture, Appliances, Grocery, and more. Further, we welcome Manufacturers, Importers, Distributors, Wholesalers, Retailers, Resellers, and even NGOs from different product categories. We have a vendor friendly panel to upload products and make it available for sale on the same day itself.</p>
<p>We will strive to provide the best customer experience possible. Customers will be able to browse products, manage cart, order products using multiple secure payment methods, track orders, and get it delivered directly by the seller to their doorsteps.</p>
<p>We are smart, passionate builders with different backgrounds and goals, who share a common desire to always be learning and inventing on behalf of our customers.</p>
                    
                  <!--   <ul class="benefits">
                        <li><i class="fas fa-check"></i> Quias netus magni netsum eos qui ratione sequi.</li>
                        <li><i class="fas fa-check"></i> Venis ratione sequi netus enim quia tempor magni.</li>
                        <li><i class="fas fa-check"></i> Enim ipsam netus voluptatem quia voluptas.</li>
                    </ul> -->

                    <a href="https://wa.me/919892384666?text=Hi%2C%20%20%0AI%20would%20like%20to%20apply%20for%20Franchisee." class="btn-red small scrool">Enquire Now!</a>

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

                    <h2 class="section-title">Presentation (PDF)</h2>

                    
                </div>
                <!--end col-md-12 -->
                
                <!--begin team-item -->
                <div class="col-sm-12 col-md-6  margin-top-30" >

                   
                   
                    <div style="text-align: left;" class="team-item">
                    
                       <ul>
                           
<li> ऑलमार्ट ट्रेनिंग हिंदी Pdf</li>
<a href="ppt/Allmart Hindi Franchisee Presentation.pdf" class="btn-red1 small scrool">Download Now</a> 
</ul>
                 
                    </div>

                </div>
                <!--end team-item -->

                 <!--begin team-item -->
                <div class="col-sm-12 col-md-6 margin-top-30">

                   
                   
                    <div style="text-align: left;" class="team-item">
                    
                <ul>
                    
                    
<li></b>Allmart Training English Pdf </li>
 <a href="ppt/Allmart English Franchisee Presentation.pdf" class="btn-red1 small scrool">Download Now</a>      
</ul>
                    
           </div>

                </div>
                <!--end team-item -->


                <!--begin team-item -->

                <!--end team-item -->
                
  <!--begin team-item -->
   
         <div class="col-md-6 col-sm-6 col-xs-6 margin-top-30" >

            <div style="text-align: left;" class="team-item">
                    
            
<a href="https://docs.google.com/presentation/d/1UyuY3iVzoEN2JC6EdGB_fxuXyD31bQgtWmtVNwNVynI/edit?usp=sharing" style="width:100%;" class="btn btn-primary button ">
    <h5> ऑलमार्ट ट्रेनिंग हिंदी </br>फ्रेंचाइजी</h5></a>

                    </div>

                </div>
                <!--end team-item -->
                 <!--begin team-item -->
                <div class="col-md-6 col-sm-6 col-xs-6 margin-top-30" >

                   
                   
                    <div style="text-align: left;" class="team-item">
                    
          
<a href="https://docs.google.com/presentation/d/14iY4GvVX96sjyjxuxVwRIAWJNHbsdKOTXz32L7Uvwjc/edit?usp=sharing" style="width:100%;" class="btn btn-primary button ">
    <h5>Allmart Training English</br>Franchisee</h5></a>

                    
                    </div>

                
                </div>
                
               
            </div>
            <!--end row-->
    
        </div>
        <!--end container-->
    
    </section>
    <!--end section-grey-->
    
    <section class="section-white">
        <div class="container">
             <h2 style="text-align: center; text-decoration:underline;">See Franchise Positions Vacant  &  Filled </h2> <br>
        <div class="row">
            <div class="col-md-2">
                <div style="text-align: center;"></div>
            </div>    
            <div class="col-md-8">
                <table class="table table-bordered table-new">
                  <thead>
                    <tr>
                      <th scope="col"> </th>
                      <th scope="col">Total Position</th>
                      <th scope="col">Position Given</th>
                      <th scope="col">Qualified</th>
                      <th scope="col">Available</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">India</th>
                      <td class="total_pos">1</td>
                      <td class="given_pos"> 1</td>
                      <td class="qualify"><? echo $country_qualified;?></td>
                      <td class="available_pos">
                          0
                        </td>
                    </tr>
                    <tr>
                      <th scope="row">Zone</th>
                      <td class="total_pos"><? echo $zone[0];?></td>
                      <td class="given_pos"><? echo $zone[1];?></td>
                      <td class="qualify">
                            <? echo $zone_qualified;?>
                      </td>
                      <td  class="available_pos"><? echo $zone[0] - $zone[1];?></td>
                    </tr>
                    
                    <tr>
                  <th scope="row">State</th>          
                  <td class="total_pos"><? echo $state[0];?></td>
                      <td class="given_pos"><? echo $state[1];?></td>
                      
                      <td class="qualify">
                          <? echo $state_qualified;?>
                      </td>
                      <td class="available_pos"><? echo $state[0]-$state[1];?></td>
                    </tr>
                    
                    
                    <tr>
                      <th scope="row">Division</th>
                                                              <td class="total_pos"><? echo $division[0];?></td>
                      <td class="given_pos"><? echo $division[1];?></td>
                      <td class="qualify">
                          <? echo $division_qualified;?>
                      </td>
                      <td  class="available_pos"><? echo $division[0]-$division[1];?></td>
                      
                    </tr>
                    <tr>
                      <th scope="row">District</th>
                      <td class="total_pos"><? echo $district[0];?></td>
                      <td class="given_pos"><? echo $district[1];?></td>
                      <td class="qualify">
                          <? echo $district_qualified;?>
                      </td>
                      <td  class="available_pos"><? echo $district[0]-$district[1];?></td>
                      
                    </tr>
                    <tr>
                      <th scope="row">Taluka</th>
                      <td class="total_pos"><? echo $taluka[0];?></td>
                      <td class="given_pos"><? echo $taluka[1];?></td>
                      <td class="qualify">
                            <? echo $taluka_qualified;?>
                      </td>
                      <td  class="available_pos"><? echo $taluka[0]-$taluka[1];?></td>
                      
                    </tr><tr>
                      <th scope="row">Pincode</th>
                      <td class="total_pos"><? echo $pincode[0];?></td>
                      <td class="given_pos"><? echo $pincode[1];?></td>
                      <td class="qualify">
                          <? echo $pincode_qualified;?>
                      </td>
                      <td  class="available_pos"><? echo $pincode[0] - $pincode[1] ;?></td>
                    </tr><tr>
                      <th scope="row">Village</th>
                      <td class="total_pos"><? echo $village[0];?></td>
                      <td class="given_pos"><? echo $village[1];?></td>
                      <td class="qualify">
                          <? echo $village_qualified;?>
                      </td>
                      <td  class="available_pos"><? echo $village[0] -  $village[1];?></td>
                    </tr><tr>
                      <th scope="row">Total</th>
                      <td class="total"></td>
                      <td class="given"></td>
                      <td class="total_qualify"></td>
                      <td class="available"></td>
                    </tr>
                  </tbody>
                </table>
                                        
               </div>
            </div>
            <div class="row">
<!-- start Location availability popup -->
                <div class="col-md-12 text-center">
                    
                      <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#checklocation" style="border-radius: 23px 23px;backround:#fd1200;font-size:1.3rem !important">
                 Check Your Location Availability
                  
                  </button>
                  
                 </div>
            </div> 
        </div>     
    </section>

     <!--begin section-bg-2 -->
    <section class="section-bg-2">
        
        <div class="section-bg-overlay"></div>

        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row">
            
                <!--begin col md 7 -->
                <div class="col-md-12 mx-auto text-center">

                    <h2 class="white-text">Franchise Has no Cost</h2>

                    <p class="white-text text-left" >How ever it is purely on Merit, Application and selection basis. The applicant Needs to Apply with us by filling the form , Our Team will be calling them to understand their credentials followed by finalisation.<br> What are we looking in our Franchise Associate? </p>                 
                    
                    <ul class="white-text text-left">
                        
                          <li>A Good Leader</li>      
                        
                          <li>Good Contacts</li>  
                        
                          <li>Clean Image</li>  
                         
                          <li>A Good Influencer</li>  
                      
                          <li>Smart Phone User</li>     
                      
                </ul>
                  
                </div>
                <!--end col md 7-->
            
            </div>
            <!--end row-->
    
        </div>
        <!--end container-->
    
    </section>
    <!--end section-bg-2 -->

    
    
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
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#One" aria-expanded="false" aria-controls="collapseOne" style="color: black;text-decoration: none;justify-content: space-between;">
                                   Why ALLMART ?
                                   
                                <span class="fa-co material-icons-outlined md-36">add_circle_outline</span>
                                </button>
                                </h5>
                            </div>
                            <div id="One" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionFAQ">
                                <div class="card-body">
                                <p class="red-color">All mart is a mega Ecommerce store and its one of its kind of store which has a strong Online and Offline presence, it provides opportunities to Franchise owner’s with complete backhand development  and well equipped professional team. It Franchise comes with Zero cost and millions of opportunities.</p>
                                </div>
                            </div>

                            

                        </div>
                        <!--end card -->
                        <!--begin card -->
                        <div class="card ">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#Two" aria-expanded="true" aria-controls="collapseOne">
                                  What would be my role as a franchise owner ?
                                  
                               
                                <span class="fa-co material-icons-outlined md-36">add_circle_outline</span>
                                </button>
                                </h5>
                            </div>
                            <div id="Two" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionFAQ">
                                <div class="card-body">
                                <p class="red-color">Role as a franchise owner would be to Build a team under them of franchises and develop them as your ancillary earning are linked to their earnings too. Network and market our products online and offline with a considerable margin. To know more please contact us</p>
                                </div>
                            </div>

                            

                        </div>
                        <!--end card -->


                        <!--begin card -->
                        <div class="card ">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#three" aria-expanded="true" aria-controls="collapseOne">
                                  Are there any hidden costs ?
                                  
                               
                                <span class="fa-co material-icons-outlined md-36">add_circle_outline</span>
                                </button>
                                </h5>
                            </div>
                            <div id="three" class="collapse " aria-labelledby="headingThree" data-parent="#accordionFAQ">
                                <div class="card-body">
                                <p class="red-color">No there are no hidden costs </p>
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

                                    <input class="contact-input" required="" name="contact_email" placeholder="Email Address*" type="email">
                              

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
<script src="js/validation.js"></script>
<script type="text/javascript">

$('#send').click(function(event){ debugger;
   var mob_no = $('#register_number').val();
   var mob_res = _phonenumber(mob_no);
   
   var pin = $('#register_ticket').val();
   var pin_code = _pincode(pin);
   if(mob_res==0){
       alert("Invalid Mobile Number");
       return false;
   }if(pin_code==0){
       alert("Invalid Mobile Number");
       return false;
   }
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
$('#getintouch').click(function(event){ debugger;
   $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'contact-form.php',
        data: $('#gettouch form').serialize(),
        success: function (msg) {
            if(msg==1){
                $(".contact_success_box").css("display","block");
            }
        }
    });
});

$('#location').click(function(event){ debugger;
   $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'location-form.php',
        data: $('form').serialize(),
        success: function (msg) {
            if(msg==1){
                $(".location_success_box").css("display","block");
            }
        }
    });
});
</script>

    <script>
    
    $(document).ready(function(){
        
    
    setTimeout(function(){ 
        
        
    var value1;
    var theTotal1 = 0;
    $(".total_pos").each(function () {
    value1 = $(this).html();
    
    if(value1){
        console.log(value1);
    theTotal1 += parseInt(value1);
    $(".total").text(theTotal1);        
    }

});


    var value2;
    var theTotal2 = 0;
    $(".given_pos").each(function () {
    value2 = $(this).html();
    if(value2){
    theTotal2 += parseInt(value2);
    $(".given").text(theTotal2);        
    }

});


    var value4;
    var theTotal4 = 0;
    $(".available_pos").each(function () {
    value4 = $(this).html();
    if(value4){
    theTotal4 += parseInt(value4);
    $(".available").text(theTotal4);        
    }

});


   var value5;
    var theTotal5 = 0;
    $(".qualify").each(function () {
    value5 = $(this).html();
    if(value5){
    theTotal5 += parseInt(value5);
    $(".total_qualify").text(theTotal5);        
    }

});


        
    }, 1000);
    });


    </script>
    
    <script>        
        $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
            $(this).prev(".card-header").find(".fa-co").text('add_circle_outline');
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
            $(this).prev(".card-header").find(".fa-co").text('remove_circle_outline');
            // alert("Minus");
        }).on('hide.bs.collapse', function(){
            $(this).prev(".card-header").find(".fa-co").text('add_circle_outline');
             // alert("Plus");
        });
    });
   </script>
   
   
   
   <!-- Global site tag (gtag.js) - Google Ads: 342455883 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-342455883"></script>
<script>
window.dataLayer = window.dataLayer || [];
 function gtag(){dataLayer.push(arguments);}
 gtag('js', new Date());

 gtag('config', 'AW-342455883');
</script>

<!-- Event snippet for Website traffic conversion page -->
<script>
gtag('event', 'conversion', {'send_to': 'AW-342455883/wo0gCL-Q3M0CEMvspaMB'});
</script>

    
    
    <!-- Bootstrap core JavaScript -->
</body>


</html>