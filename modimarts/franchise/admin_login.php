<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
  
       
<div class="container">
  <h2><center><u>Login Form</u></center></h2>
 <form action="member3.php">
    <div class="form-group">
      <label for="name">Username</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Username" name="name" style="width:20%;">
    </div>
    <div class="form-group">
      <label for="pwd">Password</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" style="width:20%;">
    </div>
   
    <button type="login" class="btn btn-success">Login</button>
   </form>
 
</div>
</body>
</html>
