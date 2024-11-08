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
  <h1>Add  Banner</h1></div>

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
	 <a href="viewBanners.php"> <input name="button"  type='button'  value="<< Back" style="background-color:green"/></a>
	<div id="content-table-inner">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
	
		<!--  end step-holder -->
	
		<!-- start id-form -->
		<?php $qry="select * from main_cat where under!=0";
               $result=mysql_query($qry);  ?>

<form action='processAddBanner.php' enctype='multipart/form-data' method='post' >
<table width="481" id="id-form"><tr>
   
    
<td width="109"><?php /*if($pos=="ltop"){
	echo "Left Top";
	
} else if($pos=="rtop"){
	echo "Right Top";
	
}else if($pos=="lbottom"){  
echo "Bottom Left";
}
else if($pos=="rbottom"){
	 echo "Bottom Right";
} else {
	echo "Center"; }*/
	?></td><td width="221">
<input type="number" name="pos" id="pos" value="1">
<!--Select Category :<select name='cid' id='cid' style="height:31px;width:198px;font-size:14px">
<option value="">select</option>
         <?php
           while($row = mysql_fetch_row($result))
		{
             			  ?>
     <option value="<?php echo $row[0]; ?>" <?php if(isset($_GET['catid']) && $_GET['catid']==$row[0]) echo "Selected"; ?> ><?php echo $row[1]; ?></option>
                <?php } 
				?></select>-->
<br/><br/>
<input type='file' name='banner' size='40' /></td></tr>
<!--<tr><td>Total Count</td><td><input type='text' name='count' />   -->              <tr><td height="48" colspan="2"> <!--<input type="text" name='pid' value="<?php echo $pos; ?>" /> --><input name="Submit" id="Submit" type='submit' class="form-submit"/>
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
	<!--  start footer-left -
	<div id="footer-left">
	Admin Skin &copy; Copyright 1Click Guide. <a href="1clickguide.org">www.1clickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>