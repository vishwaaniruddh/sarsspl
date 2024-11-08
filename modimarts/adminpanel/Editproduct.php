<?php
session_start();
include('config.php');
include('adminaccess.php');

 $id=$_GET['ccode'];
    $pcode=$_GET['pcode'];
    $pcat=$_GET['cat'];
    $prodid=$_GET['prodid'];

    if($pcat==1)
    {
         $qry2="select *  from fashion where code='$pcode' ";
    }
    else if($pcat==190)
    {
         $qry2="select *  from electronics where code='$pcode'  ";
    }
    else if($pcat==218)
    {
         $qry2="select *  from grocery where code='$pcode'  ";
    }else if($pcat==482)
    {
         $qry2="select *  from Resale where code='$pcode'  ";
    }
    else
    {
     $qry2="select *  from products where code='$pcode' ";
    }
    $res2=mysqli_query($con1,$qry2);
    $nrwsd=mysqli_num_rows($res2);
    $row2=mysqli_fetch_array($res2);

    // var_dump($row2);
    //ruchi Get product name by id
    $prod = mysqli_query($con1,"SELECT * FROM product_model where id='".$prodid."'");
    $product_name = mysqli_fetch_assoc($prod);
    //ruchi Get brand name by id
    $brand = mysqli_query($con1,"SELECT brand FROM brand where id='".$row2['brand']."'");
    $brand_name = mysqli_fetch_assoc($brand);
    $sltcat=mysqli_query($con1,"SELECT name FROM `main_cat` where id ='".$row2[4]."' ");
    $sltcat=mysqli_fetch_array($sltcat);
?>
<?php
session_start();
include('config.php');
include('adminaccess.php');
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
<div id="content">
  <?php 
  $img=Getimg($pcode,$pcat);
  $minqty=$row2['minqty'];
  $maxqty=$row2['maxqty'];
  $franchise_price=$row2['franchise_price'];
  $total_amt=$row2['total_amt'];
  $HSN=$row2['HSN'];
  $gst=$row2['gst'];
   ?>
<form action="editproductprocess.php" method="post">
<div class="row">
  <?php
   if(isset($_GET['status'])){ 
    if ($_GET['status']=='success') {
      ?>
      <div class="col-md-12 form-group">
      <div class="bg-success">
        <p style="margin:1%;font-weight: bold;">Updated Successfully</p>
      </div>   
    </div>

      <?php
    } else {
      ?>
      <div class="col-md-12 form-group">
      <div class="bg-danger">
        <p style="margin:1%;font-weight: bold;">Update Failed</p>
      </div>   
    </div>
      <?php
    }
    
    ?>
  
<?php } ?>

  <div class="col-md-12">
    <div class="form-group">
      <label>Product Name</label>
      <input type="text" name="" class="form-control" value="<?=$product_name['product_model']?>" id="">
      <input type="hidden" name="pro_modal_id" class="form form-full" value="<?php echo $row2[1];?>" required/>
    </div>  
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Product IMG</label><br/>
     <img src="<?=$img?>" alt="" width="100" height="100">
    </div>  
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Product Minimum Qty</label><br/>
     <input type="number" name="minqty" value="<?=$minqty?>" class="form-control" id="">
     <input type="hidden" name="pcode" value="<?=$pcode?>">
     <input type="hidden" name="pcat" value="<?=$pcat?>">
     <input type="hidden" name="ccode" value="<?=$id?>">
     <input type="hidden" name="prodid" value="<?=$prodid?>">
    </div>  
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Product Maximum Qty</label><br/>
      <input type="number" value="<?=$maxqty?>" name="maxqty" class="form-control" id="">
    </div>  
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Franchise Price</label><br/>
      <input type="number" value="<?=$franchise_price?>" step=".01" name="franchise_price" class="form-control" id="">
    </div>  
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Customer Price</label><br/>
      <input type="number" value="<?=$total_amt?>" name="total_amt" step=".01" class="form-control" >
    </div>  
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Product HSN</label><br/>
      <input type="number" value="<?=$HSN?>" name="HSN" step=".01" class="form-control" >
    </div>  
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Product GST</label><br/>
      <input type="number" value="<?=$gst?>" name="gst" step=".01" class="form-control" >
    </div>  
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Product Status</label><br/>
      <select name="status" id="status" class="form-control"> 
        <option value="1" <?php if($product_name['status']=="1"){ echo "selected";} ?>>Active</option>
        <option value="0" <?php if($product_name['status']=="0"){ echo "selected"; } ?>>Dis-Active</option>
      </select>
    </div>  
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Sell Online</label><br/>
      <select name="is_online" id="is_online" class="form-control"> 
        <option value="1" <?php if($product_name['is_online']=="1"){ echo "selected";} ?>>Online</option>
        <option value="0" <?php if($product_name['is_online']=="0"){ echo "selected"; } ?>>Offline</option>
      </select>
    </div>  
  </div>
  <div class="col-md-12 ">
    <input type="submit" value="Submit" style="float: right;" name="Editprod" class="btn btn-primary">
  </div>

</div>
</form>

  </div>
</div>

<?php 
function Getimg($pid,$cid)
  {
       global $con1;
     
    $qrya           = "SELECT * FROM `main_cat` WHERE `id`='$cid'";
    $resulta        = mysqli_query($con1, $qrya);
    $rowa           = mysqli_fetch_row($resulta);
      $aa             = $rowa[2];
      
      

    
    if ($cid == 80)
      {
        $maincatid      = 5;
        $sql            = "select * from  `garment_product` where product_for='" . $maincatid . "' and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)";
      }
    else
      {
        if ($aa != 0)
          {
            $qrya1          = "select * from main_cat where id='" . $aa . "'";
            $resulta1       = mysqli_query($con1, $qrya1);
            $rowa1          = mysqli_fetch_row($resulta1);
            $Maincate       = $rowa1[4];
          }
        
      }
    
    if ($Maincate == 1)
      {
        $sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `fashion_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
      }
    else if ($Maincate == 190)
      {
        $sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$pid' order by id asc  limit 0,1");
        //  $imgrow=mysqli_fetch_row($sqlimg23mn);
        //  echo "SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$prod_id' order by id asc  limit 0,1";
        
      }
    else if ($Maincate == 218)
      {
        $sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `grocery_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
      }
    else if ($Maincate == 760)
      {
        $sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `kits_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
      }
    else if ($Maincate == 657)
      {
        $sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `service_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
      }
    else if ($Maincate == 767)
      {
        $sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `promotion_product_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
      }
    else
      {
        $sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
      }
    $frtu           = mysqli_fetch_array($sqlimg23mn);
    
    
        
        
            $pro_img        = '/ecom/' . $frtu[1];
          
      
      return $pro_img;
  }

 ?>
</body>
</html>