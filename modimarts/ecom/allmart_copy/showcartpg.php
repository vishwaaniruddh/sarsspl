<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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
 include("config.php");
    // echo "select sum(qty) from cart where user_id='".$_SESSION['gid']."' and status=0";
    $qryc=mysqli_query($con1,"select sum(qty),sum(final_amt) from cart where user_id='".$_SESSION['gid']."' and status=0");
    
   // echo "select sum(qty),sum(final_amt) from cart where user_id='".$_SESSION['gid']."' and status=0";
    
$fetchc=mysqli_fetch_array($qryc);

$totqt=0;
$totamt=0;
if($fetchc[0]!=null)
{
    $totqt=$fetchc[0];
    $totamt=$fetchc[1];
}
                            ?>
                            
                            <style>     
 .trash{transition:opacity 200ms;opacity:0.8;position:relative;right:0;vertical-align:middle;cursor:pointer;margin:-20px auto 10px}  
 .trash > .lid{transform-origin:10% 100%;transition:transform 10ms;height:9px;width:128px;-webkit-transform-origin:-7% 100%}  
 .trash > .can{background-position:0 -10px!important;width:128px;height:23px;margin:10px 0 0;padding:0!important}  
 .trash > .can,.trash > .lid{background:url(image/dustbin_big.png) 0 0 no-repeat;position:absolute;right:8px;top:2px;-webkit-transform:rotate(0deg);-webkit-transition:-webkit-transform 250ms}  
 .trash > .can:hover{border:none!important;box-shadow:none!important}  
 .trash > span{display:inline-block}  
 .trash:focus > .lid,.trash:hover > .lid{transform:rotate(-45deg);transition:transform 250ms;-webkit-transform:rotate(-45deg);-webkit-transition:-webkit-transform 250ms} 
 
 </style>
                         
                           
    <div id="cart-top" class="cart-top pull-right">
    <div id="cart" class="clearfix" style="width: 174px;">
    <div data-toggle="dropdown" data-loading-text="Loading..." class="heading media dropdown-toggle">
      <div class="pull-left">
        <i class="icon-cart fa fa-shopping-cart"></i>
      </div>
      <div class="cart-inner media-body">
        <b class="text-cart" ><font color="white">My cart</font></b>
        <p>
          <span id="cart-total" class="cart-total"><font color="white"><?php echo $totqt;?>item(s) :<i class="fa fa-inr"></i> <?php echo round($totamt,$roundupto);?></span></font>
          <i class="fa fa-angle-down"></i>
        </p>
      </div>
    </div>
    <?php
   // echo "select * from cart where user_id='".$_SESSION['gid']."' and status=0";
     $cartdets=mysqli_query($con1,"select * from cart where user_id='".$_SESSION['gid']."' and status=0");
     
   $nrwss1=mysqli_num_rows($cartdets);
   //echo $nrwss1;
    if($nrwss1==0)
    {
    ?>
    <ul class="dropdown-menu content">
            <li>
        <p class="text-center">Your shopping cart is empty!</p>
        
      </li>
          </ul>
          <?php }else
          {
          
         
          ?>
          
          
          <ul class="dropdown-menu content"><li>
       <!-- <table class="table">-->
       <table >
                    <tbody>
        <?php
  $totfamt=0;  
 
while($cartdetsrw=mysqli_fetch_array($cartdets))
{
    
     //================ query for  get category which is under '0' ============

$qrya="select * from main_cat where id='".$cartdetsrw['cat_id']."'";
 $resulta=mysqli_query($con1,$qrya);
 $rowa = mysqli_fetch_row($resulta);
$aa=$rowa[2];

   
if($aa!=0){
    
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysqli_query($con1,$qrya1);
 $rowa1 = mysqli_fetch_row($resulta1);
    $Maincate= $rowa1[4];
   
} 
//===============================================================  

    
    if($Maincate==1){
     $getprdets=mysqli_query($con1,"select * from fashion where code='".$cartdetsrw['pid']."'");
      $prdrws=mysqli_fetch_array($getprdets);
      
      //code for image show in cart
        $getprdets1=mysqli_query($con1,"select img from fashion_img where product_id='".$cartdetsrw['pid']."'");
         $prdrws1=mysqli_fetch_array($getprdets1);
    }
    else if($Maincate==190)
    {  
       $getprdets=mysqli_query($con1,"select * from electronics where code='".$cartdetsrw['pid']."'");
      $prdrws=mysqli_fetch_array($getprdets);
      
      //code for image show in cart
        $getprdets1=mysqli_query($con1,"select img from electronics_img where product_id='".$cartdetsrw['pid']."'");
         $prdrws1=mysqli_fetch_array($getprdets1);
    }  
     else if($Maincate==218)
    {  
       $getprdets=mysqli_query($con1,"select * from grocery where code='".$cartdetsrw['pid']."'");
      $prdrws=mysqli_fetch_array($getprdets);
      
      //code for image show in cart
        $getprdets1=mysqli_query($con1,"select img from grocery_img where product_id='".$cartdetsrw['pid']."'");
         $prdrws1=mysqli_fetch_array($getprdets1);
    }    
     else 
    {  
       $getprdets=mysqli_query($con1,"select * from products where code='".$cartdetsrw['pid']."'");
      $prdrws=mysqli_fetch_array($getprdets);
      
      //code for image show in cart
        $getprdets1=mysqli_query($con1,"select img from product_img where product_id='".$cartdetsrw['pid']."'");
         $prdrws1=mysqli_fetch_array($getprdets1);
    }    
      
        ?>
        <tr style="border-bottom:1pt solid #F5F5F5;padding:15px" >
            <td class="text-left" >
            <a href="details.php?id=<?php echo $prdrws['code'];?>"><img style="border: 2px solid #F5F5F5;padding: 5px; width: 70px;height: 70px;  " src="<?php echo $prdrws1[0];?>" alt="" title=""></a>
            </td>
             <td class="text-left" style="padding-left:10px;padding-bottom: 10px;width:160px">
             <a href="details.php?id=<?php echo $prdrws['code'];?>" ><?php echo $prdrws['name'];?></a>
             
             <p > QTY:  <?php echo $cartdetsrw['qty'];?></p> 
             <p > Price: <?php echo $cartdetsrw['final_amt'];$totfamt=$totfamt+$cartdetsrw['final_amt']; ?></p> <br />
           </td>
            <td class="text-right" style="width: 20%;padding-left:10px;padding-bottom: 10px;">
           <!--  <button type="button" onclick="remfromcart('<?php echo $cartdetsrw['id'];?>');" title="Remove" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
             -->
               <div class="trash" title="Remove" onclick="remfromcart('<?php echo $cartdetsrw['id'];?>');"><span class="lid" style="width:26px"></span><span class="can" style="width:26px"></span></div>
                   
             
              </td>
           <?php /* Ruchi : 8 August 19
           <td class="text-left" style="width: 40%;padding-left:10px;padding-bottom: 10px;"><a href="details.php?id=<?php echo $prdrws['code'];?>"><?php echo $prdrws['name'];?></a></td>
                         
            <td class="text-right" style="white-space: nowrap;padding-left:10px">x  <?php echo $cartdetsrw['qty'];?> = </td>
            <td class="text-right" style="width: 10%;padding-left:10px"><?php echo $cartdetsrw['final_amt'];$totfamt=$totfamt+$cartdetsrw['final_amt'];?></td>
          <td class="text-right" style="padding-left:5px;padding-right:5px"><button type="button" onclick="remfromcart('<?php echo $cartdetsrw['id'];?>');" title="Remove" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td> 
         */?>
         
          </tr>
        
           <?php } ?>  
                            </tbody>
        </table>
      </li>
     
      <li>
        <div class="table-responsive">
          <table class="table table-v4">
                        <tbody>
                            <!--<tr>
              <td class="text-right"><strong>Sub-Total</strong></td>
              <td class="text-right">$12,333.00</td>
            </tr>-->
                        <tr>
              <td class="text-right"><strong>Total</strong></td>
              <td class="text-right"><?php echo round($totfamt,$roundupto);?> </td>
              
             
            </tr>
           
        
        
        
                      </tbody></table>
          <p class="text-center">
           <!-- <a href="cart.php" class="btn btn-primary">
              View Cart            </a><br>-->
              
              
            <!--<a href="Checkout.php" class="btn btn-primary">
              Checkout</a>-->
              <a href="paymentProcess.php" class="btn btn-primary">
              Checkout</a>
          </p>
        </div>
      </li></ul>
      <?php } ?>
      </div>