<?php session_start();
include('../connect.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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



$order_id = '259';

$sql = mysqli_query($con1 , "SELECT * FROM Order_ent WHERE id = '".$order_id."'");

$sql_result = mysqli_fetch_assoc($sql);
$total_amount = $sql_result['amount'];
$txn_id = $sql_result['transaction_id'];
$shipping = $sql_result['shipping_charges'];
$userid = $sql_result['user_id'];
$date = $sql_result['date'];
// $total_gst = $sql_result['cgst']+$sql_result['igst']+$sql_result['igst'];
$total_gst = "0";



// $shipping_charges = get_shipping_charges($total_amount);


 $date=date("d-M-Y h:i:s A", strtotime($date));

$user_sql = mysqli_query($con1,"select * from Registration where id = '".$userid."'");
$user_sql_result = mysqli_fetch_assoc($user_sql);

$fname = $user_sql_result['Firstname'];
$lname = $user_sql_result['Lastname'];
$sql_address = mysqli_query($con1,"select * from address where userid='".$userid."' and status=1 and is_primary=1");

            $sql_address_result = mysqli_fetch_assoc($sql_address);
$address = $sql_address_result['address'];
$name = $fname.' '.$lname;
$mobile = $user_sql_result['Mobile'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-Type" content="text/html; charset=utf-8" />
<title>Allmart.world</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<script type="text/javascript" src="paging.js"></script>
<script type="text/javascript">





        function PrintDiv() {
           var divToPrint = document.getElementById('bill');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
           popupWin.document.close();
                }
		function rollback(){
			document.getElementById("bdy").innerHTML="Transaction is rolled back. Please refresh this page to complete the transaction!";
			//document.getElementById("pageNavPosition").innerHTML="";
			}

</script>
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
          <td width="47%">
              <img src="http://allmart.world/new_ver/assets/logo.png" width="104px"/>
          </td>
         <td width="30%">
              <div><b>Order ID :</b><?php echo $order_id; ?></div>
              <div><b>Order Date :</b> <?php echo date('d-m-Y h:i:s a',strtotime($date)) ?></div>
              <!-- <div>Allmart Building No: 2, </div>
              <div> Pragati Society, Near Pancholiya School,</div>
              <div>Mahavir Nagar, Kandivali West,</div>
              <div> Mumbai Maharashtra Bharat- 400067</div>
              <div><b>Phone</b> - +91-7710835444</div>
              <div><b>Email</b>:enquiry.allmart@gmail.com</div>
              <div><b>GST</b> - 27ABSFA2696M1ZL</div>
              <div><b>PAN No:</b> - ABSFA2696M</div> -->
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
            <td style="padding:0px; margin:3px;" style="font-size:11px;">
              <div><b>Billing Details :</b></div>
              <div><b>Company Name :</b>  Allmart Ecommerce LLP</div>
              <div>Allmart Building No: 2, </div>
              <div> Pragati Society, Near Pancholiya School,</div>
              <div>Mahavir Nagar, Kandivali West,</div>
              <div> Mumbai Maharashtra Bharat- 400067</div>
              <div><b>Phone</b> - +91-7710835444</div>
              <div><b>Email</b>:enquiry.allmart@gmail.com</div>
              <div><b>GST</b> - 27ABSFA2696M1ZL</div>
              <div><b>PAN No:</b> - ABSFA2696M</div>
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
$i=1;
$total_qty = 0 ;
$detail_sql = mysqli_query($con1,"select* from order_details where oid='".$order_id."'");
while($pro_sql_result = mysqli_fetch_assoc($detail_sql)){


    $pro_amount = $pro_sql_result['rate'];
    $pro_qty = $pro_sql_result['qty'];
    // $pro_type = $pro_sql_result['product_type'];
    $pro_type = 0;
    // $product_id = $pro_sql_result['product_id'];
    $product_name = $pro_sql_result['product_name'];

    $total_qty = $total_qty + $pro_qty ;

$price = floatval($pro_amount);
$price = sprintf("%.2f", $price);
if ($price < 1060) {
 $igst = ($price - floatval($price * 100) / 106) * $pro_qty;
} else {
 $igst = ($price - floatval($price * 100) / 112) * $pro_qty;
}
$total_gst = $total_gst + $igst;





?>

  <tr>
    <td align="center"><?php echo $i; ?></td>
    <td align="center"><?php echo $product_name; ?></td>
    <td align="center"><?php echo $pro_amount; ?></td>
    <td align="center"><?php echo $pro_qty; ?></td>
    <td align="center"><?php echo '--'; ?></td>
    <td align="center"><?php echo '--'; ?></td>
    <td align="center">
    <? if($pro_type==1){
    echo '3%';
}
else{
    if($pro_amount<1060){
            echo '6%';
    }
    else{
            echo '12%';
    }
}
?>

        </td>
    <td align="center"><?php echo $pro_amount; ?></td>
  </tr>



<? $i++; } ?>

 <tr>
     <td colspan="7" style="text-align:right;">GST (Included in Total) </td>
     <td> ₹<? echo round($total_gst,2) ; ?></td>
 </tr>

 <tr>
     <td colspan="7" style="text-align:left;"><b>Total:</b> </td>
     <td>₹<? echo $total_amount . '.00'; ?></td>
 </tr>
 <tr>
     <td colspan='12' style="text-align:left;"><b>Amount In Words :<br/>
     <?php echo getIndianCurrency($total_amount);?>only</b></td>

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