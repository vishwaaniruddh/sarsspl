<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
})
.then((willDelete) => {
  if (willDelete) {
   // swal("Poof! Your imaginary file has been deleted!", {
    //  icon: "success",
  //  });
    window.open("PaymentReceipt.php","_self");
    
  } 
});
     
</script>
   
<?php }else{
    echo "error";
}

   
?>
</body>
</html>