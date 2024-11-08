<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php 
include("config.php");

$program=$_POST['program'];
$levelName=$_POST['levelName'];



if(isset($_POST['update'])){

 $mainid=$_POST['mainid']; 
  if (is_array($levelName))
                    {
                        for($i=0;$i<count($levelName);$i++)
                        {
 $sqlupdate=mysqli_query($conn,"update  Level set level_name='".$levelName[$i]."' where Leval_id='".$mainid."'");
                        }
                    }
if($sqlupdate){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Updated Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   // swal("Poof! Your imaginary file has been deleted!", {
    //  icon: "success",
  //  });
    window.open("Level_view.php","_self");
    
  } 
});
     
</script>
   
<?php }else{
    echo "error";
}   

}
if(isset($_POST['submit'])){
$err=0;
   if (is_array($levelName))
                    {
                        for($i=0;$i<count($levelName);$i++)
                        {  $hotelinsert=mysqli_query($conn,"INSERT INTO `Level`(`Program_ID`, `level_name`) VALUES('".$program."','".$levelName[$i]."')");
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
   // swal("Poof! Your imaginary file has been deleted!", {
    //  icon: "success",
  //  });
    window.open("Level.php","_self");
    
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