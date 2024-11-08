<?php session_start();

include('connect.php');

$prodid=$_POST['prodid'];
$pid = $_POST['pid'];
$cid=$_POST['cid'];


$price = $_POST['price'];
$image = $_POST['image'];
$pname = $_POST['pname'];

$usrid = $_SESSION['gid'];
$dt = date("Y-m-d");


if($usrid){
    

    
$check_sql = mysqli_query($con1,"select * from wishlist where cat_id='".$cid."' and user_id='".$usrid."' and pid='".$prodid."' and prodid = '".$pid."'");

if($check_sql_result = mysqli_fetch_assoc($check_sql)){
    
    $delete  = "delete from wishlist where cat_id='".$cid."' and user_id='".$usrid."' and pid='".$prodid."' and prodid = '".$pid."'";


    if(mysqli_query($con1,$delete)){
        echo 2;
    }
    else{
        echo 0;
    }
    
}

else{
    $total_amount  =  $price; 

      $insert = "INSERT INTO `wishlist`(`user_id`,guest_id ,`pid`, `qty`, `dt`,p_price,total_amt,final_amt,color,size,cat_id,status,product_name,image,prodid) VALUES ('".$usrid."','".$usrid."','".$prodid."','".$qty."','".$dt."','".$price."','".$total_amount."','".$total_amount."','','','".$cid."','0','".$pname."','".$image."','".$pid."')";
    
    
    if(mysqli_query($con1,$insert)){
        echo 1;
    }    
    else{
        echo 0;
    }
}
}
else{
    echo 0;
}


?>