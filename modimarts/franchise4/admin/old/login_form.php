<? session_start();
include('../config.php');

if(isset($_POST['submit'])){
    
    $username = $_POST['user_name'];
    $password = $_POST['user_password'];
    
    $sql = mysqli_query($con,"select * from Users where UserName='".$username."' and Password='".$password."'");
    
    if($sql_result = mysqli_fetch_assoc($sql)){
        
        $userid = $sql_result['UserId'];
        $roll_id = $sql_result['roll_id'];

        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $userid;
        $_SESSION['rollid']= $roll_id;?>
        
       <script>
           window.location.href="index.php";
       </script> 
        
    <? }
    else{
        $message = 'Invalid Credentials !';
    }
    
}



?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../css/custom.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script> 

</head>
<body>
<div class="login-form">
    <form action="" method="post">
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