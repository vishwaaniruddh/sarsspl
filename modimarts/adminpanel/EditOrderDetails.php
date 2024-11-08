<?php
session_start();
include 'config.php';
include 'adminaccess.php';
$orderid = $_GET['orderid'];
if (isset($_POST['subemail'])) {
    $address    = mysqli_real_escape_string($con1, $_GET['address']);
    $pmode      =  mysqli_real_escape_string($con1, $_GET['pmode']);
    $username   =  mysqli_real_escape_string($con1, $_GET['username']);
    $pro_name   =  mysqli_real_escape_string($con1, $_GET['pro_name']);
    $quntity    =  mysqli_real_escape_string($con1, $_GET['quntity']);
    $email      =  mysqli_real_escape_string($con1, $_GET['email']);
    $orderdate  =  mysqli_real_escape_string($con1, $_GET['orderdate']);
    $vendorname =  mysqli_real_escape_string($con1, $_GET['vendorname']);
    $status     = (int) $_POST['status'];

    if ($status == 1) {
        $update = mysqli_query($con1, "UPDATE `Order_ent` SET `status`='$status' WHERE id='$orderid'");
        for ($i = 0; $i < count($_POST['email']); $i++) {
            $to = $email[$i];
            // $to = "work.rjkashyap05@gmail.com";
            $subject = $username . " Has Order " . $_POST['pro_name'][$i];

            $message = "<b>" . $username . " Has Order " . $_POST['pro_name'][$i] . "</b>";
            $message .= "<h3>Hello " . $vendorname[$i] . "</h3><p>Recently we Have receive Order from " . $username . " , Thay Order <b>" . $_POST['pro_name'][$i] . " x " . $_POST['quntity'][$i] . " </b> From Allmart Website <br/></p><p>Address mention below For further  Process</p><p><strong> " . $address . " </strong> </p><p>Order Place date is - " . $orderdate . " </p>";

            $header = "From:enquiry.allmart@gmail.com \r\n";
            // $header .= "Cc:enquiry.allmart@gmail.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $retval = mail($to, $subject, $message, $header);

            if ($retval == true) {
                echo "Message sent successfully...";
            } else {
                echo "Message could not be sent...";
            }

        }
        ?>
 <script>
     alert("Email Send successfully");
     window.location.href="order_details.php?orderid=<?=$orderid?>";
 </script>
 <?php
} else if ($status == '2') {

        $update = mysqli_query($con1, "UPDATE `Order_ent` SET `status`='" . $status . "' WHERE id='" . $orderid . "'");

        ?>
 <script>
     alert("Change Status successfully");
     window.location.href="order_details.php?orderid=<?=$orderid?>";
 </script>
 <?php

    } else if ($status == '3') {

        $update = mysqli_query($con1, "UPDATE `Order_ent` SET `status`='" . $status . "' WHERE id='" . $orderid . "'");

        ?>
 <script>
     alert("Change Status successfully");
     window.location.href="order_details.php?orderid=<?=$orderid?>";
 </script>
 <?php
} else if ($status == '4') {

        $update = mysqli_query($con1, "UPDATE `Order_ent` SET `status`='" . $status . "' WHERE id='" . $orderid . "'");

        ?>
 <script>
     alert("Change Status successfully");
     window.location.href="order_details.php?orderid=<?=$orderid?>";
 </script>
 <?php
} else if ($status == '5') {

        $update = mysqli_query($con1, "UPDATE `Order_ent` SET `status`='" . $status . "' WHERE id='" . $orderid . "'");

        ?>
 <script>
     alert("successfully Change Status To Refunded");
     window.location.href="order_details.php?orderid=<?=$orderid?>";
 </script>
 <?php
} else {
        ?>
 <script>
     alert("Error");
     window.location.href="order_details.php?orderid=<?=$orderid?>";
 </script>
 <?php

    }

}

$orderdetails = mysqli_query($con1, "SELECT * FROM `Order_ent` WHERE id=" . $orderid . " ORDER BY `Order_ent`.`id` ASC");
$orddetails   = mysqli_fetch_assoc($orderdetails);

