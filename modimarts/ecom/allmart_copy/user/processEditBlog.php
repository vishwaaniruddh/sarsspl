<?php

session_start();		

include('config.php');
$cid=$_SESSION['id'];

$title=$_POST['title'];
$bid=$_GET['bid'];
$desc=$_POST['desc'];
       // echo " ".$ccode."-".$pname."-".$pcode; 
$old=$_POST['oldimg'];

if(basename( $_FILES['bimg']['name']) ) 

{//echo "image";

 $dir = "blog/".$cid; 
 if (!is_dir($dir)) {
    mkdir($dir);         
	}
$max=rand(10000000000,100000);
$min=rand(10000,10);
$img=rand($max,$min);
 $t1="blog/".$cid."/".$img.".jpg"; 
$new=$img.".jpg";

if(!move_uploaded_file($_FILES['bimg']['tmp_name'], $t1)) 
 { 
 echo "The file ". basename( $_FILES['bimg']['name']). " has not uploaded"; 
}  


}
else 
{		//echo "else part";
		$new=$old;
}        	


//echo "here";

//	echo "in try";  		

	  $qry="UPDATE `blog` SET `title`='$title',`discription`='$desc',`image`='$new',`date`=now() WHERE blog_id='$bid'";			 

                $res=mysqli_query($con1,$qry); 

                               if($res)

	{ 
			if(basename( $_FILES['bimg']['name']) ) 
			{unlink("blog/".$cid."/".$old);}
		?>	<script>
  	 window.location ='view_blog.php';              
</script><?php
	} 	

                  else

                 {    

	  echo "Error Occured, Please go back and try again";

	}     	                        




?>