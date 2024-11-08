<div class="footer-center " id="pavo-footer-center">
  <div class="container" style="margin-left: 0px;margin-right: 0px;width: 1355px;">
      <div class="row">
        <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="media">  	
            <div class="logo-about"> 
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 logo-holder" style="width: 372px;"> 
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo row">
                      <div class="col-md-1">
                          <a href="https://sarmicrosystems.in/oc1">
        		          <img  src="image/shopping-cart.png" style="width:100px;height: 43px;" alt="logo"/> 
        		     </div>
                      <div class="col-md-2">
                          <img src="image/merabazaar.png" style="width:200px;height: 63px;margin-top: -12px;margin-left:52px;" alt="logo"></a>
        		      </div>
                    </div>
                </div>
            </div>
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
                <div class="box-content">
                    <div class="description"> 
                        Sunil Complex, Near Mannubhai Jewellers,, Next to HSBC Bank, L.T. Road, Borivali ( West ), Gautam Nagar, Borivali West, Mumbai, 
                        Maharashtra 400092
                    </div>  
                    <ul class="list contact"> 
                        <li><span class="iconbox"><i class="fa fa-phone">&nbsp;</i>+022 2898 6153 </span></li>  
                        <li><span class="iconbox"><i class="fa fa-mobile-phone">&nbsp;</i>+844 123 456 79</span></li>  	
                        <li><span class="iconbox"><i class="fa fa-envelope">&nbsp;</i>info@merabazaar.com</span></li>  
                    </ul> 
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
<div class="footer-bottom " id="pavo-footer-bottom" style="padding-top: 0px;padding-bottom: 0px; background-color:white">
  <div class="container">
    <div class="container-inner">
     <div class="row">
      <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="box">
          <!--<div class="panel-heading">
            <h4 class="panel-title1">My Account</h4>
          </div>-->
          <ul class="list-unstyled list">
              <?php /*
              if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){?>
              <li><a class="" href="myacc.php">My Account</a></li>
              <li><a href="OrderHistory.php">Order History</a></li>
              <li><a href="WishList.php">Wish List</a></li>
              <li><a href="trackorder.php">Delivery Information</a></li>
             <!-- <li><a href="#">Specials</a></li>-->
              <?php }else{ ?>
               <li><a onclick="popup('1','myaccount')">My Account</a></li>
               <li><a onclick="popup('1','myaccount')">Order History</a></li>
               <li><a onclick="popup('1','myaccount')">Wish List</a></li>
               <li><a onclick="popup('1','myaccount')">Delivery Information</a></li>
              <!-- <li><a href="login.php">Specials</a></li>-->
              <?php } */?>
          </ul>
        </div>
      </div>
      <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="box">
          <div class="panel-heading">
            <h4 class="panel-title1">Information</h4>
          </div>
          <ul class="list-unstyled list">
            <li><a onclick="popup('2','')">About Us</a></li>
            <!--<li><a onclick="popup('3','')">Newsletter</a></li>-->
            <li><a onclick="popup('4','')">Privacy Policy</a></li>
            <li><a onclick="popup('5','')">Terms &amp; Conditions</a></li>
          </ul>
        </div>
      </div>
      <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="box">
          <!--<div class="panel-heading">
            <h4 class="panel-title1">Customer Service</h4>
          </div>-->
          <ul class="list-unstyled list">
            <!--<li><a  onclick="popup('5','')">Contact Us</a></li>-->
            <li><a onclick="popup('6','')">Returns</a></li>
            <!--<li><a onclick="popup('7','')">Site Map</a></li>-->
            <!--<li><a onclick="popup('8','')">Brands</a></li>-->
              <?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){?>
            <li><a onclick="popup('9','')">Gift Certificates</a></li>
            <?php }else{ ?>
             <li><a  onclick="popup('1','myaccount')">Gift Certificates</a></li>
             <?php } ?>
          </ul>
        </div>
      </div>
      <!--<div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="box contact-us">
            <div class="panel-heading">
              <h4 class="panel-title1">Business Hours</h4>
            </div>
              <div class="box-content">
              <ul class="list-unstyled list">
                 <li>Mon - Fri: ---------------8am - 5pm</li>
                 <li>Sat: ----------------------8am - 11am</li> 
                 <li>Sun: ------------------------- Closed</li>
                 <li>We work all the holidays</li>
              </ul>
             </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</div>
