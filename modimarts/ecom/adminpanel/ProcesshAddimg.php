<?php
include('../config.php');

//$banner=$_POST['banner'];
$pos=$_POST['pid'];
$cnt=$_POST['count'];
//$key=$_POST['add1'];
          //  echo " ".$code."-".$cname."-".$key;            
if(basename( $_FILES['banner']['name']) )
 {//echo "image";
 $target1 = basename( $_FILES['banner']['name']); 
 $t1="HomeImage/".$target1;
 $path=$mainpath."HomeImage/".$target1;
 
 if(!move_uploaded_file($_FILES['banner']['tmp_name'], $path)) 
 {
 echo "The file ". basename( $_FILES['banner']['name']). " has not uploaded";
 
 } 
			
			  $qry="insert into HomePageImage(id,name,count) values('".$pos."','".$t1."',".$cnt.")";
			  $res=mysql_query($qry);
			 // echo mysql_error();
			 // echo $qry;
                if($res){
		 
header('location:ViewHomePageImg.php?pos='.$pos);
//  echo $pos;
 	
				}else
                 
echo "Error Occured";
  
 	
                          
 }
?>
