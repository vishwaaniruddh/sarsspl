<?php
session_start();
 include('header.php'); ?>
	

<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// var_dump($_SESSION['username']);

if(isset($_POST['promotions'])){

$promotions = mysqli_real_escape_string($con,$_POST['promotions']);
$promotion_type = mysqli_real_escape_string($con,$_POST['promotion_type']);
$date =mysqli_real_escape_string($con,$_POST['created_at']) ;
$subtype =mysqli_real_escape_string($con,$_POST['subtype']) ;
$next_date =mysqli_real_escape_string($con,$_POST['next_date']) ;
$createdby=$_SESSION['username'];

$date=date('Y-m-d',strtotime($date));


$insert = "insert into promotions(promotions,type,status,created_at,created_by,subtype,next_date) values('".$promotions."','".$promotion_type."','1','".$date."','".$createdby."','".$subtype."','".$next_date."')";
		
		if(mysqli_query($con,$insert)){ ?>

				<script>
					alert('Added Successfully !');
					window.location.href='https://allmart.world/franchise/promotions_cms/add_promo.php';
				</script>

		 <? }
		 else{
		 	?>

				<script>
					alert('Added Error !');
					window.location.href='https://allmart.world/franchise/promotions_cms/add_promo.php';
				</script>

		 <?
		 }
		

}

?>

		<div class="row">
			<div class="col-md-3">
				
				<ul>
					<li><a href="add_promo.php">Add Promotions</a></li>
					<li><a href="add_language.php">Add Language</a></li>
					<li><a href="index.php">Promotions</a></li>
				</ul>
			</div>
			<div class="col-md-6">
				

				<form action="#" method="POST">
					<br/>
					<br/>
					<br/>	<lable>Promotions Name</lable>
					<br/>
					<input type="text" class="form-control" name="promotions" placeholder="Promotions Name">
					<br/>
					<lable>This Year Date</lable>
					<br/>
					<input type="date" class="form-control" name="created_at" placeholder="Date">
					<br/>
					<lable>Next Year Date</lable>
					<br/>
					<input type="date" class="form-control" name="next_date" placeholder="Date">
					<br/>
					<select class="form-control" name="promotion_type" id="" required>
						<option value="">Select Promotion Type</option>
						<option  value="1">Advertising</option>
						<option value="2">Greetings</option>
					</select> 
					<br/><br/>
					<select class="form-control" name="subtype" id="" required>
						<option value="">Select subtype</option>
						<?php 
						$promo_sql = mysqli_query($con,"select * from promotion_sub_type where status=1");

						while($promo_sql_result = mysqli_fetch_assoc($promo_sql)){

							$promotion_name = $promo_sql_result['name'];
							$promotion_id = $promo_sql_result['id'];
							?>

								<option value="<? echo $promotion_id?>">
									<? echo $promotion_name; ?>
								</option>
						<? }
						?>
					</select> 
					<br/>
					<input type="submit" name="submit" class="btn btn-danger">
				</form>


<div class="row">
	<ul>
		
	<?php

	$get_sql = mysqli_query($con,"select * from promotions");

	while($get_sql_result = mysqli_fetch_assoc($get_sql)){ ?>

		<li><? echo $get_sql_result['promotions'];?></li>

	<? }

	?>
	</ul>
</div>

			</div>	
		</div>



<?php include('footer.php'); ?>