function getccode($cid, $pid)
{
    global $con1;

    $qrya = "select * from main_cat where id='" . $cid . "'";

    $resulta = mysqli_query($con1, $qrya);
    $rowa    = mysqli_fetch_row($resulta);
    $aa      = $rowa[2];

    if ($cid == 80) {
        $maincatid = 5;

    } else {
        if ($aa != 0) {
            $qrya1    = "select * from main_cat where id='" . $aa . "'";
            $resulta1 = mysqli_query($con1, $qrya1);
            $rowa1    = mysqli_fetch_row($resulta1);
            $Maincate = $rowa1[4];
        }

        if ($Maincate == 1) {
            $qrylatf = "SELECT `ccode` FROM `fashion` WHERE code='" . $pid . "'";
        } else if ($Maincate == 190) {
            $qrylatf = "SELECT `ccode` FROM `electronics` WHERE code='" . $pid . "'";
        } else if ($Maincate == 218) {
            $qrylatf = "SELECT `ccode` FROM `grocery` WHERE code='" . $pid . "'";
        } else if ($Maincate == 760) {
            $qrylatf = "SELECT `ccode` FROM `kits` WHERE code='" . $pid . "'";
        } else if ($Maincate == 767) {
            $qrylatf = "SELECT  `ccode` FROM `promotion_product` WHERE code='" . $pid . "'";
        } else {
            $qrylatf = "SELECT  `ccode` FROM `products` WHERE code='" . $pid . "'";
        }
    }
    $qrylatfrws = mysqli_query($con1, $qrylatf);

    $latstprnrws = mysqli_fetch_array($qrylatfrws);
    // var_dump($latstprnrws);
    return $latstprnrws['ccode'];

}

function getccodebyname($cid, $prodname)
{
    global $con1;
    $prod         = mysqli_query($con1, "SELECT product_model FROM product_model where product_model='" . $prodname . "'");
    $product_name = mysqli_fetch_assoc($prod);
    $prodid       = $product_name['id'];

    $qrya = "select * from main_cat where id='" . $cid . "'";

    $resulta = mysqli_query($con1, $qrya);
    $rowa    = mysqli_fetch_row($resulta);

    $aa = $rowa[2];

    if ($cid == 80) {
        $maincatid = 5;

    } else {
        if ($aa != 0) {
            $qrya1    = "select * from main_cat where id='" . $aa . "'";
            $resulta1 = mysqli_query($con1, $qrya1);
            $rowa1    = mysqli_fetch_row($resulta1);
            $Maincate = $rowa1[4];
        }
        if ($Maincate == 1) {
            $qrylatf = "SELECT `ccode` FROM `fashion` WHERE name = '" . $prodid . "'";
        } else if ($Maincate == 190) {
            $qrylatf = "SELECT `ccode` FROM `electronics` WHERE name  '" . $prodid . "'";
        } else if ($Maincate == 218) {
            $qrylatf = "SELECT `ccode` FROM `grocery` WHERE name = '" . $prodid . "'";
        } else if ($Maincate == 760) {
            $qrylatf = "SELECT `ccode` FROM `kits` WHERE name name = '" . $prodid . "'";
        } else if ($Maincate == 767) {
            $qrylatf = "SELECT  `ccode` FROM `promotion_product` WHERE name = '" . $prodid . "'";
        } else {
            $qrylatf = "SELECT  `ccode` FROM `products` WHERE name = '" . $prodid . "'";
        }
    }
    $qrylatfrws = mysqli_query($con1, $qrylatf);

    $latstprnrws = mysqli_fetch_array($qrylatfrws);
    return $latstprnrws['ccode'];
}

function getfranchise($client_id)
{
    global $con;
    global $con1;

    $sql = mysqli_query($con1, "SELECT * FROM `clients` WHERE code ='" . $client_id . "'");
    $row = mysqli_fetch_assoc($sql);
    // $country="india";
    // $zone=$row['city'];
    // $state=$row['state'];
    // $pincode=$row['pincode'];

    // $getfra=mysqli_query($con,"SELECT * FROM `new_member` WHERE pincode='".$pincode."' AND zone='".$zone."' AND state='".$state."' AND country='".$country."'");
    // $getfranchdata=mysqli_fetch_assoc($getfra);

    return $row;

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Panel</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>

<!--  checkbox styling script -->
<!--<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
    //  $('input').checkBox();
    //  $('#toggle-all').click(function() {
    //      $('#toggle-all').toggleClass('toggle-checked');
    //      $('#mainform input[type=checkbox]').checkBox('toggle');
   //       return false;
   //   });
   // });
</script>  -->

<![if !IE 7]>

<!--  styled select box script version 1 -->
<script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script>

<![endif]>

<!--  styled select box script version 2 -->
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
  $('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
});
</script>

