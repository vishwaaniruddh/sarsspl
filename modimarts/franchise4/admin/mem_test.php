<?php session_start();
// var_dump($_SESSION['username']);

if (!isset($_SESSION['username'])) {?>

    <script>
        window.location.href='https://www.modimart.world/franchise4/admin';
    </script>

<?}
include 'config.php';



// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function get_state_id($name)
{
    global $con;

    $sql        = mysqli_query($con, "select * from new_state where state like '" . $name . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['id'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>AllMart | Franchise</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="https://www.modimart.world/franchise4/typeahead.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.modimart.world/franchise4/style.css">
    <!-- Sweetalert Css -->
    <link href="https://www.modimart.world/franchise4/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link rel="shortcut icon" href="https://www.modimart.world/assets/logo-original.png" type="image/png" />

</head>


<!-- <script>
    if (!!window.performance && window.performance.navigation.type === 2) {
        // value 2 means "The page was accessed by navigating into the history"
        // console.log('Reloading');
        window.location.reload(); // reload whole page

    }
</script> -->

<style>
* {
    box-sizing: border-box;
}
body{
    margin: 0;
    background-color:rgb(240,240,240);
    scroll-behavior: smooth;
}

/* Style the top navigation bar */
.heading {
    overflow: hidden;
    background-color: red;
    padding-top: 10px;
}

/* Style the topnav links */
.heading a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    text-decoration: none;
    font-size: 50px;

}

/* Change color on hover */
.heading a:hover {
    color: black;
}

.main{
    background-color: white;
    padding: 20px;
    box-shadow: 5px 10px #888888;
}


table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: center;
    padding: 8px;
    /*white-space: nowrap;*/
    border: 1px solid;
}
input{
    width: 140px;
    margin-bottom: 10px;
}


#member_pic img{
    height: 150px;
    /*width: 150px;*/
    /*border: 1px solid black;*/
}



@media only screen and (max-width: 768px) {
    .col{
        margin-top: 20px;
    }

    .row{
        display: flex;
        flex-direction:column;
    }
}




/* Style the footer */
.footer {
    background-color:red;
    padding: 10px;
    text-align: center;
    padding: 30px;
    height: 280px;
    padding-left: 20px;
    padding-right: 20px;

}

.contact_us{
    color: white;
    line-height: 30px;
    font-size: 18px;
    margin-top: 20px;

}


.social_a{
    text-decoration: none;
    color: white;
}

.social_label{
    margin-left: 10px;
    margin-right: 10px;
    padding: 20px;

}
.heading {
    display: flex;
}
.logo {
    width: 30%;
}
.menu {
    width: 70%;
}
.menu ul {
    float: right;
}

.menu_ul {
    padding: 0;
    margin: 3%;
    list-style-type: none;
}
.menu ul li a {
    font-size: 18px;
}

.menu_ul{
    width: 100%;
    display: flex;
    justify-content: flex-end;
}
.menu_ul li{
    margin: auto 2%;
}
.custom_row{
    display:flex;
}

.col input,.col select{
    width:100%;
}
.cust_col{
    padding-left:1%;
    padding-right:1%;
}

.typeahead li a{
    font-size: 14px;
}


input{
    border-left: none;
    border-top: none;
    border-right: none;
}

input:focus{
    border-left: none;
    border-top: none;
    border-right: none;
}

#myModal td{
    text-align:left;
}

.sweet-alert button{
    margin:0 !important;
    font-size: 12px !important;
}
.sweet-alert h2{
    font-size: 20px !important;
    margin: 10px 0 !important;
}

.confirm{
    font-size: 18px;
    color: red;
    font-weight: 700;
}
.heading a:hover {
    color: cyan;
}
.nav>li>a:focus, .nav>li>a:hover{
    background-color:red;
}


ul.typeahead{
    width:100%;
}

#franchise_of{
    text-align: center;
    color: red;
    text-decoration: underline;
    font-weight: 700;
}
</style>
<body>
<div class="heading" style="padding-top:0px !important;">
    <div class="logo">
        <a href="https://www.modimart.world/franchise4/get_members.php" style="padding:10px;"><img src="https://www.modimart.world/assets/logo.png" alt="" style="width: 105px;background:white;border-radius: 50%;"><span style="font-size:0.7em;padding:10px;">Modimart.world</span></a>
    </div>
    <div class="menu">
        <?php include '../menu.php';?>
    </div>
</div>

