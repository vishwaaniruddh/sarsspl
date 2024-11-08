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
<form action="addchargeprocess.php" method="post">
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
<div class="col-md-4 form-group">
  <label>Start Amount</label>
  <input type="number" name="first_price" class="form-control">
</div>
<div class="col-md-4 form-group">
  <label>Total Amount</label>
  <input type="number" name="totalamt" class="form-control">
</div>
<div class="col-md-4 form-group">
  <label>Charge</label>
  <input type="number" name="charge" class="form-control">
</div>
<div class="col-md-4 form-group">
  <label>Weight</label>
  <input type="number" step="0.1" name="weight" class="form-control">
</div>
<div class="col-md-4 form-group">
  <label>User Type</label>
  <select name="user_type" class="form-control">
    <option value="1">Customer</option>
    <option value="2">Franchise</option>
  </select>
</div>
<div class="col-md-4 form-group">
  <label>Franchise Type</label>
  <select name="franchise_type" class="form-control">
    <option value="0">None</option>
    <option value="1">Village</option>
    <option value="2">Management</option>
  </select>
</div>
<div class="col-md-4 form-group">
  <label>Product Type</label>
  <select name="Product_type" class="form-control">
    <option value="0">None</option>
    <option value="1">All Product</option>
    <option value="588">B del</option>
  </select>
</div>
  <div class="col-md-12 ">
    <input type="submit" value="Submit" style="float: right;" name="addcharge" class="btn btn-primary">
  </div>

</div>
</form>

  </div>
</div>
</body>
</html>