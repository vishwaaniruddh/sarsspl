<?php 
session_start();

include('header.php');
$id=$_GET['id'];

$getsql = mysqli_query($con,"SELECT * from promotion_sub_type where id =$id AND status=1");
$getresult=mysqli_fetch_assoc($getsql);



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
					<li><a href="addsubtype.php">Add Sub-Type</a></li>
				</ul>
			</div>
			
			<div class="col-md-9">
				
				<form action="editsubtype_process.php" method="POST" enctype="multipart/form-data" >
				      <lable>Select Type</lable>
					<select class="form-control" name="type" required>
				    	<option value="2" <?php if($getresult['type_id']==2){ echo "selected";} ?>>Greetings</option>
					</select>
                        <br>
                        <lable>Enter Sub Type</lable>
                        <input type="text" class="form-control" value="<?=$getresult['name']?>" name="subtype" required>
                        <input type="hidden" class="form-control" value="<?=$getresult['id']?>" name="id" required>
                        <br>
                         
					<select class="form-control" name="status" required>
				    	<option value="0" <?php if($getresult['status']==0){ echo "selected";} ?>>Desactive</option>
				    	<option value="1" <?php if($getresult['status']==1){ echo "selected";} ?>>Active</option>
					</select>
                        <br>
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
                                            <th>Sub Type</th>
                                            <th>Type</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                        
<? $sql = mysqli_query($con,"SELECT * from promotion_sub_type where status=1");  

$i=1;

while($sql_result = mysqli_fetch_assoc($sql)){ ?>

                    <tr>
                        <td><? echo $i;?></td>
                        <td><?=$sql_result['name']?></td>
                        <td><?php if($sql_result['type_id']==2){ echo"Greetings";}else{ echo "advertisement";} ?></td>
                        <td><a class="btn btn-danger" style="margin-right:5px;" href="deleteedit.php?id=<?=$sql_result['id']?>" onclick="return Checkdelete()">Delete</a><a class="btn btn-info" href="editsubtype.php?id=<?=$sql_result['id']?>">Edit</a></td>
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
