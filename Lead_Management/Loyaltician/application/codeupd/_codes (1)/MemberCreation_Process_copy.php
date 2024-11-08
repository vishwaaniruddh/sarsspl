<?php session_start(); ?>
<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include ('config.php');
  include ('number_to_wordConvert.php');



  //static Post Data                      
  $Static_LeadID = $_POST['Static_LeadID'];
  $Static_LeadSource = $_POST['Static_LeadSource'];
  $Static_FirstName = $_POST['Static_FirstName'];
  $Static_LastName = $_POST['Static_LastName'];
  $Static_AssignedTo = $_POST['Static_AssignedTo'];
  $Static_DateOfAssignment = $_POST['Static_DateOfAssignment'];
  $Static_DateOfEntry = $_POST['Static_DateOfEntry'];
  $Static_Status = $_POST['Static_Status'];
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
  $Primary_AreaofPincode = $_POST['Primary_Area'];
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

  $DOB = date('Y-m-d', strtotime($Primary_DateOfBirth));
  if ($Anniversary != "")
    $Primary_Anniversary = date('Y-m-d', strtotime($Anniversary));
  else
    $Primary_Anniversary = '0000-00-00';
  // $Primary_Anniversary="";
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
  $Spouse_DateOfBirth = $_POST['Spouse_DateOfBirth'];
  $Spouse_nameOnTheCardMarried = $_POST['Spouse_nameOnTheCardMarried'];

  if ($Spouse_DateOfBirth != "" || $Spouse_DateOfBirth != "01-01-1970")
    $Spouse_DOB = date('Y-m-d', strtotime($Spouse_DateOfBirth));
  else
    $Spouse_DOB = '0000-00-00';
  ////////////////////////////////////////////////////////////////////////
  
  $MemshipDts_GST_number = $_POST['MemshipDts_GST_number'];

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
  $GenerateMember_Id = "";
  /*$hotlName=$_POST['hotlName'];
  $randomNumber=rand( 10000 , 99999 );
  $GenerateMember_Id=$hotlName.$MembershipDetails_Level.$randomNumber.'1';*/

  chk();
  function chk()
  {

    $hotlName = $_POST['hotlName'];
    $randomNumber = rand(10000, 99999);
    $GenerateMember_Id = $hotlName . $MembershipDetails_Level . $randomNumber . '1';
  }

  $qgen = mysqli_query($conn, "select * from Members where GenerateMember_Id='" . $GenerateMember_Id . "'");
  if ($qgen) {
    chk();
  }


  ////////////////////////////////////////////////
  

  //booklet Assign
  

  $sql3 = "SELECT MembershipDetails_Level FROM `Members` where  Static_LeadID='" . $Static_LeadID . "' ";
  //echo $sql3;
  $runsql3 = mysqli_query($conn, $sql3);
  $sql3fetch = mysqli_fetch_array($runsql3);

  $sql4 = "SELECT * FROM `Level` where Leval_id='" . $sql3fetch['MembershipDetails_Level'] . "' ";
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


      /*	$sql6="SELECT serialNumber,V_type_id,status FROM `voucher_Type` where Program_ID='".$sql4fetch['Program_ID']."' and Level_id='".$sql4fetch['Leval_id']."'  and status='0' order by serialNumber limit 1";
          $runsql6=mysqli_query($conn,$sql6);
        $countsql6=mysqli_num_rows($runsql6);
        $sql6fetch=mysqli_fetch_array($runsql6);*/



      //  if($countsql6>0){
  
      mysqli_query($conn, "START TRANSACTION");

      $qryinsert = mysqli_query($conn, "Update Members set Primary_Title='" . $Primary_Title . "',Primary_Pincode='" . $Primary_Pincode . "',Primary_mcode2='" . $Primary_mcode2 . "',Primary_mob2='" . $Primary_mob2 . "',Primary_Contact1code='" . $Primary_Contact1code . "',Primary_Contact1='" . $Primary_Contact1 . "',Primary_Contact2code='" . $Primary_Contact2code . "',Primary_Contact2='" . $Primary_Contact2 . "',Primary_Contact3code='" . $Primary_Contact3code . "',Primary_Contact3='" . $Primary_Contact3 . "',Primary_nameOnTheCard='" . $Primary_nameOnTheCard . "',Primary_PhotoUpload='" . $Primary_PhotoUpload . "',Primary_Email_ID2='" . $Primary_Email_ID2 . "',Primary_DateOfBirth='" . $DOB . "',Primary_Anniversary='" . $Primary_Anniversary . "',Primary_AddressType1='" . $Primary_AddressType1 . "',Primary_BuldNo_addrss='" . $Primary_BuldNo_addrss . "',Primary_Area_addrss='" . $Primary_Area_addrss . "',Primary_Landmark_addrss='" . $Primary_Landmark_addrss . "',Primary_MaritalStatus='" . $Primary_MaritalStatus . "',Spouse_Title='" . $Spouse_Title . "',Spouse_FirstName='" . $Spouse_FirstName . "',Spouse_LastName='" . $Spouse_LastName . "',Spouse_GmailMArrid1='" . $Spouse_GmailMArrid1 . "',Spouse_GmailMArrid2='" . $Spouse_GmailMArrid2 . "',Spouse_PhotoUpload='" . $Spouse_PhotoUpload . "',Spouse_mcode1Married1='" . $Spouse_mcode1Married1 . "',Spouse_mob1MArid1='" . $Spouse_mob1MArid1 . "',Spouse_mcode1Married2='" . $Spouse_mcode1Married2 . "',Spouse_mob1MArid2='" . $Spouse_mob1MArid2 . "',Spouse_Contact1codeMArid='" . $Spouse_Contact1codeMArid . "',Spouse_Contact1Married='" . $Spouse_Contact1Married . "',Spouse_Contact2codeMArid='" . $Spouse_Contact2codeMArid . "',Spouse_DateOfBirth='" . $Spouse_DOB . "',Spouse_nameOnTheCardMarried='" . $Spouse_nameOnTheCardMarried . "',Documentation_UploadSignatures='" . $Documentation_UploadSignatures . "',Documentation_AddressProof='" . $Documentation_AddressProof . "',Relationships_ReferredByLEADID='" . $Relationships_ReferredByLEADID . "',Relationships_ReferredByMEMBERSHIPID='" . $Relationships_ReferredByMEMBERSHIPID . "',itemCheck1='" . $itemCheck1 . "',BookletCheck1='" . $BookletCheck1 . "',CertificatesCheck1='" . $CertificatesCheck1 . "',PromotionalCheck1='" . $PromotionalCheck1 . "',Issue_ReferredByLEADID='" . $Issue_ReferredByLEADID . "',Issue_ReferredByMEMBERSHIPID='" . $Issue_ReferredByMEMBERSHIPID . "',booklet_Series='" . $AssignBooklet . "',GST_NUMBER='" . $MemshipDts_GST_number . "' where Static_LeadID='" . $Static_LeadID . "' ");


      if ($qryinsert) {

        $UpdateQry = mysqli_query($conn, "update Leads_table set Status='5',MobileCode2='" . $Primary_mcode2 . "', MobileNumber2	='" . $Primary_mob2 . "',contact1Code='" . $Primary_Contact1code . "' ,ContactNo1='" . $Primary_Contact1 . "',contact2Code='" . $Primary_Contact2code . "',ContactNo2='" . $Primary_Contact2 . "',contact3Code='" . $Primary_Contact3code . "',ContactNo3='" . $Primary_Contact3 . "'  where Lead_id='" . $Static_LeadID . "' ");

        $UpdateVoucherType = mysqli_query($conn, "update voucher_Booklet set AssignBooklet='" . $AssignBooklet . "' where Level_id='" . $sql5fetch['Level_id'] . "' ");

        $q = "SELECT count(level_id) as V_no from voucher_Type where level_id='" . $sql5fetch['Level_id'] . "' and serviceName not like '%RENEWAL%'";
        $sql = mysqli_query($conn, $q);
        $_row = mysqli_fetch_array($sql);

        for ($i = 1; $i <= $_row['V_no']; $i++) {

          $countR = $i;
          $readyToUse = sprintf("%03s", $countR);
          $NoOfVoucher = $AssignBooklet . $readyToUse;
          //echo $NoOfVoucher."<br>";
  
          mysqli_query($conn, "insert into BarcodeScan(Voucher_id,Available) values('" . $NoOfVoucher . "','0')");
        }


        if ($qryinsert && $UpdateQry && $UpdateVoucherType) {





          $rungen = mysqli_query($conn, "SELECT GenerateMember_Id,MembershipDts_PaymentMode,entryDate,MembershipDts_NetPayment,MembershipDts_GrossTotal,receipt_no FROM `Members` where Static_LeadID='" . $Static_LeadID . "'");
          $fetchgen = mysqli_fetch_array($rungen);

          $sqlexpiry = "SELECT Expiry_month FROM `validity` where Leval_id='" . $sql4fetch['Leval_id'] . "' ";
          //echo $sqlexpiry;
          $QryExpiry = mysqli_query($conn, $sqlexpiry);
          $fetchExpiry = mysqli_fetch_array($QryExpiry);

          $dd = date('Y-m-d', strtotime($fetchgen['entryDate']));

          $exm = "";
          $exm = $fetchExpiry['Expiry_month'];

          if (date('d', strtotime($fetchgen['entryDate'])) >= "25") {

            if (date("Y-m-d") >= "2019-11-25") {
              $exm += 1;
            }

          }





          //=======================Function for add month in date ================
  

          function addTime($time, $days, $months, $years)
          {
            // Convert unix time to date format
            if (is_numeric($time))
              $time = date('Y-m-d', $time);

            try {
              $date_time = new DateTime($time);
            } catch (Exception $e) {
              echo $e->getMessage();
              exit;
            }

            if ($days)
              $date_time->add(new DateInterval('P' . $days . 'D'));

            // Preserve day number
            if ($months or $years)
              $old_day = $date_time->format('d');

            if ($months)
              $date_time->add(new DateInterval('P' . $months . 'M'));

            if ($years)
              $date_time->add(new DateInterval('P' . $years . 'Y'));

            // Patch for adding months or years    
            if ($months or $years) {
              $new_day = $date_time->format("d");

              // The day is changed - set the last day of the previous month
              if ($old_day != $new_day)
                $date_time->sub(new DateInterval('P' . $new_day . 'D'));
            }
            // You can chage returned format here
            return $date_time->format('Y-m-d');


          }



          $d = strtotime(addTime($dd, 0, $exm, 0));

          ////////////////////////////////////////////////////////////////////
  


          //	 $d = strtotime("+".$exm." months",strtotime($dd)); //comment by anand
          //  $R=  date("d-m-Y",$d);
          $formattedValue = date("F, Y", $d);
          $R = $formattedValue;

          mysqli_query($conn, "Update Members set ExpiryDate='" . date("Y-m-d", $d) . "' where Static_LeadID='" . $Static_LeadID . "' ");

          if ($sql4fetch['Leval_id'] == '1') {

            // echo  convertNum($fetchgen['MembershipDts_GrossTotal']);
            //  exit();
  

            // include("Leadpdf/OrchidFirstMember_pdf.php");
  
            //===========for mail Welcome Latter First Orchid Member===============
  
            $EmailSubject2 = "Welcome to Orchid First!";


            $message2 .= '<table width="70%" align="center">';
            // $message2.='<tr><th>The Orchid First Member</th></tr>';
            $message2 .= '<tr>';
            $message2 .= '<th><img src="http://loyaltician.com/application/gold_logo.png" alt="gold_logo.png" />  </th></tr><tr>';

            $message2 .= '<th><img src="http://loyaltician.com/application/FIRST.png" alt="FIRST.png" />    </th>';
            $message2 .= '</tr><tr>';
            $message2 .= '<th style="text-align: left;"><b >Dear ' . $Primary_nameOnTheCard . ' ,</b></th></tr><tr></br>';
            $message2 .= '<td>Welcome to Orchid First and to a host of benefits and privileges that are now yours to enjoy on dining and accommodation at The Orchid Hotel Pune, The Orchid Hotel Mumbai Vile Parle, Fort JadhavGADH Pune, Mahodadhi Palace Puri, Lotus Eco Resort Konark and Lotus Beach Resort Goa with more hotels being added soon.<br><br>
         Your Membership Card number is ' . $fetchgen['GenerateMember_Id'] . '. The membership is valid till ' . $R . ' You may click here to view the Summary of Benefits of the membership.<br><br>
         The annual membership charge of Rs.' . $fetchgen['MembershipDts_NetPayment'] . ' + 18% Goods & Services Tax amounting to Rs.' . $fetchgen['MembershipDts_GrossTotal'] . '/- (' . convertNum($fetchgen['MembershipDts_GrossTotal']) . ' only) has been received by ' . $fetchgen['MembershipDts_PaymentMode'] . '<br><br>
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
            $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='" . $did . "' and serviceName not like '%RENEWAL%'";
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
            $message2 .= '<tr ><td><img src="http://loyaltician.com/application/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
            $message2 .= '<td><img src="http://loyaltician.com/application/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
            $message2 .= '<td><img src="http://loyaltician.com/application/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
            $message2 .= '<td><img src="http://loyaltician.com/application/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



            $message2 .= '<tr><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited.<br>
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

            require_once 'phpmail/src/PHPMailer.php';
            require_once 'phpmail/src/SMTP.php';
            require_once 'phpmail/src/Exception.php';

            $mail2 = new PHPMailer\PHPMailer\PHPMailer();

            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail2->isSMTP();                                      // Set mailer to use SMTP
            $mail2->Host = 'mail.khil.com';  // Specify main and backup SMTP servers
            $mail2->SMTPAuth = true;                               // Enable SMTP authentication
            $mail2->Username = 'orchidgoldpune@orchidhotel.com';                 // SMTP username
            $mail2->Password = 'Orchid#2022';                           // SMTP password
            $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail2->Port = 587;                                    // TCP port to connect to
  
            //Recipients
            $mail2->setFrom('orchidgoldpune@orchidhotel.com', 'The Orchid Hotel Pune');
            $mail2->addAddress($Primary_Gmail_1);
            //  $mail2->addCC('meanand.gupta21@gmail.com');
  
            $mail2->mailheader = $mailheader2;// Add a recipient
            $mail2->addCC('orchidgoldpune@orchidhotel.com');
            $mail2->addBCC('kvaljani@gmail.com');
            //    $mail2->addBCC('meanand.gupta21@gmai.com');
            $mail2->addCC('hitesh.gunwani@outlook.com');
            $mail2->addCC('khannakaran67@gmail.com');
            $mail2->addBCC('vishwaaniruddh@gmail.com ');


            $mail2->isHTML(true);                                  // Set email format to HTML
            $mail2->Subject = $EmailSubject2 . "\r\n";
            $mail2->Body = $message2;
            $mail2->send();
            //==============mail end===
  



          } else if ($sql4fetch['Leval_id'] == '2') {
            //  include("Leadpdf/OrchidGoldMember_pdf.php");
  

            $EmailSubject2 = "Welcome to Orchid Gold!";





            $message2 .= '<table width="70%" align="center">';

            $message2 .= '<tr>';

            $message2 .= '<th><img src="http://loyaltician.com/application/gold_logo.png" alt="gold_logo.png" />  </th></tr><tr>';

            $message2 .= '<th><img src="http://loyaltician.com/application/GOLD.png" alt="GOLD.png" />    </th>';
            $message2 .= '</tr><tr>';
            $message2 .= '<th  style="text-align: left;"><b>Dear ' . $Primary_nameOnTheCard . ' ,</b></th></tr><tr></br>';
            $message2 .= '<td>Welcome to Orchid Gold and to a host of benefits and privileges that are now yours to enjoy on dining and accommodation at The Orchid Hotel Pune, The Orchid Hotel Mumbai Vile Parle, Fort JadhavGADH Pune, Mahodadhi Palace Puri, Lotus Eco Resort Konark and Lotus Beach Resort Goa with more hotels being added soon.<br><br>
         Your Membership Card number is ' . $fetchgen['GenerateMember_Id'] . '. The membership is valid till ' . $R . ' You may click here to view the Summary of Benefits of the membership.<br><br>
         The annual membership charge of Rs. ' . $fetchgen['MembershipDts_NetPayment'] . ' + 18% Goods & Services Tax amounting to Rs. ' . $fetchgen['MembershipDts_GrossTotal'] . '/- (' . convertNum($fetchgen['MembershipDts_GrossTotal']) . ' only) has been received by ' . $fetchgen['MembershipDts_PaymentMode'] . '<br><br>
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
            $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='" . $did . "' and serviceName not like '%RENEWAL%'";
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
            $message2 .= '<tr ><td><img src="http://loyaltician.com/application/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
            $message2 .= '<td><img src="http://loyaltician.com/application/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
            $message2 .= '<td><img src="http://loyaltician.com/application/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
            $message2 .= '<td><img src="http://loyaltician.com/application/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



            $message2 .= '<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com) and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.</td></tr>';

            $message2 .= '</table>';


            $leadsmail2 = " Orchidmembership@loyaltician.com";
            $mailheader2 = "From: " . $leadsmail2 . "\r\n";
            $mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";

            require_once 'phpmail/src/PHPMailer.php';
            require_once 'phpmail/src/SMTP.php';
            require_once 'phpmail/src/Exception.php';

            $mail2 = new PHPMailer\PHPMailer\PHPMailer();

            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail2->isSMTP();                                      // Set mailer to use SMTP
            $mail2->Host = 'mail.khil.com';  // Specify main and backup SMTP servers
            $mail2->SMTPAuth = true;                               // Enable SMTP authentication
            $mail2->Username = 'orchidgoldpune@orchidhotel.com';                 // SMTP username
            $mail2->Password = 'Orchid#2022';                           // SMTP password
            $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail2->Port = 587;                                    // TCP port to connect to
  
            //Recipients
            $mail2->setFrom('orchidgoldpune@orchidhotel.com', 'The Orchid Hotel Pune');
            $mail2->addAddress($Primary_Gmail_1);
            //    $mail2->addCC('meanand.gupta21@gmail.com'); 
            $mail2->mailheader = $mailheader2;// Add a recipient
            $mail2->addCC('orchidgoldpune@orchidhotel.com');
            $mail2->addBCC('vishwaaniruddh@gmail.com ');

            $mail2->addCC('khannakaran67@gmail.com');
            $mail2->addCC('hitesh.gunwani@outlook.com ');
            //   $mail2->addBCC('meanand.gupta21@gmai.com');
  
            $mail2->isHTML(true);                                  // Set email format to HTML
            $mail2->Subject = $EmailSubject2 . "\r\n";
            $mail2->Body = $message2;
            $mail2->send();
            //==============mail end===
  












          } else if ($sql4fetch['Leval_id'] == '3') {
            //       include("Leadpdf/OrchidPlatinumMember_pdf.php");
  

            $EmailSubject2 = "Welcome to Orchid Platinum!";
            $message2 .= '<table width="70%" align="center">';
            $message2 .= '<tr>';
            $message2 .= '<th><img src="http://loyaltician.com/application/gold_logo.png" alt="gold_logo.png" />  </th></tr><tr>';
            $message2 .= '<th><img src="http://loyaltician.com/application/PLATINUM.png" alt="PLATINUM.png" />    </th>';
            $message2 .= '</tr><tr>';
            $message2 .= '<th  style="text-align: left;"><b>Dear ' . $Primary_nameOnTheCard . ' , </b></th></tr><tr></br>';
            $message2 .= '<td>Welcome to Orchid Platinum and to a host of benefits and privileges that are now yours to enjoy on dining and accommodation at The Orchid Hotel Pune, The Orchid Hotel Mumbai Vile Parle, Fort JadhavGADH Pune, Mahodadhi Palace Puri, Lotus Eco Resort Konark and Lotus Beach Resort Goa with more hotels being added soon.<br><br>
         Your Membership Card number is ' . $fetchgen['GenerateMember_Id'] . '. The membership is valid till ' . $R . ' You may click here to view the Summary of Benefits of the membership.<br><br>
         The annual membership charge of Rs.' . $fetchgen['MembershipDts_NetPayment'] . ' + 18% Goods & Services Tax amounting to Rs. ' . $fetchgen['MembershipDts_GrossTotal'] . '/- (' . convertNum($fetchgen['MembershipDts_GrossTotal']) . ' only) has been received by ' . $fetchgen['MembershipDts_PaymentMode'] . '<br><br>
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
            $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='" . $did . "' and serviceName not like '%RENEWAL%'";
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
            $message2 .= '<tr ><td><img src="http://loyaltician.com/application/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
            $message2 .= '<td><img src="http://loyaltician.com/application/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
            $message2 .= '<td><img src="http://loyaltician.com/application/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
            $message2 .= '<td><img src="http://loyaltician.com/application/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



            $message2 .= '<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com) and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.</td></tr>';

            $message2 .= '</table>';


            $leadsmail2 = " Orchidmembership@loyaltician.com";
            $mailheader2 = "From: " . $leadsmail2 . "\r\n";
            $mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";

            require_once 'phpmail/src/PHPMailer.php';
            require_once 'phpmail/src/SMTP.php';
            require_once 'phpmail/src/Exception.php';

            $mail2 = new PHPMailer\PHPMailer\PHPMailer();

            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail2->isSMTP();                                      // Set mailer to use SMTP
            $mail2->Host = 'mail.khil.com';  // Specify main and backup SMTP servers
            $mail2->SMTPAuth = true;                               // Enable SMTP authentication
            $mail2->Username = 'orchidgoldpune@orchidhotel.com';                 // SMTP username
            $mail2->Password = 'Orchid#2022';                           // SMTP password
            $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail2->Port = 587;                                    // TCP port to connect to
  
            //Recipients
            $mail2->setFrom('orchidgoldpune@orchidhotel.com', 'The Orchid Hotel Pune');
            $mail2->addAddress($Primary_Gmail_1);
            // $mail2->addCC('meanand.gupta21@gmail.com'); 
            $mail2->mailheader = $mailheader2;// Add a recipient
            $mail2->addCC('orchidgoldpune@orchidhotel.com');
            $mail2->addBCC('vishwaaniruddh@gmail.com ');

            $mail2->addCC('hitesh.gunwani@outlook.com');
            $mail2->addCC('khannakaran67@gmail.com');
            //   $mail2->addBCC('meanand.gupta21@gmai.com');
  
            $mail2->isHTML(true);                                  // Set email format to HTML
            $mail2->Subject = $EmailSubject2 . "\r\n";
            $mail2->Body = $message2;
            $mail2->send();
            //==============mail end===
  





          }



          //===========for mail===============
  


          $countRecipt = $fetchgen['receipt_no'];
          /*
              if($fetchCntRecipt['FromSeries']<=$fetchCntRecipt['ToSeries']){
                 $countRecipt=$fetchCntRecipt['CountRecipt']+1;
                 mysqli_query($conn,"update PaymentReceipt set CountRecipt='".$countRecipt."' where PayReceipt_id='".$fetchCntRecipt['PayReceipt_id']."' ");
                 mysqli_query($conn,"Update Members set receipt_no='".$countRecipt."' where Static_LeadID='".$Static_LeadID."' ");
                 }
                  */

          $sqlcount = mysqli_query($conn, "SELECT COUNT(level_id) as count FROM `voucher_Type` where level_id='" . $did . "' and serviceName not like '%RENEWAL%'");
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

          require_once 'phpmail/src/PHPMailer.php';
          require_once 'phpmail/src/SMTP.php';
          require_once 'phpmail/src/Exception.php';

          $mail1 = new PHPMailer\PHPMailer\PHPMailer();

          //Server settings
          //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
          $mail1->isSMTP();                                      // Set mailer to use SMTP
          $mail1->Host = 'mail.khil.com';  // Specify main and backup SMTP servers
          $mail1->SMTPAuth = true;                               // Enable SMTP authentication
          $mail1->Username = 'orchidgoldpune@orchidhotel.com';                 // SMTP username
          $mail1->Password = 'Orchid#2022';                           // SMTP password
          $mail1->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          $mail1->Port = 587;                                    // TCP port to connect to
  
          //Recipients
          $mail1->setFrom('orchidgoldpune@orchidhotel.com', 'The Orchid Hotel Pune');
          $mail1->addAddress('orchidgoldpune@orchidhotel.com');
          $mail1->mailheader = $mailheader1;// Add a recipient
          $mail1->addBCC('kvaljani@gmail.com ');
          $mail1->addCC('khannakaran67@gmail.com');
          //  $mail2->addBCC('meanand.gupta21@gmai.com');
  

          $mail1->isHTML(true);                                  // Set email format to HTML
          $mail1->Subject = $EmailSubject1 . "\r\n";
          $mail1->Body = $message1 . "\r\n" . $MESSAGE_BODY1;
          $mail1->send();


          //========================this is for log details========================
  
          $EmailSubject9 = "New Membership Created Successfully by " . $_SESSION['user'] . "!";


          $mail9 = new PHPMailer\PHPMailer\PHPMailer();

          //Server settings
          //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
          $mail9->isSMTP();                                      // Set mailer to use SMTP
          $mail9->Host = 'mail.khil.com';  // Specify main and backup SMTP servers
          $mail9->SMTPAuth = true;                               // Enable SMTP authentication
          $mail9->Username = 'orchidgoldpune@orchidhotel.com';                 // SMTP username
          $mail9->Password = 'Orchid#2022';                           // SMTP password
          $mail9->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          $mail9->Port = 587;                                    // TCP port to connect to
  
          //Recipients
          $mail9->setFrom('orchidgoldpune@orchidhotel.com', 'The Orchid Hotel Pune');
          $mail9->addAddress('admin.orchidpune@loyaltician.com');
          $mail9->mailheader = $mailheader1;// Add a recipient
          $mail9->addBCC('vishwaaniruddh@gmail.com ');
          $mail9->addCC('khannakaran67@gmail.com');


          $mail9->isHTML(true);                                  // Set email format to HTML
          $mail9->Subject = $EmailSubject9 . "\r\n";
          $mail9->Body = $message1 . "\r\n" . $MESSAGE_BODY1;
          $mail9->send();

          //==============mail end===
  


          $d = mysqli_query($conn, "insert into voucher_Details (MembershipNumber,VoucherBookletNumber)values('" . $GenNm . "','" . $serialNm . "')");


          if ($d) {
            mysqli_query($conn, "COMMIT");
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
                  window.open("prospect_view.php", "_self");

                }
              });

          </script>

          <?php
        } else {
          mysqli_query($conn, "ROLLBACK");
          echo mysqli_error($conn);
          // echo "<script>swal('Error!')</script>";
        }


      } else {
        echo "err -";
        echo mysqli_error($conn);//"<script>swal('Error!')</script>";
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
              window.open("prospect_view.php", "_self");

            }
          });

      </script>
      <?php
    }
  }

  ?>
</body>

</html>