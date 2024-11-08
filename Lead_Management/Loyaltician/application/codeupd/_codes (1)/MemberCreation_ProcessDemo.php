<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include ('config.php');

  /*                 Static_LeadID Static_LeadSource Static_FirstName Static_LastName Static_AssignedTo Static_DateOfAssignment Static_DateOfEntry Static_Status
                   Primary_Title Primary_FirstName Primary_LastName Primary_Company Primary_Designation Primary_State Primary_City Primary_Country Primary_Pincode Primary_Gmail_1 Primary_mcode1
                   Primary_mob1 Primary_mcode2 Primary_mob2 Primary_Contact1code Primary_Contact1 Primary_Contact2code Primary_Contact2 Primary_Contact3code Primary_Contact3 Primary_nameOnTheCard
                  Primary_PhotoUpload Primary_Email_ID2 Primary_DateOfBirth Primary_AddressType1 Primary_BuldNo_addrss Primary_Area_addrss Primary_Landmark_addrss Primary_MaritalStatus
                 Spouse_Title Spouse_FirstName Spouse_LastName Spouse_GmailMArrid1 Spouse_GmailMArrid2 Spouse_PhotoUpload Spouse_mcode1Married1 Spouse_mob1MArid1 Spouse_mcode1Married2 Spouse_mob1MArid2
                   Spouse_Contact1codeMArid Spouse_Contact1Married Spouse_Contact2codeMArid Spouse_Contact2Married Spouse_nameOnTheCardMarried MembershipDetails_Level MembershipDetails_Fee MembershipDetails_offerCheck1
                   MembershipDts_Discount MembershipDts_Author   MembershipDts_NetPayment MembershipDts_GST MembershipDts_GrossTotal MembershipDts_PaymentDate MembershipDts_PaymentMode MembershipDts_InstrumentNumber
                      MemshipDts_UploadCopyOfTheInstmnt MemshipDts_BatchNumber MemshipDts_Remarks Documentation_UploadSignatures Documentation_AddressProof Relationships_ReferredByLEADID
                   Relationships_ReferredByMEMBERSHIPID itemCheck1   BookletCheck1    CertificatesCheck1 PromotionalCheck1 Issue_ReferredByLEADID Issue_ReferredByMEMBERSHIPID
                   
   */


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
  $Primary_AddressType1 = $_POST['Primary_AddressType1'];
  $Primary_BuldNo_addrss = $_POST['Primary_BuldNo_addrss'];
  $Primary_Area_addrss = $_POST['Primary_Area_addrss'];
  $Primary_Landmark_addrss = $_POST['Primary_Landmark_addrss'];
  $Primary_MaritalStatus = $_POST['Primary_MaritalStatus'];

  $DOB = date('Y-m-d', strtotime($Primary_DateOfBirth));
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
  

  // part 3. MembershipDetails
  $MembershipDetails_Level = $_POST['MembershipDetails_Level'];
  $MembershipDetails_Fee = $_POST['MembershipDetails_Fee'];
  $MembershipDetails_offerCheck1 = $_POST['MembershipDetails_offerCheck1'];
  $MembershipDts_Discount = $_POST['MembershipDts_Discount'];
  $MembershipDts_Author = $_POST['MembershipDts_Author'];
  $MembershipDts_NetPayment = $_POST['MembershipDts_NetPayment'];
  $MembershipDts_GST = $_POST['MembershipDts_GST'];
  $MembershipDts_GrossTotal = $_POST['MembershipDts_GrossTotal'];
  $MembershipDts_PaymentDate = $_POST['MembershipDts_PaymentDate'];
  $MembershipDts_PaymentMode = $_POST['MembershipDts_PaymentMode'];
  $MembershipDts_InstrumentNumber = $_POST['MembershipDts_InstrumentNumber'];
  $MemshipDts_UploadCopyOfTheInstmnt = $_POST['MemshipDts_UploadCopyOfTheInstmnt'];
  $MemshipDts_BatchNumber = $_POST['MemshipDts_BatchNumber'];
  $MemshipDts_Remarks = $_POST['MemshipDts_Remarks'];

  if ($MembershipDetails_offerCheck1 == "") {
    $MembershipDetails_offerCheck1 = 0;
  } else {
    $MembershipDetails_offerCheck1 = 1;
  }
  $MembershipDts_PaymentDate = date('Y-m-d', strtotime($MembershipDts_PaymentDate));
  ///////////////////////////////////////////////////////////////////////////////////////
  

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
  
  /*
  // part 1. Primary_PhotoUpload
 $Primary_banner=$_FILES['Primary_PhotoUpload']['name']; 
 $Primary_expbanner=explode('.',$Primary_banner);
 $Primary_bannerexptype=$Primary_expbanner[1];
 date_default_timezone_set('Australia/Melbourne');
 $Primary_date = date('m/d/Yh:i:sa', time());
 $Primary_rand=rand(10000,99999);
 $Primary_encname=$Primary_date.$Primary_rand;
 $Primary_bannername=md5($Primary_encname).'.'.$Primary_bannerexptype;
 $Primary_bannerpath="upload/PrimaryPhoto/".$Primary_bannername;
 move_uploaded_file($_FILES["Primary_PhotoUpload"]["tmp_name"],$Primary_bannerpath);
 /////////////////////////////////////////////////////////////////////////////////////////////  
 
 // part 2. Spouse_PhotoUpload
 $Spouse_banner=$_FILES['Spouse_PhotoUpload']['name']; 
 $Spouse_expbanner=explode('.',$Spouse_banner);
 $Spouse_bannerexptype=$Spouse_expbanner[1];
 date_default_timezone_set('Australia/Melbourne');
 $Spouse_date = date('m/d/Yh:i:sa', time());
 $Spouse_rand=rand(10000,99999);
 $Spouse_encname=$Spouse_date.$Spouse_rand;
 $Spouse_bannername=md5($Spouse_encname).'.'.$Spouse_bannerexptype;
 $Spouse_bannerpath="upload/Spouse_Photo/".$Spouse_bannername;
 move_uploaded_file($_FILES["Spouse_PhotoUpload"]["tmp_name"],$Spouse_bannerpath);
 /////////////////////////////////////////////////////////////////////////////////////////////  
   
   
 // part 3. MemshipDts_UploadCopyOfTheInstmnt
 $MemshipDts_banner=$_FILES['MemshipDts_UploadCopyOfTheInstmnt']['name']; 
 $MemshipDts_expbanner=explode('.',$MemshipDts_banner);
 $MemshipDts_bannerexptype=$MemshipDts_expbanner[1];
 date_default_timezone_set('Australia/Melbourne');
 $MemshipDts_date = date('m/d/Yh:i:sa', time());
 $MemshipDts_rand=rand(10000,99999);
 $MemshipDts_encname=$MemshipDts_date.$MemshipDts_rand;
 $MemshipDts_bannername=md5($MemshipDts_encname).'.'.$MemshipDts_bannerexptype;
 $MemshipDts_bannerpath="upload/CopyOfTheInstmnt/".$MemshipDts_bannername;
 move_uploaded_file($_FILES["MemshipDts_UploadCopyOfTheInstmnt"]["tmp_name"],$MemshipDts_bannerpath);
 /////////////////////////////////////////////////////////////////////////////////////////////  
   
   
   // part 3. $MembershipDts_Author 
 $Author_banner=$_FILES['MembershipDts_Author']['name']; 
 $Author_expbanner=explode('.',$Author_banner);
 $Author_bannerexptype=$Author_expbanner[1];
 date_default_timezone_set('Australia/Melbourne');
 $Author_date = date('m/d/Yh:i:sa', time());
 $Author_rand=rand(10000,99999);
 $Author_encname=$Author__date.$Author_rand;
 $Author_bannername=md5($Author_encname).'.'.$Author_bannerexptype;
 $Author_bannerpath="upload/Author/".$Author_bannername;
 move_uploaded_file($_FILES["MembershipDts_Author"]["tmp_name"],$Author_bannerpath);
 /////////////////////////////////////////////////////////////////////////////////////////////  
 
   
  
   
    // part 4. Upload Signatures
 $Signatures_banner=$_FILES['Documentation_UploadSignatures']['name']; 
 $Signatures_expbanner=explode('.',$Signatures_banner);
 $Signatures_bannerexptype=$Signatures_expbanner[1];
 date_default_timezone_set('Australia/Melbourne');
 $Signatures_date = date('m/d/Yh:i:sa', time());
 $Signatures_rand=rand(10000,99999);
 $Signatures_encname=$Signatures_date.$Signatures_rand;
 $Signatures_bannername=md5($Signatures_encname).'.'.$Signatures_bannerexptype;
 $Signatures_bannerpath="upload/Signatures/".$Signatures_bannername;
 move_uploaded_file($_FILES["Documentation_UploadSignatures"]["tmp_name"],$Signatures_bannerpath);
 /////////////////////////////////////////////////////////////////////////////////////////////  
  
    // part 4. Upload Address Proof
 $Proof_banner=$_FILES['Documentation_AddressProof']['name']; 
 $Proof_expbanner=explode('.',$Proof_banner);
 $Proof_bannerexptype=$Proof_expbanner[1];
 date_default_timezone_set('Australia/Melbourne');
 $Proof_date = date('m/d/Yh:i:sa', time());
 $Proof_rand=rand(10000,99999);
 $Proof_encname=$Proof_date.$Proof_rand;
 $Proof_bannername=md5($Proof_encname).'.'.$Proof_bannerexptype;
 $Proof_bannerpath="upload/AddressProof/".$Proof_bannername;
 move_uploaded_file($_FILES["Documentation_AddressProof"]["tmp_name"],$Proof_bannerpath);
 /////////////////////////////////////////////////////////////////////////////////////////////  
   
*/

  $qryinsert = mysqli_query($conn, "insert into Members (GenerateMember_Id,Static_LeadID,Primary_Title,Primary_Pincode,Primary_mcode2,Primary_mob2,Primary_Contact1code,Primary_Contact1,Primary_Contact2code,Primary_Contact2,Primary_Contact3code,Primary_Contact3,Primary_nameOnTheCard,Primary_PhotoUpload,Primary_Email_ID2,Primary_DateOfBirth,Primary_AddressType1,Primary_BuldNo_addrss,Primary_Area_addrss,Primary_Landmark_addrss,Primary_MaritalStatus,Spouse_Title,Spouse_FirstName,Spouse_LastName,Spouse_GmailMArrid1,Spouse_GmailMArrid2,Spouse_PhotoUpload,Spouse_mcode1Married1,Spouse_mob1MArid1,Spouse_mcode1Married2,Spouse_mob1MArid2,Spouse_Contact1codeMArid,Spouse_Contact1Married,Spouse_Contact2codeMArid,Spouse_Contact2Married,Spouse_nameOnTheCardMarried,MembershipDetails_Level,MembershipDetails_Fee,MembershipDetails_offerCheck1,MembershipDts_Discount,MembershipDts_Author,MembershipDts_NetPayment,MembershipDts_GST,MembershipDts_GrossTotal,MembershipDts_PaymentDate,MembershipDts_PaymentMode,MembershipDts_InstrumentNumber,MemshipDts_UploadCopyOfTheInstmnt,MemshipDts_BatchNumber,MemshipDts_Remarks,Documentation_UploadSignatures,Documentation_AddressProof,Relationships_ReferredByLEADID,Relationships_ReferredByMEMBERSHIPID,itemCheck1,BookletCheck1,CertificatesCheck1,PromotionalCheck1,Issue_ReferredByLEADID,Issue_ReferredByMEMBERSHIPID)
                                values('$GenerateMember_Id','$Static_LeadID','$Primary_Title','$Primary_Pincode','$Primary_mcode2','$Primary_mob2','$Primary_Contact1code','$Primary_Contact1','$Primary_Contact2code','$Primary_Contact2','$Primary_Contact3code','$Primary_Contact3','$Primary_nameOnTheCard','$Primary_PhotoUpload','$Primary_Email_ID2','$DOB','$Primary_AddressType1','$Primary_BuldNo_addrss','$Primary_Area_addrss','$Primary_Landmark_addrss','$Primary_MaritalStatus','$Spouse_Title','$Spouse_FirstName','$Spouse_LastName','$Spouse_GmailMArrid1','$Spouse_GmailMArrid2','$Spouse_PhotoUpload','$Spouse_mcode1Married1','$Spouse_mob1MArid1','$Spouse_mcode1Married2','$Spouse_mob1MArid2','$Spouse_Contact1codeMArid','$Spouse_Contact1Married','$Spouse_Contact2codeMArid','$Spouse_Contact2Married','$Spouse_nameOnTheCardMarried','$MembershipDetails_Level','$MembershipDetails_Fee','$MembershipDetails_offerCheck1','$MembershipDts_Discount','$MembershipDts_Author','$MembershipDts_NetPayment','$MembershipDts_GST','$MembershipDts_GrossTotal','$MembershipDts_PaymentDate','$MembershipDts_PaymentMode','$MembershipDts_InstrumentNumber','$MemshipDts_UploadCopyOfTheInstmnt','$MemshipDts_BatchNumber','$MemshipDts_Remarks','$Documentation_UploadSignatures','$Documentation_AddressProof','$Relationships_ReferredByLEADID','$Relationships_ReferredByMEMBERSHIPID','$itemCheck1','$BookletCheck1','$CertificatesCheck1','$PromotionalCheck1','$Issue_ReferredByLEADID','$Issue_ReferredByMEMBERSHIPID')");


  if ($qryinsert) {
    $UpdateQry = mysqli_query($conn, "update Leads_table set Status='5' where Lead_id='" . $Static_LeadID . "' ");

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

  <?php } else {
    echo "<script>swal('Error!')</script>";
  }


  ?>
</body>

</html>