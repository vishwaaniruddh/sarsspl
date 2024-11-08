<?php
session_start();
include ("../config.php");
$message="";
if(count($_POST)>0) {
    $query="SELECT * FROM user_login WHERE user_name='" . $_POST["user_name"] . "' and user_password = '". $_POST["user_password"]."'";
    //var_dump($query);
    $result = mysqli_query($conn,$query);
    $row='';
    if($result){
       $row  = mysqli_fetch_array($result);  
    }
   // var_dump($row);
    if(is_array($row)) {
    $_SESSION["id"] = $row['user_id'];
    $_SESSION["user_name"] = $row['user_name'];
    } else {
        $message = "Invalid Username or Password!";
    }
}
    if(isset($_SESSION["id"])) {
        //echo $_SESSION["id"];
    header("Location:../member1.php");
    die;
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="https://modimart.world/assets/logo-original.png" type="image/png" />
</head>
<body>

<div class="container">
  <h2>Login form</h2>
  <form class="form-horizontal" method="post" action="">
      <div class="message"><?php if($message!="") { echo $message; } ?></div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">User Name:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control"  placeholder="Enter username" name="user_name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-6">          
        <input type="password" class="form-control" placeholder="Enter password" name="user_password">
      </div>
    </div>
 
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="Login" class="btn btn-primary">Login</button>
      </div>
     
    </div>
  </form>
</div>

</body>
</html>