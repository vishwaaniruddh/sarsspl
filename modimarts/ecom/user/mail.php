<?php
if($_POST['button'] && isset($_FILES['attachment'])) 
{ 

	$from_email		 = 'developer@abc.com'; //from mail, sender email addrress 
	$recipient_email = 'developer.ruchi@gmail.com'; //recipient email addrress 
	
	//Load POST data from HTML form 
	/*$sender_name = $_POST["sender_name"]; 
	$reply_to_email = $_POST["sender_email"] ;
	$subject	 = $_POST["subject"]; 
	$message	 = $_POST["message"]; */
	
	$sender_name ='test';
	$reply_to_email =='';
	$subject	 = 'Billing Report';
	$message	 = 'hi!Kindly find the attached report of your products sold via merabazaar.';
	
 
	/*Always remember to validate the form fields like this 
	if(strlen($sender_name)<1) 
	{ 
		die('Name is too short or empty!');  
	} 
	*/
	
	//Get uploaded file data using $_FILES array 
	$tmp_name = $_FILES['my_file']['tmp_name']; // get the temporary file name of the file on the server 
	$name	 = $_FILES['my_file']['name']; // get the name of the file 
	$size	 = $_FILES['my_file']['size']; // get size of the file for size validation 
	$type	 = $_FILES['my_file']['type']; // get type of the file 
	$error	 = $_FILES['my_file']['error']; // get the error (if any) 

	//validate form field for attaching the file 
	if($file_error > 0) 
	{ 
		die('Upload error or No files uploaded'); 
	} 

	//read from the uploaded file & base64_encode content 
	$handle = fopen($tmp_name, "r"); // set the file handle only for reading the file 
	$content = fread($handle, $size); // reading the file 
	fclose($handle);				 // close upon completion 

	$encoded_content = chunk_split(base64_encode($content)); 

	$boundary = md5("random"); // define boundary with a md5 hashed value 

	//header 
	$headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version 
	$headers .= "From:".$from_email."\r\n"; // Sender Email 
	$headers .= "Reply-To: ".$reply_to_email."\r\n"; // Email addrress to reach back 
	$headers .= "Content-Type: multipart/mixed;\r\n"; // Defining Content-Type 
	$headers .= "boundary = $boundary\r\n"; //Defining the Boundary 
		
	//plain text 
	$body = "--$boundary\r\n"; 
	$body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n"; 
	$body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
	$body .= chunk_split(base64_encode($message)); 
		
	//attachment 
	$body .= "--$boundary\r\n"; 
	$body .="Content-Type: $file_type; name=".$file_name."\r\n"; 
	$body .="Content-Disposition: attachment; filename=".$file_name."\r\n"; 
	$body .="Content-Transfer-Encoding: base64\r\n"; 
	$body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n"; 
	$body .= $encoded_content; // Attaching the encoded file with email 
	
	$sentMailResult = mail($recipient_email, $subject, $body, $headers); 

	if($sentMailResult ) 
	{ 
	echo "File Sent Successfully."; 
	unlink($name); // delete the file after attachment sent. 
	} 
	else
	{ 
	die("Sorry but the email could not be sent. 
					Please go back and try again!"); 
	} 
}
// Redirect to the listing page
header("Location: claim_bill.php".$qstring);

?>

<!--<form enctype="multipart/form-data" method="POST" action=""> 
    <label>Your Name <input type="text" name="sender_name" /> </label>  
    <label>Your Email <input type="email" name="sender_email" /> </label>  
    <label>Subject <input type="text" name="subject" /> </label>  
    <label>Message <textarea name="message"></textarea> </label>  
    <label>Attachment <input type="file" name="attachment" /></label> 
    <label><input type="submit" name="button" value="Submit" /></label> 
</form> 
-->
