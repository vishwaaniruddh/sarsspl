<?php include('header.php'); ?>
	

<?php 

if(isset($_POST['language'])){

$language = $_POST['language'];
$date = date("Y-m-d");


$insert = "insert into language(language,created_at) values('".$language."','".$date."')";
		
		if(mysqli_query($con,$insert)){ ?>

				<script>
					alert('Added Successfully !');
				</script>

		 <? }
		 else{
		 	?>

				<script>
					alert('Added Error !');
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
				

				<form action="<? $_SERVER['PHP_SELF'] ; ?>" method="POST">
					
					<input type="text" name="language" placeholder="language Name">
					<input type="submit" name="submit" class="btn btn-danger">
				</form>


<div class="row">
	<ul>
		
	<?php

	$get_sql = mysqli_query($con,"select * from language");

	while($get_sql_result = mysqli_fetch_assoc($get_sql)){ ?>

		<li><? echo $get_sql_result['language'];?></li>

	<? }

	?>
	</ul>
</div>

			</div>	
		</div>



<?php include('footer.php'); ?>
