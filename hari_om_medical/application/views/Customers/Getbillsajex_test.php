<?php
if(count($Bill_deatils)){
if ($cust_id!="All" && $bill_type!=1) {
?>
<div class="table-responsive">
    <table class="table dt-responsive nowrap w-100" id="allsale-datatable">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>SNo</th>
            <th>Customer Name</th>
            <th>Date</th>
            <th>Bill ID</th>
            <th>QTY</th>
            <th>Total Amount</th>
            <th>Outstanding Amount</th>
            <th>Discount</th>
        </tr>
    </thead>
    <tbody>
    <?php
    
    foreach ($Bill_deatils as $key => $payment) {
    ?>
    <tr>
    <td>
        <input type="checkbox" name="payment[]" class="checkbox payment" value="<?=$payment->pur_id?>" onchange="total();" id="payment">
    </td>
    <td>
        <?=$key+1?>
    </td>
    <td><?=$payment->customer_name?></td>
    <td>
        <?=date('d-m-Y',strtotime($payment->date))?>
    </td>
    <td>
        <?=$payment->bill_id?>
    </td>
    <td>
        <?=$payment->totalqty?>
    </td>
    <td>
        <h5> <?=$payment->totalamt?></h5>
    </td>
    <td>
        <h5> <?=$payment->outstanding?>
        <input type="hidden" name="ttl[]" class='ttl' id="ttl" value="<?=$payment->outstanding?>">
    </h5>
    </td>
    <td>
        <h5> <?=$payment->discount?> <?php if($payment->dis_type=="Rupees"){ echo "Rs.";}else{ echo "%";} ?></h5>
    </td>
    
    
    </tr>
    <?php
    }?>                                                    
    </tbody>
    </table>
</div>
<div class="row text-right">
    <div class="col-md-4"></div>
        <div class="col-md-4"><input type="text" name="payamt" id="payamt" class="form-control" readonly>
        <input type="hidden" name="cust_id" value="<?=$cust_id?>"></div>
            <div class="col-md-4"><input type="submit" name="paybtn" class="btn btn-success" id="paybtn" disabled></div>
</div>
<?php
}
else
{
?>
<div class="table-responsive">
    <table class="table dt-responsive nowrap w-100" id="allsale-datatable">
        <thead class="thead-light">
        <tr>
            <th>SNo</th>
            <th>Customer Name</th>
            <th>Date</th>
            <th>Bill ID</th>
            <th>QTY</th>
            <th>Total Amount</th>
            <!--<th>OutStanding Amount</th>-->
            <th>Discount</th>
            <!--<th>GST</th>-->
            <!--<th>Action</th>-->
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($Bill_deatils as $key => $payment) {
        ?>
        <tr>
            <td>
                <?=$key+1?>
            </td>
                <td><?=$payment->customer_name?></td>
            <td>
                <?=date('d-m-Y',strtotime($payment->date))?>
            </td>
            <td>
                <?=$payment->bill_id?>
            </td>
            <td>
                <?=$payment->totalqty?>
            </td>
            <td>
                <h5> <?=$payment->totalamt?></h5>
            </td>
            <!--<td>-->
            <!--    <h5> <?=$payment->outstanding?></h5>-->
            <!--</td>-->
            <td>
                <h5> <?=$payment->discount?> <?php if($payment->dis_type=="Rupees"){ echo "Rs.";}else{ echo "%";} ?></h5>
            </td>
            <!--<td>-->
            <!--    <h5> <?=$payment->gstper?> <?php if($payment->gsttype=="Rupees"){ echo "Rs.";}else{ echo "%";} ?></h5>-->
            <!--</td>-->
            
        </tr>
        <?php
        }?>
        </tbody>
    </table>
</div>
<?php 
    } } else {
    ?>
    <p>No Bills Found</p>
    <?php
    }?>
<script>
$(document).ready(function() {
    $('#allsale-datatable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
    'copyHtml5',
    // 'csvHtml5',
    {
    extend: 'csvHtml5',
    text: 'Export CSV',
    filename: 'View All Sale Bill', // Set your custom filename here
    
    },
    'pdfHtml5',
    
    ]
    } );
} );
</script>
