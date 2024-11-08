<?php include('../../config.php');		
	$keyword = strval($_POST['query']);

	$search_param = "{$keyword}%";
	

	$sql = mysqli_query($con,"SELECT * FROM new_division WHERE division LIKE '%".$search_param."%' and status=1");
		while($row = mysqli_fetch_assoc($sql)) {
		    
		$id = $row["id"];
		$division = $row["division"];
		$countryResult[] = ['id'=>$id,'name'=>$division];
		
// 		$countryResult[] = $row["division"];
		}
		echo json_encode($countryResult);
?>

