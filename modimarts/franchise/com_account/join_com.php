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
                                            <td>Amount (In Rupees)</td>

                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
<? $sql = mysqli_query($con,"SELECT * FROM `joining_com` where status=1 and member_id>0 order by id desc");  

$i=1;

while($sql_result = mysqli_fetch_assoc($sql)){

    $member_id = $sql_result['member_id'];
    $id = $sql_result['id'];
    
    
    $status = member('mem_status',$member_id);

    if($status=='p'){
        
    
?>

<tr>
    <td><? echo $i; ?></td>
    <td><? echo member('id',$member_id); ?></td>
    <td><? echo member('name',$member_id); ?></td>
    <td><? echo member('mobile',$member_id); ?></td>
    <td><? echo $sql_result['amount']; ?></td>

    <td><a class="btn btn-danger" onclick="$('#content').load( 'fran_com_join_details.php?id=<? echo $id; ?> ');">View Disctribution</a></td>

</tr>                

    <? $i++; } 
    }
    
    
    
    ?>
                                        
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