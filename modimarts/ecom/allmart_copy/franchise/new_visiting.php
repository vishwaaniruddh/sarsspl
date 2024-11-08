<? session_start();
include('config.php');


$id = $_GET['id'];

$sql = mysqli_query($con,"select * from new_member where id='".$id."'");
$sql_result = mysqli_fetch_assoc($sql);

$name = $sql_result['name'];
$level = $sql_result['level_id'];
$lv_id = $sql_result['level_id'];
$mobile = $sql_result['mobile'];
$issue_date = $sql_result['full_pay_date'];

$_SESSION['visiting_mobile']=$mobile;

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

$image = str_replace('https://www.allmart.world/franchise/', '', $image);
?>


<html>
    <head>
        <!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
	<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script> 
	
    </head>
    <body>
        <style>
        .member_position{
            background: #fcae007a;
        }

            .inner_card{
                background: white;
                margin: auto 2% auto 2%
            }
            .visiting_header{
                background:red;
            }
            
            .visiting_header h2{
                margin:3% auto
            }
            .visiting_header h3{
                padding: 0;
                margin: 0;
            }
            .visiting_header h2, .visiting_header h3{
                text-align:center;
                color:white;
                
                
            }
            .top{
                background:red;
                height: 14%;
                width: 100%;
    border: 1px solid black;
            }

            table{
                width: 100%;
                /*margin: 2% auto;*/
            }
            tr{
                border: 1px solid black;
            }
            .mid_one{
                height: 25%;
                width: 100%;
            }
            
            .mid_two{
                height: 35%;
                width: 100%;
            }
            
            
           .mid_one table tr td{
                padding: 1%;
                width:100%;
                    border: 1px solid black;
            }
            .mid_two table tr td img{
                height:18px;
                /*width:10px;*/
            }
            .member_img{
                max-height:150px;
                width: 100%;
                height: 100%;
                /*width: 130px;*/
                /*height: 150px;*/
                
                
                margin: auto;
                display: flex;
            }
            
            .mid_two table thead tr{
                    background: pink;
            }
            .mid_two table tr th{
                    text-align:center;
                border:1px solid black;
            } 

                
            .mid_two table tr td{
                text-align:center;
                    border: 1px solid;
            }
            .copyrights{
    background: pink;
    font-weight: 700;
    font-size: 14px;
    border: 1px solid;
            }
                .contact{
                    border: 1px solid;
    text-align: center;
    font-size: 14px;
    font-weight: 700;
                }
                .email{
                    border: 1px solid;
                    text-align: center;
                    font-size: 14px;
                    font-weight: 700;
                }
.row{
    margin:0 ! important;
}

   .custome_card{
       max-width:400px;
                width: 100%;
                margin: auto;

                height:600px;
                
            }
            
@media (min-width: 991px) { 
    
                .custome_card{
                width: 30% ! important;
            }
    
}

.row{
    display:flex;
}

.col-xs-3 img{
    width: 100px;
}
.col-xs-3{
    width:25%;
}

.col-xs-9{
    width:75%;
}

.col-xs-6{
    width:50%;
}

.col-xs-12{
    width:100%;
}
#mid_two tr td{
    /*dis*/
}

.bottom{
    height:25%;
}


.btn-danger {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}
.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

            
        </style>
        
        <div class="custome_card" id="html-content-holder">
            <div class="inner_card">
            
        <div class="top">
          <div class="row" style="background:white; height:100%;">
              <div class="col-xs-3" style="display:flex;justify-content:center;">
                  <img src="star_img/allmart.png">
              </div>
              
              <div class="col-xs-9 visiting_header">
                  <h2>ALLMART.WORLD</h2>
                  <h3>आपकी अपनी दुकान</h3>
              </div>
          </div>      
          </div>
          
        <div class="mid_one" style="display:flex;">
            <table cellpadding="0" cellspacing="0" style="height: 150px; width:100%;    vertical-align: middle;">
            <tr>
            <td><b>Name :</b> <? echo $name; ?></td>
            </tr>
            <tr><td><b>Franchisee of:</b> <? echo $level; ?> - <? echo $level_id?></td></tr>
            <tr><td><b>Mobile Number: </b><? echo $mobile; ?></td></tr>
