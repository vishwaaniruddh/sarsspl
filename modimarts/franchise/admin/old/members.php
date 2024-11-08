<? session_start();
include('../config.php');



if(!isset($_SESSION["username"])) {
	header("Location:login_form.php");
}


function get_country($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_country where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['country'];
}


function get_state($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_state where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['state'];
}


function get_zone($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_zone where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['zone'];
}

function get_division($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_city where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['city'];
}


function get_district($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_district where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['district'];
}


function get_taluka($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_taluka where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['taluka'];
}


function get_pincode($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_pincode where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['pincode'];
}




?>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>All Mart | Members </title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="../https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="../https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
    
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  
  
    <style>
        section.content{
        margin: 13% 15px 0 15px;
        }
               .navbar-nav {
     margin: 2% auto !important;
}

        td{
                white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
        }
    </style>
    
        <style>
               section.content{
    margin: 13% 15px 0 15px;
        }
        
        td{
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
#modal_body table{
    font-size:13px;
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
    <!--<div class="page-loader-wrapper">-->
    <!--    <div class="loader">-->
    <!--        <div class="preloader">-->
    <!--            <div class="spinner-layer pl-red">-->
    <!--                <div class="circle-clipper left">-->
    <!--                    <div class="circle"></div>-->
    <!--                </div>-->
    <!--                <div class="circle-clipper right">-->
    <!--                    <div class="circle"></div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <p>Please wait...</p>-->
    <!--    </div>-->
    <!--</div>-->
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
    
    
    
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header" style="min-width: 200px;">

                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                
                <a class="navbar-brand" href="http://www.allmart.world/franchise/" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                    <img src="../logo.jpg" style="width:100px;" >
                    <span style="margin: auto 5%;">AllMart</span>
                
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <? include('../menu.php');?>
                
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    
    
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
                                        <th>Wating</th>
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
                                        <td id="waiting_btn"></td>
                                        <td id="member_apply"></td>
                                        <td id="visiting_card"></td>
                                    </tr>
                                </tbody>
                                
                            </table>
                        <input style="position: absolute; top: 140px; left: 324px; padding: 10px; text-align: start; font: 400 14px / 20px Roboto, Arial, Tahoma, sans-serif; width: 220px; height: 41px; display: none; border-width: 1px 0px; border-style: solid none; border-color: rgb(238, 238, 238) rgb(85, 85, 85);"></div>
                    </div>
                    
                    
                <!-- <div class="card">-->
                <!--        <div class="header">-->
                <!--            <h2>-->
                <!--                Next Level-->
                <!--            </h2>-->

                <!--        </div>-->
                    
                <!--<div class="body">-->
                <!--    <div id="additional_member">-->
                        
                <!--        </div>-->
                <!--    </div>-->
                                        
                    
                <!--</div>-->
                
                
                 <div class="card">
                        <div class="header">
                            <h2>
                                Introduced To
                            </h2>

                        </div>
                    
                <div class="body">
                    <div id="child">
                        
                        
                    </div>
                    </div>
                                        
                    
                </div>
                
                
                
            </div>
                                                    
</section>





<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Position Detailed</h4>
      </div>
      
      
      <div class="modal-body" id="modal_body">

      </div>
      
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


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
        url: '../get_member_data.php',
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
               
                
               $("#visiting_card").html('<a href="https://allmart.world/franchise/new_visiting.php?id='+obj['id']+'" class="btn btn-danger">Visiting Card</a> | <button id="trees" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-original-title ='+obj['id']+' data-target="#myModal">View Tree</button>');           
                $("#member_apply").html('');
    
    
                var member_id = obj['id'];
                $.ajax({
                type: "POST",
                url: '../get_tree.php',
                data: 'member_id='+member_id,
                
                success:function(msg) {
                console.log(msg);
                $("#modal_body").html(msg);
                
                }
                });   
                
                
                
                  $.ajax({
                type: "POST",
                url: '../get_child.php',
                data: 'member_id='+member_id,
                
                success:function(msg) {
                // alert(msg);
                $("#child").html(msg);
                
                }
                });   
                
    


            
    
                
            }
            else{
                $("#member_pic").html('');
                $("#member_apply").html('<a id="apply" href="https://allmart.world/franchise/apply.php?country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village+'" class="btn btn-danger">Apply</a>');
            document.getElementById("member_position").innerHTML = '';
            document.getElementById("member_mobile").innerHTML = '';
            document.getElementById("member_name").innerHTML = '';
            
            }   
        }
        

          
          
         });
         
        
         
         
             
         
     
            

         
         if(!zone){
          $.ajax({
        type: "POST",
        url: '../get_additional_members.php',
        data: 'country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village,
        
        success:function(msg) {
           // alert(msg);
            $("#addtional_member").html(msg);
            
        }
          });
                      
         }

         
         
         
         
         $("#form").on('change',function(){
             
        // $("#modal_body").html('');
        
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
            url: '../get_member_data.php',
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
                
                
                // $("#visiting_card").html('<a href="new_visiting.php?id='+obj['id']+'" class="btn btn-danger">Visiting Card</a> | <a href="new_visiting.php?id='+obj['id']+'" class="btn btn-danger">View Tree</a>');
                
               $("#visiting_card").html('<a href="https://allmart.world/franchise/new_visiting.php?id='+obj['id']+'" class="btn btn-danger">Visiting Card</a> | <button id="trees" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-original-title ='+obj['id']+' data-target="#myModal">View Tree</button>');
                
                $("#waiting_btn").html('<a id="waiting" href="https://allmart.world/franchise/waiting.php?country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village+'" class="btn btn-danger">Waiting</a>');
                
                
                document.getElementById("member_position").innerHTML = obj['star'];
                document.getElementById("member_mobile").innerHTML = obj['mobile'];
                document.getElementById("member_name").innerHTML = obj['name'];   
                $("#member_apply").html('');
                
                    $.ajax({
            type: "POST",
            url: '../get_child.php',
            data: 'member_id='+obj['id'],
            
            success:function(msg) {
            console.log(msg);
            $("#child").html(msg);
            
            }
            });   
            
            
            
            }
            else{
            $("#member_pic").html('');
           
           $("#member_apply").html('<a id="apply" href="https://allmart.world/franchise/apply.php?country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village+'" class="btn btn-danger">Apply</a>');
           
           $("#waiting_btn").html('<a id="waiting" href="https://allmart.world/franchise/waiting.php?country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village+'" class="btn btn-danger">Waiting</a>');
                           
            document.getElementById("member_position").innerHTML = '';
            document.getElementById("member_mobile").innerHTML = '';
            document.getElementById("member_name").innerHTML = '';
            document.getElementById("visiting_card").innerHTML = '';
                }
            }
            });
         
         
    $.ajax({
        type: "POST",
        url: '../get_additional_members.php',
        data: 'country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village,
        
        success:function(msg) {
            //alert(msg);
            $("#addtional_member").html(msg);
            
        }
          });
          
          
          
            
            
            

    
         }, 1500);
         
           
         });
         
         
        
          $("#form").on('change',function(){
             setTimeout(function(){
   
                  var member_id = $('#trees').data('original-title');
            
                      $.ajax({
        type: "POST",
        url: '../get_tree.php',
        data: 'member_id='+member_id,
        
        success:function(msg) {
            // console.log(msg);
            $("#modal_body").html(msg);
            
        }
          });    
          
        
            
            
                  }, 2000);
         });
             
                  
                  
                  
                  
         
         $("#zone").on('change',function(){
             var zone_id = $("#zone").val(); 
             $.ajax({
                 
                type: "POST",
                url: '../get_state.php',
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
                url: '../get_division.php',
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
                url: '../get_district.php',
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
                url: '../get_taluka.php',
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
                url: '../get_pincode.php',
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
                url: '../get_village.php',
                data: 'pincode_id='+pincode_id,
                success:function(msg) {

            document.getElementById("village").innerHTML = '<option value="">Village</option>';
                    
                    $("#village").html(msg);                    
                }
            });
            
         });              
        
                             
    });


