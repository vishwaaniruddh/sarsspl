<?php
session_start();
 include('../config.php');

$id = $_GET['id'];

$language = $_GET['language'];
$promotion = $_GET['promotion'];

$pro=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `promotions` WHERE id='".$promotion."'"));
$proname=$pro['promotions'];

$lung=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `language` WHERE id='".$language."'"));
$lunguage=$lung['language'];
$title=$proname." ".$lunguage;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$sql = mysqli_query($con,"select * from Users where UserId='".$id."'");
$sql_result = mysqli_fetch_assoc($sql);
$designation=$sql_result['UserType'];

$name = $sql_result['Full_Name'];
$mobile = $sql_result['mobile'];
$image = $sql_result['image'];

function promo_image($language,$promotion){
    global $con;
    
    $sql = mysqli_query($con,"select * from total_promotions where language='".$language."' and promotion ='".$promotion."' and status=1");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['image'];
}





?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="https://modimart.world/assets/logo-original.png" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js" integrity="sha512-OqcrADJLG261FZjar4Z6c4CfLqd861A3yPNMb+vRQ2JwzFT49WT4lozrh3bcKxHxtDTgNiqgYbEUStzvZQRfgQ==" crossorigin="anonymous"></script>
    <title><?=$title?></title>
<!-------------------------------------------------------------------------------->
    <style> 
        * {
  font-family: Arial , sans-serif !important;
  font-family: inherit !important;
}
    .mem_info p{    
        font-size:8px; 
        text-align:left;    
            margin:0;
            font-family: Arial , sans-serif;
    }
    .mem_info p:nth-child(3) {
     
        font-size:15px; 
    }
     .mem_info{    
       padding: 5px;   
    }   
    .character {    
        width: 62px;   
        height: 62px;  
        object-fit: cover;  
    }
    .content{
    background-color: black;
    color: white;
    text-align: center;
    border-left: 1px solid white;
    border-bottom: 1px solid white;
    margin-bottom: 0px;   
}
.inner{
    margin-left: 30%;
    margin-right: 30%;
    margin-top: 10px;
    margin-bottom: 20px;
    font-size: 14px;
    letter-spacing:1px;
    font-weight: 600;
    width: 23%;
}
 
.photo{
    width: 100%;
    height: auto;
}
.logo{
    width: 62px;
    padding: 5px;
}
.character{
    width: 62px;
}


/* ----------------tablet------------------ */
@media only screen and (max-width: 1024px) {
    .inner{
        font-size: 11px;
        font-weight: 600;
        margin-left: 20%;
        margin-right:20%;
        margin-top: 10px;
        margin-bottom: 20px;
        letter-spacing:1px; 
        width: 67%;       
    }
    .mem_info p{    
        font-size:17px; 
        text-align:left;    
            margin:0;   
    } 
    .mem_info p:nth-child(3) {
     
        font-size:17px; 
    }
    .logo{
        width: 104px;
        padding: 5px;
    }
    .character{
        width: 104px;
        height: auto;
    }
}
/* ----------------mobile------------------ */
@media screen and (max-width: 480px) {
    .inner{
        font-size: 8px;
        font-weight: 600;
        margin-left: 5%;
        margin-right: 5%;
        margin-top: 10px;
        margin-bottom: 20px;
        letter-spacing:1px;
        width: 90%;
    }
    .mem_info p{    
        font-size:10px; 
        text-align:left;    
            margin:0;   
    } 
   .mem_info p:nth-child(3) {
     
        font-size:15px; 
    }
    .logo{
        width: 70px;
        padding: 5px;
    }
    .character{
        width: 60px;
    }
}


    </style>

            <style>
          .loader{
          display: none;
          position: fixed;
          left: 0px;
          top: 0px;
          width: 100%;
          height: 100%;
          z-index: 9999;
          background: url('https://modimart.world/assets/loader.gif') 
                      50% 50% no-repeat rgb(246 246 246);
        }
        </style>
