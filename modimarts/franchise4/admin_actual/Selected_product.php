<? session_start();
include('../config.php');

include '../ecommerce_config.php';

if (isset($_SESSION["username"])) {
    $usrid = $_REQUEST['id'];

    $check = "SELECT * FROM `franchise_product` WHERE id='" . $usrid . "'";
    $result = mysqli_query($con_web, $check);
    $result = mysqli_fetch_assoc($result);
    $user = $result['franchise_id'];
    $upd = "SELECT * FROM `new_member` WHERE  id='" . $user . "' ";
    $runsql = mysqli_query($con_web, $upd) or die(mysqli_error($con_web));
    $sql_result = mysqli_fetch_assoc($runsql);
    $payamount = $sql_result['payment_receivable'];
} else {
    header("Location:login_form.php");
}
function get_kit_info($id, $parameter)
{

    global $con_web;

    $sql = mysqli_query($con_web, "select $parameter from kits where code ='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result[$parameter];

}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>All Mart | Selected Product </title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

      <!-- fontawsome  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
      <!-- fontawsome  -->
    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
    
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  
  
    <style>
        section.content{
        margin: 13% 15px 0 15px;
        }
               .navbar-nav {
     margin: 2% auto !important;
}

        td{
                white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
        }
    </style>
    
        <style>
               section.content{
    margin: 13% 15px 0 15px;
        }
        
        td{
    overflow: hidden;
    text-overflow: ellipsis;
        }
        .navbar-nav {
     margin: 2% auto !important;
}
#member_pic img{
    height: 150px;
    /*width: 150px;*/
        border: 1px solid black;
}
.table tbody tr td{
    vertical-align: baseline;
    
}

@media (min-width: 991px) { 
    
.custom_row{
    display:flex;
}

}

@media (max-width: 991px) { 
    
.margin_row{
    margin: 30% auto;
}

}
#modal_body table{
    font-size:13px;
}


@media (min-width: 768px){

.modal-dialog {
    width: 900px;
    margin: 30px auto;
}    
}

    </style>
    
    
