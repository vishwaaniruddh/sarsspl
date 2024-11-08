<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('header.php');
include('config.php');
?>
<!--=====================multiselect=============-->
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

<!--==================================-->

 <!--============================ ck Editor ===============-->
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="adstyle.css" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
    <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">-->
    <script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
    
     <!--============================ ck Editor ===============-->

<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 

 

 $( function() {
    $( "#Primary_DateOfBirth" ).datepicker();
        $( "#Primary_DateOfBirth" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
        $( "#Primary_DateOfBirth" ).datepicker( "option", "showAnim", "fold" );
   
  } );

function chkIndividual(){
 var ddl=  document.getElementById('Membership_Level').value;
if(ddl=='Individual'){
    $("#hd_mul").show();
}else{
    $("#hd_mul").hide();
}


if(ddl=="Geographycal"){
    
 $("#hd_geo").show();
}else{
    $("#hd_geo").hide();
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

                        <h4 class="">  News Letter
                        </h4>
                      

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
                               Send News Letter
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        
                        
                        <form id="myForm" method="POST" action="news_r.php" target="_blank" enctype="multipart/form-data" >
                        <div class="card-body">
                               
                                <div class="form-group ">
                                    <label for="Subject">Subject For Mail</label>
                                    <input type="text" class="form-control" id="Subject" name="Subject" required  >
                                </div>
                               
                                <div class="form-group ">
                                    <label for="inputPassword4">Level</label>
                                    <select class="form-control"  name="Membership_Level" id="Membership_Level" onchange="chkIndividual()" required>
                                          <option value="">Select Level *</option>
                                          <option value="All">All</option>
                                           <?php
                                         $levelQry="select * from Level where 1=1";
                                         
                                          $runlevel=mysqli_query($conn,$levelQry);
                                          while($fetchLevel=mysqli_fetch_array($runlevel)){?>
                                          <option value="<?php echo $fetchLevel['Leval_id'];?>"><?php echo $fetchLevel['level_name'];?></option>
                                          <?php } ?>
                                          <option value="Male"> Male</option>
                                          <option value="Female"> Female</option>
                                          <option value="Geographycal"> Geographycal</option>
                                          <option value="NoVisitLast3Month">No Visit Last 3 Month</option>
                                          <option value="Individual">Individual mail send</option>
                                       
                                  </select>
                                </div>
                            
                            <div class="form-group " id="hd_geo" style="display:none">
                                <input type="text" name="GeoPincode" id="GeoPincode" class="form-control " placeholder="Enter Pincode">
                            </div>

                            <!--<select name="lstStates"  >-->
          
                              
                                      
                            <div class="form-group " id="hd_mul" style="display:none">
                            <input type="hidden" name="drop" id="drop"/>
                            
                            <select name="lstStates" multiple="multiple" id="lstStates" class="form-control" onchange="per()"  >
          
                            <optgroup label="Membership Number">
                            <optgroup label=" ">
                                     <?php 
                                      
                                      $abc="select VoucherBookletNumber,MembershipNumber from voucher_Details where 1=1 order by MembershipNumber";
                                      
                                      $runabc=mysqli_query($conn,$abc);
                                      while($fetch=mysqli_fetch_array($runabc)){
                                      
                                       $View1="select Primary_nameOnTheCard from Members where GenerateMember_Id='".$fetch['MembershipNumber']."'";
 	                                   $qrys1=mysqli_query($conn,$View1);
                                       $fetchMem=mysqli_fetch_array($qrys1);
                                      
                                      ?>
                                      <option value="<?php echo $fetch['MembershipNumber'];?>"><?php echo $fetch['MembershipNumber']."          ".$fetchMem['Primary_nameOnTheCard'];?></option>
                                       <
                                      
                                     <?php } ?>
                                     </optgroup>
               </optgroup>
                                      </select>
                            </div>
                            
                            
                                <div class="form-group ">
                                    <label for="inputPassword4">Message</label>
                                    <textarea   id="editor" name="editor"></textarea>
                                </div>
                        
                            <div class="form-group ">
                                    <label for="inputPassword4">Photo Upload</label>
                                    <input type="file" class="form-control" id="Primary_PhotoUpload" name="Primary_PhotoUpload"   >
                                </div>
                           
                             
<br />
                          
                            <div class="form-group">
                                <input  type="submit" class="btn btn-primary" target="_blank" value="Review"/>
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
  
  
<!--=================================ck editor=======================-->
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <script type="text/javascript" src="script.js"></script>-->
<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
	<script src="ckeditor/samples/js/sample1.js"></script>
<script>
	initSample();
	//	initSample1();
		
</script>
<!--=================================ck editor=======================-->

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