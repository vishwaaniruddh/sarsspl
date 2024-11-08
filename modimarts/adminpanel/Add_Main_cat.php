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

              $qry='select max(cid) from main_category';

              $res=mysql_query($qry);                

              $row = mysql_fetch_row($res);
			  
		//$cid = mysql_result($res,0,'cid'); 
			  $cid1=$row[0]+1;

?>

<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Add Main Category</h1></div>


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
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="id-form">
	<tr valign="top">
	<td>
<form action='processmainCategory.php' method='post'>
<table align="center" border="0" width="50%" id="id-form">

  <tr height="30"><td width="30%" height="39" align="center">Category Code</td>
  <td width="70%"><input name="cid" size="50" type="text" value="<?php echo $cid1; ?>" class="inp-form" readonly="readonly"/></td>
  </tr>
  <tr height="30"><td height="39" align="center">Category Name</td>
  <td><input name="cname" size="50" type="text" class="inp-form"/></td></tr>
  <tr><td colspan="2" align="center"><input class="form-submit" type="submit" /></td></tr></table>

</form>

<div class="clear"></div>
 </td></tr></table>

</div>
<!--  end content-table-inner  -->
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
<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">
	Admin Skin &copy; Copyright 1clickGuide. <a href="">www.1ClickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 