<?php
session_start();
include 'config.php';
include 'adminaccess.php';
$orderid = $_GET['orderid'];


$orderdetails = mysqli_query($con1, "SELECT * FROM `proforma_Order_ent` WHERE id=" . $orderid . " ORDER BY `proforma_Order_ent`.`id` ASC");
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
       
      
       <input type="hidden" id="order_id" value="<?php echo $orderid; ?>">
       <?php
$sql_address = mysqli_query($con1, "select * from proforma_new_order where oid='" . $orddetails['id'] . "'");

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

<form action="EditProformaDetailprocess.php" method="post">
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
                <label>Order Date</label>
                <input type="text" class="form-control" value="<?=date('Y-m-d H:i:s', strtotime($orddetails['date']))?>" name="orderdate" >
                <input type="hidden" value="<?=$orddetails['pmode']?>" name="ordertype">
                <input type="hidden" value="<?=$orddetails['is_franchise']?>" name="is_franchise">
                <input type="hidden" value="<?=$orddetails['user_id']?>" name="userid">
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
        <div class="row">
        <div class="col-md-1"> 
           <label><small>API Product</small></label> <input type="checkbox" id="apicheck" class="form-control">
        </div>
                                                    <div class="col-md-9">
                                                      <div class="form-group" >
                                                          <label>Enter Product Name</label>
                                                          <input type="text" list="prolist" class="form-control typeahead" id="productdescrip"  placeholder="Enter Product Name">
                                                          <datalist id="prolist">
                                                          </datalist>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                      <div class="form-group" >
                                                          <br/>
                                                          <a   class="btn btn-primary text-white" style="margin-top:3%;" onclick="Addtolist()" >Add product</a>
                                                      </div>
                                                    </div>
                                                  </div>

        <div class="col-md-12">

            <h5>Order Products</h5>
            <div class="form-group">
               <table class="table table-responsive">
            <thead><tr>
                <th>S.no</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Dis(%)</th>
                <th>DIs Amount</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="addrowhere">
              <?php 
              $delidss = array();
              $delids=json_encode($delidss);
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
                  $item_id=$show_order_sql_result1['item_id'];
                  $outside_product=$show_order_sql_result1['outside_product'];
                  $image=$show_order_sql_result1['image'];
                  $mrc_id=$show_order_sql_result1['mrc_id'];
                  $discount=$show_order_sql_result1['discount'];
                  $dis_amount=$show_order_sql_result1['dis_amount'];

                  $orderdata=explode('/', $item_id);
                  $pid=$orderdata[0];
                  $cat=$orderdata[1];
                  $prod_id=$orderdata[2];

               ?>
              <tr id="prorow_<?=$i+1?>">
                <td><?=$i+1?></td>
                <td>
                  <input type="text" name="productId[]" class="form-control" value="<?=$pro_name1?>" id="productId_1" readonly="">
                  <input type="hidden" id="orderDeta_<?=$i+1?>" name="itemid[]" value="<?=$proodr?>">
                  <input type="hidden" name="pid[]" value="<?=$pid?>">
                  <input type="hidden" name="prod_id[]" value="<?=$prod_id?>">
                  <input type="hidden" name="category_id[]" value="<?=$cat?>">
                  <input type="hidden" name="vendor[]" value="<?=$mrc_id?>">
                  <input type="hidden" name="pro_img[]" value="<?=$image?>">
                  <input type="hidden" name="outside_product[]" value="<?=$outside_product?>">
                </td>
                <td>
                  <input type="number" step="0.01" min="1" name="productprice[]" value="<?=$single_price1?>" onchange="subtotal()" class="form-control cprice" id="productprice_1" required>
                </td>
                <td>
                  <input type="number" name="productqty[]" step="0.01" min="1" value="<?=$pro_qty1?>" onchange="subtotal()" min="1" class="form-control qty" id="productqty_1" required>
                </td>
                <td>
                  <input type="text" onchange="subtotal()" name="pro_total[]" value="<?=$total_amt1?>" min="1" class="form-control subtotal" id="pro_total_1" readonly required>
                  
                </td> 
                <td>
                  <input type="text" onchange="subtotal()" name="pro_dis[]" value="<?=$discount?>" min="1" class="form-control prodis" id="pro_total_1"  required>
                  
                </td> 
                <td>
                  <input type="text" onchange="subtotal()" name="pro_disamt[]" value="<?=$dis_amount?>" min="1" class="form-control prodisamt" id="pro_total_1" readonly required>
                  
                </td> 
                <td>
                    <a class="btn btn-danger" onclick="return Remove('<?=$i+1?>')">Delete</a>
                </td>
              </tr>  
              <?php
              $i++ ;
               } ?>             

            <tfoot>


                <tr>
                    <td colspan="3" align="right">Discount</td>
                    <input  type="hidden" id="rowcount" value="<?=$i+1?>">
                    <td> <input colspan="2" type="text" id="totaldiscount"  name="discount" class="form-control" value="<?=$orddetails['discount']?>" readonly>
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

    function Remove(count)
    {
        var del =confirm("Are You Sure Delete This Records");
        if(del){            
            
        var orderdata = $("#orderDeta_"+count).val();
        if(orderdata)
        {
          // alert("Ajex Call");
          DeleteOrderFromData(orderdata);  
        }

        

        $("#prorow_"+count).remove(); 
        subtotal();
        
        
        }
    }
