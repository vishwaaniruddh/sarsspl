<?php

session_start();
if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{	
$id=$_SESSION['id'];

include "config.php"; 
}
else{
	header('location:index.php');
	}
$oname=$_POST['oname'];
$offid=$_POST['offid'];
 if($oname==''){?>
  <script>
  alert('Title Field Can not leave as Blank');
  window.location='view_offers.phpoffid=<?php echo $offid; ?>';
  </script>
<?php
 }
$odesc=$_POST['odesc'];

 $frmdate=$_POST['frmdate'];
 $oldimg=$_POST['oldimg'];

 $tilldate=$_POST['tilldate'];  
 if($frmdate==''||$tilldate==''||$frmdate=='00-00-0000'||$tilldate=='00-00-0000') {?>
  <script>
  alert('Date Field Can not leave as Blank');
  window.location='view_offers.php';
  </script>
<?php }
if(basename( $_FILES['oimg']['name']) ) 

{//echo "image";


 $dir = "offers/".$id; 
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
unlink('offers/'.$id.'/'.$oldimg);
 }
else
{
	$tar=$oldimg;
}
        	

//echo "here";

//	echo "in try";  		

	  $qry="UPDATE `offers` SET `title`='$oname',`off_image`='$tar',`frm_date`=STR_TO_DATE('".$frmdate."','%d/%m/%Y'),`till_date`=STR_TO_DATE('".$tilldate."','%d/%m/%Y'),`description`='$odesc' where offer_id='$offid'";			 

            // echo $qry;
			   $res=mysqli_query($con1,$qry); 

                               if($res)

	{ 

  	 header('Location: view_offers.php');              

	} 	

                  else

                 {    

	  echo "Error Occured, Please go back and try again".mysqli_error($con1);

	}     	                        

 



?>