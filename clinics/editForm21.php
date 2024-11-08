<?php
include 'config.php'; 

// var_dump($_SESSION['SESS_USER_NAME']);


// function getfevbyfvc($measured,$predicted){
    
//     if($predicted=0||$predicted='' || $measured=0||$measured=''){
//         return 0;
//     } else {
//         $calculatedfev_fvc = (($measured/$predicted) * 100);
//         return round($calculatedfev_fvc,2);
//     }

//     // $calculatedfev_fvc = (($measured/$predicted) * 100);
//     // return round($calculatedfev_fvc,2);
// }

// function getpercentofpredicted($measured,$predicted){
    
//     $calculatedpercent = (($measured/$predicted) * 100);
//     return round($calculatedpercent,2);
// }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>EDIT FORM 21</title>
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
            <form method="post" class="certificate-form" action="updateprocess_form21.php" enctype="multipart/form-data">
                <p style="color:#ffffff; font-weight:bold; font-size:30px;" align="center">Medical Examination Form
                </p>
                <hr />
                <?php
                // $ipdsql = mysqli_query($con, "select id from newdischarge_summary order by id desc limit 1");
                // $ipdbill_res = mysqli_fetch_row($ipdsql);
                // $id = $ipdbill_res[0];

                // $idd = $id + 1;
                
                $idd = $_GET['id'];
                
                
                
                $reportsql = mysqli_query($con, "select * from report where id = '$idd' ");
                $reportsql_result = mysqli_fetch_assoc($reportsql);
                
                $predicted_fvc = $reportsql_result['predicted_fvc'];
                $predicted_fev = $reportsql_result['predicted_fev'];
                $predicted_fvc_fev = $reportsql_result['predicted_fvc_fev'];
                
                $measured_fvc = $reportsql_result['measured_fvc'];
                $measured_fev = $reportsql_result['measured_fev'];
                $measured_fvc_fev = $reportsql_result['measured_fvc_fev'];
                
                $percent_fvc = $reportsql_result['percent_fvc'];
                $percent_fev = $reportsql_result['percent_fev'];
                $percent_fvc_fev = $reportsql_result['percent_fvc_fev'];
                
                
                
                $form21Datasql = mysqli_query($con,"select * from form21_data where reports_id = '$idd' ");
                $form21Datasql_result = mysqli_fetch_assoc($form21Datasql);




                ?>
                <p><label style="color:white"><b> GENERAL INFORMATION </b></label></p>
                <div class="basic-details">

                    <table>

                        <tr>
                            <td width="306">Name of Certifying Surgeon:</td>
                            <td width="168">
                                <input id="certifying_person_name" name="certifying_person_name" type="text" class="form-control" value="<?=$form21Datasql_result['surgeon_name']?>" >
                                <input type="hidden" name="idd" id="idd" value="<?=$idd?>">
                            </td>
                        </tr>


                        <tr>
                            <td width="306">Full Name :</td>
                            <td width="240"><input id="name" name="name" type="text" class="form-control" value="<?=$reportsql_result['name']?>" >
                            </td>
                        </tr>
                        <tr>
                            <td width="306">Emp ID :</td>
                            <td width="168"><input id="empid" name="empid" type="text" class="form-control" value="<?=$form21Datasql_result['empid']?>">
                            </td>
                        </tr>

                        <tr>
                            <td><label class="age">Age :</label></td>
                            <td><input id="age" name="age" type="text" class="form-control" value="<?=$reportsql_result['age']?>" ></td>
                        </tr>
                        <tr>
                            <td><label class="gender">Gender :</label></td>
                            <td><input id="gender" name="gender" type="text" class="form-control" value="<?=$reportsql_result['sex']?>" ></td>
                        </tr>


                        <tr>
                            <td><label for="designation">Designation</label></td>
                            <td><input type="text" class="form-control" id="designation" name="designation" value="<?=$form21Datasql_result['designation']?>"" ></td>
                        </tr>

                        <tr>
                            <td><label for="aadhar_no">Aadhar No:</label></td>
                            <td> <input id="aadhar_no" name="aadhar_no" type="text" maxlength="12" class="form-control" value="<?=$form21Datasql_result['aadhar']?>"">
                            </td>
                        </tr>

                        <tr>
                            <td><label for="esic">ESIC</label></td>
                            <td>
                                <input type="text" name="esic" id="esic" class="form-control" value="<?=$form21Datasql_result['esic']?>"  >

                            </td>
                        </tr>
                        <tr>
                            <td><label class="gender">Type of Examination :</label></td>
                            <td>
                                <select id="exam_type" name="exam_type" class="form-control">
                                    <option value="">Select</option>
                                    <option value="PME" <?php if($form21Datasql_result['exam_type'] == 'PME') echo 'selected'; ?>>PME</option>
                                    <option value="PEME" <?php if($form21Datasql_result['exam_type'] == 'PEME') echo 'selected'; ?>>PEME</option>
                                </select>

                            </td>
                        </tr>

                        <tr>
                            <td><label for="last_pme_peme_date">Last PME/PEME Date :</label></td>
                            <td><input id="last_pme_peme_date" name="last_pme_peme_date" type="date" class="form-control" value="<?=$form21Datasql_result['last_pme_pmce_date']?>">
                            </td>
                        </tr>

                        <tr>
                            <td><label>Date of Examination :</label></td>
                            <td><input id="exam_date" name="exam_date" type="date" class="form-control"  value="<?=$form21Datasql_result['exam_date']?>">
                            </td>
                        </tr>

                        <tr>
                            <td><label>Date of Joining :</label></td>
                            <td><input id="join_date" name="join_date" type="date" class="form-control"  value="<?=$form21Datasql_result['join_date']?>">
                            </td>
                        </tr>

                        <tr>
                            <td><label>Department :</label></td>
                            <td><input id="dept" name="dept" type="text" class="form-control"  value="<?=$form21Datasql_result['department']?>">
                            </td>
                        </tr>




                    </table>

                </div>
                <hr>
                <!-- Details of Medical Examination -->
                <p><label style="color:white"><b>1. GENERAL EXAMINATION </b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>
                        <!-- <p><label style="color:white">A. General Examination</label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Height (cm) :</label></td>
                                <td><input type="text" name="height" id="height" class="form-control" value="<?=$reportsql_result['height']?>" onchange="calculateBmi()">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Weight (kg) :</label></td>
                                <td><input type="text" name="weight" id="weight" class="form-control" value="<?=$reportsql_result['weight']?>" onchange="calculateBmi()">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Inspiration (cm) :</label></td>
                                <td><input type="text" name="inspiration" value='5' id="inspiration" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Expiration (cm) :</label></td>
                                <td><input type="text" name="expiration" value='4' id="expiration" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td>
                                    <label for="built">Built:</label>
                                </td>
                                <td>
                                    <!--<select name="built" id="built" class="form-control">-->
                                    <!--    <option value="AVERAGE">Average</option>-->
                                    <!--    <option value="STRONG">Strong</option>-->
                                    <!--    <option value="POOR">Poor</option>-->
                                    <!--</select>-->
                                    <input type="text" name="built" value='Average' id="built" class="form-control">
                                </td>
                            </tr>
                            <tr class="data-row">
                                <td><label>BMI :</label></td>
                                <td><input type="text" name="bmi" id="bmi" class="form-control" value="<?=$reportsql_result['bmi']?>"></td>
                            </tr>
                            
                             <tr class="data-row">
                                <td><label>Thyroid :</label></td>
                                <td><input name="thyroid" id="thyroid" value="Normal" type="text" class="form-control"></td>
                            </tr>

                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Throat :</label></td>
                                <td><input name="throat" id="throat" value="Normal" type="text" class="form-control"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Tongue :</label></td>
                                <td><input name="tongue" id="tongue" value="Normal" type="text" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Tonsils :</label></td>
                                <td><input type="text" name="tonsils" id="tonsils" value="Normal" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Gums :</label></td>
                                <td><input type="text" name="gums" id="gums" class="form-control" value="Normal"></td>
                            </tr>


                            <tr class="data-row">
                                <td><label>Teeth:</label></td>
                                <td><input type="text" class="form-control" name="teeth" id="teeth" value="Normal"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Lymph Nodes : </label></td>
                                <td><input type="text" class="form-control" name="lymph_nodes" id="lymph_nodes" value="Non Palpable"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Additional Findings :</label></td>
                                <td> 
                                <!--<textarea name="additional_findings" id="additional_findings"-->
                                <!--        class="form-control"></textarea>-->
                                    <input type="text" name="additional_findings" id="additional_findings" class="form-control" value="Absent">
                                </td>
                            </tr>

                        </table>
                    </div>

                </div>
                <hr />

                <p><label style="color:white"><b>2. CARDIO-VASCULAR SYSTEM</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>Pulse :</label></td>
                                <td>
                                    <input type="text" name="pulse" id="pulse" class="form-control" value="<?=$reportsql_result['pulse']?>">
                                    
                                    <input type="text" name="pulse_type" id="pulse_type" value="Regular" class="form-control">
                                   
                            </tr>
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Pheripheral Pulse :</label></td>
                                <td>
                                   
                                    <input type="text" name="pher_pulse" id="pher_pulse" value="Felt" class="form-control">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>BP :</label></td>
                                <td><input type="text" name="bp" id="bp" class="form-control" value="<?=$reportsql_result['bp']?>" ></td>
                            </tr>



                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label for="heart_rate">Heart Sound:</label></td>
                                <td>
                                    
                                    <input type="text" name="heart_rate" id="heart_rate" value="Normal" class="form-control">
                                </td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Murmur :</label></td>
                                <td><input type="text" name="murmur" id="murmur" value="Absent" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Additional Findings, If Any :</label></td>
                                <td> 
                                  
                                    <input type="text" name="additional_findings_1" id="additional_findings_1" class="form-control" value="Absent">
                                </td>
                            </tr>



                        </table>
                    </div>

                </div>
                <hr>

                <p><label style="color:white"><b>3. RESPIRATORY SYSTEM</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>Shape of Chest :</label></td>
                                <td>
                                     <input type="text" name="chest_shape" id="chest_shape" value="Normal" class="form-control"> 
                                    
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Chest Movement :</label></td>
                                <td>
                                  
                                    <input type="text" name="chest_movement" id="chest_movement" value="Normal" class="form-control">
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Trachea :</label></td>
                                <td><input type="text" name="trachea" id="trachea" class="form-control" value="Normal"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label for="breath_sound">Breath Sounds:</label></td>
                                <td>
                                    <!--<select name="breath_sound" id="breath_sound" class="form-control">-->
                                    <!--    <option value="NORMAL">Normal</option>-->
                                    <!--    <option value="ABNORMAL">AbNormal</option>-->
                                    <!--</select>-->
                                    <input type="text" name="breath_sound" id="breath_sound" value="Normal" class="form-control">
                                </td>
                            </tr>

                        </table>
                    </div>

                </div>
                <hr>

                <p><label style="color:white"><b>4. GASTRO-INTESTINAL SYSTEM</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>Liver :</label></td>
                                <td>
                                    <input type="text" name="liver" id="liver" value="Non Palpable" class="form-control">

                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Spleen :</label></td>
                                <td>
                                    <input type="text" name="spleen" id="spleen" value="Non Palpable" class="form-control">

                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Any Abdominal Lumps :</label></td>
                                <td><input type="text" name="abdominal_lumps" id="abdominal_lumps" value="Absent" class="form-control">
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
                <hr>

                <p><label style="color:white"><b>5. EXAMINATION OF EYES</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>
                        <table>
                            <tr class="data-row">
                                <td><label>External Exam :</label></td>
                                <td>
                                    <input type="text" name="ext_exam" id="ext_exam" value="Normal" class="form-control">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Squint :</label></td>
                                <td>
                                    <input type="text" name="squint" id="squint" value="Absent" class="form-control">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Nystagmus :</label></td>
                                <td><input type="text" name="nystagmus" id="nystagmus" value="Absent" class="form-control"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Color Vision :</label></td>
                                <td>
                                    <input type="text" name="color_vision" id="color_vision" value="Normal" class="form-control">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Fundus (L) (R) :</label></td>
                                <td><input type="text" name="fundus" id="fundus" value="Normal" class="form-control"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Distant Vision(Without Glass) :</label></td>
                                <td>
                                    <input type="text" name="distant_vision_without_left"
                                        id="distant_vision_without_left" placeholder="left" class="form-control" value="<?=$reportsql_result['distant_vision_without_left']?>">
                                    <input type="text" name="distant_vision_without_right"
                                        id="distant_vision_without_right" placeholder="right" class="form-control" value="<?=$reportsql_result['distant_vision_without_right']?>">
                                </td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Distant Vision(With Glass) :</label></td>
                                <td>
                                    <input type="text" name="distant_vision_with_left" id="distant_vision_with_left"
                                        placeholder="left" class="form-control" value="<?=$reportsql_result['distant_vision_with_left']?>">
                                    <input type="text" name="distant_vision_with_right" id="distant_vision_with_right"
                                        placeholder="right" class="form-control" value="<?=$reportsql_result['distant_vision_with_right']?>">
                                </td>
                            </tr>
                        </table>

                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Individual Colour Identification :</label></td>
                                <td><input type="text" name="color_identify" id="color_identify" value="Normal" class="form-control">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Night Blindness(Nyctalopia):</label></td>
                                <td><input type="text" name="night_blindness" id="night_blindness" value="Absent" class="form-control">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Near Vision(Without Glass) :</label></td>
                                <td>
                                    <input type="text" name="near_vision_without_left" id="near_vision_without_left"
                                        placeholder="left" class="form-control" value="<?=$reportsql_result['near_vision_without_left']?>">
                                    <input type="text" name="near_vision_without_right" id="near_vision_without_right"
                                        placeholder="right" class="form-control" value="<?=$reportsql_result['near_vision_without_right']?>">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Near Vision(With Glass) :</label></td>
                                <td>
                                    <input type="text" name="near_vision_with_left" id="near_vision_with_left"
                                        placeholder="left" class="form-control"  value="<?=$reportsql_result['near_vision_with_left']?>">
                                    <input type="text" name="near_vision_with_right" id="near_vision_with_right"
                                        placeholder="right" class="form-control"  value="<?=$reportsql_result['near_vision_with_right']?>">
                                </td>
                            </tr>

                        </table>
                    </div>

                </div>
                <hr>

                <p><label style="color:white"><b>6. EXAMINATION OF EAR,NOSE AND THROAT</b></label></p>
                <div class="basic-details">
                    <table>
                        <tr>
                            <td><label style="padding-right: 82px;">External Exam :</label></td>
                            <td><input type="text" name="ext_exam_ear_nose_throat" id="ext_exam_ear_nose_throat"
                                    value="Normal" class="form-control">
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>

                <p><label style="color:white"><b>7. GENITO URINARY SYSTEM</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>Cryptorchidism :</label></td>
                                <td>
                                    <input type="text" name="cryptorchidism" id="cryptorchidism" value="Absent" class="form-control">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Phimosis :</label></td>
                                <td>
                                    <input type="text" name="phimosis" id="phimosis" value="Absent" class="form-control">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Hernia :</label></td>
                                <td><input type="text" name="hernia" id="hernia" value="Absent" class="form-control"></td>
                            </tr>


                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Hydrocele/Variocele:</label></td>
                                <td><input type="text" name="hydro_vario" id="hydro_vario" value="Absent" class="form-control"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Variocose Veins:</label></td>
                                <td><input type="text" name="vario_veins" id="vario_veins" value="Absent" class="form-control"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Signs of STD:</label></td>
                                <td><input type="text" name="std" id="std" value="Absent" class="form-control"></td>
                            </tr>
                        </table>
                    </div>

                </div>
                <p><label style="color:white"><b>OTHER EXAMINATION FOR FEMALES</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>Menstrual History :</label></td>
                                <td>
                                    <input type="text" name="menstrual_history" id="menstrual_history"
                                        class="form-control"  value="<?=$form21Datasql_result['menstrual_history']?>">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Obstetric History :</label></td>
                                <td>
                                    <input type="text" name="obstetric_history" id="obstetric_history"
                                        class="form-control"  value="<?=$form21Datasql_result['obstetric_history']?>">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Menarche at(Yrs):</label></td>
                                <td><input type="text" name="menarche" id="menarche" class="form-control"  value="<?=$form21Datasql_result['menarche_at']?>"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Menstrual Irregularity,If Any:</label></td>
                                <td><input type="text" name="menstrual_irrregularity" id="menstrual_irrregularity"
                                        class="form-control"  value="<?=$form21Datasql_result['menstrual_irreg']?>"></td>
                            </tr>


                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Gravida:</label></td>
                                <td><input type="text" name="gravida" id="gravida" class="form-control"  value="<?=$form21Datasql_result['gravida']?>"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Para:</label></td>
                                <td><input type="text" name="para" id="para" class="form-control"  value="<?=$form21Datasql_result['para']?>"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>LMP:</label></td>
                                <td><input type="text" name="lmp" id="lmp" class="form-control" value="<?=$form21Datasql_result['lmp']?>"></td>
                            </tr>
                        </table>
                    </div>

                </div>
                <p><label style="color:white"><b>OTHER EXAMINATION FOR CANTEEN WORKERS</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>Widal :</label></td>
                                <td>
                                    <input type="text" name="widal" id="widal" class="form-control"  value="<?=$form21Datasql_result['widal']?>">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>HEP B :</label></td>
                                <td>
                                    <input type="text" name="hep_b" id="hep_b" class="form-control"  value="<?=$form21Datasql_result['hepb']?>">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Sputum for AFB :</label></td>
                                <td><input type="text" name="sputum_afb" id="sputum_afb" class="form-control"  value="<?=$form21Datasql_result['sputum']?>"></td>
                            </tr>


                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Skin Disease:</label></td>
                                <td><input type="text" name="skin_disease" id="skin_disease" class="form-control"  value="<?=$form21Datasql_result['skin_disease']?>"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>HIV:</label></td>
                                <td><input type="text" name="hiv" id="hiv" class="form-control"  value="<?=$form21Datasql_result['hiv']?>"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Worm Infection:</label></td>
                                <td><input type="text" name="worm_infection" id="worm_infection" class="form-control"  value="<?=$form21Datasql_result['worm_infection']?>">
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
                <hr>

                <p><label style="color:white"><b>INVESTIGATIONS</b></label></p>
                <p><label style="color:white"><b>8. LAB INVESTIGATIONS</b></label></p>
                <p><label style="color:white"><b>URINE</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>Albumin :</label></td>
                                <td>
                                    <input type="text" name="albumin" id="albumin" value="<?=$reportsql_result['albumin']?>" class="form-control">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Sugar :</label></td>
                                <td>
                                    <input type="text" name="sugar" id="sugar" value="<?=$reportsql_result['sugar']?>" class="form-control">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Microscopy-Pus Cells:</label></td>
                                <td><input type="text" name="miscroscopy_pus" id="miscroscopy_pus" class="form-control" value="<?=$reportsql_result['pus_cells']?>">
                                </td>
                            </tr>


                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Epith Cells:</label></td>
                                <td><input type="text" name="epith_cells" id="epith_cells" class="form-control" value="<?=$reportsql_result['epith_cells']?>"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Stools:</label></td>
                                <td><input type="text" name="stools" id="stools" value="Normal" class="form-control" value="<?=$reportsql_result['stools']?>"></td>
                            </tr>
                        </table>
                    </div>

                </div>

                <p><label style="color:white"><b>HAEMOGRAM</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>Blood Group :</label></td>
                                <td>
                                    <input type="text" name="blood_grp" id="blood_grp" class="form-control" value="<?=$reportsql_result['blood_group']?>">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>RH Factor :</label></td>
                                <td>
                                    <input type="text" name="rh_factor" id="rh_factor" class="form-control" value="<?=$reportsql_result['rh_factor']?>">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>HB(%):</label></td>
                                <td><input type="text" name="hb" id="hb" class="form-control" value="<?=$reportsql_result['hb']?>">
                                </td>
                            </tr>


                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>TLC:</label></td>
                                <td><input type="text" name="tlc" id="tlc" class="form-control" value="<?=$reportsql_result['tlc']?>"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>RBC:</label></td>
                                <td><input type="text" name="rbc" id="rbc" class="form-control" value="<?=$reportsql_result['rbc']?>"></td>
                            </tr>
                        </table>
                    </div>

                </div>

                <p><label style="color:white"><b>DLC</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>Neutrophils :</label></td>
                                <td>
                                    <input type="text" name="neutrophils" id="neutrophils" class="form-control" value="<?=$reportsql_result['neutrophils']?>">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Eosinophils :</label></td>
                                <td>
                                    <input type="text" name="eosinophils" id="eosinophils" class="form-control" value="<?=$reportsql_result['eosinophils']?>">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Basophils:</label></td>
                                <td><input type="text" name="basophils" id="basophils" class="form-control" value="<?=$reportsql_result['basophils']?>">
                                </td>
                            </tr>


                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Lymphocytes:</label></td>
                                <td><input type="text" name="lymphocytes" id="lymphocytes" class="form-control" value="<?=$reportsql_result['lymphocytes']?>"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Monocytes:</label></td>
                                <td><input type="text" name="monocytes" id="monocytes" class="form-control" value="<?=$reportsql_result['monocytes']?>"></td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Flatelets Count:</label></td>
                                <td><input type="text" name="flatelets_count" id="flatelets_count" class="form-control" value="<?=$reportsql_result['patelets_count']?>">
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>

                <p><label style="color:white"><b>LIPID PROFILE:</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>Serum Cholesterol :</label></td>
                                <td>
                                    <input type="text" name="serum_cholesterol" id="serum_cholesterol"
                                        class="form-control" value="<?=$reportsql_result['serum_cholesterol']?>">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>Triglycerides :</label></td>
                                <td>
                                    <input type="text" name="triglycerides" id="triglycerides" class="form-control" value="<?=$reportsql_result['striglycerides']?>">
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>HDL:</label></td>
                                <td><input type="text" name="hdl" id="hdl" class="form-control" value="<?=$reportsql_result['hdl']?>"></td>
                            </tr>

                            <tr class="data-row">
                                <td><label>LDL:</label></td>
                                <td><input type="text" name="ldl" id="ldl" class="form-control" value="<?=$reportsql_result['ldl']?>"></td>
                            </tr>

                        </table>
                    </div>

                </div>

                <p><label style="color:white"><b>HEPATIC PROFILE:</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>SGPT :</label></td>
                                <td>
                                    <input type="text" name="sgpt" id="sgpt" class="form-control" value="<?=$reportsql_result['sgpt']?>">
                                </td>
                            </tr>

                            <tr class="data-row">
                                <td><label>SGOT :</label></td>
                                <td>
                                    <input type="text" name="sgot" id="sgot" class="form-control" value="<?=$reportsql_result['sgot']?>">
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Alkaline Phosphate:</label></td>
                                <td><input type="text" name="alkaline_phosphate" id="alkaline_phosphate"
                                        class="form-control" value="<?=$reportsql_result['alkaline_phosphatase']?>"></td>
                            </tr>
                        </table>
                    </div>

                </div>

                <p><label style="color:white"><b>RENAL PROFILE:</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>Blood Urea :</label></td>
                                <td>
                                    <input type="text" name="blood_urea" id="blood_urea" class="form-control" value="<?=$reportsql_result['blood_urea']?>">
                                </td>
                            </tr>

                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Creatinine:</label></td>
                                <td><input type="text" name="creatinine" id="creatinine" class="form-control" value="<?=$reportsql_result['creatinine']?>"></td>
                            </tr>
                        </table>
                    </div>

                </div>

                <p><label style="color:white"><b>METABOLIC:</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>Blood Sugar(Fasting) :</label></td>
                                <td>
                                    <input type="text" name="blood_sugar_fasting" id="blood_sugar_fasting"
                                        class="form-control" value="<?=$reportsql_result['blood_sugar_f']?>">
                                </td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Blood Sugar(PP) :</label></td>
                                <td>
                                    <input type="text" name="blood_sugar_pp" id="blood_sugar_pp" class="form-control" value="<?=$reportsql_result['blood_sugar_pp']?>">
                                </td>
                            </tr>

                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>Uric Acid:</label></td>
                                <td><input type="text" name="uric_acid" id="uric_acid" class="form-control" value="<?=$reportsql_result['uric_acid']?>"></td>
                            </tr>
                        </table>
                    </div>

                </div>
                <hr>

                <p><label style="color:white"><b>9. OTHER INVESTIGATIONS:</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>X-RAY CHEST :</label></td>
                                <td>
                                    <input type="text" name="xray_chest" id="xray_chest" class="form-control" value="<?=$reportsql_result['x_ray_chest']?>">
                                </td>
                            </tr>
                            <tr class="data-row">
                                <td><label>ECG :</label></td>
                                <td>
                                    <input type="text" name="ecg" id="ecg" value="Normal" class="form-control" value="<?=$reportsql_result['ecg']?>">
                                </td>
                            </tr>

                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>USG Whole Abdomen:</label></td>
                                <td><input type="text" name="usg_whole_abdomen" id="usg_whole_abdomen"
                                        class="form-control"  value="<?=$form21Datasql_result['usg']?>" ></td>
                            </tr>
                        </table>
                    </div>

                </div>
                <hr>

                <p><label style="color:white"><b>10. PULMONARY FUNCTION TEST: Remarks</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>Predicted :</label></td>
                                <td>
                                    <input type="text" name="predicted_fvc" id="predicted_fvc" placeholder="FVC" class="form-control" value="<?=$reportsql_result['predicted_fvc']?>" onchange="calculateFvcFevi('predicted'); calculatePercentages();">
                                    <input type="text" name="predicted_fevi" id="predicted_fevi" placeholder="FEVI" class="form-control" value="<?=$reportsql_result['predicted_fev']?>" onchange="calculateFvcFevi('predicted'); calculatePercentages();">
                                    <input type="text" name="predicted_fvc_fevi" id="predicted_fvc_fevi" placeholder="FVC/FEVI" class="form-control" >
                                </td>
                            </tr>
                            <tr class="data-row">
                                <td><label>Measured :</label></td>
                                <td>
                                    <input type="text" name="measured_fvc" id="measured_fvc" placeholder="FVC" class="form-control" value="<?=$reportsql_result['measured_fvc']?>" onchange="calculateFvcFevi('measured'); calculatePercentages();">
                                    <input type="text" name="measured_fevi" id="measured_fevi" placeholder="FEVI" class="form-control" value="<?=$reportsql_result['measured_fev']?>" onchange="calculateFvcFevi('measured'); calculatePercentages();">
                                    <input type="text" name="measured_fvc_fevi" id="measured_fvc_fevi" placeholder="FVC/FEVI" class="form-control" >
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>% of Predicted :</label></td>
                                <td>
                                    <input type="text" name="percent_fvc" id="percent_fvc" placeholder="FVC" class="form-control" >
                                    <input type="text" name="percent_fevi" id="percent_fevi" placeholder="FEVI" class="form-control" >
                                    <input type="text" name="percent_fvc_fevi" id="percent_fvc_fevi" placeholder="FVC/FEVI" class="form-control" >
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
                <hr>

                <p><label style="color:white"><b>11. AUDIOMETRY:</b></label></p>
                <div class="details-section">
                    <!--  A. General Examination -->
                    <div>

                        <table>
                            <tr class="data-row">
                                <td><label>PTA Lt:</label></td>
                                <td>
                                    <input type="text" name="pta_lt" id="pta_lt" class="form-control"  value="<?=$reportsql_result['audio_pta_l']?>">
                                </td>
                            </tr>

                        </table>
                    </div>

                    <!-- B. Systemic Examination -->
                    <div>
                        <!-- <p><label style="color:white">B. Systemic Examination </label></p> -->
                        <table>
                            <tr class="data-row">
                                <td><label>PTA Rc:</label></td>
                                <td><input type="text" name="pta_rc" id="pta_rc" class="form-control" value="<?=$reportsql_result['audio_pta_r']?>"></td>
                            </tr>
                        </table>
                    </div>

                </div>
                <hr>

                <br />
                <div class="d-flex justify-content-center">
                    <input type="submit" value="Update" name="submit" class="btn btn-success">
                </div>
                <div class="d-flex justify-content-left">
                    <input type="submit" value="Back" name="back" class="btn btn-danger">
                </div>
            </form>

            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </div>
    </div>

    <!-- add script code here -->
    
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
    /*
    
    function getPercentOfPredictedfvcfev(measured, predicted) {
            if (predicted == 0) {
                return 0; // Avoid division by zero
            }
            const calculatedPercent = (measured / predicted) * 100;
            return calculatedPercent.toFixed(2); // Round to 2 decimal places
        }
    
    function calculateOnLoad() {
            const measuredValue = parseFloat(document.getElementById('measured_fvc_fevi').value);
            const predictedValue = parseFloat(document.getElementById('predicted_fvc_fevi').value);
            
            // alert(measuredValue)

             if (!isNaN(measuredValue) && !isNaN(predictedValue)) {
                const result = getPercentOfPredictedfvcfev(measuredValue, predictedValue);

                // Set the calculated result in the input field with ID 'percent_fvc_fevi'
                document.getElementById('percent_fvc_fevi').value = result;
            } else {
                document.getElementById('percent_fvc_fevi').value = '';
            }
        }

        window.onload = calculateOnLoad;
        */
    </script>
    
