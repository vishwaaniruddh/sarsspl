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
$Level_id=$_POST['Level'];
$FromSerial=$_POST['FromSerial'];
$ToSerial=$_POST['ToSerial'];



if(isset($_POST['update'])){
                             $mainid=$_POST['mainid']; 
                        
                        $err=0;
   if (is_array($FromSerial))
                    {
                        for($i=0;$i<count($FromSerial);$i++)
                        {      
                           $hotelinsert=mysqli_query($conn,"update voucher_Booklet set FromSerialNo='".$FromSerial[$i]."',ToSerialNo='".$ToSerial[$i]."' where v_id='".$mainid."'");
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
  window.location.href = "voucher_booklet_view.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("voucher_booklet_view.php","_self");
//     window.location.href = "voucher_booklet_view.php";
    
//   } 
// });
     
</script>
   
<?php }else{
    swal("error");;
}

}



if(isset($_POST['submit'])){
$err=0;
   if (is_array($FromSerial))
                    {
                        for($i=0;$i<count($FromSerial);$i++)
                        { 
                         $hotelinsert=mysqli_query($conn,"insert into voucher_Booklet (Program_ID,Level_id,FromSerialNo,ToSerialNo)values('".$Program."','".$Level_id[$i]."','".$FromSerial[$i]."','".$ToSerial[$i]."')");
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
window.location.href = "voucher_booklet.php";
// .then((willDelete) => {
//   if (willDelete) {
//   // swal("Poof! Your imaginary file has been deleted!", {
//     //  icon: "success",
//   //  });
//     // window.open("voucher_booklet.php","_self");
//     window.location.href = "voucher_booklet.php";
    
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