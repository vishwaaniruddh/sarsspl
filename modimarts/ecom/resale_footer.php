<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     
<div class="footer-center " id="pavo-footer-center">
  <div class="container" style="margin-left: 0px;margin-right: 0px;width: 1355px;">
      <div class="row">
          
        <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="media">  				<div class="logo-about">  
          
          
          
           <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 logo-holder" style="width: 372px;"> 
          <!-- ============================================================= LOGO ============================================================= -->
          <div class="logo row">
              <div class="col-md-1">
                  <a href="https://sarmicrosystems.in/oc1">
		     <img  src="image/shopping-cart.png" style="width:100px;height: 43px;" alt="logo"/> 
		     </div>
              <div class="col-md-2">
                  <img src="image/merabazaar.png" style="width:200px;height: 63px;margin-top: -12px;margin-left:52px;" alt="logo"> </a>
		      </div>
              
          </div></div></div>
          
          
          
          
          
			<!-- <img  src="image/shopping-cart.png" style="width:100px;height: 43px;" alt="logo"/> 	<img alt="icon" src="image/merabazaar.png" style="width:100%;height:94px;"> -->	</div>    
				<div class="media-body">  				
				<div class="ourservice-content">  					
				<p>Clothes, electronics, accessories - whatever your need for the hour maybe, Merabazaar, your favorite online shopping site, is sure to spoil you with a wide range of products.</p>  		
				</div>  	
				</div>    		
			</div>      
		</div>
        <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          
<div class=" pav-newsletter" id="newsletter_956013334">
   
		<form  class="formNewLestter" >
            <div class="panel-heading"><h4 class="panel-title">Newsletter</h4></div>
            <div class="box-content">
                <div class="description"><!---<p>A newsletter is a regularly distributed publication that is generally about one main topic of interest to its subscribers.</p>---></div>
                <div class="input-group">
                    <input type="email" class="form-control email" id="email"  style="background-color:white;border-color:red"  placeholder="Your email address" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                	<div class="input-group-btn">
                    	<button type="button" style="border-color:red" onclick="newsletter()" class="btn btn-custom" value="Subscribe">
                    	<span class="fa fa-paper-plane"></span></button>
                	</div>
                	
                </div>
             
                
                            </div>	
                            
		</form>
</div>
<script type="text/javascript">


function newsletter(){

    var email=document.getElementById("email").value;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email)) {
    swal('Please provide a valid email address');
    email.focus;
   
 }
 else{
 
            $.ajax({
					type:'POST',    
					url:'Newsletter.php',
					data:'email='+email,
					success: function(msg)
					{
                      //alert(msg);
                      if(msg==3){
                            swal("Error!", "This Email-ID Is Allready Exist !", "error");
                      }else{
			              if(msg==1){
                             swal("Done!", "You Registered successfully !", "success");
                             document.getElementById("email").value="";
                             }
                             else{
                            swal("Error!", "You clicked the button!", "error"); 
                             }
                           }
					    
					}
				});
}
}

</script>    

</div>
                  <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="box pav-custom">              
              <div class="panel-heading">
                <h4 class="panel-title" >Contact Us</h4>
              </div>
              <div class="box-content">
                <div class="box-content"><div class="description"> Sunil Complex, Near Mannubhai Jewellers,, Next to HSBC Bank, L.T. Road, Borivali ( West ), Gautam Nagar, Borivali West, Mumbai, 
                Maharashtra 400092</div>  
                <ul class="list contact">  		<li><span class="iconbox"><i class="fa fa-phone">&nbsp;</i>+022 2898 6153 </span></li>  
                <li><span class="iconbox"><i class="fa fa-mobile-phone">&nbsp;</i>+844 123 456 79</span></li>  	
                <li><span class="iconbox"><i class="fa fa-envelope">&nbsp;</i>info@merabazaar.com</span></li>  	</ul> 
                </div>            
                </div>
            </div>
          </div>        
        
                <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="box pav-custom">
            <div class="panel-heading">
              <h4 class="panel-title">follow us</h4>
            </div>
            
              <div class="box-content">
              <ul class="list folow">  				
              <li><i class="fa fa-facebook"> </i><a data-original-title="Facebook" data-placement="top" target="_blank" href="https://www.facebook.com/Merabazaar-1362889730447213/" title=""><span>Facebook</span> </a></li>  	
              <li><i class="fa fa-twitter"> </i><a data-original-title="Twitter" data-placement="top" target="_blank" href="https://twitter.com/Merabazaar12" title=""><span>Twitter</span> </a></li>  
              <li><i class="fa fa-google-plus"> </i><a data-original-title="Google +" data-placement="top" target="_blank" href="https://plus.google.com/u/0/112130250176171864474" title=""><span>Google +</span> </a></li> 
              <li><i class="fa fa-youtube"> </i><a data-original-title="Youtube" data-placement="top" target="_blank" href="https://www.youtube.com/channel/UCuPwvDJ5w9bxepuJNOFZZHQ" title=""><span>Youtube</span> </a></li>  		
               <li><i class="fa fa-instagram"> </i><a data-original-title="Instagram" data-placement="top" target="_blank" href="https://www.youtube.com/channel/UCuPwvDJ5w9bxepuJNOFZZHQ" title=""><span>Instagram</span> </a></li>  				
             </ul>           
             </div>
           
          </div>
          
        </div>        
              </div>
  </div>
