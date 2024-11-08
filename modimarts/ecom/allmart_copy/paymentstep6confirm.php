<?php
session_start();
include('config.php');
?>
<form method="post" id="confirmordpg" name="confirmordpg" action="">
<div class="panel-body" style="margin-right: 17px;"><div class="table-responsive">
  <table class="table table-bordered table-hover" style="background-color:#f3f3f3;width: 90%;">
    <thead>
      <tr>
        <td class="text-left">Product Name</td>
        <td class="text-left">Name</td> 
        <td class="text-left" id="hiddcolr">Color</td>
        <td class="text-left">Size</td>
        <td class="text-right">Quantity</td>
        <td class="text-right">Unit Price</td>
        <td class="text-right">Total</td>
      </tr>
    </thead>
    <tbody>
        <?php
         
if( $_GET["pid"] !="" &&  $_GET["cid"]!="" && $_GET["qty"]!="" )
{

         $getprdets=mysqli_query($con1,"select * from Productviewtable where code='".$_GET["pid"]."' and category='".$_GET["cid"]."' ");
         $prdrws=mysqli_fetch_array($getprdets);
   
         $getprdets1=mysqli_query($con1,"select img,thumbs from Productviewimg where product_id='".$_GET["pid"]."' and category='".$_GET["cid"]."' ");
         $prdrws1=mysqli_fetch_array($getprdets1);
       
         $getprcolor=mysqli_query($con1,"select * from fashioncolor where id='".$_GET["clr"]."'");
         $pcolor=mysqli_fetch_array($getprcolor);
     
     ?>  
       
       
    <tr>
        <td class="text-center"> 
                
                <a href="details.php?prid=<?php echo $prdrws['code'];?>"><img style="width:100px;height:100px;" src="<?php echo $prdrws1['thumbs'];?>" alt="" title="<?php echo $prdrws['name'];?>" class="img-thumbnail" /></a>
                
                  </td>
                <td class="text-left"><a href="details.php?id=<?php echo $prdrws['code'];?>"><?php echo $prdrws['name'];?></a>
                                                                        </td>
                   <?php if($_GET["clr"]==""){?>
                    <td class="text-right" id="hiddcolr"><?php echo "NA";?></td>
                    <?php } else{ ?>
                   
                    <td class="text-right" id="hiddcolr"><?php echo $pcolor['color'];?></td>
                    <?php }?>
                    
                    
                    <?php if($_GET["sz"]==""){?>
                    <td class="text-right"><?php echo NA;?></td>
                <?php } else{ ?>
                   
                  <td class="text-right"><?php echo $_GET["sz"];?></td>
                   <?php }?>
                    
                   
                    <td class="text-right"><?php echo $_GET["qty"];?></td>
                <td class="text-right"><?php echo $prdrws['total_amt'];?></td>
                <td class="text-right"><?php echo $totfamt=$prdrws['total_amt']*$_GET["qty"];?></td>
                
      </tr>
       <input type="hidden" name="prdid" id="prdid" value="<?php echo $_GET["pid"];?>">
  <input type="hidden" name="cate_id" id="cate_id" value="<?php echo $_GET["cid"];?>">
   <input type="hidden" name="pric" id="pric" value="<?php echo $totfamt;?>">
      <input type="hidden" name="qtty" id="qtty" value="<?php echo $_GET["qtty"];?>">
   
    
       <input type="hidden" name="cCod" id="cCod" value="<?php echo $_GET["clr"];?>">
  <input type="hidden" name="cSize" id="cSize" value="<?php echo $_GET["sz"];?>">
      
    
                </tbody>
    <tfoot>
        <!--    <tr>
        <td colspan="4" class="text-right"><strong>Sub-Total:</strong></td>
        <td class="text-right">$12,333.00</td>
      </tr>
            <tr>
        <td colspan="4" class="text-right"><strong>Flat Shipping Rate:</strong></td>
        <td class="text-right">$5.00</td>
      </tr>-->
            <tr>
        <td colspan="6" class="text-right"><strong>Total:</strong></td>
        <td class="text-right"><i class="fa fa-inr"> <?php echo $totfamt;?></td>
      </tr>
          </tfoot>
  </table>
  <input type="hidden" name="cartids" id="cartids" value="<?php echo $cartids;?>">
 
  <input type="hidden" name="orderno" id="orderno" >
</div>
<div class="buttons">
  <div class="pull-right">
    <input value="Confirm Order" id="button-confirm" style="padding:20px 71px;" class="btn btn-primary" data-loading-text="Loading..." type="button"  onclick="confirmfunc420();">
  </div>
</div>
<script type="text/javascript"><!--
//--></script>
</div>
</form>
       
         

  <?php      
 } else{
//echo "select * from cart where user_id='".$_SESSION['gid']."' and status=0";
 $cartdets=mysqli_query($con1,"select * from cart where user_id='".$_SESSION['gid']."' and status=0");
   $nrwss1=mysqli_num_rows($cartdets);
    if($nrwss1>0)
    {
    $cartdets1=mysqli_query($con1,"select sum(qty) from cart where user_id='".$_SESSION['gid']."' and status=0");
   $nrwss11=mysqli_fetch_array($cartdets1);   
         
         
         $cartids="";
                  $totfamt=0;       
while($cartdetsrw=mysqli_fetch_array($cartdets))
{
    if($cartids=="")
    {
        $cartids=$cartdetsrw[0];
    }else
    {
        $cartids=$cartids.",".$cartdetsrw[0];
    }
    
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
      
      
      $getprdets1=mysqli_query($con1,"select * from fashion_img where product_id='".$cartdetsrw['pid']."'");
       $prdrws1=mysqli_fetch_array($getprdets1);
      
      $getprcolor=mysqli_query($con1,"select * from fashioncolor where id='".$cartdetsrw['color']."'");
         $pcolor=mysqli_fetch_array($getprcolor);
      
    }
    else if($Maincate==190){
    
         $getprdets=mysqli_query($con1,"select * from electronics where code='".$cartdetsrw['pid']."'");
      $prdrws=mysqli_fetch_array($getprdets);
      
      
      $getprdets1=mysqli_query($con1,"select * from electronics_img where product_id='".$cartdetsrw['pid']."'");
       $prdrws1=mysqli_fetch_array($getprdets1);
       
        $getprcolor=mysqli_query($con1,"select * from fashioncolor where id='".$cartdetsrw['color']."'");
         $pcolor=mysqli_fetch_array($getprcolor);
      
    }
    else if($Maincate==218){
    
         $getprdets=mysqli_query($con1,"select * from grocery where code='".$cartdetsrw['pid']."'");
      $prdrws=mysqli_fetch_array($getprdets);
      
      
      $getprdets1=mysqli_query($con1,"select * from grocery_img where product_id='".$cartdetsrw['pid']."'");
       $prdrws1=mysqli_fetch_array($getprdets1);
       
       $getprcolor=mysqli_query($con1,"select * from fashioncolor where id='".$cartdetsrw['color']."'");
         $pcolor=mysqli_fetch_array($getprcolor);
      
    }
    else{
    
         $getprdets=mysqli_query($con1,"select * from products where code='".$cartdetsrw['pid']."'");
      $prdrws=mysqli_fetch_array($getprdets);
      
      
      $getprdets1=mysqli_query($con1,"select * from product_img where product_id='".$cartdetsrw['pid']."'");
       $prdrws1=mysqli_fetch_array($getprdets1);
       
       
       $getprcolor=mysqli_query($con1,"select * from fashioncolor where id='".$cartdetsrw['color']."'");
         $pcolor=mysqli_fetch_array($getprcolor);
      
    }
    

     
                ?>
            <tr>
        <td class="text-center">                  
              <!--  <a href="details.php?prid=<?php echo $prdrws['code'];?>"><img style="width:100px;height:100px;" src="<?php echo $prodimgpth.$prdrws['photo'];?>" alt="" title="<?php echo $prdrws['name'];?>" class="img-thumbnail" /></a>-->
                
                <a href="details.php?prid=<?php echo $prdrws['code'];?>"><img style="width:100px;height:100px;" src="<?php echo $prdrws1['thumbs'];?>" alt="" title="<?php echo $prdrws['name'];?>" class="img-thumbnail" /></a>
                
                  </td>
                <td class="text-left"><a href="details.php?id=<?php echo $prdrws['code'];?>"><?php echo $prdrws['name'];?></a>
                                                                        </td>
                                                                        
                                                                  <?php  if($pcolor['color']==""){ ?>
                         <td class="text-right" id="hiddcolr">NA</td>
                                                      <? } else {?>       
                                                                  <td class="text-right" id="hiddcolr"><?php echo $pcolor['color'];?></td>
                                                                  <?php }?>
                   <!-- <td class="text-right" id="hiddcolr"><?php echo $pcolor['color'];?></td>
                    <td class="text-right"><?php echo $cartdetsrw['size'];?></td>-->
                    
                    
                    <?php  if($cartdetsrw['size']==""){ ?>
                         <td class="text-right" >NA</td>
                                                      <? } else {?>       
                                                                 <td class="text-right"><?php echo $cartdetsrw['size'];?></td>
                    <?php }?>
                    
                    
                
                    <td class="text-right"><?php echo $cartdetsrw['qty'];?></td>
                <td class="text-right"><?php echo $cartdetsrw['p_price'];?></td>
                <td class="text-right"><?php echo $cartdetsrw['total_amt']; $totfamt=$totfamt+$cartdetsrw['total_amt'];?></td>
                
      </tr>

       <input type="hidden" name="cCod" id="cCod" value="<?php echo $cartdetsrw['color'];?>">
  <input type="hidden" name="cSize" id="cSize" value="<?php echo $cartdetsrw['size'];?>">
      
      <?php } 
   
        
    
    ?>
                </tbody>
    <tfoot>
        <!--    <tr>
        <td colspan="4" class="text-right"><strong>Sub-Total:</strong></td>
        <td class="text-right">$12,333.00</td>
      </tr>
            <tr>
        <td colspan="4" class="text-right"><strong>Flat Shipping Rate:</strong></td>
        <td class="text-right">$5.00</td>
      </tr>-->
            <tr>
        <td colspan="6" class="text-right"><strong>Total:</strong></td>
        <td class="text-right"><i class="fa fa-inr"> <?php echo $totfamt;?></td>
      </tr>
          </tfoot>
  </table>
  <input type="hidden" name="cartids" id="cartids" value="<?php echo $cartids;?>">
 
  <input type="hidden" name="orderno" id="orderno" >
</div>
<div class="buttons">
  <div class="pull-right">
    <input value="Confirm Order" id="button-confirm" class="btn btn-primary" data-loading-text="Loading..." type="button" style="pedding:20px 71px" onclick="confirmfunc();">
  </div>
</div>
<script type="text/javascript"><!--
//--></script>
</div>
</form>
<?php } }?>