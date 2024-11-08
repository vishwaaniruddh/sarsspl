<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ('header.php');
    include ('config.php');

    $Main_id = $_GET['id'];

    $qeryLead = mysqli_query($conn, "select * from Leads_table where Lead_id='" . $Main_id . "' ");
    $qeryfetch = mysqli_fetch_array($qeryLead);

    $member_detail = mysqli_query($conn, "select ExpiryDate from Members where Static_LeadId = '" . $Main_id . "' ");
    $mem_detail_res = mysqli_fetch_assoc($member_detail);

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
        function getStateCity() {

            var Pincode = document.getElementById("Pincode").value;
            $.ajax({
                type: 'POST',
                url: 'setDropDownSateCity.php',
                data: 'Pincode=' + Pincode,
                datatype: 'json',
                success: function (msg) {
                    //  alert(msg);
                    var jsr = JSON.parse(msg);
                    for (var i = 0; i < jsr.length; i++) {

                        document.getElementById("state").value = jsr[i]["State"];
                        document.getElementById("City").value = jsr[i]["City"];
                    }
                }
            })

        }


        function setDropDownTitle(table, id, name, setDropdwon) {
            $.ajax({
                type: 'POST',
                url: 'setDropDownTitle.php',
                data: 'table=' + table + '&id=' + id + '&name=' + name,
                datatype: 'json',
                success: function (msg) {
                    // alert(msg);
                    var jsr = JSON.parse(msg);
                    //alert(jsr.length);



                    var hed = '#' + setDropdwon;

                    var newoption = ' <option value="">Select</option>';
                    $(hed).empty();
                    if (setDropdwon == "state") {
                        for (var i = 0; i < jsr.length; i++) {
                            newoption += '<option id=' + jsr[i]["ids"] + ' value=' + jsr[i]["ids"] + '   >' + jsr[i]["name"] + '</option> ';
                        }
                    } else {

                        for (var i = 0; i < jsr.length; i++) {
                            newoption += '<option id=' + jsr[i]["name"] + ' value=' + jsr[i]["name"] + '   >' + jsr[i]["name"] + '</option> ';
                        }
                    }
                    $(hed).append(newoption);

                }
            })

        }


        function setDropDown(Textboxid, tableName, Column, id, name, setDropdwon) {
            var value = Textboxid;

            $.ajax({
                type: 'POST',
                url: 'SetDropdownValue.php',
                data: 'value=' + value + '&tableName=' + tableName + '&Column=' + Column + '&id=' + id + '&name=' + name,
                datatype: 'json',
                success: function (msg) {
                    // alert(msg);
                    var jsr = JSON.parse(msg);
                    //alert(jsr.length);


                    var hed = '#' + setDropdwon;

                    var newoption = ' <option value="">Select</option>';
                    $(hed).empty();

                    for (var i = 0; i < jsr.length; i++) {
                        newoption += '<option id=' + jsr[i]["ids"] + ' value=' + jsr[i]["ids"] + '   >' + jsr[i]["name"] + '</option> ';
                    }
                    $(hed).append(newoption);

                }
            })

        }








        function modelnos() {

            var state = document.getElementById("state").value;
            //alert(state);
            $.ajax({
                type: 'POST',
                url: 'city.php',
                data: 'state=' + state,
                datatype: 'json',
                success: function (msg) {
                    //  alert(msg);
                    var jsr = JSON.parse(msg);
                    //alert(jsr.length);
                    var newoption = ' <option value="">Select</option>';
                    $('#City').empty();

                    for (var i = 0; i < jsr.length; i++) {


                        //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
                        newoption += '<option id=' + jsr[i]["ids"] + ' value=' + jsr[i]["ids"] + '   >' + jsr[i]["modelno"] + '</option> ';


                    }
                    $('#City').append(newoption);

                }
            })

        }



    </script>
    <script>


        var bool = false;

        function chkmailexs() {
            //for update
            var MainGetID = document.getElementById('MainGetID').value;
            /////////////////////////////////////////////////////////////////

            var email = document.getElementById('Gmail').value;
            if (email != "") {
                var exs = "0";
                //alert(email);
                $.ajax({
                    type: 'POST'
                    , url: 'checkemail.php'
                    , data: "email=" + email + '&Table=' + 'Leads_table' + '&column=' + 'EmailId' + '&MainGetID=' + MainGetID
                    //, error: function () {}
                    , success: function (data) {
                        // alert(data);
                        if (data == 1) {
                            swal("Email id Already Exists !");
                            document.getElementById("label3").innerHTML = "Email id Already Exists !";
                            document.getElementById("label3").style.color = "Red";
                            document.getElementById('email').focus();
                            bool = false;
                        }
                        else {
                            document.getElementById("label3").innerHTML = "";
                            bool = true;
                        }
                    }
                    /* , error: function (data) {
                         bool = false;
                     }*/
                });
            }
            /*else {
                bool = true;
            }*/
            return bool;
        }



        function validation() {
            var LeadByLead = document.getElementById("LeadByLead").value;
            var LeadByMember = document.getElementById("LeadByMember").value;
            var Source = document.getElementById("Source").value;
            var FirstName = document.getElementById("FirstName").value;
            var LastName = document.getElementById("LastName").value;
            var mcode1 = document.getElementById("mcode1").value;
            var mob1 = document.getElementById("mob1").value;
            var Email = document.getElementById("Gmail").value;
            var Pincode = document.getElementById("Pincode").value;
            var state = document.getElementById("state").value;
            var City = document.getElementById("City").value;
            var emailFilter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;


            if (FirstName == "") {
                swal("Please enter First Name ");
                return false;
            }
            else if (LastName == "") {
                swal("Please enter Last Name");
                return false;
            }
            else if (mcode1 == "") {
                swal("Please enter Mobile Code");
                return false;
            }
            else if (mob1 == "") {
                swal("Please enter Mobile Number");
                return false;
            }
            else if (mob1 < "10") {
                swal("Please enter valid Number");
                return false;
            }
            else if (Pincode == "") {
                swal("Please enter Pincode");
                return false;
            }

            else if (state == "") {
                swal("Please Select State");
                return false;
            }



            else if (City == "") {
                swal("Please Select City");
                return false;
            }

            else if (Source != "" && Source == "10" && LeadByLead == "") {
                swal("Please Enter Lead By Lead");
                return false;
            }
            else if (Source != "" && Source == "11" && LeadByMember == "") {
                swal("Please Enter Lead By Member");
                return false;
            }

            /*  else if (Email == "")
             {
                 swal(" Please fill email id ");
                 return false;
                 
             }
              else if (!emailFilter.test(Email))
             {
                 
                 swal("Invalid Email ")
                 return false;
             }*/
            else {

                // sumitfunc();
                return true;

            }

        }


        var bool1 = false;
        function chkmobile() {
            //for update
            var MainGetID = document.getElementById('MainGetID').value;
            /////////////////////////////////////////////////////////////////


            var mob = document.getElementById('mob1').value;
            var mcode1 = document.getElementById("mcode1").value;
            if (mob != "") {

                //var exs="0";
                //alert(email);
                $.ajax({

                    type: 'POST',
                    url: 'checkMobile.php',
                    data: 'mob=' + mob + '&mcode1=' + mcode1 + '&Table=' + 'Leads_table' + '&column=' + 'MobileNumber' + '&MainGetID=' + MainGetID,
                    /* error: function() {
                        
                     },*/
                    async: false,
                    success: function (data) {

                        //alert(data);

                        if (data == "1") {
                            swal("Mobile Number Already Exists !")
                            document.getElementById("label5").innerHTML = "Mobile Number Already Exists !";
                            document.getElementById("label5").style.color = "Red";
                            document.getElementById('mob').focus();
                            bool1 = false;
                        }
                        else {
                            document.getElementById("label5").innerHTML = "";
                            bool1 = true;
                        }

                    }
                    /*,error: function (data) {
                              bool1 = false;
                          }*/

                });

            }
            /*else
            {
            bool1 = true;
            
            }*/

            return bool1;
        }



        /*
        var bool5 = false;
        function chkmobile1()
        {
                   //for update
                    var MainGetID = document.getElementById('MainGetID').value;
                    /////////////////////////////////////////////////////////////////
                    
        
        var mob=document.getElementById('mob2').value;
        var mcode1= document.getElementById("mcode2").value;
        if(mob!="")
        {
          
        //var exs="0";
        //alert(email);
         $.ajax({
                       
           type:'POST',  
           url:'checkMobile2.php',
           data:'mob='+mob+'&mcode1='+mcode1+'&Table='+'Leads_table'+'&column='+'MobileNumber'+'&column2='+'MobileNumber2'+'&MainGetID='+MainGetID,
          
          async: false,
        success: function(data) {
        
        
        
        if(data=="1")
        {
        swal("Mobile Number Already Exists !")
        document.getElementById("label6").innerHTML="Mobile Number Already Exists !";
        document.getElementById("label6").style.color="Red";
        document.getElementById('mob2').focus();
        bool5 = false;
        }
        else
        {
        document.getElementById("label5").innerHTML="";
        bool5 = true;
        }
        
          }
          
        
        return bool5;
        }
        */





        function submitfun(action) {
            //alert(chkmailexs())
            //alert(chkmobile())
            //alert(validation())


            var MainGetID = document.getElementById("MainGetID").value;

            if (MainGetID != "") {

                if (validation()) {
                    sumitfunc(action);
                }

            } else {

                if (validation()) {
                    //  if(chkmailexs())

                    //  {
                    if (chkmobile()) {

                        sumitfunc(action);

                    }
                    //}
                }
            }
        }


    </script>
    <script>
        function sumitfunc(action) {

            $('#submit').val('Please wait ...')
                .attr('disabled', 'disabled');

            var ExpiryDt = document.getElementById("ExpiryDate").value;

            // alert(action)

            $.ajax({
                type: 'POST',
                url: 'update_expirydt_process.php',

                data: 'ExpityDt=' + ExpityDt + '&Leadid=' + MainGetID,
                async: false,
                success: function (msg) {
                    // alert(msg);
                    if (msg == 1) {
                        swal({
                            title: "Success!",
                            text: "Thank you, the lead has been recorded.!",
                            icon: "success",
                            // buttons: true,
                            dangerMode: true,
                        })
                            .then((willDelete) => {
                                if (willDelete) {

                                    window.open("update_expirydate.php", "_self");

                                }
                            });


                    }
                    else if (msg == 3) {
                        swal({
                            title: "Success!",
                            text: "Thank you, the lead Updated Successfully.!",
                            icon: "success",
                            // buttons: true,
                            dangerMode: true,
                        })
                            .then((willDelete) => {
                                if (willDelete) {

                                    window.open("leadupdatebysales.php", "_self");

                                }
                            });

                    }
                    else {
                        swal("error");
                    }


                }
            })
        } 
    </script>



