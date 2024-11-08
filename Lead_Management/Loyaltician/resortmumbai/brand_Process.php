<html>
 <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 </head>
<body>
<?php 
include("config.php");


if (isset($_POST['Update'])){
    
$BrandName=$_POST['BrandName'];
$MainID=$_POST['MainID'];

$brandinsert=mysqli_query($conn,"update Brand set Brand_name='".$BrandName."' where Brand_id='".$MainID."' ");
if($brandinsert){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Update Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   // swal("Poof! Your imaginary file has been deleted!", {
    //  icon: "success",
  //  });
    // window.open("brand_view.php","_self");
    window.location.href = "brand_view.php";
    
  } 
});
     
</script>
   
<?php }else{
    echo "error";
}
    
}


if (isset($_POST['Submit'])){

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
    // window.open("brand.php","_self");
    window.location.href = "brand.php";
    
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