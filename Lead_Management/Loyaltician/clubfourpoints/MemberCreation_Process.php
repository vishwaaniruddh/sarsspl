<?php session_start(); ?>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
</head>

<body>
    <?php
    include ('config.php');
    include ('number_to_wordConvert.php');



    $host = 'mail.clubfourpoints.com';
    $hostusername = 'contactus@clubfourpoints.com';
    $hostpassword = 'QKAc&mn,[xY%';
    $port = '587';

    // $nodes = 'https://arpeeindustries.in/mail.php';
    $nodes = 'https://sarmicrosystems.in/SarMailor_APIS/mail.php';

    $leadsmail2 = " contactus@clubfourpoints.com";
    $leadsmail = $leadsmail2;

    $from = 'contactus@clubfourpoints.com';
    $fromname = 'Club Four Points';

    // $to =['orchidgoldpune@orchidhotel.com'];
    $cc = ['vishwaaniruddh@gmail.com'];
    $bcc = ['khannakaran67@gmail.com'];



    $attachment = "https://loyaltician.in/clubfourpoints/Leadpdf/memberpdf/$Primary_nameOnTheCard.pdf";


    include ('Leadpdf/generatepdf/TCPDF-master/examples/tcpdf_include.php');
    include ('Leadpdf/generatepdf/TCPDF-master/tcpdf.php');

    class MYPDF extends TCPDF
    {
        public function Header()
        {
        }

        public function Footer()
        {
        }
    }



    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Satyendra Sharma');
    $pdf->SetTitle($Primary_nameOnTheCard);
    $pdf->SetSubject('DER Report');
    $pdf->SetKeywords('E-FSR, PDF');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once (dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }





    $pdf->SetFont('times', '', 12);
    $pdf->AddPage();
    $pdf->SetMargins(5, 0, 10, true);
    $pdf->SetFillColor(255, 255, 127);















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

    $todaysdate = date('Y-m-d');
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



    //booklet Assign
    

    $sql3 = "SELECT MembershipDetails_Level FROM `Members` where  Static_LeadID='" . $Static_LeadID . "' ";
    $runsql3 = mysqli_query($conn, $sql3);
    $sql3fetch = mysqli_fetch_array($runsql3);


    $sql4 = "SELECT * FROM `Level` where Leval_id='" . $sql3fetch['MembershipDetails_Level'] . "' ";
    $runsql4 = mysqli_query($conn, $sql4);
    $sql4fetch = mysqli_fetch_array($runsql4);

    $sql5 = "SELECT FromSerialNo,ToSerialNo,AssignBooklet,Level_id FROM `voucher_Booklet` where Program_ID='" . $sql4fetch['Program_ID'] . "' and Level_id='" . $sql4fetch['Leval_id'] . "'   ";
    $runsql5 = mysqli_query($conn, $sql5);
    $sql5fetch = mysqli_fetch_array($runsql5);




    $AssignBooklet = $sql5fetch['AssignBooklet'];

    if ($AssignBooklet == 0) {
        $AssignBooklet = $sql5fetch['FromSerialNo'];
        $isfirst = 1;
    }




    if ($sql5fetch['FromSerialNo'] <= $sql5fetch['ToSerialNo']) {

        $levelIncrement = "";

        if ($sql5fetch['Level_id'] == '1') {
            $levelIncrement = '12000';
        } else if ($sql5fetch['Level_id'] == '2') {
            $levelIncrement = '14000';

        } else if ($sql5fetch['Level_id'] == '6') {
            $levelIncrement = '11000';

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
    


        //  echo '$sql5fetch = ' . $sql5fetch['ToSerialNo'];
        //  echo '<br>';
        //  echo '$AssignBooklet'. $AssignBooklet;
    

        if ($sql5fetch['ToSerialNo'] >= $AssignBooklet) {


            /*	$sql6="SELECT serialNumber,V_type_id,status FROM `voucher_Type_new` where Program_ID='".$sql4fetch['Program_ID']."' and Level_id='".$sql4fetch['Leval_id']."'  and status='0' order by serialNumber limit 1";
                  $runsql6=mysqli_query($conn,$sql6);
                $countsql6=mysqli_num_rows($runsql6);
                $sql6fetch=mysqli_fetch_array($runsql6);*/



            //  if($countsql6>0){
    
            mysqli_query($conn, "START TRANSACTION");

            $qryinsert = mysqli_query($conn, "Update Members set member_since='" . $todaysdate . "' ,Primary_Title='" . $Primary_Title . "',Primary_Pincode='" . $Primary_Pincode . "',Primary_mcode2='" . $Primary_mcode2 . "',Primary_mob2='" . $Primary_mob2 . "',Primary_Contact1code='" . $Primary_Contact1code . "',Primary_Contact1='" . $Primary_Contact1 . "',Primary_Contact2code='" . $Primary_Contact2code . "',Primary_Contact2='" . $Primary_Contact2 . "',Primary_Contact3code='" . $Primary_Contact3code . "',Primary_Contact3='" . $Primary_Contact3 . "',Primary_nameOnTheCard='" . $Primary_nameOnTheCard . "',Primary_PhotoUpload='" . $Primary_PhotoUpload . "',Primary_Email_ID2='" . $Primary_Email_ID2 . "',Primary_DateOfBirth='" . $DOB . "',Primary_Anniversary='" . $Primary_Anniversary . "',Primary_AddressType1='" . $Primary_AddressType1 . "',Primary_BuldNo_addrss='" . $Primary_BuldNo_addrss . "',Primary_Area_addrss='" . $Primary_Area_addrss . "',Primary_Landmark_addrss='" . $Primary_Landmark_addrss . "',Primary_MaritalStatus='" . $Primary_MaritalStatus . "',Spouse_Title='" . $Spouse_Title . "',Spouse_FirstName='" . $Spouse_FirstName . "',Spouse_LastName='" . $Spouse_LastName . "',Spouse_GmailMArrid1='" . $Spouse_GmailMArrid1 . "',Spouse_GmailMArrid2='" . $Spouse_GmailMArrid2 . "',Spouse_PhotoUpload='" . $Spouse_PhotoUpload . "',Spouse_mcode1Married1='" . $Spouse_mcode1Married1 . "',Spouse_mob1MArid1='" . $Spouse_mob1MArid1 . "',Spouse_mcode1Married2='" . $Spouse_mcode1Married2 . "',Spouse_mob1MArid2='" . $Spouse_mob1MArid2 . "',Spouse_Contact1codeMArid='" . $Spouse_Contact1codeMArid . "',Spouse_Contact1Married='" . $Spouse_Contact1Married . "',Spouse_Contact2codeMArid='" . $Spouse_Contact2codeMArid . "',Spouse_DateOfBirth='" . $Spouse_DOB . "',Spouse_nameOnTheCardMarried='" . $Spouse_nameOnTheCardMarried . "',Documentation_UploadSignatures='" . $Documentation_UploadSignatures . "',Documentation_AddressProof='" . $Documentation_AddressProof . "',Relationships_ReferredByLEADID='" . $Relationships_ReferredByLEADID . "',Relationships_ReferredByMEMBERSHIPID='" . $Relationships_ReferredByMEMBERSHIPID . "',itemCheck1='" . $itemCheck1 . "',BookletCheck1='" . $BookletCheck1 . "',CertificatesCheck1='" . $CertificatesCheck1 . "',PromotionalCheck1='" . $PromotionalCheck1 . "',Issue_ReferredByLEADID='" . $Issue_ReferredByLEADID . "',Issue_ReferredByMEMBERSHIPID='" . $Issue_ReferredByMEMBERSHIPID . "',booklet_Series='" . $AssignBooklet . "',GST_NUMBER='" . $MemshipDts_GST_number . "' where Static_LeadID='" . $Static_LeadID . "' ");


            if ($qryinsert) {

                $UpdateQry = mysqli_query($conn, "update Leads_table set Status='5',MobileCode2='" . $Primary_mcode2 . "', MobileNumber2	='" . $Primary_mob2 . "',contact1Code='" . $Primary_Contact1code . "' ,ContactNo1='" . $Primary_Contact1 . "',contact2Code='" . $Primary_Contact2code . "',ContactNo2='" . $Primary_Contact2 . "',contact3Code='" . $Primary_Contact3code . "',ContactNo3='" . $Primary_Contact3 . "'  where Lead_id='" . $Static_LeadID . "' ");

                $UpdateVoucherType = mysqli_query($conn, "update voucher_Booklet set AssignBooklet='" . $AssignBooklet . "' where Level_id='" . $sql5fetch['Level_id'] . "' ");

                $q = "SELECT count(level_id) as V_no from voucher_Type_new where level_id='" . $sql5fetch['Level_id'] . "' and serviceName not like '%RENEWAL%'";
                $sql = mysqli_query($conn, $q);
                $_row = mysqli_fetch_array($sql);


                if ($PromotionalCheck1 == 1) {
                    $counter = 1;
                } else {
                    $counter = 2;
                }

                for ($i = $counter; $i <= $_row['V_no']; $i++) {

                    $countR = $i;
                    $readyToUse = sprintf("%03s", $countR);
                    $NoOfVoucher = $AssignBooklet . $readyToUse;
                    $NoOfVoucher . "<br>";

                    mysqli_query($conn, "insert into BarcodeScan(Voucher_id,Available) values('" . $NoOfVoucher . "','0')");
                }



                // return ; 
    
                if ($qryinsert && $UpdateQry && $UpdateVoucherType) {





                    $rungen = mysqli_query($conn, "SELECT GenerateMember_Id,MembershipDts_PaymentMode,entryDate,MembershipDts_NetPayment,MembershipDts_GrossTotal,receipt_no,booklet_series FROM `Members` where Static_LeadID='" . $Static_LeadID . "'");


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





                    $sql_custom = mysqli_query($conn, "select * from Members where Static_LeadId='" . $Static_LeadID . "'");
                    $custrow = mysqli_fetch_assoc($sql_custom);


                    $validity = $custrow['ExpiryDate'];
                    $level = $custrow['MembershipDetails_Level'];
                    $booklet_series = $custrow['booklet_Series'];
                    $payment_mode = $custrow['MembershipDts_PaymentMode'];

                    $member_id = $custrow['GenerateMember_Id'];








                    if ($sql4fetch['Leval_id'] == '1') {


                        $EmailSubject2 = "Welcome to Club Four Points !";


                        $message2 = '
<table width="50%" align="center">
<td>
<img style="width:100%;" id="Picture 4" src="http://loyaltician.in/clubfourpoints/newassets/image001.jpg">

</td>
</table>





<table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>
    
      <span style="text-decoration:none">
      <img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/clubfourpoints/newassets/image002.png" alt="The Orchid Gold"></span>
    <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right">

  <span style="text-decoration:none"><img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/clubfourpoints/newassets/image003.png" alt="The Orchid Platinum">
  </span>

<u></u><u></u></p>
</td>
</tr>
</tbody>
</table>








<table width="50%" align="center">
<tbody>
<td>
<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal><span lang=EN-IN>Dear ' . $Primary_nameOnTheCard . '</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN></span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Welcome to Club Four Points</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="color:black">We thank you for your decision to become a
member at Four Points by Sheraton Navi Mumbai, Vashi. Your membership details
are as follows:</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Membership Level - Gold</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Your Membership Card number is ' . $member_id . '. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The membership is valid till ' . date('M Y', strtotime($validity)) . ' </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The annual membership charge of Rs. 11000 + 18% Goods &amp; Services
Tax amounting to Rs. 12980 /- (Rupees Twelve Thousand Nine Hundred and Eighty only)
has been received by ' . $payment_mode . '.  A receipt is enclosed in
this email. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>You can present your membership number and a copy of this email to
start using your membership benefits.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The complete welcome package will reach you within 10 working days
of this e-mail. Your membership gift certificates along with the membership are
given at the bottom of this email.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Do take a moment to view all benefits and terms at </span><span
lang=EN-IN><a href="http://www.clubfourpoints.com">www.clubfourpoints.com</a></span><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">Yours sincerely,</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">Team Club Four Points</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">+91 9808293333</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><a href="http://www.clubfourpoints.com"><span style="font-size:12.0pt;
line-height:107%">www.clubfourpoints.com</span></a></span><span lang=EN-IN
style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal align=center style="text-align:center"><span lang=EN-IN
style="font-size:12.0pt;line-height:107%">Gift Certificates issued</span></p>





<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none">
 
 <tr style="height:14.5pt">
 
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">SN</span></b></p>
  </td>
 
  <td width=329 nowrap valign=top style="width:247.0pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Description</span></b></p>
  </td>
 
  <td width=168 nowrap valign=top style="width:125.85pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Number</span></b></p>
  </td>
 
 </tr>';



                        $srno = 1;

                        $qry = "select Leval_id,level_name from Level where Leval_id='" . $sql4fetch['Leval_id'] . "' ";
                        $did = $sql4fetch['Leval_id'];

                        $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type_new` where level_id='" . $did . "' and serviceName not like '%RENEWAL%' order by serialNumber ASC";
                        $runsql2 = mysqli_query($conn, $sql2);
                        while ($sql2fetch = mysqli_fetch_array($runsql2)) {

                            if ($PromotionalCheck1 == 1) {
                                $PromotionalCheck1 = 0;
                                continue;
                            }


                            $remaining1 = substr($sql2fetch['serialNumber'], 8);
                            if ($isfirst == 1) {
                                $value = $AssignBooklet + 1;
                            } else {
                                $value = $AssignBooklet;
                            }

                            $AssignBooklet1 = $value . $remaining1;



                            $message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $srno . '</span></p>
  </td>
  
  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $sql2fetch['serviceName'] . '</span></p>
  </td>
  
  
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $AssignBooklet1 . '</span></p>
  </td>
 
 </tr>';
                            $srno++;
                        }

                        $message2 .= '</table>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white;font-style:normal">&nbsp;</span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">The membership program is operated by Loyaltician
CRM India Private Limited for Chalet Hotels Limited. </span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">This message is sent to you because your email
address is on our subscribers list as a Member with an express consent to
communicate with you. We will ensure only high quality / relevant information
is sent to you to manage your membership. If you wish to change any
communication preferences, please write to us at </span></em><span lang=EN-IN><a
href="mailto:contactus@clubfourpoints.com"><span style="font-size:10.5pt;
line-height:107%;border:none windowtext 1.0pt;
padding:0in;background:white">contactus@clubfourpoints.com</span></a></span><em><span
lang=EN-IN style="font-size:10.5pt;line-height:107%;
color:#444444;border:none windowtext 1.0pt;padding:0in;background:white"> </span></em></p>

<p class=MsoNormal style="line-height:normal;background:white;vertical-align:
baseline"><i><span lang=EN-IN style="font-size:10.5pt;
color:#444444;border:none windowtext 1.0pt;padding:0in">Disclaimer: This
message has been sent as a part of discussion between ‘Club Four Points’ and
the addressee whose name is specified above. Should you receive this message by
mistake, we would be most grateful if you informed us that the message has been
sent to you. In this case, we also ask that you delete this message from your
mailbox, and do not forward it or any part of it to anyone else. Thank you for
your cooperation and understanding.</span></i></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>
</td>
</tbody>
</table>';
                        // echo $message2;
    





                        $pdfsql = mysqli_query($conn, "select * from Members where Static_LeadID='" . $Static_LeadID . "'");
                        $pdfsql_result = mysqli_fetch_assoc($pdfsql);

                        $receiptNO = $pdfsql_result['receipt_no'];
                        $MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
                        $memGST = $pdfsql_result['GST_Number'];
                        if ($memGST) {

                        } else {
                            // $memGST ='27AADCL8692D1Z8';
                        }


                        $pdfleads_sql = mysqli_query($conn, "select * from Leads_table where Lead_id='" . $Static_LeadID . "'");
                        $pdfleads_sql_result = mysqli_fetch_assoc($pdfleads_sql);


                        $Primary_nameOnTheCard = $pdfsql_result['Primary_nameOnTheCard'];
                        $receipt_no = $pdfsql_result['receipt_no'];
                        $entryDate = $pdfsql_result['entryDate'];
                        $entryDate = date("d-m-Y", strtotime($entryDate));
                        $MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
                        if ($MembershipDetails_Level == 1) {
                            $level = 'Gold';
                        } elseif ($MembershipDetails_Level == 2) {
                            $level = 'Platinum';
                        } elseif ($MembershipDetails_Level == 6) {
                            $level = 'Silver';
                        }

                        $ExpiryDate = $pdfsql_result['ExpiryDate'];
                        $ExpiryDate = date("d-m-Y", strtotime($ExpiryDate));
                        $MembershipDetails_Fee = $pdfsql_result['MembershipDetails_Fee'];
                        $MembershipDts_PaymentMode = $pdfsql_result['MembershipDts_PaymentMode'];

                        $CGST = $pdfsql_result['MembershipDts_GST'] / 2;
                        $MembershipDts_GrossTotal = $pdfsql_result['MembershipDts_GrossTotal'];

                        $MobileNumber = $pdfleads_sql_result['MobileNumber'];
                        $Company = $pdfleads_sql_result['Company'];
                        $EmailId = $pdfleads_sql_result['EmailId'];
                        $State = $pdfleads_sql_result['State'];
                        $City = $pdfleads_sql_result['City'];

                        $CGST = $pdfsql_result['MembershipDts_GST'] / 2;


                        $htmtab1 = '<table border="1" cellpadding="5">



                                            <tbody>

                                            <tr>
                                            <th colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <img src="Leadpdf/logoai.jpg" style="margin-left:200px;height:60px;">
                                            </th>
                                            </tr>
                                            
                                            <tr>
                                            <th colspan="6" style="font-size:25px;font-weight:700;text-align:center;"> Loyaltician CRM India Private Limited- A/C Club Four Points </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> Representative for, Four Points by Sheraton Navi Mumbai Vashi,  contactus@clubfourpoints.com </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> GSTN ID- 27AADCL8692D1Z8      State- Maharashtra     Code -27 </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="font-size:25px;text-align:center;"> Tax Invoice cum Receipt </th>
                                            </tr>							
							
                                            
                                            
                                        <tr>
                                            <th colspan="4" style="padding:10pt; background-color: #dbe5f1; color: black; "><b>Invoice to: (Customer Details)</b></th>                                            
                                            <th colspan="2" style="background-color: #dbe5f1; color: black; "><b>Invoice Details</b></th>
                                        </tr>
    

                                        <tr>
                                            <td colspan="4"><b>Company Name :</b> ' . $Company . ' </td>
                                            <td border="0" colspan="1"><b>Date :</b></td>
                                            <td border="0" colspan="1">' . $entryDate . '</td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="4"><b>Name :</b> ' . $Primary_nameOnTheCard . ' </td>
                                            <td colspan="1"><b>Invoice / Receipt: </b></td>
                                            <td colspan="1">' . $receipt_no . '</td>
                                        </tr>
                                        <tr>
                                        
                                            <td colspan="4"><b>Phone: </b>' . $MobileNumber . '</td>
                                            <td colspan="2"><b>Membership Details</b></td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="4"><b>Email :</b> ' . $EmailId . ' </td>
                                            <td colspan="1"><b>Level :</b></td>
                                            <td colspan="1">' . $level . '</td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td class="" colspan="4"><b>GSTN: </b>' . $memGST . ' </td>
                                           <td colspan="1"><b>Validity :</b></td>
                                            <td colspan="1">' . date('M Y', strtotime($ExpiryDate)) . '</td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="3"><b>City: </b>' . $City . ' </td>
                                           <td colspan="3"><b>State :</b>' . $State . '</td>
                                        </tr>




                                        <tr style="background-color: #dbe5f1; color: black; ">
                                            <td class="" colspan="3"><b>Description</b></td>
                                           <td colspan="1"><b>Quantity :</b></td>
                                            <td colspan="1"><b>Unit Price</b></td>
                                            <td colspan="1"><b>Amount</b></td>
                                        </tr>



                                    <tr>
                                            <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">' . $level . ' Membership: </td>
                                           <td colspan="1">1</td>
                                            <td colspan="1">' . $MembershipDetails_Fee . '</td>
                                            <td colspan="1">' . $MembershipDetails_Fee . '</td>
                                            
                                        </tr>
                                       
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Payment Details:</b></td>
                                           <td colspan="2" style="background-color: #daeef3; color: black; "><b>Subtotal:</b></td>
                                            <td colspan="1" style="background-color: #daeef3; color: black; ">' . $MembershipDetails_Fee . '</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; ">Received by : ' . $MembershipDts_PaymentMode . '</td>';

                        if ($State == "MAHARASHTRA" || $State == "Maharashtra") {

                            $htmtab1 .= '<td colspan="2" style="background-color: #daeef3; color: black; "><b>CGST @ 9% </b></td>
                                                    <td colspan="1" style="background-color: #daeef3; color: black; ">' . $CGST . '</td>';

                        } else {
                            $htmtab1 .= '<td colspan="2"rowspan="2" style="background-color: #daeef3; color: black; "><b>IGST @ 18% </b></td>
                                                    <td colspan="1" rowspan="2" style="background-color: #daeef3; color: black; ">' . ($CGST * 2) . '</td>';
                        }


                        $htmtab1 .= '</tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; ">Instrument Number/ Approval Code</td>';

                        if ($State == "MAHARASHTRA" || $State == "Maharashtra") {
                            $htmtab1 .= '<td colspan="2" style="background-color: #daeef3; color: black; "><b>GGST @ 9% </b></td>
                                            <td colspan="1" style="background-color: #daeef3; color: black; ">' . $CGST . '</td>';
                        } else {


                        }


                        $htmtab1 .= '</tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Cheque Favouring -  Loyaltician CRM India Private Limited- A/C Club Four Points</b></td>
                                           <td colspan="2" style="background-color: #dbe5f1; color: black; "><b>Total including Taxes </b></td>
                                            <td colspan="1" style="background-color: #dbe5f1; color: black; "><b>' . $MembershipDts_GrossTotal . '</b></td>
                                        </tr>
                                        
                                       <tr>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">Terms and Conditions<br>
1. To avail input credit (if available), GSTN number and State is mandatory.<br>
2. This is the final invoice regarding the purchase.<br>
3. No refunds are entertained beyond 15 days of purchase<br>
</td>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">
                                        <br><br><br><br><br><br>
                                        <b>Signed</b><br>
                                        For Loyaltician CRM India Private Limited<br>
                                        (Computer Generated Receipt)
                                        </td>


                                    </tr>
                                </tbody>
                            </table>';



                        // echo $htmtab1 ; 
// return ; 
    
                        $pdf->writeHTML($htmtab1 . $htmtab1_body . $tbl_footer, true, false, false, false, '');
                        $pdf->Output('Leadpdf/memberpdf/' . $Primary_nameOnTheCard . '.pdf', 'F');


                        //     $leadsmail2=" contactus@clubfourpoints.com";
                        //     $mailheader2 = "From: ".$leadsmail2."\r\n"; 
                        // $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
    


                        // require_once 'phpmail/src/PHPMailer.php';
// require_once 'phpmail/src/SMTP.php';
// require_once 'phpmail/src/Exception.php';
    

                        $pagesource = "CPF_MemberCreation_Process";
                        $memid = $Static_LeadID;
                        $msg = "";

                        $subject = $EmailSubject2;
                        $message = $message2;
                        $to = [$Primary_Gmail_1];
                        // $cc = ['khannakaran9317@gmail.com'];
                        $cc = ['khannakaran9317@gmail.com', 'hitesh.gunwani@outlook.com'];
                        $bcc = ['khannakaran9317@gmail.com', 'vishwaaniruddh@gmail.com'];



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
                            'pdfstructure' => $htmtab1,
                            'attachment' => $attachment,
                            'primary_name' => $Primary_nameOnTheCard,
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




                        // $mail2 = new PHPMailer\PHPMailer\PHPMailer();
// try{
//     //Server settings
//     //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
//     $mail2->isSMTP();                                       // Set mailer to use SMTP
//     $mail2->Host = 'mail.clubfourpoints.com';                    // Specify main and backup SMTP servers
//     $mail2->SMTPAuth = true;                                // Enable SMTP authentication
//     $mail2->Username = 'contactus@clubfourpoints.com';            // SMTP username
//     $mail2->Password = 'QKAc&mn,[xY%';                          // SMTP password
//     $mail2->SMTPSecure = 'tls';                             // Enable TLS encryption, `ssl` also accepted
//     $mail2->Port = 587;                                     // TCP port to connect to
    
                        //     //Recipients
//     $mail2->setFrom('contactus@clubfourpoints.com','Club Four Points');
    

                        //     $mail2->mailheader=$mailheader2;// Add a recipient
    
                        //     $mail2->addBCC('vishwaaniruddh@gmail.com ');
    

                        //     $mail2->addAddress($Primary_Gmail_1); 
//      $mail2->addCC('hitesh.gunwani@outlook.com ');
// $mail2->addBCC('khannakaran9317@gmail.com');
// $mail2->addAttachment("Leadpdf/memberpdf/$Primary_nameOnTheCard.pdf");
    
                        //     $mail2->isHTML(true);                                  // Set email format to HTML
//     $mail2->Subject = $EmailSubject2."\r\n";
//     $mail2->Body    = $message2;
//     $mail2->send();
// //==============mail end===
// }
// catch(Exception $e){
//     $msg = "Mail not send due to SMTP Host error: mail2!!!";
// }
//   if($msg!='')
// {
//     $sqlr= mysqli_query($conn,"insert into testcatchdata (message,page_source,mem_id,status) values ('".$msg."','".$pagesource."','".$memid."',0) ");
    
                        // }
// else{
    
                        // }	      
    


                    } else if ($sql4fetch['Leval_id'] == '2') {

                        $EmailSubject2 = "Welcome to Club Four Points !";

                        $message2 = '
<table width="50%" align="center">
<td>
<img style="width:100%;" id="Picture 4" src="http://loyaltician.in/clubfourpoints/newassets/image001.jpg">

</td>
</table>





<table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>
    
      <span style="text-decoration:none">
      <img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/clubfourpoints/newassets/image002.png" alt="The Orchid Gold"></span>
    <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right">

  <span style="text-decoration:none"><img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/clubfourpoints/newassets/image003.png" alt="The Orchid Platinum">
  </span>

<u></u><u></u></p>
</td>
</tr>
</tbody>
</table>








<table width="50%" align="center">
<tbody>
<td>
<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal><span lang=EN-IN>Dear ' . $Primary_nameOnTheCard . '</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN></span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Welcome to Club Four Points</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="color:black">We thank you for your decision to become a
member at Four Points by Sheraton Navi Mumbai, Vashi. Your membership details
are as follows:</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Membership Level - Platinum </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Your Membership Card number is ' . $member_id . '. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The membership is valid till ' . date('M Y', strtotime($validity)) . ' </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
The annual membership charge of Rs. 14000 + 18% Goods &amp; Services Tax amounting to Rs. 16520 /- (Rupees Sixteen Thousand Five Hundred and Twenty only) has been received by  ' . $payment_mode . '. A receipt is enclosed in
this email. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>You can present your membership number and a copy of this email to
start using your membership benefits.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The complete welcome package will reach you within 10 working days
of this e-mail. Your membership gift certificates along with the membership are
given at the bottom of this email.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Do take a moment to view all benefits and terms at </span><span
lang=EN-IN><a href="http://www.clubfourpoints.com">www.clubfourpoints.com</a></span><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">Yours sincerely,</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">Team Club Four Points</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">+91 9808293333</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><a href="http://www.clubfourpoints.com"><span style="font-size:12.0pt;
line-height:107%">www.clubfourpoints.com</span></a></span><span lang=EN-IN
style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal align=center style="text-align:center"><span lang=EN-IN
style="font-size:12.0pt;line-height:107%">Gift Certificates issued</span></p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none">
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">SN</span></b></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate
  Description</span></b></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Number</span></b></p>
  </td>
 </tr>';


                        $srno = 1;

                        $qry = "select Leval_id,level_name from Level where Leval_id='" . $sql4fetch['Leval_id'] . "' ";
                        $did = $sql4fetch['Leval_id'];
                        $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type_new` where level_id='" . $did . "' and serviceName not like '%RENEWAL%' order by serialNumber ASC";
                        //echo $sql2;
                        $runsql2 = mysqli_query($conn, $sql2);
                        while ($sql2fetch = mysqli_fetch_array($runsql2)) {

                            $remaining1 = substr($sql2fetch['serialNumber'], 8);
                            //$value= $sql5fetch['AssignBooklet']+1;
                            //$AssignBooklet1=$value.$remaining1;
    

                            if ($isfirst == 1) {
                                $value = $AssignBooklet + 1;
                            } else {
                                $value = $AssignBooklet;
                            }

                            $AssignBooklet1 = $value . $remaining1;




                            $message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $srno . '</span></p>
  </td>
  
  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $sql2fetch['serviceName'] . '</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $AssignBooklet1 . '</span></p>
  </td>
 </tr>';

                            $srno++;
                        }







                        $message2 .= '</table>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white;font-style:normal">&nbsp;</span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">The membership program is operated by Loyaltician
CRM India Private Limited for Chalet Hotels Limited. </span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">This message is sent to you because your email
address is on our subscribers list as a Member with an express consent to
communicate with you. We will ensure only high quality / relevant information
is sent to you to manage your membership. If you wish to change any
communication preferences, please write to us at </span></em><span lang=EN-IN><a
href="mailto:contactus@clubfourpoints.com"><span style="font-size:10.5pt;
line-height:107%;border:none windowtext 1.0pt;
padding:0in;background:white">contactus@clubfourpoints.com</span></a></span><em><span
lang=EN-IN style="font-size:10.5pt;line-height:107%;
color:#444444;border:none windowtext 1.0pt;padding:0in;background:white"> </span></em></p>

<p class=MsoNormal style="line-height:normal;background:white;vertical-align:
baseline"><i><span lang=EN-IN style="font-size:10.5pt;
color:#444444;border:none windowtext 1.0pt;padding:0in">Disclaimer: This
message has been sent as a part of discussion between ‘Club Four Points’ and
the addressee whose name is specified above. Should you receive this message by
mistake, we would be most grateful if you informed us that the message has been
sent to you. In this case, we also ask that you delete this message from your
mailbox, and do not forward it or any part of it to anyone else. Thank you for
your cooperation and understanding.</span></i></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>
</td>
</tbody>
</table>';
                        // echo $message2;
// //exit;
    





                        $pdfsql = mysqli_query($conn, "select * from Members where Static_LeadID='" . $Static_LeadID . "'");
                        $pdfsql_result = mysqli_fetch_assoc($pdfsql);

                        $receiptNO = $pdfsql_result['receipt_no'];
                        $MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
                        $memGST = $pdfsql_result['GST_Number'];
                        if ($memGST) {

                        } else {
                            // $memGST ='27AADCL8692D1Z8';
                        }


                        $pdfleads_sql = mysqli_query($conn, "select * from Leads_table where Lead_id='" . $Static_LeadID . "'");
                        $pdfleads_sql_result = mysqli_fetch_assoc($pdfleads_sql);


                        $Primary_nameOnTheCard = $pdfsql_result['Primary_nameOnTheCard'];
                        $receipt_no = $pdfsql_result['receipt_no'];
                        $entryDate = $pdfsql_result['entryDate'];
                        $entryDate = date("d-m-Y", strtotime($entryDate));
                        $MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
                        if ($MembershipDetails_Level == 1) {
                            $level = 'Gold';
                        } elseif ($MembershipDetails_Level == 2) {
                            $level = 'Platinum';
                        } elseif ($MembershipDetails_Level == 6) {
                            $level = 'Silver';
                        }

                        $ExpiryDate = $pdfsql_result['ExpiryDate'];
                        $ExpiryDate = date("d-m-Y", strtotime($ExpiryDate));
                        $MembershipDetails_Fee = $pdfsql_result['MembershipDetails_Fee'];
                        $MembershipDts_PaymentMode = $pdfsql_result['MembershipDts_PaymentMode'];

                        $CGST = $pdfsql_result['MembershipDts_GST'] / 2;
                        $MembershipDts_GrossTotal = $pdfsql_result['MembershipDts_GrossTotal'];

                        $MobileNumber = $pdfleads_sql_result['MobileNumber'];
                        $Company = $pdfleads_sql_result['Company'];
                        $EmailId = $pdfleads_sql_result['EmailId'];
                        $State = $pdfleads_sql_result['State'];
                        $City = $pdfleads_sql_result['City'];

                        $CGST = $pdfsql_result['MembershipDts_GST'] / 2;


                        $htmtab1 = '<table border="1" cellpadding="5">



                                            <tbody>

                                            <tr>
                                            <th colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <img src="Leadpdf/logoai.jpg" style="margin-left:200px;height:60px;">
                                            </th>
                                            </tr>
                                            
                                            <tr>
                                            <th colspan="6" style="font-size:25px;font-weight:700;text-align:center;"> Loyaltician CRM India Private Limited- A/C Club Four Points </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> Representative for, Four Points by Sheraton Navi Mumbai Vashi,  contactus@clubfourpoints.com </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> GSTN ID- 27AADCL8692D1Z8      State- Maharashtra     Code -27 </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="font-size:25px;text-align:center;"> Tax Invoice cum Receipt </th>
                                            </tr>							
							
                                            
                                            
                                        <tr>
                                            <th colspan="4" style="padding:10pt; background-color: #dbe5f1; color: black; "><b>Invoice to: (Customer Details)</b></th>                                            
                                            <th colspan="2" style="background-color: #dbe5f1; color: black; "><b>Invoice Details</b></th>
                                        </tr>
    

                                        <tr>
                                            <td colspan="4"><b>Company Name :</b> ' . $Company . ' </td>
                                            <td border="0" colspan="1"><b>Date :</b></td>
                                            <td border="0" colspan="1">' . $entryDate . '</td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="4"><b>Name :</b> ' . $Primary_nameOnTheCard . ' </td>
                                            <td colspan="1"><b>Invoice / Receipt: </b></td>
                                            <td colspan="1">' . $receipt_no . '</td>
                                        </tr>
                                        <tr>
                                        
                                            <td colspan="4"><b>Phone: </b>' . $MobileNumber . '</td>
                                            <td colspan="2"><b>Membership Details</b></td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="4"><b>Email :</b> ' . $EmailId . ' </td>
                                            <td colspan="1"><b>Level :</b></td>
                                            <td colspan="1">' . $level . '</td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td class="" colspan="4"><b>GSTN: </b>' . $memGST . ' </td>
                                           <td colspan="1"><b>Validity :</b></td>
                                            <td colspan="1">' . date('M Y', strtotime($ExpiryDate)) . '</td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="3"><b>City: </b>' . $City . ' </td>
                                           <td colspan="3"><b>State :</b>' . $State . '</td>
                                        </tr>




                                        <tr style="background-color: #dbe5f1; color: black; ">
                                            <td class="" colspan="3"><b>Description</b></td>
                                           <td colspan="1"><b>Quantity :</b></td>
                                            <td colspan="1"><b>Unit Price</b></td>
                                            <td colspan="1"><b>Amount</b></td>
                                        </tr>



                                    <tr>
                                            <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">' . $level . ' Membership: </td>
                                           <td colspan="1">1</td>
                                            <td colspan="1">' . $MembershipDetails_Fee . '</td>
                                            <td colspan="1">' . $MembershipDetails_Fee . '</td>
                                            
                                        </tr>
                                       
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Payment Details:</b></td>
                                           <td colspan="2" style="background-color: #daeef3; color: black; "><b>Subtotal:</b></td>
                                            <td colspan="1" style="background-color: #daeef3; color: black; ">' . $MembershipDetails_Fee . '</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; ">Received by : ' . $MembershipDts_PaymentMode . '</td>';

                        if ($State == "MAHARASHTRA" || $State == "Maharashtra") {

                            $htmtab1 .= '<td colspan="2" style="background-color: #daeef3; color: black; "><b>CGST @ 9% </b></td>
                                                    <td colspan="1" style="background-color: #daeef3; color: black; ">' . $CGST . '</td>';

                        } else {
                            $htmtab1 .= '<td colspan="2"rowspan="2" style="background-color: #daeef3; color: black; "><b>IGST @ 18% </b></td>
                                                    <td colspan="1" rowspan="2" style="background-color: #daeef3; color: black; ">' . ($CGST * 2) . '</td>';
                        }


                        $htmtab1 .= '</tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; ">Instrument Number/ Approval Code</td>';

                        if ($State == "MAHARASHTRA" || $State == "Maharashtra") {
                            $htmtab1 .= '<td colspan="2" style="background-color: #daeef3; color: black; "><b>GGST @ 9% </b></td>
                                            <td colspan="1" style="background-color: #daeef3; color: black; ">' . $CGST . '</td>';
                        } else {


                        }


                        $htmtab1 .= '</tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Cheque Favouring -  Loyaltician CRM India Private Limited- A/C Club Four Points</b></td>
                                           <td colspan="2" style="background-color: #dbe5f1; color: black; "><b>Total including Taxes </b></td>
                                            <td colspan="1" style="background-color: #dbe5f1; color: black; "><b>' . $MembershipDts_GrossTotal . '</b></td>
                                        </tr>
                                        
                                       <tr>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">Terms and Conditions<br>
1. To avail input credit (if available), GSTN number and State is mandatory.<br>
2. This is the final invoice regarding the purchase.<br>
3. No refunds are entertained beyond 15 days of purchase<br>
</td>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">
                                        <br><br><br><br><br><br>
                                        <b>Signed</b><br>
                                        For Loyaltician CRM India Private Limited<br>
                                        (Computer Generated Receipt)
                                        </td>


                                    </tr>
                                </tbody>
                            </table>';



                        // echo $htmtab1 ; 
// return ; 
    
                        $pdf->writeHTML($htmtab1 . $htmtab1_body . $tbl_footer, true, false, false, false, '');
                        $pdf->Output('Leadpdf/memberpdf/' . $Primary_nameOnTheCard . '.pdf', 'F');


                        // $leadsmail2=" contactus@clubfourpoints.com";
// $mailheader2 = "From: ".$leadsmail2."\r\n"; 
// $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
    

                        // require_once 'phpmail/src/PHPMailer.php';
// require_once 'phpmail/src/SMTP.php';
// require_once 'phpmail/src/Exception.php';
    
                        $pagesource = "CPF_MemberCreation_Process";
                        $memid = $Static_LeadID;
                        $msg = "";



                        $subject = $EmailSubject2;
                        $message = $message2;
                        $to = [$Primary_Gmail_1];
                        // $cc = ['khannakaran9317@gmail.com'];
                        $cc = ['khannakaran9317@gmail.com', 'hitesh.gunwani@outlook.com'];
                        $bcc = ['khannakaran9317@gmail.com', 'vishwaaniruddh@gmail.com'];



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
                            'pdfstructure' => $htmtab1,
                            'attachment' => $attachment,
                            'primary_name' => $Primary_nameOnTheCard,
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

                    } else if ($sql4fetch['Leval_id'] == '6') {


                        $EmailSubject2 = "Welcome to Club Four Points !";


                        $message2 = '
<table width="50%" align="center">
<td>
<img style="width:100%;" id="Picture 4" src="http://loyaltician.in/clubfourpoints/newassets/image001.jpg">

</td>
</table>





<table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>
    
      <span style="text-decoration:none">
      <img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/clubfourpoints/newassets/image002.png" alt="The Orchid Gold"></span>
    <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right">

  <span style="text-decoration:none"><img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/clubfourpoints/newassets/image003.png" alt="The Orchid Platinum">
  </span>

<u></u><u></u></p>
</td>
</tr>
</tbody>
</table>








<table width="50%" align="center">
<tbody>
<td>
<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal><span lang=EN-IN>Dear ' . $Primary_nameOnTheCard . '</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN></span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Welcome to Club Four Points</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="color:black">We thank you for your decision to become a
member at Four Points by Sheraton Navi Mumbai, Vashi. Your membership details
are as follows:</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Membership Level - Silver</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Your Membership Card number is ' . $member_id . '. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The membership is valid till ' . date('M Y', strtotime($validity)) . ' </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The annual membership charge of Rs. 9000 + 18% Goods &amp; Services
Tax amounting to Rs. 10620 /- (Rupees Ten Thousand Six Hundred and Twenty only)
has been received by ' . $payment_mode . '.  A receipt is enclosed in
this email. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>You can present your membership number and a copy of this email to
start using your membership benefits.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The complete welcome package will reach you within 10 working days
of this e-mail. Your membership gift certificates along with the membership are
given at the bottom of this email.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Do take a moment to view all benefits and terms at </span><span
lang=EN-IN><a href="http://www.clubfourpoints.com">www.clubfourpoints.com</a></span><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">Yours sincerely,</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">Team Club Four Points</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">+91 9808293333</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><a href="http://www.clubfourpoints.com"><span style="font-size:12.0pt;
line-height:107%">www.clubfourpoints.com</span></a></span><span lang=EN-IN
style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal align=center style="text-align:center"><span lang=EN-IN
style="font-size:12.0pt;line-height:107%">Gift Certificates issued</span></p>





<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none">
 
 <tr style="height:14.5pt">
 
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">SN</span></b></p>
  </td>
 
  <td width=329 nowrap valign=top style="width:247.0pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Description</span></b></p>
  </td>
 
  <td width=168 nowrap valign=top style="width:125.85pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Number</span></b></p>
  </td>
 
 </tr>';



                        $srno = 1;

                        $qry = "select Leval_id,level_name from Level where Leval_id='" . $sql4fetch['Leval_id'] . "' ";
                        $did = $sql4fetch['Leval_id'];

                        $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type_new` where level_id='" . $did . "' and serviceName not like '%RENEWAL%' order by serialNumber ASC";

                        $runsql2 = mysqli_query($conn, $sql2);
                        while ($sql2fetch = mysqli_fetch_array($runsql2)) {


                            $remaining1 = substr($sql2fetch['serialNumber'], 8);
                            //$value= $sql5fetch['AssignBooklet']+1;
                            //$AssignBooklet1=$value.$remaining1;
    
                            if ($isfirst == 1) {
                                $value = $AssignBooklet + 1;
                            } else {
                                $value = $AssignBooklet;
                            }

                            $AssignBooklet1 = $value . $remaining1;



                            $message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $srno . '</span></p>
  </td>
  
  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $sql2fetch['serviceName'] . '</span></p>
  </td>
  
  
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $AssignBooklet1 . '</span></p>
  </td>
 
 </tr>';
                            $srno++;
                        }

                        $message2 .= '</table>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white;font-style:normal">&nbsp;</span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">The membership program is operated by Loyaltician
CRM India Private Limited for Chalet Hotels Limited. </span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">This message is sent to you because your email
address is on our subscribers list as a Member with an express consent to
communicate with you. We will ensure only high quality / relevant information
is sent to you to manage your membership. If you wish to change any
communication preferences, please write to us at </span></em><span lang=EN-IN><a
href="mailto:contactus@clubfourpoints.com"><span style="font-size:10.5pt;
line-height:107%;border:none windowtext 1.0pt;
padding:0in;background:white">contactus@clubfourpoints.com</span></a></span><em><span
lang=EN-IN style="font-size:10.5pt;line-height:107%;
color:#444444;border:none windowtext 1.0pt;padding:0in;background:white"> </span></em></p>

<p class=MsoNormal style="line-height:normal;background:white;vertical-align:
baseline"><i><span lang=EN-IN style="font-size:10.5pt;
color:#444444;border:none windowtext 1.0pt;padding:0in">Disclaimer: This
message has been sent as a part of discussion between ‘Club Four Points’ and
the addressee whose name is specified above. Should you receive this message by
mistake, we would be most grateful if you informed us that the message has been
sent to you. In this case, we also ask that you delete this message from your
mailbox, and do not forward it or any part of it to anyone else. Thank you for
your cooperation and understanding.</span></i></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>
</td>
</tbody>
</table>';
                        // echo $message2;
    





                        $pdfsql = mysqli_query($conn, "select * from Members where Static_LeadID='" . $Static_LeadID . "'");
                        $pdfsql_result = mysqli_fetch_assoc($pdfsql);

                        $receiptNO = $pdfsql_result['receipt_no'];
                        $MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
                        $memGST = $pdfsql_result['GST_Number'];
                        if ($memGST) {

                        } else {
                            // $memGST ='27AADCL8692D1Z8';
                        }


                        $pdfleads_sql = mysqli_query($conn, "select * from Leads_table where Lead_id='" . $Static_LeadID . "'");
                        $pdfleads_sql_result = mysqli_fetch_assoc($pdfleads_sql);


                        $Primary_nameOnTheCard = $pdfsql_result['Primary_nameOnTheCard'];
                        $receipt_no = $pdfsql_result['receipt_no'];
                        $entryDate = $pdfsql_result['entryDate'];
                        $entryDate = date("d-m-Y", strtotime($entryDate));
                        $MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];


                        if ($MembershipDetails_Level == 1) {
                            $level = 'Gold';
                        } elseif ($MembershipDetails_Level == 2) {
                            $level = 'Platinum';
                        } elseif ($MembershipDetails_Level == 6) {
                            $level = 'Silver';
                        }

                        $ExpiryDate = $pdfsql_result['ExpiryDate'];
                        $ExpiryDate = date("d-m-Y", strtotime($ExpiryDate));
                        $MembershipDetails_Fee = $pdfsql_result['MembershipDetails_Fee'];
                        $MembershipDts_PaymentMode = $pdfsql_result['MembershipDts_PaymentMode'];

                        $CGST = $pdfsql_result['MembershipDts_GST'] / 2;
                        $MembershipDts_GrossTotal = $pdfsql_result['MembershipDts_GrossTotal'];

                        $MobileNumber = $pdfleads_sql_result['MobileNumber'];
                        $Company = $pdfleads_sql_result['Company'];
                        $EmailId = $pdfleads_sql_result['EmailId'];
                        $State = $pdfleads_sql_result['State'];
                        $City = $pdfleads_sql_result['City'];

                        $CGST = $pdfsql_result['MembershipDts_GST'] / 2;


                        $htmtab1 = '<table border="1" cellpadding="5">



                                            <tbody>

                                            <tr>
                                            <th colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <img src="Leadpdf/logoai.jpg" style="margin-left:200px;height:60px;">
                                            </th>
                                            </tr>
                                            
                                            <tr>
                                            <th colspan="6" style="font-size:25px;font-weight:700;text-align:center;"> Loyaltician CRM India Private Limited- A/C Club Four Points </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> Representative for, Four Points by Sheraton Navi Mumbai Vashi,  contactus@clubfourpoints.com </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> GSTN ID- 27AADCL8692D1Z8      State- Maharashtra     Code -27 </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="font-size:25px;text-align:center;"> Tax Invoice cum Receipt </th>
                                            </tr>							
							
                                            
                                            
                                        <tr>
                                            <th colspan="4" style="padding:10pt; background-color: #dbe5f1; color: black; "><b>Invoice to: (Customer Details)</b></th>                                            
                                            <th colspan="2" style="background-color: #dbe5f1; color: black; "><b>Invoice Details</b></th>
                                        </tr>
    

                                        <tr>
                                            <td colspan="4"><b>Company Name :</b> ' . $Company . ' </td>
                                            <td border="0" colspan="1"><b>Date :</b></td>
                                            <td border="0" colspan="1">' . $entryDate . '</td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="4"><b>Name :</b> ' . $Primary_nameOnTheCard . ' </td>
                                            <td colspan="1"><b>Invoice / Receipt: </b></td>
                                            <td colspan="1">' . $receipt_no . '</td>
                                        </tr>
                                        <tr>
                                        
                                            <td colspan="4"><b>Phone: </b>' . $MobileNumber . '</td>
                                            <td colspan="2"><b>Membership Details</b></td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="4"><b>Email :</b> ' . $EmailId . ' </td>
                                            <td colspan="1"><b>Level :</b></td>
                                            <td colspan="1">' . $level . '</td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td class="" colspan="4"><b>GSTN: </b>' . $memGST . ' </td>
                                           <td colspan="1"><b>Validity :</b></td>
                                            <td colspan="1">' . date('M Y', strtotime($ExpiryDate)) . '</td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="3"><b>City: </b>' . $City . ' </td>
                                           <td colspan="3"><b>State :</b>' . $State . '</td>
                                        </tr>




                                        <tr style="background-color: #dbe5f1; color: black; ">
                                            <td class="" colspan="3"><b>Description</b></td>
                                           <td colspan="1"><b>Quantity :</b></td>
                                            <td colspan="1"><b>Unit Price</b></td>
                                            <td colspan="1"><b>Amount</b></td>
                                        </tr>



                                    <tr>
                                            <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">' . $level . ' Membership: </td>
                                           <td colspan="1">1</td>
                                            <td colspan="1">' . $MembershipDetails_Fee . '</td>
                                            <td colspan="1">' . $MembershipDetails_Fee . '</td>
                                            
                                        </tr>
                                       
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Payment Details:</b></td>
                                           <td colspan="2" style="background-color: #daeef3; color: black; "><b>Subtotal:</b></td>
                                            <td colspan="1" style="background-color: #daeef3; color: black; ">' . $MembershipDetails_Fee . '</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; ">Received by : ' . $MembershipDts_PaymentMode . '</td>';

                        if ($State == "MAHARASHTRA" || $State == "Maharashtra") {

                            $htmtab1 .= '<td colspan="2" style="background-color: #daeef3; color: black; "><b>CGST @ 9% </b></td>
                                                    <td colspan="1" style="background-color: #daeef3; color: black; ">' . $CGST . '</td>';

                        } else {
                            $htmtab1 .= '<td colspan="2"rowspan="2" style="background-color: #daeef3; color: black; "><b>IGST @ 18% </b></td>
                                                    <td colspan="1" rowspan="2" style="background-color: #daeef3; color: black; ">' . ($CGST * 2) . '</td>';
                        }


                        $htmtab1 .= '</tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; ">Instrument Number/ Approval Code</td>';

                        if ($State == "MAHARASHTRA" || $State == "Maharashtra") {
                            $htmtab1 .= '<td colspan="2" style="background-color: #daeef3; color: black; "><b>GGST @ 9% </b></td>
                                            <td colspan="1" style="background-color: #daeef3; color: black; ">' . $CGST . '</td>';
                        } else {


                        }


                        $htmtab1 .= '</tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Cheque Favouring -  Loyaltician CRM India Private Limited- A/C Club Four Points</b></td>
                                           <td colspan="2" style="background-color: #dbe5f1; color: black; "><b>Total including Taxes </b></td>
                                            <td colspan="1" style="background-color: #dbe5f1; color: black; "><b>' . $MembershipDts_GrossTotal . '</b></td>
                                        </tr>
                                        
                                       <tr>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">Terms and Conditions<br>
1. To avail input credit (if available), GSTN number and State is mandatory.<br>
2. This is the final invoice regarding the purchase.<br>
3. No refunds are entertained beyond 15 days of purchase<br>
</td>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">
                                        <br><br><br><br><br><br>
                                        <b>Signed</b><br>
                                        For Loyaltician CRM India Private Limited<br>
                                        (Computer Generated Receipt)
                                        </td>


                                    </tr>
                                </tbody>
                            </table>';


                        $pdf->writeHTML($htmtab1 . $htmtab1_body . $tbl_footer, true, false, false, false, '');
                        $pdf->Output('Leadpdf/memberpdf/' . $Primary_nameOnTheCard . '.pdf', 'F');

                        $pagesource = "CPF_MemberCreation_Process";
                        $memid = $Static_LeadID;
                        $msg = "";

                        $subject = $EmailSubject2;
                        $message = $message2;
                        $to = [$Primary_Gmail_1];
                        // $cc = ['khannakaran9317@gmail.com'];
                        $cc = ['khannakaran9317@gmail.com', 'hitesh.gunwani@outlook.com'];
                        $bcc = ['khannakaran9317@gmail.com', 'vishwaaniruddh@gmail.com'];



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
                            'pdfstructure' => $htmtab1,
                            'attachment' => $attachment,
                            'primary_name' => $Primary_nameOnTheCard,
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



                    // Today Cal
                    $today_sqlsilver = mysqli_query($conn, "select count(mem_id) as today from Members where MembershipDetails_Level=6 and DATE(entryDate) = DATE(NOW())");
                    $today_sqlsilver_result = mysqli_fetch_assoc($today_sqlsilver);
                    $today_silver = $today_sqlsilver_result['today'];


                    $today_sqlgold = mysqli_query($conn, "select count(mem_id) as today from Members where MembershipDetails_Level=1 and DATE(entryDate) = DATE(NOW())");
                    $today_sqlgold_result = mysqli_fetch_assoc($today_sqlgold);
                    $today_gold = $today_sqlgold_result['today'];

                    $today_sqlplat = mysqli_query($conn, "select count(mem_id) as today from Members where MembershipDetails_Level=2 and DATE(entryDate) = DATE(NOW())");
                    $today_sqlplat_result = mysqli_fetch_assoc($today_sqlplat);
                    $today_plat = $today_sqlplat_result['today'];

                    $today = $today_plat + $today_gold + $today_silver;
                    // End Today Cal
    


                    // Month Cal
                    $monthsqlsilver = mysqli_query($conn, "SELECT count(mem_id) as monthss FROM Members WHERE MembershipDetails_Level=6 and MONTH(entryDate) = MONTH(CURDATE()) and YEAR(entryDate) = YEAR(CURDATE())");
                    $monthsqlsilver_result = mysqli_fetch_assoc($monthsqlsilver);
                    $monthsilver = $monthsqlsilver_result['monthss'];

                    $monthsqlgold = mysqli_query($conn, "SELECT count(mem_id) as monthss FROM Members WHERE MembershipDetails_Level=1 and MONTH(entryDate) = MONTH(CURDATE()) and YEAR(entryDate) = YEAR(CURDATE())");
                    $monthsqlgold_result = mysqli_fetch_assoc($monthsqlgold);
                    $monthgold = $monthsqlgold_result['monthss'];

                    $monthsqlplat = mysqli_query($conn, "SELECT count(mem_id) as monthss FROM Members WHERE MembershipDetails_Level=2 and MONTH(entryDate) = MONTH(CURDATE()) and YEAR(entryDate) = YEAR(CURDATE())");
                    $monthsqlplat_result = mysqli_fetch_assoc($monthsqlplat);
                    $monthplat = $monthsqlplat_result['monthss'];

                    $month = $monthgold + $monthplat + $monthsilver;




                    // Year Cal
    
                    $date1 = '2021-04-01';
                    $date2 = date('Y-m-d');

                    $year_sqlsilver = mysqli_query($conn, "SELECT count(mem_id) as years_count FROM Members WHERE MembershipDetails_Level=1 and CAST(entryDate AS DATE) >= '" . $date1 . "' and CAST(entryDate AS DATE) <= '" . $date2 . "'");
                    $year_sqlsilver_result = mysqli_fetch_assoc($year_sqlsilver);
                    $year_sqlsilver_count = $year_sqlsilver_result['years_count'];

                    $year_sqlgold = mysqli_query($conn, "SELECT count(mem_id) as years_count FROM Members WHERE MembershipDetails_Level=1 and CAST(entryDate AS DATE) >= '" . $date1 . "' and CAST(entryDate AS DATE) <= '" . $date2 . "'");
                    $year_sqlgold_result = mysqli_fetch_assoc($year_sqlgold);
                    $year_sqlgold_count = $year_sqlgold_result['years_count'];


                    $year_sqlplat = mysqli_query($conn, "SELECT count(mem_id) as years_count FROM Members WHERE MembershipDetails_Level=2 and CAST(entryDate AS DATE) >= '" . $date1 . "' and CAST(entryDate AS DATE) <= '" . $date2 . "'");
                    $year_sqlplat_result = mysqli_fetch_assoc($year_sqlplat);
                    $year_sqlplat_count = $year_sqlplat_result['years_count'];

                    $yearscount = $year_sqlplat_count + $year_sqlgold_count + $year_sqlsilver_count;







                    $sqlcount = mysqli_query($conn, "SELECT COUNT(level_id) as count FROM `voucher_Type_new` where level_id='" . $did . "' and serviceName not like '%RENEWAL%'");



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

                    $message1 .= '</tr></table>';

                    $message1 .= '<br><br><br>';

                    $message1 .= '<table border="1">
        <tr>
        <td></td>
        <td  style="background:yellow;" colspan="3">Enrollments Update</td>
        </tr>
        
        <tr>
        <td></td>
        <td>Silver</td>
        <td>Gold</td>
        <td>Platinum</td>
        <td>Total</td>
        </tr>
        
        <tr>
        <td>Today</td>
        <td>' . $today_silver . '</td>
        <td>' . $today_gold . '</td>
        <td>' . $today_plat . '</td>
        <td>' . $today . '</td>
        </tr>
        
        
        <tr>
        <td>Month To Date</td>
        <td>' . $monthsilver . '</td>
        <td>' . $monthgold . '</td>
        <td>' . $monthplat . '</td>
        <td>' . $month . '</td>
        </tr>
        
        <tr>
        <td>Year To Date</td>
        <td>' . $year_sqlsilver_count . '</td>
        <td>' . $year_sqlgold_count . '</td>
        <td>' . $year_sqlplat_count . '</td>
        <td>' . $yearscount . '</td>
        </tr>
        </table>';






                    //         $leadsmail1="contactus@clubfourpoints.com";
//         $mailheader1 = "From: ".$leadsmail1."\r\n"; 
//         $mailheader1 .= "Reply-To: ".$leadsmail1."\r\n"; 
    
                    // require_once 'phpmail/src/Exception.php';
// require_once 'phpmail/src/PHPMailer.php';
// require_once 'phpmail/src/SMTP.php';
    
                    $pagesource = "CPF_MemberCreation_Process";
                    $memid = $Static_LeadID;
                    $msg = "";


                    $subject = $EmailSubject1;
                    $message = $message1;
                    $to = ['contactus@clubfourpoints.com'];
                    // $cc = ['khannakaran9317@gmail.com'];
                    $cc = ['khannakaran9317@gmail.com', 'hitesh.gunwani@outlook.com'];
                    $bcc = ['khannakaran9317@gmail.com', 'vishwaaniruddh@gmail.com'];



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
                        'pdfstructure' => $htmtab1,
                        'attachment' => $attachment,
                        'primary_name' => $Primary_nameOnTheCard,
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






                    // $mail1 = new PHPMailer\PHPMailer\PHPMailer();
// try{
//     //Server settings
//     //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
//     $mail1->isSMTP();                                      // Set mailer to use SMTP
//     $mail1->Host = 'mail.clubfourpoints.com';  // Specify main and backup SMTP servers
//     $mail1->SMTPAuth = true;                               // Enable SMTP authentication
//     $mail1->Username = 'contactus@clubfourpoints.com';                 // SMTP username
//     $mail1->Password = 'QKAc&mn,[xY%';                           // SMTP password
//     $mail1->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//     $mail1->Port = 587;                                    // TCP port to connect to
    
                    //     //Recipients
//     $mail1->setFrom('contactus@clubfourpoints.com','Club Four Points');
//     $mail1->addAddress('contactus@clubfourpoints.com'); 
//     $mail1->mailheader=$mailheader1;// Add a recipient
//     $mail1->addBCC('vishwaaniruddh@gmail.com ');
//     $mail1->addBCC('khannakaran9317@gmail.com');
    
                    //     $mail1->isHTML(true);                                  // Set email format to HTML
//     $mail1->Subject = $EmailSubject1."\r\n";
//     $mail1->Body    = $message1."\r\n".$MESSAGE_BODY1;
//     $mail1->send();
// }
// catch(Exception $e){
//     $msg = "Mail not send due to SMTP Host error:mail1 !!!";
// }
//   if($msg!='')
// {
//     $sqlr= mysqli_query($conn,"insert into testcatchdata (message,page_source,mem_id,status) values ('".$msg."','".$pagesource."','".$memid."',0) ");
    
                    // }
// else{
    
                    // }   
    
                    //========================this is for log details========================
    
                    $EmailSubject9 = "New Membership Created Successfully by " . $_SESSION['user'] . "!";

                    $subject = $EmailSubject9;
                    $message = $message1;
                    $to = ['contactus@clubfourpoints.com'];
                    // $cc = ['khannakaran9317@gmail.com'];
                    $cc = ['khannakaran9317@gmail.com', 'hitesh.gunwani@outlook.com'];
                    $bcc = ['khannakaran9317@gmail.com', 'vishwaaniruddh@gmail.com'];



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
                        'pdfstructure' => $htmtab1,
                        'attachment' => $attachment,
                        'primary_name' => $Primary_nameOnTheCard,
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


                    // $mail9 = new PHPMailer\PHPMailer\PHPMailer();
// try{
//     //Server settings
//     //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
//     $mail9->isSMTP();                                      // Set mailer to use SMTP
//     $mail9->Host = 'mail.clubfourpoints.com';  // Specify main and backup SMTP servers
//     $mail9->SMTPAuth = true;                               // Enable SMTP authentication
//     $mail9->Username = 'contactus@clubfourpoints.com';                 // SMTP username
//     $mail9->Password = 'QKAc&mn,[xY%';                           // SMTP password
//     $mail9->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//     $mail9->Port = 587;                                    // TCP port to connect to
    
                    //     //Recipients
//     $mail9->setFrom('contactus@clubfourpoints.com','Club Four Points');
//     $mail9->addAddress('contactus@clubfourpoints.com'); 
//     $mail9->mailheader=$mailheader1;// Add a recipient
//     $mail9->addBCC('vishwaaniruddh@gmail.com ');
//     $mail9->addCC('hitesh.gunwani@outlook.com ');
//     $mail9->addBCC('khannakaran9317@gmail.com');
    
                    //     $mail9->isHTML(true);                                  // Set email format to HTML
//     $mail9->Subject = $EmailSubject9."\r\n";
//     $mail9->Body    = $message1."\r\n".$MESSAGE_BODY1;
//     $mail9->send();
    
                    // //==============mail end===
// }
// catch(Exception $e){
//     $msg = "Mail not send due to SMTP Host error:mail9!!!";
// }
//   if($msg!='')
// {
//     $sqlr= mysqli_query($conn,"insert into testcatchdata (message,page_source,mem_id,status) values ('".$msg."','".$pagesource."','".$memid."',0) ");
    
                    // }
// else{
    
                    // }
    

                    $d = mysqli_query($conn, "insert into voucher_Details (MembershipNumber,VoucherBookletNumber)values('" . $GenNm . "','" . $serialNm . "')");


                    if ($d) {
                        mysqli_commit($conn);
                    }
                    ?>
                                    <script>
                                        swal({
                                            title: "Success!",
                                            text: "Thank you, Add Successfully.!",
                                            icon: "success",
                                            // buttons: true,
                                            dangerMode: true,
                                        });
                                         window.location.href = "prospect_view.php";
                                            // .then((willDelete) => {
                                            //     if (willDelete) {
                                            //         // window.open("prospect_view.php", "_self");
                                            //           window.location.href = "prospect_view.php";

                                            //     }
                                            // });

                                    </script>

                                <?php
                } else {
                    mysqli_rollback($conn);
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
                        });
                         window.location.href = "prospect_view.php";
                            // .then((willDelete) => {
                            //     if (willDelete) {
                            //         // window.open("prospect_view.php", "_self");
                            //           window.location.href = "prospect_view.php";

                            //     }
                            // });

                    </script>
                <?php
        }
    }

    ?>
</body>

</html>