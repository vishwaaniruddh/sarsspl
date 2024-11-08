<? session_start();
include('../config.php');
include('../../config.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$id = $_GET['id'];


function member($parameter,$id){
    global $con;
    
    $mem_sql = mysqli_query($con,"select $parameter from new_member where id='".$id."'");
    $mem_sql_result = mysqli_fetch_assoc($mem_sql);
    
    return $mem_sql_result[$parameter];

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
        
    <a class="btn btn-warning" onclick="$('#content').load( 'recent.php');">Refresh</a>
    
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
                                            <th>Member</th>
                                            <th>Remarks</th>
                                            <th>Amount( In Rupees )</th>
                                            <th>Payment Date</td>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                         <?
                                         $sql = mysqli_query($con3,"select * from manage_sales_com where status=1 order by id desc");  

$i=1;
while($sql_result = mysqli_fetch_assoc($sql)){
$id = $sql_result['id'];
$date = $sql_result['created_at'];
$date = date('d F Y', strtotime($date));

?>
                                        
                    <tr>
                        <td><? echo $i;?></td>
                        <td><? echo member('name',$sql_result['member_id']);?></td>
                        <td><? echo $sql_result['remark'];?></td>
                        <td><? echo $sql_result['amount'];?></td>
                        <td><? echo $sql_result['payment_date'];?></td>
                        <td><a class="btn btn-danger" delete_id="<? echo $id; ?>" id="delete_transaction">Delete</a></td>
                    </tr>
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
                   $('#loading').hide();         
    </script>
    
        <script>
        $(document).ready(function(){
            

            
                    $('#delete_transaction').click(function(){
      
    var delete_id = $(this).attr('delete_id');
    
        jQuery.ajax({
                type: "POST",
                url: 'delete_selling_pay.php',
              data: 'delete_id='+delete_id, 
                    success:function(data) {

                        if(data==1 || data=='1' || data=="1"){
                            swal("Good job!", 'Deleted successfully' , "success")
                          
                          setTimeout(function(){ 
                                $('#content').load( 'recent.php' ); 
                          }, 1500);

                        }
                        else{
                          swal("Cancelled", 'Something Wrong'  , "error");
                        }

                    }
            });

});




        });
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