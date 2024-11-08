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
include('header.php');
include('config.php');

$cmp=$_GET['cmp'];

		
			  $qry1="select * from main_cat where id='$cmp'";

			  $res1=mysql_query($qry1);
			  $row1=mysql_fetch_row($res1);                


               $qry2="select * from main_cat where id=$row1[2]";
               $result2=mysql_query($qry2);  
			   $row2=mysql_fetch_row($result2);

//echo $qry2;   
			   
           /*  $qry="select * from main_cat";
               $result=mysql_query($qry);  */

?>

<!-- start content-outer -->
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
  
}

.btn:hover {background-color: #3e8e41}

.btn:active {
  background-color: #3e8e41;
  
}
</style>
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Edit Sub-Category</h1></div>


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
<form action='processEditCat.php' method='post'>
<table align="center" border="0" width="50%" id="id-form">

<tbody>

<tr height='30'>

<td align='center' width='30%'>Select Category</td>
   <td width='100%'><select name='cid' id='cid' style="height:31px;width:198px;font-size:14px">
       
<option > select.. </option>
<option value="<?php echo $row2[0]; ?>" selected><?php echo $row2[1]; ?></option>
     
         <?php
           while($row = mysql_fetch_row($result))
		{
             			  ?>
     <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                <?php } 
				?></select></td></tr>

<tr height='30'>

<td align='center'>Category Name</td>

<td><input name='cname' id='cname' size='50' type='text' value="<?php echo $row1[1]; ?>" class="inp-form" required/></td></tr>

<tr height='30' style="display:none">

<td align='center'>Keywords</td>

<td><input name='add1' id='add1' size='50' type='text' class="inp-form"  value="<?php echo $row1[2]; ?>"/></td></tr>

<tr>

<td colspan='2' align='center'>

<input value="<?php echo $cmp; ?>" name="sn"  type="hidden" /><input value='Save' class="btn"  type='submit' />
<button type="button" class="btn" onclick="window.open('sub_cat.php','_self');">Back</button></td></tr>
</td></tr>

 </tbody></table></form>

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
	<!--  start footer-left -
	<div id="footer-left">
	Admin Skin &copy; Copyright 1clickGuide. <a href="">www.1ClickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 