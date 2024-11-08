<?php 
include('config.php');
$Status=$_POST['status'];
// ini_set('display_errors', 1);

// ini_set('display_startup_errors', 1);

// error_reporting(E_ALL);




 if(isset($_POST['date1']) && isset($_POST['date2'])){

        $date1=date('Y-m-d',strtotime($_POST['date1']));
        $date2=date('Y-m-d',strtotime($_POST['date2']));
        $view="SELECT * FROM `commission_details` WHERE com_givien='".$Status."' AND created_at BETWEEN '".$date1."' AND '".$date2."'  Group BY `commission_to`";
$view=mysqli_query($con1,$view);

    }else{
        if($Status==''){

$view="SELECT * FROM `commission_details` Group BY `commission_to` ORDER BY `commission_details`.`id` DESC";


$view=mysqli_query($con1,$view);
}
else
{
    $view="SELECT * FROM `commission_details` WHERE com_givien='".$Status."' Group BY `commission_to` ORDER BY `commission_details`.`id` DESC";


$view=mysqli_query($con1,$view);
}
}
 ?>
 <div class="table-responsive" id="commissionTable">
 	<?php if($Status==0){ ?>
            <form action="PayToFranchise.php" method="Post">
           <?php } if($Status==1){ ?>
            <form action="PayToFranchiseSuccess.php" method="Post">
            	<?php } if($Status==2){ ?>
            <form action="" method="Post">
            <?php } ?>
                                <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
            <thead>
                <tr>
                <th>S.no</th>
                <?php if($Status==2){ ?>
                    <th>Date</th>
                <?php } ?>
                <?php if($Status==0){ ?>
                <th>Franchise Id</th>
            <?php } else {?>
                <th>Batch No</th>
            <?php } ?>
                <th>Franchise Name</th>
                <th>Total Comm</th> 
                <th>Distributed Comm</th> 
                <th>Pending Comm</th> 
                <th>Details</th> 
                <?php if($Status!=2){ ?>
                <th>Pay To</th> 
            <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if($Status!=2)
                {
                 $totalamountpe=0;
                $totalamountpay=0;

                    foreach ($view as $key => $view_result) {
                                $commission_to=$view_result['commission_to'];
                                $batch_no=$view_result['batch_no'];
                               $sql= mysqli_query($con,"SELECT name FROM `new_member` WHERE id='".$commission_to."'");
                               $memdata=mysqli_fetch_assoc($sql);

                               $totalAmount=mysqli_fetch_assoc(mysqli_query($con1,"SELECT SUM(amount) as TotalCom FROM `commission_details` WHERE commission_to='".$commission_to."' AND com_givien='0'"));
                               $totalamountpe=$totalamountpe+$totalAmount['TotalCom'];

                                $totalAmountpay=mysqli_fetch_assoc(mysqli_query($con1,"SELECT SUM(amount) as TotalCom FROM `commission_details` WHERE  commission_to='".$commission_to."' AND com_givien='2'"));
                                $totalamountpay=$totalamountpay+$totalAmountpay['TotalCom'];

                                ?>
                        <tr>
                            <td><?=$key+1?></td> 
                            <?php if($Status==0){ ?>
                <td><?=$commission_to?></td>
            <?php } else {?>
                <td><?=$batch_no?></td>
            <?php } ?>   
                            
                            <td><?php if($memdata!=''){ ?><?=$memdata['name']?> <?php }else{ ?> SAR<?php } ?></td>
                            <td><?=number_format($totalAmountpay['TotalCom']+$totalAmount['TotalCom'],2)?></td>
                            <td><?=number_format($totalAmountpay['TotalCom'],2)?></td>
                            <td><?=number_format($totalAmount['TotalCom'],2)?></td>
                             <td><a class="btn btn-danger" href="/adminpanel/CommisionBydate.php?id=<?=$commission_to?>&status=<?=$Status?><?php if($Status!=0){?>&batchno=<?=urlencode($batch_no)?><?php } ?><?php if(isset($_POST['date2']) && isset($_POST['date1'])){ ?> &date1=<?=$_POST['date1']?>&date2=<?=$_POST['date2']?> <?php }?>">Details</a></td>
                             <td><?php if($Status!=2){ ?><input type="checkbox" name="mem_id[]" value="<?=$commission_to?>/<?=number_format($totalAmount['TotalCom'],2, '.', '')?><?php if($Status==1){ echo "/".$batch_no; } ?>"> <?php } ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Amount</td>
                        <td><?=number_format($totalamountpay+$totalamountpe,2)?></td>
                        <td><?=number_format($totalamountpay,2)?></td>
                        <td><?=number_format($totalamountpe,2)?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                }
                
                if($Status==2)
                {
                    $view="SELECT * FROM `commission_Payment` WHERE status='1' ORDER BY `commission_Payment`.`id` DESC";
                    $view=mysqli_query($con1,$view);
                     $totalamountpe=0;
                     $totalamountpay=0;

                    foreach ($view as $key => $view_result) {
                                $commission_to=$view_result['commission_to'];
                                $batch_no=$view_result['batch_no'];
                                $created_date=$view_result['created_date'];
                               $sql= mysqli_query($con,"SELECT name FROM `new_member` WHERE id='".$commission_to."'");
                               $memdata=mysqli_fetch_assoc($sql);

                               $totalAmount=mysqli_fetch_assoc(mysqli_query($con1,"SELECT SUM(amount) as TotalCom FROM `commission_details` WHERE commission_to='".$commission_to."' AND com_givien='0' "));
                               $totalamountpe=$totalamountpe+$totalAmount['TotalCom'];

                               $totalAmountpay=mysqli_fetch_assoc(mysqli_query($con1,"SELECT SUM(amount) as TotalCom FROM `commission_details` WHERE  commission_to='".$commission_to."' AND com_givien='2'"));
                                $totalamountpay=$totalamountpay+$totalAmountpay['TotalCom'];
                                ?>
                        <tr>
                            <td><?=$key+1?></td> 
                           
           
                            <td><?=date('d-M-Y',strtotime($created_date))?></td>
                            <td><?=$batch_no?></td>
              
                            
                            <td><?php if($memdata!=''){ ?><?=$memdata['name']?> <?php }else{ ?> SAR<?php } ?></td>
                            <td><?=number_format($totalAmountpay['TotalCom']+$totalAmount['TotalCom'],2)?></td>
                            <td><?=number_format($totalAmountpay['TotalCom'],2)?></td>
                            <td><?=number_format($totalAmount['TotalCom'],2)?></td>
                             <td><a class="btn btn-danger" href="/adminpanel/CommisionBydate.php?id=<?=$commission_to?>&status=<?=$Status?>&batchno=<?=urlencode($batch_no)?><?php if(isset($_POST['date2']) && isset($_POST['date1'])){ ?> &date1=<?=$_POST['date1']?>&date2=<?=$_POST['date2']?> <?php }?>">Details</a></td>
                             
                        </tr>
                    <?php
                    }
                    ?>
                  <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Amount</td>
                        <td><?=number_format($totalamountpay+$totalamountpe,2)?></td>
                        <td><?=number_format($totalamountpay,2)?></td>
                        <td><?=number_format($totalamountpe,2)?></td>
                        <td></td>
                    </tr>
                    <?php
                   
                }
                 ?>
            </tbody>
        </table>
        <?php if($Status!=2){ ?>
            <input type="hidden" name="txnid" value="<?=time()?>">
        <button style="float:right;" onclick="return CheckResponce()" class="btn btn-danger">Proceed To Pay</button>
    <?php } ?>
    </div>


    <script>
 $(document).ready(function() {
    $('#example').DataTable( {
        <?php if($Status!=2){?>
        "order": [[ 3, "desc" ]],
    <?php } ?>
        dom: 'Bfrtip',
        buttons: [
            {
                        extend: 'excelHtml5',
                        title: 'Orders Excel',
                        text:'Export to excel'
                        //Columns to export
                        //exportOptions: {
                       //     columns: [0, 1, 2, 3,4,5,6]
                       // }
                    },'pageLength'
        ]
    } );
} );
</script>