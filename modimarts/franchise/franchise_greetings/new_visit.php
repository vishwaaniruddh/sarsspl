<? include('config.php'); 

$id = $_GET['id'];

$sql = mysqli_query($con,"select * from greetings_member where id='".$id."'" );
$sql_result = mysqli_fetch_assoc($sql);

// print_r($sql_result);
$name = $sql_result['name'];
$Id=$sql_result['id'];
$Country=$sql_result['position_name'];

$level = $sql_result['level_id'];
$lv_id = $sql_result['level_id'];
$greet_id = $sql_result['greeting_id'];


function get_image($id){
    
    global $con;
    

    $sql = mysqli_query($con, "select * from customer_promotion where customer_id = '".$id."' ");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['image'];
}

function get_zone($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_zone where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['zone'];
}

function get_state($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_state where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['state'];
}

function get_division($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_division where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['division'];
}

function get_district($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_district where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['district'];
}

function get_taluka($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_taluka where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['taluka'];
}


function get_pincode($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_pincode where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['pincode'];
}

function get_village($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_village where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['village'];
}


if($level==1){
    $level = 'Country';
    $level_id = 'India';
}
else if($level==2){
        $level = 'Zone';
        $level_id = $sql_result['zone'];
        $level_id = get_zone($level_id);
        
}
else if($level==3){
        $level = 'State';
        $level_id = $sql_result['state'];
        $level_id = get_state($level_id);
}
else if($level==4){
        $level = 'Division';
        $level_id = $sql_result['division'];
        $level_id = get_division($level_id);
}
else if($level==5){
        $level = 'District';
        $level_id = $sql_result['district'];
        $level_id = get_district($level_id);
}
else if($level==6){
        $level = 'Taluka';
        $level_id = $sql_result['taluka'];
        $level_id = get_taluka($level_id);
}
else if($level==7){
        $level = 'Pincode';
        $level_id = $sql_result['pincode'];
        $level_id = get_pincode($level_id);
}
else if($level==8){
        $level = 'Village';
        $level_id = $sql_result['village'];
        $level_id = get_village($level_id);
}



$image = get_image($greet_id);

$image ='https://allmart.world/franchise/promotions_cms/customer_promotion/'.$image;
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="https://allmart.world/assets/logo-original.png" type="image/png" />
    <!-- Bootstrap CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" integrity="sha512-XKa9Hemdy1Ui3KSGgJdgMyYlUg1gM+QhL6cnlyTe2qzMCYm4nAZ1PsVerQzTTXzonUR+dmswHqgJPuwCq1MaAg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />
    
    <title>All Mart | Franchise | Visiting Card</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script> -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js" integrity="sha512-OqcrADJLG261FZjar4Z6c4CfLqd861A3yPNMb+vRQ2JwzFT49WT4lozrh3bcKxHxtDTgNiqgYbEUStzvZQRfgQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <style>
         body
            {
                font-family: Verdana, sans-serif;!important
            }
        .left-section{
        display: flex;
        /*justify-content: center;*/
        width:220px;
        }

        .right-section{
        background-color: #ed2226;
        color:#fff;
        width:220px;
        }
        
        @media (max-width: 768px){
            
        .right-section  { 
            /*font-size:5px; */
            }
        }
        
        .textclass{
        color:#fff;
        text-align:center;
        margin: 5%;
        }
        .Hr{
        color:#fff;
        }
        .textclass1{
        color:#fff;
        text-align:left;
        margin:5px;
        }
        div#round3 {
          color:#000;
        }
        div#round3 {
           box-sizing: border-box;
           text-align:left;
              width: 97%;
              height: 30px;
              margin-left:5px;
              background-color:#fff;
              color:#000;
              border: 2px solid white;
        }
        div #round3 .div1
        {
            margin-left: 6px;
        }div #round3 .div2
        {
            margin-left: 4px;
        }
        .postimg
        {
            height: 650px;
            width: 100%;
        }

        .notice
        {
            background: black;    color: white;
            font-size: 55%;
            /*margin-left: 4%;*/
        }
        .lastdiv
        {
           width: 50px; 
        }
        .downdiv
        {
            margin:0px;
        }

        /* ----------------mobile------------------ */
@media screen and (max-width: 480px) {
   .postimg
        {
            height: auto;
            width: 100%;
        } 

        .notice
        {
            background: black;
            color: white;
            font-size: 38%;
        }
        .lastdiv
        {
           width: 100%; 
        }
}

