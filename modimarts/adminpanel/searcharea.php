<?php
/*
session_start();
    ob_start();
        if(!isset($_SESSION['admin'])) {
        header('Location:index.php');    
        exit;
    }*/
include('config.php');

       $search=$_GET['search'];
       $city=$_GET['city'];
              if($search){
              $qry="SELECT name as suggest FROM areas WHERE name like('" . $search . "%') and city='$city' ORDER BY name";
              $res=mysql_query($qry);                
            //  $num=mysql_num_rows($res);

	while($suggest = mysql_fetch_array($res, MYSQL_ASSOC)) {
		//Return each page title seperated by a newline.
		echo $suggest['suggest']."\n";
	}
   }
?>