</head>
<body class="theme-red">
    <!-- Page Loader -->
    <!--<div class="page-loader-wrapper">-->
    <!--    <div class="loader">-->
    <!--        <div class="preloader">-->
    <!--            <div class="spinner-layer pl-red">-->
    <!--                <div class="circle-clipper left">-->
    <!--                    <div class="circle"></div>-->
    <!--                </div>-->
    <!--                <div class="circle-clipper right">-->
    <!--                    <div class="circle"></div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <p>Please wait...</p>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    
    
    
    
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header" style="min-width: 200px;">

                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                
                <a class="navbar-brand" href="http://www.allmart.world/franchise/" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                    <img src="https://allmart.world/assets/allmart.2png" style="width:100px;" >
                    <span style="margin: auto 5%;">AllMart</span>
                
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <? include('../menu.php');?>
                
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
  
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Franchise Select Product
                </h2>
            </div>
          <?php
          
        $product_data = "SELECT * FROM `products` WHERE status=1 and category=803";
        $product_data_array = mysqli_query($con1, $product_data);
       // $product_data_result = mysqli_fetch_assoc($product_data_array);
        
        ?>
        <div class="block-header">
        <select id="select_product" class="select_product">
            <option value="">Select New Product</option>
            <?php while($product_data_result = mysqli_fetch_assoc($product_data_array)){  
                 $_pro_name = $product_data_result['name']; 
                 $_pro_code = $product_data_result['code']; 
                 $_pro_price = $product_data_result['offer_price']; 
                 $_cat_id = $product_data_result['category']; 
                 
                 $prod = mysqli_query($con1, "SELECT product_model FROM product_model where id='" . $_pro_name . "'");
                 $product_name = mysqli_fetch_assoc($prod);
                 $_product_name = $product_name['product_model'];
                 
                 $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='" . $_pro_code . "'");
                 $frtu = mysqli_fetch_assoc($sqlimg23mn);

                // $qry = mysqli_query($con1, "SELECT product_specification,specificationname from productspecification where product_id='" . $_pro_code . "'");
 
                $pro_img = 'https://allmart.world/ecom/' . $frtu['img'];
                 
            ?>
                 <option value='<?php echo $_pro_code;?>' data-name='<?php echo $_product_name;?>' data-cat='<?php echo $_cat_id;?>' data-proname='<?php echo $_pro_name;?>'
                      data-img='<?php echo $pro_img;?>' data-price='<?php echo $_pro_price;?>'><?php echo $_product_name;?></option>
          <?php  }?>
            </select>
            <input type="hidden" id="new_product_img" value="">
            <input type="hidden" id="new_product_price" value="">
            <input type="hidden" id="new_product_name" value="">
            <input type="hidden" id="new_pro_name" value="">
            <input type="hidden" id="new_cat_id" value="">
            <a href="#" onclick="cart_add()" class="text-dark btn btn-success" > <i class="fa fa-plus-circle"></i> Add Product</a>
          </div>
        <?php
        $usrcheck = "SELECT * FROM `franchise_received_products` WHERE franchise_id='" . $user . "'";
        $usrresult = mysqli_query($con_web, $usrcheck);
        $usercount=mysqli_num_rows($usrresult);

          if($usercount==0){
          ?>
            <!-- container -->
            <div class="container">
            <form action="approve_purchase.php" method="POST" enctype="multipart/form-data">
            <div class="row">
            <div class="col-md-8">
            <div class="table-responsive">

            <table class="table table-bordered" style="border:1px solid black;">

              <thead>

                  

                <tr>

                  <th scope="col" class="border-0 bg-light">

                    <div>Product</div>

                  </th>

                  <th scope="col" class="border-0 bg-light">

                    <div>Total Price</div>

                    <span style="font-size: 10px; text-align: center;"></span>

                  </th>

                  <th scope="col" class="border-0 bg-light">

                    <div>Quantity</div>

                  </th>

                  <th scope="col" class="border-0 bg-light">

                    <div>Remove</div>

                  </th>

                </tr>

              </thead>

              <tbody id="selected_products">
            <!-- Exportable Table -->
            <?php

$check = "SELECT * FROM `franchise_product` WHERE franchise_id='" . $user . "'";
$result = mysqli_query($con_web, $check);
$rowcount = mysqli_num_rows($result);
if ($rowcount) {

    $rws2 = mysqli_fetch_assoc($result);
    $product_ids = $rws2['product_ids'];
    $proid = explode(',', $product_ids);
    $prices = explode(', ', $rws2['amounts']);
    $quntitys = explode(', ', $rws2['quantities']);
    $total_amount=0;

    for ($i = 0; $i < count($proid); $i++) {

        $quntity = $quntitys[$i];
        $price = $prices[$i];
        $_totalmount=$price*$quntity;
        $total_amount=$total_amount+$_totalmount;
        $proiddata = explode('/', $proid[$i]);
        $prod_id = trim($proiddata[2]);

        $pid = trim($proiddata[0]);

        $cid = trim($proiddata[1]);

//=================================================== query for get category which under 0 =================================================

        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc,shipping_in_area,shipping_out_state FROM `products` WHERE code='" . $pid . "'";

        $qrylatfrws = mysqli_query($con1, $qrylatf);

        $latstprnrws = mysqli_fetch_array($qrylatfrws);
        //  var_dump($latstprnrws);

        $prod = mysqli_query($con1, "SELECT product_model FROM product_model where id='" . $latstprnrws['name'] . "'");
        $product_name = mysqli_fetch_assoc($prod);
        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='" . $pid . "'");
        $frtu = mysqli_fetch_assoc($sqlimg23mn);

        $qry = mysqli_query($con1, "SELECT product_specification,specificationname from productspecification where product_id='" . $pid . "'");

        $amount = $latstprnrws['total_amt'];
        $pro_name = $product_name['product_model'];
        $pro_img = 'https://allmart.world/ecom/' . $frtu['img'];

        ?>

        
<tr id="product_<?php echo $pid;?>">

<td scope="row" class="border-0">

  

  <div class="p-2">

    <img src="<? echo $pro_img; ?>" alt="1798" width="70" class="cart_img">

   

    <div class="cart_product_name">

      <h5 class="mb-0"> <a id="sku_code" href="#" class="text-dark d-inline-block align-middle"><? echo $pro_name;?></a></h5>
      <input type="hidden" name="product_ids[]" value="<?=$pid?>/<?=$cid?>/<?=$prod_id?>">
       <input type="hidden" name="franchise_id" value="<?=$rws2['franchise_id']?>">
      

    </div>

  </div>

   <div class="single_price" style="font-size: 12px;">
   <input  type="text" name="amount[]" class="amount" id="amount<?=$pid?>" data-price="<? echo $price; ?>" value="<? echo $price; ?>" readonly></div>

</td>

  <td class="border-0 align-middle"><strong>

      <input  type="text" class="productprice" name="pro_amount" id="prototal_amount<?=$pid?>" value="<? echo $_totalmount; ?>/- Rs" border="none" readonly="">

      </strong>

  </td>

  <td class="border-0 align-middle">

      <div class="nights-count"><h6 class=""></h6>



        <button type="button" style="margin: 0; padding: 0; border: 0;background: transparent; outline:0; " class="button hollow circle" data-productinfo="minus" data-field="productinfo"> 

        

          <i class="fa" style="background: url(https://image.flaticon.com/icons/svg/149/149146.svg); height: 14px; width: 21px; background-repeat: no-repeat; outline:none;     vertical-align: middle;" aria-hidden="true" onclick="decrement(<?=$pid?>)">

          </i>

        </button>

          <input class="input-group-field" type="number" id="quntity<?=$pid?>" onchange="proquntity(<?=$pid?>)"  name="proquntity[]" product_id="<? echo $quntity; ?>" style="font-size: 14px;width: 30%;text-align: center;background: #f1f1f1;border: none;border-top: none;box-shadow: none;" min="1" value="<? echo $quntity; ?>">

          

          <button  type="button" style="margin: 0; padding: 0; border: 0;background: transparent; outline:none; " class="button hollow circle" data-productinfo="plus" data-field="productinfo">

            <i class="fa " style="background: url(https://image.flaticon.com/icons/svg/149/149145.svg); height: 14px; width: 21px; background-repeat: no-repeat; outline:none;    vertical-align: middle;" aria-hidden="true" onclick="increment(<?=$pid?>)"></i><br>

          </button>

      </div>

  </td>

<td class="border-0 align-middle"><a href="#" onclick="cart_remove('<?php echo $pid;?>')" class="text-dark btn btn-danger" ><i class="fa fa-trash"></i> Remove</a></td>

</tr>
        
            <?php
}

    ?>
    
    
      </tbody>

</table>
<?php if($total_amount>0){ ?>      

<div class="col" style=" border-top: 1px solid; padding-top: 5%;">

    <h3 class="total_show" style="font-weight:700;text-align: right;">
    <input type="hidden" name="prodid" value="<?=$usrid?>">

        Grand Total :<span id="subttl"> <?php echo  $total_amount;?></span> Rs/-
        <input type="hidden" name="subtotal" id="subtotal" value="<? echo $total_amount;?>" class="form-control" readonly>

    </h3>

       

</div>

<?php } 
?>
</div>

            <?php
} 
?>

</div>
<div class="col-md-3">
        <!-- Sidebar2 -->
        <div class="form-group">
         <label for="">Upload Images</label>
         <input type="file" name="send_imgs[]" class="form-control" multiple>
        </div>

        <div class="form-group">
         <label for="">Upload Videos</label>
         <input type="file" name="send_video" class="form-control">
        </div>

        <div class="form-group">
        <!-- <button onclick="add_pro()">Add Pro</button> -->
        </div>

        <div class="form-group">
         <input type="submit" name="appoved" class="btn btn-primary" value="Generate Bill & Proceed">
        </div>
        <!-- Sidebar2 -->
</div>
</div>
</form>
</div>
<!-- container end -->
<?php
          }
          else{
?>
<div class="container">
    <div class="row">
     <?php
     
$usrcheck = "SELECT * FROM `franchise_received_products` WHERE franchise_id='" . $user . "'";
$usrresult = mysqli_query($con_web, $usrcheck);
$count=mysqli_num_fields($usrresult);

if($count){


          ?>
            <!-- container -->
            <div class="row">
            <div class="col-md-8">
            <div class="table-responsive">

            <table class="table table-bordered" style="border:1px solid black;">

              <thead>

                  

                <tr>

                  <th scope="col" class="border-0 bg-light">

                    <div>Product</div>

                  </th>

                  <th scope="col" class="border-0 bg-light">

                    <div>Total Price</div>

                    <span style="font-size: 10px; text-align: center;"></span>

                  </th>

                  <th scope="col" class="border-0 bg-light">

                    <div>Quantity</div>

                  </th>

                </tr>

              </thead>

              <tbody>
            <!-- Exportable Table -->
            <?php

$check1 = "SELECT * FROM `franchise_received_products` WHERE franchise_id='" . $user . "'";
$result1 = mysqli_query($con_web, $check1);
$rowcount1 = mysqli_num_rows($result1);

if ($rowcount1) {

    $rws2 = mysqli_fetch_assoc($result1);
    $product_ids = $rws2['product_ids'];
    $proid = explode(',', $product_ids);
    $prices = explode(', ', $rws2['amounts']);
    $quntitys = explode(', ', $rws2['quantities']);
    $total_amount=0;

    for ($i = 0; $i < count($proid); $i++) {

        $quntity = $quntitys[$i];
        $price = $prices[$i];
        $_totalmount=$price*$quntity;
        $total_amount=$total_amount*$_totalmount;
        $proiddata = explode('/', $proid[$i]);
        $prod_id = trim($proiddata[2]);

        $pid = trim($proiddata[0]);

        $cid = trim($proiddata[1]);

//=================================================== query for get category which under 0 =================================================

        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc,shipping_in_area,shipping_out_state FROM `products` WHERE code='" . $pid . "'";
        $qrylatfrws = mysqli_query($con1, $qrylatf);
        $latstprnrws = mysqli_fetch_array($qrylatfrws);
        //  var_dump($latstprnrws);
        $prod = mysqli_query($con1, "SELECT product_model FROM product_model where id='" . $latstprnrws['name'] . "'");
        $product_name = mysqli_fetch_assoc($prod);
        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='" . $pid . "'");
        $frtu = mysqli_fetch_assoc($sqlimg23mn);
        $qry = mysqli_query($con1, "SELECT product_specification,specificationname from productspecification where product_id='" . $pid . "'");
        $amount = $latstprnrws['total_amt'];
        $pro_name = $product_name['product_model'];
        $pro_img = 'https://allmart.world/ecom/' . $frtu['img'];

        ?>      
<tr id="YNB177">
<td scope="row" class="border-0">
  <div class="p-2">
    <img src="<? echo $pro_img; ?>" alt="1798" width="70" class="cart_img">
    <div class="cart_product_name">
      <h5 class="mb-0"> <a id="sku_code" href="#" class="text-dark d-inline-block align-middle"><? echo $pro_name;?></a></h5>
      <input type="hidden" name="product_ids[]" value="<?=$pid?>/<?=$cid?>/<?=$prod_id?>">
       <input type="hidden" name="franchise_id" value="<?=$rws2['franchise_id']?>">
    </div>
  </div>
   <div class="single_price" id="single_price" style="font-size: 12px;">
   <input  type="text" name="amount[]" class="amount" id="amount<?=$pid?>" data-price="<? echo $price; ?>" value="<? echo $price; ?>" readonly></div>
</td>
  <td class="border-0 align-middle"><strong>
      <input  type="text" class="productprice" name="pro_amount" id="prototal_amount<?=$pid?>" value="<? echo $_totalmount; ?>/- Rs" border="none" readonly="">
      </strong>
  </td>
  <td class="border-0 align-middle">
      <div class="nights-count"><h6 class=""></h6>
        <button type="button" style="margin: 0; padding: 0; border: 0;background: transparent; outline:0; " class="button hollow circle" data-productinfo="minus" data-field="productinfo"> 
          <i class="fa" style="background: url(https://image.flaticon.com/icons/svg/149/149146.svg); height: 14px; width: 21px; background-repeat: no-repeat; outline:none;     vertical-align: middle;" aria-hidden="true" onclick="increment(<?=$pid?>)">
          </i>
        </button>
          <input class="input-group-field" type="number" id="quntity<?=$pid?>" onchange="proquntity(<?=$pid?>)"  name="proquntity[]" product_id="<? echo $quntity; ?>" min="1" style="font-size: 14px;width: 30%;text-align: center;background: #f1f1f1;border: none;border-top: none;box-shadow: none;" value="<? echo $quntity; ?>" readonly>
          <button  type="button" style="margin: 0; padding: 0; border: 0;background: transparent; outline:none; " class="button hollow circle" data-productinfo="plus" data-field="productinfo">
            <i class="fa " style="background: url(https://image.flaticon.com/icons/svg/149/149145.svg); height: 14px; width: 21px; background-repeat: no-repeat; outline:none;    vertical-align: middle;" aria-hidden="true"  onclick="decrement(<?=$pid?>)"></i><br>
          </button>
      </div>
  </td>
</tr>
<?php
}
?>
    
      </tbody>

</table>
<?php if($total_amount>0){ ?>      

<div class="col" style=" border-top: 1px solid; padding-top: 5%;">

    <h3 class="total_show" style="font-weight:700;text-align: right;">

        Grand Total :<span id="subttl"> <?php echo sprintf("%.2f", $total_amount) ;?></span> Rs/-
        <input type="hidden" name="subtotal" id="subtotal" value="<? echo $total_amount;?>" class="form-control" readonly>

    </h3>

       

</div>

<?php } 
?>
</div>

       
    </div>
    <div class="col-md-3">
        <!-- Sidebar2 -->
        <div class="form-group">
         <?php 
         $imgs=$rws2['packaging_images'];
         $imgs = explode(', ', $imgs);
         for ($i=0; $i <count($imgs) ; $i++) { 
             ?>
             <img src="https://www.allmart.world/franchise/admin/<?=$imgs[$i]?>" alt="" style="width:100%">
            <?php
         }?>
        </div>

        <div class="form-group">
         <a href="<?php if($rws2['video_url']!=''){ ?>https://www.allmart.world/franchise/admin/<?php echo $rws2['video_url']; } else{ echo "#";} ?>" class="btn btn-primary">Video Link</a>
        </div>
        <!-- Sidebar2 -->
</div>
</div>
<?php
}
          }
        }
