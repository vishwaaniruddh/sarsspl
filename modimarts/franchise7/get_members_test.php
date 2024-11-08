<? session_start();
include('config.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function get_state_id($name){
    global $con;
    
    $sql = mysqli_query($con,"select * from new_state where state like '".$name."'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['id'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>TradeEx.World | ModiMart</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="typeahead.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <!-- Sweetalert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link rel="shortcut icon" href="favicon.png" type="image/png"/>

    
</head>


<script>
    if (!!window.performance && window.performance.navigation.type === 2) {
            // value 2 means "The page was accessed by navigating into the history"
            // console.log('Reloading');
            window.location.reload(); // reload whole page

        }
</script>

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
    .tagname {
        width:30%;
        text-align:center;
    }
    .menu {
        width: 40%;
        
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
    <div class="heading">
        <div class="logo">
            <a href="https://modimart.world/franchise/get_members.php"><img src="visiting_assets/modi-logo.png" alt="" style="width: 60%;background:white;"></a>
        </div>
        <!--<div>-->
        <!--    <h4 style="color:aliceblue;width:115%;">TradeEx.World</h4>-->
        <!--</div>-->
        <div class="tagname">
            <img src="visiting_assets/trade-exlogo.jpeg" alt="" style="width:60%;background:white;">
            <!--<h4 style="color:aliceblue;width:115%;">TradeEx.World</h4>-->
        </div>
    </div>

    <div class=" main" style="margin: 20px; width: auto; height: auto;">
        <form id="form" action="<? $_SERVER['PHP_SELF'];?>" method="POST">
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
        <button id="get">Get</button>
        <hr>


        <!--<h3 id="5000" style="display:flex;justify-content:center; ">Confirm Franchise Application by paying Rs. 5000</h3>-->
                
        <h3 id="franchise_of"></h3>
        

                
                
                <div id="data_row" style="display:flex;justify-content:center;"></div>        
                  

        <p id="bread"></p>
        
        <div id="data_table"  style="overflow-x:auto;">
            <table style="cursor: pointer;">
              <tr>
                <th>Position Name</th>
                <th>Profile</th>
                <th>ID No</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Total Introduction Done</th>
                <th>Total Introduced Qualified</th>
                <th>Days Over</th>
                <th>Turnover</th>
                <th>Apply</th>
                <th>Status</th>
                <th>Visiting Card</th>
                <th>View Down Line</th>
                <th>Direct Introduction</th>
                <th>Promotions</th>
                <th>Edit Profile</th>

              </tr>
              <tr>
                <td id="member_position"> India</td>
                <td id="member_pic"></td>
                <td id="member_id"></td>
                <td><p id="member_name"></p></td>
                <td id="member_mobile"></td>
                <td id="total_intro"></td>
                <td id="active_intro"></td>
                <td id="days_over"></td>
                <td></td>
                <td id="member_apply"></td>
                <td id="confirm"></td>
                <td id="visiting_card"></td>
                <td id="show_tree"></td>
                <td id="direct_intro"></td>
                
                <td id="promotions"></td>
                <td>
                    <div class="row clearfix js-sweetalert" style="display: flex;justify-content: center;" id="edit_member">
                        <button class='btn btn-primary waves-effect' id="btn_edit" data-type="prompt">Edit</button>
                    </div>
                </td>
                

              </tr>
            
            </table>
            
            <br>
            <br>
            <div class="show_com">
                <div id="show_com"></div>
                
            </div>
            <br>
            <br>
          </div>

    </div>
<br>
<!--<div id="waiting_btn" style="display: flex; justify-content: center;">-->
<!--</div>-->

<hr>

</div>


                <div class="waiting main" style="margin: 20px; width: auto; height: auto;" id="waiting_content">
                    <div class="header" style="text-align:center;">
                        <h3>Free Waiting List Franchise Application : </h3>
                        <p style="font-size:20px;">Apply for Franchisee Start Sale & get commission & if you complete sale of Rs. 1 Lac first then get Confirm Franchisee Position.</p>
                    </div>
                    <div class="body">
                        <div id="waiting_data"></div>
                    </div>
                </div>



<div class="village_level_fran" style="margin: 20px; width: auto; height: auto;" >
    <div class="body">
        <div id="village_level_fran"></div>    
    </div>
    
</div>







    <br>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:900px;">

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

<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:900px;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Introduced To Members</h4>
      </div>
      
      
      <div class="modal-body" id="child">

      </div>
      
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





<!---->



<!-- Modal -->
<div id="waiting_intro_to" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:900px;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Introduced To Members</h4>
      </div>
      
      
      <div class="modal-body" id="waiting_intro">

      </div>
      
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





<!---->






<style>
    .loader_img{
        height:100px;
    }
</style>




<script>

        



    $(document).ready(function () {

$("#village_level_fran").html('');

        
        $("#data_row").html('<img class="loader_img" src="landing_assets/830.gif">');
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
                url: 'get_member_data.php',
            
            data: 'country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village+'&mem_id='+mem_id+'&mem_name='+mem_name+'&mem_mobile='+mem_mobile,
            
            success:function(msg) {
        
            console.log(msg);
        
            if(msg>0 || msg > '0'){
                
                document.getElementById("data_table").style.display = "block";
                document.getElementById("data_row").style.display = "none";
                
                
                var obj = JSON.parse(msg);
                var status = obj['status'];
                var total_intro = obj['total_intro'];
                var active_intro = obj['qualify'];
                var days_over = obj['days_over'];
                var commission = obj['commission'];
                
                $("#show_com").html('Total Commission = Rs. '+ commission + '/-  <a href="com_details.php?id='+obj['id']+'">Click For Details</a>');
                
                if(status==1){
                    status = 'Approve';
                }
                else{
                    status = 'Not Approve';
                }
                
                $("#waiting_data").html('');
                $("#village_level_fran").html('');
                
               
                $("#member_pic").html('<img src="'+obj['image']+'" alt="Not Available">');
                
                
                

                
                $("#promotions").html('<a class="btn btn-danger" href="promotions.php?id='+obj['id']+'"> Promotions </a>');
                
                
                $("#btn_edit").attr('mobile',obj['id']);
                
                $("#bread").html(obj['bread']);
                    
                document.getElementById("member_position").innerHTML = obj['star'];
                document.getElementById("member_mobile").innerHTML = obj['mobile'];
                document.getElementById("member_name").innerHTML = obj['name'];
                document.getElementById("member_id").innerHTML = obj['id'];
                document.getElementById("active_intro").innerHTML = obj['qualify'];
                document.getElementById("total_intro").innerHTML = obj['total_intro'];
                document.getElementById("days_over").innerHTML = obj['days_over'];
                
               
                $("#franchise_of").html('Franchise of '+obj['position']);
               $("#visiting_card").html('<a href="new_visit.php?id='+obj['id']+'" class="btn btn-danger">Visiting Card</a>');
            //   $("#aatm").html('<a href="offer/offer.php?id='+obj['id']+'" class="btn btn-danger">See Image</a>')
               $("#show_tree").html ('<button id="trees" type="button" class="btn btn-info" data-toggle="modal" data-original-title ='+obj['id']+' data-target="#myModal">View Tree</button>');
               
               $("#direct_intro").html ('<button id="introduced_to" type="button" class="btn btn-info" data-toggle="modal" data-original-title ='+obj['id']+' data-target="#myModal1">Introduced To</button>');
               
               
                $("#member_apply").html('');
    
                $("#confirm").html('<p class="confirm">Confirm</p>');
                // $("#waiting_btn").html('<p class="confirm">( Confirm )</p>');
    
                var member_id = obj['id'];
                $.ajax({
                type: "POST",
                url: 'get_tree.php',
                data: 'member_id='+member_id,
                
                success:function(msg) {
                // console.log(msg);
                $("#modal_body").html(msg);
                
                }
                });   
                
                
                
                  $.ajax({
                type: "POST",
                url: 'get_child.php',
                data: 'member_id='+member_id,
                
                success:function(msg) {
                // alert(msg);
                $("#child").html(msg);
                
                }
                });   
                
            document.getElementById("waiting_content").style.display= 'none';

            
    
                
        }
        else{
            
            document.getElementById("data_table").style.display = "block";
            document.getElementById("data_row").style.display = "none";
            
            $("#franchise_of").html('');
            // $("#aatm").html('');
            $("#promotions").html('');
            $("#visiting_card").html('');
            $("#direct_intro").html ('');
            $("#active_intro").html('');
            $("#days_over").html('');
            $("#total_intro").html('');
            $("#member_id").html('');
            $("#member_pic").html('');
            $("#member_apply").html('<a id="apply" href="apply.php?country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village+'" class="btn btn-danger">Apply</a>');
            document.getElementById("member_position").innerHTML = '';
            document.getElementById("member_mobile").innerHTML = '';
            document.getElementById("member_name").innerHTML = '';   
            
            }   
        }    
    });
         
        
         
         
             
         
     
            



        
        $('#txtCountry').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "get_country.php",
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
        
        $('#txtZone').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "get_zone1.php",
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
        
        $('#txtState').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "get_state1.php",
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
        
        $('#txtPincode').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "get_pincode1.php",
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
        
        
        $('#txtDivision').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "get_division1.php",
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
        
        $('#txtDistrict').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "get_district1.php",
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
        
        
         $('#txtDistrict').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "get_district1.php",
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
        
        $('#txtTaluka').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "get_taluka1.php",
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
        
        
        
        $('#txtVillage').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "get_village1.php",
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
        
        
        $('#mem_name').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "get_mem_name.php",
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
        
           $('#mem_mobile').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "get_mem_mobile.php",
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
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    $("#form").on('change',function(){
        
        
$("#show_com").html('');



$("#village_level_fran").html('');


        document.getElementById("data_row").style.display = "flex";
        
        $("#bread").html('');
        $("#data_row").html('<img class="loader_img" src="landing_assets/830.gif">');            
        document.getElementById("data_table").style.display = "none";
        
            $("#txtCountry").on("change",function(){
        
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
        
        

        

        

    $("#txtZone").on("change",function(){
        
        var zone = this.value;
        
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
                url: "fill_by_zone.php",
				data: 'zone=' + zone,
                type: "POST",
                success: function (data) {
                     
                    var obj = JSON.parse(data);
            
                    var zone = obj['zone'];
                    $("#zone").val(zone);
                    
    $.ajax({
        type: "POST",
        url: 'get_zone.php',
        data: 'zone_id='+zone,
        success:function(msg) {            
            document.getElementById("state").innerHTML = '<option value="">State</option>';
            $("#state").html(msg);
            $('#state option[value="' + state + '"]').prop('selected', true);
        }
    });
    }
});
});
        
        
        
                     
          

    $("#txtState").on("change",function(){
        
        var state = this.value;
        
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
                url: "fill_by_state.php",
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
        url: 'get_state.php',
        data: 'zone_id='+zone,
        success:function(msg) {            
            document.getElementById("state").innerHTML = '<option value="">State</option>';
            $("#state").html(msg);
            $('#state option[value="' + state + '"]').prop('selected', true);
        }
    });
    
    $.ajax({
        type: "POST",
        url: 'get_division.php',
        data: 'state_id='+state,
        success:function(msg) {            
            document.getElementById("division").innerHTML = '<option value="">Division</option>';
            $("#division").html(msg);
            $('#division option[value="' + division + '"]').prop('selected', true);
        }
    });
    
    }
});
});
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

    $("#txtDivision").on("change",function(){
        
        var division = this.value;
        
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
                url: "fill_by_division.php",
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
        url: 'get_state.php',
        data: 'zone_id='+zone,
        success:function(msg) {            
            document.getElementById("state").innerHTML = '<option value="">State</option>';
            $("#state").html(msg);
            $('#state option[value="' + state + '"]').prop('selected', true);
        }
    });
    
    $.ajax({
        type: "POST",
        url: 'get_division.php',
        data: 'state_id='+state,
        success:function(msg) {            
            document.getElementById("division").innerHTML = '<option value="">Division</option>';
            $("#division").html(msg);
            $('#division option[value="' + division + '"]').prop('selected', true);
        }
    });
    
    
        $.ajax({
        type: "POST",
        url: 'get_district.php',
        data: 'division_id='+division,
        success:function(msg) {            
            document.getElementById("district").innerHTML = '<option value="">District</option>';
            $("#district").html(msg);
            $('#district option[value="' + district + '"]').prop('selected', true);
            }
        });
    
    
    }
});
});
        
        
        
            
    
    $("#txtDistrict").on("change",function(){
        var district = this.value;
        
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
                url: "fill_by_district.php",
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
        url: 'get_state.php',
        data: 'zone_id='+zone,
        success:function(msg) {            
            document.getElementById("state").innerHTML = '<option value="">State</option>';
            $("#state").html(msg);
            $('#state option[value="' + state + '"]').prop('selected', true);
        }
    });
    
    $.ajax({
        type: "POST",
        url: 'get_division.php',
        data: 'state_id='+state,
        success:function(msg) {            
            document.getElementById("division").innerHTML = '<option value="">Division</option>';
            $("#division").html(msg);
            $('#division option[value="' + division + '"]').prop('selected', true);
        }
    });
    
    
    $.ajax({
        type: "POST",
        url: 'get_district.php',
        data: 'division_id='+division,
        success:function(msg) {            
            document.getElementById("district").innerHTML = '<option value="">District</option>';
            $("#district").html(msg);
            $('#district option[value="' + district + '"]').prop('selected', true);
            }
        });
    
    
        $.ajax({
        type: "POST",
        url: 'get_taluka.php',
        data: 'district_id='+district,
        success:function(msg) {            
            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
            $("#taluka").html(msg);
            $('#taluka option[value="' + taluka + '"]').prop('selected', true);
        }
    });
    
    }
});
});
        
        
        
        
    $("#txtTaluka").on("change",function(){
        var taluka = this.value;
            
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
                url: "fill_by_taluka.php",
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
        url: 'get_state.php',
        data: 'zone_id='+zone,
        success:function(msg) {            
            document.getElementById("state").innerHTML = '<option value="">State</option>';
            $("#state").html(msg);
            $('#state option[value="' + state + '"]').prop('selected', true);
        }
    });
    
    $.ajax({
        type: "POST",
        url: 'get_division.php',
        data: 'state_id='+state,
        success:function(msg) {            
            document.getElementById("division").innerHTML = '<option value="">Division</option>';
            $("#division").html(msg);
            $('#division option[value="' + division + '"]').prop('selected', true);
        }
    });
    
    
    $.ajax({
        type: "POST",
        url: 'get_district.php',
        data: 'division_id='+division,
        success:function(msg) {            
            document.getElementById("district").innerHTML = '<option value="">District</option>';
            $("#district").html(msg);
            $('#district option[value="' + district + '"]').prop('selected', true);
        }
    });
    
    $.ajax({
        type: "POST",
        url: 'get_taluka.php',
        data: 'district_id='+district,
        success:function(msg) {            
            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
            $("#taluka").html(msg);
            $('#taluka option[value="' + taluka + '"]').prop('selected', true);
        }
    });
    
    
    $.ajax({
        type: "POST",
        url: 'get_pincode.php',
        data: 'taluka_id='+taluka,
        success:function(msg) {            
            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
            $("#pincode").html(msg);
            // $('#pincode option[value="' + pincode_id + '"]').prop('selected', true);
        }
        });
                    }
                });
        });
        
        
        
    
        
    $("#txtPincode").on("change",function(){
        var pincode = this.value;
        
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
                url: "fill_by_pin.php",
				data: 'pincode=' + pincode,
                type: "POST",
                success: function (data) {
                     
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
        url: 'get_state.php',
        data: 'zone_id='+zone,
        success:function(msg) {            
            document.getElementById("state").innerHTML = '<option value="">State</option>';
            $("#state").html(msg);
            $('#state option[value="' + state + '"]').prop('selected', true);
        }
    });
    
            $.ajax({
        type: "POST",
        url: 'get_division.php',
        data: 'state_id='+state,
        success:function(msg) {            
            document.getElementById("division").innerHTML = '<option value="">Division</option>';
            $("#division").html(msg);
            $('#division option[value="' + division + '"]').prop('selected', true);
        }
    });
    
            $.ajax({
        type: "POST",
        url: 'get_district.php',
        data: 'division_id='+division,
        success:function(msg) {            
            document.getElementById("district").innerHTML = '<option value="">District</option>';
            $("#district").html(msg);
            $('#district option[value="' + district + '"]').prop('selected', true);
        }
    });
    
            $.ajax({
        type: "POST",
        url: 'get_taluka.php',
        data: 'district_id='+district,
        success:function(msg) {            
            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
            $("#taluka").html(msg);
            $('#taluka option[value="' + taluka + '"]').prop('selected', true);
        }
    });
    
            $.ajax({
        type: "POST",
        url: 'get_pincode.php',
        data: 'taluka_id='+taluka,
        success:function(msg) {            
            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
            $("#pincode").html(msg);
            $('#pincode option[value="' + pincode_id + '"]').prop('selected', true);
        }
        });
        
            $.ajax({
        type: "POST",
        url: 'get_village.php',
        data: 'pincode_id='+pincode_id,
        success:function(msg) {   
            

            document.getElementById("village").innerHTML = '<option value="">village</option>';
            $("#village").html(msg);
            $('#village option[value="' + village + '"]').prop('selected', true);
           }
          });
         }
       });
     });
        
        
    
