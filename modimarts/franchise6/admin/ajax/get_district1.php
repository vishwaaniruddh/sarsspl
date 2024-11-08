<?php include('../../config.php');		
	$keyword = strval($_POST['query']);

	$search_param = "{$keyword}%";
	

	$sql = mysqli_query($con,"SELECT * FROM new_district WHERE district LIKE '".$search_param."' and status=1");
		while($row = mysqli_fetch_assoc($sql)) {
	    $district= $row["district"];
        $id= $row["id"];
        $countryResult[] =  ['id'=>$id,'name'=>$district];
		}
		echo json_encode($countryResult);
?>

