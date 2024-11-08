<?php
$city=$_GET['city'];
include_once('class_files/database_connection.php');
$conn=new database_connection();
$conn->open_connection('localhost','site','site','atm_site');
require_once('class_files/new_site.php');
$newsite_obj=new new_site();
$table=$newsite_obj->drop_down("localhost","site","site","atm_site","city_id","city","city",$city,"area","area");
       
              /*$qry="select * from state where state_id='$state'";
              $res=mysql_query($qry);   */             
              //$num=mysql_num_rows($table);
			  
			  
$out="<select name='area' id='area'>
<option value='0'>select area</option>";
while($row=mysql_fetch_row($table)){
	//echo $row[0];
	$out.="<option value='$row[0]'>$row[0]</option>";
	
	}
   /* for ($i=0; $i<$num; $i++) 
                {
                 $city = mysql_result($table,$i,"city"); 
                // $city = mysql_result($res,$i,"city"); 
$out=$out."<option value=".$city.">".$city."</option>";
 // $out=$out."=".$ccode;
               }*/
$out=$out."</select>";
echo $out;  
//$conn->close_connection();
?>