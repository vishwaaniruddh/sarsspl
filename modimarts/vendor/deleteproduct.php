<?php

session_start();    

include('config.php');
$cid=$_SESSION['id'];
$errors=0;
$pcode=$_GET['pcode'];
$pcat=$_GET['cat'];

mysqli_begin_transaction($con1);
$fetch=mysqli_query($con1,"select photo from `products` where `code`='$pcode' and ccode='$cid'");
$row=mysqli_fetch_row($fetch);
  
  
if($pcat==1)
{
    $qry="DELETE from `fashion` WHERE `code`='$pcode' and ccode='$cid'";    
}
else if($pcat==190)
{
    $qry="DELETE from `electronics` WHERE `code`='$pcode' and ccode='$cid'";    
}
else if($pcat==218)
{
     $qry="DELETE from `grocery` WHERE `code`='$pcode' and ccode='$cid'";   
}
else
{
 $qry="DELETE from `products` WHERE `code`='$pcode' and ccode='$cid'";    
}
  
   

                $res=mysqli_query($con1,$qry); 

    if($res)
  { 
      
      
$slting=mysqli_query($con1,"SELECT * FROM `product_img` where product_id='".$pcode."'");
while($sltingf=mysqli_fetch_array($slting))
{
    if($sltingf["img"]!="")
      {
     if (file_exists("../".$sltingf["img"])) 
      {
     unlink("../".$sltingf["img"]);
      }
      }
      
      if($sltingf["thumbs"]!="")
      {
      if (file_exists("../".$sltingf["thumbs"])) 
      {
      unlink("../".$sltingf["thumbs"]);
      }
      }
       if($sltingf["midsize"]!="")
      {
      if (file_exists("../".$sltingf["midsize"])) 
      {
      unlink("../".$sltingf["midsize"]);
      }
      }
    
}
  
$qry2="DELETE from `product_img` WHERE product_id='".$pcode."'";       

//                $res2=mysqli_query($con1,$qry2); 

mysqli_commit($con1);

    ?>
    <script>
    alert("Product deleted successfully");
    window.open("view_products.php","_self");
  //  window.location ='view_products.php';              
</script><?php
  } 
    else
    {    
        
mysqli_rollback($con1);
    echo "Error Occured, Please go back and try again";
    }                               
  
?>