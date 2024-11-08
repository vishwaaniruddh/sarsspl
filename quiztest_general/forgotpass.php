<?php
include('config.php');

$email=$_POST['email'];




$qry=mysqli_query($con,"select * from quiz_regdetails where emailid='".$email."'");
$fetch=mysqli_num_rows($qry);
$row=mysqli_fetch_array($qry);

//echo "select * from login where email='".$name."'";

if($fetch>0)
{
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range(0, 9));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
  $string=random_string(6);
       $email = strip_tags($email);





$str="";
  if($email!="")
  {   
  	$str="update quiz_login set pass='".$string ."' where user_id='".$row['id']."' ";
 
   }
   
 
echo $str;
$qry1 = mysqli_query($con,$str);

if($qry1)
{
$subject="Your new password";
$headers = "From: <mail@example.com>\r\n";
//$headers .= "Cc: <info@designbigideas.com>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//$headers .= "Cc: ".$this->ccm."\r\n";
			//echo $tbl."<br>";
			//echo $this->ccm;
			$message="Your password is ".$string;
			
			//$send = mail('rahull.1612@gmail.com', 'Test Subject', $message);
			$result = mail($email, $subject, $message, $headers);
                       // $result = mail('secretary@ipua.in', $subject, $message, $headers);
			//$result = mail('rahull.1612@gmail.com', 'Test Subject', $message);



}



if($qry1)
{

echo "<script>alert('Password send on your e-mail');</script>";

echo "<script> location.href='login.php'; </script>";
 
}else
{
    
   
   echo "0"; 

    
}
}
else 
{
    echo "<script>swal('mail id does not exist');</script>";
echo "<script> location.href='forgot.php'; </script>";
}


?>