<div class=" main" style="margin: 20px; width: auto; height: auto;">
    <form id="form" action="<?$_SERVER['PHP_SELF'];?>" method="POST">
        <div class="row mem_info" id="meminfo">

            <div class="col-md-4">
                <input class="form-control" type="text" name="mem_id" id="mem_id" placeholder="search by id">
            </div>
            <div class="col-md-4">
                <input class="form-control" type="text" name="mem_name" id="mem_name" placeholder="search by Name">
            </div>
            <div class="col-md-4">
                <input class="form-control" type="text" name="mem_mobie" id="mem_mobile" placeholder="search by Mobile">
            </div>
            <!-- <div class="col-md-3">
                <input class="form-control" type="text" name="Createdate" id="Createdate" placeholder="search created Date">
            </div> -->
        </div>

        <div class="row custom_row">
            <div class="col cust_col">
                <!-- <label>Country</label> -->
                <input type="text" name="txtCountry" id="txtCountry" class="typeahead" placeholder="Search Country">
                <select class="form-control" id="country">

                    <option value="1">India</option>
                </select>
            </div>

            <div class="col cust_col">
                <!-- <label>Zone</label> -->
                <input type="text" name="txtZone" id="txtZone" class="typeahead" placeholder="Search Zone">
                <select class="form-control" id="zone">
                    <option value="">  Zone </option>
                    <option value="6">Central India</option>
                    <option value="4">East India</option>
                    <option value="3">North East</option>
                    <option value="5">North India</option>
                    <option value="2">South India</option>
                    <option value="1">Western India</option>

                </select>
            </div>

            <div class="col cust_col">
                <!-- <label>State</label> -->
                <input type="text" name="txtState" id="txtState" class="typeahead" placeholder="Search State">
                <select class="form-control" id="state">
                    <option value="">  State </option>
                </select>
            </div>


            <div class="col cust_col">
                <!-- <label>Division</label> -->
                <input type="text" name="txtDivision" id="txtDivision" class="typeahead" placeholder="Search Division">
                <select class="form-control" id="division">
                    <option value=""> Division </option>
                </select>
            </div>


            <div class="col cust_col">
                <!-- <label>District</label> -->
                <input type="text" name="txtDistrict" id="txtDistrict" class="typeahead" placeholder="Search District">
                <select class="form-control" id="district">
                    <option value="">  District </option>
                </select>
            </div>


            <div class="col cust_col">
                <!-- <label>Taluka</label> -->
                <input type="text" name="txtTaluka" id="txtTaluka" class="typeahead" placeholder="Search Taluka">
                <select class="form-control" id="taluka">
                    <option value="">  Taluka </option>
                </select>
            </div>


            <div class="col cust_col">
                <!-- <label>Pincode</label> -->
                <input type="text" name="txtPincode" id="txtPincode" class="typeahead" placeholder="Search Pincode">
                <select class="form-control" id="pincode">
                    <option value="">  Pincode </option>
                </select>
            </div>


            <div class="col cust_col" style="display:none;">
                <!-- <label>Village</label> -->
                <input type="text" name="txtVillage" id="txtVillage" class="typeahead" placeholder="Search Village">
                <select class="form-control" id="village">
                    <option value="">  Village </option>
                </select>
            </div>


        </div>
    </form>
    <br>
    <!-- <button id="get">Get</button> -->
    <hr>


    <div id="5k" style="display:none">
        <!--<h3 id="5000" style="display:flex;justify-content:center; ">Confirm Franchise Application by paying Rs. 5000</h3>-->
    </div>


    <div id="25k" style="display:none">
    <!-- <h3 id="25000" style="display:flex;justify-content:center; ">Joining by purchase of goods worth Rs. 25,000/- within 60 days from the joining date</h3>         -->
    </div>


    <h3 id="franchise_of"></h3>




    <div id="data_row" style="display:flex;justify-content:center;"></div>


    <p id="bread"></p>

    <div id="data_table"  style="overflow-x:auto;">
        <table style="cursor: pointer;">
                                        <tr>
                                            <th>Id</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Level</th>
                                            <th>Star</th>
                                            <th>Position</th>
                                           <!--  <th>Country</th>
                                            <th>Zone</th>
                                            <th>State</th>
                                            <th>Division</th>
                                            <th>Districts</th>
                                            <th>Taluka</th>
                                            <th>Pincode</th>
                                            <th>Village</th>
                                            <th>Location</th>
                                            <th>PAN Card</th>
                                            <th>Adhar Card</th>
                                            <th>GST</th> -->


                                            <th>Paid Status</th>
                                            <th>Product Given Status</th>
                                           <!--  <th>Amount</th>
                                            <th>Created at</th> -->
                                          
                                           
                                            <th>Introducer Id</th>
                                            <th>Introducer Name</th>
                                            <th>Introducer Mobile</th>
                                              <th>View</th>
                                            <th>Edit</th>
                                             <th>Product Select</th>
                                        </tr>
                                        <tbody id="member_result">
                                        <tr>
                                        <td><p id="member_id"></p></td>
                                        <td><p id="member_pic"></p></td>
                                        <td><p id="member_name"></p></td>
                                        <td id="member_mobile"></td>
                                        <td id="level"></td>
                                        <td id="star"></td>
                                        <td id="member_position"></td>
                                        <!-- <td id="getcountry"></td>
                                        <td id="getzone"></td>
                                        <td id="getstate"></td>
                                        <td id="getdivision"></td>
                                        <td id="getdistrict"></td>
                                        <td id="gettaluka"></td>
                                        <td id="getpincode"></td>
                                        <td id="getvillage"></td>
                                        <td id="getlocation"></td>
                                        <td id="pan_card"></td>
                                        <td id="aadhar_card"></td>
                                        <td id="gst"></td> -->


                                        <td id="paid_status"></td>
                                        <td id="product_given_status"></td>
                                       <!--  <td id="amount"></td>
                                        <td id="created_at"></td> -->
                                       
                                         <td id="introduced_id"></td>
                                        <td id="introduced_name"></td>
                                        <td id="introduced_mobile"></td>
                                        
                                         <td id="view"></td>
                                        <td id="edit"></td>
                                        <td id="product_select"></td>
                                    </tr>
                                    </tbody>
                                </table>

        <br>
        <br>
        <br>
        <br>

    </div>

