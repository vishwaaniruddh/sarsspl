<?php
session_start();
/*
session_start();
	ob_start();
		if(!isset($_SESSION['admin'])) {
		header('Location:index.php');	
		exit;
	}*/
include('config.php');

$code=$_POST['code'];
//echo "ram".$code;
$cname=$_POST['cname'];
//echo $cname;
$key=$_POST['add1'];


          //  echo " ".$code."-".$cname."-".$key;            
			try{  
			  $qry="insert into cities(`state_code`, `name`, `keywords`) values('".$code."','".$cname."','".$key."')";
			  $res=mysql_query($qry);
			  //echo $qry;
			  
			$sublastid= mysql_insert_id();
    $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Add','Add City In City Table','".$curr_dt."','".$_SESSION['lastSubID']."','". $sublastid." ','cities') ");
		
	
			  
			  
                if($res){
                $a="insert succsessfully";
echo "<script type='text/javascript'>alert('$a');</script>";
		 
//'<script>window.open("cities.php")</script>';
echo '<script>window.open("cities.php", "_self" )</script>';



//header('Location:cities.php');  
}
                  else
                 {
echo "Error Occured";
                 }
 	
                          }catch(Exception $e)
                           {
                             echo 'Message: ' .$e->getMessage();
                           }
?>
