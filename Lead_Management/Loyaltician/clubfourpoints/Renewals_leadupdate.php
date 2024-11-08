<?php session_start();
include('config.php');

$leadid=$_REQUEST['id'];
$sql="select * from Leads_table where Lead_id='".$leadid."'";
$runsql=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($runsql);
 
$number0=explode('-',$row['MobileNumber']) ;
$number1=explode('-',$row['ContactNo1']) ;
$number2=explode('-',$row['ContactNo2']) ;
$number3=explode('-',$row['ContactNo3']) ;

$sql2="select state from state where state_id='".$row['State']."'";
$runsql2=mysqli_query($conn,$sql2);
$sqlfetch=mysqli_fetch_array($runsql2);
//print_r($number1);


?>
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
    function validation()
{
    
    var status= document.getElementById("status").value; 
    var ClosedReason= document.getElementById("ClosedReason").value;
     var Comments= document.getElementById("Comments").value;
  // alert(Comments);
   if(status==""){
       swal("Please select status");
       return false;
   }
   
   if(Comments==" "){
       swal("Please Enter comment");
       return false;
   }else{
   
     if(status==2){
         if(ClosedReason==""){
             swal("Please Select Close Reason ");
              return false;
         }
         else{
              sumitfunc();
     return true;
         }
     }
     
     else{
 //alert("hi")
     sumitfunc();
     return true;
     
          }
   }
}

$( function() {
    $( "#dt1" ).datepicker();
        $( "#dt1" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
        $( "#dt1" ).datepicker( "option", "showAnim", "fold" );
        $( "#dt1" ).datepicker( "option", "minDate", '-0m -0w' );
  } );
</script>
<script>
    function sumitfunc(){
     var leadid= document.getElementById("leadid").value; 
     var FirstName= document.getElementById("FirstName").value;
     var LastName= document.getElementById("LastName").value;
     var Comments= document.getElementById("Comments").value;
     var status= document.getElementById("status").value;
     var dt1= document.getElementById("dt1").value; 
     var ClosedReason= document.getElementById("ClosedReason").value;
    //  alert(ClosedReason)
            $.ajax({
   type: 'POST',    
   url:'updateRenewal_lead_process.php',
   
    data:'leadid='+leadid+'&FirstName='+FirstName+'&LastName='+LastName+'&Comments='+Comments+'&status='+status+'&dt1='+dt1+'&ClosedReason='+ClosedReason,

   success: function(msg){
    
    
   //alert(msg);
 if(msg==1){
     swal("successfully Updated");
     window.open("RenewalsLeadupdatebysales.php","_self");
 }else{
     swal("error");
 }
   
   
} })
            }
</script>




</head>
<body class="sidebar-pinned">

<?php include("vertical_menu.php")?>


<main class="admin-main">
    <!--site header begins-->
<?php include("navbar.php")?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class="">  Update Renewal Leads
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
                                 Update Renewal Leads 
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <div class="card-body ">
                            
                            
                            <!--<form action="process_renewal_lead.php" method="post">-->
                                
                            
                            
                      
                                <div class="form-group ">
                                    <label for="inputEmail4">Member Id </label>
                                    <input type="text" class="form-control" id="leadid"  value="<?php echo $leadid;?>" name="leadid" placeholder="Lead Id *" required="true" readonly>
                                </div>
                               

                      
                            
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Member Name</label>
                                    <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="First Name *" value="<?php echo $row['FirstName'];?>" readonly required>
                               </div>
                                <div class="form-group col-md-6">
                                   <label for="inputEmail4">Member Last Name</label>
                                    <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Last Name " value="<?php echo $row['LastName'];?>" readonly required>
                                 </div>
                            </div>
                            
                             
                                <div class="form-group">
                                    <label for="inputEmail4">Comments</label>
                                <textarea id="Comments" name="Comments" class="form-control" rows="4" cols="50" required> </textarea>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="inputPassword4">Status</label>
                              <select class="form-control" name="status" id="status" onchange="abc()">
                              <option value="">select status</option>
                              <option value="1">open</option>
                              <option value="2">close</option>
                              <option value="3">Suspense</option>
                              <option value="7">Ready To Renew</option>
                              <!--<option value="4">Payment Received</option>-->
                              </select> 
                                </div>
                            
                            <div class="form-group" id="UpTime" style="display:none" >
                                <label for="inputAddress">Next Update Time</label>
                                <input type="text" name="dt1" id="dt1" class="form-control" Placeholder="dd-mm-yyyy"> 
                            </div>
                            

                            <div class="form-group" style="display:none" id="showonclose">
                                <label for="inputAddress">Closed Reason</label>
                                    <select class="form-control" name="ClosedReason" id="ClosedReason">
                              <option value=" ">select status</option>
                              <?php $qrycolse=mysqli_query($conn,"select * from CloseLead");
                                    while($qfetch=mysqli_fetch_array($qrycolse)){
                              ?>
                               <option value="<?php echo $qfetch['CloseLeadReason'];?>" id="<?php echo $qfetch['CloseLeadReason'];?>"><?php echo $qfetch['CloseLeadReason'];?></option>
                               <?php } ?>
                              </select> 
                               <!-- <input type="text" class="form-control" id="ClosedReason" name="ClosedReason" placeholder="Closed Reason *"  required>-->
                            </div>
                           
<br />
                          
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" onclick="validation()">Update</button>
                            </div>
                            <!--</form>-->
                        </div>
                    </div>
                    <!--widget card ends-->

                                     


                </div>
            
            
            <div class="col-md-6">
                 <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                 Previous Comments 
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        
                        <div class="card-body ">
                            <?
                            $get_pre_sql = mysqli_query($conn,"select * from RenewalLeadUpdates where leadId='".$_GET['id']."' order by UpdateId desc");
                            
                            while($get_pre_sql_result = mysqli_fetch_assoc($get_pre_sql)){ ?>
                                
                                    <div>
                                        <label>Comments: </label>
                                        <p><?php echo $get_pre_sql_result['Comments'];?></p>
                                    </div>
                                    
                                    <div>
                                        <label>Update Time :</label>
                                        <p><?php echo $get_pre_sql_result['UpdateTime'];?></p>
                                    </div>
                                    
                                    <?php if(!empty($get_pre_sql_result['closeReason']) || $get_pre_sql_result['closeReason']!=" " || $get_pre_sql_result['closeReason'] != NULL){ ?>
                                        <div>
                                            <label>Close Reason</label>
                                           
                                            <p><?php echo $get_pre_sql_result['closeReason'];?></p>
                                        </div>                                        
                                    <?php } ?>

                                    
                                    
                                    <hr>

                            <?php } ?>
                        </div>
                </div>
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
  
<!--page specific scripts for demo-->
</body>
</html>


<script>
    
function abc(){
var a =document.getElementById('status').value;

if(a==2){
    $("#showonclose").show();
    
    $("#UpTime").hide();
     $("#dt1").val("");

}
else if(a==7){
     $("#UpTime").hide();
     $("#dt1").val("");
     $("#showonclose").hide(); 
      $('#ClosedReason').prop('selectedIndex',0);
}
else{
   
    $("#UpTime").show();
   $("#showonclose").hide(); 
   $('#ClosedReason').prop('selectedIndex',0);
}

/*if(a==7){
     $("#UpTime").hide();
}else{
     $("#UpTime").show();
}*/


}
</script>