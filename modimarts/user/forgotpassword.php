<?php
session_start();
include("config.php");
//if(isset($_POST['email']))
$email=$_POST['email'];
echo $email;
/*$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i"; 
            if (preg_match($pattern, trim(strip_tags($_GET['email'])))) { 
                $cleanedFrom = trim(strip_tags($_POST['email'])); 
            } else { 
                echo "The email address you entered was invalid. Please try again!"; 
            } 

function spamcheck($field)
  {
  //filter_var() sanitizes the e-mail
  //address using FILTER_SANITIZE_EMAIL
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);

  //filter_var() validates the e-mail
  //address using FILTER_VALIDATE_EMAIL
  if(filter_var($field, FILTER_VALIDATE_EMAIL))
    {
    return TRUE;
    }
    else
    {
    return FALSE;
    }
  }

$mailcheck = spamcheck($email);
    if ($mailcheck==FALSE)
    {
    	echo "<br>Invalid input";
    }
    else
    {*/

    	$q=mysqli_query($con1,"SELECT * FROM clients WHERE email='".$email."'");
		$row=mysqli_fetch_row($q);
		$q1=mysqli_query($con1,"SELECT * FROM users WHERE cid='".$row[0]."'");
		$row1=mysqli_fetch_row($q1);
		
		//echo "SELECT * FROM users WHERE cid='".$row[0]."'";

		
		
		if (mysqli_num_rows($q)>0)
		{//echo $row[3];
		
		$headers = "From:  Administrator ". strip_tags("admin@1clickguide.org") . "\r\n";
		$headers .= "Reply-To: Administrator". strip_tags("admin@1clickguide.org") . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	
		$subject = "Your 1 Click Guide Login Details" ;
	$to=$email;
		//$to= $_GET['email'];
    	$message = "<html><body><table width='400px' height='287' border='1' bgcolor='#99FF33'>
  <tr valign='middle'>
    <td colspan='2' align='center' ><img src='http://1clickguide.org/logo.png' width='100px' align='left'></td>
  </tr>
  <tr valign='middle'>
    <td colspan='2' align='center' ><font size='+3' color='#FF0000'>Merabazaar</font></td>
  </tr>
  <tr valign='middle'>
    <td colspan='2' align='center' ><h3>Your Login Details</h3></td>
  </tr>
  <tr valign='middle'>
    <td width='200px'><b>Your Id</b></td>
    <td width='200px'><b>".$row[0]."</b></td>
  </tr>
  <tr valign='middle'>
    <td><b>Your Email</b></td>
    <td><b>".$row[10]."</b></td>
  </tr>
  <tr valign='middle'>
    <td><b>Your Password</b></td>
    <td><b>".$row1[1]."</b></td>
  </tr>
</table></body></html>
" ;
mail($to, $subject, $message, $headers);
    //	mail($to, $subject,$message, $headers ); // open this to start sending mails
    	echo "Mail Sent";
		}
	else
	{
		echo "Email Not in the system / Waiting for Approval";
	}


	
?>