<?php

include 'config.php';
date_default_timezone_set('Asia/Calcutta');
$id = $_GET['id'];

$sql = "SELECT * FROM newdischarge_summary WHERE id='" . $id . "'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$bill_id = $row['id'];

$observation = $row['observation'];

$admissionDate = $row['add_date'];
$admissionDt = date("d M Y", strtotime($admissionDate));

$admissionTime = $row['add_time'];
$admTime = date("g:i a", strtotime($admissionTime));

$dischargeDate = $row['datedis'];
$dischargeDt = date("d M Y", strtotime($dischargeDate));

$dischargeTime = $row['timedis'];
$disTime = date("g:i a", strtotime($dischargeTime));


?>

<style type="text/css">
/* Define print-specific styles here */
body {
    font-size: 12pt;
}

/* Define print-specific styles here */
@page {
    margin-top: 50px;
    margin-bottom: 50px;
}

header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 50px;
    text-align: center;
    background-color: #f5f5f5;
    padding: 10px;
}

footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    height: 50px;
    text-align: center;
    background-color: #f5f5f5;
    padding: 10px;
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
    <!-- <p align="center"><b>IPD BILL NO.
            <?= $id; ?>
        </b>
    </p>
    <hr> -->

    <!-- Particulars Section -->
    <table border="1" width="100%">


        <p align="center"><b>IPD BILL NO.
                <?= $id; ?>
            </b>
        </p>

        <tr>
            <td><b>Full Name:</b></td>
            <td>
                <?php if (isset($row['name'])) {
                    echo $row['name'];
                } ?>
            </td>
            <td align="left"><b>INDOOR REG. NO:</b></td>
            <td>
                <?php if (isset($row['indoor_reg_no'])) {
                    echo $row['indoor_reg_no'];
                } ?>
            </td>
        </tr>
        <tr>
            <td><b>Age/Gender:</b></td>
            <td>
                <?php echo $row['age']; ?>/
                <?php echo $row['gender']; ?>
            </td>
            <td align="left"><b>Admission Date & Time:</b></td>
            <td>
                <?php echo $admissionDt . '  ' . $admTime; ?>
            </td>
        </tr>
        <tr>
            <td><b>Mobile No:</b></td>
            <td>
                <?php echo $row['contact_no']; ?>
            </td>
            <td align="left"><b>Discharge Date & Time:</b></td>
            <td>
                <?php echo $dischargeDt . '  ' . $disTime; ?>
            </td>
        </tr>
        <tr style="width:100%">
            <td><b>Address:</b></td>
            <td>
                <?php echo $row['address']; ?>
            </td>
            <td><b>Payment Mode :</b></td>
            <td>
                <?php echo $row['payment_mode']; ?>
            </td>
        </tr>
        <tr>
            <td><b>Consultant Doctor:</b></td>
            <td>
                <?php if (isset($row['consult_doc'])) {
                    echo $row['consult_doc'];
                } ?>
            </td>
        </tr>
    </table>
    <br>

    <table width="100%">

        <tr>

            <th>Diagnosis : </th>
            <th><?= $row['diagnosis']; ?></th>

        </tr>
        <tr>
            <th>History: </th>

        </tr>
        <tr>
            <td><?= $row['chief_complain']; ?></td>
        </tr>
    </table>



    <table border="1" width="100%">

        <tr>
            <th>Particulars</th>
            <th>Quantity</th>
            <th>Rate (₹)</th>
            <th>Amount (₹)</th>
        </tr>
        <?php while ($row1 = mysqli_fetch_assoc($result1)) : ?>
        <tr>
            <td align="center">
                <?php echo $row1['particulars']; ?>
            </td>
            <td align="center">
                <?php
                    if ($row1['quantity']) {
                        echo $row1['quantity'];
                    } else {
                        echo 0;
                    } ?>
            </td>
            <td align="center">
                <?php
                    if ($row1['rate'] != '') {
                        echo $row1['rate'];
                    } else {
                        echo "0";
                    } ?>
            </td>
            <td align="center">
                <?php echo $row1['amount']; ?>
            </td>
        </tr>
        <?php endwhile; ?>
        <!-- Add more rows if needed -->

        <!-- Total Amount Section -->
        <tr>
            <td colspan="3" align="right"><b>Total Amount (₹):</b></td>
            <td align="center"><b>
                    <?php echo $row['t_amt']; ?>
                </b></td>
        </tr>

        <!-- Discount Section -->
        <tr>
            <td colspan="3" align="right"><b>Discount (₹):</b></td>
            <td align="center"><b>
                    <?php $discountamt = $row['discount'];
                    if (isset($discountamt)) {
                        echo $discountamt . '.00';
                    } else {
                        echo "0.00";
                    }; ?>
                </b></td>
        </tr>

        <!-- Advance Amount Section -->
        <tr>
            <td colspan="3" align="right"><b>Advance Amount (₹):</b></td>
            <td align="center"><b>
                    <?php echo $row['advanceAmount'] . ".00"; ?>
                </b></td>
        </tr>

        <!-- Paid Amount Section -->
        <tr>
            <td colspan="3" align="right"><b>Amount to be Paid (₹):</b></td>
            <td align="center"><b>
                    <?php echo $row['paid_amt']; ?>
                </b></td>
        </tr>

    </table>
    <!-- Prepared By and Authorized By Section -->
    <table border="1" width="100%">
        <tr>
            <td><b>Prepared By:</b></td>

            <td align="left"><b>Authorized By:</b></td>

        </tr>
    </table>
    <table border="1" width="100%">
        <tr>
            <td align="center">NOTE: Cheque/DD will issue in favor of <b>BEENA HEALTH CARE</b></td>
        </tr>
    </table>
</div>

<p align="center"><a href="#" onclick="divprint()">Print</a></p>
<p align="center"><a href="home.php">Back</a></p>
<script>
function divprint() {
    var printContent = document.getElementById('maindiv').outerHTML;
    var mywindow = window.open('', 'GDH', 'height=400,width=600');
    mywindow.document.write('<html><head><title>Print</title>');
    mywindow.document.write('</head><body>');
    mywindow.document.write(printContent);
    mywindow.document.write('</body></html>');

    mywindow.document.close();
    mywindow.print();
    // mywindow.close();

    return false;
}
</script>