</div>
<br>

<hr>

</div>

<br>


<style>
    .loader_img{
        height:100px;
    }
</style>




<script>


$(document).ready(function () {

    var j=0
    $("#village_level_fran").html('');


    $("#data_row").html('<img class="loader_img" src="https://www.modimart.world/franchise4/landing_assets/830.gif">');
   document.getElementById("data_table").style.display = "none";

    setTimeout(function(){

        var mem_id = $("#mem_id").val();
        var mem_name = $("#mem_name").val();
        var mem_mobile = $("#mem_mobile").val();

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
            url: 'get_data_member.php',

            data: 'country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village+'&mem_id='+mem_id+'&mem_name='+mem_name+'&mem_mobile='+mem_mobile,

            success:function(msg) {

                console.log(msg);

                if(msg>0 || msg > '0'){
                    document.getElementById("data_table").style.display = "block";
                     document.getElementById("data_row").style.display = "none";


                    var obj = JSON.parse(msg);
                    console.log(obj);

                    $("#bread").html(obj['bread']);
                    $("#member_id").html(obj['id']);
                    document.getElementById("member_mobile").innerHTML = obj['mobile'];
                    document.getElementById("member_name").innerHTML = obj['name'];
                    $("#level").html(obj['position']);
                    $("#star").html(obj['star']);
                    $("#member_position").html(obj['position_name']);
                    // $("#getcountry").html(obj['country']);
                    // $("#getzone").html(obj['zone']);
                    // $("#getstate").html(obj['state']);
                    // $("#getdivision").html(obj['division']);
                    // $("#getdistrict").html(obj['district']);
                    // $("#gettaluka").html(obj['taluka']);
                    // $("#getpincode").html(obj['pincode']);
                    // $("#getvillage").html(obj['village']);
                    // $("#getlocation").html(obj['location']);
                    // $("#pan_card").html(obj['pan_card']);
                    // $("#aadhar_card").html(obj['aadhar_card']);
                    // $("#gst").html(obj['gst']);
                    $("#introduced_id").html(obj['introduced_id']);
                    $("#introduced_name").html(obj['introduced_name']);
                    $("#introduced_mobile").html(obj['introduced_mobile']);
                    $("#paid_status").html(obj['paid_status']);
                    $("#product_given_status").html(obj['product_given_status']);
                    // $("#amount").html(obj['amount']);
                    // $("#created_at").html(obj['created_at']);
                    $("#product_select").html(obj['product_select']);
                    $("#view").html(obj['view']);
                    $("#edit").html(obj['edit']);
                    $("#product_select").html(obj['product_select']);

                     $("#member_pic").html('<img src="'+obj['image']+'" style="width:100px;height:100px;" alt="Not Available">');
                     document.getElementById("data_row").style.display = "none";

                }
                else{
                document.getElementById("data_table").style.display = "block";
                     document.getElementById("data_row").style.display = "none";
                    $("#member_pic").html('');
                    $("#bread").html('');

                    document.getElementById("member_position").innerHTML = '';
                    document.getElementById("member_mobile").innerHTML = '';
                    document.getElementById("member_name").innerHTML = '';
                    $("#level").html("");
                    $("#star").html("");
                    $("#member_id").html("");
                    $("#member_position").html("");
                    // $("#getcountry").html("");
                    // $("#getzone").html("");
                    // $("#getstate").html("");
                    // $("#getdivision").html("");
                    // $("#getdistrict").html("");
                    // $("#gettaluka").html("");
                    // $("#getpincode").html("");
                    // $("#getvillage").html("");
                    // $("#getlocation").html("");
                    // $("#pan_card").html("");
                    // $("#aadhar_card").html("");
                    // $("#gst").html("");
                    $("#introduced_id").html("");
                    $("#introduced_name").html("");
                    $("#introduced_mobile").html("");
                    $("#paid_status").html("");
                    $("#product_given_status").html("");
                    // $("#amount").html("");
                    // $("#created_at").html("");
                    $("#product_select").html("");
                    $("#view").html("");
                    $("#edit").html("");
                    $("#product_select").html("");
                    document.getElementById("data_row").style.display = "none";

                }
            }
        });












        $('#txtCountry').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://www.modimart.world/franchise4/get_country.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            }
        });
        /* ===============================================================================================================
         Function for select Zone
         =================================================================================================================*/
        function selectZone(zone){

            //      var zone = this.value;

            $("#txtState").val('');
            $("#txtDistrict").val('');
            $("#txtDivision").val('');
            $("#txtTaluka").val('');
            $("#txtPincode").val('');
            $("#txtVillage").val('');


            $("#division").val('');
            $("#district").val('');
            $("#taluka").val('');
            $("#pincode").val('');
            $("#village").val('');


            $("#mem_id").val('');
            $("#mem_name").val('');
            $("#mem_mobile").val('');

            $.ajax({
                url: "https://www.modimart.world/franchise4/fill_by_zone.php",
                data: 'zone=' + zone,
                type: "POST",
                success: function (data) {

                    var obj = JSON.parse(data);

                    var zone = obj['zone'];
                    $("#zone").val(zone);

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_zone.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });
                }
            });


        }
        $('#txtZone').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://www.modimart.world/franchise4/get_zone1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                selectZone(item);
                console.log("selectZone====="+item)
                return item;
            }
        });

        /* ===============================================================================================================
         Function for select State
         =================================================================================================================*/
        function selectState(state){

            // var state = this.value;

            $("#txtZone").val('');
            $("#txtDivision").val('');
            $("#txtDistrict").val('');
            $("#txtTaluka").val('');
            $("#txtPincode").val('');
            $("#txtVillage").val('');

            //  $("#division").val('');
            $("#district").val('');
            $("#taluka").val('');
            $("#pincode").val('');
            $("#village").val('');


            $("#mem_id").val('');
            $("#mem_name").val('');
            $("#mem_mobile").val('');

            $.ajax({
                url: "https://www.modimart.world/franchise4/fill_by_state.php",
                data: 'state=' + state,
                type: "POST",
                success: function (data) {

                    var obj = JSON.parse(data);

                    var zone = obj['zone'];
                    var state = obj['state'];
                    var division = obj['division_id'];
                    $("#zone").val(zone);

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_state.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_division.php',
                        data: 'state_id='+state,
                        success:function(msg) {
                            document.getElementById("division").innerHTML = '<option value="">Division</option>';
                            $("#division").html(msg);
                            $('#division option[value="' + division + '"]').prop('selected', true);
                        }
                    });

                }
            });


        }
        $('#txtState').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://www.modimart.world/franchise4/get_state1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {

                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },updater: function(item) {
                selectState(item.name);
                console.log("selectState====="+item.name)
                return item;
            }
        });
        /* ===============================================================================================================
         Function for select Pincode
         =================================================================================================================*/
        function selectPincode(pincode){

            //var pincode = this.value;

            $("#txtZone").val('');
            $("#txtState").val('');
            $("#txtDivision").val('');
            $("#txtDistrict").val('');
            $("#txtTaluka").val('');
            $("#txtVillage").val('');


            $("#mem_id").val('');
            $("#mem_name").val('');
            $("#mem_mobile").val('');

            $.ajax({
                url: "https://www.modimart.world/franchise4/fill_by_pin.php",
                data: 'pincode=' + pincode,
                type: "POST",
                success: function (data) {

                    console.log(data);

                    var obj = JSON.parse(data);
                    var zone = obj['zone'];
                    var state = obj['state'];
                    var division = obj['division'];
                    var district = obj['district'];
                    var taluka = obj['taluka'];
                    var pincode_id = obj['pincode_id'];
                    $("#zone").val(zone);


                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_state.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_division.php',
                        data: 'state_id='+state,
                        success:function(msg) {
                            document.getElementById("division").innerHTML = '<option value="">Division</option>';
                            $("#division").html(msg);
                            $('#division option[value="' + division + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_district.php',
                        data: 'division_id='+division,
                        success:function(msg) {
                            document.getElementById("district").innerHTML = '<option value="">District</option>';
                            $("#district").html(msg);
                            $('#district option[value="' + district + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_taluka.php',
                        data: 'district_id='+district,
                        success:function(msg) {
                            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                            $("#taluka").html(msg);
                            $('#taluka option[value="' + taluka + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_pincode.php',
                        data: 'taluka_id='+taluka,
                        success:function(msg) {
                            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
                            $("#pincode").html(msg);
                            $('#pincode option[value="' + pincode_id + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_village.php',
                        data: 'pincode_id='+pincode_id,
                        success:function(msg) {


                            document.getElementById("village").innerHTML = '<option value="">village</option>';
                            $("#village").html(msg);
                            $('#village option[value="' + village + '"]').prop('selected', true);
                        }
                    });
                }
            });


        }
        $('#txtPincode').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://www.modimart.world/franchise4/get_pincode1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                selectPincode(item.name);
                console.log("selectPincode====="+item.id)
                return item;
            }
        });

        /* ===============================================================================================================
         Function for select division
         =================================================================================================================*/
        function selectDivision(division){
            //    var division = this.value;

            $("#txtZone").val('');
            $("#txtState").val('');
            $("#txtDistrict").val('');
            $("#txtTaluka").val('');
            $("#txtPincode").val('');
            $("#txtVillage").val('');


            //  $("#division").val('');
            // $("#district").val('');
            $("#taluka").val('');
            $("#pincode").val('');
            $("#village").val('');


            $("#mem_id").val('');
            $("#mem_name").val('');
            $("#mem_mobile").val('');



            $.ajax({
                url: "https://www.modimart.world/franchise4/fill_by_division.php",
                data: 'division=' + division,
                type: "POST",
                success: function (data) {

                    var obj = JSON.parse(data);
                    var zone = obj['zone'];
                    var state = obj['state'];
                    var division = obj['division_id'];

                    $("#zone").val(zone);


                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_state.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_division.php',
                        data: 'state_id='+state,
                        success:function(msg) {
                            document.getElementById("division").innerHTML = '<option value="">Division</option>';
                            $("#division").html(msg);
                            $('#division option[value="' + division + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_district.php',
                        data: 'division_id='+division,
                        success:function(msg) {
                            document.getElementById("district").innerHTML = '<option value="">District</option>';
                            $("#district").html(msg);
                            $('#district option[value="' + district + '"]').prop('selected', true);
                        }
                    });


                }
            });


        }
        $('#txtDivision').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://www.modimart.world/franchise4/get_division1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                selectDivision(item.id);
                console.log("selectDivision====="+item)
                return item;
            }
        });

        /* ===============================================================================================================
         Function for select District
         =================================================================================================================*/
        function selectDist(district){
            //var district = selectVal;

            $("#txtZone").val('');
            $("#txtState").val('');
            $("#txtDivision").val('');
            $("#txtTaluka").val('');
            $("#txtPincode").val('');
            $("#txtVillage").val('');

            //  $("#division").val('');
            // $("#district").val('');
            // $("#taluka").val('');
            $("#pincode").val('');
            $("#village").val('');


            $("#mem_id").val('');
            $("#mem_name").val('');
            $("#mem_mobile").val('');

            $.ajax({
                url: "https://www.modimart.world/franchise4/fill_by_district.php",
                data: 'district=' + district,
                type: "POST",
                success: function (data) {

                    var obj = JSON.parse(data);
                    var zone = obj['zone'];
                    var state = obj['state'];
                    var division = obj['division'];
                    var district = obj['district_id'];
                    $("#zone").val(zone);


                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_state.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_division.php',
                        data: 'state_id='+state,
                        success:function(msg) {
                            document.getElementById("division").innerHTML = '<option value="">Division</option>';
                            $("#division").html(msg);
                            $('#division option[value="' + division + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_district.php',
                        data: 'division_id='+division,
                        success:function(msg) {
                            document.getElementById("district").innerHTML = '<option value="">District</option>';
                            $("#district").html(msg);
                            $('#district option[value="' + district + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_taluka.php',
                        data: 'district_id='+district,
                        success:function(msg) {
                            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                            $("#taluka").html(msg);
                            $('#taluka option[value="' + taluka + '"]').prop('selected', true);
                        }
                    });

                }
            });
        }


        $('#txtDistrict').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://www.modimart.world/franchise4/get_district1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                selectDist(item.id);
                console.log("====="+item)
                return item;
            }
        });


        /* ===================================================================================================================
         Function for select Taluka
         ===================================================================================================================*/
        function selectTaluka(taluka){

            // var taluka = taluka;

            $("#txtZone").val('');
            $("#txtState").val('');
            $("#txtDivision").val('');
            $("#txtDistrict").val('');
            $("#txtPincode").val('');
            $("#txtVillage").val('');


//  $("#division").val('');
//             $("#district").val('');
//             $("#taluka").val('');
//             $("#pincode").val('');
            $("#village").val('');


            $("#mem_id").val('');
            $("#mem_name").val('');
            $("#mem_mobile").val('');


            $.ajax({
                url: "https://www.modimart.world/franchise4/fill_by_taluka.php",
                data: 'taluka=' + taluka,
                type: "POST",
                success: function (data) {

                    var obj = JSON.parse(data);
                    var zone = obj['zone'];
                    var state = obj['state'];
                    var division = obj['division'];
                    var district = obj['district'];
                    var taluka = obj['taluka_id'];
                    // var pincode_id = obj['pincode_id'];
                    $("#zone").val(zone);


                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_state.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_division.php',
                        data: 'state_id='+state,
                        success:function(msg) {
                            document.getElementById("division").innerHTML = '<option value="">Division</option>';
                            $("#division").html(msg);
                            $('#division option[value="' + division + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_district.php',
                        data: 'division_id='+division,
                        success:function(msg) {
                            document.getElementById("district").innerHTML = '<option value="">District</option>';
                            $("#district").html(msg);
                            $('#district option[value="' + district + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_taluka.php',
                        data: 'district_id='+district,
                        success:function(msg) {
                            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                            $("#taluka").html(msg);
                            $('#taluka option[value="' + taluka + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_pincode.php',
                        data: 'taluka_id='+taluka,
                        success:function(msg) {
                            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
                            $("#pincode").html(msg);
                            // $('#pincode option[value="' + pincode_id + '"]').prop('selected', true);
                        }
                    });
                }
            });



        }


        $('#txtTaluka').typeahead({
            source: function (query, result) {
                console.log("Call data"+j)
                j++;
                $.ajax({
                    url: "https://www.modimart.world/franchise4/get_taluka1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                selectTaluka(item.id);
                console.log("====="+item)
                return item;
            }
        });

        /* ==================================================================================================================
         Function for select Village
         =====================================================================================================================*/
        function selectVillage(village){

            //var village = this.value;

            $("#txtZone").val('');
            $("#txtState").val('');
            $("#txtDivision").val('');
            $("#txtDistrict").val('');
            $("#txtTaluka").val('');
            $("#txtPincode").val('');


            $("#mem_id").val('');
            $("#mem_name").val('');
            $("#mem_mobile").val('');


            $.ajax({
                url: "https://www.modimart.world/franchise4/fill_by_village.php",
                data: 'village=' + village,
                type: "POST",
                success: function (data) {

                    var obj = JSON.parse(data);
                    var zone = obj['zone'];
                    var state = obj['state'];
                    var division = obj['division'];
                    var district = obj['district'];
                    var taluka = obj['taluka'];
                    var pincode = obj['pincode'];
                    var village_id = obj['village'];

                    $("#zone").val(zone);


                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_state.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_division.php',
                        data: 'state_id='+state,
                        success:function(msg) {
                            document.getElementById("division").innerHTML = '<option value="">Division</option>';
                            $("#division").html(msg);
                            $('#division option[value="' + division + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_district.php',
                        data: 'division_id='+division,
                        success:function(msg) {
                            document.getElementById("district").innerHTML = '<option value="">District</option>';
                            $("#district").html(msg);
                            $('#district option[value="' + district + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_taluka.php',
                        data: 'district_id='+district,
                        success:function(msg) {
                            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                            $("#taluka").html(msg);
                            $('#taluka option[value="' + taluka + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_pincode.php',
                        data: 'taluka_id='+taluka,
                        success:function(msg) {
                            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
                            $("#pincode").html(msg);
                            $('#pincode option[value="' + pincode + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://www.modimart.world/franchise4/get_village.php',
                        data: 'pincode_id='+pincode,
                        success:function(msg) {

                            document.getElementById("village").innerHTML = '<option value="">village</option>';
                            $("#village").html(msg);
                            $('#village option[value="' + village_id + '"]').prop('selected', true);
                        }
                    });
                }
            });

        }

        $('#txtVillage').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://www.modimart.world/franchise4/get_village1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },

            updater: function(item) {
                selectVillage(item);
                console.log("====="+item)
                return item;
            }
        });


        /* ======================================================================================================
         typeahead for search by Name
         =========================================================================================================*/
        $('#mem_name').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://www.modimart.world/franchise4/get_mem_name.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            }
        });
        /* ===============================================================================================================
         typeahead for search by Mobile
         ==================================================================================================================*/
        $('#mem_mobile').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://www.modimart.world/franchise4/get_mem_mobile.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            }
        });






























    $("#form").on('change', function() {
     $("#show_com").html('');
     $("#village_level_fran").html('');
     document.getElementById("data_row").style.display = "flex";
     $("#bread").html('');
     $("#data_row").html('<img class="loader_img" src="https://www.modimart.world/franchise4/landing_assets/830.gif">');
     document.getElementById("data_table").style.display = "none";
     $("#txtCountry").on("change", function() {
         var country = this.value;
         $("#txtZone").val('');
         $("#txtState").val('');
         $("#txtDistrict").val('');
         $("#txtDivision").val('');
         $("#txtTaluka").val('');
         $("#txtPincode").val('');
         $("#txtVillage").val('');
         $("#zone").val('');
         $("#state").val('');
         $("#division").val('');
         $("#district").val('');
         $("#taluka").val('');
         $("#pincode").val('');
         $("#village").val('');
         $("#mem_id").val('');
         $("#mem_name").val('');
         $("#mem_mobile").val('');
     });
     setTimeout(function() {
         $("input").blur();
         var mem_id = $("#mem_id").val();
         var mem_name = $("#mem_name").val();
         var mem_mobile = $("#mem_mobile").val();
         var country = '1';
         var zone = $("#zone").val();
         var state = $("#state").val();
         var division = $("#division").val();
         var district = $("#district").val();
         var taluka = $("#taluka").val();
         var pincode = $("#pincode").val();
         var village = $("#village").val();
         $("#mem_id").on("change", function() {
             var mem_name = $("#mem_name").val('');
             var mem_mobile = $("#mem_mobile").val('');
             var country = '';
             var zone = $("#zone").val('');
             var state = $("#state").val('');
             var division = $("#division").val('');
             var district = $("#district").val('');
             var taluka = $("#taluka").val('');
             var pincode = $("#pincode").val('');
             var village = $("#village").val('');
         });
         $("#mem_name").on("change", function() {
             var mem_id = $("#mem_id").val('');
             var mem_mobile = $("#mem_mobile").val('');
             var country = '';
             var zone = $("#zone").val('');
             var state = $("#state").val('');
             var division = $("#division").val('');
             var district = $("#district").val('');
             var taluka = $("#taluka").val('');
             var pincode = $("#pincode").val('');
             var village = $("#village").val('');
         });
         $("#mem_mobile").on("change", function() {
             var mem_id = $("#mem_id").val('');
             var mem_name = $("#mem_name").val('');
             var country = '';
             var zone = $("#zone").val('');
             var state = $("#state").val('');
             var division = $("#division").val('');
             var district = $("#district").val('');
             var taluka = $("#taluka").val('');
             var pincode = $("#pincode").val('');
             var village = $("#village").val('');
         });
         $.ajax({
             type: "POST",
             url: 'get_data_member.php',
             data: 'country=' + country + '&zone=' + zone + '&state=' + state + '&division=' + division + '&district=' + district + '&taluka=' + taluka + '&pincode=' + pincode + '&village=' + village + '&mem_id=' + mem_id + '&mem_name=' + mem_name + '&mem_mobile=' + mem_mobile,
             success: function(msg) {
                 console.log(msg);
                 if (msg > 0 || msg > '0') {
                     document.getElementById("data_table").style.display = "block";
                     document.getElementById("data_row").style.display = "none";
                     var show_div = '<?echo $_SESSION['
                     show_table ']; ?>';
                     console.log('show_div' + show_div);
                     var obj = JSON.parse(msg);

                    $("#bread").html(obj['bread']);
                    $("#member_id").html(obj['id']);
                    document.getElementById("member_mobile").innerHTML = obj['mobile'];
                    document.getElementById("member_name").innerHTML = obj['name'];
                    $("#level").html(obj['position']);
                    $("#star").html(obj['star']);
                    $("#member_position").html(obj['position_name']);
                    // $("#getcountry").html(obj['country']);
                    // $("#getzone").html(obj['zone']);
                    // $("#getstate").html(obj['state']);
                    // $("#getdivision").html(obj['division']);
                    // $("#getdistrict").html(obj['district']);
                    // $("#gettaluka").html(obj['taluka']);
                    // $("#getpincode").html(obj['pincode']);
                    // $("#getvillage").html(obj['village']);
                    // $("#getlocation").html(obj['location']);
                    // $("#pan_card").html(obj['pan_card']);
                    // $("#aadhar_card").html(obj['aadhar_card']);
                    // $("#gst").html(obj['gst']);
                    $("#introduced_id").html(obj['introduced_id']);
                    $("#introduced_name").html(obj['introduced_name']);
                    $("#introduced_mobile").html(obj['introduced_mobile']);
                    $("#paid_status").html(obj['paid_status']);
                    $("#product_given_status").html(obj['product_given_status']);
                    // $("#amount").html(obj['amount']);
                    // $("#created_at").html(obj['created_at']);
                    $("#product_select").html(obj['product_select']);
                    $("#view").html(obj['view']);
                    $("#edit").html(obj['edit']);
                    $("#product_select").html(obj['product_select']);

                     $("#member_pic").html('<img src="'+obj['image']+'" style="width:100px;height:100px;" alt="Not Available">');

                     document.getElementById("data_row").style.display = "none";


                 } else {
                    document.getElementById("data_table").style.display = "block";
                     document.getElementById("data_row").style.display = "none";

                    $("#member_pic").html('');
                    $("#bread").html('');
                    $("#member_id").html('');

                    document.getElementById("member_position").innerHTML = '';
                    document.getElementById("member_mobile").innerHTML = '';
                    document.getElementById("member_name").innerHTML = '';
                    $("#level").html("");
                    $("#star").html("");
                    $("#member_position").html("");
                    // $("#getcountry").html("");
                    // $("#getzone").html("");
                    // $("#getstate").html("");
                    // $("#getdivision").html("");
                    // $("#getdistrict").html("");
                    // $("#gettaluka").html("");
                    // $("#getpincode").html("");
                    // $("#getvillage").html("");
                    // $("#getlocation").html("");
                    // $("#pan_card").html("");
                    // $("#aadhar_card").html("");
                    // $("#gst").html("");
                    $("#introduced_id").html("");
                    $("#introduced_name").html("");
                    $("#introduced_mobile").html("");
                    $("#paid_status").html("");
                    $("#product_given_status").html("");
                    // $("#amount").html("");
                    // $("#created_at").html("");
                    $("#product_select").html("");
                    $("#view").html("");
                    $("#edit").html("");
                    $("#product_select").html("");

                    document.getElementById("data_row").style.display = "none";


                 }
             }
         });

     }, 2500);
 });



        $("#zone").on('change',function(){
            var zone_id = $("#zone").val();
            $.ajax({

                type: "POST",
                url: 'https://www.modimart.world/franchise4/get_state.php',
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
                url: 'https://www.modimart.world/franchise4/get_division.php',
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
                url: 'https://www.modimart.world/franchise4/get_district.php',
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
                url: 'https://www.modimart.world/franchise4/get_taluka.php',
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
                url: 'https://www.modimart.world/franchise4/get_pincode.php',
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
                url: 'https://www.modimart.world/franchise4/get_village.php',
                data: 'pincode_id='+pincode_id,
                success:function(msg) {

                    document.getElementById("village").innerHTML = '<option value="">Village</option>';

                    $("#village").html(msg);
                }
            });

        });
        $("select").on("change",function(){
            $("#form input").val('');
        });


    }, 2500);

});

</script>

<!-- SweetAlert Plugin Js -->
<script src="https://www.modimart.world/franchise4/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Custom Js -->
<script src="https://www.modimart.world/franchise4/js/pages/ui/dialog2.js"></script>
</body>
</html>