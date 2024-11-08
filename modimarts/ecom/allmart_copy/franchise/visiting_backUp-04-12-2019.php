<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<title>Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
	<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script> 

<style>	
    body{
      font-size: 3rem;
      color: white;
    }
    .img-container{
            height: 330px ! important;
        width: 100%;
    }
    img{
      height: 100%;
    }
    a {
      color: white;
      font-size:34px;
    }
    .main {
        background: url(https://shyambabadham.com/images/card_header.png);
        height: 346px;
        background-repeat: no-repeat;
        width: 100%;
        background-position: center;
        background-size: cover;
        background-color: white;
    }
    .url a {
        text-decoration: none;
        color: white;
        font-size: 4rem;
        text-align: center;
        width: 100%;
    }
    tbody{
            background: white;
    }
    li{
        line-height:40px;
        margin: 3% auto;
    }
    .flex{
      display: flex;
    }
    .mail a{
          width: 100%;
        text-align: center;
    }
    .profile{
      background: #d84c28;
    }
    .profile-info {
        height: 100%;
        padding: 5%;
        margin: auto auto 2%;
    }
    .profile-info div{
    height:auto;
    }
    .profile-image{
          position: relative;
    }
    .profile-image img {
       border: 3px solid white;
    width: 100%;
    height: 330px;
    position: absolute;
    right: 0;
    }
    .contact span{
        font-size:3rem;
    }
    .name span{
      font-size: 4rem;
    }
    span{
    font-size:2.5rem;
    }
    .phone{
        padding-bottom: 40px;
        width: 100%;
        justify-content: center;
        display: flex;
        margin: auto;
    }
    .tel{
        margin: auto 10px;
        width: 100%;
        text-align: center;
        font-size: 4rem;
    }
    .custom-padding{
        padding-left: 30px;
        padding-right: 30px;
    }
    .table{
        display: flex;
        justify-content: center;
    }
    table{
        width: 93%;
    }
    .dham-address ul {
        margin-bottom:-10px;
    }
    td,th{
        text-align:center;
    }
    .table td, .table th{
        padding:0;
        font-size: 37px;
    }
    .left{
        text-align:left;
    }
    .right{
        text-align:center;
        width:100%;
        font-size: 4rem;
    }
    .btn-primary{
        color: #fff ! important;
        background-color: gray ! important;
        border-color: #007bff ! important;
        border: 1px solid white ! important;
        margin: 11px ! important;
        font-size:2.5rem;
    }
    .dham-address img, .office-address img{
        height:40px;
    }
    .flex img{
        margin:0%;
    }
    a label{
    }
</style>
</head>
<body>

<?php 
include('config.php');

$state=$_REQUEST['state'];
$city= $_REQUEST['city'];
$District=$_REQUEST['District'];
$talukaa=$_REQUEST['talukaa'];
$Zone= $_REQUEST['Zone'];
$country=$_REQUEST['cnt'];
$village=$_REQUEST['v'];
$Pincode=$_REQUEST['p'];
$Level=$_REQUEST['Level'];
$Loc= $_REQUEST['Loc'];
$position=$_REQUEST['position'];
// echo $village;

$query= mysqli_query($conn,"select file,name,LastName,mobile from member where level_id='".$Level."' and loc_id='".$Loc."' and position_id='".$position."' and status='1' and Waiting='Y' ");
$fetch= mysqli_fetch_array($query);

$PositionQuery= mysqli_query($conn,"select dasignation_name from committee_structure where id='".$position."' ");
$PositionFetch= mysqli_fetch_array($PositionQuery);

$contryQ=mysqli_query($conn,"select * from country where id='".$country."' ");
$contryF=mysqli_fetch_array($contryQ);
$contryV= $contryF['country'];

$zoneQ=mysqli_query($conn,"select * from zone where id='".$Zone."' and country_id='".$country."' ");
$zoneF=mysqli_fetch_array($zoneQ);
$zoneV= $zoneF['zone'];

$stateQ=mysqli_query($conn,"select * from state where id='".$state."' and  zone_id='".$Zone."' ");
$stateF=mysqli_fetch_array($stateQ);
$stateV=$stateF['state'];

$cityQ=mysqli_query($conn,"select * from city where id='".$city."' and  state_id='".$state."' ");
$cityF=mysqli_fetch_array($cityQ);
$cityV= $cityF['city'];

$DistrictQ=mysqli_query($conn,"select * from district where id='".$District."' and  city_id='".$city."' ");
$DistrictF=mysqli_fetch_array($DistrictQ);
$DistrictV=$DistrictF['district'];

$talukaQ=mysqli_query($conn,"select * from taluka where id='".$talukaa."' and  district_id='".$District."' ");
$talukaF=mysqli_fetch_array($talukaQ);
$talukaV= $talukaF['taluka'];
//echo  "select * from pincode where id='".$Pincode."' and  taluka_id='".$talukaa."' ";
$pincodeQ=mysqli_query($conn,"select * from pincode where id='".$Pincode."' and  taluka_id='".$talukaa."' ");
$pincodeF=mysqli_fetch_array($pincodeQ);
$pincodeV= $pincodeF['pincode'];

$villageQ=mysqli_query($conn,"select * from village where id='".$village."' ");
$villageF=mysqli_fetch_array($villageQ);
$villageV= $villageF['village'];

if($villageV!=""){
$lev=$villageV;
}else if($pincodeV!=""){
$lev=$pincodeV;
}
else if($talukaV!=""){
$lev=$talukaV;
}
else if($DistrictV!=""){
$lev=$DistrictV;
}
else if($cityV!=""){
$lev=$cityV;
}
else if($stateV!=""){
$lev=$stateV;
}
else if($zoneV!=""){
$lev=$zoneV;
}
else if($contryV!=""){
$lev=$contryV;
}

$Fullnm=   $fetch['name']." ".$fetch['LastName'];
$nm=ucwords($Fullnm);
?>

<div id="html-content-holder">
<div>	
<div class="main" >
	<!-- <img src="card_header.png" alt=""> -->
</div>
<div class="profile" >
	<div class="row profile-info" >
		<div class="col-md-8">	
		<div class="name"><span><?php echo $nm; ?></span></div>
		<div class="position">
			<span>
				Committee <?php echo $PositionFetch['dasignation_name']."-".$lev ; ?>
			</span>
		</div>
		<div class="contact">
			<span>	<?php
			$m = $fetch['mobile'];
			echo $m;
			$_SESSION['visiting_mobile']=$m;
			?></span>
		</div>
	</div>
	<div class="col-md-4 profile-image">
		<div class="img-container">
			
			<img src="<?php echo $fetch['file']; ?>" alt="">
		</div>
	</div>
	</div>
    <div class="table">	
     <table  class="table-bordered" >
        <tr >
            <th >Star</th>
            <th >Place</th><th >Place Name</th>
        </tr>
         <tr <?php if($country!="" && $Zone=="" && $state=="" && $city=="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?> style="background-color:#fcae007a" <?php } ?> > 
             <td width="30%" ><?php if($country!="" && $Zone=="" && $state=="" && $city=="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?><img src="star_img/8 star red.png" style="width:92%;"><?php }else{ ?><img src="star_img/8 star blank.png" style="width:92%;"><?php } ?></td>
             <td width="35%">Country</td>
             <td><?php echo $contryV;?></td>
         </tr>
          <tr  <?php if($country!="" && $Zone!="" && $state=="" && $city=="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?> style="background-color:#fcae007a" <?php } ?>>
             <td ><?php if($country!="" && $Zone!="" && $state=="" && $city=="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?><img src="star_img/7 star red.png" style="width:82%;"><?php }else{ ?><img src="star_img/7 star blank.png" style="width:82%;padding-left:3;"><?php } ?></td>
             <td >Zone</td>
             <td> <?php echo $zoneV;?></td>
          </tr>
          <tr <?php if($country!="" && $Zone!="" && $state!="" && $city=="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?>style="background-color:#fcae007a" <?php } ?> >
             <td><?php if($country!="" && $Zone!="" && $state!="" && $city=="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?><img src="star_img/6 star red.png" style="width:70%;margin-left:6px;"><?php }else{ ?><img src="star_img/6 star blank.png" style="width:70%;margin-left:6px;"><?php } ?></td>
             <td>State</td>
             <td><?php echo $stateV;?></td>
         </tr>
          <tr <?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?>style="background-color:#fcae007a" <?php } ?> >
             <td><?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?><img src="star_img/5 star red.png" style="width:60%;margin-left:10px;"><?php }else{ ?><img src="star_img/5 star blank.png" style="width:60%;margin-left:10px;"><?php } ?></td>
             <td>City</td>
             <td><?php echo $cityV; ?></td>
          </tr>
          <tr <?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?> style="background-color:#fcae007a" <?php } ?>>
             <td><?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?><img src="star_img/4 star red.png" style="width:49%;margin-left:14px;"><?php }else{ ?><img src="star_img/4 star blank.png" style="width:49%;margin-left:14px;"><?php } ?></td>
             <td>District</td>
             <td><?php echo $DistrictV;?></td>
          </tr>
          <tr <?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa!="" && $Pincode=="" && $village==""){ ?>style="background-color:#fcae007a" <?php } ?> >
             <td><?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa!="" && $Pincode=="" && $village==""){ ?><img src="star_img/3 star red.png" style="width:36%;margin-left:22px;"><?php }else{ ?><img src="star_img/3 star blank.png" style="width:36%;margin-left:22px;"><?php } ?></td>
             <td>Taluka</td>
             <td><?php  echo $talukaV;?></td>
          </tr>
          <tr <?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa!="" && $Pincode!="" && $village==""){ ?> style="background-color:#fcae007a" <?php } ?>>
             <td><?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa!="" && $Pincode!="" && $village==""){ ?><img src="star_img/2 star red.png" style="width:23%;margin-left:28px;"><?php }else{ ?><img src="star_img/2 star blank.png" style="width:23%;margin-left:28px;"><?php } ?></td>
             <td>Pincode</td>
             <td><?php echo $pincodeV;?></td>
          </tr>
          <tr <?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa!="" && $Pincode!="" && $village!=""){ ?> style="background-color:#fcae007a" <?php } ?>>
             <td><?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa!="" && $Pincode!="" && $village!=""){ ?><img src="star_img/1 star red.png" style="width:13%;margin-left:33px;"><?php }else{ ?><img src="star_img/1 star blank.png" style="width:13%;margin-left:33px;"><?php } ?></td>
             <td>Village</td>
             <td><?php echo $villageV;?></td>
          </tr>
     </table>
    </div>
    <div class="flex dham-address custom-padding">	
	<!--<img src="https://shyambabadham.com/images/placeholder.png" alt="">-->
    <ul>
    <a href="https://www.google.com/maps/place/Shyam+Baba+Dham/@19.1899985,72.8458425,17z/data=!4m12!1m6!3m5!1s0x3be7b7df6332cd33:0x1601ca0ed30dba72!2sShyam+Baba+Dham!8m2!3d19.1899934!4d72.8480312!3m4!1s0x3be7b7df6332cd33:0x1601ca0ed30dba72!8m2!3d19.1899934!4d72.8480312";>
    <img src="images/circle.png" style="height:14px">  
    <b>Karyalaya</b> :  18/2, Sainath Road, Next to Lifeline Hospital, Near Subway, Malad (West), Mumbai - 400064
    <br>
    </a>
    <a href="https://www.google.com/maps/place/Shyam+Baba+Mandir+Chanana/@28.0310975,75.6126402,17z/data=!3m1!4b1!4m5!3m4!1s0x39132f142b832b71:0x5a5fde55af8860a3!8m2!3d28.0310975!4d75.6148289">
    <img src="images/circle.png" style="height:14px">  	
    <b>Dham Address</b> : SHYAM BABA DHAM, Village - Chanana, District - Jhunjhunu, Rajasthan - 333026
    </a>
    </ul>   					
    </div>

