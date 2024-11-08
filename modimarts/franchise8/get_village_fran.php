<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>
    img{
        width:100px;
    }
</style>

<? include('config.php');





$country = $_POST['country'];
$zone = $_POST['zone'];
$state = $_POST['state'];
$division = $_POST['division'];
$district = $_POST['district'];
$taluka = $_POST['taluka'];
$pincode = $_POST['pincode'];
// $village = $_POST['village'];


// $pincode = '11838';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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
    $sql = mysqli_query($con,"select count(id) as intro_count from new_member where intro_id='".$id."' ");
    $sql_result = mysqli_fetch_assoc($sql);
    $intro_count =$sql_result['intro_count'];
    return $intro_count; 
}


function get_Totalintro($id){
    global $con;
    $sql = mysqli_query($con,"select count(id) as intro_count from new_member where intro_id = '".$id."' and id <> '".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['intro_count'];
}



function total_qualify($id){
    global $con;
    
    $sql = mysqli_query($con,"select * from new_member where intro_id='".$id."' and id <> '".$id."'");
    $qualify = 0;
    while($sql_result = mysqli_fetch_assoc($sql)){
        
        
        $id_array[] = $sql_result['id'];
        $intro_to_id = $sql_result['id'];
        
        // echo "select count(id) as check_mem from new_member where intro_id='".$intro_to_id."' and status=1 and id<> '".$intro_to_id."'";
        
        $check_sql = mysqli_query($con,"select count(id) as check_mem from new_member where intro_id='".$intro_to_id."'  and id<> '".$intro_to_id."'");
        
        $check_sql_result = mysqli_fetch_assoc($check_sql);
        
        if($check_sql_result['check_mem'] >= 6){
            $qualify++;
        }
    }


return $qualify;
}




if($pincode>0){ ?>
    



<h2 style=" text-align:center; "> Village Level Franchise</h2>
    <table style="cursor: pointer;">
    <tbody>
    <tr>
                <th>Position Name</th>
                <th>Profile</th>
                <th>ID No</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Total Introduction Done</th>
                <th>Total Introduced Qualified</th>
                <th>Days Over</th>
                <th>Turnover</th>
                <th>Apply</th>
                <th>Status</th>
                <th>Visiting Card</th>
                <th>View Down Line</th>
                <th>Direct Introduction</th>
                <th>Promotions</th>
                <th>Edit Profile</th>
              </tr>
              <?

$sql = mysqli_query($con,"select * from new_village where pincode = '".$pincode."' order by id asc");

while($sql_result = mysqli_fetch_assoc($sql)){
    
     $village_id = $sql_result['id'];
     $village = $sql_result['village'];


$member_sql = mysqli_query($con,"select * from new_member where pincode='".$pincode."' and village='".$village_id."' and status ='1'");

// echo "select * from new_member where pincode='".$pincode."' and village='".$village_id."' and status in ('1','2')";
if($member_sql_result = mysqli_fetch_assoc($member_sql)){ 



    $id = $member_sql_result['id'];
    $mem_status= $member_sql_result['mem_status'];

    $position_name = $member_sql_result['position_name'];
    $star = $member_sql_result['star'];
    $name = $member_sql_result['name'];
    $status = $member_sql_result['status'];
    $mobile = $member_sql_result['mobile'];
    $level = $member_sql_result['level_id'];
    $position = get_position_name($level);
    $from_date =  $member_sql_result['created_at'];
    $date = date('Y-m-d');
    
    $turn_sql = mysqli_query($con,"select datediff( '".$date."',  '".$from_date."') as days from new_member where id = '".$id."'");
    $turn_sql_result = mysqli_fetch_assoc($turn_sql);

    $days_over = $turn_sql_result['days'];
    $total_intro  = get_Totalintro($id);
    $active_intro = get_Activeintro($id);
    $qualify = total_qualify($id);

    if($mem_status == 'p'){
    $image_sql = mysqli_query($con,"select * from new_member_images where member_id='".$id."' and type='passport'");
    $image_sql_result = mysqli_fetch_assoc($image_sql);
    $image = $image_sql_result['image'];        
    }
    else if($mem_status == 'w'){
    $image_sql = mysqli_query($con,"select * from new_member_waiting_images where member_id='".$id."' and type='passport'");
    $image_sql_result = mysqli_fetch_assoc($image_sql);
    $image = $image_sql_result['image'];
    }


?>
    
    
        <tr>
                <td><? echo $star; ?></td>
                <td><img src="<? echo $image; ?> "></td>
                <td><? echo $id; ?></td>
                <td><? echo $name; ?></td>
                <td><? echo $mobile; ?></td>
                <td><? echo $total_intro; ?></td>
                <td><? echo $active_intro; ?></td>
                <td><? echo $days_over; ?></td>
                <td>0</td>
                <td></td>
                <td>    
                    <? if($mem_status == 'p'){
                    echo 'Confirm';    
                    }
                    else if($mem_status == 'w'){
                        echo 'W/L';
                    }
                     ?>
                </td>
                <td><a href="new_visiting.php?id=<? echo $id; ?>" class="btn btn-danger">Visiting Card</a></td>

                <td>
                    <button id="trees" type="button" class="btn btn-info" data-toggle="modal" data-original-title ="<? echo $id; ?>" data-target="#myModal">View Tree</button>
                </td>
                <td></td>
                <td>
                    <a class="btn btn-danger" href="promotions.php?id=<? echo $id; ?>"> Promotions </a>
                </td>
                <td>
                    <a type="button" href="waiting_login.php?id=<? echo $id; ?>&&mem=1" class="btn btn-danger">Edit</button></td>
              </tr>
    
    

    
    
    
<? }
else{ ?>
       <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a id="apply" href="apply.php?country=<? echo $country;?>&zone=<? echo $zone; ?>&state=<? echo $state;?>&division=<? echo $division; ?>&district=<? echo $district; ?>&taluka=<? echo $taluka; ?>&pincode=<? echo $pincode; ?>&village=<? echo $village_id; ?>" class="btn btn-danger">Apply for <? echo $village; ?></a>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>


<? } ?>

    

    
    
<? } ?>
    </tbody>
    
    </table>
    
<? } ?>