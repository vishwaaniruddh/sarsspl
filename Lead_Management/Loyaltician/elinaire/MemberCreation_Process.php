<?php session_start(); ?>
<html>

<head>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <?php
    // echo '<pre>';print_r($_POST);echo '</pre>';die;
    include ('config.php');
    include ('welcome_template.php');
    include ('number_to_wordConvert.php');


    $hostusername = 'contactus@theresortexperiences.com';

    // $host = 'mail.theresortexperiences.com';
// $hostpassword = '94Z6g.;d1CSq';
// $port = '587';
    
    $host = 'smtp.hostinger.com';
    $hostpassword = 'mckyaUC,?z5H';
    $port = '587';


    // $nodes = 'https://arpeeindustries.in/mail.php';
    $nodes = 'https://sarsspl.com/SarMailor_APIS/mail.php';

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

    $MemshipDts_GST_number = $_POST['MemshipDts_GST_number'];

    // part 4.Documentation
    $Documentation_UploadSignatures = $_POST['Documentation_UploadSignatures'];
    $Documentation_AddressProof = $_POST['Documentation_AddressProof'];

    // part 5. Relationships
    $Relationships_ReferredByLEADID = $_POST['Relationships_ReferredByLEADID'];
    $Relationships_ReferredByMEMBERSHIPID = $_POST['Relationships_ReferredByMEMBERSHIPID'];

    // Part 6. Issue Membership
    $itemCheck1 = $_POST['itemCheck1'];
    $BookletCheck1 = $_POST['BookletCheck1'];
    $CertificatesCheck1 = $_POST['CertificatesCheck1'];
    $PromotionalCheck1 = $_POST['PromotionalCheck1'];
    $RenewalCheck1 = $_POST['RenewalCheck1'];
    $ExpiryCheck1 = $_POST['ExpiryCheck1'];
    $ActualExpiry = $_POST['ActualExpiry'];
    $ChangedExpiry = $_POST['ChangedExpiry'];


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
    // echo $PromotionalCheck1."--";
    if ($PromotionalCheck1 == "") {
        $PromotionalCheck1 = 0;
    } else {
        $PromotionalCheck1 = 1;
    }

    if ($RenewalCheck1 == "") {
        $RenewalCheck1 = 0;
    } else {
        $RenewalCheck1 = 1;
    }
    if ($ExpiryCheck1 == "") {
        $ExpiryCheck1 = 0;
    } else {
        $ExpiryCheck1 = 1;
    }

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

    //booklet Assign
    $sql3 = "SELECT MembershipDetails_Level FROM `Members` where  Static_LeadID='" . $Static_LeadID . "' ";
    $runsql3 = mysqli_query($conn, $sql3);
    $sql3fetch = mysqli_fetch_array($runsql3);

    $sql4 = "SELECT * FROM `Level` where Leval_id='" . $sql3fetch['MembershipDetails_Level'] . "' ";
    $runsql4 = mysqli_query($conn, $sql4);
    $sql4fetch = mysqli_fetch_array($runsql4);

    $sql5 = "SELECT FromSerialNo,ToSerialNo,AssignBooklet,Level_id FROM `voucher_Booklet` where Program_ID='" . $sql4fetch['Program_ID'] . "' and Level_id='" . $sql4fetch['Leval_id'] . "'   ";
    //$sql5="SELECT FromSerialNo,ToSerialNo,AssignBooklet,Level_id FROM `voucher_Booklet` where Program_ID='2' and Level_id='2'";
    $runsql5 = mysqli_query($conn, $sql5);
    $sql5fetch = mysqli_fetch_array($runsql5);

    $AssignBooklet = $sql5fetch['AssignBooklet'];

    if ($AssignBooklet == 0) {
        $AssignBooklet = $sql5fetch['FromSerialNo'];
        $isfirst = 1;
    }

    $AdditionalPromotionalAssignBooklet = "";
    if ($PromotionalCheck1 == '1') {
        $promotionalmastersql = "SELECT voucher_code FROM `voucher_issued_code` where Program_ID='" . $sql4fetch['Program_ID'] . "' AND voucher_name='Promotional'";
        $promotionalmastersql_result = mysqli_query($conn, $promotionalmastersql);
        $promotionalmastersql_result_data = mysqli_fetch_assoc($promotionalmastersql_result);
        $promotionalsql = "SELECT fromSerialNo,toSerialNo,issued_voucher_code,voucher_code FROM `voucher_issued_additional` where Program_ID='" . $sql4fetch['Program_ID'] . "' and voucher_code='" . $promotionalmastersql_result_data['voucher_code'] . "'";
        $promotionalsql_result = mysqli_query($conn, $promotionalsql);
        if (mysqli_num_rows($promotionalsql_result) == 0) { ?>
            <script>
                window.location.href = "show_message.php?code=1";
            </script>
        <?php }
        $promotionalsql_result_fetch = mysqli_fetch_assoc($promotionalsql_result);
        $prefix_code = $promotionalsql_result_fetch['voucher_code'];

        if ($promotionalsql_result_fetch['issued_voucher_code'] == "0") {
            $AdditionalPromotionalAssignBooklet = $prefix_code . '0001';
        } else {
            $remaining_p = substr($promotionalsql_result_fetch['issued_voucher_code'], 3);
            $countR_p = $remaining_p + 1;
            $readyToUse_p = sprintf("%04s", $countR_p);
            $AdditionalPromotionalAssignBooklet = $prefix_code . $readyToUse_p;
        }
    }
    $AdditionalRenewalAssignBooklet = "";
    if ($RenewalCheck1 == '1') {
        $renewalmastersql = "SELECT voucher_code FROM `voucher_issued_code` where Program_ID='" . $sql4fetch['Program_ID'] . "' AND voucher_name='Renewal'";
        $renewalmastersql_result = mysqli_query($conn, $renewalmastersql);
        $renewalmastersql_result_data = mysqli_fetch_assoc($renewalmastersql_result);
        $renewalsql = "SELECT fromSerialNo,toSerialNo,issued_voucher_code,voucher_code FROM `voucher_issued_additional` where Program_ID='" . $sql4fetch['Program_ID'] . "' and voucher_code='" . $renewalmastersql_result_data['voucher_code'] . "'";
        $renewalsql_result = mysqli_query($conn, $renewalsql);
        if (mysqli_num_rows($renewalsql_result) == 0) { ?>
            <script>
                window.location.href = "show_message.php?code=2";
            </script>
        <?php }
        $renewalsql_result_fetch = mysqli_fetch_assoc($renewalsql_result);

        $prefix_code_r = $renewalsql_result_fetch['voucher_code'];
        if ($renewalsql_result_fetch['issued_voucher_code'] == "0") {
            $AdditionalRenewalAssignBooklet = $prefix_code_r . '0001';
        } else {
            $remaining_r = substr($renewalsql_result_fetch['issued_voucher_code'], 3);
            $countR_r = $remaining_r + 1;
            $readyToUse_r = sprintf("%04s", $countR_r);
            $AdditionalRenewalAssignBooklet = $prefix_code_r . $readyToUse_r;
        }
    }
    if ($sql5fetch['FromSerialNo'] <= $sql5fetch['ToSerialNo']) {
        $levelIncrement = "0";
        if ($sql5fetch['Level_id'] == '1') {
            $levelIncrement = '12000';
        } else if ($sql5fetch['Level_id'] == '2') {
            $levelIncrement = '14000';
        } else if ($sql5fetch['Level_id'] == '3') {
            $levelIncrement = '18000';
        }

        // echo $levelIncrement."   ";
    
        if ($sql5fetch['AssignBooklet'] == "0") {
            $AssignBooklet = $levelIncrement . '001';
        } else {
            $remaining = substr($sql5fetch['AssignBooklet'], 5);
            $countR = $remaining + 1;
            $readyToUse = sprintf("%03s", $countR);
            $AssignBooklet = $levelIncrement . $readyToUse;
        }


        // echo $AssignBooklet; die;
        if ($sql5fetch['ToSerialNo'] >= $AssignBooklet) {
            //   $d= strtotime(addTime($dd, 0, $exm, 0));
            //       $formattedValue = date("F, Y", $d);
            //       $R=$formattedValue;
    
            // if($ExpiryCheck1=="0"){ echo "00";
    
            //    $expirydate = date("Y-m-d");
            // }else if($ExpiryCheck1=="1"){ echo "11";
            //         $expirydate = date("Y-m-d",strtotime($ChangedExpiry));
            // }
            // echo $expirydate; die;
    
            mysqli_query($conn, "START TRANSACTION");

            $qryinsert = mysqli_query($conn, "Update Members set member_since='" . $todaysdate . "' ,Primary_Title='" . $Primary_Title . "',Primary_Pincode='" . $Primary_Pincode . "',Primary_mcode2='" . $Primary_mcode2 . "',Primary_mob2='" . $Primary_mob2 . "',Primary_Contact1code='" . $Primary_Contact1code . "',Primary_Contact1='" . $Primary_Contact1 . "',Primary_Contact2code='" . $Primary_Contact2code . "',Primary_Contact2='" . $Primary_Contact2 . "',Primary_Contact3code='" . $Primary_Contact3code . "',Primary_Contact3='" . $Primary_Contact3 . "',Primary_nameOnTheCard='" . $Primary_nameOnTheCard . "',Primary_PhotoUpload='" . $Primary_PhotoUpload . "',Primary_Email_ID2='" . $Primary_Email_ID2 . "',Primary_DateOfBirth='" . $DOB . "',Primary_Anniversary='" . $Primary_Anniversary . "',Primary_AddressType1='" . $Primary_AddressType1 . "',Primary_BuldNo_addrss='" . $Primary_BuldNo_addrss . "',Primary_Area_addrss='" . $Primary_Area_addrss . "',Primary_Landmark_addrss='" . $Primary_Landmark_addrss . "',Primary_MaritalStatus='" . $Primary_MaritalStatus . "',Spouse_Title='" . $Spouse_Title . "',Spouse_FirstName='" . $Spouse_FirstName . "',Spouse_LastName='" . $Spouse_LastName . "',Spouse_GmailMArrid1='" . $Spouse_GmailMArrid1 . "',Spouse_GmailMArrid2='" . $Spouse_GmailMArrid2 . "',Spouse_PhotoUpload='" . $Spouse_PhotoUpload . "',Spouse_mcode1Married1='" . $Spouse_mcode1Married1 . "',Spouse_mob1MArid1='" . $Spouse_mob1MArid1 . "',Spouse_mcode1Married2='" . $Spouse_mcode1Married2 . "',Spouse_mob1MArid2='" . $Spouse_mob1MArid2 . "',Spouse_Contact1codeMArid='" . $Spouse_Contact1codeMArid . "',Spouse_Contact1Married='" . $Spouse_Contact1Married . "',Spouse_Contact2codeMArid='" . $Spouse_Contact2codeMArid . "',Spouse_DateOfBirth='" . $Spouse_DOB . "',Spouse_nameOnTheCardMarried='" . $Spouse_nameOnTheCardMarried . "',Documentation_UploadSignatures='" . $Documentation_UploadSignatures . "',Documentation_AddressProof='" . $Documentation_AddressProof . "',Relationships_ReferredByLEADID='" . $Relationships_ReferredByLEADID . "',Relationships_ReferredByMEMBERSHIPID='" . $Relationships_ReferredByMEMBERSHIPID . "',itemCheck1='" . $itemCheck1 . "',BookletCheck1='" . $BookletCheck1 . "',CertificatesCheck1='" . $CertificatesCheck1 . "',PromotionalCheck1='" . $PromotionalCheck1 . "',RenewalCheck1='" . $RenewalCheck1 . "',Issue_ReferredByLEADID='" . $Issue_ReferredByLEADID . "',Issue_ReferredByMEMBERSHIPID='" . $Issue_ReferredByMEMBERSHIPID . "',booklet_Series='" . $AssignBooklet . "',GST_NUMBER='" . $MemshipDts_GST_number . "' where Static_LeadID='" . $Static_LeadID . "' ");
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
                    $NoOfVoucher . "<br>";
                    mysqli_query($conn, "insert into BarcodeScan(Voucher_id,Available) values('" . $NoOfVoucher . "','0')");
                }

                if ($PromotionalCheck1 == '1') {
                    $UpdatePromotionalVoucherCode = mysqli_query($conn, "update voucher_issued_additional set issued_voucher_code='" . $AdditionalPromotionalAssignBooklet . "' where voucher_code='" . $prefix_code . "' ");
                    mysqli_query($conn, "insert into BarcodeScan(Voucher_id,Available) values('" . $AdditionalPromotionalAssignBooklet . "','0')");
                    mysqli_query($conn, "Update Members set promotional_voucher_code='" . $AdditionalPromotionalAssignBooklet . "' where Static_LeadID='" . $Static_LeadID . "'");
                }
                if ($RenewalCheck1 == '1') {
                    $UpdateRenewalVoucherCode = mysqli_query($conn, "update voucher_issued_additional set issued_voucher_code='" . $AdditionalRenewalAssignBooklet . "' where voucher_code='" . $prefix_code_r . "' ");
                    mysqli_query($conn, "insert into BarcodeScan(Voucher_id,Available) values('" . $AdditionalRenewalAssignBooklet . "','0')");
                    mysqli_query($conn, "Update Members set renewal_voucher_code='" . $AdditionalRenewalAssignBooklet . "' where Static_LeadID='" . $Static_LeadID . "'");
                }

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
                    $formattedValue = date("F, Y", $d);
                    $R = $formattedValue;

                    if ($ExpiryCheck1 == "0") {
                        $expirydate = date("Y-m-d", $d);
                    } else if ($ExpiryCheck1 == "1") {
                        $expirydate = date("Y-m-d", strtotime($ChangedExpiry));
                    }

                    mysqli_query($conn, "Update Members set ExpiryDate='" . $expirydate . "', ActualExpiryDate='" . $ActualExpiry . "',ExpiryCheck1='" . $ExpiryCheck1 . "' where Static_LeadID='" . $Static_LeadID . "' ");

                    $sql_custom = mysqli_query($conn, "select * from Members where Static_LeadId='" . $Static_LeadID . "'");
                    $custrow = mysqli_fetch_assoc($sql_custom);


                    $validity = $custrow['ExpiryDate'];
                    $level = $custrow['MembershipDetails_Level'];
                    $booklet_series = $custrow['booklet_Series'];
                    $payment_mode = $custrow['MembershipDts_PaymentMode'];
                    $MembershipDts_NetPayment = $custrow['MembershipDts_NetPayment'];
                    $MembershipDts_GrossTotal = $custrow['MembershipDts_GrossTotal'];



                    $member_id = $custrow['GenerateMember_Id'];

                    if ($sql4fetch['Leval_id'] == '1') {
                        select($Primary_Gmail_1, $Primary_nameOnTheCard, $member_id, $validity, $payment_mode, 1, $Static_LeadID, $AdditionalRenewalAssignBooklet, $AdditionalPromotionalAssignBooklet, $pdf, $MembershipDts_NetPayment, $MembershipDts_GrossTotal, $AssignBooklet);

                    } else if ($sql4fetch['Leval_id'] == '2') {
                        plus($Primary_Gmail_1, $Primary_nameOnTheCard, $member_id, $validity, $payment_mode, 2, $Static_LeadID, $AdditionalRenewalAssignBooklet, $AdditionalPromotionalAssignBooklet, $pdf, $MembershipDts_NetPayment, $MembershipDts_GrossTotal, $AssignBooklet);

                    } else if ($sql4fetch['Leval_id'] == '3') {
                        premium($Primary_Gmail_1, $Primary_nameOnTheCard, $member_id, $validity, $payment_mode, 3, $Static_LeadID, $AdditionalRenewalAssignBooklet, $AdditionalPromotionalAssignBooklet, $pdf, $MembershipDts_NetPayment, $MembershipDts_GrossTotal, $AssignBooklet);


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
                    $today_sqlgold = mysqli_query($conn, "select count(mem_id) as today from Members where MembershipDetails_Level=1 and DATE(entryDate) = DATE(NOW())");
                    $today_sqlgold_result = mysqli_fetch_assoc($today_sqlgold);
                    $today_gold = $today_sqlgold_result['today'];

                    $today_sqlplat = mysqli_query($conn, "select count(mem_id) as today from Members where MembershipDetails_Level=2 and DATE(entryDate) = DATE(NOW())");
                    $today_sqlplat_result = mysqli_fetch_assoc($today_sqlplat);
                    $today_plat = $today_sqlplat_result['today'];

                    $today_sqlivory = mysqli_query($conn, "select count(mem_id) as today from Members where MembershipDetails_Level=3 and DATE(entryDate) = DATE(NOW())");
                    $today_sqlivory_result = mysqli_fetch_assoc($today_sqlivory);
                    $today_ivory = $today_sqlivory_result['today'];

                    $today = $today_plat + $today_gold + $today_ivory;
                    // End Today Cal
    


                    // Month Cal
                    $monthsqlgold = mysqli_query($conn, "SELECT count(mem_id) as monthss FROM Members WHERE MembershipDetails_Level=1 and MONTH(entryDate) = MONTH(CURDATE()) and YEAR(entryDate) = YEAR(CURDATE())");
                    $monthsqlgold_result = mysqli_fetch_assoc($monthsqlgold);
                    $monthgold = $monthsqlgold_result['monthss'];

                    $monthsqlplat = mysqli_query($conn, "SELECT count(mem_id) as monthss FROM Members WHERE MembershipDetails_Level=2 and MONTH(entryDate) = MONTH(CURDATE()) and YEAR(entryDate) = YEAR(CURDATE())");
                    $monthsqlplat_result = mysqli_fetch_assoc($monthsqlplat);
                    $monthplat = $monthsqlplat_result['monthss'];

                    $monthsqlivory = mysqli_query($conn, "SELECT count(mem_id) as monthss FROM Members WHERE MembershipDetails_Level=3 and MONTH(entryDate) = MONTH(CURDATE()) and YEAR(entryDate) = YEAR(CURDATE())");
                    $monthsqlivory_result = mysqli_fetch_assoc($monthsqlivory);
                    $monthivory = $monthsqlivory_result['monthss'];

                    $month = $monthgold + $monthplat + $monthivory;




                    // Year Cal
    
                    $date1 = '2021-04-01';
                    $date2 = date('Y-m-d');

                    $year_sqlgold = mysqli_query($conn, "SELECT count(mem_id) as years_count FROM Members WHERE MembershipDetails_Level=1 and CAST(entryDate AS DATE) >= '" . $date1 . "' and CAST(entryDate AS DATE) <= '" . $date2 . "'");
                    $year_sqlgold_result = mysqli_fetch_assoc($year_sqlgold);
                    $year_sqlgold_count = $year_sqlgold_result['years_count'];


                    $year_sqlplat = mysqli_query($conn, "SELECT count(mem_id) as years_count FROM Members WHERE MembershipDetails_Level=2 and CAST(entryDate AS DATE) >= '" . $date1 . "' and CAST(entryDate AS DATE) <= '" . $date2 . "'");
                    $year_sqlplat_result = mysqli_fetch_assoc($year_sqlplat);
                    $year_sqlplat_count = $year_sqlplat_result['years_count'];

                    $year_sqlivory = mysqli_query($conn, "SELECT count(mem_id) as years_count FROM Members WHERE MembershipDetails_Level=3 and CAST(entryDate AS DATE) >= '" . $date1 . "' and CAST(entryDate AS DATE) <= '" . $date2 . "'");
                    $year_sqlivory_result = mysqli_fetch_assoc($year_sqlivory);
                    $year_sqlivory_count = $year_sqlivory_result['years_count'];

                    $yearscount = $year_sqlplat_count + $year_sqlgold_count + $year_sqlivory_count;







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

                    $message1 .= '</tr></table>';

                    $message1 .= '<br><br><br>';

                    $message1 .= '<table border="1">
        <tr>
        <td></td>
        <td  style="background:yellow;" colspan="4">Enrollments Update</td>
        </tr>

        <tr>
        <td></td>
        <td>Select</td>
        <td>Plus</td>
        <td>Premium</td>
        <td>Total</td>
        </tr>

        <tr>
        <td>Today</td>
        <td>' . $today_gold . '</td>
        <td>' . $today_plat . '</td>
        <td>' . $today_ivory . '</td>
        <td>' . $today . '</td>
        </tr>


        <tr>
        <td>Month To Date</td>
        <td>' . $monthgold . '</td>
        <td>' . $monthplat . '</td>
        <td>' . $monthivory . '</td>
        <td>' . $month . '</td>
        </tr>

        <tr>
        <td>Year To Date</td>
        <td>' . $year_sqlgold_count . '</td>
        <td>' . $year_sqlplat_count . '</td>
        <td>' . $year_sqlivory_count . '</td>
        <td>' . $yearscount . '</td>
        </tr>
        </table>';




                    require_once 'phpmail/src/PHPMailer.php';
                    require_once 'phpmail/src/SMTP.php';
                    require_once 'phpmail/src/Exception.php';


                    $leadsmail1 = "contactus@theresortexperiences.com";
                    $mailheader1 = "From: " . $leadsmail1 . "\r\n";
                    $mailheader1 .= "Reply-To: " . $leadsmail1 . "\r\n";


                    // $pagesource = "MemberCreation_Process";
// $memid = $Static_LeadID;
// $msg = "";
// $member_id = $GenerateMember_Id;
    

                    $subject = $EmailSubject1;
                    $message = $message1;
                    $leadsmail = $leadsmail1;

                    $from = 'contactus@theresortexperiences.com';
                    $fromname = 'The Resort Mumbai';



                    $to = ['contactus@theresortexperiences.com'];
                    $cc = [];
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



                    //========================this is for log details========================
    
                    $EmailSubject9 = "New Membership Created Successfully by " . $_SESSION['user'] . "!";

                    $subject = $EmailSubject9;
                    $message = $message1;
                    $leadsmail = $leadsmail1;

                    $from = 'contactus@theresortexperiences.com';
                    $fromname = 'The Resort Mumbai';



                    $to = ['contactus@theresortexperiences.com'];
                    $cc = [];
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
                        }).then((willDelete) => {
                            if (willDelete) {
                                window.open("prospect_view.php", "_self");
                            }
                        });
                    </script>
                    <?
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
                }).then((willDelete) => {
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