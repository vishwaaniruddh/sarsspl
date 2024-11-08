<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php 
include("config.php");

$Program=$_POST['Program'];
$CloseLeadReason=$_POST['CloseLeadReason'];

$err=0;
   if (is_array($CloseLeadReason))
                    {
                        for($i=0;$i<count($CloseLeadReason);$i++)
                        { 
                         $hotelinsert=mysqli_query($conn,"insert into CloseLead (Program_ID,CloseLeadReason)values('".$Program."','".$CloseLeadReason[$i]."')");
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
})
.then((willDelete) => {
  if (willDelete) {

    window.open("CloseLeadMasters.php","_self");
    
  } 
});
     
</script>
   
<?php }else{
    swal("error");;
}

 
?>
</body>
</html>