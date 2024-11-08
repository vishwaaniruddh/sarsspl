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
        $zone_name[] = $get_zone_result['zone'];
        $count=count($zone_id);
    }
    
 //   $all_zone_id = json_encode($zone_id);
 //   $all_zone_id=str_replace( array('[',']','"') , ''  , $all_zone_id);
    
    

 //   $sql = "select * from new_member where country='".$country."' and zone in ($all_zone_id) and level_id='".$new_id."'";
}


if($level_id ==2){
    
    $new_id = $level_id+1;
    $get_state = mysqli_query($con,"select * from new_state where zone='".$zone."'");
    while($get_state_result = mysqli_fetch_assoc($get_state)){
        $state_id[] = $get_state_result['id'];
        $state_name[] = $get_state_result['state'];
        $count=count($state_id);
    }
    
 //   $all_state_id = json_encode($state_id);
 //   $all_state_id=str_replace( array('[',']','"') , ''  , $all_state_id);
    
    

//    $sql = "select * from new_member where country='".$country."' and zone='".$zone."' and state in ($all_state_id) and level_id='".$new_id."'";
    
 //   echo $sql;
}


if($level_id ==3){
    
    $new_id = $level_id+1;
    $get_div = mysqli_query($con,"select * from new_division where state='".$state."'");
    while($get_div_result = mysqli_fetch_assoc($get_div)){
        $div_id[] = $get_div_result['id'];
        $div_name[] = $get_div_result['division'];
        $count=count($div_id);
    }
    
 //   $all_div_id = json_encode($div_id);
 //   $all_div_id=str_replace( array('[',']','"') , ''  , $all_div_id);
    
    


 //   $sql = "select * from new_member where country='".$country."' and zone='".$zone."' and state='".$state."' and division in ($all_div_id) and level_id='".$new_id."'";

}



if($level_id ==4){
    
    $new_id = $level_id+1;
    $get_dis = mysqli_query($con,"select * from new_district where division='".$division."'");
    while($get_dis_result = mysqli_fetch_assoc($get_dis)){
        $dis_id[] = $get_dis_result['id'];
        $dis_name[] = $get_dis_result['district'];
        $count=count($dis_id);
    }
    
 //   $all_dis_id = json_encode($dis_id);
 //   $all_dis_id=str_replace( array('[',']','"') , ''  , $all_dis_id);
    
    

 //   $sql = "select * from new_member where country='".$country."' and zone='".$zone."' and state='".$state."' and division = '".$division."' and district in ($all_dis_id) and level_id='".$new_id."'";
}

if($level_id ==5){
    
    $new_id = $level_id+1;
    $get_tal = mysqli_query($con,"select * from new_taluka where district='".$district."'");
    while($get_tal_result = mysqli_fetch_assoc($get_tal)){
        $tal_id[] = $get_tal_result['id'];
        $tal_name[] = $get_tal_result['taluka'];
        $count=count($tal_id);
    }
    
 //   $all_dis_id = json_encode($dis_id);
 //   $all_dis_id=str_replace( array('[',']','"') , ''  , $all_dis_id);
    
    

 //   $sql = "select * from new_member where country='".$country."' and zone='".$zone."' and state='".$state."' and division = '".$division."' and district in ($all_dis_id) and level_id='".$new_id."'";
}

if($level_id ==6){
    
    $new_id = $level_id+1;
    $get_pin = mysqli_query($con,"select * from new_pincode where taluka='".$taluka."'");
    while($get_pin_result = mysqli_fetch_assoc($get_pin)){
        $pin_id[] = $get_pin_result['id'];
        $pin_name[] = $get_pin_result['pincode'];
        $count=count($pin_id);
    }
    
 //   $all_dis_id = json_encode($dis_id);
 //   $all_dis_id=str_replace( array('[',']','"') , ''  , $all_dis_id);
    
    

 //   $sql = "select * from new_member where country='".$country."' and zone='".$zone."' and state='".$state."' and division = '".$division."' and district in ($all_dis_id) and level_id='".$new_id."'";
}

if($level_id ==7){
    
    $new_id = $level_id+1;
    $get_vil = mysqli_query($con,"select * from new_village where pincode='".$pincode."'");
    while($get_vil_result = mysqli_fetch_assoc($get_vil)){
        $vil_id[] = $get_vil_result['id'];
        $vil_name[] = $get_vil_result['village'];
        $count=count($vil_id);
    }
    
 //   $all_dis_id = json_encode($dis_id);
 //   $all_dis_id=str_replace( array('[',']','"') , ''  , $all_dis_id);
    
    

 //   $sql = "select * from new_member where country='".$country."' and zone='".$zone."' and state='".$state."' and division = '".$division."' and district in ($all_dis_id) and level_id='".$new_id."'";
}



//echo $count."hh";


//$query = mysqli_query($con,$sql);

$i=0;

//$array = explode (",", $all_state_id);

