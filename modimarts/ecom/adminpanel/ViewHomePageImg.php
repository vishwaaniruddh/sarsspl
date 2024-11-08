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
    $pos=$_GET['pos'];

              $qry="select * from HomePageImage where id='$pos'";

              $res=mysql_query($qry);                

              $num=mysql_num_rows($res);
 
 ?>
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Images</h1></div>

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
		
			<!--  start table-content  -->
			<div id="table-content">
				  <!--  start message-green -->
				<div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left"  height="40px;" valign="middle"> <a href="AddHomePageImage.php?pos=<?php echo $pos; ?>">Add new one Image.</a></td>
					
				</tr>
				</table>
				</div>
				<!--  end message-green -->

	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
	
		<!--  end step-holder -->
	
		<!-- start id-form -->
		

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Sr No</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Image File</p>	</th>
				
						<!--  	<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Balance</p>	</th>-->
					
					<th class="table-header-options line-left"><p style="font-size:16px; color:#FFF;">Options</p></th>
                    </tr>
                    <?php
					for ($i=0; $i<$num; $i++) 

                {

                 $cname = mysql_result($res,$i,"name"); 

                 $ccode = mysql_result($res,$i,"count"); 

                 $sn = mysql_result($res,$i,"sn"); 
?>
                    <tr class="alternate-row">
<td><?php echo $sn; ?></td>
<td><img src="../<?php echo $cname; ?>" style="height:100px;width:100px"</td>
<!--<td><?php echo $ccode; ?></td>-->
<td><a href="EditHomePageImg.php?cmp=<?php echo $sn; ?>&pos=<?php echo $pos; ?>" title="Edit" class="icon-1 info-tooltip"></a><a href="DeleteHomePageImage.php?cmp=<?php echo $sn; ?>&pos=<?php echo $pos; ?>" title="Delete" class="icon-2 info-tooltip"></a></td></tr>       
<?php } ?>
</table>
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