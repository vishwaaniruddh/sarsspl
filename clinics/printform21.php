<?php
include 'config.php';
date_default_timezone_set('Asia/Calcutta');
$id = $_GET['id'];

$form21Query = mysqli_query($con, "select * from form_21 where id='3' ");
$form_21_sql = mysqli_fetch_assoc($form21Query);

$idd = $form_21_sql['id'];

$general_examQuery = mysqli_query($con, "select * from form_21_general_examination where id = '$idd' ");
$general_exam_result = mysqli_fetch_assoc($general_examQuery);

$sql_cardiovascular = mysqli_query($con, "select * from cardiovascular_system where id = '$idd' ");
$sql_cardiovascular_result = mysqli_fetch_assoc($sql_cardiovascular);

$sql_respiratory = mysqli_query($con, "select * from respiratory_system where id = '$idd' ");
$sql_respiratory_result = mysqli_fetch_assoc($sql_respiratory);

$sql_gastrointestinal = mysqli_query($con, "select * from gastrointestinal_system where id = '$idd' ");
$sql_gastrointestinal_result = mysqli_fetch_assoc($sql_gastrointestinal);

$sql_eyes = mysqli_query($con, "select * from examination_of_eyes where id = '$idd' ");
$sql_eyes_result = mysqli_fetch_assoc($sql_eyes);

$sql_ear_nose_throat = mysqli_query($con, "select * from ent_examination where id='$idd'");
$sql_ear_nose_throat_result = mysqli_fetch_assoc($sql_ear_nose_throat);

$sql_genito_urinary = mysqli_query($con, "select * from genitourinary_system where id='$idd'");
$sql_genito_urinary_result = mysqli_fetch_assoc($sql_genito_urinary);

$sql_lab_investigations = mysqli_query($con, "select * from lab_investigations where id='$idd'");
$sql_lab_investigations_result = mysqli_fetch_assoc($sql_lab_investigations);

$sql_other_investigations = mysqli_query($con, "select * from other_investigations where id='$idd'");
$sql_other_investigations_result = mysqli_fetch_assoc($sql_other_investigations);

$sql_pulmonary_function = mysqli_query($con, "select * from pulmonary_function_test where id='$idd'");
$sql_pulmonary_function_test_result = mysqli_fetch_assoc($sql_pulmonary_function);

$sql_audiometry = mysqli_query($con, "select * from audiometry where id='$idd'");
$sql_audiometry_result = mysqli_fetch_assoc($sql_audiometry);


?>
<style type="text/css">
    /* Define print-specific styles here */

    body {
        font-size: 9pt;
        /* font-size: 8pt; */
    }

    #maindiv {
        padding: 20px;
    }

    @page {
        margin: 50px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 2px;
        text-align: left;
        font-size: 9pt;
        /* font-size: 8pt; */
    }

    th {
        background-color: #f5f5f5;
    }

    header,
    footer {
        text-align: center;
        background-color: #f5f5f5;
        padding: 10px;
        margin-bottom: 10px;
    }

    header img {
        height: 100px;
    }

    .container {
        margin-top: 20px;
    }

    .name_row {
        border: 1px solid;
        border-bottom: 0;
    }

    .name_row .label {
        width: 300px;
    }

    .label_style {
        background-color: lightgreen;
        width: 150px;
    }

    .basic_details {
        border: 1px solid;
    }

    .titled_section {
        border: 1px solid;
        border-top: 0;
        text-align: center;
        margin-bottom: 1px;
        font-weight: bold;
    }

    .top_section {
        font-size: 10px;
        width: 100%;
        height: 60px;
        display: flex;
        justify-content:flex-start;
        align-items: center;
    }

    .top_section_1 div {
        font-size: 13px;
    }
</style>

