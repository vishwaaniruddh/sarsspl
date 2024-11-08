<?php Session_Start();?>
<!DOCTYPE html>
<html lang="en">
<head>

    
<?php include('header.php');
include('config.php');
$Mainid=$_GET['id'];
if($Mainid!=""){
    
    
$QuryGetMem=mysqli_query($conn,"select * from Members where Static_LeadID='".$Mainid."'");
$fetchMem=mysqli_fetch_array($QuryGetMem);
    
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


/*
$QuryState=mysqli_query($conn,"select * from state where state_id='".$fetchLead['State']."'");
$fetchState=mysqli_fetch_array($QuryState);*/
}
?>

<script>
function getStateCity(){
    
var Pincode=document.getElementById("Primary_Pincode").value;
     $.ajax({
                    type:'POST',
                    url:'setDropDownSateCity.php',
                     data:'Pincode='+Pincode,
                     datatype:'json',
                    success:function(msg){
                 //  alert(msg);
                   var jsr=JSON.parse(msg);
                    for(var i=0;i<jsr.length;i++)
                        {
                       
                   document.getElementById("Primary_State").value=jsr[i]["State"];
                   document.getElementById("Primary_City").value=jsr[i]["City"];
                        }
                    }
                })
                
            }
 

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
       
       $("#Spouse_Title").attr("required",false);
          $("#Spouse_FirstName").attr("required",false);
           $("#Spouse_LastName").attr("required",false);
            $("#Spouse_GmailMArrid1").attr("required",false);
             $("#Spouse_mcode1Married1").attr("required",false);
              $("#Spouse_mob1MArid1").attr("required",false);
              $("#Spouse_nameOnTheCardMarried").attr("required",false);
       
       
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


