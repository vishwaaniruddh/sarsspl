<?php
// Database connection
include 'config.php';

// Sanitize input to prevent SQL injection
$id = intval($_GET['id']);

// Fetch admission details
$sql = $con->prepare("SELECT * FROM admission WHERE ad_id = ?");
$sql->bind_param('i', $id);
$sql->execute();
$add_result = $sql->get_result();
$add_row = $add_result->fetch_assoc();

$ad_id = $add_row['ad_id'];
$patient_id = $add_row['patient_id'];

$discharge_date = date('d-m-Y', strtotime($add_row['dis_date']));
$discharge_time = date('H:i:s a', strtotime($add_row['dis_time']));

// Fetch patient details
$sql1 = $con->prepare("SELECT * FROM patient WHERE no = ?");
$sql1->bind_param('i', $patient_id);
$sql1->execute();
$result1 = $sql1->get_result();
$patient_result = $result1->fetch_assoc();

// Fetch discharge details
$disc_sql = $con->prepare("SELECT * FROM discharge WHERE ad_id = ?");
$disc_sql->bind_param('i', $ad_id);
$disc_sql->execute();
$discharge_result = $disc_sql->get_result()->fetch_assoc();

function get_procedure($code, $con)
{
    $proc_name = $con->prepare("SELECT investigation FROM procedures WHERE investigation<>'' AND id = ? ORDER BY investigation");
    $proc_name->bind_param('i', $code);
    $proc_name->execute();
    $proc_name_result = $proc_name->get_result()->fetch_assoc();
    return $proc_name_result['investigation'];
}

function get_procedure2($code, $con)
{
    $proc_name = $con->prepare("SELECT name FROM other_charges WHERE id = ? ORDER BY name");
    $proc_name->bind_param('i', $code);
    $proc_name->execute();
    $proc_name_result = $proc_name->get_result()->fetch_assoc();
    return $proc_name_result['name'];
}

