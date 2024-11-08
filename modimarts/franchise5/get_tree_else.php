<? include('config.php');

$country = $_REQUEST['country'];
$zone = $_REQUEST['zone'];
$state = $_REQUEST['state'];
$division = $_REQUEST['division'];
$district = $_REQUEST['district'];
$taluka = $_REQUEST['taluka'];
$pincode = $_REQUEST['pincode'];
$village = $_REQUEST['village'];


if($country > 0 && $zone =='0'){
    $search_level = 1;
}
if($country > 0 && $zone > 0 && $state == 0){
    $search_level = 2;
}
if($country > 0 && $zone > 0 && $state > 0 && $division == 0){
    $search_level = 3;
}

if($country > 0 && $zone > 0 && $state > 0 && $division > 0 && $district == 0){
    $search_level = 4;
}

if($country > 0 && $zone > 0 && $state > 0 && $division > 0 && $district > 0 && $taluka ==0 ){
    $search_level = 5;
}

if($country > 0 && $zone > 0 && $state > 0 && $division > 0 && $district > 0 && $taluka > 0 && $pincode ==0){
    $search_level = 6;
}

if($country > 0 && $zone > 0 && $state > 0 && $division > 0 && $district > 0 && $taluka > 0 && $pincode > 0 && $village == 0 ){
    $search_level = 7;
}

if($country > 0 && $zone > 0 && $state > 0 && $division > 0 && $district > 0 && $taluka > 0 && $pincode > 0 && $village > 0 ){
    $search_level = 8;
}



$request = $_REQUEST;


