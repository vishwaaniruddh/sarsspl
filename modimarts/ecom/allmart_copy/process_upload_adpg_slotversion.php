<?php
session_start();
include('config.php');
//include('access.php');

function format_time($t,$f=':') // t = seconds, f = separator 
{
  return sprintf("%02d%s%02d%s%02d", floor($t/3600), $f, ($t/60)%60, $f, $t%60);
}


function format_seconds($t) 
{
  return sprintf("%02d", $t%60);
}
$id=$_POST['id'];
$errors=0;


$fdt=$_POST["fdt"];
$tdt=$_POST["tdt"];
$dur=format_seconds($_POST["duration"]);
$desc=$_POST["desc"];
$name=$_POST["name"];
//echo "duration"." ".$duration;
$errormsg=1;

//print_r($_POST);
$avdts=$_POST["availdtsarr"];
$requiredslot=$_POST["availdtslotreqcnt"];

//print_r($avdts);
$chkslotexs=0;


mysqli_query($con1,"BEGIN");

//echo $chkslotexs;

$image=$_FILES['img0']['name'];
	 //$qcnt= count($image); 

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

		
// echo $image; 
 $extension1=getExtension($image);
 /*if($extension1!="mp4")
 {
     $errors++;
     $errormsg=4;
 }else
 {*/
     
$image_name3=time()."".$a.'.'.$extension1;

$newname3=$pth.$image_name3;



if(!move_uploaded_file($_FILES['img0']['tmp_name'],mysqli_real_escape_string($newname3)))
{
   $errors++;
     $errormsg=10; 
}
     
 


$dateduration_id=0;
if($errors==0)
{
$primage=mysqli_query($con1,"insert into `ads_upload`(`name`, `descrtn`, `videopath`,duration,upload_dt,`fromdt`, `todt`,upload_by) values('".mysqli_real_escape_string($name)."','".mysqli_real_escape_string($desc)."','".$newname3."','".$dur."','".date('Y-m-d H:i:s')."','".date("Y-m-d",strtotime($_POST['fdt']))."','".date("Y-m-d",strtotime($_POST['tdt']))."','".$_SESSION['id']."')");	

 if(!$primage)
		          {
                                  $errors++;
                              // echo mysqli_error($con1); 
                                  $errormsg=5; 
		 	   }      
$adsid=$con1->insert_id;

}




