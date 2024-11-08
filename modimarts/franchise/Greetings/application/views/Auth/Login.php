<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content=".">
    <meta name="keywords" content="">
    <meta name="author" content="SAR">
    <title>Dashboard</title>
    <link rel="apple-touch-icon" href="<?=base_url('assets/')?>images/logo/logo.png">
    <link rel="shortcut icon" type="image/png" href="<?=base_url('assets/')?>images/logo/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/css/forms/icheck/custom.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/components.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/pages/login-register.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/style.css">
    <!-- END: Custom CSS-->

     <style>
      #load{
    /*display: none;*/
    width: 100%;
    height: 100%;
    position:fixed;
    z-index:9999;
    background:url("<?=base_url('assets/images/Circle.svg')?>") no-repeat center center rgba(0,0,0,0.25)
}
    </style>

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 1-column   blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div id="load"></div>
    <div class="app-content content">
      
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="row flexbox-container">
  <div class="col-12 d-flex align-items-center justify-content-center">
    <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
      <div class="card border-grey border-lighten-3 m-0">
        <div class="card-header border-0">
          <!-- <div class="card-title text-center">
            <div class="p-1"><img src="<?=base_url('assets/')?>images/logo/logo.png" alt="branding logo"></div>
          </div> -->
          <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Login</span>
          </h6>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form class="form-horizontal form-simple" method="POST" action="<?=base_url('Login/LoginAuth')?>" novalidate>
              <?=$this->session->flashdata('FlashMassage');?>
              <fieldset class="form-group position-relative has-icon-left mb-0">
                <input type="number" name="userName" class="form-control" id="user-name" autocomplete="off" placeholder="Your Mobile Number" required >
                <div class="form-control-position">
                  <i class="la la-user"></i>
                </div>
              </fieldset>
              <br/>
              <fieldset class="form-group position-relative has-icon-left">
                <input type="password" name="password" class="form-control" id="user-password" autocomplete="off" placeholder="Enter Password" required>
                <div class="form-control-position">
                  <i class="la la-key"></i>
                </div>
                <input type="hidden" value="<?=$this->input->get('redirecturl')?>" name="redircturl">
              </fieldset>
              <div class="form-group row">
                <!--<div class="col-sm-6 col-12 text-center text-sm-left">-->
                <!--  <fieldset>-->
                <!--    <input type="checkbox" id="remember-me" class="chk-remember">-->
                <!--    <label for="remember-me"> Remember Me</label>-->
                <!--  </fieldset>-->
                <!--</div>-->
                <!-- <div class="col-sm-6 col-12 text-center text-sm-right"><a href="recover-password.html"
                    class="card-link">Forgot Password?</a></div> -->
              </div>
              <button type="submit" class="btn btn-info btn-block"><i class="ft-unlock"></i> Login</button>
            </form>
          </div>
        </div>
        <!-- <div class="card-footer">
          <div class="">
            <p class="float-xl-left text-center m-0"><a href="recover-password.html" class="card-link">Recover
                password</a></p>
            <p class="float-xl-right text-center m-0">New to Moden Admin? <a href="register-simple.html"
                class="card-link">Sign Up</a></p>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</section>

        </div>
      </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="<?=base_url('assets/')?>vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url('assets/')?>vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="<?=base_url('assets/')?>vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?=base_url('assets/')?>js/core/app-menu.min.js"></script>
    <script src="<?=base_url('assets/')?>js/core/app.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?=base_url('assets/')?>js/scripts/forms/form-login-register.min.js"></script>
    <!-- END: Page JS-->

    <script>
      document.onreadystatechange = function () {
  var state = document.readyState
  if (state == 'interactive') {
       document.getElementById('contents').style.visibility="hidden";
  } else if (state == 'complete') {
      setTimeout(function(){
         document.getElementById('interactive');
         document.getElementById('load').style.visibility="hidden";
      },1000);
  }
}
    </script>

  </body>
  <!-- END: Body-->

</html>