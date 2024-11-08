 <!-- Start Content-->

 <style>
     body {
        color:black;
     }
     .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin: 2px 0;
    font-weight: 700;
}
 </style>
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Payment</a></li>
                                            <li class="breadcrumb-item active">Invoice</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Invoice</h4>
                                </div>
                            </div>
                        </div>     

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div style="border: 2px solid black;">
                                        <table width="100%" valign="top" cellpadding="5" >
                                            <tr>
                                            <td width="40%">
                                                <span><?=$Settings->slogan?><small style="float:right;"><?=$Settings->Jurisdiction?></small></span>
                                                <h3 style="font-family: 'Times New Roman', Times, serif;text-transform: uppercase;"><?=$Settings->Company_name?></h3>
                                                <span><?=$Settings->Address?></span><br/>
                                                <span>GST NO:<?=$Settings->GST?>, PAN: <?=$Settings->PAN?></span><br/>
                                                <span><?=$Settings->Licence_no?></span><br/>
                                                <span>Ph No.:-<?=$Settings->Phone_no?>, Email.:<?=$Settings->email?></span>

                                            </td>
                                            <td width="20%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;padding:2px;font-family: 'Times New Roman', Times, serif;text-transform: uppercase;">
                                                <h4>TAX-INVOICE</h4>
                                                <h4>CREDIT</h4>
                                                <h4 >Inv.NO.:<?=$bills_data->bill_id?></h4>
                                                <h4>Date:<?=date('d/m/Y',strtotime($bills_data->date))?></h4>
                                               <!-- <p><?=date('h:i a',strtotime($bills_data->date))?></p>-->
                                            </td>
                                            <td width="40%" align="left">
                                                <span>To :</span><br/>
                                                <h4 style="font-family: 'Times New Roman', Times, serif;text-transform: uppercase;"><b><?=$customer_data->company_name?></b></h4>
                                                <span><?=$customer_data->address_1?></span><br/>
                                                <span><?=$customer_data->address_2?></span><br/>
                                                <span>Phone:<?=$customer_data->phone_number?></span><br/>
                                                <span>GST:<?=$customer_data->gstno?>, PAN:<?=$customer_data->pannumber?></span><br/>
                                                <span><?=$customer_data->comments?></span><br/>
                                               <!-- <span>Aadhar:6575455356</span>-->
                                            </td>
                                            </tr> 
                                        </table>
                                        <div style="min-height: 200px;">
                                        <table width="100%" cellpadding="5" >
                                            <tbody >
                                            <tr style="border-top:1px solid black;border-bottom:1px solid black;">
                                                <td>MFG</td>
                                                <td>HSN</td>
                                                <td>PARTICULARS</td>
                                                <td>Unit</td>
                                                <td>Batch</td>
                                                <td>Exp</td>
                                                <td>QTY</td>
                                                <td>MRP</td>
                                                <td>Rate</td>
                                                <td>Sch%</td>
                                                <td>Dis%</td>
                                                <td>GST(%)</td>
                                                <td>Amount</td>
                                            </tr>
                                            <?php 
                                            $totalsgst=0;
                                            $totalcgst=0;
                                            $taxableamount=0;
                                            $ttamount=0;
                                            foreach ($getbill_product as $key => $product) {
                                                 ?>
                                             <tr>  
                                                <td><?php 
                                                     $y = $this->Customers_M->getmfg($product->item_id);
                                                     //print_r($y);
                                                     echo substr($y[0]->company_name,0,3);
                                                    ?>
                                                </td>
                                                <td><?=$product->hsn?></td>
                                                <td><?=$product->name?></td>
                                                <td><?=$product->unit?></td>
                                                <td><?=$product->batch_no?></td>
                                                <td><?=date('m/y',strtotime($product->expiry_date))?></td>
                                               
                                                <?php if(isset($product->freeqty)) { ?>
                                                    <td><?=$product->qty?>+<?=$product->freeqty;?></td>
                                                <?php } else{ ?>
                                                    <td><?=$product->qty?></td>
                                                <?php }?>
                                                
                                                <td><?php 
                                                     $x = $this->Customers_M->getmrp($product->item_id,$product->batch_no);
                                                     echo $x->price
                                                ?></td>
                                                 <td><?php 
                                                 //$rate=$this->billing->getnetamount($product->price,$product->gst);
                                                 if($x->gst==12)
                                                 $trf=0.71;
                                                 else if($x->gst==18)
                                                 $trf=0.678;
                                                 
                                                  echo number_format($x->price*$trf,2);
                                             ?></td>
                                                <td><?php
                                                //echo $x->price*0.71*$product->qty.'--'; 
                                                $taxableamount=$taxableamount+$x->price*$trf*$product->qty; 
                                                //echo $taxableamount;
                                                ?>
                                                </td>
                                                <td><?=$product->dis?>%</td>
                                                <td><?=$x->gst?>%</td>
                                                <td>
                                                    <?php 
                                                    $amount=$x->price*$trf*$product->qty+($x->price*$trf*$product->qty*$x->gst)/100; 
                                                    $ttamount=$ttamount+$amount;
                                                    echo number_format($amount,2);
                                                    ?>
                                                    <?php
                                                     // $gstamount= $this->billing->getgstamount($ttamount,$product->gst);
                                                     $discountamount= $this->billing->getdiscamount($ttamount,$product->dis);
                                                    // echo  number_format($ttamount-$discountamount,2);
                                                 ?></td>
                                            </tr>
                                        <?php } ?>
                                            </tbody>
                                            
                                        </table>
                                        </div>
                                         <table width="100%">
                                            <tbody>
                                                <tr style="border-top:1px solid black;">
                                                    <td><u>GST %</u></td>
                                                    <td><u>Taxble Val</u></td>
                                                    <td><u>(%)CGST</u></td>
                                                    <td><u>Amt</u></td>
                                                    <td><u>(%)SGST</u></td>
                                                    <td><u>Amt</u></td>
                                                    <td rowspan="<?=4+count($getbill_product)?>" style="border-left: 1px solid black;border-right: 1px solid black;padding:2px;padding: 5px;"><h5>Item:<?=count($getbill_product)?></h5></td>
                                                    <td>Total</td>
                                                    <td style="border-right:1px solid black;"><?=$taxableamount?></td>
                                                    <td>BILL TOTAL:</td>
                                                    <td><?=number_format($ttamount,2)?></td>
                                                </tr>
                                                <?php foreach ($getbill_product as $key => $product) {
                                                    
                                                    ?>
                                                <tr>
                                                    <td><?=$product->gst?>%</td>
                                                    <td><?php
                                                    //$totalamt=($product->qty*$product->rate)-$discountamount;
                                                    $x = $this->Customers_M->getmrp($product->item_id,$product->batch_no);
                                                    // echo $x->price;
                                                 if($x->gst==12)
                                                 $trf=0.71;
                                                 else if($x->gst==18)
                                                 $trf=0.678;
                                                 
                                                  $totalamt = $x->price*$trf*$product->qty;
                                                     if($product->gst!=0){
                                                         echo $totalamt;
                                                      //$this->billing->getnetamount($totalamt,$product->gst);
                                                      }else { echo "0.00";}?></td>
                                                    <td><?php $gst=$product->gst;
                                                        $scgs=$gst/2;
                                                        $samt=$totalamt*$scgs/100;
                                                        ?> <?=$scgs?>%
                                                    </td>
                                                    <td><?=number_format($samt,2)?></td>
                                                    <td><?=$scgs?>%</td>
                                                    <td><?=number_format($samt,2)?></td>
                                                    <td></td>
                                                    <td style="border-right:1px solid black;"></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                               <?php
                                               $totalsgst = $totalsgst+$samt;
                                               $totalcgst = $totalcgst+$samt;
                                                } ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>CGST Amt</td>
                                                    <td style="border-right:1px solid black;"><?=number_format($totalsgst,2)?></td> 
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>SGST Amt</td>
                                                    <td style="border-right:1px solid black;"><?=number_format($totalcgst,2)?></td> 
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                     <td style="border-right:1px solid black;"></td> 
                                                    <td><b>Net AMOUNT R/o<b></td>
                                                    <td><b><?=number_format(round($ttamount))?></b></td>                                                   
                                                </tr>
                                                <tr  style="border-top:1px solid black;">
                                                    <td colspan="9">
                                                       
                                                        <span>Rupees: <?=$amtwords?></span><br/>
                                                            <b>Bank :<?=$Settings->BankName?> A/c : <?=$Settings->accountNumber?> IFSC: <?=$Settings->IFSCCode?></b><br/>
                                                            <span>Price Difference Under Drug Price Control Order 1970 will be Refunded E&OE</span></td>
                                                    <td colspan="2" style="border-left:1px solid black;padding: 5px;"><b>NOTE:1TH-<?=$Settings->user_name?></b>
                                                        <br/>
                                                        <br/>
                                                        <span style="margin-left: 5px;">FOR, <?=$Settings->Company_name?></span></td>                                                   
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                         <div class="d-print-none mt-4">
                                            <div class="text-right">
                                                <a href="javascript:window.print()" class="btn btn-primary"><i class="mdi mdi-printer"></i>Print</a>
                                               
                                            </div>
                                        </div>   
                                        <!-- end buttons -->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->