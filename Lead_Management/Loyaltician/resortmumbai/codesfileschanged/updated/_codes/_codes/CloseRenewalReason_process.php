<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    window.open("CloseRenewalMasters.php","_self");
    
  } 
});
     
</script>
   
<?php }else{
    swal("error");;
}


?>
</body>
</html>