<?php
include 'config.php';
date_default_timezone_set('Asia/Calcutta');
$id = $_GET['id'];

$form21dataQuery = mysqli_query($con, "select * from form21_data where reports_id='$id' ");
$form21data_result = mysqli_fetch_assoc($form21dataQuery);

$sql_report = mysqli_query($con, "select * from report where id = '$id' ");
$sql_report_result = mysqli_fetch_assoc($sql_report);


?>
<title>Print FORM 21</title>
<style type="text/css">
    /* Define print-specific styles here */

    body {
        font-size: 9pt;
        /* font-size: 8pt; */
    }

    #maindiv {
        padding: 15px;
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
        font-size: 11px;
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
    <!--<hr>-->

    <table border="0" width="100%" class="name_row">
        <tr>
            <td class="label"><b>NAME OF THE CERTIFYING SURGEON:</b></td>
            <td><b><?= ucwords($form21data_result['surgeon_name']) ?></b></td>
        </tr>
    </table>
    <table border="0" width="100%" class="basic_details">

        <tr>
            <td><b>NAME:</b></td>
            <td><b><?= ucwords($sql_report_result['name']); ?></b></td>
            <td><b>EMP ID.:</b></td>
            <td><b><?= $form21data_result['empid']; ?></b></td>
            <td><b>AGE:</b></td>
            <td><b><?= $sql_report_result['age']; ?></b></td>
            <td><b>SEX:</b></td>
            <td><b><?= ucwords($sql_report_result['sex']); ?></b></td>

        </tr>
        <tr>
            <td><b>DATE OF EXAMINATION:</b></td>
            <td><b><?php if($form21data_result['exam_date']== '0000-00-00'){ echo "";} else $form21data_result['exam_date']; ?></b></td>
            <td><b>DESIG:</b></td>
            <td><b><?= ucwords($form21data_result['designation']); ?></b></td>
            <td><b>AADHAR:</b></td>
            <td><b><?= $form21data_result['aadhar']; ?></b></td>
            <td><b>ESIC:</b></td>
            <td><b><?= $form21data_result['esic']; ?></b></td>

        </tr>
        <tr>
            <td><b>TYPE OF EXAMINATION:</b></td>
            <td><b><?= $form21data_result['exam_type']; ?></b></td>
            <td><b>LAST PME/PEME DT:</b></td>
            <td><b><?php if($form21data_result['last_pme_pmce_date']== '0000-00-00'){ echo "";} else{ $form21data_result['last_pme_pmce_date']; }?></b></td>
            <td><b>DATE OF JOINING:</b></td>
            <td><b><?php if($form21data_result['join_date']== '0000-00-00'){ echo "";} else  $form21data_result['join_date']; ?></b></td>
            <td></td>
            <td></td>

        </tr>

        <tr>
            <td align="center"><b>DEPARTMENT:</b></td>
            <td><b><?= ucwords($form21data_result['department']); ?></b></td>
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
                    <td id="height"><b><?= $sql_report_result['height'] ?> CMS</b></td>
                    <td>WEIGHT:</td>
                    <td id="weight"><b><?= $sql_report_result['weight'] ?> KGS</b></td>
                </tr>
                <!-- <div class="section-title">1. General Examination</div> -->
                <tr>
                    <td>BMI:</td>
                    <td id="weight"><b><?= $sql_report_result['bmi'] ?></b></td>
                    <td>THYROID:</td>
                    <td id="weight"><b>Normal</b></td>
                </tr>
                <tr>
                    <td>INSPIRATION:</td>
                    <td id="inspitration"><b>5 CMS</b></td>
                    <td>EXPIRATION:</td>
                    <td id="expiration"><b>4 CMS</b></td>
                </tr>
                <tr>
                    <td>BUILT:</td>
                    <td id="built"><b><?= ucwords('Average') ?></b></td>
                    <td>THROAT:</td>
                    <td id="throat"><b><?= ucwords('Normal') ?></b></td>
                </tr>
                <tr>
                    <td>TONGUE:</td>
                    <td><b><?= ucwords('Normal') ?></b></td>
                    <td>TEETH:</td>
                    <td><b><?= ucwords('Normal') ?></b></td>
                </tr>
                <tr>
                    <td>TONSILS:</td>
                    <td><b><?= ucwords('Normal') ?></b></td>
                    <td>GUMS:</td>
                    <td><b><?= ucwords('Normal') ?></b></td>
                </tr>
                <tr>
                    <td>LYMPH NODES:</td>
                    <td><b>Non Palpable</b></td>
                    <td>ADDITIONAL FINDINGS:</td>
                    <td><b>Absent</b></td>
                </tr>
            </table>
            <br>
            <table>
                <div class="section-title"><u><b>2. CARDIO-VASCULAR SYSTEM</b></u></div>
                <br>

                <tr>
                    <td>PULSE:</td>
                    <td><b><?= ucwords($sql_report_result['pulse']) ?> /MIN</b></td>
                    <td><b><?= ucwords('Regular') ?></b></td>
                </tr>
                <tr>
                    <td>PERIPHERAL PULSE:</td>
                    <td><b><?= ucwords('Felt') ?></b></td>
                    <td>BP:</td>
                    <td><b><?= $sql_report_result['bp'] ?> MM OF HG</b></td>
                </tr>
                <tr>
                    <td>HEART SOUND:</td>
                    <td><b><?= ucwords('Normal') ?></b></td>
                    <td>MURMUR, IF ANY:</td>
                    <td><b><?= ucwords('absent') ?></b></td>
                </tr>
                <tr>
                    <td>ADDITIONAL FINDINGS,IF ANY:</td>
                    <td><b><?= ucwords('absent') ?></b></td>
                </tr>
            </table>
            <br>
            <table>
                <div class="section-title"><u><b>3. RESPIRATORY SYSTEM</b></u></div><br>

                <tr>
                    <td>SHAPE OF CHEST:</td>
                    <td><b><?= ucwords('normal'); ?></b></td>
                    <td>CHEST MOVEMENTS:</td>
                    <td><b><?= ucwords('normal') ?></b></td>

                </tr>
                <tr>
                    <td>TRACHEA:</td>
                    <td><b><?= ucwords('normal') ?></b></td>
                    <td>BREATH SOUND:</td>
                    <td><b><?= ucwords('normal') ?></b></td>
                </tr>
            </table>
            <br>
            <table>
                <div class="section-title"><u><b>4. GASTRO-INTESTINE SYSTEM</b></u></div>
                <br>
                <tr>
                    <td>LIVER:</td>
                    <td><b><?= ucwords('Non Palpable') ?></b></td>
                    <td>SPLEEN:</td>
                    <td><b><?= ucwords('non palpable') ?></b></td>

                </tr>
                <tr>
                    <td>ANY ABDOMINAL LUMPS:</td>
                    <td><b><?= ucwords('normal') ?></b></td>

                </tr>
            </table>
            <br>
            <table>
                <div class="section-title"><u><b>5. EXAMINATION OF EYES </b></u></div>
                <br>
                <tr>
                    <td>EXTERNAL EXAM:</td>
                    <td><b><?= ucwords('normal') ?></b></td>
                    <td>SQUINT:</td>
                    <td><b><?= ucwords('absent') ?></b></td>
                </tr>
                <tr>
                    <td>NYSTAGMUS:</td>
                    <td><b><?= ucwords('absent') ?></b></td>
                    <td>COLOUR VISION:</td>
                    <td><b><?= ucwords('normal') ?></b></td>
                </tr>
                <tr>
                    <td>FUNDUS (L) (R):</td>
                    <td><b><?= ucwords('normal') ?></b></td>
                    <td>INDIVIUDUAL COLOUR IDENTIFICATION:</td>
                    <td><b><?= ucwords('normal') ?></b></td>
                </tr>

                <tr>
                    <td><br><b>DISTANT VISION(WITHOUT GLASS):</b></td>
                </tr>
                <tr>
                    <td>RIGHT:</td>
                    <td><b><?= $sql_report_result['distant_vision_without_right'] ?></b></td>
                    <td>LEFT:</td>
                    <td><b><?= $sql_report_result['distant_vision_without_left'] ?></b></td>
                </tr>

                <tr>
                    <td><br><b>(WITH GLASSES): </b></td>
                </tr>
                <tr>
                    <td>RIGHT:</td>
                    <td><b><?= $sql_report_result['distant_vision_with_right'] ?></b></td>
                    <td>LEFT:</td>
                    <td><b><?= $sql_report_result['distant_vision_with_left'] ?></b></td>
                </tr>

                <tr>
                    <td><br><b>NEAR VISION(WITHOUT GLASSES):</b></td>
                </tr>
                <tr>
                    <td>RIGHT:</td>
                    <td><b><?= $sql_report_result['near_vision_without_right'] ?></b></td>
                    <td>LEFT:</td>
                    <td><b><?= $sql_report_result['near_vision_without_left'] ?></b></td>
                </tr>

                <tr>
                    <td><br><b>(WITH GLASSES):</b></td>
                </tr>
                <tr>
                    <td>RIGHT:</td>
                    <td><b><?= $sql_report_result['near_vision_with_right'] ?></b></td>
                    <td>LEFT:</td>
                    <td><b><?= $sql_report_result['near_vision_with_left'] ?></b></td>
                </tr>

                <tr>
                    <td><br>NIGHT BLINDNESS (NYCTALOPIA)</td>
                    <td><b><?=ucwords('absent')?></b></td>
                </tr>
            </table>
            <br>
            <table>
                <div class="section-title"><u><b>6. EXAMINATION OF EAR,NOSE & THROAT </b></u></div>
                <br>
                <tr>
                    <td>EXTERNAL EXAM</td>
                    <td><b><?= ucwords('normal') ?></b></td>
                </tr>
            </table>

        </div>
        <div style="margin:15px;width:50%;">
            <div class="section-title"><u><b>7. GENITO-URINARY SYSTEM</b></u></div>
            <table>
                <tr>
                    <td>CRYPTORCHIDISM:</td>
                    <td id="height"><b><?= ucwords('absent') ?></b></td>
                    <td>PHIMOSIS:</td>
                    <td id="weight"><b><?= ucwords('absent') ?></b></td>
                </tr>
                <tr>
                    <td>HERNIA:</td>
                    <td id="measurement"><b><?= ucwords('absent') ?></b></td>
                    <td>HYDROCELE/VARIOCELE:</td>
                    <td id="expiration"><b><?= ucwords('absent') ?></b></td>
                </tr>
                <tr>
                    <td>VARICOSE VEINS:</td>
                    <td id="built"><b><?= ucwords('absent') ?></b></td>
                    <td>SIGNS OF STD:</td>
                    <td id="throat"><b><?=ucwords('absent') ?></b></td>
                </tr>
            </table>
            <table>
                <div class="col-6" style="margin:5px;width:50%;">
                    <div class="section-title"><u><b>OTHER EXAMINATION FOR FEMALES</b></u></div>

                    <tr>
                        <td>MENSTRUAL HISTORY:</td>
                        <td><b><?= $form21data_result['menstrual_history'] ?></b></td>
                        <td>OBSTETRIC HISTORY:</td>
                        <td><b><?= $form21data_result['obstetric_history'] ?></b></td>
                    </tr>
                    <tr>
                        <td>MENARCH AT:</td>
                        <td><b><?= $form21data_result['menarche_at'] ?> YRS</b></td>
                        <td>GRAVIDA:</td>
                        <td><b><?= $form21data_result['gravida'] ?></b></td>
                    </tr>
                    <tr>
                        <td>PARA:</td>
                        <td><b><?= $form21data_result['para'] ?></b></td>
                        <td>LMP:</td>
                        <td><b><?= $form21data_result['lmp'] ?></b></td>
                    </tr>
                    <tr>
                        <td>MENSTRUAL IRREGULARITY,IF ANY:</td>
                        <td><b><?= $form21data_result['menstrual_irreg'] ?></b></td>
                    </tr>
            </table>
            <table style=" margin:5px;">
                <div class="section-title"><u><b>OTHER EXAMINATION FOR CANTEEN WORKERS</b></u></div>

                <tr>
                    <td>WIDAL:</td>
                    <td><b><?= $form21data_result['widal'] ?></b></td>
                    <td>HEP B:</td>
                    <td><b><?= $form21data_result['hepb'] ?></b></td>
                </tr>
                <tr>
                    <td>SPUTUM FOR AFB:</td>
                    <td><b><?= $form21data_result['sputum'] ?></b></td>
                    <td>SKIN DISEASES:</td>
                    <td><b><?= $form21data_result['skin_disease'] ?></b></td>
                </tr>
                <tr>
                    <td>HIV:</td>
                    <td><b><?= $form21data_result['hiv'] ?></b></td>
                    <td>WORM INFECTION:</td>
                    <td><b><?= $form21data_result['worm_infection'] ?></b></td>
                </tr>

            </table>
            <br>
            <div class="section-title"><b><i>INVESTIGATIONS</i></b></div>
            <div class="section-title"><u><b>8. LAB INVESTIGATIONS</b></u></div>
            <table>
                <div class="section-title"><u><b>URINE</b></u></div>

                <tr>
                    <td>ALBUMIN:</td>
                    <td><b><?= $sql_report_result['albumin'] ?></b></td>
                    <td>SUGAR:</td>
                    <td><b><?= $sql_report_result['sugar'] ?></b></td>
                </tr>
                <tr>
                    <td>MICROSCOPY-PUS CELLS:</td>
                    <td><b><?= $sql_report_result['pus_cells'] ?></b></td>
                    <td>EPITH CELLS:</td>
                    <td><b><?= $sql_report_result['epith_cells'] ?></b></td>
                    <td>STOOLS:</td>
                    <td><b><?= ucwords('normal') ?></b></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><u><b>HAEMOGRAM</b></u></div>

                <tr>
                    <td>BLOOD GROUP:</td>
                    <td><b><?= $sql_report_result['blood_group'] ?></b></td>
                    <td>RH FACTOR:</td>
                    <td><b><?= $sql_report_result['rh_factor'] ?></b></td>

                </tr>
                <tr>
                    <td>HB(%):</td>
                    <td><b><?= $sql_report_result['hb'] ?></b></td>
                    <td>TLC:</td>
                    <td><b><?= $sql_report_result['tlc'] ?></b></td>
                    <td>RBC:</td>
                    <td><b><?= $sql_report_result['rbc'] ?></b></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><u><b>DLC</b></u></div>

                <tr>
                    <td>NEUTROPHILS:</td>
                    <td><b><?= $sql_report_result['neutrophils'] ?></b></td>
                    <td>LYMPHOCYTES:</td>
                    <td><b><?= $sql_report_result['lymphocytes'] ?></b></td>
                </tr>
                <tr>
                    <td>EOSINIPHILS:</td>
                    <td><b><?= $sql_report_result['eosinophils'] ?></b></td>
                    <td>MONOCYTES:</td>
                    <td><b><?= $sql_report_result['monocytes'] ?></b></td>
                </tr>
                <tr>
                    <td>BASOPHILS:</td>
                    <td><b><?= $sql_report_result['basophils'] ?></b></td>
                    <td>FLATELETS COUNT:</td>
                    <td><b><?= $sql_report_result['patelets_count'] ?></b></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><u><b>LIPID PROFILE</b></u></div>

                <tr>
                    <td>SERUM CHOLESTEROL:</td>
                    <td><b><?= $sql_report_result['serum_cholesterol'] ?></b></td>
                    <td>TRIGLYCERIDES:</td>
                    <td><b><?= $sql_report_result['striglycerides'] ?></b></td>
                </tr>
                <tr>
                    <td>HDL:</td>
                    <td><b><?= $sql_report_result['hdl'] ?></b></td>
                    <td>LDL:</td>
                    <td><b><?= $sql_report_result['ldl'] ?></b></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><u><b>HEPATIC PROFILE</b></u></div>

                <tr>
                    <td>SGPT:</td>
                    <td><b><?= $sql_report_result['sgpt'] ?></b></td>
                    <td>SGOT:</td>
                    <td><b><?= $sql_report_result['sgot'] ?></b></td>
                </tr>
                <tr>
                    <td>ALKALINE PHOSPHATE:</td>
                    <td><b><?= $sql_report_result['alkaline_phosphatase'] ?></b></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><u><b>RENAL PROFILE</b></u></div>

                <tr>
                    <td>BLOOD UREA:</td>
                    <td><b><?= $sql_report_result['blood_urea'] ?></b></td>
                    <td>CREATININE:</td>
                    <td><b><?= $sql_report_result['creatinine'] ?></b></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><u><b>METABOLIC</b></u></div>

                <tr>
                    <td>BLOOD SUGAR(FASTING):</td>
                    <td><b><?= $sql_report_result['blood_sugar_f'] ?></b></td>
                </tr>
                <tr>
                    <td>BLOOD SUGAR(PP):</td>
                    <td><b><?= $sql_report_result['blood_sugar_pp'] ?></b></td>
                    <td>URIC ACID:</td>
                    <td><b><?= $sql_report_result['uric_acid'] ?></b></td>
                </tr>
            </table>
            <table>
                <div class="section-title"><br><u><b>9. OTHER INVESTIGATIONS</b></u></div>

                <tr>
                    <td>X-RAY CHEST:</td>
                    <td><b><?= $sql_report_result['x_ray_chest'] ?></b></td>
                    <td>ECG:</td>
                    <td><b><?= $sql_report_result['ecg'] ?></b></td>
                </tr>
                <tr>
                    <td>USG WHOLE ABDOMEN:</td>
                    <td><?= $form21data_result['usg'] ?></td>
                    <!--<td>___________________</td>-->

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
                        <td><b><?= $sql_report_result['predicted_fvc'] ?></b></td>
                        <td><b><?= $sql_report_result['predicted_fev'] ?></b></td>
                        <td><b><?= $sql_report_result['predicted_fvc_fev'] ?></b></td>
                    </tr>
                    <tr>
                        <th>Measured</th>
                        <td><b><?= $sql_report_result['measured_fvc'] ?></b></td>
                        <td><b><?= $sql_report_result['measured_fev'] ?></b></td>
                        <td><b><?= $sql_report_result['measured_fvc_fev'] ?></b></td>
                    </tr>
                    <tr>
                        <th>% of Predicted</th>
                        <td><b><?= $sql_report_result['predicted_perc_fvc'] ?></b></td>
                        <td><b><?= $sql_report_result['predicted_perc_fev'] ?></b></td>
                        <td><b><?= $sql_report_result['predicted_perc_fvc_fev'] ?></b></td>
                    </tr>
                </tbody>
            </table>
            <table>
                <div class="section-title"><br><u><b>11. AUDIOMETRY</b></u></div>

                <tr>
                    <td>PTA Lt</td>
                    <td><?= $sql_report_result['audio_pta_l'] ?></td>
                    <td>PTA Rc</td>
                    <td><?= $sql_report_result['audio_pta_r'] ?></td>
                </tr>
            </table>

        </div>

    </div>

    <div style="width:100%;display:flex;justify-content:space-around;">
        <div style="margin:5px 15px;width:50%;">
            <table>
                <tr>
                    <td><br>Signature (With Date) of Certifying Surgeon</td>
                </tr>
            </table>
        </div>
        <div style="margin:5px 15px;width:50%;">
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

        mywindow.document.write('<html><head><title>Form21_<?=$sql_report_result['name'];?></title>');
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