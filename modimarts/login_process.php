<?php
 session_start();
include('head.php');

$geust_id=$_SESSION['geust_id'];
$email=$_POST['usernm'];
$email = mysqli_real_escape_string($con1, $email);
$passwd=$_POST['pass'];
$passwd = mysqli_real_escape_string($con1, $passwd);


if($email!='' && $passwd!=''){

$qrylogin=mysqli_query($con1,"select * from login where email='".$email."' and password='".$passwd."'");

if($qrylogin_result = mysqli_fetch_assoc($qrylogin)) {

    $sql=mysqli_query($con1,"select * from Registration where email='".$email."'");
    
    $sql_result=mysqli_fetch_assoc($sql); 


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
            mysqli_query($con1,"update cart set user_id = '".$sql_result['id']."' where user_id='".$geust_id."' AND pid='".$g_pid."' AND cat_id='".$g_catid."'");
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
            
            $update = "update cart set qty = '".$new_quantity."',p_price = '".$price."', total_amt = '".$total_amount."', final_amt = '".$total_amount."'  WHERE user_id='".$sql_result['id']."' AND pid='".$g_pid."' AND cat_id='".$g_catid."' AND variant_id='".$g_variant_id."'";
            if(mysqli_query($con1,$update)){

                $delsql = "DELETE FROM cart WHERE user_id = '".$geust_id."' AND pid='".$g_pid."' AND cat_id='".$g_catid."' AND variant_id='".$g_variant_id."'";
                mysqli_query($con1,$delsql);
            }

        }
  
     }
   



    
   
    
    $_SESSION['gid'] = $sql_result['id']; 
    $_SESSION['fname']=$sql_result['Firstname'];
    $_SESSION['lname']=$sql_result['Lastname'];
    $_SESSION['mobile']=$sql_result['Mobile'];
    $_SESSION['email']=$sql_result['email'];
    if($sql_result['ref_id']!=0 && $sql_result['ref_id']!=''){
    $_SESSION['ref_id']=$sql_result['ref_id'];
    }
   






$sql_address = mysqli_query($con1,"select * from address where userid='".$_SESSION['gid']."' and status=1 and is_primary=1");

$sql_address_result = mysqli_fetch_assoc($sql_address);

$address = $sql_address_result['address'];
$pincode = $sql_address_result['pincode'];
$city = $sql_address_result['city'];
$state = $sql_address_result['state'];
$landmark = $sql_address_result['landmark'];


$_SESSION['primary_address'] = $address.', '.$landmark.', '.$city.', '.$pincode.', '.$state ;
$_SESSION['primary_city'] = $city;
$_SESSION['primary_state'] = $state;
$_SESSION['primary_zip'] = $pincode;

// header('Location:my_account.php ');

// exit();

?>

<script>
    swal("Login Succesfully !", "", "success");    
    setTimeout(function(){
        window.location.href='index.php';        
    }, 1500);
</script>

<?php
}

else { 

    
?>

<script>
       swal("Invalid Credentials ! Please Try Again !","","error");    
    
    setTimeout(function(){
        window.location.href='login.php';        
    }, 3000);
</script>
<?php
    // header('Location:index.php ');

    // exit();
}
}
else
{
	?>

<script>
       swal("Invalid Credentials ! Please Try Again !","","error");    
    
    setTimeout(function(){
        window.location.href='login.php';        
    }, 3000);
</script>
<?php

}


?>