.username
{
    margin-top: 5px;
    margin-left: 15px;
    margin-right: 15px;
    border-top: 1px solid white;
    border-bottom: 1px solid white;
}

.maindiv
{
    width: 100%;
    display: flex;
    margin: 1%;
}
.div1
{
        width: 40%;
    text-align: left;
    margin-left: 9px;
}
.div2
{
    width: 60%;
    text-align: left;
}
.logo
{
    width: 100px;
    height: 100px;
}
.userimg
{
width: 100px;
height: 100px;
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
          background: url('https://allmart.world/assets/loader.gif') 
                      50% 50% no-repeat rgb(246 246 246);
        }

        .contentdiv
        {
            display:inline-flex;
        }
        .text-center
        {
            margin-top:20%;
        }
        </style>
  </head>
  <body>
<div>
    <div class="loader"></div>
    <div class="htmldiv" style="display:flex;justify-content:center;margin:1% 7% ;">
        <div class="row contentdiv"  id="html-content-holder">
            <div class=" col left-section  px-0">
                <img src="../visiting_assets/left_img.jpg" class="postimg"  >
                <!-- <P>hello world</p> -->
            </div>
            
            <div class=" col right-section px-0 text-right">
                <img src="../visiting_assets/logo.svg" class="logo" >
                
                <div class="text-center" style="margin-bottom: 10%;">
                    <img src="<? echo $image; ?>" class="userimg" >
                </div>
                <p class="textclass mb-1 username" ><? echo $name; ?> </p>
                <p class="textclass mb-1"><i class="fa fa-phone-alt " style="margin-right:7px;"></i><? echo $sql_result['mobile'];?></p>
                <p class="textclass mb-1">ID NO:<?echo $Id;?></p>
               
                <p class="textclass" style="font-weight: bold;" >Franchisee For</p>
                
                <div class="maindiv" <? if($lv_id == 1){ echo 'id="round3"'; } ?>>
                    <div class="div1">Country:</div>
                    <div class="div2">India</div>                    
                </div>
                <div class="maindiv" <? if($lv_id == 2){ echo 'id="round3"'; } ?>>
                    <div class="div1">Zone:</div>
                    <div class="div2"><? echo get_zone($sql_result['zone']);?></div>                    
                </div>
                <div class="maindiv" <? if($lv_id == 3){ echo 'id="round3"'; } ?>>
                    <div class="div1">State:</div>
                    <div class="div2"><? echo get_state($sql_result['state']);?></div>                    
                </div>
                <div class="maindiv" <? if($lv_id == 4){ echo 'id="round3"'; } ?>>
                    <div class="div1">Division:</div>
                    <div class="div2"><? echo get_division($sql_result['division']);?></div>                    
                </div>
                <div class="maindiv" <? if($lv_id == 5){ echo 'id="round3"'; } ?>>
                    <div class="div1">District:</div>
                    <div class="div2"> <? echo get_district($sql_result['district']);?></div>                    
                </div>
                <div class="maindiv" <? if($lv_id == 6){ echo 'id="round3"'; } ?>>
                    <div class="div1">Taluka:</div>
                    <div class="div2"> <? echo get_taluka($sql_result['taluka']);?></div>                    
                </div>
                <div class="maindiv" <? if($lv_id == 7){ echo 'id="round3"'; } ?>>
                    <div class="div1">Pincode:</div>
                    <div class="div2">  <? echo get_pincode($sql_result['pincode']);?></div>                    
                </div>
                <div class="maindiv" <? if($lv_id == 8){ echo 'id="round3"'; } ?>>
                    <div class="div1">Village:</div>
                    <div class="div2"> <? echo get_village($sql_result['village']);?></div>                    
                </div>
            </div>
           <div class="row downdiv" style="width: 100%;background: black;">
                <div class="col-md-12 lastdiv" >
                   <small class="notice">Issue Date:<?=date('d-m-Y') ?> | Expiry Date: <?=date('d-m-Y', strtotime('+365 days'));?> * Idendity Card Will be renewed every year for free</small>
                </div>
            </div> 
        </div>
    </div>

    
    <div style="display:flex;justify-content:center; margin:2%;"  >

<a style="margin:auto 2%;" class="btn btn-danger" id="btn-Convert-Html2Image" href="#">Download</a>

