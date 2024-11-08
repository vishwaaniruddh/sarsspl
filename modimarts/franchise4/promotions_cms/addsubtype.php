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
					<li><a href="add_promo.php">Add Promotions</a></li>
					<li><a href="add_language.php">Add language</a></li>
					<li><a href="index.php">Promotions</a></li>
					<li><a href="ViewPromotions.php">View Promotions</a></li>
					<li><a href="addsubtype.php">Add Sub-Type</a></li>
				</ul>
			</div>
			
			<div class="col-md-9">
				
				<form action="addsubtype_process.php" method="POST" enctype="multipart/form-data" >
				    
					<select class="form-control" name="type" id="" required>
						<option value="">Select Promotion</option>
				    	<option value="2">Greetings</option>
					</select>
<br>
<lable>Enter Sub Type</lable>
<input type="text" class="form-control" name="subtype" >

					
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
		
		<script>
		    function Checkdelete()
		    {
		        return confirm("Are you Sure,Delete this");
		    }
		</script>

<?php include('footer.php'); ?>
