<? include('config.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$full_name = $_POST['full_name'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$cast = $_POST['cast'];
$anniversary = $_POST['anniversary'];
$gender = $_POST['gender'];
$marrital_status = $_POST['marrital_status'];
$intro_name = $_POST['intro_name'];
$intro_mobile = $_POST['intro_mobile'];
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
$pay_option = $_POST['pay_option'];
$gst = $_POST['gst'];




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
                            }
                      }
                }
            }
        }
    }
}

// var_dump($_POST);


// echo '<br>';
// echo '<br>';


echo "insert into new_member2(full_pay_date,level_id,country,zone,state,division,district,taluka,village,location,pincode,status,name,mobile,introducer_name,introducer_mobile,created_at,star) values('".$full_pay_date."','".$level_id."','".$country."','".$zone."','".$state."','".$division."','".$district."','".$taluka."','".$village."','".$location."','".$pincode."','2','".$full_name."','".$mobile."','".$intro_name."','".$intro_mobile."','".$full_pay_date."','".$star."')";


// return;
$sql = mysqli_query($con,"insert into new_member2(full_pay_date,level_id,country,zone,state,division,district,taluka,village,location,pincode,status,name,mobile,introducer_name,introducer_mobile,created_at,star) values('".$full_pay_date."','".$level_id."','".$country."','".$zone."','".$state."','".$division."','".$district."','".$taluka."','".$village."','".$location."','".$pincode."','2','".$full_name."','".$mobile."','".$intro_name."','".$intro_mobile."','".$full_pay_date."','".$star."')");

$insert_id  = $con->insert_id; 

$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');
$year = date("Y");  
$month = date("m");  





        if (!is_dir('members_image/'.$insert_id)) {
                    mkdir('members_image/'.$insert_id, 0777, true);
                }
                
        $target_dir = 'members_image/'.$insert_id;
    
    $file_name=$_FILES["aadhar_front"]["name"];
    $file_tmp=$_FILES["aadhar_front"]["tmp_name"];
    $file_name = str_replace(" ","",$file_name);
    move_uploaded_file($file_tmp=$_FILES["aadhar_front"]["tmp_name"],$target_dir.'/'.$file_name);
    $uploaded_link = 'https://www.allmart.world/franchise/members_image/'.$insert_id.'/'.$file_name;
    $aadhar_front_sql = "insert into new_member_images(member_id,image,type,created_at) values('".$insert_id."','".$uploaded_link."','aadhar_front','".$date."')";
    

    mysqli_query($con,$aadhar_front_sql);    

    
    $file_name=$_FILES["aadhar_back"]["name"];
    $file_tmp=$_FILES["aadhar_back"]["tmp_name"];
    $file_name = str_replace(" ","",$file_name);
    move_uploaded_file($file_tmp=$_FILES["aadhar_back"]["tmp_name"],$target_dir.'/'.$file_name);
    $uploaded_link = 'https://www.allmart.world/franchise/members_image/'.$insert_id.'/'.$file_name;
    $aadhar_back_sql = "insert into new_member_images(member_id,image,type,created_at) values('".$insert_id."','".$uploaded_link."','aadhar_back','".$date."')";
    mysqli_query($con,$aadhar_back_sql);
    
    $file_name=$_FILES["pan_card"]["name"];
    $file_tmp=$_FILES["pan_card"]["tmp_name"];
    $file_name = str_replace(" ","",$file_name);
    move_uploaded_file($file_tmp=$_FILES["pan_card"]["tmp_name"],$target_dir.'/'.$file_name);
    $uploaded_link = 'https://www.allmart.world/franchise/members_image/'.$insert_id.'/'.$file_name;
    $pan_sql = "insert into new_member_images(member_id,image,type,created_at) values('".$insert_id."','".$uploaded_link."','pan_card','".$date."')";
    mysqli_query($con,$pan_sql);
    
    $file_name=$_FILES["passport"]["name"];
    $file_tmp=$_FILES["passport"]["tmp_name"];
    $file_name = str_replace(" ","",$file_name);
    move_uploaded_file($file_tmp=$_FILES["passport"]["tmp_name"],$target_dir.'/'.$file_name);
    $uploaded_link = 'https://www.allmart.world/franchise/members_image/'.$insert_id.'/'.$file_name;
    $passport_sql = "insert into new_member_images(member_id,image,type,created_at) values('".$insert_id."','".$uploaded_link."','passport','".$date."')";
    mysqli_query($con,$passport_sql);



if($insert_id > 0){ ?>    

<script>

alert('Added Successfully ');

window.location.href="get_members1.php";
    
</script>

<? } else{ ?>

<script>
    
    alert('Some error Occured');
    
    window.history.back();
    
</script>

<? } ?>

