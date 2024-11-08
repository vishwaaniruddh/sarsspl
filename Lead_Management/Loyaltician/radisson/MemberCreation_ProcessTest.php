<?php session_start();
ini_set('memory_limit', '-1');

?>
<html>

<head>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <?php
    include ('config.php');
    include ('number_to_wordConvert.php');

    $host = 'smtp.hostinger.com';
    $hostusername = 'contactus@clubeliteplus.com';
    $hostpassword = '8x%8AovpL3O8';
    $port = '587';

    // $nodes = 'https://sarmicrosystems.in/SarMailor_APIS/LOYALTICIAN/mail.php';
// $nodes = 'https://arpeeindustries.in/mail.php';
    // $nodes = 'https://sarsspl.com/SarMailor_APIS/mail.php';


    $leadsmail2 = " contactus@clubeliteplus.com";
    $leadsmail = $leadsmail2;

    $from = 'contactus@clubeliteplus.com';
    $fromname = 'Radisson';


    // $to =['orchidgoldpune@orchidhotel.com'];
    $cc = ['contactus@clubeliteplus.com', 'pratik@loyaltician.com', 'farheen@loyaltician.com', 'fbmgr@rdmumbai.com', 'credit@rdmumbai.com'];
    $bcc = [];





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




    $MembershipDetails_Fee = $_REQUEST['MembershipDetails_Fee'];
    $MembershipDts_NetPayment = $_REQUEST['MembershipDts_NetPayment'];


    $Static_LeadID = $_REQUEST['Static_LeadID'];


    $memsql = mysqli_query($conn, "select * from Members where Static_LeadID='" . $Static_LeadID . "'");
    $memsql_result = mysqli_fetch_assoc($memsql);
    $savedDiscount = $memsql_result['MembershipDts_Discount'];
    $totalGst = $memsql_result['MembershipDts_GST'];
    $cgst = $totalGst / 2;
    $MembershipDts_GrossTotal = $memsql_result['MembershipDts_GrossTotal'];


    // return ; 
    

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
    
     // Additional Meal Vouchers
    
    $MealCheck1 = $_POST['MealCheck1'];
    $MealCheck2 = $_POST['MealCheck2'];

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
    
    
   if ($MealCheck1 == "") {
        $_MealCheck1 = 0;
    } else {
        $_MealCheck1 = 1;
    }
    
    if ($MealCheck2 == "") {
        $MealCheck2 = 0;
    } else {
        $MealCheck2 = 1;
    }
    
    
    if($MealCheck1 == 'on')
    { 
        echo '1'.' ';
        $mealsql = mysqli_query($conn,"select * from voucher_issued_additional"); 
        $mealsql_result = mysqli_fetch_assoc($mealsql);
        $additional_voucher = $mealsql_result['issued_voucher_code'];
        $prefixcode = $mealsql_result['voucher_code'];
        
         $meal_sql = mysqli_query($conn, "SELECT max(meal_voucher_code) as meal_voucher FROM `Members_test`");
            $meal_sql_result = mysqli_fetch_assoc($meal_sql);
            $meal_voucher = $meal_sql_result['meal_voucher'];
            
            if($meal_voucher == "" || $meal_voucher == NULL){
                $_meal_voucher = $additional_voucher;
            } else {
                $_meal_voucher = $additional_voucher + 1;
            }
            
             $member_additional = $prefixcode._.$_meal_voucher;
             
            $Static_LeadID = 36;
            //$meal_voucher = $meal_sql_result['meal'] + 1;
        
        mysqli_query($conn, "insert into BarcodeScan_test(Voucher_id,Available) values('" . $member_additional . "','0')");
        
        mysqli_query($conn, "Update Members_test set meal_voucher_code='" . $member_additional . "' where Static_LeadID='" . $Static_LeadID . "'");

            mysqli_query($conn, "update voucher_issued_additional set issued_voucher_code = '" . $_meal_voucher . "'");
        
    }
    
     echo $member_additional."<br>";
    
    var_dump($meal_voucher); 
    die;
    
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

    $attachment = "https://loyaltician.in/radisson/Leadpdf/memberpdf/$Primary_nameOnTheCard.pdf";


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
        }


        if ($sql5fetch['AssignBooklet'] == "0") {
            $AssignBooklet = $levelIncrement . '001';
        } else {
            $remaining = substr($sql5fetch['AssignBooklet'], 5);
            $countR = $remaining + 1;
            $readyToUse = sprintf("%03s", $countR);
            $AssignBooklet = $levelIncrement . $readyToUse;
        }








        if ($sql5fetch['ToSerialNo'] >= $AssignBooklet) {



            mysqli_query($conn, "START TRANSACTION");

            $qryinsert = mysqli_query($conn, "Update Members set member_since='" . $todaysdate . "' ,Primary_Title='" . $Primary_Title . "',Primary_Pincode='" . $Primary_Pincode . "',Primary_mcode2='" . $Primary_mcode2 . "',Primary_mob2='" . $Primary_mob2 . "',Primary_Contact1code='" . $Primary_Contact1code . "',Primary_Contact1='" . $Primary_Contact1 . "',Primary_Contact2code='" . $Primary_Contact2code . "',Primary_Contact2='" . $Primary_Contact2 . "',Primary_Contact3code='" . $Primary_Contact3code . "',Primary_Contact3='" . $Primary_Contact3 . "',Primary_nameOnTheCard='" . $Primary_nameOnTheCard . "',Primary_PhotoUpload='" . $Primary_PhotoUpload . "',Primary_Email_ID2='" . $Primary_Email_ID2 . "',Primary_DateOfBirth='" . $DOB . "',Primary_Anniversary='" . $Primary_Anniversary . "',Primary_AddressType1='" . $Primary_AddressType1 . "',Primary_BuldNo_addrss='" . $Primary_BuldNo_addrss . "',Primary_Area_addrss='" . $Primary_Area_addrss . "',Primary_Landmark_addrss='" . $Primary_Landmark_addrss . "',Primary_MaritalStatus='" . $Primary_MaritalStatus . "',Spouse_Title='" . $Spouse_Title . "',Spouse_FirstName='" . $Spouse_FirstName . "',Spouse_LastName='" . $Spouse_LastName . "',Spouse_GmailMArrid1='" . $Spouse_GmailMArrid1 . "',Spouse_GmailMArrid2='" . $Spouse_GmailMArrid2 . "',Spouse_PhotoUpload='" . $Spouse_PhotoUpload . "',Spouse_mcode1Married1='" . $Spouse_mcode1Married1 . "',Spouse_mob1MArid1='" . $Spouse_mob1MArid1 . "',Spouse_mcode1Married2='" . $Spouse_mcode1Married2 . "',Spouse_mob1MArid2='" . $Spouse_mob1MArid2 . "',Spouse_Contact1codeMArid='" . $Spouse_Contact1codeMArid . "',Spouse_Contact1Married='" . $Spouse_Contact1Married . "',Spouse_Contact2codeMArid='" . $Spouse_Contact2codeMArid . "',Spouse_DateOfBirth='" . $Spouse_DOB . "',Spouse_nameOnTheCardMarried='" . $Spouse_nameOnTheCardMarried . "',Documentation_UploadSignatures='" . $Documentation_UploadSignatures . "',Documentation_AddressProof='" . $Documentation_AddressProof . "',Relationships_ReferredByLEADID='" . $Relationships_ReferredByLEADID . "',Relationships_ReferredByMEMBERSHIPID='" . $Relationships_ReferredByMEMBERSHIPID . "',itemCheck1='" . $itemCheck1 . "',BookletCheck1='" . $BookletCheck1 . "',CertificatesCheck1='" . $CertificatesCheck1 . "',PromotionalCheck1='" . $PromotionalCheck1 . "',Issue_ReferredByLEADID='" . $Issue_ReferredByLEADID . "',Issue_ReferredByMEMBERSHIPID='" . $Issue_ReferredByMEMBERSHIPID . "',booklet_Series='" . $AssignBooklet . "',GST_NUMBER='" . $MemshipDts_GST_number . "' where Static_LeadID='" . $Static_LeadID . "' ");


            if ($qryinsert) {

                $UpdateQry = mysqli_query($conn, "update Leads_table set Status='5',MobileCode2='" . $Primary_mcode2 . "', MobileNumber2	='" . $Primary_mob2 . "',contact1Code='" . $Primary_Contact1code . "' ,ContactNo1='" . $Primary_Contact1 . "',contact2Code='" . $Primary_Contact2code . "',ContactNo2='" . $Primary_Contact2 . "',contact3Code='" . $Primary_Contact3code . "',ContactNo3='" . $Primary_Contact3 . "'  where Lead_id='" . $Static_LeadID . "' ");

                $UpdateVoucherType = mysqli_query($conn, "update voucher_Booklet set AssignBooklet='" . $AssignBooklet . "' where Level_id='" . $sql5fetch['Level_id'] . "' ");


                // Normal Vouchers
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

                // End Normal Vouchers
    

                //   Promotional Vouchers
    
                $PromotionalCheck1 = $_REQUEST['PromotionalCheck1'];

                if ($PromotionalCheck1 == 'on') {
                    $q = "SELECT * from voucher_Type_promotional where status=0 order by V_type_id desc";
                    $sql = mysqli_query($conn, $q);
                    $_row = mysqli_fetch_array($sql);
                    $_rowa = mysqli_num_rows($sql);
                    if ($_rowa > 0) {
                        $countR = $_row['serialNumber'];
                        $readyToUse = $countR + 1;
                        $NoOfVoucher = $readyToUse;

                        $promotional_sql = mysqli_query($conn, "SELECT max(promotional_voucher_code) as promotional_voucher FROM `Members`");
                        $promotional_sql_result = mysqli_fetch_assoc($promotional_sql);
                        $promotional_voucher = $promotional_sql_result['promotional_voucher'] + 1;


                        mysqli_query($conn, "insert into BarcodeScan(Voucher_id,Available) values('" . $promotional_voucher . "','0')");
                        mysqli_query($conn, "Update Members set promotional_voucher_code='" . $promotional_voucher . "' where Static_LeadID='" . $Static_LeadID . "'");

                        mysqli_query($conn, "update voucher_Type_promotional set serialNumber = '" . $promotional_voucher . "'");

                    }


                }

                // End Promotional Vouchers
    // additional vouchers start
                
                // $MealCheck1 = $_REQUEST['MealCheck1'];
                
                if($MealCheck1 == 'on')
                {
                    $mealsql = mysqli_query($conn,"select * from voucher_issued_additional"); 
                    $mealsql_result = mysqli_fetch_assoc($mealsql);
                    $additional_voucher = $mealsql_result['issued_voucher_code'];
                    $prefixcode = $mealsql_result['voucher_code'];
                    
                     $meal_sql = mysqli_query($conn, "SELECT max(meal_voucher_code) as meal_voucher FROM `Members`");
                        $meal_sql_result = mysqli_fetch_assoc($meal_sql);
                        $meal_voucher = $meal_sql_result['meal_voucher'];
                        
                        if($meal_voucher == "" || $meal_voucher == NULL){
                            $_meal_voucher = $additional_voucher;
                        } else {
                            $_meal_voucher = $additional_voucher + 1;
                        }
                        
                        $member_additional = $prefixcode._.$_meal_voucher;
                        //$meal_voucher = $meal_sql_result['meal'] + 1;
                    
                    mysqli_query($conn, "insert into BarcodeScan_test(Voucher_id,Available) values('" . $member_additional . "','0')");
                    
                    mysqli_query($conn, "Update Members_test set meal_voucher_code='" . $member_additional . "' where Static_LeadID='" . $Static_LeadID . "'");

                        mysqli_query($conn, "update voucher_issued_additional set issued_voucher_code = '" . $_meal_voucher . "'");
                    
                }
                
                
                
                
                // additional vouchers end


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


                        $EmailSubject2 = "Welcome to Elite Plus by Radisson Mumbai Goregaon!";


                        $message2 = '
<table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>
    
      <span style="text-decoration:none">
  <img border="0" width="130" style="width:1.3541in" src="https://loyaltician.in/radisson/newassets/wlogo.png" alt="Elite Plus">
    <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right">

  <span style="text-decoration:none">
    <img border="0" width="130" style="width:1.3541in" src="https://loyaltician.in/radisson/assets/Image2.png" alt="Elite Plus">
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
lang=EN-IN>A warm welcome to Elite Plus!</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="color:black">We thank you for your decision to become a member at Radisson Mumbai Goregaon. Your membership has been issued and details are as follows:
</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Details</u></b>&nbsp;</span></p>

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
lang=EN-IN><b><u>Membership Fee</u></b>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The annual membership charge of Rs. ' . $MembershipDts_NetPayment . ' + 18% Goods & Services Tax amounting to 
Rs. ' . $MembershipDts_GrossTotal . ' /- ( ' . convertNum($MembershipDts_GrossTotal) . ' ) has been received by ' . $payment_mode . '.
A Tax Invoice cum Receipt is enclosed in this email. This receipt does not require a signature. 
</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Usage</u></b>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
You can present your membership number and a copy of this email to start using your membership card benefits. 
To know more about these benefits please visit <a href="www.clubeliteplus.com ">www.clubeliteplus.com </a> 
</span></p>



<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Package</u></b>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
Your personalised welcome package will reach you within 10 working days of this e-mail.
Do note that the membership gift certificates can be used only upon receipt of the membership package and have to be presented in original.
The certificates issued along with the membership are given at the bottom of this email.
Should there be a need to use any of these certificates urgently before they arrive, do reach out to our Member Help Desk for help.
</span></p>






<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Terms and Conditions</u></b>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
Payment of the membership fee confirms that you have read and understood the membership terms and conditions and then made the payment to enrol.
Do take a moment to view all benefits and terms at <a href="www.clubeliteplus.com ">www.clubeliteplus.com </a>
or reach out to our Member Help Desk from Monday to Saturday, 9.30 AM to 6.30 PM 
for any clarifications.
</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
We will look forward to welcoming you to our hotel and to a great Membership Year with us.
</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>


<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
Yours sincerely,
</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
Team Elite Plus
</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">+91 7678040999</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><a href="http://www.clubeliteplus.com"><span style="font-size:12.0pt;
line-height:107%">www.clubeliteplus.com</span></a></span><span lang=EN-IN
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

                        $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='" . $did . "' and serviceName not like '%RENEWAL%' order by serialNumber ASC";

                        $runsql2 = mysqli_query($conn, $sql2);
                        while ($sql2fetch = mysqli_fetch_array($runsql2)) {


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


                        if ($PromotionalCheck1 == 'on') {

                            $sql2 = "SELECT * from voucher_Type_promotional where status=0 order by V_type_id desc";
                            $runsql2 = mysqli_query($conn, $sql2);

                            while ($sql2fetch = mysqli_fetch_array($runsql2)) {
                                $remaining1 = $sql2fetch['serialNumber'];
                                $AssignBooklet1 = $remaining1;


                                //   	$AssignBooklet1=$value.$remaining1;         
    
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

                        }



                        $message2 .= '</table>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white;font-style:normal">&nbsp;</span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">The membership program is operated by Loyaltician CRM India Private Limited for Radisson Mumbai Goregaon. </span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at
  </span></em><span lang=EN-IN><a
href="mailto:contactus@clubeliteplus.com"><span style="font-size:10.5pt;
line-height:107%;border:none windowtext 1.0pt;
padding:0in;background:white">contactus@clubeliteplus.com</span></a></span><em><span
lang=EN-IN style="font-size:10.5pt;line-height:107%;
color:#444444;border:none windowtext 1.0pt;padding:0in;background:white"> </span></em></p>

<p class=MsoNormal style="line-height:normal;background:white;vertical-align:
baseline"><i><span lang=EN-IN style="font-size:10.5pt;
color:#444444;border:none windowtext 1.0pt;padding:0in">
Disclaimer: This message has been sent as a part of discussion between ‘Club Elite Plus’ and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.
</span></i></p>

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
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <img src="https://loyaltician.in/radisson/assets/Image1.png" style="margin-left:200px;height:60px;">
                                            </th>
                                            </tr>
                                            
                                            
                                            <tr>
                                            <th colspan="6" style="font-size:25px;font-weight:700;text-align:center;"> LCRM- A/C Radisson Membership </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> Representative for, Radisson Mumbai Goregaon,  contactus@clubeliteplus.com </th>
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
                                            <td colspan="1">' . $MembershipDts_NetPayment . '</td>
                                            
                                        </tr>
                                       
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Payment Details:</b></td>
                                           <td colspan="2" style="background-color: #daeef3; color: black; "><b>Subtotal:</b></td>
                                           
                                            <td colspan="1" style="background-color: #daeef3; color: black; ">' . $MembershipDts_NetPayment . '</td>
                                            
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
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Cheque Favouring -  LCRM- A/C Radisson Membership</b></td>
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
                        $cc = ['contactus@clubeliteplus.com', 'nikhil@loyaltician.com', 'farheen@loyaltician.com', 'fbmgr@rdmumbai.com', 'credit@rdmumbai.com'];
                        $bcc = [];
                        
                        $mailheader = "From: ".$from."\r\n"; 
                        $mailheader .= "Reply-To: ".$from."\r\n"; 
                        
                        
                        
                        require_once 'phpmail/src/PHPMailer.php';
                        require_once 'phpmail/src/SMTP.php';
                        require_once 'phpmail/src/Exception.php';
                        
                        $mail = new PHPMailer\PHPMailer\PHPMailer();
                        try{
                            //Server settings
                            // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = ' smtp.hostinger.com';  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'contactus@clubeliteplus.com';                 // SMTP username
                            $mail->Password = '8x%8AovpL3O8';                           // SMTP password
                            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587;                                    // TCP port to connect to
                        
                            //Recipients
                            $mail->setFrom('contactus@clubeliteplus.com','Radisson');
                        
                            $mail->addAddress('nikhil@loyaltician.com');
                            $mail->mailheader=$mailheader;// Add a recipient
                            
                           $mail->addBCC('hellbinderkumar@gmail.com');
                            
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $mail->Subject = $subject."\r\n";
                            $mail->Body    = $message;
                            $mail->send();
                            echo 'Message has been sent';
                        }
                        catch(Exception $e){
                        
                            $msg = "Mail not send due to SMTP Host error!!!";
                          
                        }



                        // $data = array(
                        //     'subject' => $subject,
                        //     'message' => $message,
                        //     'leadsmail' => $leadsmail,
                        //     'host' => $host,
                        //     'hostusername' => $hostusername,
                        //     'hostpassword' => $hostpassword,
                        //     'port' => $port,
                        //     'from' => $from,
                        //     'fromname' => $fromname,
                        //     'to' => $to,
                        //     'cc' => $cc,
                        //     'bcc' => $bcc,
                        //     'pdfstructure' => $htmtab1,
                        //     'attachment' => $attachment,
                        //     'primary_name' => $Primary_nameOnTheCard,
                        // );

                        // $options = array(
                        //     'http' => array(
                        //         'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                        //         'method' => 'POST',
                        //         'content' => http_build_query($data)
                        //     )
                        // );

                        // $context = stream_context_create($options);
                        // $result = file_get_contents($nodes, false, $context);







                    } else if ($sql4fetch['Leval_id'] == '2') {

                        $EmailSubject2 = "Welcome to Elite Plus by Radisson Mumbai Goregaon!";



                        $message2 = '
<table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>
    
      <span style="text-decoration:none">
  <img border="0" width="130" style="width:1.3541in" src="https://loyaltician.in/radisson/newassets/wlogo.png" alt="Elite Plus">
    <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right">

  <span style="text-decoration:none">
    <img border="0" width="130" style="width:1.3541in" src="https://loyaltician.in/radisson/assets/Image2.png" alt="Elite Plus">
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
lang=EN-IN>A warm welcome to Elite Plus!</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="color:black">We thank you for your decision to become a member at Radisson Mumbai Goregaon. Your membership has been issued and details are as follows:
</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Details</u></b>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Membership Level - Platinum</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Your Membership Card number is ' . $member_id . '. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The membership is valid till ' . date('M Y', strtotime($validity)) . ' </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>


<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Fee</u></b>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The annual membership charge of Rs. ' . $MembershipDts_NetPayment . ' + 18% Goods & Services Tax amounting to 
Rs. ' . $MembershipDts_GrossTotal . ' /- ( ' . convertNum($MembershipDts_GrossTotal) . ' ) has been received by ' . $payment_mode . '.
A Tax Invoice cum Receipt is enclosed in this email. This receipt does not require a signature. 
</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Usage</u></b>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
You can present your membership number and a copy of this email to start using your membership card benefits. 
To know more about these benefits please visit <a href="www.clubeliteplus.com ">www.clubeliteplus.com </a> 
</span></p>



<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Package</u></b>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
Your personalised welcome package will reach you within 10 working days of this e-mail.
Do note that the membership gift certificates can be used only upon receipt of the membership package and have to be presented in original.
The certificates issued along with the membership are given at the bottom of this email.
Should there be a need to use any of these certificates urgently before they arrive, do reach out to our Member Help Desk for help.
</span></p>






<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Terms and Conditions</u></b>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
Payment of the membership fee confirms that you have read and understood the membership terms and conditions and then made the payment to enrol.
Do take a moment to view all benefits and terms at <a href="www.clubeliteplus.com ">www.clubeliteplus.com </a>
or reach out to our Member Help Desk from Monday to Saturday, 9.30 AM to 6.30 PM 
for any clarifications.
</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
We will look forward to welcoming you to our hotel and to a great Membership Year with us.
</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>


<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
Yours sincerely,
</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
Team Elite Plus
</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">+91 7678040999</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><a href="http://www.clubeliteplus.com"><span style="font-size:12.0pt;
line-height:107%">www.clubeliteplus.com</span></a></span><span lang=EN-IN
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
                        $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='" . $did . "' and serviceName not like '%RENEWAL%' order by serialNumber ASC";
                        //echo $sql2;
                        $runsql2 = mysqli_query($conn, $sql2);
                        while ($sql2fetch = mysqli_fetch_array($runsql2)) {
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

                        if ($PromotionalCheck1 == 'on') {

                            $sql2 = "SELECT * from voucher_Type_promotional where status=0 order by V_type_id desc";
                            $runsql2 = mysqli_query($conn, $sql2);

                            while ($sql2fetch = mysqli_fetch_array($runsql2)) {
                                $remaining1 = $sql2fetch['serialNumber'];
                                $AssignBooklet1 = $remaining1;


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

                        }






                        $message2 .= '</table>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white;font-style:normal">&nbsp;</span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">The membership program is operated by Loyaltician CRM India Private Limited for Radisson Mumbai Goregaon. </span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at
  </span></em><span lang=EN-IN><a
href="mailto:contactus@clubeliteplus.com"><span style="font-size:10.5pt;
line-height:107%;border:none windowtext 1.0pt;
padding:0in;background:white">contactus@clubeliteplus.com</span></a></span><em><span
lang=EN-IN style="font-size:10.5pt;line-height:107%;
color:#444444;border:none windowtext 1.0pt;padding:0in;background:white"> </span></em></p>

<p class=MsoNormal style="line-height:normal;background:white;vertical-align:
baseline"><i><span lang=EN-IN style="font-size:10.5pt;
color:#444444;border:none windowtext 1.0pt;padding:0in">
Disclaimer: This message has been sent as a part of discussion between ‘Club Elite Plus’ and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.
</span></i></p>

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
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <img src="https://loyaltician.in/radisson/assets/Image1.png" style="margin-left:200px;height:60px;">
                                                </th>
                                            </tr>
                                            
                                            
                                            <tr>
                                            <th colspan="6" style="font-size:25px;font-weight:700;text-align:center;"> LCRM- A/C Radisson Membership </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> Representative for, Radisson Mumbai Goregaon,  contactus@clubeliteplus.com </th>
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
                                           <td colspan="3"><b>State :</b>' . ucwords($State) . '</td>
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
                                            <td colspan="1">' . $MembershipDts_NetPayment . '</td>
                                            
                                        </tr>
                                       
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Payment Details:</b></td>
                                           <td colspan="2" style="background-color: #daeef3; color: black; "><b>Subtotal:</b></td>
                                            <td colspan="1" style="background-color: #daeef3; color: black; ">' . $MembershipDts_NetPayment . '</td>
                                            
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
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Cheque Favouring -  LCRM- A/C Radisson Membership</b></td>
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
                        $cc = ['contactus@clubeliteplus.com', 'pratik@loyaltician.com', 'farheen@loyaltician.com', 'fbmgr@rdmumbai.com', 'credit@rdmumbai.com'];
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


                    // Today Cal
    

                    $today_sqlgold = mysqli_query($conn, "select count(mem_id) as today from Members where MembershipDetails_Level=1 and DATE(entryDate) = DATE(NOW())");
                    $today_sqlgold_result = mysqli_fetch_assoc($today_sqlgold);
                    $today_gold = $today_sqlgold_result['today'];

                    $today_sqlplat = mysqli_query($conn, "select count(mem_id) as today from Members where MembershipDetails_Level=2 and DATE(entryDate) = DATE(NOW())");
                    $today_sqlplat_result = mysqli_fetch_assoc($today_sqlplat);
                    $today_plat = $today_sqlplat_result['today'];

                    $today = $today_plat + $today_gold;
                    // End Today Cal
    


                    // Month Cal
                    $monthsqlgold = mysqli_query($conn, "SELECT count(mem_id) as monthss FROM Members WHERE MembershipDetails_Level=1 and MONTH(entryDate) = MONTH(CURDATE()) and YEAR(entryDate) = YEAR(CURDATE())");
                    $monthsqlgold_result = mysqli_fetch_assoc($monthsqlgold);
                    $monthgold = $monthsqlgold_result['monthss'];

                    $monthsqlplat = mysqli_query($conn, "SELECT count(mem_id) as monthss FROM Members WHERE MembershipDetails_Level=2 and MONTH(entryDate) = MONTH(CURDATE()) and YEAR(entryDate) = YEAR(CURDATE())");
                    $monthsqlplat_result = mysqli_fetch_assoc($monthsqlplat);
                    $monthplat = $monthsqlplat_result['monthss'];

                    $month = $monthgold + $monthplat;




                    // Year Cal
    
                    $date1 = '2021-04-01';
                    $date2 = date('Y-m-d');


                    $year_sqlgold = mysqli_query($conn, "SELECT count(mem_id) as years_count FROM Members WHERE MembershipDetails_Level=1 and CAST(entryDate AS DATE) >= '" . $date1 . "' and CAST(entryDate AS DATE) <= '" . $date2 . "'");
                    $year_sqlgold_result = mysqli_fetch_assoc($year_sqlgold);
                    $year_sqlgold_count = $year_sqlgold_result['years_count'];


                    $year_sqlplat = mysqli_query($conn, "SELECT count(mem_id) as years_count FROM Members WHERE MembershipDetails_Level=2 and CAST(entryDate AS DATE) >= '" . $date1 . "' and CAST(entryDate AS DATE) <= '" . $date2 . "'");
                    $year_sqlplat_result = mysqli_fetch_assoc($year_sqlplat);
                    $year_sqlplat_count = $year_sqlplat_result['years_count'];

                    $yearscount = $year_sqlplat_count + $year_sqlgold_count;







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
        <td  style="background:yellow;" colspan="3">Enrollments Update</td>
        </tr>
        
        <tr>
        <td></td>

        <td>Gold</td>
        <td>Platinum</td>
        <td>Total</td>
        </tr>
        
        <tr>
        <td>Today</td>
        <td>' . $today_gold . '</td>
        <td>' . $today_plat . '</td>
        <td>' . $today . '</td>
        </tr>
        
        
        <tr>
        <td>Month To Date</td>
        <td>' . $monthgold . '</td>
        <td>' . $monthplat . '</td>
        <td>' . $month . '</td>
        </tr>
        
        <tr>
        <td>Year To Date</td>
        <td>' . $year_sqlgold_count . '</td>
        <td>' . $year_sqlplat_count . '</td>
        <td>' . $yearscount . '</td>
        </tr>
        </table>';





                    $pagesource = "CPF_MemberCreation_Process";
                    $memid = $Static_LeadID;
                    $msg = "";


                    $subject = $EmailSubject1;
                    $message = $message1;
                    $to = ['contactus@clubeliteplus.com'];
                    $cc = ['contactus@clubeliteplus.com', 'pratik@loyaltician.com', 'farheen@loyaltician.com'];
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



                    //========================this is for log details========================
    
                    $EmailSubject9 = "New Membership Created Successfully by " . $_SESSION['user'] . "!";

                    $subject = $EmailSubject9;
                    $message = $message1;
                    $to = ['contactus@clubeliteplus.com'];
                    $cc = ['contactus@clubeliteplus.com', 'pratik@loyaltician.com', 'farheen@loyaltician.com', 'hitesh@loyaltician.com'];
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
                                        })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    window.open("prospect_view.php", "_self");

                                                }
                                            });

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