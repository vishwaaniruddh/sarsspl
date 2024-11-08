<? include('../../config.php');

$id = $_GET['id'];

$language = $_GET['language'];
$promotion = $_GET['promotion'];

$pro=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `promotions` WHERE id='".$promotion."'"));
$proname=$pro['promotions'];

$lung=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `language` WHERE id='".$language."'"));
$lunguage=$lung['language'];


$title=$proname." ".$lunguage;
// $title = 'Album';


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$sql = mysqli_query($con,"select * from new_member where id='".$id."'");
$sql_result = mysqli_fetch_assoc($sql);

$name = $sql_result['name'];
$level = $sql_result['level_id'];
$lv_id = $sql_result['level_id'];
$mobile = $sql_result['mobile'];
$issue_date = $sql_result['full_pay_date'];
$member_status = $sql_result['mem_status'];

function promo_image($language,$promotion){
    global $con;
    
    $sql = mysqli_query($con,"select * from total_promotions where language='".$language."' and promotion ='".$promotion."' and status=1");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['image'];
}

function get_image($id,$member_status){
    
    global $con;
    
    if($member_status==''){
        $sql = mysqli_query($con, "select * from new_member_images where member_id = '".$id."' and type='passport'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['image'];

    }
    else if($member_status=='w'){
    $sql = mysqli_query($con, "select * from new_member_waiting_images where member_id = '".$id."' and type='passport'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['image'];        
    }
    else
    {
         $sql = mysqli_query($con, "select * from new_member_images where member_id = '".$id."' and type='passport'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['image'];

    }

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


$image = get_image($id,$member_status);

// $image = str_replace('https://www.modimart.world/franchise', '', $image);
// echo $image;
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="https://modimart.world/assets/logo.png" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script> -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js" integrity="sha512-OqcrADJLG261FZjar4Z6c4CfLqd861A3yPNMb+vRQ2JwzFT49WT4lozrh3bcKxHxtDTgNiqgYbEUStzvZQRfgQ==" crossorigin="anonymous"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" ></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js" integrity="sha512-OqcrADJLG261FZjar4Z6c4CfLqd861A3yPNMb+vRQ2JwzFT49WT4lozrh3bcKxHxtDTgNiqgYbEUStzvZQRfgQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    
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
//   $str = str_replace('https://www.modimart.world/franchise', '', $newimg);  
    ?>
    <!-- <section>
  <div id="original" class="container">
    <img src="modimart_logo.png" />
   <p>PNG original</p>
  </div>
  <div class="container" id="canvas-container">
  </div> 
  <button onclick="convert()">Convert</button>
</section> -->
<div class="loader"></div>
  
    <div class="holder">
<div class="inner " id="htmlcontent">
<img src="new_album.jpeg" class="photo" width="550" height="630"  >

<div class="container content">

    <div class="row" style="padding-top: 5px;padding-bottom: 0px;border-bottom: 1px solid white;margin-bottom: 5px;">

        <div class="col-3" style="text-align: center; border-right: 1px solid white;margin-bottom: 5px;">
                <img src="https://modimart.world/assets/logo.png" class="logo">
        </div>
    
        <div class="col-6 mem_info">
            <? 
            if($member_status=='p')
                 {?>
                 <p style="font-family: Arial , sans-serif;"> <? echo strtoupper($name); ?></p>
               <?  }
            else {?>
                 <!-- <p> <?php  //echo 'W\L - '.strtoupper($name); ?></p> -->
                 <p style="font-family: Arial , sans-serif;"> <? echo strtoupper($name); ?></p>
                <? }
            ?>
            
            <p style="font-family: Arial , sans-serif;"><? echo strtoupper($level); ?> HEAD <? echo strtoupper($level_id);?></p>
            <!-- <p></p> -->
            <p class="mob" style="font-family: Arial , sans-serif;"><? echo $mobile; ?></p>
        </div>
    
        <div class="col-3">
            <img src="<? echo $image;?>" class="character">
        </div>
       

    </div>

</div>

<!-------------------------------------------------------------------------------->
</div> <!--inner -->





<div style="display:flex;justify-content:center; margin:2%;width: 77%"  >

<a style="margin:auto 2%;" class="btn btn-danger" id="btn-Convert-Html2Image" href="#">Download</a>

<!--<a class="btn btn-danger"  href="https://avoservice.in/whatsapp_send_visiting.php?id=<? echo $id; ?>" >Send To Whatsapp</a>-->

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
        $(".character").width('120px');
        $(".character").height('125px');
        $(".logo").width('120px');
        $(".mem_info ").css('padding', "15px");
        $(".mem_info p").css('font-size', "24px");
        $(".mob").css('font-size', "31px");
        $(".content p").css('max-width', "1750px");
    }
    else 
    {
    $("#htmlcontent").width('55%');
    $(".character").width('134px');
    $(".character").height('150px');
    $(".logo").width('112px');
    $(".mem_info ").css('padding', "15px");
    $(".mem_info p").css('font-size', "20px");
    $(".mob").css('font-size', "30px");
    }

    
    var getCanvas;
    
        html2canvas(element,
         { 
          scale: 2,
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

                        // $("#btn-Convert-Html2Image").attr( 
                        // "download", "myimage.jpeg").attr( 
                        // "href", newData); 

                        const a = document.createElement('a');
                          a.href = newData;
                          a.download = "<?=$title?>.jpeg";
                          document.body.appendChild(a);
                          a.click();
                          document.body.removeChild(a);

                          // $('.loader').hide();
                           location.reload();

                          // var url =window.location.href;
                          // window.location.replace=url;                 
    
    
            }
    //  }); 
    });
     });  
}); 

        
        

</script> 
</body>
</html>
