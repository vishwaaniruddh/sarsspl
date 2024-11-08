<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

<script>

 $( function() {
    $( "#FromDt" ).datepicker();
        $( "#FromDt" ).datepicker( "option", "dateFormat", "dd-mm" );
        $( "#FromDt" ).datepicker( "option", "showAnim", "fold" ); 
        $( "#FromDt" ).datepicker( "option", "changeMonth", "true" );
        
  } );
  
   $( function() {
    $( "#Todt" ).datepicker();
        $( "#Todt" ).datepicker( "option", "dateFormat", "dd-mm" );
        $( "#Todt" ).datepicker( "option", "showAnim", "fold" ); 
        $( "#Todt" ).datepicker( "option", "changeMonth", "true" );
        
  } );
</script>
<!--========= hide year in datepicker==================-->
<style>
    .ui-datepicker-year
{
 display:none;   
    /* clip: rect(0px, 243px, 219px, 0px);*/
}.ui-datepicker{clip: rect(0px, 243px, 235px, 0px) !important};
</style>
<!--==================================================-->
</head>
<body class="sidebar-pinned" id="rightclick1">


<?php include("vertical_menu.php")?>
<main class="admin-main">
  <?php include('navbar.php');?>
  
    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span>View Birthday/Anniversary 
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

?>
                        <div class="card-body">
                            
                                <div class="form-row">
                               <div class="form-group col-md-3">
                                  
                                  <select class="form-control" name="Ab_Filtter" id="Ab_Filtter" >
                                  <option value="">Select</option>
                                  <option value="Anniversary">Anniversary</option>
                                  <option value="Birthday">Birthday</option>
                                  </select>
                                  
                                  </div>
                                  
                                   <div class="form-group col-md-3">
                                      
                                       
                                 <input type="text" class="form-control" id="FromDt" name="FromDt" autocomplete="off" placeholder="From Date">
                                  </div><div class="form-group col-md-3">
                                    
                                  <input type="text" class="form-control" id="Todt" autocomplete="off" name="Todt" placeholder="To Date">
                                  </div><div class="form-group col-md-3">
                                   <input type="button" class="btn btn-primary" onclick="searchfiltter()" value="Search">
                               </div>
                             
                              </div>
                            
                             <div class="table-responsive p-t-10">
    <div id="example1"></div>
    
    </div> 
                            
                            </div>
                    <!--  <div class="row">   
            <div class="cols-md-8">
        <form name="frm" method="post" action="exportbirthAnny.php" target="_new">
<input type="hidden" name="qr" id="qr" value="<?php echo $View; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" class="btn btn-primary"> <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
</div>&nbsp;&nbsp;
 <div class="cols-md-4">
<form name="frm" method="post" action="Leadpdf/DSRreportPDF.php" target="_new">
<input type="hidden" name="qr1" id="qr1" value="<?php echo $View; ?>" readonly>
<input type="hidden" name="From1" id="From1"  readonly>
<input type="hidden" name="To1" id="To1"  readonly>
<input type="submit" name="cmdsub" value="Generate PDF" class="btn btn-primary">
</form>
</div></div>-->
        
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        
         
        
    </section>

</main>
<?php include('belowScript.php');?>
<script src="assets/vendor/DataTables/datatables.min.js"></script>
<script src="assets/js/datatable-data.js"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  
  
<script src="assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/vendor/datedropper/datedropper.min.js"></script>
<script src="assets/vendor/dropzone/dropzone.js"   ></script>
<script src="assets/vendor/jquery.mask/jquery.mask.min.js"></script>
<script src="assets/js/form-data.js"></script>
  
  <!--====== this is for export to excel,pdf,copy --===================-->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>
<!--====== this is for export to excel,pdf,copy --===================-->
  
<script>
    
function searchfiltter(){
    
    var Ab_Filtter=document.getElementById('Ab_Filtter').value;
    var FromDt=document.getElementById('FromDt').value;
    var Todt=document.getElementById('Todt').value;
   
      if(Ab_Filtter==""){
          swal("Please Select Dropdown");
      }else if(FromDt==""){
          swal("Please Select From Date");
      }else if(Todt==""){
          swal("Please Select To Date");
      }else{
     
             $.ajax({
          
                    type:'POST',
                    url:'Bday_Anniversary_filtter.php',
                     data:'FromDt='+FromDt+'&Todt='+Todt+'&Ab_Filtter='+Ab_Filtter,
                    
                    success:function(msg){
                    // alert(msg);
                      
                     $('#example1').empty();
                      
                     $('#example1').html(msg);
                      test()
                      /*
                        $('#setTable').empty();
                             var json=JSON.parse(msg);
                       for(var i=0;i<json.length;++i){
                            var srno=i+1;
                            var Birth_Anni="";
    if(Ab_Filtter=="Birthday"){ if(json[i].Primary_DateOfBirth=='01-01-1970'){ Birth_Anni="00-00-0000"; }else{Birth_Anni=json[i].Primary_DateOfBirth;}     }
    else if(Ab_Filtter=="Anniversary"){  if(json[i].Primary_Anniversary=='01-01-1970'){ Birth_Anni="00-00-0000"; }else{   Birth_Anni=json[i].Primary_Anniversary;} }
    
    $('#BdayAnni').text(Ab_Filtter);
    $('#BdayAnni2').text(Ab_Filtter);
    $('#setTable').append('<tr role="row" class="odd" ><td class="sorting_1">'+srno+'</td><td>'+json[i].Primary_nameOnTheCard+'</td><td>'+json[i].Type+'</td><td>'+json[i].level_name+'</td><td>'+json[i].GenerateMember_Id+'</td><td>'+Birth_Anni+'</td><td>'+json[i].booklet_Series+'</td><td>'+json[i].EmailId +'</td><td>'+json[i].MobileNumber +'</td><td>'+json[i].MemshipDts_Remarks +'</td> </tr>');
                       
                          }
                     
                      document.getElementById('qr').value="";
                      document.getElementById('qr').value=json['0'].Qry;
                      
                      document.getElementById('qr1').value="";
                      document.getElementById('qr1').value=json['0'].Qry;
                       document.getElementById('From1').value="";
                      document.getElementById('From1').value=json['0'].FromDat;
                       document.getElementById('To1').value="";
                      document.getElementById('To1').value=json['0'].Todt;
              */
                    }
                })
    
     
      }
}

function test(){
$('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
}
</script>
</body>
</html>
