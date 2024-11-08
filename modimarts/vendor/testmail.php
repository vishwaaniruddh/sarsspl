<?php
$to = "developer.ruchi@gmail.com";
$email = $to;
$subject = "HTML email";

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range(0, 9));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
/*$string=random_string(6);

$email = strip_tags($email);
//echo $email;

$subject="Your login id and password Allmart";
$headers = "From: <mail@example.com>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message="Your User Name is ".$email."<br/> Your Password is : ".$string;

$message = "
<html>
<head>
<title>Your email passwordl</title>
</head>
<body>
<p>Your allmart login credentials are : </p>
<table>
<tr>
<th>Email:</th>
<th>'".$email."'</th>
</tr>
<tr>
<td>Password:</td>
<td>'".$string."'</td>
</tr>
</table>
</body>
</html>
";
*/

$string=random_string(6);
  
$email = strip_tags($email);
//echo $email;
$to= $email;
$subject="Your login id and password Allmart";
$headers = "From: <mail@example.com>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message="Your User Name is ".$email."<br/> Your Password is : ".$string;
			
//$result = mail($email, $subject, $message, $headers);
mail($to, $subject, $message, $headers);
			

//mail($email, $subject, $message, $headers);


?>
