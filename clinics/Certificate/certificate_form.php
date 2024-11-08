<?php
include '../config.php';

$sql = "select id from emp_cert_details";
$sql_qry = mysqli_query($con, $sql);
$sql_res_count = mysqli_num_rows($sql_qry);
?>

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
            <form method="post" class="certificate-form" id="invoiceForm" action="process_certificate_form.php" enctype="multipart/form-data">
                <p style="color:#ffffff; font-weight:bold; font-size:30px;" align="center">Medical Fitness Certificate</p>
                <hr />

                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label >Certificate No. :</label></td>
                            <td><input id="certificate_no" name="certificate_no" type="text" class="form-control input-control" value="<?php if (!empty($sql_res_count)) {
                                                                                                                                            echo $sql_res_count + 1;
                                                                                                                                        } else
                                                                                                                                            echo '1'; ?>" readonly></td>
                        </tr>
                        <tr>
                            <td><label>Date :</label></td>
                            <td><input required id="date" name="date" type="date" class="form-control input-control">
                            </td>
                        </tr>

                        <tr>
                            <td><label>Mr./Mrs./Ku. :</label></td>
                            <td width="168"><input required id="name" name="name" type="text" class="form-control input-control">
                            </td>
                        </tr>

                        <tr>
                            <td><label>S/D/W of :</label></td>
                            <td width="168"><input required id="relative_name" name="relative_name" type="text" class="form-control input-control">
                            </td>
                        </tr>

                        <tr>
                            <td><label class="age">Age :</label></td>
                            <td><input required id="age" name="age" type="text" class="form-control input-control"></td>
                        </tr>

                        <tr>
                            <td><label class="gender">Gender :</label></td>
                            <td>
                                <select required id="gender" name="gender" class="form-control input-control">
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label>Address :</label></td>
                            <td><textarea required name="address" rows="5" cols="50" class="form-control input-control" style="resize:none;"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td><label>Employee No. :</label></td>
                            <td><input required id="employee_no" name="employee_no" type="text" class="form-control input-control" value=""></td>
                        </tr>

                        <tr>
                            <td><label>Upload Passport Size Photo :</label></td>
                            <td><input required id="passport_photo" value="" name="passport_photo" type="file" class="form-control input-control" onchange="preview()"></td>
                        </tr>

                    </table>

                    <div class="preview-image">
                        <img id="thumb" src="./assets/images/no-image.jpeg" width="200px" height="200px" />
                    </div>
                </div>

                <!-- Details of Medical Examination -->
                <br>
                <p><label style="color:white"><b>* Details of Medical Examination *</b></label></p>

                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>
                        <p><label style="color:white">A. General Examination</label></p>
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
                                <td><label>Height :</label></td>
                                <td><input name="height" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Weight :</label></td>
                                <td><input name="weight" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Pallor :</label></td>
                                <td><input name="pallor" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Edema :</label></td>
                                <td><input name="edema" type="text" class="form-control"></td>
                            </tr>

                            <th>* Investigation - </th>

                            <tr class="data-row">
                                <td><label>Hb :</label></td>
                                <td><input name="hb" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Blood Grouping/RH Factor :</label></td>
                                <td><input name="blood_grouping_factor" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Blood Sugar :</label></td>
                                <td><input name="blood_sugar" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Sickling :</label></td>
                                <td><input name="sickling" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Other :</label></td>
                                <td><input name="ge_other1" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Urine R/M :</label></td>
                                <td><input name="urina_rm" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>X-Ray Chest :</label></td>
                                <td><input name="xray_chest" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>ECG :</label></td>
                                <td><input name="ecg" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Other :</label></td>
                                <td><input name="ge_other2" type="text" class="form-control"></td>
                            </tr>
                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <p><label style="color:white">B. Systemic Examination </label></p>
                        <table>
                            <tr class="data-row">
                                <td><label>Eye :</label></td>
                                <td><input name="eye" type="text" class="form-control"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Vision :</label></td>
                                <td><input name="vision" type="text" class="form-control"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Colour Vision:</label></td>
                                <td><input name="colour_vision" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Other :</label></td>
                                <td><input name="se_other1" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>ENT :</label></td>
                                <td><input name="ent" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Hearing :</label></td>
                                <td><input name="hearing" type="text" class="form-control"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Other :</label></td>
                                <td><input name="se_other2" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Orthopedic :</label></td>
                                <td><input name="orthopedic" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Gait :</label></td>
                                <td><input name="gait" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Abnormality :</label></td>
                                <td><input name="abnormality" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Medical :</label></td>
                                <td><input name="medical" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Gynae :</label></td>
                                <td><input name="gynae" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Surgical :</label></td>
                                <td><input name="surgical" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Dental :</label></td>
                                <td><input name="dental" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Other :</label></td>
                                <td><input name="se_other3" type="text" class="form-control"></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr />

                <div class="mark-section">
                    <div>
                        <table>
                            <tr class="data-row">
                                <td><label>Identification Mark :</label></td>
                                <td><input name="identification_mark" type="text" class="form-control" /></td>
                            </tr>

                        </table>
                    </div>
                    <div>
                        <table>
                            <tr class="data-row">
                                <td><label>Remark :</label></td>
                                <td><input name="remark" type="text" class="form-control" /></td>
                            </tr>

                        </table>
                    </div>
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
</body>

</html>