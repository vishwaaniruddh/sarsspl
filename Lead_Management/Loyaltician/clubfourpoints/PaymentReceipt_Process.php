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
$fromSeries=$_POST['fromSeries'];
$ToSeries=$_POST['ToSeries'];
$ReceiptFormat=$_POST['ReceiptFormat'];

$hotelinsert=mysqli_query($conn,"INSERT INTO `PaymentReceipt`(`Program_ID`, `FromSeries`,`ToSeries`, `ReceiptFormat`) VALUES('".$Program."','".$fromSeries."','".$ToSeries."','".$ReceiptFormat."')");

if($hotelinsert){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Add Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
    window.location.href = "PaymentReceipt.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("PaymentReceipt.php","_self");
//     window.location.href = "PaymentReceipt.php";
    
//   } 
// });
     
</script>
   
<?php }else{
    echo "error";
}

   
?>
</body>
</html>