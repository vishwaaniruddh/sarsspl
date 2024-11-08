<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
    <!--<link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">-->
    <!--<link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">-->

<!--=====================multiselect=============-->
 <link rel="stylesheet" href="multipledropdown.css">

<style>


.multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}

.multiselect label {
    display:block;
}

.multiselect-on {


}
.ms-options-wrap > button > span {
    display: inline-block;
}

</style>

<!--==================================-->

<script>

function searchfiltter(){
    var FromDt=document.getElementById('FromDt').value;
    var Todt=document.getElementById('Todt').value;

       if(FromDt==""){
          swal("Please Select From Date");
      }else if(Todt==""){
          swal("Please Select To Date");
      }else{

             $.ajax({

                    type:'POST',
                    url:'Leadpdf/Sheet.php',
                    data:'FromDt='+FromDt+'&Todt='+Todt,
                     success:function(msg){
                     // alert(msg);
                     swal(msg);
                     if(msg==1){
                      swal({
                      title: "Mail Send To Keval!",
                      text: "",
                      icon: "success",
                     // buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {

                       window.open("Lable_Address.php","_self");

                      }
                    });

                     }
                     else{
                         swal("error");
                     }
                    }
                })
      }
}

</script>

</head>
<body class="sidebar-pinned" >


<?php include("vertical_menu.php")?>
<main class="admin-main">
  <?php include('navbar.php');?>

    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> QR Code Labels
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">
<?php include("config.php");
  //  $View="select * from Leads_table where leadEntryef='".$_SESSION['id']."'";
 	  $View="select * from Members where DATE(entryDate)='".date("Y-m-d")."'";

      $qrys=mysqli_query($conn,$View);

?>
<form id="myForm" method="post" action="Leadpdf/vc_qr.php">
                        <div class="card-body">

                                <div class="form-row">
                             <!--<div class="form-group col-md-3">

                                  <select class="form-control" name="Ab_Filtter" id="Ab_Filtter" >
                                  <option value="">Select</option>
                                  <option value="DSR">DSR</option>
                                  <option value="Anniversary">Anniversary</option>
                                  <option value="Birthday">Birthday</option>
                                  </select>
                                </div>-->

                                   <div class="form-group col-md-4">
                                <!--  <input type="text" class="form-control" id="Voucher" name="Voucher" placeholder="Voucher booklet">-->
                                  </div><div class="form-group col-md-4"> <input type="hidden" name="drop" id="drop"/>
                                  <select name="lstStates" multiple="multiple" id="lstStates" class="form-control" onchange="per()" required>

                                  <optgroup label="VoucherBookletNumber">
                                  <optgroup label=" ">
                                     <?php

                                      $abc="select VoucherBookletNumber,MembershipNumber from voucher_Details";
                                      $runabc=mysqli_query($conn,$abc);
                                      while($fetch=mysqli_fetch_array($runabc)){

                                       $View1="select Primary_nameOnTheCard from Members where GenerateMember_Id='".$fetch['MembershipNumber']."'";
 	                                   $qrys1=mysqli_query($conn,$View1);
                                        $fetchMem=mysqli_fetch_array($qrys1);

                                      ?>
                                      <option value="<?php echo $fetch['VoucherBookletNumber'];?>"><?php echo $fetch['VoucherBookletNumber']."          ".$fetchMem['Primary_nameOnTheCard'];?></option>
                                       <

                                     <?php } ?>
                                     </optgroup>
               </optgroup>
                                      </select>

                                  </div><div class="form-group col-md-4">
                                   <input type="submit" class="btn btn-primary" value="Search">
                               </div>

                              </div>

                        </div></form>
                    </div>
                </div>
            </div>
        </div>




    </section>

</main>
<?php include('belowScript.php');?>

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>

<script src="assets/vendor/DataTables/datatables.min.js"></script>
<!--<script src="assets/js/datatable-data.js"></script>-->




 <script>


 function per(){

   var obj = myForm.lstStates,
        options = obj.options,
        selected = [], i, str;

    for (i = 0; i < options.length; i++) {
        options[i].selected && selected.push(obj[i].value);
    }

    str = selected.join();

    // what should I write here??
   // alert("Options selected are " + str);

document.getElementById("drop").value=str;
 }


    $(function () {
    $('#lstStates').multiselect({
        buttonText: function(options){
          if (options.length === 0) {
              return 'No option selected ...';
           }
           var labels = [];
           options.each(function() {
               if ($(this).attr('value') !== undefined) {
                   labels.push($(this).attr('value'));
               }
            });
            return labels.join(', ');
         }
    });
});
</script>


</body>
</html>