<? include('config.php');

include('function.php');
$contents = "" ; 

$contents .= "SR \t Ticket ID \t Customer \t Bank \t ATM ID \t CTS BM \t Require Material Name \t Dispatch Address \t Contact Person Name \t Contact Person Mobile \t Remark \t Created Date \t Location \t City \t State \t Zone \t MIS ID \t Created By \t";

$counter=1 ;




$query = "select * from material_inventory where status<>'1' group by mis_id order by id desc";
$sql = mysqli_query($css,$query);
$start = microtime(true);

while($sql_result = mysqli_fetch_assoc($sql)){ 
            $id = $sql_result['id'];
            $mis_id = $sql_result['mis_id'];
            
            $misdetail_sql = mysqli_query($css,"select * from mis_details where id='".$mis_id."'");
            $count = mysqli_num_rows($misdetail_sql);
            $misdetail_sql_result = mysqli_fetch_assoc($misdetail_sql);
            $main_mis = $misdetail_sql_result['mis_id'];
            
            $current_status = $misdetail_sql_result['status'];
            
            $mis_sql = mysqli_query($css,"select * from mis where id='".$main_mis."'");
            $mis_sql_result = mysqli_fetch_assoc($mis_sql);
            $location = $mis_sql_result['location'];
            $state = $mis_sql_result['state'];
            $zone = $mis_sql_result['zone'];
            $city = $mis_sql_result['city'];
            $customer = $mis_sql_result['customer'];
            $bank = $mis_sql_result['bank'];
            
            $_atmid = mis_details_data('atmid',$sql_result['mis_id']);
            $bm_sql = mysqli_query($css,"select bm from atm_info where atmid like '".$_atmid."'");
            $bm_sql_result = mysqli_fetch_assoc($bm_sql);
            $bm = $bm_sql_result['bm'];
            
            $mis_history = mysqli_query($css,"select created_by from mis_history where mis_id='".$mis_id."' AND type='".$current_status."'");
            $mis_his_count = mysqli_num_rows($mis_history);
            $user_created_by = "";
            if($mis_his_count>0){
              $mis_his_sql_result = mysqli_fetch_assoc($mis_history);
              $created_by_id = $mis_his_sql_result['created_by'];
              if($created_by_id>0){
                  $mis_created_by_sql = mysqli_query($css,"select name from mis_loginusers where id='".$created_by_id."'");
                  $mis_created_by_count = mysqli_num_rows($mis_created_by_sql);
                  if($mis_created_by_count>0){
                      $mis_user_sql_result = mysqli_fetch_assoc($mis_created_by_sql);
                      $user_created_by = $mis_user_sql_result['name'];
                  }
              }
            }
            
            if($count>0){
                
            $contents.="\n".$counter."\t";
            $contents.= mis_details_data('ticket_id',$sql_result['mis_id'])."\t";

                     $contents.=mis_details_data('ticket_id',$sql_result['mis_id'])."\t";
                     $contents.=$customer."\t";
                     $contents.=$bank."\t";
                     $contents.=mis_details_data('atmid',$sql_result['mis_id'])."\t";
                     $contents.=$bm."\t"; 
                     $contents.=$sql_result['material']."\t";  
                     $contents.=mis_history_data('delivery_address',$sql_result['mis_id'])."\t";
                     $contents.=mis_history_data('contact_person_name',$sql_result['mis_id'])."\t";
                     $contents.=mis_history_data('contact_person_mob',$sql_result['mis_id'])."\t";
                     $contents.=mis_history_data('remark',$sql_result['mis_id'])."\t";
                     $contents.=$sql_result['created_at']."\t"; 
                     $contents.=$location."\t"; 
                     $contents.=$city."\t"; 
                     $contents.=$state."\t"; 
                     $contents.=$zone."\t";
                     $contents.=$sql_result['mis_id']."\t";
                     $contents.=$user_created_by."\t";

            $counter++; } }

$end = microtime(true);
$totalDuration = $end - $start;

echo "Total execution time: " . $totalDuration . " seconds\n";


return ; 

$contents = strip_tags($contents);
header("Content-Disposition: attachment; filename=material.xls");
// header("Content-Type: application/vnd.ms-excel");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

print $contents;