?>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!--<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>

    <script>
    var franchise_id = "<?php echo $rws2['franchise_id']?>";
    function proquntity(pid) 
    {
        var id="#prototal_amount"+pid;
        var amount="#amount"+pid;
        var quntity="#quntity"+pid;

        var amountval=$(amount).val();
        var quntityval=$(quntity).val();
        var totalamount=parseInt(amountval)*parseInt(quntityval);
          $(id).val(totalamount);
        // alert(totalamount);

        var values = 0.00;
        //  {

            $('.productprice').each(function() {
    //test
                var currentElement = $(this);
                        values = values + parseFloat($(this).val());
                        // alert(values);
            });
           
        // alert(values);
        var totalamt = parseFloat(values);
        $("#subtotal").val(totalamt);
        $("#subttl").html(totalamt);
        
    }
    function cart_remove(pid){ debugger;
        
        var amt = $('#amount'+pid).val();
        var qty = $('#quntity'+pid).val();
        var less_amt = amt*qty;
        var prevsubtotal = $('#subtotal').val();
        var newsubtotal = prevsubtotal - less_amt;
        $('#subtotal').val(newsubtotal);
        $('#subttl').text(newsubtotal);
        $('#product_'+pid).remove();
    }
   
    function cart_add(){ debugger;
        var productid = $('#select_product').val();
         var product_img = $('#new_product_img').val();
         var product_price = $('#new_product_price').val();
         var product_name = $('#new_product_name').val();
         var proname = $('#new_pro_name').val();
         var catid = $('#new_cat_id').val();
        var new_html = '<tr id="product_'+productid+'">';
        new_html += '<td scope="row" class="border-0">';
        new_html += '<div class="p-2"><img src="'+product_img+'" alt="1798" width="70" class="cart_img">';
        new_html += '<div class="cart_product_name">';
        new_html += '<h5 class="mb-0"><a href="#" class="text-dark d-inline-block align-middle">'+product_name+'</a></h5>';
        new_html += '<input type="hidden" name="product_ids[]" value="'+productid+'/'+catid+'/'+proname+'">';
        new_html += '<input type="hidden" name="franchise_id" value="'+franchise_id+'">';
        new_html += '</div></div>';
        new_html += '<div class="single_price" style="font-size: 12px;">';
        new_html += '<input type="text" name="amount[]" class="amount" id="amount'+productid+'" data-price="'+product_price+'" value="'+product_price+'" readonly=""></div></td>';
        new_html += '<td class="border-0 align-middle"><strong>';
        new_html += '<input type="text" class="productprice" name="pro_amount" id="prototal_amount'+productid+'" value="'+product_price+'/- Rs" border="none" readonly="">';
        new_html += '</strong></td>';
        new_html += '<td class="border-0 align-middle"><div class="nights-count"><h6 class=""></h6>';
        new_html += '<button type="button" style="margin: 0; padding: 0; border: 0;background: transparent; outline:0; " class="button hollow circle" data-productinfo="minus" data-field="productinfo">'; 
        new_html += '<i class="fa" style="background: url(https://image.flaticon.com/icons/svg/149/149146.svg); height: 14px; width: 21px; background-repeat: no-repeat; outline:none; vertical-align: middle;" aria-hidden="true" onclick="decrement('+productid+')"></i></button>';
        new_html += '<input class="input-group-field" type="number" id="quntity'+productid+'" onchange="proquntity('+productid+')" name="proquntity[]" product_id="1" style="font-size: 14px;width: 30%;text-align: center;background: #f1f1f1;border: none;border-top: none;box-shadow: none;" min="1" value="1">';
        new_html += '<button type="button" style="margin: 0; padding: 0; border: 0;background: transparent; outline:none; " class="button hollow circle" data-productinfo="plus" data-field="productinfo">';
        new_html += '<i class="fa " style="background: url(https://image.flaticon.com/icons/svg/149/149145.svg); height: 14px; width: 21px; background-repeat: no-repeat; outline:none;    vertical-align: middle;" aria-hidden="true" onclick="increment('+productid+')"></i><br>';
        new_html += '</button></div></td>';
        new_html += '<td class="border-0 align-middle"><a href="#" onclick="cart_remove('+productid+')" class="text-dark btn btn-danger"><i class="fa fa-trash"></i> Remove</a></td></tr>';
        $('#selected_products').append(new_html);
        var add_amt = product_price;
        var prevsubtotal = $('#subtotal').val();
        var newsubtotal = parseFloat(prevsubtotal) + parseFloat(add_amt);
        $('#subtotal').val(newsubtotal);
        $('#subttl').text(newsubtotal); 
    }
    $(document).ready(function() {
        $('select#select_product').change(function() {
            var price = $('select#select_product').find(':selected').data('price');
            $('#new_product_price').val(price);
             var img = $('select#select_product').find(':selected').data('img');
            $('#new_product_img').val(img);
             var name = $('select#select_product').find(':selected').data('name');
            $('#new_product_name').val(name);
            
             var proname = $('select#select_product').find(':selected').data('proname');
            $('#new_pro_name').val(proname);
            var catid = $('select#select_product').find(':selected').data('cat');
            $('#new_cat_id').val(catid);
        });
    });
    </script>

<script>
    function increment(id) {
        document.getElementById('quntity'+id).stepUp();
        proquntity(id);
    }
    function decrement(id) {
        document.getElementById('quntity'+id).stepDown();
        proquntity(id);
    }
</script>

    
</body>

</html>
