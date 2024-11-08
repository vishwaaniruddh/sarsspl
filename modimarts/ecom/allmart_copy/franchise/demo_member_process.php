<?php
session_start();
include ('config.php');

//var_dump($_POST);exit;
$hdLevel=$_POST['hdLevel'];
$hdLoc=$_POST['hdLoc'];

$state=$_POST['state'];
$city=$_POST['city'];
$District=$_POST['District'];
$Pincode=$_POST['Pincode'];
$Village=$_POST['Village'];
$talukaa=$_POST['talukaa'];
$Zone=$_POST['Zone'];
$country=$_POST['country'];
$position_id=$_POST['position'];

$Name=$_POST['Name'];
//$Address=$_POST['Address'];
$datepicker1=$_POST['datepicker'];
 $datepicker=date("Y-m-d", strtotime($datepicker1));


$Gmail=$_POST['Gmail'];
$Mobile=$_POST['Mobile'];
/*$Pincode=$_POST['Pincode'];*/
date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');
//$code=rand();
$code=md5(uniqid(rand(), true));

    $imgdir ='';

    if(isset($_POST['hdpic'])){
        $data = $_POST['hdpic'];

    }

    // echo $data;

    $myfile = fopen("file.txt", "w") or die("Unable to open file!");
$txt = $data;
fwrite($myfile, $txt);
fclose($myfile);




$file_contents = file_get_contents('file.txt');

echo 'content'.'<br>';
echo $file_contents;


$rename_image=rename($file_contents,"pictures.png");




?>
<img src="<?php echo $rename_image; ?>" alt="">



<?php 
if(isset($_FILES['up']) && $_FILES['up']['name']!=''){
   

// echo $data;

    //echo 'up'.$_FILES['up']['name'];
    // $name=$_FILES['up']['name'];
    // $size=$_FILES['up']['size'];
    
   /* if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}*/
    

    
    
    // $type=$_FILES['up']['type'];
    // $tmp_name=$_FILES['up']['tmp_name'];
    
    $location="image/".$myfile;
    echo '<br>';
    echo $location;
    // move_uploaded_file($myfile,$location);


}




if(isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'){
    $verify='Y';
    $status=1;
} else {
    $verify='N';
    $status=0;
}

//Check for existence of committee
if(isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'){
    echo '1';
$sql_check="select id,position_id from member where position_id='".$position_id."' and status=1";
$runsql=mysqli_query($conn,$sql_check);
$fetchdata=mysqli_fetch_array($runsql);
$result=mysqli_fetch_assoc($runsql);

//if($result!=''){
    //echo '1';exit;
    $count_committee=mysqli_num_rows($runsql);
    var_dump($count_committee);
//}

if($count_committee>0){
   // echo '2';exit;
    $data['position']=$result['position_id'];
    //echo '<script>alert("already available");</script>';
    //echo $data['position'];exit;
    //echo '<script>document.getElementById("#checkPosition'.$position_id.'").insertAfter("#committee_list"); </script>';
    echo '<script>document.getElementById("#checkPosition'.$position_id.'").showModal(); </script>';
?> 

<!-- Delete Modal -->
 <div class="modal fade" id="checkPosition<?php echo $result['id']; ?>" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close btn-style" data-dismiss="modal" style="width: 10% !important;">&times;</button>
          <h4 class="modal-title">Already exist</h4>
        </div>
        <div class="modal-body">
          One member already available at this position?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-warning btn-style" data-dismiss="modal" style="width: 20% !important;" onclick="shiftCommittee(<?php echo $result['id']; ?>)">Put in Wait list</button>
          <button type="button" class="btn btn-success btn-style" data-dismiss="modal" style="width: 10% !important;" onclick="deleteCommittee(<?php echo $result['id']; ?>)">Delete Existing Member</button>
          <button type="button" data-dismiss="modal" style="width: 10% !important;" class="btn btn-danger btn-style">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <script>
  
   /* function deleteCommittee(id){
        alert(id);
		 $.ajax({
             type: "POST",
             url: "confirmDelete.php",
             data: 'id='+id+'&remove='+1,			
             success: function(msg){              
              //alert(msg);
              swal('Committee deleted successfully!');
              //sumitfunc();
              window.open("member1.php","_self");
             },
         });
    }
    
    function shiftCommittee(id){
        alert('shift'+id);
    		 $.ajax({
                 type: "POST",
                 url: "confirmDelete.php",
                 data: 'id='+id+'&shift='+1,			
                 success: function(msg){              
                  //alert(msg);
                  swal('Committee shifted to waiting list successfully!');
                  //sumitfunc();
                  window.open("member1.php","_self");
                 },
             });
    
    }*/

</script>

<?php } }
//Check for existence of committee
if(isset($_POST['id']) && $_POST['id']>0){
    /*if(isset($_POST['remove_img'])){
        $imgdir='';
       
    }*/
    
    

    
    if( $_FILES['up']['name']=='' && $_POST['hdpic']!=""){
             $sql_update="update member set name='".$Name."' ,email='".$Gmail."',mobile='".$Mobile."',DOB='".$datepicker."',updated_by='".$_SESSION["email"]."' where id='".$_POST['id']."' "; 
    }else{
     $sql_update="update member set name='".$Name."' ,file='".$imgdir."',email='".$Gmail."',mobile='".$Mobile."',DOB='".$datepicker."',updated_by='".$_SESSION["email"]."' where id='".$_POST['id']."' "; 
    }
    
  
   // echo $sql_update;exit;
    $runsql_update=mysqli_query($conn,$sql_update);
    if($runsql_update){
       echo "<script> location.href='member3.php'; </script>";
    } else{
        echo "<script> location.href='member3.php'; </script>";
    }
    
} else{
  $sql="insert into member(position_id,name,address,email,mobile,pincode,entrydt,file,mailcode,addedby,country,state,city,district,taluka,village,zone,verify,level_id,loc_id,status,DOB,created_by) values('".$position_id."','".$Name."','','".$Gmail."','".$Mobile."','".$Pincode."','".$dates."','".$imgdir."','".$code."','". $_SESSION['id']."','".$country."','".$state."','".$city."','".$District."','".$talukaa."','".$Village."','".$Zone."','".$verify."','".$hdLevel."','".$hdLoc."','".$status."','".$datepicker."','".$_SESSION["email"]."')";
    $runsql=mysqli_query($conn,$sql);
    //$last_id = $conn->insert_id;
}

//===========for mail===============
/*if($Gmail!='' || !($_SESSION['user_name']=='Admin')){
$EmailSubject="Your Registration done Please click on given link for Email verification";
$MESSAGE_BODY="";
   // $MESSAGE_BODY.="your username is: ".$email."\r\n";
    //$MESSAGE_BODY.="your password is: ".$fetchHotelusers['password']."\r\n";
     $message="Dear ".$Name." You have been successfully registered please verify with following link"."\r\n";
            $message.="http://shyambabadham.com/Committee/verification_mail.php?id=$code";
        $leadsmail="ram@sarmicrosystems.in', 'Mailer";
        $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 
//require 'phpmail/src/Exception.php';
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'sarmicrosystems.in';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ram@sarmicrosystems.in';                 // SMTP username
    $mail->Password = 'ram1234*';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('ram@sarmicrosystems.in', 'Temple');
    $mail->addAddress($Gmail); 
    $mail->mailheader=$mailheader;// Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('ramshankargupta444@gmail.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message."\r\n".$MESSAGE_BODY;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    //$mail->AltBody=$MESSAGE_BODY;
    $mail->send();
//==============mail end===
} 
 */
//echo $sql;

