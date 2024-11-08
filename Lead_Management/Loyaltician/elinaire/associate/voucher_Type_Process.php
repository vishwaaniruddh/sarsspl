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

$serialNo=$_POST['serialNo'];
$ServiceName=$_POST['ServiceName'];


$err=0;
   if (is_array($serialNo))
                    {
                        for($i=0;$i<count($serialNo);$i++)
                        {  $hotelinsert=mysqli_query($conn,"INSERT INTO `voucher_Type`(`hotel_id`, `serialNumber`,`serviceName`) VALUES('".$Hotel."','".$serialNo[$i]."','".$ServiceName[$i]."')");
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
    // window.open("voucher_Type.php","_self");
      window.location.href = "voucher_Type.php";
    
  } 
});
     
</script>
   
<? }else{
    echo "error";
}

   
?>
</body>
</html>