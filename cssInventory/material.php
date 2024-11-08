<?php session_start();
include('function.php');
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';

?> 

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.footer {
    background-image: url("download.jpg");
    color: #FFFFFF;
    font-size:.8em;
    margin-top:25px;
    padding-top: 15px;
    padding-bottom: 10px;
    position:fixed;
    left:0;
    bottom:0;
    width:100%;
}

</style>
    <style>
    
body {
    display: flex;
  flex-direction: column;
    
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: #ffd942;
}

</style>
<title>Dash Board</title>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  
<!--<script src="jquery-1.8.3.js"></script>-->
<script>
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>


<?php
include 'header.php';

?>

<link rel="stylesheet" type="text/css" href="style.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="datatable/dataTables.bootstrap.css">
<!--<link rel="stylesheet" type="text/css" href="http://cssmumbai.sarmicrosystems.com/css/dash/style.css">-->

        <script>
            function search(strPage,perpg){
                
                var oit=document.getElementById("oit").value;
        
var Page="";
if(strPage!="")
{
Page=strPage;
}

var perp='';
if(perpg=='')
perp='50';
else
perp=document.getElementById(perpg).value;



            $.ajax({
   type: 'POST',    
   url:'dashboard1_process.php',
  
    //data:'oit='+oit+'&Page='+Page+'&perpg='+perp,
    data:'oit='+oit+'&Page='+Page+'&perpg='+perp,

   success: function(msg){
    
    
   //alert(msg);
   document.getElementById("show").innerHTML=msg;
   
   
   
} })
            }
        </script>
</head>



<body style="background-color: #e0fde0;" > <!-- onload="search('','')" -->
  <div class="container">  <div class="footer">
  <p align="left" style="margin-bottom: 2px;padding-left: 18px;">CSS</p>
</div></div>
<?php include('menu.php') ?>





<div style="margin:1%"></div>
<div class="container">
    <div class="card">
        <div class="card-block">
            <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
            <table id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Actions</th>
                            <th>Ticket ID</th>
                            <th>ATM ID</th>
                            <th>CTS BM</th>
                            <th>Require Material Name</th>
                            <th>Dispatch Address</th>
                            
                            <th>Remark</th>
                            <th>Created Date</th>
                            <th>Location</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zone</th>
                            
                        </tr>
                    </thead>
                            <tbody>
                                <?
                                $i=1;
                                $sql = mysqli_query($css,"select * from material_inventory where status=1 order by id desc");
                                while($sql_result = mysqli_fetch_assoc($sql)){ 
                                $id = $sql_result['id'];
                                $mis_id = $sql_result['mis_id'];
                                
                                $misdetail_sql = mysqli_query($css,"select * from mis_details where id='".$mis_id."'");
                                $misdetail_sql_result = mysqli_fetch_assoc($misdetail_sql);
                                $main_mis = $misdetail_sql_result['mis_id'];
                                
                                $mis_sql = mysqli_query($css,"select * from mis where id='".$main_mis."'");
                                $mis_sql_result = mysqli_fetch_assoc($mis_sql);
                                $location = $mis_sql_result['location'];
                                $state = $mis_sql_result['state'];
                                $zone = $mis_sql_result['zone'];
                                $city = $mis_sql_result['city'];
                                
                                $_atmid = mis_details_data('atmid',$sql_result['mis_id']);
                                $bm_sql = mysqli_query($css,"select bm from atm_info where atmid like '".$_atmid."'");
                                $bm_sql_result = mysqli_fetch_assoc($bm_sql);
                                $bm = $bm_sql_result['bm'];
                                
                                ?>
                                    <tr>
                                        <td><? echo $i; ?></td>
                                        <td>
                                            <a target="_blank" class="btn btn-info" href="material_update.php?id=<? echo $sql_result['mis_id']; ?>">View</a>
                                           <a data-toggle="modal" data-id="<? echo $id; ?>" class="open-DetailDialog btn btn-danger" href="#myModal">Cancel</a>    
                                            <a data-id="<? echo $sql_result['mis_id']; ?>" class="open-Accept btn btn-success">Accept</a>
                                        </td>
                                        <td><? echo mis_details_data('ticket_id',$sql_result['mis_id']);?></td>
                                        <td><? echo mis_details_data('atmid',$sql_result['mis_id']);?></td>
                                        <td><? echo $bm; ?></td>
                                        <td><? echo $sql_result['material']; ?><?// echo get_material($sql_result['material']);?></td> <? //echo mis_history_data('material',$mis_id);?>
                                        <td><? echo mis_history_data('delivery_address',$sql_result['mis_id']);?></td>
                                        
                                        <td><? echo mis_history_data('remark',$sql_result['mis_id']);?></td>
                                        <td><? echo $sql_result['created_at']; ?></td>
                                        <td><? echo $location; ?></td>
                                        <td><? echo $city; ?></td>
                                        <td><? echo $state; ?></td>
                                        <td><? echo $zone; ?></td>
                                        
                                    </tr>
                                <? $i++; } ?>

                            </tbody>
                </table>
                  </div>
                </div>    
            </div>

        </div>
    </div>    