while($i < $count ){
    
//$state = $sql_result['state'];
?>
    <div class='row'>
    <?php
     if(($level_id ==1)){ 
    $sql='select * from new_member where zone='.$zone_id[$i].' and level_id=2 and status=1';
    //echo $sql;
    $query = mysqli_query($con,$sql);
    $sql_result=mysqli_fetch_array($query);
    if($sql_result){
        $name=$sql_result['name'];
        $mobile=$sql_result['mobile'];
    }
    else{
        $name='Not Occupied';
        $mobile='';
    }
    ?>
    <div class='col-md-3'><?php echo $zone_name[$i]; ?></div>
    
    <div class='col-md-3'><?php echo $name; ?></div>
    <div class='col-md-3'><?php echo $mobile; ?></div>
    <?php } ?>
    <?php
     if(($level_id ==2)){ 
    $sql='select * from new_member where state='.$state_id[$i].' and level_id=3 and status=1';
    //echo $sql;
    $query = mysqli_query($con,$sql);
    $sql_result=mysqli_fetch_array($query);
    if($sql_result){
        $name=$sql_result['name'];
        $mobile=$sql_result['mobile'];
    }
    else{
        $name='Not Occupied';
        $mobile='';
    }
    ?>
    <div class='col-md-3'><?php echo $state_name[$i]; ?></div>
    
    <div class='col-md-3'><?php echo $name; ?></div>
    <div class='col-md-3'><?php echo $mobile; ?></div>
    <?php } ?>
    <?php
     if(($level_id ==3)){ 
    $sql='select * from new_member where division='.$div_id[$i].' and level_id=4 and status=1';
    //echo $sql;
    $query = mysqli_query($con,$sql);
    $sql_result=mysqli_fetch_array($query);
    if($sql_result){
        $name=$sql_result['name'];
        $mobile=$sql_result['mobile'];
    }
    else{
        $name='Not Occupied';
        $mobile='';
    }
    ?>
    <div class='col-md-3'><?php echo $div_name[$i]; ?></div>
    
    <div class='col-md-3'><?php echo $name; ?></div>
    <div class='col-md-3'><?php echo $mobile; ?></div>
    <?php } ?>
    <?php
     if(($level_id ==4)){ 
    $sql='select * from new_member where district='.$dis_id[$i].' and level_id=5 and status=1';
    //echo $sql;
    $query = mysqli_query($con,$sql);
    $sql_result=mysqli_fetch_array($query);
    if($sql_result){
        $name=$sql_result['name'];
        $mobile=$sql_result['mobile'];
    }
    else{
        $name='Not Occupied';
        $mobile='';
    }
    ?>
    <div class='col-md-3'><?php echo $dis_name[$i]; ?></div>
    
    <div class='col-md-3'><?php echo $name; ?></div>
    <div class='col-md-3'><?php echo $mobile; ?></div>
    <?php } ?>
    <?php
     if(($level_id ==5)){ 
    $sql='select * from new_member where taluka='.$tal_id[$i].' and level_id=6 and status=1';
    //echo $sql;
    $query = mysqli_query($con,$sql);
    $sql_result=mysqli_fetch_array($query);
    if($sql_result){
        $name=$sql_result['name'];
        $mobile=$sql_result['mobile'];
    }
    else{
        $name='Not Occupied';
        $mobile='';
    }
    ?>
    <div class='col-md-3'><?php echo $tal_name[$i]; ?></div>
    
    <div class='col-md-3'><?php echo $name; ?></div>
    <div class='col-md-3'><?php echo $mobile; ?></div>
    <?php } ?>
    <?php
     if(($level_id ==6)){ 
    $sql='select * from new_member where pincode='.$pin_id[$i].' and level_id=7 and status=1';
    //echo $sql;
    $query = mysqli_query($con,$sql);
    $sql_result=mysqli_fetch_array($query);
    if($sql_result){
        $name=$sql_result['name'];
        $mobile=$sql_result['mobile'];
    }
    else{
        $name='Not Occupied';
        $mobile='';
    }
    ?>
    <div class='col-md-3'><?php echo $pin_name[$i]; ?></div>
    
    <div class='col-md-3'><?php echo $name; ?></div>
    <div class='col-md-3'><?php echo $mobile; ?></div>
    <?php } ?>
    <?php
     if(($level_id ==7)){ 
    $sql='select * from new_member where village='.$vil_id[$i].' and level_id=8 and status=1';
    //echo $sql;
    $query = mysqli_query($con,$sql);
    $sql_result=mysqli_fetch_array($query);
    if($sql_result){
        $name=$sql_result['name'];
        $mobile=$sql_result['mobile'];
    }
    else{
        $name='Not Occupied';
        $mobile='';
    }
    ?>
    <div class='col-md-3'><?php echo $vil_name[$i]; ?></div>
    
    <div class='col-md-3'><?php echo $name; ?></div>
    <div class='col-md-3'><?php echo $mobile; ?></div>
    <?php } ?>
    <!--<div class='col-md-3' id='is_apply'></div>-->
    
    </div>
    <?php
  //  $status = $sql_result['status'];
    
//    if($status == 1){
        
  //  echo 'apply';
    ?>
    <script>
        $("#is_apply").html('<a href="apply.php" class="btn btn-danger">Apply</a>');
    </script>
<?  //}  
$i++;
}
?>

