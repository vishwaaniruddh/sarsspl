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



 function add_change(){
    var fullname= $("#fullname").val(""); 
    var plotNo= $("#plotNo").val(""); 
    var wingNo= $("#wingNo").val(""); 
    var buildingName= $("#buildingName").val(""); 
    var roadNo= $("#roadNo").val(""); 
    var landmark= $("#landmark").val(""); 
    var locality= $("#locality").val(""); 
   
   
 }
 

</script>



<!--============== by anand =======================-->



<style>


* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.containers {
  background-color: #f2f2f2;
  padding: 5px 20px 0px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

/*
input[type=text] {
  width: 100%;
  margin-bottom: 4px;
  height:30px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

input[type=password] {
  width: 100%;
  margin-bottom: 10px;
  padding: 6px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
*/

label {
  margin-bottom: 5px;
  display: block;
}


.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}


a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>

<div class="panel-body" style="width: 670px;background-color:white;margin-left: -20px;">
<div class="row" id="HD_address" >
  <div class="col-50">
    <div class="containers">
     <!-- <form method="POST"  action="addnewaddressuser_test.php">-->
    <form  class="form-horizontal" id="usenewaddr" name="usenewaddr" method="post" onsubmit="return loginuserbilldetailsfunc_test();">
        <div class="row">
        
<div class="col-50">
    
    <?php  
   if($_SESSION['log']!="" && $_SESSION['log']=="login"){
       
       
       
       
     $rw=mysqli_query($con1,"select * from Registration where id='".$_SESSION['gid']."'");
    // echo "select * from Registration where id='".$_SESSION['gid']."'";
     
      $fth=mysqli_fetch_array($rw);
      
      $ct=mysqli_query($con1,"select * from cities where code='".$fth['city']."'");
   //   echo "select * from cities where code='".$fth['city']."'";
      
      $fth_ct=mysqli_fetch_array($ct);
      
       $st=mysqli_query($con1,"select * from states where state_code='".$fth['state']."'");
      $fth_st=mysqli_fetch_array($st);
      
       
   }
    
    ?>
    
    
    
    
    
    
    
    
            <h3>Delivery Address</h3>
            <label for="fullname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo $fth['Firstname'].' '.$fth['Lastname']; ?>" style="padding:2px 10px;" class="form-control">
            <div class="row">
              <div class="col-50">
            <label for="plotNo"><i class="fa fa-home" ></i> Plot No.</label>
            <input type="text" id="plotNo" name="plotNo" value="<?php echo $fth["plotNo"]; ?>" style="padding:2px 10px;"  class="form-control">
           </div>
                 <div class="col-50">
            <label for="wingNo"><i class="fa fa-home" ></i>Wing No.</label>
            <input type="text" id="wingNo" name="wingNo" value="<?php echo $fth["wingNo"]; ?>" style="padding:2px 10px;"  class="form-control" >
           </div>
           </div>
            <label for="buildingName"><i class="fa fa-home" ></i>Building Name</label>
            <input type="text" id="buildingName" name="buildingName" value="<?php echo $fth["buildName"]; ?>" style="padding:2px 10px;"  class="form-control">
            <div class="row">
              <div class="col-50">
                <label for="roadNo"><i class="fa fa-home" ></i>Road No.</label>
                <input type="text" id="roadNo" name="roadNo" value="<?php echo $fth["roadNo"]; ?>" style="padding:2px 10px;"  class="form-control" >
              </div>
              <div class="col-50">
                <label for="landmark"><i class="fa fa-home" ></i>LandMark</label>
                <input type="text" id="landmark" name="landmark" value="<?php echo $fth["landmark"]; ?>" style="padding:2px 10px;"  class="form-control">
              </div>
              <div class="col-50">
                <label for="locality"><i class="fa fa-home" ></i>Locality</label>
                <input type="text" id="locality" name="locality" value="<?php echo $fth["Locality"]; ?>" style="padding:2px 10px;"  class="form-control">
              </div>
              <div class="col-50">
                  <label for="state"><i class="fa fa-home" ></i>State</label>
                <?php if($_SESSION['log']!="login"){?>
                
                <select name="zone_id" id="input-payment-zone"  style="padding:2px 10px;"  class="form-control" onchange="city2('');"  <?php if($_SESSION['log']=="login"){?> readonly <? } ?> >
            <?php 
              $sqlm=mysqli_query($con1,"select * from states ");
               while($rowm=mysqli_fetch_row($sqlm)){
             ?>
				<option value="<?php echo $rowm[1]; ?>" ><?php echo $rowm[1];?></option>
            <?php } ?>
              </select>
              
             <? }else{?>
              <input type="text" id="state_Show_Only" name="state_Show_Only" class="form-control" value="<?php echo $fth_st['state_name']; ?>" style="padding:2px 10px;" readonly>
              <input type="hidden" id="input-payment-zone" name="zone_id" class="form-control" value="<?php echo $fth_st['state_code']; ?>" style="padding:2px 10px;" readonly>
             
             
             
             <?php }?>
              
              
              
              </div>
             
              <div class="col-50" >
                <label for="city"><i class="fa fa-home" ></i>City</label>
                <div id="city1">
                      <?php if($_SESSION['log']!="login"){?>
               <select name="city" id="city" class="form-control" style="padding:2px 10px;" <?php if($_SESSION['log']=="login"){?> disabled <? } ?> required><option value="<?php if($_SESSION['log']=="login"){ echo $fth_ct['name']; }?>  "> <?php if($_SESSION['log']=="login"){ echo $fth_ct['name']; }else{?> Select City <? } ?></option></select>
               <? }else{?>
              <input type="text" id="city_for_show_Only" name="city_for_show_Only" class="form-control" value="<?php echo $fth_ct['name']; ?>" style="padding:2px 10px;" readonly>
              <input type="hidden" id="city" name="city" class="form-control" value="<?php echo $fth_ct['code']; ?>" style="padding:2px 10px;" readonly>
             
             <?php }?>
              
              
              </div>
             </div>
             
              <div class="col-50">
                <label for="pincode"><i class="fa fa-home" ></i>Pincode</label>
                <input type="text" id="pincode" name="pincode" value="<?php echo $fth["pincode"]; ?>" style="padding:2px 10px;"  class="form-control" <?php if($_SESSION['log']=="login"){?> readonly <? } ?>>
              <input type="hidden" id="address_id" name="address_id" value="<?php echo $fth['Firstname'].' '.$fth['Lastname'].",".$fth["plotNo"].",".$fth["wingNo"].",".$fth["buildName"].",".$fth["roadNo"].",".$fth["landmark"].",".$fth["Locality"].",".$fth_st['state_name'].",".$fth_ct['name'].",".$fth["pincode"]; ?>" style="padding:2px 10px;"  class="form-control" >
            
             
             </div>
            </div>
          </div>
  
  
  




          <!--<div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>-->
          
        </div>
        <br />
        <input type="button" value="Change" class="btn btn-primary"  onclick="add_change()" /><!-- <input type="submit" value="Edit" class="btn btn-primary"/>-->
        <input type="submit" value="Checkout11111" class="btn btn-primary"/>
      <br />
      </form>
    </div>
  </div>
  
</div>











<!--============== by anand =======================-->


    <!--
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
  
-->
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