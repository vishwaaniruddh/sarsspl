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

$result ="select * from Users where UserName='$username' and Password='$password' ";
$runresult=mysqli_query($conn,$result);
 $num=  mysqli_num_rows($runresult);
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
    
   

//echo $_SESSION['designation'];
//$result = mysql_query("INSERT INTO `login_activity`(`login_id`, `login_dt`) VALUES ('".$row[0]."','".date('Y-m-d H:i:s')."')");
$result = mysqli_query($conn,"INSERT INTO `login_activity`(`login_id`, `login_dt`) VALUES ('".$frws[6]."','".date('Y-m-d H:i:s')."')");


 //===========for mail Welcome Latter First Orchid Member===============

$EmailSubject2="Login details...";
 
        $message2.='Login :-'. $_SESSION['user'] ;
         
          

        $leadsmail2=" contactus@clubfourpoints.com";
        $mailheader2 = "From: ".$leadsmail2."\r\n"; 
    $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 
require_once 'phpmail/src/Exception.php';
require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';

$mail2 = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail2->isSMTP();                                      // Set mailer to use SMTP
    $mail2->Host = 'mail.clubfourpoints.com';  // Specify main and backup SMTP servers
    $mail2->SMTPAuth = true;                               // Enable SMTP authentication
    $mail2->Username = 'contactus@clubfourpoints.com';                 // SMTP username
    $mail2->Password = 'QKAc&mn,[xY%';                           // SMTP password
    $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail2->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail2->setFrom('contactus@clubfourpoints.com','Clubfourpoints');
    $mail2->addAddress('contactus@clubfourpoints.com'); 
    $mail2->mailheader=$mailheader2;// Add a recipient
  //  $mail->addCC('leads@loyaltician.com');
 // $mail2->addCC('satyendra1111@gmail.com');
    $mail2->addBCC('vishwaaniruddh@gmail.com ');
     
    
    
    $mail2->isHTML(true);                                  // Set email format to HTML
    $mail2->Subject = $EmailSubject2."\r\n";
    $mail2->Body    = $message2;
    $mail2->send();
//==============mail end===

    
    
  
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