<div id="maindiv">
    <div>
        <div class="top_section">
            <div>
            <img src="images\gdh.jpg" style="height: 100%; width:200px" />
            </div>
        
            <div align="center" style="margin-left:250px"><b>GINDODI DEVI MEMORIAL CHARITABLE HOSPITAL & RESEARCH CENTER
                </b>
                <p align="center">( Run By: Beena Health Care Charitable Trust )<br>G.E. ROAD, KHURSIPAR - 490
                    012 (C.G.)<br>PHONE: 0788-3594666 </p>
            </div>
        </div>
        <!-- <table class="top_section_1">
            <tr>
                <td><img src="images\gdh.jpg" height="100" width="240px" /></td>
                <td align="center" style="height: 100%;">
                    <div align="center"><b>GINDODI DEVI MEMORIAL CHARITABLE HOSPITAL & RESEARCH CENTER
                        </b> </div>
                    <p align="center">( Run By: Beena Health Care Charitable Trust )<br>G.E. ROAD, KHURSIPAR - 490
                        012 (C.G.)<br>PHONE: 0788-3594666 </p>
                </td>
            </tr>
        </table> -->
        <table class="top_section_1">
            <tr>
                <td align="center">
                    <div align="center"><u><b>FORM 21</b></u></div>
                    <p align="center">[Prescribed under Rule (19)]<br>(In respect of persons
                        employed in occupations declared to be dangerous operationsunder Section 87)
                    </p>
                </td>
            </tr>
        </table>
    </div>
    <hr>

    <table border="0" width="100%" class="name_row">
        <tr>
            <td class="label"><b>NAME OF THE CERTIFYING SURGEON:</b></td>
            <td><?= ucwords($form_21_sql['certifying_person_name']) ?></td>
        </tr>
    </table>
    <table border="0" width="100%" class="basic_details">

        <tr>
            <td><b>NAME:</b></td>
            <td><?= ucwords($form_21_sql['name']); ?></td>
            <td><b>EMP ID.:</b></td>
            <td><?= $form_21_sql['emp_id']; ?></td>
            <td><b>AGE:</b></td>
            <td><?= $form_21_sql['age']; ?></td>
            <td><b>SEX:</b></td>
            <td><?= ucwords($form_21_sql['gender']); ?></td>

        </tr>
        <tr>
            <td><b>DATE OF EXAMINATION:</b></td>
            <td><?= date("d/m/Y",strtotime($form_21_sql['exam_date'])) ?></td>
            <td><b>DESIG:</b></td>
            <td><?= ucwords($form_21_sql['designation']); ?></td>
            <td><b>AADHAR:</b></td>
            <td><?= $form_21_sql['aadhar_no']; ?></td>
            <td><b>ESIC:</b></td>
            <td><?= $form_21_sql['esic']; ?></td>

        </tr>
        <tr>
            <td><b>TYPE OF EXAMINATION:</b></td>
            <td><?= $form_21_sql['exam_type']; ?></td>
            <td><b>LAST PME/PEME DT:</b></td>
            <td><?= date("d/M/Y",strtotime($form_21_sql['last_pme_peme_date'])) ?></td>
            <td><b>DATE OF JOINING:</b></td>
            <td><?= date("d/M/Y",strtotime($form_21_sql['join_date'])) ?></td>
            <td></td>
            <td></td>

        </tr>

        <tr>
            <td align="center"><b>DEPARTMENT:</b></td>
            <td><?= ucwords($row['discharge_type']); ?></td>
        </tr>

    </table>

    <div class="titled_section">
        <div>ANNEXURE</div>
        <div>PRE-EMPLOYMENT / PERIODIC MEDICAL EXAMINATION</div>
    </div>

    <div style="width:100%;display:flex;justify-content:space-around;">

        <div style="margin:15px ;width:50%;">
            <div class="section-title"><u><b>1. GENERAL EXAMINATION</b></u></div> <br>
            <table>
                <tr>
                    <td>HEIGHT:</td>
                    <td id="height"><?= $general_exam_result['height'] ?> CMS</td>
                    <td>WEIGHT:</td>
                    <td id="weight"><?= $general_exam_result['weight'] ?> KGS</td>
                </tr>
                <!-- <div class="section-title">1. General Examination</div> -->
                <tr>
                    <td>BMI:</td>
                    <td id="weight"><?= $general_exam_result['bmi'] ?></td>
                    <td>THYROID:</td>
                    <td id="weight"><?= $general_exam_result['thyroid'] ?></td>
                </tr>
                <tr>
                    <td>INSPIRATION:</td>
                    <td id="inspitration"><?= $general_exam_result['inspiration'] ?> CMS</td>
                    <td>EXPIRATION:</td>
                    <td id="expiration"><?= $general_exam_result['expiration'] ?> CMS</td>
                </tr>
                <tr>
                    <td>BUILT:</td>
                    <td id="built"><?= ucwords($general_exam_result['built']) ?></td>
                    <td>THROAT:</td>
                    <td id="throat"><?= ucwords($general_exam_result['throat']) ?></td>
                </tr>
                <tr>
                    <td>TONGUE:</td>
                    <td><?= ucwords($general_exam_result['tounge']) ?></td>
                    <td>TEETH:</td>
                    <td><?= ucwords($general_exam_result['teeth']) ?></td>
                </tr>
                <tr>
                    <td>TONSILS:</td>
                    <td><?= ucwords($general_exam_result['tonsils']) ?></td>
                    <td>GUMS:</td>
                    <td><?= ucwords($general_exam_result['teeth']) ?></td>
                </tr>
                <tr>
                    <td>LYMPH NODES:</td>
                    <td id="lymph_nodes"></td>
                    <td>ADDITIONAL FINDINGS:</td>
                    <td></td>
                </tr>
            </table>
            <br>
            <table>
                <div class="section-title"><u><b>2. CARDIO-VASCULAR SYSTEM</b></u></div>
                <br>

                <tr>
                    <td>PULSE:</td>
                    <td><?= ucwords($sql_cardiovascular_result['pulse']) ?> /MIN</td>
                    <td><?= ucwords($sql_cardiovascular_result['pulse_type']) ?></td>
                </tr>
                <tr>
                    <td>PERIPHERAL PULSE:</td>
                    <td id="lymph_nodes"><?= ucwords($sql_cardiovascular_result['pher_pulse']) ?></td>
                    <td>BP:</td>
                    <td><?= $sql_cardiovascular_result['bp'] ?> MM OF HG</td>
                </tr>
                <tr>
                    <td>HEART SOUND:</td>
                    <td id="lymph_nodes"><?= ucwords($sql_cardiovascular_result['heart_rate']) ?></td>
                    <td>MURMUR, IF ANY:</td>
                    <td><?= ucwords($sql_cardiovascular_result['murmur']) ?></td>
                </tr>
                <tr>
                    <td>ADDITIONAL FINDINGS,IF ANY:</td>
                    <td><?= ucwords($sql_cardiovascular_result['additional_findings_1']) ?></td>
                </tr>
            </table>
            <br>
            <table>
                <div class="section-title"><u><b>3. RESPIRATORY SYSTEM</b></u></div><br>

                <tr>
                    <td>SHAPE OF CHEST:</td>
                    <td><?= ucwords($sql_respiratory_result['chest_shape']); ?></td>
                    <td>CHEST MOVEMENTS:</td>
                    <td><?= ucwords($sql_respiratory_result['chest_movement']) ?></td>

                </tr>
                <tr>
                    <td>TRACHEA:</td>
                    <td><?= ucwords($sql_respiratory_result['trachea']) ?></td>
                    <td>BREATH SOUND:</td>
                    <td><?= ucwords($sql_respiratory_result['breath_sound']) ?> MM OF HG</td>
                </tr>
            </table>
            <br>
            <table>
                <div class="section-title"><u><b>4. GASTRO-INTESTINE SYSTEM</b></u></div>
                <br>
                <tr>
                    <td>LIVER:</td>
                    <td><?= ucwords($sql_gastrointestinal_result['liver']) ?></td>
                    <td>SPLEEN:</td>
                    <td><?= ucwords($sql_gastrointestinal_result['spleen']) ?></td>

                </tr>
                <tr>
                    <td>ANY ABDOMINAL LUMPS:</td>
                    <td><?= ucwords($sql_gastrointestinal_result['abdominal_lumps']) ?></td>

                </tr>
            </table>
            <br>
            <table>
                <div class="section-title"><u><b>5. EXAMINATION OF EYES </b></u></div>
                <br>
                <tr>
                    <td>EXTERNAL EXAM:</td>
                    <td><?= ucwords($sql_eyes_result['chest_shape']) ?></td>
                    <td>SQUINT:</td>
                    <td><?= ucwords($sql_eyes_result['chest_movement']) ?></td>
                </tr>
                <tr>
                    <td>NYSTAGMUS:</td>
                    <td><?= ucwords($sql_eyes_result['nystagmus']) ?></td>
                    <td>COLOUR VISION:</td>
                    <td><?= ucwords($sql_eyes_result['colour_vision']) ?></td>
                </tr>
                <tr>
                    <td>FUNDUS (L) (R):</td>
                    <td><?= ucwords($sql_eyes_result['fundus']) ?></td>
                    <td>INDIVIUDUAL COLOUR IDENTIFICATION:</td>
                    <td><?= ucwords($sql_eyes_result['color_identify']) ?></td>
                </tr>

                <tr>
                    <td><br><b>DISTANT VISION(WITHOUT GLASS):</b></td>
                </tr>
                <tr>
                    <td>RIGHT:</td>
                    <td><?= $sql_eyes_result['distant_vision_without_right'] ?></td>
                    <td>LEFT:</td>
                    <td><?= $sql_eyes_result['distant_vision_without_left'] ?></td>
                </tr>

                <tr>
                    <td><br><b>(WITH GLASSES): </b></td>
                </tr>
                <tr>
                    <td>RIGHT:</td>
                    <td><?= $sql_eyes_result['distant_vision_with_right'] ?></td>
                    <td>LEFT:</td>
                    <td><?= $sql_eyes_result['distant_vision_with_left'] ?></td>
                </tr>

                <tr>
                    <td><br><b>NEAR VISION(WITHOUT GLASSES):</b></td>
                </tr>
                <tr>
                    <td>RIGHT:</td>
                    <td><?= $sql_eyes_result['near_vision_without_right'] ?></td>
                    <td>LEFT:</td>
                    <td><?= $sql_eyes_result['near_vision_without_left'] ?></td>
                </tr>

                <tr>
                    <td><br><b>(WITH GLASSES):</b></td>
                </tr>
                <tr>
                    <td>RIGHT:</td>
                    <td><?= $sql_eyes_result['near_vision_with_right'] ?></td>
                    <td>LEFT:</td>
                    <td><?= $sql_eyes_result['near_vision_with_left'] ?></td>
                </tr>

                <tr>
                    <td><br>NIGHT BLINDNESS (NYCTALOPIA)</td>
                    <td><?= $sql_eyes_result['near_vision_without_right'] ?></td>
                </tr>
            </table>
            <br>
            <table>
                <div class="section-title"><u><b>6. EXAMINATION OF EAR,NOSE & THROAT </b></u></div>
                <br>
                <tr>
                    <td>EXTERNAL EXAM</td>
                    <td><?= ucwords($sql_ear_nose_throat_result['ext_exam_ear_nose_throat']) ?></td>
                </tr>
            </table>

        </div>
        <div style="margin:15px;width:50%;">
            <div class="section-title"><u><b>7. GENITO-URINARY SYSTEM</b></u></div>
            <table>
                <tr>
                    <td>CRYPTORCHIDISM:</td>
                    <td id="height"><?= $sql_genito_urinary_result['cryptorchidism'] ?></td>
                    <td>PHIMOSIS:</td>
                    <td id="weight"><?= $sql_genito_urinary_result['phimosis'] ?></td>
                </tr>
                <tr>
                    <td>HERNIA:</td>
                    <td id="measurement"><?= $sql_genito_urinary_result['hernia'] ?></td>
                    <td>HYDROCELE/VARIOCELE:</td>
                    <td id="expiration"><?= $sql_genito_urinary_result['hydro_vario'] ?></td>
                </tr>
                <tr>
                    <td>VARICOSE VEINS:</td>
                    <td id="built"><?= $sql_genito_urinary_result['hydro_vario'] ?></td>
                    <td>SIGNS OF STD:</td>
                    <td id="throat"><?= $sql_genito_urinary_result['std'] ?></td>
                </tr>
            </table>
            <table>
                <div class="col-6" style="margin:5px;width:50%;background-color:lightyellow">
                    <div class="section-title"><u><b>OTHER EXAMINATION FOR FEMALES</b></u></div>

                    <tr>
                        <td>MENSTRUAL HISTORY:</td>
                        <td id="tongue"><?= $sql_genito_urinary_result['std'] ?></td>
                        <td>OBSTETRIC HISTORY:</td>
                        <td id="teeth"><?= $sql_genito_urinary_result['std'] ?></td>
                    </tr>
                    <tr>
                        <td>MENARCH AT:</td>
                        <td id="lymph_nodes"><?= $sql_genito_urinary_result['menarche'] ?> YRS</td>
                        <td>GRAVIDA:</td>
                        <td id="additional_findings"><?= $sql_genito_urinary_result['gravida'] ?></td>
                    </tr>
                    <tr>
                        <td>PARA:</td>
                        <td id="lymph_nodes"><?= $sql_genito_urinary_result['para'] ?></td>
                        <td>LMP:</td>
                        <td id="additional_findings"><?= $sql_genito_urinary_result['lmp'] ?></td>
                    </tr>
                    <tr>
                        <td>MENSTRUAL IRREGULARITY,IF ANY:</td>
                        <td id="lymph_nodes"><?= $sql_genito_urinary_result['menstrual_irregularity'] ?></td>
                    </tr>
            </table>
            <table style=" margin:5px;">
                <div class="section-title"><u><b>OTHER EXAMINATION FOR CANTEEN WORKERS</b></u></div>

                <tr>
                    <td>WIDAL:</td>
                    <td id="tongue"><?= $sql_genito_urinary_result['widal'] ?></td>
                    <td>HEP B:</td>
                    <td id="teeth"><?= $sql_genito_urinary_result['hep_b'] ?></td>
                </tr>
                <tr>
                    <td>SPUTUM FOR AFB:</td>
                    <td id="lymph_nodes"><?= $sql_genito_urinary_result['sputum_for_afb'] ?></td>
                    <td>SKIN DISEASES:</td>
                    <td id="additional_findings"><?= $sql_genito_urinary_result['skin_diseases'] ?></td>
                </tr>
                <tr>
                    <td>HIV:</td>
                    <td id="lymph_nodes"><?= $sql_genito_urinary_result['htv'] ?></td>
                    <td>WORM INFECTION:</td>
                    <td id="additional_findings"><?= $sql_genito_urinary_result['worm_infection'] ?></td>
                </tr>

            </table>
            <br>
            <div class="section-title"><b><i>INVESTIGATIONS</i></b></div>
            <div class="section-title"><u><b>8. LAB INVESTIGATIONS</b></u></div>
            <table>
                <div class="section-title"><u><b>URINE</b></u></div>

                <tr>
                    <td>ALBUMIN:</td>
                    <td id="tongue"><?= $sql_lab_investigations_result['albumin'] ?></td>
                    <td>SUGAR:</td>
                    <td id="teeth"><?= $sql_lab_investigations_result['sugar'] ?></td>
                </tr>
                <tr>
                    <td>MICROSCOPY-PUS CELLS:</td>
                    <td id="lymph_nodes"><?= $sql_lab_investigations_result['miscroscopy_pus'] ?></td>
                    <td>EPITH CELLS:</td>
                    <td id="additional_findings"><?= $sql_lab_investigations_result['epith_cells'] ?></td>
                    <td>STOOLS:</td>
                    <td id="additional_findings"><?= $sql_lab_investigations_result['stools'] ?></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><u><b>HAEMOGRAM</b></u></div>

                <tr>
                    <td>BLOOD GROUP:</td>
                    <td id="lymph_nodes"><?= $sql_lab_investigations_result['blood_grp'] ?></td>
                    <td>RH FACTOR:</td>
                    <td id="additional_findings"><?= $sql_lab_investigations_result['rh_factor'] ?></td>

                </tr>
                <tr>
                    <td>HB(%):</td>
                    <td id="lymph_nodes"><?= $sql_lab_investigations_result['hb'] ?></td>
                    <td>TLC:</td>
                    <td id="additional_findings"><?= $sql_lab_investigations_result['tlc'] ?></td>
                    <td>RBC:</td>
                    <td id="additional_findings"><?= $sql_lab_investigations_result['rbc'] ?></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><u><b>DLC</b></u></div>

                <tr>
                    <td>NEUTROPHILS:</td>
                    <td id="lymph_nodes"><?= $sql_lab_investigations_result['neutrophils'] ?></td>
                    <td>LYMPHOCYTES:</td>
                    <td id="additional_findings"><?= $sql_lab_investigations_result['lymphocytes'] ?></td>
                </tr>
                <tr>
                    <td>EOSINIPHILS:</td>
                    <td id="lymph_nodes"><?= $sql_lab_investigations_result['eosinophils'] ?></td>
                    <td>MONOCYTES:</td>
                    <td id="additional_findings"><?= $sql_lab_investigations_result['monocytes'] ?></td>
                </tr>
                <tr>
                    <td>BASOPHILS:</td>
                    <td id="lymph_nodes"><?= $sql_lab_investigations_result['basophils'] ?></td>
                    <td>FLATELETS COUNT:</td>
                    <td id="additional_findings"><?= $sql_lab_investigations_result['flatelets_count'] ?></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><u><b>LIPID PROFILE</b></u></div>

                <tr>
                    <td>SERUM CHOLESTEROL:</td>
                    <td id="lymph_nodes"><?= $sql_lab_investigations_result['serum_cholesterol'] ?></td>
                    <td>TRIGLYCERIDES:</td>
                    <td id="additional_findings"><?= $sql_lab_investigations_result['triglycerides'] ?></td>
                </tr>
                <tr>
                    <td>HDL:</td>
                    <td id="lymph_nodes"><?= $sql_lab_investigations_result['hdl'] ?></td>
                    <td>LDL:</td>
                    <td id="additional_findings"><?= $sql_lab_investigations_result['ldl'] ?></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><u><b>HEPATIC PROFILE</b></u></div>

                <tr>
                    <td>SGPT:</td>
                    <td id="lymph_nodes"><?= $sql_lab_investigations_result['sgpt'] ?></td>
                    <td>SGOT:</td>
                    <td id="additional_findings"><?= $sql_lab_investigations_result['sgot'] ?></td>
                </tr>
                <tr>
                    <td>ALKALINE PHOSPHATE:</td>
                    <td id="lymph_nodes"><?= $sql_lab_investigations_result['alkaline_phosphate'] ?></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><u><b>RENAL PROFILE</b></u></div>

                <tr>
                    <td>BLOOD UREA:</td>
                    <td id="lymph_nodes"><?= $sql_lab_investigations_result['blood_urea'] ?></td>
                    <td>CREATININE:</td>
                    <td id="additional_findings"><?= $sql_lab_investigations_result['creatinine'] ?></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><u><b>METABOLIC</b></u></div>

                <tr>
                    <td>BLOOD SUGAR(FASTING):</td>
                    <td id="lymph_nodes"><?= $sql_lab_investigations_result['blood_sugar_fasting'] ?></td>
                </tr>
                <tr>
                    <td>BLOOD SUGAR(PP):</td>
                    <td id="lymph_nodes"><?= $sql_lab_investigations_result['blood_sugar_pp'] ?></td>
                    <td>URIC ACID:</td>
                    <td id="additional_findings"><?= $sql_lab_investigations_result['uric_acid'] ?></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><br><u><b>9. OTHER INVESTIGATIONS</b></u></div>

                <tr>
                    <td>X-RAY CHEST:</td>
                    <td id="lymph_nodes"><?= $sql_other_investigations_result['xray_chest'] ?></td>
                    <td>ECG:</td>
                    <td id="lymph_nodes"><?= $sql_other_investigations_result['ecg'] ?></td>
                </tr>
                <tr>
                    <td>USG WHOLE ABDOMEN:</td>
                    <td id="additional_findings"><?= $sql_other_investigations_result['usg_whole_abdomen'] ?></td>

                </tr>
            </table>

            <table class="" border="1">
                <div class="section-title"><br><u><b>10. PULMONARY FUNCTION TEST:</b></u> Remarks</div>
                <thead>
                    <tr>
                        <th></th>
                        <th>FVC</th>
                        <th>FEV1</th>
                        <th>FEV1/FVC%</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Predicted</th>
                        <td><?= $sql_pulmonary_function_test_result['predicted_fvc'] ?></td>
                        <td><?= $sql_pulmonary_function_test_result['predicted_fevi'] ?></td>
                        <td><?= $sql_pulmonary_function_test_result['predicted_fvc_fevi'] ?></td>
                    </tr>
                    <tr>
                        <th>Measured</th>
                        <td><?= $sql_pulmonary_function_test_result['measured_fvc'] ?></td>
                        <td><?= $sql_pulmonary_function_test_result['measured_fevi'] ?></td>
                        <td><?= $sql_pulmonary_function_test_result['measured_fvc_fevi'] ?></td>
                    </tr>
                    <tr>
                        <th>% of Predicted</th>
                        <td><?= $sql_pulmonary_function_test_result['percent_fvc'] ?></td>
                        <td><?= $sql_pulmonary_function_test_result['percent_fevi'] ?></td>
                        <td><?= $sql_pulmonary_function_test_result['percent_fvc_fevi'] ?></td>
                    </tr>
                </tbody>
            </table>
            <table>
                <div class="section-title"><br><u><b>11. AUDIOMETRY</b></u></div>

                <tr>
                    <td>PTA Lt</td>
                    <td id="lymph_nodes"><?= $sql_audiometry_result['pta_lt'] ?></td>
                    <td>PTA Rc</td>
                    <td id="lymph_nodes"><?= $sql_audiometry_result['pta_rc'] ?></td>
                </tr>
            </table>

        </div>

    </div>

    <div style="width:100%;display:flex;justify-content:space-around;">
        <div style="margin:0px 15px;width:50%;">
            <table>
                <tr>
                    <td><br>Signature (With Date) of Certifying Surgeon</td>
                </tr>
            </table>
        </div>
        <div style="margin:0px 15px;width:50%;">
            <table>
                <tr>
                    <td><br>Signature (With Date) of Factory Medical Officer</td>
                </tr>
            </table>
        </div>
    </div>

