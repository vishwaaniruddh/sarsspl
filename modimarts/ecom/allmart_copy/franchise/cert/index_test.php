<?php 
    include('../config.php');
    
     $state=$_REQUEST['state'];
     $city= $_REQUEST['city'];
     $District=$_REQUEST['District'];
     $talukaa=$_REQUEST['talukaa'];
     $Zone= $_REQUEST['Zone'];
     $country=$_REQUEST['cnt'];
     $village=$_REQUEST['v'];
     $Pincode=$_REQUEST['P'];
    $Level=$_REQUEST['Level'];
    $Loc= $_REQUEST['Loc'];
    $position=$_REQUEST['position'];
    
    
    
   $query= mysqli_query($conn,"select id,address,file,name,LastName,mobile,praman_patra_id from member where level_id='".$Level."' and loc_id='".$Loc."' and position_id='".$position."' and status='1' and Waiting='Y' ");
   $fetch= mysqli_fetch_array($query);
    //   var_dump($fetch);
// $conn->set_charset("utf8");

   
    
   
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
 $nm=ucwords(strtolower($Fullnm));
 
$praman_patra_id = $fetch['praman_patra_id'];
    if($praman_patra_id==null||$praman_patra_id==""){
        $idP = $fetch['id'];
        $str = strval($idP);
        $length = strlen($str);
        $l = 7-$length;
        if($lenght <=7){
            while($length<=6){
                $str="0".$str;
                $length= strlen($str);
            }
            $praman_patra_id=$str;
        }
    }else{
        $str = strval($praman_patra_id);
        $length = strlen($str);
        $l = 7-$length;
        if($lenght <=7){
            while($length<=6){
                $str="0".$str;
                $length= strlen($str);
            }
            $praman_patra_id=$str;
        }
    }
    
    $pQuery = "update member set praman_patra_id = $str where id=$idP";
    $pExe = mysqli_query($conn,$pQuery);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


	<title>Document</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"> 
    </script> 
    
    <script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

<style>
    .img-class{
        position: absolute;
                        width: 85%;
                        position: absolute;
                        top: 0;
                        bottom: 0;
                        left: 0;
                        right: 0;
                        z-index: 1;
                        opacity: 0.1;
                        background-repeat: no-repeat;
                        background-size: contain;
                        background-position: center;
                        width: 60%;
                        height: 85%;
                        margin: auto;
    }
    
    p{
        font-size:20px;
    }
    
    @media print {
    th {
        background: #d44949 !important;
        color: white !important;
        -webkit-print-color-adjust: exact; 
    }
    
    p{
        color: white !important;
    }
    h3{
        color: white !important;
    }
    b{
        color: white !important;
    }
}

@media print{@page {size: landscape}}

@media print {
    td {
        background-color: white !important;
    }
}

@media print {
  @page {
    margin: 13px;
}
}
</style>
</head>
<body>
	

<div class="outer" id="html-content-holder" >
    <div style="position:absolute;">
        <img src="img/image_new.png" style="width: 100%;">
    </div>
	<div class="inner" id="inner">
		

		<div class="inner-curve">
			<div id="watermark" class="watermark">
                <img src="img/certificate_0004_Logo.png" class="img-class"
                        >
            </div>
				<div class=" ">
				    <img src="img/1.png" style="position: absolute;height: 100px;left: 10px;top: 10px;width: 100px;">
				</div>

				<div class="">
					<img src="img/2.png" style="position: absolute;height: 100px;right: 10px;top: 10px;width: 100px;">
				</div>

				<div class="">
					<img src="img/3.png" style="position: absolute;height: 100px;left: 10px;bottom: 10px;width: 100px;">
				</div>

				<div class="">
					<img src="img/4.png" style="position: absolute;height: 100px;right: 10px;bottom: 10px;width: 100px;">
				</div>



<div class="header row" style="display: flex;">
	<div class="col-md-3 col-sm-3 col-lg-3 ">
			<div class="">
			    <img src="img/hindi-logo.png" style="height: 140px;width: 140px;position:absolute;left: 26%;top: 19%">
			</div>
	</div>

	<div class="col-md-6 col-sm-6 col-lg-6 heading">
			<img src="img/certificate_0002_Praman-Patra-Text.png" alt="">
	</div>

	<div class="col-md-3 col-sm-3 col-lg-3">
		<div class="">
		    <img src="img/certificate_0003_SB-Logo.png" style="height: 140px;width: 140px;position:absolute;right: 26%;top: 19%;">
		</div>
	</div>

	

