<? include('config.php');

$id = $_REQUEST['member_id'];

// $id = 243;



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


function get_div_by_taluka($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select* from new_taluka where id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['division'];
}


function get_dis_by_pincode($id){
    
    global $con;
    $sql = mysqli_query($con,"select * from new_pincode where id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['district'];
}


function get_tal_by_pin($id){
    global $con;
    
    $sql = mysqli_query($con,"select * from new_village where id='".$id."'");
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
        
        $sql = mysqli_query($con,"select * from new_taluka where taluka='".$position_name."'");
        $sql_result = mysqli_fetch_assoc($sql);
        $tal = $sql_result['id'];
        $dis = $sql_result['district'];
        $div = get_div_by_taluka($dis);
        $state = get_state_by_div($div);
        $zone = get_zone_by_state($state);
        
        return "apply.php?country=1&zone=$zone&state=$state&division=$div&district=$dis&taluka=$tal&pincode=0&village=0";
    }
    
    
    if($position =='pincode'){
        
        $sql = mysqli_query($con,"select * from new_pincode where pincode='".$position_name."'");
        $sql_result = mysqli_fetch_assoc($sql);
        $pin = $sql_result['id'];
        $tal = $sql_result['district'];
        $dis = get_dis_by_pincode($tal);
        $div = get_div_by_taluka($dis);
        $state = get_state_by_div($div);
        $zone = get_zone_by_state($state);
        
        return "apply.php?country=1&zone=$zone&state=$state&division=$div&district=$dis&taluka=$tal&pincode=$pin&village=0";
    }
    
    if($position =='village'){
        
        $sql = mysqli_query($con,"select * from new_village where village='".$position_name."'");
        $sql_result = mysqli_fetch_assoc($sql);
        $village = $sql_result['id'];
        $pin = $sql_result['pincode'];
        $tal = get_tal_by_pin($id);
        $dis = get_dis_by_pincode($tal);
        $div = get_div_by_taluka($dis);
        $state = get_state_by_div($div);
        $zone = get_zone_by_state($state);
        
        return "apply.php?country=1&zone=$zone&state=$state&division=$div&district=$dis&taluka=$tal&pincode=$pin&village=$village";
    }
    
    
    
    
}


