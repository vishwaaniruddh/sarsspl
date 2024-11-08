<?php
// Database connection
include 'config.php';

//Fetch data
$id = $_GET['id'];


//addmission table

$sql = "SELECT * FROM admission WHERE ad_id='$id'";
$add_result = mysqli_query($con, $sql);
$add_row = mysqli_fetch_assoc($add_result);
$ad_id = $add_row['ad_id'];
$patient_id = $add_row['patient_id'];

$discharge_date = $add_row['dis_date'];
$discharge_date = date('d-m-Y', strtotime($discharge_date));

$discharge_time = $add_row['dis_time'];
$discharge_time = date('H:i:s a', strtotime($discharge_time));

$admit_date = $add_row['admit_date'];
$admit_date = date('d-m-Y', strtotime($admit_date));

$admit_time = $add_row['admit_time'];
$admit_time = date('H:i:s a', strtotime($admit_time));


//patient table

$sql1 = "select * from patient where no='$patient_id' ";
$result1 = mysqli_query($con, $sql1);
$patient_result = mysqli_fetch_assoc($result1);

//discharge table

$disc_sql = mysqli_query($con, "select * from discharge where ad_id = '$ad_id' ");
$discharge_result = mysqli_fetch_assoc($disc_sql);



// discharge details table
// $discharge_details =  "select * from discharge_details where ad_id = '$ad_id' ";

function get_procedure($code)
{
    global $con;
    $proc_name = mysqli_query($con, "select investigation from procedures where investigation<>'' and id = '$code' order by investigation");
    $proc_name_result = mysqli_fetch_assoc($proc_name);
    $investigation = $proc_name_result['investigation'];

    return $investigation;
}

function get_procedure2($code)
{
    global $con;
    $proc_name = mysqli_query($con, "select name from other_charges where id = '$code' order by name");
    $proc_name_result = mysqli_fetch_assoc($proc_name);
    $pname = $proc_name_result['name'];

    return $pname;
}

function get_medical_stores($code)
{
    global $con;
    $store_sql = mysqli_query($con, "select name from medical_stores where id = '$code' order by name ");
    $store_name_result = mysqli_fetch_assoc($store_sql);
    $name = $store_name_result['name'];

    return $name;
}

