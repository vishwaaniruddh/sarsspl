<?php Session_Start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('header.php');
include('config.php');
$id=$_GET['id'];
$sql="select * from Program where Program_ID='".$id."'";
$runsql=mysqli_query($conn,$sql);
$fetch1=mysqli_fetch_array($runsql);

$sql2="select * from Hotel_Creation where hotel_id='".$fetch1['Hotel_id']."'";
$runsql2=mysqli_query($conn,$sql2);
$fetchname=mysqli_fetch_array($runsql2);
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
    
     var Hotel= document.getElementById("Hotel").value;
     var Program= document.getElementById("Program").value;
     
     if(Hotel=="")
     {
     swal("Please select Hotel");
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


  <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class="">  Program Creation
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
                                 Program Entry
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <form method="post" action="Program_Process.php" onsubmit="return validation()" >
                        <input type="hidden" name="mainid" id="mainid" value="<?php echo $id?>"/>
                        <div class="card-body ">
                            <div class="form-group">
                                <label for="inputAddress">Hotel Name</label>&nbsp;<label id="label3"></label>
                                        <select class="form-control"  name="Hotel" id="Hotel"   <?php if($id!=""){?>readonly<?php } ?> required>
                                            <?php if($id!=""){?>
                                            <option value="<?php echo $fetchname['hotel_id'];?>" ><?php echo $fetchname['Hotel_Name']?> </option>
                                           <?php }else{?>
                                        <option value="">select </option>
                                        <?php }?>
                                          <?php 
                                          $abc="select * from Hotel_Creation";
                                          $runabc=mysqli_query($conn,$abc);
                                          while($fetch=mysqli_fetch_array($runabc)){?>
                                          <option value="<?php echo $fetch['hotel_id'];?>" id="<?php echo $fetch['hotel_id'];?>"><?php echo $fetch['Hotel_Name']?></option>
                                         <?php } ?>
                                          </select>
                        
                        
                        
                            </div>
                            
                            <div class="form-group">
                                <label for="inputAddress">Program</label>&nbsp;<label id="label3"></label>
                                <input type="text" class="form-control" id="Program" name="Program" placeholder="Program *" value="<?php echo $fetch1['Progam_name']?>" required>
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