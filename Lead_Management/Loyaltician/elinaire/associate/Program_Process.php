<html>
 <head>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
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
    // window.open("Program.php","_self");
      window.location.href = "Program.php";
    
  } 
});
     
</script>
   
<? }else{
    echo "error";
}

?>
</body>
</html>