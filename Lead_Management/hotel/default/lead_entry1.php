<?php Session_Start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('header.php');
include('config.php');
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

</script>

<script>
    
    function modelnos() {
//alert("hello");

var state=document.getElementById("state").value;
//alert(state);
                $.ajax({
                    type:'POST',
                    url:'city.php',
                     data:'state='+state,
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                        var newoption=' <option value="">Select</option>' ;
                        $('#City').empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'   >'+jsr[i]["modelno"]+'</option> ';
		
                        
                        }                       
                     	$('#City').append(newoption);
 
                    }
                })
                
            }
            
            
           
</script>
<script>


        var bool = false;

        function chkmailexs() {
            
            var email = document.getElementById('Gmail').value;
            if (email != "") {
                var exs = "0";
                //alert(email);
                $.ajax({
                    type: 'POST'
                    , url: 'checkemail.php'
                    , data: "email=" + email+'&Table='+'Leads_table'+'&column='+'EmailId'
                    //, error: function () {}
                    , success: function (data) {
                       // alert(data);
                        if (data==1) {
                            swal("Email id Already Exists !");
                           document.getElementById("label3").innerHTML = "Email id Already Exists !";
                            document.getElementById("label3").style.color = "Red";
                            document.getElementById('email').focus();
                            bool = false;
                        }
                        else {
                            document.getElementById("label3").innerHTML = "";
                            bool = true;
                        }
                    }
                   /* , error: function (data) {
                        bool = false;
                    }*/
                });
            }
            /*else {
                bool = true;
            }*/
            return bool;
        }



    function validation()
{
    
     var FirstName= document.getElementById("FirstName").value;
     var LastName= document.getElementById("LastName").value;
     var mcode1= document.getElementById("mcode1").value;
     var mob1= document.getElementById("mob1").value;
     var Email = document.getElementById("Gmail").value;
     var LeadSource=document.getElementById('Source').value;
     var Pincode=document.getElementById('Pincode').value;
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


 var bool1 = false;
function chkmobile()
{


var mob=document.getElementById('mob1').value;
var mcode1= document.getElementById("mcode1").value;
if(mob!="")
{
  
//var exs="0";
//alert(email);
 $.ajax({
               
   type:'POST',  
   url:'checkMobile.php',
   
   data:'mob='+mob+'&mcode1='+mcode1+'&Table='+'Leads_table'+'&column='+'MobileNumber',
  /* error: function() {
      
   },*/
  async: false,
success: function(data) {

//alert(data);

if(data=="1")
{
swal("Mobile Number Already Exists !")
document.getElementById("label5").innerHTML="Mobile Number Already Exists !";
document.getElementById("label5").style.color="Red";
document.getElementById('mob').focus();
bool1 = false;
}
else
{
document.getElementById("label5").innerHTML="";
bool1 = true;
}

  }
  /*,error: function (data) {
            bool1 = false;
        }*/

});

}
/*else
{
bool1 = true;

}*/

return bool1;
}


function submitfun()
{//alert(chkmailexs())
//alert(chkmobile())
//alert(validation())
if(validation())

{
    if(chkmailexs())
    
    {
if(chkmobile())
{

sumitfunc();

}
}
}
}


</script>
<script>
    function sumitfunc(){
        
           $('#submitbtn').val('Please wait ...')
            .attr('disabled','disabled');
   
        
     var FirstName= document.getElementById("FirstName").value;
     var LastName= document.getElementById("LastName").value;
     var Contact1code= document.getElementById("Contact1code").value;
     var offNum= document.getElementById("offNum").value;
     var mcode1= document.getElementById("mcode1").value;
     var mob1= document.getElementById("mob1").value;
     var state= document.getElementById("state").value;
     var City= document.getElementById("City").value;
     var Company= document.getElementById("Company").value;
     var Designation= document.getElementById("Designation").value;
     var Gmail= document.getElementById("Gmail").value;
      var Source= document.getElementById("Source").value;
     var Pincode=document.getElementById('Pincode').value;
     
           $.ajax({
                   type: 'POST',    
                   url:'lead_entry1_process.php',
                   data:'FirstName='+FirstName+'&LastName='+LastName+'&Contact1code='+Contact1code+'&offNum='+offNum+'&mcode1='+mcode1+'&mob1='+mob1+'&state='+state+'&City='+City+'&Company='+Company+'&Designation='+Designation+'&Gmail='+Gmail+'&Source='+Source+'&Pincode='+Pincode,
                   async: false,
                   success: function(msg){
 //alert(msg);
 if(msg==1){
     swal({
  title: "Success!",
  text: "Thank you, the lead has been recorded.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
 
    window.open("lead_entry1.php","_self");
    
  } 
});
     
   
 }else{
   //  swal("error");
      window.open("lead_entry1.php","_self");
 }
   
   
} })
            }
