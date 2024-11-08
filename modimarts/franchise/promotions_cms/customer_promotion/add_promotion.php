<?php
session_start();
if (!isset($_SESSION['mem_id']) && !isset($_SESSION['username'])) {
    ?>

    <script>
        window.location.href='https://allmart.world/franchise/get_members.php';
    </script>

<?
}
include 'https://www.allmart.world/franchise/config.php';




$userid     = $_GET['id'];
$sql        = mysqli_query($con, "select * from customer_promotion where id='" . $id . "'");
$sql_result = mysqli_fetch_assoc($sql);

$customer_id         = $sql_result['customer_id'];
$customer_address    = $sql_result['customer_address'];
$customer_name       = $sql_result['customer_name'];
$logo                = $sql_result['logo'];
$image               = $sql_result['image'];
$status              = $sql_result['status'];

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Add Customers | All Mart</title>
    <!-- Favicon-->
    <link rel="icon" href="https://www.allmart.world/franchise/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="https://www.allmart.world/franchise/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="https://www.allmart.world/franchise/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="https://www.allmart.world/franchise/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="https://www.allmart.world/franchise/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="https://www.allmart.world/franchise/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="https://www.allmart.world/franchise/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <!--<link href="https://www.allmart.world/franchise/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->

    <!-- Custom Css -->
    <link href="https://www.allmart.world/franchise/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="https://www.allmart.world/franchise/css/themes/all-themes.css" rel="stylesheet" />

    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>


    <link href="https://www.allmart.world/franchise/plugins/dropzone/dropzone.css" rel="stylesheet">
    <style>
                section.content{
    margin: 13% 15px 0 15px;
        }

        td{
                white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
        }
        .navbar-nav {
     margin: 2% auto !important;
}
img{
    width: 100%;
    object-fit: cover;
    height: 350px;
}

@media (min-width: 768px){
.modal-dialog {
    width: 900px;
    margin: 30px auto;
}
}


    </style>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
        <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header" style="min-width: 200px;">

                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>

                <a class="navbar-brand" href="https://www.allmart.world/franchise/index.php" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                      <img src="https://allmart.world/assets/logo.png" alt="" style="width: 100px;background:white;border-radius: 50%;height: auto;">
                    <span style="margin: auto 5%;">AllMart</span>

                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
              <?include 'https://www.allmart.world/franchise/menu.php';?>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->


    <section class="content">
        <form id="form" action="addcustomerpromo.php" method="post" enctype="multipart/form-data">
        <div class="container-fluid">
            
<!--Changed-->
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               INSERT DETAILS
                            </h2>
                        </div>
                        <div class="body">


                            <div class="row clearfix">

                               
                                <div class="col-sm-6">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="name"  class="form-control" required/>
                                            <label class="form-label">Full Name</label>
                                        </div>
                                    </div>

                                </div>
                                 
                                 <div class="col-sm-6">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" name="mobile"  class="form-control" required/>
                                            <label class="form-label">Mobile Number</label>
                                        </div>
                                    </div>

                                </div>

                                 <div class="col-sm-6">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="password"  class="form-control" required/>
                                            <label class="form-label">Password</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-6">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" name="email" value="" maxlength="25"  class="form-control" />
                                            <label class="form-label">email Id</label>
                                        </div>
                                    </div>

                                </div>
                                 <div class="col-sm-6">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="website" value="" maxlength="25"  class="form-control" />
                                            <label class="form-label">Website</label>
                                        </div>
                                    </div>

                                </div>
                                 <div class="col-sm-6">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="designation" value="" maxlength="25"  class="form-control" />
                                            <label class="form-label">Designation</label>
                                        </div>
                                    </div>

                                </div>

                                 
                                 <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            
                                           <textarea maxlength="58" name="content"  class="form-control" id="text"></textarea>
                                            <label class="form-label">Content (1st Line)</label>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            
                                           <textarea maxlength="58" name="content1"  class="form-control" id="text"></textarea>
                                            <label class="form-label">Content (2nd Line)</label>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            
                                           <textarea maxlength="58" name="content2"  class="form-control" id="text"></textarea>
                                            <label class="form-label">Content (3rd Line)</label>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            
                                           <textarea maxlength="58" name="content3"  class="form-control" id="text"></textarea>
                                            <label class="form-label">Content (4th Line)</label>
                                        </div>
                                    </div>
                                </div>

                               


                            </div>



                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                          <select class="form-control" name="is_franchisee">
                                              <option value="0">Not Franchise</option>
                                              <option value="1">Franchise</option>
                                              <option value="2">Paid Customer</option>
                                              <option value="4">Staff</option>
                                              <option  value="3">Advertiser</option>
                                          </select>
                                            <label class="form-label">Is Franchise</label>
                                        </div>
                                    </div>
                                </div>
                                

                                
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                            <input type="file" name="logo" class="form-control" >
                                            <label class="form-label">Logo</label>
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        
                                            <input type="file" name="image"  class="form-control" onchange="preview_images();" />
                                            <label class="form-label">Images</label>
                                       
                                    </div>

                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                            <input type="file" name="footer_image"  class="form-control" onchange="preview_images();" />
                                            <label class="form-label">footer image</label>
                                       
                                    </div>

                                </div>
                                
                        </div>

                        </div>
                    </div>
                </div>




