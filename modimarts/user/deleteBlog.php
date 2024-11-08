<?php

session_start();		

include('config.php');
$cid=$_SESSION['id'];

$bid=$_GET['bid'];

$fetchblog=mysqli_query($con1,"select image from `blog` where `blog_id`='$bid'");
$row=mysqli_fetch_row($fetchblog);
	
	  $qry="DELETE from blog WHERE blog_id='$bid'";			 

                $res=mysqli_query($con1,$qry); 

    if($res)
	{ 
	unlink("blog/".$cid."/".$row[0]);
		?>	<script>
  	 window.location ='view_blog.php';              
</script><?php
	} 
	  else
	  {    
		echo "Error Occured, Please go back and try again";
		}     	                        
	
?>
<font color="#CCFF33">