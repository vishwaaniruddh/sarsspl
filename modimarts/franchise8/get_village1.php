<?php include('config.php');		
	$keyword = strval($_POST['query']);

	$search_param = "{$keyword}%";
	

	$sql = mysqli_query($con,"SELECT * FROM new_village WHERE village LIKE '".$search_param."'");
		while($row = mysqli_fetch_assoc($sql)) {
		$countryResult[] = $row["village"];
		}
		echo json_encode($countryResult);
?>

