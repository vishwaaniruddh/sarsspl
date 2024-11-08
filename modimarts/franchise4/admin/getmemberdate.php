<?php include('../config.php');		
	$keyword = strval($_POST['query']);
	
	$search_param = "%{$keyword}%";
	

	$sql = mysqli_query($con,"SELECT * FROM new_member WHERE created_at like '".$search_param."' and status=1");
		while($row = mysqli_fetch_assoc($sql)) {
		    $id = $row['id'];
		    $pincode = date('Y-m-d',strtotime($row['created_at']));
		$countryResult[] = ['id'=>$id,'name'=>$pincode];
		}
		echo json_encode($countryResult);
?>