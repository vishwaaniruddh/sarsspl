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
             $qry="select * from main_category";
               $result=mysql_query($qry);  

?>

<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Add Popular Search</h1></div>


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
<form action='processSearch.php' method='post'>
<table border="0" width="45%" id="id-form">

<tbody>

<tr height='30'>

<td align='left' width='26%'>Category Name :</td>
   <td width='74%'><select name='cid' id='cid'>
         <?php
           while($row = mysql_fetch_row($result))
		{
             			  ?>
     <option value="<?php echo $row[3]; ?>"><?php echo $row[1]; ?></option>
                <?php } 
				?>
                </select></td></tr>

<tr height='30'>

<td align='left'>Status :</td>

<td>
  <select name="status" id="status">
  <option value="0">Select</option>
  <option value="Yes">Yes</option>
  <option value="No">No</option>
  </select></td></tr>

<tr>

<td colspan='2' align='center'><input value='Create' class="form-submit"  type='submit' /></td></tr>

 </tbody></table></form>
 
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
 