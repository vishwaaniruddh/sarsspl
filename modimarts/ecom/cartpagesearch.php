<?php
session_start();
include('config.php');
//echo "select * from cart where user_id='".$_SESSION['gid']."' and status=0";
 $cartdets=mysqli_query($con1,"select * from cart where user_id='".$_SESSION['gid']."' and status=0");
   $nrwss1=mysqli_num_rows($cartdets);
    if($nrwss1>0)
    {
        $cartdets1=mysqli_query($con1,"select sum(qty) from cart where user_id='".$_SESSION['gid']."' and status=0");
        
        $nrwss11=mysqli_fetch_array($cartdets1);   
    ?>

    <h1>Shopping Cart &nbsp;(<?php  if($nrwss11[0]!=null){echo $nrwss11[0];}else{echo "0";};?>)
              </h1>
           
<table class="table table-bordered">
            <thead >
              <tr style="background-color:#1c4b6f;color:white">
                <td class="text-center">Image</td>
                <td class="text-left">Product Name</td>
                <td class="text-left">Color</td>
                <td class="text-left">Size</td>
               <!-- <td class="text-left">Model</td>-->
                <td class="text-left">Quantity</td>
                <td class="text-right">Unit Price</td>
                <td class="text-right">Total</td>
              </tr>
            </thead>
            <tbody>
                <?php
                  $totfamt=0;  
                  $nr=0;
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
         $getprdets=mysqli_query("$con1,select * from fashion where code='".$cartdetsrw['pid']."'");
         $prdrws=mysqli_fetch_array($getprdets);
     
         $getprdets1=i($con1,"select img from fashion_img where product_id='".$cartdetsrw['pid']."'");
         $prdrws1=mysqli_fetch_array($getprdets1);
         
         $getprcolor=mysqli_query($con1,"select * from fashioncolor where id='".$cartdetsrw['color']."'");
         $pcolor=mysqli_fetch_array($getprcolor);
     
    }
    else  if($Maincate==190)
    {
         $getprdets=mysqli_query($con1,"select * from electronics where code='".$cartdetsrw['pid']."'");
         $prdrws=mysqli_fetch_array($getprdets);
         
     
         $getprdets1=mysqli_query($con1,"select img from electronics_img where product_id='".$cartdetsrw['pid']."'");
         $prdrws1=mysqli_fetch_array($getprdets1);
         
        $getprcolor=mysqli_query($con1,"select * from fashioncolor where id='".$cartdetsrw['color']."'");
         $pcolor=mysqli_fetch_array($getprcolor);
     
    }    
    else  if($Maincate==218)
    {
         $getprdets=mysqli_query($con1,"select * from grocery where code='".$cartdetsrw['pid']."'");
         $prdrws=mysqli_fetch_array($getprdets);
     
         $getprdets1=mysqli_query($con1,"select img from grocery_img where product_id='".$cartdetsrw['pid']."'");
         $prdrws1=mysqli_fetch_array($getprdets1);
         
         $getprcolor=mysqli_query($con1,"select * from fashioncolor where id='".$cartdetsrw['color']."'");
         $pcolor=mysqli_fetch_array($getprcolor);
     
    }      
     else
    {
         $getprdets=mysqli_query($con1,"select * from products where code='".$cartdetsrw['pid']."'");
         $prdrws=mysqli_fetch_array($getprdets);
     
         $getprdets1=mysqli_query($con1,"select img from product_img where product_id='".$cartdetsrw['pid']."'");
         $prdrws1=mysqli_fetch_array($getprdets1);
         
         $getprcolor=mysqli_query($con1,"select * from fashioncolor where id='".$cartdetsrw['color']."'");
         $pcolor=mysqli_fetch_array($getprcolor);
     
    }        
         
         
        // echo "select * from products where code='".$cartdetsrw['pid']."'";
      
                ?>
                            <tr>
                <td class="text-center">                  
                <a href="details.php?prid=<?php echo $prdrws['code'];?>&catid=<?php echo $prdrws['category'];?>"><img style="width:100px;height:100px;" src="<?php echo $prdrws1[0];?>" alt="" title="<?php echo $prdrws['name'];?>" class="img-thumbnail" /></a>
                  </td>
                <td class="text-left"><a href="details.php?prid=<?php echo $prdrws['code'];?>&catid=<?php echo $prdrws['category'];?>"><?php echo $prdrws['name'];?></a> </td>
                             
                            <?php if($pcolor['color']==""){?>
                  <td class="text-left"><?php echo NA;?></td>
                  <?php } else{ ?>
                   <td class="text-left"><?php echo $pcolor['color'];?></td>
                 <?php }?>
                     
                               <?php if($cartdetsrw['size']==""){?>
                  <td class="text-left"><?php echo NA;?></td>
                  <?php } else{ ?>
                   <td class="text-left"><?php echo $cartdetsrw['size'];?></td>
                 <?php }?>
                               
                                                                       
               <!-- <td class="text-left"><?php echo $pcolor['color'];?></td>
                <td class="text-left"><?php echo $cartdetsrw['size'];?></td>-->
                                                                        
                <!--<td class="text-left"></td>-->
                <td class="text-left">
                    <div class="input-group btn-block" style="max-width: 200px;">
                
<input type=button value='-' onclick='javascript:process(-1,<?php echo $nr;?>,"<?php echo $cartdetsrw["id"];?>","<?php echo "nwqty".$nr;?>")'>
<input type=test size=2 id='nwqty<?php echo $nr;?>' name='quantity[15]' style="text-align:center" value='<?php echo $cartdetsrw["qty"];?>' maxlength='3' onkeypress="return event.charCode >= 48 && event.charCode <= 57" >
<input type=button value='+' onclick='javascript:process(1,<?php echo $nr;?>,"<?php echo $cartdetsrw["id"];?>","<?php echo "nwqty".$nr;?>")'>
                  
           

        <!--======================-->           
                  
                    <div class="trash" data-toggle="tooltip" title="Remove" style="margin-top: -35px;" onclick="remfromcart2('<?php echo $cartdetsrw['id'];?>');"><span class="lid" style="width:26px"></span><span class="can" style="width:26px"></span></div>
          	
                    </span>
                    </div>
                </td>
                <td class="text-right"><?php echo $cartdetsrw['p_price'];?></td>
                <td class="text-right"><?php echo $cartdetsrw['total_amt']; $totfamt=$totfamt+$cartdetsrw['total_amt'];?></td>
              </tr>
              <?php 
              $nr++;
              } ?>
                                        </tbody>
          </table>
          
           
            <br />
      <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
          <table class="table table-bordered">
                        <!--<tr>
              <td class="text-right"><strong>Sub-Total:</strong></td>
              <td class="text-right">$190,000.00</td>
            </tr>-->
                        <tr>
              <td class="text-right"><strong>Total:</strong></td>
              <td class="text-right"><i class="fa fa-inr"> <?php echo $totfamt;?></td>
            </tr>
                      </table>
        </div>
      </div>
     

    
       <!DOCTYPE html>
<html>
<head>

</head>
<body>



</body>
</html>
   
          
          
          
          <?php } ?>
          
          