<?php 
Session_Start();
include('header.php');
include('config.php');
$check=$_POST['check'];
$_SESSION["delvalue"]=$check;
?>
<!DOCTYPE html>
<html lang="en">
<head>


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
    
    var Sales= document.getElementById("Sales").value; 
     
     if(Sales=="")
     {
     swal("please Select Drop down");
     return false;
     } 
    
     else{
     
     document.getElementById("myForm").submit();
     return true;
     
          }
          
}
</script>



</head>
<body class="sidebar-pinned">

<?php include("vertical_menu.php")?>


<main class="admin-main">
    
    <?php include('navbar.php'); ?>
    
        <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> Select Sales associate
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
                                 Sales associate
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <form id="myForm" method="post" action="delegate_process.php" >
                           
                        <div class="card-body ">
                            <div class="form-group">
                                <label for="inputAddress">Associate</label>&nbsp;<label id="label3"></label>
                             
                             <select class="form-control" name="Sales" id="Sales">
                              <option value=" ">Select Sales associate</option>
                          <?php 
                          
                          $abc="select * from SalesAssociate ";
                          
                          $runabc=mysqli_query($conn,$abc);
                          while($fetch=mysqli_fetch_array($runabc)){?>
                          <option value="<?php echo $fetch['SalesmanId'];?>"><?php echo $fetch['FirstName']?></option>
                         <?php } ?>
                          </select>
                            </div>
                        
                            
                        
                            <div class="form-group">
                                <button type="button" onclick="validation()" class="btn btn-primary" >Submit</button>

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