</script>



</head>
<body class="sidebar-pinned">

<?php include("vertical_menu.php")?>


<main class="admin-main">
    <!--site header begins-->
<header class="admin-header">

    <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>

    <nav class=" mr-auto my-auto">
        <ul class="nav align-items-center">

            <li class="nav-item">
                <a class="nav-link  " data-target="#siteSearchModal" data-toggle="modal" href="#">
                    <i class=" mdi mdi-magnify mdi-24px align-middle"></i>
                </a>
            </li>
        </ul>
    </nav>
    <nav class=" ml-auto">
        <ul class="nav align-items-center">
           
            <li class="nav-item">
                <div class="dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-24px mdi-bell-outline"></i>
                        <span class="notification-counter"></span>
                    </a>

                    <div class="dropdown-menu notification-container dropdown-menu-right">
                        <div class="d-flex p-all-15 bg-white justify-content-between border-bottom ">
                            <a href="#!" class="mdi mdi-18px mdi-settings text-muted"></a>
                            <span class="h5 m-0">Notifications</span>
                            <a href="#!" class="mdi mdi-18px mdi-notification-clear-all text-muted"></a>
                        </div>
                        <div class="notification-events bg-gray-300">
                            <div class="text-overline m-b-5">today</div>
                            <a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body"> <i class="mdi mdi-circle text-success"></i> All systems operational.</div>
                                </div>
                            </a>
                            <a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body"> <i class="mdi mdi-upload-multiple "></i> File upload successful.</div>
                                </div>
                            </a>
                            <a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="mdi mdi-cancel text-danger"></i> Your holiday has been denied
                                    </div>
                                </div>
                            </a>


                        </div>

                    </div>
                </div>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#"   role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-sm avatar-online">
                        <span class="avatar-title rounded-circle bg-dark">V</span>

                    </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right"   >
                   <!-- <a class="dropdown-item" href="#">  Add Account
                    </a>
                    <a class="dropdown-item" href="#">  Reset Password</a>
                    <a class="dropdown-item" href="#">  Help </a>-->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"> Logout</a>
                </div>
            </li>

        </ul>

    </nav>