</div>
<!--    <div class="footer-bottom " id="pavo-footer-bottom" style="padding-top: 0px;padding-bottom: 0px; background-color:white">
  <div class="container">
    <div class="container-inner">
    <div class="row">
      <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="box">
          <div class="panel-heading">
            <h4 class="panel-title1">My Account</h4>
          </div>
          <ul class="list-unstyled list">
              <?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){?>
              <li><a class="" href="myacc.php">My Account</a></li>
              <li><a href="OrderHistory.php">Order History</a></li>
              <li><a href="WishList.php">Wish List</a></li>
              <li><a href="trackorder.php">Delivery Information</a></li>
                     
              
           
              
              <?php }else{ ?>
               <li><a onclick="popup('1')">My Account</a></li>
               <li><a onclick="popup('1')">Order History</a></li>
               <li><a onclick="popup('1')">Wish List</a></li>
               <li><a onclick="popup('1')">Delivery Information</a></li>
             
               
              <?php } ?>
              
           
          </ul>
        </div>
      </div>
            <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="box">
          <div class="panel-heading">
            <h4 class="panel-title1">Information</h4>
          </div>
          <ul class="list-unstyled list">
               
                        <li><a onclick="popup('2')">About Us</a></li>
                        <li><a onclick="popup('3')">Newsletter</a></li>
                        <li><a onclick="popup('4')">Privacy Policy</a></li>
                        <li><a onclick="popup('5')">Terms &amp; Conditions</a></li>
                      </ul>
        </div>
      </div>
            
      <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="box">
          <div class="panel-heading">
            <h4 class="panel-title1">Customer Service</h4>
          </div>
          <ul class="list-unstyled list">
              
              
              
            <li><a  onclick="popup('5')">Contact Us</a></li>
            <li><a onclick="popup('6')">Returns</a></li>
            <li><a onclick="popup('7')">Site Map</a></li>
             <li><a onclick="popup('8')">Brands</a></li>
             
              <?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){?>
             
            <li><a onclick="popup('9')">Gift Certificates</a></li>
            <?php }else{ ?>
             <li><a  onclick="popup('1')">Gift Certificates</a></li>
             <?php } ?>
            
          </ul>
        </div>
      </div>


              <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="box contact-us">
            <div class="panel-heading">
              <h4 class="panel-title1">Business Hours</h4>
            </div>
              <div class="box-content">
              <ul class="list-unstyled list">  			            <li>Mon - Fri: ---------------8am - 5pm</li>  			            <li>Sat: ----------------------8am - 11am</li>  			            <li>Sun: ------------------------- Closed</li>  			            <li>We work all the holidays</li>  			        </ul>            </div>
          </div>
        </div>        
      
      </div>
    </div>
  </div>
</div>

-->





<!-- ===================login pop up window  (start) =============================-->
 <!--  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
             
    <!--   <link href="loginPopCss.css" rel="stylesheet" />
       <link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
    
                <script>
                    function popup(id){
                        document.getElementById('id01').style.display='block';
                 
                        if(id==1){
                                 $("#HD_login").show();
                                 $("#HD_about").hide();
                                 $("#HD_PrivacyPolicy").hide();
                                 $("#HD_TermsConditions").hide();
                               
                                 }
                                 else if(id==2)
                                     {
                                     $("#HD_login").hide();
                                     $("#HD_about").show();
                                     $("#HD_PrivacyPolicy").hide();
                                     $("#HD_TermsConditions").hide();
                                    
                                     }
                        else if(id==3)
                                     {
                                     $("#HD_login").hide();
                                     $("#HD_about").hide();
                                    
                                     $("#HD_PrivacyPolicy").hide();
                                     $("#HD_TermsConditions").hide();
                                    
                                     }
                         else if(id==4)
                                     {
                                     $("#HD_login").hide();
                                     $("#HD_about").hide();
                                     $("#HD_PrivacyPolicy").show();
                                     $("#HD_TermsConditions").hide();
                                    
                                     }
                        else if(id==5)
                                     {
                                     $("#HD_login").hide();
                                     $("#HD_about").hide();
                                     $("#HD_PrivacyPolicy").hide();
                                     $("#HD_TermsConditions").show();
                                     }             
                              else{
                                  
                              }
            
                        
                    }
                    function popupclose(){
                        
                        document.getElementById('id01').style.display='none';
                      //  window.open("index.php","_self");
                    }
                    
                </script>
                
          
          