/* $( function() {
    $( "#Primary_DateOfBirth" ).datepicker();
        $( "#Primary_DateOfBirth" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
        $( "#Primary_DateOfBirth" ).datepicker( "option", "showAnim", "fold" );
   
  } );*/
  
  $(document).ready(function(){
  $("#Primary_DateOfBirth").focus(function(){
  
    $( "#Primary_DateOfBirth" ).datepicker();
        $( "#Primary_DateOfBirth" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
        $( "#Primary_DateOfBirth" ).datepicker( "option", "showAnim", "fold" );
   });
   
    
});


 $(document).ready(function(){
  $("#Primary_Anniversary").focus(function(){
  
 
    $( "#Primary_Anniversary" ).datepicker();
        $( "#Primary_Anniversary" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
        $( "#Primary_Anniversary" ).datepicker( "option", "showAnim", "fold" );
  });
 
});
  
  $(document).ready(function(){
  $("#MembershipDts_PaymentDate").focus(function(){
  
 
    $( "#MembershipDts_PaymentDate" ).datepicker();
        $( "#MembershipDts_PaymentDate" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
        $( "#MembershipDts_PaymentDate" ).datepicker( "option", "showAnim", "fold" );
  });
 
});
  
    $(document).ready(function(){
    $("#Spouse_DateOfBirth").focus(function(){
  
    $( "#Spouse_DateOfBirth" ).datepicker();
        $( "#Spouse_DateOfBirth" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
        $( "#Spouse_DateOfBirth" ).datepicker( "option", "showAnim", "fold" );
   });
  
 
});
  
  
 
 /*$( function() {
    $( "#Primary_Anniversary" ).datepicker();
        $( "#Primary_Anniversary" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
        $( "#Primary_Anniversary" ).datepicker( "option", "showAnim", "fold" );
   
  } );*/

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
            

           
    
    function modelnos() {
         
var state=document.getElementById("Primary_State").value;
//alert(state);
                $.ajax({
                    type:'POST',
                    url:'city.php',
                     data:'state='+state,
                     datatype:'json',
                    success:function(msg){
                      //  alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                        var newoption=' <option value="">Select</option>' ;
                        $('#Primary_City').empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'   >'+jsr[i]["modelno"]+'</option> ';
		
                        
                        }                       
                     	$('#Primary_City').append(newoption);
 
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

                        <h4 class="">  View Member
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
                <div class="col-lg-12">

                    <!--widget card begin-->
                    <div class="card m-b-30">


                        <div class="card-body">
                              <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Static Info</div>
                          <input type="hidden" value="<?php echo $HOtelNameChk ;?>" id="hotlName" name="hotlName" required>
                         
                         
                         
                <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputEmail4">Membership ID</label>
                <input type="text" class="form-control" value="<?php echo $fetchMem['GenerateMember_Id']; ?>" readonly  required>
                </div>
                
                <div class="form-group col-md-6">
                <label for="inputEmail4">Booklet Series</label>
                <input type="text" class="form-control"  value="<?php echo $fetchMem['booklet_Series']; ?>" readonly  required>              
                </div>                                                                 
                </div>
                
                

                             <div class="form-row">
                                
                                      
                                
                                
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Lead ID</label>
                         <input type="text" class="form-control" id="Static_LeadID" name="Static_LeadID"  value="<?php if($Mainid!=""){echo $fetchLead['Lead_id'];} ?>" readonly  required>
                          
                             
                                      
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Lead Source</label>
                                 <!--   <input type="text" class="form-control" id="Static_LeadSource" name="Static_LeadSource" value="<?php if($Mainid!=""){echo $fetchLead_Sources['Name'];} ?>"  required >
                                -->
                                 <select class="form-control" name="Static_LeadSource" id="Static_LeadSource" >
                                     <option value="">Select Lead Source</option>
                                    <?php if($Mainid!=""){
                                    $qerySources=mysqli_query($conn,"select * from Lead_Sources where Active='YES' ");
                                   while($Sourcesfetch=mysqli_fetch_array($qerySources)){
                                   
                                     
                                    ?>
                                    <option value="<?php echo $Sourcesfetch['SourceId'];?>" id="<?php echo $Sourcesfetch['SourceId'];?>"  <?php if($Mainid!=""){ if($Sourcesfetch['Name']==$fetchLead_Sources['Name']) { ?>selected <?php }} ?> ><?php echo $Sourcesfetch['Name'];?></option>
                                    <?php }} ?>
                                
                                      </select>
                                </div>
                            </div>
                         
                         <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">First Name</label>
                                    <input type="text" class="form-control" id="Static_FirstName" name="Static_FirstName"  value="<?php if($Mainid!=""){echo $fetchLead['FirstName'];} ?>" placeholder="First Name *" readonly required >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Last Name</label>
                                    <input type="text" class="form-control" id="Static_LastName" name="Static_LastName" value="<?php if($Mainid!=""){echo $fetchLead['LastName'];} ?>" placeholder="Last Name *" readonly required >
                                </div>
                            </div>
                         
                         <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Assigned to</label>
                                    <input type="text" class="form-control" id="Static_AssignedTo" name="Static_AssignedTo"  value="<?php if($Mainid!=""){echo $fetchSalesmanId['FirstName']." ".$fetchSalesmanId['LastName'];} ?>" readonly  required  >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Date of Assignment</label>
                                    <input type="text" class="form-control" id="Static_DateOfAssignment" name="Static_DateOfAssignment" value="<?php if($Mainid!=""){echo $fetchDelegate['DelegatedTIme'];} ?>" readonly required >
                                </div>
                            </div>
                            
                     
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Date of entry</label>
                                    <input type="text" class="form-control" id="Static_DateOfEntry" name="Static_DateOfEntry"  value="<?php if($Mainid!=""){echo $fetchLead['Creation'];} ?>" readonly required >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Status</label>
                                    <input type="text" class="form-control" id="Static_Status" name="Static_Status" value="<?php if($Mainid!=""){   if($fetchLead['Status']=='4' || $fetchLead['Status']=='5'){echo "Payment Received " ;} } ?>" readonly required >
                                </div>
                            </div>
                     <!-- <div class="form-group col-md-6">
                                    <label for="inputPassword4">Reference from</label>
                                    <input type="text" class="form-control" id="LastName" name="LastName" value="<?php if($Mainid!=""){echo $fetchLead['LastName'];} ?>"   >
                                </div>-->
                       
                        
                        
                            <br /><br />
                             <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 1. Primary Member Entry</div>
                        
                                  <div class="form-group">
                                  <label for="inputAddress2">Title</label>
                                  <select class="form-control" name="Primary_Title" id="Primary_Title" required>
                                  <?php if($Mainid!=""){?> <option value="<?php echo $fetchLead['Title']; ?>"><?php echo $fetchLead['Title']; ?></option><?php } ?>
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
                            
                                  
                             <div class="form-group ">
                                    <label for="Primary_Area">Area of Pincode</label></label>
                                    <input type="text" class="form-control" id="Primary_Area" name="Primary_Area" value="<?php if($Mainid!=""){echo $fetchLead['pincodeOfArea'];} ?>"  placeholder="Area"  >
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
                                    <input type="text" class="form-control" id="Primary_Pincode" name="Primary_Pincode" onblur="getStateCity();" value="<?php if($Mainid!=""){echo $fetchLead['PinCode'];} ?>"  placeholder="Pincode *" required >
                                </div>
                            </div>
                            
                            
                             <div class="form-row">
                             <div class="form-group col-md-6">
                                <label for="inputAddress2">State</label>
                       <input type="text" class="form-control" id="Primary_State" name="Primary_State" placeholder="State *"  readonly value="<?php if($Mainid!=""){echo $fetchLead['State'];} ?>" required >
                        
                          
                        
                        <!-- <select class="form-control"  name="Primary_State" id="Primary_State" onchange="modelnos()" required>
                                        <option value=" ">Select State</option>
                                        
                                      
                                          <?php if($Mainid!=""){
                                            $qeryState=mysqli_query($conn,"select * from state where 1=1 ");
                                            while($Statefetch=mysqli_fetch_array($qeryState)){?>
                                      <option value="<?php echo $Statefetch['state_id'];?>" id="<?php echo $Statefetch['state_id'];?>" <?php if($Mainid!=""){ if($Statefetch['state']==$fetchState['state']) { ?>selected <?php }} ?>><?php echo $Statefetch['state'];?></option><?php } ?>
                                           <?php } ?>
                                          </select>-->
                        
                        
                            </div>
                            
                              <div class="form-group col-md-6">
                                <label for="inputAddress2">City</label>
                              <input type="text" class="form-control" id="Primary_City" name="Primary_City" placeholder="city *"  value="<?php if($Mainid!=""){echo $fetchLead['City'];} ?>" readonly required >
                         <!--<select class="form-control" name="Primary_City" id="Primary_City" onfocus="modelnos()" required>
                                       <option value=" ">Select City</option>
                                   
                                       <option id="Pune" value="Pune" selected="selected">Pune</option>
                                </select>-->
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
                                    <input type="text" class="form-control"  name="Primary_mcode2" id="Primary_mcode2" maxlength="3"   value="+<?php if($Mainid!=""){echo $fetchLead['MobileCode2'];} ?>"  placeholder="eg. 91" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Mobile number *</label>&nbsp;<label id="label5"></label>
                                    <input type="text" class="form-control" id="Primary_mob2" name="Primary_mob2" maxlength="10"  value="<?php if($Mainid!=""){echo $fetchLead['MobileNumber2'];} ?>"  placeholder="Mobile number"  >
                                </div>
                            </div>
                            
                            
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Code</label>
                                    <input type="text" class="form-control" name="Primary_Contact1code" id="Primary_Contact1code" value="<?php if($Mainid!=""){echo $fetchLead['contact1Code'];}else{ echo "022"; } ?>" maxlength="3" placeholder="eg. 022" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact Number1</label>
                                    <input type="text" class="form-control" id="Primary_Contact1" name="Primary_Contact1" maxlength="10" value="<?php if($Mainid!=""){echo $fetchLead['ContactNo1'];} ?>" placeholder="Contact Number 1"  >
                                </div>
                            </div>
                            
                           
                           <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Code</label>
                                    <input type="text" class="form-control" name="Primary_Contact2code" id="Primary_Contact2code" value="<?php if($Mainid!=""){echo $fetchLead['contact2Code'];}else{ echo "022"; } ?>"  maxlength="3" placeholder="eg. 022" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact Number2</label>
                                    <input type="text" class="form-control" id="Primary_Contact2" name="Primary_Contact2" maxlength="10" value="<?php if($Mainid!=""){echo $fetchLead['ContactNo2'];} ?>"  placeholder="Contact Number 2"  >
                                </div>
                            </div>
                            
                            
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Code</label>
                                    <input type="text" class="form-control" name="Primary_Contact3code" id="Primary_Contact3code" value="<?php if($Mainid!=""){echo $fetchLead['contact3Code'];}else{ echo "022"; } ?>" maxlength="3" placeholder="eg. 022" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact Number3</label>
                                    <input type="text" class="form-control" id="Primary_Contact3" name="Primary_Contact3" value="<?php if($Mainid!=""){echo $fetchLead['ContactNo3'];} ?>"  maxlength="10"  placeholder="Contact Number3"  >
                                </div>
                            </div>
                            
                            
                            
                             <div class="form-group ">
                                    <label for="inputPassword4">Name on the Card</label>
                                    <input type="text" class="form-control" id="Primary_nameOnTheCard" name="Primary_nameOnTheCard" value="<?php if($Mainid!=""){echo $fetchMem['Primary_nameOnTheCard'];} ?>" maxlength="22"  placeholder="22 Characters including spaces" required >
                                </div>
                            
                            <div class="form-group " style="display:none">
                                    <label for="inputPassword4">Photo Upload</label>
                                    <input type="file" class="form-control" id="Primary_PhotoUpload" name="Primary_PhotoUpload"   >
                                </div>
                            <div class="form-group ">
                                    <label for="inputPassword4">Email-ID 2(Gmail)</label>
                                    <input type="email" class="form-control" id="Primary_Email_ID2" name="Primary_Email_ID2"  placeholder="Email-ID " value="<?php if($Mainid!=""){echo $fetchMem['Primary_Email_ID2'];} ?>" >
                                </div>
                            
                            
                            <div class="form-group ">
                                    <label for="inputPassword4">Date Of Birth</label>
                                    <input type="text" class="form-control" id="Primary_DateOfBirth"  name="Primary_DateOfBirth" value="<?php if($Mainid!=""){  $c=$fetchMem['Primary_DateOfBirth']; if($c=="0000-00-00"){echo "0000-00-00";}else{  echo date("d-m-Y", strtotime($c)); }} ?>"  placeholder="dd-mm-yyyy" required />
                                </div>
                            
                            
                             <div class="form-group ">
                                    <label for="inputPassword4">Anniversary</label>
                                    <input type="text" class="form-control" id="Primary_Anniversary"  name="Primary_Anniversary" value="<?php if($Mainid!=""){  $cc=$fetchMem['Primary_Anniversary']; if($cc=="0000-00-00"){echo "0000-00-00";}else{  echo date("d-m-Y", strtotime($cc)); } } ?>" placeholder="dd-mm-yyyy" required >
                                </div>
                            
                             
                                <div class="form-group">
                                 <!-- Textboxid,tableName,Column,id,name,setDropdwon-->
                                             <label for="inputEmail4">Address Type 1</label>
                                    <select class="form-control"  name="Primary_AddressType1" id="Primary_AddressType1" required >
                                        <option value="">Select Type *</option>
                                        <option value="Business" <?php  if($fetchMem['Primary_AddressType1']=="Business"){?>Selected <?php } ?> >Business</option>
                                        <option value="Residence" <?php  if($fetchMem['Primary_AddressType1']=="Residence"){?>Selected <?php } ?> >Residence</option>
                                         </select> 
                                          
                                </div>
                                   <div class="form-group">
                                   <label for="inputPassword4">Address</label>
                                   <input type="text" class="form-control" id="Primary_BuldNo_addrss" name="Primary_BuldNo_addrss" value="<?php if($Mainid!=""){echo $fetchMem['Primary_BuldNo_addrss'];} ?>"  placeholder="Buld No./Room NO."  >
                              
                                </div>
                                
                               <div class="form-group">
                                   <label for="inputPassword4">Address</label>
                                   <input type="text" class="form-control" id="Primary_Area_addrss" name="Primary_Area_addrss" value="<?php if($Mainid!=""){echo $fetchMem['Primary_Area_addrss'];} ?>"   placeholder="Area/Location"  >
                              
                                </div>
                                <div class="form-group">
                                   <label for="inputPassword4">Address</label>
                                   <input type="text" class="form-control" id="Primary_Landmark_addrss" name="Primary_Landmark_addrss" value="<?php if($Mainid!=""){echo $fetchMem['Primary_Landmark_addrss'];} ?>"  placeholder="Landmark"  >
                              
                                </div>
                            
                             <div class="form-group ">
                                    <label for="inputPassword4">Marital Status</label>
                               <select class="form-control"  name="Primary_MaritalStatus" id="Primary_MaritalStatus"  onchange="setSpouseMember()" required>
                                        <option value="">Select Type *</option>
                                        <option id="Single" value="Single" <?php  if($fetchMem['Primary_MaritalStatus']=="Single"){?>Selected <?php } ?>>Single</option>
                                        <option id="Married" value="Married" <?php  if($fetchMem['Primary_MaritalStatus']=="Married"){?>Selected <?php } ?>>Married</option>
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
                                  <option value="<?php echo $fetchTitle['titleName'];?>"  <?php if($fetchTitle['titleName']==$fetchMem['Spouse_Title']){ ?>Selected <?php }?> ><?php echo $fetchTitle['titleName'];?></option>
                                 <?php } ?>
                                  </select>
                               </div>
                            
                            
                           <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">First Name</label>
                                    <input type="text" class="form-control" id="Spouse_FirstName" name="Spouse_FirstName"  value="<?php if($Mainid!=""){echo $fetchMem['Spouse_FirstName'];} ?>"  placeholder="First Name *"  >
                                </div> 
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Last Name</label>
                                    <input type="text" class="form-control" id="Spouse_LastName" name="Spouse_LastName" value="<?php if($Mainid!=""){echo $fetchMem['Spouse_LastName'];} ?>"  placeholder="Last Name *"  >
                                </div>
                            </div>
                            
                          
                            
                      
                            <div class="form-group">
                                <label for="inputAddress">Email</label>&nbsp;<label id="label3"></label>
                                <input type="email" class="form-control" id="Spouse_GmailMArrid1" name="Spouse_GmailMArrid1" value="<?php if($Mainid!=""){echo $fetchMem['Spouse_GmailMArrid1'];} ?>" placeholder="Email *"    >
                            </div>
                            
                             <div class="form-group">
                                <label for="inputAddress">Email-ID (Gmail)</label>&nbsp;<label id="label3"></label>
                                <input type="email" class="form-control" id="Spouse_GmailMArrid2" name="Spouse_GmailMArrid2" value="<?php if($Mainid!=""){echo $fetchMem['Spouse_GmailMArrid2'];} ?>" placeholder="Email-id (Gmail) *"    >
                            </div>
                      
                              <div class="form-group " style="display:none">
                                    <label for="inputPassword4">Photo Upload</label>
                                    <input type="file" class="form-control" id="Spouse_PhotoUpload" name="Spouse_PhotoUpload"   >
                                </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Mobile Code *</label>
                                    <input type="text" class="form-control"  name="Spouse_mcode1Married1" id="Spouse_mcode1Married1" value="+<?php if($Mainid!=""){echo $fetchMem['Spouse_mcode1Married1'];}else{echo "91";} ?>" maxlength="3"   value="+91"  placeholder="eg. 91" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Mobile number *</label>&nbsp;<label id="label5"></label>
                                    <input type="text" class="form-control" id="Spouse_mob1MArid1" name="Spouse_mob1MArid1" maxlength="10" value="<?php if($Mainid!=""){echo $fetchMem['Spouse_mob1MArid1'];} ?>" placeholder="Mobile number"  >
                                </div>
                            </div>
                            
                            
                                
                             <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Mobile Code *</label>
                                    <input type="text" class="form-control"  name="Spouse_mcode1Married2" id="Spouse_mcode1Married2" maxlength="3"   value="+<?php if($Mainid!=""){echo $fetchMem['Spouse_mcode1Married2'];}else{echo "91"; } ?>"  placeholder="eg. 91" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Mobile number *</label>&nbsp;<label id="label5"></label>
                                    <input type="text" class="form-control" id="Spouse_mob1MArid2" name="Spouse_mob1MArid2" maxlength="10" value="<?php if($Mainid!=""){echo $fetchMem['Spouse_mob1MArid2'];} ?>"  placeholder="Mobile number"  >
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Contact1 Code</label>
                                    <input type="text" class="form-control" name="Spouse_Contact1codeMArid" id="Spouse_Contact1codeMArid" maxlength="3" value="<?php if($Mainid!=""){echo $fetchMem['Spouse_Contact1codeMArid'];}else{echo "022";} ?>" placeholder="eg. 022" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact1 Number</label>
                                    <input type="text" class="form-control" id="Spouse_Contact1Married" name="Spouse_Contact1Married" maxlength="10" value="<?php if($Mainid!=""){echo $fetchMem['Spouse_Contact1Married'];} ?>"  placeholder="Contact1 For Married"  >
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Contact2 Code</label>
                                    <input type="text" class="form-control" name="Spouse_Contact2codeMArid" id="Spouse_Contact2codeMArid" value="<?php if($Mainid!=""){echo $fetchMem['Spouse_Contact2codeMArid'];}else{echo "022";} ?>" maxlength="3" placeholder="eg. 022" >
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Contact2 Number</label>
                                    <input type="text" class="form-control" id="Spouse_Contact2Married" name="Spouse_Contact2Married" maxlength="10" value="<?php if($Mainid!=""){echo $fetchMem['Spouse_Contact2Married'];} ?>" placeholder="Contact Number" >
                                </div>
                            </div>
                        
                            <div class="form-group ">
                                    <label for="Spouse_DateOfBirth">Date Of Birth</label>
                                    <input type="text" class="form-control" id="Spouse_DateOfBirth"  name="Spouse_DateOfBirth" value="<?php if($Mainid!=""){  $e=$fetchMem['Spouse_DateOfBirth']; if($e=="0000-00-00"){echo "0000-00-00";}else{  echo date("d-m-Y", strtotime($e)); }} ?>"  placeholder="dd-mm-yyyy" required />
                                </div>
                            
                            
                             <div class="form-group ">
                                    <label for="Spouse_nameOnTheCardMarried">Name on the Card</label>
                                    <input type="text" class="form-control" id="Spouse_nameOnTheCardMarried" name="Spouse_nameOnTheCardMarried" value="<?php if($Mainid!=""){echo $fetchMem['Spouse_nameOnTheCardMarried'];} ?>"  maxlength="22" placeholder="22 Characters including spaces"  >
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
                                    <input type="text" class="form-control" id="MembershipDetails_Level" name="MembershipDetails_Level" value="<?php echo $fetchStatic_LeadID1['level_name']; ?>" readonly>
                                 
                                </div>
                                 
                                <div class="form-group">
                                    <label for="inputEmail4">Membership Fee</label>
                                    <input type="text" class="form-control" id="MembershipDetails_Fee" name="MembershipDetails_Fee" value="<?php echo $fetchStatic_LeadID['MembershipDetails_Fee']; ?>" readonly>
                                   
                                 </div>
                        
                              
                                  <div class="form-group">
                                    <label for="inputEmail4">% Discount</label>
                                    <input type="text" class="form-control" id="MembershipDts_Discount" name="MembershipDts_Discount" value="<?php echo $fetchStatic_LeadID['MembershipDts_Discount']; ?>" readonly >
                                 </div>
                              
                                 
                                 <div class="form-group">
                                    <label for="inputEmail4">Net Payment</label>
                                    <input type="text" class="form-control" id="MembershipDts_NetPayment" name="MembershipDts_NetPayment"  value="<?php echo $fetchStatic_LeadID['MembershipDts_NetPayment']; ?>" readonly>
                                 </div>
                                 
                                  <div class="form-group">
                                    <label for="inputEmail4">GST @ 18%</label>
                                    <input type="text" class="form-control" id="MembershipDts_GST" name="MembershipDts_GST"  value="<?php echo $fetchStatic_LeadID['MembershipDts_GST']; ?>"  readonly>
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Gross Total</label>
                                    <input type="text" class="form-control" id="MembershipDts_GrossTotal" name="MembershipDts_GrossTotal"  value="<?php echo $fetchStatic_LeadID['MembershipDts_GrossTotal']; ?>" readonly >
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Payment Date</label>
                                    <input type="text" class="form-control" id="MembershipDts_PaymentDate" name="MembershipDts_PaymentDate" value="<?php if($Mainid!=""){  $ccc=$fetchStatic_LeadID['MembershipDts_PaymentDate'];if($ccc=="0000-00-00"){echo "0000-00-00";}else{  echo date("d-m-Y", strtotime($ccc));} } ?>" >
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Payment Mode</label>
                                <!--         <input type="text" class="form-control" id="MembershipDts_PaymentMode" name="MembershipDts_PaymentMode" value="<?php echo $fetchStatic_LeadID['MembershipDts_PaymentMode']; ?>"  >
                                -->  <select class="form-control"  name="MembershipDts_PaymentMode" id="MembershipDts_PaymentMode"   >
                                        <option value="">Select Mode *</option>
                                          <?php 
                                          $runLevel=mysqli_query($conn,"select * from Level where Leval_id='".$fetchMem['MembershipDetails_Level']."'");
                                          $fetchLevel=mysqli_fetch_array($runLevel);
                                          $runMode=mysqli_query($conn,"select * from MembershipPaymentMode where Program_ID='".$fetchLevel['Program_ID']."'");
                                          while($fetchMode=mysqli_fetch_array($runMode)){
                                          ?>
                                          <option value="<?php echo $fetchMode['Payment_mode'];?>" <?php  if($fetchMode['Payment_mode']==$fetchMem['MembershipDts_PaymentMode']){?>Selected <?php } ?>    ><?php echo $fetchMode['Payment_mode'];?></option>
                                          <?php } ?>
                                    </select> 
                                 
                                  </div>
                                 
                                  <div class="form-group">
                                    <label for="inputEmail4">Instrument Number</label>
                                    <input type="text" class="form-control" id="MembershipDts_InstrumentNumber" name="MembershipDts_InstrumentNumber" value="<?php echo $fetchStatic_LeadID['MembershipDts_InstrumentNumber']; ?>"  >
                                 </div>
                            
                                 <div class="form-group">
                                    <label for="inputEmail4">Bank Name</label>
                                    <input type="text" class="form-control" id="MemshipDts_BankName" name="MemshipDts_BankName" value="<?php echo $fetchStatic_LeadID['Member_bankName']; ?>" >
                                 </div>
                                 
                                  <div class="form-group">
                                    <label for="inputEmail4">Batch Number</label>
                                    <input type="text" class="form-control" id="MemshipDts_BatchNumber" name="MemshipDts_BatchNumber" value="<?php echo $fetchStatic_LeadID['MemshipDts_BatchNumber']; ?>" >
                                 </div>
                                 
                                 
                                 <div class="form-group">
                                    <label for="inputEmail4">Remarks</label>
                                    <input type="text" class="form-control" id="MemshipDts_Remarks" name="MemshipDts_Remarks"  value="<?php echo $fetchStatic_LeadID['MemshipDts_Remarks']; ?>" >
                                 </div>
                            
                            
                            <div class="form-group">
                                    <label for="inputEmail4">GST NO.</label>
                                    <input type="text" class="form-control" id="MemshipDts_GST_number" name="MemshipDts_GST_number" value="<?php if($fetchStatic_LeadID['GST_Number']!=""){echo $fetchStatic_LeadID['GST_Number'];} ?>"   placeholder='GST NO.' >
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
                                <div class="bg-dark" style="color:white;display:none">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 4. Documentation</div>
                             
                                 <div class="form-group" style="display:none">
                                    <label for="inputEmail4">Upload Signatures</label>
                                    <input type="file" class="form-control" id="Documentation_UploadSignatures" name="Documentation_UploadSignatures"  >
                                 </div>
                                 
                               
                                 <div class="form-group" style="display:none">
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
                                    <input type="text" class="form-control" name="Relationships_ReferredByLEADID" id="Relationships_ReferredByLEADID" value="<?php echo $fetchMem['Relationships_ReferredByLEADID']; ?>"  placeholder="Referred by LEAD ID" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Referred by MEMBERSHIP ID</label>
                                    <input type="text" class="form-control" id="Relationships_ReferredByMEMBERSHIPID" name="Relationships_ReferredByMEMBERSHIPID" value="<?php echo $fetchMem['Relationships_ReferredByMEMBERSHIPID']; ?>" placeholder="Referred by MEMBERSHIP ID"  required>
                                </div>
                            </div>
                                
                                
                                   <!--======================== Part 5 Relationships (End)================================--->
                                
                                <br /><br />
                                
                                
                                
                                
                                
                                
                                      <!--======================== Part 6 Issue Membership (start)================================--->
                              <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part 6. Issue Membership</div>
                        
                             
                             
                              <div class="custom-control custom-checkbox" style="display:none">
                                    <input type="checkbox" class="custom-control-input" id="itemCheck1" name="itemCheck1" <?php if($fetchMem['itemCheck1']!=""){?>checked <?php }?>>
                                    <label class="custom-control-label" for="itemCheck1">Check this item</label>
                                </div>
                             
                             <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="BookletCheck1" name="BookletCheck1" <?php if($fetchMem['BookletCheck1']!=""){?>checked <?php }?> >
                                    <label class="custom-control-label" for="BookletCheck1">Issue Booklet</label>
                                </div>
                             
                              <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="CertificatesCheck1" name="CertificatesCheck1" <?php if($fetchMem['CertificatesCheck1']!=""){?>checked <?php }?>>
                                    <label class="custom-control-label" for="CertificatesCheck1">Issue Certificates</label>
                                </div>
                             
                             
                               <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="PromotionalCheck1" name="PromotionalCheck1" <?php if($fetchMem['PromotionalCheck1']!=""){?>checked <?php }?>>
                                    <label class="custom-control-label" for="PromotionalCheck1">Issue Promotional Certificate</label> 
                                </div>
                            
                            
                             <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Referred by LEAD ID</label>
                                    <input type="text" class="form-control" name="Issue_ReferredByLEADID" id="Issue_ReferredByLEADID"  placeholder="Referred by LEAD ID" value="<?php echo $fetchMem['Issue_ReferredByLEADID']; ?>" required >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Referred by MEMBERSHIP ID</label>
                                    <input type="text" class="form-control" id="Issue_ReferredByMEMBERSHIPID" name="Issue_ReferredByMEMBERSHIPID" value="<?php echo $fetchMem['Issue_ReferredByMEMBERSHIPID']; ?>" placeholder="Referred by MEMBERSHIP ID" required >
                                </div>
                            </div>
                            
                                
                            
                             
                                <!--======================== Part 6 Issue Membership (End)================================--->
                             
                                
                            
<br />



<script>
                    $('input').attr('readonly', true); 
                    $('select').attr('readonly', true); 
</script>
                          
                        </div>

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