<a class="btn btn-danger"  href="https://avoservice.in/whatsapp_send_visiting.php?id=<? echo $id; ?>" >Send To Whatsapp</a>

</div>

</div>
    



<!-- <div id="previewImage" ></div> -->
<div id="previewImage"  style="display:none;"><canvas width="992" height="1708"></canvas></div>


<script> 
//import jsPDF from './jspdf.min.js';
//import html2canvas from './html2canvas.min.js';
//window.html2canvas = html2canvas;

// or


$(document).ready(function() {

      $("#btn-Convert-Html2Image").on('click', function() {
        $('.loader').show();

    var element = $("#html-content-holder");


    var mobheight= window.screen.availHeight;
    var mobwidth= window.screen.availWidth;
    // alert(mobwidth);
    if(mobwidth<480){
        // $("#htmlcontent").width('130%');
        $(".left-section").width('450px');
    // $(".left-section").height('400px');
    // $(".right-section").height('400px');
    $(".right-section").width('450px');
    $(".postimg").height('auto');
    $(".logo").width('200px');
    $(".logo").height('200px');
    $(".userimg").width('200px');
    $(".userimg").height('200px');
    $(".textclass ").css('font-size', "38px");
    $(".maindiv").css('font-size', "37px");
    $(".maindiv").css('margin', "1%");
    $("div#round3").height('auto');
    $("div#round3").css('margin', "2%");
    $(".downdiv").css('margin-left','0');
    $(".notice").css('margin-left','5%');
    $(".notice").css('font-size','120%');
    $(".contentdiv").css('dispaly','');
    $(".htmldiv").width('900px');
    }
    else 
    {
    // $("#htmlcontent").width('55%');
    $(".left-section").width('400px');
    // $(".left-section").height('400px');
    // $(".right-section").height('400px');
    $(".right-section").width('400px');
    $(".postimg").height('auto');
    $(".logo").width('200px');
    $(".logo").height('200px');
    $(".userimg").width('200px');
    $(".userimg").height('200px');
    $(".textclass ").css('font-size', "29px");
    $(".maindiv").css('font-size', "28px");
    $(".maindiv").css('margin', "1%");
    $("div#round3").height('auto');
    $("div#round3").css('margin', "2%");
    $(".downdiv").css('margin-left','0');
    $(".notice").css('margin-left','0');
    $(".text-center").css('margin-top','40%');
    $(".notice").css('margin-left','0');
    $(".notice").css('font-size','94%');


    }

     window.scrollTo(0,0);
    var getCanvas;
    
        html2canvas(element,
         { 
          // scale: 2,
          // width: 750,
           // height: 1050,
           // dpi: 300,
           
          useCORS: true,
           allowTaint: true,
            onrendered: function(canvas) { 
                getCanvas = canvas; 
    
                $("#previewImage").append(canvas); 

    
                  
                        
                        var imgageData = 
                            getCanvas.toDataURL("image/jpeg"); 
                    
                        // Now browser starts downloading 
                        // it instead of just showing it 
                        var newData = imgageData.replace( 
                        /^data:image\/jpeg/, "data:application/octet-stream"); 
                    
                    // console.log(newData);

                        $("#btn-Convert-Html2Image").attr( 
                        "download", "myimage.jpeg").attr( 
                        "href", newData); 

                        const a = document.createElement('a');
                          a.href = newData;
                          a.download = "myimage.jpeg";
                          document.body.appendChild(a);
                          a.click();
                          document.body.removeChild(a);

                          // $('.loader').hide();
                           location.reload();

                                         
    
    
            }
    //  }); 
    });
     });  
}); 
</script> 

<script> 



$(function() { 
            $(document).ready(function() { 
                html2canvas($("#html-content-holder"), { 
                    onrendered: function(canvas) { 
                        var imgsrc = canvas.toDataURL("image/png"); 

                        $("#newimg").attr('src', imgsrc); 
                        
                        $("#img").show(); 
                        
                        var dataURL = canvas.toDataURL(); 
                        
                //      console.log(dataURL);
                        
                        $.ajax({ 
                        type: "POST", 
                        url: "save_visiting_card.php", 
                        data: { 
                        imgBase64: dataURL,
                        mobilenum: '<? echo $mobile;?>',
                        id :'<? echo $id;?>'
                        } 
                        }).done(function(o) { 
                    //      console.log('saved');
                    
                        }); 
                        
                        
                    } 
                }); 
            }); 
        });
        
        

</script> 

    </body>
</html>
