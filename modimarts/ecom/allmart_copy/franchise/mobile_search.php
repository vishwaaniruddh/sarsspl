<?php 
ini_set('memory_limit','2048M');
//error_reporting(0);
include ('config.php');
//include('query.php');

$mobile = $_REQUEST['mobile'];

$sql = "SELECT * FROM member where mobile= $mobile";
$result = $conn->query($sql);
// var_dump($result->fetch_assoc()) ;

if ($result->num_rows > 0) {
    $cot = 0;
    while($row = $result->fetch_assoc()) {
        if(!$cot>=1){
        $cot++;
         //var_dump($row);
        //$idS = $row['id'];
        $level_idS = $row['level_id'];
        $loc_idS = $row['loc_id'];
        //$position_idS = $row['position_id'];
        //$nameS = $row['name'];
        //$lastNameS = $row['LastName'];
        $state = $row['state'];
        $city = $row['city'];
        $district = $row['district'];
        $talukaa = $row['taluka'];
        $zone = $row['zone'];
        $country = $row['country'];
        $pincode = $row['pincode'];
        $village = $row['village'];
        
        if($state==0){
            $state='';
        }
        if($city==0){
            $city='';
        }
        if($district==0){
            $district='';
        }
        if($talukaa==0){
            $talukaa='';
        }
        if($zone==0){
            $zone='';
        }
        if($country==0){
            $country='';
        }
        if($pincode==0){
            $pincode='';
        }
        if($village==0){
            $village='';
        }
        
        $myObj->State = $state;
        $myObj->City = $city;
        $myObj->District = $district;
        $myObj->talukaa = $talukaa;
        $myObj->Zone = $zone;
        $myObj->country = $country;
        $myObj->Pincode = $pincode;
        $myObj->village = $village;
        $myObj->hdLevel = $level_idS;
        $myObj->hdLoc = $loc_idS;
        
        $myJSON = json_encode($myObj);

        
        echo $myJSON;
        }
    }
}else{
    echo "0";
}
        ?>