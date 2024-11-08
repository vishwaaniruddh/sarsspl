<?php include('../config.php');

$atmid = $_REQUEST['atmid'];

if($atmid){
        $sql = mysqli_query($con,"select * from sitesmaster where atmid='".trim($atmid)."'");
        
        if($sql_result = mysqli_fetch_assoc($sql)){

            $customer = strtoupper($sql_result['client']);

            $location = $sql_result['address'];
            $state = $sql_result['state'];
            $region = $sql_result['zone'];    

            $branch = $sql_result['branch_code'];
            $city = $sql_result['city'];
            
            $data = ['customer'=>$customer,'location'=>$location,'city'=>$city,'state'=>$state,'region'=>$region,'branch'=>$branch] ; 
        
        if($data){
            echo json_encode($data);    
        }else{
            echo 0;
        }
    }
}else{
    echo 0; 
}

?>