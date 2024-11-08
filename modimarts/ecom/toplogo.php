<script>

//var position=null;
$(document).ready(function(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
    }else{ 
        alert('Geolocation is not supported by this browser.');
    }
});

function showLocation(position)
{

try
{
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
 
 document.getElementById("latitude").value=latitude;
 
 document.getElementById("longitude").value=longitude;
 
// alert(latitude+"---"+longitude);
var strr='<?php echo $stsss;?>';

//alert(strr);

if(strr=="1")
{
    
    funcs('','');
}

}catch(ex)
{
    alert(ex);
}    
    
}
</script>
    <form id="frmsrchsub" method="post" action="product_search.php">
            
<div class="logo inner col-lg-3 col-md-2 col-sm-3 col-xs-12">
                                            <div id="" class="logo-store">
                            <a href="index.php">
                                <span><img src="image/newlogo.png"/ style=" width: 230px;
  height: 100px;"></span>
                            </a>
                        </div>
                                    </div>
                <div id="search" class="col-lg-4 col-md-4 col-sm-5 col-xs-8">
                    <div class="quick-access">
                        <div class="input-group">  
  <input type="text" name="srchtxt" id="srchtxt" value="<?php echo $_POST["srchtxt"];?>" placeholder="Search" class="form-control radius-x" />
  <div class="input-group-btn">
    <button type="button" class="btn btn-default btn-lg radius-x"><i class="fa fa-search"></i></button>
  </div>
</div>  

 <button type="button" onclick="fnnn();"></button>
</div>
                </div>
                <div class="inner col-lg-4 col-md-5 col-sm-4 col-xs-4 col-lg-offset-1 col-md-offset-1" id="cartshowid">
          
                </div>
                
                    
                    
                       <input type="text" name="latitude" id="latitude" readonly>
          <input type="text" name="longitude" id="longitude" readonly>
      
       </form>
       <script>
       
       function fnnn()
{
    
   var latitide= document.getElementById("latitude").value;
  var longitude= document.getElementById("longitude").value;
  
  
  document.getElementById("frmsrchsub").submit();
    
}
       
       </script>