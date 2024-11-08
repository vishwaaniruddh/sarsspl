<?php 
session_start();

include('header.php'); 

function get_promotion($id){
    global $con;
    
    $sql = mysqli_query($con,"select * from promotions where id ='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['promotions'];
}


function get_language($id){
    global $con;
    
    $sql = mysqli_query($con,"select * from language where id ='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['language'];
}



?>
	
	
	<style>
	    .image{
	        width:100px;
	        height:150px;
	    }
	</style>
		<div class="row">
			<div class="col-md-3">
				
				<ul>
					<li><a href="index1.php">Add Promotions</a></li>
					<li><a href="https://allmart.world/franchise/admin/logout.php">logout</a></li>

					
				</ul>
			</div>
			
			<br>
			<div class="col-md-9">
				
				<form action="index_process1.php" method="POST" enctype="multipart/form-data" >
				    
					<select class="form-control" name="promotion" id="" required>
						<option value="">Select Promotion</option>
						<?php 
						$promo_sql = mysqli_query($con,"select * from promotions where type='2' AND status=1");

						while($promo_sql_result = mysqli_fetch_assoc($promo_sql)){

							$promotion_name = $promo_sql_result['promotions'];
							$promotion_id = $promo_sql_result['id'];
							?>

								<option value="<? echo $promotion_id?>">
									<? echo $promotion_name; ?>
								</option>
						<? }
						?>
					</select>
<br>


					<input type="hidden" class="form-control" name="language" id="" required value="1"  >
					
				
<br>

					<input type="file" name="image" id="image" onchange="preview_images();" required>
					<div class="row" id="image_preview"></div>
					<br>

					<input type="submit" name="submit" class="btn btn-danger">
				</form>
				
				
				
			<br>
			<br>	
				    <section>
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Promotion Name</th>
                                            <th>Language </th>
                                            <th>Image</th>
                                            
                                        </tr>
                                    </thead>
                                <tbody>
                                        
<? 
$getpromo=mysqli_query($con,"SELECT * FROM `promotions` where type='2' AND status='1'");
$proids = array();
		foreach ($getpromo as $key => $promo) {
        
        
         array_push($proids, $promo['id']);
        }
        $List = implode(', ', $proids);
        
$sql = mysqli_query($con,"SELECT * from total_promotions where status=1 AND promotion IN ($List) ORDER BY `total_promotions`.`id` ASC");  

$i=1;

while($sql_result = mysqli_fetch_assoc($sql)){ ?>

                    <tr>
                        <td><? echo $i;?></td>
                        <td><? echo get_promotion($sql_result['promotion']); ?></td>
                        <td><? echo get_language($sql_result['language']);?></td>
                        <td><img class="image" src="<? echo $sql_result['image'];?>"></td>
                     
                    </tr>
    <? $i++; } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
				
			</div>	
		</div>

<?php include('footer.php'); ?>
