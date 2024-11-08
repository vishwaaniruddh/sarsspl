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
    $paise  = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise.' only';
}

function getnetamount($amount,$percent){

   $gst_amount = $amount-($amount*(100/(100+$percent)));
   $percentcgst = number_format($gst_amount/2, 2, '.', '');
   $percentsgst =  number_format($gst_amount/2, 2, '.', '');
  
   
   $withoutgst = number_format($amount - $gst_amount,2, '.', '');
   return $withoutgst;
}


function getSGST($amount,$percent){
   $gst_amount = $amount-($amount*(100/(100+$percent)));
   $percentcgst = number_format($gst_amount/2, 2, '.', '');
   $percentsgst =  number_format($gst_amount/2, 2, '.', '');
   return $percentsgst;

}



function simplegstexcluded($amount,$percent){
   $gst_amount = ($amount*$percent)/100;
   $total = number_format($amount+$gst_amount, 2, '.', '');
   $percentcgst = number_format($gst_amount/2, 3, '.', '');
   $percentsgst = number_format($gst_amount/2, 3, '.', '');
   return $percentcgst;
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
// $total_gst = $sql_result['cgst']+$sql_result['igst']+$sql_result['igst'];
$total_gst = "0";

$gst=$sql_result['gst_details'];
$pan=$sql_result['pan_details'];
$discount=$sql_result['discount'];



// $shipping_charges = get_shipping_charges($total_amount);


 $date=date("d-M-Y h:i:s A", strtotime($date));

// $user_sql = mysqli_query($con1,"select * from Registration where id = '".$userid."'");
// $user_sql_result = mysqli_fetch_assoc($user_sql);


// $fname = $user_sql_result['Firstname'];
// $lname = $user_sql_result['Lastname'];
// $email = $user_sql_result['email'];

$sql_address = mysqli_query($con1,"select * from new_order where oid='".$result["id"]."'");

            $sql_address_result = mysqli_fetch_assoc($sql_address);

            $name = $sql_address_result['name'];
        $email = $sql_address_result['email'];

        $add1 = $sql_address_result['address'];       
        $mobile = $sql_address_result['phone'];
        $city = $sql_address_result['city'];
        $pincode = $sql_address_result['zip'];
        $state = $sql_address_result['state'];
        $country = $sql_address_result['country'];

        $address= $add1.", ".$city.", ".$state." - ".$pincode." ".$country;


?>
<html>
<head>
</head>
<body>
<div style="margin-top:5px;"></div>
    <div >
    <table style="line-height: 1.5;width:100%">
    <tr>
        <td colspan="6"><img src="http://allmart.world/assets/logo.png" alt="Allmart" style="width:100px;" >
        </td>
        <td style="text-align:right;" colspan="6"> <b>Tax Invoice/Bill of Supply/Cash Memo</b>
           <br/><b>Order Id-</b> #<?php echo $result["id"]; ?>
           <br/><b>Order Date:</b> <?php echo $date; ?></td>
    </tr>
    </table>
    <div>
    <div style="margin-top:5px;"></div>
    <div >
<table style="line-height: 1.5;width:100%">
<tr><td colspan="7" style="text-align:left;"><b>Seller detail:</b></td><td style="text-align:left;" colspan="5"><b>Buyer detail:</b></td>
</tr>
<tr><td colspan="7" style="text-align:left;"><b>Allmart Ecommerce LLP</b></td>
<td style="text-align:left;" colspan="5"><b><?php if($name!=''){ echo $name;}?></b></td>
    </tr>
    <tr><td colspan="7" style="text-align:justify;">Allmart Building No. 2, MHB Colony No. 1,<br/>Near Pancholia School,
        Mahavir Nagar,<br/>Kandivali (W), Mumbai, Maharashtra, 400067 IN<br/>
        <b>Phone:</b> +91-9892384666<br/>
        <b>Email:</b> enquiry.allmart@gmail.com
         <p><b>GST No:</b> 27ABSFA2696M1ZL<br/>
         <b>PAN No:</b> ABSFA2696M
         </p>
        </td><td style="text-align:justify;" colspan="5"><?php if($address!=''){ echo $address;}?>
         <br/>
         <?php if($mobile!=''){ echo $mobile; }?>
         <br/>
         <?php
         if($email!=''){echo  $email;}
         if($gst!='' || $pan!=''){?>
         <p><?php if($gst!=''){ ?><b>GST No: </b><?=$gst?><br/><?php } if($pan!=''){ ?>
         <b>PAN No: </b> <?=$pan?><?php } ?>
         </p>
       <?php } ?>
         </td>
    </tr>
</table>
</div>

<div style="margin-top:5px;"></div>
    <div>
        <table style="line-height: 2; width:100%; border-collapse: collapse;border:1px solid #cccccc;" >
            <tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px; width:5%; ">S. <br/>No</td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:37%;" >Item Description</td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" >Unit<br/> Price</td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:5%;" >Qty</td>
                 <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" >Net <br/> Amount</td>
                
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:6%;" >Tax<br/> Rate</td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:7%;" >Tax <br/>Type</td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;">Tax <br/>Amount</td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" >Total <br/>Amount</td>
            </tr>
            <tbody>
  <?php
$i=1;
$total_qty = 0 ;
$total     = 0;
$totalvalue=0;

$detail_sql = mysqli_query($con1,"select * from order_details where oid='".$oid."'");
while($pro_sql_result = mysqli_fetch_assoc($detail_sql)){


    $pro_amount = $pro_sql_result['rate'];
    $pro_qty = $pro_sql_result['qty'];
    
    // $pro_type = $pro_sql_result['product_type'];
    $pro_type = 0;
    // $product_id = $pro_sql_result['product_id'];
    $product_name = $pro_sql_result['product_name'];
    $item_id=$pro_sql_result['item_id'];
    $orderdata=explode('/', $item_id);
    $proid=$orderdata[0];
    $hsn=$pro_sql_result['HSN'];
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
      $hsn=$hsn;
    }
    $ttgst=trim(number_format($pro_sql_result['gst'],0, '.', ''));
    $i_gst =number_format($ttgst/2,2, '.', '');
    $c_gst =number_format($ttgst/2,2, '.', '');



    $total_qty = $total_qty + $pro_qty ;
    $total += $pro_amount * $pro_qty;

$price = floatval($pro_amount);
$price = sprintf("%.2f", $price);
// $price = number_format($pro_amount,0);


  
    if($ttgst==0)
    {
       $i_gst = 9;
       $c_gst = 9;
       $ttgst =18;
    }




    
    $unitprice=getnetamount($price,$ttgst); 
    // $unitprice=$rate/(100+$i_gst)*100;

    
    $netamt=$unitprice*$pro_qty; 
    // $netamt=$unitprice;
    $ntoamt =$price*$pro_qty;

    $netamount=$ntoamt/(100+$ttgst)*100;

   // CGST GET FROM NET AMOUNT
    $single=($netamount/100)*$i_gst;
    $totalsingle=$single;
    $unittax=2*$single;

     // CGST GET FROM AMOUNT
    // $single=getSGST($price,$ttgst);    
    // $totalsingle=$single*$pro_qty;

    // $unittax=2*$single;

    $totaltax=$totalsingle*2;

    // $totlval=$pro_amount*$pro_qty;
    // $totlval=$unittax+$netamt;

    $totalvalue=$totalvalue+$ntoamt;



    
$total_gst = $total_gst + $totaltax;


?>
 
  <tr>
                 <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;width:5%;font-size: 8px;" ><?php echo $i; ?></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:37%;" ><?php if ($product_name != '') {echo $product_name;}?> <br/><?php if($hsn!=''){ echo "HSN: ". $hsn;} ?></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ><?php if ($unitprice != '') {echo $unitprice;}?></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:5%;" ><?=$pro_qty?></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ><?php echo number_format($netamount, 2); ?></td>
               
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:6%;" ><?php if($state=='Maharashtra'){ if($pro_amount<1060){ echo $c_gst."%";}else{echo $c_gst."%";}?><br/><?php if($pro_amount<1060){ echo $i_gst."%";} else{ echo $i_gst."%";}}else{if($pro_amount<1060){ echo $ttgst."%";;} else{ echo $ttgst."%";}}?>
        </td>
        <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:7%;" ><?php if($state=='Maharashtra'){ ?><?php echo "CGST"; ?><br/><?php echo "SGST";}else{ echo "IGST"; } ?>
        </td><td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ><?php if($state=='Maharashtra'){ if($totalsingle!=''){ echo number_format($totalsingle,2);} ?><br/><?php if($totalsingle!=''){ echo number_format($totalsingle,2);}}else{echo number_format($totaltax,2);} ?></td> 
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ><?php echo number_format($ntoamt, 2); ?></td>
  </tr>

<? $i++; } ?>
<?php 
$total_amount=$totalvalue-$discount;
$round=round($total_amount);
$round1=round($total_amount,2);

