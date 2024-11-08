<?php session_start();

include('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '-1');



function get_taluka($name){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_pincode where pincode='".$name."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['id'];
    
}



$sql = mysqli_query($con,"select * from new_member1");

while($sql_result = mysqli_fetch_assoc($sql)){
    
    $id = $sql_result['id'];
    $taluka  = $sql_result['pincode'];
    
    $dist_id = get_taluka($taluka);

if($dist_id){
    
$update  = "update new_member1 set pincode = '".$dist_id."' where id='".$id."'";

mysqli_query($con,$update);

}
echo '<br>';

}

return;



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
        <br>
        <br>
        <form action="#" method="post" enctype="multipart/form-data">
          <input type="file" name="images" class="form-control cust_file">
          <input type="submit" value="upload" class="btn btn-danger">
        </form>
        
    </body>
</html>


<?php

// function get_state($name){
    
//     global $con;
    
//     $sql = mysqli_query($con,"select * from state where state='".$name."'");
//     $sql_result = mysqli_fetch_assoc($sql);
    
//     return $sql_result['id'];
    
// }

function get_division($name){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_district where district='".$name."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['division'];
    
}


function get_zone($name){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_state where state='".$name."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['zone'];
    
}


// function get_taluka($name){
    
//     global $con;
    
//     $sql = mysqli_query($con,"select * from taluka where taluka='".$name."'");
//     $sql_result = mysqli_fetch_assoc($sql);
    
//     return $sql_result['id'];
    
// }

// function get_pincode($name){
    
//     global $con;
    
//     $sql = mysqli_query($con,"select * from pincode where pincode='".$name."'");
//     $sql_result = mysqli_fetch_assoc($sql);
    
//     return $sql_result['id'];
    
// }




$date = date('Y-m-d h:i:s a', time());

$only_date = date('Y-m-d');



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
  
      $row = $row-2;
  
          for($i = 1; $i<=$row; $i++){
            
            $joining_date = $rowData[$i][0][0];
            $name =   $rowData[$i][0][1];
            $mobile = $rowData[$i][0][2];
            $email = $rowData[$i][0][3];
            $dob = $rowData[$i][0][4];
            
            $gender = $rowData[$i][0][5];
            
            $location =$rowData[$i][0][6];
            
            $state = $rowData[$i][0][7];
            
            $zone = get_zone($state);
            
            $district = $rowData[$i][0][8];
            $division = get_division($district);
            
            $taluka = $rowData[$i][0][9];
            $village = $rowData[$i][0][10];
            $pincode = $rowData[$i][0][11];
            
            $is_married = $rowData[$i][0][12];            
            $anniversary = $rowData[$i][0][13];
            $cast = $rowData[$i][0][14];
            $pan_no = $rowData[$i][0][15];
            $aadhar_no = $rowData[$i][0][16];
            $bank = $rowData[$i][0][17];
            echo $account = $rowData[$i][0][18];
            $ifsc = $rowData[$i][0][19];
            $account_type = $rowData[$i][0][20];
            $gst = $rowData[$i][0][21];
            $payment_option = $rowData[$i][0][22];
            $comments = $rowData[$i][0][23];
            $is_agree = $rowData[$i][0][28];
            $introducer_name = $rowData[$i][0][29];
            $introducer_mobile = $rowData[$i][0][30];
            $nominee = $rowData[$i][0][31];

            // // $payment_receivable = $rowData[$i][0][32];
            // // $payment_received = $rowData[$i][0][33];
            // // $balance = $rowData[$i][0][34];
            // // $time = $rowData[$i][0][35];
            // // $residing_area  = $rowData[$i][0][36];
            // $mobile2  = $rowData[$i][0][37];
            
            
            // // echo 'date = '.$joining_date. 'Name = '.$name;
            // $joining_date = strtotime(trim($joining_date));
            // $joining_date = date('Y-m-d',$joining_date);

            // $payment_date = strtotime(trim($payment_date));
            // $payment_date = date('Y-m-d',$payment_date);



          $ymd = date("Y-m-d");
           
        //   $sql = "insert into new_member1(full_pay_date,country,zone,state,division,district,taluka,village,location,pincode,status,name,mobile,introducer_name,introducer_mobile,nominee,payment_date,is_verify,created_at,dob,email,cast,pan_no,aadhar_no,bank_name,account_no,ifsc,account_type,gst,comments,is_married) values('".$joining_date."','1','".$zone."','".$state."','".$division."','".$district."','".$taluka."','".$village."','".$location."','".$pincode."','1','".$name."','".$mobile."','".$introducer_name."','".$introducer_mobile."','".$nominee."','".$joining_date."','1','".$ymd."','".$dob."','".$email."','".$cast."','".$pan_no."','".$aadhar_no."','".$bank."','".$account."','".$ifsc."','".$account_type."','".$gst."','".$comments."','".$is_married."')";
           
        //   echo $sql;
          echo '<br>';
// echo '<br>';
           
            // mysqli_query($con,$sql);
          }

    ?>