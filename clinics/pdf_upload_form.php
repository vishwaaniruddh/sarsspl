<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pdf Upload Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        #form-parent {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .form-container {
            background: #e3cbb1;
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
            margin-bottom: 15px;
        }

        .input-control {
            width: 145%;
        }

        .label-control {
            width: 180px;
        }
    </style>
</head>

<body>
    <div id="form-parent">
        <div class="form-container">
            <form method="post" class="certificate-form" id="invoiceForm" action="process_pdf_upload_form.php" enctype="multipart/form-data">
                <p style="color:#ffffff; font-weight:bold; font-size:30px;" align="center">PDF'S UPLOAD FORM</p>
                <hr />

                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label class="label-control">1. E.C.G :</label></td>
                            <td><input id="ecg" value="" name="ecg" type="file" class="form-control input-control"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Submit" name="submit_ecg" class="btn btn-success" onclick="validate();">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label class="label-control">2. AUDIO :</label></td>
                            <td><input id="audio" value="" name="audio" type="file" class="form-control input-control"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Submit" name="submit_audio" class="btn btn-success" onclick="validate();">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label class="label-control">3. EYE :</label></td>
                            <td><input id="eye" value="" name="eye" type="file" class="form-control input-control"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Submit" name="submit_eye" class="btn btn-success" onclick="validate();">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label class="label-control">4. SPIRO :</label></td>
                            <td><input id="spiro" value="" name="spiro" type="file" class="form-control input-control"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Submit" name="submit_spiro" class="btn btn-success" onclick="validate();">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label class="label-control">5. X-RAY :</label></td>
                            <td><input id="x_ray" value="" name="x_ray" type="file" class="form-control input-control"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Submit" name="submit_x_ray" class="btn btn-success" onclick="validate();">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label class="label-control">6. CBC WITH FSR :</label></td>
                            <td><input id="cbc_with_fsr" value="" name="cbc_with_fsr" type="file" class="form-control input-control"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Submit" name="submit_cbc_with_fsr" class="btn btn-success" onclick="validate();">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label class="label-control">7. BLOOD GROUP :</label></td>
                            <td><input id="blood_group" value="" name="blood_group" type="file" class="form-control input-control"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Submit" name="submit_blood_group" class="btn btn-success" onclick="validate();">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label class="label-control">8. LIPID PROFILE :</label></td>
                            <td><input id="lipid_profile" value="" name="lipid_profile" type="file" class="form-control input-control"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Submit" name="submit_lipid_profile" class="btn btn-success" onclick="validate();">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label class="label-control">9. GGT :</label></td>
                            <td><input id="ggt" value="" name="ggt" type="file" class="form-control input-control"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Submit" name="submit_ggt" class="btn btn-success" onclick="validate();">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label class="label-control">10. STOOL R/M :</label></td>
                            <td><input id="stool_rm" value="" name="stool_rm" type="file" class="form-control input-control"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Submit" name="submit_stool_rm" class="btn btn-success" onclick="validate();">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                 <div class="basic-details">
                    <table>
                        <tr>
                            <td><label class="label-control">11. LAB INVESTIGATION :</label></td>
                            <td><input id="lab_invest" value="" name="lab_invest" type="file" class="form-control input-control"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Submit" name="submit_lab_invest" class="btn btn-success" onclick="validate();">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div> 
                <!-- <div class="basic-details">
                    <table>
                        <tr>
                            <td><label class="label-control">8. FORM-21 :</label></td>
                            <td><input id="form_21" value="" name="form_21" type="file" class="form-control input-control"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Submit" name="submit" class="btn btn-success" onclick="validate();">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div> -->

            </form>
        </div>
    </div>

</body>

</html>