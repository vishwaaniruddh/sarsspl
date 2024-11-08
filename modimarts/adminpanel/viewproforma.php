<?php

session_start();
include('config.php');
include('adminaccess.php');
include('../apidata.php');
$orderid=$_GET['orderid'];
//header('Access-Control-Allow-Origin: *');



$orderdetails=mysqli_query($con1,"SELECT * FROM `proforma_Order_ent` WHERE id=".$orderid." ORDER BY `proforma_Order_ent`.`id` ASC");
$orddetails=mysqli_fetch_assoc($orderdetails);

function getccode($cid, $pid)
{
    global $con1;

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

function getccodebyname($cid,$prodname)
{
    global $con1;
    $prod = mysqli_query($con1, "SELECT product_model FROM product_model where product_model='" . $prodname . "'");
$product_name = mysqli_fetch_assoc($prod);
$prodid=$product_name['id'];


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
            }
            else if ($Maincate == 767) {
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

    $sql=mysqli_query($con1,"SELECT * FROM `clients` WHERE code ='".$client_id."'");
    $row=mysqli_fetch_assoc($sql);

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
    //	$('input').checkBox();
    //	$('#toggle-all').click(function() {
    // 	    $('#toggle-all').toggleClass('toggle-checked');
    //	    $('#mainform input[type=checkbox]').checkBox('toggle');
   // 	    return false;
   // 	});
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
<?php include('header.php');?>
<!-------------------------------- start nav-outer-repeat.... END ----------------------------->
<div class="clear"></div>
<div id="content-outer">
<!-- start content -->
<div class="loader"></div>
<div id="content"> 
       <?
            $qrytoken = "select token from add_ship_rocket_token where id='1'";
            $result_token = mysqli_query($con1, $qrytoken);
            $rowtoken    = mysqli_fetch_row($result_token);
       ?>
       <input type="hidden" id="jwt_token" value="<?php echo $rowtoken[0]; ?>">
       <input type="hidden" id="order_id" value="<?php echo $orderid; ?>">
       <?php 
                $sql_address = mysqli_query($con1,"select * from proforma_new_order where oid='".$orddetails['id']."'");

                    $sql_address_result = mysqli_fetch_assoc($sql_address);

                    $username = $sql_address_result['name'];
                    $address = $sql_address_result['address'];
                    $city = $sql_address_result['city'];
                    $pincode = $sql_address_result['zip'];
                    $state = $sql_address_result['state'];
                    $country = $sql_address_result['country'];
                    $email = $sql_address_result['email'];
                    $phone = $sql_address_result['phone'];
                    $primary_address= $address ;
                ?>
                <input type="hidden" id="billing_customer_name" value="<?=$username?>">
                <input type="hidden" id="billing_last_name" value="">
                <input type="hidden" id="billing_address" value="<?=$address?>">
                <input type="hidden" id="billing_address_2" value="">
                <input type="hidden" id="billing_city" value="<?=$city?>">
                <input type="hidden" id="billing_pincode" value="<?=$pincode?>">
                <input type="hidden" id="billing_state" value="<?=$state?>">
                <input type="hidden" id="billing_email" value="<?=$email?>">
                <input type="hidden" id="billing_phone" value="<?=$phone?>">
                <input type="hidden" id="sub_total" value="<?=$orddetails['amount']?>">
                <input type="hidden" id="responce1" value="">


                <!-- <input type="hidden" id="" value=""> -->
                
               

    <form action="#" method="post">
	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Orders</h1>
	</div>
	<!-- end page-heading -->
	<div class="row">
		<div class="col-md-3">
            <div class="form-group">
                <label>Order Id</label>
                <input type="text" value="<?=$orddetails['id']?>"  class="form-control">                
            </div>
		</div>
        <div class="col-md-3">
            <div class="form-group">
                <label>User Name</label>
                
                <input type="text" class="form-control" value="<?=$username?>" id="billing_customer_name">                
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Order Date</label>
                <input type="text" class="form-control" value="<?=date('D,d-m-Y',strtotime($orddetails['date']))?>" name="orderdate" >   
                <input type="hidden" value="<?=date('Y-m-d H:m',strtotime($orddetails['date']))?>" id="order_date">             
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Order Type</label>
                <input type="text" class="form-control" value="<?=$orddetails['pmode']?>">                
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Mobile Number</label>
             
                <input type="text" class="form-control" value="<?=$phone?>" readonly>               
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Email</label>
             
                <input type="text" class="form-control" value="<?=$email?>" readonly>               
            </div>
        </div>
        <div class="col-md-6">

            <div class="form-group">
                <label>Shipping Address </label>
             
                <textarea id="billing_address" class="form-control" cols="30" rows="5"><?=$primary_address?></textarea>               
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>City </label>
                <input type="text" name="billing_city" value="<?=$city?>" class="form-control" placeholder="Enter City " required>
            </div>          
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>State </label>
                    <select name="billing_state" class="form-control" required>
                      <option value="">Select State</option>
                        <?php $state_sql = mysqli_query($con1,"SELECT * FROM `states` ORDER BY `states`.`state_name` ASC");
                         while($state_sql_result = mysqli_fetch_assoc($state_sql)){ ?>
                                      <option value="<? echo $state_sql_result['state_name'];?>" <? if($state_sql_result['state_name'] == $state){ echo 'selected'; }?>>
                                            <?=$state_sql_result['state_name'];?>
                                      </option>
                                    <? } ?>
                    </select>
            </div>          
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Pincode</label>
                <input type="number" name="billing_zip" value="<?=$pincode?>" class="form-control" placeholder="Enter Pincode">
            </div>          
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>GST Number </label>
                <input type="text" name="gstnumber" value="<?=$orddetails['gst_details']?>" data-uppercase="1" class="form-control" placeholder="Enter GST Number">
            </div>          
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Pan Number</label>
                <input type="text" name="pannumber" data-uppercase="1" value="<?=$orddetails['pan_details']?>" class="form-control" placeholder="Enter Pan Number">
            </div>          
        </div>
         
        <div class="col-md-12">
           
            <h5>Order Products</h5>
            <div class="form-group">
                <table class="table">
                    <tr>
                        <td>S.No</td>
                        <td>Product image</td>
                        <td>Product Name</td>
                        <td>Quantity</td>
                        <td>Rate</td>                        
                        <td>Total</td>
                        <td>Discount (%)</td>
                        <td>Dis Amt</td>
                    </tr>

                    <?php
                    $prodata = array();
                    $i=0;
                    $show_email_sql = mysqli_query($con1,"select * from proforma_order_details  where oid='".$orderid."' ");
                    
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
$track_id=$show_order_sql_result1['track_id'];
$outside_product=$show_order_sql_result1['outside_product'];
$discount=$show_order_sql_result1['discount'];
$dis_amount=$show_order_sql_result1['dis_amount'];

$productitem_id=$show_order_sql_result1['item_id'];
 $_product_id   = explode('/', $productitem_id);

$sku_id   =  $_product_id[1];
$product_id  =  $_product_id[2];


 $sku = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($pro_name1)));
 $sku=substr($sku, 0, 49);
 $pro_name1=substr($pro_name1, 0, 49);  

 $prolist= array(
    'name' => urldecode($pro_name1),
    'sku' => $sku,
    'units' => $pro_qty1,
    'selling_price' => $single_price1,
    'discount' =>'',
    'tax' => '',
    'hsn' => '',
     );
