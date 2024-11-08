<?php
session_start();
include('config.php');
include('adminaccess.php');
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Panel</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->   
<!-- <script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> -->

<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap.min.css">
		  <script type="text/javascript">
		if (typeof jQuery == 'undefined') {
		    var script = document.createElement('script');
		    script.type = "text/javascript";
		    script.src = "http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js";
		    document.getElementsByTagName('head')[0].appendChild(script);
		}
		</script>


<script type="text/javascript">
    $(function(){
    	$('input').checkBox();
    	$('#toggle-all').click(function() {
     	    $('#toggle-all').toggleClass('toggle-checked');
    	    $('#mainform input[type=checkbox]').checkBox('toggle');
    	    return false;
    	});
    });
</script>     

<![if !IE 7]>  

<!--  styled select box script version 1 -->
<script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script>

<![endif]>

<!--  styled select box script version 2 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
	$('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
});
</script>

<!--  styled select box script version 3 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
});
</script>

<!--  styled file upload script --> 
<script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
    $(function() {
      $("input.file_1").filestyle({ 
          image: "images/forms/choose-file.gif",
          imageheight : 21,
          imagewidth : 78,
          width : 310
        });
    });
</script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
function delfun(id,remid)
{
    try
    {
        var reas="";
        var remcheck=0;
        <?php if($_SESSION['designation']!="0")
        {
            ?>
        reas=document.getElementById(remid).value;
        if(reas.trim()=="")
        {
            remcheck=1;
        }
        <?php } ?>
        
        if(remcheck==0)
        {
        
        var confirmv=confirm("Are you sure to delete");
        if(confirmv)
        {
            $.ajax({
                type: "POST",
                url: "deleteCustomer.php",
                data:'cmp='+ id + '&reas='+ reas,

                success: function(msg){
                    //alert(msg);
                    if(msg==1)
                    {
                        alert("Delete successfull");
                    }else
                    {
                        alert("Error");
                    }
                    window.location.reload();
                }
             });
            }
        }   else
        {
            alert("Enter Reason for deletion");
            document.getElementById(remid).focus();
        }
    }catch(exc)
    {
        alert(exc);
    }
}
</script> 
<!--  date picker script -->
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
    function shfunc(divid,stats)
    {
        try
        {
            // alert(divid);
            if(stats=="1")
            {
                document.getElementById(divid).style.display="block"; 
            }else
            {
                document.getElementById(divid).style.display="none";   
            }
        }catch(exc)
        {
            alert(exc);
        }
    }
</script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body> 

<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!------------------------------  start nav-outer-repeat....... START ------------------------->
<?php include('header.php');?>
<!-------------------------------- start nav-outer-repeat.... END ----------------------------->
<div class="clear"></div>
<div id="content-outer">
<!-- start content -->
<div id="content">
	<?php 
	$view = "(select p.* from (select pm.product_model,pm.id,pm.offer_price,pm.allmart_commission,pm.category_id,pm.status,pd.code,pd.price,pd.total_amt,pd.name,pd.photo,pd.ccode from product_model as pm join electronics as pd on pm.id=pd.name   ) as p group by p.id) 

UNION 

(select p.* from (select pm.product_model,pm.id,pm.offer_price,pm.allmart_commission,pm.category_id,pm.status,pd.code,pd.price,pd.total_amt,pd.name,pd.photo,pd.ccode from product_model as pm join fashion as pd on pm.id=pd.name ) as p group by p.id)
UNION


(select p.* from (select pm.product_model,pm.id,pm.offer_price,pm.allmart_commission,pm.category_id,pm.status,pd.code,pd.price,pd.total_amt,pd.name,pd.photo,pd.ccode from product_model as pm join grocery as pd on pm.id=pd.name ) as p group by p.id)

UNION

(select p.* from (select pm.product_model,pm.id,pm.offer_price,pm.allmart_commission,pm.category_id,pm.status,pd.code,pd.price,pd.total_amt,pd.name,pd.photo,pd.ccode from product_model as pm join services as pd on pm.id=pd.name ) as p group by p.id)


