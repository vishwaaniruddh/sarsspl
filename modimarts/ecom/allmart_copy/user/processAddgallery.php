<?php

session_start();		

include('config.php');
$cid=$_SESSION['id'];
if(basename( $_FILES['bimg']['name']) ) 

{//echo "image";

 $dir = "gallery/".$cid; 
 if (!is_dir($dir)) {
    mkdir($dir);         
}
$max=rand(10000000000,100000);
$min=rand(10000,10);
$img=rand($max,$min);
 $t1="gallery/".$cid."/".$img.".jpg"; 
$new=$img.".jpg";
if(!move_uploaded_file($_FILES['bimg']['tmp_name'], $t1)) 

 { echo "The file ". basename( $_FILES['bimg']['name']). " has not uploaded"; 

$ok1=0; }  

 

        	


//echo "here";

//	echo "in try";  		

	  $qry="INSERT INTO `gallery`(`img_id`, `cust_id`, `image`, `albumid`, `date_added`) VALUES ('','$cid','$new','',now())";			 

                $res=mysqli_query($con1,$qry); 

                               if($res)

	{ 

  	 header('Location: view_gallery.php' );              

	} 	

                  else

                 {    

	  echo "Error Occured, Please go back and try again";

	}     	                        

}
else
header('Location: view_gallery.php' );

?>