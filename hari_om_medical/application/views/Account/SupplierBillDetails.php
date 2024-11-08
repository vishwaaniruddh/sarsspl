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
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <h5>Supplier Name : <?=$supplier_data->company_name?></h5>
                                                <p class="mb-0">Address : <?=$supplier_data->address_1?>&nbsp;&nbsp;<?=$supplier_data->address_2?></p>
                                                <p class="mb-0">GST : <?=$supplier_data->gstno?></p>
                                                <p class="mb-0">PAN : <?=$supplier_data->pannumber?></p>
                                                <p class="mb-0">Invoice No : <?=$bills_data->bill_id?></p>
                                                <p class="mb-0">Invoice Date : <?=date('d/m/Y',strtotime($bills_data->date))?></p>
                                            </div>
                                            <div class="col-md-12">
                                                <h5>Order Details</h5>


                                                <div style="min-height: 200px;">
                                        <table width="100%" cellpadding="5" >
                                            <tbody >
                                            <tr style="border-top:1px solid black;border-bottom:1px solid black;">
                                                <td>MFG</td>
                                                <td>HSN</td>
                                                <td>Rack</td>
                                                <td>PARTICULARS</td>
                                                <td>PACK</td>
                                                <td>Batch</td>
                                                <td>Exp</td>
                                                <td>QTY</td>
                                                <td>MRP</td>
                                                <td>Rate</td>
                                                <td>Scheme</td>
                                                <td>Discount</td>
                                                <td>GST(%)</td>
                                                <td>Amount</td>
                                            </tr>
                                            <?php 
                                            $totalsgst=0;
                                            $totalcgst=0;
                                            foreach ($getbill_product as $key => $product) {
                                                 ?>
                                             <tr>  
                                                <td><?=$product->name?></td>
                                                <td><?=$product->hsn?></td>
                                                <td><?=$product->rack?></td>
                                                <td><?=$product->name?></td>
                                                <td><?=$product->category?></td>
                                                <td><?=$product->batch_no?></td>
                                                <td><?=date('m-Y',strtotime($product->expiry_date))?></td>
                                                <td><?=$product->qty?></td>
                                                <td><?=$product->price?></td>
                                                <td><?=$product->rate?></td>
                                                <td></td>
                                                <td><?=$product->dis?>%</td>
                                                <td><?=$product->gst?>%</td>
                                                <td>
                                                    <?php 
                                                    $ttamount=$product->totalamt; ?>
                                                    <?php $discountamount= $this->billing->getdiscamount($ttamount,$product->dis);
                                                   
                                                    echo  number_format($ttamount-$discountamount,2);
                                                 ?></td>
                                            </tr>
                                        <?php } ?>
                                            </tbody>
                                            
                                        </table>
                                        </div>
                                         <table width="100%">
                                            <tbody>
                                                <tr style="border-top:1px solid black;">
                                                    <td>GST %</td>
                                                    <td>Taxble Val</td>
                                                    <td>(%)CGST</td>
                                                    <td>Amt</td>
                                                    <td>(%)SGST</td>
                                                    <td>Amt</td>
                                                    <td rowspan="<?=4+count($getbill_product)?>" style="border-left: 1px solid black;border-right: 1px solid black;padding:2px;padding: 5px;"><h5>Item:<?=count($getbill_product)?></h5></td>
                                                    <td>Total</td>
                                                    <td style="border-right:1px solid black;"><?=number_format($bills_data->payamt,2)?></td>
                                                    <td>BILL TOTAL:</td>
                                                    <td><?=number_format($bills_data->payamt,2)?></td>
                                                </tr>
                                                <?php foreach ($getbill_product as $key => $product) {
                                                    
                                                    ?>
                                                <tr>
                                                    <td><?=$product->gst?>%</td>
                                                    <td><?php
                                                    $totalamt=$product->qty*$product->rate;
                                                    $totalamtwgst=$product->totalamt;
                                                     if($product->gst!=0){ echo $totalamt;}else { echo "0.00";}?></td>
                                                    <td><?php $gst=$product->gst;
                                                        $scgs=$gst/2;
                                                        $samt=$this->billing->getSGST($totalamtwgst,$gst);
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
                                                    <td><b><?=number_format($bills_data->payamt,2)?></b></td>                                                   
                                                </tr>
                                                <tr  style="border-top:1px solid black;">
                                                    <td colspan="12" ><h4 class="m-3"><b>Rupees: <?=$amtwords?></b></h4></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- </div> -->
                                         <div class="d-print-none mt-4">
                                            <div class="text-right">
                                                <a href="javascript:window.print()" class="btn btn-primary"><i class="mdi mdi-printer"></i>Print</a>
                                               
                                            </div>
                                        </div>   
                                        <!-- end buttons -->
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->