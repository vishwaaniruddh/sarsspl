<? include('config.php'); 

$id = $_GET['id'];

$sql = mysqli_query($con,"select * from new_member where id='".$id."'" );
$sql_result = mysqli_fetch_assoc($sql);

// print_r($sql_result);
$name = $sql_result['name'];
$Id=$sql_result['id'];
$Country=$sql_result['position_name'];

$level = $sql_result['level_id'];
$lv_id = $sql_result['level_id'];
 

function get_image($id){
    
    global $con;
    

    $sql = mysqli_query($con, "select * from new_member_images where member_id = '".$id."' and type='passport'");
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



$image = get_image($id);

$image = str_replace('https://www.modimarts.com/', '/', $image);
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Modi Mart | R-Mart</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
	<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
	<link rel="shortcut icon" href="favicon.png" type="image/png"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
	
<style>
    .left-section {
        display: flex;
        /*justify-content: center;*/
        width: 220px;
    }

    .right-section {
        background-color: #ed2226;
        color: #fff;
        width: 220px;
    }

    @media (max-width: 768px) {
        .left-section,
        .right-section {
            width: 50%; /* Adjust width for smaller screens */
        }

        .right-section {
            font-size: 15px; /* Adjust font-size for smaller screens */
        }
    }

    .textclass {
        color: #fff;
        text-align: center;
    }

    .Hr {
        color: #fff;
    }

    .textclass1 {
        color: #fff;
        text-align: left;
        margin: 5px;
    }

    p#round3 {
        color: #000;
    }

    p#round3 {
        box-sizing: border-box;
        text-align: left;
        /*width: 95%;*/
        /*height: 5%;*/
        margin-left: 5px;
        background-color: #fff;
        color: #000;
        border: 2px solid white;
    }
</style>

  </head>
  <body>
<div>
    <div style="display:flex;justify-content:center;margin:1% 7% ;">
		<div class="row" style="display:inline-flex;" id="html-content-holder">
			<div class=" col left-section  px-0">
				<img src="visiting_assets/left_rmart.jpeg" style="height: 600px;    width: 100%;" >
				<!-- <P>hello world</p> -->
			</div>
			
			<div class=" col right-section px-0 text-center">
			    <br>
				<img src="visiting_assets/right-top.jpeg"  width="180" height="50">
				
				<div class="text-center">
				    <div id="space" style="height: 10px;"></div>
					<img src="<? echo $image; ?>" class="" width="40%" >
				</div>
				<p class="textclass mb-1" ><? echo $name; ?> </p>
				<p class="textclass mb-1"><? echo $sql_result['mobile'];?></P>
				<p class="textclass mb-1">ID NO:<?echo $Id;?></p>
				<p class="textclass "><b>Franchisee For</b></p>
				
				
				<p class="textclass1" <? if($lv_id == 1){ echo 'id="round3"'; } ?>>
				Country: India</p>
				<p class="textclass1" <? if($lv_id == 2){ echo 'id="round3"'; } ?>>Zone:
				    <? echo get_zone($sql_result['zone']);?>
				</p>
				
				<p class="textclass1" <? if($lv_id == 3){ echo 'id="round3"'; } ?>>State:
				    <? echo get_state($sql_result['state']);?>
				</p>
				<p class="textclass1" <? if($lv_id == 4){ echo 'id="round3"'; } ?>>Division:
				    <? echo get_division($sql_result['division']);?>
				</p>
				<p class="textclass1" <? if($lv_id == 5){ echo 'id="round3"'; } ?>>District:
				    <? echo get_district($sql_result['district']);?>
				</p>
				<p class="textclass1" <? if($lv_id == 6){ echo 'id="round3"'; } ?> >Taluka:
				    <? echo get_taluka($sql_result['taluka']);?>
				</p>
				<p class="textclass1" <? if($lv_id == 7){ echo 'id="round3"'; } ?> >Pincode:
				    <? echo get_pincode($sql_result['pincode']);?>
				</p>
			<p  class="textclass1"  <? if($lv_id == 8){ echo 'id="round3"'; } ?> >Village:
				    <? echo get_village($sql_result['village']);?>
				</p>
				
		
			</div>
		</div>
	</div>

    
    <div style="display:flex;justify-content:center; margin:2%;"  >

<a style="margin:auto 2%;" class="btn btn-danger" id="btn-Convert-Html2Image" href="#">Download</a>

<!--<a class="btn btn-danger"  href="https://avoservice.in/whatsapp_send_visiting.php?id=<? echo $id; ?>" >Send To Whatsapp</a>-->

</div>

</div>
    



<div id="previewImage" style="display:none;"><canvas width="992" height="1708"></canvas></div>
<!--style="display:none;"-->

<script>
    $(document).ready(function () {

        var element = $("#html-content-holder");
        var getCanvas;

        html2canvas(element, {
            // scale: 5, // Commented out or set to a lower value
            onrendered: function (canvas) {
                getCanvas = canvas;

                $("#previewImage").append(canvas);

                $("#btn-Convert-Html2Image").on('click', function () {

                    var imageData =
                        getCanvas.toDataURL("image/jpeg");
                    
                    // Now browser starts downloading
                    // it instead of just showing it
                    var newData = imageData.replace(
                        /^data:image\/jpeg/, "data:application/octet-stream");

                    // console.log(newData);
                    $("#btn-Convert-Html2Image").attr(
                        "download", "myimage.jpeg").attr(
                            "href", newData);
                });


            }
        });
    });
</script>

    </body>
</html>
