<?php include('config.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '-1');


?>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Bulk Upload Purchase Order </title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link href="menu.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    
    
       <style>
      
   #custome_buyer_information,#buyer_information{
       color: white;
    text-align: left;
   }
   
   #buyer_information label,#custome_buyer_information label{
       width:30%;
   }
  #buyer_information span, #custome_buyer_information span{
       width:70%;
   }
   .add_heading{
       color:white;
   }
   .custom_inside_row{
       width:47%;
       display: flex;
    height: fit-content;
   }
   
   .custom_inside_row .span_label{
       width:98%;
       
   }
   html[xmlns] #menu-bar {
    display: block;
    z-index: 100000;
    position: relative;
}

   #header, #form1 table{
       width:80%;
   }
   
   body{
           background-color: #4D9494;
    margin-top: 20px;
    
   }
 
             .select-editable {
     position:relative;
     background-color:white;
     border:solid grey 1px;
     width:120px;
     height:18px;
 }
 .select-editable select {
     position:absolute;
     top:0px;
     left:0px;
     font-size:14px;
     border:none;
     width:120px;
     margin:0;
 }
 .select-editable input {
     position:absolute;
     top:0px;
     left:0px;
     width:100px;
     padding:1px;
     font-size:12px;
     border:none;
 }
 .select-editable select:focus, .select-editable input:focus {
     outline:none;
 }
 
.bd-example {
    position: relative;
    padding: 5rem;
    margin: 2rem -15px 0;
    border: none;
    border-width: 0;
}
form{
    margin:2%;
    display:flex;
    justify-content:center;
}
.cust_file{
    color: white;
    background-color: #4d9494;
        width: 50%;
}

        </style>
    </head>
    <body>
        
        <form action="#" method="post" enctype="multipart/form-data">
          <input type="file" name="images" class="form-control cust_file">
          <input type="submit" value="upload" class="btn btn-danger">
        </form>
        
    </body>
</html>


<?php
	
	if ($_FILES['images']) {


	$target_dir = 'PHPExcel/';

    $file_name=$_FILES["images"]["name"];
    
    $file_tmp=$_FILES["images"]["tmp_name"];
    
    
    
    $file =  $target_dir.'/'.$file_name;

    move_uploaded_file($file_tmp=$_FILES["images"]["tmp_name"],$target_dir.'/'.$file_name);
    


  //Had to change this path to point to IOFactory.php.
  //Do not change the contents of the PHPExcel-1.8 folder at all.
  include('PHPExcel/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

  //Use whatever path to an Excel file you need.
  $inputFileName = $file;

  try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
  } catch (Exception $e) {
    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . 
        $e->getMessage());
  }

  $sheet = $objPHPExcel->getSheet(0);
  $highestRow = $sheet->getHighestRow();
  $highestColumn = $sheet->getHighestColumn();

  for ($row = 1; $row <= $highestRow; $row++) { 
    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
                                    null, true, false);
                                
  }
  
  
//   var_dump($rowData[0]);
      $row = $row-2;
      


          for($i = 2; $i<=$row; $i++){
            
	          $country = $rowData[$i][0][5];
	          $zone = $rowData[$i][0][6];
	          $state = $rowData[$i][0][7];
	          $division =   $rowData[$i][0][8];      
	          $district =   $rowData[$i][0][9];      
	          $taluka =   $rowData[$i][0][10];      
	          $pincode =   $rowData[$i][0][11];      
	          $village=   $rowData[$i][0][12];      



	          if($country){

	          
	          $country_sql = mysqli_query($con,"select * from new_country where country='".$country."'");
	          $country_sql_result = mysqli_fetch_assoc($country_sql);

	          if($country_sql_result){

	          	$country_id = $country_sql_result['id'];
	          }
	          else{
	          	 mysqli_query($con,"insert into new_country(country,status) values('".$country."','1')");

	          	 $country_id = $con->insert_id;
	          }



}


if($zone){
     
	          $zone_sql = mysqli_query($con,"select * from new_zone where zone='".$zone."'");
	          $zone_sql_result = mysqli_fetch_assoc($zone_sql);

	          if($zone_sql_result){

	          	$zone_id = $zone_sql_result['id'];
	          }
	          else{
	          	 mysqli_query($con,"insert into new_zone(zone,country,status) values('".$zone."','".$country_id."','1')");

	          	 $zone_id = $con->insert_id;
	          }
}


if($state){
     
	          $state_sql = mysqli_query($con,"select * from new_state where state='".$state."'");
	          $state_sql_result = mysqli_fetch_assoc($state_sql);

	          if($state_sql_result){

	          	$state_id = $state_sql_result['id'];
	          }
	          else{
	          	 mysqli_query($con,"insert into new_state(state,zone,status) values('".$state."','".$zone_id."','1')");

	          	 $state_id = $con->insert_id;
	          }
}



if($division){
     
	          $division_sql = mysqli_query($con,"select * from new_division where division='".$division."'");
	          $division_sql_result = mysqli_fetch_assoc($division_sql);

	          if($division_sql_result){

	          	$division_id = $division_sql_result['id'];
	          }
	          else{
	          	 mysqli_query($con,"insert into new_division(division,state,status) values('".$division."','".$state_id."','1')");

	          	 $division_id = $con->insert_id;
	          }
}


if($district){
     
	          $district_sql = mysqli_query($con,"select * from new_district where district='".$district."'");
	          $district_sql_result = mysqli_fetch_assoc($district_sql);

	          if($district_sql_result){

	          	$district_id = $district_sql_result['id'];
	          }
	          else{
	          	 mysqli_query($con,"insert into new_district(district,division,status) values('".$district."','".$division_id."','1')");

	          	 $district_id = $con->insert_id;
	          }
}

if($taluka){
     
	          $taluka_sql = mysqli_query($con,"select * from new_taluka where taluka='".$taluka."'");
	          $taluka_sql_result = mysqli_fetch_assoc($taluka_sql);

	          if($taluka_sql_result){

	          	$taluka_id = $taluka_sql_result['id'];
	          }
	          else{
	          	 mysqli_query($con,"insert into new_taluka(taluka,district,status) values('".$taluka."','".$district_id."','1')");

	          	 $taluka_id = $con->insert_id;
	          }
}


if($pincode){
     
	          $pincode_sql = mysqli_query($con,"select * from new_pincode where pincode='".$pincode."'");
	          $pincode_sql_result = mysqli_fetch_assoc($pincode_sql);

	          if($pincode_sql_result){

	          	$pincode_id = $pincode_sql_result['id'];
	          }
	          else{

	          	// echo "insert into new_pincode(pincode,taluka,status) values('".$pincode."','".$taluka_id."','1')";
	          	 mysqli_query($con,"insert into new_pincode(pincode,taluka,status) values('".$pincode."','".$taluka_id."','1')");

	          	 $pincode_id = $con->insert_id;
	          }
}


if($village){
     
	          $village_sql = mysqli_query($con,"select * from new_village where village='".$village."'");
	          $village_sql_result = mysqli_fetch_assoc($village_sql);

	          if($village_sql_result){

	          	$village_id = $village_sql_result['id'];
	          }
	          else{
	          	 mysqli_query($con,"insert into new_village(village,pincode,status) values('".$village."','".$pincode_id."','1')");

	          	//  $village_id = $con->insert_id;
	          }
}

          }
	}

    ?>
