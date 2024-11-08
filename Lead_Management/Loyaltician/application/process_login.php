<?php session_start();
include('config.php');

// if($conn){ echo "<script>alert('hello')</script>";}

// var_dump($_POST);  die;
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

$result ="select * from Users where UserName='".$username."' and Password='".$password."' ";
$runresult=mysqli_query($conn,$result);
 $num=  mysqli_num_rows($runresult);
 echo $num; 
if($num>0)
   {
       

      $frws=mysqli_fetch_array($runresult);
      $_SESSION['user']=$frws['UserName'];
      $_SESSION['email']='';
      $_SESSION['id']=$frws['UserId'];
   $_SESSION['permission']=$frws['permission'];
   $_SESSION['register_id']=$frws['reg_id'];
   $_SESSION['usertype']=$frws['UserType'];
   $_SESSION['HotelName']=$frws['hotel_id'];
      $_SESSION['roll_id']=$frws['roll_id'];
    
   

// echo $_SESSION['usertype'];
//$result = mysql_query("INSERT INTO `login_activity`(`login_id`, `login_dt`) VALUES ('".$row[0]."','".date('Y-m-d H:i:s')."')");
$result = mysqli_query($conn,"INSERT INTO `login_activity`(`login_id`, `login_dt`) VALUES ('".$frws[6]."','".date('Y-m-d H:i:s')."')");


  
    $runQ=mysqli_query($conn,"select l.Lead_id from Members m INNER JOIN Leads_table l on m.Static_LeadID=l.Lead_id where  m.ExpiryDate='2020-04-23' and l.Status='5' and renewalStatus='0' ");
  if(mysqli_num_rows($runQ)>0){
    while($fetchlead=mysqli_fetch_array($runQ)){
    mysqli_query($conn,"update Leads_table set renewalStatus='1' where Lead_id='".$fetchlead[0]."' ");
  }}

?>




<script>
   swal("Login successfull");
   //window.open("dashboard.php","_self");
      window.open("redirection1.php","_self");
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