$Roundof=$round-$round1;
$total_amount=$round+$shipping;
 ?>
<tr>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;width:5%;"></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:37%;" >Shipping Charges</td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ><?=$shipping?></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:5%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ></td>
               
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:6%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:7%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ><?php echo number_format($shipping, 2); ?></td>
  </tr>
  <?php if($discount>0){ ?>
<tr>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;width:5%;"></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:37%;" >Discount </td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:5%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ></td>
               
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:6%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:7%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" >(<?php echo number_format($discount, 2); ?>)</td>
  </tr>
<?php } ?>
  <?php if($Roundof!=0){ ?>
<tr>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;width:5%;"></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:37%;" >Rounding Of </td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:5%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ></td>
               
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:6%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:7%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" ></td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;" >(<?php echo number_format(abs($Roundof), 2); ?>)</td>
  </tr>
<?php } ?>

 <tr>
     <td  style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:80%;"><b>Total:</b> </td>
     <td  style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;"> <b><?php if($total_gst!=''){ echo number_format($total_gst,2) ;} ?></b></td>
      <td  style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:10%;"><b><?php echo number_format($total_amount,2); ?></b></td>
 </tr>
 <tr>
     <td  style="border-collapse: collapse;border:1px solid #cccccc;text-align:left;font-size: 8px;width:100%;"><b>Amount In Words : <?php if($total_amount!=''){ echo getIndianCurrency($total_amount);}?></b></td>
 </tr>
</table>
</div>
   <div style="text-align:right;">
   <b>For ALLMART ECOMMERCE LLP :</b>
   <br/>
   <!-- <p><b>AUTH. SIGNATORY</b></p> -->
       </div>
<!-- <p><i>Note: This is computer generated invoice no signature required.</i></p> -->
</body>
</html>
<?php
return ob_get_clean();
}
?>