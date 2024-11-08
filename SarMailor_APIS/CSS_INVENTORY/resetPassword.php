<? 
include($_SERVER['DOCUMENT_ROOT'].'/SarMailor_APIS/phpmail/src/PHPMailer.php');
include($_SERVER['DOCUMENT_ROOT'].'/SarMailor_APIS/phpmail/src/SMTP.php');
include($_SERVER['DOCUMENT_ROOT'].'/SarMailor_APIS/phpmail/src/Exception.php');

include($_SERVER['DOCUMENT_ROOT'].'/SarMailor_APIS/CSS_INVENTORY/config.php');




$EmailSubject = $_REQUEST['subject'];
$message = $_REQUEST['message'];


$bcc = $_REQUEST['bcc'];    //array
$to = $_REQUEST['to'];      //array
$cc = $_REQUEST['cc'];      //array

$mailheader = "From: ".$from."\r\n"; 
$mailheader .= "Reply-To: ".$from."\r\n"; 


$mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP();											
	$mail->Host	 = 'mail.sarmicrosystems.in';					
	$mail->SMTPAuth = true;							
	$mail->Username = 'cssinventory@sarmicrosystems.in';				
	$mail->Password = 'cssinventory';						
	$mail->SMTPSecure = 'tls';							
	$mail->Port	 = 587;
	
    //Recipients
    $mail->setFrom($from,$fromname);
    $mail->From = trim($from);
    $mail->FromName = $fromname;
    
    foreach($to as $key=>$val){
            $mail->addAddress($val);         
    }

    foreach($cc as $keycc=>$valcc){
        $mail->addCC($valcc);
    }
    
    foreach($bcc as $keybcc=>$valbcc){
        $mail->addCC($valbcc);
    }
    
    $mail->mailheader=$mailheader;// Add a recipient

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message;
    
    if($mail->send()){
        echo 1;
    }else{
        echo 0;
    }
    
?>