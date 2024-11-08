<? include('../config.php');
 include('../../config.php');
 
 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function get_promotionid($name){
    global $con1;
    
    $sql = mysqli_query($con1,"select * from promotions where promotion like '".$name."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['id'];
}



function commission($txn_id,$commision,$mem,$date,$promotion){
    
    global $con;
    global $con1;
    
$distribut_amount = $commision;

$member_sql = mysqli_query($con,"select * from new_member where id='".$mem."' and status=1");
$member_sql_result = mysqli_fetch_assoc($member_sql);

$pos_name = $member_sql_result['star'];
$member_level = $member_sql_result['level_id'];

$village = $member_sql_result['village'];
$pincode = $member_sql_result['pincode'];
$taluka = $member_sql_result['taluka'];
$district = $member_sql_result['district'];
$division = $member_sql_result['division'];
$state = $member_sql_result['state'];
$zone = $member_sql_result['zone'];
$country = $member_sql_result['country'];


if($village > 0 ){
    $vil_sql = mysqli_query($con,"select * from new_member where village='".$village."' and status=1");
    $vil_sql_result = mysqli_fetch_assoc($vil_sql);
    $vil_mem = $vil_sql_result['id'];
    
    if($vil_mem){
        $vil_amount = round($distribut_amount /2 ,5);
        $actual_amount = $vil_amount;

        // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','village".$vil_mem."','".$vil_amount."','1','".$promotion."','".$date."')";
        // echo '<br>';
          mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$vil_mem."','".$vil_amount."','1','".$promotion."','".$date."')");
    }
    else{
        $actual_amount = $distribut_amount;
    }      

}
else{
        $vil_amount = $distribut_amount;
        $actual_amount = $distribut_amount;
        $vil_mem = 0;
}



if($pincode > 0){
    
$pin_sql = mysqli_query($con,"select * from new_member where pincode='".$pincode."' and village=0 and status=1");
$pin_sql_result = mysqli_fetch_assoc($pin_sql);
$pin_mem = $pin_sql_result['id'];
    
    if($pin_mem){
        
       $pin_amount =  round($vil_amount /2 ,5) ;       
      $actual_amount = $pin_amount;
        // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','pincode".$pin_mem."','".$pin_amount."','1','".$promotion."','".$date."')";
        // echo '<br>';
          mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$pin_mem."','".$pin_amount."','1','".$promotion."','".$date."')");
    }
    else{
         $pin_amount =  $actual_amount ;
    }

}
else{
$pin_amount = $distribut_amount ;
    // $pin_amount =  round($actual_amount /2 ,5) ;
    $actual_amount = $distribut_amount;
    $pin_mem = 0;
}



// return;
if($taluka > 0){
    $tal_sql = mysqli_query($con,"select * from new_member where taluka='".$taluka."' and pincode=0 and status=1");
    $tal_sql_result = mysqli_fetch_assoc($tal_sql);
    $tal_mem = $tal_sql_result['id'];
    
    if($tal_mem){
        $tal_amount = round($pin_amount /2,5) ;
        $actual_amount = $tal_amount;
        
        // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','taluka".$tal_mem."','".$tal_amount."','1','".$promotion."','".$date."')";
        // echo '<br>';
          mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$tal_mem."','".$tal_amount."','1','".$promotion."','".$date."')");
    }
    else{
        $tal_amount = $actual_amount  ;
    }


}
else{
    $tal_amount=$distribut_amount;
    $actual_amount = $distribut_amount;
    $tal_mem = 0;
}

if($district > 0){
$dis_sql = mysqli_query($con,"select * from new_member where district='".$district."' and taluka=0 and status=1");
$dis_sql_result = mysqli_fetch_assoc($dis_sql);
$dis_mem = $dis_sql_result['id'];

    if($dis_mem){
        $dis_amount = round($tal_amount /2,5) ;   
        $actual_amount = $dis_amount;
        // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$dis_mem."','".$dis_amount."','1','".$promotion."','".$date."')";
        // echo '<br>';
          mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$dis_mem."','".$dis_amount."','1','".$promotion."','".$date."')");
        
    }
    else{
            $dis_amount = $actual_amount ;
    }
    
}
else{
    $dis_amount=$distribut_amount;
    $actual_amount = $distribut_amount;
    $dis_mem = 0;
}
    


