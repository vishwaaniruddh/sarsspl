<?php
include 'connect.php';

$guest_id = $_SESSION['gid'];?>


<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </head>

    <body>
<?
if($_SERVER['REQUEST_METHOD']=='POST'){

$Firstname = $_POST['fname'];
$Firstname = mysqli_real_escape_string($con1, $Firstname);

$Lastname = $_POST['lname'];
$Lastname = mysqli_real_escape_string($con1, $Lastname);

$email = $_POST['emailid'];
$email = mysqli_real_escape_string($con1, $email);

$Mobile = $_POST['mob'];
$Mobile = mysqli_real_escape_string($con1, $Mobile);

$password = $_POST['passwd'];
$password = mysqli_real_escape_string($con1, $password);

$check_sql = mysqli_query($con1,"select email from Registration where email = '".$email."'");

if($check_sql_result = mysqli_fetch_assoc($check_sql)){ ?>

 <script>

    // swal('Email Found! Please Login or try different email to continue !')

    // setTimeout(function(){
    //     window.history.back();
    // }, 3000);

    swal({
    title: "Error!",
    text: "Email already exists! Please Login or try different email to continue !",
    type: "error"
}).then(function() {
 window.history.back();
});
</script>
<? }
else{

    if(isset($_SESSION['refcode']))
    {
        $reff=mysqli_query($con,"SELECT * FROM `franchise_referral` WHERE ref_code ='".$_SESSION['refcode']."'");
        $refdata=mysqli_fetch_assoc($reff);
        $refid=$refdata['franchise_id'];
         
    }
    else
    {
        $refid=""
    }



$sql = "insert into Registration(Firstname,Lastname,email,Mobile,password,guest_id,'ref_id') values('".$Firstname."','".$Lastname."','".$email."','".$Mobile."','".$password."','".$guest_id."','".$refid."') ";

if(mysqli_query($con1,$sql)){

    $regid = mysqli_insert_id($con1);;;

    $login_inssert = "insert into login(email,password,regid,MobileNumber) values('".$email."','".$password."','".$regid."','".$Mobile."')";

    mysqli_query($con1,$login_inssert);
    $address=mysqli_query($con1,"INSERT INTO `address`(`userid`, `fname`, `lname`, `mobile`, `email`, `address`, `status`, `is_primary`) VALUES ('".$regid."','".$Firstname."','".$Lastname."','".$Mobile."','".$email."','','1','1')");


    // mail
    $to= $email;
    $subject="Allmart : Your login id and password! ";
    $headers = "From: <noreply@allmart.world>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message="Your User Name is ".$email."<br/> Your Password is : ".$password;

    mail($email, $subject, $message, $headers);
    // mail('developer.ruchi@gmail.com', $subject, $message, $headers);


    ?>

    <script>
    swal({
    title: "Success",
    text: "Registered Succesfully ! Please login to contine !",
    type: "success"
}).then(function() {
 window.location.href="login.php";
});

    </script>

<? }

else{ ?>

        <script>

      swal({
    title: "Error!",
    text: "Registered Error ! Please Try Again !",
    type: "error"
}).then(function() {
 window.history.back();
});



    </script>
<? }




    } // if not email found then only insert

} // check IF On ly POST END
else{ ?>
   <script>
       window.history.back();
   </script>
<? }
?>
</body>

</html>