<div class="w3-container" >

 <!-- <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">Open Animated Modal</button>-->

  <div id="id01" class="w3-modal" style="z-index:39">
    <div class="w3-modal-content w3-animate-zoom w3-card-4" style="width: 559px;border-radius: 30px;">
      <header class="w3-container w3-teal" style="background-color:#0acefb!important;border-top-left-radius: 20px;border-top-right-radius: 18px; "> 
        <span onclick="popupclose()" 
        class="w3-button w3-display-topright"  style="left: 509px;right: 29px;">&times;</span>
       <h2 style="text-align:center">Login Form</h2>
      </header><br />
      <div class="w3-container">
        
        
        
        
        <div class="row" id="HD_login">     
              <!-- <div id="content" class="col-sm-9">      <div class="row">
        <div class="col-sm-4">
         
        </div>
        <div class="col-sm-8">
          <div class="well">-->
           
            
        <!--    <img src="image/TLlogin.gif" alt="Login" height="72" style="align:center;width: 170px;margin-left: 18px;height: 93px;" width="72"/>-->
            <form action="resale_process_login.php" method="post" enctype="multipart/form-data" style="width: 486px;margin-left: 34px;height: 281px;">
             
              <script type="text/javascript">
$(document).ready(function() {
  
       $("#input-email").val("");
       $("#input-password").val("");
});

</script>
              
             
             
              <div class="form-group">
                <label class="control-label" for="input-email">E-Mail Address / Mobile Number</label>
                <input type="text" name="email" value="" placeholder="E-Mail Address / Mobile Number" id="input-email" class="form-control" style="margin-top: 0px;border-radius: 36px;border: 1px solid #9c9898;background-color: #ececec;"/>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-password">Password</label>
                <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" style="margin-top: 0px;border-radius: 36px;border: 1px solid #9c9898;background-color: #ececec;"/>
                <a href="resale_forgot_pass.php">Forgotten Password</a>
              </div>
              <input type="button" value="Login" id="button-login" class="btn btn-primary" style="margin-left: 83px;border-radius: 41px;height: 38px;width: 140px;" onclick="logfnn();"/>
              <input type="button" value="Sign up" id="signup" class="btn btn-primary" style="margin-left: 44px;border-radius: 41px;height: 38px;width: 140px;" onclick="sign()"/>
                          </form>
          </div>
       </div>
      <!--</div>
      </div> </div>-->
      
      
      <div id="HD_about">
          <h1>About US</h1>
          <h3>
              Sunil Complex, Near Mannubhai Jewellers,
              Next to HSBC Bank,
              L.T. Road,
              Borivali ( West ),
              Gautam Nagar,
              Borivali West,
              Mumbai,
              Maharashtra 400092
          </h3>
          
      </div>   
     
     
      <div id="HD_PrivacyPolicy">
          <h1>
              HD_PrivacyPolicy
          </h1>
          
      </div> 
      
      
      <div id="HD_TermsConditions">
          <h1>
            HD_Terms&Conditions
          </h1>
          
      </div>
      
      
      
        
  
<script type="text/javascript">

function sign()
{
    window.open("resale_Register.php","_self");
}


function logfnn()
{
    var eml=document.getElementById('input-email').value;
    var passw=document.getElementById('input-password').value;
 
    $.ajax({
        url: 'resale_process_login.php',
        type: 'post',
        data:'email='+eml+'&password='+passw,
        success: function(msg) {
        // alert(msg)
            if (msg==0)
            {
               swal("Error");
            }
            else
            { swal({
                      title: "Login Succsessfully !!!",
                      text: "You clicked the button!",
                      icon: "success",
                      button: "OK!",
                    });
  location = 'resale_index.php';
                
            }
        }
    });
}
</script>
        
      </div>
     <!-- <footer class="w3-container w3-teal" style="background-color:#0acefb!important">
        <p>Merabazzar</p>
      </footer>-->
    </div>
  </div>
</div>

<!-- ===================login pop up window (End) =============================-->

