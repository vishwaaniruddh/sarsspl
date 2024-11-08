<?php
include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Certificate Form</title>
    <!--Datepicker-->
    <script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        #form-parent {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .form-container {
            background: #7d8ae1;
            padding: 10px;
            border: 2px solid #ac0404;
            float: left;
            font-size: 1.2em;
            position: relative;
            top: 0%;
            left: 3%;
            z-index: 99999;
            box-shadow: 0px 0px 20px #999;
            /* CSS3 */
            -moz-box-shadow: 0px 0px 20px #999;
            /* Firefox */
            -webkit-box-shadow: 0px 0px 20px #999;
            /* Safari, Chrome */
            border-radius: 3px 3px 3px 3px;
            -moz-border-radius: 3px;
            /* Firefox */
            -webkit-border-radius: 3px;
            /* Safari, Chrome */

            display: flex;
            justify-content: center;
            align-items: center;
            width: 80%;
            border-radius: 10px;
        }

        .form-container .certificate-form {
            width: 100%;
            height: 100%;
        }

        .basic-details {
            padding: 0px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .basic-details .preview-image {
            width: 220px;
            height: 220px;
            border: 1px solid;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .input-control {
            width: 145%;
        }

        .details-section {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-around;
            /* align-items: center; */
        }

        .details-section div {
            width: 35%;
            display: flex;
            flex-direction: column;
        }

        .details-section div table {
            width: 100%;
        }

        .details-section div table tr {
            width: 100%;
        }

        .details-section div table tr td {
            width: 50%;
        }

        .mark-section {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .mark-section div {
            width: 35%;
            display: flex;
        }

        .mark-section div table {
            width: 100%;
        }

        .mark-section div table tr {
            width: 100%;
        }

        .mark-section div table tr td {
            width: 50%;
        }
    </style>
</head>


<!--  Medical fitness Certificate Form -->

<body>
    <div id="form-parent">
        <div class="form-container">
            <form method="post" class="certificate-form" action="process_discharge_summary_form.php" enctype="multipart/form-data">
                <p style="color:#ffffff; font-weight:bold; font-size:30px;" align="center">Discharge Summary Form
                </p>
                <hr />
                <?php
                $ipdsql = mysqli_query($con, "select id from newdischarge_summary order by id desc limit 1");
                $ipdbill_res = mysqli_fetch_row($ipdsql);
                $id = $ipdbill_res[0];

                $idd = $id + 1;


                ?>

                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label class="fdiag">Bill No. :</label></td>
                            <td>
                                <input id="bill_no" name="bill_no" type="text" class="form-control" value="<?= $idd; ?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="indoor_reg_no">Indoor Reg. No. </label></td>
                            <td><input type="text" id="indoor_reg_no" name="indoor_reg_no" class="form-control"></td>
                        </tr>



                        <tr>
                            <td><label class="fdiag">Payment Method :</label></td>
                            <td>
                                <select name="payment_mode" id="payment_mode" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Cash">Cash</option>
                                    <option value="ESI">ESI</option>
                                    <option value="Ayushman">Ayushman</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="bed_no">Bed No.</label></td>
                            <td><input type="text" id="bed_no" class="form-control" name="bed_no"></td>
                        </tr>


                        <tr>
                            <td width="306">Full Name :</td>
                            <td width="168"><input id="name" name="name" type="text" class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <td><label class="age">Age :</label></td>
                            <td><input id="age" name="age" type="text" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><label class="gender">Gender :</label></td>
                            <td>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="pro_diag">Address :</label></td>
                            <td><textarea name="address" rows="5" cols="50" class="form-control" style="resize:none;"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="city">City</label></td>
                            <td><input type="text" class="form-control" id="city" name="city"></td>
                        </tr>

                        <tr>
                            <td><label>Contact No:</label></td>
                            <td> <input id="contact_no" name="contact_no" type="text" class="form-control" maxlength="10"></td>
                        </tr>

                        <tr>
                            <td><label for="discharge_type">Discharge Type</label></td>
                            <td>
                                <input type="text" name="discharge_type" id="discharge_type" class="form-control">

                            </td>
                        </tr>


                        <tr>
                            <td><label>Date of Admission :</label></td>
                            <td><input id="add_date" name="add_date" type="date" class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <td><label>Time of Admission :</label></td>
                            <td><input id="add_time" name="add_time" type="time" class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <td><label>Primary Consultant Dr :</label></td>
                            <td>
                                <select name="consult_doc" id="consult_doc" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                    $sql = mysqli_query($con, "select doc_id,name from doctor");

                                    while ($sql_result = mysqli_fetch_assoc($sql)) { ?>
                                        <option value="<?php echo $sql_result['name']; ?>">
                                            <?php echo $sql_result['name']; ?>
                                        </option>

                                    <?php }

                                    ?>
                                </select>
                            </td>
                            <td><input type="text" name="dept1" id="dept1" class="form-control" placeholder="Department"></td>
                        </tr>

                        <tr>
                            <td><label> Consultant Doctor 1:</label></td>
                            <td>
                                <select name="consult_doc_1" id="consult_doc_1" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                    $sql = mysqli_query($con, "select doc_id,name from doctor");

                                    while ($sql_result = mysqli_fetch_assoc($sql)) { ?>
                                        <option value="<?php echo $sql_result['name']; ?>">
                                            <?php echo $sql_result['name']; ?>
                                        </option>

                                    <?php }

                                    ?>
                                </select>
                            </td>
                            <td><input type="text" name="dept2" id="dept2" class="form-control" placeholder="Department"></td>

                        </tr>

                        <tr>
                            <td><label> Consultant Doctor 2 :</label></td>
                            <td>
                                <select name="consult_doc_2" id="consult_doc_2" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                    $sql = mysqli_query($con, "select doc_id,name from doctor");

                                    while ($sql_result = mysqli_fetch_assoc($sql)) { ?>
                                        <option value="<?php echo $sql_result['name']; ?>">
                                            <?php echo $sql_result['name']; ?>
                                        </option>

                                    <?php }

                                    ?>
                                </select>
                            </td>
                            <td><input type="text" name="dept3" id="dept3" class="form-control" placeholder="Department"></td>

                        </tr>

                        <tr>
                            <td><label>Date of DisCharges :</label></td>
                            <td><input id="datedis" name="datedis" type="date" class="form-control"></td>
                        </tr>

                        <tr>
                            <td><label>Time of DisCharges :</label></td>
                            <td><input id="timedis" name="timedis" type="time" class="form-control"></td>
                        </tr>

                        <tr>
                            <td><label for="diagnosis">Diagnosis :</label></td>
                            <td><textarea name="diagnosis" id="diagnosis" rows="2" cols="50" class="form-control" onkeypress="handleEnterKey(event)"></textarea></td>
                        </tr>

                        <tr>
                            <td><label for="chief_complain">Chief Complain :</label></td>
                            <td><textarea name="chief_complain" id="chief_complain" rows="2" cols="50" class="form-control" onkeypress="handleEnterKey(event)"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="h_o">H/O :</label></td>
                            <td><textarea name="h_o" id="h_o" rows="2" cols="50" class="form-control" onkeypress="handleEnterKey(event)"></textarea>
                            </td>
                        </tr>

                    </table>

                </div>

                <!-- Details of Medical Examination -->
                <br>
                <p><label style="color:white"><b>* Clinical Examination on Addmission *</b></label></p>

                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>
                        <!-- <p><label style="color:white">A. General Examination</label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Pulse :</label></td>
                                <td><input name="pulse" type="text" class="form-control"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>BP :</label></td>
                                <td><input name="bp" type="text" class="form-control"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Temp :</label></td>
                                <td><input name="temp" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>R/R :</label></td>
                                <td><input name="rr" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>SPO2 :</label></td>
                                <td><input name="spo2" type="text" class="form-control"></td>
                            </tr>



                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>CVS :</label></td>
                                <td><input name="cvs" type="text" class="form-control"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>CNS :</label></td>
                                <td><input name="cns" type="text" class="form-control"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>RS:</label></td>
                                <td><input name="rs" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>P/A :</label></td>
                                <td><input name="p_a" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Local Examination :</label></td>
                                <td><input name="local_examination" type="text" class="form-control"></td>
                            </tr>

                        </table>
                    </div>

                </div>

                <hr />

                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label>Investigation :</label></td>
                            <td><textarea name="investigation" id="investigation" class="form-control" rows="2" cols="50" onkeypress="handleEnterKey(event)"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td><label>Operation Details :</label></td>
                            <td><textarea name="operation_details" id="operation_details" class="form-control" rows="2" cols="50" onkeypress="handleEnterKey(event)"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td><label>Course in Hospital :</label></td>
                            <td><textarea name="course_hospital" id="course_hospital" rows="2" cols="50" class="form-control" onkeypress="handleEnterKey(event)"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td><label>Condition During Discharge :</label></td>
                            <td><textarea name="cond_discharge" id="cond_discharge" rows="2" cols="50" class="form-control" onkeypress="handleEnterKey(event)"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td><label>Medicine Advised At Discharge :</label></td>
                            <td><textarea name="med_adv_discharge" id="med_adv_discharge" class="form-control" rows="2" cols="50" onkeypress="handleEnterKey(event)"></textarea>
                            </td>
                        </tr>



                    </table>

                </div>




                <br />
                <div class="d-flex justify-content-center">
                    <input type="submit" value="Submit" name="submit" class="btn btn-success" onclick="validate();">
                </div>
            </form>

            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </div>
    </div>

    <!-- add script code here -->
    <script>
        function preview() {
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }

        function validate() {
            var form = document.getElementById('invoiceForm');
            with(form) {
                if (date.value == '') {
                    alert("Please Enter Date");
                    date.focus();
                    return;
                }
                if (name.value == '') {
                    alert("Please Enter Name");
                    name.focus();
                    return;
                }

                if (relative_name.value == '') {
                    alert("Please Enter Relative Name");
                    relative_name.focus();
                    return;
                }

                if (age.value == '') {
                    alert("Please Enter Your age.");
                    age.focus();
                    return;
                }

                if (gender.value == '') {
                    alert("Select Gender");
                    gender.focus();
                    return;
                }

                if (employee_no.value == '') {
                    alert("Please Enter Employee Number");
                    employee_no.focus();
                    return;
                }

                if (address.value == '') {
                    alert("Please Enter address");
                    address.focus();
                    return;
                }

                if (passport_photo.value == '') {
                    alert("Please Upload Passport Size Photo");
                    passport_photo.focus();
                    return;
                }

                form.submit();
            }
        }
    </script>
    <script>
        function handleEnterKey(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                var textarea = event.target;
                var start = textarea.selectionStart;
                var end = textarea.selectionEnd;
                var value = textarea.value;

                // Insert newline character at the cursor position
                //textarea.value = value.substring(0, start) + '\n' + value.substring(end);
                //textarea.selectionStart = textarea.selectionEnd = start + 1; // Move cursor to the new line

                textarea.value = value.substring(0, start) + '<br>' + value.substring(end);
                textarea.selectionStart = textarea.selectionEnd = start + 4; // Move cursor after <br>

                // Optionally, you can remove any <br> tags that were previously inserted
                //textarea.value = textarea.value.replace(/<br>/g, '');
            }
        }
    </script>

</body>

</html>