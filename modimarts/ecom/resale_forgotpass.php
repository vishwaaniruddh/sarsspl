<?php
include('config.php');
$app=0;
if(isset($_POST['emails']))
{
$email=$_POST['emails'];
}else
{
   $app=1; 
  $email=$_GET['email2']; //---request is from app---/
}



$qry=mysqli_query($con1,"select * from login where email='".$email."'");
$fetch=mysqli_num_rows($qry);

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
  	$str="update login set password='".$string ."' where EMAIL='".$email."' ";
   }
   
 
$qry1 = mysqli_query($con1,$str);

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
//echo 1;
 
   if($app=="0")
   {
?>
<script>window.open('resale_forgot_pass.php?sts=1','_self');</script>
<?php
}
else
{
   echo "1"; 
}

}else
{
    
   if($app=="0")
   {
?>
<script>window.open('resale_forgot_pass.php?sts=0','_self');</script>
<?php
}
else
{
   echo "0"; 
} 
    
}
}
else 
{
   if($app=="0")
   {
?>
<script>alert('Invalid Email');</script>
<script>window.open('resale_forgot_pass.php?sts=2','_self');</script>
<?php
   }else
   {
       
      echo "2"; 
   }
}


?>