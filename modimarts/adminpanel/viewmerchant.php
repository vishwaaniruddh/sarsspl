<?php
session_start();
include('config.php');
include('adminaccess.php');

				$cmp=$_GET['cmp'];
				//echo $cmp;
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
<script type="text/javascript">

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


<!--  date picker script -->
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>

       
      
<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body> 

<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat................................................................................................. START -->
<?php include('header.php');?>
<!--  start nav-outer-repeat................................................... END -->

 <div class="clear"></div>
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<center><h1>ORDER ID:<?php echo $cmp?></h1></center>
	</div>
	<!-- end page-heading -->
<!--  start message-green -->


<?php
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
/*	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}*/
?>

	<table border="0"   width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
				 
			  <!--  start product-table ..................................................................................... -->
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-check"><p style="font-size:16px; color:#FFF;">Sr No</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Merchant Name</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Product Name</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Rate</p></th>
				    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Qty</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Discount</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Total amt</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Image</p></th>
					
					
					</tr>
                <?php
				include('config.php');

				$sql_statement = "select * from order_details where oid='".$cmp."'";
		
	$result = mysql_query($sql_statement);
	


$i=1;
while($row=mysql_fetch_array($result)){
    
    
    $getprdets1=mysql_query("select * from Productviewimg where product_id='".$row[2]."' and category='".$row[10]."'");
      $prdrws1=mysql_fetch_array($getprdets1);
      
      $query2 = "SELECT name FROM clients where code='".$row['mrc_id']."'";
      
//echo $query2;
$result2 = mysql_query($query2);

$row2=mysql_fetch_array($result2);

	$query1 = "SELECT name,photo,total_amt FROM Productviewtable where code='".$row['item_id']."' and category='".$row['cat_id']."' ";

$result1 = mysql_query($query1);
$row3=mysql_fetch_array($result1);

	$total = mysql_query("SELECT sum(total_amt) FROM order_details where oid='".$cmp."'");
	$rows5 = mysql_fetch_array($total);
      
				?>
				<tr class="alternate-row">
					<td><?php echo $i;?></td>
					<td><?php echo $row2['name']; ?></td>
					<td><?php echo $row3['name']; ?></td>
					<td><?php echo $row[3]; ?></td>
					<td><?php echo $row[4]; ?></td>
						<td><?php echo $row[5]; ?></td>
						<td><?php echo $row[8]; ?></td>
					<td><img src="<?php echo $mainpath.$prdrws1[3]; ?>" height="100px" width="100px" style="object-fit:contain"></td>
				
				</tr>
					
				
                <?php $i++; } ?>
                
                	
				</table>
				
				<!--  end product-table................................... --> 
				<div class="pull-right">
		<div class="span">
				<div><h3>Total amount :- <?php echo $rows5['sum(total_amt)']; ?></h3></div>
						</div>
			</div>
			
	</div>
			<!--  end content-table  -->
		
			
			
			<!--  start paging..................................................... --><!--  end paging................ -->
			
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -
	<div id="footer-left">
	
	Admin Skin &copy; Copyright 1 Click Guide. <span id="spanYear"></span> <a href="1clickguide.org">www.1ClickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>