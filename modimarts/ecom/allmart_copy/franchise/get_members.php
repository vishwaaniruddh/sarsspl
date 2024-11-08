<? session_start();

include('config.php');?>

<html>

<head>
    
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>All Mart | Members</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <!--<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    
    
    
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
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
#member_pic img{
    height: 150px;
    /*width: 150px;*/
        border: 1px solid black;
}
.table tbody tr td{
    vertical-align: baseline;
    
}

@media (min-width: 991px) { 
    
.custom_row{
    display:flex;
}

}

@media (max-width: 991px) { 
    
.margin_row{
    margin: 30% auto;
}

}


    </style>
</head>

<script>
    if (!!window.performance && window.performance.navigation.type === 2) {
            // value 2 means "The page was accessed by navigating into the history"
            console.log('Reloading');
            window.location.reload(); // reload whole page

        }
</script>

<body class="theme-red">
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
                <a href="javascript:void(0);" class="bars"> </a>
                <a class="navbar-brand" href="https://allmart.world/" style="display:flex;height: 100px;margin: auto; line-height: 3; padding: 0;
    width: 100%;">
                    <img src="logo.jpg" style="width:100px;" >
                    <span style="margin: auto 5%;">AllMart</span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    
                    <?php if($_SESSION['id'] && $_SESSION['status']==1) { ?>
                        <li>
                            <a href="https://allmart.world/franchise/admin/member_edit.php?id=<? echo $_SESSION['id']; ?>" class="">Edit Profile</a>
                        </li>                        
                    <?php } ?>
                    <li>
                        <a href="http://www.allmart.world/franchise/get_members.php" class="">Member Filter</a>
                    </li>
                    
                    <li>
                        <a href="http://www.allmart.world/franchise/pay" class="">Franchise Payment</a>
                    </li>
                    
                    <? 
                    if(isset($_SESSION) && $_SESSION['rollid']==1){ ?>
                                        <li>
                        <a href="http://www.allmart.world/franchise/admin/members.php" class="">Member</a>
                    </li>
                    
                    
                    <li>
                        <a href="http://www.allmart.world/franchise/admin/pending_approve.php" class="">Pending Approve</a>
                    </li>
                        
                    <? } else{ ?>
                    <li>
                        <a href="http://www.allmart.world/franchise/admin/index.php" class="">Login</a>
                    </li>     
                    <? } ?>
                   
                   
                </ul>
            </div>
        </div>
    </nav>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Filters</h2>
            </div>

            <!-- Select -->
            <div class="row clearfix margin_row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <form id="form">
                        
                    
                    <div class="card">


                        <div class="body">
                            <div class="row clearfix custom_row" >
                                <div class="col-sm-2">
                                    <label>Country</label>
                                    <select class="form-control" id="country">
                                     
                                        <option value="1">India</option>
                                    </select>
                                </div>
                                
                                
                                
                                
                                <div class="col-sm-2">
                                    <label>Zone</label>
                                    <select class="form-control" id="zone">
                                        <option value="">  Zone </option>
                                    <?
                                    $zone_sql = mysqli_query($con,"select * from new_zone where status=1 order by zone ASC");
                                    while($zone_sql_result = mysqli_fetch_assoc($zone_sql)){ ?>
                                    
                                    <option value="<? echo $zone_sql_result['id']?>"><? echo $zone_sql_result['zone'];?></option>
                                    
                                    <? } ?>
                                    </select>
                                </div>
                                
                                
                                <div class="col-sm-2">
                                    <label>State</label>
                                    <select class="form-control" id="state">
                                    <option value="">  State </option>
                                    </select>
                                </div>
                                
                                
                                <div class="col-sm-2">
                                    <label>Division</label>
                                    <select class="form-control" id="division">
                                        <option value=""> Division 
                                    </select>
                                </div>
                                
                                
                              <div class="col-sm-2">
                                  <label>District</label>
                                    <select class="form-control" id="district">
                                        <option value="">  District </option>
                                    </select>
                                </div>
                                
                                
                                
                              <div class="col-sm-2">
                                  <label>Taluka</label>
                                    <select class="form-control" id="taluka">
                                        <option value="">  Taluka </option>
                                    </select>
                                </div>
                                
                              <div class="col-sm-2">
                                  <label>Pincode</label>
                                    <select class="form-control" id="pincode">
                                        <option value="">  Pincode </option>
                                    </select>
                                </div>
                                
                              <div class="col-sm-2">
                                  <label>Village</label>
                                    <select class="form-control" id="village">
                                        <option value="">  Village </option>
                                    </select>
                                </div>
                                
                                
                                
                                
                            </div>
                        </div>
                    </div>
                    
                    
                    </form>
                    
                </div>
            </div>
            <!-- #END# Select -->

    </section>




    <section class="content2">
        <div class="container-fluid">
            
            
