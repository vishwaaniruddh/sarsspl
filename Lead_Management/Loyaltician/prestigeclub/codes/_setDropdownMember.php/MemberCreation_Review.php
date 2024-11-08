<?php Session_Start();?>
<!DOCTYPE html>
<html lang="en">
<head>


<?php include('header.php');
include('config.php');
$Mainid=$_GET['id'];
if($Mainid!=""){


$QuryGetLead=mysqli_query($conn,"select * from Leads_table where Lead_id='".$Mainid."'");
$fetchLead=mysqli_fetch_array($QuryGetLead);

$HOtelNameChk=$fetchLead['Hotel_Name'];


$QuryDelegate=mysqli_query($conn,"select * from LeadDelegation where LeadId='".$Mainid."'");
$fetchDelegate=mysqli_fetch_array($QuryDelegate);
if($QuryDelegate){
$QurySalesmanId=mysqli_query($conn,"select * from SalesAssociate where SalesmanId='".$fetchDelegate['SalesmanId']."'");
$fetchSalesmanId=mysqli_fetch_array($QurySalesmanId);
}

$QuryLead_Sources=mysqli_query($conn,"SELECT * FROM `Lead_Sources` where SourceId='".$fetchLead['LeadSource']."' and Active='YES'");
$fetchLead_Sources=mysqli_fetch_array($QuryLead_Sources);



$QuryState=mysqli_query($conn,"select * from state where state_id='".$fetchLead['State']."'");
$fetchState=mysqli_fetch_array($QuryState);
}



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

$expirycheck = $_POST['ExpiryCheck1'];
if($expirycheck==""){
    $expirycheck=0;
    $display = "hide";
} else{
        $expirycheck=1;
         $display = "show";
 }

$ActualExpiry = $_POST['ActualExpiry'];
$ChangedExpiry = $_POST['ChangedExpiry'];
?>

<style>
    .show{
        display:block;
    }
    .hide{
        display:none;
    }
</style>
<script>

    function validation()
{

     var FirstName= document.getElementById("Static_FirstName").value;
     var LastName= document.getElementById("Static_LastName").value;
      var GST_number= document.getElementById("MemshipDts_GST_number").value;

           var startChar = GST_number.substring(0, 1);
           var endChar = GST_number.charAt(str.length-1);

 alert(isNaN(startChar));

     if(FirstName=="")
     {
     swal("Please enter First Name ");
     return false;
     }
     else if(LastName=="")
     {
     swal("Please enter Last Name");
     return false;
     }
     else if(isNaN(startChar)=='false'){
      swal("Invaliid GST No.");
     return false;
     }
      else if(isNaN(endChar)=='false'){
      swal("Invaliid GST No.");
     return false;
     }

     else{
          $('#submit').val('Please wait ...')
          .attr('disabled','disabled');


     return true;


         }

}



</script>


</head>
<body class="sidebar-pinned">

<?php include("vertical_menu.php")?>


<main class="admin-main">
    <!--site header begins-->
    <?php include('navbar.php');?>

