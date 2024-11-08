<?php
include('head.php');
?>

<?php 
// var_dump($_SESSION['refcode']);
 ?>

<nav class="breadcrumb" aria-label="breadcrumbs">
 <div class="container-bg">


  <h1>Create Account</h1>
  <a href="/" title="Back to the frontpage">Home</a>

  <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
  <span>Create Account</span>



 </div>
</nav>

  <main class=" main-content  ">

  <div class="dt-sc-hr-invisible-small"></div>








  <div class="wrapper">
    <div class="grid-uniform">
      <div class="grid__item">

        <div class="container-bg">


         <div class="grid__item">
           <div class="user-account">
  <div class="grid__item small--text-center">
    <div class="register-form">

      <form method="post" action="process_register.php"  accept-charset="UTF-8" autocomplete="off">


      <label for="FirstName" class="label--hidden">First Name *</label>
      <input type="text" name="fname" id="fname" placeholder="First Name" onKeyPress="return ValidateAlpha(event);"  autocapitalize="words" autofocus autocomplete="off" required>

      <label for="LastName" class="label--hidden">Last Name *</label>
      <input type="text" name="lname" id="lname" placeholder="Last Name" onKeyPress="return ValidateAlpha(event);"  autocapitalize="words" autocomplete="off" required>

      <label for="Email" class="label--hidden">Email *</label>
      <input type="email" name="emailid" id="emailid" placeholder="Email"  autocorrect="off"  autocomplete="off" autocapitalize="off" required>
      <label for="mob" class="label--hidden">Mobile Number *</label>
      <input type="number" name="mob" id="mob" placeholder="Mobile Number" onkeydown="return ismob()" pattern="[1-9]{1}[0-9]{9}" autocomplete="off"  autocorrect="off" autocapitalize="off" required>
      <!-- <input type="radio" name="radio" value="Male" id="rd1" checked=""><i></i>Male
      <input type="radio" name="radio" id="rd2" value="Female"><i></i>Female
 -->
      <label for="CreatePassword" class="label--hidden">Password *</label>
      <input type="password" name="passwd" id="passwd" onkeyup="checksPassword(this.value)" autocomplete="off" placeholder="Password" required >
      <label for="CreatePassword" class="label--hidden">Retype Password *</label>
      <input type="password"  id="rpass" placeholder="Retype Password" autocomplete="off" required >
      <span id="message"></span>
      <span class="error_message spassword_error" style="display: none;">Enter minimum 8 chars with atleast 1 number, lowercase, uppercase</span>
      <p>
        <input type="submit" value="Create" class="btn" onclick="return checkpass()">
      </p>
      <a href="index.php">Return to Store</a>

      </form>

    </div>
  </div>
</div>
         </div>


        </div>

      </div>
    </div>
  </div>

  <div class="dt-sc-hr-invisible-large"></div>

  </main>
  <script>
    $('#rpass').on('keyup', function () {
  if ($('#passwd').val() == $('#rpass').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
    
  </script>

  <script>
    function checkpass()
    {
      if($('#fname').val()!='')
      {
        var password= $('#passwd').val();
        var pattern = /^.*(?=.{8,20})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;
    if(pattern.test(password)) {
       
        if ($('#passwd').val() == $('#rpass').val()) {
          var mobNum=$('#mob').val();

          var filter = /^\d*(?:\.\d{1,2})?$/;

          if (filter.test(mobNum)) {
            if(mobNum.length==10){
              return true;
                  
             } else {
                alert('Please put 10 digit mobile number');
               return false;
              }
            }
            else {
              alert('Not a valid number');              
              return false;
           }
        

    }
    else
    {
      alert('Please Enter Same password on confirm password')
      return false;
    }
  }
  else
  {
    alert('Please Enter Valid password')
      return false;
  }

      }
      else
      {
       alert('Please Enter First Name')
      return false;
      }
      
  }
  </script>

  <script>
    function checksPassword(password){
    var pattern = /^.*(?=.{8,20})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;
    if(!pattern.test(password)) {
    $(".spassword_error").show();
    }else
    {
    $(".spassword_error").hide();
    }
    }
  </script>

<!--   <script type="text/javascript">
  jQuery(document).ready(function () {
      jQuery("#mob").keypress(function (e) {
         var length = jQuery(this).val().length;
       if(length > 9) {
            return false;
       } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
       } else if((length == 0) && (e.which == 48)) {
            return false;
       }
      });
    });
</script> -->

  <script>        
           function ismob(){          
            jQuery("#mob").keypress(function (e) {
         var length = jQuery(this).val().length;
       if(length > 9) {
            return false;
       } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
       } else if((length == 0) && (e.which == 48)) {
            return false;
       }
      });
        }
       </script>

<?php include('footer.php');?>