<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Result
                            </h2>

                        </div>
                        

                            
                            
                        <div class="body">
                                    <div class="row clearfix js-sweetalert" style="display: flex;justify-content: flex-end; margin: auto 7%;" id="edit_member">
                                        <button class='btn btn-primary waves-effect' id="btn_edit" data-type="prompt">Edit</button>
                                    </div>
                                    
                                    
                            <table id="" class="table" style="cursor: pointer;">
                                <thead>
                                    <tr>
                                        <th>Position Name</th>
                                        <th>Profile</th>
                                        <th>Mobile</th>
                                        <th>Name</th>
                                      <!--  <th>Status</th>-->
                                        <th>Apply Franchise</th>
                                        <th>Visiting Card</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="member_position"></td>
                                        <td id="member_pic"></td>
                                        <td id="member_mobile"></td>
                                        <td id="member_name"></td>
                                        <td id="member_apply"></td>
                                        <td id="visiting_card"></td>
                                    </tr>
                                </tbody>
                                
                            </table>
                        <input style="position: absolute; top: 140px; left: 324px; padding: 10px; text-align: start; font: 400 14px / 20px Roboto, Arial, Tahoma, sans-serif; width: 220px; height: 41px; display: none; border-width: 1px 0px; border-style: solid none; border-color: rgb(238, 238, 238) rgb(85, 85, 85);"></div>
                    </div>
                </div>
            </div>
                                                    
</section>








<script>

    $("document").ready(function(){

        var country = $("#country").val();
        var zone = $("#zone").val();
        var state = $("#state").val();
        var division = $("#division").val();
        var district = $("#district").val();
        var taluka = $("#taluka").val();
        var pincode = $("#pincode").val();
        var village = $("#village").val();
        

            

        $.ajax({
        type: "POST",
        url: 'get_member_data.php',
        data: 'country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village,
        
        success:function(msg) {
        
        console.log(msg);
        
            if(msg>0 || msg > '0'){
                var obj = JSON.parse(msg);
                var status = obj['status'];
                
                if(status==1){
                    status = 'Approve';
                }
                else{
                    status = 'Not Approve';
                }
                
                $("#member_pic").html('<img src="'+obj['image']+'" alt="Not Available">');
                $("#btn_edit").attr('mobile',obj['id']);
                    
                document.getElementById("member_position").innerHTML = obj['star'];
                document.getElementById("member_mobile").innerHTML = obj['mobile'];
                document.getElementById("member_name").innerHTML = obj['name'];
               $("#visiting_card").html('<a href="new_visiting.php?id='+obj['id']+'" class="btn btn-danger">Visiting Card</a>');
                $("#member_apply").html('');
            }
            else{
                $("#member_pic").html('');
           $("#member_apply").html('<a id="apply" href="apply.php?country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village+'" class="btn btn-danger">Apply</a>');
            document.getElementById("member_position").innerHTML = '';
            document.getElementById("member_mobile").innerHTML = '';
            document.getElementById("member_name").innerHTML = '';
            //document.getElementById("member_status").innerHTML = '';
            
            }
    
            
                
            
        }
         });
         
         
         $("#form").on('change',function(){
         
         setTimeout(function(){
             
        var country = $("#country").val();
        var zone = $("#zone").val();
        var state = $("#state").val();
        var division = $("#division").val();
        var district = $("#district").val();
        var taluka = $("#taluka").val();
        var pincode = $("#pincode").val();
        var village = $("#village").val();
        
        $.ajax({
            
            type: "POST",
            url: 'get_member_data.php',
            data: 'country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village,
            success:function(msg) {
            
            console.log(msg);
            
            if(msg>0 || msg > '0'){
                var obj = JSON.parse(msg);
                var status = obj['status'];
                
                if(status==1){
                    status = 'Approve';
                }
                else{
                    status = 'Not Approve';
                }

                $("#member_pic").html('<img src="'+obj['image']+'" alt="Not Available">');
                $("#btn_edit").attr('mobile',obj['id']);
                $("#visiting_card").html('<a href="new_visiting.php?id='+obj['id']+'" class="btn btn-danger">Visiting Card</a>');
                document.getElementById("member_position").innerHTML = obj['star'];
                document.getElementById("member_mobile").innerHTML = obj['mobile'];
                document.getElementById("member_name").innerHTML = obj['name'];   
                $("#member_apply").html('');
            }
            else{
            $("#member_pic").html('');
           $("#member_apply").html('<a id="apply" href="apply.php?country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village+'" class="btn btn-danger">Apply</a>');
            document.getElementById("member_position").innerHTML = '';
            document.getElementById("member_mobile").innerHTML = '';
            document.getElementById("member_name").innerHTML = '';
            document.getElementById("visiting_card").innerHTML = '';
            }
    
            
                
            }
            });
         
            
         }, 1500);
         });
         
         
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
    
    </script>




 
    <script src="plugins/jquery/jquery.min.js"></script>
 
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

 
    <!--<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

 
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

 
    <script src="plugins/node-waves/waves.js"></script>

 
    <script src="plugins/autosize/autosize.js"></script>

 
    <script src="plugins/momentjs/moment.js"></script>

 
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

 
    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


    <script src="js/admin.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>



    <script src="js/admin.js"></script>
    <script src="js/demo.js"></script>
    
        <!-- SweetAlert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="js/pages/ui/dialog2.js"></script>
    
</body>
</html>
