   

   <?php
   if(count($Bill_deatils)){
   if ($cust_id!="All" && $bill_type!=1) {
    ?>
     <div class="table-responsive">
                                            <table class="table table-centered mb-0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Serial No</th>
                                                        <th>Customer Name</th>
                                                        <th>Date</th>
                                                        <th>Bill ID</th>
                                                        <th>QTY</th>
                                                        <th>Total Amount</th>
                                                        <th>Outstanding Amount</th>
                                                        <th>Discount</th>
                                                        <th>GST</th>
                                                        <th>Action</th>
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
                                                        <td>
                                                            <h5> <?=$payment->gstper?> <?php if($payment->gsttype=="Rupees"){ echo "Rs.";}else{ echo "%";} ?></h5>
                                                        </td>
                                                        <td>                                        
                                                        <a class="action-icon" href="<?=base_url('Sale/Bill_details')?>/<?=$payment->pur_id?>">
                                                            <i class="mdi mdi-eye">
                                                            </i>
                                                        </a>
                                                        <a class="action-icon" href="<?=base_url('Sale/Bill_Edit')?>/<?=$payment->pur_id?>">
                                                            <i class="mdi mdi-square-edit-outline">
                                                            </i>
                                                        </a>
                                                       <!--  <a class="action-icon" href="#" onclick="return Checkdel()">
                                                            <i class="mdi mdi-delete">
                                                            </i>
                                                        </a> -->
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
                                            <table class="table table-centered mb-0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Serial No</th>
                                                        <th>Customer Name</th>
                                                        <th>Date</th>
                                                        <th>Bill ID</th>
                                                        <th>QTY</th>
                                                        <th>Total Amount</th>
                                                        <th>OutStanding Amount</th>
                                                        <th>Discount</th>
                                                        <th>GST</th>
                                                        <th>Action</th>
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
                                                        <td>
                                                            <h5> <?=$payment->outstanding?></h5>
                                                        </td>
                                                        <td>
                                                            <h5> <?=$payment->discount?> <?php if($payment->dis_type=="Rupees"){ echo "Rs.";}else{ echo "%";} ?></h5>
                                                        </td>
                                                        <td>
                                                            <h5> <?=$payment->gstper?> <?php if($payment->gsttype=="Rupees"){ echo "Rs.";}else{ echo "%";} ?></h5>
                                                        </td>
                                                        <td>                                        
                                                        <a class="action-icon" href="<?=base_url('Sale/Bill_details')?>/<?=$payment->pur_id?>">
                                                            <i class="mdi mdi-eye">
                                                            </i>
                                                        </a>
                                                        <a class="action-icon" href="<?=base_url('Sale/Bill_Edit')?>/<?=$payment->pur_id?>">
                                                            <i class="mdi mdi-square-edit-outline">
                                                            </i>
                                                        </a>
                                                       <!--  <a class="action-icon" href="#" onclick="return Checkdel()">
                                                            <i class="mdi mdi-delete">
                                                            </i>
                                                        </a> -->
                                                    </td>
                                                        
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
