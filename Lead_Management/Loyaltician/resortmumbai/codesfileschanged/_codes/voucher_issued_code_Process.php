<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php
include("config.php");

$Program=$_POST['Program'];
// $VoucherCode=$_POST['VoucherCode'];
$voucherCode=$_POST['voucherCode'];
$voucherName=$_POST['voucherName'];


$err=0;
   if (is_array($voucherCode))
                    {
                        for($i=0;$i<count($voucherCode);$i++)
                        {  $hotelinsert=mysqli_query($conn,"INSERT INTO `voucher_issued_code`(`Program_ID`, `voucher_code`,`voucher_name`) VALUES('".$Program."','".$voucherCode[$i]."','".$voucherName[$i]."')");
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
    window.open("voucher_issued_code.php","_self");

  }
});

</script>

<?php }else{
    echo "error";
}


?>
</body>
</html>