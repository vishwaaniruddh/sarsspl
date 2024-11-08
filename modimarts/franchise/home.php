<? include('particles.php');


include('../config.php');
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
<html>
<head>

    <link rel="stylesheet" type="text/css" href="style.css">
    <title>All Mart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        
        <style>
* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: white;
  width: 35%;
  height: auto;
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: red;
    color: white;
}

/* Create an active/current "tab button" class */
.tab button.active {
    background-color: red;
    color: white;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 65%;
  border-left: none;
  height: 100%;
}
img{
    width:100%;
}
</style>


        <style>
        .heading{
            display:flex;
        }
            .card a img{
                height: 300px;
            }
            .card {
    height: 380px;
    width:100%;
                
            }
            .logo{
                width:30%;
            }
            .menu{
                width:70%;
            }
            .menu ul{
                float:right;
                display: flex;
            }
            .menu ul li a {
                font-size:18px;         
                
            }
            .menu_ul{
                padding: 0;
    margin: 2% auto;
    
            }




    /*For Small device*/
    @media only screen and (max-width: 768px){

.icons{
    display:flex;
    justify-content:center;
    margin:auto;
}
.heading {
    display: block;
}
.logo {
display: flex;
    width: 100%;
    justify-content: center;
}
.menu {
    width: 100%;
}
.menu_ul,.menu_ul li{
    width:auto;
}

.card{
        height: 300px;
    margin: 5% auto;
    
}
.h2, h2 {
    font-size: 1.5rem;
}

.about_us {
    background-color: rgb(240,240,240);
    padding: 30px;
    height: 100%;
    padding-left: 10px;
    padding-right: 10px;
    margin: auto auto 2%;
}

    }
/* End */

marquee{

    margin: 1% 3% 1% 3%;

    font-size: 20px;
    padding: 1%;
    border: 1px solid red;
    background: red;
    color: white;
    font-weight: 700;

}

#youtube-iframe{
width: 100% !important;
    height: 450px !important;
}


    .custom_flex{
        display:flex;
        justify-content:center;
    }
    
    .mar_row{
            width: 90%;
    display: flex;
    justify-content: center;
    margin: auto;
    }
    
    @media (min-width: 576px){
        .modal-dialog {
            max-width: 1100px;
            margin: 1.75rem auto;
        }        
    }
    
    h5{
        text-align:center;
    }

    
        </style>
</head>

<body>
          

        <div class="heading">

            <div class="logo">
            <a href="https://sarsspl.com/modimarts/franchise"><img src="https://sarsspl.com/modimarts/assets/logo.png" alt="" style="width: 105px;background:white;border-radius: 50%;"><span style="font-size:0.7em;padding:10px;">Modimart.world</span></a>
            </div>
            
             <div class="menu">
                <ul class="menu_ul" style="    width: auto !important; ">
                    <!--<li><a href="https://sarsspl.com/modimarts/allmart/index.php">Ecommerce</a></li>-->
                    <li><a href="get_members.php">Franchise</a></li>
                    <!--<li><a href="https://sarsspl.com/modimarts/pay/">Franchise Payment</a></li>-->
                </ul>
            </div>

        </div>

<style>
marquee b{ 
        font-weight: 900;
    color: yellow;
}
    
