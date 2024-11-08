<? include('../../config.php');

$id = $_GET['id'];



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$sql = mysqli_query($con,"select * from new_member where id='".$id."'");
$sql_result = mysqli_fetch_assoc($sql);

$name = $sql_result['name'];
$level = $sql_result['level_id'];
$lv_id = $sql_result['level_id'];
$mobile = $sql_result['mobile'];
$issue_date = $sql_result['full_pay_date'];
$member_status = $sql_result['mem_status'];

function get_image($id,$member_status){
    
    global $con;
    
   if($member_status==''){
    //   if($member_status=='p'){
    $sql = mysqli_query($con, "select * from new_member_images where member_id = '".$id."' and type='passport'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['image'];
    }
    else if($member_status=='w'){
    $sql = mysqli_query($con, "select * from new_member_waiting_images where member_id = '".$id."' and type='passport'");
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




//$image = get_image($id);
$image = get_image($id,$member_status);
$image = str_replace('https://www.modimart.world/', '/', $image);

// $image = str_replace('https://www.modimart.world/franchise3', '', $image);

// echo $image;
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <title>Product for sale to customer 2</title>
<!-------------------------------------------------------------------------------->
    <style>	
    .mem_info p{	
        font-size:12px;	
        text-align:left;	
            margin:0;	
    }	
    .character {	
        width: 100px;	
        height: 100px;	
        object-fit: cover;	
    }
    .content{
    background-color:black;
    color: white; 
    text-align: center;
    border-left:1px solid white;
    /*border-right:1px solid white;
    border-bottom:1px solid white;*/   
}
.inner{
    margin-left: 40%;
    margin-right: 35%;
    margin-top: 10px;
    margin-bottom: 20px;
    font-size: 14px;
    letter-spacing:1px;
    font-weight: 600;
}
 
.photo{
    width: 100%;
    height: auto;
}
.logo{
    width: 100px;
    padding: 5px;
}
.character{
    width: 90px;
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
    }
    .logo{
        width: 80px;
        padding: 5px;
    }
    .character{
        width: 80px;
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
    }
    .logo{
        width: 70px;
        padding: 5px;
    }
    .character{
        width: 80px;
    }
}


    </style>
<!-------------------------------------------------------------------------------->
</head>

<body>
    
<div class="inner row " id="html-content-holder">	

<!-------------------------------------------------------------------------------->

<div >
    <a href="#"><img src="promotion_doubtx2.jpg" class="photo" width="550" height="630"></a>
</div>

<div class="container content">

    <div class="row" style="padding-top: 5px; padding-bottom: 5px;">

        <div class="col-4" style="text-align: center; border-right: 1px solid white;        margin-bottom: 5px;">
                <img src="https://modimart.world/assets/logo.png" class="logo">
        </div>
    
        <div class="col-4 mem_info">
            <? 
            if($member_status=='')
                 {?>
                 <p> <? echo strtoupper($name); ?></p>
               <?  }
            else {?>
                 <p> <? echo 'W\L - '.strtoupper($name); ?></p>
                <? }
            ?>
            
            <p><? echo strtoupper($level); ?> HEAD</p>
            <p><? echo strtoupper($level_id);?></p>
            <p><? echo $mobile; ?></p>
        </div>
    
        <div class="col-4">
            <img src="<?php echo $image;?>" class="character">
            <!--<img src="https://modimart.world/franchise3/promo/doubtx/mayurihead.jpg" class="character">-->
        </div>
       

    </div>

</div>

<!-------------------------------------------------------------------------------->
</div> <!--inner -->

<div style="display:flex;justify-content:center; margin:2%;"  >

<a style="margin:auto 2%;" class="btn btn-danger" id="btn-Convert-Html2Image" href="#">Download</a>

<!--<a class="btn btn-danger"  href="https://avoservice.in/whatsapp_send_visiting.php?id=<? echo $id; ?>" >Send To Whatsapp</a>-->

</div>

<div id="previewImage" style="display:none;"><canvas width="692" height="908"></canvas></div>
<!--style="display:none;"-->



<script> 
$(document).ready(function() {
    
    var element = $("#html-content-holder"); 
    var getCanvas;
    
    	html2canvas(element, { 
          scale: 5,
    		onrendered: function(canvas) { 
    			getCanvas = canvas; 
    
    			$("#previewImage").append(canvas); 

    
    				$("#btn-Convert-Html2Image").on('click', function() {
    				    
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
    				}); 
    
    
    		}
    // 	}); 
    }); 
}); 


// $(function() { 
// 			$(document).ready(function() { 
// 				html2canvas($("#html-content-holder"), { 
// 					onrendered: function(canvas) { 
// 						var imgsrc = canvas.toDataURL("image/png"); 

//  						$("#newimg").attr('src', imgsrc); 
						
// 						$("#img").show(); 
						
// 						var dataURL = canvas.toDataURL(); 
						
// 				// 		console.log(dataURL);
						
// 						$.ajax({ 
// 						type: "POST", 
// 						url: "save_visiting_card.php", 
// 						data: { 
// 						imgBase64: dataURL,
// 						mobilenum: '<? echo $mobile;?>',
// 						id :'<? echo $id;?>'
// 						} 
// 						}).done(function(o) { 
//     				// 		console.log('saved');
    				
// 						}); 
						
						
// 					} 
// 				}); 
// 			}); 
// 		});
		
		

</script> 
</body>
</html>