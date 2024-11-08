<?php
session_start();
include('config.php');
//echo "select * from Registration where id='".$_SESSION['gid']."'";
//echo "SELECT * FROM `user_address` where user_id='".$_SESSION['gid']."' and id='".$_POST['id']."'";
$qrgetguestdts=mysqli_query($con1,"SELECT * FROM `user_address` where user_id='".$_SESSION['gid']."' and id='".$_POST['id']."'");
$nrs=mysqli_num_rows($qrgetguestdts);
$gtrws=mysqli_fetch_array($qrgetguestdts);
?>
<script>

</script>
<div class="row" class="col-lg-3 col-md-3 col-sm-12 sidebar col-xs-12">  
<form class="form-horizontal" id="usenewaddr" name="usenewaddr" method="post" onsubmit="return addresfn();">
<div class="form-group required">
      <label class="col-sm-2 control-label" for="input-payment-address-1">Address</label>
      <div class="col-sm-10">
        <textarea  name="address_1" value="" placeholder="Address" id="input-payment-address-1" class="form-control" required><?php echo $gtrws["address"];?></textarea>
      </div>
    </div>
    
        <div class="form-group required">
      <label class="col-sm-2 control-label" for="input-payment-zone">State</label>
      <div class="col-sm-10">
        <select name="zone_id" id="input-payment-zone" class="form-control" onchange="city2('');">
            <?php 
           
            
$sqlm=mysqli_query($con1,"select * from states");
while($rowm=mysqli_fetch_row($sqlm)){
?>
				<option value="<?php echo $rowm[1]; ?>" <?php if($rowm[0]==$gtrws["state"]){ echo "selected";} ?>><?php echo $rowm[1]; ?></option>
<?php } ?>
        </select>
      </div>
      
     
      
    </div>
    

    
    
     <?php
           if($_POST['id']!="")
            {
               // echo "select name from cities where code='".$gtrws["city"]."'";
          $gestnm=mysqli_query($con1,"select name from cities where code='".$gtrws["city"]."'");
          $cityrr=mysqli_fetch_array($gestnm);
         // echo $cityrr[0];
          ?>
          <script>
          city2('<?php echo $cityrr[0];?>');
          </script>
          <?php } ?>
    <div class="form-group required">
      <label class="col-sm-2 control-label" for="input-payment-city">City</label>
      <div class="col-sm-10" id="city1">
        <select name="city" id="city" required><option value="">Select City</option></select>
      </div>
    </div>
    <div class="form-group required">
      <label class="col-sm-2 control-label" for="input-payment-postcode">Pin Code</label>
      <div class="col-sm-10">
        <input type="text" name="postcode" value="<?php echo $gtrws["pin"];?>" placeholder="Post Code" id="input-payment-postcode" class="form-control" required>
      </div>
    </div>
 <div class="buttons clearfix">
        <div class="pull-left"><a href="javascript:void(0);" onclick="displfunc();" class="btn btn-default">Back</a></div>
        <?php
           if($_POST['id']!="")
            {
                ?>
        <div class="pull-right">
            <input type="submit" value="Update"  class="btn btn-primary">
            <!--<a href="javascript:void(0);" onclick="addresfn('<?php echo $_POST['id'];?>');" class="btn btn-primary">Update</a>-->
            
            </div>
        <?php }else{ ?>
        <input type="submit" value="Submit"  class="btn btn-primary">
        <!--<div class="pull-right"><a href="javascript:void(0);" onclick="addresfn('');" class="btn btn-primary">Submit</a>-->
        </div>
        <?php } ?>
      </div>


</form>
</div>
 <?php
    if($_POST['id']=="")
{
//echo "blank";
?>
<script> 
getloc2();

function getloc2()
{
// alert("ok");

   
    
}
</script>
<?php 
}else
{
 //   echo "ok";
}
?>
