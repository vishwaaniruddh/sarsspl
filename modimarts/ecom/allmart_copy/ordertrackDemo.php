<!DOCTYPE html>
<html>
<head>
<title>ORDER TRACKING</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap s JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Wedding Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="trackstyle.css" rel="stylesheet" type="text/css" media="all" />




        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
        
                <link href="image/catalog/cart.png" rel="icon" />
    	        <link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/paneltool.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
                <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
                
                <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
        



<!-- start menu -->
<script src="js/simpleCart.min.js"> </script>
<!-- start menu -->
<!-- /start menu -->

<script>
function getTrackstatus(oid,pid,cid){
    
    $.ajax({
   type: 'POST',    
   url:'trackorder_view_map.php',
//data:'orderid='+orderid+'&trackid='+trackid,
data:'oid='+oid+'&pid='+pid+'&cid='+cid,

success: function(msg){

  document.getElementById('map').innerHTML=msg;
//alert(msg);
         }
     });
}


function trackorderfunc()
{

var orderid=document.getElementById('inputOrderTrackingID').value;
//var trackid=document.getElementById('ordertrackid').value;
//alert("test");
$.ajax({
   type: 'GET',    
url:'trackorder_view.php',
//data:'orderid='+orderid+'&trackid='+trackid,
data:'orderid='+orderid,

success: function(msg){

  document.getElementById('show').innerHTML=msg;
//alert(msg);
         }
     });

}


</script>
<style>
body {
  font-family: Arial;
  }

.split {
  height: 100%;
  width: 50%;
  z-index: 1;
  top: 0;
  overflow-x: hidden;
  padding-top: 20px;
}

.left {
  left: 0;
 }

.right {
  right: 0;
 
}

</style>
</head>
<body>
<header id="header-layout" class="header-v2">
    <div id="topbar" class="topbar-v1">
  <div class="container">
  <?php include('topbar.php')?>
</div>
</div>    <div id="header-main">
        <div class="">
            <div class="row">
            <?php include('menucopy.php')?>
            </div>
        </div>
    </div>

</header>

 <div class="row">
    <div class="col-md-4">
        

<div >
 
     <div id="sidebar-main" >
       
    <div class="well">
        <h3 align="center" style="margin-top: 0px;margin-bottom: 0px;">Order Tracking </h3><br/>
            <div class="form-horizontal" align="center" >

                <div class="form-group">
                    <label for="inputOrderTrackingID" class="col-sm-3 control-label">Order id :</label>
                        <div class="col-sm-6" align="left">
                        <input type="text" class="form-control" id="inputOrderTrackingID"  value="" placeholder="# put your order id here">
                     </div>
                     <div class="col-sm-3" >
                         <button type="button" id="shopGetOrderStatusID" class="btn btn-default" style="border-radius: 24px;outline: none;" onclick="trackorderfunc();">Get status</button>
                   
                    </div>
                </div>
                
             <!--
                 <div class="form-group">
                    <label for="ordertrackid" class="col-sm-6 control-label">Track id :</label>
                        <div class="col-sm-6" align="left">
                        <input type="text" class="form-control" id="ordertrackid" style="width: 48%;" value="" placeholder="# put your Track ID here">
                    </div>
                </div>
           -->
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                    </div>
                </div>
                
                 <div id="show"></div>
                
                
            </div>
    
          
       </div>
    </div>
</div>

    </div>
    <div class="col-md-8">
         <div  style="margin-top:3%;">
              <div id="showtable"></div>
              <div id="map">
              
                  
                  
                      
                 <div class="row shop-tracking-status">     
<div class="order-status">

                <div class="order-status-timeline">
                    <!-- class names: c0 c1 c2 c3 and c4 -->
                    <div  class="order-status-timeline-completion <?php echo $trackstatus;?>"></div>
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
                <div class="image-order-status image-order-status-completed active img-circle">
                    <span class="status">Completed</span>
                    <div class="icon"></div>
                </div>

            </div>
            </div>
             
                  </div>
                  </div>
              
           
                 
    </div>
  </div>








           
     
     
     </div>
</div>
     
     
     <footer id="footer" class="nostylingboxs">
        <?php include("footer.php")?>
     </footer>
     
     <div id="powered">
        <?php include('footerbottom.php')?>
     </div>

     
</body>
</html> 
