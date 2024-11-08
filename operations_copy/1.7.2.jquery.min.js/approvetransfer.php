<?php

include("config.php");

 $id=$_POST['id'];

 $cmnt=$_POST['cmnt'];

 if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $cmnt))
mysqli_query($con,
{
mysqli_query($con,
   $cmnt=str_replace("'","\'",$cmnt);

}

 $statmysqli_query($con,tatus'];
mysqli_query($con,
 $alert=mysqli_query($con,"select * from alert where alert_id=(select alertid from transfersites where id='".$id."')");

 $alertro=mysqli_fetch_row($alert);

 $trans=mysqli_query($con,"select * from transfersites where id='".$id."'");

 $trrow=mysqli_fetch_row($trans);

 if($smysqli_query($con,pprove')
mysqli_query($con,
 {

// echo "Update alert set transapp='0' where alert_id='".$alertro[0]."'";

 $qry=mysqli_query($con,"Update alert set transapp='0' where alert_id='".$alertro[0]."'");

 $qry2=mysqli_query($con,"Update transfersites set todesc='".$cmnt."',apptime='".date('Y-m-d H:i:s')."',approval='".$status."' where id='".$id."'");

 if($qry && $qry2)

 echo "1";

 else

 echo "0";

 }

 elseif($status=='approve')

 {

 //echo "Update alert set transapp='2',state='".$trrow[2]."' where alert_id='".$alertro[0]."'";

 $qry=mysqli_query($con,"Update alert set transapp='2',state='".$trrow[2]."' where alert_id='".$alertro[0]."'");

 $qry2=mysqli_query($con,"Update transfersites set todesc='".$cmnt."',apptime='".date('Y-m-d H:i:s')."',approval='".$status."' where id='".$id."'");

 if($qry && $qry2)

 {

 

 echo "1";

 }

 else

 {



 echo "0";

 }

 }

?>