if($id){
    


$sql = mysqli_query($con,"select * from new_member where id='".$id."'");
$sql_result = mysqli_fetch_assoc($sql);


$name = $sql_result['name'];
$mobile = $sql_result['mobile'];
$level_id = $sql_result['level_id'];

$myintro = get_introducer($id);


$total_pos[] = $sql_result['country'];
$total_pos[] .= $sql_result['zone'];
$total_pos[] .= $sql_result['state'];
$total_pos[] .= $sql_result['division'];
$total_pos[] .= $sql_result['district'];
$total_pos[] .= $sql_result['taluka'];
$total_pos[] .= $sql_result['pincode'];
$total_pos[] .= $sql_result['village'];



// var_dump($total_pos);






$level = get_levels_name($level_id);

$new_level_id = $level_id-1;

if($level_id > 1){
    $previous_level_id = $new_level_id-1;    
}
if($level_id<8){
$next_level_id = $level_id+1;    
}




if($level_id > 1){ ?> 
    <h3>Position Under</h3>
<table class="table table-hover table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Mobile</th>
        <th>Position</th>
        <th>Position Name</th>
        <th>Introducer Name</th>
        <th>Introducer Mobile</th>
      </tr>
    </thead>
    <tbody>
        
        <?

$cont_dec = $level_id-1;

$pos = 0;
$cont_inverse = 1;

$newdots ='';
$dots ='';
for($i=$cont_dec;$i>0;$i--){
    

$new_level_name = get_levels_name($cont_inverse);

$query  = mysqli_query($con,"select * from new_member where $new_level_name[0]='".$total_pos[$pos]."' and $new_level_name[2]='0' and status=1");


if($all_prevoius_result = mysqli_fetch_assoc($query)){ 

$newdots.= $dots;

$p_id = $all_prevoius_result['id'];
$p_name = $all_prevoius_result['name'];
$p_mobile = $all_prevoius_result['mobile'];
$p_level = $all_prevoius_result['level_id'];

$intro = get_introducer($p_id);
?>
   
    
     
      <tr>
        <td>
            <? echo '<b>'.$newdots.'</b>'.$p_name;?>
        </td>
        
        <td>
            <? echo $p_mobile;?>
        </td>
        
        <td>
           <? echo $new_level_name[0]; ?> 
        </td>
        
        <td>
            <? echo get_column_value($p_id,$new_level_name[0]); ?>
        </td>
        
        <td>
            <? echo $intro[0];?>
        </td>
        
        
        <td>
            <? echo $intro[1];?>
        </td>
        
      </tr>

  
  
    
<? 
    $dots = '-';
    
}
$cont_inverse++;
$cont_dec = $cont_dec-1;
$pos++;

}
?>
    </tbody>
  </table>


  <? } ?>
  
  
  
  
  
    <? 
    $my_mem_id = get_pre_mem($level_id,$level[0],$total_pos[$new_level_id],'id');
    ?>       
    <h3>My Information </h3>
    
<table class="table table-hover table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Mobile</th>
        <th>Position</th>
        <th>Position Name</th>
        <th>Introducer Name</th>
        <th>Introducer Mobile</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
            <? echo $name;?>
        </td>
        
        <td>
            <? echo $mobile;?>
        </td>
        
        <td>
           <? echo $level[0]; ?> 
        </td>
        <td>
            <? echo get_column_value($my_mem_id,$level[0]);?> 
        </td>
        <td>
            <? echo $myintro[0];?>
        </td>
        
        <td>
            <? echo $myintro[1];?>
        </td>
        
      </tr>
    </tbody>
  </table>
  

    <h3>Next.. </h3>
    
    <table class="table table-hover table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Mobile</th>
        <th>Position</th>
        <th>Position Name</th>
        <th>Introducer Name</th>
        <th>Introducer Mobile</th>
      </tr>
    </thead>
    <tbody>


        
<? 

if($level[2] == 'zone'){
    $level[3] ='state';
}
elseif($level[2] == 'state'){
    $level[3] = 'division';
}
elseif($level[2] == 'division'){
    $level[3] = 'district';
}
elseif($level[2] == 'district'){
    $level[3] = 'taluka';
}
elseif($level[2] == 'taluka'){
    $level[3] = 'pincode';
}
elseif($level[2] == 'pincode'){
    $level[3] = 'village';
}



























$get_dynamic_table = mysqli_query($con,"select * from new_$level[2] where $level[0]='".$total_pos[$new_level_id]."' and status=1");



while($get_dynamic_table_result = mysqli_fetch_assoc($get_dynamic_table)){
    

    if($get_dynamic_table_result[$level[2]]){
        
     $next_id =  $get_dynamic_table_result['id'];
     $next_name = $get_dynamic_table_result[$level[2]];
     
     $get_next_all_sql  = mysqli_query($con,"select * from new_member where $level[2]='".$next_id."' and level_id = '".$next_level_id."' and status=1 order by status asc");
     
     

     
     if($get_next_all_sql_result = mysqli_fetch_assoc($get_next_all_sql)){
         
        $next_member_id = $get_next_all_sql_result['id'];
        $next_member_name = $get_next_all_sql_result['name'];
        $next_member_mobile = $get_next_all_sql_result['mobile'];
        $next_member_level = $get_next_all_sql_result['level_id']; 
        $next_intro = get_introducer($next_member_id);
        ?>
        

      <tr style="font-weight:700;background: antiquewhite;">
          
        <td><? echo $next_member_name;?></td>
        <td><? echo $next_member_mobile;?></td>
        <td><? echo $level[2]; ?></td>
        <td><? echo get_column_value($next_member_id,$level[2]);?></td>
        <td><? echo $next_intro[0];?></td>
<td><? echo $next_intro[1];?></td>
      </tr> 
      
     <?

     $level_two_sql = mysqli_query($con,"select * from new_$level[3] where $level[2]='".$next_id."' and status=1");
    
      while($level_two_sql_result = mysqli_fetch_assoc($level_two_sql)){
        $next2_id =  $level_two_sql_result['id'];
        $next2_name = $level_two_sql_result[$level[3]];
        
        $level_two_member = mysqli_query($con, "select * from new_member where $level[3]='".$next2_id."' and level_id = '".($next_level_id+1)."' and status=1 order by status asc");        
        if(mysqli_num_rows($level_two_member)>0){

        while($level_two_member_result = mysqli_fetch_assoc($level_two_member)){
            
            $lv2_name = $level_two_member_result['name'];
            $lv2_mobile = $level_two_member_result['mobile'];            
            $lv2_id = $level_two_member_result['id'];
            $lv2_level = $level_two_member_result['level_id']; 
            $next_intro1 = get_introducer($lv2_id);
        ?> 
    
    
     <tr>
        <td>
             ----  <? echo $lv2_name;?>
        </td>
        
        <td>
            <? echo $lv2_mobile;?>
        </td>
        
        <td>
           <? echo $level[3]; ?> 
        </td>
        
        <td>
        <? echo get_column_value($lv2_id,$level[3]);?>     
        </td>
        
        <td><? echo $next_intro1[0];?></td>
        <td><? echo $next_intro1[1];?></td>
      </tr>
      
      
    
      <? }
        }
      else{ ?>
          
      <?

        $get_pos_name = mysqli_query($con,"select * from new_$level[3] where id ='".$next2_id."' and status=1");
        $get_pos_name_result = mysqli_fetch_assoc($get_pos_name);
          
        $pos = $get_pos_name_result[$level[3]];
          ?>
     <tr>
        <td>
             ----  
        </td>
        
        <td>
            <a class="btn btn-danger" href="<? echo get_apply_url($level[3],$pos)?>">Apply</a>
            </td>
            
        </td>
        
        <td>
           <? echo $level[3]; ?> 
        </td>
        
        <td>
        <? echo $pos; ?>     
        </td>
      </tr> 
          
      <? }
    }
}






























     else{ ?>
     
     
     
     
     
     
     
     
     
     
     
     
     
 <tr style="font-weight:700;background: aquamarine;">
        <td>----</td>
        
        <td>
            <a class="btn btn-danger" href="<? echo get_apply_url($level[2],$next_name)?>">Apply</a>
            </td>
        
        <td>
           <? echo $level[2]; ?> 
        </td>

        <td>
        <? echo $next_name;?>     
        </td>
      </tr>

     
     
     <?

     
     $pos_id = mysqli_query($con,"select * from new_$level[2] where $level[2]='".$next_name."'");
     $pos_id_result = mysqli_fetch_assoc($pos_id);
     
     $req_id = $pos_id_result['id'];
     
    //  echo "select * from new_$level[3] where $level[2]='".$req_id."' and status=1";
     $not_next_sql = mysqli_query($con,"select * from new_$level[3] where $level[2]='".$req_id."' and status=1");
     
     while($not_next_sql_result = mysqli_fetch_assoc($not_next_sql)){
         
         
         $next2_id =  $not_next_sql_result['id'];
        $next2_name = $not_next_sql_result[$level[3]];
        
        

        $level_two_member = mysqli_query($con, "select * from new_member where $level[3]='".$next2_id."' and level_id = '".($next_level_id+1)."' and status=1 order by status asc");
        if(mysqli_num_rows($level_two_member)>0){

        while($level_two_member_result = mysqli_fetch_assoc($level_two_member)){
            
            $lv2_name = $level_two_member_result['name'];
            $lv2_mobile = $level_two_member_result['mobile'];            
            $lv2_id = $level_two_member_result['id'];
            $lv2_level = $level_two_member_result['level_id']; 
            $next_intro2 = get_introducer($lv2_id);
        ?> 
    
    
     <tr>
        <td>
             ----  <? echo $lv2_name;?>
        </td>
        
        <td>
            <? echo $lv2_mobile;?>
        </td>
        
        <td>
           <? echo $level[3]; ?> 
        </td>
        
        <td>
        <? echo get_column_value($lv2_id,$level[3]);?>     
        </td>
                <td><? echo $next_intro2[0];?></td>
        <td><? echo $next_intro2[1];?></td>
      </tr>
      
      
    
      <? }
        }
      else{ ?>
          
      <?

        $get_pos_name = mysqli_query($con,"select * from new_$level[3] where id ='".$next2_id."' and status=1");
        $get_pos_name_result = mysqli_fetch_assoc($get_pos_name);
          
        $pos = $get_pos_name_result[$level[3]];
          ?>
     <tr>
        <td>
             ----  
        </td>
        
        <td>
            <a class="btn btn-danger" href="<? echo get_apply_url($level[3],$pos)?>">Apply</a>
            </td>
            
        </td>
        
        <td>
           <? echo $level[3]; ?> 
        </td>
        
        <td>
        <? echo $pos; ?>     
        </td>
      </tr> 
          
      <? } 
     } //end while 
}
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     

    }
}



?>
</tbody>
  </table>
  
  <?
}
else{
    echo 'Some Error Occure ! Please refresh the page and try again ...!';
}
  ?>
  
  
  