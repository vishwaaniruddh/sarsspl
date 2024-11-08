<?php
session_start();
if (isset($_SESSION['SESS_USER_NAME'])) {
    include 'config.php';
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include 'header.php'; ?>

<body onload="createList();">

    <div id="site_title_bar_wrapper_outter">
        <div id="site_title_bar_wrapper_inner">

            <div id="site_title_bar">

                <div id="banner_left">

                    <div id="site_title" style="margin-bottom:-100px;">
                        <h1><a href="#">
                                Health <span>Clinic</span>
                                <span class="tagline">A complete health care</span>
                            </a></h1>
                    </div>
                    <!--end of site title-->

                    <?php include 'navbar.php'; ?>

                </div>

                <div id="banner_right">
                    <div id="banner_box">

                        <h1>Welcome to Health Clinic </h1><br />
                        <a href="accounts.php" target="_new">Accounts</a>
                        <br /><a href="esibill.php">ESI Bills</a>

                        <div class="button"><a href="logout.php">Log Out</a></div>


                    </div>
                </div>

            </div> <!-- end of site_title_bar  -->

        </div> <!-- end of site_title_bar_wrapper_inner -->
    </div> <!-- end of site_title_bar_wrapper_outter  -->

    <div id="content">



    </div> <!-- end of content -->
    <!-- end of footer wrapper -->

    <!--New Patient -->

    <!--end of New Patient -->

    <!--view patient records-->

    <div id="view_patient" class="login-popup">
        <div id="view_patient1">
            <?php

                //$id=$_GET['patient_id'];
                $result = mysqli_query($con, "select * from patient");

                ?>

            <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                    alt="Close" /></a>

            <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Patient's Records</p>

            <table border="1">
                <tr>
                    <td><input type="text" style="width:70px;" name="idd" id="idd" onchange="searchById();" /></td>
                    <td><input type="text" style="width:90px;" name="fname22" id="fname22" onchange="searchById();" />
                    </td>
                </tr>

                <tr>
                    <td width="73" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td>
                    <td width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Full Name </td>
                    <td width="42" style="color:#ac0404; font-size:14px; font-weight:bold;">Age</td>
                    <td width="103" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td>
                    <td width="61" style="color:#ac0404; font-size:14px; font-weight:bold;">City </td>
                    <td width="98" style="color:#ac0404; font-size:14px; font-weight:bold;">Address</td>
                    <td width="135" style="color:#ac0404; font-size:14px; font-weight:bold;">Reference By </td>
                    <td width="51" style="color:#ac0404; font-size:14px; font-weight:bold;">Appoint-ment</td>
                    <td width="46" style="color:#ac0404; font-size:14px; font-weight:bold;">OPD</td>
                    <td width="51" style="color:#ac0404; font-size:14px; font-weight:bold;">Admission</td>
                    <td width="64" style="color:#ac0404; font-size:14px; font-weight:bold;">Surgery</td>
                    <td width="64" style="color:#ac0404; font-size:14px; font-weight:bold;">History</td>
                    <td width="77" style="color:#ac0404; font-size:14px; font-weight:bold;">View Full Details</td>
                </tr>
            </table>
            <div id="search">
                <table border="1">
                    <?php while ($row = mysqli_fetch_row($result)) { ?>

                    <tr>
                        <td width="73">
                            <?php echo $row[2]; ?>
                        </td>
                        <td width="92">
                            <?php echo $row[6]; ?>
                        </td>
                        <td width="42">
                            <?php echo $row[26]; ?>
                        </td>
                        <td width="103">
                            <?php echo $row[23]; ?>
                        </td>
                        <td width="61">
                            <?php echo $row[18]; ?>
                        </td>
                        <td width="90">
                            <?php echo $row[20]; ?>
                        </td>
                        <?php

                                $result1 = mysqli_query($con, "select * from doctor where doc_id='$row[9]'");
                                //$result1 = mysqli_query($con,"select doc_id,name from new_doc ");
                                $row1 = mysqli_fetch_row($result1)
                                ?>
                        <td width="135">
                            <?php echo $row1[1]; ?>
                        </td>
                        <td width="67"><input name="code1[]" id="code1[]" type="checkbox" value="<?php echo $row[2]; ?>"
                                onclick="window.location.href='app.php?id=<?php echo $row[2]; ?>'" /></td>
                        <td width="46"><input name="code2[]" id="code2[]" type="checkbox" value="<?php echo $row[2]; ?>"
                                onclick="window.location.href='opd.php?id=<?php echo $row[2]; ?>'" /> </td>
                        <td width="81"><input name="code4[]" id="code4[]" type="checkbox" value="<?php echo $row[2]; ?>"
                                onclick="window.location.href='admission.php?id=<?php echo $row[2]; ?>'" /></td>
                        <td width="64"><input name="code5[]" id="code5[]" type="checkbox" value="<?php echo $row[2]; ?>"
                                onclick="window.location.href='surgery.php?id=<?php echo $row[2]; ?>'" /></td>
                        <td width="64"><input name="code3[]" id="code3[]" type="checkbox" value="<?php echo $row[2]; ?>"
                                onclick="window.location.href='history.php?id=<?php echo $row[2]; ?>'" /></td>
                        <td width="77"><a href='patient_detail.php?id=<?php echo $row[2]; ?>'> Details </a></td>
                    </tr>
                    <?php } ?>
                </table>



                <div id="pageNavPosition"></div>
            </div>
            <script type="text/javascript" src="paging.js"></script>
            <script type="text/javascript">
            var pager = new Pager('results', 5);
            pager.init();
            pager.showPageNav('pager', 'pageNavPosition');
            pager.showPage(1);
            </script>
        </div>
    </div>
    <!--end of view patient records-->

    <script type="text/javascript">
    function confirm_delete3(id) {
        if (window.confirm("Are you sure you want to delete this entry?")) {
            window.location = "delete_app.php?id=" + id;
        }
    }
    </script>
    <!--view Appointment records-->

    <div id="viewapp" class="login-popup">

    </div>
    <!--end of view appointment records-->


    <!--telephone directory-->

    <!--end of telephone directory-->

    <!--view Telephone Directory-->

    <!--end of view telephone directory-->

    <!--New Doctor-->
    <!--End of New Doctor-->

    <script type="text/javascript">
    function confirm_delete4(id) {
        if (window.confirm("Are you sure you want to delete this entry?")) {
            window.location = "delete_doc.php?id=" + id;
        }

    }
    </script>

    <!--view doctor-->

    <div id="view_doc" class="login-popup">
        <div id="view_doc1">
            <?php

                $result = mysqli_query($con, "select * from doctor");
                ?>

            <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                    alt="Close" /></a>

            <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Doctor's Records</p>

            <table border="1" style="border:2px #ac0404 solid;">

                <tr>
                    <td><input type="text" style="width:50px;" name="did" id="did" onchange="searchdoc1();" /></td>
                    <td><input type="text" name="dname" id="dname" onchange="searchdoc1();" /></td>
                    <td><input type="text" name="city22" id="city22" onchange="searchdoc1();" /></td>

                </tr>
                <tr>
                    <td width="50" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td>
                    <td width="110" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</td>
                    <td style="color:#ac0404; font-size:14px; font-weight:bold;">Address</td>
                    <td width="80" style="color:#ac0404; font-size:14px; font-weight:bold;">City </td>
                    <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td>
                    <td width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Gender</td>
                    <td width="85" style="color:#ac0404; font-size:14px;font-weight:bold;">Category </td>
                    <td width="85" style="color:#ac0404; font-size:14px;font-weight:bold;">Specialist </td>
                    <td width="27" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</td>
                    <td width="37" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</td>
                </tr>
            </table>

            <div id="docsearch1">
                <table border="1">
                    <?php while ($row = mysqli_fetch_row($result)) { ?>

                    <tr>
                        <td width="54">
                            <?php echo $row[0]; ?>
                        </td>
                        <td width="155">
                            <?php echo $row[1]; ?>
                        </td>
                        <td width="156">
                            <?php echo $row[4]; ?>
                        </td>
                        <td width="80">
                            <?php echo $row[3]; ?>
                        </td>
                        <td width="100">
                            <?php echo $row[6]; ?>
                        </td>
                        <td width="70">
                            <?php echo $row[11]; ?>
                        </td>
                        <td width="70">
                            <?php echo $row[8]; ?>
                        </td>
                        <td width="70">
                            <?php echo $row[9]; ?>
                        </td>

                        <td> <a href='edit_doc.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
                        <td width="50"> <a href="javascript:confirm_delete4(<?php echo $row[0]; ?>);"> Delete </a></td>
                    </tr>

                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <!--end of view doctor-->



    <!--Vew Diagnosis -->
    <div id="view_diag" class="login-popup">

        <?php


            ?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>


    </div>
    <!--end of view diagnosis-->


    <!--New Medical Reports -->

    <!--end of New Reports -->

    <!-- Vew Reports -->
    <!--end of view reports-->

    <!--New Delivery Details -->

    <!--end of Delivery -->

    <!-- Vew Delivery -->
    <!--end of view delivery-->


    <!--New Receipt -->

    <div id="receipt" class="login-popup">
        <?php
            // include 'config.php';
            $sql = "select * from new_patient";
            $result = mysqli_query($con, $sql);
            ?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>

        <form method="post" class="signin" action="new_receipt.php">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Receipt</p>

                <label class="pat_id"><span>Patient ID:</span>
                    <select name="pid" id="pid" style="width:235px;">
                        <?php while ($row = mysqli_fetch_row($result)) { ?>
                        <option value="<?php echo $row[0] ?>">
                            <?php echo $row[0] ?>
                        </option>
                        <?php } ?>
                    </select>
                </label>

                <label class="amount">
                    <span>Amount:</span>
                    <input id="amt" name="amt" type="text">
                </label>

                <label class="Date">
                    <span>Date:</span>
                    <input id="rdate" name="rdate" type="text" onClick="displayDatePicker('rdate');">
                </label>

                <label class="toward">
                    <span>Towards:</span>
                    <select name="toward" style="width:235px;">
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </label>

                <button class="submit formbutton" type="submit">Submit</button>

            </fieldset>
        </form>
    </div>
    <!--end of receipt -->

    <!--New Payment -->

    <div id="payment" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>

        <form method="post" class="signin" action="new_receipt.php">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Payment</p>

                <label class="date">
                    <span>Date:</span>
                    <input id="date" name="date" type="text" value="<?php echo date('d/m/Y'); ?>" readonly="readonly">
                </label>

                <label class="paid">
                    <span>Paid To:</span>
                    <select name="paid" style="width:235px;">
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </label>

                <label class="amount">
                    <span>Amount:</span>
                    <input id="amt" name="amt" type="text">
                </label>

                <label class="narr">
                    <span>Narration:</span>
                    <textarea rows="2" cols="27" style="resize:none"></textarea>
                </label>

                <label class="paymode">
                    <span> Payment mode: </span>
                    CP<input name="cp" type="radio" value="" style="width:30px;" />
                    BP<input name="cp" type="radio" value="" style="width:30px;" />
                </label>

                <label class="bank">
                    <span>Bank name:</span>
                    <select name="bank" style="width:235px;">
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </label>

                <label class="chq">
                    <span>Cheque no.:</span>
                    <input id="chq" name="chq" type="text">
                </label>

                <button class="submit formbutton" type="submit">Submit</button>

            </fieldset>
        </form>
    </div>
    <!--end of Payment -->


    <!--New Staff master -->

    <div id="new_staff" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>

        <form method="post" class="signin" action="new_staffmaster.php" name="staffform"
            onsubmit="return staffvalidate(this)">

            <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Staff Master</p>

            <fieldset class="textbox">
                <table>

                    <tr>
                        <td><label class="fname"> Full Name: </label></td>
                        <td> <input id="fname" name="fname" type="text"> </td>
                        <td><label class="gender"> Gender: </label></td>
                        <td>
                            <font color="#FFFFFF"> Male: </font><input name="gender" id="gender" type="radio"
                                checked="checked" value="Male" style="width:20px;" />
                            <font color="#FFFFFF"> Female: </font><input name="gender" id="gender" type="radio"
                                value="Female" style="width:20px;" />
                        </td>
                    </tr>

                    <tr>
                        <td><label class="dob"> Date of Birth: </label></td>
                        <td><input id="dob4" name="dob4" type="text" onclick="displayDatePicker('dob4');"></td>
                        <td><label class="age"> Age: </label></td>
                        <td><input id="age" name="age" type="text"></td>
                    </tr>

                    <tr>
                        <td><label class="add">Address:</label></td>
                        <td><textarea id="add" name="add" cols="26" rows="3" style="resize: none"></textarea></td>
                        <td><label class="cn">Contact No.:</label></td>
                        <td><input id="cn" name="cn" type="text"></td>

                    <tr>
                        <td><label class="crel">Close Relative: </label></td>
                        <td> <input id="crel" name="crel" type="text"> </td>
                        <td><label class="rel">Relation: </label></td>
                        <td> <input id="rel" name="rel" type="text"> </td>
                    </tr>

                    <tr>
                        <td><label class="mem"> Members living in the House: </label></td>
                        <td><input id="mem" name="mem" type="text"> </td>
                        <td><label class="house"> House: </label></td>
                        <td><select name="house" style="width:200px;height:27px;border:1px #ac0404 solid;">
                                <option value="Rented">Rented</option>
                                <option value=""></option>
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><label class="kids">Kids Information:</label></td>
                        <td><textarea id="kids" name="kids" cols="26" rows="3" style="resize: none"></textarea></td>
                        <td><label class="relation">Name and Relation of member:</label></td>
                        <td><textarea id="relation" name="relation" cols="26" rows="3" style="resize: none"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td><label class="exp_home">Expenses at home:</label></td>
                        <td><input id="amt" name="amt" type="text"></td>
                        <td><label class="sal">Salary Expectations:</label></td>
                        <td><input id="sal" name="sal" /></td></textarea>
                    </tr>

                    <tr>
                        <td><label class="work">Daily Hours:</label></td>
                        <td><input id="work" name="work" /></td>
                        <td><label class="post">Post:</label></td>
                        <td><input id="post" name="post" /></td>
                    </tr>

                    <tr>
                        <td><label class="basic_salary">Basic Salary:</label></td>
                        <td><input id="bsal" name="bsal" /></td>
                        <td><label class="ot">OT Rate:</label></td>
                        <td><input id="ot" name="ot" /></td>
                    </tr>

                    <tr>
                        <td><button class="submit formbutton" type="submit">Submit</button></td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
    <!--end of Staff Master -->

    <script type="text/javascript">
    <!--
    function confirm_deletestaff(id) {
        if (window.confirm("Are you sure you want to delete this entry?")) {
            window.location = "delete_staff.php?id=" + id;
        }
    } </script> 
    // Start of view staff
    <div id = "view_staff"
    class = "login-popup" >

        <?php


            $result = mysqli_query($con, "select * from staff");

            ?>

        <a href = "#"
    class = "close" > <img src = "images/close_pop.png"
    class = "btn_close"
    title = "Close Window"
    alt = "Close" / > </a>

        <p style = "color:#ac0404; font-weight:bold; font-size:16px;"
    align = "center" > Staff 's Records</p>

        <table border = "1"
    style = "border:2px #ac0404 solid; width:600px;" >
        <th width = "40"
    style = "color:#ac0404; font-size:14px; font-weight:bold;" > ID </th> 
    <th width = "90"
    style = "color:#ac0404; font-size:14px; font-weight:bold;" > Full Name </th> 
    <th width = "30"
    style = "color:#ac0404; font-size:14px; font-weight:bold;" > Gender </th> 
    <th width = "30"
    style = "color:#ac0404; font-size:14px; font-weight:bold;" > Age </th> 
    <th width = "40"
    style = "color:#ac0404; font-size:14px; font-weight:bold;" > Contact </th> 
    <th width = "100"
    style = "color:#ac0404; font-size:14px; font-weight:bold;" > Address </th> 
    <th width = "100"
    style = "color:#ac0404; font-size:14px; font-weight:bold;" > Post </th> 
    <th width = "100"
    style = "color:#ac0404; font-size:14px; font-weight:bold;" > Daily Hours </th> 
    <th width = "100"
    style = "color:#ac0404; font-size:14px; font-weight:bold;" > Basic Salary </th> 
    <th width = "100"
    style = "color:#ac0404; font-size:14px; font-weight:bold;" > Edit </th> 
    <th width = "100"
    style = "color:#ac0404; font-size:14px; font-weight:bold;" > Delete </th>
    <?php while ($row = mysqli_fetch_row($result)) { ?>

        <tr>
        <td > <?php echo $row[20]; ?> </td> <
    td > <?php echo $row[0]; ?> </td> <
    td > <?php echo $row[3]; ?> </td> <
    td > <?php echo $row[1]; ?> </td> <
    td > <?php echo $row[5]; ?> </td> <
    td > <?php echo $row[4]; ?> </td> <
    td > <?php echo $row[15]; ?> </td> <
    td > <?php echo $row[14]; ?> </td> <
    td > <?php echo $row[16]; ?> </td> <
    td > <a href = 'edit_staff.php?id=<?php echo $row[20]; ?>' > Edit </a></td >
        <
        td > <a href = "javascript:confirm_deletestaff(<?php echo $row[20]; ?>);" > Delete </a></td >
        <?php } ?> <
        /tr> </table >

        <
        /div>
        /* End of view staff */

        /* New Attendence */
        <div id = "new_attendance" class = "login-popup" >
        <?php
                $result = mysqli_query($con, "SELECT staff_id,name FROM staff");
                ?> <
        a href = "#"
    class = "close" >
        <
        img src = "images/close_pop.png"
    class = "btn_close"
    title = "Close Window"
    alt = "Close" / >
        <
        /a> <
    form method = "post"
    class = "signin"
    action = "new_attendance.php" >
        <
        p style = "color:#ac0404; font-weight:bold; font-size:16px;"
    align = "center" > New Staff Attendance </p><br / >
        <
        fieldset class = "textbox" >
        <
        label class = "name" > Date </label> <
    input type = "text"
    name = "atdate"
    id = "atdate"
    onclick = "displayDatePicker('atdate');" / >
        <
        table border = "1" >
        <
        tr >
        <
        th > <label class = "name" > Full Name </label></th >
        <
        th > <label class = "present" > Present </label></th >
        <
        th > <label class = "time" > Time </label></th >
        <
        th > <label class = "ot" > OT </label></th >
        <
        /tr>
    <?php while ($row = mysqli_fetch_row($result)) { ?>
        <
        tr >
        <
        td > <?php echo $row[1]; ?> </td> <
    td >
        <
        select name = "present[]"
    id = "present[]" >
        <
        option value = "Yes" > Yes </option> <
    option value = "No" > No </option> </
    select > <
        /td> <
    td >
        <
        select name = "hr[]"
    id = "hr[]"
    style =
        "background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;" >
        <
        option value = ""
    selected = "selected" > Hour </option>
    <?php for ($i = 0; $i <= 23; $i++) { ?>
        <
        option value = "<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>" >
        <?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?> </option>
    <?php } ?>
        <
        /select> <
    select name = "min[]"
    id = "min[]"
    style =
        "background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;" >
        <
        option value = ""
    selected = "selected" > Min </option>
    <?php for ($i = 0; $i <= 59; $i += 5) { ?>
        <
        option value = "<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>" >
        <?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?> </option>
    <?php } ?>
        <
        /select> </
    td > <
        td >
        <
        input id = "ot[]"
    name = "ot[]"
    type = "text"
    style = "width:50px;" / >
        <
        input name = "name[]"
    id = "name[]"
    type = "hidden"
    value = "<?php echo $row[0]; ?>" />
        </td> </tr>
        <?php } ?> </table>
        <button class = "submit formbutton" type = "submit" > Submit </button> </fieldset> </form> </div>


        /* End of new attendance */

        <!--View Attendance-->
    <div id="view_attendance" class="login-popup">
        <a href="#" class="close">
            <img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" />
        </a>
        <form method="post" class="signin" action="view_attendance.php">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Staff Attendance</p>
                <br />
                Select Month:
                <input type="button" id="db" onclick="displayDatePicker('adate');" value="select" style="width:80px;" />
                <input id="adate" name="adate" type="text" onfocus="getDate1();" style="width:55px" />
                <div id="adate1">
                    <table border="1" cellpadding="4" cellspacing="0">
                        <tr>
                            <th width='136'><label class='name'>Full Name</label></th>
                            <th width='73'><label class='present'>Present</label></th>
                            <th width='81'><label class='time'>Time</label></th>
                            <th width='57'><label class='ot'>OT</label></th>
                            <th width='57'><label class='ot'>Edit</label></th>
                        </tr>
                        <?php
                            $dat = mysqli_query($con, "SELECT * FROM attend");
                            while ($datt = mysqli_fetch_row($dat)) {
                                $nam = mysqli_query($con, "SELECT name FROM staff WHERE staff_id='$datt[2]'");
                                $nam1 = mysqli_fetch_row($nam);
                            ?>
                        <tr>
                            <td><?php echo $nam1[0]; ?></td>
                            <td><?php echo $datt[2]; ?></td>
                            <td><?php echo $datt[6]; ?></td>
                            <td><?php echo $datt[3]; ?></td>
                            <td><a href='edit_attendance.php?id=<?php echo $datt[0] ?>'>Edit</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </fieldset>
        </form>
    </div>

    /* End of view attendence */


    // Leave Report
    <div id="leave_report" class="login-popup">
        <?php
            $result = mysqli_query($con, "SELECT staff_id, name FROM staff");
            ?>
        <a href="#" class="close">
            <img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" />
        </a>
        <form method="post" class="signin" action="leave_report.php">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Leave Report</p>
                <table>
                    <tr>
                        <td><label class="Date">From Date:</label></td>
                        <td><input id="frmdate" name="frmdate" type="text" onclick="displayDatePicker('frmdate');" />
                        </td>
                    </tr>
                    <tr>
                        <td><label class="Date">To Date:</label></td>
                        <td><input id="todate" name="todate" type="text" onclick="displayDatePicker('todate');" /></td>
                    </tr>
                    <tr>
                        <td><label class="name">Name:</label></td>
                        <td>
                            <select name="name" style="width:235px;height:27px;border:1px #ac0404 solid;">
                                <?php while ($row = mysqli_fetch_row($result)) { ?>
                                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label id="remarks">Remarks:</label></td>
                        <td><textarea id="remarks" name="remarks" style="resize:none" rows="3" cols="26"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><button class="submit formbutton" type="submit">Submit</button></td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>

    /* End of Leave Report */


    <script type="text/javascript">
    <!--
    function confirm_deleteleave(id) {
        if (window.confirm("Are you sure you want to delete this entry?")) {
            window.location = "delete_leaverecord.php?id=" + id;
        }
    } </script>
    /* Vew Leave Record */
    <div id = "view_leaverecord"
    class = "login-popup" >

        <?php

            $result = mysqli_query($con, "SELECT * FROM  `leave` ");
            ?>

        <a href = "#" class = "close"> <img src = "images/close_pop.png" class = "btn_close" title = "Close Window" alt = "Close" /> </a>

        <p style = "color:#ac0404; font-weight:bold; font-size:16px;" align = "center"> View Leave Record </p><br / >

        <table border = "1" style = "border:2px #ac0404 solid; text-align:left;" >

        <th width = "40" style = "color:#ac0404; font-size:14px; font-weight:bold;" > From date </th> 
        <th width = "40" style = "color:#ac0404; font-size:14px; font-weight:bold;" > To Date </th> 
        <th width = "100" style = "color:#ac0404; font-size:14px; font-weight:bold;" > Name </th> 
        <th width = "100"style = "color:#ac0404; font-size:14px; font-weight:bold;" > Remarks </th>
        <th width = "50" style = "color:#ac0404; font-size:14px;font-weight:bold;" > Edit </th> 
        <th width = "50" style = "color:#ac0404; font-size:14px;font-weight:bold;" > Delete </th>

    <?php while ($row = mysqli_fetch_row($result)) {
                $result1 = mysqli_query($con, "select * from staff where staff_id='$row[2]'");
                $row1 = mysqli_fetch_row($result1);
            ?>

        <tr>

        <td width = "105">
        <?php if (isset($row[0]) and $row[0] != '0000-00-00')
                        echo date('d/m/Y', strtotime($row[0])); ?> </td> 
                        <td width = "105">
        <?php if (isset($row[1]) and $row[1] != '0000-00-00')
                        echo date('d/m/Y', strtotime($row[1])); ?> </td> 
                        <td width = "105" > <?php echo $row1[1]; ?> </td> 
                        <td width = "105" > <?php echo $row[3]; ?> </td>

        <td> <a href = 'edit_leave.php?id=<?php echo $row[4]; ?>' > Edit </a></td>
        <td> <a href = "javascript:confirm_deleteleave(<?php echo $row[4]; ?>);" > Delete </a></td>

        </tr>
    <?php } ?>
        </table> </div > 
    <!--end of view Leave Record-->

    <!-- new Salary-->
    <div id="new_salary" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>

        <form method="post" class="signin" action="new_salary.php">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Salary</p><br />

                <table border="1" cellpadding="4" cellspacing="0">
                    <tr>
                        <td colspan="10">

                            Year:
                            <select name="year" id="year" size="1">
                                <option value=" " selected="selected">-Year-</option>
                            </select>

                            Month:
                            <select name="month" id="month" size="1" onchange="caldays();">
                                <option value=" " selected="selected">-Month-</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>

                            Days of Month:
                            <input name="day1" id="day1" style="width:40px;" readonly="readonly">
                        </td>
                    </tr>

                    <tr>
                        <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="name">Full Name</label></th>
                        <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="basic">Basic</label>
                        </th>
                        <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="prs">Present </label>
                        </th>
                        <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="abs">Absent </label>
                        </th>
                        <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="pay">Payable </label>
                        </th>
                        <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="all">Allowance
                            </label></th>
                        <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="ot">OT </label></th>
                        <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="ded">Deduction
                            </label></th>
                        <th style="color:#ac0404; font-size:14px; font-weight:bold;"><label class="net">Net </label>
                        </th>
                    </tr>
                    <?php
                        $result1 = mysqli_query($con, "select * from staff_master ");
                        while ($row1 = mysqli_fetch_row($result1)) {
                            $result2 = mysqli_query($con, "SELECT count(`present`) FROM `attendence` WHERE staff_id=$row1[0] and present='No'");
                            $row2 = mysqli_fetch_row($result2);

                            $result3 = mysqli_query($con, "SELECT count(`present`) FROM `attendence` WHERE staff_id=$row1[0] and present='Yes'");
                            $row3 = mysqli_fetch_row($result3);
                        ?>
                    <tr>
                        <td><?php echo $row1[1]; ?></td>
                        <td><?php echo $row1[17]; ?></td>
                        <td><?php echo $row3[0]; ?></td>
                        <td><?php echo $row2[0]; ?></td>
                        <td><input name="" type="text" style="width:70px;" /></td>
                        <td><input name="" type="text" style="width:70px;" /></td>
                        <td><input name="" type="text" style="width:70px;" /></td>
                        <td><input name="" type="text" style="width:70px;" /></td>
                        <td><input name="" type="text" style="width:70px;" /></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="10"><button class="submit formbutton" type="submit">Submit</button></td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
    <!-- End of new salary-->


    <!-- View Salary-->
    <div id="view_salary" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>

        <form method="post" class="signin" action="view_salary.php">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Salary</p><br />

                Month: <input id="mn" name="mn" type="text" style="width:75px">
                Total net:<input id="tn" name="tn" type="text" style="width:75px"> </br></br>

                <table border="1">
                    <tr>
                        <td><label class="name">Full Name</label></td>
                        <td><label class="basic">Basic</label></td>
                        <td><label class="prs">Present </label></td>
                        <td><label class="abs">Absent </label></td>
                        <td><label class="pay">Payable </label></td>
                        <td><label class="all">Allowance </label></td>
                        <td><label class="ot">OT </label></td>
                        <td><label class="ded">Deduction </label></td>
                        <td><label class="net">Net </label></td>
                        <td><label class="Remarks">Remarks</label></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="10"><button class="submit formbutton" type="submit">Submit</button></td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
    //
    <!-- End of view salary-->


    <!--Vew Surgery Details-->
    <div id="view_surgery" class="login-popup">
    </div>
    </div>
    
    <!--end of view Surgery Details-->



   
    // <!--New Complaints-->
    <div id="new_complaint" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>

        <form method="post" class="signin" action="new_comp.php" name="compform">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Complaints</p><br />

                <label class="name">
                    <span>Complaint Name :</span>
                    <input id="compname" name="compname" type="text">
                </label>

                <button class="submit formbutton" type="submit">Submit</button>

            </fieldset>
        </form>
    </div>
    //
    <!--End of New Complaints-->

    <script type="text/javascript">
    function confirm_deletecomp(id) {
        if (window.confirm("Are you sure you want to delete this entry?")) {
            window.location = "delete_complaint.php?id=" + id;
        }
    }
    </script>
 
    <!--View Complaint-->
    <?php
       
        $result66 = mysqli_query($con, "select * from compla");
        ?>
    <div id="view_complaint" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>

        <form method="post" class="signin" action="view_find.php" name="viewfindform">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Complaints</p><br />

                <table border="1">

                    <th style="color:#ac0404; font-size:14px; font-weight:bold;"> ID </th>
                    <th style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
                    <th style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>
                    <th style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>

                    <?php while ($row66 = mysqli_fetch_row($result66)) {
                        ?>
                    <tr>

                        <td width="55">
                            <?php echo $row66[1]; ?>
                        </td>
                        <td width="110">
                            <?php echo $row66[0]; ?>
                        </td>
                        <td> <a href='edit_complaint.php?id=<?php echo $row66[1]; ?>'> Edit </a></td>
                        <td> <a href="javascript:confirm_deletecomp(<?php echo $row66[1]; ?>);"> Delete </a></td>
                    </tr>
                    <?php } ?>
                </table>


            </fieldset>
        </form>
    </div>
    <!--/* End of View Complaint */-->
    <!--/* New Advise */-->
    <div id="new_advise" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>

        <form method="post" class="signin" action="new_advise.php" name="adviseform">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Advise</p><br />

                <label class="name">
                    <span>Advise Name :</span>
                    <input id="advisename" name="advisename" type="text">
                </label>

                <button class="submit formbutton" type="submit">Submit</button>

            </fieldset>
        </form>
    </div>
    <!--/* End of New Advise */-->
    <!--/* New Medical Store */-->
    <div id="new_advise" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>

        <form method="post" class="signin" action="new_medical.php" name="medicalform">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Medical Store</p><br />

                <label class="name">
                    <span>Medical Store Name :</span>
                    <input id="medicalname" name="medicalname" type="text">
                </label>
                <label class="name">
                    <span>Address :</span>
                    <input id="medicaladdress" name="medicaladdress" type="text">
                </label>
                <label class="name">
                    <span>Phone :</span>
                    <input id="medicalphone" name="medicalphone" type="text">
                </label>

                <button class="submit formbutton" type="submit">Submit</button>

            </fieldset>
        </form>
    </div>
    <!--End of New Medical Store -->

    <script type="text/javascript">
    function confirm_deleteadvise(id) {
        if (window.confirm("Are you sure you want to delete this entry?")) {
            window.location = "delete_advise.php?id=" + id;
        }
    }
    </script>




    <!--View Advise -->
    <?php
        // include ('config.php');
        $result67 = mysqli_query($con, "select * from advise");
        ?>
    <div id="view_advise" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>

        <form method="post" class="signin" action="view_advise.php" name="viewadviseform">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Advise</p><br />

                <table border="1">

                    <th style="color:#ac0404; font-size:14px; font-weight:bold;"> ID </th>
                    <th style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
                    <th style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>
                    <th style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>

                    <?php while ($row67 = mysqli_fetch_row($result67)) {
                        ?>
                    <tr>

                        <td width="55">
                            <?php echo $row67[1]; ?>
                        </td>
                        <td width="110">
                            <?php echo $row67[0]; ?>
                        </td>
                        <td> <a href='edit_advise.php?id=<?php echo $row67[1]; ?>'> Edit </a></td>
                        <td> <a href="javascript:confirm_deleteadvise(<?php echo $row67[1]; ?>);"> Delete </a></td>
                    </tr>
                    <?php } ?>
                </table>


            </fieldset>
        </form>
    </div>
    //
    <!--End of View Advise-->

    /* New OPD Bill Data */
    <div id="opd_bill" class="login-popup">
        <?php
            // include ('config.php');
            $result = mysqli_query($con, "select *from opdbill");
            $row = mysqli_fetch_row($result)
            ?>

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>

        <form method="post" class="signin" action="update_opdbill.php" name="opdbillform">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">OPD Bill Data</p><br />

                <table>
                    <tr>
                        <td><label class="consultation">Consultation: </label></td>
                        <td><input id="con" name="con" type="text" value="<?php echo $row[0]; ?>"></td>
                    </tr>

                    <tr>
                        <td><label class="follow">Follow Up: </label></td>
                        <td><input id="fol" name="fol" type="text" value="<?php echo $row[1]; ?>"></td>
                    </tr>

                    <tr>
                        <td><label class="Xray">Xray: </label></td>
                        <td><input id="xray" name="xray" type="text" value="<?php echo $row[2]; ?>"></td>
                    </tr>

                    <tr>
                        <td><label class="dressing">Dressing: </label></td>
                        <td><input id="dr" name="dr" type="text" value="<?php echo $row[3]; ?>"></td>
                    </tr>

                    <tr>
                        <td><label class="strapping">Strapping: </label></td>
                        <td><input id="str" name="str" type="text" value="<?php echo $row[4]; ?>"></td>
                    </tr>

                    <tr>
                        <td><label class="ecg">ECG: </label></td>
                        <td><input id="ecg" name="ecg" type="text" value="<?php echo $row[5]; ?>"></td>
                    </tr>

                    <tr>
                        <td><button class="submit formbutton" type="submit">Submit</button></td>
                    </tr>
                </table>

            </fieldset>
        </form>
    </div>
    /* End of New opdbill */

    <!--New Medicine-->
    <div id="medicine" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>

        <form method="post" class="signin" action="new_medicine.php" name="medform">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Medicine</p><br />

                <label class="med">
                    <span>Medicine Name :</span>
                    <input id="medname" name="medname" type="text">
                </label>

                <button class="submit formbutton" type="submit">Submit</button>

            </fieldset>
        </form>
    </div>
    <!--End of New Medicine-->

    <!--New Instructions-->
    <div id="new_inst" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window"
                alt="Close" /></a>

        <form method="post" class="signin" action="new_inst.php" name="medform">
            <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Dosage Instruction</p>
                <br />

                <label class="inst">
                    <span>Dosage Instructions :</span>
                    <input id="inst" name="inst" type="text">
                </label>

                <button class="submit formbutton" type="submit">Submit</button>

            </fieldset>
        </form>
    </div>
    <!--End of New Instructions-->

    <!--New Room-->

</body>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/ajax-dynamic-list.js"></script>


</html>
<?php
} else {
    header("location: index.html");
}

?>