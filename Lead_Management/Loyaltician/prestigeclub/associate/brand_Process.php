<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php 
include("config.php");

$BrandName=$_POST['BrandName'];

$brandinsert=mysqli_query($conn,"insert into Brand (Brand_name)values('".$BrandName."')");
if($brandinsert){?>
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
    window.open("brand.php","_self");
    
  } 
});
     
</script>
   
<? }else{
    echo "error";
}

?>
</body>
</html>