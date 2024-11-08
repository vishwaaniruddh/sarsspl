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
$Level_id=$_POST['Level_id'];
$FromSerial=$_POST['FromSerial'];
$ToSerial=$_POST['ToSerial'];

$err=0;
   if (is_array($FromSerial))
                    {
                        for($i=0;$i<count($FromSerial);$i++)
                        { 
                         $hotelinsert=mysqli_query($conn,"insert into voucher_Booklet (hotel_id,FromSerialNo,ToSerialNo,Level_id)values('".$Hotel."','".$FromSerial[$i]."','".$ToSerial[$i]."','".$Level_id[$i]."')");
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
    // window.open("voucher_booklet.php","_self");
      window.location.href = "voucher_booklet.php";
    
  } 
});
     
</script>
   
<? }else{
    swal("error");;
}


?>
</body>
</html>