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

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script><link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
  
  

                <meta name="description" content="My Store" />
                <link href="http://sarmicrosystems.in/oc1/" rel="canonical" />
                    	    	<link href="http://sarmicrosystems.in/oc1/image/catalog/cart.png" rel="icon" />
    	                <link href="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
            
                <link href="http://sarmicrosystems.in/oc1/catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                <link href="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
                <link href="http://sarmicrosystems.in/oc1/catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="http://sarmicrosystems.in/oc1/catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
                <link href="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />
                <link href="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/stylesheet/homebuilder.css" rel="stylesheet" />
                <link href="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/stylesheet/sliderlayer/css/typo.css" rel="stylesheet" />
                <link href="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
                        <script type="text/javascript" src="http://sarmicrosystems.in/oc1/catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
                <script type="text/javascript" src="http://sarmicrosystems.in/oc1/catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="http://sarmicrosystems.in/oc1/catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="http://sarmicrosystems.in/oc1/catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="http://sarmicrosystems.in/oc1/catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="http://sarmicrosystems.in/oc1/catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="http://sarmicrosystems.in/oc1/catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
                <script type="text/javascript" src="http://sarmicrosystems.in/oc1/catalog/view/javascript/layerslider/jquery.themepunch.plugins.min.js"></script>
                <script type="text/javascript" src="http://sarmicrosystems.in/oc1/catalog/view/javascript/layerslider/jquery.themepunch.revolution.min.js"></script>
        

<script>
function bannerfunc(id,tid)
{
	
//var Standardid= document.getElementById('dactiv').value;


//var radiobtn=$("input[type='radio'][name='group']:checked").val();
//alert("test");
/*
var bannerid=[];
		 var ids = document.getElementsByName('active[]');

    for ( var i = 0; i < ids.length; i++) {
        if (ids[i].checked == true) {

            bannerid.push(ids[i].value);
        }
    }
*/
//var id=document.getElementById('id').value;


//alert(id);

var status=0;
	
	
	if(document.getElementById(tid).checked)
{
	
	status="1";
}
//alert(status);
 var datap={id:id,status:status};
 var dataString = JSON.stringify(datap);


$.ajax({
             type: "POST",
             url: "banner_active.php",
		
   data:{dat:dataString},
            success: function(msg){
          
     // alert(msg);
if(msg==1)
{
alert(" Banner active successfully" );
//location.reload();
}
else if(msg==2)
{
alert(" Banner deactivated successfully" );
//location.reload();
}
else
{
alert("Error");
}

 window.location.reload();
             },
			 error: function (request, status, error) {
        alert(request.responseText);
    }
         });

}

</script>
<div id="page-heading">
  <h1>Slider Images</h1></div>

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
					<td class="green-left"  height="40px;" valign="middle"> <a href="addBanner.php?pos=<?php echo $pos; ?>">Add new Image.</a></td>
					
				</tr>
				</table>
				</div>
	
	
	<div class="layerslider-wrapper" style="max-width:1170px;">


			<?php //include('homepgslider.php')?>
 

			<!--
			##############################
			 - ACTIVATE THE BANNER HERE -
			##############################
			-->
			
			
			
			
			<script type="text/javascript">

				var tpj=jQuery;
				 

			

				if (tpj.fn.cssOriginal!=undefined)
					tpj.fn.css = tpj.fn.cssOriginal;

					tpj('#sliderlayer1360699920').revolution(
						{
							delay:9000,
							startheight:645,
							startwidth:1170,


							hideThumbs:50,

							thumbWidth:100,						
							thumbHeight:50,
							thumbAmount:5,

							navigationType:"bullet",				
							navigationArrows:"verticalcentered",				
														navigationStyle:"round",			 
							 					
							navOffsetHorizontal:0,
							navOffsetVertical:20, 	

							touchenabled:"on",			
							onHoverStop:"on",						
							shuffle:"off",	
							stopAtSlide:-1,						
							stopAfterLoops:-1,						

							hideCaptionAtLimit:0,				
							hideAllCaptionAtLilmit:0,				
							hideSliderAtLimit:0,			
							fullWidth:"off",
							shadow:0	 
							 				 


						});


function loadvid()
{
    
    
}
				

			</script>
					                   				
	
	
	
				<!--  end message-green -->

	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
	
		<!--  end step-holder -->
	
		<!-- start id-form -->
		

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Sr No</p>	</th>
                    <!--<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Banner image</p>	</th>-->
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Image</p>	</th>
					
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
<td><?php echo $irn; ?> </td>
<td>
    <img src="<?php echo trim($ocimagepath.$rwf["image"]); ?>" width="200px" height="100px" /></td>
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
<td><!--<img src="images/shared/blank.gif" width="695" height="1" alt="blank" />--></td>
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