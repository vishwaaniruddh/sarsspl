<?php
include('../ecommerce_config.php');


function getIndianCurrency(float $number)
{
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


function getHTMLPurchaseDataToPDF($result, $orderItemResult)
{
    include('../ecommerce_config.php');
$check="SELECT * FROM `new_member` WHERE id='".$result['franchise_id']."'";
$sqlresult=mysqli_query($con_web,$check);
$userdetails= mysqli_fetch_assoc($sqlresult);

$total_amount = $result['total_amount'];
$txn_id       = $result['id'];
$order_id       = $result['id'];
// $shipping     = $result['shipping_charges'];
$shipping     = 0;
$userid       = $result['franchise_id'];
$date         = $result['created_at'];
// $total_gst = $sql_result['cgst']+$sql_result['igst']+$sql_result['igst'];
$total_gst = "0";

// $shipping_charges = get_shipping_charges($total_amount);

// $date = date("d-M-Y h:i:s A", strtotime($date));
$address     = $userdetails['location'];
$name        =  $userdetails['name'];
$mobile      = $userdetails['mobile'];


ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-Type" content="text/html; charset=utf-8" />
<title>Allmart.world</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<script type="text/javascript" src="paging.js"></script>

<body id="bdy">

<style>
body{
    font-size:10px;
}
td{
    padding:3px;
}
    .tnc li{
        font-size:12px;
    }
    p{
        margin:0;
        padding:0;
    }
    pre{
        display:none;
    }
</style>

<div id="bill">

        <p style="text-align:center;"><B><U> CONFIRMATION MEMO </U></B></font></p>



<table width="826" border="0" align="center">
<tr>
<td width="820" height="42">

    <table width="100%">
       <tr>

          <td style="padding:0px; margin:0px;">
              <div><b style="font-size:11px;">Allmart, your single destination <br/>for everything you need.</b></div>
              <!-- <ul style="margin:0;font-size:10px;">
                  <li>Bridal Jewellery & Accessories</li>
                  <li>Lehenga, Evening Gowns, Blouse</li>
                  <li>All Kinds Of Jewellery & Outfits</li>
              </ul> -->
              <br>
          </td>

          <td style="padding:0px; margin:0px;">
              <img src="http://allmart.world/new_ver/assets/logo.png" width="104px"/>
          </td>

          <td style="padding:0px; margin:0px;" style="font-size:11px;">
              <div><b>Sold By :</b></div>
              <div>Allmart Building No: 2, </div>
              <div> Pragati Society, Near Pancholiya School,</div>
              <div>Mahavir Nagar, Kandivali West,</div>
              <div> Mumbai Maharashtra Bharat- 400067</div>
              <div><b>Phone</b> - +91-7710835444</div>
              <div><b>Email</b>:enquiry.allmart@gmail.com</div>
              <div><b>GST</b> - </div>
              <div><b>PAN No:</b> - </div>




          </td>

       </tr>
       </table>

       <hr style="margin:3px;border-top: 1px solid #000;">
    <table width="100%">
       <tr>
           <td>
               <div><b>Shipping Address;-</b></div>
            <div style="width: 300px; height:30px;"><b> Name :</b><?php echo $name ; ?>
            <br/><b>Contact No: </b><?php echo $mobile; ?>
            <br/><b> Address : </b><?php echo $address; ?> <br/>
            <b> Order ID. </b><?php echo $order_id; ?><br/><b>Order Date: </b><?php echo date('d-m-Y h:i:s a',strtotime($date)) ?></div>
           </td>


           <td>

               <div style="width: 320px;">
                   <br>
                   <b><u>TERMS & CONDITION:</u></b>
          <ul style="padding: 0;">
              <li>Once An Order Is Booked, It Will Not Be Changed, Exchange Or Cancelled.</li>
              <li>No Money Will Be Refunded.</li>
              <li>The Full Amount Of Rent Is To Be Given On The Day Of Booking.</li>
              <li>Rental Is For 3 Days Only, 10% Extra For Each Day.</li>
              <li>Security Deposit Is Compulsory.</li>
              <li>Any Damage Done Will Be Deducted From The Security Deposit.</li>
              <li>Subject To Mumbai Jurisdiction.</li>
              <li>Fixed Price No Bargaining.</li>
            </ul>
               </div>
           </td>
        </tr>
</table>

  <font size="2" >

  <table width="100%" border="1" cellpadding="4" cellspacing="0" id="results">
  <tr>
    <th style="padding:3px;" width="50"><font size="2"><u><center>SR NO.</center></u></font></th>
    <th style="padding:3px;" width="140"><font size="2"><u><center>ITEM CODE</center></u></font></th>
    <th style="padding:3px;" width="80"><u>Price</u></th>
    <th style="padding:3px;" width="96"><font size="2"><u><center>Quantity</center></u></font></th>
    <th style="padding:3px;" width="86"><font size="2"><u><center>Discount</center></u></font></th>
    <th style="padding:3px;" width="86"><font size="2"><u><center>Discount Per Item</center></u></font></th>
    <th style="padding:3px;" width="110"><font size="2"><u><center>GST %</center></u></font></th>
    <th style="padding:3px;" width="119"><font size="2"><u><center>Amount(inc gst)</center></u></font></th>
  </tr>

  <?php
  $total=0;
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
    <td align="center"><?php echo $i+1; ?></td>
    <td align="center"><?php echo $pro_name; ?></td>
    <td align="center"><?php echo $amount; ?></td>
    <td align="center"><?php echo $quntity[$i]; ?></td>
    <td align="center"><?php echo '--'; ?></td>
    <td align="center"><?php echo '--'; ?></td>
    <td align="center">
    <? if(0){
    echo '3%';
}
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
    <td align="center"><?php echo $amount*$quntity[$i]; ?></td>
  </tr>



<? } ?>

 <tr>
     <td colspan="7" style="text-align:right;">GST (Included in Total) </td>
     <td> ₹<? echo round($total_gst,2) ; ?></td>
 </tr>

 <tr>
     <td colspan="7" style="text-align:left;"><b>Total:</b> </td>
     <td>₹<? echo round($total,2); ?></td>
 </tr>
 <tr>
     <td colspan='12' style="text-align:left;"><b>Amount In Words :<br/>
     <?php echo getIndianCurrency($total);?>only</b></td>

 </tr>


</table>
</font>

</td>
</tr>

</tr>



</table>

<div style="width:826px; margin:auto; padding-top: 30px; text-align: right; padding-bottom: 11px;">
    <p><b>ALLMART ECOMMERCE LLP</b></p>
</div>

<div style="width:826px; margin:auto; text-align: right; padding: 40px;">
    <p><b>AUTH. SIGNATORY</b></p>
</div>



</div>
<br/><br/>
<div id="pageNavPosition"></div>
<center><a href="#" onclick='PrintDiv();'>Print</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center>
<br><br>
<br><br>
</body>
</html>
<?php
return ob_get_clean();
}
?>