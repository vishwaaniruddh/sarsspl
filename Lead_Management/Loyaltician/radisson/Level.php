<?php Session_Start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('header.php');
include('config.php');

$id=$_GET['id'];

$sql="select * from Level where Leval_id='".$id."'";
$runsql=mysqli_query($conn,$sql);
$fetchlevel=mysqli_fetch_array($runsql);

$sql2="select * from Program where Program_ID='".$fetchlevel['Program_ID']."'";
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
     var Program= document.getElementById("Program").value;
     var HotelName= document.getElementById("HotelName").value;
     
     if(Program=="")
     {
     swal("Please select Program ");
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
 
    <?php include('navbar.php'); ?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class="">  Level Creation
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
                                 Level Entry
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <form method="post" action="Level_process.php" enctype="multipart/form-data" onsubmit="return validation()" >
                        <input type="hidden" name="mainid" id="mainid" value="<?php echo $id?>"/>
                        <div class="card-body ">
                            <div class="form-group">
                                <label for="inputAddress">Program Name</label>&nbsp;
                                        <select class="form-control"  name="program" id="program"  <?php if($id!=""){?>disabled<?php } ?> required>
                                        <!--<option value="">Select Program *</option>-->
                                        <?php if($id!=""){?>
                                            <option value="<?php echo $fetchname['Program_ID'];?>" ><?php echo $fetchname['Progam_name']?> </option>
                                           <?php }else{?>
                                        <option value="">Select Program *</option>
                                        <?php }?>
                                         <?php 
                                          $abc="select Progam_name,Program_ID from Program ";
                                          $runabc=mysqli_query($conn,$abc);
                                          while($fetch=mysqli_fetch_array($runabc)){?>
                                          <option value="<?php echo $fetch['Program_ID'];?>" id="<?php echo $fetch['Program_ID']?>"><?php echo $fetch['Progam_name'];?></option>
                                         <?php } ?>
                                         </select> 
                                          
                                          </div>
                                          
                                      <table class="form-table" id="customFields">
                                    	<tr valign="top">
                                    		
                                    		<td>
                                    		    
                                    		        <div class="form-row">
                                <div class="form-group col-md-5">
                              	<input type="text" class="code form-control" id="levelName" name="levelName[]" value="<?php echo $fetchlevel['level_name']?>" placeholder="Level Name" required/> &nbsp;
                                    		  </div>
                                <div class="form-group col-md-5">
                                   
                               		<!--<input type="text" class="code form-control" id="price" name="price[]" value="<?php echo $fetchlevel['price']?>" placeholder="Price" required/> &nbsp;
                                    -->
                                    	 </div>
                                    	 <?php if($id==""){?>
                                    	  <div class="form-group col-md-2">	 <button type="button" class="btn m-b-15 ml-2 mr-2  btn-rounded-circle
                            btn-info addCF"><i class="mdi mdi-plus"></i></button></div>
                            <?php }?>
                            </div>
                                    		    
                                    			
                                    		</td>
                                    	</tr>
                                    </table>
                                      
                                      
                                      
                                      
                                      
                        
                        
                          <br />
                            <div class="form-group">
                                <?php if($id!=""){?>
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

<script>
    $(document).ready(function(){
	$(".addCF").click(function(){
		$("#customFields").append('<tr valign="top"><td><input type="text" class="code" id="levelName" name="levelName[]" value="" placeholder="Level Name" required/> &nbsp;  &nbsp; <button type="button" class="btn m-b-15 ml-2 mr-2  btn-rounded-circle btn-info remCF"><i class="mdi mdi-minus"></i></button></td></tr>');
	});
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
});
</script>

<?php include('belowScript.php');?>
</body>
</html>