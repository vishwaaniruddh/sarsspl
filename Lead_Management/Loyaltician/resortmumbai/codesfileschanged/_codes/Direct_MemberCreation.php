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
?>

<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 

 $(document).ready(function(){
 var value=document.getElementById('Primary_MaritalStatus').value;
  if(value=='Married'){
        $("#Spouse").show();
         $("#Spouse_Title").attr("required",true);
          $("#Spouse_FirstName").attr("required",true);
           $("#Spouse_LastName").attr("required",true);
            $("#Spouse_GmailMArrid1").attr("required",true);
             $("#Spouse_mcode1Married1").attr("required",true);
              $("#Spouse_mob1MArid1").attr("required",true);
              $("#Spouse_nameOnTheCardMarried").attr("required",true);
    }
});
 
function setSpouseMember(){
    var value=document.getElementById('Primary_MaritalStatus').value;
   //  Spouse_Title Spouse_FirstName Spouse_LastName Spouse_GmailMArrid1 Spouse_GmailMArrid2 Spouse_PhotoUpload Spouse_mcode1Married1
  //   Spouse_mob1MArid1 Spouse_mcode1Married2 Spouse_mob1MArid2  Spouse_Contact1Married Spouse_Contact2Married Spouse_nameOnTheCardMarried
     
    if(value=='Married'){
        $("#Spouse").show();
       
         $("#Spouse_Title").attr("required",true);
          $("#Spouse_FirstName").attr("required",true);
           $("#Spouse_LastName").attr("required",true);
            $("#Spouse_GmailMArrid1").attr("required",true);
             $("#Spouse_mcode1Married1").attr("required",true);
              $("#Spouse_mob1MArid1").attr("required",true);
              $("#Spouse_nameOnTheCardMarried").attr("required",true);
        
    }
    else{
       
       document.getElementById('Spouse_Title').value=""; 
       document.getElementById('Spouse_FirstName').value=""; 
       document.getElementById('Spouse_LastName').value=""; 
       document.getElementById('Spouse_GmailMArrid1').value=""; 
      document.getElementById('Spouse_GmailMArrid2').value=""; 
       document.getElementById('Spouse_PhotoUpload').value=""; 
      document.getElementById('Spouse_mcode1Married1').value=""; 
       document.getElementById('Spouse_mob1MArid1').value=""; 
      document.getElementById('Spouse_mcode1Married2').value=""; 
       document.getElementById('Spouse_mob1MArid2').value=""; 
      document.getElementById('Spouse_Contact1Married').value=""; 
       document.getElementById('Spouse_Contact2Married').value=""; 
      document.getElementById('Spouse_nameOnTheCardMarried').value=""; 
         
          $("#Spouse").hide(); 
    }
      
      
    
}

function valueChangedHideShow()
{
    if($('#MembershipDetails_offerCheck1').is(":checked"))   
        $("#Hide_Discount_UplodeAuthorisation").show();
    else
        $("#Hide_Discount_UplodeAuthorisation").hide();
}

