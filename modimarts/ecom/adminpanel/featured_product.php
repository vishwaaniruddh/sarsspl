<?php
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}
 include('header.php');
include('config.php');
$pos=$_GET['pos'];
 ?>
 <style>
 .back {
    background: url(../images/forms/form_submit.gif) no-repeat;
    border: none;
    cursor: pointer;
    display: block;
    float: left;
    height: 30px;
    margin: 0 4px 0 0;
    padding: 0;
    text-indent: -3000px;
    width: 80px;
}
 </style>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>fetcher Product</h1></div>

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
	<!--  start content-table-inner 
	 <a href="viewBanners.php"> <input name="button"  type='button'  value="<< Back" /></a>-->
	<div id="content-table-inner">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
	
		<!--  end step-holder -->
	
		<!-- start id-form -->
		<?php $qry="select * from latest_featured_product ";
               $result=mysql_query($qry);  ?>

<form action='add_fetcher.php' enctype='multipart/form-data' method='post' >
<table width="50%" id="id-form" align="center">
    <tr>
   
<td>
<select name="typ" id="typ" class="styledselect_form_1">

<option value="1">Latest</option>
<option value="2">Featured</option>
<option value="3">Special</option>
        
				</select>



</tr>
<tr>
<td><input type="text" name="productid" id="productid" placeholder="Product id" class="inp-form"/></td>

</tr>
<tr>
<td><input name="Submit" id="Submit" type='submit' class="form-submit"/>
                  </td></tr></table></form>	</td>

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
	<!--  start footer-left -
	<div id="footer-left">
	Admin Skin &copy; Copyright 1Click Guide. <a href="1clickguide.org">www.1clickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>