<?
include('../config.php');

$id = $_POST['userid'];
$passport = $_FILES['passport']['name'];
$aadhar_front = $_FILES['aadhar_front']['name'];
$aadhar_back = $_FILES['aadhar_back']['name'];
$pan_card = $_FILES['pan_card']['name'];
$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');
$year = date("Y");  
$month = date("m");

$email = $_POST['email'];
$dob = $_POST['dob'];
$cast = $_POST['cast'];
$anniversary = $_POST['anniversary'];
$gender = $_POST['gender'];
$marrital_status = $_POST['marrital_status'];
$pan = $_POST['pan'];
$adhar_card = $_POST['adhar_card'];
$bank = $_POST['bank'];
$account_num = $_POST['account_num'];
$ifsc = $_POST['ifsc'];
$account_type = $_POST['account_type'];
$pay_option = $_POST['pay_option'];
$gst = $_POST['gst'];
$password = $_POST['password'];
$location = $_POST['address'];

$dob = date("Y-m-d", strtotime($dob) );

$anniversary=date("Y-m-d", strtotime($anniversary));


 $update_member = "update new_waiting set email='".$email."',dob = '".$dob."',cast='".$cast."',anniversary ='".$anniversary."',gender = '".$gender."',marrital_status ='".$marrital_status."',pan= '".$pan."',adhar_card = '".$adhar_card."',bank='".$bank."',account_num= '".$account_num."',ifsc='".$ifsc."',account_type='".$account_type."',pay_option='".$pay_option."',gst='".$gst."',password='".$password."' ,location ='".$location."' where id ='".$id."'";


mysqli_query($con,$update_member);



    if (!is_dir('../members_image_waiting/'.$id)) {
        mkdir('../members_image_waiting/'.$id, 0777, true);
    }
     $target_dir = '../members_image_waiting/'.$id;
    
    
    
    
    function is_image_exist($type,$id){
        global $con;
        $check_sql = mysqli_query($con,"select * from new_member_waiting_images where member_id='".$id."' and type='".$type."'");
        $check_sql_result = mysqli_fetch_assoc($check_sql);
        if($check_sql_result){
            return '1';   
        }
        else{
            return '2';
        }
    }
    
if($passport){

    $file_name=$_FILES["passport"]["name"];
    $file_tmp=$_FILES["passport"]["tmp_name"];
    $file_name = str_replace(" ","",$file_name);
    
    move_uploaded_file($file_tmp=$_FILES["passport"]["tmp_name"],$target_dir.'/'.$file_name);
    $pass_uploaded_link = 'https://www.modimart.world/franchise6/members_image_waiting/'.$id.'/'.$file_name;
    
    echo $pass_uploaded_link;
    
    
if(is_image_exist('passport',$id)==2){
    $passport_sql = "insert into new_member_waiting_images(member_id,image,type,created_at) values('".$id."','".$pass_uploaded_link."','passport','".$date."')";    
}
else{
    $passport_sql = "update new_member_waiting_images set image='".$pass_uploaded_link."' where member_id='".$id."' and type='passport'"; 
}

 
}

if($aadhar_front){

        
    $file_name=$_FILES["aadhar_front"]["name"];
    $file_tmp=$_FILES["aadhar_front"]["tmp_name"];
    $file_name = str_replace(" ","",$file_name);
    move_uploaded_file($file_tmp=$_FILES["aadhar_front"]["tmp_name"],$target_dir.'/'.$file_name);
    $front_uploaded_link = 'https://www.modimart.world/franchise6/members_image_waiting/'.$id.'/'.$file_name;
    

if(is_image_exist('aadhar_front',$id)==2){
    $aadhar_front_sql = "insert into new_member_waiting_images(member_id,image,type,created_at) values('".$id."','".$front_uploaded_link."','aadhar_front','".$date."')";    
}
else{
    $aadhar_front_sql = "update new_member_waiting_images set image='".$front_uploaded_link."' where member_id='".$id."' and type='aadhar_front'"; 
}
}



if($aadhar_back){

        
    $file_name=$_FILES["aadhar_back"]["name"];
    $file_tmp=$_FILES["aadhar_back"]["tmp_name"];
    $file_name = str_replace(" ","",$file_name);
    move_uploaded_file($file_tmp=$_FILES["aadhar_back"]["tmp_name"],$target_dir.'/'.$file_name);
    $backuploaded_link = 'https://www.modimart.world/franchise6/members_image_waiting/'.$id.'/'.$file_name;
    

if(is_image_exist('aadhar_back',$id)==2){
    $aadhar_back_sql = "insert into new_member_waiting_images(member_id,image,type,created_at) values('".$id."','".$backuploaded_link."','aadhar_back','".$date."')";    
}
else{
    $aadhar_back_sql = "update new_member_waiting_images set image='".$backuploaded_link."' where member_id='".$id."' and type='aadhar_back'"; 
}

 
}


if($pan_card){

        
    $file_name=$_FILES["pan_card"]["name"];
    $file_tmp=$_FILES["pan_card"]["tmp_name"];
    $file_name = str_replace(" ","",$file_name);
    move_uploaded_file($file_tmp=$_FILES["pan_card"]["tmp_name"],$target_dir.'/'.$file_name);
    $panuploaded_link = 'https://www.modimart.world/franchise6/members_image_waiting/'.$id.'/'.$file_name;
    

if(is_image_exist('pan_card',$id)==2){
    $pancard_sql = "insert into new_member_waiting_images(member_id,image,type,created_at) values('".$id."','".$panuploaded_link."','pan_card','".$date."')";    
}
else{
    $pancard_sql = "update new_member_waiting_images set image='".$panuploaded_link."' where member_id='".$id."' and type='pan_card'"; 
}

    
}

    if(mysqli_query($con,$passport_sql)){
        echo 'Passport Image Updated Succesfully';
    }else{
        echo 'Passport Image Updated Error';
    }
    echo '<br>';
    
    if(mysqli_query($con,$aadhar_front_sql)){
        echo 'Aadhar Front Part Image Updated Succesfully';
    }else{
        echo 'Aadhar Front Part Image Updated Error';
    }
echo '<br>';    
    if(mysqli_query($con,$aadhar_back_sql)){
        echo 'Aadhar Back Part Image Updated Succesfully';
    }else{
        echo 'Aadhar Back Part Image Updated Error';
    }
    echo '<br>';
    if(mysqli_query($con,$pancard_sql)){
        echo 'Pancard Image Updated Succesfully';
    }else{
        echo 'Pancard Image Updated Error';
    }
    echo '<br>';
?>

<script>
    setTimeout(function(){
        window.location.href="http://www.modimart.world/franchise6/admin/waiting_edit.php?id=<? echo $id;?>"
    }, 2000);

</script>