</style>
        <div>
            <div class="row mar_row">
                <marquee>Join free and get Franchisee by selling Rs <b>One Lac</b> Products / Services and also get commission or else pay Rs <b>5000 </b> non refundable and get confirmed Area Level Franchisee.</marquee>
            </div>            
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        


















        <div class="franchisee_presentation">
            <h2 style="text-align: center;">Franchisee Presentation</h2><br>

            <div class="row">
                
                <div class="col-md-3 custom_flex">
                    <div class="card">
                    <!--<a href="https://docs.google.com/presentation/d/1_cx_06UoN9PGQ3O8wao0pUXvnL9fPY2ePhk4JUa8Svk/edit?usp=sharing">-->
                        <a href="https://sarsspl.com/modimarts/franchise/videos/Allmart_Franchisee_Hindi PDF.pdf">
                    
                        <img src="golden1.png" alt="" style="width:100%">
                        <div class="container">
                          <h5 style="color:black;">फ्रेंचाइजी बनने का सुनहरा मौका</h5> 
                        </div>
                    </a>
                  </div>
                </div>
                
                
                <div class="col-md-3 custom_flex">
                    <div class="card">
                    <!--<a href="https://docs.google.com/presentation/d/1v1FlFBwJEOi7IGz0T2psQsF4UqzksMyrRPVKoOFNFQ8/edit?usp=sharing">-->
                    <a href="https://sarsspl.com/modimarts/franchise/videos/Allmart_Franchisee_English PDF.pdf">
                    <img src="golden2.jpg" alt="" style="width:100%">
                    <div class="container">
                      <h5 style="color:black;">Golden Chance to become Franchisee</h5> 
                    </div>
                    </a>
                  </div>
                </div>
                
                
                <div class="col-md-3 custom_flex">
                    <div class="card">
                    <a href="testimonials.php">
                    <img src="testimonial1.jpg" alt="" style="width:100%">
                    <div class="container">
                      <h5 style="color:black;">Testimonial</h5>
                    </div>
                    </a>
                  </div>
                </div>

                <div class="col-md-3 custom_flex">
                    <div class="card">
                    <a href="testimonial_videos.php">
                    <img src="testimonialvideo.jpg" alt="" style="width:100%">
                    <div class="container">
                      <h5 style="color:black;">Testimonial Videos</h5>
                    </div>
                    </a>
                  </div>
                </div>
                
                
                <!--<div class="col-md-3">-->
                <!--    <div class="card">-->
                <!--    <img src="news.jpg" alt="" style="width:100%">-->
                <!--    <div class="container">-->
                <!--      <h4>News Ticker</h4>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>                        -->
                    


                

            </div>
        </div>


        <div class="zoom_links">
                <h2 style="text-align: center;">Zoom Meeting Links <a href="https://us02web.zoom.us/meeting/register/tZwoc-2pqzIsE9DH7STTnLYESP6peNBTWPNG">Click Here</a></h2>
                <h2 style="text-align: center;">on Whats App or Copy or Sharing Video</h2>
<hr>
<div class="container">
    <div class="row">

                <div class="col-md-12" style="display:flex;justify-content:center;">
                <!--<iframe width="560" height="315" src="https://www.youtube.com/embed/tmdJXEZU34E" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                <video width="600" height="400" controls autoplay>
                  <source src="https://sarsspl.com/modimarts/franchise/videos/Allmart Video High Rez.mp4" type="video/mp4" >
                  <source src="https://sarsspl.com/modimarts/franchise/videos/Allmart Video High Rez.ogg" type="video/ogg" >
                  Your browser does not support the video tag.
                </video>

                <br>
                <h4><b></b></h4>
                </div>
                <!--<div class="col-md-6" style="background-color: #f0f0f0;align-items: center;text-align: center;">-->
                <!--    <iframe id="youtube-iframe" type="text/html" src="https://www.youtube.com/embed/s5Knr9lTVsU?enablejsapi=1&html5=1&autoplay=0&showinfo=0&controls=0&rel=0&wmode=transparent&vq=hd1080&hd=1&loop=1" frameborder="1px" wmode="Opaque" style=" height: 178px;" ></iframe><br>-->
                <!--    <h4><b> Rajesh Salvi</b></h4>-->
                <!--</div>-->

            </div>
</div>
            

        </div>


        <div class="franchise_positions">
            <h2 style="text-align: center; text-decoration:underline;">See Franchise Positions Vacant  &  Filled </h2> <br>

