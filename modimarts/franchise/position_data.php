<? include('franchise/config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



function vil_count(){
    global $con ; 
    
    $sql = mysqli_query($con,"select count(id) as vil_count from new_village where status=1");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['vil_count'];
}

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


function pin_count(){
    global $con ; 
    
    $sql = mysqli_query($con,"select count(id) as pin_count from new_pincode where status=1");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['pin_count'];
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

function get_district($taluka){
    global $con; 
    
    $sql = mysqli_query($con,"select * from new_taluka where id='".$taluka."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['district'];
}

function get_taluka($pincode){
    global $con; 
    
    $sql = mysqli_query($con,"select * from new_pincode where id='".$pincode."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['taluka'];
}


function zone_cal(){
    
    global $con;
    
    $sql  = mysqli_query($con, "select count(*) as zone_count from new_member where zone in(select id from new_zone) and status = 1 and state = 0");

    $sql_result = mysqli_fetch_assoc($sql);

    $zone_count = $sql_result['zone_count'];
 
    $result = [zone_count(),$zone_count];
    return $result;
    
}


function state_cal(){
    
    global $con;
    
    $sql  = mysqli_query($con, "select count(*) as state_count from new_member where state in(select id from new_state) and status = 1 and division = 0");

    $sql_result = mysqli_fetch_assoc($sql);

    $state_count = $sql_result['state_count'];
 
    $result = [state_count(),$state_count];
    return $result;
    
}



function div_cal(){
    
    global $con;
    
    $sql  = mysqli_query($con, "select count(*) as div_count from new_member where division in(select id from new_division) and status = 1 and district = 0");

    $sql_result = mysqli_fetch_assoc($sql);

    $div_count = $sql_result['div_count'];
 
    $result = [division_count(),$div_count];
    return $result;
    
}



function district_cal(){
    
    global $con;
    
    $sql  = mysqli_query($con, "select count(*) as dis_count from new_member where district in(select id from new_district) and status = 1 and taluka = 0");

    $sql_result = mysqli_fetch_assoc($sql);

    $dis_count = $sql_result['dis_count'];
 
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
    
    $sql  = mysqli_query($con, "select count(*) as tal_count from new_member where taluka in(select id from new_taluka) and status = 1 and pincode = 0");

    $sql_result = mysqli_fetch_assoc($sql);

    $tal_count = $sql_result['tal_count'];
 
    $result = [tal_count(),$tal_count];
    return $result;
    
}






function pincode_cal(){
    
    global $con;
    
    $sql  = mysqli_query($con, "select count(*) as pin_count from new_member where pincode in(select id from new_pincode) and status = 1 and village = 0");

    $sql_result = mysqli_fetch_assoc($sql);

    $pin_count = $sql_result['pin_count'];
 
    $result = [pin_count(),$pin_count];
    return $result;
    
}


function village_cal(){
    global $con;
    
    $sql  = mysqli_query($con, "select count(*) as vil_count from new_member where village not in('0','') and status = 1");

    $sql_result = mysqli_fetch_assoc($sql);

    $vil_count = $sql_result['vil_count'];
 
    $result = [vil_count(),$vil_count];
    return $result;

}


// function total_qualify($id){
//     global $con;
    
//     $sql = mysqli_query($con,"select * from new_member where intro_id='".$id."' and status=1 and id <> '".$id."'");
//     $qualify = 0;
//     while($sql_result = mysqli_fetch_assoc($sql)){
        
        
//         $id_array[] = $sql_result['id'];
//         $intro_to_id = $sql_result['id'];
        
//         // echo "select count(id) as check_mem from new_member where intro_id='".$intro_to_id."' and status=1 and id<> '".$intro_to_id."'";
        
//         $check_sql = mysqli_query($con,"select count(id) as check_mem from new_member where intro_id='".$intro_to_id."' and status=1 and id<> '".$intro_to_id."'");
        
//         $check_sql_result = mysqli_fetch_assoc($check_sql);
        
//         if($check_sql_result['check_mem'] >= 6){
//             $qualify++;
//         }
//     }


//         if($qualify){
//             return 1;
//         }
//         else{
//         return 0;    
//         }

// }


// function country_qualified(){
//     global $con;

//     $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone = '0' and status=1");
//     while($sql_result = mysqli_fetch_assoc($sql) ){
//         $id[] = $sql_result['id'];
//     }

//     $total = 0;
//     foreach($id as $key=>$val){
//         $total = $total + total_qualify($val);
//     }
//     return $total;
// }


// function zone_qualified(){
//     global $con;

//     $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state = 0 and status=1");
    
//     while($sql_result = mysqli_fetch_assoc($sql) ){
        
//         $id[] = $sql_result['id'];
//     }
    
//     $total = 0;
//     foreach($id as $key=>$val){
//         $total = $total + total_qualify($val);
//     }
//     return $total;
// }

// function state_qualified(){
//     global $con;

//     $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state <> '0' and division = 0 and status=1");
    
//     while($sql_result = mysqli_fetch_assoc($sql) ){
        
//         $id[] = $sql_result['id'];
//     }
    
//     $total = 0;
//     foreach($id as $key=>$val){
//         $total = $total + total_qualify($val);
//     }
//     return $total;
// }

// function division_qualified(){
//     global $con;

//     $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state <> '0' and division <> '0' and district=0 and status=1");
    
//     while($sql_result = mysqli_fetch_assoc($sql) ){
        
//         $id[] = $sql_result['id'];
//     }
    
//     $total = 0;
//     foreach($id as $key=>$val){
//         $total = $total + total_qualify($val);
//     }
//     return $total;
// }

// function district_qualified(){
//     global $con;

//     $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state <> '0' and division <> '0' and district <> '0' and taluka= 0 and status=1");
    
//     while($sql_result = mysqli_fetch_assoc($sql) ){
        
//         $id[] = $sql_result['id'];
//     }
    
//     $total = 0;
//     foreach($id as $key=>$val){
//         $total = $total + total_qualify($val);
//     }
//     return $total;
// }

// function taluka_qualified(){
//     global $con;

//     $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state <> '0' and division <> '0' and district <> '0' and taluka  <> '0' and pincode = 0   and status=1");
    
//     while($sql_result = mysqli_fetch_assoc($sql) ){
        
//         $id[] = $sql_result['id'];
//     }
    
//     $total = 0;
//     foreach($id as $key=>$val){
//         $total = $total + total_qualify($val);
//     }
//     return $total;
// }



// function pincode_qualified(){
//     global $con;

//     $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state <> '0' and division <> '0' and district <> '0' and taluka <> 0 and pincode <> '0' and village =0  and status=1");
    
//     while($sql_result = mysqli_fetch_assoc($sql) ){
        
//         $id[] = $sql_result['id'];
//     }
    
//     $total = 0;
//     foreach($id as $key=>$val){
//         $total = $total + total_qualify($val);
//     }
//     return $total;
// }

// function village_qualified(){
//     global $con;

//     $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state <> '0' and division <> '0' and district <> '0' and taluka <> 0 and pincode <> '0' and village <> '0' and status=1");
    
//     while($sql_result = mysqli_fetch_assoc($sql) ){
        
//         $id[] = $sql_result['id'];
//     }
    
//     $total = 0;
//     foreach($id as $key=>$val){
//         $total = $total + total_qualify($val);
//     }
//     return $total;
// }




function country_qualified(){
    global $con;
    
    $total = 0 ;
    $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone = '0' and status=1");
        while($sql_result = mysqli_fetch_assoc($sql) ){
            $id[] = $sql_result['id'];
        }
        
        foreach($id as $key =>$val){
            
            $get_sql = mysqli_query($con,"select count(id) as count_id from new_member where intro_id='".$val."' and id <> '".$val."' and status=1");
            $get_sql_resut = mysqli_fetch_assoc($get_sql);
            $result = $get_sql_resut['count_id'];
            
            if($result >=6){
                $total++;
            }
        }

    return $total;
}




function zone_qualified(){
    global $con;
    
    $total = 0 ;
    $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state = 0 and status=1");
        while($sql_result = mysqli_fetch_assoc($sql) ){
            $id[] = $sql_result['id'];
        }
        
        foreach($id as $key =>$val){
            
            $get_sql = mysqli_query($con,"select count(id) as count_id from new_member where intro_id='".$val."' and id <> '".$val."' and status=1");
            $get_sql_resut = mysqli_fetch_assoc($get_sql);
            $result = $get_sql_resut['count_id'];
            
            if($result >=6){
                $total++;
            }
        }

    return $total;
}


function state_qualified(){
    global $con;
    
    $total = 0 ;
    $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state <> '0' and division = 0 and status=1");
        while($sql_result = mysqli_fetch_assoc($sql) ){
            $id[] = $sql_result['id'];
        }
        
        foreach($id as $key =>$val){
            
            $get_sql = mysqli_query($con,"select count(id) as count_id from new_member where intro_id='".$val."' and id <> '".$val."' and status=1");
            $get_sql_resut = mysqli_fetch_assoc($get_sql);
            $result = $get_sql_resut['count_id'];
            
            if($result >=6){
                $total++;
            }
        }

    return $total;
}


function division_qualified(){
    global $con;
    
    $total = 0 ;
    $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state <> '0' and division <> '0' and district=0 and status=1");
        while($sql_result = mysqli_fetch_assoc($sql) ){
            $id[] = $sql_result['id'];
        }
        
        foreach($id as $key =>$val){
            
            $get_sql = mysqli_query($con,"select count(id) as count_id from new_member where intro_id='".$val."' and id <> '".$val."' and status=1");
            $get_sql_resut = mysqli_fetch_assoc($get_sql);
            $result = $get_sql_resut['count_id'];
            
            if($result >=6){
                $total++;
            }
        }

    return $total;
}


function district_qualified(){
    global $con;
    
    $total = 0 ;
    $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state <> '0' and division <> '0' and district <> '0' and taluka= 0 and status=1");
        while($sql_result = mysqli_fetch_assoc($sql) ){
            $id[] = $sql_result['id'];
        }
        
        foreach($id as $key =>$val){
            
            $get_sql = mysqli_query($con,"select count(id) as count_id from new_member where intro_id='".$val."' and id <> '".$val."' and status=1");
            $get_sql_resut = mysqli_fetch_assoc($get_sql);
            $result = $get_sql_resut['count_id'];
            
            if($result >=6){
                $total++;
            }
        }

    return $total;
}


function taluka_qualified(){
    global $con;
    
    $total = 0 ;
    $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state <> '0' and division <> '0' and district <> '0' and taluka  <> '0' and pincode = 0   and status=1");
        while($sql_result = mysqli_fetch_assoc($sql) ){
            $id[] = $sql_result['id'];
        }
        
        foreach($id as $key =>$val){
            
            $get_sql = mysqli_query($con,"select count(id) as count_id from new_member where intro_id='".$val."' and id <> '".$val."' and status=1");
            $get_sql_resut = mysqli_fetch_assoc($get_sql);
            $result = $get_sql_resut['count_id'];
            
            if($result >=6){
                $total++;
            }
        }

    return $total;
}




function pincode_qualified(){
    global $con;


    $total = 0 ;
    
    $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state <> '0' and division <> '0' and district <> '0' and taluka <> 0 and pincode <> '0' and village =0  and status=1");
    
    while($sql_result = mysqli_fetch_assoc($sql) ){
        
        $id[] = $sql_result['id'];
    }
    
   foreach($id as $key =>$val){
            
            $get_sql = mysqli_query($con,"select count(id) as count_id from new_member where intro_id='".$val."' and id <> '".$val."' and status=1");
            $get_sql_resut = mysqli_fetch_assoc($get_sql);
            $result = $get_sql_resut['count_id'];
            
            if($result >=6){
                $total++;
            }
        }

    return $total;
    
}



function village_qualified(){
    global $con;

    $total = 0 ;
    
    $sql = mysqli_query( $con ,"select * from new_member where country <> '0' and zone <> '0' and state <> '0' and division <> '0' and district <> '0' and taluka <> 0 and pincode <> '0' and village <> '0' and status=1");
    
    while($sql_result = mysqli_fetch_assoc($sql) ){
        
        $id[] = $sql_result['id'];
    }
    
    
        foreach($id as $key =>$val){
            
            
            echo "select count(id) as count_id from new_member where intro_id='".$val."' and id <> '".$val."' and status=1;";
            echo '<br>';
            $get_sql = mysqli_query($con,"select count(id) as count_id from new_member where intro_id='".$val."' and id <> '".$val."' and status=1");
            $get_sql_resut = mysqli_fetch_assoc($get_sql);
            $result = $get_sql_resut['count_id'];
            
            if($result >=6){
                $total++;
            }
        }

    return $total;
    
}

echo village_qualified();

    $zone = zone_cal();
    $state    = state_cal();
    $division = div_cal();
    $district = district_cal();
    $taluka = taluka_cal();
    $pincode = pincode_cal();
    $village = village_cal();
    
    $country_qualified= country_qualified();
$zone_qualified = zone_qualified();
$state_qualified = state_qualified();
$division_qualified = division_qualified();
$district_qualified = district_qualified();
$taluka_qualified = taluka_qualified();
$pincode_qualified = pincode_qualified();
$village_qualified = village_qualified();


return;

?>



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        
        
<table class="table table-bordered table-new">
                                          <thead>
                                            <tr>
                                              <th scope="col"> </th>
                                              <th scope="col">Total Position</th>
                                              <th scope="col">Position Given</th>
                                              <th scope="col">Qualified</th>
                                              <th scope="col">Available</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th scope="row">India</th>
                                              <td class="total_pos">1</td>
                                              <td class="given_pos"> 1</td>
                                              <td class="available_pos">
                                                  <? echo $country_qualified;?>
                                                </td>
                                              <td>0</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Zone</th>
                                              <td class="total_pos"><? echo $zone[0];?></td>
                                              <td class="given_pos"><? echo $zone[1];?></td>
                                              <td>
                                                                                  <? echo $zone_qualified;?>
                                              </td>
                                              <td  class="available_pos"><? echo $zone[0] - $zone[1];?></td>
                                            </tr>
                                            
                                            <tr>
                                          <th scope="row">State</th>          
                                          <td class="total_pos"><? echo $state[0];?></td>
                                              <td class="given_pos"><? echo $state[1];?></td>
                                              
                                              <td>
                                                  <? echo $state_qualified;?>
                                              </td>
                                              <td class="available_pos"><? echo $state[0]-$state[1];?></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                              <th scope="row">Division</th>
                                                                                      <td class="total_pos"><? echo $division[0];?></td>
                                              <td class="given_pos"><? echo $division[1];?></td>
                                              <td>
                                                  <? echo $division_qualified;?>
                                              </td>
                                              <td  class="available_pos"><? echo $division[0]-$division[1];?></td>
                                              
                                            </tr>
                                            <tr>
                                              <th scope="row">District</th>
                                              <td class="total_pos"><? echo $district[0];?></td>
                                              <td class="given_pos"><? echo $district[1];?></td>
                                              <td>
                                                  <? echo $district_qualified;?>
                                              </td>
                                              <td  class="available_pos"><? echo $district[0]-$district[1];?></td>
                                              
                                            </tr>
                                            <tr>
                                              <th scope="row">Taluka</th>
                                              <td class="total_pos"><? echo $taluka[0];?></td>
                                              <td class="given_pos"><? echo $taluka[1];?></td>
                                              <td>
                                                                                          <? echo $taluka_qualified;?>
                                              </td>
                                              <td  class="available_pos"><? echo $taluka[0]-$taluka[1];?></td>
                                              
                                            </tr><tr>
                                              <th scope="row">Pincode</th>
                                              <td class="total_pos"><? echo $pincode[0];?></td>
                                              <td class="given_pos"><? echo $pincode[1];?></td>
                                              <td>
                                                  <? echo $pincode_qualified;?>
                                              </td>
                                              <td  class="available_pos"><? echo $pincode[0] - $pincode[1] ;?></td>
                                            </tr><tr>
                                              <th scope="row">Village</th>
                                              <td class="total_pos"><? echo $village[0];?></td>
                                              <td class="given_pos"><? echo $village[1];?></td>
                                              <td>
                                                  <? echo $village_qualified;?>
                                              </td>
                                              <td  class="available_pos"><? echo $village[0] -  $village[1];?></td>
                                            </tr><tr>
                                              <th scope="row">Total</th>
                                              <td class="total"></td>
                                              <td class="given"></td>
                                              <td></td>
                                              <td class="available"></td>
                                            </tr>
                                          </tbody>
                                        </table>