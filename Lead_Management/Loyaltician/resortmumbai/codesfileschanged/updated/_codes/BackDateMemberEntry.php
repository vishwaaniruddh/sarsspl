<?php session_start();
include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    
    
     
<script>
    
 function expfunc()
{

$('#formf').attr('action', 'delegation.php').attr('target','_self');
$('#formf').submit();

   }   


function toggle(source){
    
    chkboxes=document.getElementsByName('check[]');
    for(var i=0,n=chkboxes.length;i<n;i++){
        chkboxes[i].checked=source.checked;
        
    }
    
}




</script>

</head>
<body class="sidebar-pinned" onload="AutoLoad();">


<?php include("vertical_menu.php")?>
<main class="admin-main">
  <?php include('navbar.php');?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-40">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Member Back Date Entry
                        </h4>
                        

                    </div>
                </div>
            </div>
        </div><br /><br /><br />
<!-- <form  method="post" id="formf" action="delegation.php">-->
<form>
        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">


<div class="card-body">
     
                              
               
                       
                        <div class="form-row">
                                   
                                   <div class="form-group col-md-2">
                                      <label for="inputAddress2">Member ID</lable>
                                <input type="text" id="MemberId" name="MemberId"  class="form-control"  placeholder="Enter Member ID " required>
                                </div>
                               
                                <div class="form-group col-md-2">
                                      <label for="inputAddress2">Member Name</lable>
                                <input type="text" id="MemberName" name="MemberName"  class="form-control"  placeholder="Member Name " required>
                               </div>
                            
                               <div class="form-group col-md-2">
                                      <label for="inputAddress2">Entry Date</lable>
                                  <input class="form-control" id="EntryDt" name="EntryDt" data-large-mode="true" type="text"  readonly>
                               </div>
                               
                               <div class="form-group col-md-2">
                                      <label for="inputAddress2">Back Date Select</lable>
                                  <input class="form-control" id="backDt" name="backDt" data-large-mode="true"  type="text" style="background-color: white;" autocomplete="off">
                               </div>
                               
                                  
                               <div class="form-group col-md-4">
                                   <input type="button" class="btn btn-primary" style="height:30px;margin-top: 24px;padding-top: 2px;" onclick="submitBackdate()" value="Submit">
                             
                               </div>
                               
                             
                               
                               <div class="form-group col-md-2">
                                      <label for="inputAddress2">Level</lable>
                                       <input class="form-control " id="Level" name="Level" data-large-mode="true" type="text" readonly>
                            
                               </div>
                              
                               <div class="form-group col-md-2">
                                      <label for="inputAddress2">Membership Validity</lable>
                                  <input class="form-control " id="MembershipValidity" name="MembershipValidity" data-large-mode="true" type="text" readonly>
                               </div>
                               <div class="form-group col-md-2">
                                      <label for="inputAddress2">Designation</lable>
                                  <input class="form-control " id="Designation" name="Designation" data-large-mode="true" type="text" readonly>
                               </div>
                                <div class="form-group col-md-2">
                                      <label for="inputAddress2">Company</lable>
                                  <input class="form-control " id="Company" name="Company" data-large-mode="true" type="text" readonly>
                               </div>
                            
                             
                              </div>
                              
 <lable id="labl" style="color:red; font-size:16px;display:none">* Only Current month date can be backdate</lable>
  
    

     </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </section>

</main>

<?php include('belowScript.php');?>
<!--page specific scripts for demo-->
<!--<script src="assets/vendor/DataTables/datatables.min.js"></script>
<script src="assets/js/datatable-data.js"></script>-->


<script src="assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/vendor/datedropper/datedropper.min.js"></script>
<script src="assets/vendor/dropzone/dropzone.js"   ></script>
<script src="assets/vendor/jquery.mask/jquery.mask.min.js"></script>
<script src="assets/js/form-data.js"></script>

