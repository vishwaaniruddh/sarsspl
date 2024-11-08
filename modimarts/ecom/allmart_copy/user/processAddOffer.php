<?php

session_start();		

include('config.php');

$ccode=$_POST['ccode'];

//$pcode=$_POST['pcode'];

$oname=$_POST['oname'];

 if($oname=='') {?>
  <script>
  alert('Title Field Can not leave as Blank');
  window.location='add_offer.php';
  </script>
<?php
 }
$odesc=$_POST['odesc'];

 $frmdate=$_POST['frmdate'];

 $tilldate=$_POST['tilldate'];  
 if($frmdate==''||$tilldate=='') {?>
  <script>
  alert('Date Field Can not leave as Blank');
  window.location='add_offer.php';
  </script>
<?php }
if(basename( $_FILES['oimg']['name']) ) 
{//echo "image";


 $dir = "offers/".$ccode; 
 if (!is_dir($dir)) {
    mkdir($dir);         
}
$max=rand(10000000000,100000);
$min=rand(10000,10);
$img=rand($max,$min);
$tar=$img.".jpg";
 $t1=$dir."/".$img.".jpg"; 
 //$t1=$dir.$target1; 

if(!move_uploaded_file($_FILES['oimg']['tmp_name'], $t1)) 

 { echo "The file ". basename( $_FILES['oimg']['name']). " has not uploaded"; 

$ok1=0; }  

 }

        	

//echo "here";

//	echo "in try";  		

	  $qry="INSERT INTO `offers`(`offer_id`, `cust_id`, `title`, `off_image`, `frm_date`, `till_date`, `description`) VALUES ('','$ccode','$oname','$tar',STR_TO_DATE('".$frmdate."','%d/%m/%Y'),STR_TO_DATE('".$tilldate."','%d/%m/%Y'),'$odesc')";			 

            //	 echo $qry;
			    $res=mysqli_query($con1,$qry); 

                               if($res)

	{ 

  	 header('Location: view_offers.php' );              

	} 	

                  else

                 {    

	  echo "Error Occured, Please go back and try again".mysqli_error($con1);

	}     	                        

 



?>