<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class="">  Review Member
                        </h4>
                       <!-- <p class="opacity-75 ">
                            Examples for form control styles, layout options, and custom components for
                            creating a wide variety of forms elements.
                            <br>
                            we have included dropzone for file uploads, datepicker and select2 for custom controls.
                        </p>-->


                    </div>
                </div>
            </div>
        </div>

        <div class="container  pull-up">
            <div class="row">
                <div class="col-lg-6">

                    <!--widget card begin-->
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                 Member Review
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>


                        <form method="POST" action="MemberCreation_Process.php" onSubmit="return validation()" enctype="multipart/form-data" >
                        <div class="card-body ">
                              <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Static Info</div>
                          <input type="hidden" value="<?php echo $_POST['hotlName'] ;?>" id="hotlName" name="hotlName">


                             <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Lead ID</label>
                                    <input type="text" class="form-control" id="Static_LeadID" name="Static_LeadID"  value="<?php echo $_POST['Static_LeadID'] ;?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Lead Source</label>
                                    <input type="text" class="form-control" id="Static_LeadSource" name="Static_LeadSource" value="<?php echo $_POST['Static_LeadSource'] ;?>"   readonly>
                                </div>
                            </div>

                         <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">First Name</label>
                                    <input type="text" class="form-control" id="Static_FirstName" name="Static_FirstName"  value="<?php echo $_POST['Static_FirstName']; ?>" placeholder="First Name *"  readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Last Name</label>
                                    <input type="text" class="form-control" id="Static_LastName" name="Static_LastName" value="<?php echo $_POST['Static_LastName']; ?>" placeholder="Last Name *"  readonly>
                                </div>
                            </div>

                         <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Assigned to</label>
                                    <input type="text" class="form-control" id="Static_AssignedTo" name="Static_AssignedTo"  value="<?php echo $_POST['Static_AssignedTo']; ?>"   readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Date of Assignment</label>
                                    <input type="text" class="form-control" id="Static_DateOfAssignment" name="Static_DateOfAssignment" value="<?php echo $_POST['Static_DateOfAssignment']; ?>"  readonly>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Date of entry</label>
                                    <input type="text" class="form-control" id="Static_DateOfEntry" name="Static_DateOfEntry"  value="<?php echo $_POST['Static_DateOfEntry']; ?>"   readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Status</label>
                                    <input type="text" class="form-control" id="Static_Status" name="Static_Status" value="<?php echo $_POST['Static_Status']; ?>"   readonly>
                                </div>
                            </div>



                            <br /><br />
                             <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 1. Primary Member Entry</div>

                                  <div class="form-group">
                                  <label for="inputAddress2">Title</label>
                                <input type="text" class="form-control" id="Primary_Title" name="Primary_Title" value="<?php echo $_POST['Primary_Title']; ?>"   readonly>
                             </div>


                           <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">First Name</label>
                                    <input type="text" class="form-control" id="Primary_FirstName" name="Primary_FirstName"  value="<?php echo $_POST['Primary_FirstName'];  ?>" placeholder="First Name *"  readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Last Name</label>
                                    <input type="text" class="form-control" id="Primary_LastName" name="Primary_LastName" value="<?php echo $_POST['Primary_LastName'];  ?>" placeholder="Last Name *"  readonly>
                                </div>
                            </div>

                              <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Company</label>
                                    <input type="text" class="form-control" id="Primary_Company" name="Primary_Company" value="<?php echo $_POST['Primary_Company'];  ?>" placeholder="Company Name "  readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Designation</label>
                                    <input type="text" class="form-control" id="Primary_Designation" name="Primary_Designation" value="<?php echo $_POST['Primary_Designation'];  ?>" placeholder="Designation "  readonly>
                                </div>
                            </div>

                             <div class="form-row">
                             <div class="form-group col-md-6">
                                <label for="inputAddress2">State</label>
                                     <input type="text" class="form-control" id="Primary_State" name="Primary_State" placeholder="State *"  value="<?php echo $_POST['Primary_State'];  ?>" readonly>

                            </div>

                              <div class="form-group col-md-6">
                                <label for="inputAddress2">City</label>
                              <input type="text" class="form-control" id="Primary_City" name="Primary_City" placeholder="city *"  value="<?php echo $_POST['Primary_City'];  ?>" readonly>

                            </div>

                          </div>

                       <div class="form-group">
                                <label for="Primary_Area">Area of pincode</label>&nbsp;<label id="label3"></label>
                                <input type="text" class="form-control" id="Primary_Area" name="Primary_Area" placeholder="Area of pincode *"  value="<?php echo $_POST['Primary_Area'];  ?>"  readonly>
                            </div>



                       <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Country</label>
                                     <input type="text" class="form-control" id="Primary_City" name="Primary_City" placeholder="city *"  value="<?php echo $_POST['Primary_Country'];  ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Pincode</label>
                                    <input type="text" class="form-control" id="Primary_Pincode" name="Primary_Pincode"  placeholder="Pincode *"  value="<?php echo $_POST['Primary_Pincode'];  ?>" readonly>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="inputAddress">Email</label>&nbsp;<label id="label3"></label>
                                <input type="email" class="form-control" id="Primary_Gmail_1" name="Primary_Gmail_1" placeholder="Email *"  value="<?php echo $_POST['Primary_Gmail_1'];  ?>" readonly>
                            </div>




                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Mobile Code *</label>
                                    <input type="text" class="form-control"  name="Primary_mcode1" id="Primary_mcode1" maxlength="3"   value="+<?php echo $_POST['Primary_mcode1']; ?>"  placeholder="eg. 91" readonly>
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Mobile number *</label>&nbsp;<label id="label5"></label>
                                    <input type="text" class="form-control" id="Primary_mob1" name="Primary_mob1" maxlength="10" value="<?php echo $_POST['Primary_mob1'];  ?>"  placeholder="Mobile number"  readonly>
                                </div>
                            </div>

                             <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Mobile Code *</label>
                                    <input type="text" class="form-control"  name="Primary_mcode2" id="Primary_mcode2" maxlength="3"   value="<?php echo $_POST['Primary_mcode2']; ?>"  placeholder="eg. 91" readonly>
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Mobile number *</label>&nbsp;<label id="label5"></label>
                                    <input type="text" class="form-control" id="Primary_mob2" name="Primary_mob2" maxlength="10" value="<?php echo $_POST['Primary_mob2'];  ?>"  placeholder="Mobile number" readonly >
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Code</label>
                                    <input type="text" class="form-control" name="Primary_Contact1code" id="Primary_Contact1code" value="<?php echo $_POST['Primary_Contact1code'];?>" maxlength="3" placeholder="eg. 022" readonly>
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact Number1</label>
                                    <input type="text" class="form-control" id="Primary_Contact1" name="Primary_Contact1" maxlength="10" value="<?php echo $_POST['Primary_Contact1'];?>" placeholder="Contact Number 1"  readonly>
                                </div>
                            </div>


                           <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Code</label>
                                    <input type="text" class="form-control" name="Primary_Contact2code" id="Primary_Contact2code" value="<?php echo $_POST['Primary_Contact2code'];  ?>" maxlength="3" placeholder="eg. 022" readonly>
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact Number2</label>
                                    <input type="text" class="form-control" id="Primary_Contact2" name="Primary_Contact2" maxlength="10"  placeholder="Contact Number 2" value="<?php echo $_POST['Primary_Contact2'];  ?>" readonly >
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Code</label>
                                    <input type="text" class="form-control" name="Primary_Contact3code" id="Primary_Contact3code" value="<?php echo $_POST['Primary_Contact3code'];?>" maxlength="3" placeholder="eg. 022" readonly>
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact Number3</label>
                                    <input type="text" class="form-control" id="Primary_Contact3" name="Primary_Contact3" maxlength="10" value="<?php echo $_POST['Primary_Contact3'];?>"  placeholder="Contact Number3" readonly >
                                </div>
                            </div>



                             <div class="form-group ">
                                    <label for="inputPassword4">Name on the Card</label>
                                    <input type="text" class="form-control" id="Primary_nameOnTheCard" name="Primary_nameOnTheCard"  maxlength="22" value="<?php echo $_POST['Primary_nameOnTheCard'];?>"  placeholder="22 Characters including spaces"  readonly>
                                </div>

                            <div class="form-group ">
                                    <label for="inputPassword4">Photo Upload</label>
                                     <input type="hidden" class="form-control" id="Primary_PhotoUpload" name="Primary_PhotoUpload" value="<?php echo $Primary_bannerpath;?>"  readonly >

                               <img  src="<?php echo $Primary_bannerpath ;?>"   alt="img" style="width:100px;height:100px" readonly/>
                                </div>
                            <div class="form-group ">
                                    <label for="inputPassword4">Email-ID 2(Gmail)</label>
                                    <input type="email" class="form-control" id="Primary_Email_ID2" name="Primary_Email_ID2" value="<?php echo $_POST['Primary_Email_ID2'];?>"  placeholder="Email-ID " readonly >
                                </div>


                            <div class="form-group ">
                                    <label for="inputPassword4">Date Of Birth</label>
                                    <input type="text" class="form-control" id="Primary_DateOfBirth" value="<?php echo $_POST['Primary_DateOfBirth'];?>"  name="Primary_DateOfBirth" readonly >
                                </div>

                            <div class="form-group ">
                                    <label for="inputPassword4">Anniversary</label>
                                    <input type="text" class="form-control" id="Primary_Anniversary" value="<?php  echo $_POST['Primary_Anniversary'];?>"  name="Primary_Anniversary" readonly >
                                </div>


                                <div class="form-group">
                                 <!-- Textboxid,tableName,Column,id,name,setDropdwon-->
                                             <label for="inputEmail4">Address Type 1</label>
                                                     <input type="text" class="form-control" id="Primary_AddressType1" value="<?php echo $_POST['Primary_AddressType1'];?>"  name="Primary_AddressType1" placeholder="dd-mm-yyyy" readonly >
                              </div>
                                   <div class="form-group">
                                   <label for="inputPassword4">Address</label>
                                   <input type="text" class="form-control" id="Primary_BuldNo_addrss" name="Primary_BuldNo_addrss" value="<?php echo $_POST['Primary_BuldNo_addrss'];?>"  placeholder="Buld No./Room NO." readonly >

                                </div>

                               <div class="form-group">
                                   <label for="inputPassword4">Address</label>
                                   <input type="text" class="form-control" id="Primary_Area_addrss" name="Primary_Area_addrss" value="<?php echo $_POST['Primary_Area_addrss'];?>"  placeholder="Area/Location" readonly >

                                </div>
                                <div class="form-group">
                                   <label for="inputPassword4">Address</label>
                                   <input type="text" class="form-control" id="Primary_Landmark_addrss" name="Primary_Landmark_addrss" value="<?php echo $_POST['Primary_Landmark_addrss'];?>"  placeholder="Landmark"  readonly>

                                </div>

                             <div class="form-group ">
                                    <label for="inputPassword4">Marital Status</label>
                                <input type="text" class="form-control" id="Primary_MaritalStatus" name="Primary_MaritalStatus" value="<?php echo $_POST['Primary_MaritalStatus'];?>"  placeholder="Landmark" readonly >
                               </div>

                            <br /><br />


                            <!--===================================== if Marital Status Married (start)================================-->

                           <div id="Spouse"  <?php if($_POST['Primary_MaritalStatus']!="Married"){?>style="display:none" <?php }?> > <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 2.  Spouse Member Entry</div>

                             <div class="form-group">
                                  <label for="inputAddress2">Title</label>
                                  <input type="text" class="form-control" id="Spouse_Title" name="Spouse_Title" value="<?php echo $_POST['Spouse_Title'];?>" readonly >
                              </div>


                           <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">First Name</label>
                                    <input type="text" class="form-control" id="Spouse_FirstName" name="Spouse_FirstName" value="<?php echo $_POST['Spouse_FirstName'];?>"   readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Last Name</label>
                                    <input type="text" class="form-control" id="Spouse_LastName" name="Spouse_LastName"  value="<?php echo $_POST['Spouse_LastName'];?>"   readonly>
                                </div>
                            </div>




                            <div class="form-group">
                                <label for="inputAddress">Email</label>&nbsp;<label id="label3"></label>
                                <input type="email" class="form-control" id="Spouse_GmailMArrid1" name="Spouse_GmailMArrid1" value="<?php echo $_POST['Spouse_GmailMArrid1'];?>"    readonly>
                            </div>

                             <div class="form-group">
                                <label for="inputAddress">Email-ID (Gmail)</label>&nbsp;<label id="label3"></label>
                                <input type="email" class="form-control" id="Spouse_GmailMArrid2" name="Spouse_GmailMArrid2" value="<?php echo $_POST['Spouse_GmailMArrid2'];?>"    readonly>
                            </div>

                              <div class="form-group ">
                                    <label for="inputPassword4">Photo Upload</label>
                                 <input type="hidden" class="form-control"  id="Spouse_PhotoUpload" name="Spouse_PhotoUpload" value="<?php echo $Spouse_bannerpath;?>"  readonly >

                                <img src="<?php echo $Spouse_bannerpath;?>" alt="img" style="width:100px;height:100px" />
                                </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Mobile Code *</label>
                                    <input type="text" class="form-control"  name="Spouse_mcode1Married1" id="Spouse_mcode1Married1" value="<?php echo $_POST['Spouse_mcode1Married1'];?>" readonly >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Mobile number *</label>&nbsp;<label id="label5"></label>
                                    <input type="text" class="form-control" id="Spouse_mob1MArid1" name="Spouse_mob1MArid1" value="<?php echo $_POST['Spouse_mob1MArid1'];?>" readonly >
                                </div>
                            </div>



                             <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Mobile Code *</label>
                                    <input type="text" class="form-control"  name="Spouse_mcode1Married2" id="Spouse_mcode1Married2" value="<?php echo $_POST['Spouse_mcode1Married2'];?>" readonly>
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Mobile number *</label>&nbsp;<label id="label5"></label>
                                    <input type="text" class="form-control" id="Spouse_mob1MArid2" name="Spouse_mob1MArid2" value="<?php echo $_POST['Spouse_mob1MArid2'];?>"  readonly>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Contact1 Code</label>
                                    <input type="text" class="form-control" name="Spouse_Contact1codeMArid" id="Spouse_Contact1codeMArid" value="<?php echo $_POST['Spouse_Contact1codeMArid'];?>" readonly>
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact1 Number</label>
                                    <input type="text" class="form-control" id="Spouse_Contact1Married" name="Spouse_Contact1Married" value="<?php echo $_POST['Spouse_Contact1Married'];?>" readonly>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Contact2 Code</label>
                                    <input type="text" class="form-control" name="Spouse_Contact2codeMArid" id="Spouse_Contact2codeMArid" value="<?php echo $_POST['Spouse_Contact2codeMArid'];?>" readonly>
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact2 Number</label>
                                    <input type="text" class="form-control" id="Spouse_Contact2Married" name="Spouse_Contact2Married"value="<?php echo $_POST['Spouse_Contact2Married'];?>" readonly>
                                </div>
                            </div>


                             <div class="form-group ">
                                    <label for="Spouse_DateOfBirth">Date Of Birth</label>
                                    <input type="text" class="form-control" id="Spouse_DateOfBirth"  name="Spouse_DateOfBirth" placeholder="dd-mm-yyyy" value="<?php echo $_POST['Spouse_DateOfBirth'];?>"  >
                                </div>

                             <div class="form-group ">
                                    <label for="inputPassword4">Name on the Card</label>
                                    <input type="text" class="form-control" id="Spouse_nameOnTheCardMarried" name="Spouse_nameOnTheCardMarried" value="<?php echo $_POST['Spouse_nameOnTheCardMarried'];?>" readonly>
                                </div>
                                
                                <div class="form-group ">
                                    <label for="inputPassword4">Spouse Fee</label>
                                    <input type="text" class="form-control" id="Spouse_Fee" name="Spouse_Fee" value="<?php echo $_POST['Spouse_Fee'];?>" readonly>
                                </div>
                                
                                <div class="form-group ">
                                    <label for="inputPassword4">Spouse VAT</label>
                                    <input type="text" class="form-control" id="Spouse_VAT" name="Spouse_VAT" value="<?php echo $_POST['Spouse_VAT'];?>" readonly>
                                </div>
                                
                      <br /><br />

                        </div>
                            <!--===================================== if Marital Status Married (end)================================-->




                              <!--======================== Part 3 Membership Details (End)================================--->
                               <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 3 Membership Details</div>


                                <div class="form-group">
                                    <label for="inputPassword4">Membership Level</label>
                                          <input type="text" class="form-control" id="MembershipDetails_Level" name="MembershipDetails_Level" value="<?php echo $_POST['MembershipDetails_Level'];?>" readonly>
                               </div>

                                <div class="form-group">
                                    <label for="inputEmail4">Membership Fee</label>
                                                 <input type="text" class="form-control" id="MembershipDetails_Fee" name="MembershipDetails_Fee" value="<?php echo $_POST['MembershipDetails_Fee'];?>" readonly>
                             </div>




                        <div  <?php if($_POST['MembershipDetails_offerCheck1']==""){?>style="display:none" <?php }?>>
                                  <div class="form-group">
                                    <label for="inputEmail4">% Discount</label>
                                    <input type="text" class="form-control" id="MembershipDts_Discount" name="MembershipDts_Discount" value="<?php echo $_POST['MembershipDts_Discount'];?>"  readonly>
                                 </div>



                                <div class="form-group">
                                    <label for="inputEmail4">Upload Authorisation</label>
                                    <input type="hidden" class="form-control"   id="MembershipDts_Author" name="MembershipDts_Author" value="<?php echo $Author_bannerpath;?>"  readonly >
                                    <img src="<?php echo $Author_bannerpath;?>"   alt="img" style="width:100px;height:100px" />
                                 </div>

                        </div>




                                 <div class="form-group">
                                    <label for="inputEmail4">Net Payment</label>
                                    <input type="text" class="form-control" id="MembershipDts_NetPayment" name="MembershipDts_NetPayment" value="<?php echo $_POST['MembershipDts_NetPayment'];?>" readonly>
                                 </div>

                                  <div class="form-group">
                                    <label for="inputEmail4">VAT @ 16%</label>
                                    <input type="text" class="form-control" id="MembershipDts_GST" name="MembershipDts_GST"  value="<?php echo $_POST['MembershipDts_GST'];?>" readonly >
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Gross Total</label>
                                    <input type="text" class="form-control" id="MembershipDts_GrossTotal" name="MembershipDts_GrossTotal" value="<?php echo $_POST['MembershipDts_GrossTotal'];?>"  readonly >
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Payment Date</label>
                                    <input type="text" class="form-control" id="MembershipDts_PaymentDate" name="MembershipDts_PaymentDate"  value="<?php echo $_POST['MembershipDts_PaymentDate'];?>" readonly>
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Payment Mode</label>
                                       <input type="text" class="form-control" id="MembershipDts_PaymentMode" name="MembershipDts_PaymentMode"  value="<?php echo $_POST['MembershipDts_PaymentMode'];?>" readonly>
                                   </div>

                                  <div class="form-group">
                                    <label for="inputEmail4">Instrument Number</label>
                                    <input type="text" class="form-control" id="MembershipDts_InstrumentNumber" name="MembershipDts_InstrumentNumber" value="<?php echo $_POST['MembershipDts_InstrumentNumber'];?>"  readonly>
                                 </div>



                                  <div class="form-group">
                                    <label for="inputEmail4">Batch Number</label>
                                    <input type="text" class="form-control" id="MemshipDts_BatchNumber" name="MemshipDts_BatchNumber"  value="<?php echo $_POST['MemshipDts_BatchNumber'];?>"  placeholder='Batch Number' readonly>
                                 </div>


                                 <div class="form-group">
                                    <label for="inputEmail4">Remarks</label>
                                    <input type="text" class="form-control" id="MemshipDts_Remarks" name="MemshipDts_Remarks" value="<?php echo $_POST['MemshipDts_Remarks'];?>"   placeholder='Remarks' readonly>
                                 </div>

                                 <div class="form-group">
                                    <label for="inputEmail4">GST NO.</label>
                                    <input type="text" class="form-control" id="MemshipDts_GST_number" name="MemshipDts_GST_number" value="<?php echo $_POST['MemshipDts_GST_number'];?>"   placeholder='GST NO.' >
                                 </div>

                                 <!--======================== Part 3 Membership Details (End)================================--->

                                <br /> <br />


                                  <!--======================== Part 4  Documentation (Start)================================--->
                                <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 4. Documentation</div>



                                <div class="form-group">
                                    <label for="inputEmail4">Upload Signatures</label>
                                    <input type="hidden" class="form-control"  id="Documentation_UploadSignatures" name="Documentation_UploadSignatures" value="<?php echo $Signatures_bannerpath;?>"  readonly >

                                    <img src="<?php echo $Signatures_bannerpath;?>"    alt="img" style="width:100px;height:100px"/>
                                 </div>


                                 <div class="form-group">
                                    <label for="inputEmail4">Address Proof</label>
                                     <input type="hidden" class="form-control"  id="Documentation_AddressProof" name="Documentation_AddressProof" value="<?php echo $Proof_bannerpath;?>"  readonly >
                                     <img src="<?php echo $Proof_bannerpath;?>"   alt="img" style="width:100px;height:100px"/>
                                 </div>
                                  <!--======================== Part 4  Documentation (End)================================--->
                                <br /> <br />






                                   <!--======================== Part 5 Relationships (Start)================================--->
                                 <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 5. Relationships</div>


                                  <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Referred by LEAD ID</label>
                                    <input type="text" class="form-control" name="Relationships_ReferredByLEADID" id="Relationships_ReferredByLEADID" value="<?php echo $_POST['Relationships_ReferredByLEADID'];?>"  placeholder="Referred by LEAD ID" readonly >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Referred by MEMBERSHIP ID</label>
                                    <input type="text" class="form-control" id="Relationships_ReferredByMEMBERSHIPID" name="Relationships_ReferredByMEMBERSHIPID" value="<?php echo $_POST['Relationships_ReferredByMEMBERSHIPID'];?>"  placeholder="Referred by MEMBERSHIP ID" readonly >
                                </div>
                            </div>


                                   <!--======================== Part 5 Relationships (End)================================--->

                                <br /><br />






                                      <!--======================== Part 6 Issue Membership (start)================================--->
                              <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 6. Issue Membership</div>



                              <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="itemCheck1" name="itemCheck1" <?php if($_POST['itemCheck1']!=""){?>checked <?php }?>>
                                    <label class="custom-control-label" for="itemCheck1">Check this item</label>
                                </div>

                             <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="BookletCheck1" name="BookletCheck1" <?php if($_POST['BookletCheck1']!=""){?>checked <?php }?>>
                                    <label class="custom-control-label" for="BookletCheck1">Issue Booklet</label>
                                </div>

                              <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="CertificatesCheck1" name="CertificatesCheck1" <?php if($_POST['CertificatesCheck1']!=""){?>checked <?php }?>>
                                    <label class="custom-control-label" for="CertificatesCheck1">Issue Certificates</label>
                                </div>


                               <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="PromotionalCheck1" name="PromotionalCheck1" <?php if($_POST['PromotionalCheck1']!=""){?>checked <?php }?>>
                                    <label class="custom-control-label" for="PromotionalCheck1">Issue Promotional Certificate</label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="RenewalCheck1" name="RenewalCheck1" <?php if($_POST['RenewalCheck1']!=""){?>checked <?php }?>>
                                    <label class="custom-control-label" for="RenewalCheck1">Issue Renewal Certificate</label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="ExpiryCheck_0" name="ExpiryCheck1" onclick="expirycheck('0')" <?php if($expirycheck!=""){?>checked <?php }?>>
                                    <label class="custom-control-label" for="ExpiryCheck_0">Issue Expiry Change</label>
                                </div>

                                <div class="form-row <?php echo $display;?>" id="new">
                                    <div class="form-group col-md-6" id="actual">
                                        <label for="ActualExpiry">Actual Expiry</label>
                                        <input type="text" class="form-control" id="ActualExpiry"  name="ActualExpiry"  value="<?php echo $ActualExpiry;?>" placeholder="Actual Expiry" readonly >
                                    </div>

                                    <div class="form-group col-md-6"  id="changed">
                                        <label for="ActualExpiry">Changed Expiry</label>
                                        <input type="date" class="form-control" id="ChangedExpiry"  name="ChangedExpiry" placeholder="New Expiry" value= "<?php echo $ChangedExpiry; ?>">
                                    </div>
                                </div>


                             <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Referred by LEAD ID</label>
                                    <input type="text" class="form-control" name="Issue_ReferredByLEADID" id="Issue_ReferredByLEADID" value="<?php echo $_POST['Issue_ReferredByLEADID'];?>"  readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Referred by MEMBERSHIP ID</label>
                                    <input type="text" class="form-control" id="Issue_ReferredByMEMBERSHIPID" name="Issue_ReferredByMEMBERSHIPID"  value="<?php echo $_POST['Issue_ReferredByMEMBERSHIPID'];?>"  readonly >
                                </div>
                            </div>




                                <!--======================== Part 6 Issue Membership (End)================================--->



<br />

                            <div class="form-group">
                                <input  type="submit" class="btn btn-primary" id="submit" value="Submit"/>

                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href = "javascript:history.back()" class="btn btn-primary"  >Back to previous page</a>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!--widget card ends-->




                </div>

            </div>


        </div>
    </section>
</main>
<?php include('belowScript.php');?>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

      function expirycheck(val)
      {
        //   alert(val);
        //   var test = $("#Static_FirstName").val();
        //   alert($("#ExpiryCheck_"+val).is(":checked"));
          if($("#ExpiryCheck_"+val).is(":checked"))
          {
              $( "#new" ).removeClass( "hide" ).addClass( "show" );

            //   $("#changed").show();
          }
          else{
              $( "#new" ).removeClass( "show" ).addClass( "hide" );
             // $("#new").hide();
            //   $("#changed").hide();
          }
      }
  </script>
</body>
</html>