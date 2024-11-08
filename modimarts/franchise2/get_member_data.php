<? session_start();
include('config.php');
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



function get_commision($id){
    
    global $con1;
    

    $sql = mysqli_query($con1,"select sum(amount) as total_com from commission_details where commission_to ='".$id."' and status=1");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['total_com'].'/-';
}

 

function get_position_name($level){
    global $con;
    
    
if($level==1){
    $level = 'Country';
}
else if($level==2){
        $level = 'Zone';
        
}
else if($level==3){
        $level = 'State';
}
else if($level==4){
        $level = 'Division';
}
else if($level==5){
        $level = 'District';
}
else if($level==6){
        $level = 'Taluka';
}
else if($level==7){
        $level = 'Pincode';
}
else if($level==8){
        $level = 'Village';
}

return $level;
}


function country_name($id){
    
    global $con; 
    
    $sql = mysqli_query($con,"select * from new_country where id = '".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['country'];
}

function zone_name($id){
    
    global $con; 
    
    $sql = mysqli_query($con,"select * from new_zone where id = '".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['zone'];
}

function state_name($id){
    
    global $con; 
    
    $sql = mysqli_query($con,"select * from new_state where id = '".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['state'];
}


function division_name($id){
    
    global $con; 
    
    $sql = mysqli_query($con,"select * from new_division where id = '".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['division'];
}

function district_name($id){
    
    global $con; 
    
    $sql = mysqli_query($con,"select * from new_district where id = '".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['district'];
}

function taluka_name($id){
    
    global $con; 
    
    $sql = mysqli_query($con,"select * from new_taluka where id = '".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['taluka'];
}


function pincode_name($id){
    
    global $con; 
    
    $sql = mysqli_query($con,"select * from new_pincode where id = '".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['pincode'];
}

function village_name($id){
    
    global $con; 
    
    $sql = mysqli_query($con,"select * from new_village where id = '".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['village'];
}



function get_mem_bred($id){
    
    global $con; 
    
    
    $sql = mysqli_query($con , "select * from new_member where id = '".$id."' ");
    $sql_result = mysqli_fetch_assoc($sql);
    
    
    $country = $sql_result['country'];
    $country = country_name($country);
    
    $zone = $sql_result['zone'];
    $zone = zone_name($zone);
    
    $state = $sql_result['state'];
    $state = state_name($state);
    
    $division = $sql_result['division'];
    $division = division_name($division);
    
    $district = $sql_result['district'];
    $district = district_name($district);
    
    $taluka = $sql_result['taluka'];
    $taluka = taluka_name($taluka);
    
    $pincode = $sql_result['pincode'];
    $pincode = pincode_name($pincode);
    
    $village = $sql_result['village'];
    $village = village_name($village);
    
    $string=  $country ; 
    if($zone){
        $string .= ' > '. $zone ;         
    }
    if($state){
        $string .=     '  > '.$state;     
    }
    if($division){
        $string .=      ' > '.$division;
    }

if($district){
    $string .= ' > '.$district;    
}
if($taluka){
    $string .= ' > '.$taluka ;     
}

if($pincode){
        $string .= ' > '.$pincode;
}

if($village){
$string .=     ' >'. $village ;    
}

return $string;

    
}



function get_Activeintro($id){
    global $con;
    $sql = mysqli_query($con,"select count(id) as intro_count from new_member where intro_id='".$id."' and status=1");
    $sql_result = mysqli_fetch_assoc($sql);
    $intro_count =$sql_result['intro_count'];
    return $intro_count; 
}


function get_Totalintro($id){
    global $con;
    $sql = mysqli_query($con,"select count(id) as intro_count from new_member where intro_id = '".$id."' and status=1 and id <> '".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['intro_count'];
}



function total_qualify($id){
    global $con;
    
    $sql = mysqli_query($con,"select * from new_member where intro_id='".$id."' and status=1 and id <> '".$id."'");
    $qualify = 0;
    while($sql_result = mysqli_fetch_assoc($sql)){
        
        
        $id_array[] = $sql_result['id'];
        $intro_to_id = $sql_result['id'];
        
        // echo "select count(id) as check_mem from new_member where intro_id='".$intro_to_id."' and status=1 and id<> '".$intro_to_id."'";
        
        $check_sql = mysqli_query($con,"select count(id) as check_mem from new_member where intro_id='".$intro_to_id."' and status=1 and id<> '".$intro_to_id."'");
        
        $check_sql_result = mysqli_fetch_assoc($check_sql);
        
        if($check_sql_result['check_mem'] >= 6){
            $qualify++;
        }
    }


return $qualify;
}


$country = $_POST['country'];
$zone = $_POST['zone'];
$state = $_POST['state'];
$division = $_POST['division'];
$district = $_POST['district'];
$taluka = $_POST['taluka'];
$pincode = $_POST['pincode'];
$village = $_POST['village'];





if($zone == ''){
    $zone = 0;
} 

if($state == ''){
    $state = 0;
} 

if($division == ''){
    $division = 0;
} 

if($district == ''){
    $district = 0;
} 

if($taluka == ''){
    $taluka = 0;
} 

if($pincode == ''){
    $pincode = 0;
} 

if($village == ''){
    $village = 0;
}
 




if(($_POST['mem_id']) !=''  || ($_POST['mem_name']) !='' || ($_POST['mem_mobile']) !='' ){
    
    $mem_id=$_POST['mem_id'];
    $mem_name=$_POST['mem_name'];
    $mem_mobile=$_POST['mem_mobile'];
    
    
if($mem_id){
$query = "select * from new_member where id = '".$mem_id."' and status='1'";    
}
else if($mem_name){
$query = "select * from new_member where  name like '".$mem_name."' and status='1'";
}
else if($mem_mobile){
    $query = "select * from new_member where mobile like '".$mem_mobile."' and status='1'";
}





$sql = mysqli_query($con,$query);

if($sql_result = mysqli_fetch_assoc($sql)){
    
    $id = $sql_result['id'];
    
    
    $commission = get_commision($id);

    $bread = get_mem_bred($id);
    $position_name = $sql_result['position_name'];
    $star = $sql_result['star'];
    $name = $sql_result['name'];
    $status = $sql_result['status'];
    $mobile = $sql_result['mobile'];
    $level = $sql_result['level_id'];
    $position = get_position_name($level);
    $from_date =  $sql_result['created_at'];
    $date = date('Y-m-d');
    
    $turn_sql = mysqli_query($con,"select datediff( '".$date."',  '".$from_date."') as days from new_member where id = '".$id."'");
    $turn_sql_result = mysqli_fetch_assoc($turn_sql);

    $days_over = $turn_sql_result['days'];
    $total_intro  = get_Totalintro($id);
    $active_intro = get_Activeintro($id);
    $qualify = total_qualify($id);

    
    $image_sql = mysqli_query($con,"select * from new_member_images where member_id='".$id."' and type='passport'");
    $image_sql_result = mysqli_fetch_assoc($image_sql);
    $image = $image_sql_result['image'];
    // $image = str_replace("https://www.","http://",$image);
    
        // $image = str_replace('https://www.allmart.world/', 'https://www.modimarts.com/', $image);
        $image = str_replace('https://www.modimart.world/', 'https://www.modimarts.com/', $image);
    
    
    
    
    
    
    
    
    
    
    $data = ['id'=>$id,'star'=>$star,'position'=>$position,'position_name'=>$position_name,'mobile'=>$mobile,'name'=>$name,'status'=>$status,'image'=>$image,'total_intro'=>$total_intro,'active_intro'=>$active_intro,'qualify'=>$qualify,'days_over'=>$days_over,'bread'=>$bread,'commission'=>$commission];
    
    echo json_encode($data);    

$_SESSION['show_table'] = '1';
}

else{

$_SESSION['show_table'] = '0';   
    echo 0;
}



    
}

else{
    
    
$sql = mysqli_query($con,"select * from new_member where country='".$country."'and zone='".$zone."' and state='".$state."' and division='".$division."' and district='".$district."' and taluka='".$taluka."' and pincode='".$pincode."' and village='".$village."' and status='1'");
// $sql = mysqli_query($con,"select * from new_member where country=''and zone='' and state='' and division='' and district='' and taluka='' and pincode='' and village='' and status='' ");
if($sql_result = mysqli_fetch_assoc($sql)){
    
    $id = $sql_result['id'];
$commission = get_commision($id);

$commission = round($commission,2);

    $bread = get_mem_bred($id);
    $position_name = $sql_result['position_name'];
    $star = $sql_result['star'];
    $name = $sql_result['name'];
    $status = $sql_result['status'];
    $mobile = $sql_result['mobile'];
    $level = $sql_result['level_id'];
    $position = get_position_name($level);
    $total_intro  = get_Totalintro($id);
    $active_intro = get_Activeintro($id);
    $qualify = total_qualify($id);

    $from_date =  $sql_result['created_at'];
    $date = date('Y-m-d');
    
    $turn_sql = mysqli_query($con,"select datediff( '".$date."',  '".$from_date."') as days from new_member where id = '".$id."'");
    $turn_sql_result = mysqli_fetch_assoc($turn_sql);

    $days_over = $turn_sql_result['days'];
    
    
    
    $image_sql = mysqli_query($con,"select * from new_member_images where member_id='".$id."' and type='passport'");
    $image_sql_result = mysqli_fetch_assoc($image_sql);
    $image = $image_sql_result['image'];
        $image = str_replace("https://www.","http://",$image);
    
    
    $data = ['id'=>$id,'star'=>$star,'position'=>$position,'position_name'=>$position_name,'mobile'=>$mobile,'name'=>$name,'status'=>$status,'image'=>$image,'total_intro'=>$total_intro,'active_intro'=>$active_intro,'qualify'=>$qualify,'days_over'=>$days_over,'bread'=>$bread,'commission'=>$commission];
    
    echo json_encode($data);    
$_SESSION['show_table'] = '1';
}

else{
    echo 0;
    $_SESSION['show_table'] = '0';
}

}





?>