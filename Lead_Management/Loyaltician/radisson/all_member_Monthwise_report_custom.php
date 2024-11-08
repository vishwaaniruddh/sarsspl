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
   var  FromDt=document.getElementById('FromDt').value;
    var  Todt=document.getElementById('Todt').value;
   
    if(FromDt==""){
          swal("Please Select From Date");
      }else if(Todt==""){
          swal("Please Select To Date");
      }
   else{
   
             $.ajax({
                    type:'POST',
                    url:'MonthWiseSearch_Filtter_custom.php',
                     data:'FromDt='+FromDt+'&Todt='+Todt,
                    
                    success:function(msg){
                        
                        const json_data = JSON.parse(msg);
                        const query = json_data.query;
                        $("#qr").val(query)
                        const json = json_data.data
                
        

                
                        
                        $('#setTable').empty();
                             
                             for(var i=0;i<json.length;++i){
                                var srno=i+1;
                            $('#setTable').append('<tr role="row" class="odd" ><td class="sorting_1">'+srno+'</td><td>'+json[i].GenerateMember_Id+'</td><td>'+json[i].FirstName+'</td><td>'+json[i].LastName+'</td><td>'+json[i].MembershipDetails_Level+'</td><td>'+json[i].Expirydate+'</td> <td>'+json[i].MobileNumber+'</td><td>'+json[i].EmailId+'</td><td>'+json[i].Company+'</td><td>'+json[i].Designation+'</td><td>'+json[i].Primary_mob2+'</td><td>'+json[i].Primary_BuldNo_addrss+'</td><td>'+json[i].Primary_Area_addrss+'</td><td>'+json[i].Primary_Landmark_addrss+'</td><td>'+json[i].MembershipDts_GrossTotal+'</td><td>'+json[i].MembershipDts_PaymentMode+'</td><td>'+json[i].booklet_Series+'</td><td>'+json[i].entryDate+'</td><td>'+json[i].sales_associate+'</td></tr>');
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
                                <i class="mdi mdi-table "></i></span>Renewal REPORT 
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">
<?php include("config.php"); ?>
                        <div class="card-body">
                                   <div class="form-row">
                              
                                  
                                   <div class="form-group col-md-3">
                                  <input type="text" class="js-datepicker form-control" id="FromDt" name="FromDt" autocomplete="off" placeholder="From Date">
                                  </div><div class="form-group col-md-3">
                                  <input type="text" class="js-datepicker form-control" id="Todt" name="Todt" autocomplete="off" placeholder="To Date">
                                  </div><div class="form-group col-md-3">
                                   <input type="button" class="btn btn-primary" onclick="searchfiltter()" value="Search">
                               </div>
                             
                              </div>
                            
                            
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>srno</th>
                                        <th>MEMBER_ID</th>
                                        <th>FIRSTNAME</th>
                                        <th>LASTNAME</th>
                                        <th>Level</th>
                                        <th>ExpiryDate</th>
                                        <th>MOBILENUMBER</th>
                                        <th>PRIMARYMAIL</th>
                                        <th>COMPANY</th>
                                        <th>DESIGNATION</th>
                                        <th>Primary_mob2</th>
                                        <th>Primary_BuldNo_addrss</th>
                                        <th>Primary_Area_addrss</th>
                                        <th>Primary_Landmark_addrss</th>
                                        <th>MembershipDts_GrossTotal</th>
                                        <th>MembershipDts_PaymentMode</th>
                                        <th>booklet_Series</th>
                                        <th>entryDate</th>
                                        <th>Sales Associate</th>

                                          
                                    </tr>
                                    </thead>
                                    <tbody id="setTable"></tbody>
                                    <tfoot>
                                    <tr>
                                        <th>srno</th>
                                        <th>MEMBER_ID</th>
                                        <th>FIRSTNAME</th>
                                        <th>LASTNAME</th>
                                        <th>Level</th>
                                        <th>ExpiryDate</th>
                                        <th>MOBILENUMBER</th>
                                        <th>PRIMARYMAIL</th>
                                        <th>COMPANY</th>
                                        <th>DESIGNATION</th>
                                        <th>Primary_mob2</th>
                                        <th>Primary_BuldNo_addrss</th>
                                        <th>Primary_Area_addrss</th>
                                        <th>Primary_Landmark_addrss</th>
                                        <th>MembershipDts_GrossTotal</th>
                                        <th>MembershipDts_PaymentMode</th>
                                        <th>booklet_Series</th>
                                        <th>entryDate</th>
                                        <th>Sales Associate</th>  
                                    </tr>
                                         
                                    </tfoot>
                                </table>
                            </div>    <div class="row">
            
            <div class="cols-md-8">
                
        <form name="frm" method="post" action="export_AllMember_monthwise_report_custom.php" target="_new">
<input type="hidden" name="qr" id="qr" value="<?php echo $View; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" class="btn btn-primary"> <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
</div>&nbsp;&nbsp;
</div>
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
<script>
    $(document).ready(function() {
    $("#rightclick").on("contextmenu",function(e){
       return false;
    }); 
}); 
</script>