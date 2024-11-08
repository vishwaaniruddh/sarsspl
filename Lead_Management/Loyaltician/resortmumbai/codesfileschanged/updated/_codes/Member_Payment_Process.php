<?php session_start(); ?>
<html>

<head>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <?php
    include ('config.php');


    $Static_LeadID = $_POST['Mainid'];

    $pagesource = "Member_Payment_Process";
    $memid = $Static_LeadID;
    $msg = "";
    $member_id = $GenerateMember_Id;

    $hostusername = 'contactus@theresortexperiences.com';

    // $host = 'mail.theresortexperiences.com';
// $hostpassword = '94Z6g.;d1CSq';
// $port = '587';
    
    $host = 'smtp.hostinger.com';
    $hostpassword = 'mckyaUC,?z5H';
    $port = '587';

    // $nodes = 'https://arpeeindustries.com/mail.php';
    $nodes = 'https://sarmicrosystems.in/SarMailor_APIS/mail.php';

    mysqli_query($conn, "START TRANSACTION");

    $QuryGetLead = mysqli_query($conn, "select * from Leads_table where Lead_id='" . $Static_LeadID . "'");
    $fetchLead = mysqli_fetch_array($QuryGetLead);
    if ($QuryGetLead) {
        $flag1 = "1";
    } else {
        $flag1 = "0";
    }


    // part 3. MembershipDetails
    $MembershipDetails_Level = $_POST['MembershipDetails_Level'];


    if ($MembershipDetails_Level == 1) {
        $firstchar = 2;
    } else if ($MembershipDetails_Level == 2) {
        $firstchar = 4;
    } else if ($MembershipDetails_Level == 3) {
        $firstchar = 8;
    }

    $MembershipDetails_Fee = $_POST['MembershipDetails_Fee'];
    $MembershipDetails_offerCheck1 = $_POST['MembershipDetails_offerCheck1'];
    $MembershipSampal_offerCheck1 = $_POST['MembershipSampal_offerCheck1'];
    $MembershipDts_Discount = $_POST['MembershipDts_Discount'];

    $MembershipDts_Discount_Remark = $_POST['MembershipDts_Discount_Remark'];

    $MembershipDts_Author = $_POST['MembershipDts_Author'];
    $MembershipDts_NetPayment = $_POST['MembershipDts_NetPayment'];
    $MembershipDts_GST = $_POST['MembershipDts_GST'];
    $MembershipDts_GrossTotal = $_POST['MembershipDts_GrossTotal'];
    $MembershipDts_PaymentDate = $_POST['MembershipDts_PaymentDate'];
    $MembershipDts_PaymentMode = $_POST['MembershipDts_PaymentMode'];
    $MembershipDts_InstrumentNumber = $_POST['MembershipDts_InstrumentNumber'];
    $MembershipDts_BankName = $_POST['BankName'];

    $MemshipDts_UploadCopyOfTheInstmnt = $_POST['MemshipDts_UploadCopyOfTheInstmnt'];
    $MemshipDts_BatchNumber = $_POST['MemshipDts_BatchNumber'];
    $MemshipDts_Remarks = $_POST['MemshipDts_Remarks'];

    if ($MembershipDetails_offerCheck1 == "") {
        $MembershipDetails_offerCheck1 = 0;
    } else {
        $MembershipDetails_offerCheck1 = 1;
    }

    if ($MembershipSampal_offerCheck1 == "") {
        $MembershipSampal_offerCheck1 = 0;
    } else {
        $MembershipSampal_offerCheck1 = 1;
    }

    $MembershipDts_PaymentDate = date('Y-m-d', strtotime($MembershipDts_PaymentDate));
    ///////////////////////////////////////////////////////////////////////////////////////
    

    // part 1. Generate Membership ID
    $hotlName = $fetchLead['Hotel_Name'];
    $randomNumber = rand(10000, 99999);



    //  $GenerateMember_Id=$hotlName.$MembershipDetails_Level.$randomNumber.'1';
    $GenerateMember_Id = '1' . $firstchar . $randomNumber . '1';


    ////////////////////////////////////////////////
    
    $currdt = date('Y-m-d H:i:s');

    $QL = mysqli_query($conn, "select * from Level where Leval_id='" . $MembershipDetails_Level . "' ");
    $FL = mysqli_fetch_array($QL);

    $runCntRecipt = mysqli_query($conn, "SELECT ToSeries,CountRecipt,PayReceipt_id FROM `PaymentReceipt` where Program_ID='" . $FL['Program_ID'] . "'");
    $fetchCntRecipt = mysqli_fetch_array($runCntRecipt);


    if ($fetchCntRecipt['FromSeries'] <= $fetchCntRecipt['ToSeries']) {

        $countRecipt = $fetchCntRecipt['CountRecipt'] + 1;

        mysqli_query($conn, "update PaymentReceipt set CountRecipt='" . $countRecipt . "' where PayReceipt_id='" . $fetchCntRecipt['PayReceipt_id'] . "' ");

        $statement = "insert into Members(GenerateMember_Id, Static_LeadID, Primary_Title, Primary_Pincode, Primary_mcode2, Primary_mob2, Primary_Contact1code, Primary_Contact1, Primary_Contact2code, Primary_Contact2, Primary_Contact3code, Primary_Contact3, Primary_nameOnTheCard, Primary_PhotoUpload, Primary_Email_ID2, Primary_DateOfBirth, Primary_AddressType1, Primary_BuldNo_addrss, Primary_Area_addrss, Primary_Landmark_addrss, Primary_MaritalStatus, Spouse_Title, Spouse_FirstName, Spouse_LastName, Spouse_GmailMArrid1, Spouse_GmailMArrid2, Spouse_PhotoUpload, Spouse_mcode1Married1, Spouse_mob1MArid1, Spouse_mcode1Married2, Spouse_mob1MArid2, Spouse_Contact1codeMArid, Spouse_Contact1Married, Spouse_Contact2codeMArid, Spouse_Contact2Married, Spouse_nameOnTheCardMarried, MembershipDetails_Level, MembershipDetails_Fee, MembershipDetails_offerCheck1, MembershipDts_Discount,MembershipDts_Discount_Remark, MembershipDts_Author, MembershipDts_NetPayment, MembershipDts_GST, MembershipDts_GrossTotal, MembershipDts_PaymentDate, MembershipDts_PaymentMode, MembershipDts_InstrumentNumber, MemshipDts_UploadCopyOfTheInstmnt, MemshipDts_BatchNumber, MemshipDts_Remarks, Documentation_UploadSignatures, Documentation_AddressProof, Relationships_ReferredByLEADID, Relationships_ReferredByMEMBERSHIPID, itemCheck1, BookletCheck1, CertificatesCheck1, PromotionalCheck1, Issue_ReferredByLEADID, Issue_ReferredByMEMBERSHIPID, Member_bankName, Sample, entryDate, receipt_no )   values('" . $GenerateMember_Id . "', '" . $Static_LeadID . "', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '" . $MembershipDetails_Level . "', '" . $MembershipDetails_Fee . "', '" . $MembershipDetails_offerCheck1 . "', '" . $MembershipDts_Discount . "','" . $MembershipDts_Discount_Remark . "', '" . $MembershipDts_Author . "', '" . $MembershipDts_NetPayment . "', '" . $MembershipDts_GST . "', '" . $MembershipDts_GrossTotal . "', '" . $MembershipDts_PaymentDate . "', '" . $MembershipDts_PaymentMode . "', '" . $MembershipDts_InstrumentNumber . "', '" . $MemshipDts_UploadCopyOfTheInstmnt . "', '" . $MemshipDts_BatchNumber . "', '" . $MemshipDts_Remarks . "', '', '', '', '', '', '', '', '', '', '', '" . $MembershipDts_BankName . "', '" . $MembershipSampal_offerCheck1 . "', '" . $currdt . "', '" . $countRecipt . "')";

        $qryinsert = mysqli_query($conn, $statement);
    }





    if ($qryinsert) {
        $flag2 = "1";
    } else {
        $flag2 = "0";
    }


    if ($qryinsert) {

        //echo "<br>success";
    
        include ('Leadpdf/MemberPaymentRecipt_pdf.php');


        $st = "4";





        if ($MembershipDts_PaymentMode == "Online") {
            $st = "6";

            //===========for mail===============
            $Gmail = $fetchLead['EmailId'];

            $EmailSubject = "Online Payment Link !";

            $MESSAGE_BODY = "";
            $MESSAGE_BODY .= "Sincerely, " . "\r\n";
            $MESSAGE_BODY .= "The Resort Mumbai," . "\r\n";

            $message = "hii This is for Online Payment Link " . "\r\n";

            $leadsmail = " contactus@theresortexperiences.com";
            $mailheader = "From: " . $leadsmail . "\r\n";
            $mailheader .= "Reply-To: " . $leadsmail . "\r\n";


            $subject = $EmailSubject;
            $message = $message;
            $leadsmail = $leadsmail;

            $from = 'contactus@theresortexperiences.com';
            $fromname = 'The Resort Mumbai';



            $to = ['contactus@theresortexperiences.com'];
            $cc = ['leads@loyaltician.com'];
            $bcc = [];

            $data = array(
                'subject' => $subject,
                'message' => $message,
                'leadsmail' => $leadsmail,
                'host' => $host,
                'hostusername' => $hostusername,
                'hostpassword' => $hostpassword,
                'port' => $port,
                'from' => $from,
                'fromname' => $fromname,
                'to' => $to,
                'cc' => $cc,
                'bcc' => $bcc,
            );

            $options = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data)
                )
            );

            $context = stream_context_create($options);
            $result = file_get_contents($nodes, false, $context);

            // require_once 'phpmail/src/PHPMailer.php';
