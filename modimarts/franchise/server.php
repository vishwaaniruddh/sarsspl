<?php include('config.php');		
	$keyword = strval($_POST['query']);

	$search_param = "{$keyword}%";
	

	$sql = mysqli_query($con,"SELECT * FROM new_state WHERE state LIKE '".$search_param."'");
		while($row = mysqli_fetch_assoc($sql)) {
		$countryResult[] = $row["state"];
		}
		echo json_encode($countryResult);
?>