<!-- ===================login pop up window  (start) =============================-->
 <!--  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
    <!--   <link href="loginPopCss.css" rel="stylesheet" />
       <link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
                <script>
                    function popup(id,page_redirect){
                        document.getElementById('id01').style.display='block';
                        document.getElementById('input-redirct').value=page_redirect;
                        if(id==1){
                            $("#HD_login").show();
                            $("#HD_about").hide();
                            $("#HD_PrivacyPolicy").hide();
                            $("#HD_TermsConditions").hide();
                            $("#HD_OrderStatus").hide();
                            $("#HD_Guest").hide();
                            $("#login_Heading").show();
                            $("#OPT_Heading").hide();
                        }
                        else if(id==2)
                        {
                         $("#HD_login").hide();
                         $("#HD_about").show();
                         $("#HD_PrivacyPolicy").hide();
                         $("#HD_TermsConditions").hide();
                         $("#HD_Guest").hide();
                         $("#HD_OrderStatus").hide();
                         $("#login_Heading").show();
                         $("#OPT_Heading").hide();
                        }
                        else if(id==3)
                         {
                             $("#HD_login").hide();
                             $("#HD_about").hide();
                             $("#HD_OrderStatus").hide();
                             $("#HD_PrivacyPolicy").hide();
                             $("#HD_TermsConditions").hide();
                             $("#HD_Guest").hide();
                             $("#login_Heading").show();
                             $("#OPT_Heading").hide();
                         }
                         else if(id==4)
                        {
                            $("#HD_login").hide();
                            $("#HD_about").hide();
                            $("#HD_OrderStatus").hide();
                            $("#HD_PrivacyPolicy").show();
                            $("#HD_TermsConditions").hide();
                            $("#HD_Guest").hide();
                            $("#login_Heading").show();
                            $("#OPT_Heading").hide();
                        }
                        else if(id==5)
                         {
                            $("#HD_login").hide();
                            $("#HD_about").hide();
                            $("#HD_OrderStatus").hide();
                            $("#HD_PrivacyPolicy").hide();
                            $("#HD_TermsConditions").show();
                            $("#HD_Guest").hide();
                            $("#login_Heading").show();
                            $("#OPT_Heading").hide();
                         }     
                        else if(id==8)
                         {
                             $("#HD_login").hide();
                             $("#HD_about").hide();
                             $("#HD_OrderStatus").hide();
                             $("#HD_PrivacyPolicy").hide();
                             $("#HD_TermsConditions").hide();
                             $("#HD_Guest").show();
                             $("#login_Heading").hide();
                             $("#OPT_Heading").show();
                         }         
                          else if(id==9)
                         {
                             $("#HD_login").hide();
                             $("#HD_about").hide();
                             $("#HD_PrivacyPolicy").hide();
                             $("#HD_TermsConditions").hide();
                             $("#HD_OrderStatus").hide();
                             $("#HD_Guest").hide();
                             $("#login_Heading").hide();
                             $("#OPT_Heading").hide();
                             $("#forgotpassword").show();
                             $("#forgot_Heading").show(); 
                         }     
                          else if(id==10)
                         {
                             $("#HD_login").hide();
                             $("#HD_about").hide();
                             $("#HD_PrivacyPolicy").hide();
                             $("#HD_TermsConditions").hide();
                             $("#HD_OrderStatus").show();
                             $("#HD_Guest").hide();
                             $("#login_Heading").hide();
                             $("#OPT_Heading").hide();
                             $("#OrderStaus_Heading").show();
                         }   
                        else{
                            }
                    }
                    function popupclose(){
                        document.getElementById('id01').style.display='none';
                        window.open("index.php","_self");
                    }
                </script>
