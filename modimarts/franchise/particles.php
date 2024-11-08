<? include('config.php');

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
            
            
            $get_sql = mysqli_query($con,"select count(id) as count_id from new_member where intro_id='".$val."' and id <> '".$val."' and status=1");
            $get_sql_resut = mysqli_fetch_assoc($get_sql);
            $result = $get_sql_resut['count_id'];
            
            if($result >=6){
                $total++;
            }
        }

    return $total;
    
}
?>