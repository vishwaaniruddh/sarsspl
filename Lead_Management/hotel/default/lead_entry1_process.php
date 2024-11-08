<?php session_Start();
include ('config.php');

 $sesid=$_SESSION['id'];

// echo $sesid;
$FirstName=$_POST['FirstName'];
$LastName=$_POST['LastName'];
$fullname=$FirstName." ".$LastName;
$mcode1=$_POST['mcode1'];
$mob1=$_POST['mob1'];
$Contact1code=$_POST['Contact1code'];
$offNum=$_POST['offNum'];
$state=$_POST['state'];
$City=$_POST['City'];
$Company=$_POST['Company'];
$Designation=$_POST['Designation'];
$Gmail=$_POST['Gmail'];
$Source=$_POST['Source'];
$Pincode=$_POST['Pincode'];

date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');


$sql="insert into Leads_table(Title,FirstName,LastName,MobileCode,MobileNumber,contact1Code,ContactNo1,ContactNo2,ContactNo3,EmailId,FacebookId,Country,State,City,PinCode,Nationality,Company,Designation,DelegationStatus,Creation,LeadSource,Status,leadEntryef,Hotel_Name) values('','".$FirstName."','".$LastName."','".$mcode1."','".$mob1."','".$Contact1code."','".$offNum."','','','".$Gmail."','','','".$state."','".$City."','$Pincode','','".$Company."','".$Designation."','','".$dates."','".$Source."','0','".$_SESSION['id']."','2')";
$runsql=mysqli_query($conn,$sql);





//echo $sql;
if($runsql){



include ('sendSMS.php');




    
    //===========for mail===============
$sqlHotelAssociate="select * from HotelUsers where id='".$sesid."' ";
$queryHotelAssociate=mysqli_query($conn,$sqlHotelAssociate);
$fetchHotelAssociate=mysqli_fetch_array($queryHotelAssociate);



//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
//whether ip is from remote address
else
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }
//echo $ip_address;






$EmailSubject="Thank you, lead submitted successfully!";

   $MESSAGE_BODY="";
   $MESSAGE_BODY.="Sincerely,"."\r\n";
   $MESSAGE_BODY.="Team The Orchid Pune,"."\r\n";
      
     $message="Dear ".$fullname."\r\n"."Thank you for your interest in our membership program at The Orchid Pune. We are scheduled to launch the membership in the first week of April. One of our associates will call you to discuss the member benefits and enroll you as a patron member with us."."\r\n";
            
        $leadsmail=" Orchidmembership@loyaltician.com";
        $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 
/*require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';*/

$mail = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'sarmicrosystems.in';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ram@sarmicrosystems.in';                 // SMTP username
    $mail->Password = 'ram1234*';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('leads@loyaltician.com','loyaltician');
   // $mail->addAddress($Gmail); 
   $mail->addAddress('meanand.gupta21@gmail.com'); 
    $mail->mailheader=$mailheader;// Add a recipient
  //  $mail->addCC('leads@loyaltician.com');
   // $mail->addBCC('admin@loyaltician.com ');
   // $mail->addBCC('meanand.gupta21@gmail.com');
    
    
    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message."\r\n".$MESSAGE_BODY;
    $mail->send();
//==============mail end===

    
    
    
$EmailSubject1="New Lead Added successfully!";

   $MESSAGE_BODY1="";
   // $MESSAGE_BODY1.="Sincerely,"."\r\n";
   //$MESSAGE_BODY1.="Team The Orchid Pune,"."\r\n";
      
       // $message="Dear ".$fullname."\r\n"."Thank you for your interest in our membership program at The Orchid Pune. We are scheduled to launch the membership in the first week of April. One of our associates will call you to discuss the member benefits and enroll you as a patron member with us."."\r\n";
        $m=$fetchHotelAssociate['hotelname'];
        $message1.='<table border="1">';
        $message1.='<tr>';
        $message1.='<th>Hotel Associate Name</th>';
         $message1.='<td>'.$m.'</td>';
        $message1.='</tr><tr>';
        $message1.='<th>Date & Time</th>';
        $message1.='<td>'.$dates.'</td>';
        $message1.='</tr><tr>';
        $message1.='<th>First Name</th>';
        $message1.='<td>'.$FirstName.'</td>';
        $message1.='</tr><tr>';
        $message1.='<th>Last Name</th>';
        $message1.='<td>'.$LastName.'</td>';
        $message1.='</tr><tr>';
        $message1.='<th>Mobile Number</th>';
        $message1.='<td>'.$mcode1." ".$mob1.'</td>';
        $message1.='</tr><tr>';
        $message1.='<th>Office Number</th>';
         $message1.='<td>'.$Contact1code." ".$offNum.'</td>'; 
        $message1.='</tr><tr>';
        $message1.='<th>Email ID</th>';
        $message1.='<td>'.$Gmail.'</td>';
        $message1.='</tr><tr>';
        $message1.='<th>Company</th>'; 
         $message1.='<td>'.$Company.'</td>'; 
        $message1.='</tr><tr>';
        $message1.='<th>Designation</th>'; 
        $message1.='<td>'.$Designation.'</td>';
        $message1.='</tr><tr>';
        $message1.='<th>City</th>';
         $message1.='<td>'.$City.'</td>'; 
          $message1.='</tr><tr>';
          $message1.='<th>IP Address</th>';
         $message1.='<td>'.$ip_address.'</td>'; 
        $message1.='</tr>';
        
        
         
            
        $leadsmail1=" Orchidmembership@loyaltician.com";
        $mailheader1 = "From: ".$leadsmail1."\r\n"; 
    $mailheader1 .= "Reply-To: ".$leadsmail1."\r\n"; 
 
//require '../../phpmail/src/PHPMailer.php';
//require '../../phpmail/src/SMTP.php';

$mail1 = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail1->isSMTP();                                      // Set mailer to use SMTP
    $mail1->Host = 'sarmicrosystems.in';  // Specify main and backup SMTP servers
    $mail1->SMTPAuth = true;                               // Enable SMTP authentication
    $mail1->Username = 'ram@sarmicrosystems.in';                 // SMTP username
    $mail1->Password = 'ram1234*';                           // SMTP password
    $mail1->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail1->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail1->setFrom('leads@loyaltician.com','loyaltician');
    $mail1->addAddress('leads@loyaltician.com'); 
    $mail1->mailheader=$mailheader1;// Add a recipient
 
    $mail1->addBCC('kvaljani@gmail.com ');
     $mail1->addCC('meanand.gupta21@gmail.com');
    
    
    $mail1->isHTML(true);                                  // Set email format to HTML
    $mail1->Subject = $EmailSubject1."\r\n";
    $mail1->Body    = $message1."\r\n".$MESSAGE_BODY1;
    $mail1->send();
//==============mail end===

  
   echo '1';
}else{
    echo '0';
  //  echo "ram";

}
?>