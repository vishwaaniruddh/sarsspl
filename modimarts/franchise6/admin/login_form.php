<? session_start();
include('../config.php');


if(isset($_POST['submit'])){
    
    $username    = mysqli_real_escape_string($con, $_POST['user_name']);
    $password    = mysqli_real_escape_string($con, $_POST['user_password']);
    
    $sql = mysqli_query($con,"select * from Users where UserName='".$username."' and Password='".$password."' AND status='1'");
    
    if($sql_result = mysqli_fetch_assoc($sql)){
        
        $userid = $sql_result['UserId'];
        $roll_id = $sql_result['roll_id'];
        $UserType = $sql_result['UserType'];

        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $userid;
        $_SESSION['rollid']= $roll_id;
        $_SESSION['UserType']= $UserType;
        ?>
        
       <script>
           window.location.href="index.php";
       </script> 
        
    <? }
    else{
        $message = 'Invalid Credentials !';
    }
    
}

if(isset($_SESSION['userid']))
{
    ?>
        
       <script>
           window.location.href="index.php";
       </script> 
        
    <? 

}



?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../css/custom.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="shortcut icon" href="https://modimart.world/assets/logo-original.png" type="image/png" />

</head>
<body>
<div class="login-form">
    <form action="#" method="post">
        <h2 class="text-center">Sign in</h2>   
		<div class="message">
		    <?php if($message!="") { echo $message; } ?>
		</div>
        <div class="form-group">
        	<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="user_name" placeholder="Username" required="required">				
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="user_password" placeholder="Password" required="required">				
            </div>
        </div>        
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary login-btn btn-block">Sign in</button>
        </div>
        <div class="clearfix">
            <label class="pull-left checkbox-inline">
                <input type="checkbox" name="remember_me" id="remember_me"> Remember me</label>
            <a href="forgot_password.php" class="pull-right">Forgot Password?</a>
        </div>
    </form>
    <p class="text-center">&#169; 2020 .All Rights Reserved.  </p>
</div>
</body>
</html>                            