<?php
session_start();
include "config.php"; 
 if(isset($_SESSION['SESS_USER_NAME']) && isset($_SESSION['id'])){ 
     
$p_Other=mysqli_real_escape_string($con3,$_POST['editor1']);
$pbrand=$_POST['pbrand'];    
$LongDesc=$_POST['editor'];
$P_desc=$_POST['P_desc'];

$spfc=$_POST['specification'];
$spfc1=$_POST['specification1'];
$vid=$_POST['id'];
$catid=$_POST['catid'];
$pcode=$_POST['prodid'];
$ccode=$_POST['ccode'];
 

$qrya="select * from main_cat where id='".$catid."'";
 $resulta=mysql_query($qrya);
 $rowa = mysql_fetch_row($resulta);
$aa=$rowa[2];

   
if($aa!=0){
    
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysql_query($qrya1);
 $rowa1 = mysql_fetch_row($resulta1);
    $Maincate= $rowa1[4];
   
} 


if($Maincate==1){
    $qry="UPDATE `fashion` SET `description`='$p_Other',`brand`='$pbrand',`others`='$P_desc',Long_desc='$LongDesc' WHERE code='$pcode' and ccode='$ccode'";	
 }
else if($Maincate==190){
    $qry="UPDATE `electronics` SET `description`='$p_Other',`brand`='$pbrand',`others`='$P_desc',Long_desc='$LongDesc' WHERE code='$pcode' and ccode='$ccode'";	//echo $qry;
    }
else if($Maincate==218){
    $qry="UPDATE `grocery` SET `description`='$p_Other',`brand`='$pbrand',`others`='$P_desc',Long_desc='$LongDesc' WHERE code='$pcode' and ccode='$ccode'";	
}

else{
   $qry="UPDATE `products` SET `description`='$p_Other',`brand`='$pbrand',`others`='$P_desc',Long_desc='$LongDesc' WHERE code='$pcode' and ccode='$ccode'";		
}


$res=mysql_query($qry); 
           
      
    if($Maincate==1)
    {
        for($i=0;$i<count($spfc);$i++)
                         {  
                      $qry1=mysql_query("update  fashionSpecification set product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'");
                     }
        
    }else if($Maincate==190)
    {
        for($i=0;$i<count($spfc);$i++)
                         {  
                      $qry1=mysql_query("update  electronicsSpecification set product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'");
                     }
        
    }else if($Maincate==218)
    {
        for($i=0;$i<count($spfc);$i++)
                         {  
                      $qry1=mysql_query("update  grocerySpecification set product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'");
                     }
        
    }else 
    {
        for($i=0;$i<count($spfc);$i++)
                         {  
                      $qry1=mysql_query("update  productspecification set product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'");
                     }
        
    }

if($res && $qry1){
     echo "<script>window.close();</script>";
    header('Location: productapproval.php');
    
}

}
?>