function cal_NetPayment(){
    
     var fee=document.getElementById('MembershipDetails_Fee').value;
     var discnt=document.getElementById('MembershipDts_Discount').value;
     var Amt=(fee*discnt)/100;
     var NetAmt=fee-Amt;
     
     var Gst=(NetAmt*18)/100;
     
     var grossAmt=NetAmt+Gst;
     
     
     document.getElementById('MembershipDts_NetPayment').value=NetAmt;
     document.getElementById('MembershipDts_GST').value=Gst;
     document.getElementById('MembershipDts_GrossTotal').value=grossAmt;
             
}
 $( function() {
    $( "#Primary_DateOfBirth" ).datepicker();
        $( "#Primary_DateOfBirth" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
        $( "#Primary_DateOfBirth" ).datepicker( "option", "showAnim", "fold" );
   
  } );



</script>

<script>
function setDropDownBrand(){
   // alert("hii")
      var value=document.getElementById('Hotel').value;
      var tableName='Hotel_Creation'; 
      var Column='hotel_id';
      var id='Brand';
      var name='Hotel_Name';
      
               $.ajax({
                    type:'POST',
                    url:'SetDropdownValueBrand.php',
                     data:'value='+value+'&tableName='+tableName+'&Column='+Column+'&id='+id+'&name='+name,
                    
                    success:function(msg){
                       // alert(msg);
                      document.getElementById('Brand').value=msg;
                    }
                })
                
            }
    


    
    function setDropDown(Textboxid,tableName,Column,id,name,setDropdwon) {
       var value=document.getElementById(Textboxid).value;
        
               $.ajax({
                    type:'POST',
                    url:'SetDropdownValue.php',
                     data:'value='+value+'&tableName='+tableName+'&Column='+Column+'&id='+id+'&name='+name,
                     datatype:'json',
                    success:function(msg){
                       // alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                      
                       if(Textboxid=="MembershipDetails_Level"){
                           
                           document.getElementById('MembershipDetails_Fee').value="";
                           document.getElementById('MembershipDetails_Fee').value=jsr[0]["name"];
                       }else{
                           
                    
                       var hed='#'+setDropdwon;
                      
                        var newoption=' <option value="">Select</option>' ;
                        $(hed).empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                           newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'   >'+jsr[i]["name"]+'</option> ';
		                }                       
                     	$(hed).append(newoption);
                       }
                    }
                })
                
            }
            

           
