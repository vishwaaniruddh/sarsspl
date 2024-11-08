<?php
include('head.php');
?>



<nav class="breadcrumb" aria-label="breadcrumbs">
 <div class="container-bg">


  <h1>Set Password</h1>
  <a href="/" title="Back to the frontpage">Home</a>

  <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
  <span>Set Password</span>



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
    	<?php
    	if(isset($_GET['auth'])&& isset($_GET['token'])){
        $email=base64_decode($_GET['auth']);
        $token=$_GET['token'];
        $check_sql = mysqli_query($con1,"select email from Registration where email = '".$email."' AND pass_token='".$token."'");
        if($check_sql_result = mysqli_fetch_assoc($check_sql)){
    	?>

      <form method="post" action="SetNewPassProcess.php"  accept-charset="UTF-8" autocomplete="off">
      <label for="CreatePassword" class="label--hidden">Password *</label>
      <input type="password" name="passwd" id="passwd" onkeyup="checksPassword(this.value)" autocomplete="off" placeholder="New Password" require >
      <label for="CreatePassword" class="label--hidden">Retype Password *</label>
      <input type="password"  id="rpass" name="cpass" placeholder="Confirm Password" autocomplete="off" require >
      <input type="hidden" value="<?=$email?>" name="email">
      <input type="hidden" value="<?=$token?>" name="pass_token">
      <span id="message"></span>
      <span class="error_message spassword_error" style="display: none;">Enter minimum 8 chars with atleast 1 number, lower, upper &amp; special(@#$%&!-_&amp;) char.</span>
      <p>
        <input type="submit" value="Set New Password" class="btn" name="UpdatePass" onclick="return checkpass()">
      </p>
      </form>
      <?php
    }
    else
    {
      ?>
      <p><b>Link Expired</b></p>
       <a href="/" class="btn btn-success">Go To Allmart</a>
      <?php
          }
   } else{?>
    <p><b>Invalid Authentication </b></p>
     <a href="/" class="btn btn-success">Go To Allmart</a>
  <?php } ?>

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
      
        var password= $('#passwd').val();
        var pattern = /^.*(?=.{8,20})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&!-_]).*$/;
    if(pattern.test(password)) {
       
        if ($('#passwd').val() == $('#rpass').val()) {
          return true; 
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
  </script>

  <script>
    function checksPassword(password){
    var pattern = /^.*(?=.{8,20})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&!-_]).*$/;
    if(!pattern.test(password)) {
    $(".spassword_error").show();
    }else
    {
    $(".spassword_error").hide();
    }
    }
  </script>

<?php include('footer.php');?>