$("#txtVillage").on("change",function(){
        var village = this.value;
        
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
                url: "fill_by_village.php",
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
        url: 'get_state.php',
        data: 'zone_id='+zone,
        success:function(msg) {            
            document.getElementById("state").innerHTML = '<option value="">State</option>';
            $("#state").html(msg);
            $('#state option[value="' + state + '"]').prop('selected', true);
        }
    });
    
    $.ajax({
        type: "POST",
        url: 'get_division.php',
        data: 'state_id='+state,
        success:function(msg) {            
            document.getElementById("division").innerHTML = '<option value="">Division</option>';
            $("#division").html(msg);
            $('#division option[value="' + division + '"]').prop('selected', true);
        }
    });
    
    
    $.ajax({
        type: "POST",
        url: 'get_district.php',
        data: 'division_id='+division,
        success:function(msg) {            
            document.getElementById("district").innerHTML = '<option value="">District</option>';
            $("#district").html(msg);
            $('#district option[value="' + district + '"]').prop('selected', true);
        }
    });
    
    $.ajax({
        type: "POST",
        url: 'get_taluka.php',
        data: 'district_id='+district,
        success:function(msg) {            
            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
            $("#taluka").html(msg);
            $('#taluka option[value="' + taluka + '"]').prop('selected', true);
        }
    });
    
    
    $.ajax({
        type: "POST",
        url: 'get_pincode.php',
        data: 'taluka_id='+taluka,
        success:function(msg) {            
            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
            $("#pincode").html(msg);
            $('#pincode option[value="' + pincode + '"]').prop('selected', true);
        }
        });
        
    $.ajax({
        type: "POST",
        url: 'get_village.php',
        data: 'pincode_id='+pincode,
        success:function(msg) {   

            document.getElementById("village").innerHTML = '<option value="">village</option>';
            $("#village").html(msg);
            $('#village option[value="' + village_id + '"]').prop('selected', true);
                }
            });
        }
    });
});
        
        setTimeout(function(){
            
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
        
        $("#mem_id").on("change",function(){
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
        
        $("#mem_name").on("change",function(){
            
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
        $("#mem_mobile").on("change",function(){
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
            url: 'get_member_data.php',
            data: 'country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village+'&mem_id='+mem_id+'&mem_name='+mem_name+'&mem_mobile='+mem_mobile,
            success:function(msg) {
            
            console.log(msg);
            
            if(msg>0 || msg > '0'){
                
                document.getElementById("data_table").style.display = "block";
                document.getElementById("data_row").style.display = "none";
                
                
        var show_div = '<? echo $_SESSION['show_table'];?>';
        
        
        console.log('show_div'+show_div);
                var obj = JSON.parse(msg);
                var status = obj['status'];
                
                if(status==1){
                    status = 'Approve';
                }
                else{
                    status = 'Not Approve';
                }
                
                

            $.ajax({
                type: "POST",
                url: 'get_waiting1.php',
                data: 'country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village,
                success:function(msg) {
                 $("#waiting_data").html(msg);
                }
            });        






            $.ajax({
                type: "POST",
                url: 'get_village_fran.php',
                data: 'country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode,
                success:function(msg) {
                 $("#village_level_fran").html(msg);
                }
            });        





                var commission = obj['commission'];
                
                $("#show_com").html('Total Commission = Rs. '+ commission + '/-  <a href="com_details.php?id='+obj['id']+'">Click For Details</a>');

            $("#edit_member").show();
            
            
            $("#promotions").html('<a class="btn btn-danger" href="promotions.php?id='+obj['id']+'"> Promotions </a>');
                

                            
                            
            $("#member_pic").html('<img src="'+obj['image']+'" alt="Not Available">');
            $("#btn_edit").attr('mobile',obj['id']);
            document.getElementById("member_id").innerHTML = obj['id'];
            $("#franchise_of").html('Franchise of '+obj['position']);
            document.getElementById("active_intro").innerHTML = obj['qualify'];
            document.getElementById("days_over").innerHTML = obj['days_over'];
            document.getElementById("total_intro").innerHTML = obj['total_intro'];
            $("#visiting_card").html('<a href="new_visit.php?id='+obj['id']+'" class="btn btn-danger">Visiting Card</a>');
            // $("#aatm").html('<a href="offer/offer.php?id='+obj['id']+'" class="btn btn-danger">See Image</a>');
            $("#show_tree").html ('<button id="trees" type="button" class="btn btn-info" data-toggle="modal" data-original-title ='+obj['id']+' data-target="#myModal">View Tree</button>');
            $("#direct_intro").html ('<button id="introduced_to" type="button" class="btn btn-info" data-toggle="modal" data-original-title ='+obj['id']+' data-target="#myModal1">Introduced To</button>');
            $("#confirm").html('<p class="confirm">Confirm</p>');
            
            
            if(village>0){
                // $("#waiting_btn").html('<a id="waiting" href="https://modimart.world/franchise/waiting.php?country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village+'" class="btn btn-danger">Apply Waiting</a>');                
        document.getElementById("waiting_content").style.display= 'block';
            }
             else{
                $("#waiting_btn").html('');
        document.getElementById("waiting_content").style.display= 'none';
            }
    
            document.getElementById("member_position").innerHTML = obj['star'];
            document.getElementById("member_mobile").innerHTML = obj['mobile'];
            document.getElementById("member_name").innerHTML = obj['name'];   
            $("#member_apply").html('');
              
                          document.getElementById("bread").innerHTML = obj['bread'];

             
        $.ajax({
            type: "POST",
            url: 'get_child.php',
            data: 'member_id='+obj['id'],
            success:function(msg) {
                $("#child").html(msg);
                }
            });
        
        
        var member_id = $('#trees').data('original-title');
            
        $.ajax({
            type: "POST",
            url: 'get_tree.php',
            data: 'member_id='+member_id,
            success:function(msg) {
            $("#modal_body").html(msg);
        }
          });    
          
          
          
        $.ajax({
            type: "POST",
            url: 'get_child.php',
            data: 'member_id='+member_id,
            
            success:function(msg) {
            $("#child").html(msg);
            
            }
            });   
            
            
            
            
            
            
            
            
    }
            else{
                $("#show_com").html('');
                
            $.ajax({
                type: "POST",
                url: 'get_village_fran.php',
                data: 'country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode,
                success:function(msg) {
                 $("#village_level_fran").html(msg);
                }
            });        



            
            $.ajax({
                type: "POST",
                url: 'get_waiting1.php',
                data: 'country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village,
                success:function(msg) {
                    $("#waiting_data").html(msg);
                }
            });
            
            
            
            $.ajax({
            type: "POST",
            url: 'get_tree_else1.php',
            data: 'country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village,
            success:function(msg) {
            $("#modal_body").html(msg);
        }
          });
                
                console.log('NOt found');
                
                document.getElementById("data_table").style.display = "block";
                document.getElementById("data_row").style.display = "none";
                var show_div = '<? echo $_SESSION['show_table'];?>';

                $("#promotions").html('');
                $("#franchise_of").html('');
                $("#visiting_card").html('');
                $("#direct_intro").html ('');
                $("#active_intro").html('');
                $("#days_over").html('');
                $("#total_intro").html('');
                $("#member_id").html('');
                $("#member_pic").html('');
                $("#confirm").html('');
                $("#edit_member").hide();
                $("#member_apply").html('<a id="apply" href="apply.php?country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village+'" class="btn btn-danger">Apply</a>');            
                
                document.getElementById("member_position").innerHTML = '';
                document.getElementById("member_mobile").innerHTML = '';
                document.getElementById("member_name").innerHTML = '';
                document.getElementById("visiting_card").innerHTML = '';
            
            if(village>0){
                // $("#waiting_btn").html('<a id="waiting" href="waiting.php?country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village+'" class="btn btn-danger">Apply Waiting</a>'); 
                                document.getElementById("waiting_content").style.display= 'block';
            }
            else{
                $("#waiting_btn").html('');
        document.getElementById("waiting_content").style.display= 'none';
            }

        }
            }
            });
         
         
    $.ajax({
        type: "POST",
        url: 'get_additional_members.php',
        data: 'country='+country+'&zone='+zone+'&state='+state+'&division='+division+'&district='+district+'&taluka='+taluka+'&pincode='+pincode+'&village='+village,
        
        success:function(msg) {
                $("#addtional_member").html(msg);
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
        $("select").on("change",function(){
             $("#form input").val('');
         });
        
             
                }, 4000);

    });
    
</script>
    
     <!-- SweetAlert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="js/pages/ui/dialog2.js"></script>
</body>
</html>
