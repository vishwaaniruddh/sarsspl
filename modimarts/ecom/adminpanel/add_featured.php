<?php
include('config.php');

//$banner=$_POST['banner'];
//$pos=$_POST['pid'];
$typ=$_POST['typ'];
$pid=$_POST['productid'];

$sltqry=mysql_query("select * from products where code='".$pid."'");
$sltqryr=mysql_num_rows($sltqry);

if($sltqryr>0){
$sltqryarr=mysql_fetch_array($sltqry);

$chkqry=mysql_query("select * from latest_featured_product where cat_id='".$sltqryarr['category']."' and product_id='".$pid."' and typ='".$typ."'");
$chkqryr=mysql_num_rows($chkqry);
if($chkqryr==0){

$qry="INSERT INTO `latest_featured_product`(`cat_id`, `product_id`, `typ`) VALUES ('".$sltqryarr['category']."','".$pid."','".$typ."')";
			        	// echo $qry;
			  $res=mysqli_query($con3,$qry);
			  
			   if($res!=""){
	 header('location:fetcher_product.php?');
//  echo $pos;

 	
				}else{
             echo mysqli_error($con3);	    
echo "Error Occured";
  
 	
                          
 }
			  
}else{
    ?>
    <script>
    alert("Already exist!!");
    window.open('fetcher_product.php','self');
    </script>
    <?php
    
}
			  

               
 }else{
    ?>
    <script>
    alert("This product not in product list!!");
    window.open('fetcher_product.php','self');
    </script>
    <?php 
  
    
 }
?>