</script>

<script>
    function DeleteOrderFromData(orderdata)
    {
        $.ajax({
                          type: 'POST',
                          url: "ajexprafomadelete.php",
                          data: {orderids:orderdata},
                          success: function(resultData) {
                            alert(resultData);
                            
                            console.log(resultData);
                          }
                    });

    }
</script>

<script>
     $("#productdescrip").on("keyup", function(e) {
                   var productdescrip= $("#productdescrip").val();
                   var n = productdescrip.length;
                   if (n>2) {
                      var myKeyVals = { proname :productdescrip}


                      // alert(productdescrip);
                      // var apicheck=$('#apicheck').val();
                      if($('#apicheck').prop('checked')){
                        // alert("API Pro");
                  $.ajax({
                          type: 'POST',
                          url: "apiSearch.php",
                          data: myKeyVals,
                          success: function(resultData) {
                            // alert(resultData);
                            $("#prolist").html(resultData);
                            // console.log(resultData);
                          }
                    });
                      }else{

                    $.ajax({
                          type: 'POST',
                          url: "productserach.php",
                          data: myKeyVals,
                          success: function(resultData) {
                            // alert(resultData);
                            $("#prolist").html(resultData);
                            // console.log(resultData);
                          }
                    });
                 // alert("NOT API Pro");
                }


                  }
                  });

     function Setproid(val)
     {
        alert(val);
     }

             function Addtolist()
               {
                     var productdescrip= $("#productdescrip").val();
                   var n = productdescrip.length;
                   if (n>2) {

                    var array = productdescrip.split("~");
                    var productdescrip=array[0];
                    var product_id=array[1];

                      var myKeyVals = { proname :productdescrip,product_id:product_id}
                       if($('#apicheck').prop('checked')){

                        $.ajax({
                          type: 'POST',
                          url: "apiSearchdata.php",
                          data: myKeyVals,
                          success: function(resultData) {
                            // alert(resultData);
                         var data = $.parseJSON(resultData)
                           var productname=data.apidata[0].Title;
                           var offer_price=data.apidata[0].Price;
                           var prod_id=data.apidata[0].Sku_id;
                           var pid=data.apidata[0].Product_id;
                           var gst1=data.apidata[0].Gst_per_first;
                           var gst2=data.apidata[0].Gst_per_second;
                           var minqty=data.apidata[0].Stock_qty;
                           var color=data.color;
                           var size=data.size;
                           if(offer_price>100)
                           {
                            var gst=gst2;
                           }
                           else
                           {
                            var gst=gst1;
                           }
                           var vendor="Tadka";
                           var category_id=data.apidata[0].Sku_id;
                           var Hsn_code=data.apidata[0].Hsn_code;
                           var photo='https://thebrandtadka.com/images_inventory_products/front_images/'+data.apidata[0].Medium_file;

                            var rowcount= $("#rowcount").val();
                            var count=parseInt(rowcount)+1;
                            var prolink='<a href="/product_detail.php?pid='+pid+'&catid='+category_id+'&prod_id='+prod_id+'"><img src="'+photo+'"width="50" height = "50" alt=""></a>';

                           var prodata ='<input type="hidden" name="pid[]" value="'+pid+'"><input name="prod_id[]" type="hidden" value="'+prod_id+'"><input type="hidden" name="category_id[]" value="'+category_id+'"><input type="hidden" name="outside_product[]" value="1"><input type="hidden" name="size[]" value="'+size+'"><input type="hidden" name="color[]" value="'+color+'"><input type="hidden" name="hsn[]" value="'+Hsn_code+'"><input type="hidden" name="gst[]" value="'+gst+'"><input type="hidden" name="mrp[]" value="'+offer_price+'"><input type="hidden" name="vendor[]" value="'+vendor+'"><input type="hidden" name="pro_img[]" value="'+photo+'"><input type="hidden" name="itemid[]" value="">';

                            var html='<tr id="prorow_'+count+'"><td>'+count+'</td><td ><input type="text" name="productId[]" class="form-control" value="'+productname+'" id="productId_'+count+'" readonly>'+prodata+'</td><td><input type="text" name="productprice[]" value="'+offer_price+'" onChange="subtotal()"  step="0.01" min="0" class="form-control cprice" id="productprice_'+count+'"></td><td><input type="number" name="productqty[]" onChange="subtotal()" min="1"  class="form-control qty"  max="'+minqty+'"  id="productqty_'+count+'" required></td><td><input type="text" onChange="subtotal()"  name="pro_total[]" class="form-control subtotal" step="0.01" min="0" onChange="subtotal()"  id="pro_total_'+count+'" readonly></td><td><input type="number" onChange="subtotal()" step="0.01" min="0" value="0"  name="pro_dis[]" class="form-control prodis" onChange="subtotal()"  id="pro_dis_'+count+'"></td><td><input type="text" onChange="subtotal()" step="0.01" min="0"  name="pro_disamt[]" class="form-control prodisamt" onChange="subtotal()"  id="pro_disamt_'+count+'" readonly></td><td><button class="btn btn-sm btn-danger" onclick="return Remove('+count+')">remove</button></td></td></tr>';

                            // $("#addrow").append(rowhtml);


                            $("#addrowhere").append(html);
                            $("#rowcount").val(count);

                            $("#productdescrip").val("");
                            $("#prolist").html("");

                          }
                    });

                       }
                       else {

                     $.ajax({
                          type: 'POST',
                          url: "productdetails.php",
                          data: myKeyVals,
                          success: function(resultData) {
                            // alert(resultData);
                         var data = $.parseJSON(resultData)
                           var productname=data.product_model;
                           var offer_price=data.total_amt;
                           var prod_id=data.id;
                           var pid=data.code;
                           var vendor=data.vendor;
                           var category_id=data.category_id;
                           var photo='/ecom/'+data.photo;

                            var rowcount= $("#rowcount").val();
                            var count=parseInt(rowcount)+1;
                            var prolink='<a href="/product_detail.php?pid='+pid+'&catid='+category_id+'&prod_id='+prod_id+'"><img src="'+photo+'"width="50" height = "50" alt=""></a>';

                           var prodata ='<input type="hidden" name="pid[]" value="'+pid+'"><input name="prod_id[]" type="hidden" value="'+prod_id+'"><input type="hidden" name="category_id[]" value="'+category_id+'"><input type="hidden" name="vendor[]" value="'+vendor+'"><input type="hidden" name="pro_img[]" value=""><input type="hidden" name="outside_product[]" value="0"><input type="hidden" name="itemid[]" value="">';

                            var html='<tr id="prorow_'+count+'"><td>'+count+'</td><td><input type="text" name="productId[]" class="form-control" value="'+productname+'" id="productId_'+count+'" readonly>'+prodata+'</td><td><input type="text" name="productprice[]" value="'+offer_price+'" onChange="subtotal()"  step="0.01" min="0"  class="form-control cprice" id="productprice_'+count+'"></td><td><input type="number" name="productqty[]" onChange="subtotal()" min="1" class="form-control qty" id="productqty_'+count+'" required></td><td><input type="text" onChange="subtotal()" step="0.01" min="0"  name="pro_total[]" class="form-control subtotal" onChange="subtotal()"  id="pro_total_'+count+'" readonly></td><td><input type="number" onChange="subtotal()" step="0.01" min="0" value="0"  name="pro_dis[]" class="form-control prodis" onChange="subtotal()"  id="pro_dis_'+count+'"></td><td><input type="text" onChange="subtotal()" step="0.01" min="0"  name="pro_disamt[]" class="form-control prodisamt" onChange="subtotal()"  id="pro_disamt_'+count+'" readonly></td><td><button class="btn btn-sm btn-danger" onclick="return Remove('+count+')">remove</button></td></td></tr>';

                            // $("#addrow").append(rowhtml);


                            $("#addrowhere").append(html);
                            $("#rowcount").val(count);

                            $("#productdescrip").val("");
                            $("#prolist").html("");

                          }
                    });
                 }

                   }
                   }

</script>

<script>
  function  getmax(id)
    {
       var max= $('#'+id).attr('max');
       alert(max);
    }
</script>



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

                       var discount=$("#totaldiscount").val();
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

                        $('#totaldiscount').val(totldisamt);                        
                        
                    }
</script>

<script>
    function DeleteOrder()
    {
        vardata= confirm("Are You Sure Delete This Record");
        if (vardata) { alert("delete");}
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