<div class="row">
    

            <div class="col-md-4">
                    <img src="franch.jpg" style="width:90%; margin:auto;display:flex"> <br>
                    <div style="text-align: center;">
                        <a class="btn btn-danger" href="#" > See All India Franchise Data !</a>
                    </div>
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

        </div>
        
        
        
        <div class="news">
            <h2 style="text-align: center;">News</h2><br>

        <div class="container">
        <div class="row">
            <div class="col-md-6" style="background:white;position:relative;">
                <p style="position:absolute;top:50%; bottom:50;    color: red;text-align: center;position: absolute;top: 45%;bottom: 50%;font-size: 28px;text-shadow: 1px -1px #a7a7a7;">More than 8000 products are available in women's fashion section</p>
            </div>
            <div class="col-md-6">
                <img src="news1.jpg">
            </div>            
        </div>
            
        </div>


        </div>
         
            
         <div class="about_us"> 
            <h2 style="text-align: center;">About Us</h2>
            <br>
         <div class="row">
    

<div id="mission" class="tabcontent">
    
    <div class="row">
        <div class="col-md-6">
            <a href="https://sarsspl.com/modimarts/franchise/landing_assets/hindi_mission.jpeg">
        <img src="https://sarsspl.com/modimarts/franchise/landing_assets/hindi_mission.jpeg">                
            </a>
            
        </div>
        <div class="col-md-6">
            <a href="https://sarsspl.com/modimarts/franchise/landing_assets/mission.jpeg">
                <img src="https://sarsspl.com/modimarts/franchise/landing_assets/mission.jpeg">                
            </a>
    
        </div>
    </div>
</div>





<div id="values" class="tabcontent">
 <div class="row">
        <div class="col-md-6">
            <a href="https://sarsspl.com/modimarts/franchise/landing_assets/eng_guid.jpeg">
                <img src="https://sarsspl.com/modimarts/franchise/landing_assets/eng_guid.jpeg">                
            </a>
            
        </div>
        <div class="col-md-6">
            <a href="https://sarsspl.com/modimarts/franchise/landing_assets/hindi_opp.jpeg">
                <img src="https://sarsspl.com/modimarts/franchise/landing_assets/hindi_opp.jpeg">                
            </a>
    
        </div>
    </div>
    
</div>

<div id="people" class="tabcontent">

<div class="row">
        <div class="col-md-6">
        <a href="https://sarsspl.com/modimarts/franchise/landing_assets/eng_ajay_pro.jpeg">
            <img src="https://sarsspl.com/modimarts/franchise/landing_assets/eng_ajay_pro.jpeg">            
        </a>
            
        </div>
        <div class="col-md-6">
        <a href="https://sarsspl.com/modimarts/franchise/landing_assets/hindi_ajay_pro.jpeg">
            <img src="https://sarsspl.com/modimarts/franchise/landing_assets/hindi_ajay_pro.jpeg">    
        </a>
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <a href="https://sarsspl.com/modimarts/franchise/landing_assets/eng_rajesh_pro.jpeg">
                <img src="https://sarsspl.com/modimarts/franchise/landing_assets/eng_rajesh_pro.jpeg">
            </a>
                    
        </div>
        <div class="col-md-6">
            <a href="https://sarsspl.com/modimarts/franchise/landing_assets/hindi_rajesh_pro.jpeg">
                <img src="https://sarsspl.com/modimarts/franchise/landing_assets/hindi_rajesh_pro.jpeg">
            </a>
            
        </div>
    </div>
</div>

<div id="Consultants" class="tabcontent">
    <div class="row">
        <div class="col-md-6">
        <a href="https://sarsspl.com/modimarts/franchise/landing_assets/consult.jpeg">
            <img src="https://sarsspl.com/modimarts/franchise/landing_assets/consult.jpeg">
        </a>            
        

        </div>
        
        <div class="col-md-6">
            <a href="https://sarsspl.com/modimarts/franchise/landing_assets/hindi_guid.jpeg">
                <img src="https://sarsspl.com/modimarts/franchise/landing_assets/hindi_guid.jpeg">
            </a>            
            
        
        </div>
        
    </div>