<div class="w3-container" >
 <!-- <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">Open Animated Modal</button>-->

  <div id="id01" class="w3-modal" style="z-index:39">
    <div class="w3-modal-content w3-animate-zoom w3-card-4" style="width: 470px;border-radius: 30px;height: 321px;">
      <header class="w3-container w3-teal" style="background-color:#0acefb!important;border-top-left-radius: 20px;border-top-right-radius: 18px; "> 
        <span onclick="popupclose()" class="w3-button1 w3-display-topright" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" style="font-size: x-large;left: 419px;right: 29px;color: #040404;font-weight: bold;top:9px;cursor: pointer;">&times;</span>
        <h2 style="text-align:center" id="login_Heading" >Login Form</h2>
        <h2 style="text-align:center;display:none" id="OPT_Heading" >Enter OPT / Password</h2>
        <h2 style="text-align:center;display:none" id="forgot_Heading" >Retrieve Password</h2>
        <h2 style="text-align:center;display:none" id="OrderStaus_Heading" >Order Status</h2>
      </header><br />
      <div class="w3-container">
        <div class="row" id="HD_login">     
               <form action="process_login.php" method="post" enctype="multipart/form-data" style="width: 486px;margin-left: 34px;height: 281px;">
              <script type="text/javascript">
                $(document).ready(function() {
                $("#input-email").val("");
                $("#input-password").val("");
            });
        </script>
              <div class="form-group">
                <label class="control-label" for="input-email" style="margin-left: 17px;">User-ID</label>
                <input type="hidden" id="input-redirct" name="input-redirct" value=" "/>
                <input type="text" name="email" value="" placeholder="E-Mail Address / Mobile Number" id="input-email" class="form-control" style="width: 400px;margin-top: 0px;border-radius: 36px;border: 1px solid #9c9898;background-color: #f7f6f6;"/>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-password" style="margin-left: 17px;">Password</label>
                <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" style="width: 400px;margin-top: 0px;border-radius: 36px;border: 1px solid #9c9898;background-color: #f7f6f6;"/>
                <span toggle="#input-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
              </div>
              <style>
                  .field-icon {
                   float: left;
                   margin-left: 369px;
                   margin-top: -43px;
                   position: relative;
                   z-index: 2;
                   font-size: medium;
                }
              </style>
              <script>
                  /* Ruchi : 1 july
                  $(".toggle-password").click(function() {
                    $(this).toggleClass("fa-eye fa-eye-slash");
                    var input = $($(this).attr("toggle"));
                    if (input.attr("type") == "password") {
                    input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }
                    });
                    */
                    $(".toggle-password").mouseup(function() {
                    $(this).toggleClass("fa-eye fa-eye-slash");
                    var input = $($(this).attr("toggle"));
                    input.attr("type", "password");
                    });
                     $(".toggle-password").mousedown(function() {
                    $(this).toggleClass("fa-eye fa-eye-slash");
                    var input = $($(this).attr("toggle"));
                    input.attr("type", "text");
                    });
              </script>
              <input type="button" value="Login" id="button-login" class="btn btn-primary" style="margin-left: 37px;border-radius: 41px;height: 38px;width: 140px;outline: none;" onclick="logfnn();"/>
              <input type="button" value="Sign up" id="signup" class="btn btn-primary" style="margin-left: 44px;border-radius: 41px;height: 38px;width: 140px;outline: none;" onclick="sign()"/>
             <br />  <a style="margin-left: 146px;" onclick="popup('9','')">Forgot Password ?</a>
            </form>
          </div>
       </div>
      <!--</div>
      </div> </div>-->
      <div id="forgotpassword" style="display:none">
          <form action="forgotpass.php" method="post" enctype="multipart/form-data" class="form-horizontal">
            <fieldset>
                <p style="margin: 18px 174px 14px;font-size: medium;width: max-content;">Enter Your User-ID </p>
              <div class="form-group required">
                <!--<label class="col-sm-2 control-label" for="input-email">E-Mail Address</label>-->
                <div class="col-sm-10">
                  <input type="text" name="email" value="" placeholder="E-Mail Address /Mobile No." id="input-email" class="form-control" style="width: 400px;margin-top: 21px;border-radius: 36px;border: 1px solid #9c9898;background-color: #f7f6f6;margin-left: 39px;" required/>
                </div>
              </div>
            </fieldset>
        <div class="buttons clearfix">
          <div style="margin-left: 196px;">
            <input type="submit" value="Submit" style="border-radius: 15px;width: 122px;margin-left: -17px;" class="btn btn-primary" />
          </div>
        </div>
      </form>
      </div>   
      <div id="HD_about" style="display:none">
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
      <div id="HD_PrivacyPolicy" style="display:none">
          <h1>
              HD_PrivacyPolicy
          </h1>
      </div> 
      <div id="HD_OrderStatus" style="display:none">
        <div class="container">
            <div class="row">                
                <div id="content" class="col-sm-12">   
                    <?php 
                      include ('generatepdf/report.php');
                      include("sendmailwithattachment.php");
                    ?>
                    <h2 style="color:red;margin-left: 131px;margin-top: 0px;">Congratulations !!! </h2>
                    <h4  style="margin-left: 37px;"> Your order has been successfully processed !</h4>
                    
                    <hr style="width: 440px;margin-left: 0px;"></hr>
                    <h3 id="OrderNumber" style="margin-left:140px"></h3>
                    <hr style="width: 440px;margin-left: 0px;"></hr> 
                    <h5 style="margin-left:24px">You will receive an email !
                      Thanks for shopping with us online! </h5>
                </div>
            </div>
        </div>
    </div> 
    <div id="HD_TermsConditions" style="display:none">
        <h1>
            HD_Terms&Conditions
        </h1>
      </div>
      <div id="HD_Guest" style="margin-left: 120px;" style="display:none">
        <div class="row" style="margin-left: 28px;">
           <div class="col-sm-3">
             <div class="radio">
               <label><input type="radio" name="chk_guest" class="className" value="OTP" checked="checked" >OTP</label>  
             </div>  
           </div>
        <div class="col-sm-3">
         <div class="radio">
           <label>  <input type="radio" name="chk_guest" class="className"  value="Password"> Password</label>
         </div>
        </div>
    </div>
    <div class="form-group" id="HD_Enter_opt">
       <input type="text" name="EnterOTP"  id="EnterOTP" placeholder="Enter OPT"  class="form-control"  style="margin-bottom: 0px;height: 38px;width: 322px;">
    </div>
   <input type="hidden" id="randomNo" name="randomNo">
   <input type="hidden" id="emailsend" name="emailsend">
   <input type="hidden" id="mobisend" name="mobisend">
      <div class="form-group" id="HD_Enter_pass" style="display:none">
          <input type="text" id="EnterPass" name="EnterPass"  placeholder="Enter Password"  class="form-control"  style="margin-bottom: 0px;height: 38px;width: 322px;">
      </div>
        <input type="button" value="Submit" onclick="registerfunction()"  class="btn btn-primary"  style="margin-left: 49px;border-radius: 7px;height: 33px;margin-bottom: 10px;width: 214px;">
      </div>   
<script type="text/javascript">
function sign()
{
    window.open("Register.php","_self");
}
function logfnn()
{
    //alert('login');
      var pgredirct=document.getElementById('input-redirct').value;
      /* Ruchi */
      pgredirct ='index';
      /* Ruchi */
     var eml=document.getElementById('input-email').value;
    var passw=document.getElementById('input-password').value;
     //alert(pgredirct);
    $.ajax({
        url: 'loginprocessnew.php',
        type: 'post',
        data:'email='+eml+'&password='+passw,
        success: function(msg) {
         //  alert(msg)
            if (msg==1) {
               //swal("Login Succsessfullyy !!!");
                
                swal({
                      title: "Login Succsessfully !!!",
                      text: " ",
                      icon: "success",
                      closeOnConfirm: false,
                      buttons: false
                    });
 
                 if(pgredirct!=""){
                     location = pgredirct+'.php';
                 }else{
                     location = index+'.php';
                 }
            } else {
                swal( "Oop's something went wrong...");
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

