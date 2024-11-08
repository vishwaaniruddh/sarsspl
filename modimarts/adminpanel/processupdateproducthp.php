<?php
include("config.php");
$qr="";
 $getdetrs=mysql_query("select code from products where code='".$_POST['newid']."'");
$prdetsrw=mysql_fetch_array($getdetrs);

    if($_POST['str']=="pro")
    {
      if($_POST['updid']!="")
   {
    $qr="update product_sideslide set pid='".$prdetsrw['code']."' where id='".$_POST['updid']."'";
    
    
   }else
   {
      $qr="insert into product_sideslide(pid) values ('".$_POST['newid']."')";  
   }  
        
    }
    
    
    

//echo $qr;
$exwcq=mysql_query($qr);
if($exwcq)
{
    echo 1;
}
else
{
    echo 2;
}

?>