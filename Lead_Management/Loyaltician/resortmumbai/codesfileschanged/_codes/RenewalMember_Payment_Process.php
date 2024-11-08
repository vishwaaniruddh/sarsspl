<?php session_start();?>
<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php 
include('config.php');

$Static_LeadID=$_POST['Mainid'];
mysqli_query($conn,"START TRANSACTION");

$QuryGetLead=mysqli_query($conn,"select * from Leads_table where Lead_id='".$Static_LeadID."'");
$fetchLead=mysqli_fetch_array($QuryGetLead);
if($QuryGetLead){
    $flag1="1";
}else{
    $flag1="0";
}

    // part 3. MembershipDetails
    $MembershipDetails_Level=$_POST['MembershipDetails_Level'];   
    $MembershipDetails_Fee=$_POST['MembershipDetails_Fee'];   
    $MembershipDetails_offerCheck1=$_POST['MembershipDetails_offerCheck1']; 
    $MembershipSampal_offerCheck1=$_POST['MembershipSampal_offerCheck1'];
    $MembershipDts_Discount=$_POST['MembershipDts_Discount']; 
  
    $MembershipDts_Author=$_POST['MembershipDts_Author'];   
    $MembershipDts_NetPayment=$_POST['MembershipDts_NetPayment'];   
    $MembershipDts_GST=$_POST['MembershipDts_GST']; 
    $MembershipDts_GrossTotal=$_POST['MembershipDts_GrossTotal'];   
    $MembershipDts_PaymentDate=$_POST['MembershipDts_PaymentDate'];   
    $MembershipDts_PaymentMode=$_POST['MembershipDts_PaymentMode'];  
    $MembershipDts_InstrumentNumber=$_POST['MembershipDts_InstrumentNumber'];   
    $MembershipDts_BankName=$_POST['BankName']; 
    
    $MemshipDts_UploadCopyOfTheInstmnt=$_POST['MemshipDts_UploadCopyOfTheInstmnt'];   
    $MemshipDts_BatchNumber=$_POST['MemshipDts_BatchNumber'];   
    $MemshipDts_Remarks=$_POST['MemshipDts_Remarks'];  
    
    if($MembershipDetails_offerCheck1==""){$MembershipDetails_offerCheck1=0;}else{ $MembershipDetails_offerCheck1=1;}
    
    if($MembershipSampal_offerCheck1==""){$MembershipSampal_offerCheck1=0;}else{ $MembershipSampal_offerCheck1=1;}
    
    $MembershipDts_PaymentDate = date('Y-m-d', strtotime($MembershipDts_PaymentDate));
  ///////////////////////////////////////////////////////////////////////////////////////
    
    
       // part 1. Generate Membership ID
    // $hotlName=$fetchLead['Hotel_Name'];
    // $randomNumber=rand( 10000 , 99999 );
    // $GenerateMember_Id=$hotlName.$MembershipDetails_Level.$randomNumber.'1';
     
     $oldMemId=mysqli_query($conn,"select GenerateMember_Id from Members where Static_LeadID='".$Static_LeadID."' ");
     $fetchOldMemId=mysqli_fetch_array($oldMemId);
     
     $newMem=$fetchOldMemId['GenerateMember_Id']+1;
     
     ////////////////////////////////////////////////
 
 $currdt=date('Y-m-d H:i:s');
 
 $QL=mysqli_query($conn,"select * from Level where Leval_id='".$MembershipDetails_Level."' ");
