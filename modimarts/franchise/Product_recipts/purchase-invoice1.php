<?php
include('../ecommerce_config.php');


function getIndianCurrency(float $number) {
    $decimal       = round($number - ($no = floor($number)), 2) * 100;
    $hundred       = null;
    $digits_length = strlen($no);
    $i             = 0;
    $str           = array();
    $words         = array(0 => '', 1          => 'one', 2        => 'two',
        3                        => 'three', 4     => 'four', 5       => 'five', 6 => 'six',
        7                        => 'seven', 8     => 'eight', 9      => 'nine',
        10                       => 'ten', 11      => 'eleven', 12    => 'twelve',
        13                       => 'thirteen', 14 => 'fourteen', 15  => 'fifteen',
        16                       => 'sixteen', 17  => 'seventeen', 18 => 'eighteen',
        19                       => 'nineteen', 20 => 'twenty', 30    => 'thirty',
        40                       => 'forty', 50    => 'fifty', 60     => 'sixty',
        70                       => 'seventy', 80  => 'eighty', 90    => 'ninety');
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_length) {
        $divider = (2 == $i) ? 10 : 100;
        $number  = floor($no % $divider);
        $no      = floor($no / $divider);
        $i += 10 == $divider ? 1 : 2;
        if ($number) {
            $plural  = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = (1 == $counter && $str[0]) ? ' and ' : null;
            $str[]   = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
        } else {
            $str[] = null;
        }

    }
    $Rupees = implode('', array_reverse($str));
    $paise  = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}

// function getHTMLPurchaseDataToPDF($result, $orderItemResult)
// {
    include('../ecommerce_config.php');


    $user_id   = 3;
$check     = "SELECT * FROM `franchise_received_products` WHERE id='$user_id'";
$sqlresult = mysqli_query($con_web, $check);

$result = mysqli_fetch_assoc($sqlresult);
// var_dump($result);

$orderItemResult = $result['product_ids'];

$check="SELECT * FROM `new_member` WHERE id='".$result['franchise_id']."'";
$sqlresult=mysqli_query($con_web,$check);
$userdetails= mysqli_fetch_assoc($sqlresult);
// ob_start();
?>
<html>
<head>Receipt of Purchase - <?php  echo $result["id"]; ?>
<!-- <style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style> -->
</head>
<body>
<div style="width:100%;display:inline-flex;">
       <div style="text-align:left;width:50%">
       <img src="http://allmart.world/new_ver/assets/logo.png" alt="Allmart" style="width:20%;" >
       </div>
       <div style="text-align:right;width:50%;">
        <b>Tax Invoice/Bill of Supply/Cash Memo</b><br/>
           <b>(Original for Recipient)</b>
           <br/><b>Order Id-</b> #<?php echo $result["id"];?>
           <br/><b>Order Date:</b> <?php echo date('D, d-m-Y h:i:s a',strtotime($result["created_at"])); ?>
       </div>

        <!-- <div style="text-align: left;border-top:1px solid #000;">
        <div style="font-size: 24px;color: #666;">INVOICE</div> -->
    </div>
    <br/>
    <hr/>
<table style="line-height: 1.5;width:100%">
    <tr>
        <td><b>Seller detail</b>
        </td>
        <td style="text-align:right;"><b>Shipping Address</b></td>
    </tr>
    <tr>
        <td>
            <b>Allmart Ecommerce LLP</b>
         </td>
        <td style="text-align:right;">
      <b> <?php echo $userdetails["name"]; ?></b>
        </td>
    </tr>
    <tr>
        <td>
            <?php
           $text= "Allmart Building No. 2,
MHB Colony No. 1, Near Pancholiya School,
Mahavir Nagar, Kandivali West,
Mumbai ,Maharashtra India - 400067.";
$textoutput = str_replace(',', '<br />', $text);
echo $textoutput;
?><br/>
<b>Phone:</b> +91-7710835444<br/>
<b>Email:</b>enquiry.allmart@gmail.com
         <br/><p><b>GST Registration No:</b> 27ABSFA2696M1ZL<br/>
            <b>PAN No:</b> ABSFA2696M
         </p>
        </td>
        <td style="text-align:right;"><?php
        $foo    = $userdetails["location"];
        $output = str_replace(',', '<br />', $foo);
        echo $output;
         ?>
         <br/>
         <?=$userdetails["mobile"]?>
         <br/>
         <?=$userdetails["email"]?>
         </td>
    </tr>
