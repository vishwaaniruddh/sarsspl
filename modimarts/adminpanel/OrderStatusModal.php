<?php
session_start();
include('config.php');
include('adminaccess.php');
include('../apidata.php');
$orderid=$_POST['orderid'];

 $qrytoken = "select token from add_ship_rocket_token where id='1'";
            $result_token = mysqli_query($con1, $qrytoken);
            $rowtoken    = mysqli_fetch_row($result_token);
            $orderdetails=mysqli_query($con1,"SELECT * FROM `Order_ent` WHERE id=".$orderid." ORDER BY `Order_ent`.`id` ASC");
$orddetails=mysqli_fetch_assoc($orderdetails);
?>
 <div class="col-md-12">

            <h5>Order Details Order Id <?=$orderid?></h5>
            <div class="form-group">
                <table class="table">
                    <tr>
                        <td>S.No</td>
                        <td>Product image</td>
                        <td style="width: 40%;">Product Name</td>
                        <td colspan="2">Status</td>
                    </tr>

                    <?php
                    $prodata        = array();
                    $i              = 0;
                    $show_email_sql = mysqli_query($con1, "select * from order_details  where oid='" . $orderid . "' ");

                    while ($show_order_sql_result1 = mysqli_fetch_assoc($show_email_sql)) {
                        $pro_image1      = $show_order_sql_result1['image'];
                        $pro_name1       = $show_order_sql_result1['product_name'];
                        $item_id         = $show_order_sql_result1['item_id'];
                        $proodr          = $show_order_sql_result1['id'];
                        $shipping_status = $show_order_sql_result1['shipping_status'];
                        $track_Status    = $show_order_sql_result1['track_Status'];
                        $discount        = $show_order_sql_result1['discount'];
                        $track_id        = $show_order_sql_result1['track_id'];
                        $outside_product = $show_order_sql_result1['outside_product'];

                        $productitem_id = $show_order_sql_result1['item_id'];
                        $_product_id    = explode('/', $productitem_id);

                        $sku_id     = $_product_id[1];
                        $product_id = $_product_id[2];

                        ?>

                                        <tr>
                                            <td><?=$i + 1?></td>
                                            <td> <img src="<?=$pro_image1?>" alt="<?=$pro_name1?>" style="width:50px;height: 50px;"> </td>
                                            <td><b><?=$pro_name1?></b></td>
                                         
                                            <td>
                                                <?php
                    if ($outside_product != 1) {


                        if($track_Status!=''){

                            $shiorddetail = mysqli_query($con1, "SELECT * FROM `order_shipping` WHERE oid='" . $orderid. "'");

                            $statusty=1;  
                            $count=mysqli_num_rows($shiorddetail); 

                            if($count){ 
                            while (($data = mysqli_fetch_assoc($shiorddetail))) {
                                $gettrackdetails = $data['gettrackdetails'];
                                
                                if($gettrackdetails!=''){
                                $datajson=json_decode($gettrackdetails);
            
                                $rlstatus=$datajson->tracking_data->shipment_track[0]->current_status;  
                             
                              echo '<span class="text-success" >'.$rlstatus.'</span>';
                              $statusty=0;
                                }                                
                            }

                            }else {

                                if ($orddetails['status'] == 0) {
                                    echo "<span class='text-warning' >Waiting For Approval</span>";
                                }
                                if ($orddetails['status'] == 1) {
                                    echo "<span class='text-info' >Waiting For Dispatch</span>";
                                }
                                if ($orddetails['status'] == 2) {
                                    echo "<span class='text-primary' >Dispatch</span>";
                                }
                                if ($orddetails['status'] == 3) {
                                    echo "<span class='text-success' >Delivered</span>";
                                }
                                if ($orddetails['status'] == 4) {
                                    echo "<span class=' text-danger' >Rejected</span>";

                                }
                                if ($orddetails['status'] == 5) {
                                    echo "<span class=' text-danger' >Refunded</span>";

                                }
                                if ($orddetails['status'] == 6) {
                                    echo "<span class=' text-danger' >Cancelled</span>";

                                }
                            }
                        }
                        else
                        {
                            if ($orddetails['status'] == 0) {
                                    echo "<span class='text-warning' >Waiting For Approval</span>";
                                }
                                if ($orddetails['status'] == 1) {
                                    echo "<span class='text-info' >Waiting For Dispatch</span>";
                                }
                                if ($orddetails['status'] == 2) {
                                    echo "<span class='text-primary' >Dispatch</span>";
                                }
                                if ($orddetails['status'] == 3) {
                                    echo "<span class='text-success' >Delivered</span>";
                                }
                                if ($orddetails['status'] == 4) {
                                    echo "<span class=' text-danger' >Rejected</span>";

                                }
                                if ($orddetails['status'] == 5) {
                                    echo "<span class=' text-danger' >Refunded</span>";

                                }
                                if ($orddetails['status'] == 6) {
                                    echo "<span class=' text-danger' >Cancelled</span>";

                                }

                        }
                      
                        } else {
                            if($show_order_sql_result1['shipping_status']==0){
                            $order_Res = $orddetails['other_res'];
                            $Ordres    = json_decode($order_Res);
                            $ressts    = $Ordres->Status;
                            // var_dump($Ordres);
                            if ($ressts == "success") {
                                $apiorderid = $Ordres->Order_no;
                                $prostst    = Prostatus($apiorderid);                                
                                $Dis_Status = $prostst[0]->Dispatch_status;

                                echo "<span class=' text-warning' >" . $Dis_Status . " (From Discount Tadka)</span>";

                            } else {
                                echo "<span class=' text-danger' >Order Failed ( From Discount Tadka)</span>";
                            }
                        }
                        else
                        {
                             if ($show_order_sql_result1['shipping_status'] == 1) {
                                echo "<span class='text-info' >Waiting For Dispatch</span>";
                            }
                            if ($show_order_sql_result1['shipping_status'] == 2) {
                                echo "<span class='text-primary' >Dispatch</span>";
                            }
                            if ($show_order_sql_result1['shipping_status'] == 3) {
                                echo "<span class='text-success' >Delivered</span>";
                            }
                            if ($show_order_sql_result1['shipping_status'] == 4) {
                                echo "<span class=' text-danger' >Rejected</span>";

                            }
                            if ($show_order_sql_result1['shipping_status'] == 5) {
                                echo "<span class=' text-danger' >Refunded</span>";

                            }
                            if ($show_order_sql_result1['shipping_status'] == 6) {
                                echo "<span class=' text-danger' >Cancelled</span>";

                            }
                        }
                    }
                    ?>



                                            </td>

                                        </tr>
                                    <?php $i++;}?>

                           </tr>
                       </table>
</div>