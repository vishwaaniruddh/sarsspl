<?php
include("config.php");
$qr="";
 $getdetrs=mysql_query("select * from Productviewtable where code='".$_POST['newid']."'");
$prdetsrw=mysql_fetch_array($getdetrs);
if(isset($_POST['typ']) & $_POST['typ']!="")
{
   if($_POST['updid']!="")
   {
    $qr="update latest_featured_product set cat_id='".$prdetsrw['category']."',product_id='".$_POST['newid']."' where id='".$_POST['updid']."' and typ='".$_POST['typ']."'";
   }else
   {
      $qr="insert into latest_featured_product(cat_id,product_id,typ) values ('".$prdetsrw['category']."','".$_POST['newid']."','".$_POST['typ']."')";  
   }
}
else
{
   // echo "ok1";
    if($_POST['str']=="deals")
    {
      if($_POST['updid']!="")
   {
    $qr="update deals_of_the_day set cat_id='".$prdetsrw['category']."',product_id='".$_POST['newid']."' where deal_id='".$_POST['updid']."'";
   }else
   {
      $qr="insert into deals_of_the_day(cat_id,product_id) values ('".$prdetsrw['category']."','".$_POST['newid']."')";  
   }  
        
    }
    elseif($_POST['str']=="toprating")
    {
       
       if($_POST['updid']!="")
   {
    $qr="update top_rating_details set cat_id='".$prdetsrw['category']."',product_id='".$_POST['newid']."' where id='".$_POST['updid']."'";
   }else
   {
      $qr="insert into top_rating_details(cat_id,product_id) values ('".$prdetsrw['category']."','".$_POST['newid']."')";  
   }   
        
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