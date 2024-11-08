<?php Session_Start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include ('header.php');
include ('config.php');
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
     var Brand= document.getElementById("BrandName").value;
     
     if(Brand=="")
     {
     swal("Please enter brand name");
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

<?php include ("vertical_menu.php") ?>


<main class="admin-main">
    
    <?php include ('navbar.php'); ?>
    
        <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class="">  New Brands
                        </h4>
                       <!-- <p class="opacity-75 ">
                            Examples for form control styles, layout options, and custom components for
                            creating a wide variety of forms elements.
                            <br>
                            we have included dropzone for file uploads, datepicker and select2 for custom controls.
                        </p>-->


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
                                 Brand Entry
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <form method="post" action="brand_Process.php" onsubmit="return validation()" >
                            <?php
                            if ($_GET['id'] != "") {
                                $View = "select * from Brand where Brand_id='" . $_GET['id'] . "' ";
                                $qrys = mysqli_query($conn, $View);
                                $_row = mysqli_fetch_array($qrys);

                                ?>
                            
                        <input type="hidden" class="form-control" id="MainID" name="MainID"  value="<?php if ($_GET['id'] != "") {
                            echo $_row['Brand_id'];
                        } ?>"  required>
                            <?php } ?> 
                        <div class="card-body ">
                            <div class="form-group">
                                <label for="inputAddress">Brand Name</label>&nbsp;<label id="label3"></label>
                                <input type="text" class="form-control" id="BrandName" name="BrandName" placeholder="Brand Name *" value="<?php if ($_GET['id'] != "") {
                                    echo $_row['Brand_name'];
                                } ?>"  required>
                            </div>
                        
                            
                        <?php if ($_GET['id'] == "") { ?>
                                <div class="form-group">
                                    <button type="submit" id="Submit" name="Submit" class="btn btn-primary" >Submit</button>
                                </div>
                            <?php } else { ?>
                                <div class="form-group">
                                    <button type="submit" id="Update" name="Update" class="btn btn-primary" >Update</button>
                                </div>
                            <?php } ?>
                            
                        </div>
                        </form>
                    </div>
                    <!--widget card ends-->

                                     


                </div>
              
            </div>


        </div>
    </section>
</main>


<?php include ('belowScript.php'); ?>
</body>
</html>