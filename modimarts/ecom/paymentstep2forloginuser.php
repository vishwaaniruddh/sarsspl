<?php
session_start();
include('config.php');

//echo "select * from Registration where id='".$_SESSION['gid']."'";
$qrgetguestdts=mysqli_query($con1,"SELECT * FROM `user_address` where user_id='".$_SESSION['gid']."'");

//echo "SELECT * FROM `user_address` where user_id='".$_SESSION['gid']."'";
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

<div class="panel-body">
    
    <div class="radio">
    <label>
      <input type="radio" name="payment_address" id="payment_address" value="existing" checked="checked">
      I want to use an existing address</label>
  </div>
  <div id="payment-existing" style="display: block;">
      
    <select name="address_id" id="address_id" class="form-control">
        <?php
        while($fguestfrws=mysqli_fetch_array($qrgetguestdts))
        {
            
            $getstate=mysqli_query($con1,"select state_name from states where state_code='".$fguestfrws['state']."'");
            $getstnm=mysqli_fetch_array($getstate);
            
            $getcity=mysqli_query($con1,"select name from cities where code='".$fguestfrws['city']."'");
            $getstnm2=mysqli_fetch_array($getcity);
        ?>
                  <option value="<?php echo $fguestfrws[0];?>" selected="selected"><?php echo $fguestfrws[2].",".$getstnm[0].",".$getstnm2[0];?></option>
                  
                  <?php } ?>
                </select>
                <div class="buttons clearfix">
    <div class="pull-right">
      <input type="button" value="Continue" id="button-payment-address" data-loading-text="Loading..." class="btn btn-primary" onclick="loginuserbilldetailsfunc();">
    </div>
  </div>
  </div>
  <div class="radio">
    <label>
      <input type="radio" name="payment_address" id="payment_address2" value="new">
      I want to use a new address</label>
  </div>
    <br>
  <div id="payment-new" style="display: none;">
      <form class="form-horizontal" id="usenewaddr" name="usenewaddr" method="post" onsubmit="return loginuserbilldetailsfunc();">
          
           <div id="sys-notification1">
          <div class="container">
            <div id="notification1">
                
             
                
                
            </div>
          </div>
        </div>
          
    <div class="form-group required">
      <label class="col-sm-2 control-label" for="input-payment-address-1">Address</label>
      <div class="col-sm-10">
        <textarea  name="address_1" value="" placeholder="Address" id="input-payment-address-1" class="form-control" required></textarea>
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
				<option value="<?php echo $rowm[1]; ?>" ><?php echo $rowm[1]; ?></option>
<?php } ?>
        </select>
      </div>
    </div>
    
    <script>getloc();</script>
    
    <div class="form-group required">
      <label class="col-sm-2 control-label" for="input-payment-city">City</label>
      <div class="col-sm-10" id="city1">
        <select name="city" id="city" required><option value="">Select City</option></select>
      </div>
    </div>
    <div class="form-group required">
      <label class="col-sm-2 control-label" for="input-payment-postcode">Pin Code</label>
      <div class="col-sm-10">
        <input type="text" name="postcode" value="" placeholder="Post Code" id="input-payment-postcode" class="form-control" required>
      </div>
    </div>

<div class="buttons clearfix">
    <div class="pull-right">
      <input type="submit" value="Continue" id="button-payment-address" data-loading-text="Loading..." class="btn btn-primary" >
    </div>
  </div>
    
    </form>
    
      </div>
  

<script type="text/javascript"><!--
$('input[name=\'payment_address\']').on('change', function() {
	if (this.value == 'new') {
		$('#payment-existing').hide();
		$('#payment-new').show();
	} else {
		$('#payment-existing').show();
		$('#payment-new').hide();
	}
});
//--></script>
<script type="text/javascript"><!--
// Sort the custom fields
$('#collapse-payment-address .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#collapse-payment-address .form-group').length-2) {
		$('#collapse-payment-address .form-group').eq(parseInt($(this).attr('data-sort'))+2).before(this);
	}

	if ($(this).attr('data-sort') > $('#collapse-payment-address .form-group').length-2) {
		$('#collapse-payment-address .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') == $('#collapse-payment-address .form-group').length-2) {
		$('#collapse-payment-address .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') < -$('#collapse-payment-address .form-group').length-2) {
		$('#collapse-payment-address .form-group:first').before(this);
	}
});
//--></script>
<script type="text/javascript"><!--

//--></script>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.time').datetimepicker({
	pickDate: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});
//--></script>
<script type="text/javascript"><!--

</script>
</div>