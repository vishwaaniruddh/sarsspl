<? session_start();
include('../config.php');
include('../../config.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function member($parameter,$id){
    global $con;
    
    $mem_sql = mysqli_query($con,"select $parameter from new_member where id='".$id."'");
    $mem_sql_result = mysqli_fetch_assoc($mem_sql);
    
    return $mem_sql_result[$parameter];

}

function get_amount($id){
    global $con;
    
    $sql = mysqli_query($con,"select sum(amount) as amount from manage_join_com where member_id='".$id."' order by id desc");
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
                                            <th>Bank</th>
                                            <th>Account No</th>
                                            <th>IFSC Code</th>
                                            <td>Detail</td>
                                            <th>Pay</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
<? $sql = mysqli_query($con,"SELECT DISTINCT(member_id) FROM `joining_com_details` where status=1");  

$i=1;

while($sql_result = mysqli_fetch_assoc($sql)){
    $id = $sql_result['member_id'];
    
    $com_sql = mysqli_query($con,"select sum(amount) as amount from joining_com_details where member_id = '".$id."'");
    while($com_sql_result = mysqli_fetch_assoc($com_sql)){

                        if(get_amount($id)>0){
                               
                               $amount = round($com_sql_result['amount'],2) - get_amount($id);  
                            }else{
                                $amount = round($com_sql_result['amount'],2);                                
                            } 
?>
                               
                                                   <tr <? if($id == 'SAR'){ ?> style= "background:#a78d8b; color: white;" <? } ?> >
                        <td><? echo $i;?></td>
                        <td><? echo $id; ?></td>
                        
                        <? if($id == 'SAR'){ ?>
                            <td> SARMicrosystems Pvt Ltd.  </td>
                            <? } else{ ?>
                        <td><? echo member('name',$id); ?></td>    
                            <? } ?>
                        
                        <td><? echo member('mobile',$id); ?></td>
                        
                        <td>
                        <? echo $amount ; ?>
                        </td>
                        
                        <td><? echo member('bank',$id); ?></td>
                        <td><? echo member('account_num',$id); ?></td>
                        <td><? echo member('ifsc',$id); ?></td>
                        <td><a class="btn btn-danger" onclick="$('#loading').show(); $('#content').load( 'overall_franch_com_join_details.php?id=<? echo $id?> ');">View</a></td>
                        <td><a class="btn btn-danger" onclick="$('#loading').show(); $('#content').load( 'join_pay.php?id=<? echo $id?> ');">Pay</a></td>
                    </tr>
                    
                    
                            <? 
                            


                                        
     } ?>
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