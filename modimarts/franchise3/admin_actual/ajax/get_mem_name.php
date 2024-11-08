<?php include('../../config.php');		
	$keyword = strval($_POST['query']);
	$search_param = "{$keyword}%";
	

	$sql = mysqli_query($con,"SELECT * FROM greetings_member WHERE name LIKE '%".$search_param."%' and status<>0");
		while($row = mysqli_fetch_assoc($sql)) {
		$id = $row["id"];
		$mobile = $row["name"];
		$countryResult[] = ['id'=>$id,'name'=>$mobile];
		    
		}
		echo json_encode($countryResult);
?>

