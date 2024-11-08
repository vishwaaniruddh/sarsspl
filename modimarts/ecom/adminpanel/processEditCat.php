<?php
session_start();
include('config.php');

$code=$_POST['cid'];
$cname=$_POST['cname'];
$key=$_POST['add1'];
$sn=$_POST['sn'];
          //  echo " ".$code."-".$cname."-".$key;            
			try{  
			  $qry="update main_cat set name='$cname',under='$code' where id='$sn'";
			  $res=mysql_query($qry);
			  $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Edit','Edit Category From Category Table','".$curr_dt."','".$_SESSION['lastSubID']."','". $sn." ','main_cat') ");
		
	
			  
                 if($res){
?>
		 <script>alert("category updated successfully!!");
		 window.open('sub_cat.php','_self');
		 </script>
		 <?php

  
				}

                  else
{
                 ?>
		 <script>alert("Try again!!");
		 window.open('editSub_cat.php?cmp=<?php echo $sn; ?>','_self');
		 </script>
		 <?php
  
}
                          }catch(Exception $e)
                           {
                             echo 'Message: ' .$e->getMessage();
                           }
?>
<p>&nbsp;</p>