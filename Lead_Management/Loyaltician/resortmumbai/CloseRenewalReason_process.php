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
$CloseRenewalReason=$_POST['CloseRenewalReason'];

$err=0;
   if (is_array($CloseRenewalReason))
                    {
                        for($i=0;$i<count($CloseRenewalReason);$i++)
                        { 
                         $hotelinsert=mysqli_query($conn,"insert into CloseRenewal (Program_ID,CloseRenewalReason)values('".$Program."','".$CloseRenewalReason[$i]."')");
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
    // window.open("CloseRenewalMasters.php","_self");
    window.location.href = "CloseRenewalMasters.php";
    
  } 
});
     
</script>
   
<?php }else{
    swal("error");;
}


?>
</body>
</html>