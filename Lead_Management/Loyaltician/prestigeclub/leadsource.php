<?php Session_Start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('header.php');
include('config.php');

$id=$_GET['id'];
$sql="select * from Lead_Sources where SourceId='".$id."'";
$runsql=mysqli_query($conn,$sql);
$fetch1=mysqli_fetch_array($runsql);
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
     var Program= document.getElementById("Program").value;
     
     if(Brand=="")
     {
     swal("Please select Brand");
     return false;
     } 
     else if(Program=="")
     {
     swal("Please enter Program");
     return false;
     } 
     
     else{
 
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

                        <h4 class="">  Lead Source Creation
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
                                 Lead Source Entry
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <form method="post" action="leadsource_process.php" onsubmit="return validation()" >
                            <input type="hidden" name="mainid" id="mainid" value="<?php echo $id?>"/>
                        <div class="card-body ">
                           
                            
                            <div class="form-group">
                                <label for="inputAddress">Name</label>&nbsp;<label id="label3"></label>
                                <input type="text" class="form-control" id="Name" name="Name" placeholder="Name *"  value="<?php echo $fetch1['Name']?>" required>
                            </div>
                        
                             <div class="form-group">
                                <label for="inputAddress">Description</label>&nbsp;<label id="label3"></label>
                                <input type="text" class="form-control" id="Description" name="Description" placeholder="Description *" value="<?php echo $fetch1['Description']?>" required>
                            </div>
                            
                             <div class="form-group">
                                <label for="inputAddress">Active</label>&nbsp;<label id="label3"></label>
                                        <select class="form-control"  name="Active" id="Active"  required>
                                        <!--<option value="">Select </option>-->
                                          <?php if($id!=""){?>
                                            <option value="<?php echo $fetch1['Active'];?>" ><?php echo $fetch1['Active']?> </option>
                                           <?php }else{?>
                                        <option value="">select </option>
                                        <?php }?>
                                          <option value="YES" id="YES">YES</option>
                                          <option value="NO" id="NO">NO</option>
                                         
                                          </select>
                        
                        
                        
                            </div>
                            
                          
                            <div class="form-group">
                                 <?php 
                                if($id!=""){?>
                                <button type="submit" class="btn btn-primary" name="update">Update</button>
                                <?php }else{?>
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <?php }?>
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