</head>

<body class="sidebar-pinned">

    <?php include ("vertical_menu.php") ?>


    <main class="admin-main">
        <?php include ('navbar.php'); ?>
        <!--site header ends -->
        <section class="admin-content">
            <div class="bg-dark">
                <div class="container  m-b-30">
                    <div class="row">
                        <div class="col-12 text-white p-t-40 p-b-90">

                            <h4 class=""> New Prospect
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
                                    Lead Entry
                                </h5>
                                <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                            </div>
                            <div class="card-body ">

                                <input type="hidden" id="MainGetID" name="MainGetID" value="<?php echo $Main_id; ?>">
                                <input type="hidden" id="excelid" name="excelid" value="<?php echo $_GET['excelid']; ?>">


                                <div class="form-group">

                                    <label for="inputAddress2">Title</label>
                                    <select class="form-control" name="Title" id="Title"
                                        onfocus="setDropDownTitle('Title','title_id','titleName','Title')">
                                        <option value="">Select Title</option>
                                        <?php if ($Main_id != "") { ?>
                                            <option value="<?php echo $qeryfetch['Title']; ?>"
                                                id="<?php echo $qeryfetch['Title']; ?>" selected>
                                                <?php echo $qeryfetch['Title']; ?></option><?php } ?>

                                    </select>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">First Name</label>
                                        <input type="text" class="form-control" id="FirstName" name="FirstName"
                                            value="<?php if ($Main_id != "") {
                                                echo $qeryfetch['FirstName'];
                                            } ?>"
                                            placeholder="First Name *" required="true">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Last Name</label>
                                        <input type="text" class="form-control" id="LastName" name="LastName"
                                            value="<?php if ($Main_id != "") {
                                                echo $qeryfetch['LastName'];
                                            } ?>"
                                            placeholder="Last Name *" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Nationality</label>
                                        <input type="text" class="form-control" id="Nationality" name="Nationality"
                                            value="<?php if ($Main_id != "") {
                                                echo $qeryfetch['Nationality'];
                                            } else {
                                                echo "Indian";
                                            } ?>"
                                            placeholder="Nationality " required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Country</label>
                                        <select class="form-control" name="Country" id="Country">
                                            <option value=" ">Select Country</option>
                                            <option value="India" <?php if ($Main_id != "") { ?>selected<?php } else { ?>selected <? } ?>>India</option>

                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="inputAddress">Email</label>&nbsp;<label id="label3"></label>
                                    <input type="email" class="form-control" id="Gmail" name="Gmail"
                                        value="<?php if ($Main_id != "") {
                                            echo $qeryfetch['EmailId']; ?>  <?php } ?>"
                                        placeholder="Email" <?php if ($Main_id != "") { ?> <?php } else { ?> <?php } ?>
                                        readonly>
                                </div>


                                <div class="form-group">
                                    <label for="inputAddress2">Pincode</label>
                                    <input type="text" class="form-control" onblur="getStateCity();" id="Pincode"
                                        name="Pincode" value="<?php if ($Main_id != "") {
                                            echo $qeryfetch['PinCode'];
                                        } ?>"
                                        Placeholder="Pincode" onkeypress="return isNumber(event)" maxlength="6" required
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label for="inputAddress2">State</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        value="<?php if ($Main_id != "") {
                                            echo $qeryfetch['State'];
                                        } ?>" Placeholder="State"
                                        readonly required>
                                </div>

                                <div class="form-group">
                                    <label for="inputAddress2">City</label>
                                    <input type="text" class="form-control" id="City" name="City"
                                        value="<?php if ($Main_id != "") {
                                            echo $qeryfetch['City'];
                                        } ?>" Placeholder="City"
                                        readonly required>

                                </div>




                                <div class="form-row">
                                    <div class="form-group col-md-4 col-sm-4">
                                        <label for="inputEmail4">Mobile Code *</label>
                                        <input type="text" class="form-control" name="mcode1" id="mcode1" maxlength="3"
                                            <?php if ($Main_id != "") {
                                            } else { ?> onblur="chkmobile();" <?php } ?>
                                            value="<?php if ($Main_id != "") {
                                                echo '+' . $qeryfetch['MobileCode'];
                                            } else {
                                                echo '+91';
                                            } ?>"
                                            onkeypress="return isNumber(event)" placeholder="eg. 91">
                                    </div>
                                    <div class="form-group col-md-8 col-sm-8">
                                        <label for="inputPassword4">Mobile number *</label>&nbsp;<label
                                            id="label5"></label>
                                        <input type="text" class="form-control" id="mob1" name="mob1" maxlength="10"
                                            <?php if ($Main_id != "") { ?> readonly <?php } else { ?> onblur="chkmobile();"
                                            <?php } ?> onkeypress="return isNumber(event)"
                                            value="<?php if ($Main_id != "") {
                                                echo $qeryfetch['MobileNumber'];
                                            } ?>"
                                            placeholder="Mobile number">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Expiry Date</label>
                                        <input type="text" class="form-control" id="ExpiryDate" name="ExpiryDate"
                                            value="<?php if ($Main_id != "") {
                                                echo $mem_detail_res['ExpiryDate'];
                                            } ?>"
                                            placeholder="Expiry Date *" required="true">
                                    </div>

                                </div>


                                <br />

                                <div class="form-group">
                                    <?php if ($_GET['id'] == "") { ?>
                                        <button type="button" class="btn btn-primary" id="submit" name="submit"
                                            onclick="submitfun('submit')">Submit</button>

                                    <?php }
                                    if ($_GET['excelid'] == "1") { ?>
                                        <button type="button" class="btn btn-primary" id="excelUpdate" name="excelUpdate"
                                            onclick="submitfun('excelUpdate')">Update</button>
                                    <?php } else if ($_GET['excelid'] == "0") { ?>
                                            <button type="button" class="btn btn-primary" id="LeadUpdate" name="LeadUpdate"
                                                onclick="submitfun('LeadUpdate')">Update</button>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!--widget card ends-->




                    </div>

                </div>


            </div>
        </section>
    </main>
    <?php include ('belowScript.php'); ?>

</body>

</html>

<script>
    function leadbyLead_Member() {
        var leadSource = $("#Source").val();

        if (leadSource != "" && leadSource == "10") {
            $("#LeadByL").show();
            $("#LeadByMember").val('');
            $("#LeadByM").hide();
        }
        else if (leadSource != "" && leadSource == "11") {
            $("#LeadByM").show();
            $("#LeadByLead").val('');
            $("#LeadByL").hide();
        } else {
            $("#LeadByLead").val('');
            $("#LeadByMember").val('');
            $("#LeadByL").hide();
            $("#LeadByM").hide();
        }
    }
</script>