</div>

<div class="margin">
    
</div>




    <div  class="custom_body p-5 row">
        <div class="col-md-3 col-sm-3 col-lg-3">
            <div class="">

            <div id="" class="">
                <img src="img/certificate_0011_Anup-ji.png" style="width:100%;height:100%;padding:5%;">
            </div>	
            </div>

        

            <div class="name">
                <img src="img/certificate_0010_Anup-Ji-text.png" alt="">    
            </div>

        
        </div>


        <div class="col-md-6 col-sm-6 col-lg-3 custom_table">
                 <table  class="table-bordered" >
        
<tr class="heading-tr">
            <th style="width: 35%">Star</th>
            <th style="width: 20%">Place</th>
            <th style="width: 45%">Place Name</th>

        </tr>
        
            <tr <?php if($country!="" && $Zone=="" && $state=="" && $city=="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" )
         { ?> style="background-color:#fcae007a !important !important" <?php } ?> > 
             <td width="30%" ><?php if($country!="" && $Zone=="" && $state=="" && $city=="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" )
             { ?>
              <img src="../star_img/8 star red.png" style="width:92%;">
              <?php 
            }
            else
              { 
                ?>
                <img src="../star_img/8 star blank.png" style="width:92%;">
                <?php } ?>
              </td>
             <td width="35%">Country</td>
             <td><?php echo $contryV;?></td>
         </tr>
          <tr  <?php if($country!="" && $Zone!="" && $state=="" && $city=="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?> style="background-color:#fcae007a !important" <?php } ?>>
             <td ><?php if($country!="" && $Zone!="" && $state=="" && $city=="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?><img src="../star_img/7 star red.png" style="width:82%;"><?php }else{ ?><img src="../star_img/7 star blank.png" style="width:82%;padding-left:3;"><?php } ?></td>
             <td >Zone</td>
             <td> <?php echo $zoneV;?></td>
          </tr>
          <tr <?php if($country!="" && $Zone!="" && $state!="" && $city=="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?>style="background-color:#fcae007a !important" <?php } ?> >
             <td><?php if($country!="" && $Zone!="" && $state!="" && $city=="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?><img src="../star_img/6 star red.png" style="width:70%;margin-left:6px;"><?php }else{ ?><img src="../star_img/6 star blank.png" style="width:70%;margin-left:6px;"><?php } ?></td>
             <td>State</td>
             <td><?php echo $stateV;?></td>
         </tr>
          <tr <?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?>style="background-color:#fcae007a !important" <?php } ?> >
             <td><?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District=="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?><img src="../star_img/5 star red.png" style="width:60%;margin-left:10px;"><?php }else{ ?><img src="../star_img/5 star blank.png" style="width:60%;margin-left:10px;"><?php } ?></td>
             <td>City</td>
             <td><?php echo $cityV; ?></td>
          </tr>
          <tr <?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?> style="background-color:#fcae007a !important" <?php } ?>>
             <td><?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa=="" && $Pincode=="" && $village=="" ){ ?><img src="../star_img/4 star red.png" style="width:49%;margin-left:14px;"><?php }else{ ?><img src="../star_img/4 star blank.png" style="width:49%;margin-left:14px;"><?php } ?></td>
             <td>District</td>
             <td><?php echo $DistrictV;?></td>
          </tr>
          <tr <?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa!="" && $Pincode=="" && $village==""){ ?>style="background-color:#fcae007a !important" <?php } ?> >
             <td><?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa!="" && $Pincode=="" && $village==""){ ?><img src="../star_img/3 star red.png" style="width:36%;margin-left:22px;"><?php }else{ ?><img src="../star_img/3 star blank.png" style="width:36%;margin-left:22px;"><?php } ?></td>
             <td>Taluka</td>
             <td><?php  echo $talukaV;?></td>
          </tr>
          <tr <?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa!="" && $Pincode!="" && $village==""){ ?> style="background-color:#fcae007a !important" <?php } ?>>
             <td><?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa!="" && $Pincode!="" && $village==""){ ?><img src="../star_img/2 star red.png" style="width:23%;margin-left:28px;"><?php }else{ ?><img src="../star_img/2 star blank.png" style="width:23%;margin-left:28px;"><?php } ?></td>
             <td>Pincode</td>
             <td><?php echo $pincodeV;?></td>
          </tr>
          <tr <?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa!="" && $Pincode!="" && $village!=""){ ?> style="background-color:#fcae007a !important" <?php } ?>>
             <td><?php if($country!="" && $Zone!="" && $state!="" && $city!="" &&$District!="" &&$talukaa!="" && $Pincode!="" && $village!=""){ ?><img src="../star_img/1 star red.png" style="width:13%;margin-left:33px;"><?php }else{ ?><img src="../star_img/1 star blank.png" style="width:13%;margin-left:33px;"><?php } ?></td>
             <td>Village</td>
             <td><?php echo $villageV;?></td>
          </tr>
          
     </table>


