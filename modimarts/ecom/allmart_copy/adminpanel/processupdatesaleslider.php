<?php
session_start();
include("config.php");
$qr="";
mysql_query("BEGIN");

$cat=$_POST['cat'];
 $getdetrs=mysql_query("select code from Productviewtable where code='".$_POST['newid']."' and category='".$cat."' ");
 
 
$prdetsrw=mysql_fetch_array($getdetrs);

        
        if($_POST['updid']!="")
   {
       
    $qrup="update top_right_slider set stats='1',lastupdt='".date("Y-m-d H:i:s")."' where id='".$_POST['updid']."'";
    
    
   }
            $qr="INSERT INTO `top_right_slider`( `pid`, `user_id`, `slot_id`, `slot_pos`, `booking_id`,entrydt,cat) values ('".$_POST['newpid']."','".$_SESSION['id']."','".$_POST["slotid"]."','".$_POST['slotpos']."','0','".date("Y-m-d H:i:s")."','".$cat."')";  
  
    
    $err=0;
   if($_POST['updid']!="")
   {
  //echo $qrup;
$exwcqupd=mysql_query($qrup);
if(!$exwcqupd)
{
    echo mysql_error();
      $err++;
} 

}

//echo $qr;
$exwcq=mysql_query($qr);
$sbid=mysql_insert_id();

if($_POST['updid']!="")
{
    $Subid=$_POST['updid'];
}else
{
    $Subid=$sbid;
}
  $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Add','slider Product upload','".$curr_dt."','".$_SESSION['lastSubID']."','". $Subid." ','top_right_slider') ");
		
	
    

if(!$exwcq)
{
     echo mysql_error();
   $err++;
}



if($err==0)
{
    echo 1;
    
mysql_query("COMMIT");
}else
{
    echo 0;
    
mysql_query("ROLLBACK");
}
?>