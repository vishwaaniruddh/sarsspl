<?php include('header.php'); 

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
					<li><a href="add_promo.php">Add Promotions</a></li>
					<li><a href="add_language.php">Add language</a></li>
					<li><a href="index.php">Promotions</a></li>
					<li><a href="ViewPromotions.php">View Promotions</a></li>
				</ul>
			</div>
			
			<div class="col-md-9">
				
				<form action="index_process.php" method="POST" enctype="multipart/form-data" >
				    
					<select class="form-control" name="promotion" id="" required>
						<option value="">Select Promotion</option>
						<?php 
						$promo_sql = mysqli_query($con,"select * from promotions where status=1");

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


					<select class="form-control" name="language" id="" required>
						<option value="">Select Language</option>
						<?php 
						$lang_sql = mysqli_query($con,"select * from language");

						while($lang_sql_result = mysqli_fetch_assoc($lang_sql)){

							$lang_name = $lang_sql_result['language'];
							$lang_id = $lang_sql_result['id'];
							?>

								<option value="<? echo $lang_id?>">
									<? echo $lang_name; ?>
								</option>
						<? }
						?>
					</select>
<br>

					<input type="file" name="image" id="image" onchange="preview_images();" required>
					<div class="row" id="image_preview"></div>
					<br>

					<input type="submit" name="submit" class="btn btn-danger">
				</form>
				
				<form action="insert.php"  method="POST" enctype="multipart/form-data">
				    
				    <input type="file" name="image1" id="image1" onchange="preview_images();" required>
					<div class="row" id="image_preview1"></div>
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
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                        
			<? $sql = mysqli_query($con,"SELECT * FROM `promotions`  ORDER BY `promotions`.`status` DESC");  

			$i=1;

			while($sql_result = mysqli_fetch_assoc($sql)){ ?>

                    <tr>
                        <td><? echo $i;?></td>
                        <td><?=$sql_result['promotions']?></td>
                        
                        <td>
                        	<?php 
                        	if ($sql_result['type']==1) {
                        	 	echo"<a class='btn btn-danger btn-sm'>Adver</a>";
                        	 }
                        	 if ($sql_result['type']==2) {
                        	 	echo"<a class='btn btn-success btn-sm'>Greeting</a>";
                        	 } ?>
                        	</td>
                        	<td>
                        	<?php 
                        	if ($sql_result['status']==0) {
                        	 	echo"<a class='btn btn-danger btn-sm'>disActive</a>";
                        	 }
                        	 if ($sql_result['status']==1) {
                        	 	echo"<a class='btn btn-success btn-sm'>Active</a>";
                        	 } ?>
                        	</td>
                        <td><a href="editPromotions.php?id=<?=$sql_result['id']?>" class="btn btn-info">Edit</a></td>
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
