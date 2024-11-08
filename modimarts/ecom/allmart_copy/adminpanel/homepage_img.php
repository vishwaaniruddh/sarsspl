<?php
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}
?>
<?php include('header.php');
include('config.php');
 ?>
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Banners</h1></div>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
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
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
	
		<!--  end step-holder -->
	
		<!-- start id-form -->
		

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Sr No</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Banner Position</p>	</th>
					
					
					
					<th class="table-header-options line-left"><p style="font-size:16px; color:#FFF;">Options</p></th>
                    </tr>
                    <tr class="alternate-row">
<td>1</td><td>Top Left</td><td><a href='viewBanners.php?pos=ltop' title="Edit" class="icon-1 info-tooltip"></a><a href='viewBanners.php?pos=ltop' title="Delete" class="icon-2 info-tooltip"></a></td></tr>       

<tr class="alternate-row">
<td>2</td><td>Top Right</td><td><a href='viewBanners.php?pos=rtop'  title="Edit" class="icon-1 info-tooltip"></a><a href='viewBanners.php?pos=rtop' title="Delete" class="icon-2 info-tooltip"></a></td></tr>

<tr class="alternate-row">
 <td>3</td><td>Bottom Left</td><td><a href='viewBanners.php?pos=lbottom' title="Edit" class="icon-1 info-tooltip"></a><a href='viewBanners.php?pos=lbottom' title="Delete" class="icon-2 info-tooltip"></a></td></tr>

 <tr class="alternate-row">
 <td>4</td><td>Bottom Right</td><td><a href='viewBanners.php?pos=rbottom' title="Edit" class="icon-1 info-tooltip"></a><a href='viewBanners.php?pos=rbottom' title="Delete" class="icon-2 info-tooltip"></a></td></tr>

 <tr class="alternate-row">
 <td>5</td><td>Center Bottom</td><td><a href='viewBanners.php?pos=cbottom' title="Edit" class="icon-1 info-tooltip"></a><a href='viewBanners.php?pos=cbottom' title="Delete" class="icon-2 info-tooltip"></a></td></tr>
                

</table>
	<!-- end id-form  -->

	</td>
	<td>

</td>
</tr>
<tr>
<td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>

</table>









 





<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">
	Admin Skin &copy; Copyright 1Click Guide. <a href="1clickguide.org">www.1clickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>