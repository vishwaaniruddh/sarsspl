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
		<h1>All Merchants</h1>
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


<form action="" method="POST">
				<div id="message-green">
				    
				<table border="0" width="100%"   cellpadding="0" cellspacing="0">
				<tr>
					<td class=""  height="40px;" valign="middle"> <b>From Date </b>
           <!--<input type="text" class="form-control"   name="fdate" id="fdate"   class="inp-form"  />-->
           <input type="text"   class="form-control"   name="fdate" id="fdate" data-maxdate="<?php echo date("Y-m-d", strtotime("+1 day"));?>"  class="inp-form"  />
      
           <b>To Date </b>
           <input type="text"   class="form-control"   name="todate" id="todate" data-maxdate="<?php echo date("Y-m-d", strtotime("+1 day"));?>"  class="inp-form"  />
      
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="datepc/dcalendar.picker.js"></script>
        <script>
          $('#fdate').dcalendarpicker({format: 'dd-mm-yyyy'});
           $('#todate').dcalendarpicker({format: 'dd-mm-yyyy'});
        </script>



<input type="submit" action="" method="post" value="Search">
</td>
					
				</tr>
				</table>
				</div>
				<!--  end message-green -->
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
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Name</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Code</p></th>
				    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Address</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Category</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Email</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Date Of Registration</p></th>
					
					</tr>
                <?php
				include('config.php');
				$sql_statement = "select * from clients where 1=1 ";
				
				if($_POST['fdate']!="" && $_POST['todate']!="")
{
    $fd= date('Y-m-d', strtotime($_POST['fdate']));
    $td= date('Y-m-d', strtotime($_POST['todate']));
    
     $sql_statement.=" and  date(rdate) BETWEEN '".$fd."' AND '".$td."'  ";
}
			else if($_POST['fdate']!="")
{
   $fd= date('Y-m-d', strtotime($_POST['fdate']));
    
     $sql_statement.=" and  date(rdate)>='".$fd."' ";
   
    
}
else if($_POST['todate']!="")
{
   $td= date('Y-m-d', strtotime($_POST['todate']));
    
     $sql_statement.=" and  date(rdate)<='".$td."' ";
}


//echo $sql_statement;
	$result = mysql_query($sql_statement);
	
//$clde=mysql_fetch_array($result);

				
				
				
				


$i=1;
while($row=mysql_fetch_row($result)){
				?>
				<tr class="alternate-row">
					<td><?php echo $i;?></td>
					<td><?php echo $row[1]; ?></td>
					<td><?php echo $row[0]; ?></td>
					<td><?php echo $row[5]; ?></td>
						<td><?php echo $row[7]; ?></td>
						<td><?php echo $row[10]; ?></td>
					<td><?php echo $row[19]; ?></td>
						
				</tr>
                <?php $i++; } ?>
				</table>
				<!--  end product-table................................... --> 
				
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