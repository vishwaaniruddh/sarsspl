<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php 
include("config.php");

$BrandName=$_POST['Brand'];
$Program=$_POST['Program'];
$programInsert=mysqli_query($conn,"insert into  Program(Progam_name,brand_name)values('".$Program."','".$BrandName."')");
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
    window.open("Program.php","_self");
    
  } 
});
     
</script>
   
<? }else{
    echo "error";
}

?>
</body>
</html>