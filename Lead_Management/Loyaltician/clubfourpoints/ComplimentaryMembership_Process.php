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
$P_Level=$_POST['P_Level'];
$MembershipFee=$_POST['MembershipFee'];

$hotelinsert=mysqli_query($conn,"INSERT INTO `ComplimentaryMembership`(`Progm_id`, `level_id`, `MembershipFee`) VALUES('".$Program."','".$P_Level."','".$MembershipFee."')");

if($hotelinsert){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Add Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
 window.location.href = "ComplimentaryMembership.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("ComplimentaryMembership.php","_self");
//       window.location.href = "ComplimentaryMembership.php";
    
//   } 
// });
     
</script>
   
<?php }else{
    echo "error";
}

   
?>
</body>
</html>