</div>

<!-- large modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Cancel</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>Cancel </h6>
          <div class="card">
            <div class="card-block">
               
                <form>
                    <div class="row">
                        <input type="hidden" id="reqId" name="id">
                        
                        <div class="col-sm-12">
                            <br>
                            <label>Remarks</label>
                            <input type="text" required name="cancel_remarks" class="form-control" id="remarks">
                        </div>
                        <div class="col-sm-6">
                            <br>
                            <input type="submit" name="submit" class="btn btn-success">
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>



<? } ?>


<script src="datatable/jquery.dataTables.js"></script>
<script src="datatable/dataTables.bootstrap.js"></script>
<script src="datatable/dataTables.buttons.min.js"></script>
<script src="datatable/buttons.flash.min.js"></script>
<script src="datatable/jszip.min.js"></script>

<script src="datatable/pdfmake.min.js"></script>
<script src="datatable/vfs_fonts.js"></script>
<script src="datatable/buttons.html5.min.js"></script>
<script src="datatable/buttons.print.min.js"></script>
<script src="datatable/jquery-datatable.js"></script>

<script>
   $(document).ready(function() {
var oTable = $('#example').DataTable( {
        dom: 'Blfrtip',
        buttons: [
       {
           extend: 'pdf',
           footer: true,
           exportOptions: {
                columns: [0,2,3,4,5,6,7,8,9,10,11,12]
            }
       },
       {
           extend: 'csv',
           footer: false,
           exportOptions: {
                columns: [0,2,3,4,5,6,7,8,9,10,11,12]
            }
          
       },
       {
           extend: 'excel',
           footer: false,
           exportOptions: {
                columns: [0,2,3,4,5,6,7,8,9,10,11,12]
            }
       }         
    ]  
    } );

} );
</script>
<script>

$('#myModal form').on('submit', function (e) {

          e.preventDefault();
          $("#myModal .btn-success").hide();
          $.ajax({
            type: 'post',
            url: 'material_process_action.php',
            data: $('#myModal form').serialize(),
            success: function (msg) { debugger;
               if(msg==1){
                   swal("Success","Cancelled Successfully","success");
                   setTimeout(() => {
                       location.reload();
                   },1000);
                   
               }else{
                   swal("Error","Unable to proceed your request","error");
                    $("#myModal .btn-success").show();
                    $('#myModal').modal('toggle'); 
               }
            
            }
          });

        });

$(document).on("click", ".open-DetailDialog", function () {
     var reqId = $(this).data('id');
     
});
$(document).on("click", ".open-Accept", function () {
     var Id = $(this).data('id');
     swal({
    title: "Are you sure?",
    text: "Check before proceed!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, accept it!",
    cancelButtonText: "No, cancel plz!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
    function (isConfirm) {
      if (isConfirm) {
        $.ajax({
          type: 'POST',
          url: 'material_request_accept.php',
          data: {id:Id},
          success: function (msg) {
              if(msg==1)
                 swal("Accept!", "Material Request has been accepted.", "success");
              else
                 swal("NOT Accepted!", "Something blew up.", "error");
          },
          error: function (msg) {
            swal("NOT Accepted!", "Something blew up.", "error");
          }
        });
      } else {
        swal("Cancelled", "Material Request has not been accepted :)", "error");
      }
    });

  return false;
     
});
</script>

</body>
</html>
