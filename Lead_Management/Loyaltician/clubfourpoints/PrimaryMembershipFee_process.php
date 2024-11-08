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
$NewMembership=$_POST['NewMembership'];
$RenewalMembership=$_POST['RenewalMembership'];
$gst=$_POST['gst'];



 $hotelinsert=mysqli_query($conn,"INSERT INTO `PrimaryMembershipFee`(`Program_id`, `P_Level_id`, `NewMembership`, `RenewalMembership`, `GST`) VALUES('".$Program."','".$P_Level."','".$NewMembership."','".$RenewalMembership."','".$gst."')");
                     
        
if($hotelinsert){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Add Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
window.location.href = "PrimaryMembershipFee.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("PrimaryMembershipFee.php","_self");
//       window.location.href = "PrimaryMembershipFee.php";
    
//   } 
// });
     
</script>
   
<?php }else{
    echo "error";
}

   
?>
</body>
</html>