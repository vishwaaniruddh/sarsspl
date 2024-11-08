<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php 
include("config.php");

$Hotel=$_POST['Hotel'];
$serviceName=$_POST['serviceName'];
$POScode=$_POST['POScode'];

$err=0;
   if (is_array($serviceName))
                    {
                        for($i=0;$i<count($serviceName);$i++)
                        {  $hotelinsert=mysqli_query($conn,"INSERT INTO `services`(`hotel_id`, `name`,`POScode`) VALUES('".$Hotel."','".$serviceName[$i]."','".$POScode[$i]."')");
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
    window.open("hotel_creation.php","_self");
    
  } 
});
     
</script>
   
<? }else{
    echo "error";
}

   
?>
</body>
</html>