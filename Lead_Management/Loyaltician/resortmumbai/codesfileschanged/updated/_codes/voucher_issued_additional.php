<?php Session_Start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('header.php');
include('config.php');

$id=$_GET['id'];
$sql="select * from voucher_issued_additional where v_id='".$id."'";
$runsql=mysqli_query($conn,$sql);
$fetch1=mysqli_fetch_array($runsql);

$sql2="select * from Program where Program_ID='".$fetch1['Program_ID']."'";
$runsql2=mysqli_query($conn,$sql2);
$programname=mysqli_fetch_array($runsql2);



$sql3="select * from voucher_issued_code where v_id='".$fetch1['v_id']."'";
$runsql3=mysqli_query($conn,$sql3);
$vouchername=mysqli_fetch_array($runsql3);
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



function AdditionalIssuedVoucherSet(){

var Program=document.getElementById("Program").value;
//alert(state);
                $.ajax({
                    type:'POST',
                    url:'additionalvoucherset.php',
                     data:'Program='+Program,
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);

                        var newoption=' <option value="">Select Voucher *</option>' ;
                        $('#voucher').empty();

                        for(var i=0;i<jsr.length;i++)
                        {


                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'   >'+jsr[i]["vouchername"]+'</option> ';


                        }
                     	$('#voucher').append(newoption);

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
<?php include('navbar.php'); ?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> Additional Issued Voucher
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
                                 Voucher Entry
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <form method="post" action="voucher_issued_additional_Process.php" enctype="multipart/form-data" onsubmit="return validation()" >
                            <input type="hidden" name="mainid" id="mainid" value="<?php echo $id?>"/>



                        <div class="card-body ">


                                <div class="form-group">
                                <label for="inputAddress">Program Name</label>&nbsp;
                                        <select class="form-control"  name="Program" id="Program" onfocus="setProgram();" onchange="AdditionalIssuedVoucherSet()"   <?php if($id!=""){?>disabled<?php } ?> required>

                                         <?php if($id!=""){?>
                                           <option value="<?php echo $programname['Program_ID'];?>" ><?php echo $programname['Progam_name']?> </option>
                                           <?php }else{?>
                                           <option value="">Select Program * </option>
                                        <?php }?>
                                         </select>

                                          </div>


                                      <table class="form-table" id="customFields">
                                    	<tr valign="top">
                                    		<td>
                                    		        <div class="form-row">
                                    		             <div class="form-group col-md-3">
                                    		                      <select class="form-control"  style="padding-left: 0px;" name="voucher[]" id="voucher"  <?php if($id!=""){?>disabled<?php } ?> required>
                                                                   <?php if($id!=""){?>
                                                                   <option value="<?php echo $vouchername['v_id'];?>" ><?php echo $vouchername['voucher_name']?> </option>
                                                                   <?php }else{?>
                                                                   <option value="">Select Voucher * </option>
                                                                   <?php }?>
                                                                  </select>

                                              </div>

                                <div class="form-group col-md-4">
                              	<input type="text" class="code form-control" id="FromSerial" name="FromSerial[]" value="<?php if($id!=""){ echo $fetch1['fromSerialNo']; } ?>" placeholder="From Serial *" required/> &nbsp;
                                    		  </div>
                                         <div class="form-group col-md-4">
                                     	<input type="text" class="code form-control" id="ToSerial" name="ToSerial[]" value="<?php if($id!=""){ echo $fetch1['toSerialNo']; } ?>" placeholder="To Serial *" required/> &nbsp;
                                    	 </div>
                                    	  <div class="form-group col-md-1">	<button type="button" class="btn m-b-15 ml-2 mr-2  btn-rounded-circle
                            btn-info addCF"><i class="mdi mdi-plus"></i></button> </div>
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
        var c=0;
	$(".addCF").click(function(){ debugger;
	 //  var c= $('#customFields tr').length;
	   c++;
	$("#customFields").append('<tr valign="top"><td> <select class="code" style="width:24%" name="voucher[]" id="voucher'+c +'" onfocus="AdditionalVoucherSet1('+c+')"  required> <option value="">Select Voucher *</option>    </select> &nbsp; <input type="text" class="code" id="FromSerial" name="FromSerial[]" value="" style="width: 29%;" placeholder="From Serial *" required/> &nbsp; <input type="text" class="code" id="ToSerial" name="ToSerial[]" style="width: 29%;" value="" placeholder="To Serial *" required /> &nbsp;<button type="button" class="btn m-b-15 ml-2 mr-2  btn-rounded-circle btn-info remCF"><i class="mdi mdi-minus"></i></button></td></tr>');

	});
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
});



function AdditionalVoucherSet1(c){
  // alert(C+"ram")
var Program=document.getElementById("Program").value;
//alert(state);
                $.ajax({
                    type:'POST',
                    url:'additionalvoucherset.php',
                     data:'Program='+Program,
                     datatype:'json',
                    success:function(msg){
                       // alert(msg);
                       var jsr=JSON.parse(msg);
                       var Le='#voucher'+c;
                      // alert(Le)
                        var newoption=' <option value="">Select</option>' ;
                        $(Le).empty();

                        for(var i=0;i<jsr.length;i++)
                        {


                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'   >'+jsr[i]["vouchername"]+'</option> ';


                        }
                     	$(Le).append(newoption);

                    }
                })

            }

</script>

<?php include('belowScript.php');?>
</body>
</html>