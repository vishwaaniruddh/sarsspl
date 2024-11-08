<html>
 <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 </head>
<body>
<?php
include 'config.php';
$Name=$_POST['Name'];
$Description=$_POST['Description'];
$Active=$_POST['Active'];

if(isset($_POST['update'])){

 $mainid=$_POST['mainid']; 
 
 $sqlupdate=mysqli_query($conn,"update  Lead_Sources set Name='".$Name."',Description='".$Description."',Active='".$Active."' where SourceId='".$mainid."'");
            
if($sqlupdate){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Updated Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
window.location.href = "leadsource.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("leadsource_view.php","_self");
//       window.location.href = "leadsource.php";
    
//   } 
// });
     
</script>
   
<?php }else{
    echo "error";
}   

}
if(isset($_POST['submit'])){
$sql="insert into Lead_Sources(Name,Description,Active) values('".$Name."','".$Description."','".$Active."')";
$runsql=mysqli_query($conn,$sql);
$last=mysqli_insert_id($conn);
//echo $sql;
if($last){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Add Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
 window.location.href = "leadsource.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("leadsource.php","_self");
//       window.location.href = "leadsource.php";
    
//   } 
// });
     
</script>
   
<?php }else{
    echo "error";
}

}        
   

?>