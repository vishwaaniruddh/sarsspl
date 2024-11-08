<?php include('../../config.php'); 
// print_r($con);
if(isset($_POST['action']) ){
    if($_POST['action'] === 'dropdowndata'){
        $respdata=getalldata($con);
        // print_r($respdata);
        $resp =array("data"=>$respdata);
        echo json_encode($resp);
    
    }
    if($_POST['action'] === 'imagedata'){
        
    	$filename = $_FILES["file"]["name"]; 
    // 	echo $filename;
    	$tempname = $_FILES["file"]["tmp_name"];	 
// 		$folder = "image/".$filename; 
        // print_r($_POST['adname']);
        $respdata= insertimagedata($con,$_POST['adname'],$_POST['languagae'],$filename,$tempname);
        // print_r($respdata);
        // $resp =array("data"=>$respdata);
        echo json_encode($respdata);
    
    }
}
function Insertdata()
    {
        $userdate=$_POST["Date1"];
        $adname=$_POST["Adname"];
        $status=$_POST["Status"];
        
        $t=time();
        //echo($userdate . "<br>");
        $createdate=date("Y/m/d",$t);
        //echo($createdate);
        //die();
        $sql = "INSERT INTO pormotions (name, date, status, created_at) VALUES ('$adname', '$userdate', '$status', '$createdate')";
        $xsy = mysqli_query($con, $sql);
        
        if ($xsy) {
          echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    
    }

function  getalldata($con)
    {
        $sql  = 'SELECT * FROM pormotions';
         $result = mysqli_query($con, $sql);
        //  print_r($result);
         if($result){
            //  $i=0;
            while($row = mysqli_fetch_array($result)){
            $responsedata[] = array("id"=>$row['id'],"name"=>$row['name']);
             }
         }
        return $responsedata;
    }
    
function  insertimagedata($con,$adname,$language,$filename,$tempname){
    $createddate =  date("Y-m-d");
    
    $sql2 = "INSERT INTO ads_image(Filename) VALUES ('$filename')"; 
    $sql4 = "INSERT INTO ads_languages(`ads language`,`created at`) VALUES ('$language','$createddate')"; 
    $sql5 = "INSERT INTO pormotions(`name`,`date`,`status`,`created_at`) VALUES ('$adname','$createddate',0,'$createddate')"; 
      $a = mysqli_query($con, $sql2);
      $b = mysqli_query($con, $sql4); 
      $d = mysqli_query($con, $sql5);
       
    //   echo $sql2;
    //   echo $sql3;
    //   echo $sql4;
    //   echo $sql5;
	if($a && $b && $d) {
	    $sql  = 'SELECT id FROM ads_languages WHERE `ads language` = "'.$language.'"';
         $result = mysqli_query($con, $sql);
         if($result){
             while($row = mysqli_fetch_array($result)){
                $language_id = $row['id'];
             }
         }
         $sql3 = "INSERT INTO ads(`ads name`,`language id`,`display flag`,`created at`) VALUES ('$adname',$language_id,1,'$createddate')";
	     mysqli_query($con, $sql3);
        $target = "image/" . basename($filename);
        if (move_uploaded_file($tempname, $target)) {
            $response = array(
                "type" => "success",
                "message" => "Successfull.",
                "data" =>'null'
            );
         }
    }else{
        $response = array(
                "type" => "success",
                "message" => "Data Not Inserted.",
                "data" =>'null'
            );
    }
    
    return $response;
    
}
?>