<tr>            <td><b>Issue Date : </b><? echo $issue_date; ?></td></tr>
    <tr>        <td><b>I Card Valid For 1 Year</b></td></tr>
        <tr>    <td><b>ID No: </b><? echo $id; ?></td>
            </tr>
            
            </table>
            
            <div style="width:35%;height:150px; overflow:hidden; background:black;"><img class="member_img" src="<? echo $image; ?>"></div>
            
        </div>
          
        <div class="mid_two">
            

            <table cellpadding="0" cellspacing="0" style="height: 100%;">
    <thead>
      <tr>
        <th>Star</th>
        <th>Position</th>
        <th>Position Name</th>
      </tr>
    </thead>
    <tbody id="mid_two">
        
      <tr <? if($lv_id ==1){ echo 'class="member_position"'; }?> >
        
        <td>
            <?
            
            if($lv_id ==1){
            for($i=0;$i<8;$i++){ ?>
               <img src="star_img/1%20star%20red.png"> 
            <? }                
            }
            else{
            for($i=0;$i<8;$i++){ ?>
               <img src="star_img/blank.png"> 
            <? }
            }

            
            
            ?>
        </td>
        
        <td>Country</td>
        <td>India</td>
      </tr>
      <tr <? if($lv_id ==2){ echo 'class="member_position"'; }?> >
        <td>
            <? 
            if($lv_id ==2){
            for($i=0;$i<7;$i++){ ?>
               <img src="star_img/1%20star%20red.png"> 
            <? }                
            }else{
            for($i=0;$i<7;$i++){ ?>
               <img src="star_img/blank.png"> 
            <? }            
            }
    
            ?>
        </td>
        
        <td>Zone</td>
        <td><? echo get_zone($sql_result['zone']);?></td>
      </tr>
      
      <tr <? if($lv_id ==3){ echo 'class="member_position"'; }?> >
        <td>
            <? 
            if($lv_id ==3){
            for($i=0;$i<6;$i++){ ?>
               <img src="star_img/1%20star%20red.png"> 
            <? }                
            }
            else{
            for($i=0;$i<6;$i++){ ?>
               <img src="star_img/blank.png"> 
            <? }                
            }

            ?>
        </td>
        
        <td>State</td>
        <td><? echo get_state($sql_result['state']);?></td>
      </tr>
      <tr <? if($lv_id ==4){ echo 'class="member_position"'; }?> >
        <td>
            <? if($lv_id ==4){
                for($i=0;$i<5;$i++){ ?>
               <img src="star_img/1%20star%20red.png"> 
            <? }
            }else{
                for($i=0;$i<5;$i++){ ?>
               <img src="star_img/blank.png"> 
            <? }
            }
            ?>
        </td>
        <td>Division</td>
        <td><? echo get_division($sql_result['division']);?></td>
      </tr>
      <tr <? if($lv_id ==5){ echo 'class="member_position"'; }?> >
                   <td>
            <? 
            if($lv_id ==5){
            for($i=0;$i<4;$i++){ ?>
               <img src="star_img/1%20star%20red.png"> 
            <? }                
            }
            else{
            for($i=0;$i<4;$i++){ ?>
               <img src="star_img/blank.png"> 
            <? }
            }

            ?>
        </td>
        <td>District</td>
        <td><? echo get_district($sql_result['district']);?></td>
      </tr>
      <tr <? if($lv_id ==6){ echo 'class="member_position"'; }?> >
        <td>
            <? 
            if($lv_id ==6){
            for($i=0;$i<3;$i++){ ?>
               <img src="star_img/1%20star%20red.png"> 
            <? }                
            }else{
            for($i=0;$i<3;$i++){ ?>
               <img src="star_img/blank.png"> 
            <? }
            }

            ?>
        </td>
        <td>Taluka</td>
        <td><? echo get_taluka($sql_result['taluka']);?></td>
      </tr>
      <tr <? if($lv_id ==7){ echo 'class="member_position"'; }?> >
        <td>
            <? 
            if($lv_id ==7){
            for($i=0;$i<2;$i++){ ?>
               <img src="star_img/1%20star%20red.png"> 
            <? }                
            }else{
            for($i=0;$i<2;$i++){ ?>
               <img src="star_img/blank.png"> 
            <? }
            }

            ?>
        </td>
        <td>Pincode</td>
        <td><? echo get_pincode($sql_result['pincode']);?></td>
      </tr>
      <tr <? if($lv_id ==8){ echo 'class="member_position"'; }?> >
        <td>
            <? 
            if($lv_id ==8){
            for($i=0;$i<1;$i++){ ?>
               <img src="star_img/1%20star%20red.png"> 
            <? }                
            }
            else{
                for($i=0;$i<1;$i++){ ?>
               <img src="star_img/blank.png"> 
            <? }
            }
            ?>
        </td>
        <td>Village</td>
        <td><? echo get_village($sql_result['village']);?></td>
      </tr>
    </tbody>
  </table>
  
  
        </div>   
        
        
        <div class="bottom">
            
            <div class="copyrights">
                <p style="text-align:center;">
                    We sell All Consumer Items, Services, Software, Media, Properties etc. You can purchase online from me
                </p>
            </div>
            
            <div class="contact">
                <p>24 Hrs Hotline Number 9999999999</p>
            </div>
            
            <div class="email">
                <p>
                    Email ID: allmartsales@gmail.com
                </p>
            </div>
        </div>
        
            
            </div>            
        </div>














<div style="display:flex;justify-content:center; margin:2%;"  >

<a style="margin:auto 2%;" class="btn btn-danger" id="btn-Convert-Html2Image" href="#">Download</a>

<a class="btn btn-danger"  href="https://avoservice.in/whatsapp_send_visiting.php?id=<? echo $id; ?>" >Send To Whatsapp</a>

</div>

<div id="previewImage" style="display:none;"><canvas width="992" height="1708"></canvas></div>
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


$(function() { 
			$(document).ready(function() { 
				html2canvas($("#html-content-holder"), { 
					onrendered: function(canvas) { 
						var imgsrc = canvas.toDataURL("image/png"); 

 						$("#newimg").attr('src', imgsrc); 
						
						$("#img").show(); 
						
						var dataURL = canvas.toDataURL(); 
						
				// 		console.log(dataURL);
						
						$.ajax({ 
						type: "POST", 
						url: "save_visiting_card.php", 
						data: { 
						imgBase64: dataURL,
						mobilenum: '<? echo $mobile;?>',
						id :'<? echo $id;?>'
						} 
						}).done(function(o) { 
    				// 		console.log('saved');
    				
						}); 
						
						
					} 
				}); 
			}); 
		});
		
		

</script> 
    </body>
</html>