<!--  styled select box script version 3 -->
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
});
</script>

<!--  styled file upload script -->
<script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
    $(function() {
      $("input.file_1").filestyle({
          image: "images/forms/choose-file.gif",
          imageheight : 21,
          imagewidth : 78,
          width : 310
        });
    });
</script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>

<!--  date picker script -->
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
    function shfunc(divid,stats)
    {
        try
        {
            // alert(divid);
            if(stats=="1")
            {
                document.getElementById(divid).style.display="block";
            }else
            {
                document.getElementById(divid).style.display="none";
            }
        }catch(exc)
        {
            alert(exc);
        }
    }
</script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>

<style>
  .loader{
  display: none;
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('/assets/loader.gif')
              50% 50% no-repeat rgb(246 246 246 / 52%);
}
</style>
</head>
<body>

<!-- End: page-top-outer -->

<div class="clear">&nbsp;</div>


<!------------------------------  start nav-outer-repeat....... START ------------------------->
<?php include 'header.php';?>
<!-------------------------------- start nav-outer-repeat.... END ----------------------------->
<div class="clear"></div>
<div id="content-outer">
<!-- start content -->
<div class="loader"></div>
<div id="content">
       <?
$qrytoken     = "select token from add_ship_rocket_token where id='1'";
$result_token = mysqli_query($con1, $qrytoken);
$rowtoken     = mysqli_fetch_row($result_token);
?>
       <input type="hidden" id="jwt_token" value="<?php echo $rowtoken[0]; ?>">
       <input type="hidden" id="order_id" value="<?php echo $orderid; ?>">
       <?php
$sql_address = mysqli_query($con1, "select * from new_order where oid='" . $orddetails['id'] . "'");

$sql_address_result = mysqli_fetch_assoc($sql_address);

$username        = $sql_address_result['name'];
$address         = $sql_address_result['address'];
$city            = $sql_address_result['city'];
$pincode         = $sql_address_result['zip'];
$state           = $sql_address_result['state'];
$country         = $sql_address_result['country'];
$email           = $sql_address_result['email'];
$phone           = $sql_address_result['phone'];
$primary_address = $address;
?>
              


              


    <form action="EditOrderDetailprocess.php" method="post">
  <!--  start page-heading -->
  <div id="page-heading">
    <h1>Orders</h1>
  </div>
  <!-- end page-heading -->
  <div class="row">
    <div class="col-md-3 col-lg-3">
            <div class="form-group">
                <label>Order Id</label>
                <input type="text" value="<?=$orddetails['id']?>" name="order_id"  class="form-control" readonly>
            </div>
    </div>
        <div class="col-md-3 col-lg-3">
            <div class="form-group">
                <label>User Name</label>

                <input type="text" class="form-control" name="username" value="<?=$username?>" id="billing_customer_name">
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="form-group">
                <label>User ID</label>

                <input type="text" class="form-control" name="userid" value="<?=$orddetails['user_id']?>" >
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="form-group">
                   <label>
                       <input name="is_franchise" type="checkbox" value="1" <?php if($orddetails['is_franchise']==1){ echo "checked";}?>>
                       Is Frenchise
                   </label>
               </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="form-group">
                <label>Order Date</label>
                <input type="text" class="form-control" value="<?=date('Y-m-d H:i:s', strtotime($orddetails['date']))?>" name="orderdate" >
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="form-group">
                <label>Order Type</label>
                <select name="ordertype" id="" class="form-control" required>
                    <option value="">Select Order Type</option>
                    <option <?php if($orddetails['pmode']=='online'){ echo "selected";} ?> value="online">Online</option>
                    <option <?php if($orddetails['pmode']=='COD'){ echo "selected";} ?> value="COD">COD</option>
                    <option <?php if($orddetails['pmode']=='Cash'){ echo "selected";} ?> value="Cash">Cash</option>
                    <option <?php if($orddetails['pmode']=='CreatedByAdmin'){ echo "selected";} ?> value="CreatedByAdmin">Created By Admin</option>
                    <option <?php if($orddetails['pmode']=='Account Transfer'){ echo "selected";} ?> value="Account Transfer">Account Transfer </option>
                     <option <?php if($orddetails['pmode']=='Free Sample'){ echo "selected";} ?> value="Free Sample">Account Transfer </option>
                </select>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="form-group">
                <label>Ship To</label>
                <select name="ship_to" id="" class="form-control" required>
                    <option value="">Select Ship Status</option>
                    <option <?php if($orddetails['ship_to']==1){ echo "selected";} ?> value="1">Given Address</option>
                    <option <?php if($orddetails['ship_to']==2){ echo "selected";} ?> value="2">Collect from Allmart</option>
                    
                </select>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-3 col-lg-3">
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" class="form-control" id="mob" onkeydown="return ismob()" pattern="^[6-9]\d{9}$" name="phone" value="<?=$phone?>" >
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="<?=$email?>" >
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <label>Shopping Address </label>

                <textarea id="billing_address" class="form-control" name="billing_address" cols="30" rows="5"><?=$primary_address?></textarea>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-4 col-lg-4">
            <div class="form-group">
                <label>City </label>
                <input type="text" name="billing_city" value="<?=$city?>" class="form-control" placeholder="Enter City " required>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="form-group">
                <label>State </label>
                    <select name="billing_state" class="form-control" required>
                      <option value="">Select State</option>
                        <?php $state_sql = mysqli_query($con1, "SELECT * FROM `states` ORDER BY `states`.`state_name` ASC");
