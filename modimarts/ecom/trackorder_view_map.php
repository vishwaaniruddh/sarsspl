<?php
session_start();
include('config.php');
$oid=$_POST['oid'];
$pid=$_POST['pid'];
$cid=$_POST['cid'];

 $slctqryo_logg=mysqli_query($con1,"select * from `order_details` where oid='".$oid."' and item_id='".$pid."' and cat_id='".$cid."'  ");
      
//echo "select * from `order_details` where oid='".$oid."' and item_id='".$pid."' and cat_id='".$cid."'  ";


$slctqrychkf=mysqli_num_rows($slctqryo_logg);

if($slctqrychkf>0){

$slctqryf=mysqli_fetch_array($slctqryo_logg);

if($slctqryf['status']=="Accept"){
$trackstatus="c1";
}
else if($slctqryf['status']=="pr"){
$trackstatus="c2";
}
else if($slctqryf['status']=="dis"){
$trackstatus="c3";
}
else if($slctqryf['status']=="c"){
$trackstatus="c4";
}
else if($slctqryf['status']=="completed"){
$trackstatus="c5";
}



?>
<style>


img:hover {
 /* box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);*/
}
</style>

<?php
$poductImag=mysqli_query($con1,"select * from Productviewimg where product_id='".$pid."' and category='".$cid."' ");
           $ftname=mysqli_fetch_array($poductImag);
         
         $poductDetailsQuery=mysqli_query($con1,"select * from Productviewtable where code='".$pid."' and category='".$cid."' ");
           $poductDetailsFetch=mysqli_fetch_array($poductDetailsQuery);
         
             
?>
<div class="w3-panel w3-round-xxlarge w3-teal" style="color: #fff!important;background-color: #ffffff!important;margin-right: 80px;margin-left:60px;border: 2px solid #e3e3e3;">
<div class="row">
    <div class="col-sm-6">
<a onclick="getTrackstatus('<?php echo $oid;?>','<?php echo $pid;?>','<?php echo $cid;?>'); " style="margin-left: 62px; border: none;">
  <img src="<?php echo $ftname['thumbs'];?>" alt="Paris" style="width:250px;height: 250px;border-radius: 4px;padding: 5px;" />
</a>
</div>
<div class="col-sm-6">
<h2><?php echo $poductDetailsFetch['name'];?></h2>
<h5 style="margin-bottom: 0px;">Qty : <?php echo $slctqryf['qty'];?></h5>

<?php $poductSpecificationQuery=mysqli_query($con1,"select * from ProductView_Specification where product_id='".$pid."' and category='".$cid."' limit 3 ");
         $poductSpecificationRows=mysqli_num_rows($poductSpecificationQuery);
         
             if($poductSpecificationRows>0){?>
                <h5 >Specification :</h5> 
          <?php  
             
             
             while($poductSpecificationFetch=mysqli_fetch_array($poductSpecificationQuery)){ ?>
        
<h6 style="color: #777474;"><?php echo $poductSpecificationFetch['product_specification'];?>:<?php echo $poductSpecificationFetch['specificationname'];?></h6>
<?php } ?>
<h6>etc...</h6>

<?}?>
<?php $poductTermscondition=mysqli_query($con1,"select * from order_shipping where Pid='".$pid."' and Cid='".$cid."'");
       echo "select * from order_shipping where Pid='".$pid."' and Cid='".$cid."'";
         $NumTermscondition=mysqli_num_rows($poductTermscondition);
             if($NumTermscondition>0){?>
                <h5>Dispatch Details:</h5> 
          <?php  
             
             
             $fetchTermscondition=mysqli_fetch_array($poductTermscondition); ?>
        
<h6 style="color: #777474;">Mode : <?php echo $fetchTermscondition['pmode'];?></h6>
<h6 style="color: #777474;">Name : <?php echo $fetchTermscondition['person_name'].$fetchTermscondition['courier name'];?></h6>
<h6 style="color: #777474;"><?php if($fetchTermscondition['docate no']!="0"){ ?>Docket No : <?php echo $fetchTermscondition['docate no'];}else{?>Contact No : <?php echo $fetchTermscondition['P_contact'];}?> </h6>
<?}?>

</div>

</div>
 </div>    

<div class="row shop-tracking-status" style="margin-right:-131px">
<div class="order-status" style="margin-top: 111px;margin-left:10%">

                <div class="order-status-timeline" style="
    width: 690px;
">
                    <!-- class names: c0 c1 c2 c3 and c4 -->
                    <div  class="order-status-timeline-completion <?php echo $trackstatus;?>" ></div>
                </div>

                <div class="image-order-status image-order-status-new active img-circle">
                    <span class="status">Accepted</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-active active img-circle">
                    <span class="status">In progress</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-intransit active img-circle">
                    <span class="status">Shipped</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-delivered active img-circle">
                    <span class="status">Delivered</span>
                    <div class="icon"></div>
                </div>
               

            </div>
            </div>
  <?php           
}
?>
