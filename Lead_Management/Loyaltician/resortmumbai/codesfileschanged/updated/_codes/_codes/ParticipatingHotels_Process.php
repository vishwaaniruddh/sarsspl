<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
})
.then((willDelete) => {
  if (willDelete) {
   // swal("Poof! Your imaginary file has been deleted!", {
    //  icon: "success",
  //  });
    window.open("Program_view.php","_self");
    
  } 
});
     
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
})
.then((willDelete) => {
  if (willDelete) {
   // swal("Poof! Your imaginary file has been deleted!", {
    //  icon: "success",
  //  });
    window.open("ParticipatingHotels.php","_self");
    
  } 
});
     
</script>
   
<?php }else{
    echo "error";
}
}
?>
</body>
</html>