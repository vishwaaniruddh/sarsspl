<html>
 <head>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 </head>
<body>
<?php 
include("config.php"); 

$Program=$_POST['Program'];
$Level=$_POST['Level'];
$Month=$_POST['Month'];

if(isset($_POST['update'])){
                             $mainid=$_POST['mainid']; 
                             
                             
       
                          $hotelupdate=mysqli_query($conn,"update `validity` set Expiry_month='".$Month."' where validity_id='".$mainid."' ");
              // echo " update `validity` set Expiry_month='".$Month."' where validity_id='".$mainid."' ";
        
       
        
if($hotelupdate){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Update Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
 window.location.href = "validity_view.php";
.then((willDelete) => {
  if (willDelete) {
   // swal("Poof! Your imaginary file has been deleted!", {
    //  icon: "success",
  //  });
    // window.open("validity_view.php","_self");
    window.location.href = "validity_view.php";
  } 
});
     
</script>
   
<?php }else{
   
    echo "error";
}
                   
                             
                        
}


if(isset($_POST['submit'])){
                          $hotelinsert=mysqli_query($conn,"INSERT INTO `validity`(`Program_ID`,`Leval_id`, `Expiry_month`) VALUES('".$Program."','".$Level."','".$Month."')");
                
        
if($hotelinsert){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Add Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
 window.location.href = "validity.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("validity.php","_self");
//     window.location.href = "validity.php";
//   } 
// });
     
</script>
   
<?php }else{
    echo "error";
}
}
   
?>
</body>
</html>