<html>
 <head>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 </head>
<body>
<?php 
include("config.php");

$getid=$_POST['getid'];
$NewMembership=$_POST['NewMembership'];
$RenewalMembership=$_POST['RenewalMembership'];
$gst=$_POST['gst'];



 $hotelinsert=mysqli_query($conn,"update  `PrimaryMembershipFee` set `NewMembership`='".$NewMembership."', `RenewalMembership`='".$RenewalMembership."' , `GST`='".$gst."' where MembershipFee_id='".$getid."'");
                     
        
if($hotelinsert){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Update Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
window.location.href = "PrimaryMembershipFee_view.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("PrimaryMembershipFee_view.php","_self");
//       window.location.href = "PrimaryMembershipFee_view.php";
    
//   } 
// });
     
</script>
   
<?php }else{
    echo "error";
}

   
?>
</body>
</html>