while ($state_sql_result = mysqli_fetch_assoc($state_sql)) {?>
                                      <option value="<?echo $state_sql_result['state_name']; ?>" <?if ($state_sql_result['state_name'] == $state) {echo 'selected';}?>>
                                            <?=$state_sql_result['state_name'];?>
                                      </option>
                                    <?}?>
                    </select>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="form-group">
                <label>Pincode</label>
                <input type="number" name="billing_zip" value="<?=$pincode?>" class="form-control" placeholder="Enter Pincode">
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <label>GST Number </label>
                <input type="text" name="gstnumber" onkeyup="this.value = this.value.toUpperCase();" value="<?=$orddetails['gst_details']?>" class="form-control" placeholder="Enter GST Number">
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <label>Pan Number</label>
                <input type="text" name="pannumber" onkeyup="this.value = this.value.toUpperCase();" value="<?=$orddetails['pan_details']?>" class="form-control" placeholder="Enter Pan Number">
            </div>
        </div>

        <div class="col-md-12">

            <h5>Order Products</h5>
            <div class="form-group">
               <table class="table table-responsive">
            <thead><tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Discount (%)</th>
                <th>Discount (Amount)</th>
            </tr>
            </thead>
            <tbody id="addrowhere">
              <?php 
              $i=0;
                    $show_email_sql = mysqli_query($con1,"select * from order_details  where oid='".$orderid."' ");
                    
                  while($show_order_sql_result1=mysqli_fetch_assoc($show_email_sql)){
                  $pro_image1 = $show_order_sql_result1['image'];
                  $pro_name1 = $show_order_sql_result1['product_name'];
                  $pro_qty1 = $show_order_sql_result1['qty'];
                  $single_price1 = $show_order_sql_result1['rate'];
                  $total_amt1 = $single_price1*$pro_qty1;
                  $item_id=$show_order_sql_result1['item_id'];
                  $proodr=$show_order_sql_result1['id'];
                  $shipping_status=$show_order_sql_result1['shipping_status'];
                  $track_Status=$show_order_sql_result1['track_Status'];
                  $discount=$show_order_sql_result1['discount'];
                  $dis_amount=$show_order_sql_result1['dis_amount'];
               ?>
              <tr id="prorow_1">
                <td>
                  <input type="text" name="productId[]" class="form-control" value="<?=$pro_name1?>" id="productId_1" readonly="">
                  <input type="hidden" name="itemid[]" value="<?=$proodr?>">
                </td>
                <td>
                  <input type="number" step="0.01" min="0" name="productprice[]" value="<?=$single_price1?>" onchange="subtotal()" class="form-control cprice" id="productprice_1">
                </td>
                <td>
                  <input type="number" name="productqty[]" step="0.01" min="0" value="<?=$pro_qty1?>" onchange="subtotal()" class="form-control qty" id="productqty_1">
                </td>
                <td>
                  <input type="text" onchange="subtotal()" name="pro_total[]" value="<?=$total_amt1?>" class="form-control subtotal" id="pro_total_1" readonly>
                </td> 
                 <td>
                  <input type="text" onchange="subtotal()" name="pro_dis[]" value="<?=$discount?>" min="1" class="form-control prodis" id="pro_total_1"  required>
                  
                </td> 
                <td>
                  <input type="text" onchange="subtotal()" name="pro_disamt[]" value="<?=$dis_amount?>" min="1" class="form-control prodisamt" id="pro_total_1" readonly required>
                  
                </td> 
              </tr>  
              <?php } ?>             

            <tfoot>


                <tr>
                    <td colspan="3" align="right">Discount</td>
                    <td> <input colspan="2" type="number" id="discount" step="0.00001" min="0" onchange="subtotal()" name="discount" class="form-control" value="<?=$orddetails['discount']?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">Shipping Charges</td>
                    <td> <input colspan="2" type="number" id="shipping_charges" onchange="subtotal()" step="0.01" min="0" name="shipping_charges" class="form-control" value="<?=$orddetails['shipping_charges']?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td> <input colspan="2" type="number" name="g_total" class="form-control" step="0.01" min="0" value="<?=$orddetails['amount']?>" id="g_total" readonly="">
                     
                    </td>
                </tr> <tr>
                      <td colspan="3" align="right">Notes (Optional)</td>
                      <td> <input colspan="2" type="text" value="<?=$orddetails['Notes']?>" name="Notes" class="form-control" >
                      </td>
                    </tr>
                  <tr>
                    <td colspan="5" align="right"><input type="submit" class="btn btn-danger float-right" name="updatepro" value="Update Product"></td>

                </tr>
                
            </tfoot>

        </table>
            </div>
        </div>

  </div>
   </form>
              </div>



