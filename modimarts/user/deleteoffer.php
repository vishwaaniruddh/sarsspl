<?php

session_start();		

include('config.php');
$cid=$_SESSION['id'];

$offid=$_GET['offid'];

$fetch=mysqli_query($con1,"select `off_image` from `offers` where `offer_id`='$offid' and cust_id='$cid'");
$row=mysqli_fetch_row($fetch);
	
	  $qry="DELETE from `offers` WHERE `offer_id`='$offid' and cust_id='$cid'";			 

                $res=mysqli_query($con1,$qry); 

    if($res)
	{ 
	if($row[0]!="")
	unlink("offers/".$cid."/".$row[0]);
	
		?>	<script>
  	window.location ='view_offers.php?offid=<?php echo $offid;?>';              
</script><?php
	} 
	  else
	  {    
		echo "Error Occured, Please go back and try again";
		}     	                        
	
?>