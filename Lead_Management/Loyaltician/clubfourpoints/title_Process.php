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
    
$TitleName=$_POST['TitleName'];
$MainID=$_POST['MainID'];

$brandinsert=mysqli_query($conn,"update Title set titleName='".$TitleName."' where title_id='".$MainID."' ");
if($brandinsert){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Update Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
 window.location.href = "title_view.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("title_view.php","_self");
//     window.location.href = "title_view.php";
//   } 
// });
     
</script>
   
<?php }else{
    echo "error";
}
    
}


if (isset($_POST['Submit'])){

$TitleName=$_POST['TitleName'];

$brandinsert=mysqli_query($conn,"insert into Title (titleName)values('".$TitleName."')");
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
    // window.open("title.php","_self");
    window.location.href = "title.php";
    
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