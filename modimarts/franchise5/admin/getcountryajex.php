<?php include('../config.php');		
	$keyword = strval($_POST['query']);

	$search_param = "{$keyword}%";
	

	$sql = mysqli_query($con,"SELECT * FROM new_country WHERE country LIKE '".$search_param."'");
		while($row = mysqli_fetch_assoc($sql)) {
		$country = $row["country"];
		$id = $row["id"];
		$countryResult[] = ['id'=>$id,'name'=>$country];
		}
		echo json_encode($countryResult);
?>