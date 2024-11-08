<?php
include("config.php");
$qr="";
 $getdetrs=mysql_query("select * from products where code='".$_POST['newid']."'");
    $prdetsrw=mysql_fetch_array($getdetrs);
if(isset($_POST['typ']) & $_POST['typ']!="")
{
  
    $qr="delete from latest_featured_product  where id='".$_POST['updid']."' and typ='".$_POST['typ']."'";
  
}
else
{
 
 if($_POST['str']=="deals")
    {
        
         $qr="delete from deals_of_the_day where deal_id='".$_POST['updid']."'";
      
        
    }
    elseif($_POST['str']=="toprating")
    {
       
         $qr="delete from top_rating_details where id='".$_POST['updid']."'";
    }
    
}
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