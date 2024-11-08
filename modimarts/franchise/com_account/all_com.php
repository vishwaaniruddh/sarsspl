<? session_start();
include('../config.php');
include('../../config.php');

function member($parameter,$id){
    global $con;
    
    $mem_sql = mysqli_query($con,"select $parameter from new_member where id='".$id."'");
    $mem_sql_result = mysqli_fetch_assoc($mem_sql);
    
    return $mem_sql_result[$parameter];

}


function get_amount($id){
    global $con3;
    
    $sql = mysqli_query($con3,"select sum(amount) as amount from manage_sales_com where member_id='".$id."' order by id desc");
    if($sql_result = mysqli_fetch_assoc($sql)){
        return round($sql_result['amount'],2);
    }
    else{
        return 0;
    }
    
    
}

?>

<!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">


    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <style>
    section.content{
        margin:0;
    }
</style>
    
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Member Id</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Amount (In Rupees)</th>
                                            <th>Bank</th>
                                            <th>Account No</th>
                                            <th>IFSC Code</th>
                                            <th>Detail</th>
                                            <th>Pay</th>
                                            <th>Pay History</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
<? $sql = mysqli_query($con3,"SELECT DISTINCT(commission_to) FROM `commission_details` where status=1");  

$i=1;

while($sql_result = mysqli_fetch_assoc($sql)){
    $id = $sql_result['commission_to'];
    
    $com_sql = mysqli_query($con3,"select sum(amount) as amount from commission_details where commission_to = '".$id."'");
    while($com_sql_result = mysqli_fetch_assoc($com_sql)){ ?>
                                        
                    <tr <? if($id == 'SAR'){ ?> style= "background:#a78d8b; color: white;" <? } ?> >
                        <td><? echo $i;?></td>
                        <td><? echo $id; ?></td>
                        
                        <? if($id == 'SAR'){ ?>
                            <td> SARMicrosystems Pvt Ltd.  </td>
                            <? } else{ ?>
                        <td><? echo member('name',$id); ?></td>    
                            <? } ?>
                        
                        <td><? echo member('mobile',$id); ?></td>
                        
                        <td><?
                        if(get_amount($id)>0){
                               
                               echo round($com_sql_result['amount'],2) - get_amount($id);  
                            }else{
                        echo round($com_sql_result['amount'],2);                                
                            } ?>
                        </td>
                        
                        <td><? echo member('bank',$id); ?></td>
                        
                        <td>
                            <? echo member('account_num',$id); ?>
                            
                        </td>
                        <td><? echo member('ifsc',$id); ?></td>
                        <td><a class="btn btn-danger" onclick="$('#loading').show(); $('#content').load( 'com_details.php?id=<? echo $id; ?>');">View</a></td>
                        
                        <td>
                            <a style="margin:3px;" class="btn btn-danger" onclick="$('#loading').show(); $('#content').load( 'payment.php?id=<?php echo $id; ?>');">Pay</a>
                        </td>
                        
                        <td>
                            <a class="btn btn-warning" onclick="$('#loading').show(); $('#content').load( 'history.php?id=<? echo $id?>');">View History</a>
                        </td>
                        
                        
                        
                    </tr>
                                        
    <? } ?>
    <? $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
    
    
    <script>
//         $('.sales_btn').click(function(){
//       var id =  $(this).attr('id');

//     var so_trackid = $(this).attr('sales_id');


                 
// swal("Enter Settelment Amount:", {
//   content: "input",
// })
// .then((value) => {
    
//         var value=$('.swal-content__input').val();
     
//         jQuery.ajax({
//                 type: "POST",
//                 url: 'pay.php',
//               data: 'value='+value+'&id='+id, 
//                     success:function(data) {


// // alert(data);
//                         if(data==1 || data=='1' || data=="1"){
//                             swal("Good job!", 'Settelment added successfully' , "success")
                          
//                           setTimeout(function(){ 
//                                 $('#content').load( 'all_com.php' ); 
//                           }, 1500);

//                         }
//                         else{
//                           swal("Cancelled", 'Something Wrong'  , "error");
//                         }
//                          if(data==2 || data=='2' || data=="2"){
                            
//                           swal("Cancelled", 'Settelment Not Added ! '  , "error");
                            
//                         }
                        
//                     }
//             });
// });
// });





             $('#loading').hide();         
    </script>
    
    
    
     <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!--<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>