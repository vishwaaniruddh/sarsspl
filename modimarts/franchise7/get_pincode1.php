<?php include('config.php');		
	$keyword = strval($_POST['query']);
	
	$search_param = "{$keyword}%";
	

	$sql = mysqli_query($con,"SELECT * FROM new_pincode WHERE pincode like '".$search_param."' and status=1");
		while($row = mysqli_fetch_assoc($sql)) {
		    $id = $row['id'];
		    $pincode = $row['pincode'];
		$countryResult[] = ['id'=>$id,'name'=>$pincode];
		}
		echo json_encode($countryResult);
?>