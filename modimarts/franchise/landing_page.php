<?php include('position_data.php');

    $zone = zone_cal();
    $state    = state_cal();
    $division = div_cal();
    $district = district_cal();
    $taluka = taluka_cal();
    
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <title> Allmart </title>

            <!-- Bootstrap core CSS -->
            <link href="allmart/css/new_bootstrap.min.css" rel="stylesheet">

            <!-- Custom styles for this template --> 
            <link href="https://startbootstrap.github.io/startbootstrap-business-frontpage/css/business-frontpage.css" rel="stylesheet">
            <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <script src="https://startbootstrap.github.io/startbootstrap-business-frontpage/vendor/jquery/jquery.min.js"></script>
            <script src="https://startbootstrap.github.io/startbootstrap-business-frontpage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <style>
                .content-container{
                    max-width: 1650px !important;
                }
                .logo-container{
                    margin-left: 0 !important;
                }
                .table td, .table th{
                    padding: 0.15rem !important;
                }
                .card {
                    border-color: #e1422e !important;
                }
                /*a{
                    color : #1f2429 !important;
                }*/
                .col-form-label{
                    font-weight: 600;
                }
                .table-new{
                    margin: 5px 20px 0px 20px;
                }
            </style>
        </head>
        <body>
            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <div class="container logo-container"> 
                    <a class="navbar-brand" href="https://allmart.world">
                        <img src="allmart/images/allmart.png" style="width:100px;" alt="logo"> &nbsp;&nbsp;allmart.world
                    </a>
                    <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a> 
                      </li>
                    </ul>
                  </div>-->
                </div>
            </nav>

            <!-- Header -->
            <!--<header class="bg-primary py-5 mb-5">
            <div class="container h-100">
              <div class="row h-100 align-items-center">
                <div class="col-lg-12">
                  <h1 class="display-4 text-white mt-5 mb-2">Business Name or Tagline</h1>
                  <p class="lead mb-5 text-white-50">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non possimus ab labore provident mollitia. Id assumenda voluptate earum corporis facere quibusdam quisquam iste ipsa cumque unde nisi, totam quas ipsam.</p>
                </div>
              </div>
            </div>
            </header>-->
          <!-- Page Content -->
            <div class=" py-5"></div>
            <div class="container content-container">
                <div class="row">
                  <!--<div class="col-md-8 mb-5">
                    <h2>What We Do</h2>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deserunt neque tempore recusandae animi soluta quasi? Asperiores rem dolore eaque vel, porro, soluta unde debitis aliquam laboriosam. Repellat explicabo, maiores!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis optio neque consectetur consequatur magni in nisi, natus beatae quidem quam odit commodi ducimus totam eum, alias, adipisci nesciunt voluptate. Voluptatum.</p>
                    <a class="btn btn-primary btn-lg" href="#">Call to Action &raquo;</a>
                  </div>
                  <div class="col-md-4 mb-5">
                    <h2>Contact Us</h2>
                    <hr>
                    <address>
                      <strong>Start Bootstrap</strong>
                      <br>3481 Melrose Place
                      <br>Beverly Hills, CA 90210
                      <br>
                    </address>
                    <address>
                      <abbr title="Phone">P:</abbr>
                      (123) 456-7890
                      <br>
                      <abbr title="Email">E:</abbr>
                      <a href="mailto:#">name@example.com</a>
                    </address>
                  </div>-->
                </div>
                <!-- /.row -->

                <div class="row">
                  <div class="col-md-8 mb-5" style="padding-right: 0;">
                    <div class="card h-100">
                      <!--<img class="card-img-top" src="https://placehold.it/300x200" alt="">-->
                      <div class="card-body">
                        <h4 class="card-title"><a href="franchise/index.php"> Franchisee</a></h4>
                        <!--<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus.</p>-->
                            <div class="col-md-6 col-sm-6">
                                <label class="col-form-label">Presentation</label>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-check">
                                    <a href="https://docs.google.com/presentation/d/1_cx_06UoN9PGQ3O8wao0pUXvnL9fPY2ePhk4JUa8Svk/edit?usp=sharing">
                                      <label class="form-check-label" >
                                        फ्रेंचाइजी बनने का सुनहरा मौका - हिंदी 
                                      </label>
                                    </a>
                                </div>
                                <div class="form-check">
                                    <a href="https://docs.google.com/presentation/d/1v1FlFBwJEOi7IGz0T2psQsF4UqzksMyrRPVKoOFNFQ8/edit?usp=sharing">
                                      <label class="form-check-label" > Golden Chance to become Franchisee - English </label>
                                    </a>
                                </div>
                                <div class="form-check disabled">
                                    <a href="#">
                                      <label class="form-check-label" for="gridRadios3">
                                        Testimonial
                                      </label>
                                    </a>
                                </div> 
                                <div class="form-check disabled">
                                    <a href="#">
                                      <label class="form-check-label" for="gridRadios3">
                                        News Ticker
                                      </label>
                                    </a>
                                </div>
                            </div>
                            <br>
                            
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label class="col-form-label">Zoom Meeting Link on Whats App or Copy or Sharing Video</label>
                                </div>
                                <div class="col-md-6 col-sm-6"> 
                                    <div class="form-check ">
                                        <a href="#">
                                          <label class="form-check-label" >
                                            Video - Bansidhar 
                                          </label>
                                        </a>
                                    </div>
                                    <iframe id="youtube-iframe" type="text/html" src="https://www.youtube.com/embed/s5Knr9lTVsU?enablejsapi=1&html5=1&autoplay=1&showinfo=0&controls=0&rel=0&wmode=transparent&vq=hd1080&hd=1&loop=1" frameborder="0" wmode="Opaque" ></iframe>
                                    
                                </div>
                                <div class="col-md-6 col-sm-6"> 
                                    <div class="form-check ">
                                        <a href="#">
                                          <label class="form-check-label" >
                                            Video - Rajesh Salvi 
                                          </label>
                                        </a>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                                
                                <br>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="col-form-label">See Franchisee Positions Vacant & Filled</label>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-check ">
                                            <a href="#">
                                              <label class="form-check-label" >
                                                See Vacant Franchisee - Apply
                                              </label>
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <br>
                                
                                <div class="row">
                                    <div class="col-md-12 col-sm-2">
                                        <label class="col-form-label">Social Media</label>
                                    </div><br>
                                    <div class="col-md-12 col-sm-10">
                                        
                                        <a href="https://www.facebook.com/AllmartWorld-111946707234321">
                                          <i class="fa fa-facebook" aria-hidden="true"></i> &nbsp; Facebook 
                                        </a>
                                        
                                        <a href="https://www.instagram.com/allmart.world">
                                          <i class="fa fa-instagram" aria-hidden="true"></i> &nbsp; Instagram
                                        </a>
                                        
                                        <a href="https://www.youtube.com/channel/UCmwbXGCoL4RnSuzEhbA71Aw">
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i> &nbsp; You tube
                                        </a>
                                        
                                        <a href="#">
                                            <i class="fa fa-graduation-cap" aria-hidden="true"></i> &nbsp; Training 
                                        </a>
                                        
                                        <a href="https://t.me/AllmartProduct">
                                            <i class="fa fa-graduation-cap" aria-hidden="true"></i> &nbsp; Telegram 
                                        </a>
                                        
                                        
                                    </div>
                                </div>
                                <br>
                                
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="col-form-label">News Section</label>
                                    </div>
                                    <!--<div class="col-md-6 col-sm-6">-->
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
                                              <td class="available_pos"></td>
                                              <td>0</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Zone</th>
                                              <td class="total_pos"><? echo $zone[0];?></td>
                                              <td class="given_pos"><? echo $zone[0]-$zone[1];?></td>
                                              <td></td>
                                              <td  class="available_pos"><? echo $zone[1];?></td>
                                            </tr>
                                            <tr>
                                          <th scope="row">State</th>                  <td class="total_pos"><? echo $state[0];?></td>
                                              <td class="given_pos"><? echo $state[1];?></td>
                                              <td></td>
                                              <td class="available_pos"><? echo $state[0]-$state[1];?></td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Division</th>
                                                                                      <td class="total_pos"><? echo $division[0];?></td>
                                              <td class="given_pos"><? echo $division[1];?></td>
                                              <td></td>
                                              <td  class="available_pos"><? echo $division[0]-$division[1];?></td>
                                              
                                            </tr>
                                            <tr>
                                              <th scope="row">District</th>
                                              <td class="total_pos"><? echo $district[0];?></td>
                                              <td class="given_pos"><? echo $district[1];?></td>
                                              <td></td>
                                              <td  class="available_pos"><? echo $district[0]-$district[1];?></td>
                                              
                                            </tr>
                                            <tr>
                                              <th scope="row">Taluka</th>
                                              <td class="total_pos"><? echo $taluka[0];?></td>
                                              <td class="given_pos"><? echo $taluka[1];?></td>
                                              <td></td>
                                              <td  class="available_pos"><? echo $taluka[0]-$taluka[1];?></td>
                                              
                                            </tr><tr>
                                              <th scope="row">Pincode</th>
                                              <td class="total_pos"></td>
                                              <td class="given_pos"></td>
                                              <td></td>
                                              <td  class="available_pos"></td>
                                            </tr><tr>
                                              <th scope="row">Village</th>
                                              <td class="total_pos"></td>
                                              <td class="given_pos"></td>
                                              <td></td>
                                              <td  class="available_pos"></td>
                                            </tr><tr>
                                              <th scope="row">Total</th>
                                              <td class="total"></td>
                                              <td class="given"></td>
                                              <td></td>
                                              <td class="available"></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                        
                                    <!--</div>-->
                                </div>
                                <br>
                                
                                
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="col-form-label">About Us</label>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <ul class="list-group">
                                          <li class="list-group-item"><a href="#">Mission & Vision</a></li>
                                          <li class="list-group-item"><a href="#">Values</li></a>
                                          <li class="list-group-item"><a href="#">People Behind Company</li></a>
                                          <li class="list-group-item"><a href="#">Consultants</li></a>
                                        </ul>
                                    </div>
                                </div>
                                <br>
                                
                                <!--<div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="col-form-label">Contact Us</label>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <ul class="list-group">
                                          <li class="list-group-item">Address</li>
                                          <li class="list-group-item">Mobile</li></a>
                                          <li class="list-group-item">Email</li>
                                        </ul>
                                    </div>
                                </div>-->
                                <br>
                                
                                
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="col-form-label">Contact Us</label>
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <div class="form-check ">
                                              <label class="col-form-label" > Address </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-10">
                                        <div class="form-check ">
                                            <p>Office Address: 25/25A, IIND FLOOR, 327, Nawab Bldg, D.N. Rd, Opp Thomas Cook, Mumbai. 400001</p>
                                            <label class="col-form-label" > Mobile </label>
                                            <label class="form-check-label" > 7710835444 </label><br>
                                            <label class="col-form-label" > Email </label>
                                            <label class="form-check-label" >  </label>
                                        </div>
                                    </div>
                                    
                                </div>
                                <br>
                        </div>
                      <div class="card-footer">
                        
                      </div>
                    </div>
                  </div>
                  <!--<div class="col-md-4 mb-5">
                    <div class="card h-100">
                        
                        <div class="card-body">
                            <h4 class="card-title"><a href="https://allmart.world/"> Ecommerce Website</a></h4>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus totam ut praesentium aut.</p>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    
                                    <label class="col-form-label"><a href="http://www.allmart.world/get_members.php">Franchisee</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            
                        </div>
                    </div>
                </div>-->
            </div>
            <!-- /.row -->
        </div>
    <!-- /.container -->
    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
        </div>
        <!-- /.container -->
    </footer>
    
    
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

        
    }, 1000);
    });


    </script>
    <!-- Bootstrap core JavaScript -->

</body>

</html>
