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

		

			  $qry1="select * from areas where code='$cmp'";

			  $res11=mysql_query($qry1);                
$res1=mysql_fetch_array($res11);
		

			  $qry="select code,name from cities";

			  $res=mysql_query($qry);                

                          $num=mysql_num_rows($res);

	$cty="select code,name from cities where code='".$res1['city']."'";
	//echo $cty;
			  $ctyqry=mysql_query($cty);                
                          $ctynr=mysql_fetch_array($ctyqry);
	

?>

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
window.open("location.php","_SELF");
}
</script>
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Edit Area</h1></div>


<table border="0" width="100%" cellpadding="0" cellspacing="0" id="">
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
<form action="processEditArea.php" method="post" >

<table width="50%" align="center" border="0" id="id-form" >

<tr height="30" ><td width="30%" height="37" align="center" >City Name</td><td width="70%" ><select name="ccode" class="styledselect_form_1"><option value="<?php echo $ctynr[0]; ?>" ><?php echo $ctynr[1]; ?></option>

<?php 

                       		  for ($i=0; $i<$num; $i++) 

				{
$cname1 = mysql_result($res,$i,"name");
		     		$ccode = mysql_result($res,$i,"code"); ?>

			

			<option value="<?php echo $ccode; ?>"><?php echo $cname1; ?></option>

			

			  <?php } ?>

</select></td></tr>

<tr height="30" ><td width="30%" height="36" align="center" >Area Code</td><td width="70%" ><input type="text" class="inp-form" name="code" size="50" value="<?php echo $res1['code']; ?>" readonly="readonly" /></td></tr>

<tr height="30" ><td height="39" align="center" >Area Name</td><td><input type="text" class="inp-form"  name="cname" size="50" value="<?php echo $res1['name']; ?>" required/></td></tr>

<tr height="30" ><td height="42" align="center" >Keywords</td><td><input type="text" class="inp-form" name="add1" size="50" value="<?php echo $res1['keywords']; ?>" required/></td></tr>


<tr><td align="center" ><input type="submit" value="Save" class="button" /></td>
<td><button class="button" onclick="cancel();" type="button" >Back</button></td>
</tr>

</table>

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
	<!--  start footer-left -
	<div id="footer-left">
	Admin Skin &copy; Copyright 1clickGuide. <a href="">www.1ClickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 