<?php include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$atmid = $_REQUEST['atmid'];

function cust_date($date){
    if($date){
        return date('d M, Y', strtotime($date));        
    }else{
        return ;
    }
    
}


        
        function cust_datetime($date){
            if($date){
                return date('d M, Y H:i:s', strtotime($date));        
            }else{
                return '';
            }
        }



$sql1 = mysqli_query($con,"select * from mis_details where atmid = '".$atmid."'");
        $i = 1;
        

        if(mysqli_num_rows($sql1) > 0 ){ 
        


        
        ?>
            

<div class="card">
    <div class="card-block">
        <div style="overflow-x:auto;">
        <table id="example" class="table dataTable js-exportable no-footer" style="width:100%">
        
        <thead>
                <tr>
                    <th>Sn</th>
                    <th>Ticket ID</th>
                    <th>Component</th>
                    <th>Sub Component</th>

                    <th>Call Receive From</th>

                    <th>Remarks</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Date</th>
                    <th>Closing Date</th>
                    <th>Attachment 1</th>
                    <th>Attachment 2</th>
                </tr>
            </thead>
            <tbody>
                
        <?php $sql = mysqli_query($con,"select * from mis_details where atmid = '".$atmid."' order by id desc");
        $i = 1; 
            while($sql_result = mysqli_fetch_assoc($sql)){ 
            
            $mis_id  = $sql_result['mis_id'] ; 
            $sql1 = mysqli_query($con,"select * from mis where id='".$sql_result['mis_id']."'");
            $sql1_result = mysqli_fetch_assoc($sql1);
            $created_by = $sql1_result['created_by'];
            
            $created_at = $sql1_result['created_at'];
            $created_at = cust_date($created_at);
            
            $user_sql = mysqli_query($con,"select * from vendorUsers where id='".$created_by."'");
            $user_sql_result = mysqli_fetch_assoc($user_sql);
            $created_by = $user_sql_result['name'];
            
            


            
            $his_sql = mysqli_query($con,"select * from mis_history where mis_id='".$sql_result['id']."' and type='close' order by id desc");
            $his_sql_result = mysqli_fetch_assoc($his_sql);
            $close_time = $his_sql_result['created_at'];
            $attachment = $his_sql_result['attachment'];
            $attachment2 = $his_sql_result['attachment2'];
            
            
            ?>
            
            <tr>
                <td><?php echo  $i; ?></td>
                <td>
                    <a  href="mis_details.php?id=<?php echo  $mis_id; ?>">
                        <?php echo  $sql_result['ticket_id']; ?>
                    </a>
                    </td>
                <td><?php echo  $sql_result['component']; ?></td>
                <td><?php echo  $sql_result['subcomponent']; ?></td>
                <td><?php echo  $sql1_result['call_receive_from']; ?></td>

                <td><?php echo  $sql1_result['remarks']; ?></td>
                <td><?php echo  $sql_result['status']; ?></td>
                <td><?php echo  $created_by; ?></td>
                <td><?php echo  $created_at; ?></td>
                <td><?php echo  cust_datetime($close_time); ?></td>
                <td>
                    <?php
                    if($attachment){ ?>
                        <a href="<?php echo  $attachment ; ?>" class="btn btn-success" >View Attachment 1</a>    
                    <?php } ?>
                    </td>
                                    <td>
                    <?php
                    if($attachment2){ ?>
                        <a href="<?php echo  $attachment2 ; ?>" class="btn btn-success" >View Attachment 2</a>    
                    <?php } ?>
                    </td>
                    
                    
                
            </tr>
            
            <?php $i++ ; } ?>  
        
            </tbody>
        </table>
        </div>
    </div>
</div>

        <?php } else{ 
            
            echo 'No History Found !' ;
        }
        ?>



<script src="../datatable/jquery.dataTables.js">
</script>
<script src="../datatable/dataTables.bootstrap.js">
</script>
<script src="../datatable/dataTables.buttons.min.js">
</script>
<script src="../datatable/buttons.flash.min.js">
</script>
<script src="../datatable/jszip.min.js">
</script>

<script src="../datatable/pdfmake.min.js">
</script>
<script src="../datatable/vfs_fonts.js">
</script>
<script src="../datatable/buttons.html5.min.js">
</script>
<script src="../datatable/buttons.print.min.js">
</script>
<script src="../datatable/jquery-datatable.js">
</script>