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

div.dt-top-container {
  display: grid;
  grid-template-columns: auto auto auto;
}

div.dt-center-in-div {
  margin: 0 auto;
}

div.dt-filter-spacer {
  margin: 10px 0;
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
<div class="container-fluid">
    <div class="card">
        <div class="card-block">
            <div class="row">
                    <div class="col-md-9">
                        
                        <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="col-md-6">
                            <select id="status" class="form-control" name="status">
                                 <option value="1" <? if(isset($_POST['status'])) { if($_POST['status']=='1'){ echo 'selected' ;  }} ?>>Material Requirement</option>
                                 <option value="5" <? if(isset($_POST['status'])) { if($_POST['status']=='5'){ echo 'selected' ;  }} ?>>Confirm Processed</option>
                                 <option value="2" <? if(isset($_POST['status'])) { if($_POST['status']=='2'){ echo 'selected' ;  }} ?>>Available</option>
                                 
                                 <option value="0" <? if(isset($_POST['status'])) { if($_POST['status']=='0'){ echo 'selected' ;  }} ?>>Cancelled</option>
                                 <option value="3" <? if(isset($_POST['status'])) { if($_POST['status']=='3'){ echo 'selected' ;  }} ?>>Not Available</option>
                                 <option value="4" <? if(isset($_POST['status'])) { if($_POST['status']=='4'){ echo 'selected' ;  }} ?>>Dispatched</option>
                            </select>
                            </div>
                            <div class="col-md-3">
                                <input type="submit" value="Search">
                            </div>
                        </form>    
                    </div>
            </div>
        </div>
    </div>    
    <div class="card">
        <div class="card-block">
            <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
            <table  id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Actions</th>
                            <th>Ticket ID</th>
                            <th>Customer</th>
                            <th>Bank</th>
                            <th>ATM ID</th>
                            <th>CTS BM</th>
                            <th>Material Condition</th>
                            <th>Require Material Name</th>
                            <th>Dispatch Address</th>
                            <th>Contact Person Name</th>
                            <th>Contact Person Mobile</th>
                            <th>Remark</th>
                            <th>Created Date</th>
                            <th>Location</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zone</th>
                            <th>MIS ID</th>
                            <th>Created By</th>
                        </tr> 
                    </thead>
                            <tbody>
                                <? $view = 0;
                                if(isset($_POST['status'])){
                                    $_status = $_POST['status'];
                                  //  SELECT * FROM `material_inventory` WHERE status=1 and mis_id IN (select mis_id from mis_details)
                                  if($_status==1){
                                      $query = "SELECT * FROM `material_inventory` WHERE status='".$_status."' AND material_inventory.mis_id IN (select mis_details.id from mis_details, mis WHERE mis.id = mis_details.mis_id and mis_details.status='material_requirement') order by id desc";
                                  }else{
                                      $query = "select * from material_inventory where status='".$_status."' group by mis_id order by id desc";
                                  }
                                    
                                    $view = 1; 
                                }else{
                                   // $query = "select * from material_inventory where status=2 order by id desc";
                                   $query = "";
                                }
                                
                               // echo $query ; 
                                if($view==1){
                                $i=1;
                                $sql = mysqli_query($css,$query);
                                
                               // echo mysqli_num_rows($sql);
                                if(mysqli_num_rows($sql)>0){
                                while($sql_result = mysqli_fetch_assoc($sql)){ 
                                $id = $sql_result['id'];
                                $mis_id = $sql_result['mis_id'];
                                
                                $misdetail_sql = mysqli_query($css,"select * from mis_details where id='".$mis_id."'");
                                $count = mysqli_num_rows($misdetail_sql);
                                $misdetail_sql_result = mysqli_fetch_assoc($misdetail_sql);
                                $main_mis = $misdetail_sql_result['mis_id'];
                                
                                $current_status = $misdetail_sql_result['status'];
                                
                                $mis_sql = mysqli_query($css,"select * from mis where id='".$main_mis."'");
                                $mis_sql_result = mysqli_fetch_assoc($mis_sql);
                                $location = $mis_sql_result['location'];
                                $state = $mis_sql_result['state'];
                                $zone = $mis_sql_result['zone'];
                                $city = $mis_sql_result['city'];
                                $customer = $mis_sql_result['customer'];
                                $bank = $mis_sql_result['bank'];
                                $_atmid = $mis_sql_result['atmid'];
                               // $_atmid = mis_details_data('atmid',$sql_result['mis_id']);
                                $bm_sql = mysqli_query($css,"select bm from atm_info where atmid like '".$_atmid."'");
                                $bm_sql_result = mysqli_fetch_assoc($bm_sql);
                                $bm = $bm_sql_result['bm'];
                                
                                $mis_history = mysqli_query($css,"select material_condition,created_by from mis_history where mis_id='".$mis_id."' AND type='".$current_status."'");
                                $mis_his_count = mysqli_num_rows($mis_history);
                                $user_created_by = "";
                                if($mis_his_count>0){
                                  $mis_his_sql_result = mysqli_fetch_assoc($mis_history);
                                  $created_by_id = $mis_his_sql_result['created_by'];
                                  if($created_by_id>0){
                                      $mis_created_by_sql = mysqli_query($css,"select name from mis_loginusers where id='".$created_by_id."'");
                                      $mis_created_by_count = mysqli_num_rows($mis_created_by_sql);
                                      if($mis_created_by_count>0){
                                          $mis_user_sql_result = mysqli_fetch_assoc($mis_created_by_sql);
                                          $user_created_by = $mis_user_sql_result['name'];
                                      }
                                  }
                                  
                                $material_condition = $mis_his_sql_result['material_condition'];
                                $contact_person_name = $mis_his_sql_result['contact_person_name']; 
                                }
                                
                                if($count>0){
                                ?>
                                    <tr>
                                        <td><? echo $i; ?></td>  
                                        <td>
                                            <a target="_blank" class="btn btn-info" href="material_update.php?id=<? echo $sql_result['mis_id']; ?>">View</a>
                                            <?php if($sql_result['status']==1) { ?>
                                            <a data-id="<? echo $sql_result['mis_id']; ?>" class="open-Accept btn btn-success">Accept</a>
                                            <?php } ?>
                                            <?php if($sql_result['status']==1 || $sql_result['status']==2){ ?>
                                            <!--<a data-toggle="modal" data-id="<? echo $id; ?>" class="open-DetailDialog btn btn-danger" href="#myModal">Cancel</a>    -->
                                            <?php } if($sql_result['status']==2){ ?>
                                            <a data-toggle="modal" data-misid="<? echo $mis_id; ?>" data-id="<? echo $id; ?>" class="open-DetailPOD-Dialog btn btn-success" href="#myPODModal">POD</a>   
                                            <?php } ?>
                                        </td>
                                       
                                        <td><? echo mis_details_data('ticket_id',$sql_result['mis_id']);?></td>
                                        <td><? echo $customer;?></td>
                                        <td><? echo $bank;?></td>
                                        <td><? echo mis_details_data('atmid',$sql_result['mis_id']);?></td>
                                        <td><? echo $bm; ?></td>
                                        <td><? echo $material_condition ; ?></td>
                                        <td><? echo $sql_result['material']; ?><?// echo get_material($sql_result['material']);?></td> <? //echo mis_history_data('material',$mis_id);?>
                                        <td><? echo mis_history_data('delivery_address',$sql_result['mis_id']);?></td>
                                        <td><? echo mis_history_data('contact_person_name',$sql_result['mis_id']) ;?></td>
                                        <td><? echo mis_history_data('contact_person_mob',$sql_result['mis_id']);?></td>
                                        
                                        <td><? echo mis_history_data('remark',$sql_result['mis_id']);?></td>
                                        <td><? echo $sql_result['created_at']; ?></td>
                                        <td><? echo $location; ?></td>
                                        <td><? echo $city; ?></td>
                                        <td><? echo $state; ?></td>
                                        <td><? echo $zone; ?></td>
                                       <!-- <td>
                                            <tr>
                                            <td><a target="_blank" class="btn btn-info" href="material_update.php?id=<? echo $sql_result['mis_id']; ?>">View</a></td>
                                            <?php if($sql_result['status']==1 || $sql_result['status']==2){ ?>
                                            <td><a data-toggle="modal" data-id="<? echo $id; ?>" class="open-DetailDialog btn btn-danger" href="#myModal">Cancel</a></td>    
                                            <?php } if($sql_result['status']==2){ ?>
                                            <td><a data-toggle="modal" data-misid="<? echo $mis_id; ?>" data-id="<? echo $id; ?>" class="open-DetailPOD-Dialog btn btn-success" href="#myPODModal">POD</a></td>    
                                            <?php } ?>
                                            </tr> 
                                        </td> -->
                                         <td><? echo $sql_result['mis_id']; ?></td>
                                         <td><? echo $user_created_by;?></td>
                                    </tr>
                                <? $i++; } } } }?>

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
                        <input type="hidden" name="status" value="0">
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


<!-- large modal -->
<div class="modal fade" id="myPODModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">POD</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>POD </h6>
          <div class="card">
            <div class="card-block">
               
                <form>
                    <div class="row">
                        <input type="hidden" id="tableId" name="id">
                        <input type="hidden" id="misId" name="mis_id">
                        <input type="hidden" name="status" value="4">
                        <div class="col-sm-6">
                            <label>POD</label>
                            <input type="text" required name="pod" class="form-control" id="pod">
                        </div>
                        <div class="col-sm-6">
                            <label>Courier Name</label>
                            <input type="text" name="courier_name" class="form-control" id="courier_name">
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
<!--<script src="datatable/jquery-datatable.js"></script>-->

<script>
   $(document).ready(function() {
var oTable = $('#example').DataTable( {
        dom: 'Blfrtip',
       // dom: 'flit',
       // dom: '<"dt-top-container"<l><"dt-center-in-div"B><f>r>t<"dt-filter-spacer"f><ip>',
        buttons: [
       {
           extend: 'pdf',
           footer: true,
           exportOptions: {
                columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]
            }
       },
       {
           extend: 'csv',
           footer: false,
           exportOptions: {
                columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]
            }
          
       },
       {
           extend: 'excel',
           footer: false,
           exportOptions: {
                columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]
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
            success: function (msg) { 
                console.log(msg) ;
                
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
     $(".modal-body #reqId").val( reqId );
});

function allLetter(inputtxt)
    { 
      var letters = /^[A-Za-z]+$/;
      if(inputtxt.match(letters))
      {
         return 1;
      }
      else
      {
         return 0;
      }
    }
$('#myPODModal form').on('submit', function (e) { 
        var courier_name = $("#courier_name").val();
        if(allLetter(courier_name)){
          e.preventDefault();
              $("#myPODModal .btn-success").hide();
              $.ajax({
                type: 'post',
                url: 'material_process_action.php',
                data: $('#myPODModal form').serialize(),
                success: function (msg) { debugger;
                   if(msg==1){
                       swal("Success","Processed Successfully","success");
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
        }else{
            swal("Error","Courier Name Must have Alphabets Only","error");
            return false;
        }

});
$(document).on("click", ".open-DetailPOD-Dialog", function () {
     var reqId = $(this).data('id');
     $(".modal-body #tableId").val( reqId );
     var misId = $(this).data('misid');
     $(".modal-body #misId").val( misId );
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
