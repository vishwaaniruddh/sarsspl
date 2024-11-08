<!doctype html>
<html lang="en">
<head>
  <!-- Meta -->
  <meta charset="UTF-8">
  <meta name="author" content="Acura">
  <meta name="description" content="Acura - A Real Admin Template">
  <meta name="keywords" content="Acura, Admin Template, Admin, Premium, ThemeForest, Clean, Modern, Responsive">
  <!-- Responsive viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <!-- Title -->
  <title>Login | All mart User Panel</title>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="media/favicon.png">
  <!-- LessCSS Style --><!--
  <link rel="stylesheet/less" type="text/css" href="css/style.less">
  <script src="js/lessCSS/less-1.4.2.min.js" type="text/javascript"></script>-->
  <!-- Pure CSS Style --><!--
  <link rel="stylesheet" type="text/css" href="css/style.css">-->
  <!-- Pure CSS Style (minified) -->
  <link rel="stylesheet" type="text/css" href="css/style-min.css">
  <!-- WebFonts-->
  <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic|Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
  <!-- Font Awesome -->
  <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
  <script src="js/jquery-migrate/jquery-migrate-1.0.0.js"></script>
  <!-- Acura JS -->
  <script src="js/acura.js"></script>
  <!-- Tipsy jQuery -->
  <script src="js/tipsy/jquery.tipsy.js"></script>
  <link href="js/tipsy/tipsy.css" rel="stylesheet">
  <!-- Masked Input -->
  <script src="js/maskedinput/jquery.maskedinput.min.js"></script>
  <!-- Textarea Autosize -->
  <script src="js/autosize/jquery.autosize.min.js"></script>
  <!-- Textarea Counter -->
  <script src="js/nobleCount/jquery.NobleCount.min.js"></script>
  <!-- Uniform -->
  <link rel="stylesheet" href="js/uniform/theme/css/uniform.default.min.css">
  <script src="js/uniform/jquery.uniform.min.js"></script>
  <!-- jQuery UI -->
  <script src="js/jquery-ui-1.10.3/js/jquery-ui-1.10.3.custom.min.js"></script>
  <link rel="stylesheet" href="js/jquery-ui-1.10.3/css/no-theme/jquery-ui-1.10.3.custom.css">
  <!-- CLEditor -->
  <script src="js/cleditor/jquery.cleditor.min.js"></script>
  <link rel="stylesheet" href="js/cleditor/jquery.cleditor.css">
  <!-- jQuery textext -->
  <script src="js/tagsinput/jquery.tagsinput.min.js"></script>
  <link rel="stylesheet" href="js/tagsinput/jquery.tagsinput.css">
  <!-- flot -->
  <script src="js/flot/jquery.flot.min.js"></script>
  <script src="js/flot/jquery.flot.resize.js"></script>
  <script src="js/flot/jquery.flot.time.js"></script>
  <script src="js/flot/jquery.flot.threshold.js"></script>
  <script src="js/flot/jquery.flot.pie.js"></script>
  <script src="js/flot/jquery.flot.stack.js"></script>
  <!-- colResizable -->
  <script src="js/colResizable/colResizable-1.3.js"></script>
  <script src="js/dataTables/jquery.dataTables.min.js"></script>
  <!-- Full Calendar -->
  <script src="js/fullcalendar/fullcalendar.min.js"></script>
  <link rel="stylesheet" href="js/fullcalendar/fullcalendar.css">
  <!-- jquery UI Map -->
  <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
  <script src="js/jquery-ui-map/ui/jquery.ui.map.js" type="text/javascript"></script>
  <!-- jQuery Vector Map -->
  <script src="js/jqvmap-stable/jqvmap/jquery.vmap.js" type="text/javascript"></script>
  <script src="js/jqvmap-stable/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
  <script src="js/jqvmap-stable/jqvmap/maps/jquery.vmap.world.js"></script>
  <script src="js/jqvmap-stable/jqvmap/data/jquery.vmap.sampledata.js"></script>
  <!-- jQuery Knob -->
  <script src="js/jquery-knob/jquery.knob.js"></script>
  <!-- bxSlider -->
  <script src="js/bxSlider/jquery.bxslider.min.js"></script>
  <link href="js/bxSlider/jquery.bxslider.css" rel="stylesheet">
  <!-- Gritter -->
  <script src="js/gritter/js/jquery.gritter.min.js"></script>
  <link href="js/gritter/css/jquery.gritter.css" rel="stylesheet">
  <!-- Lightbox -->
  <script src="js/lightbox/js/lightbox-2.6.min.js"></script>
  <link href="js/lightbox/css/lightbox.css" rel="stylesheet">
  <!-- jGrowl-->
  <link rel="stylesheet" href="js/jGrowl/jquery.jgrowl.css" />
  <script src="js/jGrowl/jquery.jgrowl.min.js"></script>
  <!-- Circle Slider -->
  <link rel="stylesheet" href="js/circleSlider/css/website.css" />
  <script src="js/circleSlider/js/jquery.tinycircleslider.min.js"></script>
  <!-- Highlight.js -->
  <script src="js/highlight.js/highlight.pack.js"></script>
  <link rel="stylesheet" href="js/highlight.js/styles/github.css">
  <script>hljs.initHighlightingOnLoad();</script>
  <link href="http://fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet" type="text/css">
  <!-- Color Picker -->
  <link rel="stylesheet" media="screen" type="text/css" href="js/colorpicker/css/colorpicker.css" />
  <script type="text/javascript" src="js/colorpicker/js/colorpicker.js"></script>
</head>
<body>
  <!-- Login Widget -->
  <div class="login-widget login-login">
    <header class="login-header">
      <a href="#">
        <img src="media/acura-logo.png" alt="">
      </a>
    </header>
    <h4 class="typo login-title">Login </h4>
    <form action="mem_login.php">
      <div class="form-separator form-field">
        <div class="field-icon field-icon-left">
          <i class="i">&#xf007;</i>
          <input type="text" class="form form-full" placeholder="Username">
        </div>
      </div>
      <div class="form-separator form-field">
        <div class="field-icon field-icon-left">
          <i class="i">&#xf023;</i>
          <input type="password" class="form form-full" placeholder="Password">
        </div>
      </div>
      <div class="login-submit">
        <a href="#" class="pass-r-w">Problems?</a>
        <input value="Login" type="submit" class="btn btn-submit">
      </div>
    </form>
    <footer class="login-footer">
      Copyright © 2013 1cilckeguide.org.
    </footer>
  </div>
 
  <!-- Login Forget -->
  <div class="login-widget forget-pass">
    <header class="login-header">
      <a href="#">
        <img src="media/acura-logo.png" alt="">
      </a>
    </header>
    <h4 class="typo login-title">Forget Pass? <a href="#" class="login-w">Login?</a></h4>
    <form action="http://mitgux.com/shop/Acura/index.html">
      <div class="form-separator form-field">
        <div class="field-icon field-icon-left">
          <i class="i">&#xf0e0;</i>
          <input type="text" class="form form-full" placeholder="Email Recovery!">
        </div>
      </div>
      <div class="login-submit">
        <input value="Recover" type="submit" class="btn btn-submit">
      </div>
    </form>
    <footer class="login-footer">
     
    </footer>
  </div>
</body>
</html>