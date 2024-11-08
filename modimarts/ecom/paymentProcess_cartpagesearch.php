<?php
session_start();
include('config.php');

//===========Code for BuyNow Process (Start)=========================

if($_GET["qty"]!="" && $_GET["qty"]>0){
?>
<table class="table table-bordered" style="font-size:12px;background-color:white ">
    <thead >
      <tr style="background-color:#14456b;color:white">
        <td class="text-center">Image</td>
        <td class="text-center">Product Name</td>
        <td class="text-center">Color</td>
        <td class="text-center">Size</td>
        <!-- <td class="text-left">Model</td>-->
        <td class="text-center">Quantity</td>
        <td class="text-center">Unit Price</td>
        <td class="text-center">Total</td>
      </tr>
    </thead>
    <tbody>
        <?php
        $totfamt=0;  
        $nr=0;
        /* Ruchi 14 oct 19
        $getprdets=mysqli_query($con1,"select * from Productviewtable where code='".$_GET["Pid"]."' and category='".$_GET["cId"]."' ");
        */
        $qry_data = "select pd.*,p.product_model,p.id,p.category_id,p.description as descr,p.brand_id,p.others as other,p.Long_desc as longdesc,p.status as pstatus from Productviewtable pd join product_model p on pd.name = p.id where pd.code='".$_GET["Pid"]."' and p.category_id='".$_GET["cId"]."' ";
        //echo $qry_data;
        $getprdets=mysqli_query($con1,$qry_data);
        $prdrws=mysqli_fetch_array($getprdets);
        //var_dump($prdrws);
        //echo "select * from Productviewtable where code='".$_GET["Pid"]."' and category='".$_GET["cId"]."' ";
         $getprdets1=mysqli_query($con1,"select img from Productviewimg where product_id='".$_GET["Pid"]."' and category='".$_GET["cId"]."' ");
         
         $prdrws1=mysqli_fetch_array($getprdets1);
         
         $getprcolor=mysqli_query($con1,"select * from fashioncolor where id='".$_GET["clr"]."'");
         $pcolor=mysqli_fetch_array($getprcolor);
         
        // echo "select * from products where code='".$cartdetsrw['pid']."'";
      
        ?>
            <tr>
                <td class="text-center">                  
                    <a href="details.php?prid=<?php echo $prdrws['code'];?>"><img style="width:100px;height:100px;" src="<?php echo $prdrws1[0];?>" alt="" title="<?php echo $prdrws['product_model'];?>" class="img-thumbnail" /></a>
                </td>
                <td class="text-left">
                    <a href="details.php?id=<?php echo $prdrws['code'];?>"><?php echo $prdrws['product_model'];?></a>
                </td>
                <?php if($pcolor['color']==""){?>
                   <td class="text-center"><?php echo "NA";?></td>
                 <?php } else{ ?>
                   <td class="text-center"><?php echo $pcolor['color'];?></td>
                <?php }?>
                <?php if($_GET["sz"]==""){?>
                    <td class="text-center"><?php echo "NA";?></td>
                <?php } else{ ?>
                  <td class="text-center"><?php echo $_GET["sz"];?></td>
                <?php }?>
                <!-- <td class="text-left"><?php echo $pcolor['color'];?></td>
                <td class="text-left"><?php echo $_GET["sz"];?></td>-->
                <td class="text-center"><?php echo $_GET["qty"];?></td> 
                <!--<td class="text-left"></td>-->
                <!-- <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                    <input type="text" name="quantity[15]" id="nwqty<?php echo $nr;?>" value="<?php echo $_GET["qty"];?>" size="1" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
                    <span class="input-group-btn">
                   <!-- <button type="button" data-toggle="tooltip" title="Update" class="btn btn-primary" onclick="updtfn('<?php echo $cartdetsrw['id'];?>','<?php echo "nwqty".$nr;?>');"><i class="fa fa-refresh"></i></button>
                    <button type="button" data-toggle="tooltip" title="Remove" class="btn btn-danger" onclick="remfromcart2('<?php echo $cartdetsrw['id'];?>');"><i class="fa fa-times-circle"></i></button>-->
                   <!-- </span></div></td>-->
                <td class="text-center"><?php echo $prdrws['total_amt'];?></td>
                <td class="text-center"><?php echo  $totfamt=$prdrws['total_amt']*$_GET["qty"];?></td>
              </tr>
              <?php 
              $nr++;
               ?>
            </tbody>
          </table>
          <input type='hidden' name="price" id="price" value="<?php echo  $totfamt=$prdrws['total_amt']*$_GET["qty"];?>">
            <br />
      <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
          <table class="table table-bordered" style="background-color:white ">
                        <!--<tr>
              <td class="text-right"><strong>Sub-Total:</strong></td>
              <td class="text-right">$190,000.00</td>
            </tr>-->
                        <tr>
              <td class="text-center"><strong>Total:</strong></td>
              <td class="text-center"><i class="fa fa-inr"> <?php echo $totfamt;?></td>
            </tr>
                      </table>
                      </div>
      </div>
<?

}else{
//=========== Code for BuyNow Process (End)============================ 

//echo "select * from cart where user_id='".$_SESSION['gid']."' and status=0";
 $cartdets=mysqli_query($con1,"select * from cart where user_id='".$_SESSION['gid']."' and status=0");
   $nrwss1=mysqli_num_rows($cartdets);
    if($nrwss1>0)
    {
    $cartdets1=mysqli_query($con1,"select sum(qty) from cart where user_id='".$_SESSION['gid']."' and status=0");
   $nrwss11=mysqli_fetch_array($cartdets1);   
?>
 <!--<h1 style="margin-top: 0px;">Shopping Cart   &nbsp;(<?php  if($nrwss11[0]!=null){echo $nrwss11[0];}else{echo "0";};?>)
              </h1>-->
<table class="table table-bordered" style="font-size:12px;background-color:white ">
            <thead>
              <tr style="background-color:#14456b;color:white">
                <td class="text-center">Prduct_Image</td>
                <td class="text-center">Product_Name</td>
                <td class="text-center">Color</td>
                <td class="text-center">Size</td>
               <!-- <td class="text-left">Model</td>-->
                <td class="text-center">Quantity</td>
                <td class="text-center">Unit_Price</td>
                <td class="text-center">Total</td>
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
         $getprdets=mysqli_query($con1,"select * from fashion where code='".$cartdetsrw['pid']."'");
         $prdrws=mysqli_fetch_array($getprdets);
     
         $getprdets1=mysqli_query($con1,"select img from fashion_img where product_id='".$cartdetsrw['pid']."'");
         $prdrws1=mysqli_fetch_array($getprdets1);
         
         $getprcolor=mysqli_query($con1,"select * from fashioncolor where id='".$cartdetsrw['color']."'");
         $pcolor=mysqli_fetch_array($getprcolor);
     
    }
    else  if($Maincate==190)
    {
         $getprdets=mysqli_query($con1,"select * from electronics where code='".$cartdetsrw['pid']."'");
         $prdrws=mysqli_fetch_array($getprdets);
         
         $getprdetsx=mysqli_query($con1,"select product_model from product_model where id='".$prdrws['name']."'");
         $prdrwsx=mysqli_fetch_array($getprdetsx);
         
        /* $getprdets1=mysqli_query($con1,"select thumbs from electronics_img where product_id=(select name from electronics where code='".$cartdetsrw['pid']."')");*/
        $getprdets1=mysqli_query($con1,"select thumbs from electronics_img where product_id='".$cartdetsrw['pid']."'");
         $prdrws1=mysqli_fetch_array($getprdets1);
         
        $getprcolor=mysqli_query($con1,"select * from fashioncolor where id='".$cartdetsrw['color']."'");
         $pcolor=mysqli_fetch_array($getprcolor);
     
    }    
    else if($Maincate==218)
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
                <a href="details.php?prid=<?php echo $prdrws['code'];?>&catid=<?php echo $prdrws['category'];?>"><img style="width:80px;height:80px;" src="<?php echo $prdrws1[0];?>" alt="" title="<?php echo $prdrws['name'];?>" class="img-thumbnail" /></a>
            </td>
                <td class="text-left">
                    <a href="details.php?prid=<?php echo $prdrws['code'];?>&catid=<?php echo $prdrws['category'];?>"><?php echo $prdrwsx['product_model'];?></a>
                </td>
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
                <td class="text-left" style="width: 131px;"><div class="input-group btn-block" style="max-width: 300px;">
                   <!-- <input type="text" name="quantity[15]" id="nwqty<?php echo $nr;?>" style="padding-left: 2px;padding-right: 0px;width: 35px;height: 33px;" value="<?php echo $cartdetsrw['qty'];?>" size="1" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
                    <span class="input-group-btn">
                    <button type="button" data-toggle="tooltip" title="Update" style="height: 30px;width: 32px;padding-left: 9px;padding-top: 6px;" class="btn btn-primary" onclick="updtfn('<?php echo $cartdetsrw['id'];?>','<?php echo "nwqty".$nr;?>');"><i class="fa fa-refresh"></i></button>
                    <button type="button" data-toggle="tooltip" title="Remove" style="height: 30px;width: 32px;padding-left: 9px;padding-top: 6px;" class="btn btn-danger" onclick="remfromcart2('<?php echo $cartdetsrw['id'];?>');"><i class="fa fa-times-circle"></i></button>
                    </span>
                    
                    -->
                    
                          
<input type=button value='-' onclick='javascript:process(-1,<?php echo $nr;?>,"<?php echo $cartdetsrw["id"];?>","<?php echo "nwqty".$nr;?>")'>
<input type=test size=1 id='nwqty<?php echo $nr;?>' name='quantity[15]' style="text-align:center" value='<?php echo $cartdetsrw["qty"];?>' maxlength='3' onkeypress="return event.charCode >= 48 && event.charCode <= 57" >
<input type=button value='+' onclick='javascript:process(1,<?php echo $nr;?>,"<?php echo $cartdetsrw["id"];?>","<?php echo "nwqty".$nr;?>")'>
                  
          
            <div class="trash" data-toggle="tooltip" title="Remove" style="margin-top: -35px;left: 9px;" onclick="remfromcart2('<?php echo $cartdetsrw['id'];?>');"><span class="lid" style="width:26px"></span><span class="can" style="width:26px"></span></div>
          	</div>
            </td>
                <td class="text-center"><?php echo $cartdetsrw['p_price'];?></td>
                <td class="text-center"><?php echo $cartdetsrw['total_amt']; $totfamt=$totfamt+$cartdetsrw['total_amt'];?></td>
              </tr>
              <?php 
              $nr++;
              } ?>
                </tbody>
          </table>
            <br />
      <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
          <table class="table table-bordered" style="background-color:white ">
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
    <?php }} ?>