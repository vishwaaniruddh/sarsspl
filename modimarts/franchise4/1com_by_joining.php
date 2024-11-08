<? include('config.php');
 include('../config.php');
 
 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$member_id = $insert_id;

$sql = mysqli_query($con,"select * from new_member where id='".$member_id."'");
$sql_result = mysqli_fetch_assoc($sql);

$level_id = $sql_result['level_id'];
$intro_id = $sql_result['intro_id'];
$comm_amount = '800';
$datetime = date('Y-m-d h:i:s');


$intro_amount = $comm_amount/2;

$distribution_amount = $intro_amount ; 


$country = $sql_result['country'];
$zone = $sql_result['zone'];
$state = $sql_result['state'];
$division = $sql_result['division'];
$district = $sql_result['district'];
$taluka = $sql_result['taluka'];
$pincode = $sql_result['pincode'];




mysqli_query($con,"insert into joining_com(member_id,amount,status,created_at) values('".$member_id."','".$comm_amount."','1','".$datetime."')");
$join_insert_id = $con->insert_id;

$pre_level_id = $level_id-1;
$is_intro_found=0;

if($join_insert_id){
    

        
        for($new_level=$pre_level_id;$new_level>0;$new_level--){
            
        
            
        if($new_level==7){
            $sql = "select * from new_member where level_id='".$new_level."' and country='".$country."' and zone='".$zone."' and state='".$state."' and division='".$division."' and district='".$district."' and taluka='".$taluka."' and pincode='".$pincode."' and status=1";
        }
        if($new_level==6){
            $sql = "select * from new_member where level_id='".$new_level."' and country='".$country."' and zone='".$zone."' and state='".$state."' and division='".$division."' and district='".$district."' and taluka='".$taluka."' and status=1";    
        }
        if($new_level==5){
            $sql = "select * from new_member where level_id='".$new_level."' and country='".$country."' and zone='".$zone."' and state='".$state."' and division='".$division."' and district='".$district."' and status=1";    
        }
        if($new_level==4){
            $sql = "select * from new_member where level_id='".$new_level."' and country='".$country."' and zone='".$zone."' and state='".$state."' and division='".$division."' and status=1";    
        }
        if($new_level==3){
            $sql = "select * from new_member where level_id='".$new_level."' and country='".$country."' and zone='".$zone."' and state='".$state."' and status=1";    
        }
        if($new_level==2){
            $sql = "select * from new_member where level_id='".$new_level."' and country='".$country."' and zone='".$zone."' and status=1";    
        }
        
        if($new_level==1){
            $sql = "select * from new_member where level_id='".$new_level."' and country='".$country."'  and status=1";    
        }
        
        
        
        
            $statement = mysqli_query($con,$sql);
            $statement_result = mysqli_fetch_assoc($statement);
            
            $mem_id = $statement_result['id'];
            $get_intro = $statement_result['intro_id'];
            $level_id = $statement_result['level_id'];
            if($mem_id){
                
            
            if($intro_id == $mem_id){
        
            $is_intro_found=1;
            
            // echo "insert into joining_com_details(joining_com_id,member_id,amount,status,is_introducer,created_at) values('".$join_insert_id."','".$mem_id."','400','1','1','".$datetime."') ";
            mysqli_query($con,"insert into joining_com_details(joining_com_id,member_id,amount,status,is_introducer,created_at,level_id,is_diff_branch) values('".$join_insert_id."','".$mem_id."','400','1','1','".$datetime."','".$level_id."','0') ");

                if($new_level==1){
                    
                    $sar_amount = $distribution_amount ;
                    // echo "insert into joining_com_details(joining_com_id,member_id,amount,status,is_introducer,created_at) values('".$join_insert_id."','SAR','".$distribution_amount."','1','0','".$datetime."') ";        
                    mysqli_query($con,"insert into joining_com_details(joining_com_id,member_id,amount,status,is_introducer,created_at,level_id,is_diff_branch) values('".$join_insert_id."','SAR','".$distribution_amount."','1','0','".$datetime."','0','0') "); 
        
            }
            
                
            }
            else{
            $distribution_amount = $distribution_amount/2; 
            
            
            // echo $sql;
            // echo "insert into joining_com_details(joining_com_id,member_id,amount,status,is_introducer,created_at) values('".$join_insert_id."','".$mem_id."','".$distribution_amount."','1','0','".$datetime."')";
            mysqli_query($con,"insert into joining_com_details(joining_com_id,member_id,amount,status,is_introducer,created_at,level_id,is_diff_branch) values('".$join_insert_id."','".$mem_id."','".$distribution_amount."','1','0','".$datetime."','".$level_id."','0')"); 
            
        
                        if($new_level==1){
                $sar_amount = $distribution_amount ; 

                // echo "insert into joining_com_details(joining_com_id,member_id,amount,status,is_introducer,created_at) values('".$join_insert_id."','SAR','".$distribution_amount."','1','0','".$datetime."') ";    
                
                mysqli_query($con,"insert into joining_com_details(joining_com_id,member_id,amount,status,is_introducer,created_at,level_id,is_diff_branch) values('".$join_insert_id."','SAR','".$distribution_amount."','1','0','".$datetime."','0','0') "); 
        
            }
            }
            
            }
            // echo '<br>';
        }
        
      
      $intro_id_sql = mysqli_query($con,"select * from new_member where id='".$intro_id."'");
      $intro_id_sql_result = mysqli_fetch_assoc($intro_id_sql);
    
    $intro_level = $intro_id_sql_result['level_id'];
        if($is_intro_found==0){
        
            mysqli_query($con,"insert into joining_com_details(joining_com_id,member_id,amount,status,is_introducer,created_at,is_diff_branch,level_id) values('".$join_insert_id."','".$intro_id."','400','1','1','".$datetime."','1','".$intro_level."') ");
            
            
        }

}    