</header>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class="">  New Prospect
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
                                 Lead Entry
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <div class="card-body ">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">First Name</label>
                                    <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="First Name *" required="true">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Last Name</label>
                                    <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Last Name *" required>
                                </div>
                            </div>
                            
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Company</label>
                                    <input type="text" class="form-control" id="Company" name="Company" placeholder="Company Name " required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Designation</label>
                                    <input type="text" class="form-control" id="Designation" name="Designation" placeholder="Designation " required>
                                </div>
                            </div>
                            
                            

                            <div class="form-group">
                                <label for="inputAddress">Email</label>&nbsp;<label id="label3"></label>
                                <input type="email" class="form-control" id="Gmail" name="Gmail" placeholder="Email *" onblur="chkmailexs();" required>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">State</label>
                                <select class="form-control"  name="state" id="state" onchange="modelnos()" required>
                                        <option value=" ">Select State</option>
                                      
                                          <?php 
                                          
                                          $abc="select * from state ";
                                          
                                          $runabc=mysqli_query($conn,$abc);
                                          while($fetch=mysqli_fetch_array($runabc)){?>
                                          <option value="<?php echo $fetch['state_id'];?>" <?php if($fetch['state_id']=="1"){ ?> selected="selected"<? } ?>><?php echo $fetch['state']?></option>
                                         <?php } ?>
                                          </select>
                            </div>
                            
                              <div class="form-group">
                                <label for="inputAddress2">City</label>
                                <select class="form-control" name="City" id="City" required>
                                       <option value=" ">Select City</option>
                                       <option id="Pune" value="Pune" selected="selected">Pune</option>
                                </select>
                            </div>
                            
                          <div class="form-group">
                              <label>Pincode</label>
                              <input type="text" class="form-control" id="Pincode" name="Pincode" maxlength="10" onkeypress="return isNumber(event)" placeholder="Pincode" >
                          </div>
                          
                            
                            
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Mobile Code *</label>
                                    <input type="text" class="form-control"  name="mcode1" id="mcode1" maxlength="3" onblur="chkmobile();" value="+91" onkeypress="return isNumber(event)" placeholder="eg. 91" Required>
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Mobile number *</label>&nbsp;<label id="label5"></label>
                                    <input type="text" class="form-control" id="mob1" name="mob1" maxlength="10" onkeypress="return isNumber(event)" onblur="chkmobile();" placeholder="Mobile number" Required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="inputEmail4">Code</label>
                                    <input type="text" class="form-control" name="Contact1code" id="Contact1code" value="020" onkeypress="return isNumber(event)" maxlength="3" placeholder="eg. 022">
                                </div>
                                <div class="form-group col-md-8 col-sm-8">
                                    <label for="inputPassword4">Office Number</label>
                                    <input type="text" class="form-control" id="offNum" name="offNum" maxlength="10" onkeypress="return isNumber(event)" placeholder="Office Number" >
                                </div>
                            </div>
                            
                                 <div class="form-group" style="display:none">
                                    <label for="inputEmail4">Lead Source</label>
                                    <input type="text" name="Source" id="Source"  value="7"/>
                                    
                                 <!--<select class="form-control"name="Source" id="Source" >
                                  <option value=" ">Lead Source</option>
                                  <?php 
                                   $abc3="select * from Lead_Sources where Active='YES' ";
                                  $runabc3=mysqli_query($conn,$abc3);
                                  while($fetch3=mysqli_fetch_array($runabc3)){?>
                                  <option id="<?php echo $fetch3['SourceId'];?>" value="<?php echo $fetch3['SourceId'];?>"><?php echo $fetch3['Name']?></option>
                                 <?php } ?>
                                  </select>-->
                                
                                 </div>
                          
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="submitbtn" name="submitbtn" onclick="submitfun()">Submit</button>
                            </div>
                        </div>
                    </div>
                    <!--widget card ends-->

                                     


                </div>
              
            </div>


        </div>
    </section>
</main>

<div class="modal modal-slide-left  fade" id="siteSearchModal" tabindex="-1" role="dialog" aria-labelledby="siteSearchModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body p-all-0" id="site-search">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="form-dark bg-dark text-white p-t-60 p-b-20 bg-dots" >
                    <h3 class="text-uppercase    text-center  fw-300 "> Search</h3>

                    <div class="container-fluid">
                        <div class="col-md-10 p-t-10 m-auto">
                            <input type="search" placeholder="Search Something"
                                   class=" search form-control form-control-lg">

                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="bg-dark text-muted container-fluid p-b-10 text-center text-overline">
                        results
                    </div>
                    <div class="list-group list  ">


                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"   src="assets/img/users/user-3.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Eric Chen</div>
                                <div class="text-muted">Developer</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                                                    src="assets/img/users/user-4.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Sean Valdez</div>
                                <div class="text-muted">Marketing</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                                                    src="assets/img/users/user-8.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Marie Arnold</div>
                                <div class="text-muted">Developer</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar-title bg-dark rounded"><i class="mdi mdi-24px mdi-file-pdf"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">SRS Document</div>
                                <div class="text-muted">25.5 Mb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar-title bg-dark rounded"><i
                                                class="mdi mdi-24px mdi-file-document-box"></i></div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">Design Guide.pdf</div>
                                <div class="text-muted">9 Mb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar avatar-sm  ">
                                        <div class="avatar-title bg-primary rounded"><i
                                                    class="mdi mdi-24px mdi-code-braces"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">response.json</div>
                                <div class="text-muted">15 Kb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar-title bg-info rounded"><i
                                                    class="mdi mdi-24px mdi-file-excel"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">June Accounts.xls</div>
                                <div class="text-muted">6 Mb</div>
                            </div>


                        </div>
                    </div>
                </div>Form Control Sizes

            </div>

        </div>
    </div>
</div>


<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/vendor/popper/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/select2/js/select2.full.min.js"></script>
<script src="assets/vendor/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/vendor/listjs/listjs.min.js"></script>
<script src="assets/vendor/moment/moment.min.js"></script>
<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/atmos.min.js"></script>
<!--page specific scripts for demo-->
</body>
</html>