</table>

<div style="margin-top:10px;"></div>
    <div style="border-bottom:1px solid #000;">
        <table style="line-height: 2; width:100%; border-collapse: collapse;border:1px solid #cccccc;">
            <tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
                <td style="border:1px solid #cccccc;width:50px;text-align:center;">S.No</td>
                <td style="border:1px solid #cccccc;width:180px;text-align:center;">Item Description</td>
                <td style="border:1px solid #cccccc;width:80px;text-align:center;">Unit Price</td>
                <td style="border:1px solid #cccccc;width:80px;text-align:center;">Discount</td>
                <td style="border:1px solid #cccccc;width:50px;text-align:center;">Qty</td>
                <td style="border:1px solid #cccccc;width:80px;text-align:center;">GST %</td>
                <td style = "text-align:right;border:1px solid #cccccc;width:150px;text-align:center;">Amount(inc gst)</td>
            </tr>
            <tbody>
<?php
$total=0;
$total_gst=0;
$proid=explode(',',$orderItemResult);
for ($i=0; $i < count($proid) ; $i++) {

$proiddata=explode('/',$proid[$i]);
$quntity=explode(',',$result['quantities']);
$prod_id=trim($proiddata[2]);
$pid=trim($proiddata[0]);
$cid=trim($proiddata[1]);

$qrylatf="SELECT `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc,shipping_in_area,shipping_out_state FROM `products` WHERE code='".$pid."'";

$qrylatfrws=mysqli_query($con1,$qrylatf);
$latstprnrws=mysqli_fetch_array($qrylatfrws);

$prod = mysqli_query($con1,"SELECT product_model FROM product_model where id='".$latstprnrws['name']."'");
$product_name = mysqli_fetch_assoc($prod);




    $amount = $latstprnrws['total_amt'];
     $pro_name = $product_name['product_model'];
    $total+=$amount*$quntity[$i];
    $price = floatval($amount);
    $price = sprintf("%.2f", $price);
    if ($price < 1060) {
        $igst = ($price - floatval($price * 100) / 106) * $quntity[$i];
    } else {
        $igst = ($price - floatval($price * 100) / 112) * $quntity[$i];
    }
    $total_gst = $total_gst + $igst;

    ?>
    <tr>
     <td style="border:1px solid #cccccc;text-align:center;"><?=$i+1?></td>
     <td style="border:1px solid #cccccc;text-align:center;"><?php echo $pro_name; ?></td>
     <td style="border:1px solid #cccccc;text-align:center;"><?=$amount?></td>
    <td style = "text-align:right; border:1px solid #cccccc;text-align:center;"><?php echo number_format($amount, 2); ?></td>
    <td style = "text-align:right; border:1px solid #cccccc;text-align:center;"><?php echo $quntity[$i]; ?></td>
    <td style = "text-align:right; border:1px solid #cccccc;text-align:center;"><? if(0){ echo '3%';}
        else{
            if($amount<1060){
                    echo '6%';
            }
            else{
                    echo '12%';
            }
        }
       ?>
</td>
    <td style = "text-align:right; border:1px solid #cccccc;text-align:center;"><?php echo number_format($amount, 2); ?></td>
               </tr>
<?php
}
?>
<tr style = "font-weight: bold;">
    <td colspan="6" style = "text-align:center; border:1px solid #cccccc;">GST (Included in Total) </td>
    <td style = "text-align:center; border:1px solid #cccccc;"><?php echo number_format($total_gst, 2); ?></td>
</tr>
<tr style = "font-weight: bold;">
    <td colspan="6" style = "text-align:center; border:1px solid #cccccc;">Total </td>
    <td style = "text-align:center; border:1px solid #cccccc;"><?php echo number_format($total, 2); ?></td>
</tr>
</tr>
<tr style = "font-weight: bold;">
    <td colspan="7" style = "text-align:left; border:1px solid #cccccc;">Amount in Words: <br/><?php echo getIndianCurrency($total); ?> </td>

</tr>
</tbody>
</table></div>
   <div style="text-align:right;">
   <br/>
   <br/>
   <b>ALLMART ECOMMERCE LLP</b>
   <br/>
   <br/>
   <br/>
   <p><b>AUTH. SIGNATORY</b></p>
       </div>

<p><i>Note: This is computer generated invoice no signature required.</i></p>
</body>
</html>

<?php
// return ob_get_clean();
//}
?>