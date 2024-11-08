<?php include('config.php');		
	$keyword = strval($_POST['query']);
	$search_param = "{$keyword}%";
	

	$sql = mysqli_query($con,"SELECT * FROM new_member WHERE mobile LIKE '%".$search_param."%' and status=1");
		while($row = mysqli_fetch_assoc($sql)) {
		$id = $row["id"];
		$mobile = $row["mobile"];
		$countryResult[] = ['id'=>$id,'name'=>$mobile];
		    
		}
		echo json_encode($countryResult);
?>