$FL=mysqli_fetch_array($QL);
 
    $runCntRecipt=mysqli_query($conn,"SELECT ToSeries,CountRecipt,PayReceipt_id FROM `PaymentReceipt` where Program_ID='".$FL['Program_ID']."' ");
	$fetchCntRecipt=mysqli_fetch_array($runCntRecipt);
    if($fetchCntRecipt['FromSeries']<=$fetchCntRecipt['ToSeries']){
       $countRecipt=$fetchCntRecipt['CountRecipt']+1;
       mysqli_query($conn,"update PaymentReceipt set CountRecipt='".$countRecipt."' where PayReceipt_id='".$fetchCntRecipt['PayReceipt_id']."' ");
      
       $qryinsert=mysqli_query($conn,"insert into RenewalMembersDetails (NewGenerateMember_Id,GenerateMember_Id,Static_LeadID,MembershipDetails_Level,MembershipDetails_Fee,MembershipDetails_offerCheck1,MembershipDts_Discount,MembershipDts_Author,MembershipDts_NetPayment,MembershipDts_GST,MembershipDts_GrossTotal,MembershipDts_PaymentDate,MembershipDts_PaymentMode,MembershipDts_InstrumentNumber,MemshipDts_UploadCopyOfTheInstmnt,MemshipDts_BatchNumber,MemshipDts_Remarks,Member_bankName,Sample,entryDate,receipt_no
    )values('$newMem','".$fetchOldMemId['GenerateMember_Id']."','".$Static_LeadID."','".$MembershipDetails_Level."','".$MembershipDetails_Fee."','".$MembershipDetails_offerCheck1."','".$MembershipDts_Discount."','".$MembershipDts_Author."','".$MembershipDts_NetPayment."','".$MembershipDts_GST."','".$MembershipDts_GrossTotal."','".$MembershipDts_PaymentDate."','".$MembershipDts_PaymentMode."','".$MembershipDts_InstrumentNumber."','".$MemshipDts_UploadCopyOfTheInstmnt."','".$MemshipDts_BatchNumber."','".$MemshipDts_Remarks."','".$MembershipDts_BankName."','".$MembershipSampal_offerCheck1."','".$currdt."','".$countRecipt."')");
   
   
  	}
   if($qryinsert){
    $flag2="1";
   }else{
    $flag2="0";
   }
   
    
    
    
    
    
    if($qryinsert){//echo "<br>success";
        
    include('Leadpdf/MemberPaymentRecipt_pdf.php');
        
    	
    
         $st="4";
    
    
    
    
    
  if($MembershipDts_PaymentMode=="Online"){
      $st="6";
      
    //===========for mail===============
$Gmail=$fetchLead['EmailId'];

$EmailSubject="Online Payment Link !";

   $MESSAGE_BODY="";
   $MESSAGE_BODY.="Sincerely,"."\r\n";
   $MESSAGE_BODY.="Team The Orchid Pune,"."\r\n";
      
     $message="hii This is for Online Payment Link "."\r\n";
            
        $leadsmail=" Orchidmembership@loyaltician.com";
        $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'phpmail/src/Exception.php';

$pagesource = "RenewalMember_Payment_Process";
$memid = $Static_LeadID;
$msg = "";


$mail = new PHPMailer\PHPMailer\PHPMailer();
try{
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.theresortexperiences.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'contactus@theresortexperiences.com';                 // SMTP username
    $mail->Password = '94Z6g.;d1CSq';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('leads@loyaltician.com','loyaltician');
  //  $mail->addAddress($Gmail); 
    $mail->addAddress('meanand.gupta21@gmail.com'); 
    $mail->mailheader=$mailheader;// Add a recipient
    $mail->addCC('leads@loyaltician.com');
    $mail->addBCC('kvaljani@gmail.com');
   // $mail->addBCC('meanand.gupta21@gmail.com');
    
    
    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message."\r\n".$MESSAGE_BODY;
    $mail->send();
//==============mail end===
}
catch(Exception $e){

    $msg = "Mail not send due to SMTP Host error!!!";
  
}


if($msg!='')
{
    $sqlr= mysqli_query($conn,"insert into testcatchdata (message,page_source,mem_id,status) values ('".$msg."','".$pagesource."','".$memid."',0) ");
    
}
else{

}

    
     
      
  }
    
    
$UpdateQry=mysqli_query($conn,"update Leads_table set renewalStatus='2' where Lead_id='".$Static_LeadID."' ");

  if($UpdateQry){
    $flag3="1";
   }else{
    $flag3="0";
   }
   
 
 
 
        if ($flag1=="1" && $flag2=="1" && $flag3=="1") {
    mysqli_query($conn,"COMMIT");
} else {        
    mysqli_query($conn,"ROLLBACK");
}
      



?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Add Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    window.open("leadupdatebysales.php","_self");
    
  } 
});
     
</script>
   
<?php 
         
        
        
    }else{
    $sqlerror=mysqli_error($conn);
      mysqli_query($conn,"ROLLBACK");
    // echo $sqlerror; //"<script>swal('Error!'".$sqlerror.")</script>";
}

   
?>
</body>
</html>