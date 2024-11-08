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
$cmp=$_GET['cmp'];

		//echo $cmp;

			  $qry="select * from users where id='$cmp'";

			  $res=mysql_query($qry);                

 
 ?>
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Edit User</h1></div>

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
		
		<form action="processEditUser.php" method="post">

<table width="448" border="0" cellpadding="0" cellspacing="0"  id="id-form"> 	

<tbody>

<tr height="30">

<td width="30%" height="42" align="center">Username</td>

<td width="70%"><input name="id" class="inp-form" type="text" value="<?php echo mysql_result($res,0,'id'); ?>" readonly="readonly" /></td></tr>

<tr height="30">

<td height="39" align="center">Password</td>

<td><input name="pass" class="inp-form" type="text" value="<?php echo mysql_result($res,0,'password'); ?>" /></td></tr>

<tr height="30">

<td height="32" align="center">Department</td>

<td><select name="dept" class="styledselect_form_1"><option value="<?php echo mysql_result($res,0,'department'); ?>" ><?php echo mysql_result($res,0,'department'); ?></option>

                                              <option value='admin'>admin</option>

                                              <option value='users'>users</option>

                                              </select></td></tr>


<td colspan="2" align="center"><input value="Create"  class="form-submit" type="submit" /></td></tr></tbody></table></form>
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
	<!--  start footer-left -
	<div id="footer-left">
	Admin Skin &copy; Copyright 1Click Guide. <a href="1clickguide.org">www.1clickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>