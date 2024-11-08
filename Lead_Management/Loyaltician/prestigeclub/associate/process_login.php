<?php session_start();
include('config.php');
?>
<html>
<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <body>
<?php
$username = $_POST['uname'];
$password = $_POST['pass'];
//echo "select * from login where username='$username' and password='$password'";
 $result ="select * from HotelUsers where (emailid='$username' or mobile='$username') and Password='$password' and verified='Y'";
$runresult=mysqli_query($conn,$result);
 //echo $result;
$rwsc=mysqli_num_rows($runresult);
if($rwsc>0)
   {
//echo $rwsc;
//echo "test";
      $frws=mysqli_fetch_array($runresult);
      $_SESSION['user']=$frws['empname'];
      $_SESSION['email']=$frws['emailid'];
      $_SESSION['id']=$frws['id'];
 //  $_SESSION['permission']=$frws['permission'];
//   $_SESSION['register_id']=$frws['reg_id'];
//   $_SESSION['usertype']=$frws['UserType'];

//echo $_SESSION['designation'];
//$result = mysql_query("INSERT INTO `login_activity`(`login_id`, `login_dt`) VALUES ('".$row[0]."','".date('Y-m-d H:i:s')."')");
$result = mysqli_query($conn,"INSERT INTO `login_activity`(`login_id`, `login_dt`) VALUES ('".$frws[0]."','".date('Y-m-d H:i:s')."')");

?>

<script>
   swal("Successfully Login ");
   //window.open("dashboard_temp/index.php","_self");
   //window.open("lead_entry1.php","_self");
   window.open("dashboard.php","_self");
   
</script>

 <?php   
}else{?>
   <script>
    swal("Enter correct userid and password to login");
    window.open("login.php","_self");
</script> 
<?php }

?>
</body>
</html>