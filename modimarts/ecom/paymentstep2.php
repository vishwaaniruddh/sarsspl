<?php
session_start();
include('config.php');

//echo "select * from Registration where id='".$_SESSION['gid']."'";
$qrgetguestdts=mysqli_query($con1,"select * from Registration where id='".$_SESSION['gid']."'");
$fguestfrws=mysqli_fetch_array($qrgetguestdts);

?>
<script>
function getloc()
{
 //alert("ok");

    $.ajax({
             type: "POST",
             url: "getlocationtestr.php",
		datatype:'json',	
   data:'',

             success: function(msg){
                // alert(msg);
//alert(msg.city);
var jsr=JSON.parse(msg);
//alert(jsr['region_name']);


document.getElementById("input-payment-zone").value=jsr['region_name'];
//document.getElementById("city").value=jsr['city'];
city2(jsr['city']);
//document.getElementById("Latitude").value=jsr['latitude'];
//document.getElementById("Longitude").value=jsr['longitude'];

//var sp=msg.split('####');


/*$("#state option").each(function(i){
        alert($(this).text());
        
        if($(this).text()==sp[0])
        {
            alert($(this).text());
            $(this)prop('selected', true);
            
        }
    });*/

            }
         });
    
    
}


function city2(city)
{
    try
    {
     var str=document.getElementById('input-payment-zone').value;
    //alert(city);
     $.ajax({
             type: "GET",
             url: "getCity.php",
		
   data:"id="+str+"&city="+city,

             success: function(msg){
                 //alert(msg);
                  document.getElementById("city1").innerHTML=msg;
             },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
     });
    }catch(ex)
    {
        alert(ex);
    }
    
}
</script>
<form id="guestpaymentstep2form" name="guestpaymentstep2form" onsubmit="return checkemail();">
    <div id="sys-notification1">
          <div class="container">
            <div id="notification1">
                
             
                
                
            </div>
          </div>
        </div>
<div class="panel-body"><div class="row">
  <div class="col-sm-6">
    <fieldset id="account">
      <legend>Your Personal Details</legend>
      
      <div class="form-group" style="display: none;">
        <label class="control-label">Customer Group</label>
                        <div class="radio">
          <label>
            <input name="customer_group_id" value="1" checked="checked" type="radio">
            Default</label>
        </div>
                      </div>
      <div class="form-group required">
        <label class="control-label" for="input-payment-firstname">First Name</label>
        <input name="firstname" value="<?php echo $fguestfrws['Firstname'];?>" placeholder="First Name" id="input-payment-firstname" class="form-control" type="text" maxlength="100" required autofocus>
      </div>
      
      <div class="form-group required">
        <label class="control-label" for="input-payment-lastname">Last Name</label>
        <input name="lastname"  value="<?php echo $fguestfrws['Lastname'];?>" placeholder="Last Name" id="input-payment-lastname" class="form-control" maxlength="100" type="text" required autofocus>
      </div>
      <div class="form-group required ">
        <label class="control-label" for="input-payment-email">E-Mail</label>
        <input name="email" value="<?php echo $fguestfrws['email'];?>" placeholder="E-Mail" id="input-payment-email" class="form-control" type="email" maxlength="100" required autofocus>
        <input name="emailchk" value="<?php echo $fguestfrws['email'];?>"  id="emailchk" class="form-control" type="hidden">
      </div>
      <div class="form-group required">
        <label class="control-label" for="input-payment-telephone">Contact No</label>
        <input name="telephone" value="<?php echo $fguestfrws['Mobile'];?>" placeholder="Telephone" id="input-payment-telephone" class="form-control" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength='10' required autofocus>
      <input name="contchk" value="<?php echo $fguestfrws['Mobile'];?>"  id="contchk"  class="form-control" type="hidden">
      </div>
     
          </fieldset>
  </div>
  <div class="col-sm-6">
    <fieldset id="address">
      <legend>Your Address</legend>
      <div class="form-group required">
        <label class="control-label" for="input-payment-address-1">Address</label>
        <textarea name="address_1"  placeholder="Address" id="input-payment-address-1" class="form-control" required autofocus><?php echo $fguestfrws['address'];?></textarea>
      </div>
      <div class="form-group required">
        <label class="control-label" for="input-payment-zone" >State</label>
        <?php 
            $stt="";
             $stt2="";
             //echo "chkst".$fguestfrws['state'];
            if($fguestfrws['state']!="0"){
            $sqlm1=mysqli_query($con1,"select * from states where state_code='".$fguestfrws['state']."'");
            $rowm1=mysqli_fetch_array($sqlm1);
            $stt=$rowm1['state_name'];
            //echo $stt;
             $sqlm12=mysqli_query($con1,"select * from cities where code='".$fguestfrws['city']."'");
            $rowm12=mysqli_fetch_array($sqlm12);
            $stt2=$rowm12['name'];
            //echo $stt2;
            }
            ?>
        <select name="zone_id"  id="input-payment-zone" class="form-control" onchange="city2('')" autofocus>
            <?php 
           
            
$sqlm=mysqli_query($con1,"select * from states");
while($rowm=mysqli_fetch_row($sqlm)){
?>
				<option value="<?php echo $rowm[1]; ?>" <?php if(strtoupper($rowm[1])==strtoupper($stt)) { echo "selected";} ?> ><?php echo $rowm[1]; ?></option>
<?php } ?>
</select>

<?php if($fguestfrws['state']=="0"){?>
<script>getloc();</script>
<?php }else{ ?>
<script>city2('<?php echo $stt2;?>');</script>
<?php }?>
      </div>
      
      <div class="form-group required">
        <label class="control-label" for="input-payment-city" >City</label>
        <div id="city1">
        <select name="city" value="" placeholder="City" id="city" class="form-control" autofocus required="required">
            <option value=''>select City</option>
        </select>
        </div>
      </div>
      <div class="form-group required">
        <label class="control-label" for="input-payment-postcode" >Pin Code</label>
        <input name="postcode" value="<?php echo $fguestfrws['pincode']; ?>" placeholder="Post Code" id="input-payment-postcode" class="form-control" maxlength="6" type="text" required autofocus> 
      </div>
      
      
          </fieldset>
    
      </div>
</div>
<div class="checkbox">
  <!--<label>
        <input name="shipping_address" value="1" checked="checked" type="checkbox">
        My delivery and billing addresses are the same.</label>-->
</div>
<div class="buttons">
  <div class="pull-right">
    <input value="Continue" id="button-guest" data-loading-text="Loading..." class="btn btn-primary" type="submit">
   
  </div>
</div>
</form>
<script type="text/javascript"><!--


//$('#collapse-payment-address input[name=\'customer_group_id\']:checked').trigger('change');
//--></script>
<script type="text/javascript"><!--

//--></script>
</div>