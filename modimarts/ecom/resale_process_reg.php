<?php session_start();
include('config.php'); ?>
<html>
    <head>
      
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        </head>
        <body>
<?php

$fname=mysqli_real_escape_string($_POST['firstname']);
$lname=mysqli_real_escape_string($_POST['lastname']);
$email=mysqli_real_escape_string($_POST['email']);
$state=mysqli_real_escape_string($_POST['state']);
$address=mysqli_real_escape_string($_POST['address_1']);
$city=mysqli_real_escape_string($_POST['city']);
$pincode=mysqli_real_escape_string($_POST['pincode']);
$mob=mysqli_real_escape_string($_POST['contact']);
$pass=$_POST['password'];
$id="";

if($_SESSION['gids']!="")
{
    $gtsts=mysqli_query($con1,"SELECT * FROM `states` where state_name='".$state."'");
    $stsrw=mysqli_fetch_array($gtsts);
    
    //echo "SELECT * FROM `states` where state_name='".$state."'";
    if(isset($_POST["submit"]))
    {
    
    //echo  "update Registration set `Firstname`='".$fname."',`Lastname`='".$lname."',`email`='".$email."',`Mobile`='".$mob."',`Gender`='".$rd."',`address`='".$address."',`pincode`='".$pincode."',`state`='".$state."',`city`='".$city."',`password`='".$pass."' where id='".$_SESSION['gid']."'";
$qry=mysqli_query($con1,"update Registration set `Firstname`='".$fname."',`Lastname`='".$lname."',`email`='".$email."',`Mobile`='".$mob."',`Gender`='".$rd."',`address`='".$address."',`pincode`='".$pincode."',`state`='".$stsrw[0]."',`city`='".$city."',`password`='".$pass."' where id='".$_SESSION['gid']."'");

$qrylogin=mysqli_query($con1,"INSERT INTO `login`(`email`, `password`, `regid`,MobileNumber) VALUES ('".$email."','".$pass."','".$_SESSION['gid']."','".$mob."')  ");

    
$qryaddrqr=mysqli_query($con1,"INSERT INTO `user_address`(`user_id`, `address`, `state`, `city`, `pin`) VALUES('".$_SESSION['gid']."','".$address."','".$stsrw[0]."','".$city."','".$pincode."')"); 
  
  $qrymail=mysqli_query($con1,"select id from verification where email='".$email."'");
//echo "select * from verification where email='".$email."'";
$fetchem=mysqli_fetch_array($qrymail);
$fetch=mysqli_num_rows($qrymail);

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
  $string=random_string(7);
       $email = strip_tags($email);





$str="";


  if($fetchem[0]!="")
  {   
  	$str="update verification  set code='".$string ."' where EMAIL='".$email."' ";
  	//$update = 1;
   
   }
   else
   {
if($_SESSION['gid']!="")
{
 	$str="INSERT INTO verification(email,code,reg_id) VALUES ('".$email."','".$string ."','".$_SESSION['gid']."')";
}
else
{
$str="INSERT INTO verification(email,code,reg_id) VALUES ('".$email."','".$string ."','".$_SESSION['id']."')";
}
 	//echo $str;
 }
 
  
  
  
    }else if(isset($_POST["update"]))
    {
      //  echo "ok";
     // echo "update Registration set `Firstname`='".$fname."',`Lastname`='".$lname."',`email`='".$email."',`Mobile`='".$mob."',`Gender`='".$rd."',`address`='".$address."',`pincode`='".$pincode."',`state`='".$stsrw[0]."',`city`='".$city."' where id='".$_SESSION['gid']."'";
      $qry=mysqli_query($con1,"update Registration set `Firstname`='".$fname."',`Lastname`='".$lname."',`email`='".$email."',`Mobile`='".$mob."',`Gender`='".$rd."',`address`='".$address."',`pincode`='".$pincode."',`state`='".$stsrw[0]."',`city`='".$city."' where id='".$_SESSION['gid']."'");
 echo mysqli_error($con1);
$getusaddr=mysqli_query($con1,"select id from user_address where user_id='".$_SESSION['gid']."' order by id asc limit 0,1");
$gtuseraddrid=mysqli_fetch_array($getusaddr);
$qryaddrqr=mysqli_query($con1,"update `user_address` set `address`='".$address."', `state`='".$stsrw[0]."', `city`='".$city."', `pin`='".$pincode."' where id='".$gtuseraddrid[0]."'"); 
 echo mysqli_error($con1);
    }
}
else
{
$qry=mysqli_query($con1,"INSERT INTO `Registration`(`Firstname`, `Lastname`, `email`, `Mobile`, `address`, `pincode`, `landmark`, `state`, `city`, `Gender`, `password`,resale_merchant)
VALUES ('".$fname."','".$lname."','".$email."','".$mob."','".$address."','".$pincode."','','".$state."','".$city."','','".$pass."','1')");

$id=$con1->insert_id;
$qrylogin=mysqli_query($con1,"INSERT INTO `login`(`email`, `password`, `regid`,MobileNumber) VALUES ('".$email."','".$pass."','".$id."','".$mob."')");

}
if($qry & $_SESSION['gids']=="")
{$message = $id;
echo "<script type='text/javascript'>alert('$message');</script>";
//header("Location:resale_Register.php?sts=1");
   $_SESSION['email']=$email;
   $_SESSION['gids']=$id;
   $_SESSION['loginstats']="1";
?>



 
   
<script>

swal({
  title: "Are you sure?",
  text: "You want to Add Product Now or Later!",
  icon: "warning",
  buttons: [
            'Latter',
            'Add PRODUCT NOW'
          ],
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Registered Successfully!", {
      icon: "success",
    });
    
    window.open("resale_AddProduct.php","_SELF");
    
  } 
  
  else {
  //  swal("Your imaginary file is safe!");
   swal("Registered Successfully!", {
      icon: "success",
    });
  window.open("resale_index.php","_SELF");
  
  }
});
</script>



<?php
//echo $email;
}
else
{
header("Location:resale_Register.php?sts=2");
}


//========================send mail=============



?>
</body>
</html>