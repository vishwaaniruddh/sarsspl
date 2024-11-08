<?php session_start();
// var_dump($_SESSION);

if (!isset($_SESSION['username'])) {?>

    <script>
        window.location.href='https://modimart.world/franchise5/admin';
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
    <script type="text/javascript" src="https://modimart.world/franchise5/typeahead.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="https://modimart.world/franchise5/style.css">
    <!-- Sweetalert Css -->
    <link href="https://modimart.world/franchise5/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link rel="shortcut icon" href="https://modimart.world/assets/logo-original.png" type="image/png" />
    <!-- Favicon-->
    <link rel="icon" href="https://modimart.world/assets/logo.png" type="image/png">

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

        <!-- <link href="css/themes/all-themes.css" rel="stylesheet" /> -->
   <!--  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script> -->


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
ul {
    /* background: lightsalmon; */
    padding: 2px;
    list-style-type: none;
    width: auto;
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

<style>
  .loader{
  display: none;
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('https://modimart.world/assets/loader.gif') 
              50% 50% no-repeat rgb(246 246 246 / 52%);
}
</style>
<body>
    <div class="loader"></div>
<div class="heading" style="padding-top:0px !important;">
    <div class="logo">
        <a href="https://modimart.world/franchise5/get_members.php" style="padding:10px;"><img src="https://modimart.world/assets/logo.png" alt="" style="width: 105px;background:white;border-radius: 50%;"><span style="font-size:0.7em;padding:10px;">Modimart.world</span></a>
    </div>
    <div class="menu">
        <?php include '../menu.php';?>
    </div>
</div>

<div class=" main" style="margin: 20px; width: auto; height: auto;">
    <form id="form" action="<?$_SERVER['PHP_SELF'];?>" method="POST">
        <div class="row mem_info" id="meminfo">

            <div class="col-md-3">
                <input class="form-control typeahead" type="text" name="mem_id" id="mem_id" placeholder="search by id">
            </div>
            <div class="col-md-3">
                <input class="form-control typeahead" type="text" name="mem_name" id="mem_name" placeholder="search by Name">
            </div>
            <div class="col-md-3">
                <input class="form-control typeahead" type="text" name="mem_mobie" id="mem_mobile" placeholder="search by Mobile">
            </div>
            <div class="col-md-3">
                <input class="form-control" type="text" name="Createdate" id="created_at" placeholder="YYYY-MM-DD search created Date">
            </div>
        </div>

        <div class="row custom_row">
            <div class="col cust_col">
                <!-- <label>Country</label> -->
                <input type="text" name="txtCountry" id="txtCountry" class="typeahead" placeholder="Search Country">
            </div>

            <div class="col cust_col">
                <!-- <label>Zone</label> -->
                <input type="text" name="txtZone" id="txtZone" class="typeahead" placeholder="Search Zone">
                
            </div>

            <div class="col cust_col">
                <!-- <label>State</label> -->
                <input type="text" name="txtState" id="txtState" class="typeahead" placeholder="Search State">
                
            </div>


            <div class="col cust_col">
                <!-- <label>Division</label> -->
                <input type="text" name="txtDivision" id="txtDivision" class="typeahead" placeholder="Search Division">
                
            </div>


            <div class="col cust_col">
                <!-- <label>District</label> -->
                <input type="text" name="txtDistrict" id="txtDistrict" class="typeahead" placeholder="Search District">
                
            </div>


            <div class="col cust_col">
                <!-- <label>Taluka</label> -->
                <input type="text" name="txtTaluka" id="txtTaluka" class="typeahead" placeholder="Search Taluka">
              
            </div>


            <div class="col cust_col">
                <!-- <label>Pincode</label> -->
                <input type="text" name="txtPincode" id="txtPincode" class="typeahead" placeholder="Search Pincode">
               
            </div>


            <div class="col cust_col" style="display:none;">
                <!-- <label>Village</label> -->
                <input type="text" name="txtVillage" id="txtVillage" class="typeahead" placeholder="Search Village">
               
            </div>


        </div>
    </form>
    <br>
    <!-- <button id="get">Get</button> -->
    <hr>

    <div id="data_table"  >
        <table style="cursor: pointer;" id="example">
         <thead>
             <tr>
                                            <th>Id</th>
                                            <!-- <th>Image</th> -->
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


                                            <!--<th>Paid Status</th>-->
                                            <!--<th>Product Given Status</th>-->
                                           <!--  <th>Amount</th>
                                            <th>Created at</th> -->
                                          
                                           
                                            <th>Introducer Id</th>
                                            <th>Introducer Name</th>
                                            <th>Introducer Mobile</th>
                                            <!--  <th>Status</th>-->
                                            <!--  <th>View</th>-->
                                            <!--<th>Edit</th>-->
                                             <!--<th>Product Select</th>-->
                                          <th>Date of Joining</th>

                                        </tr>
                                </thead>
                                    
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


$(document).ready(function() {
            var j = 0
            $("#village_level_fran").html('');
            // $("#data_row").html('<img class="loader_img" src="https://modimart.world/franchise5/landing_assets/830.gif">');
            // document.getElementById("data_table").style.display = "none";

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
                                type: 'POST',
                                dataType: 'json',
                                url: 'ajax/getmemberfirstData1.php',
                                // data: {type:type,id:id },
                                success: function(d) {
                                    // alert(d);
                                    $("#data_row").hide();
                                    $('#example').DataTable({
                                        dom: "Bfrtip",                                        
                                        buttons: [
                                                    'copy', 'excel', 'pdf',
                                                ],                                              
                                         data: d.data,
                                        "columns": [
                                            { "data": "id" },
                                            { "data": "name" },                                            
                                            { "data": "mobile" },
                                            { "data": "position" },
                                            { "data": "star" },
                                            { "data": "position_name" },
                                            // { "data": "paid_status" },
                                            // { "data": "product_given_status" },
                                            { "data": "introduced_id" },
                                            { "data": "introduced_name" },
                                            { "data": "introduced_mobile" },
                                            // { "data": "status" },
                                            // { "data": "view" },
                                            // { "data": "edit" },
                                            // { "data": "product_select" }
                                            {"data" : "created_at" }
                                        ]
                                    });
                                }
                            });
                        

                        $('#txtCountry').typeahead({
                            source: function(query, result) {
                                $.ajax({
                                    url: "https://modimart.world/franchise5/admin/ajax/getcountryajex.php",
                                    data: 'query=' + query,
                                    dataType: "json",
                                    type: "POST",
                                    success: function(data) {
                                        result($.map(data, function(item) {
                                            return item;
                                        
                                        }));
                                    }
                                });
                            },
                            updater: function(item) {
                                GetResult(item.id,'country');
                                console.log(item);
                                // alert(item);
                                return item;
                            }
                        });


                         $('#txtZone').typeahead({
                            source: function (query, result) {
                                $.ajax({
                                    url: "https://modimart.world/franchise5/admin/ajax/getzoneajex.php",
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
                                GetResult(item.id,'zone');
                                console.log("selectZone====="+item)
                                return item;
                            }
                        });


                         $('#txtState').typeahead({
                            source: function (query, result) {
                                $.ajax({
                                    url: "https://modimart.world/franchise5/admin/ajax/get_state1.php",
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
                                GetResult(item.id,'state');
                                console.log("selectState====="+item.name)
                                return item;
                            }
                        });

                         $('#txtPincode').typeahead({
                            source: function (query, result) {
                                $.ajax({
                                    url: "https://modimart.world/franchise5/admin/ajax/get_pincode1.php",
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
                                GetResult(item.id,'pincode');
                                console.log("selectPincode====="+item.id)
                                return item;
                            }
                        });

                         $('#txtDivision').typeahead({
                            source: function (query, result) {
                                $.ajax({
                                    url: "https://modimart.world/franchise5/admin/ajax/get_division1.php",
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
                                GetResult(item.id,'division');
                                console.log("selectDivision====="+item)
                                return item;
                            }
                        });



                         $('#txtDistrict').typeahead({
                            source: function (query, result) {
                                $.ajax({
                                    url: "https://modimart.world/franchise5/admin/ajax/get_district1.php",
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
                                GetResult(item.id,'district');
                                console.log("====="+item)
                                return item;
                            }
                        });

                         $('#txtTaluka').typeahead({
                            source: function (query, result) {
                                console.log("Call data"+j)
                                j++;
                                $.ajax({
                                    url: "https://modimart.world/franchise5/admin/ajax/get_taluka1.php",
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
                                GetResult(item.id,'taluka');
                                console.log("====="+item)
                                return item;
                            }
                        });


                         $('#txtVillage').typeahead({
                            source: function (query, result) {
                                $.ajax({
                                    url: "https://modimart.world/franchise5/admin/ajax/get_village1.php",
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
                                // selectVillage(item);
                                GetResult(item.id,'village')
                                console.log("====="+item)
                                return item;
                            }
                        });



                          $('#mem_mobile').typeahead({
                            source: function (query, result) {
                                $.ajax({
                                    url: "https://modimart.world/franchise5/admin/ajax/get_mem_mobile.php",
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
                                GetResult(item.id,'id');
                                console.log("selectPincode====="+item.id)
                                return item;
                            }
                        });

                          $('#mem_name').typeahead({
                            source: function (query, result) {
                                $.ajax({
                                    url: "https://modimart.world/franchise5/admin/ajax/get_mem_name.php",
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
                                GetResult(item.id,'id');
                                console.log("selectPincode====="+item.id)
                                return item;
                            }
                        });
                          $('#mem_id').typeahead({
                            source: function (query, result) {
                                $.ajax({
                                    url: "https://modimart.world/franchise5/admin/admin/ajax/getmemberid.php",
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
                                GetResult(item.id,'id');
                                console.log("selectPincode====="+item.id)
                                return item;
                            }
                        });
                          $('#created_at').typeahead({
                            source: function (query, result) {
                                $.ajax({
                                    url: "https://modimart.world/franchise5/admin/admin/ajax/getmemberdate.php",
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
                                GetResult(item.name,'created_at');
                                console.log("selectPincode====="+item.name)
                                return item;
                            }
                        });


                          function GetResult(id,type)
                          {
                            // alert(type+'---'+id);
                            $(".loader").show();
                            $(".typeahead").val("");
                            var table = $('#example').DataTable();
                            table.destroy();
                            $.ajax({
                                type: 'POST',
                                dataType: 'json',
                                url: 'ajax/getmemberData1.php',
                                data: {type:type,id:id },
                                success: function(d) {
                                    // alert(d);
                                    $(".loader").hide();
                                    $('#example').DataTable({
                                        dom: "Bfrtip",
                                        buttons: [
                                                    'copy', 'excel', 'pdf','pageLength'
                                                ],
                                         data: d.data,
                                        "columns": [
                                            { "data": "id" },
                                            { "data": "name" },                                            
                                            { "data": "mobile" },
                                            { "data": "position" },
                                            { "data": "star" },
                                            { "data": "position_name" },
                                            // { "data": "paid_status" },
                                            // { "data": "product_given_status" },
                                            { "data": "introduced_id" },
                                            { "data": "introduced_name" },
                                            { "data": "introduced_mobile" },
                                            // { "data": "status" },
                                            // { "data": "view" },
                                            // { "data": "edit" },
                                            // { "data": "product_select" }
                                            {"data" : "created_at"} 
                                        ]
                                    });
                                }
                            });

                          }
                        });

</script>

<!-- SweetAlert Plugin Js -->
<script src="https://modimart.world/franchise5/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Custom Js -->
<script src="https://modimart.world/franchise5/js/pages/ui/dialog2.js"></script>

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