<style>

.agree_heading, .main_ol>li    {
background: #cccccc;
    padding: 5px;
    color: black;
    padding-left: 1%;
    font-size: 16px;
    font-weight: 700;
    margin: 1% auto;
    }
    .main_ol li p{
        margin:2% ;
    }
</style>


          </div>
          </div>
          </div>
          </div>


            </div>
            </div>
        </div>
        <div style="display:flex;justify-content:center;">
            <input type="submit" name="submit" value="Insert" class="btn btn-danger" id="button">
        </div>


        </form>
    </section>
    <br>
    <br>
    <br>





    <style>
        .btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 100%;
}
    </style>
    <script>
    
    
    $(document).ready( function() {
        function maxLength(el) {    
    if (!('maxLength' in el)) {
        var max = el.attributes.maxLength.value;
        el.onkeypress = function () {
            if (this.value.length >= max) return false;
        };
    }
}

maxLength(document.getElementById("text"));
    }


    function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("myCheck");
  // Get the output text
  var text = document.getElementById("text");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
    $("#pay_bank").prop('required',true);
    $("#paid_amount").prop('required',true);
    $("#paid_date").prop('required',true);
    $("#paid_id").prop('required',true);


  } else {
    text.style.display = "none";
        $("#pay_bank").prop('required',false);
    $("#paid_amount").prop('required',false);
    $("#paid_date").prop('required',false);
    $("#paid_id").prop('required',false);
  }
}

    $(document).ready( function() {


       $(function() {

        $("#item").on('change',function() {
            var val = $('#item').val()
            var xyz = $('#items option').filter(function() {
                return this.value == val;
            }).data('xyz');
            // alert(xyz);



            $.ajax({
            type: "POST",
            url: 'https://www.allmart.world/franchise/get_mobile.php',
            data: 'id='+xyz,

            success:function(msg) {
            // alert(msg);
            $("#intro_mobile").val(msg);
            $("#intro_id").val(xyz);

            }
            });

        })
    })




           var member_id = '<?echo $id; ?>';
                $.ajax({
                type: "POST",
                url: 'https://www.allmart.world/franchise/get_tree.php',
                data: 'member_id='+member_id,

                success:function(msg) {
                // console.log(msg);
                $("#tree").html(msg);

                }
                });


                  $.ajax({
                type: "POST",
                url: 'https://www.allmart.world/franchise/get_child.php',
                data: 'member_id='+member_id,

                success:function(msg) {
                // alert(msg);
                $("#modal_body").html(msg);

                }
                });



    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }

		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#aadharfront').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#aadhar_front").change(function(){
		    readURL(this);
		});
	});



    $(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }

		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#aadharback').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#aadhar_back").change(function(){
		    readURL(this);
		});
	});



    $(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }

		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#pass').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#passport").change(function(){
		    readURL(this);
		});
	});



    $(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }

		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#pancard').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#pan_card").change(function(){
		    readURL(this);
		});
	});

    $("document").ready(function(){

var get_zone = "<?echo $_GET['zone']; ?>";
var get_state = "<?echo $_GET['state']; ?>";
var get_division = "<?echo $_GET['division']; ?>";
var get_district = "<?echo $_GET['district']; ?>";

    //   var get_taluka = <?echo $_GET['taluka']; ?>;
    //   var get_pincode = <?echo $_GET['pincode']; ?>;

       if(get_zone){
           window.onload = function(){

            $("#zone").val(get_zone);

            var state_id = get_state;
                 $.ajax({
                    type: "POST",
                    url: 'get_state.php',
                    data: 'zone_id='+get_zone,
                    success:function(msg) {
                // document.getElementById("division").innerHTML = '<option value="">Disivion</option>';
                // document.getElementById("district").innerHTML = '<option value="">District</option>';
                // document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                // document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
                // document.getElementById("village").innerHTML = '<option value="">Village</option>';

                        $("#state").html(msg);
                        $("#state").val(get_state);
                    }
                });
            }
       }

            setTimeout(function(){



                if(get_state){



                $.ajax({
                    type: "POST",
                    url: 'get_division.php',
                    data: 'state_id='+get_state,
                    success:function(msg) {

                    $("#division").html(msg);
                    $("#division").val(get_division);

                    }
                });

      }


    }, 1500);


                    setTimeout(function(){



                if(get_division){



                $.ajax({
                    type: "POST",
                    url: 'get_district.php',
                    data: 'division_id='+get_division,
                    success:function(msg) {


                        // alert(msg);
                    // document.getElementById("district").innerHTML = '<option value="">District</option>';
                    // document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                    // document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
                    // document.getElementById("village").innerHTML = '<option value="">Village</option>';


                    $("#district").html(msg);
                    $("#district").val(get_district);
                    }
                });

      }


    }, 2500);



       setTimeout(function(){
            if(get_district){



                $.ajax({
                    type: "POST",
                    url: 'get_taluka.php',
                    data: 'district_id='+get_district,
                    success:function(msg) {
                    $("#taluka").html(msg);
                    $("#taluka").val(get_taluka);
                    }
                });

      }


    }, 3500);

       $("#zone").on('change',function(){
             var zone_id = $("#zone").val();
             $.ajax({

                type: "POST",
                url: 'get_state.php',
                data: 'zone_id='+zone_id,
                success:function(msg) {

                document.getElementById("state").innerHTML = '<option value="">State</option>';
                document.getElementById("division").innerHTML = '<option value="">Disivion</option>';
                document.getElementById("district").innerHTML = '<option value="">District</option>';
                document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
                document.getElementById("village").innerHTML = '<option value="">Village</option>';

                    $("#state").html(msg);

                     $("#state").val('1').attr('selected','selected');

                }
            });

         });


         $("#state").on('change',function(){
             var state_id = $("#state").val();
             $.ajax({
                type: "POST",
                url: 'get_division.php',
                data: 'state_id='+state_id,
                success:function(msg) {

            document.getElementById("division").innerHTML = '<option value="">Disivion</option>';
            document.getElementById("district").innerHTML = '<option value="">District</option>';
            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
            document.getElementById("village").innerHTML = '<option value="">Village</option>';


                    $("#division").html(msg);
                }
            });
         });


         $("#division").on('change',function(){
             var division_id = $("#division").val();
             $.ajax({

                type: "POST",
                url: 'get_district.php',
                data: 'division_id='+division_id,
                success:function(msg) {


            document.getElementById("district").innerHTML = '<option value="">District</option>';
            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
            document.getElementById("village").innerHTML = '<option value="">Village</option>';



                    $("#district").html(msg);
                }
            });
         });


          $("#district").on('change',function(){
             var district_id = $("#district").val();
             $.ajax({

                type: "POST",
                url: 'get_taluka.php',
                data: 'district_id='+district_id,
                success:function(msg) {


            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
            document.getElementById("village").innerHTML = '<option value="">Village</option>';



                    $("#taluka").html(msg);
                }
            });
         });

      $("#taluka").on('change',function(){
             var taluka_id = $("#taluka").val();
             $.ajax({

                type: "POST",
                url: 'get_pincode.php',
                data: 'taluka_id='+taluka_id,
                success:function(msg) {



            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
            document.getElementById("village").innerHTML = '<option value="">Village</option>';


                    $("#pincode").html(msg);
                }
            });
         });



      $("#pincode").on('change',function(){
             var pincode_id = $("#pincode").val();
             $.ajax({

                type: "POST",
                url: 'get_village.php',
                data: 'pincode_id='+pincode_id,
                success:function(msg) {

            document.getElementById("village").innerHTML = '<option value="">Village</option>';

                    $("#village").html(msg);
                }
            });
         });


    });




        $("#basic_checkbox_1").on('click',function(){
              $("#basic_checkbox_2").removeAttr('checked');

        });
         $("#basic_checkbox_2").on('click',function(){
              $("#basic_checkbox_1").removeAttr('checked');
        });



