<html>
 <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 </head>
<body>
<?php 
include("config.php");

$Program=$_POST['program'];
$ParticipatingHotelsName=$_POST['ParticipatingHotelsName'];
if(isset($_POST['update'])){
  $mainid=$_POST['mainid'];  
 $sqlupdate=mysqli_query($conn,"update  Program set Hotel_id='".$Hotel."',Progam_name='".$Program."' where Program_ID='".$mainid."'");
if($sqlupdate){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Updated Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
 window.location.href = "Members_view.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("Program_view.php","_self");
//       window.location.href = "Members_view.php";
    
//   } 
// });
     
</script>
   
<?php }else{
    echo "error";
}   
}

if(isset($_POST['submit'])){

$programInsert=mysqli_query($conn,"insert into  ParticipatingHotels(Progam_name,ParticipatingHotelsName)values('".$Program."','".$ParticipatingHotelsName."')");
if($programInsert){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Add Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
 window.location.href = "Members_view.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("ParticipatingHotels.php","_self");
//       window.location.href = "Members_view.php";
    
//   } 
// });
     
</script>
   
<?php }else{
    echo "error";
}
}
?>
</body>
</html>