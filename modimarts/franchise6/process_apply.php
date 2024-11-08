<? include('config.php');


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$full_name = $_POST['full_name'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$cast = $_POST['cast'];
$anniversary = $_POST['anniversary'];
$gender = $_POST['gender'];
$marrital_status = $_POST['marrital_status'];

$intro_mobile = $_POST['intro_mobile'];
$intro_id = $_POST['intro_id'];
$location = $_POST['address'];
$country = $_POST['country'];
$zone = $_POST['zone'];
$state = $_POST['state'];
$division = $_POST['division'];
$district = $_POST['district'];
$taluka = $_POST['taluka'];
$pincode = $_POST['pincode'];
$village = $_POST['village'];
$pan = $_POST['pan'];
$adhar_card = $_POST['adhar_card'];
$bank = $_POST['bank'];
$account_num = $_POST['account_num'];
$ifsc = $_POST['ifsc'];
$account_type = $_POST['account_type'];
$gst = $_POST['gst'];
$password = $_POST['password'];


$mem_status = $_POST['pay_option'];
$payable_bank = $_POST['pay_bank'];
$amount_paid = $_POST['paid_amount'];
$paid_date = $_POST['paid_date'];
$txn_id = $_POST['paid_id'];

$read_agree = $_POST['read_agree'];


if($read_agree){
$read_agreement=1;    
}
else{
    $read_agreement = 0;
}

$created_date = date("Y-m-d h:i:s");


if(isset($_POST['paid_date'])){
    $paid_date=strtotime($paid_date);       //15/03/2015
    $paid_date=date('Y-m-d H:i:s',$paid_date);
}
else{
    $paid_date  = "0000-00-00 00:00:00";
}


    

$query = mysqli_query($con,"select * from new_member where id = '".$intro_id."'");

$query_result = mysqli_fetch_assoc($query);

$intro_name = $query_result['name'];



$full_pay_date = date("Y-m-d");


if($country){
    $level_id = 1;
    $star = 'Country';
    if($zone){
        $level_id =$level_id+1;
        $star = 'Zone';
        if($state){
            $level_id =$level_id+1;
            $star = 'State';
                if($division){
                   $level_id =$level_id+1;
                   $star = 'Division';
                   if($district){
                      $level_id =$level_id+1;
                      $star = 'District';
                      if($taluka){
                             $level_id =$level_id+1;
                             $star = 'Taluka';
                             if($pincode){
                                $level_id =$level_id+1;
                                $star = 'Pincode';
                             
                                if($village){
                                    $level_id =$level_id+1;
                                    $star = 'Village';
                                    }
                                else{
                                    $village='0';
                                }
                            }
                            else{
                                $pincode = '0';
                            }
                      }
                      else{
                       $taluka = '0';   
                      }
                }
                else{
                    $district = '0';
                }
            }
            else{
                $division = '0';
            }

        }
        else{
            $state= '0';
            }
    }
    else{
        $zone = '0';
    }
}
else{
    $country = '0';
}



if(!$country){
    $country = '0';
}
if(!$zone){
    $zone = '0';
}
if(!$state){
    $state = '0';
}
if(!$division){
    $division = '0';
}
if(!$district){
    $district = '0';
}
if(!$taluka){
    $taluka = '0';
}
if(!$pincode){
    $pincode = '0';
}
if(!$village){
    $village = '0';
}







$sql = mysqli_query($con,"insert into new_member(full_pay_date,level_id,country,zone,state,division,district,taluka,village,location,pincode,intro_id,status,name,mobile,introducer_name,introducer_mobile,created_at,star,password,mem_status,payable_bank,amount_paid,paid_date,txn_id,read_agreement ) values('".$full_pay_date."','".$level_id."','".$country."','".$zone."','".$state."','".$division."','".$district."','".$taluka."','".$village."','".$location."','".$pincode."','".$intro_id."','1','".$full_name."','".$mobile."','".$intro_name."','".$intro_mobile."','".$created_date."','".$star."','".$password."','".$mem_status."','".$payable_bank."','".$amount_paid."','".$paid_date."','".$txn_id."','".$read_agreement."')");


$insert_id  = $con->insert_id; 


$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');
$year = date("Y");  
$month = date("m");  





          if (!is_dir('members_image/'.$insert_id)) {
                    mkdir('members_image/'.$insert_id, 0777, true);
                }
                
        $target_dir = 'members_image/'.$insert_id;
    


    
 
    $file_name=$_FILES["paid_proof"]["name"];
if($file_name){
    $file_tmp=$_FILES["paid_proof"]["tmp_name"];
    $file_name = str_replace(" ","",$file_name);
    move_uploaded_file($file_tmp=$_FILES["paid_proof"]["tmp_name"],$target_dir.'/'.$file_name);
     $uploaded_link = 'https://www.modimart.world/franchise6/members_image/'.$insert_id.'/'.$file_name;
    
    

    mysqli_query($con,"update new_member set proof_image='".$uploaded_link."' where id='".$insert_id."'");
    
    $aadhar_front_sql = "insert into new_member_images(member_id,image,type,created_at) values('".$insert_id."','".$uploaded_link."','paid_proof','".$date."')";
    

    mysqli_query($con,$aadhar_front_sql);
        
}   
    
    
    
    
    
    
    
    $file_name=$_FILES["aadhar_front"]["name"];
    $file_tmp=$_FILES["aadhar_front"]["tmp_name"];
    $file_name = str_replace(" ","",$file_name);
    move_uploaded_file($file_tmp=$_FILES["aadhar_front"]["tmp_name"],$target_dir.'/'.$file_name);
    $uploaded_link = 'https://www.modimart.world/franchise6/members_image/'.$insert_id.'/'.$file_name;
    $aadhar_front_sql = "insert into new_member_images(member_id,image,type,created_at) values('".$insert_id."','".$uploaded_link."','aadhar_front','".$date."')";
    

    mysqli_query($con,$aadhar_front_sql);
    
    

    
    $file_name=$_FILES["aadhar_back"]["name"];
    $file_tmp=$_FILES["aadhar_back"]["tmp_name"];
    $file_name = str_replace(" ","",$file_name);
    move_uploaded_file($file_tmp=$_FILES["aadhar_back"]["tmp_name"],$target_dir.'/'.$file_name);
    $uploaded_link = 'https://www.modimart.world/franchise6/members_image/'.$insert_id.'/'.$file_name;
    $aadhar_back_sql = "insert into new_member_images(member_id,image,type,created_at) values('".$insert_id."','".$uploaded_link."','aadhar_back','".$date."')";
    mysqli_query($con,$aadhar_back_sql);
    
    $file_name=$_FILES["pan_card"]["name"];
    $file_tmp=$_FILES["pan_card"]["tmp_name"];
    $file_name = str_replace(" ","",$file_name);
    move_uploaded_file($file_tmp=$_FILES["pan_card"]["tmp_name"],$target_dir.'/'.$file_name);
    $uploaded_link = 'https://www.modimart.world/franchise6/members_image/'.$insert_id.'/'.$file_name;
    $pan_sql = "insert into new_member_images(member_id,image,type,created_at) values('".$insert_id."','".$uploaded_link."','pan_card','".$date."')";
    mysqli_query($con,$pan_sql);
    
    $file_name=$_FILES["passport"]["name"];
    $file_tmp=$_FILES["passport"]["tmp_name"];
    $file_name = str_replace(" ","",$file_name);
    move_uploaded_file($file_tmp=$_FILES["passport"]["tmp_name"],$target_dir.'/'.$file_name);
    $uploaded_link = 'https://www.modimart.world/franchise6/members_image/'.$insert_id.'/'.$file_name;
    $passport_sql = "insert into new_member_images(member_id,image,type,created_at) values('".$insert_id."','".$uploaded_link."','passport','".$date."')";
    mysqli_query($con,$passport_sql);

if($insert_id > 0 && $mem_status=='p'){
    include('com_by_joining.php');
}



if($sql){ ?>    

<script>

alert('Added Successfully ');

window.location.href="get_members.php";
    
</script>

<? } else{ ?>

<script>
    
    alert('Some error Occured');
    
    window.history.back();
    
</script>

<? } ?>