</div>

</>

<p align="center"><a href="#" onclick="divprint()">Print</a></p>
<p align="center"><a href="home.php">Back</a></p>

<script>
    // function divprint() {
    //     var printContent = document.getElementById('maindiv').outerHTML;
    //     // var mywindow = window.open('', 'GDH', 'height=400,width=600');
    //     var mywindow = window.open('', 'GDH', 'height=800,width=1000');
    //     mywindow.document.write('<html><head><title>Discharge Summary_<?= $row['name']; ?></title>');
    //     mywindow.document.write('</head><body>');
    //     mywindow.document.write(printContent);
    //     mywindow.document.write('</body></html>');

    //     mywindow.document.close();
    //     mywindow.print();
    //     // mywindow.close();

    //     return false;
    // }
    function divprint() {
        var printContent = document.getElementById('maindiv').outerHTML;
        var mywindow = window.open('', 'GDH', 'height=600,width=1000');

        mywindow.document.write('<html><head><title>Form21_<?=$form_21_sql['name'];?></title>');
        // Ensure external CSS is loaded
        mywindow.document.write('<link rel="stylesheet" href="css/bootstrap.min.css">');
        // Add any inline styles
        mywindow.document.write('<style type="text/css">' + document.querySelector('style')?.innerHTML + '</style>');

        // Add styles specific for printing
        mywindow.document.write('<style type="text/css">');
        mywindow.document.write('@media print {');
        mywindow.document.write('body, html { margin: 0; padding: 0; }');
        mywindow.document.write('#maindiv { width: 100%; }');
        mywindow.document.write('* { box-sizing: border-box; }');
        mywindow.document.write('@page { size: A4; margin: 10mm; }'); // Adjust margin as needed
        mywindow.document.write('}');
        mywindow.document.write('</style>');

        mywindow.document.write('</head><body>');
        mywindow.document.write(printContent);
        mywindow.document.write('</body></html>');
        mywindow.document.close();

        // Ensure the content is loaded before printing
        mywindow.onload = function() {
            mywindow.print();
        };

        return false;
    }

    // function divprint() {
    //     var printContent = document.getElementById('maindiv').outerHTML;
    //     var mywindow = window.open('', 'GDH', 'height=600,width=1000');
    //     mywindow.document.write('<html><head><title>Discharge Summary_<?= $row['name']; ?></title>');
    //     // mywindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
    //     mywindow.document.write('<link rel="stylesheet" href="css/bootstrap.min.css">');
    //     mywindow.document.write('<style type="text/css">' + document.querySelector('style').innerHTML + '</style>');
    //     mywindow.document.write('</head><body>');
    //     mywindow.document.write(printContent);
    //     mywindow.document.write('</body></html>');
    //     mywindow.document.close();
    //     mywindow.print();
    //     return false;
    // }
</script>