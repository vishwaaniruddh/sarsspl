<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/menu.php'); ?>


<style>
    *, *:before, *:after {
  box-sizing: border-box;
}

html {
  overflow-y: scroll;
}

body {
  background: #c1bdba;
  font-family: 'Titillium Web', sans-serif;
}

a {
  text-decoration: none;
  color: #1ab188;
  -webkit-transition: .5s ease;
  transition: .5s ease;
}
a:hover {
  color: #179b77;
}

.form {
  background: rgba(19, 35, 47, 0.9);
  padding: 40px;
  max-width: 900px;
  margin: 40px auto;
  border-radius: 4px;
  box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);
  overflow: hidden;
}

.tab-group {
  list-style: none;
  padding: 0;
  margin: 0 0 40px 0;
}
.tab-group:after {
  content: "";
  display: table;
  clear: both;
}
.tab-group li a {
  display: block;
  text-decoration: none;
  padding: 15px;
  background: rgba(160, 179, 176, 0.25);
  color: #a0b3b0;
  font-size: 20px;
  float: left;
  width: 50%;
  text-align: center;
  cursor: pointer;
  -webkit-transition: .5s ease;
  transition: .5s ease;
}
.tab-group li a:hover {
  background: #179b77;
  color: #ffffff;
}
.tab-group .active a {
  background: #1ab188;
  color: #ffffff;
}

.tab-content > div:last-child {
  display: none;
}

h1 {
  text-align: center;
  color: #ffffff;
  font-weight: 300;
  margin: 0 0 40px;
}

label {
  position: absolute;
  -webkit-transform: translateY(6px);
          transform: translateY(6px);
  left: 13px;
  color: rgba(255, 255, 255, 0.5);
  -webkit-transition: all 0.25s ease;
  transition: all 0.25s ease;
  -webkit-backface-visibility: hidden;
  pointer-events: none;
  font-size: 22px;
}
label .req {
  margin: 2px;
  color: #1ab188;
}

label.active {
  -webkit-transform: translateY(50px);
          transform: translateY(50px);
  left: 2px;
  font-size: 14px;
}
label.active .req {
  opacity: 0;
}

label.highlight {
  color: #ffffff;
}

input, textarea {
  font-size: 22px;
  display: block;
  width: 100%;
  height: 100%;
  padding: 5px 10px;
  background: none;
  background-image: none;
  border: 1px solid #a0b3b0;
  color: #ffffff;
  border-radius: 0;
  -webkit-transition: border-color .25s ease, box-shadow .25s ease;
  transition: border-color .25s ease, box-shadow .25s ease;
}
input:focus, textarea:focus {
  outline: 0;
  border-color: #1ab188;
}

textarea {
  border: 2px solid #a0b3b0;
  resize: vertical;
}

.field-wrap {
  position: relative;
  margin-bottom: 40px;
}

.top-row:after {
  content: "";
  display: table;
  clear: both;
}
.top-row > div {
  float: left;
  width: 48%;
  margin-right: 4%;
}
.top-row > div:last-child {
  margin: 0;
}

.button {
  border: 0;
  outline: none;
  border-radius: 0;
  padding: 15px 0;
  font-size: 2rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .1em;
  background: #1ab188;
  color: #ffffff;
  -webkit-transition: all 0.5s ease;
  transition: all 0.5s ease;
  -webkit-appearance: none;
}
.button:hover, .button:focus {
  background: #179b77;
}

.button-block {
  display: block;
  width: 100%;
}

.forgot {
  margin-top: -20px;
  text-align: right;
}
.tab-group li{
    padding-bottom:0 ! important;
}
input[type=checkbox]{
        width: 40px;
        height: 30px;
        display: inline-block;
}
.tnc{
    font-size:22px;
    color:white;
}

</style>


<?


$getclass_sql = mysqli_query($con,"select * from quiz_regdetails where id='".$_GET['rg']."'",$con);

