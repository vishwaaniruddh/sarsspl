<?php 
session_start();

include('../header.php'); 

?>
	
	
	<style>
	    .image{
	        width:100px;
	        height:150px;
	    }
	</style>
		<div class="row">
				
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                        
<? $sql = mysqli_query($con,"SELECT * from total_promotions where status=1");  

$i=1;

while($sql_result = mysqli_fetch_assoc($sql)){ ?>

                    <tr>
                        <td><? echo $i;?></td>
                        <td><? echo get_promotion($sql_result['promotion']); ?></td>
                        <td><? echo get_language($sql_result['language']);?></td>
                        <td><img class="image" src="<? echo $sql_result['image'];?>"></td>
                        <td><a href="delete_images.php?id=<?=$sql_result['id']?>" class="btn btn-danger">Delete</a></td>
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
