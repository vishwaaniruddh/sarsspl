<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 </head>
<body>
<?php 
include("config.php");

$Hotel=$_POST['Hotel'];
$Month=$_POST['Month'];
                        
                        
                          $hotelinsert=mysqli_query($conn,"INSERT INTO `validity`(`hotel_id`, `Expiry_month`) VALUES('".$Hotel."','".$Month."')");
                
        
if($hotelinsert){?>
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
    // window.open("validity.php","_self");
      window.location.href = "validity.php";
  } 
});
     
</script>
   
<? }else{
    echo "error";
}

   
?>
</body>
</html>