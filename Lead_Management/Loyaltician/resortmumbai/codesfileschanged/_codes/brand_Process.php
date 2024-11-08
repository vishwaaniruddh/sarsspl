<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    window.open("brand_view.php","_self");
    
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
    window.open("brand.php","_self");
    
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