<!-------------------------------------------------------------------------------->
</head>


<!-------------------------------------------------------------------------------->
<body>
    <?php 
    $newimg=promo_image($language,$promotion); 
   $str = str_replace('https://www.modimart.world/franchise3', '', $newimg);  
    ?>
    <!-- <section>
  <div id="original" class="container">
    <img src="allmart_logo.png" />
   <p>PNG original</p>
  </div>
  <div class="container" id="canvas-container">
  </div> 
  <button onclick="convert()">Convert</button>
</section> -->
<div class="loader"></div>
  
    <div class="holder">
<div class="inner " id="htmlcontent">
<img  src="../<?=$str?>" class="photo" width="550" height="630"  >

<div class="container content">

    <div class="row" id="withimg" style="padding-top: 5px;padding-bottom: 0px;border-bottom: 1px solid white;margin-bottom: 1px;">

        <div class="col-3" style="text-align: center; border-right: 1px solid white;margin-bottom: 5px;">
                <img src="https://modimart.world/franchise3/promo/allmart_logo.png" class="logo">
        </div>
    
        <div class="col-6 mem_info">
            <small class="small" style="font-size: 5px;text-align: center;"><b>Get Personalised Digital Greetings Design</b> with Your Name, Logo,Photo,Company Name, Mobile Number, Address,Website Address, Email ID, Business Highlights, Personal Achievements, FaceBook ID, Instagram ID, Twitter ID, YouTube Channel name.</small>
            
                 <p style="font-family: Arial , sans-serif;font-size: 5px;text-align: center;">Appointing Areawise Sole Franchisee</b> for zone, state, division, District, Tahsil,Pincode, Village,Area at All india Level</p>
            
            <p style="font-family: Arial;font-size: 5px;text-align: center;"><b> <?=strtoupper($name)?> - -<?=$mobile?>  www.Modimart.world </b></p>
        </div>
    
        <div class="col-3">
            <img src="<? echo 'https://modimart.world'.$image;?>" class="character">
        </div>
       

    </div>

    <div class="row" id="withoutimg" style="padding-top: 5px;padding-bottom: 0px;border-bottom: 1px solid white;margin-bottom: 1px;display:none;">

        <div class="col-3" style="text-align: center; border-right: 1px solid white;margin-bottom: 5px;">
                <img src="https://modimart.world/franchise3/promo/allmart_logo.png" class="logo">
        </div>
    
        <div class="col-9 mem_info">
            
            
            <h2 style="text-align: justify;"><b>Get Personalised Digital Greetings Design</b> with Your Name, Logo,Photo,Company Name, Mobile Number, Address,Website Address, Email ID, Business Highlights, Personal Achievements, FaceBook ID, Instagram ID, Twitter ID, YouTube Channel name.</h2>
            <h2 style="text-align: justify;"><b>Appointing Areawise Sole Franchisee</b> for zone, state, division, District, Tahsil,Pincode, Village,Area at All india Level</h2>
            <h2 style="text-align:center" class="m-0" ><b> <?=strtoupper($name)?> - -<?=$mobile?>  www.Modimart.world </b></h2>
            
        </div>

    </div>

</div>

<!-------------------------------------------------------------------------------->
</div> <!--inner -->





<div style="display:flex;justify-content:center; margin:2%;width: 77%"  >

<a style="margin:auto 2%;" class="btn btn-danger" id="btn-Convert-Html2Image" href="#">Download with Image</a><a style="margin:auto 2%;" class="btn btn-danger" id="btn-Convert-Html2ImageWithoutimg" href="#">Download without image</a>

<!-- <a class="btn btn-danger"  href="https://avoservice.in/whatsapp_send_visiting.php?id=<? echo $id; ?>" >Send To Whatsapp</a> -->

</div>

<div id="previewImage"  ><canvas></canvas></div>
<!--style="display:none;"-->

</div>

<script> 
//import jsPDF from './jspdf.min.js';
//import html2canvas from './html2canvas.min.js';
//window.html2canvas = html2canvas;

