<?php
include 'config.php';
date_default_timezone_set('Asia/Calcutta');
$id = $_GET['id'];

$sql = "SELECT * FROM newdischarge_summary WHERE id='$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

// Format dates and times
$admissionDate = date("d M Y", strtotime($row['add_date']));
$admissionTime = date("g:i a", strtotime($row['add_time']));
$dischargeDate = date("d M Y", strtotime($row['datedis']));
$dischargeTime = date("g:i a", strtotime($row['timedis']));
?>

<style type="text/css">
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
</style>

<div id="maindiv">
    <div>
        <table>
            <tr>
                <td><img src="images\gdh.jpg" height="100" width="250" /></td>
                <td align="center">
                    <div align="center"><b>GINDODI DEVI MEMORIAL CHARITABLE HOSPITAL & RESEARCH CENTER
                        </b> </div>
                    <p align="center">( Run By: Beena Health Care Charitable Trust )<br>G.E. ROAD, KHURSIPAR - 490
                        012 (C.G.)<br>PHONE: 0788-3594666 </p>
                </td>
            </tr>
        </table>
    </div>
    <hr>


    <table border="1" width="100%">
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

    <br>
    <table border="1" width="100%">
        <tr>
            <td width="17%"><b>Primary Consultant:</b></td>
            <td width="28.3%"><?= $row['consult_doc']; ?></td>
            <td width="30.3%"><b>Department:</b></td>
            <td><?= $row['dept1']; ?></td>
        </tr>
        <?php if ($row['consult_doc_1'] != '') { ?>
        <tr>
            <td><b>Consultant 1:</b></td>
            <td><?= $row['consult_doc_1']; ?></td>
            <td><b>Department:</b></td>
            <td><?= $row['dept2']; ?></td>
        </tr>
        <?php } ?>
        <?php if ($row['consult_doc_1'] != '') { ?>
        <tr>
            <td><b>Consultant 2:</b></td>
            <td><?= $row['consult_doc_2']; ?></td>
            <td><b>Department:</b></td>
            <td><?= $row['dept3']; ?></td>
        </tr>
        <?php } ?>
    </table>

    <br>

    <table border="1" width="100%">
        <tr>
            <td><b>Diagnosis:</b></td>
        </tr>
        <tr>
            <td colspan="4"><?= $row['diagnosis']; ?></td>
        </tr>
        <tr>
            <td><b>History:</b></td>
        </tr>
        <tr>
            <td colspan="4"><?= $row['h_o']; ?></td>
        </tr>
    </table>

    <br>

    <table border="1" width="100%" border-collapse>
        <tr>
            <td><b>Clinical Examination on Admission:</b></td>
        </tr>
        <tr>
            <td width="100%">
                <table width="100%">
                    <tr>
                        <td><b>PULSE: </b><?= $row['pulse']; ?></td>
                        <td><b>CVS: </b> <?= $row['cvs']; ?></td>

                    </tr>
                    <tr>
                        <td><b>BP: </b><?= $row['BP']; ?></td>
                        <td><b>CNS: </b><?= $row['cns']; ?></td>

                    </tr>
                    <tr>
                        <td><b>TEMPERATURE: </b> <?= $row['temp']; ?></td>
                        <td><b>RS: </b><?= $row['rs']; ?></td>
                    </tr>
                    <tr>
                        <td><b>R/R: </b><?= $row['rr']; ?></td>
                        <td><b>P/A: </b> <?= $row['p_a']; ?></td>
                    </tr>
                    <tr>
                        <td><b>SPO2: </b><?= $row['spo2']; ?></td>
                        <td><b>LOCAL EXAMINATION: </b> <?= $row['local_examination']; ?></td>
                    </tr>
                </table>
            </td>

        </tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr>
            <td><b>Hospital Course:</b></td>
        </tr>
        <tr>
            <td colspan="4"><?= $row['course_hospital']; ?></td>
        </tr>
    </table>
    <br>

    <table border="1" width="100%">
        <tr>
            <td><b>Operation Details:</b></td>
        </tr>
        <tr>
            <td colspan="4"><?= $row['operation_details']; ?></td>
        </tr>
    </table>

    <br>
    <table border="1" width="100%">
        <tr>
            <td><b>Investigations:</b></td>
        </tr>
        <tr>
            <td colspan="4">
                <?php echo "Detailed Printed reports given to the patient.<br>"; ?>

                <?= $row['investigation']; ?>
            </td>
        </tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr>
            <td><b>Condition at Discharge:</b></td>
        </tr>
        <tr>
            <td colspan="4"><?= $row['cond_discharge']; ?></td>
        </tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr>
            <td><b>Advice at Discharge/Medication:</b></td>
        </tr>
        <tr>
            <td colspan="4">
                <?php echo "RX" . "<br>"; ?>
                <?= $row['med_adv_discharge']; ?>
            </td>
        </tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr>
            <td><b>WHEN TO OBTAIN URGENT CARE</b></td>
        </tr>
        <tr>
            <td>IF PATIENT DEVELOP, HEADACHE, VOMITING, NAUSEA, THEN INFORM YOUR DOCTOR</td>
        </tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr>
            <td><b>HOW TO OBTAIN URGENT CARE</b></td>
        </tr>
        <tr>
            <td>
                PLEASE CONTACT THE CONSULTANT IN CASE OF ANY EMERGENCY,<br>APPROACH CASUALTY MEDICAL OFFICER, GINDODI
                DEVI MEMORIAL<br> (PHONE NO - 0788 359 46 66)
            </td>
        </tr>
    </table>


    <br>
    <table border="1" width="100%">
        <tr>
            <td><b>Prepared By:</b></td>

            <td align="left"><b>Authorized By:</b></td>

        </tr>
    </table>

</div>

</>

<p align="center"><a href="#" onclick="divprint()">Print</a></p>
<p align="center"><a href="view_dischargesummary.php">Back</a></p>

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