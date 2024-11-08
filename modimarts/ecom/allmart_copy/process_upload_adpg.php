<?php
session_start();
$errors=0;
include 'config.php';
/*var_dump($_POST);*/
if($_SESSION["id"]!="")
{
    //Note--$tyms and $adstotaltym of a slot is set in config.php

    include('config.php');

function format_time($t,$f=':') // t = seconds, f = separator 
{
  return sprintf("%02d%s%02d%s%02d", floor($t/3600), $f, ($t/60)%60, $f, $t%60);
}

function format_seconds($t) 
{
  return sprintf("%02d", $t%60);
}

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
if (!file_exists($pth)) {
    //echo "doesnt exist";
    mkdir($pth, 0755, true);
}

$fdt=$_POST["rdate"];
$tdt=$_POST["tdate"];
$dur=$_POST["durationv"];
$desc=$_POST["desc"];
$name=$_POST["dname"];
$totarr=$_POST["totarr"];
$ratearr=$_POST["rate"];
$dureacharr=$_POST["dureacharr"];
$errormsg=0;
$avdts=$_POST["availdtsarr"];
$chkslotexs=0;
$tymstmp=$_POST["tymst"];
$cnts=$_POST["cnts"];
$tors=$_POST["totalrs"];

//echo $cnts[1];
//echo $tymst;
mysqli_query($con1,"BEGIN");
$imagenm=array();
//--------------upload th files-----------------------------------------//
$vcnt= count($_FILES['img']['name']);
for($a=0;$a<$vcnt;$a++)
{
    $rowid=$cnts[$a];

    $fnam=$_FILES['img']['name'][$a];
    //echo $fnam;
    $extension1=getExtension($fnam);
 
    $nm=$pth.time()."".$a.'.'.$extension1;
    $imagenm[]=$nm;
    if(!move_uploaded_file($_FILES['img']['tmp_name'][$a],$nm))
    {
        // echo "error";
        $errors++;
        $errormsg=10; 
    } else {
        $primage=mysqli_query($con1,"insert into `ads_upload`(`name`, `descrtn`, `videopath`,duration,upload_dt,upload_by,bkid,amt) values('".mysqli_real_escape_string($name[$a])."','".mysqli_real_escape_string($desc[$a])."','".$nm."','".$dur[$a]."','".date('Y-m-d H:i:s')."','".$_SESSION['id']."','".$tymstmp."','".$tors."')");	

        if(!$primage)
	    {
            $errors++;
            $errtxt.="2".mysqli_error($con1)."\n";
            $errormsg=5; 
                                 
            $errtxt.="1".mysqli_error($con1)."\n";
		}      
        $adsid=$con1->insert_id;
        $curr_dt=date('Y-m-d H:i:s');
	    $subAdminWork=mysqli_query($con1,"insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Add','Add Vedio','".$curr_dt."','".$_SESSION['lastSubID']."','". $adsid." ','ads_upload') ");
		
        $getqry=mysqli_query($con1,"select date(upload_dt),bkid from ads_upload where id='".$adsid."'");
        $fetdt= mysqli_fetch_array($getqry);

        $getq=mysqli_query($con1,"select min(date),max(date) from ads_sec_booked where date(entrydt)='".$fetdt[0]."' and randomtymstmp='".$fetdt['bkid']."'   ");
        $fedt=mysqli_fetch_array($getq);

        $upquery=mysqli_query($con1,"update ads_upload  set fromdt='".$fedt[0]."' , todt='".$fedt[1]."' where id='".$adsid."' ");

        $qrr=mysqli_query($con1,"select * from ads_sec_booked where randomtymstmp='".$tymstmp."' and user_id='".$_SESSION["id"]."' and rowid='".$rowid."' and stats='0' order by date asc");

        $data=array();
        $totrsf=0;
        while($frt=mysqli_fetch_array($qrr))
        {
            if($errors==0)
            {
                $dtt=date("Y-m-d",strtotime($frt["date"]));
                $rate=$frt["rate"];
                $adsduration=$frt["duration"];
                $totaldur=$tyms*$adsduration;
                $totlrt=$totaldur*$rate;
                $totrs=$totlrt/100;
                $rw=$frt["rowid"];
                
                
                $chkifrexs=mysqli_query($con1,"select * from Date_duration where Date='".$dtt."'");
                $chkifrexsrws=mysqli_num_rows($chkifrexs);
                if($chkifrexsrws==0)
                {
                $insq=mysqli_query($con1,"insert into Date_duration(`Date`, `total_duration`) values('".$dtt."','".$adsduration."')");
                    $dateduration_id=$con1->insert_id;
                    if(!$insq)
                    {
                        $errormsg=5;
                         $errtxt.="3".mysqli_error($con1)."\n";
                        $errors++;
                    }
                    
                    
                    $dateduration_id=$con1->insert_id;
                }else
                {
                    $totdurws=mysqli_fetch_array($chkifrexs);
                    
                    $dateduration_id=$totdurws[0];
                 if($totdurws["stats"]=="0")
                 {
                    $durbkd=$totdurws["total_duration"];
                    $newdr=$durbkd+$adsduration;
                    
                    if($newdr>$adstotaltym)
                    {
                        $errormsg=20;//already booked
                        $errors++;
                    }else
                    {
                        $sts=0;
                         if($newdr==$adstotaltym)
                         {
                            $sts=1;
                         }
                     $updtrs=mysqli_query($con1,"update Date_duration set total_duration='".$newdr."',stats='".$sts."' where Date='".$dtt."'");
                     
                     if(!$updtrs)
                     {
                        $errormsg=5;
                        $errtxt.="4".mysqli_error($con1)."\n";
                        $errors++;
                     }
                    }  
                    }else
                    {
                        $errormsg=20;//already booked
                        $errors++;
                    }
                }
                if($errors==0)
                {
                    $insq2=mysqli_query($con1,"INSERT INTO `ads_slot_booked_details`( `video_id`, `date_duration_id`, `ad_duration`, `no_of_tyms_ads_to_be_playd`, `total_seconds_ad_will_be_played`, `slot_rate`, `total_amt`) values('".$adsid."','".$dateduration_id."','".$adsduration."','".$tyms."','".$totaldur."','".$rate."','".$totrs."')");
                    if(!$insq2)
                    {
                        $errormsg=5;
                        $errtxt.="5".mysqli_error($con1)."\n";
                        $errors++; 
                    }
                }
            }
        }
    }
}
//-------------- upload th files end -----------------------//

}else
{
 $errors++;   
 $errormsg="10";   
}
if($errors==0)
{
    $qrr=mysqli_query($con1,"select * from ads_sec_booked where randomtymstmp='".$tymstmp."' and user_id='".$_SESSION["id"]."' and rowid='".$rowid."' and stats='0' order by date asc");
    
    $updtr=mysqli_query($con1,"Update  ads_sec_booked set stats=1 where user_id='".$_SESSION["id"]."' and randomtymstmp='".$tymstmp."' ");
 
    if(!$updtr)
    {
        $errors++;   
        $errormsg="5"; 
    }
}
if($errors==0)
{
    mysqli_query($con1,"COMMIT");
}else
{
    mysqli_query($con1,"ROLLBACK");
    for($b=0;$b<count($imagenm);$b++)
    {
        if(file_exists($imagenm[$b]))
        {
            unlink($imagenm[$b]);
        }
    }
}
$data = ['available' =>$chkslotexs,'errorsts' => $errors,'errortxt'=> $errtxt,'errmsg'=>$errormsg];
echo json_encode($data);
?>