</script>
<script>

    function validation()
{
    
     var FirstName= document.getElementById("FirstName").value;
     var LastName= document.getElementById("LastName").value;
     var mcode1= document.getElementById("mcode1").value;
     var mob1= document.getElementById("mob1").value;
     var Email = document.getElementById("Gmail").value;
     
	var emailFilter =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
     
    
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
     else if(mcode1=="")
     {
     swal("Please enter Mobile Code");
     return false;
     }
     else if(mob1=="")
     {
     swal("Please enter Mobile Number");
     return false;
     }
     else if (Email == "")
	{
		swal(" Please fill email id ");
		return false;
		
	}
     else if (!emailFilter.test(Email))
	{
		
		swal("Invalid Email ")
		return false;
	}
     else{
 
    // sumitfunc();
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

                        <h4 class="">  New Member
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
                                 Member Entry
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        
                        
                        <form method="POST" action="MemberCreation_Review.php"  enctype="multipart/form-data" >
                        <div class="card-body">
                             
                          <input type="hidden" value="<?php echo $HOtelNameChk ;?>" id="hotlName" name="hotlName" required>
                         
                         
                          
                         
                         
                             <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 1. Primary Member Entry</div>
                        
                                  <div class="form-group">
                                  <label for="inputAddress2">Title</label>
                                  <select class="form-control" name="Primary_Title" id="Primary_Title" required>
                                  <option value="">Select Title</option>
                                   <?php 
                                          
                                          $titleQry="select * from Title ";
                                          
                                          $runTitle=mysqli_query($conn,$titleQry);
                                          while($fetchTitle=mysqli_fetch_array($runTitle)){?>
                                  <option value="<?php echo $fetchTitle['titleName'];?>"><?php echo $fetchTitle['titleName'];?></option>
                                 <?php } ?>
                                  </select>
                               </div>
                            
                            
                           <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">First Name</label>
                                    <input type="text" class="form-control" id="Primary_FirstName" name="Primary_FirstName"  value="<?php if($Mainid!=""){echo $fetchLead['FirstName'];} ?>" placeholder="First Name *" required >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Last Name</label>
                                    <input type="text" class="form-control" id="Primary_LastName" name="Primary_LastName" value="<?php if($Mainid!=""){echo $fetchLead['LastName'];} ?>" placeholder="Last Name *" required  >
                                </div>
                            </div>
                          
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Company</label>
                                    <input type="text" class="form-control" id="Primary_Company" name="Primary_Company" value="<?php if($Mainid!=""){echo $fetchLead['Company'];} ?>" placeholder="Company Name " required >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Designation</label>
                                    <input type="text" class="form-control" id="Primary_Designation" name="Primary_Designation" value="<?php if($Mainid!=""){echo $fetchLead['Designation'];} ?>" placeholder="Designation " required  >
                                </div>
                            </div>
                            
                             <div class="form-row">
                             <div class="form-group col-md-6">
                                <label for="inputAddress2">State</label>
                                     <input type="text" class="form-control" id="Primary_State" name="Primary_State" placeholder="State *"  value="<?php if($Mainid!=""){echo $fetchState['state'];} ?>" required >
                        
                            </div>
                            
                              <div class="form-group col-md-6">
                                <label for="inputAddress2">City</label>
                              <input type="text" class="form-control" id="Primary_City" name="Primary_City" placeholder="city *"  value="<?php if($Mainid!=""){echo $fetchLead['City'];} ?>" required >
                        
                            </div>
                            
                          </div>
                            
                      
                       <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Country</label>
                               <select class="form-control"  name="Primary_Country" id="Primary_Country" required  >
                                        <option value="">Select Country *</option>
                                        <option value="India" selected>India</option>
                                        
                                         </select> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Pincode</label>
                                    <input type="text" class="form-control" id="Primary_Pincode" name="Primary_Pincode" value="<?php if($Mainid!=""){echo $fetchLead['PinCode'];} ?>"  placeholder="Pincode *" required >
                                </div>
                            </div>
                            
                      
                            <div class="form-group">
                                <label for="inputAddress">Email</label>&nbsp;<label id="label3"></label>
                                <input type="email" class="form-control" id="Primary_Gmail_1" name="Primary_Gmail_1" placeholder="Email *"  value="<?php if($Mainid!=""){echo $fetchLead['EmailId'];} ?>"  required>
                            </div>
                            
                      
                            
                            
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Mobile Code *</label>
                                    <input type="text" class="form-control"  name="Primary_mcode1" id="Primary_mcode1" maxlength="3"   value="+<?php if($Mainid!=""){echo $fetchLead['MobileCode'];} ?>"  placeholder="eg. 91" required >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Mobile number *</label>&nbsp;<label id="label5"></label>
                                    <input type="text" class="form-control" id="Primary_mob1" name="Primary_mob1" maxlength="10" value="<?php if($Mainid!=""){echo $fetchLead['MobileNumber'];} ?>"  placeholder="Mobile number" required  >
                                </div>
                            </div>
                            
                             <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Mobile Code *</label>
                                    <input type="text" class="form-control"  name="Primary_mcode2" id="Primary_mcode2" maxlength="3"   value="+91"  placeholder="eg. 91" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Mobile number *</label>&nbsp;<label id="label5"></label>
                                    <input type="text" class="form-control" id="Primary_mob2" name="Primary_mob2" maxlength="10"   placeholder="Mobile number"  >
                                </div>
                            </div>
                            
                            
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Code</label>
                                    <input type="text" class="form-control" name="Primary_Contact1code" id="Primary_Contact1code" value="<?php if($Mainid!=""){echo $fetchLead['contact1Code'];} ?>" maxlength="3" placeholder="eg. 022" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact Number1</label>
                                    <input type="text" class="form-control" id="Primary_Contact1" name="Primary_Contact1" maxlength="10" value="<?php if($Mainid!=""){echo $fetchLead['ContactNo1'];} ?>" placeholder="Contact Number 1"  >
                                </div>
                            </div>
                            
                           
                           <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Code</label>
                                    <input type="text" class="form-control" name="Primary_Contact2code" id="Primary_Contact2code" value="022" maxlength="3" placeholder="eg. 022" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact Number2</label>
                                    <input type="text" class="form-control" id="Primary_Contact2" name="Primary_Contact2" maxlength="10"  placeholder="Contact Number 2"  >
                                </div>
                            </div>
                            
                            
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Code</label>
                                    <input type="text" class="form-control" name="Primary_Contact3code" id="Primary_Contact3code" value="022" maxlength="3" placeholder="eg. 022" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact Number3</label>
                                    <input type="text" class="form-control" id="Primary_Contact3" name="Primary_Contact3" maxlength="10"  placeholder="Contact Number3"  >
                                </div>
                            </div>
                            
                            
                            
                             <div class="form-group ">
                                    <label for="inputPassword4">Name on the Card</label>
                                    <input type="text" class="form-control" id="Primary_nameOnTheCard" name="Primary_nameOnTheCard"  maxlength="22"  placeholder="22 Characters including spaces" required >
                                </div>
                            
                            <div class="form-group ">
                                    <label for="inputPassword4">Photo Upload</label>
                                    <input type="file" class="form-control" id="Primary_PhotoUpload" name="Primary_PhotoUpload"   >
                                </div>
                            <div class="form-group ">
                                    <label for="inputPassword4">Email-ID 2(Gmail)</label>
                                    <input type="email" class="form-control" id="Primary_Email_ID2" name="Primary_Email_ID2"  placeholder="Email-ID "  >
                                </div>
                            
                            
                            <div class="form-group ">
                                    <label for="inputPassword4">Date Of Birth</label>
                                    <input type="text" class="form-control" id="Primary_DateOfBirth"  name="Primary_DateOfBirth" placeholder="dd-mm-yyyy" required >
                                </div>
                            
                            
                             
                                <div class="form-group">
                                 <!-- Textboxid,tableName,Column,id,name,setDropdwon-->
                                             <label for="inputEmail4">Address Type 1</label>
                                    <select class="form-control"  name="Primary_AddressType1" id="Primary_AddressType1" required >
                                        <option value="">Select Type *</option>
                                        <option value="Business">Business</option>
                                        <option value="Residence">Residence</option>
                                         </select> 
                                          
                                </div>
                                   <div class="form-group">
                                   <label for="inputPassword4">Address</label>
                                   <input type="text" class="form-control" id="Primary_BuldNo_addrss" name="Primary_BuldNo_addrss"   placeholder="Buld No./Room NO."  >
                              
                                </div>
                                
                               <div class="form-group">
                                   <label for="inputPassword4">Address</label>
                                   <input type="text" class="form-control" id="Primary_Area_addrss" name="Primary_Area_addrss"   placeholder="Area/Location"  >
                              
                                </div>
                                <div class="form-group">
                                   <label for="inputPassword4">Address</label>
                                   <input type="text" class="form-control" id="Primary_Landmark_addrss" name="Primary_Landmark_addrss"   placeholder="Landmark"  >
                              
                                </div>
                            
                             <div class="form-group ">
                                    <label for="inputPassword4">Marital Status</label>
                               <select class="form-control"  name="Primary_MaritalStatus" id="Primary_MaritalStatus"  onchange="setSpouseMember()" required>
                                        <option value="">Select Type *</option>
                                        <option id="Single" value="Single">Single</option>
                                        <option id="Married" value="Married">Married</option>
                                         </select> 
                                </div>
                            
                            <br /><br />
                            
                            
                            <!--===================================== if Marital Status Married (start)================================-->
                         
                           <div id="Spouse" style="display:none"> <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 2.  Spouse Member Entry</div>
                            
                             <div class="form-group">
                                  <label for="inputAddress2">Title</label>
                                  <select class="form-control" name="Spouse_Title" id="Spouse_Title">
                                  <option value="">Select Title</option>
                                   <?php 
                                          $titleQry="select * from Title ";
                                          $runTitle=mysqli_query($conn,$titleQry);
                                          while($fetchTitle=mysqli_fetch_array($runTitle)){?>
                                  <option value="<?php echo $fetchTitle['titleName'];?>"><?php echo $fetchTitle['titleName'];?></option>
                                 <?php } ?>
                                  </select>
                               </div>
                            
                            
                           <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">First Name</label>
                                    <input type="text" class="form-control" id="Spouse_FirstName" name="Spouse_FirstName"   placeholder="First Name *"  >
                                </div> 
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Last Name</label>
                                    <input type="text" class="form-control" id="Spouse_LastName" name="Spouse_LastName"  placeholder="Last Name *"  >
                                </div>
                            </div>
                            
                          
                            
                      
                            <div class="form-group">
                                <label for="inputAddress">Email</label>&nbsp;<label id="label3"></label>
                                <input type="email" class="form-control" id="Spouse_GmailMArrid1" name="Spouse_GmailMArrid1" placeholder="Email *"    >
                            </div>
                            
                             <div class="form-group">
                                <label for="inputAddress">Email-ID (Gmail)</label>&nbsp;<label id="label3"></label>
                                <input type="email" class="form-control" id="Spouse_GmailMArrid2" name="Spouse_GmailMArrid2" placeholder="Email-id (Gmail) *"    >
                            </div>
                      
                              <div class="form-group ">
                                    <label for="inputPassword4">Photo Upload</label>
                                    <input type="file" class="form-control" id="Spouse_PhotoUpload" name="Spouse_PhotoUpload"   >
                                </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Mobile Code *</label>
                                    <input type="text" class="form-control"  name="Spouse_mcode1Married1" id="Spouse_mcode1Married1" maxlength="3"   value="+91"  placeholder="eg. 91" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Mobile number *</label>&nbsp;<label id="label5"></label>
                                    <input type="text" class="form-control" id="Spouse_mob1MArid1" name="Spouse_mob1MArid1" maxlength="10"  placeholder="Mobile number"  >
                                </div>
                            </div>
                            
                            
                                
                             <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Mobile Code *</label>
                                    <input type="text" class="form-control"  name="Spouse_mcode1Married2" id="Spouse_mcode1Married2" maxlength="3"   value="+91"  placeholder="eg. 91" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Mobile number *</label>&nbsp;<label id="label5"></label>
                                    <input type="text" class="form-control" id="Spouse_mob1MArid2" name="Spouse_mob1MArid2" maxlength="10"  placeholder="Mobile number"  >
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Contact1 Code</label>
                                    <input type="text" class="form-control" name="Spouse_Contact1codeMArid" id="Spouse_Contact1codeMArid" maxlength="3" value="022" placeholder="eg. 022" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact1 Number</label>
                                    <input type="text" class="form-control" id="Spouse_Contact1Married" name="Spouse_Contact1Married" maxlength="10"  placeholder="Contact1 For Married"  >
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Contact2 Code</label>
                                    <input type="text" class="form-control" name="Spouse_Contact2codeMArid" id="Spouse_Contact2codeMArid" value="022" maxlength="3" placeholder="eg. 022" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact2 Number</label>
                                    <input type="text" class="form-control" id="Spouse_Contact2Married" name="Spouse_Contact2Married" maxlength="10"  placeholder="Contact Number" >
                                </div>
                            </div>
                        
                            
                             <div class="form-group ">
                                    <label for="inputPassword4">Name on the Card</label>
                                    <input type="text" class="form-control" id="Spouse_nameOnTheCardMarried" name="Spouse_nameOnTheCardMarried"  maxlength="22" placeholder="22 Characters including spaces"  >
                                </div>
                      <br /><br />
                      
                        </div>    
                            <!--===================================== if Marital Status Married (end)================================-->
                            
                            
                            
                            
                              <!--======================== Part 3 Membership Details (End)================================--->
                             <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 3 Membership Details</div>
                        
                        <?php 
                          $QryStatic_LeadID=  mysqli_query($conn,"SELECT * FROM `Members` where Static_LeadID='".$_GET['id']."' ");
                          $fetchStatic_LeadID=mysqli_fetch_array($QryStatic_LeadID);
                          
                           $QryStatic_LeadID1=  mysqli_query($conn,"SELECT level_name FROM `Level` where Leval_id='".$fetchStatic_LeadID['MembershipDetails_Level']."' ");
                          $fetchStatic_LeadID1=mysqli_fetch_array($QryStatic_LeadID1);
                          
                        ?>
                        
                        
                               
                                <div class="form-group">
                                    <label for="inputPassword4">Membership Level</label>
                                    <input type="text" class="form-control" id="MembershipDetails_Level" name="MembershipDetails_Level" value="<?php echo $fetchStatic_LeadID1['level_name']; ?>" >
                                 
                                </div>
                                 
                                <div class="form-group">
                                    <label for="inputEmail4">Membership Fee</label>
                                    <input type="text" class="form-control" id="MembershipDetails_Fee" name="MembershipDetails_Fee" value="<?php echo $fetchStatic_LeadID['MembershipDetails_Fee']; ?>" >
                                   
                                 </div>
                        
                              
                                  <div class="form-group">
                                    <label for="inputEmail4">% Discount</label>
                                    <input type="text" class="form-control" id="MembershipDts_Discount" name="MembershipDts_Discount" value="<?php echo $fetchStatic_LeadID['MembershipDts_Discount']; ?>"  >
                                 </div>
                              
                                 
                                 <div class="form-group">
                                    <label for="inputEmail4">Net Payment</label>
                                    <input type="text" class="form-control" id="MembershipDts_NetPayment" name="MembershipDts_NetPayment"  value="<?php echo $fetchStatic_LeadID['MembershipDts_NetPayment']; ?>" >
                                 </div>
                                 
                                  <div class="form-group">
                                    <label for="inputEmail4">GST @ 18%</label>
                                    <input type="text" class="form-control" id="MembershipDts_GST" name="MembershipDts_GST"  value="<?php echo $fetchStatic_LeadID['MembershipDts_GST']; ?>"  >
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Gross Total</label>
                                    <input type="text" class="form-control" id="MembershipDts_GrossTotal" name="MembershipDts_GrossTotal"  value="<?php echo $fetchStatic_LeadID['MembershipDts_GrossTotal']; ?>"  >
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Payment Date</label>
                                    <input type="text" class="form-control" id="MembershipDts_PaymentDate" name="MembershipDts_PaymentDate" value="<?php echo $fetchStatic_LeadID['MembershipDts_PaymentDate']; ?>" >
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Payment Mode</label>
                                         <input type="text" class="form-control" id="MembershipDts_PaymentMode" name="MembershipDts_PaymentMode" value="<?php echo $fetchStatic_LeadID['MembershipDts_PaymentMode']; ?>"  >
                                  </div>
                                 
                                  <div class="form-group">
                                    <label for="inputEmail4">Instrument Number</label>
                                    <input type="text" class="form-control" id="MembershipDts_InstrumentNumber" name="MembershipDts_InstrumentNumber" value="<?php echo $fetchStatic_LeadID['MembershipDts_InstrumentNumber']; ?>"  >
                                 </div>
                            
                                 
                                  <div class="form-group">
                                    <label for="inputEmail4">Batch Number</label>
                                    <input type="text" class="form-control" id="MemshipDts_BatchNumber" name="MemshipDts_BatchNumber" value="<?php echo $fetchStatic_LeadID['MemshipDts_BatchNumber']; ?>" >
                                 </div>
                                 
                                 
                                 <div class="form-group">
                                    <label for="inputEmail4">Remarks</label>
                                    <input type="text" class="form-control" id="MemshipDts_Remarks" name="MemshipDts_Remarks"  value="<?php echo $fetchStatic_LeadID['MemshipDts_Remarks']; ?>" >
                                 </div>
                            
                            
                              <!-- <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 3 Membership Details</div>
                        
                               
                                <div class="form-group">
                                    <label for="inputPassword4">Membership Level</label>
                                  <select class="form-control"  name="MembershipDetails_Level" id="MembershipDetails_Level" onblur="cal_NetPayment()"   onchange="setDropDown('MembershipDetails_Level','PrimaryMembershipFee','P_Level_id','MembershipFee_id','NewMembership','MembershipDetails_Fee')" required>
                                          <option value="">Select Level *</option>
                                        <?php
                                         $levelQry="select * from Level where 1=1";
                                          if($Mainid!=""){ $levelQry .= " and Program_ID=(SELECT Program_ID FROM `Program` where Hotel_id='".$HOtelNameChk."')";  }
                                         
                                          $runlevel=mysqli_query($conn,$levelQry);
                                          while($fetchLevel=mysqli_fetch_array($runlevel)){?>
                                          <option value="<?php echo $fetchLevel['Leval_id'];?>"><?php echo $fetchLevel['level_name'];?></option>
                                          <?php } ?>
                                  </select>
                                </div>
                                 
                                <div class="form-group">
                                    <label for="inputEmail4">Membership Fee</label>
                                    <input type="text" class="form-control" id="MembershipDetails_Fee" name="MembershipDetails_Fee" onblur="cal_NetPayment()"  required>
                                    <select class="form-control"  name="MembershipDetails_Fee" id="MembershipDetails_Fee"  onblur="cal_NetPayment()" >
                                        <option value=" ">Select Fee *</option>
                                         
                                    </select> 
                                 </div>
                                
                         
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="MembershipDetails_offerCheck1"  name="MembershipDetails_offerCheck1" onchange="valueChangedHideShow()">
                                    <label class="custom-control-label" for="MembershipDetails_offerCheck1">Offer</label>
                                </div>
                             
                        <div id="Hide_Discount_UplodeAuthorisation" style="display:none">        
                                  <div class="form-group">
                                    <label for="inputEmail4">% Discount</label>
                                    <input type="text" class="form-control" id="MembershipDts_Discount" name="MembershipDts_Discount" onblur="cal_NetPayment()"  value="0" >
                                 </div>
                                
                                
                                
                                <div class="form-group">
                                    <label for="inputEmail4">Upload Authorisation</label>
                                    <input type="file" class="form-control" id="MembershipDts_Author" name="MembershipDts_Author"   >
                                 </div>
                                 
                        </div>
                                 
                                 
                                 
                                 
                                 <div class="form-group">
                                    <label for="inputEmail4">Net Payment</label>
                                    <input type="text" class="form-control" id="MembershipDts_NetPayment" name="MembershipDts_NetPayment" required >
                                 </div>
                                 
                                  <div class="form-group">
                                    <label for="inputEmail4">GST @ 18%</label>
                                    <input type="text" class="form-control" id="MembershipDts_GST" name="MembershipDts_GST" required  >
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Gross Total</label>
                                    <input type="text" class="form-control" id="MembershipDts_GrossTotal" name="MembershipDts_GrossTotal" required  >
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Payment Date</label>
                                    <input type="text" class="form-control" id="MembershipDts_PaymentDate" name="MembershipDts_PaymentDate"   Placeholder="dd-mm-yyyy" required>
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Payment Mode</label>
                                    <select class="form-control"  name="MembershipDts_PaymentMode" id="MembershipDts_PaymentMode" onfocus="PaymentMode()" required >
                                        <option value="">Select Mode *</option>
                                          <?php 
                                          $runLevel=mysqli_query($conn,"select * from Level");
                                          $fetchLevel=mysqli_fetch_array($runLevel);
                                          $runMode=mysqli_query($conn,"select * from MembershipPaymentMode where Program_ID='".$fetchLevel['Program_ID']."'");
                                          $fetchMode=mysqli_fetch_array($runMode)
                                          ?>
                                          <option value="<?php echo $fetchMode['Payment_mode'];?>"><?php echo $fetchMode['Payment_mode'];?></option>
                                          
                                    </select> 
                                    </div>
                                 
                                  <div class="form-group">
                                    <label for="inputEmail4">Instrument Number</label>
                                    <input type="text" class="form-control" id="MembershipDts_InstrumentNumber" name="MembershipDts_InstrumentNumber"  placeholder='Credit Card/ Cheque/ Deposit Slip'  >
                                 </div>
                                 
                                 
                                 <div class="form-group">
                                    <label for="inputEmail4">Upload Copy of the instrument</label>
                                    <input type="file" class="form-control" id="MemshipDts_UploadCopyOfTheInstmnt" name="MemshipDts_UploadCopyOfTheInstmnt"   >
                                 </div>
                                 
                                  <div class="form-group">
                                    <label for="inputEmail4">Batch Number</label>
                                    <input type="text" class="form-control" id="MemshipDts_BatchNumber" name="MemshipDts_BatchNumber"   placeholder='Batch Number'>
                                 </div>
                                 
                                 
                                 <div class="form-group">
                                    <label for="inputEmail4">Remarks</label>
                                    <input type="text" class="form-control" id="MemshipDts_Remarks" name="MemshipDts_Remarks"   placeholder='Remarks'>
                                 </div>
                               -->  
                                 <!--======================== Part 3 Membership Details (End)================================--->
                                
                                <br /> <br />
                                
                                
                                  <!--======================== Part 4  Documentation (Start)================================--->
                                <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 4. Documentation</div>
                             
                                 <div class="form-group">
                                    <label for="inputEmail4">Upload Signatures</label>
                                    <input type="file" class="form-control" id="Documentation_UploadSignatures" name="Documentation_UploadSignatures"  >
                                 </div>
                                 
                               
                                 <div class="form-group">
                                    <label for="inputEmail4">Address Proof</label>
                                    <input type="file" class="form-control" id="Documentation_AddressProof" name="Documentation_AddressProof"  >
                                 </div>
                                  <!--======================== Part 4  Documentation (End)================================--->
                                <br /> <br />
                                
                                
                                
                                
                                 
                                
                                   <!--======================== Part 5 Relationships (Start)================================--->
                                 <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 5. Relationships</div>
                        
                                
                                  <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Referred by LEAD ID</label>
                                    <input type="text" class="form-control" name="Relationships_ReferredByLEADID" id="Relationships_ReferredByLEADID"  placeholder="Referred by LEAD ID" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Referred by MEMBERSHIP ID</label>
                                    <input type="text" class="form-control" id="Relationships_ReferredByMEMBERSHIPID" name="Relationships_ReferredByMEMBERSHIPID"  placeholder="Referred by MEMBERSHIP ID"  required>
                                </div>
                            </div>
                                
                                
                                   <!--======================== Part 5 Relationships (End)================================--->
                                
                                <br /><br />
                                
                                
                                
                                
                                
                                
                                      <!--======================== Part 6 Issue Membership (start)================================--->
                              <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 6. Issue Membership</div>
                        
                             
                             
                              <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="itemCheck1" name="itemCheck1">
                                    <label class="custom-control-label" for="itemCheck1">Check this item</label>
                                </div>
                             
                             <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="BookletCheck1" name="BookletCheck1">
                                    <label class="custom-control-label" for="BookletCheck1">Issue Booklet</label>
                                </div>
                             
                              <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="CertificatesCheck1" name="CertificatesCheck1">
                                    <label class="custom-control-label" for="CertificatesCheck1">Issue Certificates</label>
                                </div>
                             
                             
                               <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="PromotionalCheck1" name="PromotionalCheck1">
                                    <label class="custom-control-label" for="PromotionalCheck1">Issue Promotional Certificate</label> 
                                </div>
                            
                            
                             <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Referred by LEAD ID</label>
                                    <input type="text" class="form-control" name="Issue_ReferredByLEADID" id="Issue_ReferredByLEADID"  placeholder="Referred by LEAD ID" required >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Referred by MEMBERSHIP ID</label>
                                    <input type="text" class="form-control" id="Issue_ReferredByMEMBERSHIPID" name="Issue_ReferredByMEMBERSHIPID"  placeholder="Referred by MEMBERSHIP ID" required >
                                </div>
                            </div>
                            
                                
                            
                             
                                <!--======================== Part 6 Issue Membership (End)================================--->
                             
                                
                            
<br />
                          
                            <div class="form-group">
                                <input  type="submit" class="btn btn-primary" value="Review"/>
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
  
</body>
You have made no changes to save.
</html>