//         $("#form").submit(function(e) {


//             if($("#basic_checkbox_2").is(':checked') || $("#basic_checkbox_1").is(':checked')){
//                 return true;

//               }
//     alert("Please select at least one to upgrade.");
//     return false;
// });


</script>

<script>
    function createRef(id)
    {
         if(id!=''){
            $(".page-loader-wrapper").show();
         $.ajax({
                url: "https://www.allmart.world/franchise/admin/creatMemref.php",
                data: 'memcode=' + id,
                type: "POST",
                success: function (data) {
                   // alert(data);
                    $(".page-loader-wrapper").show();
                   location.reload();
                }
            });
    }
}
</script>
<script>
function CopyFun() {
  var copyText = document.getElementById("refcode");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  // alert("Copied the text: " + copyText.value);
}
</script>

    <!-- Jquery Core Js -->
    <script src="https://www.allmart.world/franchise/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="https://www.allmart.world/franchise/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!--<script src="https://www.allmart.world/franchise/plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

    <!-- Slimscroll Plugin Js -->
    <script src="https://www.allmart.world/franchise/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="https://www.allmart.world/franchise/plugins/node-waves/waves.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="https://www.allmart.world/franchise/plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="https://www.allmart.world/franchise/plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="https://www.allmart.world/franchise/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="https://www.allmart.world/franchise/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Custom Js -->
    <script src="https://www.allmart.world/franchise/js/admin.js"></script>
    <script src="https://www.allmart.world/franchise/js/pages/forms/basic-form-elements.js"></script>
<script src="https://www.allmart.world/franchise/plugins/dropzone/dropzone.js"></script>
    <!-- Demo Js -->
    <script src="https://www.allmart.world/franchise/js/demo.js"></script>
    
    <script type="text/javascript">
    document.getElementById("button").onclick = function () {
        location.href = "https://allmart.world/franchise/promotions_cms/customer_promotion/view_promotion.php";
    };
</script>

</body>
</html>
