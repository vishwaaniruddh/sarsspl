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

function setProgram(){
    

                $.ajax({
                    type:'POST',
                    url:'setProgram.php',
                     data:'',
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                      
                        var newoption=' <option value="">Select Program *</option>' ;
                        $('#Program').empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["Program_ID"]+' value='+ jsr[i]["Program_ID"]+'   >'+jsr[i]["Progam_name"]+'</option> ';
		
                        
                        }                       
                     	$('#Program').append(newoption);
 
                    }
                })
                
            }



function levelSet(){
    
var Program=document.getElementById("Program").value;
//alert(state);
                $.ajax({
                    type:'POST',
                    url:'levelset.php',
                     data:'Program='+Program,
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                      
                        var newoption=' <option value="">Select Level *</option>' ;
                        $('#Level').empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'   >'+jsr[i]["levelname"]+'</option> ';
		
                        
                        }                       
                     	$('#Level').append(newoption);
 
                    }
                })
                
            }
            
            


    function validation()
    {
     var Program= document.getElementById("Program").value;
     var Level= document.getElementById("Level").value;
     var CardBenefit= document.getElementById("CardBenefit").value;
     if(Program=="")
     {
     swal("Please select Program ");
     return false;
     }  
     else if(Level=="")
     {
     swal("Please select Level");
     return false;
     } 
     else if(CardBenefit=="")
     {
     swal("Please enter Card Benefit ");
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
 <?php include('navbar.php');?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> Card Benefits  Creation
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
                                Card Benefits  Entry
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <form method="post" action="Card_Benefits_process.php"  onsubmit="return validation()" >
                       
                        <?php 
                             if($_GET['id']!=""){
                                  $View="select * from CardBenefit where CardBenefit_id='".$_GET['id']."' ";
                                  $qrys=mysqli_query($conn,$View);
                                  $_row=mysqli_fetch_array($qrys);
                                  
                                  
                                  $prog="select Progam_name,Program_ID from Program where Program_ID='".$_row['Program_ID']."' ";
                                  $qry_prog=mysqli_query($conn,$prog);
                                  $fetch_prog=mysqli_fetch_array($qry_prog);
                                  
                                  $levl="select level_name,Leval_id from Level where Leval_id='".$_row['level_id']."' ";
                                  $Querylevl=mysqli_query($conn,$levl);
                                  $fetchLeval=mysqli_fetch_array($Querylevl);
                                  
                                  
                            
                            ?>
                            
                            <input type="hidden" class="form-control" id="MainID" name="MainID"  value="<?php if($_GET['id']!=""){echo $_row['CardBenefit_id']; }?>"  required>
                            <?php  } ?> 
                       
                        <div class="card-body ">
                            <div class="form-group">
                                <label for="inputAddress">Program Name</label>&nbsp;
                                        <select class="form-control"  name="Program" id="Program"  onfocus="setProgram();" onchange="levelSet()"  <?php if($_GET['id']!=""){?>disabled <?php }?> required>
                                        
                                        <?php if($_GET['id']!=""){ ?>
                                        <option value="<?php echo $fetch_prog['Program_ID'];?>" id="<?php echo $fetch_prog['Program_ID']?>"><?php echo $fetch_prog['Progam_name'];?></option>
                                        <?php }else{ ?>
                                        <option value="">Select Program *</option>
                                        <?php } ?>
                                         </select> 
                                          
                                          </div>
                                          
                                <div class="form-group">
                                <label for="inputAddress">Program Level</label>&nbsp;
                                        <select class="form-control"  name="Level" id="Level" onfocus="levelSet();" <?php if($_GET['id']!=""){?>disabled <?php }?> required>
                                       
                                        
                                        <?php if($_GET['id']!=""){ ?>
                                        <option value="<?php echo $fetchLeval['Leval_id'];?>" id="<?php echo $fetchLeval['Leval_id']?>"><?php echo $fetchLeval['level_name'];?></option>
                                        <?php }else{ ?>
                                        <option value="">Select Level *</option>
                                        <?php } ?>
                                       
                                       
                                         <?php 
                                        /* $abc="select level_name,Leval_id from Level ";
                                          $runabc=mysqli_query($conn,$abc);
                                          while($fetch=mysqli_fetch_array($runabc)){
                                          */
                                          ?>
                                       <!--   <option value="<?php echo $fetch['Leval_id'];?>" id="<?php echo $fetch['Leval_id']?>"><?php echo $fetch['level_name'];?></option>-->
                                         <?php //} ?>
                                         </select> 
                                          
                                          </div>
                                          
                                     <div class="form-group">
                                        <label for="inputAddress">Card Benefit</label>&nbsp;<label id="label3"></label>
                                     
                                      
                                      <table class="form-table" id="customFields" width="100%">
                                    <?php 
                                    if($_GET['id']!=""){
                               
                                           $qrybenefit=mysqli_query($conn,"SELECT * FROM `CardBenefit` where CardBenefit_id='".$_GET['id']."' ");
                                           $fetchBenefit=mysqli_fetch_array($qrybenefit);
                                           
                                                                   
                                    ?>
                                    	<tr valign="top">
                                    	    <td style="display:flex;">
                                    	
                                      	<input type="text" class="code form-control" id="CardBenefit" name="CardBenefit[]" value="<?php echo $fetchBenefit['CardBenefit'];?>" placeholder="Card Benefit *" required/> &nbsp;
                       
                                    	 
                                        </td>
                                    	</tr>
                                    	<?php  }else{ ?>
                                    		<tr valign="top">
                                    	<div class="form-row">
                                        <div class="form-group col-md-10">
                                      	<input type="text" class="code form-control" id="CardBenefit" name="CardBenefit[]" value="" placeholder="Card Benefit *" required/> &nbsp;
                                        </div>
                               
                                    	<div class="form-group col-md-2">
                                    	    <button type="button" class="btn m-b-15 ml-2 mr-2  btn-rounded-circle btn-info addCF"><i class="mdi mdi-plus"></i></button>	
                                    	</div>
                                    	 
                                        </div>
                                    	</tr>
                                    	<?php } ?>
                                    	
                                    	
                                    </table>
                                      
                                      
                                      
                                  <br />    
                                      
                                    
                        <?php if($_GET['id']==""){ ?>
                            <div class="form-group">
                                <button type="submit" id="Submit" name="Submit" class="btn btn-primary" >Submit</button>
                            </div>
                            <?php }else{ ?>
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

<script>
    $(document).ready(function(){
	$(".addCF").click(function(){
		$("#customFields").append('<tr valign="top"><td style="display:flex;"><input type="text" class="code form-control" id="CardBenefit" name="CardBenefit[]" value="" placeholder="Card Benefit *" required/>  &nbsp;<button type="button" class="btn m-b-15 ml-2 mr-2  btn-rounded-circle btn-info remCF" ><i class="mdi mdi-minus"></i></button> </td></tr>');
	});
    $("#customFields").on('click','.remCF',function(){
            $(this).parent().parent().remove();
    });
});
</script>
<?php include('belowScript.php');?>
</body>
</html>