function get_medical_stores($code, $con)
{
    $store_sql = $con->prepare("SELECT name FROM medical_stores WHERE id = ? ORDER BY name");
    $store_sql->bind_param('i', $code);
    $store_sql->execute();
    $store_name_result = $store_sql->get_result()->fetch_assoc();
    return $store_name_result['name'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printable Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            width: 100%;
        }

        .header-section,
        .section {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #000;
            page-break-inside: avoid;
        }

        .header-section .row,
        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .header-section .row .column,
        .row .column {
            flex: 1;
            padding: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .print-button {
            display: block;
            margin: 20px 0;
        }

        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container" id="maindiv">
        <div>
            <table>
                <tr>
                    <td><img src="images/gdh.jpg" height="100" width="250" /></td>
                    <td align="center">
                        <div><b>GINDODI DEVI MEMORIAL CHARITABLE HOSPITAL & RESEARCH CENTER</b></div>
                        <p>(Run By: Beena Health Care Charitable Trust)<br>G.E. ROAD, KHURSIPAR - 490 012 (C.G.)<br>PHONE: 0788-3594666</p>
                    </td>
                </tr>
            </table>
        </div>
        <hr>
        <div class="header-section">
            <div class="row">
                <div class="column">
                    <p><strong>Bill no. : </strong><?php echo $data['bill_no']; ?></p>
                    <p><strong>Name : </strong><?php echo $patient_result['name']; ?></p>
                    <p><strong>Age/Sex : </strong><?php echo $patient_result['age']; ?>/<?php echo $patient_result['sex']; ?></p>
                    <p><strong>Address : </strong><?php echo $patient_result['address']; ?></p>
                </div>
                <div class="column">
                    <p><strong>Contact No:</strong> <?php echo $patient_result['mobile']; ?></p>
                    <p><strong>Insurance Number/Staff Card No/Pensioner Card No. : </strong><?php echo $data['insurance_no']; ?></p>
                    <p><strong>Insurance Pensioner Name :</strong> <?php echo $data['insurance_pensioner_name']; ?></p>
                    <p><strong>Referral SL.No. (Routine/Emergency) :</strong> <?php echo $data['referral_sl_no']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <p><strong>Referred through SSMC/SSMC :</strong> <?php echo $data['referred_through']; ?></p>
                    <p><strong>Date of Referral :</strong> <?php echo $data['date_of_referral']; ?></p>
                    <p><strong>Date/Time of Admission :</strong> <?php echo $admit_date; ?> <?php echo $adtime; ?></p>
                    <p><strong>Department :</strong> <?php echo $discharge_result['department']; ?></p>
                </div>
                <div class="column">
                    <p><strong>Consultants :</strong> <?php echo $discharge_result['consultants']; ?></p>
                    <p><strong>Diagnosis :</strong> <?php echo $discharge_result['diagnosis']; ?></p>
                    <p><strong>Date of Discharge :</strong> <?php echo $discharge_date; ?></p>
                    <p><strong>Time of Discharge :</strong> <?php echo $discharge_time; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <p><strong>Condition of the patient at discharge :</strong></p>
                    <p><?php echo $data['condition_at_discharge']; ?></p>
                </div>
            </div>
        </div>
        <?php
        function render_table($con, $ad_id, $type, $header, $columns)
        {
            $discharge_details = $con->prepare("SELECT * FROM discharge_details WHERE ad_id = ? AND type = ? ORDER BY type ASC");
            $discharge_details->bind_param('ii', $ad_id, $type);
            $discharge_details->execute();
            $discharge_details_result = $discharge_details->get_result();
            $i = 1;
            echo "<div class='section'>";
            echo "<h3>$header</h3>";
            echo "<table>";
            echo "<tr>";
            foreach ($columns as $col) {
                echo "<th>$col</th>";
            }
            echo "</tr>";
            while ($details = $discharge_details_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>$i</td>";
                foreach ($details as $key => $value) {
                    if ($key === 'code') {
                        if ($type == 1) {
                            echo "<td>" . get_procedure2($value, $con) . "</td>";
                        } else {
                            echo "<td>" . get_procedure($value, $con) . "</td>";
                        }
                    } else {
                        echo "<td>$value</td>";
                    }
                }
                echo "</tr>";
                $i++;
            }
            echo "</table>";
            echo "</div>";
        }

        render_table($con, $ad_id, 1, "I. Existing in the package rates (list) and other chargeable procedures:", ["Sr No.", "Chargeable Procedure", "CGHS Code no with page no (1)", "Other if not on prescribed code no with page no", "Rate", "Qty", "Amt. Claimed", "Date of Claim", "Amt. Admitted with date", "Remarks (X)"]);
        render_table($con, $ad_id, 2, "II. Non-package Rates: For procedures done (not existing in the list of packages rates)", ["Sr No.", "Chargeable Procedure", "Rate", "Qty", "Amt. Claimed", "Date of Claim", "Amt. Admitted with date", "Remarks (X)"]);
        render_table($con, $ad_id, 3, "III. Additional Procedure done with rationale and documented permission", ["Sr No.", "Chargeable Procedure", "CGHS Code no with page no (1)", "Other if not on prescribed code no with page no", "Rate", "Qty", "Amt. Claimed", "Date of Claim", "Amt. Admitted with date", "Remarks (X)"]);
        render_table($con, $ad_id, 4, "IV. Medicine Bills", ["Sr No.", "Store Name", "Bill No.", "Amt. Claimed", "Date of Claim", "Amt. Admitted with date", "Remarks (X)"]);
        ?>
        <p align="center"><a href="#" onclick="divprint()" class="print-button">Print</a></p>
        <p align="center"><a href="home.php" class="print-button">Back</a></p>
    </div>

    <script>
        function divprint() {
            var printContent = document.getElementById('maindiv').outerHTML;
            var mywindow = window.open('', 'GDH', 'height=400,width=600');
            mywindow.document.write('<html><head><title>Discharge Summary_<?php echo $patient_result['name']; ?></title>');
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