// or


$(document).ready(function() {

      $("#btn-Convert-Html2Image").on('click', function() {
        $('.loader').show();

    var element = $("#htmlcontent");
    var mobheight= window.screen.availHeight;
    var mobwidth= window.screen.availWidth;
    // alert(mobwidth);
    if(mobwidth<480){
        $("#htmlcontent").width('130%');
        $(".character").width('97px');
        $(".character").height('109px');
        $(".logo").width('100px');
        $(".mem_info ").css('padding', "5px");
        $(".mem_info p").css('font-size', "18px");
        $(".mem_info p").css('text-align', "center");
        $(".mob").css('font-size', "31px");
        $(".small").css('font-size', "12px");
        $(".content p").css('max-width', "1750px");
    }
    else 
    {
    $("#htmlcontent").width('55%');
    $(".character").width('134px');
    $(".character").height('150px');
    $(".logo").width('112px');
    $(".mem_info ").css('padding', "5px");
    $(".mem_info p").css('font-size', "20px");
    $(".mem_info p").css('text-align', "center");
    $(".small").css('font-size', "15px");
    $(".mob").css('font-size', "30px");
    }

    
    var getCanvas;
    
        html2canvas(element,
         { 
          scale: 2,
          useCORS: true,
           allowTaint: true,
            onrendered: function(canvas) { 
                getCanvas = canvas; 
    
                $("#previewImage").append(canvas);                         
                        var imgageData = 
                            getCanvas.toDataURL("image/jpeg");                     
                        
                        var newData = imgageData.replace( 
                        /^data:image\/jpeg/, "data:application/octet-stream"); 
                          const a = document.createElement('a');
                          a.href = newData;
                          a.download = "<?=$title?>.jpeg";
                          document.body.appendChild(a);
                          a.click();
                          document.body.removeChild(a);
                          location.reload();
            }
    //  }); 
    });
     });

        $("#btn-Convert-Html2ImageWithoutimg").on('click', function() {
        $('.loader').show();

        var element = $("#htmlcontent");
        var mobheight= window.screen.availHeight;
        var mobwidth= window.screen.availWidth;
    // alert(mobwidth);
    if(mobwidth<480){
        $("#withimg").hide();
        $("#withoutimg").show();
        $("#htmlcontent").width('130%');
        $(".character").width('97px');
        $(".character").height('109px');
        $(".logo").width('120px');
        $(".mem_info ").css('padding', "5px");
        $(".mem_info p").css('font-size', "22px");
        $(".mem_info p").css('text-align', "center");
        $(".small").css('font-size', "20px");
        $(".content p").css('max-width', "1750px");
    }
    else 
    {
        $("#withimg").hide();
        $("#withoutimg").show();
        $("#htmlcontent").width('55%');
        $(".character").width('134px');
        $(".character").height('150px');
        $(".logo").width('112px');
        $(".mem_info ").css('padding', "5px");
        $(".mem_info p").css('font-size', "20px");
        $(".mem_info p").css('text-align', "center");
        $(".small").css('font-size', "16px");
        }

    
    var getCanvas;
    
        html2canvas(element,
         { 
          scale: 2,
          useCORS: true,
           allowTaint: true,
            onrendered: function(canvas) { 
                getCanvas = canvas; 
    
                $("#previewImage").append(canvas); 

    
                  
                        
                        var imgageData = 
                            getCanvas.toDataURL("image/jpeg"); 
                    
                        
                        var newData = imgageData.replace( 
                        /^data:image\/jpeg/, "data:application/octet-stream"); 
                    
                  

                        const a = document.createElement('a');
                          a.href = newData;
                          a.download = "<?=$title?>.jpeg";
                          document.body.appendChild(a);
                          a.click();
                          document.body.removeChild(a);

                          
                           location.reload();

            }
    //  }); 
    });
     });  
}); 

        
        

</script> 
</body>
</html>