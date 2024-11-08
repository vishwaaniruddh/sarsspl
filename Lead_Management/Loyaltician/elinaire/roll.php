<?php Session_Start();?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include('header.php');
include('config.php');
?>
 <link rel="stylesheet" href="multipledropdown.css">

<style>
    

.multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
   
  
}
.ms-options-wrap > button > span {
    display: inline-block;
}

</style>
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
    function validation()
{
    var lstStates=document.getElementById("lstStates").value;
     var Roll=document.getElementById("Roll").value;
     
   
     if(lstStates=="")
     {
     swal("drop down  can not be empty");
     return false;
     } 
    else if(Roll=="")
     {
     swal("Roll can not be empty");
     return false;
     } 
    
     else{
 
     //sumitfunc();
     return true;
     
          }
          
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

                        <h4 class="">  Roll Creation
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
                                 Roll Entry
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <form id="myForm" method="post" action="roll_process.php"  onsubmit="return validation()" >
                        <div class="card-body ">
                     
                          <div class="form-group">
                                <label for="inputAddress">Roll Name</label>&nbsp;
                                <input type="text" class="form-control" id="Roll" name="Roll" placeholder="Roll Name *"  required>
                                 <input type="hidden" name="drop" id="drop"/>
                            </div>
                                 
                                              <div class="form-group">
                                <label for="inputAddress">Permission</label>&nbsp;
                                 <select name="lstStates" multiple="multiple" id="lstStates" class="form-control" onchange="per()" required>
          
            <optgroup label="Masters">
         <optgroup label=" ">
        <option value="1">Name Title</option>
        <option value="2">Brand</option>
         <option value="3">Hotel</option>
          <option value="4">Program</option>
           <option value="5">Participating Hotels</option>
            <option value="6">Outlets</option>
             <option value="7">Level</option>
            <option value="8">Lead Source</option>
      
      
      <optgroup label="Rules">
         <optgroup label=" ">
        <option value="9">validity</option>
        <option value="10">Voucher Booklet Series</option>
        <option value="11">Voucher Details/Type</option>
         </optgroup>
          </optgroup>
          
          
          <optgroup label="Member">
         <optgroup label=" ">
        <option value="12">Membership Type</option>
       <option value="13">Membership Number Series</option>
        <option value="14">Primary Membership Fee</option>
        <option value="15">Other Membership Fee</option>
        <option value="16">Membership Payment Mode</option>
       <option value="17">Payment Receipt</option>
        <option value="18">Close Lead Masters</option>
        <option value="19">Close Renewal Masters</option>
         </optgroup>
          </optgroup>
      
      
      <optgroup label="Benefits ">
         <optgroup label=" ">
        <option value="20">Card Benefits</option>
        <option value="21">Card Benefits View</option>
        <option value="22">Certificate Benefits</option>
        <option value="23">Certificate Benefits View</option>
        <option value="24">Renewal Benefit</option>
        <option value="25">Renewal Benefit View</option>
         </optgroup>
          </optgroup>
          
          
           <optgroup label="Users ">
         <optgroup label=" ">
        <option value="26">Add user</option>
        <option value="27">Add Roll</option>
        </optgroup>
          </optgroup>
      
      
       <optgroup label="View Forms ">
         <optgroup label=" ">
        <option value="28">Brand</option>
        <option value="29">Hotel</option>
        <option value="30">Program</option>
        <option value="31">services</option>
        <option value="32">Level</option>
        <option value="33">Leadsource</option>
        <option value="34">Validity</option>
        <option value="35">Voucher Booklet</option>
         <option value="36">Voucher Type</option>
        <option value="37">Membership Type</option>
        <option value="38">Membership Number Series</option>
        <option value="39">Primary Membership Fee</option>
       <option value="40">Supplementary Membership Fee</option>
       <option value="41">Membership Payment Mode</option>
        <option value="42">Payment Receipt</option>
        <option value="43">Close Lead Masters</option>
        <option value="44">Close Renewal Reason</option>
       
         </optgroup>
          </optgroup>
      
      
      
      
      
         </optgroup>
          </optgroup>
      
      
      
      
       <optgroup label="Members">
         <optgroup label=" ">
        <option value="45">New Member Create </option>
         </optgroup>
          </optgroup>
      
          
           <optgroup label="Leads">
         <optgroup label=" ">
        <option value="46">New Prospect</option>
        <option value="47">View Prospect</option>
         <option value="48">Suspend Leads</option>
        <option value="49">View Member</option>
        <option value="50">View Prospect Sales</option>
         </optgroup>
          </optgroup>
      
      
      
          
            <optgroup label="Import">
         <optgroup label=" ">
        <option value="51">Lead Data Import</option>
        <option value="52">POS Data Import</option>
         </optgroup>
          </optgroup>
          
           <optgroup label="Campaign">
         <optgroup label=" ">
        <option value="53">..</option>
        <option value="54">...</option>
         </optgroup>
          </optgroup>
          
          
          
            <optgroup label="Reports">
         <optgroup label=" ">
        <option value="55">DSR</option>
        <option value="56">DER</option>
         </optgroup>
          </optgroup>
      
      
          
          
          
    <optgroup label="Lead Entry">
         <optgroup label=" ">
        <option value="12">Add Lead Entry</option>
        <option value="13">View Lead</option>
       <!-- <option value="15">bulk upload lead</option>-->
         </optgroup>
          </optgroup>
          
              
          
           <optgroup label="Users">
               </optgroup>
                <optgroup label=" ">
                <option value="11">Create roll</option>    
                <option value="10">Add User</option>
               <!-- <option value="5">View User</option>-->
               </optgroup>
               
               
              <!-- <optgroup label="Employee">
               </optgroup>
        <optgroup label="">
            <option value="6">Add Employee</option>
            <option value="7">View Employee</option>
            <option value="8">bulk upload Employee</option>
           
        </optgroup>-->
         
       <!--  <optgroup label="Lead Update">
               </optgroup>
        <optgroup label="">
            <option value="9">Update Lead</option>
            <option value="10">View Update</option>
            
        </optgroup>
          
          
           <optgroup label="Lead Sources">
               </optgroup>
        <optgroup label="">
            <option value="11">Add Lead source</option>
            <option value="12">View Lead source</option>

        </optgroup>-->
        
        <optgroup label="Masters">
               </optgroup>
                <optgroup label=" ">
                <option value="2">Services/Outlet</option>    
                <option value="3">Brand</option>
                <option value="4">Hotel</option>
                <option value="5">Program</option>    
                <option value="6">Level</option>
                <option value="14">Lead Source</option>
               </optgroup>
               <optgroup label="Rules">
               </optgroup>
                <optgroup label=" ">
                <option value="7">validity</option>    
                <option value="8">Voucher Booklet Series</option>
                <option value="9">Voucher Details/Type</option>
               
               
               </optgroup>
        
    </select>   
     
                                 
                                 
                                 
                                 
                                 
                                 
                               </div>
                                        
                        
                           <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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


<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>


 <script>
 
   
 function per(){
    
   var obj = myForm.lstStates,
        options = obj.options, 
        selected = [], i, str;
   
    for (i = 0; i < options.length; i++) {
        options[i].selected && selected.push(obj[i].value);
    }
    
    str = selected.join();
    
    // what should I write here??
   // alert("Options selected are " + str);
  
document.getElementById("drop").value=str;
 }
 
 
    $(function () {
    $('#lstStates').multiselect({
        buttonText: function(options){
          if (options.length === 0) {
              return 'No option selected ...';
           }
           var labels = [];
           options.each(function() {
               if ($(this).attr('value') !== undefined) {
                   labels.push($(this).attr('value'));
               } 
            });
            return labels.join(', ');  
         }
    }); 
});
</script>



</body>
</html>


