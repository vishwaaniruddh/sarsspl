<?php
session_start();
include '../config.php';
$message="";
if(isset($_POST['back'])){	
	header("Location: Login_form.php");
}
if(isset($_POST['submit']))
{	
    $user_name = $_POST['user_name'];
	$query="SELECT * FROM user_login where user_name='" . $_POST['user_name'] . "'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
	$fetch_user_id=$row['user_name'];
	$email_id=$row['user_email'];
	$password=$row['user_password'];
	if($user_name==$fetch_user_id) {
		$to = $email_id;
		$subject = "Password";
		$txt = "Your password is : $password.";
		$headers = "From: accessrichu92@gmail.com" . "\r\n" .
		"CC: accessrichu92@gmail.com";
		mail($to,$subject,$txt,$headers);
		$message="Password sent to your  email id :".$to;
		header("Location: Login_form.php?change_password=1");
	}
	else{
		$message= 'invalid userid';
	}
	//echo 'pwd: '.$password;
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
        <h2 class="text-center">Forgot Password</h2>   
		<div class="message"><?php if($message!="") { echo $message; } ?></div>
        <div class="form-group">
        	<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="password" class="form-control" name="user_name" placeholder="User Name" required>				
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
    </form>	
	
    <p class="text-center">&#169; 2019 .All Rights Reserved.  </p>
</div>
</body>
</html>

 

 

 


 
