<?php 
session_start();
include('head.php');
$geust_id=$_SESSION['geust_id'];
$password    = mysqli_real_escape_string($con, $_POST['value']);
$id    = mysqli_real_escape_string($con, $_POST['member_id']);




$sql = mysqli_query($con,"select * from new_member where id='".$id."' and password='".$password."'");

// var_dump($con);

if($sql_result = mysqli_fetch_assoc($sql)){


    $sqlquery=mysqli_query($con1,"SELECT * FROM `cart` WHERE user_id='".$geust_id."'");

    while($data=mysqli_fetch_assoc($sqlquery))
     {
        $g_pid=$data['pid'];
        $g_catid=$data['cat_id'];
        $g_price=$data['p_price'];
        $g_qty=$data['qty'];
        $g_variant_id=$data['variant_id'];

        $find = mysqli_query($con1,"SELECT * FROM `cart` WHERE user_id='".$sql_result['id']."' AND pid='".$g_pid."' AND cat_id='".$g_catid."' AND variant_id='".$g_variant_id."'");
        $countdata = mysqli_num_rows($find);

        if ($countdata==0) {
            mysqli_query($con1,"update cart set user_id = '".$sql_result['id']."',is_franchise='1' where user_id='".$geust_id."' AND pid='".$g_pid."' AND cat_id='".$g_catid."'");
        }
        else
        {
            $getdata =mysqli_fetch_assoc($find);
            $price = $getdata['p_price'];
            $prodid = $getdata['pid'];
            $cid = $getdata['cat_id'];
            $specifiid = $getdata['variant_id'];

            $quantity = $getdata['qty'];
    
            $new_quantity = $quantity + $g_qty;
            $total_amount  = $new_quantity * $g_price; 
            
            $update = "update cart set qty = '".$new_quantity."',p_price = '".$price."', total_amt = '".$total_amount."', final_amt = '".$total_amount."',is_franchise='1'  WHERE user_id='".$sql_result['id']."' AND pid='".$g_pid."' AND cat_id='".$g_catid."' AND variant_id='".$g_variant_id."'";
            if(mysqli_query($con1,$update)){

                $delsql = "DELETE FROM cart WHERE user_id = '".$geust_id."' AND pid='".$g_pid."' AND cat_id='".$g_catid."' AND variant_id='".$g_variant_id."'";
                mysqli_query($con1,$delsql);
            }

        }
  
     }
    
   $_SESSION['id'] = $sql_result['id'] ; 
   $_SESSION['mem_id'] = $sql_result['id'] ; 
   $_SESSION['status'] = '1';
   

     $_SESSION['fname']=$sql_result['name'];
    $_SESSION['email']=$sql_result['email'];
    if($sql_result['ref_id']!=0 && $sql_result['ref_id']!=''){
    $_SESSION['ref_id']=$sql_result['ref_id'];
    }

   $address = $sql_result['location'];


    $_SESSION['primary_address'] = $address ;
   


 ?>

<script>
    swal("Login Succesfully !", "", "success");    
    setTimeout(function(){
        window.location.href='index.php';        
    }, 1500);
</script>

<?php

}
else{

    ?>

<script>
       swal("Invalid Credentials ! Please Try Again !","","error");    
    
    setTimeout(function(){
        window.location.href='login_form.php';        
    }, 3000);
</script>
<?php
}
 ?>