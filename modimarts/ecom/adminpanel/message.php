<?php 
include "config.php";

$today = date("Y-m-d");

// Reminder before expire
$qr1="select upload_by,todt from ads_upload ";
$res1=mysql_query($qr1); 
if(mysql_num_rows($res1) > 0){
	while($fetchshow1=mysql_fetch_array($res1)){
		$datetime1 = date_create($today);
		$datetime2 = date_create($fetchshow1[1]);
		$interval = $datetime2->diff($datetime1);
		$s= $interval->format('%R%a');
		echo $s;
		if($s==-3){			   
			$qr2="select email from clients where code='".$fetchshow1[0]."'  ";
			//echo $qr2;
			$res2=mysql_query($qr2); 
			if(mysql_num_rows($res2) > 0){
				while($fetchshow2=mysql_fetch_array($res2)){
					$sendmail= $fetchshow2[0];
					$to=$sendmail;
					$subject=" For Renewal:";
					$message = "video adds will be expires after two days .";
					$headers="FROM : varun13roy@gmail.com";
					mail($to,$subject,$message,$headers);				
				}
			}
		}else if($s==0){
		    $qr2="select email from clients where code='".$fetchshow1[0]."'  ";
			//echo $qr2;
			$res2=mysql_query($qr2); 
			if(mysql_num_rows($res2) > 0){
				while($fetchshow2=mysql_fetch_array($res2)){
					$sendmail= $fetchshow2[0];
					$to=$sendmail;
					$subject=" For Renewal:";
					$message = "video adds will be expires today .";
					$headers="FROM : varun13roy@gmail.com";
					mail($to,$subject,$message,$headers);				
				}
			}
		}		
	}
}

 
?>