// $conn->close();
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

        .header-section .row {
            display: flex;
            flex-wrap: wrap;
        }

        .header-section .row .column {
            flex: 1;
            padding: 5px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

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
        th {
            margin-trim: block;
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

        .bottom {
            font-size: small;
            font-weight: 400;
        }
    </style>
    <style>
        .right-align-table {
            font-size: small;
            width: 100%;
            text-align: right;
            background-color: blueviolet;
        }

        .right-align-table tr {
            font-size: small;
            width: 100%;
            text-align: right;
            background-color: red;
        }

        .right-align-table td {
            text-align: right;
            width: 100%;
            background-color: pink;
        }
    </style>
</head>



<body>
    <div class="container" id="maindiv">
        <div>
            <table border="1" width="100%">
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
        <div class="header-section">
            <table border="1" style="width:100%;">
                <tr>
                    <td style="vertical-align:top; width:50%;">
                        <p><strong>Bill no. :</strong> <?php echo $data['bill_no']; ?></p>
                        <p><strong>Registration No. :</strong> <?php echo $data['indoor_reg_no']; ?></p>
                        <p><strong>Name :</strong> <?php echo $patient_result['name']; ?></p>
                        <p><strong>Age/Sex :</strong> <?= $patient_result['age']; ?>/<?= $patient_result['sex']; ?></p>
                        <p><strong>Address :</strong> <?php echo $patient_result['address']; ?></p>
                        <p><strong>Date of Referral :</strong> <?php echo $data['date_of_referral']; ?></p>
                        <p><strong>Diagnosis :</strong> <?php echo $discharge_result['diagnosis']; ?></p>
                        <p><strong>Date/Time of Admission :</strong> <?php echo $admit_date; ?> <?= $admit_time; ?></p>

                    </td>
                    <td style="vertical-align:top; width:50%;">
                        <p><strong>Contact No:</strong> <?php echo $patient_result['mobile']; ?></p>
                        <p><strong>Insurance Number/Staff Card No/Pensioner Card No. :</strong>
                            <?php echo $discharge_result['insurance_no']; ?></p>
                        <p><strong>Insurance Pensioner Name :</strong>
                            <?php echo $discharge_result['pensioner_name']; ?>
                        </p>
                        <p><strong>Referral SL.No. (Routine)/Emergency/Referred through SSMC/SSMC :</strong>
                            <?php echo $discharge_result['ref_no']; ?>
                        </p>
                        <p><strong>Consultant :</strong> <?php echo $discharge_result['consultant']; ?></p>
                        <p><strong>Department :</strong> <?php echo $discharge_result['department']; ?></p>
                        <p><strong>Date of Discharge :</strong> <?php echo $discharge_date; ?>
                            <?php echo $discharge_time; ?></p>
                    </td>
                </tr>
            </table>
            <table border="1" width="100%">
                <tr>
                    <td colspan="2">
                        <p><strong>Condition of the patient at discharge : </strong>
                            <?php echo $discharge_result['condi']; ?></p>

                    </td>
                </tr>
            </table>
        </div>


        <div class="section">
            <h3>(For Package rates)</h3>
            <h4>Treatment/Procedure done/performed :</h4>
            <h3>I. Existing in the package rates (list) and other chargeable procedures:</h3>
            <table border="1" width="100%">
                <tr>
                    <th>Sr No.</th>
                    <th>CharSrable Procedure</th>
                    <th>CGHS Code no with page no (1)</th>
                    <th>Other if not on prescribed code no with page no</th>
                    <th>Rate</th>
                    <th>Qty</th>
                    <th>Amt. Claimed</th>
                    <th>Date of Claim</th>
                    <th>Amt. Admitted with date</th>
                    <th>Remarks (X)</th>
                </tr>

                <?php

                $i = 1;
                $discharge_details = " select * from discharge_details where ad_id = '$ad_id' and type = '1' order by type asc";
                $discharge_details_result = mysqli_query($con, $discharge_details);
                $num_rows = mysqli_num_rows($discharge_details_result);
                while ($details1 = mysqli_fetch_assoc($discharge_details_result)) {
                    $code = $details1['code'];
                    $getprocedurename = get_procedure($code);

                ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $getprocedurename; ?></td>
                        <td><?= $code; ?></td>
                        <td></td>
                        <td><?= $details1['rate'] ?></td>
                        <td><?= $details1['qty']; ?></td>
                        <td><?= $details1['claimed']; ?></td>
                        <td><?= $details1['claim_date']; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php $i++;
                } ?>
            </table>
            <table border="1" width="100%">
                <tr>
                    <td><b>Charges of Implant/device used :</b></td>
                    <td><?= $discharge_result['implant']; ?></td>
                    <td><b>Amount Claimed(I):</b></td>
                    <td><?= $discharge_result['amt1']; ?></td>
                </tr>
                <tr>
                    <td><b>Amount Admitted (I): </b></td>
                    <td><?= $discharge_result['amtad1']; ?></td>
                    <td><b>Remarks:</b></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="section">
            <h3>II. Non-package Rates: For procedures done (not existing in the list of packages rates)</h3>
            <table border="1" width="100%">
                <tr>
                    <th>Sr No.</th>
                    <th>Chargeable Procedure</th>
                    <th>Rate</th>
                    <th>Qty</th>
                    <th>Amt. Claimed</th>
                    <th>Date of Claim</th>
                    <th>Amt. Admitted with date</th>
                    <th>Remarks (X)</th>
                </tr>
                <?php

                $i = 1;
                $discharge_details = "select * from discharge_details where ad_id = '$ad_id' and type = '2' order by type asc";
                $discharge_details_res = mysqli_query($con, $discharge_details);
                $num_rows = mysqli_num_rows($discharge_details_res);
                while ($details2 = mysqli_fetch_assoc($discharge_details_res)) {
                    $code = $details2['code'];
                    $getprocedurename = get_procedure2($code);

                ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $getprocedurename; ?></td>

                        <td><?= $details2['rate'] ?></td>
                        <td><?= $details2['qty']; ?></td>
                        <td><?= $details2['claimed']; ?></td>
                        <td><?= $details2['claim_date']; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php $i++;
                } ?>

            </table>
            <table border="1" width="100%">
                <tr>
                    <td><b>Amount Claimed(II):</b></td>
                    <td><?= $discharge_result['amt2']; ?></td>
                    <td><b>Amount Admitted (II): </b></td>
                    <td><?= $discharge_result['amtad2']; ?></td>
                </tr>
            </table>
        </div>
        <div class="section">
            <h3>III. Additional Procedure done with rationale and documented permission</h3>
            <table border="1" width="100%">
                <tr>
                    <th>Sr No.</th>
                    <th>Chargeable Procedure</th>
                    <th>CGHS Code no with page no (1)</th>
                    <th>Other if not on prescribed code no with page no</th>
                    <th>Rate</th>
                    <th>Qty</th>
                    <th>Amt. Claimed</th>
                    <th>Date of Claim</th>
                    <th>Amt. Admitted with date</th>
                    <th>Remarks (X)</th>
                </tr>
                <?php

                $i = 1;
                $discharge_details = "select * from discharge_details where ad_id = '$ad_id'  and type = '3' order by type asc";
                $discharge_details_result = mysqli_query($con, $discharge_details);
                $num_rows = mysqli_num_rows($discharge_details_result);
                while ($details3 = mysqli_fetch_assoc($discharge_details_result)) {
                    $code = $details3['code'];
                    $getprocedurename = get_procedure($code);

                ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $getprocedurename; ?></td>
                        <td><?= $code; ?></td>
                        <td></td>
                        <td><?= $details3['rate'] ?></td>
                        <td><?= $details3['qty']; ?></td>
                        <td><?= $details3['claimed']; ?></td>
                        <td><?= $details3['claim_date']; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php $i++;
                } ?>
            </table>
            <table border="1" width="100%">
                <tr>
                    <td><b>Amount Claimed(III):</b></td>
                    <td><?= $discharge_result['amt3']; ?></td>
                    <td><b>Amount Admitted (III): </b></td>
                    <td><?= $discharge_result['amtad3']; ?></td>
                </tr>
            </table>
        </div>
        <div class="section">
            <h3>IV. Medicine Bills</h3>
            <table border="1" width="100%">
                <tr>
                    <th>Sr No.</th>
                    <th>Store Name</th>
                    <th>Bill No.</th>
                    <th>Amt. Claimed</th>
                    <th>Date of Claim</th>
                    <th>Amt. Admitted with date</th>
                    <th>Remarks (X)</th>
                </tr>
                <?php

                $i = 1;
                $discharge_details = "select * from discharge_details where ad_id = '$ad_id' and type = '4' order by type asc";
                $discharge_details_result = mysqli_query($con, $discharge_details);
                $num_rows = mysqli_num_rows($discharge_details_result);
                while ($details4 = mysqli_fetch_assoc($discharge_details_result)) {
                    $code = $details4['code'];
                    $getstorename = get_medical_stores($code);



                ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $getstorename; ?></td>
                        <td><?= $details4['other']; ?></td>


                        <td><?= $details4['claimed']; ?></td>
                        <td><?= $details4['claim_date']; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php $i++;
                } ?>
            </table>
            <br>
            <table border="1" width="100%">
                <tr>
                    <td><b>Amount Claimed(IV):</b></td>
                    <td><?= $discharge_result['amt4']; ?></td>
                    <td><b>Amount Admitted (IV): </b></td>
                    <td><?= $discharge_result['amtad4']; ?></td>
                </tr>
            </table>
            <br>
            <table border="1" width="100%">
                <tr>
                    <table border="1" width="100%">
                        <tr>
                            <td><b>Total Amount Claimed(I+II+III+IV) ₹:</b></td>
                            <td><?= $discharge_result['totalamt']; ?></td>

                        </tr>
                        <tr>
                            <td width="27%"><b>Total Amount Admitted (X)(I+II+III+IV) ₹: </b></td>
                            <td><?= $discharge_result['totalamtad']; ?></td>
                            <td width="20%"><b>Remarks: </b></td>
                            <td width="35%"><?= $discharge_result['remarks']; ?></td>
                        </tr>
                    </table>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td>
                        Certified that the treatment/procedure has been done/performed as per laid down norms and the
                        charges in
                        the bill has/ have been claimed as per the Terms & Conditions laid down in the agreement
                        signed with ESIC.
                        <br>
                        Further certified that the treatment/ procedure have been performed on cashless basis.<br> No
                        money has been
                        received /demanded/ charged from the patient/ his/her relative.
                    </td>
                </tr>
            </table>
            <br><br>
            <table width="100%">
                <tr>
                    <td><b>Sign/Thumb Impression of Patient with date:</b></td>

                    <td align="right"><b>Sign & Stamp of Authorised Signatory with date:</b></td>

                </tr>
            </table>
            <hr>
            <div style="text-align:center;font-size:small;">(for Official use of ESIC)</div>
            <br>
            <table width="100%">
                <tr>
                    <td class="bottom" colspan="30">Signature of Dealing Assistant:</td>

                    <td align="left" class="bottom">Signature of Superintendent</td>

                </tr>
            </table>
            <!-- <br>
            <table class="right-align-table">
                <tr>
                    <td></td>
                    <td colspan="10" align="right">
                        Total Amount Payable : ______________
                        <br>
                        Date of Payment : ______________
                    </td>
                </tr>
            </table> -->

            <div style="display:flex;  justify-content:flex-end;">
                <div style="font-size:small; width:40%;">
                    <div>
                        Total Amount Payable : ______________
                    </div>
                    <div>
                        Date of Payment : ______________
                    </div>
                </div>

            </div>


            <br>

            <table width="100%">
                <tr>
                    <td class="bottom" colspan="50">Date:</td>

                    <td align="right" class="bottom">Signature of ESIC Competent Authority (MS/SMC/SSMC)</td>

                </tr>
            </table>
            <table style="text-align:left; font-size:small">
                <tr>
                    <td style="text-align:start">
                        1. Discharge Slip containing treatment summary & detailed treatment record.<br>
                        2. Bill(s) of Implant(s)/ Stent(s) /device along with Pouch/Packet/Invoice etc. <br>
                        3. Photocopies of referral proforma, Insurance Card/ Photo I-card of IP/referal recommendation
                        of medical officer & entitilement certificate. Approval letter from SMC/SSMC in case of
                        emergency treatment or additional procedure performed. <br>
                        4. Sign & Stamo of Authorised Signatory. <br>
                        5. Patient/Attendant satisfaction certificate. <br>
                        6. Document in favour of permissiontaken for additional procedure/treatment or investigation.
                        <br>
                        <br>
                        <b>(X) to be filled by ESIC Official(s).</b>

                    </td>

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
            mywindow.document.write('<html><head><title>ESI BILL</title>');
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