<? include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function zone_count(){
    
    global $con ; 
    
    $sql = mysqli_query($con,"select count(id) as zone_count from new_zone where status=1");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['zone_count'];
    
}

function state_count(){
    global $con ; 
    
    $sql = mysqli_query($con,"select count(id) as state_count from new_state where status=1");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['state_count'];
}

function tal_count(){
    global $con ; 
    
    $sql = mysqli_query($con,"select count(id) as tal_count from new_taluka where status=1");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['tal_count'];
}

function division_count(){
    global $con ; 
    
    $sql = mysqli_query($con,"select count(id) as div_count from new_division where status=1");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['div_count'];
}


function district_count(){
    
    global $con ; 
    
    $sql = mysqli_query($con,"select count(id) as dis_count from new_district where status=1");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['dis_count'];
    
}
function get_zone($state){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_state where id = '".$state."'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['zone'];

}


function get_state($division){
    global $con; 
    
    $sql = mysqli_query($con,"select * from new_division where id='".$division."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['state'];
}


function zone_cal(){
    
     global $con; 
   
    $zone_count= 0;
    
    $zone_sql = mysqli_query($con,"select * from new_zone where status=1");

    while($zone_sql_result = mysqli_fetch_assoc($zone_sql)){
    
        $zone = $zone_sql_result['zone'];

        $get_zone_member = mysqli_query($con,"select * from new_member where country=1 and zone='".$zone."' and zone<>0 and state=0 and division=0 and district = 0 and taluka= 0 and village=0 and pincode=0 and status=1");
            
            if($get_zone_member_result = mysqli_fetch_assoc($get_zone_member)){
                $zone_count++;
            }
}
    $result = [zone_count(),$zone_count];
    return $result;
    
}

function state_cal(){
    global $con;

    $state_count= 0;
    
    $state_sql = mysqli_query($con,"select * from new_state where status=1");

    while($state_sql_result = mysqli_fetch_assoc($state_sql)){
    
        $state_id = $state_sql_result['id'];
        $zone = $state_sql_result['zone'];

            $get_state_member = mysqli_query($con,"select * from new_member where country=1 and zone='".$zone."' and zone<>0 and state <> 0  and state='".$state_id."' and division=0 and district = 0 and taluka= 0 and village=0 and pincode=0 and status=1");
            
            if($get_state_member_result = mysqli_fetch_assoc($get_state_member)){
                $state_count++;
            }
}
    $result = [state_count(),$state_count];
    return $result;
}




function div_cal(){
    global $con;

    $div_count= 0;
    
    $division_sql = mysqli_query($con,"select * from new_division where status=1");

    while($division_sql_result = mysqli_fetch_assoc($division_sql)){
    
        $div_id = $division_sql_result['id'];
        // $name = $division_sql_result['division'];
        $state = $division_sql_result['state'];
        $zone = get_zone($state);
        

            $get_div_member = mysqli_query($con,"select * from new_member where country=1 and zone='".$zone."' and zone<>0 and state <> 0  and state='".$state."' and division='".$div_id."' and district = 0 and taluka= 0 and village=0 and pincode=0 and status=1");
            
            if($get_div_member_result = mysqli_fetch_assoc($get_div_member)){
                $div_count++;
            }
}
    $result = [division_count(),$div_count];
    return $result;
}


function district_cal(){
    global $con;

    $dis_count= 0;
    
    $district_sql = mysqli_query($con,"select * from new_district where status=1");

    while($district_sql_result = mysqli_fetch_assoc($district_sql)){
    
        $dis_id = $district_sql_result['id'];
        $division = $district_sql_result['division'];
        $state = get_state($division);
        $zone = get_zone($state);

        $get_dis_member = mysqli_query($con,"select * from new_member where country=1 and zone='".$zone."' and zone<>0 and state <> 0  and state='".$state."' and division='".$division."' and division <>0  and district = '".$dis_id."' and taluka= 0 and village=0 and pincode=0 and status=1");
            
            if($get_dis_member_result = mysqli_fetch_assoc($get_dis_member)){
                $dis_count++;
            }
}
    $result = [district_count(),$dis_count];
    return $result;
}



function get_division($district){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_district where id='".$district."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['division'];
}




function taluka_cal(){
    global $con;

    $tal_count= 0;
    
    $taluka_sql = mysqli_query($con,"select * from new_taluka where status=1");

    while($taluka_sql_result = mysqli_fetch_assoc($taluka_sql)){
    
        $taluka_id = $taluka_sql_result['id'];
        $dis_id = $taluka_sql_result['district'];
        $division = get_division($dis_id);
        $state = get_state($division);
        $zone = get_zone($state);

        $get_tal_member = mysqli_query($con,"select * from new_member where country=1 and zone='".$zone."' and zone<>0 and state <> 0  and state='".$state."' and division='".$division."' and division <>0  and district = '".$dis_id."' and district <> 0 and taluka='".$taluka_id."' and village=0 and pincode=0 and status=1");
            
            if($get_tal_member_result = mysqli_fetch_assoc($get_tal_member)){
                $tal_count++;
            }
}
    $result = [tal_count(),$tal_count];
    return $result;
}





    $zone = zone_cal();
    $state    = state_cal();
    $division = div_cal();
    $district = district_cal();
    $taluka = taluka_cal();
    
    var_dump($zone);
// var_dump($district);
//  echo $division[0];
?>