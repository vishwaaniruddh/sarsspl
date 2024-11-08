<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
<script>
    
function searchfiltter(){
    
  //  var Ab_Filtter=document.getElementById('Ab_Filtter').value;
    var FromDt=document.getElementById('FromDt').value;
    var Todt=document.getElementById('Todt').value;
   
       if(FromDt==""){
          swal("Please Select From Date");
      }else if(Todt==""){
          swal("Please Select To Date");
      }else{
     
             $.ajax({
          
                    type:'POST',
                    url:'Leadpdf/Sheet.php',
                     data:'FromDt='+FromDt+'&Todt='+Todt,
                    
                    success:function(msg){
                       // alert(msg);
                    // swal(msg);
                     if(msg==1){
                           swal({
                      title: "Mail Send To Keval!",
                      text: "",
                      icon: "success",
                     // buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                     
                       window.open("Lable_Address.php","_self");
                        
                      } 
                    });
                         
                     }
                     else{
                         swal("error");
                     }
                       
                                         
                   
                    }
                })
    
     
      }
}

</script>

</head>
<body class="sidebar-pinned" id="rightclick">


<?php include("vertical_menu.php")?>
<main class="admin-main">
  <?php include('navbar.php');?>
  
    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Address Labels
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">
<?php include("config.php");
  //  $View="select * from Leads_table where leadEntryef='".$_SESSION['id']."'";
 	  $View="select * from Members where DATE(entryDate)='".date("Y-m-d")."'";
 	
      $qrys=mysqli_query($conn,$View);

?><form method="post" action="Leadpdf/Sheet.php"  target="_blank">
                        <div class="card-body">
                            
                                <div class="form-row">
                             <!--  <div class="form-group col-md-3">
                                  
                                  <select class="form-control" name="Ab_Filtter" id="Ab_Filtter" >
                                  <option value="">Select</option>
                                  <option value="DSR">DSR</option>
                                  <option value="Anniversary">Anniversary</option>
                                  <option value="Birthday">Birthday</option>
                                  </select>
                                  
                                  </div>-->
                                  
                                   <div class="form-group col-md-2">
                                  <input type="text" class="js-datepicker form-control" id="FromDt" autocomplete="off" name="FromDt" placeholder="From Date">
                                  </div><div class="form-group col-md-2">
                                  <input type="text" class="js-datepicker form-control" id="Todt" name="Todt" autocomplete="off"  placeholder="To Date">
                                  </div><div class="form-group col-md-2">
                                      <input type="text" class="form-control" id="Memid" name="Memid" placeholder="Member ID">
                                  </div><div class="form-group col-md-2">
                                   <input type="submit" class="btn btn-primary" value="Search">
                               </div>
                             
                              </div>
                            
                            
                            
                       
                        
        
                            
                        </div></form>
                    </div>
                </div>
            </div>
        </div>
         
        
         
        
    </section>

</main>
<?php include('belowScript.php');?><script src="assets/vendor/DataTables/datatables.min.js"></script>
<!--<script src="assets/js/datatable-data.js"></script>-->
</body>
</html>