<!--<div class="flex office-address custom-padding">	-->
<!--<img src="https://shyambabadham.com/images/placeholder.png" alt="" >-->

<!--</div>	-->
    <div class="flex url custom-padding">
<a href="https://shyambabadham.com">www.ShyamBabaDham.com</a>
</div>
    <div class="flex mail custom-padding">	
<a href="mailto:info@shyambabadham.com?Subject=Hello%20again" target="_top">info@ShyamBabaDham.com
</a>
</div>
    <div class="flex phone">	
    <a class="right" href="tel:+91 7700900702">7700900702</a>
    <a class="tel" href="tel:+91 7700900704">7700900704</a>
    </div>
<!--<div class="d-flex justify-content-center">
<a class="btn btn-primary" style="cursor: pointer;" onclick="window.open('../demo/sapna/account.php?mobile=<?php echo $fetch['mobile']; ?>','_self');">Images</a>
<a class="btn btn-primary" style="cursor: pointer;" onclick="window.open('../demo/sapna/account.php?mobile=<?php echo $fetch['mobile']; ?>','_self');">Video</a>
<a class="btn btn-primary" style="cursor: pointer;" onclick="window.open('../demo/sapna/account.php?mobile=<?php echo $fetch['mobile']; ?>','_self');">Audio</a>
<a class="btn btn-primary" style="cursor: pointer;" onclick="window.open('../demo/sapna/account.php?mobile=<?php echo $fetch['mobile']; ?>','_self');">PDF</a>
</div>-->
</div>	
</div>