function get_introducer($member_id){
    global $con;
    
    $sql = mysqli_query($con,"select * from new_member where id = '".$member_id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    $introducer_id = $sql_result['intro_id'];
    
    $intro_sql = mysqli_query($con,"select * from new_member where id = '".$introducer_id."'");
    $intro_sql_result = mysqli_fetch_assoc($intro_sql);
    
    $intro_name = $intro_sql_result['name'];
    $intro_mobile = $intro_sql_result['mobile'];
    
    $data = [$intro_name,$intro_mobile];
    
    return $data;
}


function get_pre_mem($nid,$plevel,$pid,$return){
    global $con;
    

    $psql = mysqli_query($con,"select * from new_member where level_id = '".$nid."' and $plevel='".$pid."' and status=1");
    $psql_result = mysqli_fetch_assoc($psql);
    
    if($psql_result[$return]){
    return $psql_result[$return];
    }
    else{
    return "select * from new_member where level_id = '".$nid."' and $plevel='".$pid."' and status=1";
    }
    
    }


function get_levels_name($level_id){
 
 global $con;
 
 if($level_id ==1){
    $level_name = 'country';
    $previous_level = '';
    $next_level = 'zone';
    
    
}
else if($level_id ==2){
    $level_name = 'zone';
    $previous_level = 'country';
    $next_level = 'state';
}
else if($level_id ==3){
    $level_name = 'state';
    $previous_level = 'zone';
    $next_level = 'division';
}
else if($level_id ==4){
    $level_name = 'division';
    $previous_level = 'state';
    $next_level = 'district';
}
else if($level_id ==5){
    $level_name = 'district';
    $previous_level = 'division';
    $next_level = 'taluka';
}
else if($level_id ==6){
    $level_name = 'taluka';
    $previous_level = 'district';
    $next_level = 'pincode';
}
else if($level_id ==7){
    $level_name = 'pincode';
    $previous_level = 'taluka';
    $next_level = 'village';
}
else if($level_id ==8){
    $level_name = 'village';   
    $previous_level = 'pincode';
    $next_level= '';
}

return [$level_name,$previous_level,$next_level];
}

function get_column_value($userid,$column){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_member where id='".$userid."' and status=1");
    $sql_result = mysqli_fetch_assoc($sql);
    $id =  $sql_result[$column];
    

    $get_sql = mysqli_query($con,"select * from new_$column where id='".$id."'");
    
    $get_sql_result = mysqli_fetch_assoc($get_sql);
    return $get_sql_result[$column];
}


function get_zone_by_state($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_state where id ='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['zone'];
}



function get_state_by_div($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_division where id ='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['state'];
    
}


function get_div_by_district($id){
    
    global $con;
    

    $sql = mysqli_query($con,"select* from new_district where id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['division'];
}


function get_dis_by_taluka($id){
    
    global $con;
    $sql = mysqli_query($con,"select * from new_taluka where id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['district'];
}


function get_tal_by_pin($id){
    global $con;
    

    $sql = mysqli_query($con,"select * from new_pincode where id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['taluka'];
}

function get_apply_url($position, $position_name){
    
    global $con;
    
    if($position =='zone'){
        $sql = mysqli_query($con,"select * from new_zone where zone='".$position_name."'");
        $sql_result = mysqli_fetch_assoc($sql);
        $id = $sql_result['id'];
        
        return "apply.php?country=1&zone=$id&state=0&division=0&district=0&taluka=0&pincode=0&village=0";
    }
    
    if($position =='state'){
        
        $sql = mysqli_query($con,"select * from new_state where state='".$position_name."'");
        $sql_result = mysqli_fetch_assoc($sql);
        $id = $sql_result['id'];
        $zone = $sql_result['zone'];
        
        return "apply.php?country=1&zone=$zone&state=$id&division=0&district=0&taluka=0&pincode=0&village=0";
    }
    
    if($position =='division'){
        
        $sql = mysqli_query($con,"select * from new_division where division='".$position_name."'");
        $sql_result = mysqli_fetch_assoc($sql);
        $div = $sql_result['id'];
        $state = $sql_result['state'];
        $zone = get_zone_by_state($state);
        
        return "apply.php?country=1&zone=$zone&state=$state&division=$div&district=0&taluka=0&pincode=0&village=0";
    }
    
    
    if($position =='district'){
        
        $sql = mysqli_query($con,"select * from new_district where district='".$position_name."'");
        $sql_result = mysqli_fetch_assoc($sql);
        $dis = $sql_result['id'];
        $div = $sql_result['division'];
        $state = get_state_by_div($div);
        $zone = get_zone_by_state($state);
        
        return "apply.php?country=1&zone=$zone&state=$state&division=$div&district=$dis&taluka=0&pincode=0&village=0";
    }
    
    if($position =='taluka'){
        
        $sql = mysqli_query($con,"select * from new_taluka where taluka ='".$position_name."'");
        $sql_result = mysqli_fetch_assoc($sql);
        $tal = $sql_result['id'];
        $dis = $sql_result['district'];
        $div = get_div_by_district($dis);
        $state = get_state_by_div($div);
        $zone = get_zone_by_state($state);
        
        return "apply.php?country=1&zone=$zone&state=$state&division=$div&district=$dis&taluka=$tal&pincode=0&village=0";
    }
    
    
    if($position =='pincode'){
        
        $sql = mysqli_query($con,"select * from new_pincode where pincode='".$position_name."'");
        $sql_result = mysqli_fetch_assoc($sql);
        $pin = $sql_result['id'];
        $tal = $sql_result['district'];
        $dis = get_dis_by_taluka($tal);
        $div = get_div_by_district($dis);
        $state = get_state_by_div($div);
        $zone = get_zone_by_state($state);
        
        return "apply.php?country=1&zone=$zone&state=$state&division=$div&district=$dis&taluka=$tal&pincode=$pin&village=0";
    }
    
    if($position =='village'){
        
        $sql = mysqli_query($con,"select * from new_village where village='".$position_name."'");
        $sql_result = mysqli_fetch_assoc($sql);
        $village = $sql_result['id'];
        $pin = $sql_result['pincode'];
        $tal = get_tal_by_pin($pin);
        $dis = get_dis_by_taluka($tal);
        $div = get_div_by_district($dis);
        $state = get_state_by_div($div);
        $zone = get_zone_by_state($state);
        
        return "apply.php?country=1&zone=$zone&state=$state&division=$div&district=$dis&taluka=$tal&pincode=$pin&village=$village";
    }   
}


$counter = 0;
$level_counter = 2;
$counter1 = 0;


foreach($request as $key => $val){

    if($val == ''){
      $val =0; 
    }


    if($counter == 0){
        
        
        $ths =  get_levels_name($level_counter);
        $pre_level_name = $ths[1];
        $next_level_name = $ths[2];



        $sql = mysqli_query($con,"select * from new_$key where id = '".$val."' and status=1");
        
        $pre_id = $val;
        

        ?>
        <table>
            <thead>
                <th>Name</th>
                <th>Mobile</th>
                <th>Position</th>
                <th>Position Name</th>
                <th>Introducer Name</th>
                <th>Introducer Mobile</th>
            </thead>
            <tbody>


        <?
        while($sql_result = mysqli_fetch_assoc($sql)){
            
                
                $mem_sql = mysqli_query($con,"select * from new_member where $key= '".$sql_result['id']."' and $next_level_name  = 0 and status=1");
                if($mem_sql_result = mysqli_fetch_assoc($mem_sql)){
                    
                
                    
                
                $member_name = $mem_sql_result['name'];
                $member_mobile = $mem_sql_result['mobile'];
                $mem_intro = $mem_sql_result['introducer_name'];
                $mem_mobile = $mem_sql_result['introducer_mobile'];
            ?>
            
            <tr>
                <td><? echo $member_name;?></td>
                <td><? echo $member_mobile;?></td>
                <td><? echo $sql_result[$key];?></td>
                <td><? echo $sql_result[$key];?></td>
                <td><? echo $mem_intro;?></td>
                <td><? echo $mem_mobile;?></td>
            </tr>
        
        
        <? }
        else{ ?>
        
        
            
            <tr>
                <td> --</td>
                <td></td>
                <td><a href="#"> Apply </a></td>
                <td><? echo $sql_result[$key];?></td>
                <td> -- </td>
                <td> -- </td>
            </tr>
          
    
    
    
    
            
        <? }
        
        }  $counter++; ?>
            </tbody>
        </table>
    <? }
    
    
    
    
    
        else if($counter <= $search_level && $counter > 0 ){    
     
         $ths =  get_levels_name($level_counter);
         $pre_level_name = $ths[1];
         $next_level_name = $ths[2];
         
         
        

         $sql = mysqli_query($con,"select * from new_$key where $pre_level_name = '".$pre_id."' and status=1"); ?>
        <table>
            <thead>
                 <th>Name</th>
                <th>Mobile</th>
                <th>Position</th>
                <th>Position Name</th>
                <th>Introducer Name</th>
                <th>Introducer Mobile</th>
            </thead>
            <tbody>


        <?
        while($sql_result = mysqli_fetch_assoc($sql)){
            
            $position_id = $sql_result[$key]; 
            
            
            

            
            $mem_sql = mysqli_query($con,"select * from new_member where $key= '".$sql_result['id']."' and $next_level_name  = 0 and status=1");
                
                if($mem_sql_result = mysqli_fetch_assoc($mem_sql)){
                    
                
                
                $member_name = $mem_sql_result['name'];
                $member_mobile = $mem_sql_result['mobile'];
                $mem_intro = $mem_sql_result['introducer_name'];
                $mem_mobile = $mem_sql_result['introducer_mobile'];
          
            ?>
            <tr>
                <td><? echo $member_name;?>     </td>
                <td><? echo $member_mobile;?>   </td>
                <td><? echo $key;?></td>
                <td><? echo $sql_result[$key];?></td>
                <td><? echo $mem_intro;?>       </td>
                <td><? echo $mem_mobile;?>      </td>
            </tr>
            

<? }
else{ ?>
   
    <tr style="background: #FBC02D;">
                <td> -- </td>
                <td> -- </td>
                <td><a class="btn btn-danger" href="<? echo get_apply_url($key,$position_id); ?>"> Apply </a></td>
                <td><? echo $sql_result[$key];?></td>
                <td> -- </td>
                <td> -- </td>
            </tr>
          
           
<? }


            
        }
        $counter++;
        $level_counter++;
        $pre_id = $val;
        
    }
}
?>