<script>
    function getfevbyfvc(measured, predicted) {
        if (predicted === 0 || predicted === '' || measured === 0 || measured === '') {
            return 0;
        } else {
            const calculatedfev_fvc = (measured / predicted) * 100;
            return calculatedfev_fvc.toFixed(2);
        }
    }

    function calculateFvcFevi(type) {
        const fvc = parseFloat(document.getElementById(type + '_fvc').value) || 0;
        const fevi = parseFloat(document.getElementById(type + '_fevi').value) || 0;

        const result = getfevbyfvc(fevi, fvc);
        document.getElementById(type + '_fvc_fevi').value = result;
    }
    
    
    function calculatePercentages() {
        const predicted_fvc = parseFloat(document.getElementById('predicted_fvc').value) || 0;
        const measured_fvc = parseFloat(document.getElementById('measured_fvc').value) || 0;
        const predicted_fevi = parseFloat(document.getElementById('predicted_fevi').value) || 0;
        const measured_fevi = parseFloat(document.getElementById('measured_fevi').value) || 0;
        const predicted_fvc_fevi = parseFloat(document.getElementById('predicted_fvc_fevi').value) || 0;
        const measured_fvc_fevi = parseFloat(document.getElementById('measured_fvc_fevi').value) || 0;

        document.getElementById('percent_fvc').value = getPercentOfPredicted(measured_fvc, predicted_fvc);
        document.getElementById('percent_fevi').value = getPercentOfPredicted(measured_fevi, predicted_fevi);
        document.getElementById('percent_fvc_fevi').value = getPercentOfPredicted(measured_fvc_fevi, predicted_fvc_fevi);
    }

    function getPercentOfPredicted(measured, predicted) {
        if (predicted === 0 || predicted === '' || measured === 0 || measured === '') {
            return 0;
        } else {
            // const percent = (measured / predicted) * 100;
            const percent = (predicted / measured) * 100;
            return percent.toFixed(2);
        }
    }
    
     // Trigger calculations after the data is loaded
    function initializeCalculations() {
        calculateFvcFevi('predicted');
        calculateFvcFevi('measured');
        calculatePercentages();
    }

    window.onload = function() {
        initializeCalculations();
    };
    
</script>

<!-- JavaScript for Calculating BMI -->
<script>
    function calculateBmi() {
    let height = parseFloat(document.getElementById('height').value) || 0;
    let weight = parseFloat(document.getElementById('weight').value) || 0;

    // Convert height from centimeters to meters
    height = height / 100;

    // Check if height or weight is zero or not provided
    if (height === 0 || weight === 0) {
        document.getElementById('bmi').value = 0;
    } else {
        // Calculate BMI
        let bmi = weight / (height * height);
        bmi = bmi.toFixed(2);  // Round to two decimal places
        document.getElementById('bmi').value = bmi;
    }
}


    // Trigger BMI calculation after data is loaded
    function initializeBmiCalculation() {
        calculateBmi();
    }

    window.onload = function() {
        initializeBmiCalculation();
    };
</script>

</body>

</html>