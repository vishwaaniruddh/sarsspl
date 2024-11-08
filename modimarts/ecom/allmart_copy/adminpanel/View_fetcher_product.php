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
    $pos=$_GET['pos'];

      
      
              $qrys="select * from oc_pavosliderlayers where group_id='19' order by position";

              $ress=mysqli_query($con3,$qrys);                

echo mysqli_error($con3);
              $num=mysqli_num_rows($ress);
 
 ?>
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
	
		<!--  end step-holder -->
	
		<!-- start id-form -->
		

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Sr No</p>	</th>
                    <!--<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Banner image</p>	</th>-->
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Banner File</p>	</th>
					
					<!--<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Balance</p>	</th>-->
					
					<th class="table-header-options line-left"><p style="font-size:16px; color:#FFF;">Options 
</p></th>
                    </tr>
                    <?php
					//for ($i=0; $i<$num; $i++) 
					$irn=1;
while($rwf=mysqli_fetch_array($ress))
                {

                 $cname =$rwf["title"]; 

                 //$ccode = mysql_result($res,$i,"count"); 

                 $id= $rwf["id"]; 
$active=$rwf["status"]; 
?>
                    <tr class="alternate-row">
<td><?php echo $irn; ?></td>
<td>
    <img src="<?php echo $ocimagepath.$rwf["image"]; ?>" width="200px" height="100px" /></td>
<!--<td><?php echo $cname; ?></td>-->
<!--<td><?php echo $ccode; ?></td>-->
<td><a href="editBanner.php?cmp=<?php echo $id; ?>" title="Edit" class="icon-1 info-tooltip"></a><a href="deleteBanners.php?cmp=<?php echo $id; ?>" title="Delete" class="icon-2 info-tooltip"></a><input type="checkbox" id="active<?php echo $id; ?>"  name="active" onclick="bannerfunc('<?php echo $id; ?>',this.id)" <?php if($active==1){ echo "checked"; }?> >Active

</td>
</tr>       
<?php 
$irn++;
} ?>
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
	<!--  start footer-left 
	<div id="footer-left">
	Admin Skin &copy; Copyright 1Click Guide. <a href="1clickguide.org">www.1clickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>