<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Merabazar</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="style.css">
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="../datepc/dcalendar.picker.css" rel="stylesheet" type="text/css">

 
<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('input').checkBox();
	$('#toggle-all').click(function(){
 	$('#toggle-all').toggleClass('toggle-checked');
	$('#mainform input[type=checkbox]').checkBox('toggle');
	return false;
	});
});
</script>  


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
	image: "images/forms/upload_file.gif",
	imageheight : 29,
	imagewidth : 78,
	width : 300
	});
});
</script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
 
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
</script> 
<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body> 
<!-- Start: page-top-outer -->
<div id="page-top-outer">    

<!-- Start: page-top -->
<div id="page-top">

	<!-- start logo -->
	<div id="logo">
	<a href=""><img src="logomera.png" width="156" height="40" alt="" /></a>
	</div>
	
 	<div class="clear"></div>

</div>
<!-- End: page-top -->

</div>
<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat"> 
<!--  start nav-outer -->
<div class=""> 

		<!-- start nav-right -->
		<div id="nav-right">
		
			<div class="nav-divider">&nbsp;</div>
			<div class="showhide-account"><img src="images/shared/nav/nav_myaccount.gif" width="93" height="14" alt="" /></div>
			<div class="nav-divider">&nbsp;</div>
			<a href="logout.php" id="logout"><img src="images/shared/nav/nav_logout.gif" width="64" height="14" alt="" /></a>
			<div class="clear">&nbsp;</div>
		
			<!--  start account-content -->	
			<div class="account-content">
			<div class="account-drop-inner">
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="changePaasword.php" id="acc-stats">Change Password</a> 
			</div>
			</div>
				
		
			<!--  end account-content -->
		
		</div>
		<!-- end nav-right -->

	<div class="nav">
		<!--  start nav -->
	<label for="show-menu" class="show-menu">Show Menu</label>
	<input type="checkbox" id="show-menu" role="button">
	<?php if($_SESSION['designation']=="0")
		    
		    {
		    ?>
	<ul id="menu">
	
		<li><a href="#"><b>Merchant</b></a>
			<ul class="hidden">
				<li><a href="admin.php">Merchants</a></li>
		    	<li><a href="merchant_details.php">Order Details</a></li>
				<li><a href="merchant_delete.php">Deleted Merchants</a></li>
				
				
			</ul>
			
		
		</li>
		
		
		
		<li><a href="#"><b>Options</b></a>
			<ul class="hidden">
			<li><a href="cities.php">Cities</a></li>
				<li class=""><a href="location.php">Areas</a></li>
					<li class=""><a href="sub_cat.php">Categories</a></li>
					<li class=""><a href="productapproval.php">Approve Products</a></li>
			</ul>
			
		
		</li>
		
		<li><a href="HomePageImage.php"><b>HomePage</b></a>
		</li>
		
		
		
		<li><a href="#"><b>Ads</b></a>
			<ul class="hidden">
			<li><a href="upload_ads_videos.php">Upload Ads</a></li>
				<li><a href="slot_amount.php">Edit Slot Details</a></li>
				<li><a href="set_slot_todate.php">Set Rate For Ads</a></li>
				<li><a href="adsapprovaldetails.php">View Ads</a></li>
				<li><a href="adsbookingslotdetails.php">ads slot booking</a></li>
				<li><a href="set_ads_todatemn.php">set todays date for ads</a></li>
				<li><a href="schedulepr.php">Schedule Ads</a></li>
				
			</ul>
			
		
		</li>
	
	</ul>
	
	<?php } ?>
</div>
		
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
		</div>
		<!--  start nav -->

</div>
<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">
<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>

 
</body>
</html>