if($division > 0){
$div_sql = mysqli_query($con,"select * from new_member where division='".$division."' and district=0 and status=1");
$div_sql_result = mysqli_fetch_assoc($div_sql);
$div_mem = $div_sql_result['id'];   
    
    if( $div_mem){
        $div_amount = round($dis_amount /2,5) ;
        $actual_amount = $div_amount; 

        // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$div_mem."','".$div_amount."','1','".$promotion."','".$date."')";    
        // echo '<br>';
        
          mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$div_mem."','".$div_amount."','1','".$promotion."','".$date."')");

    }
    else{
        $div_amount = $actual_amount ;
    }


    
}
else{
        $div_amount = $distribut_amount ;
        $actual_amount = $distribut_amount;
        $div_mem = 0 ;
}





if($state > 0 ){
    
    // echo '$div_amount'.$div_amount;
    
$state_sql = mysqli_query($con,"select * from new_member where state='".$state."' and division=0 and status=1");
$state_sql_result = mysqli_fetch_assoc($state_sql);
$state_mem = $state_sql_result['id'];   
    
    if($state_mem){
        $state_amount = round($div_amount /2,5) ;  
        $actual_amount = $state_amount;
        
        // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$state_mem."','".$state_amount."','1','".$promotion."','".$date."')";
        // echo '<br>';
          mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$state_mem."','".$state_amount."','1','".$promotion."','".$date."')");
    }
    else{
        $state_amount = $actual_amount  ;   
    }   
    

}
else{
        $state_amount = $distribut_amount ;
        $actual_amount = $distribut_amount;
        $state_mem = 0 ;
}




if($zone > 0){
    $zone_sql = mysqli_query($con,"select * from new_member where zone='".$zone."' and state=0 and status=1");
    $zone_sql_result = mysqli_fetch_assoc($zone_sql);
    $zone_mem = $zone_sql_result['id'];
    
    if($zone_mem){
            $zone_amount = round($state_amount /2,5) ;
            $actual_amount = $zone_amount;
            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$zone_mem."','".$zone_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
              mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$zone_mem."','".$zone_amount."','1','".$promotion."','".$date."')"); 
    }
    else{
         $zone_amount = $actual_amount ;
    }
    

}
else{
    $zone_amount = $distribut_amount ;
    $actual_amount = $distribut_amount;
    $zone_mem = 0;
}




if($country > 0){
    $country_sql = mysqli_query($con,"select * from new_member where country='".$country."' and zone=0 and status=1");
    $country_sql_result = mysqli_fetch_assoc($country_sql);
    $country_mem = $country_sql_result['id'];    
    
    if($country_mem){
        $country_amount = round($zone_amount/2,5);
        $sar_amount = round($zone_amount/2,5);
        // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$country_mem."','".$country_amount."','1','".$promotion."','".$date."')";
        // echo '<br>';
          mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$country_mem."','".$country_amount."','1','".$promotion."','".$date."')");
    }
    else{
        $country_amount = $actual_amount;
        $sar_amount = $actual_amount;
    }

}


// Sar Commission 

// echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','SAR','".$sar_amount."','1','".$promotion."','".$date."')";

  mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','SAR','".$sar_amount."','1','".$promotion."','".$date."')");
}





$sql1 = mysqli_query($con1,"select txn_id from commission order by id desc");
$sql_result1 = mysqli_fetch_assoc($sql1);

$txnid = $sql_result1['txn_id'];
$txnid = preg_replace('/[^0-9]/', '', $txnid);
$txnid = $txnid+1 ;
$txn_id = 'txn-'.$txnid;



$date = $_POST['date'];
$date = date("Y-m-d", strtotime($date) );
$commision = $_POST['amount'];
$mem       = $_POST['member'];

$promotion = $_POST['promotion'];
$date = date("Y-m-d", strtotime($date) );



if($commision > 0 && $date && $txn_id && $mem && $promotion){
    mysqli_query($con1,"insert into commission(txn_id,amount,status,promotion,created_at) values('".$txn_id."','".$commision."','1','".$promotion."','".$date."')");
    commission($txn_id,$commision,$mem,$date,$promotion);
echo 'Commission Added successfully ! ';
?>
<script>
    
setTimeout(function(){

window.history.back();
}, 2000);

</script>

<? }
else{
    echo 'Some Problem Occured ! ';
    echo '<a href="https://modimarts.com/franchise7/admin/add_commission.php">Go Back</a>';
}


?>