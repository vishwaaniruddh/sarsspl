<?php
include('../connect.php');

function getIndianCurrency(float $number) {
    $decimal       = round($number - ($no = floor($number)), 2) * 100;
    $hundred       = null;
    $digits_length = strlen($no);
    $i             = 0;
    $str           = array();
    $words         = array(0 => '', 1          => 'One', 2        => 'Two',
        3                        => 'Three', 4     => 'Four', 5       => 'Five', 6 => 'Six',
        7                        => 'Seven', 8     => 'Eight', 9      => 'Nine',
        10                       => 'Ten', 11      => 'Eleven', 12    => 'Twelve',
        13                       => 'Thirteen', 14 => 'Fourteen', 15  => 'Fifteen',
        16                       => 'Sixteen', 17  => 'Seventeen', 18 => 'Eighteen',
        19                       => 'Nineteen', 20 => 'Twenty', 30    => 'Thirty',
        40                       => 'Forty', 50    => 'Fifty', 60     => 'Sixty',
        70                       => 'Seventy', 80  => 'Eighty', 90    => 'Ninety');
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_length) {
        $divider = (2 == $i) ? 10 : 100;
        $number  = floor($no % $divider);
        $no      = floor($no / $divider);
        $i += 10 == $divider ? 1 : 2;
        if ($number) {
            $plural  = (($counter = count($str)) && $number > 9) ? null : null;
            $hundred = (1 == $counter && $str[0]) ? ' And ' : null;
            $str[]   = ($number < 21) ? $words[$number] . ' ' . $digits[$counter]. ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
        } else {
            $str[] = null;
        }

    }
    $Rupees = implode('', array_reverse($str));
    $paise  = ($decimal > 0) ? " " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise.' only';
}

function getnetamount($amount,$percent){

    if($percent!=0 && $amount!=0 ){

   $gst_amount = $amount-($amount*(100/(100+$percent)));
   $percentcgst = number_format($gst_amount/2, 2, '.', '');
   $percentsgst =  number_format($gst_amount/2, 2, '.', '');
  
   
   $withoutgst = number_format($amount - $gst_amount,2, '.', '');
   return $withoutgst;
}
return 0;
}


function getSGST($amount,$percent){
    if($percent!=0 && $amount!=0 ){
   $gst_amount = $amount-($amount*(100/(100+$percent)));
   $percentcgst = number_format($gst_amount/2, 2, '.', '');
   $percentsgst =  number_format($gst_amount/2, 2, '.', '');
   return $percentsgst;
}else
{
    return 0;
}

}

function getGSTType($proddID)
{
    include('../connect.php');
    global $con1;

      $prod = mysqli_query($con1,"SELECT gst_with FROM product_model where id='".$proddID."'");
      $product_name = mysqli_fetch_assoc($prod);
      return $product_name['gst_with'];

}



function simplegstexcluded($amount,$percent){
   $gst_amount = ($amount*$percent)/100;
   $total = number_format($amount+$gst_amount, 2, '.', '');
   $percentcgst = number_format($gst_amount/2, 3, '.', '');
   $percentsgst = number_format($gst_amount/2, 3, '.', '');
   return $total;
}


