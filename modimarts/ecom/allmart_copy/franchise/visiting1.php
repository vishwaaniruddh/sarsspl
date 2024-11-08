<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"> 
  </script> 
  
  <script src= 
"https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"> 
  </script> 
<style> 




    

body{
  font-size: 3rem;
  color: white;
}
img{
  height: 100%;
}
a {
  color: white;
  font-size:38px;
}
  .main {
    background: url(https://shyambabadham.com/images/card_header.png);
    height: 315px;
    background-repeat: no-repeat;
    width: 100%;
    background-position: center;
    background-size: cover;
    background-color: white;
}
.url a {
    text-decoration: none;
    color: white;
    font-size: 3rem;
    text-align: center;
    width: 100%;
}
tbody{
        background: white;
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
    height: 27vh;
    padding: 5%;
    margin: auto auto 5%;
}


.profile-info div{
    height:auto;
}
    .profile-image{
      position: relative;

    }
.profile-image img {
    border: 10px solid white;
    width: 100%;
    height: 100%;
    position: absolute;
    right: 0;
}
    .name span{
      font-size: 4rem;
    }
            span{
        font-size:2.5rem;
    }

    .phone{
    padding-bottom: 40px;
    width: 80%;
    justify-content: center;
    display: flex;
    margin: auto;

    }
    .tel{
      margin: auto 10px;
      width: 100%;
      text-align: center;
    }
    .custom-padding{
        padding-top: 10px;
    padding-bottom: 10px;
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
        text-align:right;
        width:100%;
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






</style>
</head>mysqli_fetch_array($query);
<body>









    
    <?php 
    include('config.php');
    $mid=$_REQUEST['mid'];
    /* $state=$_REQUEST['state'];
     $city= $_REQUEST['city'];
     $District=$_REQUEST['D'];
     $talukaa=$_REQUEST['t'];
     $Zone= $_REQUEST['Zone'];
     $country=$_REQUEST['cnt'];
     $village=$_REQUEST['v'];
     $Pincode=$_REQUEST['P'];*/
     
     $res=mysqli_query($conn,"select * from member where id='".$mid."' ");
      $row= mysqli_fetch_array($res);
     
    $Level=$row[1];
    $Loc= $row[2];
    $position=$row[3];
    
    // echo $Level.'-'.$Loc.'-'.$position;
    
   $query= mysqli_query($conn,"select * from member where level_id='".$Level."' and loc_id='".$Loc."' and position_id='".$position."' and status='1' and Waiting='Y' ");


   $fetch= mysqli_fetch_array($query);
   
    $PositionQuery= mysqli_query($conn,"select dasignation_name from committee_structure where id='".$position."' ");
   $PositionFetch= mysqli_fetch_array($PositionQuery);
   
   if($Level>=1){
    $contryQ=mysqli_query($conn,"select * from country where id=1 ");
    $contryF=mysqli_fetch_array($contryQ);
    $contryV= $contryF['country'];

   // echo "select * from country where id='".$Loc."' ";
   }
     
     if($Level>=2){      
         
   $zoneQ=mysqli_query($conn,"select * from zone where country_id='1' and id='".$fetch['zone']."'");
   
    $zoneF=mysqli_fetch_array($zoneQ);
   $zoneV= $zoneF['zone'];
     }
   mysqli_fetch_array($query);
   
   if ($Level>=3) {

   $stateQ=mysqli_query($conn,"select * from state where zone_id='".$fetch['zone']."' ");
echo "select * from state where zone_id='".$fetch['zone']."' ".'<br>';
   

   $stateF=mysqli_fetch_array($stateQ);
   $stateV=$stateF['state'];
   
   echo $stateV.'<br>';
   }
   
if ($Level>=4) {

   $cityQ=mysqli_query($conn,"select * from city where  state_id='".$stateF['id']."' ");
   $cityF=mysqli_fetch_array($cityQ);
   $cityV= $cityF['city'];
}
   
 if ($Level>=5) {
   $DistrictQ=mysqli_query($conn,"select * from district where  city_id='".$fetch['city']."' ");
   echo "select * from district where  city_id='".$fetch['city']."' ".'<br>';
   $DistrictF=mysqli_fetch_array($DistrictQ);
   $DistrictV=$DistrictF['district'];

 }
   
  if ($Level>=6) {
    $talukaQ=mysqli_query($conn,"select * from taluka where district_id='".$fetch['district']."' ");
    
    echo "select * from taluka where district_id='".$fetch['district']."' ".'<br>';
   
   $talukaF=mysqli_fetch_array($talukaQ);
   $talukaV= $talukaF['taluka'];

   }

if ($Level>=7) {

   $pincodeQ=mysqli_query($conn,"select * from pincode where taluka_id='".$talukaF['id']."' ");
   echo "select * from pincode where taluka_id='".$talukaF['id']."' ";
   $pincodeF=mysqli_fetch_array($pincodeQ);
   $pincodeV= $pincodeF['pincode'];
}
   
   if ($Level>=8) {
     
   $villageQ=mysqli_query($conn,"select * from village where pincode_id='".$pincodeF['id']."' ");
   $villageF=mysqli_fetch_array($villageQ);
   $villageV= $villageF['village'];
   }
   
   
   
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
 
    ?>

    
    























<div id="html-content-holder">
  


<div class="container-fluid"> 
<div class="main" >
  <!-- <img src="card_header.png" alt=""> -->
</div>

<div class="profile">
  
  <div class="row profile-info">
    <div class="col-md-7">  
    
    <div class="name"><span><?php echo $nm; ?></span></div>
    
    <div class="position">
      <span>
        Committee <?php echo $PositionFetch['dasignation_name']."-".$lev ; ?>
      </span>
    </div>
    <div class="contact">
      <span>  <?php echo $fetch['mobile']; ?></span>
    </div>

  



  </div>
  
  <div class="col-md-5 profile-image">
      <img src="<?php echo $fetch['file']; ?>" alt="">
  </div>
  </div>



<div class="table"> 
     <table  class="table-bordered">
        
        <tr >
            <th>Star</th><th>Place</th><th>Place Name</th>
        </tr>
        
         <tr <?php if($Level==1){ ?> style="background-color:#fcae007a" <?php } ?> > 

         
             <td width="30%" ><?php if($Level==1){ ?>
              <img src="star_img/8 star red.png" style="width:98%;padding-bottom:5px">
              <?php }
              else
                { ?>
                  <img src="star_img/8 star blank.png" style="width:98%;padding-bottom:5px">
                    <?php } ?>
              </td>
         
             <td width="25%">Country</td>
         
             <td><?php echo $contryV;?></td>
         

         </tr>
         
         
          <tr  <?php if($Level==2){ ?> style="background-color:#fcae007a" <?php } ?>>
             <td ><?php if($Level==2){ ?><img src="star_img/7 star red.png" style="width:92%;padding-left:3;padding-bottom:5px"><?php }else{ ?><img src="star_img/7 star blank.png" style="width:92%;padding-left:3;padding-bottom:6px"><?php } ?></td>
             <td >Zone</td>
             <td> <?php echo $zoneV;?></td>
          </tr>
         
         
          <tr <?php if($Level==3){ ?>style="background-color:#fcae007a" <?php } ?> >
             <td><?php if($Level==3){ ?><img src="star_img/6 star red.png" style="width:81%;margin-left:6px;padding-bottom:5px"><?php }else{ ?><img src="star_img/6 star blank.png" style="width:81%;margin-left:6px;"><?php } ?></td>
             <td>State</td>
             <td><?php echo $stateV;?></td>
         </tr>
         
         
          <tr <?php if($Level==4){ ?>style="background-color:#fcae007a" <?php } ?> >
             <td><?php if($Level==4){ ?><img src="star_img/5 star red.png" style="width:70%;margin-left:10px;padding-bottom:5px"><?php }else{ ?><img src="star_img/5 star blank.png" style="width:70%;margin-left:10px;padding-bottom:5px"><?php } ?></td>
             <td>City</td>
             <td><?php echo $cityV; ?></td>
          </tr>
           
           
          <tr <?php if($Level==5){ ?> style="background-color:#fcae007a" <?php } ?>>
             <td><?php if($Level==5){ ?><img src="star_img/4 star red.png" style="width:59%;margin-left:14px;padding-bottom:5px"><?php }else{ ?><img src="star_img/4 star blank.png" style="width:59%;margin-left:14px;padding-bottom:5px"><?php } ?></td>
             <td>District</td>
             <td><?php echo $DistrictV;?></td>
          </tr>
          
          
          
          <tr <?php if($Level==6){ ?>style="background-color:#fcae007a" <?php } ?> >
             <td><?php if($Level==6){ ?><img src="star_img/3 star red.png" style="width:43%;margin-left:22px;padding-bottom:5px"><?php }else{ ?><img src="star_img/3 star blank.png" style="width:43%;margin-left:22px;padding-bottom:5px"><?php } ?></td>
             <td>Taluka</td>
             <td><?php  echo $talukaV;?></td>
          </tr>
          
          <tr <?php if($level==7){ ?> style="background-color:#fcae007a" <?php } ?>>
             <td><?php if($Level==7){ ?><img src="star_img/2 star red.png" style="width:27%;margin-left:28px;padding-bottom:5px"><?php }else{ ?><img src="star_img/2 star blank.png" style="width:27%;margin-left:28px;padding-bottom:5px"><?php } ?></td>
             <td>Pincode</td>
             <td><?php echo $pincodeV;?></td>
          </tr>
          
          <tr <?php if($Level==8){ ?> style="background-color:#fcae007a" <?php } ?>>
             <td><?php if($Level==8){ ?><img src="star_img/1 star red.png" style="width:16%;margin-left:33px;padding-bottom:5px"><?php }else{ ?><img src="star_img/1 star blank.png" style="width:16%;margin-left:33px;padding-bottom:5px"><?php } ?></td>
             <td>Village</td>
             <td><?php echo $villageV;?></td>
          </tr>
          
     </table>

</div>



    <div class="flex dham-address custom-padding">  
          <img src="https://shyambabadham.com/images/placeholder.png" alt="" height="40">
    <a href="https://www.google.com/maps/place/Shyam+Baba+Dham/@19.1899985,72.8458425,17z/data=!4m12!1m6!3m5!1s0x3be7b7df6332cd33:0x1601ca0ed30dba72!2sShyam+Baba+Dham!8m2!3d19.1899934!4d72.8480312!3m4!1s0x3be7b7df6332cd33:0x1601ca0ed30dba72!8m2!3d19.1899934!4d72.8480312">
    1st Floor, 18/2, Sainath Road, Next to Lifeline Hospital Malad West Subway, Mumbai - 400064
    </a>
    </div>


    <div class="flex office-address custom-padding">  
          <img src="https://shyambabadham.com/images/placeholder.png" alt="" height="40">

          <a href="https://www.google.com/maps/place/Shyam+Baba+Mandir+Chanana/@28.0310975,75.6126402,17z/data=!3m1!4b1!4m5!3m4!1s0x39132f142b832b71:0x5a5fde55af8860a3!8m2!3d28.0310975!4d75.6148289">
            
        Shyam Baba Dham, Village - Chanana, District - Jhunjhunu, Rajasthan - 333026
          </a>
    </div>

    <div class="flex url custom-padding">
      <a href="https://shyambabadham.com">www.ShyamBabaDham.com</a>
    </div>

    <div class="flex mail custom-padding">  
        <a href="mailto:info@shyambabadham.com?Subject=Hello%20again" target="_top">
          info@ShyamBabaDham.com
        </a>
    </div>

    <div class="flex phone">  
        
        <a class="right" href="tel:+91 7700900702">7700900702</a>
        <a class="tel" href="tel:+91 7700900704">7700900704</a>
        


    </div>



</div>  





</div>


<?php 

$info=$_GET;

foreach ($info as $key => $value) {
    if (!isset($key)) {
        $value='';
    }
    
}


$links='https://shyambabadham.com/Committee/visiting.php?mid='.$mid;
$link=strval( $links );



 $info_array=array('Name : '.ucwords($nm),'Committee : '.$PositionFetch['dasignation_name'].' '.$lev,'Mobile Number : '.$fetch['mobile'],'Profile Link :'.$link);
    $info = implode('%0a', $info_array);

?>
<p style="color:black;">
    <?php echo $link; ?>
</p>


</div>











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
                var imgageData = 
                  getCanvas.toDataURL("image/jpeg"); 
              
                // Now browser starts downloading 
                // it instead of just showing it 
                var newData = imgageData.replace( 
                /^data:image\/jpeg/, "data:application/octet-stream"); 
              
                $("#btn-Convert-Html2Image").attr( 
                "download", "Vcard.jpeg").attr( 
                "href", newData); 
              }); 


          } 
        }); 
      }); 


    }); 
  </script> 






    
<div class="visiting-action">
    
    <a class="btn btn-primary" id="btn-Convert-Html2Image" href="#"> 
    Download
  </a> 


    <?php

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{ ?>
        <!--<a class="btn btn-success" href="whatsapp://send?abid=phonenumber&text=<?php echo $info;?>">Share on WhatsApp</a>-->
<?php } ?>

</div>

  
  <div id="previewImage" style="display: none;"></div>
</body>
</html>