<div class="member-address">
<!--<p><?php echo $fetch['address']; ?></p>-->

</div>

        </div>
        <div class="col-md-3 col-sm-3 col-lg-3">
            <div class="member-praman" style="height:90% !important;width:90%; !important">

        <div class="members-image" >
            
            <img src="../<?php echo $fetch['file']; ?>" style=" height: 100%; width: 100%;" alt="No User">

        </div>
                

            </div>

        
            <div class="name">
                <h3><?php echo ucwords($Fullnm);?></h3>
                <p class="committee_position"> Committee <?php echo $PositionFetch['dasignation_name']."-".$lev ; ?></p>
                <p class="committee_number"><?php echo $fetch['mobile']; ?></p>
                

                
                
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>

<div class="footer row">
	
    <div class="col-sm-3 col-md-3 col-lg-3" style="padding-left:8%;">
        <div style="border:2px solid white; border-radius:5%;">
            <p align="center" style="color:white;margin-top: 12px;">नं. <?php echo $praman_patra_id; ?></p>
            <p align="center" style="color:white;font-size:25px !important; margin-top: -12px;"><b>प्रमाण पत्र</b></p>
        </div>
    </div>
	<div class="shyam-heading col-sm-6 col-sm-6 col-lg-6">
		<img id="my-id" src="img/SBD Certificate for 50000 Membership.png" alt="" style="width:110%;">
	</div>
	<div class="col-sm-3 col-md-3 col-lg-3">
	    <img src="img/sign.png" style="width: 75%;padding: 10%;">
	</div>
</div>




		</div>



	</div>
</div>

<div id="button-div" style="padding:2%">
<a class="btn btn-primary" id="btn-Convert-Html2Image" href="#">Download</a>


        <a class="btn btn-primary" id="printpdf" href="#" onclick="prnt()">Print PDF</a>

    
    <!--<button onclick="getPDF()" href="#" >Generate PDF</button>-->
    
    <!--<button onclick="getPDF()">Generate PDF</button>-->
    
    <!--<button id="btn-Convert-Html2pdf">Generate PDF</button>-->
</div>
    
    <div id="previewImage" style="display: none;"></div>
    <div id="editor"></div>
<script src="js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script>
function gen_pdf(){
            var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#html-content-holder')[0];

        // we support special element handlers. Register them with jQuery-style 
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors 
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('PramanPatra.pdf');
            }, margins
        );
}
function getPDF(){

		var HTML_Width = $(".outer").width();
		var HTML_Height = $(".outer").height();
    	console.log(HTML_Height+"  "+HTML_Width);
		var top_left_margin = 15;
		var PDF_Width = HTML_Width+(top_left_margin*2);
	var PDF_Height = (HTML_Height)+(top_left_margin*2);
		var canvas_image_width = HTML_Width;
		var canvas_image_height = HTML_Height;
		
		window.parent.document.body.style.zoom = 0.85;

		html2canvas($(".outer")[0],{allowTaint:true,scale:2}).then(function(canvas) {
        // html2canvas($(".outer")[0],{scale:2}).then(function(canvas) {
			canvas.getContext('2d');
			var imgData = canvas.toDataURL("image/png", 1);
            var pdf = new jsPDF('l', 'pt',  [HTML_Width, HTML_Height]);
		  pdf.addImage(imgData, 'png', 0, 0,canvas_image_width,canvas_image_height);

			
		    pdf.save("Prman_patr.pdf");
        });
        window.parent.document.body.style.zoom = 1;
	};

</script>
<script>
    function prnt(){
        var element = document.getElementById('button-div');
        var header = document.getElementById('watermark');
        var inner = document.getElementById('inner');
        //console.log('yyy  '+header);
        // header.style.display = 'none';
        element.style.display = 'none';
        // inner.style.display = 'block';
        window.print();
        element.style.display = 'block';
    }
</script>


</body>
</html>