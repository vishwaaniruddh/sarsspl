<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
 include('config.php');?>
<form method="post" enctype="multipart/form-data">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
</head>
<body>

<h3>Contact Form</h3>

<div class="container">
  
    <label for="fname"> Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name..">

    <label for="email">EMAIL</label>
    <input type="text" id="email" name="email" placeholder="Your Email..">


    <label for="mobile">MOBILE</label>
    <input type="text" id="mobile" name="mobile" placeholder="Your Mobile no">


    
    <label for="lname">ADDRESS</label>
    <input type="text" id="address" name="address" placeholder="Your Address..">

    
    
    <label for="lname">COMPANY</label>
    <input type="text" id="company" name="company" placeholder="Your Company Name..">

<div class="elem-group">
    <label for="image">image</label>
   <input type="file" name="image" id="image">
  </div>
  <br>
    <input type="submit" value="Submit">
  </form>
  <?php
if(isset($_POST['submit']))
{
	
  $name=$_GET['id'];
   
	$name=$_POST['name'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$image=$_POST['image'];
	
    $address=$_POST['address'];
    $company=$_POST['company'];
	
	$improvement=$_POST[''];
$ins="INSERT INTO `login`( `name`, `email`, `mobile`, `image`, `address`,`company`) VALUES ('$name','$email','$mobile','$image','$address','$company')";
if(mysqli_query($conn,$ins))
 {
	 echo"submit successful";
 }
else
{	echo mysqli_error($conn);

}

}
?>

</div>

</body>
</html>
