<?php
session_start();
include '../config.php';
if(!isset($_SESSION["user_name"])) {
	header("Location:login_form.php");
}
$message="";
$msg_class="message-success";
$user_name = $_SESSION["user_name"];/* userid of the user */
if(count($_POST)>0) {
	//$con = mysqli_connect('127.0.0.1:3306','root','','my_db') or die('Unable To connect');
	$result = mysqli_query($conn,"SELECT * FROM user_login WHERE user_name='" . $user_name . "'");
	$row  = mysqli_fetch_array($result);
	if($_POST["currentPassword"] == $row["user_password"]) {
		if($_POST['newPassword']==$_POST['confirmPassword']){
			mysqli_query($con,"UPDATE login_user set user_password='" . $_POST["newPassword"] . "' WHERE user_name='" . $user_name . "'");
			$message = "Password Changed Sucessfully";
			$msg_class="message-success";
		} else {
			$message="New password and confirm password do not match!";
			$msg_class="message-failed";
		}
		//mysqli_query($con,"UPDATE login_user set user_password='" . $_POST["newPassword"] . "' WHERE user_name='" . $user_name . "'");
		//$message = "Password Changed Sucessfully";
	} else{
		$message = "Old password is not correct!";
		$msg_class="message-failed";
	}
}
if (isset($_POST['forgot_password'])){
  header("Location: forgot_password.php");
}
?>
<!DOCTYPE html>
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
<body>
<div class="login-form">
    <form action="" method="post">
        <h2 class="text-center">Password Change</h2>   
		<div class="<?php echo $msg_class;?>"><?php if($message!="") { echo $message; } ?></div>
        <div class="form-group">
        	<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="currentPassword" placeholder="current Password" required="required">				
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="newPassword" placeholder="new Password" required="required">				
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="confirmPassword" placeholder="confirm Password" required="required">				
            </div>
        </div>
		 <div class="form-group">
			<div class="row">
				<div class="col-md-6">
					<input type="submit" name="submit" value="submit" class="btn btn-primary login-btn btn-block" id="submit">
				</div>
				<div class="col-md-6">
					<button class="btn btn-primary login-btn btn-block" onclick="window.location.href='login_form.php'" id="back">Back</button>
				</div>
			</div>			
        </div>
        <!--<div class="form-group">
            <button type="submit" class="btn btn-primary login-btn btn-block">Change</button>			
        </div>-->        
    </form>	
    <p class="text-center">&#169; 2019 .All Rights Reserved.  </p>
</div>
</body>
</html>                            