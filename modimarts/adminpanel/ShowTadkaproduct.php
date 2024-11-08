<?php 
session_start();
include('config.php');
include('adminaccess.php');
include '../apidata.php';

$product_id    = mysqli_real_escape_string($con1, $_GET['pro_id']);
// var_dump($product_id);


$res_responce=GetProductdata('getProductInfo',$product_id);
$Prodata=$res_responce->Records;
$Sku_id=$Prodata[0]->Sku_id;

$size_responce=getProductSizes('getProductSizes',$product_id,$Sku_id);
$col_responce=getProductColors('getProductColors',$product_id,$Sku_id);
$size_res=$size_responce->Records;
$color_res=$col_responce->Records;

$color=$color_res[0]->Color_id;
$size=$size_res[0]->Size_id;

// var_dump($res_responce);


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

<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
    

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


<!--  styled file upload script --> 
<script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>


<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
 
<!--  date picker script -->
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>


<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>

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

<?php 

for ($j=0; $j <count($Prodata) ; $j++) { 

   

    
 ?>
<div id="content">
 

<div class="row">
  

<?php 
 $pro_name=$Prodata[$j]->Title;
    $description=$Prodata[$j]->Description;
    $amount=$Prodata[$j]->Regular_price;
    $minqty=1;
    $stock=number_format($Prodata[$j]->Stock_qty);
    $maxqty=number_format($Prodata[$j]->Stock_qty);

    $Regular_price = $Prodata[$j]->Regular_price;
    $Product_id = $Prodata[$j]->Product_id;
    $Shipping_charges = $Prodata[$j]->Shipping_charges;
    $Sku_id = $Prodata[$j]->Sku_id;
    $Medium_file = $Prodata[$j]->Medium_file;
    $Regular_price = $Prodata[$j]->Regular_price; ?>

  
  <div class="col-md-3">
    <div class="form-group">
      <label>Product IMG</label><br/>
     <img src="https://thebrandtadka.com/images_inventory_products/front_images/<?=$Medium_file?>" alt="" width="100" height="100">
    </div>  
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Product Name</label>
      <input type="text" name="" class="form-control" value="<?=$pro_name?>" id="">
    </div>  
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Product Stock Qty</label><br/>
     <input type="number" name="minqty" value="<?=$stock?>" class="form-control" id="">
    </div>  
  </div>
  <!-- <div class="col-md-3">
    <div class="form-group">
      <label>Product Maximum Qty</label><br/>
      <input type="number" value="<?=$maxqty?>" name="maxqty" class="form-control" id="">
    </div>  
  </div> -->
  <div class="col-md-3">
    <div class="form-group">
      <label>Product Price</label><br/>
      <input type="number" value="<?=$amount?>" step=".01" name="franchise_price" class="form-control" id="">
    </div>  
  </div>
  <!-- <div class="col-md-3">
    <div class="form-group">
      <label>Customer Price</label><br/>
      <input type="number" value="<?=$total_amt?>" name="total_amt" step=".01" class="form-control" >
    </div>  
  </div> -->
 <!--  <div class="col-md-3">
    <div class="form-group">
      <label>Product HSN</label><br/>
      <input type="number" value="<?=$HSN?>" name="HSN" step=".01" class="form-control" >
    </div>  
  </div> -->
  <div class="col-md-3">
    <div class="form-group">
      <label>Product Shopping Charge</label><br/>
      <input type="number" value="<?=$Shipping_charges?>"  class="form-control" >
    </div>  
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Product Discription</label><br/>
      <?=$description?>
  </div>
 

</div>
</form>

  </div>
</div>

<?php } ?>
</body>
</html>