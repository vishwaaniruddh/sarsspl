<?php session_start();
    include('../config.php');

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title> offline orders | All Mart </title>
        <!-- Favicon-->
        <link rel="icon" href="../favicon.ico" type="image/x-icon">
    
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    
        <!-- Bootstrap Core Css -->
        <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    
        <link href="../plugins/node-waves/waves.css" rel="stylesheet" />
    
        <link href="../plugins/animate-css/animate.css" rel="stylesheet" />
    
        <link href="../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    
        <link href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    
        <link href="../plugins/waitme/waitMe.css" rel="stylesheet" />
    
        <link href="../css/style.css" rel="stylesheet">
    
        <link href="../css/themes/all-themes.css" rel="stylesheet" />
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
      
      
        <link href="../plugins/dropzone/dropzone.css" rel="stylesheet">
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
    
        <script>
            $(document).ready(function () {
                $("#mem_id").on('change',function(){
                    var mem_id = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: 'get_member_data.php',
                        data: 'mem_id='+mem_id,
                        success:function(msg) {
                            if(msg>0 || msg > '0') {
                                var obj = JSON.parse(msg);
                                // var status = obj['status'];
                                document.getElementById("franchise_name").value = obj['name'];
                                document.getElementById("franchise_mobile").value = obj['mobile'];
                                $("#franchise_name").attr('disabled','disabled');
                                $("#franchise_mobile").attr('disabled','disabled');

                            }
                        }
                    });
                });
                
                $('#is_address_same').click(function(){
                    $("#address").toggle();
                });
                
                $("#category").on('change',function(){
                    var category_id = $("#category").val(); 
                    $.ajax({
                        type: "POST",
                        url: 'get_data.php',
                        data: 'category_id='+category_id,
                        success:function(msg) {
                            var json = JSON.parse(msg);
                            if(json.data == 'product'){
                                $("#product_name").html(json.option);
                            }else if(json.data == 'subcategory') {
                                $(".sub_category").show();
                                $("#sub_category").html(json.option);
                            }
                        }
                    });
                });
                
                $("#sub_category").on('change',function(){
                    var category_id = $("#sub_category").val(); 
                    $.ajax({
                        type: "POST",
                        url: 'get_data.php',
                        data: 'category_id='+category_id,
                        success:function(msg) {
                            var json = JSON.parse(msg);
                            if(json.data == 'product'){
                                $("#product_name").html(json.option);
                            }else if(json.data == 'subcategory') {
                                $("#sub_category").html(json.option);
                            }
                        }
                    });
                });
                
                $("#product_name").on('change',function(){
                    var product_id = $("#product_name").val(); 
                    $.ajax({
                        type: "POST",
                        url: 'get_data.php',
                        data: 'product_id='+product_id,
                        success:function(msg) {
                            // alert(msg)
                            var obj = JSON.parse(msg);
                            // alert(obj);
                            document.getElementById("qty").value = obj['qty'];
                            document.getElementById("rate").value = obj['rate'];
                            document.getElementById("courier_charge").value = obj['courier_charge'];
                            document.getElementById("pid").value = obj['id'];
                            document.getElementById("total").innerHTML = obj['total_price'];
                            $("#qty").attr('disabled','disabled');
                            $("#rate").attr('disabled','disabled');
                            $("#courier_charge").attr('disabled','disabled');
                            $("#total").attr('disabled','disabled');
                            
                        }
                    });
                });
                
            });
        </script>
        <!-- Jquery Core Js -->
        <script src="../plugins/jquery/jquery.min.js"></script>
    
    </head>
    <body class="theme-red">
        <div class="search-bar">
            <div class="search-icon">
                <i class="material-icons">search</i>
            </div>
            <input type="text" placeholder="START TYPING...">
            <div class="close-search"> 
                <i class="material-icons">close</i>
            </div>
        </div>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header" style="min-width: 200px;">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="../index.php" style="display:flex;height: 100px;margin: auto; line-height: 3; padding: 0; width: 100%;">
                        <img src="https://allmart.world/assets/allmart.2png" style="width:100px;height:100px;" >
                        <span style="margin: auto 5%;">AllMart</span>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                  <?php include('../menu.php');?>
                </div>
            </div>
        </nav>
        
        <section class="content">
            <form id="form" action="offline_order_process.php" method="post" enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="block-header">
                        <h2> Franchisee Offline Order Entry  </h2>
                    </div>
                    
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Franchise Details</h2>
                                </div>
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="input" name="mem_id" id="mem_id" value="" class="form-control" />
                                                    <label class="form-label">Franchise Id</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <input type="input" name="franchise_name" value="" id="franchise_name" class="form-control"  />
                                            <label class="form-label">Name</label>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <input type="input" name="franchise_mobile" id="franchise_mobile" value="" class="form-control" />
                                            <label class="form-label">Mobile</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2> Delivery Details </h2>
                                </div>
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-sm-8">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="name" value="" class="form-control" />
                                                    <label class="form-label"> Name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="mobile" value="" class="form-control" />
                                                    <label class="form-label">Mobile</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row clearfix">
                                        <div class="col-sm-8">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="courier_company" value=" " class="form-control" />
                                                    <label class="form-label">Preferred Courier Company</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="checkbox" id="is_address_same" name="is_address_same" value="">
                                                    <label for="is_address_same"> Address same as franchise address</label><br>
        
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!--<div class="col-sm-4" id="address">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea id="delivery_address" name="delivery_address" rows="4" cols="50"> Address here</textarea>
                                                    <label class="form-label">Postal Delivery Address</label>
                                                </div>
                                            </div>
                                        </div>-->
                                        <!--<div class="col-sm-4">
                                            <div class="form-group form-float">
                                                    <div class="form-line" value="" id="bs_datepicker_container">
                                                        <input type="text" name="dob" class="form-control" value=" " placeholder="Please choose Date Of Birth...">
                                                        <label class="form-label"></label>
                                                    </div>
                                                </div>
                                        </div>-->
                                    </div>
                                
                                    <div class="row clearfix" id="address">
                                        <div class="col-sm-12 col-md-12 ">
                                            <label>Postal Delivery Address</label>
                                            <div class="form-line">
                                                <textarea id="delivery_address" name="delivery_address" rows="4" cols="50"> Address here</textarea>
                                                <!--<label class="form-label">Postal Delivery Address</label>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2> Product Details </h2>
                                </div>
                                <div class="body">
                                    <div class="row clearfix" id="productDiv">
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="hidden" name="pid" id="pid">
                                                    <select name="category" id="category">
                                                        <option>select category</option>
                                                        <?php $sql = mysqli_query($con,"select * from offline_category where status=1 and parent_id=0");
                                                            while($row = mysqli_fetch_assoc($sql)) {
                                                        ?>
                                                            <option id="<?php echo $row['id'];?>" value="<?php echo $row['id'];?>"> <?php echo $row['name'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6 sub_category" style="display:none;" >
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select name="sub_category" id="sub_category" >
                                                        <option>select sub category</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label class="form-label">Product Name</label>
                                                    <select name="product_name" id="product_name">
                                                        <option>select product</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="qty" id="qty" value=" " class="form-control" />
                                                    <label class="form-label">Qty</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <!--<input list="items" id="item" class="form-control" value="">-->
                                                    <input type="text" name="rate" id="rate" value=" " class="form-control" />
                                                    <label class="form-label">Product Rate</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="courier_charge" id="courier_charge" value=" " class="form-control" />
                                                    <label class="form-label">Courier Charge</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label class="form-label">Product Total Price(courier charge Incl.) : <span id="total"></span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2> Paymet Details </h2>
                                </div>
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <!--<input type="text" name="date" value="" class="form-control" />
                                                    <label class="form-label">Payment Date</label>
                                                    -->
                                                    <div class="form-line" value="" id="bs_datepicker_container">
                                                        <input type="text" name="date" class="form-control" value=" " placeholder="Please choose Date Of payment...">
                                                        <label class="form-label">Payment Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    
                                                    <label for="appt">Select a time:</label>
                                                    <input type="time" id="time" name="time">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="bank" value="" class="form-control" />
                                                    <label class="form-label">Bank Name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="upi" value="" class="form-control" />
                                                    <label class="form-label">UPI Id / Reference No.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="gst" value="" class="form-control" />
                                                    <label class="form-label">GST</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="submit">
                </div>
            </div>
        </div>
    </form>
</section>
<br> <br> <br>

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

<!-- Bootstrap Core Js -->
<script src="../plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<!--<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

<!-- Slimscroll Plugin Js -->
<script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../plugins/node-waves/waves.js"></script>

<!-- Autosize Plugin Js -->
<script src="../plugins/autosize/autosize.js"></script>

<!-- Moment Plugin Js -->
<script src="../plugins/momentjs/moment.js"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- Bootstrap Datepicker Plugin Js -->
<script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- Custom Js -->
<script src="../js/admin.js"></script>
<script src="../js/pages/forms/basic-form-elements.js"></script>
<script src="../plugins/dropzone/dropzone.js"></script>

<script src="../js/demo.js"></script>

</body>
</html>
