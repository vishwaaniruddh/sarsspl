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
$banner=$_GET['cmp'];
$pos=$_GET['pos'];
$sql=mysql_query("select * from HomePageImage where sn='$banner'");
$row=mysql_fetch_row($sql);
 ?>
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Edit Banner</h1></div>

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
		

<form action='process_editimg.php' enctype='multipart/form-data' method='post' >
<table width="571" id="id-form"><tr>
<td width="93">><?php if($pos=="ltop"){
	echo "Left Top";
	
} else if($pos=="rtop"){
	echo "Right Top";
	
}else if($pos=="lbottom"){  
echo "Bottom Left";
}
else if($pos=="rbottom"){
	 echo "Bottom Right";
} else {
	echo "Center"; }?></td><td width="466">
<img src="../<?php echo $row[1]; ?>" width="179" height="175" /><input type='hidden' name="oldimg" value="<?php echo $row[1]; ?>" />
<input type='file' name='image' /></td></tr>
                     <tr><td height="48" colspan="2">   <input type='hidden' name='sn' value="<?php echo $banner; ?>" />
                     <input type='hidden' name='pos' value="<?php echo $pos; ?>" /><input name="Submit" id="Submit" type='submit' class="form-submit"/>
                  </td></tr></table></form>	<!-- end id-form  -->

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