<?
include("config.php");

$err=0;
$errstr="";
$pthn="profileimgs/";

if(isset($_FILES['img']))
{
    
    if($_FILES['img']['name']!="")
    {
  if (!file_exists($pthn)) 
{
    mkdir($pthn, 0755, true);
}
$pthn=$pthn.date('Y')."/";
if (!file_exists($pthn)) 
{
   mkdir($pthn, 0755, true);
}
$pthn=$pthn.date('m')."/";
if (!file_exists($pthn)) 
{
   mkdir($pthn, 0755, true);
}

    
      $errors= array();
      $file_name = $_FILES['img']['name'];
      $file_size =$_FILES['img']['size'];
      $file_tmp =$_FILES['img']['tmp_name'];
      $file_type=$_FILES['img']['type'];
     // $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      /*if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }*/
      
      /*if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }*/
      $file_name=$pthn.date('YmdHis')."sts".$file_name;
      if($err==0)
      {
         if(move_uploaded_file($file_tmp,$file_name))
         {
             
             
         }else
         {
             echo $_FILES["img"]["error"];
             $err++;
             
             $errstr=$errstr."Upload failed";
         }
         
      }else
      {
        $errstr=$errstr."Upload failed";
        
      }
    }
}


mysqli_query($con,"BEGIN");

if($err==0)
{
    
    $qr=mysqli_query($con,"Insert into quiz_regdetails( `name`, `lname`, `emailid`, `school`, `class`, `status`, `entrydt`,img_path)values('".mysqli_real_escape_string($con,$_POST['name'])."','".mysqli_real_escape_string($con,$_POST['lname'])."','".mysqli_real_escape_string($con,$_POST['email'])."','".mysqli_real_escape_string($con,$_POST['schname'])."','".mysqli_real_escape_string($con,$_POST['class1'])."','1','".date('Y-m-d H:i:s')."','".$file_name."')");
   
                  $a=$_POST['i'];
        if($a!="")
                {
                    $qrt="select * from quiz_regdetails where 1 ORDER BY id DESC";
                     $res= mysqli_query($con,$qrt);
                     $ro= mysqli_fetch_array($res);
                     $lst=$ro[0];                
                     $rf=mysqli_query($con,"insert into quiz_friends(user_id,friend_id,entrydt)values('".$a."','".$lst."','".date('Y-m-d H:i:s')."')");
             }
                
    
    
    if(!$qr)
    {
        
        echo mysqli_error($con);
        echo $err++;
    }else
    {
        
        $insid=mysqli_insert_id($con);
    }
    
    if($err==0)
    {

        
            $qr2=mysqli_query($con,"INSERT INTO `quiz_login`(`user_id`, `email`, `pass`, `stats`,`referal`) VALUES('".mysqli_real_escape_string($con,$insid)."','".mysqli_real_escape_string($con,$_POST['uname'])."','".mysqli_real_escape_string($con,$_POST['password'])."','1','".mysqli_real_escape_string($con,$_POST['email']).''.mysqli_real_escape_string($con,$insid)."')");

            if(!$qr2)
                {
                    
                    echo mysqli_error($con);
                    echo $err++;
                }
    
    } 
}


if($err==0)
{
  
    
mysqli_query($con,"COMMIT");
  echo "1";
}
else

{
    
mysqli_query($con,"ROLLBACK");
    echo "2";
}


mysqli_close($con);
?>