$getclass_sql_result = mysqli_fetch_assoc($getclass_sql);

$senderclass=$getclass_sql_result['class'];

?>




<div class="form">
      <?
      
      echo $_SESSION['username'];
      
if($_SESSION['status']=='0' ){ ?>
    <div class="alert alert-danger" role="alert">
      <strong>Oh snap!</strong> Change a few things up and try submitting again.
    </div>

<? } ?>




      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          
              <? if($_GET['rg']){ ?>
<form action="register_process.php?rg=<? echo $_GET['rg']; ?>" method="post">
<?   }
    
    else{ ?>
    <form action="register_process.php" method="post">

<? }    ?>
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" name="name" required autocomplete="off" />
            </div>
        
            <div class="field-wrap">m
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text" name="lname" required autocomplete="off"/>
            </div>
          </div>
          

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" name="email" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              School<span class="req">*</span>
            </label>
            <input type="text" name="schname" required autocomplete="off"/>
          </div>
          
          
        <div class="top-row">
            <div class="field-wrap">
              <label>
                Class<span class="req">*</span>
              </label>
              
              
              
              
              
              
                <select name="class1" id="class1" class="form-control" <? if($senderclass) { echo 'disabled' ;}?>>
                    <option value="">Select Class</option>
                    <option value="6" <? if($senderclass =='6') { echo 'selected'; } ?> >VI</option>
                    <option value="7" <? if($senderclass =='7') { echo 'selected'; } ?>>VII</option>
                    <option value="8" <? if($senderclass =='8') { echo 'selected'; } ?>>VIII</option>
                    <option value="9" <? if($senderclass =='9') { echo 'selected'; } ?>>IX</option>
                    <option value="10" <? if($senderclass =='10') { echo 'selected'; } ?> >X</option>
                </select>
            
            
            
            </div>
        
            <div class="field-wrap">
              <label>
                Mobile<span class="req">*</span>
              </label>
              <input type="text" name="mobile" required autocomplete="off"/>
            </div>
          </div>
          
          
        <!--<div class="field-wrap">-->
        <!--    <label>-->
        <!--      Username<span class="req">*</span>-->
        <!--    </label>-->
        <!--    <input type="text" name="uname" required autocomplete="off"/>-->
        <!--  </div>-->
          
                    <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" name="password" id="password" required autocomplete="off"/>
          </div>
          
            <div class="field-wrap">
            <label>
              Confirm Password<span class="req">*</span>
            </label>
            <input type="password" name="cpassword" id="cpassword" required autocomplete="off"/>
          </div>
          
        <div class="field-wrap">
            <p class="tnc">
			<input type="checkbox" required="required"> I accept the  <a href="http://sarmicrosystems.in/quiztest/web/tnc.php">Terms of Use</a> &amp; <a href="http://sarmicrosystems.in/quiztest/web/privacy-policy.php">Privacy Policy</a>                
            </p>

		</div>
          
          <button type="submit" id="submit" class="button button-block"/>Get Started</button>
          
          </form>

        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        <div id="login">   
          <h1>Welcome Back!</h1>
         
             <? if($_GET['rg']){ ?>
<form action="login_process.php?rg=<? echo $_GET['rg']; ?>" method="post">
<?   }
    
    else{ ?>
    <form action="login_process.php" method="post">

<? }    ?>


            <div class="field-wrap">
            <label>
              Username<span class="req">*</span>
            </label>
            <input type="email" name="email" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" name="password" required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="forget_password.php">Forgot Password?</a></p>
          
          <button class="button button-block"/>Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->







<script>
    $('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }

});

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});



$("#cpassword").on("change",function(){
   

   var password = $("#password").val();
   var cpassword = $("#cpassword").val();
   
   if(password != cpassword){
       alert("confirm password doesnt match !");
   }
   
    
});




</script>







<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/footer.php'); ?>