// $(document).ready(function(){
//      setTimeout(function(){
   
//                 var member_id = $('#trees').data('original-title');
                
//                 $.ajax({
//                 type: "POST",
//                 url: 'get_tree.php',
//                 data: 'member_id='+member_id,
                
//                 success:function(msg) {
//                 console.log(msg);
//                 $("#modal_body").html(msg);
                
//                 }
//                 });                   
//           }, 2500);
       
// });


    </script>










    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Welcome
                </h2>

            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All Members
                            </h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <td>Name</td>
                                            <td>Mobile</td>
                                            <th>Level</th>
                                            <th>Star</th>
                                            <th>Position</th>
                                            <th>Country</th>
                                            <th>Zone</th>
                                            <th>State</th>
                                            <th>Division</th>
                                            <th>Districts</th>
                                            <th>Taluka</th>
                                            <th>Pincode</th>
                                            <th>Village</th>
                                            <th>View</th>
                                            <th>Edit</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <? $sql = mysqli_query($con,"select * from new_member where status=1 order by id ASC");

$i=1;
while($sql_result = mysqli_fetch_assoc($sql)){ ?>
                                        
                    <tr>
                        <td><? echo $i;?></td>
                        <td><? echo $sql_result['name'];?></td>
                        <td><? echo $sql_result['mobile'];?></td>
                        <td><? echo $sql_result['level_id'];?></td>
                        <td><? echo $sql_result['star'];?></td>
                        <td><? echo $sql_result['position_name'];?></td>
                        <td><? echo get_country($sql_result['country']);?></td>
                        <td><? echo get_zone($sql_result['zone']);?></td>
                        <td><? echo get_state($sql_result['state']);?></td>
                        <td><? echo get_division($sql_result['division']);?></td>
                        <td><? echo get_district($sql_result['district']);?></td>
                        <td><? echo get_taluka($sql_result['taluka']);?></td>
                        <td><? echo get_pincode($sql_result['pincode']);?></td>
                        <td><? if($sql_result['village'] != 0){ echo $sql_result['village']; }?></td>
                        <td>
                            <a class="btn btn-danger" href="member_view.php?id=<? echo $sql_result['id'];?>">View</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="member_edit.php?id=<? echo $sql_result['id'];?>">Edit</a>
                        </td>
                    </tr>
                                        
                                        <? $i++; } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!--<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html>
