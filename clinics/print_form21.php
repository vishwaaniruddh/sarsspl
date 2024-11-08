<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM 21</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    .container {
        width: 800px;
        margin: 0 auto;
        border: 1px solid #000;
        padding: 20px;
    }

    .header {
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .section {
        margin-bottom: 20px;
    }

    .section-title {
        font-weight: bold;
        text-decoration: underline;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 5px;
        text-align: left;
    }

    .print-button {
        text-align: center;
        margin-top: 20px;
    }

    .print-button button {
        padding: 10px 20px;
        font-size: 16px;
    }
    </style>
    <!-- <style type="text/css">
    /* Define print-specific styles here */
    body {
        font-size: 12pt;
        margin: 0;
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
        border: 1px solid black;
        padding: 8px;
        text-align: left;
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
    </style> -->
</head>

<?php

include 'config.php';

$form21Query = mysqli_query($con, "select * from form_21 where id='1' ");
$form_21_sql = mysqli_fetch_assoc($form21Query);

$id = $form_21_sql['id'];


?>

<body>

    <div class="container" id="mainDiv">
        <div class="header">
            <u><b>FORM 21</b></u><br>
            [Prescribed under Rule (19)]<br>
            (In respect of persons employed in occupations declared to be dangerous operations under Section 87)
            <!-- Pre-Employment / Periodic Medical Examination -->
        </div>

        <!-- General Information -->

        <table border="1" width="100%">
            <tr>
                <td><b>NAME OF CERTIFYING PERSON</b></td>
                <td><?=$form_21_sql['certifying_person_name']?></td>
            </tr>
            <tr>
                <td><b>UHID:</b></td>
                <td><?= $id ?></td>
                <td><b>IPD NO:</b></td>
                <td><?= $row['indoor_reg_no']; ?></td>
            </tr>
            <tr>
                <td><b>Name:</b></td>
                <td><?= $row['name']; ?></td>
                <td><b>Bed No.:</b></td>
                <td><?= $row['bed_no']; ?></td>


            </tr>
            <tr>
                <td><b>Age/Gender:</b></td>
                <td><?= $row['age']; ?>/<?= $row['gender']; ?></td>
                <td><b>Admission Date & Time:</b></td>
                <td><?= $admissionDate . ' ' . $admissionTime; ?></td>

            </tr>
            <tr>
                <td><b>Mobile No.:</b></td>
                <td><?= $row['contact_no']; ?></td>
                <td><b>Discharge Date & Time:</b></td>
                <td><?= $dischargeDate . ' ' . $dischargeTime; ?></td>
            </tr>

            <tr>
                <td><b>Address:</b></td>
                <td><?= $row['address'];; ?></td>
                <td><b>Discharge Type:</b></td>
                <td><?= $row['discharge_type']; ?></td>
            </tr>
            <tr>
                <td><b>City:</b></td>
                <td><?= $row['city']; ?></td>
            </tr>
        </table>



        <!-- General Examination -->
        <div class="section">
            <div class="section-title">1. General Examination</div>
            <table>
                <tr>
                    <td>Height:</td>
                    <td id="height"></td>
                    <td>Weight:</td>
                    <td id="weight"></td>
                </tr>
                <tr>
                    <td>Measurement:</td>
                    <td id="measurement"></td>
                    <td>Expiration:</td>
                    <td id="expiration"></td>
                </tr>
                <tr>
                    <td>Built:</td>
                    <td id="built"></td>
                    <td>Throat:</td>
                    <td id="throat"></td>
                </tr>
                <tr>
                    <td>Tongue:</td>
                    <td id="tongue"></td>
                    <td>Teeth:</td>
                    <td id="teeth"></td>
                </tr>
                <tr>
                    <td>Lymph Nodes:</td>
                    <td id="lymph_nodes"></td>
                    <td>Additional Findings:</td>
                    <td id="additional_findings"></td>
                </tr>
            </table>
        </div>

        <!-- Cardio-Vascular System -->
        <div class="section">
            <div class="section-title">2. Cardio-Vascular System</div>
            <table>
                <tr>
                    <td>Pulse:</td>
                    <td id="pulse"></td>
                    <td>B.P:</td>
                    <td id="bp"></td>
                </tr>
                <tr>
                    <td>Murmur:</td>
                    <td id="murmur"></td>
                    <td>Additional Findings:</td>
                    <td id="cardio_additional_findings"></td>
                </tr>
            </table>
        </div>

        <!-- Respiratory System -->
        <div class="section">
            <div class="section-title">3. Respiratory System</div>
            <table>
                <tr>
                    <td>Shape of Chest:</td>
                    <td id="shape_of_chest"></td>
                    <td>Chest Movement:</td>
                    <td id="chest_movement"></td>
                </tr>
                <tr>
                    <td>Trachea:</td>
                    <td id="trachea"></td>
                    <td>Breath Sounds:</td>
                    <td id="breath_sounds"></td>
                </tr>
            </table>
        </div>

        <!-- Gastro-Intestinal System -->
        <div class="section">
            <div class="section-title">4. Gastro-Intestinal System</div>
            <table>
                <tr>
                    <td>Liver:</td>
                    <td id="liver"></td>
                    <td>Spleen:</td>
                    <td id="spleen"></td>
                </tr>
                <tr>
                    <td>Abdominal Lumps:</td>
                    <td id="abdominal_lumps"></td>
                </tr>
            </table>
        </div>

        <!-- Examination of Eyes -->
        <div class="section">
            <div class="section-title">5. Examination of Eyes</div>
            <table>
                <tr>
                    <td>External Exam:</td>
                    <td id="external_exam"></td>
                    <td>Squint:</td>
                    <td id="squint"></td>
                </tr>
                <tr>
                    <td>Nystagmus:</td>
                    <td id="nystagmus"></td>
                    <td>Colour Vision:</td>
                    <td id="colour_vision"></td>
                </tr>
                <tr>
                    <td>Individual Colour Identification:</td>
                    <td id="colour_identification"></td>
                </tr>
                <tr>
                    <td>Distant Vision (Without Glasses):</td>
                    <td id="distant_vision_without_glasses"></td>
                </tr>
                <tr>
                    <td>Near Vision (Without Glasses):</td>
                    <td id="near_vision_without_glasses"></td>
                </tr>
                <tr>
                    <td>Night Blindness:</td>
                    <td id="night_blindness"></td>
                </tr>
            </table>
        </div>

        <!-- Examination of Ears, Nose, and Throat -->
        <div class="section">
            <div class="section-title">6. Examination of Ears, Nose, and Throat</div>
            <table>
                <tr>
                    <td>External Exam:</td>
                    <td id="ent_external_exam"></td>
                </tr>
            </table>
        </div>

        <!-- Genito-Urinary System -->
        <div class="section">
            <div class="section-title">7. Genito-Urinary System</div>
            <table>
                <tr>
                    <td>Cryptorchidism:</td>
                    <td id="cryptorchidism"></td>
                    <td>Phimosis:</td>
                    <td id="phimosis"></td>
                </tr>
                <tr>
                    <td>Hernia:</td>
                    <td id="hernia"></td>
                    <td>Hydrocele/Varicocele:</td>
                    <td id="hydrocele"></td>
                </tr>
                <tr>
                    <td>Varicose Veins:</td>
                    <td id="varicose_veins"></td>
                    <td>Signs of STD:</td>
                    <td id="std"></td>
                </tr>
            </table>
        </div>

        <!-- Investigations -->
        <div class="section">
            <div class="section-title">Investigations</div>
            <table>
                <tr>
                    <td>HB%:</td>
                    <td id="hb"></td>
                    <td>TLC:</td>
                    <td id="tlc"></td>
                </tr>
                <tr>
                    <td>Neutrophils:</td>
                    <td id="neutrophils"></td>
                    <td>Lymphocytes:</td>
                    <td id="lymphocytes"></td>
                </tr>
                <tr>
                    <td>Eosinophils:</td>
                    <td id="eosinophils"></td>
                    <td>Monocytes:</td>
                    <td id="monocytes"></td>
                </tr>
                <tr>
                    <td>Basophils:</td>
                    <td id="basophils"></td>
                    <td>Total Platelet Count:</td>
                    <td id="platelet_count"></td>
                </tr>
                <tr>
                    <td>Lipid Profile:</td>
                    <td id="lipid_profile"></td>
                    <td>Serum Cholesterol:</td>
                    <td id="serum_cholesterol"></td>
                </tr>
                <tr>
                    <td>HDL:</td>
                    <td id="hdl"></td>
                    <td>LDL:</td>
                    <td id="ldl"></td>
                </tr>
                <tr>
                    <td>Hepatic Profile:</td>
                    <td id="hepatic_profile"></td>
                    <td>SGPT:</td>
                    <td id="sgpt"></td>
                </tr>
                <tr>
                    <td>SGOT:</td>
                    <td id="sgot"></td>
                    <td>Alkaline Phosphate:</td>
                    <td id="alkaline_phosphate"></td>
                </tr>
                <tr>
                    <td>Renal Profile:</td>
                    <td id="renal_profile"></td>
                    <td>Blood Urea:</td>
                    <td id="blood_urea"></td>
                </tr>
                <tr>
                    <td>Creatinine:</td>
                    <td id="creatinine"></td>
                    <td>Blood Sugar (Fasting):</td>
                    <td id="blood_sugar_fasting"></td>
                </tr>
                <tr>
                    <td>Blood Sugar (PP):</td>
                    <td id="blood_sugar_pp"></td>
                    <td>Uric Acid:</td>
                    <td id="uric_acid"></td>
                </tr>
            </table>
        </div>

        <!-- Other Investigations -->
        <div class="section">
            <div class="section-title">8. Other Investigations</div>
            <table>
                <tr>
                    <td>X-Ray Chest:</td>
                    <td id="xray_chest"></td>
                    <td>ECG:</td>
                    <td id="ecg"></td>
                </tr>
                <tr>
                    <td>USG Whole Abdomen:</td>
                    <td id="usg_abdomen"></td>
                </tr>
            </table>
        </div>

        <!-- Pulmonary Function Test -->
        <div class="section">
            <div class="section-title">10. Pulmonary Function Test</div>
            <table>
                <tr>
                    <td>FVC:</td>
                    <td id="fvc"></td>
                    <td>FEV1:</td>
                    <td id="fev1"></td>
                </tr>
                <tr>
                    <td>FEV1/FVC:</td>
                    <td id="fev1_fvc"></td>
                </tr>
            </table>
        </div>

        <!-- Audiometry -->
        <div class="section">
            <div class="section-title">11. Audiometry</div>
            <table>
                <tr>
                    <td>A PTA (R):</td>
                    <td id="pta_r"></td>
                    <td>B PTA (L):</td>
                    <td id="pta_l"></td>
                </tr>
            </table>
        </div>
    </div>
    <p align="center"><a href="#" onclick="divprint()">Print</a></p>
    <p align="center"><a href="home.php">Back</a></p>

    <script>
    function divprint() {
        var printContent = document.getElementById('maindiv').outerHTML;
        var mywindow = window.open('', 'GDH', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Discharge Summary_<?= $row['name']; ?></title>');
        mywindow.document.write('</head><body>');
        mywindow.document.write(printContent);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.print();
        // mywindow.close();

        return false;
    }
    </script>

</body>

</html>