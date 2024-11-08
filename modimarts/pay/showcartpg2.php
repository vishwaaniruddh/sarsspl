<?php 
if (version_compare(phpversion(), '5.4.0', '<')) {
     if($_SESSION['gid'] == '') {
        session_start();
     }
 }
 else
 {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
 }
 include("../config.php");

$userid = $_SESSION['gid'];

?>

<script>
setInterval(function(){ 
    

<? $qryc=mysqli_query($con1,"select sum(qty),sum(final_amt) from cart where user_id='".$_SESSION['gid']."' and status=0");
    
    
$fetchc=mysqli_fetch_array($qryc);



$totqt=0;
$totamt=0;
if($fetchc[0]!=null)
{
    $totqt  = $fetchc[0];
    echo $totamt = $fetchc[1];
    }




        $sql = mysqli_query($con1,"select count(id) as wish_count from wishlist where user_id='".$_SESSION['gid']."'");
        $sql_result = mysqli_fetch_assoc($sql);
        $wish_count = $sql_result['wish_count'];
    
    
    
?>    
    
    
}, 3000);    
</script>






            <a href="https://allmart.world/wishlist.php"><img class="custom-wl-image" src="https://allmart.world/assets/white_heart.png">
                    <div class="header-cart-count"><?php echo $wish_count;?></div>
            </a>                            
            

                            
<a href="https://allmart.world/new_paymentProcess.php" class="black-cart"><img class="custom-cart-image" src="https://allmart.world/assets/white.png" alt="">
<div class="header-cart-count"><?php echo $totqt;?></div>

</a>

<a href="https://allmart.world/new_paymentProcess.php" class="white-cart"><img class="custom-cart-image" src="https://allmart.world/assets/white.png" alt="">
<div class="header-cart-count"><?php echo $totqt;?></div>

</a>