if($errors==0)
{
    
    
    
    for($a=0;$a<count($avdts);$a++)
{
     $dtt=date("Y-m-d",strtotime($avdts[$a]));
   
     $qrm=mysqli_query($con1,"select id,Date from Date_duration where date='".$dtt."' and stats=0");
$nr=mysqli_num_rows($qrm);
if($nr>0)
{
  
$fr=mysqli_fetch_array($qrm);
$dateduration_id=$fr["id"];
    
    //echo $avdts[$a];
    
    $gettotalslots=mysqli_query($con1,"select * from slot_details_ofdt where date='".$dtt."'");
$frss=mysqli_fetch_array($gettotalslots);
//echo mysqli_error($con1);
$totalslots=$frss["slot_type"];//----total slots for that date--------//
$durationofeachslot=(3600/$frss["slot_type"]);//----duration of each slots for 

$qr=mysqli_query($con1,"select sum(slot_booked) from ads_slot_booked_details where date_duration_id='".$fr["id"]."'");
    $nrm=mysqli_num_rows($qr);
    
    if($nrm>0)
    {
    $fr=mysqli_fetch_array($qr);
    
//    echo "ok";
    if($fr[0]<$totalslots)
    {
        $chkfs=$fr[0]+$requiredslot[$a];
    //echo "ok2";    
    //echo 
    if($chkfs<=$totalslots)
    {    
        //echo "ok3";
       //$chkslotexs=0;
    } else
    {
            //echo "ok4";
     $chkslotexs=1;   
        
    }
        
    }
    }

    
}else
{
    
    $insq=mysqli_query($con1,"insert into Date_duration(`Date`, `total_duration`) values('".$dtt."','".$dur."')");
    $dateduration_id=$con1->insert_id;
    if(!$insq)
    {
        
        $errors++;
    }

    
    
    
}

if($chkslotexs=="0")
{
    
    
    
    $gettotalslots=mysqli_query($con1,"select * from slot_details_ofdt where date='".$dtt."'");
    $frss=mysqli_fetch_array($gettotalslots);
$totalslots=$frss["slot_type"];//----total slots for that date--------//
$durationofeachslot=3600/$totalslots;//---duration of each slot-------//



    $calcmt=mysqli_query($con1,"SELECT * FROM `ads_slot_amount` where slot_type='".$totalslots."' order by id desc");
    
    $frc=mysqli_fetch_array($calcmt);
    
    $rate=$frc["amount"];
    $totmt=$frc["amount"]*$requiredslot[$a];
    
    
    $insq=mysqli_query($con1,"INSERT INTO `ads_slot_booked_details`(`video_id`, `slot_booked`, `date_duration_id`,slot_rate,total_amt,slot_type)values('".$adsid."','".$requiredslot[$a]."','".$dateduration_id."','".$rate."','".$totmt."','".$totalslots."')");
    if(!$insq)
    {
        
       $errors++; 
    }



//-------------------schedule ad entry------------------------------//

$endrtym=date("Y-m-d H:i:s",strtotime($dtt."23:00:00"));
$addtotym=$dtt." 00:00:00";

$addtotymaftr1hr = date("Y-m-d H:i:s", strtotime($addtotym."+1 hours"));
   
$chksch=mysqli_query($con1,"select * from schedule_details where date_duration_id='".$dateduration_id."' order by tym desc limit 0,1");
$schrws=mysqli_num_rows($chksch);
if($schrws>0)
{
  $ftchsc=mysqli_fetch_array($chksch);
  $addtotym=$dtt." ".$ftchsc["tym_end"]; 
    
}else
{
    
   $addtotym=$dtt." 00:00:00"; 
}
 
  $totalsecondsbooked=$requiredslot[$a]*$durationofeachslot;
  //echo $totalsecondsbooked."-----".$dur;
  if($totalsecondsbooked>$dur)
  {
    $secondswasted=$totalsecondsbooked-$dur;
  }else
  {
      
      $secondswasted=0;
  }
   
   
   
//echo format_time("16.456678");
   
   $vpltymstrt=$addtotym;
   $vpltymend=date("Y-m-d H:i:s",strtotime($vpltymstrt."+".$totalsecondsbooked." seconds"));
   
  /* echo "INSERT INTO `schedule_details`(`date_duration_id`, `ad_id`, `duration`, `date`, `tym`, `tym_end`) VALUES('".$dateduration_id."','".$adsid."','".format_time($dur)."','".$dtt."','".date("H:i:s",strtotime($vpltymstrt))."','".date("H:i:s",strtotime($vpltymend))."') "."\n";*/
   $inssch1=mysqli_query($con1,"INSERT INTO `schedule_details`(`date_duration_id`, `ad_id`, `duration`, `date`, `tym`, `tym_end`) VALUES('".$dateduration_id."','".$adsid."','".format_time($dur)."','".$dtt."','".date("H:i:s",strtotime($vpltymstrt))."','".date("H:i:s",strtotime($vpltymend))."') "); 
  
  
  if(!$inssch1)
{
     
     $errors++;
}

//-----insert a blank entry for pending seconds in a slot if video duration is less than total slot duration----//
  /*if($secondswasted>0)
  {
      
     $vpltymstrt2=$vpltymend;
   $vpltymend2=date("Y-m-d H:i:s",strtotime($vpltymstrt2."+".$secondswasted." seconds"));
   
   
   $insschbnk=mysqli_query($con1,"INSERT INTO `schedule_details`(`date_duration_id`, `ad_id`, `duration`, `date`, `tym`, `tym_end`) VALUES('".$dateduration_id."','0','0','".$dtt."','".date("H:i:s",strtotime($vpltymstrt2))."','".date("H:i:s",strtotime($vpltymend2))."') "); 
  
   if(!$insschbnk)
{
     $errors++;
}
  }*/
  
  //-----insert a blank entry for pending seconds in a slot if video duration is less than total slot duration end----//
 //$addtotym = date("Y-m-d H:i:s", strtotime($addtotym."+1 hours"));
   
$t=1;
/* while($endrtym>date("Y-m-d H:i:s",strtotime($addtotym)))
{
    $addtotym = date("Y-m-d H:i:s", strtotime($addtotym."+1 hours"));
    
    
     $addtotymaftr1hr = date("Y-m-d H:i:s", strtotime($addtotym."+1 hours"));
   
$chkschf=mysqli_query($con1,"select * from schedule_details where date_duration_id='".$dateduration_id."' and tym>='".date("H:i:s",strtotime($addtotym))."' and tym_end<='".date("H:i:s",strtotime($addtotymaftr1hr))."'   order by tym_end desc  limit 0,1");

$schrwsf=mysqli_num_rows($chkschf);
if($schrwsf>0)
{
  $ftchscf=mysqli_fetch_array($chkschf);
  $addtotym=$dtt." ".$ftchscf["tym_end"]; 
    
}
 
    
    $vpltymstrt=$addtotym;
    $vpltymend=date("Y-m-d H:i:s",strtotime($vpltymstrt."+".$dur." seconds"));
   
    $inssch2=mysqli_query($con1,"INSERT INTO `schedule_details`(`date_duration_id`, `ad_id`, `duration`, `date`, `tym`, `tym_end`) VALUES('".$dateduration_id."','".$adsid."','".$dur."','".$dtt."','".$vpltymstrt."','".$vpltymend."') "); 

if(!$inssch2)
{
     $errors++;
}
   
   
   
   
   //-----insert a blank entry for pending seconds in a slot if video duration is less than total slot duration----//
  if($secondswasted>0)
  {
      
     $vpltymstrt2=$vpltymend;
   $vpltymend2=date("Y-m-d H:i:s",strtotime($vpltymstrt2."+".$secondswasted." seconds"));
   
   $insschbnk=mysqli_query($con1,"INSERT INTO `schedule_details`(`date_duration_id`, `ad_id`, `duration`, `date`, `tym`, `tym_end`) VALUES('".$dateduration_id."','0','0','".$dtt."','".$vpltymstrt2."','".$vpltymend2."') "); 
  
   if(!$insschbnk)
{
     $errors++;
}
  }
  
  //-----insert a blank entry for pending seconds in a slot if video duration is less than total slot duration end----//
  
  if($t>24)
  {
      
      break;
  }
 $t++;
}
 */
//-------------------schedule ad entry end------------------------------//
    $qrchktoupd=mysqli_query($con1,"select sum(slot_booked) from ads_slot_booked_details where date_duration_id='".$dateduration_id."'");
    
    $frchkupdt=mysqli_fetch_array($qrchktoupd);
    
    if($frchkupdt[0]==$totalslots)
    
    {
    
    $updtsts=mysqli_query($con1,"update Date_duration set stats='1' where id='".$dateduration_id."'");
    if(!$updtsts)
    {
        
       $errors++; 
    }
        
    }
    
}



}

}



if($errors==0)
{
    
  mysqli_query($con1,"COMMIT");
  
  
// echo "okk";
}
else
{
    if (!file_exists($newname3)) {


unlink($newname3);
}
    mysqli_query($con1,"ROLLBACK"); 
 //   echo $errormsg;
}

$data = ['available' =>$chkslotexs,'errorsts' => $errors];

echo json_encode($data);
?>