<?php
session_start();
include('config.php');

if(isset($_SESSION['gid']) & $_SESSION['gid']!="")
{
      
  //    fullname  plotNo  wingNo buildingName roadNo landmark  locality zone_id city pincode
           
          $fullname= $_POST['fullname'];
          $plotNo= $_POST['plotNo'];
          $wingNo= $_POST['wingNo'];
          $buildingName= $_POST['buildingName'];
          $roadNo= $_POST['roadNo'];
          $landmark= $_POST['landmark'];
          $locality= $_POST['locality'];
          $zone_id= $_POST['state_Show_Only'];
          
          $city= $_POST['city']; 
          
          $city = 1;
          $pincode= $_POST['pincode']; 
          
          
        $fulnm=explode(" ",$fullname);
        if($fulnm[0]!=""){ $fnm=$fulnm[0]; }else{$fnm=""; }
        if($fulnm[1]!=""){ $lnm=$fulnm[1]; }else{$lnm=""; }
          
         $addr=  $plotNo.$wingNo.$buildingName.$roadNo.$landmark.$locality.$zone_id.$city.$pincode;
           
           
    
 $gtsts=mysqli_query($con1,"SELECT * FROM `states` where state_name='".$zone_id."'");
    $stsrw=mysqli_fetch_array($gtsts);

      $updateqry=mysqli_query($con1,"update Registration set Firstname='".$fnm."',Lastname='".$lnm."',address='".$addr."',pincode='".$pincode."',landmark='".$landmark."',state='".$stsrw[0]."',city='".$city."',wingNo='".$wingNo."',plotNo='".$plotNo."',buildName='".$buildingName."',roadNo='".$roadNo."',Locality='".$locality."' where id='".$_SESSION['gid']."'  ");
  
    $qryaddrqr=mysqli_query($con1,"INSERT INTO `user_address`(`user_id`, `address`, `state`, `city`, `pin`) VALUES('".$_SESSION['gid']."','".$addr."','".$stsrw[0]."','".mysqli_real_escape_string($city)."','".mysqli_real_escape_string($pincode)."')"); 

     if(!$qryaddrqr){ //echo mysql_error();
     echo 0;
     }else
     {
         echo 1;
         
     }
}else
{
    echo 2;
}
       
       ?>