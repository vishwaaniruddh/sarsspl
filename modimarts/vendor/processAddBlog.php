<?php

session_start();		

include('config.php');
$cid=$_SESSION['id'];

$title=$_POST['title'];

$desc=$_POST['desc'];
       // echo " ".$ccode."-".$pname."-".$pcode; 

$ok1=1; $ok2=1; $ok3=1; 

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

 { echo "The file ". basename( $_FILES['bimg']['name']). " has not uploaded"; 

$ok1=0; }  

 }

        	


//echo "here";

//	echo "in try";  		

	  $qry="INSERT INTO `blog`(`blog_id`, `title`, `discription`, `cust_id`, `image`, `date`) VALUES ('','$title','$desc','$cid','$new',now())";			 

                $res=mysqli_query($con1,$qry); 

                               if($res)

	{ 

  	 header('Location: view_blog.php' );              

	} 	

                  else

                 {    

	  echo "Error Occured, Please go back and try again";

	}     	                        




?>