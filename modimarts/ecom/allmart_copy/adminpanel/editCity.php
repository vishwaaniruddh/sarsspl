<?php
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}
?>
<?php
include('config.php');
                                   $cmp=$_GET['cmp'];
		//echo $cmp;
			  $qry="select * from cities where code='$cmp'";
			  $res=mysql_query($qry);                
                   //       $num=mysql_num_rows($res);
	
?>
<?php include('header.php'); ?>
<!-- start content-outer -->

<style>
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 8px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
     border-radius: 8px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>

<script>
function cancel()
{
window.open("cities.php","_SELF");
}
</script>
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Add City</h1></div>


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

<form action="processEditCity.php" method="post">
<table width="50%" align="center" border="0">
<tbody>
<tr height="30">
<td width="30%" height="45" align="center">City Code</td>
<td width="70%"><input name="code" size="50" type="text" value="<?php echo mysql_result($res,0,'code'); ?>"  class="inp-form"  readonly="readonly" /></td></tr>
<tr height="30">
<td height="45" align="center">City Name</td>
<td><input name="cname" size="50" type="text" value="<?php echo mysql_result($res,0,'name'); ?>" class="inp-form"  required/></td></tr>
<tr height="30">
<td height="41" align="center">Keywords</td>
<td><input name="add1" size="50" type="text" value="<?php echo mysql_result($res,0,'keywords'); ?>"  class="inp-form" required/></td></tr>

<tr>
<td  align="center"><button class="button" type="submit" />Save</td>
<td><button class="button" onclick="cancel()"; type="button">Back</button></td>
</tr></tbody></table></form>
<!-- end id-form  -->

	</td>
	<td>

	<!--  start related-activities --><!-- end related-activities -->

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
 