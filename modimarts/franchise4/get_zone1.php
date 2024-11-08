<?php include('config.php');		
	$keyword = strval($_POST['query']);

if($keyword){
	$search_param = "{$keyword}%";
	

	$sql = mysqli_query($con,"SELECT * FROM new_zone WHERE zone LIKE '".$search_param."' and status=1");
		while($row = mysqli_fetch_assoc($sql)) {
		$countryResult[] = $row["zone"];
		}
		echo json_encode($countryResult);    
}
else{
    $sql = mysqli_query($con,"SELECT * FROM new_zone");
		while($row = mysqli_fetch_assoc($sql)) {
		$countryResult[] = $row["zone"];
		}
		echo json_encode($countryResult);
}
	

	
?>

