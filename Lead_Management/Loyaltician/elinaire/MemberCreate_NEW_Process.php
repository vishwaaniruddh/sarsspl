<html>

<head>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
</head>

<body>
  <?php
  include ('config.php');



  date_default_timezone_set('Asia/Kolkata');
  $dates = date('Y-m-d H:i:s');


  //static Post Data                      
  
  $Static_LeadSource = $_POST['Static_LeadSource'];

  $Static_AssignedTo = $_POST['Static_AssignedTo'];

  /////////////////////////////////////////////////////
  
  //  Part 1. Primary Member Entry
  $Primary_Title = $_POST['Primary_Title'];
  $Primary_FirstName = $_POST['Primary_FirstName'];
  $Primary_LastName = $_POST['Primary_LastName'];
  $Primary_Company = $_POST['Primary_Company'];
  $Primary_Designation = $_POST['Primary_Designation'];
  $Primary_State = $_POST['Primary_State'];
  $Primary_City = $_POST['Primary_City'];
  $Primary_Country = $_POST['Primary_Country'];
  $Primary_Pincode = $_POST['Primary_Pincode'];
  $Primary_Gmail_1 = $_POST['Primary_Gmail_1'];
  $Primary_mcode1 = $_POST['Primary_mcode1'];
  $Primary_mob1 = $_POST['Primary_mob1'];
  $Primary_mcode2 = $_POST['Primary_mcode2'];
  $Primary_mob2 = $_POST['Primary_mob2'];
  $Primary_Contact1code = $_POST['Primary_Contact1code'];
  $Primary_Contact1 = $_POST['Primary_Contact1'];
  $Primary_Contact2code = $_POST['Primary_Contact2code'];
  $Primary_Contact2 = $_POST['Primary_Contact2'];
  $Primary_Contact3code = $_POST['Primary_Contact3code'];
  $Primary_Contact3 = $_POST['Primary_Contact3'];
  $Primary_nameOnTheCard = $_POST['Primary_nameOnTheCard'];
  $Primary_PhotoUpload = $_POST['Primary_PhotoUpload'];
  $Primary_Email_ID2 = $_POST['Primary_Email_ID2'];
  $Primary_DateOfBirth = $_POST['Primary_DateOfBirth'];
  $Anniversary = $_POST['Primary_Anniversary'];
  $Primary_AddressType1 = $_POST['Primary_AddressType1'];
  $Primary_BuldNo_addrss = $_POST['Primary_BuldNo_addrss'];
  $Primary_Area_addrss = $_POST['Primary_Area_addrss'];
  $Primary_Landmark_addrss = $_POST['Primary_Landmark_addrss'];
  $Primary_MaritalStatus = $_POST['Primary_MaritalStatus'];
  $Nationality = 'Indian';
  $Hotel = '2';
  $DOB = date('Y-m-d', strtotime($Primary_DateOfBirth));
  $Primary_Anniversary = date('Y-m-d', strtotime($Anniversary));
  /////////////////////////////////////////////////////////////
  

  // part 2.Spouse
  $Spouse_Title = $_POST['Spouse_Title'];
  $Spouse_FirstName = $_POST['Spouse_FirstName'];
  $Spouse_LastName = $_POST['Spouse_LastName'];
  $Spouse_GmailMArrid1 = $_POST['Spouse_GmailMArrid1'];
  $Spouse_GmailMArrid2 = $_POST['Spouse_GmailMArrid2'];
  $Spouse_PhotoUpload = $_POST['Spouse_PhotoUpload'];
  $Spouse_mcode1Married1 = $_POST['Spouse_mcode1Married1'];
  $Spouse_mob1MArid1 = $_POST['Spouse_mob1MArid1'];
  $Spouse_mcode1Married2 = $_POST['Spouse_mcode1Married2'];
  $Spouse_mob1MArid2 = $_POST['Spouse_mob1MArid2'];
  $Spouse_Contact1codeMArid = $_POST['Spouse_Contact1codeMArid'];
  $Spouse_Contact1codeMArid = $_POST['Spouse_Contact1codeMArid'];
  $Spouse_Contact1Married = $_POST['Spouse_Contact1Married'];
  $Spouse_Contact2codeMArid = $_POST['Spouse_Contact2codeMArid'];
  $Spouse_Contact2Married = $_POST['Spouse_Contact2Married'];
  $Spouse_nameOnTheCardMarried = $_POST['Spouse_nameOnTheCardMarried'];
  ////////////////////////////////////////////////////////////////////////
  

  $MembershipDetails_Level = $_POST['MembershipDetails_Level'];
  $MembershipDetails_Fee = $_POST['MembershipDetails_Fee'];
  $MembershipDetails_offerCheck1 = $_POST['MembershipDetails_offerCheck1'];
  $MembershipSampal_offerCheck1 = $_POST['MembershipSampal_offerCheck1'];
  $MembershipDts_Discount = $_POST['MembershipDts_Discount'];

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
  $GenerateMember_Id = $hotlName . $MembershipDetails_Level . $randomNumber . '1';
  ////////////////////////////////////////////////
  

  // part 4.Documentation
  $Documentation_UploadSignatures = $_POST['Documentation_UploadSignatures'];
  $Documentation_AddressProof = $_POST['Documentation_AddressProof'];

  //////////////////////////////////////////////////////////////////////////////////////
  
  // part 5. Relationships
  $Relationships_ReferredByLEADID = $_POST['Relationships_ReferredByLEADID'];
  $Relationships_ReferredByMEMBERSHIPID = $_POST['Relationships_ReferredByMEMBERSHIPID'];
  /////////////////////////////////////////////////////////////////////////////////////////
  

  // Part 6. Issue Membership
  $itemCheck1 = $_POST['itemCheck1'];
  $BookletCheck1 = $_POST['BookletCheck1'];
  $CertificatesCheck1 = $_POST['CertificatesCheck1'];
  $PromotionalCheck1 = $_POST['PromotionalCheck1'];
  $Issue_ReferredByLEADID = $_POST['Issue_ReferredByLEADID'];
  $Issue_ReferredByMEMBERSHIPID = $_POST['Issue_ReferredByMEMBERSHIPID'];

  if ($itemCheck1 == "") {
    $itemCheck1 = 0;
  } else {
    $itemCheck1 = 1;
  }
  if ($BookletCheck1 == "") {
    $BookletCheck1 = 0;
  } else {
    $BookletCheck1 = 1;
  }
  if ($CertificatesCheck1 == "") {
    $CertificatesCheck1 = 0;
  } else {
    $CertificatesCheck1 = 1;
  }
  if ($PromotionalCheck1 == "") {
    $PromotionalCheck1 = 0;
  } else {
    $PromotionalCheck1 = 1;
  }
  /////////////////////////////////////////////////////////////////////////////////////////////
  
  // part 1. Generate Membership ID
  $hotlName = $_POST['hotlName'];
  $randomNumber = rand(10000, 99999);
  $GenerateMember_Id = $hotlName . $MembershipDetails_Level . $randomNumber . '1';
  ////////////////////////////////////////////////
  


  // Lead entry in LEAD_TABLE
  
  $sql = "insert into Leads_table(Title,FirstName,LastName,MobileCode,MobileNumber,MobileCode2,MobileNumber2,contact1Code,ContactNo1,contact2Code,ContactNo2,contact3Code,ContactNo3,EmailId,FacebookId,Country,State,City,PinCode,Nationality,Company,Designation,DelegationStatus,Creation,LeadSource,Status,leadEntryef,Hotel_Name) values('" . $Primary_Title . "','" . $Primary_FirstName . "','" . $Primary_LastName . "','" . $Primary_mcode1 . "','" . $Primary_mob1 . "','" . $Primary_mcode2 . "','" . $Primary_mob2 . "','" . $Primary_Contact1code . "','" . $Primary_Contact1 . "','" . $Primary_Contact2code . "','" . $Primary_Contact2 . "','" . $Primary_Contact3code . "','" . $Primary_Contact3 . "','" . $Primary_Gmail_1 . "','','" . $Primary_Country . "','" . $Primary_State . "','" . $Primary_City . "','" . $Primary_Pincode . "','" . $Nationality . "','" . $Primary_Company . "','" . $Primary_Designation . "','','" . $dates . "','" . $Static_LeadSource . "','5','" . $_SESSION['id'] . "','" . $Hotel . "')";
  $runsql = mysqli_query($conn, $sql);

  //////////////////////////////////////////////////////////////////////////////
  








  //booklet Assign
  



  $sql4 = "SELECT * FROM `Level` where Leval_id='" . $MembershipDetails_Level . "' ";
  $runsql4 = mysqli_query($conn, $sql4);
  $sql4fetch = mysqli_fetch_array($runsql4);



  $sql5 = "	SELECT FromSerialNo,ToSerialNo,AssignBooklet,Level_id FROM `voucher_Booklet` where Program_ID='" . $sql4fetch['Program_ID'] . "' and Level_id='" . $sql4fetch['Leval_id'] . "'   ";
  $runsql5 = mysqli_query($conn, $sql5);
  $sql5fetch = mysqli_fetch_array($runsql5);

  ///////////////////////////////////////////////////////
  




  if ($sql5fetch['FromSerialNo'] <= $sql5fetch['ToSerialNo']) {

    $levelIncrement = "";
    if ($sql5fetch['Level_id'] == '1') {
      $levelIncrement = '21000';
    } else if ($sql5fetch['Level_id'] == '2') {
      $levelIncrement = '22000';
    } else if ($sql5fetch['Level_id'] == '3') {
      $levelIncrement = '23000';
    }


    if ($sql5fetch['AssignBooklet'] == "0") {
      $AssignBooklet = $levelIncrement . '001';
    } else {
      $remaining = substr($sql5fetch['AssignBooklet'], 5);
      $countR = $remaining + 1;
      $readyToUse = sprintf("%03s", $countR);
      $AssignBooklet = $levelIncrement . $readyToUse;


    }






    // $AssignBooklet= $levelIncrement.$sql5fetch['AssignBooklet']+1;
  

    if ($sql5fetch['ToSerialNo'] >= $AssignBooklet) {



      $qryinsert = mysqli_query($conn, "Update Members set Primary_Title='" . $Primary_Title . "',Primary_Pincode='" . $Primary_Pincode . "',Primary_mcode2='" . $Primary_mcode2 . "',Primary_mob2='" . $Primary_mob2 . "',Primary_Contact1code='" . $Primary_Contact1code . "',Primary_Contact1='" . $Primary_Contact1 . "',Primary_Contact2code='" . $Primary_Contact2code . "',Primary_Contact2='" . $Primary_Contact2 . "',Primary_Contact3code='" . $Primary_Contact3code . "',Primary_Contact3='" . $Primary_Contact3 . "',Primary_nameOnTheCard='" . $Primary_nameOnTheCard . "',Primary_PhotoUpload='" . $Primary_PhotoUpload . "',Primary_Email_ID2='" . $Primary_Email_ID2 . "',Primary_DateOfBirth='" . $DOB . "',Primary_Anniversary='" . $Primary_Anniversary . "',Primary_AddressType1='" . $Primary_AddressType1 . "',Primary_BuldNo_addrss='" . $Primary_BuldNo_addrss . "',Primary_Area_addrss='" . $Primary_Area_addrss . "',Primary_Landmark_addrss='" . $Primary_Landmark_addrss . "',Primary_MaritalStatus='" . $Primary_MaritalStatus . "',Spouse_Title='" . $Spouse_Title . "',Spouse_FirstName='" . $Spouse_FirstName . "',Spouse_LastName='" . $Spouse_LastName . "',Spouse_GmailMArrid1='" . $Spouse_GmailMArrid1 . "',Spouse_GmailMArrid2='" . $Spouse_GmailMArrid2 . "',Spouse_PhotoUpload='" . $Spouse_PhotoUpload . "',Spouse_mcode1Married1='" . $Spouse_mcode1Married1 . "',Spouse_mob1MArid1='" . $Spouse_mob1MArid1 . "',Spouse_mcode1Married2='" . $Spouse_mcode1Married2 . "',Spouse_mob1MArid2='" . $Spouse_mob1MArid2 . "',Spouse_Contact1codeMArid='" . $Spouse_Contact1codeMArid . "',Spouse_Contact1Married='" . $Spouse_Contact1Married . "',Spouse_Contact2codeMArid='" . $Spouse_Contact2codeMArid . "',Spouse_Contact2Married='" . $Spouse_Contact2Married . "',Spouse_nameOnTheCardMarried='" . $Spouse_nameOnTheCardMarried . "',Documentation_UploadSignatures='" . $Documentation_UploadSignatures . "',Documentation_AddressProof='" . $Documentation_AddressProof . "',Relationships_ReferredByLEADID='" . $Relationships_ReferredByLEADID . "',Relationships_ReferredByMEMBERSHIPID='" . $Relationships_ReferredByMEMBERSHIPID . "',itemCheck1='" . $itemCheck1 . "',BookletCheck1='" . $BookletCheck1 . "',CertificatesCheck1='" . $CertificatesCheck1 . "',PromotionalCheck1='" . $PromotionalCheck1 . "',Issue_ReferredByLEADID='" . $Issue_ReferredByLEADID . "',Issue_ReferredByMEMBERSHIPID='" . $Issue_ReferredByMEMBERSHIPID . "',booklet_Series='" . $AssignBooklet . "' where Static_LeadID='" . $Static_LeadID . "' ");


      if ($qryinsert) {

        $UpdateQry = mysqli_query($conn, "update Leads_table set Status='5',MobileCode2='" . $Primary_mcode2 . "', MobileNumber2	='" . $Primary_mob2 . "',contact1Code='" . $Primary_Contact1code . "' ,ContactNo1='" . $Primary_Contact1 . "',contact2Code='" . $Primary_Contact2code . "',ContactNo2='" . $Primary_Contact2 . "',contact3Code='" . $Primary_Contact3code . "',ContactNo3='" . $Primary_Contact3 . "' where Lead_id='" . $Static_LeadID . "' ");
        $UpdateVoucherType = mysqli_query($conn, "update voucher_Booklet set AssignBooklet='" . $AssignBooklet . "' where Level_id='" . $sql5fetch['Level_id'] . "' ");

        $sqlgen = "SELECT GenerateMember_Id,MembershipDts_PaymentMode,entryDate FROM `Members` where Static_LeadID='" . $Static_LeadID . "'";
        $rungen = mysqli_query($conn, $sqlgen);
        $fetchgen = mysqli_fetch_array($rungen);

        $sqlexpiry = "SELECT Expiry_month FROM `validity` where Leval_id='" . $sql4fetch['Leval_id'] . "' ";
        //echo $sqlexpiry;
        $QryExpiry = mysqli_query($conn, $sqlexpiry);
        $fetchExpiry = mysqli_fetch_array($QryExpiry);

        $dd = date('Y-m-d', strtotime($fetchgen['entryDate']));
        $d = strtotime("+" . $fetchExpiry['Expiry_month'] . " months", strtotime($dd));
        //  $R=  date("d-m-Y",$d);
        $formattedValue = date("F, Y", $d);
        $R = $formattedValue;


        if ($sql4fetch['Leval_id'] == '1') {
          // include("Leadpdf/OrchidFirstMember_pdf.php");
  
          //===========for mail Welcome Latter First Orchid Member===============
  
          $EmailSubject2 = "Welcome to Orchid First!";





          $message2 .= '<table width="70%" align="center">';
          // $message2.='<tr><th>The Orchid First Member</th></tr>';
          $message2 .= '<tr>';
          $message2 .= '<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/gold_logo.png" alt="gold_logo.png" />  </th></tr><tr>';

          $message2 .= '<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/FIRST.png" alt="FIRST.png" />    </th>';
          $message2 .= '</tr><tr>';
          $message2 .= '<th style="text-align: left;"><b >Dear ' . $Primary_nameOnTheCard . ' ,</b></th></tr><tr></br>';
          $message2 .= '<td>Welcome to Orchid First and to a host of benefits and privileges that are now yours to enjoy on dining and accommodation at The Orchid Hotel Pune, The Orchid Hotel Mumbai Vile Parle, Fort JadhavGADH Pune, Mahodadhi Palace Puri, Lotus Eco Resort Konark and Lotus Beach Resort Goa with more hotels being added soon.<br><br>
         Your Membership Card number is ' . $fetchgen['GenerateMember_Id'] . '. The membership is valid till ' . $R . ' You may click here to view the Summary of Benefits of the membership.<br><br>
         The annual membership charge of Rs.7,500 + 18% Goods & Services Tax amounting to Rs. 8,850/- (RupeesEight Thousand Eight Hundred and Fifty only) has been received by ' . $fetchgen['MembershipDts_PaymentMode'] . '<br><br>
         You can present your membership number or a copy of this email to start using your membership benefits.<br></br>
         The complete welcome package will reach you within 10 working days of this e-mail. Your membership gift certificates along with the membership are given at the bottom of this email.<br><br>
         We look forward to welcoming you as our esteemed Orchid First member.<br></br>
         </td>';


          $message2 .= '</tr></table>';


          $message2 .= '</table>';


          $message2 .= '<table width="70%" align="center">';
          $message2 .= '<tr height="5px">
<td><br>Yours sincerely<br><b>Team Orchid First </b><br>+91 9169166789 <br>www.orchidhotel.com</td>

</tr>';
          $message2 .= '</table>';

          $message2 .= '<table border="1" width="50%" align="center">';
          $message2 .= '<tr>';
          $message2 .= '<th colspan="3">Gift Certificates issued</th>';
          $message2 .= '</tr><tr>';
          $message2 .= '<th>SN</th><th>Type</th><th>Certificate Number</th>';



          $srno = 1;

          $qry = "select Leval_id,level_name from Level where Leval_id='" . $sql4fetch['Leval_id'] . "' ";
          $did = $sql4fetch['Leval_id'];
          $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='" . $did . "'";
          //echo $sql2;
          $runsql2 = mysqli_query($conn, $sql2);
          while ($sql2fetch = mysqli_fetch_array($runsql2)) {
            // $sql2fetch['serialNumber'];
  

            $remaining1 = substr($sql2fetch['serialNumber'], 8);
            $value = $sql5fetch['AssignBooklet'] + 1;
            $AssignBooklet1 = $value . $remaining1;



            $message2 .= '
<tr height="5px">
<td>' . $srno . '</td>
<td>' . $sql2fetch['serviceName'] . '</td>
<td>' . $AssignBooklet1 . '</td>
</tr>
';

            $srno++;
          }

          $message2 .= '</table>';

          $message2 .= '<table width="70%" align="center">';
          $message2 .= '<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
          $message2 .= '</table>';


          $message2 .= '<table width="70%" align="center">';
          $message2 .= '<tr ><td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
          $message2 .= '<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
          $message2 .= '<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
          $message2 .= '<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



          $message2 .= '<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited.<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express
consent to communicate with you. We will ensure only high quality / relevant information is sent to you to
manage your membership. If you wish to change any communication preferences, please write to us at
escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com)
and the addressee whose name is specified above. Should you receive this message by mistake, we would be
most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete
this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your
cooperation and understanding.</td></tr>';

          $message2 .= '</table>';


          $leadsmail2 = " Orchidmembership@loyaltician.com";
          $mailheader2 = "From: " . $leadsmail2 . "\r\n";
          $mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";

          require 'phpmail/src/PHPMailer.php';
          require 'phpmail/src/SMTP.php';
          require 'phpmail/src/Exception.php';

          $pagesource = "MemberCreate_NEW_Process";
          $memid = $Static_LeadID;
          $msg = "";


          $mail2 = new PHPMailer\PHPMailer\PHPMailer();
          try {
            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail2->isSMTP();                                      // Set mailer to use SMTP
            $mail2->Host = 'mail.theresortexperiences.com';  // Specify main and backup SMTP servers
            $mail2->SMTPAuth = true;                               // Enable SMTP authentication
            $mail2->Username = 'contactus@theresortexperiences.com';                 // SMTP username
            $mail2->Password = '94Z6g.;d1CSq';                           // SMTP password
            $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail2->Port = 587;                                    // TCP port to connect to
  
            //Recipients
            $mail2->setFrom('orchidgoldpune@orchidhotel.com', 'orchidhotel');
            $mail2->addAddress('meanand.gupta21@gmail.com');
            $mail2->mailheader = $mailheader2;// Add a recipient
            //  $mail->addCC('leads@loyaltician.com');
            $mail2->addBCC('kvaljani@gmail.com ');
            //  $mail2->addCC('meanand.gupta21@gmail.com');
  

            $mail2->isHTML(true);                                  // Set email format to HTML
            $mail2->Subject = $EmailSubject2 . "\r\n";
            $mail2->Body = $message2;
            $mail2->send();
            //==============mail end===
          } catch (Exception $e) {

            $msg = "Mail not send due to SMTP Host error!!!";

          }


          if ($msg != '') {
            $sqlr = mysqli_query($conn, "insert into testcatchdata (message,page_source,mem_id,status) values ('" . $msg . "','" . $pagesource . "','" . $memid . "',0) ");

          } else {
          }

        } else if ($sql4fetch['Leval_id'] == '2') {
          //  include("Leadpdf/OrchidGoldMember_pdf.php");
  

          $EmailSubject2 = "Welcome to Orchid Gold!";





          $message2 .= '<table width="70%" align="center">';

          $message2 .= '<tr>';

          $message2 .= '<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/gold_logo.png" alt="gold_logo.png" />  </th></tr><tr>';

          $message2 .= '<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/GOLD.png" alt="GOLD.png" />    </th>';
          $message2 .= '</tr><tr>';
          $message2 .= '<th  style="text-align: left;"><b>Dear ' . $Primary_nameOnTheCard . ' ,</b></th></tr><tr></br>';
          $message2 .= '<td>Welcome to Orchid Gold and to a host of benefits and privileges that are now yours to enjoy on dining and accommodation at The Orchid Hotel Pune, The Orchid Hotel Mumbai Vile Parle, Fort JadhavGADH Pune, Mahodadhi Palace Puri, Lotus Eco Resort Konark and Lotus Beach Resort Goa with more hotels being added soon.<br><br>
         Your Membership Card number is ' . $fetchgen['GenerateMember_Id'] . '. The membership is valid till ' . $R . ' You may click here to view the Summary of Benefits of the membership.<br><br>
         The annual membership charge of Rs. 10,000 + 18% Goods & Services Tax amounting to Rs. 11,800/- (Rupees Eleven Thousand Eight Hundred only) has been received by ' . $fetchgen['MembershipDts_PaymentMode'] . '<br><br>
        You can present your membership number or a copy of this email to start using your membership benefits.<br></br>
        The complete welcome package will reach you within 10 working days of this e-mail. Your membership gift certificates along with the membership are given at the bottom of this email..<br><br>
         We look forward to welcoming you as our esteemed Orchid Gold member.<br></br>
         </td>';


          $message2 .= '</tr></table>';


          $message2 .= '</table>';


          $message2 .= '<table width="70%" align="center">';
          $message2 .= '<tr height="5px">
<td><br>Yours sincerely<br><b>Team Orchid Gold </b><br>+91 9169166789 <br>www.orchidhotel.com</td>

</tr>';
          $message2 .= '</table>';

          $message2 .= '<table border="1" width="50%" align="center">';
          $message2 .= '<tr>';
          $message2 .= '<th colspan="3">Gift Certificates issued</th>';
          $message2 .= '</tr><tr>';
          $message2 .= '<th>SN</th><th>Type</th><th>Certificate Number</th>';



          $srno = 1;

          $qry = "select Leval_id,level_name from Level where Leval_id='" . $sql4fetch['Leval_id'] . "' ";
          $did = $sql4fetch['Leval_id'];
          $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='" . $did . "'";
          //echo $sql2;
          $runsql2 = mysqli_query($conn, $sql2);
          while ($sql2fetch = mysqli_fetch_array($runsql2)) {


            $remaining1 = substr($sql2fetch['serialNumber'], 8);
            $value = $sql5fetch['AssignBooklet'] + 1;
            $AssignBooklet1 = $value . $remaining1;

            $message2 .= '
<tr height="5px">
<td>' . $srno . '</td>
<td>' . $sql2fetch['serviceName'] . '</td>
<td>' . $AssignBooklet1 . '</td>
</tr>
';

            $srno++;
          }

          $message2 .= '</table>';

          $message2 .= '<table width="70%" align="center">';
          $message2 .= '<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
          $message2 .= '</table>';


          $message2 .= '<table width="70%" align="center">';
          $message2 .= '<tr ><td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
          $message2 .= '<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
          $message2 .= '<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
          $message2 .= '<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



          $message2 .= '<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com) and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.</td></tr>';

          $message2 .= '</table>';


          $leadsmail2 = " Orchidmembership@loyaltician.com";
          $mailheader2 = "From: " . $leadsmail2 . "\r\n";
          $mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";

          require 'phpmail/src/PHPMailer.php';
          require 'phpmail/src/SMTP.php';
          require 'phpmail/src/Exception.php';

          $pagesource = "MemberCreate_NEW_Process";
          $memid = $Static_LeadID;
          $msg = "";

          $mail2 = new PHPMailer\PHPMailer\PHPMailer();
          try {
            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail2->isSMTP();                                      // Set mailer to use SMTP
            $mail2->Host = 'mail.theresortexperiences.com';  // Specify main and backup SMTP servers
            $mail2->SMTPAuth = true;                               // Enable SMTP authentication
            $mail2->Username = 'contactus@theresortexperiences.com';                 // SMTP username
            $mail2->Password = '94Z6g.;d1CSq';                           // SMTP password
            $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail2->Port = 587;                                    // TCP port to connect to
  
            //Recipients
            $mail2->setFrom('orchidgoldpune@orchidhotel.com', 'orchidhotel');
            $mail2->addAddress('meanand.gupta21@gmail.com');
            $mail2->mailheader = $mailheader2;// Add a recipient
            //  $mail->addCC('leads@loyaltician.com');
            $mail2->addBCC('kvaljani@gmail.com ');
            //  $mail2->addCC('meanand.gupta21@gmail.com');
  

            $mail2->isHTML(true);                                  // Set email format to HTML
            $mail2->Subject = $EmailSubject2 . "\r\n";
            $mail2->Body = $message2;
            $mail2->send();
            //==============mail end===
          } catch (Exception $e) {

            $msg = "Mail not send due to SMTP Host error!!!";

          }


          if ($msg != '') {
            $sqlr = mysqli_query($conn, "insert into testcatchdata (message,page_source,mem_id,status) values ('" . $msg . "','" . $pagesource . "','" . $memid . "',0) ");

          } else {

          }













        } else if ($sql4fetch['Leval_id'] == '3') {
          //       include("Leadpdf/OrchidPlatinumMember_pdf.php");
  

          $EmailSubject2 = "Welcome to Orchid Platinum!";





          $message2 .= '<table width="70%" align="center">';

          $message2 .= '<tr>';
          $message2 .= '<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/gold_logo.png" alt="gold_logo.png" />  </th></tr><tr>';

          $message2 .= '<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/PLATINUM.png" alt="GOLD.png" />    </th>';
          $message2 .= '</tr><tr>';
          $message2 .= '<th  style="text-align: left;"><b>Dear ' . $Primary_nameOnTheCard . ' , </b></th></tr><tr></br>';
          $message2 .= '<td>Welcome to Orchid Platinum and to a host of benefits and privileges that are now yours to enjoy on dining and accommodation at The Orchid Hotel Pune, The Orchid Hotel Mumbai Vile Parle, Fort JadhavGADH Pune, Mahodadhi Palace Puri, Lotus Eco Resort Konark and Lotus Beach Resort Goa with more hotels being added soon.<br><br>
         Your Membership Card number is ' . $fetchgen['GenerateMember_Id'] . '. The membership is valid till ' . $R . ' You may click here to view the Summary of Benefits of the membership.<br><br>
         The annual membership charge of Rs. 15,000 + 18% Goods & Services Tax amounting to Rs. 17,700/- (RupeesSeventeen Thousand Seven Hundred only) has been received by ' . $fetchgen['MembershipDts_PaymentMode'] . '<br><br>
        You can present your membership number or a copy of this email to start using your membership benefits.<br></br>
        The complete welcome package will reach you within 10 working days of this e-mail. Your membership gift certificates along with the membership are given at the bottom of this email.<br><br>
         We look forward to welcoming you as our esteemed Orchid Platinum member.<br></br>
         </td>';


          $message2 .= '</tr></table>';


          $message2 .= '</table>';


          $message2 .= '<table width="70%" align="center">';
          $message2 .= '<tr height="5px">
<td><br>Yours sincerely<br><b>Team Orchid Platinum </b><br>+91 9169166789 <br>www.orchidhotel.com</td>

</tr>';
          $message2 .= '</table>';

          $message2 .= '<table border="1" width="50%" align="center">';
          $message2 .= '<tr>';
          $message2 .= '<th colspan="3">Gift Certificates issued</th>';
          $message2 .= '</tr><tr>';
          $message2 .= '<th>SN</th><th>Type</th><th>Certificate Number</th>';



          $srno = 1;

          $qry = "select Leval_id,level_name from Level where Leval_id='" . $sql4fetch['Leval_id'] . "' ";
          $did = $sql4fetch['Leval_id'];
          $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='" . $did . "'";
          //echo $sql2;
          $runsql2 = mysqli_query($conn, $sql2);
          while ($sql2fetch = mysqli_fetch_array($runsql2)) {

            $remaining1 = substr($sql2fetch['serialNumber'], 8);
            $value = $sql5fetch['AssignBooklet'] + 1;
            $AssignBooklet1 = $value . $remaining1;


            $message2 .= '
<tr height="5px">
<td>' . $srno . '</td>
<td>' . $sql2fetch['serviceName'] . '</td>
<td>' . $AssignBooklet1 . '</td>
</tr>
';

            $srno++;
          }

          $message2 .= '</table>';

          $message2 .= '<table width="70%" align="center">';
          $message2 .= '<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
          $message2 .= '</table>';


          $message2 .= '<table width="70%" align="center">';
          $message2 .= '<tr ><td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
          $message2 .= '<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
          $message2 .= '<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
          $message2 .= '<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



          $message2 .= '<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com) and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.</td></tr>';

          $message2 .= '</table>';


          $leadsmail2 = " Orchidmembership@loyaltician.com";
          $mailheader2 = "From: " . $leadsmail2 . "\r\n";
          $mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";

          require 'phpmail/src/PHPMailer.php';
          require 'phpmail/src/SMTP.php';
          require 'phpmail/src/Exception.php';

          $pagesource = "MemberCreate_NEW_Process";
          $memid = $Static_LeadID;
          $msg = "";

          $mail2 = new PHPMailer\PHPMailer\PHPMailer();
          try {
            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail2->isSMTP();                                      // Set mailer to use SMTP
            $mail2->Host = 'mail.theresortexperiences.com';  // Specify main and backup SMTP servers
            $mail2->SMTPAuth = true;                               // Enable SMTP authentication
            $mail2->Username = 'contactus@theresortexperiences.com';                 // SMTP username
            $mail2->Password = '94Z6g.;d1CSq';                           // SMTP password
            $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail2->Port = 587;                                    // TCP port to connect to
  
            //Recipients
            $mail2->setFrom('orchidgoldpune@orchidhotel.com', 'orchidhotel');
            $mail2->addAddress('meanand.gupta21@gmail.com');
            $mail2->mailheader = $mailheader2;// Add a recipient
            //  $mail->addCC('leads@loyaltician.com');
            $mail2->addBCC('kvaljani@gmail.com ');
            //   $mail2->addCC('meanand.gupta21@gmail.com');
  

            $mail2->isHTML(true);                                  // Set email format to HTML
            $mail2->Subject = $EmailSubject2 . "\r\n";
            $mail2->Body = $message2;
            $mail2->send();
            //==============mail end===
          } catch (Exception $e) {

            $msg = "Mail not send due to SMTP Host error!!!";

          }


          if ($msg != '') {
            $sqlr = mysqli_query($conn, "insert into testcatchdata (message,page_source,mem_id,status) values ('" . $msg . "','" . $pagesource . "','" . $memid . "',0) ");

          } else {

          }






        }



        //===========for mail===============
  

        $runCntRecipt = mysqli_query($conn, "SELECT ToSeries,CountRecipt,PayReceipt_id FROM `PaymentReceipt` where Program_ID='" . $sql4fetch['Program_ID'] . "' ");
        $fetchCntRecipt = mysqli_fetch_array($runCntRecipt);


        if ($fetchCntRecipt['FromSeries'] <= $fetchCntRecipt['ToSeries']) {
          $countRecipt = $fetchCntRecipt['CountRecipt'] + 1;
          mysqli_query($conn, "update PaymentReceipt set CountRecipt='" . $countRecipt . "' where PayReceipt_id='" . $fetchCntRecipt['PayReceipt_id'] . "' ");

        }










        $sqlcount = mysqli_query($conn, "SELECT COUNT(level_id) as count FROM `voucher_Type` where level_id='" . $did . "'");
        $fetchCount = mysqli_fetch_array($sqlcount);


        $EmailSubject1 = "Thank you, New Membership Created Successfully!";

        $MESSAGE_BODY1 = "";

        $serialNm = $AssignBooklet;
        $GenNm = $fetchgen['GenerateMember_Id'];

        $message1 .= '<table border="1">';
        $message1 .= '<tr>';
        $message1 .= '<th>Member Name on card</th>';
        $message1 .= '<td>' . $Primary_nameOnTheCard . '</td>';
        $message1 .= '</tr><tr>';
        $message1 .= '<th>Membership Number</th>';
        $message1 .= '<td>' . $GenNm . '</td>';
        $message1 .= '</tr><tr>';
        $message1 .= '<th>Voucher Booklet Number</th>';
        $message1 .= '<td>' . $serialNm . '</td>';
        $message1 .= '</tr><tr>';
        $message1 .= '<th>Certificates Issued</th>';
        $message1 .= '<td>' . $fetchCount["count"] . '</td>';
        $message1 .= '</tr><tr>';
        $message1 .= '<th>Receipt Number</th>';
        $message1 .= '<td>' . "$countRecipt" . '</td>';
        $message1 .= '</tr><tr>';
        $message1 .= '<th>Level</th>';
        $message1 .= '<td>' . $sql4fetch['level_name'] . '</td>';
        $message1 .= '</tr><tr>';
        $message1 .= '<th>Payment Mode</th>';
        $message1 .= '<td>' . $fetchgen['MembershipDts_PaymentMode'] . '</td>';

        $message1 .= '</tr>';




        $leadsmail1 = " Orchidmembership@loyaltician.com";
        $mailheader1 = "From: " . $leadsmail1 . "\r\n";
        $mailheader1 .= "Reply-To: " . $leadsmail1 . "\r\n";

        require 'phpmail/src/PHPMailer.php';
        require 'phpmail/src/SMTP.php';
        require 'phpmail/src/Exception.php';

        $pagesource = "MemberCreate_NEW_Process";
        $memid = $Static_LeadID;
        $msg = "";

        $mail1 = new PHPMailer\PHPMailer\PHPMailer();
        try {
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
          $mail1->setFrom('orchidgoldpune@orchidhotel.com', 'orchidhotel');
          $mail1->addAddress('meanand.gupta21@gmail.com');
          $mail1->mailheader = $mailheader1;// Add a recipient
          //  $mail->addCC('leads@loyaltician.com');
          $mail1->addBCC('kvaljani@gmail.com ');
          // $mail1->addCC('meanand.gupta21@gmail.com');
  

          $mail1->isHTML(true);                                  // Set email format to HTML
          $mail1->Subject = $EmailSubject1 . "\r\n";
          $mail1->Body = $message1 . "\r\n" . $MESSAGE_BODY1;
          $mail1->send();
          //==============mail end===
        } catch (Exception $e) {

          $msg = "Mail not send due to SMTP Host error!!!";

        }


        if ($msg != '') {
          $sqlr = mysqli_query($conn, "insert into testcatchdata (message,page_source,mem_id,status) values ('" . $msg . "','" . $pagesource . "','" . $memid . "',0) ");

        } else {

        }



        mysqli_query($conn, "insert into voucher_Details (MembershipNumber,VoucherBookletNumber)values('" . $GenNm . "','" . $serialNm . "')");

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
                // window.open("prospect_view.php", "_self");
                  window.location.href = "prospect_view.php";

              }
            });

        </script>

      <?php } else {
        echo "<script>swal('Error!')</script>";
      }


    } else { ?>
      <script>
        swal({
          title: "Booklet Series not Available!",
          text: "So Sorry, Member Not Created !",
          icon: "warning",
          // buttons: true,
          dangerMode: true,
        })
          .then((willDelete) => {
            if (willDelete) {
            //   window.open("prospect_view.php", "_self");
                window.location.href = "prospect_view.php";

            }
          });

      </script>
    <?php
    }
  }

  ?>
</body>

</html>