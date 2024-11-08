<html>
 <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 </head>
<body>
<?php 
include("config.php");

$Program=$_POST['Program'];
$Level=$_POST['Level'];
$CardBenefit=$_POST['CardBenefit'];

if (isset($_POST['Update'])){
$MainID=$_POST['MainID'];
  
             
             $err=0;    
   if (is_array($CardBenefit))
                    {
                        for($i=0;$i<count($CardBenefit);$i++)
                        { 
                         $hotelinsert=mysqli_query($conn,"update CardBenefit set CardBenefit='".$CardBenefit[$i]."' where CardBenefit_id='".$MainID."'");
                        }
                   $err++;
                     }

if($err>0){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Update Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
  window.open("CardBenefits_view.php","_self");
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     window.open("CardBenefits_view.php","_self");
    
//   } 
// });
     
</script>
   
<?php }else{
    swal("error");;
}

             
             
         }
         
         
                      



if (isset($_POST['Submit'])){

$err=0;    
   if (is_array($CardBenefit))
                    {
                        for($i=0;$i<count($CardBenefit);$i++)
                        { 
                         $hotelinsert=mysqli_query($conn,"insert into CardBenefit (Program_ID,level_id,CardBenefit)values('".$Program."','".$Level."','".$CardBenefit[$i]."')");
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
});
 window.location.href = "Card_Benefits.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("Card_Benefits.php","_self");
//       window.location.href = "Card_Benefits.php";
    
//   } 
// });
     
</script>
   
<?php }else{
    swal("error");;
}

}

?>
</body>
</html>