function getHTMLPurchaseDataToPDF($result, $oid)
{
    include('../connect.php');
$show_email_sql = mysqli_query($con1, "select * from order_details  where oid='" . $oid . "' ");

$userdetails= mysqli_fetch_assoc($show_email_sql);
ob_start();

// $oid = '256';

$sql = mysqli_query($con1 , "SELECT * FROM Order_ent WHERE id = '".$oid."'");

$sql_result = mysqli_fetch_assoc($sql);
$total_amount = $sql_result['amount'];
$txn_id = $sql_result['transaction_id'];
$shipping = $sql_result['shipping_charges'];
$userid = $sql_result['user_id'];
$date = $sql_result['date'];
$total_gst = "0";

$gst=$sql_result['gst_details'];
$pan=$sql_result['pan_details'];
$discount=$sql_result['discount'];
$order_id=$result["id"];
$ship_to=$result["ship_to"];


$response=$sql_result['ord_response'];
if ($response!='') {
   $response=json_decode($response);
                    $paytype=$response;                    
                    $response=$response[5];
                    $response = explode("=",$response);
                    $paymentmethod= $response[1];

                    $paytype=$paytype[6];
                    $paytype = explode("=",$paytype);
                    $paymenttype= $paytype[1];
}
else
{
    $paymentmethod= "";
    $paymenttype= "";

}
                    



// $shipping_charges = get_shipping_charges($total_amount);


 $date=date("d-M-Y h:i:s A", strtotime($date));

$sql_address = mysqli_query($con1,"select * from new_order where oid='".$result["id"]."'");

            $sql_address_result = mysqli_fetch_assoc($sql_address);

        $name = $sql_address_result['name'];
        $email = $sql_address_result['email'];
        $add1 = $sql_address_result['address'];       
        $mobile = $sql_address_result['phone'];
        $city = $sql_address_result['city'];
        $pincode = $sql_address_result['zip'];
        $state = $sql_address_result['state'];  

        $bill_name = $sql_address_result['bill_name'];
        $bill_email = $sql_address_result['bill_email'];
        $bill_address = $sql_address_result['bill_address'];       
        $bill_phone = $sql_address_result['bill_phone'];
        $bill_city = $sql_address_result['bill_city'];
        $bill_zip = $sql_address_result['bill_zip'];
        $bill_state = $sql_address_result['bill_state'];


        $country = $sql_address_result['country'];

        $getstatecode=mysqli_fetch_assoc(mysqli_query($con1,"SELECT gst_code FROM `states` WHERE state_name='".trim($state)."'"));
        $statecode=$getstatecode['gst_code'];

        


?>
<!DOCTYPE doctype html>
<html>
    <head>
        <meta charset="utf-8">
            <title>
                Untitled Document
            </title>
            
        </meta>
        <style>
            table {
              width: 100%;
            }
            td 
            {
                margin: 0;
                padding: 0;
            }

p {
    margin: 0;
    padding: 0;
}


        </style>
    </head>
    <body>
        <div id="panel" style="padding: 0;margin: 0;">
            <table border="0" cellpadding="0" cellspacing="0" class="tb" width="100%">
                <tbody>
                    <tr>
                        <td align="center" class="txt"  style="width: 25%;">
                            <img alt="Allmart" src="http://allmart.world/assets/logo.png" style="width:100px;"/>
                        </td>
                        <td align="center" class="txt" colspan="11" height="5" style="color:black; font-weight:800; font-family: 'Muli', sans-serif;width: 75%"><font style="font-size:20px;"><b>ALLMART ECOMMERCE LLP</b></font><br/><font style="padding:0;margin:0;font-size: 11px;" >Allmart Building No. 2, MHB Colony No. 1, Near Pancholia School, Mahavir Nagar, Kandivali (W), Mumbai, Maharashtra, 400067 IN<br/>Mob No: 9892384666 Email id: enquiry.allmart@gmail.com</font><br/><font style="padding:0;margin:0;font-size: 13px;" >www.Allmart.World</font>
                        </td>
                    </tr>
                    <tr style="margin-bottom: 5px;"><td align="center" class="txt"  style="width: 25%;"></td><td align="center" class="txt" width="75%"><h2 >TAX INVOICE</h2></td>
                    </tr>
                </tbody>
            </table>
            <table border="0" cellpadding="0" class="parent_table" cellspacing="0"  style="border:1px solid black;padding: 0;margin: 0;" width="100%"><tbody><tr><td colspan="12" style="padding: 0;margin: 0;"><table border="0" cellpadding="1" cellspacing="0" class="child_table"    style="margin-top: 5px;border-collapse: collapse;border-bottom: 1px solid black;" width="100%"><tbody>
                <tr><td colspan="2" style="border-right:1px solid black;font-size:9px;font-weight: bold;" >Details of Buyer (Sold to)
                                        </td>
                                        <td colspan="2" style="font-size:9px;font-weight: bold;" >Details of Consignee <?php if($ship_to!=2){ ?> (Shipped to) <?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border-right:1px solid black;font-size:9px;font-weight: bold;"   ><?=$name?>
                                        </td>
                                        <td colspan="2" style="font-size:9px;font-weight: bold;"><?=$name?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border-right:1px solid black;font-size:9px;"  ><?=$add1?>
                                        </td>
                                        <td colspan="2" style="font-size:9px;" ><?=$add1?>
                                        </td>
                                    </tr>
                                    

                                     <tr>
                                        <td style="font-size:9px;"><?=$city?></td>
                                        <td style="border-right:1px solid black;font-size:9px;"><?=$pincode?></td>
                                        <td  style="font-size:9px;"><?=$city?></td>
                                        <td style="font-size:9px;"><?=$pincode?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="font-size:9px;"><?=$state?></td>
                                        <td style="border-right:1px solid black;font-size:9px;"><?=$country?></td>
                                        <td  style="font-size:9px;"><?=$state?></td>
                                        <td style="font-size:9px;"><?=$country?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:9px;font-weight: bold;">GSTIN: <?=$gst?></td>
                                        <td style="border-right:1px solid black;font-size:9px;font-weight: bold;"  >Pan No: <?=$pan?></td>
                                        <td  style="font-size:9px;font-weight: bold;">GSTIN: <?=$gst?></td><td style="font-size:9px;font-weight: bold;">Pan No: <?=$pan?></td>
                                    </tr>
                                     <tr>
                                        <td style="font-size:9px;"  >Mobile: <?=$mobile?></td>
                                         <td  style="font-size:9px;border-right:1px solid black;"><?=$email?></td>
                                        <td style="font-size:9px;"  >Mobile: <?=$mobile?></td>
                                        <td style="font-size:9px;"><?=$email?></td>
                                    </tr>
                                   
                                    <tr>
                                        <td style="font-size:9px;font-weight: bold;">State: <?=$state?></td>
                                        <td style="border-right:1px solid black;font-size:9px;font-weight: bold;">State Code: <?=$statecode?></td>
                                            <td style="font-size:9px;font-weight: bold;">State: <?=$state?></td>
                                        <td style="font-size:9px;font-weight: bold;" >State Code: <?=$statecode?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr><td colspan="12" style="padding: 0;margin: 0;"><table border="0" cellpadding="1" cellspacing="0"   style="margin-top: 30px;border-collapse: collapse;"><tbody style="width: 100%;">
                        <tr><td colspan="2" style=" font-size:9px; color:#000;font-family: 'Muli', sans-serif;margin:5px;border-right: 1px solid black;">Invoice Number: <?=$order_id?></td>
                                        <td colspan="2" style=" font-size:9px; color:#000; font-family: 'Muli', sans-serif;margin:5px;border-right: 1px solid black;">Order Number: #<?=$order_id?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"  style=" font-size:9px; color:#000;font-family: 'Muli', sans-serif;margin:5px;border-right: 1px solid black;">Invoice Date: <?=$date?></td>
                                        <td colspan="2" style=" font-size:9px; color:#000; font-family: 'Muli', sans-serif;margin:5px;border-right: 1px solid black;">Order Date: <?=$date?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style=" font-size:9px; color:#000;font-family: 'Muli', sans-serif;margin:5px;border-right: 1px solid black;">Payment Terms:</td>
                                        <td colspan="2" style=" font-size:9px; color:#000; font-family: 'Muli', sans-serif;margin:5px;border-right: 1px solid black;">Dispatch Thrg: </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style=" font-size:9px; color:#000;font-family: 'Muli', sans-serif;margin:5px;border-right: 1px solid black;">E-Way Bill No:</td>
                                        <td colspan="2" style=" font-size:9px; color:#000; font-family: 'Muli', sans-serif;margin:5px;border-right: 1px solid black;">Trans. Receipt:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style=" font-size:9px; color:#000;font-family: 'Muli', sans-serif;margin:5px;border-right: 1px solid black;">Destination:</td>
                                        <td colspan="2" style=" font-size:9px; color:#000; font-family: 'Muli', sans-serif;margin:5px;border-right: 1px solid black;">Date : </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                     <tr ><td colspan="12" style="padding: 0;margin: 0;"><table cellpadding="2"  style="margin-top: 30px;border-collapse: collapse;"    width="100%" ><tbody><tr ><td align="center"  width="5%" style="font-size:8px;border:1px solid black;"><strong> S.N</strong>
                                                        </td>
                                                        <td align="center" width="16%" style="font-size:8px;border:1px solid black;"><strong>Particulars</strong></td>
                                                        <td align="left" width="10%" style="font-size:8px;border:1px solid black;"><strong>HSN Code</strong></td>
                                                        <td align="center" width="5%" style="font-size:8px;border:1px solid black;"><strong>Qty</strong></td>
                                                        <td align="center" width="9%" style="font-size:8px;border:1px solid black;"><strong>Gross Rate</strong></td>
                                                        <td align="center" width="5%" style="font-size:8px;border:1px solid black;"><strong>Discount</strong></td>
                                                        <td align="center" width="8%" style="font-size:8px;border:1px solid black;"><strong>Discount Amt</strong></td>
                                                        <td align="center" width="9%" style="font-size:8px;border:1px solid black;"><strong>Net Rate</strong></td>
                                                        <td align="center" width="9%" style="font-size:8px;border:1px solid black;"><strong>Taxable Amount</strong></td>
                                                        <td align="center" width="5%" style="font-size:8px;border:1px solid black;"><strong>GST %</strong></td>
                                                        <td align="center" width="9%" style="font-size:8px;border:1px solid black;"><strong>GST Amt</strong></td>
                                                        <td align="center" width="10%" style="font-size:8px;border:1px solid black;"><strong>Total Amount</strong></td>
                                                    </tr>
                                                    <?php
                                                    $pcount=0;
                                                   
                                                    $i=1;
                                                    $total_qty = 0 ;
                                                    $total     = 0;
                                                    $totalcgst=0;
                                                    $totalsgst=0;
                                                    $totaligst=0;
                                                    $ttldiscountamt=0;
                                                    $ttlnetamt=0;
                                                    $final_net_amt = 0;
                                                    $totalnetamount=0;
                                                    $detail_sql = mysqli_query($con1,"select * from order_details where oid='".$oid."'");
                                                    while($pro_sql_result = mysqli_fetch_assoc($detail_sql)){

                                                        $collect[] = $pro_sql_result;
                                                        $pro_amount = $pro_sql_result['rate'];
                                                        $pro_qty = $pro_sql_result['qty'];
                                                        $outerproduct = $pro_sql_result['outside_product'];
                                                        $pro_type = 0;
                                                        // $product_id = $pro_sql_result['product_id'];
                                                        $product_name = $pro_sql_result['product_name'];
                                                        $item_id=$pro_sql_result['item_id'];
                                                        $orderdata=explode('/', $item_id);
                                                        $proid=$orderdata[0];
                                                        $productIdName=$orderdata[2];

                                                        if($outerproduct==1){
                                                           
                                                          $GSTType=0;  
                                                        }
                                                        else
                                                        {
                                                         $GSTType=getGSTType($productIdName);
                                                        }
                                                        

                                                        
                                                        $hsn=$pro_sql_result['HSN'];

                                                        $discount=$pro_sql_result['discount'];
                                                        if($pro_sql_result['dis_amount']!=0){
                                                        $discountamount=$pro_amount*$discount/100;
                                                        }
                                                        else
                                                        {
                                                          $discountamount=0;  
                                                        }
                                                                if($hsn=='')
                                                               {
                                                               if($proid==711)
                                                                {
                                                                  $hsn="38089400";
                                                                } 
                                                                else if($proid==655)
                                                                {
                                                                  $hsn="5208";
                                                                }
                                                                else if ($proid==713)
                                                                {
                                                                  $hsn="3808";
                                                                }
                                                                else
                                                                {
                                                                  $hsn="";
                                                                }
                                                                }
                                                                else
                                                                {
                                                                  //$hsn=$hsn;
                                                                }
                                                        $total_qty = $total_qty + $pro_qty ;
                                                       
                                                        $price = floatval($pro_amount);
                                                        $price = sprintf("%.2f", $price);

                                                        $ttgst=trim(number_format($pro_sql_result['gst'],0, '.', ''));
                                                        $i_gst =number_format($ttgst/2,2, '.', '');
                                                        $c_gst =number_format($ttgst/2,2, '.', '');

                                                         if($ttgst==0)
                                                         {
                                                            $i_gst = 9;
                                                            $c_gst = 9;
                                                            $ttgst =18;
                                                         }  

                                                                     // Check Amount WIth GST Or NOT

                                                                     if ($GSTType=='1') {

                                                                         
                                                                         $price=$price-$discountamount;
                                                                         $gstamt=simplegstexcluded($price,$ttgst);
                                                                         $igst = (($gstamt* $i_gst) / 100 )* $pro_qty;
                                                                         $cgst = (($gstamt* $c_gst) / 100) * $pro_qty;

                                                                         $totalgst=$i_gst+$c_gst;
                                                                         $unitprice=$price;
                                                                         $ttlamt=$unitprice+$totalgst;
                                                                         $ntoamt=$ttlamt*$pro_qty;
                                                                         $getnetamt=$unitprice*$pro_qty;
                                                                         
                                                                         $sing_amount=$pro_amount;
                                                                     }
                                                                     else
                                                                     {

                                                                        // $price=$price-$discountamount;
                                                                         $cgst = ($price / $ttgst);
                                                                         $gstamt=$cgst;
                                                                         $igst = (($gstamt* $i_gst) / 100 )* $pro_qty;
                                                                         $cgst = (($gstamt* $c_gst) / 100) * $pro_qty;
                                                                         $unitprice=getnetamount($price,$ttgst);

                                                                         $totalgst=$i_gst+$c_gst;

                                                                          $ntoamt=$price*$pro_qty;
                                                                          $ntoamt=$ntoamt-$discountamount;
                                                                          
                                                                          $getnetamt=$unitprice*$pro_qty;
                                                                        //  $getnetamt = ($unitprice*$pro_qty)+$totalgst;
                                                                        
                                                                        $sing_amount=$pro_amount;


                                                                     }


                                                                      $ttlnetamt += $getnetamt;
                                                                      $total += $ntoamt;
                                                                      $ttldiscountamt += $discountamount;



                                                    

                                                        $total_gst = $total_gst + $igst+$cgst;
                                                        $netamt=$unitprice*$pro_qty;
                                                       
                                                        

                                                        $single=($netamt/100)*$i_gst;
                                                        $totalsingle=$single;
                                                        $unittax=2*$single;
                                                        
                                                        $totalnetamount+=$netamt;
                                                       

                                                        if($state=='Maharashtra')
                                                        {
                                                        $totalcgst=$totalcgst+$totalsingle;
                                                        $totalsgst=$totalsgst+$totalsingle;
                                                        $totaligst=$totaligst+0;
                                                        }
                                                        else
                                                        {
                                                        $totalcgst=$totalcgst+0;
                                                        $totalsgst=$totalsgst+0;
                                                        $totaligst=$totaligst+$unittax;

                                                        }
                                                    ?>                                                     
                                                    <!-- Loop Product List -->
                                                    <tr>
                                                        <td align="center" height="12"   width="5%" style="font-size:8px;border-right:1px solid black;"><?=$i?></td>
                                                        <td align="left" width="16%" style="font-size:8px;border-right:1px solid black;"><?php if ($product_name != '') {echo substr($product_name,0,50);}?></td>
                                                        <td align="center" width="10%" style="font-size:8px;border-right:1px solid black;"><?php if($hsn!=''){ echo $hsn;} ?></td>
                                                        <td align="center" width="5%" style="font-size:8px;border-right:1px solid black;"><?=$pro_qty?></td>
                                                        <td align="right" width="9%" style="font-size:8px;border-right:1px solid black;"><?php echo number_format($sing_amount, 2); ?></td>
                                                        <td align="<?php if($discount!=0){ echo "right";}else { echo "center";}?>" width="5%" style="font-size:8px;border-right:1px solid black;"> <?php if($discount!=0){ echo $discount."%";} else{ echo "-";} ?></td>
                                                        <td align="<?php if($discountamount!=0){ echo "right";}else { echo "center";}?>" width="8%" style="font-size:8px;border-right:1px solid black;"> <?php if($discountamount!=0){ echo $discountamount;} else{ echo "-";} ?></td>
                                                        <td align="right" width="9%" style="font-size:8px;border-right:1px solid black;"><?php echo number_format($unitprice, 2); ?></td>
                                                         <td align="right" width="9%" style="font-size:8px;border-right:1px solid black;"><?php if ($netamt != '') {echo number_format($netamt,2);}?></td>
                                                        <td align="right" width="5%" style="font-size:8px;border-right:1px solid black;"><?=$ttgst?> %</td>
                                                        <td align="right" width="9%" style="font-size:8px;border-right:1px solid black;"><?=number_format($unittax,2, '.', '')?></td>
                                                        <td align="right" width="10%" style="font-size:8px;border-right:1px solid black;"><?php echo number_format(($netamt+$unittax), 2, '.', ''); ?></td>
                                                    </tr>
                                                    <!-- Loop Product List -->

                                                    <? $i++;
                                                  //  $_product_net_amt = number_format($netamt,2);
                                                  //  $_product_net_tax = number_format($unittax,2);
                                                  
                                                    $_product_net_amt = number_format($netamt,2, '.', '') + number_format($unittax,2, '.', '');
                                                    $final_net_amt =  $final_net_amt + $_product_net_amt;
                                                    $pcount=$pcount+1;
                                                     } ?>
                                                    <?php 
                                                     $blank=12-$pcount;
                                                    for ($i=0; $i <$blank ; $i++) { 
                                                        ?>
                                                        <tr>
                                                        <td align="right" height="12"   width="5%" style="font-size:8px;border-right:1px solid black;"></td>
                                                        <td align="right" width="16%" style="font-size:8px;border-right:1px solid black;"></td>
                                                        <td align="right" width="10%" style="font-size:8px;border-right:1px solid black;"></td>
                                                        <td align="right" width="5%" style="font-size:8px;border-right:1px solid black;"></td>
                                                        <td align="right" width="9%" style="font-size:8px;border-right:1px solid black;"></td>
                                                        <td align="center" width="5%" style="font-size:8px;border-right:1px solid black;"></td>
                                                        <td align="center" width="8%" style="font-size:8px;border-right:1px solid black;"></td>
                                                        <td align="center" width="9%" style="font-size:8px;border-right:1px solid black;"></td>
                                                        <td align="center" width="9%" style="font-size:8px;border-right:1px solid black;"></td>
                                                        <td align="center" width="5%" style="font-size:8px;border-right:1px solid black;"></td>
                                                        <td align="center" width="9%" style="font-size:8px;border-right:1px solid black;"></td>
                                                        <td align="center" width="10%" style="font-size:8px;border-right:1px solid black;"></td>
                                                    </tr>
                                                        <?php
                                                     } ?>
                                                    <tr><td colspan="7" style="margin: 0;padding: 0;"><table border="1" cellpadding="6" cellspacing="0"  class="tb2" width="100%"><thead style="width: 100%;"><tr style="border: 1px solid black"><th style="font-size:8px;font-weight: bold;" height="15">Tax Name</th>
                                                                        <th style="font-size:8px;font-weight: bold;" align="center">Taxable Value</th>
                                                                        <th style="font-size:8px;font-weight: bold;" align="center">SGST</th>
                                                                        <th style="font-size:8px;font-weight: bold;" align="center">CGST</th>
                                                                        <th style="font-size:8px;font-weight: bold;" align="center">IGST</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody style="width: 100%;">
                                                                 <!-- Tax Calculetion -->
                                                                
                                                                    <tr style="border: 1px solid black">
                                                                        <td style="font-size:8px;" align="right" height="15"></td>
                                                                        <td style="font-size:8px;" align="right"><?=number_format($totalnetamount,2, '.', '')?></td>
                                                                        <td style="font-size:8px;" align="<?php if($totalcgst!==0){ echo "right";}else { echo "center";}?>"><?php if($totalcgst!==0){ ?><?=number_format($totalcgst,2, '.', '')?><?php } else{ echo "-"; }?>
                                                                        </td>
                                                                        <td style="font-size:8px;" align="<?php if($totalsgst!==0){ echo "right";}else { echo "center";}?>"><?php if($totalsgst!==0){ ?><?=number_format($totalsgst,2, '.', '')?><?php } else{ echo "-"; }?>
                                                                        </td>
                                                                        <td style="font-size:8px;" align="<?php if($totaligst!==0){ echo "right";}else { echo "center";}?>"><?php if($totaligst!==0){ ?><?=number_format($totaligst,2, '.', '')?><?php } else{ echo "-"; }?>
                                                                        </td>
                                                                    </tr>
                                                                

                                                                    <!-- End calculation -->

                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td style="border:1px solid black;">
                                                        </td><td colspan="5" rowspan="2" style="margin:0;padding: 0;border:1px solid black;"><table  cellpadding="6" cellspacing="0" style="margin-top: 30px;border-collapse: collapse;"><tbody style="width: 100%;"><tr><td style="border: 1px solid black;width: 42%;font-size:8px;" height="15">Net Amount</td>
                                                        <td width="28%" style="border: 1px solid black;"></td>
                                                                    <td align="right" style="border: 1px solid black;width: 30%;font-size:8px;">
                                                                        <?=number_format($final_net_amt, 2, '.', '')?>
                                                                       <?php 
                                                                       $discountamt=number_format($discount,2, '.', '');
                                                                       $total=$final_net_amt;
                                                                       $amtstr=number_format($total, 2, '.', '');
                                                                       $str_arr = explode('.',$amtstr);
                                                                                  
                                                                      
                                                                       // $roundoff=$frs-$secnd;
                                                                       
                                                                       
                                                                       
                                                                       if($str_arr[1]<=50)
                                                                       {
                                                                         $grandtotal= number_format($str_arr[0],2, '.', '');  
                                                                         $roundoff="- 0.".$str_arr[1];
                                                                       }
                                                                       else
                                                                       {
                                                                           $grandtotal= number_format($str_arr[0],2, '.', '');  
                                                                           $roundoff= 100-$str_arr[1];
                                                                           $roundoff= "0.".$roundoff;
                                                                           
                                                                          $grandtotal=$grandtotal+1;
                                                                       }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                
                                                                
                                                                                                                              
                                                                <tr>
                                                                    <td style="font-size:8px;border:1px solid black" colspan="2" height="15">
                                                                        Round Off
                                                                    </td>
                                                                    <td style="font-size:8px;border:1px solid black" align="right"><?=$roundoff?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-size:8px;border:1px solid black" colspan="2" height="15">
                                                                        GRAND TOTAL
                                                                    </td>
                                                                    <td style="font-size:8px;border:1px solid black" align="right"><?php echo number_format($grandtotal,2, '.', ''); ?>
                                                                    </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="8" height="10" style="font-size:8px;" align="left" style="margin:15px;"><b>Amount In words - <?php if($grandtotal!=''){ echo getIndianCurrency($grandtotal);}?></b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
           <table border="1" cellpadding="3" class="tb" style="border:1px solid black;" width="100%">
                <tbody>
                    <tr>
                        <td align="left" valign="center" rowspan="2" style=" font-size:8px; color:#000; padding:5px; font-family: 'Muli', sans-serif;width: 43%">
                            <strong style="font-size:8px;margin:5px;">Maharashtra GST No: 27ABSFA2696M1ZL</strong>
                        </td>
                       <td align="left" style="width: 44%;font-size:8px;"><b style="font-size:8px;margin:5px;">Bank Detail</b>
                       </td>
                       <td width="13%"></td>
                    </tr>
                    <tr><td align="left" style="width: 44%;font-size:8px;"> <b style="font-size:8px;margin:5px;">Bank Name: Kotak Mahindra Bank, Branch: Kandivali West</b>
                       
                    </td>
                         <td width="13%"></td>
                    </tr>
                    <tr>
                        <td align="left" rowspan="2" valign="center" style=" font-size:8px; color:#000; padding:5px; font-family: 'Muli', sans-serif;width: 43%">
                            <strong style="font-size:8px;margin:5px;">Pancard No: ABSFA2696M</strong>
                        </td>
                       <td align="left" width="44%" style="font-size:8px;"><b style="font-size:8px;margin:5px;">Account No: 5013315448</b>
                       </td>
                       <td></td>
                    </tr>
                    <tr><td align="left" width="44%" style="font-size:8px;"> <b style="font-size:8px;margin:5px;">IFSC Code: KKBK0000665 Acct Type: Current</b>
                       
                    </td>
                         <td width="13%"></td>
                    </tr>
                   
                    
                    <tr>
                        <td colspan="2" width="75%" style=" font-size:7px; color:#000; padding:5px; font-family: 'Muli', sans-serif;"><b style="margin:10px:font-size:7px;font-weight:500;"></b>
                          </td>
                        <td align="center" width="25%" style=" font-size:7px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                            <strong>
                                For: ALLMART ECOMMERCE LLP
                            </strong>
                        </td>
                    </tr>
                    
                    <tr>
                        <td align="center" style=" font-size:8px; color:#000; padding:5px; font-family: 'Muli', sans-serif;" valign="bottom">
                            <strong>
                                Subject to Mumbai Jurisdiction 
                            </strong>
                        </td>
                        <td align="center" style=" font-size:8px; color:#000; padding:5px; font-family: 'Muli', sans-serif;" valign="bottom">
                            <strong>
                               Thank You
                            </strong>
                        </td>
                        <td align="center" style=" font-size:8px; color:#000; padding:5px; font-family: 'Muli', sans-serif;" valign="bottom">
                            <strong>
                               Authorised Signatory
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12" align="center">
                            This is computer generated Invoice and, hence, does not require any signature
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
<?php
return ob_get_clean();
}
?>