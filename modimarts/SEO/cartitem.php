<?php 
 session_start();
 include("connect.php");

$userid = $_SESSION['gid'];
if($_SESSION['gid']==''){ $userid = $_SESSION['geust_id'];}

 $qryc=mysqli_query($con1,"select qty from cart where user_id='".$userid."' and status=0");
    $fetchc=mysqli_num_rows($qryc);
            echo $fetchc;
        
    
  
    