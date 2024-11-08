<html>
 <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 </head>
<body>
<?php 
include("config.php");

$ParticipatingHotels=$_POST['ParticipatingHotels'];

$serviceName=$_POST['serviceName'];
$POScode=$_POST['POScode'];
if(isset($_POST['update'])){

 $mainid=$_POST['mainid']; 
  if (is_array($serviceName))
                    {
                        for($i=0;$i<count($serviceName);$i++)
                        {
 $sqlupdate=mysqli_query($conn,"update  services set name='".$serviceName[$i]."',POScode='".$POScode[$i]."' where Service_id='".$mainid."'");
                        }
                    }
if($sqlupdate){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Updated Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
 window.location.href = "services_view.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("services_view.php","_self");
//       window.location.href = "services_view.php";
    
//   } 
// });
     
</script>
   
<?php }else{
    echo "error";
}   

}
if(isset($_POST['submit'])){
$err=0;
   if (is_array($serviceName))
                    {
                        for($i=0;$i<count($serviceName);$i++)
                        {  $hotelinsert=mysqli_query($conn,"INSERT INTO `services`(`ParticipatingHotels`,`level_id`, `name`,`POScode`) VALUES('".$ParticipatingHotels."','".$Level."','".$serviceName[$i]."','".$POScode[$i]."')");
                        }
                   $err++;
                     }
                     
        
if($err>0){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Add Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   // swal("Poof! Your imaginary file has been deleted!", {
    //  icon: "success",
  //  });
    // window.open("services.php","_self");
      window.location.href = "services.php";
    
  } 
});
     
</script>
   
<?php }else{
    echo "error";
}
}
   
?>
</body>
</html>