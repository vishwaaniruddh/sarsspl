<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include ('config.php');

  function promo_voucher($id, $vid)
  {
    global $conn;

    echo $promotionalsql = "SELECT fromSerialNo,toSerialNo,issued_voucher_code,voucher_code FROM `voucher_issued_additional` where Program_ID='" . $id . "' and v_cid = '" . $vid . "' ";
    $promotionalsql_result = mysqli_query($conn, $promotionalsql);

    if (mysqli_num_rows($promotionalsql_result) == 0) { ?>
      <script>
        //   window.location.href = "show_message.php?code=1";
      </script>
    <?php }
    $arr = array();
    while ($promotionalsql_result_fetch = mysqli_fetch_assoc($promotionalsql_result)) {
      $prefix_code = $promotionalsql_result_fetch['voucher_code'];

      if ($promotionalsql_result_fetch['issued_voucher_code'] == "0") {
        $pre = $prefix_code . '000001';
        $AdditionalPromotionalAssignBooklet = $prefix_code . '000001';
        array_push($arr, $pre);
      } else {
        //$remaining_p=substr($promotionalsql_result_fetch['issued_voucher_code'],0,-6);
        $remaining_p = substr($promotionalsql_result_fetch['issued_voucher_code'], 5);

        $countR_p = $remaining_p + 1;
        $readyToUse_p = sprintf("%06s", $countR_p);
        $AdditionalPromotionalAssignBooklet = $prefix_code . $readyToUse_p;
        $pre = $prefix_code . $readyToUse_p;
        array_push($arr, $pre);


      }

    }
    return json_encode($arr);
    // 	return $AdditionalPromotionalAssignBooklet;
  }

  //static Post Data                      
  $Static_LeadID = $_REQUEST['Static_LeadID'];
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
  $Primary_Area = $_POST['Primary_Area'];
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

  if ($Primary_DateOfBirth != "" || $Primary_DateOfBirth != "01-01-1970") {
    $DOB = date('Y-m-d', strtotime($Primary_DateOfBirth));
  } else {
    $DOB = "0000-00-00";
  }

  if ($Anniversary != "" || $Anniversary != "01-01-1970") {
    $Primary_Anniversary = date('Y-m-d', strtotime($Anniversary));
  } else {
    $Primary_Anniversary = "0000-00-00";
  }
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

  if ($Spouse_DateOfBirth != "" || $Spouse_DateOfBirth != "01-01-1970") {
    $Spouse_DOB = date('Y-m-d', strtotime($Spouse_DateOfBirth));
  } else {
    $Spouse_DOB = '0000-00-00';
  }
  ////////////////////////////////////////////////////////////////////////
  

  // part 3.payment Details
  $MembershipDts_PaymentDate = $_POST['MembershipDts_PaymentDate'];
  $MembershipDts_PaymentMode = $_POST['MembershipDts_PaymentMode'];
  $MembershipDts_InstrumentNumber = $_POST['MembershipDts_InstrumentNumber'];
  $MemshipDts_BankName = $_POST['MemshipDts_BankName'];
  $MemshipDts_BatchNumber = $_POST['MemshipDts_BatchNumber'];
  $MemshipDts_Remarks = $_POST['MemshipDts_Remarks'];

  if ($MembershipDts_PaymentDate != "" || $MembershipDts_PaymentDate != "01-01-1970") {
    $MemDT = date('Y-m-d', strtotime($MembershipDts_PaymentDate));
  } else {
    $MemDT = '0000-00-00';
  }
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


  $sql3 = "SELECT MembershipDetails_Level FROM `Members` where  Static_LeadID='" . $Static_LeadID . "' ";
  $runsql3 = mysqli_query($conn, $sql3);
  $sql3fetch = mysqli_fetch_array($runsql3);







  if (isset($_POST['vouchers'])) {

    $vchrsCheck1 = $_POST['vouchers'];
    $checkedid = implode(",", $vchrsCheck1);

    $PromotionalCheck1 = 1;


    $payment_date = $MembershipDts_PaymentDate;


    $AdditionalPromotionalAssignBooklet = "";
    if (isset($vchrsCheck1) && $vchrsCheck1 != '') {

      $promotionalmastersql = "SELECT v_id,voucher_code FROM `voucher_issued_code` where Program_ID='" . $sql3fetch['MembershipDetails_Level'] . "'  and v_id in ($checkedid) ";
      $promotionalmastersql_result = mysqli_query($conn, $promotionalmastersql);

      $voucherid = array();
      $additionalpromovoucher1 = array();
      while ($promotionalmastersql_result_data = mysqli_fetch_assoc($promotionalmastersql_result)) {


        $programid = $sql3fetch['MembershipDetails_Level'];
        $vid = $promotionalmastersql_result_data['v_id'];
        $additionalpromovoucher = promo_voucher($programid, $vid);

        array_push($voucherid, $vid);


        $getfromlist = json_decode($additionalpromovoucher);
        $additionalpromovoucher1 = array_merge($additionalpromovoucher1, $getfromlist);
      }

      $pv = array();
      for ($i = 0; $i < count($additionalpromovoucher1); $i++) {
        // print_r($voucherid[$i]);
        // echo $exp[$i];
        // echo $additionalpromovoucher1[$i]."<br>";
  
        $pv[] = $additionalpromovoucher1[$i];

        $PromotionalQry = mysqli_query($conn, "update voucher_issued_additional set issued_voucher_code = '" . $additionalpromovoucher1[$i] . "' where v_cid = '" . $voucherid[$i] . "' ");



        $vchsql = "insert into BarcodeScan (Voucher_id,Available,start_date,is_extended) values  ('" . $additionalpromovoucher1[$i] . "',0,'" . $payment_date . "',1 )";
        mysqli_query($conn, $vchsql);
      }



    }

  }

  $pv_string = implode(',', $pv);




  $qryinsert = mysqli_query($conn, "Update Members set Primary_Title='" . $Primary_Title . "',Primary_Pincode='" . $Primary_Pincode . "',Primary_mcode2='" . $Primary_mcode2 . "',Primary_mob2='" . $Primary_mob2 . "',Primary_Contact1code='" . $Primary_Contact1code . "',Primary_Contact1='" . $Primary_Contact1 . "',Primary_Contact2code='" . $Primary_Contact2code . "',Primary_Contact2='" . $Primary_Contact2 . "',Primary_Contact3code='" . $Primary_Contact3code . "',Primary_Contact3='" . $Primary_Contact3 . "',Primary_nameOnTheCard='" . $Primary_nameOnTheCard . "',Primary_Email_ID2='" . $Primary_Email_ID2 . "',Primary_DateOfBirth='" . $DOB . "',Primary_Anniversary='" . $Primary_Anniversary . "',Primary_AddressType1='" . $Primary_AddressType1 . "',Primary_BuldNo_addrss='" . $Primary_BuldNo_addrss . "',Primary_Area_addrss='" . $Primary_Area_addrss . "',Primary_Landmark_addrss='" . $Primary_Landmark_addrss . "',Primary_MaritalStatus='" . $Primary_MaritalStatus . "',Spouse_Title='" . $Spouse_Title . "',Spouse_FirstName='" . $Spouse_FirstName . "',Spouse_LastName='" . $Spouse_LastName . "',Spouse_GmailMArrid1='" . $Spouse_GmailMArrid1 . "',Spouse_GmailMArrid2='" . $Spouse_GmailMArrid2 . "',Spouse_mcode1Married1='" . $Spouse_mcode1Married1 . "',Spouse_mob1MArid1='" . $Spouse_mob1MArid1 . "',Spouse_mcode1Married2='" . $Spouse_mcode1Married2 . "',Spouse_mob1MArid2='" . $Spouse_mob1MArid2 . "',Spouse_Contact1codeMArid='" . $Spouse_Contact1codeMArid . "',Spouse_Contact1Married='" . $Spouse_Contact1Married . "',Spouse_Contact2codeMArid='" . $Spouse_Contact2codeMArid . "',Spouse_Contact2Married='" . $Spouse_Contact2Married . "',Spouse_DateOfBirth='" . $Spouse_DOB . "',Spouse_nameOnTheCardMarried='" . $Spouse_nameOnTheCardMarried . "',MembershipDts_PaymentDate='" . $MemDT . "',MembershipDts_PaymentMode='" . $MembershipDts_PaymentMode . "',MembershipDts_InstrumentNumber='" . $MembershipDts_InstrumentNumber . "',Member_bankName='" . $MemshipDts_BankName . "',MemshipDts_BatchNumber='" . $MemshipDts_BatchNumber . "',MemshipDts_Remarks='" . $MemshipDts_Remarks . "',Relationships_ReferredByLEADID='" . $Relationships_ReferredByLEADID . "',Relationships_ReferredByMEMBERSHIPID='" . $Relationships_ReferredByMEMBERSHIPID . "',itemCheck1='" . $itemCheck1 . "',BookletCheck1='" . $BookletCheck1 . "',CertificatesCheck1='" . $CertificatesCheck1 . "',PromotionalCheck1='" . $PromotionalCheck1 . "', promotional_voucher_code = '" . $pv_string . "' ,Issue_ReferredByLEADID='" . $Issue_ReferredByLEADID . "',Issue_ReferredByMEMBERSHIPID='" . $Issue_ReferredByMEMBERSHIPID . "',GST_Number='" . $MemshipDts_GST_number . "' where Static_LeadID='" . $Static_LeadID . "' ");


  $UpdateQry = mysqli_query($conn, "update Leads_table set Status='5',Title='" . $Primary_Title . "',FirstName='" . $Primary_FirstName . "',LastName='" . $Primary_LastName . "',MobileCode='" . $Primary_mcode1 . "',MobileNumber='" . $Primary_mob1 . "',MobileCode2='" . $Primary_mcode2 . "',MobileNumber2='" . $Primary_mob2 . "',contact1Code='" . $Primary_Contact1code . "',ContactNo1='" . $Primary_Contact1 . "',contact2Code='" . $Primary_Contact2code . "',ContactNo2='" . $Primary_Contact2 . "',contact3Code='" . $Primary_Contact3code . "',ContactNo3='" . $Primary_Contact3 . "',Company='" . $Primary_Company . "',Designation='" . $Primary_Designation . "',pincodeOfArea='" . $Primary_Pincode . "',PinCode='" . $Primary_Pincode . "',State='" . $Primary_State . "',City='" . $Primary_City . "',EmailId='" . $Primary_Gmail_1 . "' where Lead_id='" . $Static_LeadID . "' ");








  if ($qryinsert && $UpdateQry) {

    ?>
    <script>
      swal({
        title: "Success!",
        text: "Thank you, Updated Successfully.!",
        icon: "success",
        // buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            // window.open("Members_view.php","_self");

          }
        });

    </script>

  <?php } else {
    ?>
    <script>
      swal({
        title: "Error!",
        text: "So Sorry, Member Not Updated !",
        icon: "warning",
        // buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            // window.open("Members_view.php","_self");

          }
        });

    </script>
  <?php } ?>

</body>

</html>