// require_once 'phpmail/src/SMTP.php';
// require_once 'phpmail/src/Exception.php';
    
            // $newmail = new PHPMailer\PHPMailer\PHPMailer();
// try{
//     //Server settings
//     //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
//     $newmail->isSMTP();                                      // Set mailer to use SMTP
//     $newmail->Host = 'mail.theresortexperiences.com';  // Specify main and backup SMTP servers
//     $newmail->SMTPAuth = true;                               // Enable SMTP authentication
//     $newmail->Username = 'contactus@theresortexperiences.com';                 // SMTP username
//     $newmail->Password = '94Z6g.;d1CSq';                           // SMTP password
//     $newmail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//     $newmail->Port = 587;                                    // TCP port to connect to
    
            //     //Recipients
//     $newmail->setFrom('contactus@theresortexperiences.com','The Resort Mumbai');
    
            //     // $mail->addAddress($Gmail); 
//   // $mail->addAddress('meanand.gupta21@gmail.com'); 
//     $newmail->mailheader=$mailheader;// Add a recipient
    

            //     // $mail->addCC('leads@loyaltician.com');
//     $newmail->addBCC('vishwaaniruddh@gmail.com');
    


            //     $newmail->isHTML(false);                                  // Set email format to HTML
//     $newmail->Subject = $EmailSubject."\r\n";
//     $newmail->Body    = $message."\r\n".$MESSAGE_BODY;
//     $newmail->send();
// }
// //==============mail end===
// catch(Exception $e){
//     $msg = "Mail not send due to SMTP Host error!!!";
// }
//   if($msg!='')
// {
//     $sqlr= mysqli_query($conn,"insert into testcatchdata (message,page_source,membership_id,mem_id,status) values ('".$msg."','".$pagesource."','".$member_id."','".$memid."',0) ");
    
            // }
    



        }


        $UpdateQry = mysqli_query($conn, "update Leads_table set Status='" . $st . "' where Lead_id='" . $Static_LeadID . "' ");

        if ($UpdateQry) {
            $flag3 = "1";
        } else {
            $flag3 = "0";
        }




        if ($flag1 == "1" && $flag2 == "1" && $flag3 == "1") {
            mysqli_commit($conn);
        } else {
            mysqli_rollback($conn);
            ;
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
                            window.open("leadupdatebysales.php", "_self");

                        }
                    });

            </script>

            <?php



    } else {
        $sqlerror = mysqli_error($conn);
        mysqli_rollback($conn);
        ;
        // echo $sqlerror; //"<script>swal('Error!'".$sqlerror.")</script>";
    }


    ?>
</body>

</html>