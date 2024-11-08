<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php 
include("config.php");

$Program=$_POST['Program'];
$MembershipType=$_POST['MembershipType'];


$err=0;
   if (is_array($MembershipType))
                    {
                        for($i=0;$i<count($MembershipType);$i++)
                        {  $hotelinsert=mysqli_query($conn,"INSERT INTO `MembershipType`(`Progm_id`, `MembershipType`) VALUES('".$Program."','".$MembershipType[$i]."')");
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
    window.open("MembershipType.php","_self");
    
  } 
});
     
</script>
   
<?php }else{
    echo "error";
}

   
?>
</body>
</html>