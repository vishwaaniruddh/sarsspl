<?php
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}
?>
<style>
.btn {
  display: inline-block;
  padding: 15px 25px;
  font-size: 12px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.btn:hover {background-color: #3e8e41}

.btn:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


</style>
<?php 
include('header.php');
include('config.php');
$banner=$_GET['cmp'];
//$pos=$_GET['pos'];
//$sql=mysql_query("select * from banners where id='$banner'");
 $qry=mysqli_query($con3,"select * from oc_pavosliderlayers where id='".$banner."'");
// echo "select * from oc_pavosliderlayers where id='".$banner."'";
$row1=mysqli_fetch_array($qry);
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
		<?php $qry="select * from main_cat where under!=0";
               $result=mysql_query($qry);
               $qry2="select * from main_cat where under!=0 and id='".$row1[5]."'";
              // echo "select * from main_cat where under!=0 and id='".$row1[5]."'";
               $result1=mysql_query($qry2);
               $res=mysql_fetch_array($result1);
               ?>


<form action='processEditBanner.php' enctype='multipart/form-data' method='post' >
<table width="100%" id="id-form">
    <tr><td width="93"></td><td>
	Position <input type='number' name='pos' value="<?php echo $row1["position"]; ?>" />
	</td>
	</tr>
    <tr>
<td width="93"><?php /*if($pos=="ltop"){
	echo "Left Top";
	
} else if($pos=="rtop"){
	echo "Right Top";
	
}else if($pos=="lbottom"){  
echo "Bottom Left";
}
else if($pos=="rbottom"){
	 echo "Bottom Right";
} else {
	echo "Center"; }*/?></td>

	<td width="800">
<img src="<?php echo $ocimagepath.$row1["image"]; ?>" width="200" height="100" /><input type='hidden' name="oldimg" value="<?php echo $row1["image"]; ?>" />
<input type='file' name='image' /></td></tr>
                     <tr><td width="93"></td><td height="48" colspan="2">   <input type='hidden' name='id' value="<?php echo $banner; ?>" />
                    
                     <button type="submit" name="Submit" class="btn">Submit</button>
                    <button type="button" class="btn" onclick="window.open('viewBanners.php','_self')">Back</button>
                   
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
	<!--  start footer-left 
	<div id="footer-left">
	Admin Skin &copy; Copyright 1Click Guide. <a href="1clickguide.org">www.1clickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>