</div>

<center><a class="btn btn-primary" id="btn-Convert-Html2Image" href="#">Download</a></center>
<div id="previewImage" style="display: none;"></div>

<script> 
$(document).ready(function() { 
    // Global variable 
    var element = $("#html-content-holder"); 
    // Global variable 
    var getCanvas; 
    $(document).ready(function() { 
    	html2canvas(element, { 
    		onrendered: function(canvas) { 
    			$("#previewImage").append(canvas); 
    			getCanvas = canvas; 
    
    
    				$("#btn-Convert-Html2Image").on('click', function() { 
    				    console.log("clicked");
    					var imgageData = 
    						getCanvas.toDataURL("image/jpeg"); 
    				
    					// Now browser starts downloading 
    					// it instead of just showing it 
    					var newData = imgageData.replace( 
    					/^data:image\/jpeg/, "data:application/octet-stream"); 
    				
    					$("#btn-Convert-Html2Image").attr( 
    					"download", "<?php echo $fetch['mobile'];?>.jpeg").attr( 
    					"href", newData); 
    				}); 
    
    
    		}
    	}); 
    }); 
}); 
$(function() { 
			$(window).load(function() { 
				html2canvas($("#html-content-holder"), { 
					onrendered: function(canvas) { 
						var imgsrc = canvas.toDataURL("image/png"); 

 						$("#newimg").attr('src', imgsrc); 
						
						$("#img").show(); 
						
						var dataURL = canvas.toDataURL(); 
						
						console.log(dataURL);
						


						let myNum = <?php echo $m; ?>;
						console.log(myNum);
						if(myNum === '' || myNum === null || !myNum){
						    myNum = 0;
						    
						}
								$.ajax({ 
								type: "POST", 
								url: "save_visiting_card.php", 
								data: { 
								imgBase64: dataURL, 
								mobilenum: myNum
								} 
								}).done(function(o) { 
								console.log('saved'); 
								}); 
						
						
					} 
				}); 
			}); 
		});
	$(document).ready(function(){
	    console.log($(window).width());
        if ($(window).width() > 992) {
           $("#html-content-holder").css("width", "992px");
           $("#html-content-holder").css("margin", "auto");
        }
        else {
           //$(".main").css("height", "346px");
        }

    });
</script> 
</body>
</html>
