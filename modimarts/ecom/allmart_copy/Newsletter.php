<?php 
include("config.php");
$email=$_POST['email'];

$q=mysqli_query($con1,"select * from Newsletter where email_id='".$email."'");
$count=mysqli_num_rows($q);
if($count > 0){
   echo "3"; 
}

else{
 
$news=mysqli_query($con1,"insert into Newsletter(email_id) values('".$email."')");
 if($news){
  echo "1";  
 }
 else{
 echo "2"; 
 }
 
}
    ?>

