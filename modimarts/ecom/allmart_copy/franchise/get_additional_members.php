    <script src="plugins/jquery/jquery.min.js"></script>
<? include('config.php');

$country = $_POST['country'];
$country = 1;
$zone = $_POST['zone'];
$state = $_POST['state'];
$division = $_POST['division'];
$district = $_POST['district'];
$taluka = $_POST['taluka'];
$pincode = $_POST['pincode'];
$village = $_POST['village'];
        
        

$level_id = 1;

if($zone == ''){
    $zone = 0;
}
else{
    $level_id = 2;
}

if($state == ''){
    $state = 0;
} 
else{
    $level_id = 3;
}

if($division == ''){
    $division = 0;
} 
else{
    $level_id = 4;
}


if($district == ''){
    $district = 0;
} 
else{
    $level_id = 5;
}


if($taluka == ''){
    $taluka = 0;
} 
else{
    $level_id = 6;
}

if($pincode == ''){
    $pincode = 0;
} 
else{
    $level_id = 7;
}


if($village == ''){
    $village = 0;
}else{
    $level_id = 8;
}




if($level_id ==1){
    
    $new_id = $level_id+1;
    $get_zone = mysqli_query($con,"select * from new_zone where country='".$country."'");
    while($get_zone_result = mysqli_fetch_assoc($get_zone)){
        $zone_id[] = $get_zone_result['id'];
    }
    
    $all_zone_id = json_encode($zone_id);
    $all_zone_id=str_replace( array('[',']','"') , ''  , $all_zone_id);
    
    

    $sql = "select * from new_member where country='".$country."' and zone in ($all_zone_id) and level_id='".$new_id."'";
}


if($level_id ==2){
    
    $new_id = $level_id+1;
    $get_state = mysqli_query($con,"select * from new_state where zone='".$zone."'");
    while($get_state_result = mysqli_fetch_assoc($get_state)){
        $state_id[] = $get_state_result['id'];
    }
    
    $all_state_id = json_encode($state_id);
    $all_state_id=str_replace( array('[',']','"') , ''  , $all_state_id);
    
    

    $sql = "select * from new_member where country='".$country."' and zone='".$zone."' and state in ($all_state_id) and level_id='".$new_id."'";
    
    echo $sql;
}


if($level_id ==3){
    
    $new_id = $level_id+1;
    $get_div = mysqli_query($con,"select * from new_division where state='".$state."'");
    while($get_div_result = mysqli_fetch_assoc($get_div)){
        $div_id[] = $get_div_result['id'];
    }
    
    $all_div_id = json_encode($div_id);
    $all_div_id=str_replace( array('[',']','"') , ''  , $all_div_id);
    
    


    $sql = "select * from new_member where country='".$country."' and zone='".$zone."' and state='".$state."' and division in ($all_div_id) and level_id='".$new_id."'";

}



if($level_id ==4){
    
    $new_id = $level_id+1;
    $get_dis = mysqli_query($con,"select * from new_district where division='".$division."'");
    while($get_dis_result = mysqli_fetch_assoc($get_dis)){
        $dis_id[] = $get_dis_result['id'];
    }
    
    $all_dis_id = json_encode($dis_id);
    $all_dis_id=str_replace( array('[',']','"') , ''  , $all_dis_id);
    
    

    $sql = "select * from new_member where country='".$country."' and zone='".$zone."' and state='".$state."' and division = '".$division."' and district in ($all_dis_id) and level_id='".$new_id."'";
}







$query = mysqli_query($con,$sql);



$array = explode (",", $all_state_id);

while($sql_result = mysqli_fetch_assoc($query)){
    
$state = $sql_result['state'];

    echo "<div class='row'>
    <div class='col-md-3'> ".$sql_result['name']."</div>
    <div class='col-md-3'> ".$sql_result['mobile']."</div>
    <div class='col-md-3'> ".$state."</div>
    <div class='col-md-3' id='is_apply'></div>
    
    </div>";
    $status = $sql_result['status'];
    
    if($status == 1){
        
    echo 'apply';
    ?>
    <script>
        $("#is_apply").html('<a href="apply.php" class="btn btn-danger">Apply</a>');
    </script>
<?  }  }
?>

