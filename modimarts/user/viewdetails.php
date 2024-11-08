<?php
session_start();

include('config.php');

//echo "hello";
$id=$_POST['uid'];
?>
<table class="table" id="test">
    <tr>
                <th><span>Item</span></li>
              <th><span>Product Name</span></th>  
                            <th><span>Qty</span></th>
                <th><span>Rate</span></th>
              <th><span>Total Amount</span></th>
                            <th><span>Delivered Date</span></th>
                            <th><span>Dispatch Details</span></th>
                            <th><span>Color</span></th>
                            <th><span>Size</span></th>
                            <th><span>Action</span></th>
                            <div class="clearfix"> </div>
                </th>
                </tr>
            
<?php

$i=1;
$tl=0;
//$qry1=mysqli_query($con1,"SELECT * FROM `Order` where mrc_id='".$_SESSION['id']."'");
//echo "SELECT * FROM `Order` where mrc_id='".$_SESSION['id']."'";
//$qry11=mysqli_fetch_array($qry1);
$qry=mysqli_query($con1,"select item_id,qty,id,status,oid,cat_id,color,size from order_details where oid='".$id."' and mrc_id='".$_SESSION['id']."'");

while($fetch=mysqli_fetch_array($qry))
{
    
$stt="";
$nm="";
$rej="";

if($fetch[3]=="pending")
{//$stt="anand";
   $stt="Accept";
$rej="/Reject";
$nm=0;
}


else if($fetch[3]=="Accept"){
   // $stt="Accept";
    $stt="processing";
   
    $nm=1;
}
else if($fetch[3]=="pr")
{//$stt="processing";
$stt="dispatch";
$nm=2;
}
else if($fetch[3]=="dis")
{//$stt="dispatch";
$stt="Delivered";
//$rej="/Reject";
$nm=3;
}
else if($fetch[3]=="c")
{$stt="completed";
$nm=5;
}

$st="";
if($fetch[3]=="pending")
{
$st=" ";

}
elseif($fetch[3]=="Accept")
{
$st="Accept";
//$st="pending";
}

elseif($fetch[3]=="pr")
{//$st="Accept";
$st="Processing";
}
elseif($fetch[3]=="dis")
{//$st="Processing";
$st="dispatch";
}
elseif($fetch[3]=="c")
{//$st="dispatch";
$st="Delivered";
}
elseif($fetch[3]=="rej")
{
$st="Reject";
}
elseif($fetch[3]=="completed")
{
$st="completed";
}


    
    
    
    $qrycolor=mysqli_query($con1,"select * from fashioncolor where id='".$fetch['color']."' ");
    $Colr=mysqli_fetch_array($qrycolor);
    

 //================ query for  get category which is under '0' ============

$qrya="select * from main_cat where id='".$fetch['cat_id']."'";

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
  
$qrypro=mysqli_query($con1,"select name,photo,price,total_amt,code from fashion where code='".$fetch[0]."'");
$fetchp=mysqli_fetch_array($qrypro);

$qrypro1=mysqli_query($con1,"select img from fashion_img where product_id='".$fetchp['code']."'");
 
$fetchp1=mysqli_fetch_array($qrypro1);

}
else if($Maincate==190)
{
    $qrypro=mysqli_query($con1,"select name,photo,price,total_amt,code from electronics where code='".$fetch[0]."'");
    $fetchp=mysqli_fetch_array($qrypro);
    
   $qrypro1=mysqli_query($con1,"select img from electronics_img where product_id='".$fetchp['code']."'");
  // echo "select img from electronics_img where product_id='".$fetchp['code']."'";
$fetchp1=mysqli_fetch_array($qrypro1);
}    
else if($Maincate==218)
{
    $qrypro=mysqli_query($con1,"select name,photo,price,total_amt,code from grocery where code='".$fetch[0]."'");
    $fetchp=mysqli_fetch_array($qrypro);
    
    $qrypro1=mysqli_query($con1,"select img from grocery_img where product_id='".$fetchp['code']."'");
$fetchp1=mysqli_fetch_array($qrypro1);
}    
else 
{
 $qrypro=mysqli_query($con1,"select name,photo,price,total_amt,code from products where code='".$fetch[0]."'");   
 $fetchp=mysqli_fetch_array($qrypro);
 
  $qrypro1=mysqli_query($con1,"select img from product_img where product_id='".$fetchp['code']."'");
$fetchp1=mysqli_fetch_array($qrypro1);
}    






$qrys=mysqli_query($con1,"select delivery_date from Orders where id='".$id."'");
$qrydelt=mysqli_fetch_array($qrys);

$qryds=mysqli_query($con1,"select dt from order_shipping where oid='".$id."'");
//echo "select dt from order_shipping where oid='".$id."'";
$fetchdsp=mysqli_fetch_array($qryds);
//}
?> 

<tr><input type="text" value="<?php echo $fetch[0];?>" id="prid" name="prid">
    <input type="text" value="<?php echo $fetch[5];?>" id="ctid" name="ctid">

              <td><img src="<?php echo $mainpath.$fetchp1['img'];?>" class="img-responsive" alt="" style="height:90px;width:90px"></td>
              <td><span><?php echo $fetchp[0];?></span></td>
              <td><span><?php echo $fetch[1];?></span></td>
              <td><span><?php echo $fetchp[2];?></span></td>
                            <td><span><?php $total=$fetchp[3]*$fetch[1];$tl=$tl+$total; echo $total; ?></span></td>
                            <td><span><?php echo $qrydelt[0];?></span></td>
                            <td><span><?php echo $fetchdsp[0];?></span></td>
                             <td><span><?php echo $Colr['color'];?></span></td>
                             <td><span><?php echo $fetch[7];?></span></td>
<td>
    
    <?php     if($fetch[3]=="pending"){?>
<a href="javascript:void(0)" onclick="orderprocess('<?php echo $id;?>','<?php echo $nm;?>');"><?php echo $stt;?></a><?php } ?>

  <?php if($fetch[3]=="rej"){?>
<a href="javascript:void(0)"    onclick="orderprocess('<?php echo $id;?>','<?php echo 4;?>');"><?php echo $rej;?></a><?php } ?>





 <?php if($fetch[3]=="Accept"){?>
<a href="javascript:void(0)" onclick="orderprocess('<?php echo $id;?>','<?php echo $nm;?>');"><?php echo $stt;?></a><?php } ?>


   <?php if($fetch[3]=="pr"){?>
 <a href="javascript:void(0)" onclick="<?php if($fetch[3]=="pr"){ echo "popshow('$id',' 1')"; } else { echo "orderprocess('$id',' $nm')"; } ?>">
<?php echo $stt;?></a><?php } ?>

<?php if($fetch[3]=="dis"){?>
<a href="javascript:void(0)" onclick="orderprocess('<?php echo $id;?>','<?php echo $nm;?>');" ><?php echo $stt;?></a><?php } ?>

<a href="javascript:void(0)" onclick="orderprocess('<?php echo $id;?>','<?php echo 4;?>');"><?php echo $rej;?></a>


<?php if($fetch[3]=="c"){ echo $stt;} ?>



<!--<?php if($fetch[3]=="c"){?>
<a href="javascript:void(0)" onclick="<?php if($fetch[3]=="c"){ echo "popshow('$id',' 6')"; } else { echo "orderprocess('$id',' $nm')"; } ?>">
<?php echo $stt;?></a> 


<?php } ?>-->
</td>

              
              <!--single.html--><div class="clearfix"> </div>
        </tr>   

<?php

$i++;


}


?>