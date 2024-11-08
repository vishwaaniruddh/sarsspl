<?php
session_start();
include("config.php");
/*var_dump($_SESSION);*/
if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){
    header("location:index.php");
}

$qry = mysqli_query($con1,"Select r.reason,r.name as pname,r.status as pstatus,r.code,r.description,r.brand,r.category,r.price,r.sold,	rc.name as cname,rc.status from Resale r join resale_category rc on r.category=rc.id where r.ccode='".$_SESSION['gid']."'");
//echo "Select r.name as pname,r.status as pstatus,r.code,r.description,r.brand,r.category,r.price,	rc.name as cname,rc.status from Resale r join resale_category rc on r.category=rc.id where r.ccode=".$_SESSION['gid']."'";
//$s=mysqli_fetch_row($qry);
//var_dump($s);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">  
		<link rel="stylesheet" href="css/datatables.css">
	</head>
    <body>
		<div id="wrap">
			<div class="container" style="max-width: 84% !important;"> 
            <h3>Resale Products</h3>
				<table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
					<thead>
						<tr>
							<th>Sr. No</th>
							<th>Category</th>
							<th>Brand</th>
							<th>Product</th>
							<th>Price</th>
							<th>Images</th>
							<!--<th>Specifications</th>-->
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					    <?php 
					    $cnt = 1;
					    
					        while($data=mysqli_fetch_array($qry)){
					            /*var_dump($data);*/
					    ?>
						<tr class="gradeX">
							<td><?php echo $cnt;?></td>
							<td><?php echo $data['cname'];?>	</td>
							<td><?php echo $data['brand'];?></td>
							<td><?php echo $data['pname'];?></td>
							<td class="center"><?php echo $data['price'];?></td>
							<td class="center"><?php echo $data['photo'];?></td>
							<!--<td>View Specifications</td>-->
							<?php if($data['pstatus']==1){ ?>
							<td>Approved</td>
							<?php }else if($data['pstatus']==0){?>
							<td>Pending</td>
							<?php }else if($data['pstatus']==2){?>
							<td>Rejected</td>
							<?php } ?>
							<td>
							    <?php if($data['sold']==0) { ?>
							        <a href="edit_resale_product.php?id=<?php echo $data['code'];?>"><i class="fas fa-user-edit"></i>Edit</a>
							      <?php } else  { ?>
							      <a href="#"><i class="fa fa-eye"></i></a>
							      <a href="view_resale_product_details.php?prid=<?php echo $data['code'];?>&catid=<?php echo $data['category']; ?>"><i class="fas fa-user-edit"></i>View Details</a>
							    <?php } ?>
							    <?php if ($data['pstatus']==2) { ?>
							        <a href="#" data-toggle="popover" data-trigger="focus" title="Rejection Reason" data-placement="top" data-content="<?php if($data['Reason']==''){echo 'N';}else{echo $data['Reason'];} ?>">Rejection Reason</a>
							        
							    <?php } else if($data['pstatus']==1){?>
							    <label class="checkbox-inline">
                                  <input type="checkbox" value="" <?php if($data['sold']==1){ echo 'checked' ; echo '   id="sold"'; }?>>Sold
                                </label>
                                <?php } ?>
							</td>
						</tr>
						<?php $cnt++; } ?>
					</tbody>
					<!--<tfoot>
						<tr>
							<th>Rendering engine</th>
							<th>Browser</th>
							<th>Platform(s)</th>
							<th>Engine version</th>
							<th>CSS grade</th>
						</tr>
					</tfoot>-->
				</table>
			</div>
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.min.js"></script>
		<script src="js/datatables/datatables.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$('.datatable').dataTable({
				"sPaginationType": "bs_four_button"
			});	
			$('.datatable').each(function(){
				var datatable = $(this);
				// SEARCH - Add the placeholder for Search and Turn this into in-line form control
				var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
				search_input.attr('placeholder', 'Search');
				search_input.addClass('form-control input-sm');
				// LENGTH - Inline-Form control
				var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
				length_sel.addClass('form-control input-sm');
			});
		});
		</script>
		<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();   
});
</script>
<!--Ruchi -->
<script>
  document.getElementById("sold").disabled = true;
</script>
</body>
</html>