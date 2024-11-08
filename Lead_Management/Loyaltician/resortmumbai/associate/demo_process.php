<?php session_Start();
include ('config.php');

 $sesid=$_SESSION['id'];
?>

<html>
    <head>
        
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>
    <body>
        

<?
// echo $sesid;
$FirstName=$_POST['FirstName'];
$LastName=$_POST['LastName'];
$fullname=$FirstName." ".$LastName;
$mcode1=$_POST['mcode1'];
$mob1=$_POST['mob1'];
$Contact1code=$_POST['Contact1code'];
$offNum=$_POST['offNum'];

// $state=$_POST['state'];
// $City=$_POST['City'];

$state='';
 $City='';




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







    
    
$EmailSubject1="New Lead Added successfully!";

       $MESSAGE_BODY1="";
        $m=$fetchHotelAssociate['hotelname'];
        $message1.='<table border="1">';
        $message1.='<tr>';
        $message1.='<th>Hotel Associate Name</th>';
         $message1.='<td>'.$_SESSION['user'].'</td>';
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
          $message1.='</tr><tr>';
          $message1.='<th>IP Address</th>';
         $message1.='<td>'.$ip_address.'</td>'; 
        $message1.='</tr>';
        
        
         
            
        $leadsmail1=" Orchidmembership@loyaltician.com";
        $mailheader1 = "From: ".$leadsmail1."\r\n"; 
    $mailheader1 .= "Reply-To: ".$leadsmail1."\r\n"; 
 
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'phpmail/src/Exception.php';

$mail1 = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail1->isSMTP();                                      // Set mailer to use SMTP
    $mail1->Host = 'mail.theresortexperiences.com';  // Specify main and backup SMTP servers
    $mail1->SMTPAuth = true;                               // Enable SMTP authentication
    $mail1->Username = 'contactus@theresortexperiences.com';                 // SMTP username
    $mail1->Password = '94Z6g.;d1CSq';                           // SMTP password
    $mail1->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail1->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail1->setFrom('contactus@theresortexperiences.com','The Resort Mumbai');
    
    
    // $mail1->addAddress('contactus@theresortexperiences.com');
    // $mail1->addCC('hitesh.gunwani@outlook.com');
    $mail1->addBCC('vishwaaniruddh@gmail.com');
    
    
    // $mail1->addAddress('contactus@theresortexperiences.com'); 

    $mail1->mailheader=$mailheader1;// Add a recipient
 

    
    
    $mail1->isHTML(true);                                  // Set email format to HTML
    $mail1->Subject = $EmailSubject1."\r\n";
    $mail1->Body    = $message1."\r\n".$MESSAGE_BODY1;
    $mail1->send();
//==============mail end===

?>

<script>
         swal({
  title: "Success!",
  text: "Thank you, the lead has been recorded.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    window.open("lead_entry1.php","_self");
  } 
});

</script>
<?
}else{
?>
<script>
  swal("error");
   window.open("lead_entry1.php","_self");  
</script>
  

<?

}
?>


    </body>
</html>