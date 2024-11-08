<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
   <!-- <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">-->
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
<script>
function searchfiltter(){
    var  Ab_Filtter=document.getElementById('Ab_Filtter').value;
    var  FromDt=document.getElementById('FromDt').value;
    var  Todt=document.getElementById('Todt').value;
   
    if(Ab_Filtter==""){
          swal("Please Select Dropdown");
      }else if(FromDt==""){
          swal("Please Select From Date");
      }else if(Todt==""){
          swal("Please Select To Date");
      }
   else{
   
             $.ajax({
                    type:'POST',
                    url:'HotelUserCountEntry_Filtter.php',
                     data:'FromDt='+FromDt+'&Todt='+Todt+'&Ab_Filtter='+Ab_Filtter,
                    
                    success:function(msg){
                       // alert(msg);
                        $('#setTable').empty();
                             var json=$.parseJSON(msg);
                             for(var i=0;i<json.length;++i){
                             var srno=i+1;
                            
                            $('#setTable').append('<tr role="row" class="odd" ><td class="sorting_1">'+srno+'</td><td>'+json[i].Title+'</td><td>'+json[i].FirstName+'</td><td>'+json[i].LastName+'</td><td>'+json[i].MobileCode+'</td><td>'+json[i].MobileNumber+'</td><td>'+json[i].EmailId+'</td><td>'+json[i].Country+'</td><td>'+json[i].State+'</td><td>'+json[i].City+'</td><td>'+json[i].PinCode+'</td><td>'+json[i].pincodeOfArea+'</td><td>'+json[i].Nationality+'</td><td>'+json[i].Company+'</td><td>'+json[i].Designation+'</td><td>'+json[i].LeadSource+'</td><td>'+json[i].Status+'</td><td>'+json[i].DelegationStatus+'</td><td>'+json[i].Creation+'</td><td>'+json[i].Assigned+'</td><td>'+json[i].CloseReason+'</td><td>'+json[i].Close+'</td><td>'+json[i].empname+'</td><td>'+json[i].Hotel_Name+'</td></tr>');
                          }
                     
                      document.getElementById('qr').value="";
                      document.getElementById('qr').value=json['0'].Qry;
               
                  /* document.getElementById('qr1').value="";
                      document.getElementById('qr1').value=json['0'].Qry;
                       document.getElementById('From1').value="";
                      document.getElementById('From1').value=json['0'].FromDat;
                       document.getElementById('To1').value="";
                      document.getElementById('To1').value=json['0'].Todt;
               */
                       document.getElementById('Ab_Filtterid').value="";
                       document.getElementById('Ab_Filtterid').value=json['0'].Ab_Filtter;
                       
                       
                       if(Ab_Filtter=="All"){
                        var rowCount = $('#example tr').length;
                        var removeHeadingCount=rowCount-2;
                        document.getElementById('total').value=removeHeadingCount;
                        }else{
                             document.getElementById('total').value=json['0'].cnt;
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
                                <i class="mdi mdi-table "></i></span> view Hotel User Entry Details 
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
 

?>
                        <div class="card-body">
                                   <div class="form-row">
                               <div class="form-group col-md-3">
                                  
                                  <select class="form-control" name="Ab_Filtter" id="Ab_Filtter" >
                                  <option value="">Select</option>
                                  <option value="All">All</option>
                                  <?php 
                                        $userQuery1=mysqli_query($conn,"select id,empname from HotelUsers");
                                        while($fecthuser=mysqli_fetch_array($userQuery1)){?>
                                        <option value="<?php echo $fecthuser['id']; ?>"><?php echo $fecthuser['empname']; ?></option>
                                        <?php } ?>
                                  </select>
                                  
                                  </div>
                                  
                                   <div class="form-group col-md-3">
                                  <input type="text" class="js-datepicker form-control" id="FromDt" name="FromDt" autocomplete="off" placeholder="From Date">
                                  </div><div class="form-group col-md-3">
                                  <input type="text" class="js-datepicker form-control" id="Todt" name="Todt" autocomplete="off" placeholder="To Date">
                                  </div><div class="form-group col-md-3">
                                   <input type="button" class="btn btn-primary" onclick="searchfiltter()" value="Search">
                               </div>
                             
                              </div>
                            
                           <div align="center"> Total :-<input type="text" id="total" style="border:none" readonly></div>
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                    <tr>
                                         <th>srno</th>                            
                                         
                                         <th> Title</th>
                                         <th> FirstName</th>
                                         <th> LastName</th>
                                         <th> MobileCode</th>
                                         <th> MobileNumber</th>
                                         <th> EmailId</th>
                                         <th> Country</th>
                                         <th> State</th>
                                         <th> City</th>
                                         <th> PinCode</th> 
                                         <th> pincodeOfArea</th>
                                         <th> Nationality</th>
                                         <th> Company</th>
                                         <th> Designation</th>
                                         <th> LeadSource</th> 
                                         <th> Status</th>
                                         <th> DelegationStatus</th>
                                         <th> Creation Date</th>
                                         <th> Assigned</th>
                                         <th> CloseReason</th> 
                                         <th> Close</th>
                                         <th> Employee name</th>
                                         <th> Hotel_Name</th>
                                         
                                          
                                    </tr>
                                    </thead>
                                    <tbody id="setTable">
                       
	                     </tbody>
                                    <tfoot>
                                    <tr>
                                       <th>srno</th>                            
                                       
                                         <th> Title</th>
                                         <th> FirstName</th>
                                         <th> LastName</th>
                                         <th> MobileCode</th>
                                         <th> MobileNumber</th>
                                         <th> EmailId</th>
                                         <th> Country</th>
                                         <th> State</th>
                                         <th> City</th>
                                         <th> PinCode</th> 
                                         <th> pincodeOfArea</th>
                                         <th> Nationality</th>
                                         <th> Company</th>
                                         <th> Designation</th>
                                         <th> LeadSource</th> 
                                         <th> Status</th>
                                         <th> DelegationStatus</th>
                                         <th> Creation Date</th>
                                         <th> Assigned</th>
                                         <th> CloseReason</th> 
                                         <th> Close</th>
                                         <th> Employee name</th>
                                         <th> Hotel_Name</th>
                                        
                                          
                                          
                                         </tr>
                                    </tfoot>
                                </table>
                            </div>    <div class="row">
            
            <div class="cols-md-8">
        <form name="frm" method="post" action="exporHoteluserEntry.php" target="_new">
<input type="hidden" name="qr" id="qr" value="" readonly>
<input type="hidden" name="Ab_Filtterid" id="Ab_Filtterid" value="" readonly>
<input type="submit" name="cmdsub" value="Export" class="btn btn-primary"> <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
</div>&nbsp;&nbsp;
 <div class="cols-md-4">
<!--<form name="frm" method="post" action="Leadpdf/report.php" target="_new">
<input type="text" name="qr1" id="qr1" value="" readonly>
<input type="hidden" name="From1" id="From1"  readonly>
<input type="hidden" name="To1" id="To1"  readonly>
<input type="submit" name="cmdsub" value="Generate PDF" class="btn btn-primary">
</form>-->
</div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    
        
    </section>

</main>
<?php include('belowScript.php');?>
<script src="assets/vendor/DataTables/datatables.min.js"></script>
<!--<script src="assets/js/datatable-data.js"></script>-->
</body>
</html>