	<?php
	include ("config.php");
	?>
	<!DOCTYPE html>
	<!--[if IE 7 ]>
	<html lang="en" class="no-js ie7"> <![endif]-->
	<!--[if IE 8 ]>
	<html lang="en" class="no-js ie8"> <![endif]-->
	<!--[if IE 9 ]>
	<html lang="en" class="no-js ie9"> <![endif]-->
	<!--[if (gt IE 9)|!(IE)]><!-->
	<html lang="en" class="no-js"> <!--<![endif]-->
	<!-- =========================================
	head
	========================================== -->

	<head>
	    <!-- =========================================
	    Basic
	    ========================================== -->
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	    <title>Login</title>
	    <meta name="keywords" content="fontanero, HTML5, CSS3, responsive, Template"/>
	    <meta name="author" content="Cloud Software Solution Ltd."/>
	    <meta name="description" content="fontanero- Responsive HTML5/CSS3 Template"/>

	    <!-- =========================================
	    Mobile Configurations
	    ========================================== -->
	    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no"/>
	    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	    <meta name="apple-mobile-web-app-capable" content="yes"/>


	    <!-- Fonts -->
	    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
	    <link href='//fonts.googleapis.com/css?family=Raleway:600,400' rel='stylesheet' type='text/css'>
	    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
	    <!-- //Fonts -->

	    <!-- Owl Carousel CSS -->
	    <link href="css/owl.carousel.css" rel="stylesheet" media="screen">
	    <link href="css/owl.theme.css" rel="stylesheet" media="screen">

	    <!-- =========================================
	    CSS
	    ========================================== -->
	    <link rel="stylesheet" href="css/bootstrap.min.css"/>
	    <link rel="stylesheet" href="css/login.css"/>
	    
	    
	<script src="sweetalert-master/dist/sweetalert.min.js">      </script>
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet" />

	         <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    
	  	</head>
	<!-- /head -->


	<body class='body'>
	    
<div class="container">
<div  id="includedContent"> </div>
</div>

		<div>
      		<div >
	      		<div>
					
					<!-- .container-->
					
					<!-- .container-fluid-->
	 <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="img/logoqus.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" onsubmit="return loginfunc();">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" class="form-control" placeholder="User name" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
            <a href="forgot.php" class="forgot-password">
                Forgot the password?
            </a></br>
              <a href="register.php" >
                Register
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
							</div>
							<!-- .col-md-12-->
						</div>
						<!-- .row-->
					</div>
					<!-- .container-->
				
				<div  id="includedContent1"> </div>
		
		<!-- #wrapper -->


		<!-- =========================================
		JAVASCRIPT
		========================================== -->

	
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<script src="js/script.js"></script>
	
<script>

            function loginfunc()
            {
                     try {

                         var userid = document.getElementById("inputEmail").value;
                         var pwd = document.getElementById("inputPassword").value;
                            $.ajax({
                                type: "POST",
                                url: "process_login.php",
                                data:"userid="+userid+"&pwd="+pwd,
                                async: false,
                                success: function (data) 
                                {
                                //alert(data);
                                 try
                                 {
                                    var jsr = JSON.parse(data);
var losts=jsr["stats"];
}catch(ex)
{
    alert(ex);
}
if(losts=="1")
{
     window.open("<?php echo  $urlp;?>","_self");
 
    
}else
{
     swal("", "Incorrect Details", "warning");
                                     
}

                                }
                                
                            });

                        } catch (ex) {
                            alert(ex);
                        }


                        return false;

                    }





</script>	

		
	</body>
	</html>