// array_push($prodata, $prolist);
 $prolist=json_encode($prolist);


if($item_id!=0)
{
  $itmdata=explode('/', $item_id);
  $ccode=getccode($itmdata[1],$itmdata[0]); 
  $vendor=getfranchise($ccode); 
  $vendorname=$vendor['name']; 
  $email=$vendor['email']; 
  $venphone=$vendor['phone']; 
  $productname=$pro_name1;
  $quntity=$pro_qty1;

}
else
{
  $ccode=getccodebyname($itmdata[1],$pro_name1); 
  $vendor=getfranchise($ccode); 
  $vendorname=$vendor['name'];
  $email=$vendor['email'];
  $venphone=$vendor['phone'];
  $productname=$pro_name1;
  $quntity=$pro_qty1;
}

 // var_dump($vendor);
 // echo "<br/>";

    ?>
     <input type="hidden" name="email[]" value="<?=$email?>">
            <input type="hidden" name="pro_name[]" value="<?=$productname;?>">
            <input type="hidden" name="quntity[]" value="<?=$quntity;?>">
            <input type="hidden" name="vendorname[]" value="<?=$vendorname;?>">

            <input type="hidden" id="length_<?=$proodr?>" >
            <input type="hidden" id="breadth_<?=$proodr?>" >
            <input type="hidden" id="height_<?=$proodr?>" >
            <input type="hidden" id="weight_<?=$proodr?>" >
            <!-- <input type="hidden"  value=""> -->
            <textarea name="" id="order_items_<?=$proodr?>" cols="30" rows="10" style="display: none;"><?=$prolist?></textarea>

                    <tr>
                        <td><?=$i+1?></td>
                        <td> <img src="<?=$pro_image1?>" alt="<?=$pro_name1?>" style="width:50px;height: 50px;"> </td>
                        <td><b><?=$pro_name1?></b></td>
                        <td><?=$pro_qty1?></td>
                        <td><?=$single_price1?></td>
                        <td><b><?=$total_amt1?></b></td>
                        <td><b><?=$discount?></b></td>
                        <td><b><?=$dis_amount?></b></td>
                        
                        
                        
                    </tr>
                <?php $i++; }  ?>
                       <tr>
                        <td colspan="4" align="right">Shipping Charge</td>
                        <td colspan="4" align="center"><b>Rs. <?=$orddetails['shipping_charges']?></b></td>
                        <td></td>
                    </tr><tr>
                        <td colspan="4" align="right">Discount</td>
                        <td colspan="4" align="center"><b>Rs. <?=$orddetails['discount']?></b></td>
                        <td></td>
                    </tr><tr>
                        <td colspan="4" align="right">Total Amount</td>
                        <td colspan="4" align="center"><b>Rs. <?=$orddetails['amount']?></b> </td>
                        <td></td>
                    </tr>
                    <tr>
                      <td colspan="4" align="right">Notes (Optional)</td>
                      <td> <input colspan="4" type="text" value="<?=$orddetails['Notes']?>" name="Notes" class="form-control" >
                      </td>
                    </tr>
                    <tr>
                      <td colspan="4" align="right"></td>
                      <td colspan="4">
                            <a class="btn  btn-danger" onclick="Download_proforma(<?=$orderid?>)">Download Proforma</a>

                            <a class="btn  btn-success" href="Convarttoorder.php?OrderPId=<?=$orderid?>">Convert To Order</a>
                        
                      </td>
                    </tr>
                </table>
            </div>
        </div> 
         
	</div>
   </form>
   


	
</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->
<div class="clear">&nbsp;</div>
<!-- start footer -->         
<div id="footer">
	<div class="clear">&nbsp;</div>
</div>







<script>
    function printDiv(boxid) {
     var printContents = document.getElementById(boxid).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>






<script>
    function Download_proforma(order_id)
    { debugger;
        $('.loader').show();
        $.ajax({
                type: "GET",
                url: "/invoice/proinvoice.php",
                data: 'order_id=' + order_id,
                success: function(msg) {
                    console.log(msg);
                    if (msg == 1) {
                        var url = '/invoice/bills/proInvoice-'+order_id+'.pdf';
                        // location.reload();

                        // window.location = url;

                        const a = document.createElement('a');
                          a.href = url;
                          a.download = url.split('/').pop();
                          document.body.appendChild(a);
                          a.click();
                          document.body.removeChild(a);

                           $('.loader').hide();

                    }
                }
            });
    }
</script>
<script src="js/order_courier.js"></script>
</body>
</html>