</div>

<script>
   function subtotal()
                    { //alert("hii");
                      var elem = document.getElementsByClassName('qty');
                       var price=document.getElementsByClassName('cprice');
                       //alert(price);
                       var subto=document.getElementsByClassName('subtotal');
                       var shipping_charges=$("#shipping_charges").val();

                       var prodis=document.getElementsByClassName('prodis');
                       var prodisamt=document.getElementsByClassName('prodisamt');

                       var discount=$("#discount").val();
                       // alert(discount);


                       var sumamt=0; var sumqty=0;
                       var totldisamt=0;
                       for(i=0;i<elem.length;i++)
                       {
                        if(elem[i]!=0 || price[i]!=0)
                        {
                          if(price[i].value=="")
                          price[i].value=0;
                          
                          if(elem[i].value=="")
                          elem[i].value=0;                          

                          
                          var subtotal=parseFloat(elem[i].value).toFixed(2)*parseFloat(price[i].value).toFixed(2);
                          subto[i].value=parseFloat(subtotal).toFixed(2);

                          var disamount=parseFloat(subtotal).toFixed(2)*parseFloat(prodis[i].value).toFixed(2)/100;

                           totldisamt=totldisamt+disamount;
                         prodisamt[i].value=disamount;
                         var netamt=subtotal-disamount;
                          sumamt=sumamt+netamt;

                          sumqty=sumqty+parseFloat(elem[i].value);  
                        }  
                      }

                      sumamt=parseFloat(sumamt).toFixed(2)+parseFloat(shipping_charges).toFixed(2);
                      // sumamt=parseFloat(sumamt).toFixed(2)-parseFloat(discount).toFixed(2);
                      
                          
                        document.getElementById('g_total').value=parseFloat(sumamt).toFixed(2);
                        // alert(totldisamt);
                        // document.getElementById('totalqty').value=sumqty;

                        $('#discount').val(totldisamt);                        
                        
                    }
</script>

<script>
  function Checkform()
  {
    var total=$("#g_total").val();
      total= parseInt(total);
    if(total>0)
    {
      return true;
    }
    else
    {
       return false;
    }

  }
</script>

<script>        
           function ismob(){  

            jQuery("#mob").keypress(function (e) {
         var length = jQuery(this).val().length;
       if(length > 9) {
            return false;
       } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
       } else if((length == 0) && (e.which == 48)) {
            return false;
       }
      });
        }
       </script>


<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->
<div class="clear">&nbsp;</div>
<!-- start footer -->
<div id="footer">
  <div class="clear">&nbsp;</div>
</div>
</body>
</html>