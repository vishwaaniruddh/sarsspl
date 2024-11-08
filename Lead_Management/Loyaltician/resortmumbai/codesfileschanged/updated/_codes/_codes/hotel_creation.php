<?php Session_Start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('header.php');
include('config.php');
?>

<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 

</script>

<script>
    function validation()
    {
     var Brand= document.getElementById("Brand").value;
     var HotelName= document.getElementById("HotelName").value;
     
     if(Brand=="")
     {
     swal("Please select Brand ");
     return false;
     } 
     else if(HotelName=="")
     {
     swal("Please enter Hotel Name ");
     return false;
     } 
     else
     {
     return true;
     }
          
    }

</script>



</head>
<body class="sidebar-pinned">

<?php include("vertical_menu.php")?>


<main class="admin-main">
    <!--site header begins-->
 <?php include('navbar.php'); ?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class="">  Hotel Creation
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="container  pull-up">
            <div class="row">
                <div class="col-lg-6">

                    <!--widget card begin-->
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                 Hotel Entry
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <form method="post" action="hotel_creation_Process.php" enctype="multipart/form-data" onsubmit="return validation()" >
                        <div class="card-body ">
                            <div class="form-group">
                                <label for="inputAddress">Brand Name</label>&nbsp;<label id="label3"></label>
                                        <select class="form-control"  name="Brand" id="Brand"  required>
                                        <option value="">Select Brand</option>
                                          <?php 
                                          $abc="select * from Brand";
                                          $runabc=mysqli_query($conn,$abc);
                                          while($fetch=mysqli_fetch_array($runabc)){?>
                                          <option value="<?php echo $fetch['Brand_id'];?>" id="<?php echo $fetch['Brand_name'];?>"><?php echo $fetch['Brand_name']?></option>
                                         <?php } ?>
                                          </select>
                                          
                                          </div>
                                          
                                            <div class="form-group">
                                          <label for="inputAddress">Logo Upload</label>&nbsp;
                                           <div class="custom-file">
                                               
                                        <input type="file" class="custom-file-input" id="Logo" name="Logo" required>
                                        <label class="custom-file-label" for="inputGroupFile02"
                                               >Choose file *</label>
                                            </div>
                                            </div>
                        
                            <div class="form-group">
                                <label for="inputAddress">Hotel Name</label>&nbsp;
                                <input type="text" class="form-control" id="HotelName" name="HotelName" placeholder="Hotel Name *"  required>
                            </div>
                            
                          
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!--widget card ends-->

                                     


                </div>
              
            </div>


        </div>
    </section>
</main>



<?php include('belowScript.php');?>
</body>
</html>