UNION
(select p.* from (select pm.product_model,pm.id,pm.offer_price,pm.allmart_commission,pm.category_id,pm.status,pd.code,pd.price,pd.total_amt,pd.name,pd.photo,pd.ccode from product_model as pm join Resale as pd on pm.id=pd.name ) as p group by p.id)


UNION

(select p.* from (select pm.product_model,pm.id,pm.offer_price,pm.allmart_commission,pm.category_id,pm.status,pd.code,pd.price,pd.total_amt,pd.name,pd.photo,pd.ccode from product_model as pm join products as pd on pm.id=pd.name ) as p group by p.id)";

$view=mysqli_query($con1,$view);
?>
<div class="row">
	<div class="col-md-12">

		 <table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
				<th>S.no</th>
				<th>img</th>
				<th>Product Name</th>
				<th>Product Status</th>
				<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$s=1;
while($view_result = mysqli_fetch_assoc($view)){ 

	$pid=$view_result['code'];
	$pcat=$view_result['category_id'];
	$prodid=$view_result['name'];
	$ccode=$view_result['ccode'];
	$proimg=Getimg($pid,$pcat);
	$proName=$view_result["product_model"];
	$status=$view_result["status"];
	?>
	<tr>
		<td><?=$s?></td>
	<td><img src="<?=$proimg?>" alt="<?=$proName?>" width="50" height="50"></td>
	<td><?=$proName?></td>
	<td>
		<?php 
		if ($status) {
			?>
			<button class="btn btn-success btn-sm" style="background: green;">Active</button>
			<?php
		}
		else
		{
		 ?>
			<button class="btn btn-danger btn-sm">Disactive</button>
			<?php
		}
		?>
	</td>
	<td><a class="btn btn-danger" href="/adminpanel/Editproduct.php?pcode=<?=$pid?>&cat=<?=$pcat?>&ccode=<?=$ccode?>&prodid=<?=$prodid?>">Action</a></td>
		
	</tr>
	
     <?php
     $s++;
    }

	 ?>
		
				
			</tbody>
		</table>
	</div>
</div>

	</div>
</div>

<?php 
	function Getimg($pid,$cid)
	{
	     global $con1;
	   
		$qrya           = "SELECT * FROM `main_cat` WHERE `id`='$cid'";
		$resulta        = mysqli_query($con1, $qrya);
		$rowa           = mysqli_fetch_row($resulta);
    	$aa             = $rowa[2];
    	
    	

		
		if ($cid == 80)
			{
				$maincatid      = 5;
				$sql            = "select * from  `garment_product` where product_for='" . $maincatid . "' and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)";
			}
		else
			{
				if ($aa != 0)
					{
						$qrya1          = "select * from main_cat where id='" . $aa . "'";
						$resulta1       = mysqli_query($con1, $qrya1);
						$rowa1          = mysqli_fetch_row($resulta1);
						$Maincate       = $rowa1[4];
					}
				
			}
		
		if ($Maincate == 1)
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `fashion_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
			}
		else if ($Maincate == 190)
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$pid' order by id asc  limit 0,1");
				//  $imgrow=mysqli_fetch_row($sqlimg23mn);
				//  echo "SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$prod_id' order by id asc  limit 0,1";
				
			}
		else if ($Maincate == 218)
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `grocery_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
			}
		else if ($Maincate == 760)
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `kits_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
			}
		else if ($Maincate == 657)
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `service_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
			}
		else if ($Maincate == 767)
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `promotion_product_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
			}
		else
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
			}
		$frtu           = mysqli_fetch_array($sqlimg23mn);
		
		
				
				
						$pro_img        = '/ecom/' . $frtu[1];
					
			
			return $pro_img;
	}

 ?>

 <script>
 $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                        extend: 'excelHtml5',
                        title: 'Orders Excel',
                        text:'Export to excel'
                        //Columns to export
                        //exportOptions: {
                       //     columns: [0, 1, 2, 3,4,5,6]
                       // }
                    },'pageLength'
        ]
    } );
} );
</script>

<!-- end footer -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

</body>

<!-- end footer -->



</html>