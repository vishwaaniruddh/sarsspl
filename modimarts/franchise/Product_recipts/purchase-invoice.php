<?php
include '../ecommerce_config.php';

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
            $plural  = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = (1 == $counter && $str[0]) ? ' And ' : null;
            $str[]   = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
        } else {
            $str[] = null;
        }

    }
    $Rupees = implode('', array_reverse($str));
    $paise  = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}

function getHTMLPurchaseDataToPDF($result, $orderItemResult)
{
include '../ecommerce_config.php';

$check       = "SELECT * FROM `new_member` WHERE id='" . $result['franchise_id'] . "'";
$sqlresult   = mysqli_query($con_web, $check);
$userdetails = mysqli_fetch_assoc($sqlresult);
ob_start();
?>
<html>
<head>
</head>
<body>
<div style="margin-top:10px;"></div>
    <div style="border-bottom:1px solid #000;">
    <table style="line-height: 1.5;width:100%">
    <tr>
        <td colspan="6"><img src="http://allmart.world/new_ver/assets/logo.png" alt="Allmart" style="width:70px;" >
        </td>
        <td style="text-align:right;" colspan="6"> <b>Tax Invoice/Bill of Supply/Cash Memo</b><br/>
           <b>(Original for Recipient)</b>
           <br/><b>Order Id-</b> #<?php echo $result["id"]; ?>
           <br/><b>Order Date:</b> <?php echo date('D, d-m-Y h:i:s a', strtotime($result["created_at"])); ?></td>
    </tr>
    </table>
    <div>
    <div style="margin-top:10px;"></div>
    <div style="border-bottom:1px solid #000;">
<table style="line-height: 1.5;width:100%">
<tr><td colspan="6" style="text-align:left;"><b>Seller detail</b></td><td style="text-align:right;" colspan="6"><b>Shipping Address</b></td>
</tr>
<tr><td colspan="6" style="text-align:left;"><b>Allmart Ecommerce LLP</b></td>
<td style="text-align:right;" colspan="6"><b> <?php echo $userdetails["name"]; ?></b></td>
    </tr>
    <tr>
        <td colspan="6"><?php
$text = "Allmart Building No. 2,
MHB Colony No. 1, Near Pancholiya School,
Mahavir Nagar, Kandivali West,
Mumbai ,Maharashtra India - 400067.";
$textoutput = str_replace(',', '<br />', $text);
echo $textoutput;
?><br/>
<b>Phone:</b> +91-9892384666<br/>
<b>Email:</b>enquiry.allmart@gmail.com
         <br/><p><b>GST Registration No:</b> 27ABSFA2696M1ZL<br/>
            <b>PAN No:</b> ABSFA2696M
         </p>
        </td>
        <td style="text-align:right;" colspan="6"><?php

        if($userdetails["location"]!=''){
        $foo    = $userdetails["location"];
        $output = str_replace(',', '<br />', $foo);
        echo $output;
        }

        ?>
         <br/>
         <?php
         if($userdetails["mobile"]!='')
         {
         echo  $userdetails["mobile"];
         }
        ?>
         <br/>
         <?php
         if($userdetails["email"]!=''){
         echo  $userdetails["email"];
         }
         ?>
         </td>
    </tr>
</table>
</div>

<div style="margin-top:10px;"></div>
    <div >
        <table style="line-height: 2; width:100%; border-collapse: collapse;border:1px solid #cccccc;">
            <tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="1">S.No</td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="4">Item Description</td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="1">Unit Price </td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="1">Qty</td>
                 <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="1">Net Amount</td>
               
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="1">GST(%)</td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="1">Tax Amount</td>
                <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="2">Amount(inc gst)</td>
            </tr>
            <tbody>
<?php
$total     = 0;
$total_gst = 0;
if($orderItemResult!=''){
$proid     = explode(',', $orderItemResult);
for ($i = 0; $i < count($proid); $i++) {

    $proiddata = explode('/', $proid[$i]);
    $quntity   = explode(',', $result['quantities']);
    $prod_id   = trim($proiddata[2]);
    $pid       = trim($proiddata[0]);
    $cid       = trim($proiddata[1]);

    $qrylatf = "SELECT `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc,shipping_in_area,shipping_out_state FROM `products` WHERE code='" . $pid . "'";

    $qrylatfrws  = mysqli_query($con1, $qrylatf);
    $latstprnrws = mysqli_fetch_array($qrylatfrws);

    $prod         = mysqli_query($con1, "SELECT product_model FROM product_model where id='" . $latstprnrws['name'] . "'");
    $product_name = mysqli_fetch_assoc($prod);

    $amount   = $latstprnrws['total_amt'];

    $pro_name = $product_name['product_model'];
    $total += $amount * $quntity[$i];
    $price = floatval($amount);
    $price = sprintf("%.2f", $price);
    if ($price < 1060) {
        $igst = ($price - floatval($price * 100) / 109) * $quntity[$i];
        $cgst = ($price - floatval($price * 100) / 109) * $quntity[$i];
        $sgst = ($price - floatval($price * 100) / 109);
        $gstamt=$price-$sgst;
    } else {
        $igst = ($price - floatval($price * 100) / 112) * $quntity[$i];
        $cgst = ($price - floatval($price * 100) / 112) * $quntity[$i];
         $sgst = ($price - floatval($price * 100) / 112);
        $gstamt=$price-$sgst;
    }
    $total_gst = $total_gst + $igst;
    $netamt=$gstamt*$quntity[$i];
    $ntoamt=$amount*$quntity[$i];
    $hsn=

    ?>
    <tr>
     <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="1"><?=$i + 1?></td>
     <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="4"><?php echo $pro_name; ?><br/> HSN:<?php if($hsn!=''){ echo $hsn; }?></td>
     <td style="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="1"><?=number_format($gstamt, 2)?></td>
    <td style ="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="1"><?php echo $quntity[$i]; ?></td>
    <td style ="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="1"><?php echo number_format($netamt, 2); ?></td>
    
    <td style ="border-collapse: collapse;border:1px solid #cccccc;text-align:center;" colspan="1"><? if(0){ echo '3% (CGST)';}
        else{
            if($amount<1060){
                    echo '9% (CGST)';
            }
            else{
                    echo '18% (CGST)';
            }
        }
       ?> <br/><? if(0){ echo '3% (SGST)';}
        else{
            if($amount<1060){
                    echo '9% (SGST)';
            }
            else{
                    echo '12% (SGST)';
            }
        }
       ?>
</td>
    <td style = "border-collapse: collapse; border:1px solid #cccccc;text-align:center;" colspan="1"><?php echo number_format($igst, 2); ?><br/>
    <?php echo number_format($cgst, 2); ?></td>
    <td style = "border-collapse: collapse; border:1px solid #cccccc;text-align:center;" colspan="2"><?php echo number_format($ntoamt, 2); ?></td>
               </tr>
<?php
}
}
?>
<tr style = "font-weight: bold;">
    <td colspan="9" style = "border-collapse: collapse;text-align:center; border:1px solid #cccccc;">Total </td>
    <td colspan="1" style = "border-collapse: collapse;text-align:center; border:1px solid #cccccc;"><?php if($total_gst!=''){ echo number_format($total_gst, 2);} ?></td>
    <td colspan="2" style = "border-collapse: collapse;text-align:center; border:1px solid #cccccc;"><?php if($total!=''){ echo number_format($total, 2);} ?></td>
</tr>
<tr style = "font-weight: bold;">
    <td colspan="12" style = "border-collapse: collapse;text-align:left; border:1px solid #cccccc;">Amount in Words: <?php echo getIndianCurrency($total); ?> </td>

</tr>
</tbody>
</table></div>
   <div style="text-align:right;">
   <b>ALLMART ECOMMERCE LLP</b>
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