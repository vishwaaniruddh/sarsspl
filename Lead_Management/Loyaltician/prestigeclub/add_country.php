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
    function setHotel(){
       
       
var Brand=document.getElementById("Brand").value;

$.ajax({
                    
                    type:'POST',
                    url:'setHotel.php',
                     data:'Brand='+Brand,
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                        var newoption=' <option value="">Select Hotel</option>' ;
                        $('#Hotel').empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                            newoption+= '<option id='+ jsr[i]["hotel_id"]+' value='+ jsr[i]["hotel_id"]+'>'+jsr[i]["Hotel_Name"]+'</option> ';
		                }                       
                     	$('#Hotel').append(newoption);
 
                    }
                })
                
       
        
    }

    function modelnos() {
                      var state=document.getElementById("state").value;

                    $.ajax({
                    type:'POST',
                    url:'city.php',
                     data:'state='+state,
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                        var newoption=' <option value="">Select</option>' ;
                        $('#City').empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		
                        
                        }                       
                     	$('#City').append(newoption);
 
                    }
                })
                
            }
            
    


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
    <!--site header begins-->
<?php include('navbar.php');?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                         <h4 class=""> Add Country </h4>
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
                                 Country Entry
                            </h5>
                           
                        </div>
                        <form method="post" action="country_process.php">
                        <div class="card-body ">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Country</label>
                                    <input type="text" class="form-control" id="Country" name="Country" placeholder="Country *" required="true">
                                </div>
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
            
            <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body"> 
                                <div class="table-responsive p-t-10">
                                    <table id="example" class="table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Srno</th>
                                                <th>Country</th>
                                                <th>Active</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $srn = 1;
                                            $fetchCountry = mysqli_query($conn,"select * from Country where active=1 ");
                                            while ($_row = mysqli_fetch_assoc($fetchCountry)) {
                                                $country = $_row['Country'];
                                                $active = $_row['Active'];
                                                if($active=1){
                                                    $_active = "Yes"; 
                                                }
                                                
                                                
                                            ?>
                                                <tr>
                                                    <td><?=$srn; ?></td>
                                                    <td><?=$country; ?></td>
                                                    <td><?=$_active; ?></td>
                                                    
                                                </tr>

                                            <?php

                                                $srn++;
                                            }
                                            ?>


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Srno</th>
                                                <th>Country</th>
                                                <th>Active</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </section>
</main>


<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/vendor/popper/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/select2/js/select2.full.min.js"></script>
<script src="assets/vendor/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/vendor/listjs/listjs.min.js"></script>
<script src="assets/vendor/moment/moment.min.js"></script>
<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/atmos.min.js"></script>
<!--page specific scripts for demo-->
</body>
</html>