</div>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'mission')" id="defaultOpen">Mission & Vision</button>
  <button class="tablinks" onclick="openCity(event, 'values')">Values</button>
  <button class="tablinks" onclick="openCity(event, 'people')">People Behind Company</button>
  <button class="tablinks" onclick="openCity(event, 'Consultants')">Consultants</button>
  
</div>

</div>
            <!--<div class="row_5">-->
            <!--    <img src="about1.jpg" style="width:450px; margin:15px;"> -->
                
            <!--</div> -->
            <!--<div class="row_5" style="padding-left: 200px; padding-top: 90px;">-->
            <!--    <ul class="list">-->
            <!--        <li ><a href="about.php?page=1" class="list_a">Mission & Vision</a></li>-->
            <!--        <li ><a href="about.php?page=2" class="list_a">Values</li></a>-->
            <!--        <li ><a href="#" class="list_a">People Behind Company</li></a>-->
            <!--        <li ><a href="about.php?page=4" class="list_a">Consultants</li></a>-->
            <!--      </ul>-->
            <!--</div>-->

        </div>       



        <div class="footer">
            
                <div class="contact_us">
                    <h3> Contact Us</h3>
                    <a href="https://maps.app.goo.gl/z7AF8ZCc91VN63h66" style="color:white;">
                    <label >Office Address: Allmart Building No: 2, Pragati Society, Near Pancholiya School, Mahavir Nagar, Kandivali West, Mumbai Maharashtra Bharat- 400067</label>
                    </a><br>
                    <label > Mobile: </label>
                    <label > 7710835444 </label><br>
                    <label > Email:</label>
                    <label >  enquiry.allmart@gmail.com  </label> <br>
                
                    
                    <div class="icons">
                        <label class="social_label">
                            <a href="https://www.facebook.com/AllmartWorld-111946707234321" class="social_a">
                            <i class="fa fa-facebook fa-lg"  aria-hidden="true"></i> 
                            </a>
                        </label>
                        
                        <label class="social_label">
                            <a href="https://www.instagram.com/modimart.world" class="social_a">
                            <i class="fa fa-instagram fa-lg" aria-hidden="true"></i> 
                            </a>
                        </label>
                        
    
                        <label class="social_label">
                            <a href="https://www.youtube.com/channel/UCmwbXGCoL4RnSuzEhbA71Aw" class="social_a">
                            <i class="fa fa-youtube-play fa-lg" aria-hidden="true"></i>
                            </a>
                        </label>
                        
    
                        <label class="social_label">
                            <a href="#" class="social_a">
                            <i class="fa fa-book fa-lg" aria-hidden="true"></i>
                            </a>
                        </label>
                    
    
                        <label class="social_label">
                            <a href="https://t.me/AllmartProduct" class="social_a">
                            <i class="fa fa-graduation-cap fa-lg" aria-hidden="true"></i>
                            </a>
                        </label>
                    </div>                
                        
                </div>    

                                   
        </div>




<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
          <div class="row">
              
              <div class="col-md-6">
                  <a href="https://sarsspl.com/modimarts/franchise/landing_assets/test1.jpeg">
                      <img src="https://sarsspl.com/modimarts/franchise/landing_assets/test1.jpeg">
                  </a>
              </div>
              
              <div class="col-md-6">
                  <a href="https://sarsspl.com/modimarts/franchise/landing_assets/test2.jpeg">
                      <img src="https://sarsspl.com/modimarts/franchise/landing_assets/test2.jpeg">
                  </a>
              </div>
              
          </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




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
    <!-- Bootstrap core JavaScript -->

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>


<!--https://api.chat-api.com/instance172450/sendFile?token=rmmecklghkytj5wu-->

</body>
</html>
