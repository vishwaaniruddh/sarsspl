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
                                                <span><small style="float:right;"><?=$Settings->Jurisdiction?></small></span>
                                                <!--<h3 style="font-family: 'Times New Roman', Times, serif;text-transform: uppercase;"><?=$Settings->Company_name?></h3>-->
                                                <h3 style="font-family: 'Times New Roman', Times, serif;text-transform: uppercase;"><? echo 'HARI OM MEDICOSE';?></h3>
                                                <!--<span><?=$Settings->Address?></span><br/>-->
                                                <span><? echo "WARD 36 G.D.HOSPITAL KHURSIPAR BHILAI ";?></span><br/>
                                                <!--<span>GST NO:<?=$Settings->GST?>, PAN: <?=$Settings->PAN?></span><br/>-->
                                                 <span>GST NO:<? echo '22BCKPS7210R1Z3';?>, PAN: <? echo 'BCKPS7210R';?></span><br/>
                                                <!--<span><?=$Settings->Licence_no?></span><br/>-->
                                                <span><? echo "DL: 20CT2023000091/21CT2023000091 V Dt: 11/01/2028" ?></span><br/>
                                                <!--<span>Ph No.:-<?=$Settings->Phone_no?>, Email.:<?=$Settings->email?></span>-->
                                                <span>Ph No.:-<? echo '8109910231';?></span>

                                            </td>
                                            <td width="20%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;padding:2px;font-family: 'Times New Roman', Times, serif;text-transform: uppercase;">
                                                <h4>TAX-INVOICE</h4>
                                                <h4>CASH</h4>
                                                <h4 >Inv.NO.:<?=$bills_data->bill_id?></h4>
                                                <h4>Date:<?=date('d/m/Y',strtotime($bills_data->date))?></h4>
                                                <p><?=date('h:i a',strtotime($bills_data->created_date))?> </p>
                                            </td>
                                            <td width="40%" align="left">
                                                <span>To :</span><br/>
                                                <h4 style="font-family: 'Times New Roman', Times, serif;text-transform: uppercase;"><b><?=$customer_data->first_name.' '.$customer_data->last_name?></b></h4>
                                                <span><?=$customer_data->address_1?></span><br/>
                                                <span><?=$customer_data->address_2?></span><br/>
                                                <span>Reffered By: <?
                                                    $name = $this->Customers_M->get_docname($bills_data->refby);
                                                    foreach($name as $doc){
                                                        echo $doc->first_name.' '.$doc->last_name;
                                                    }
                                                ?> </span><br/>
                                                <!--<span>GST:<?=$customer_data->gstno?>, PAN:<?=$customer_data->pannumber?></span><br/>-->
                                                <!--<span>DL:20B-61/97,21B-62/97,20D-63/97</span><br/>-->
                                                <!--<span>Aadhar:6575455356</span>-->
                                            </td>
                                            </tr> 
                                        </table>
                                        <div style="min-height: 200px;">
                                        <table width="100%" cellpadding="5" >
                                            <tbody >
                                            <tr style="border-top:1px solid black;border-bottom:1px solid black;">
                                                <td>MFG</td>
                                                <td>HSN</td>
                                                <!--<td>Rack</td>-->
                                                <td>PARTICULARS</td>
                                                <td>PACK</td>
                                                <td>Batch</td>
                                                <td>Exp</td>
                                                <td>QTY</td>
                                                <td>MRP</td>
                                                <!--<td>Scheme</td>-->
                                                <td>Discount</td>
                                                <!--<td>GST(%)</td>-->
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
                                                <!--<td><?=$product->rack?></td>-->
                                                <td><?=$product->name?></td>
                                                <td><?=$product->category?></td>
                                                <td><?=$product->batch_no?></td>
                                                <td><?=date('m/y',strtotime($product->expiry_date))?></td>
                                               
                                                <td><?=$product->qty?></td>
                                                 <td>
                                                 <?php 
                                                  
                                                 $rate=$this->billing->getnetamount($product->price,$product->gst);
                                                    echo $rate
                                                //  $rate = $this->Customers_M->getmrp($product->item_id,$product->batch_no);
                                                //  echo $rate->rate
                                                 ?>
                                                 </td>
                                                <!--<td></td>-->
                                                
                                                <td><?=$product->dis?>%</td>
                                                <!--<td><?=$product->gst?>%</td>-->
                                                <!--<td>-->
                                                    <?php 
                                                    
                                                    //     $x = $this->Customers_M->getmrp($product->item_id,$product->batch_no);
                                                    //  echo $x->gst.'%'
                                                    ?>
                                                <!--</td>-->
                                                <td>
                                                    <?php 
                                                    $ttamount=number_format($product->price*$product->qty,2); ?>
                                                    <?php
                                                     // $gstamount= $this->billing->getgstamount($ttamount,$product->gst);
                                                    //  $discountamount= $this->billing->getdiscamount($ttamount,$product->dis);
                                                    //  echo $product->dis;
                                                    //  if($discountamount!=0){
                                                    //      $tamt = $ttamount-$discountamount;
                                                    //  } else {
                                                    //      $tamt = $ttamount;
                                                    //  }
                                                     
                                                    //  echo number_format($tamt,2);
                                                    echo $ttamount;
                                                     
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
                                                    <!--<td><u>GST %</u></td>-->
                                                    <!--<td><u>Taxble Val</u></td>-->
                                                    <!--<td><u>(%)CGST</u></td>-->
                                                    <!--<td><u>Amt</u></td>-->
                                                    <!--<td><u>(%)SGST</u></td>-->
                                                    <!--<td><u>Amt</u></td>-->
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td rowspan="<?=2+count($getbill_product)?>" style="border-right: 1px solid black;border-end: 1px solid black;padding:2px;padding: 5px;">
                                                        <h5>Item:<?=count($getbill_product)?></h5>
                                                    </td>
                                                    <td>Total</td>
                                                    <td style="border-right:1px solid black;"><?=number_format($bills_data->payamt,2)?></td>
                                                    <td>BILL TOTAL:</td>
                                                    <td><?=number_format($bills_data->payamt,2)?></td>
                                                </tr>
                                                <?php 
                                                // echo $ttamount;
                                                 $prod_dis = $product->dis;
                                                if($prod_dis == '0'){
                                                    $discountamount= '0';
                                                }else{
                                                    $discountamount= $this->billing->getdiscamount($ttamount,$product->dis);
                                                }
                                                    // $discountamount= $this->billing->getdiscamount($ttamount,$product->dis);
                                                    // echo $tamt = number_format($product->price,2);
                                                    //  $discountamount = number_format($discountamount); 
                                                foreach ($getbill_product as $key => $product) {
                                                     
                                                    $totalamt=($product->qty*$product->price)-$discountamount;
                                                    $gst=$product->gst;
                                                        $scgs=$gst/2;
                                                        $samt=$this->billing->getSGST($totalamt,$gst);
                                                    
                                                    
                                                    ?>
                                                <tr>
                                                    
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
                                                    <td></td>
                                                    <td style="border-right:1px solid black;"></td> 
                                                    <td><b>Net AMOUNT R/o<b></td>
                                                    <td><b><?=number_format($bills_data->payamt,2)?></b></td>                                                   
                                                </tr>
                                                <tr  style="border-top:1px solid black;">
                                                    <td colspan="9">
                                                       
                                                        <span>Rupees: <?=$amtwords?></span><br/>
                                                            <!--<b>Bank :<?=$Settings->BankName?> A/c : <?=$Settings->accountNumber?> IFSC: <?=$Settings->IFSCCode?></b><br/>-->
                                                            <span>Price Difference Under Drug Price Control Order 1970 will be Refunded E&OE</span></td>
                                                    <td colspan="2" style="border-left:1px solid black;padding: 5px;">
                                                        <!--<b>NOTE:1TH-<?=$Settings->user_name?></b>-->
                                                        <br/>
                                                        <br/>
                                                        <span style="margin-left: 5px;">FOR, <?echo 'HARI OM MEDICOSE';?></span></td>                                                   
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