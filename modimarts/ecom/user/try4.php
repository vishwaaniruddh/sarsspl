<html>
<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 
 <script>
function a(){
  //swal('Good job!', 'You clicked the button!', 'success');
 
 /*	swal({
    title: 'Good job!',
    text: 'My example text here',
    type: 'success',
   closeOnConfirm: false,
}, function(){
    swal({
  title: "Are you sure?",
  text: "You will not be able to recover this imaginary file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  cancelButtonText: "No, cancel plx!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm) {
  if (isConfirm) {
    window.location="add_product.php";
  } else {
       window.location="welcome.php";  
  }
});


	
});          
*/

    swal({
  title: "data save",
 
  type: "success",
 
  confirmButtonClass: "btn-danger",
  confirmButtonText: "OK",
  
  closeOnConfirm: false
  
},
function(isConfirm) {
  if (isConfirm) {
    window.location="add_product.php";
  } 
});
	}
 

   </script>
  
</head>
    
<body onload="a()">
   <?php
   /* echo'<script>';
  echo'swal("success")';
  echo'</script>';*/
  echo '<script>swal("success")</script>';
  
  ?>
  
 
    </body>
    </html>