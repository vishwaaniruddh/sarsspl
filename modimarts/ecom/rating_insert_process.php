<?php
include('config.php');
 session_start();
 $gid=$_SESSION['gid'];
 
  $comment=$_POST['text'];
  $rating=$_POST['rating'];
  $product_id=$_POST['pro_id'];
   $cat_id=$_POST['cat_id'];
 $date=Date('Y-m-d H:i:s');
 //".$gid."
 //echo "SELECT * FROM `login` where regid='".$gid."' and email!='' and password!=''";
 $slctqry=mysqli_query($con1,"SELECT * FROM `login` where regid='".$gid."' and email!='' and password!=''");
 $slctchkqry=mysqli_num_rows($slctqry);
 
 if($slctchkqry>0)
 {
    // echo "INSERT INTO `product_review`( `user_id`, `product_id`, `rating_count`, `description`, `date_time`) VALUES ('$gid','$product_id','$rating','$comment','$date')";
     $insrtqry=mysqli_query($con1,"INSERT INTO `product_review`( `user_id`, `product_id`, `rating_count`, `description`, `date_time`,category_id) VALUES ('$gid','$product_id','$rating','$comment','$date','$cat_id')");
     
     if($insrtqry)
     {
         echo 1;
         
    
     }
     else{
         
         echo 0;
     }
}
else{
    
    //header('Location: login.php');
 
   echo 3;
}
?>