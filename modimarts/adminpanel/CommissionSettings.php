<?php
session_start();
include('config.php');
include('adminaccess.php');
$sql="SELECT * FROM `CommissionDeduction` WHERE id='1'";
$sqlidata=mysqli_query($con,$sql);
$sqlidetails=mysqli_fetch_assoc($sqlidata);
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Panel</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--  jquery core -->   
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>

<!--  styled select box script version 1 -->
<script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script>
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
<div class="clear">&nbsp;</div> 
<!------------------------------  start nav-outer-repeat....... START ------------------------->
<?php include('header.php');?>
<!-------------------------------- start nav-outer-repeat.... END ----------------------------->
<div class="clear"></div>
<div id="content-outer">
<!-- start content -->
<div id="content">
<form action="CommissionSettingsProcess.php" method="post">
<div class="row form-group">
  <div class="col-md-4">
    <label>GST %</label>
    <input type="text" onkeypress="return isNumber(event)" value="<?=$sqlidetails['gst']?>" class="form-control" name="gst" required>    
  </div>
  <div class="col-md-4 form-group">
    <label>TDS % <small class="text-danger">(If Customer have Pancard)</small></label>
    <input type="text" onkeypress="return isNumber(event)" value="<?=$sqlidetails['tds']?>" class="form-control" name="tds" required>    
  </div>
  <div class="col-md-4 form-group">
    <label>TDS % <small class="text-danger">(If Customer Don't have Pancard)</small></label>
    <input type="text" onkeypress="return isNumber(event)" value="<?=$sqlidetails['tds2']?>" class="form-control" name="tds2" required>    
  </div>
  <div class="col-md-4 form-group">
    <label>GST Limit</label>
    <input type="text" onkeypress="return isNumber(event)" value="<?=$sqlidetails['gst_limit']?>" class="form-control" name="gst_limit" required>    
  </div>
  <div class="col-md-4 form-group">
    <label>TDS Limit</label>
    <input type="text" onkeypress="return isNumber(event)" value="<?=$sqlidetails['tds_limit']?>" class="form-control" name="tds_limit" required>    
  </div>
  
</div>
<div class="row">
  <div class="col-md-12 form-group text-right">
    <button class="btn" type="submit">Submit</button>   
  </div>
</div>
</form>

  </div>
</div>
</body>

<script>
  function isNumber(evt) {
    // evt = (evt) ? evt : window.event;
   var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
}
</script>
</html>