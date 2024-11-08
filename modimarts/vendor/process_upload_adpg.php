<?php
session_start();
include('config.php');
//include('access.php');

$id=$_POST['id'];
$errors=0;

$duration=$_POST["durarr"];
$name=$_POST["namearr"];
$desc=$_POST["descarr"];
$fdt=$_POST["fdt"];
$tdt=$_POST["tdt"];

//echo "duration"." ".$duration;
$errormsg=1;
$image=$_FILES['image']['name'];
   $qcnt= count($image); 

function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }


$nwyr=date('Y');
$nwdt=date('m');
$pth="videoads/".$nwyr."/".$nwdt."/";
//echo $pth;
if (!file_exists("../".$pth)) {

//echo "doesnt exist";

   mkdir("../".$pth, 0755, true);
}

    
//================mp3 image====================================================================== 
  
  
  $image_name3=array();
$newname3=array();
 $image1=$_FILES['img']['name'];
   $ncnt= count($image1);
  
  for($a=0;$a<$ncnt;$a++){
  
  $image1=$_FILES['img']['name'][$a];
  
  
  if ($image1) 
  {
  
    $filename1= stripslashes($image1);
  
      $extension1= getExtension($filename1);
    $extension1= strtolower($extension1);
  
 if ($extension1 != "mp4" )
    {
//&& ($extension1 != "jpeg") && ($extension1 != "png") && ($extension1 != "gif")) 
    //print error message
      //echo '<h1>Unknown extension!</h1>';
      $errors++;
      $errormsg=4;
    }
    else
{


 $size1=filesize($_FILES['img']['tmp_name'][$i]);



$image_name3[$a]=time()."".$a.'.'.$extension1;

$newname3[$a]=$pth.$image_name3[$a];
$newnmm="../".$pth.$image_name3[$a];


//echo "path  ".$newname3[$a];
$copied1= copy(mysqli_real_escape_string($_FILES['img']['tmp_name'][$a]), mysqli_real_escape_string($newnmm));

if (!$copied1) 
{
  
  $errors++;
  $errormsg=10;
  }
  
  
  }
  
  }
  
  }

    if($errors==0) 
{  
//echo "ok2";

//print_r($newname3);


      for($i=0;$i<$ncnt;$i++)
        {
            
            
      $sts=0;
$sec=round($duration[$i]);

//echo $sec;
$sltqry=mysqli_query("select slot from ads_slot_amount where status=1 ");
$sltqryf=mysqli_fetch_array($sltqry);

$slot=$sltqryf[0];

while($sts==0)
{
    $v=$sec % $slot;
    
    if($v==0)
    {
        $sts=1;
        
    }else
    {
      $sec=$sec+1; 
        
    }
    //echo $sec."\n";
} 
      
            
            
            

if($newname3[$i]!="")
{ 

    
$dt=date("Y-m-d");    
      
    //  echo "insert into `ads_upload`(`name`, `descrtn`, `videopath`,duration,upload_dt,`fromdate`, `todate`) values('".mysqli_real_escape_string($name[$i])."','".mysqli_real_escape_string($desc[$i])."','".$newname3[$i]."','".$duration[$i]."','".date("Y-m-d H:i:s")."','".date("Y-m-d",strtotime($_POST['dt1']))."','".date("Y-m-d",strtotime($_POST['dt2']))."')";
      
$primage=mysqli_query($con1,"insert into `ads_upload`(`name`, `descrtn`, `videopath`,duration,upload_dt,`fromdt`, `todt`,upload_by) values('".mysqli_real_escape_string($name[$i])."','".mysqli_real_escape_string($desc[$i])."','".$newname3[$i]."','".$sec."','".date('Y-m-d H:i:s')."','".date("Y-m-d",strtotime($_POST['fdt']))."','".date("Y-m-d",strtotime($_POST['tdt']))."','".$_SESSION['id']."')"); 
//echo "insert into `upload_only_moives`(`name`, `descrtn`, `videopath`,duration) values('".$name[$i]."','".$desc[$i]."','".$newname3[$i]."','".$duration[$i]."')";

 if(!$primage)
              {
                                  //$errors++;
                               echo mysqli_error($con1); 
                                  $errormsg=5; 
         }       
}


$begin = new DateTime($fdt);
$interval=new DateInterval('P1D');
$end = new DateTime($tdt);
$end ->add($interval);
$daterange = new DatePeriod($begin, $interval, $end);

foreach($daterange as $date){
   
    
    $daterange=$date->format("Y-m-d");
    
   
  
    


//======================================all date between 2 dates========================================



$selectcheck=mysqli_query("select * from Date_duration where Date='".$daterange."'");
$selectcheckf=mysqli_num_rows($selectcheck);

if($selectcheckf==0){
$insertdateduration=mysqli_query("INSERT INTO `Date_duration`(`Date`, `total_duration`) VALUES ('".$daterange."','".$sec."')");

//echo "INSERT INTO `Date_duration`(`Date`, `total_duration`) VALUES ('".$daterange."','".$sec."')";

}else{
    
    
     $check_durationf=mysqli_fetch_row($selectcheck);
   
   if($check_durationf[2]!=3600){
       
       
   
       
       $checktime=$check_durationf[2]+$sec;
       
       if($checktime<=3600){
          
           //echo "UPDATE `Date_duration` SET total_duration='".$checktime."' WHERE Date='".$daterange."'";
           
          $insertdateduration=mysqli_query("UPDATE `Date_duration` SET total_duration='".$checktime."' WHERE Date='".$daterange."'");
       }
    
    
    
   }
    
   
}




                  if(!$insertdateduration)
              {
                                  //$errors++;
                               echo mysqli_error($con1); 
                                  $errormsg=5; 
         }      
} 
        }
         
            // echo $errormsg;
                
        

      

        
        if($errors==0 & $errormsg==1)
        {
            //echo "select email from clients where code='".$_SESSION['id']."'";
            $geteml=mysqli_query("select email from clients where code='".$_SESSION['id']."'");
            $gtrws=mysqli_fetch_array($geteml);
            $eml=$gtrws[0];
            $subject="Merabazaar Ad booking";
$headers = "From: <mail@example.com>\r\n";
//$headers .= "Cc: <info@designbigideas.com>\r\n";
      //$headers .= "Reply-To: ".dfdf . "\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      //$headers .= "Cc: ".$this->ccm."\r\n";
      //echo $tbl."<br>";
      //echo $this->ccm;
      $message="Your ad has been uploaded and is sent for admin approval,once it is approved it will be displayed else payment will be refunded within 15 days.";
      $message.="Your booking id is ".$bkid;
      
      //$send = mail('rahull.1612@gmail.com', 'Test Subject', $message);
      $result = mail($eml, $subject, $message, $headers);
                       // $result = mail('secretary@ipua.in', $subject, $message, $headers);
      //$result = mail('rahull.1612@gmail.com', 'Test Subject', $message);


            
        }
        
        
echo $errormsg;

}else
{
    
    echo 50;
}
?>