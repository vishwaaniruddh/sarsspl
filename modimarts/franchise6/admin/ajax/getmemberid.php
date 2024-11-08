<?php include('../../config.php');		
	$keyword = strval($_POST['query']);
	
	$search_param = "{$keyword}%";
	

	$sql = mysqli_query($con,"SELECT * FROM greetings_member WHERE id like '".$search_param."' and status=1");
		while($row = mysqli_fetch_assoc($sql)) {
		    $id = $row['id'];
		    $pincode = $row['id'];
		$countryResult[] = ['id'=>$id,'name'=>$pincode];
		}
		echo json_encode($countryResult);
?>