<script>

  
    function setMemberName(){
        var  Level=document.getElementById('Level_Filtter').value;
        
          $.ajax({
            type:'POST',    
            url:'setDropdownMember.php',
            data:'Level='+Level,
            success: function(msg){
          //  alert(msg);
            document.getElementById("example1").innerHTML=msg;
          
           
            } })
    }
    
    
   function submitBackdate(){
     
          var  EntryDt=document.getElementById('EntryDt').value;
          var  backDt=document.getElementById('backDt').value;
          var  MemberId=document.getElementById('MemberId').value;
          
          
          
            var EntryDate =  EntryDt.replace(/[/]/g , '-'); 
     
                  var newdate1 = EntryDt.split("/").reverse().join("-");
                  var $k= moment(newdate1).format('YYYY/MM/DD');
                  var day = moment($k).subtract(1, 'months').format('YYYYMM');
                   
                 
                 
                  var newdate2 = backDt.split("/").reverse().join("-");
                  var $k2= moment(newdate2).format('YYYY/MM/DD');
                  var day2 = moment($k2).format('YYYYMM');

               //   alert(day+ "===" +day2);
                  
                  if(day<=day2){
                   
     
          if(MemberId==""){
              alert("please Enter Member ID / Member Name");
          }
          else if(EntryDt==""){
              alert("Entry date can not be empty. ");
          }
          
          
          else if(backDt==""){
              alert("Please Select Back date . ");
          }
          else{
          
             
     
            
            $.ajax({
            type:'POST',    
            url:'BackDateMemberEntry_process.php',
            data:'MemberId='+MemberId+'&EntryDt='+EntryDate+'&backDt='+backDt,
            success: function(msg){
              //  alert(msg)
          if(msg=="1"){
              alert("Back date updated Successfully");
              window.open("BackDateMemberEntry.php","_Self")
          }else{
              alert("Error");
          }
           
            } })
   
          }
                  }else{
                      alert("only one month data can be back date");
                  }
}

function testdatatable(){
 $('#example').DataTable();
}
</script>

<!--======================Auto Complete Function Start =======================-->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" />

        
        <script>
        
        function getAllData(id,column){
           // alert(id)
            if(id!=""){
             $.ajax({
           type:'POST',
          url:'GetAllMemberDetails.php',
          data:"id="+id+'&column='+column,
          success:function(msg){
              //alert(msg);
              
               
               var jsr=JSON.parse(msg);
                
                 $('#MemberId').val(jsr[0]['m_id']);
                 $('#MemberName').val(jsr[0]['m_name']);
                 $('#EntryDt').val(jsr[0]['m_entrydt']);
                 $('#Level').val(jsr[0]['m_level']);
                 $('#MembershipValidity').val(jsr[0]['m_expiry']);
                 $('#Designation').val(jsr[0]['m_desig']);
                 $('#Company').val(jsr[0]['m_comp']);
                        
                        
                        EntryDt
 //=========for chk date is current  or not // (hide/show lable) ============= 
                          var d = new Date();
                          var df=d.getMonth()+1;
                          var Dj=""; if(df<10){ var Dj="0"+df; }
                         var str = jsr[0]['m_entrydt'];
                         var entrydd =  str.replace(/[/]/g , ''); 
                         var date1 = entrydd.substr(2);
                       
                       var selecteddate = str;
var datestr = selecteddate.split('/');

var month = datestr[1];
var day = datestr[0]; 
var year = datestr[2];

var currentdate = new Date();
var cur_month = currentdate.getMonth() + 1;
var cur_day =currentdate.getDate();
var cur_year =currentdate.getFullYear();

console.log('cur_month'+cur_month);
console.log('cur_day'+cur_day);
console.log('cur_year'+cur_year);
console.log('month'+month);

console.log('month'+month);
console.log('day'+day);
console.log('year'+year);


if(cur_month==month && day < 10)
{
                        $("#backDt").prop( "disabled", false );
                        $("#labl").hide();
                        $("#backDt").attr('style', 'background-color: white !important');
}
else
   {
    $("#backDt").val('');
                        $("#backDt").attr( "disabled", "disabled " );
                        $("#backDt").attr('style', 'background-color: red !important');
                        $("#labl").show();
   }   




                       
                    //   alert((Dj)+d.getFullYear() +' ' +date1 + '  '+ entrydd) ; 
                    // if((Dj)+d.getFullYear() != date1){
                    
                    // }else{

                    //     }
// ========================================================================
                        
                }
     })
        }}
        
        
        
        
        
         var mid=[];
         var mname=[];
    function AutoLoad(){
         $.ajax({
           type:'POST',
          url:'GetMemberId.php',
          data:"",
          success:function(msg){
            //  alert(msg);
              
               
               var jsr=JSON.parse(msg);
                for(var i=0;i<jsr.length;i++){
                           mid.push(jsr[i]['m_id']);
                           mname.push(jsr[i]['m_name']);
                }
                         
                   test();    
             
              
             
          }
      })
    }
        
         
       function test(){
  $("#MemberId").autocomplete({
    source:mid,
    minLength: 1
  });
  
   $("#MemberName").autocomplete({
    source:mname,
    minLength: 1
  });
 
  
}

$(document).ready(function () {
    $('#MemberId').on('autocompletechange change', function () {//alert(this.value)
         getAllData(this.value,'id');
        
    }).change();
    
    
     $('#MemberName').on('autocompletechange change', function () {//alert(this.value)
         getAllData(this.value,'name');
        
    }).change();
});

 $("#backDt").datepicker({ dateFormat: "dd/mm/yy",maxDate: -1  }).val()


</script>
    
<!--======================Auto Complete Function (End)=======================-->

</body>
</html>