<?php
$state=$_GET['state'];
include_once('class_files/database_connection.php');
$conn=new database_connection();
$conn->open_connection('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts');
require_once('class_files/new_site.php');
$newsite_obj=new new_site();
$table=$newsite_obj->drop_down("localhost","satyavan_acc","Myaccounts123*","satyavan_accounts","state_id","state","state",$state,"cities","city");

       
              /*$qry="select * from state where state_id='$state'";
              $res=mysqli_query($con,$qry);   */             
              //$num=mysqli_num_rows($table);
			  
			  
$out="<select name='city' id='city'>
<option value='0'>select city</option>";
while($row=mysqli_fetch_row($table)){
	//echo $row[0];
	$out.="<option value='$row[0]'>$row[0]</option>";
	}
   /* for ($i=0; $i<$num; $i++) 
                {
                 $city = mysqli_result($table,$i,"city"); 
                // $city = mysqli_result($res,$i,"city"); 
$out=$out."<option value=".$city.">".$city."</option>";
 // $out=$out."=".$ccode;
               }*/
$out=$out."</select>";
echo $out;  
//$conn->close_connection();
?>