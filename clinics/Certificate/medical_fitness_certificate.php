<?php
include "../config.php";

$id = $_GET['id'];

$sql = "SELECT * FROM emp_cert_details WHERE id='" . $id . "'";
$sql_qry = mysqli_query($con, $sql);
$sql_row = mysqli_fetch_assoc($sql_qry);

$cert_id = $sql_row['id'];
$date = date('d-m-Y', strtotime($sql_row['cert_date']));
$image = $sql_row['image'];

if ($cert_id) {
    $ge_sql = "SELECT * FROM general_examination WHERE cert_id='" . $cert_id . "'";
    $ge_sql_qry = mysqli_query($con, $ge_sql);
    $ge_sql_row = mysqli_fetch_assoc($ge_sql_qry);

    $se_sql = "SELECT * FROM systemic_examination WHERE cert_id='" . $cert_id . "'";
    $se_sql_qry = mysqli_query($con, $se_sql);
    $se_sql_row = mysqli_fetch_assoc($se_sql_qry);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Medical Fitness Certificate</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #printDiv {
            width: 100%;
            padding: 20px 80px;
        }

        #mainDiv {
            background-color: whitesmoke;
            width: 100%;
            border: 3px solid;
            padding: 20px;
            margin: 0px auto;
            margin-bottom: 10px;
        }

        .basic-details-section {
            width: 100%;
            height: 200px;
            display: flex;
            justify-content: space-between;
        }

        .img-section {
            width: 23%;
            height: 200px;
        }

        .img-section img {
            width: 100%;
            height: 100%;
            border: 1px solid;
        }

        .details-section {
            width: 100%;
            padding: 5px;
        }

        .name-section {
            margin-right: 200px;
        }

        .examination-section {
            display: flex;
            justify-content: space-around;
        }

        .mark-section {
            width: 87%;
            margin: 0 auto;
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sign-section {
            width: 87%;
            margin: 0 auto;
            margin-top: 30px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<!--  Medical fitness Certificate  -->

<body>

    <div id="printDiv">
        <div id="mainDiv">
            <div class="heading">
                <table align="center">
                    <tr>
                        <td>
                            <div align="center">
                                <h1>DISTRICT HOSPITAL</h1>
                            </div>
                            <h6 align="center">Durg (C.G.)<br> Medical Fitness Certificate </h6>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>

            <!-- basic details section -->
            <div class="basic-details-section" style="font-weight: 600">
                <div class="details-section">
                    <div class="w-100 d-flex justify-content-between">
                        <p><span style="font-weight: 600">Certificate No.:</span> <?php echo $cert_id; ?></p>
                        <p class="mr-5"><span style="font-weight: 600">Date:</span> <?php echo $date; ?></p>
                    </div>
                    <p style="font-weight: 600">This is to certify that I/We have examined:-</p>
                    <article><span class="name-section"><span style="font-weight: 600">Mr./Mrs./Ku.:
                            </span><?php echo $sql_row['name']; ?></span> <span><span style="font-weight: 600">S/D/W of:
                            </span><?php echo $sql_row['relative_name']; ?></span></article>
                    <article><span class="mr-5"><span style="font-weight: 600">Age/Sex:
                            </span><?php echo $sql_row['age'], "/", $sql_row['gender']; ?></span> <span> <span style="font-weight: 600">resident: </span><?php echo $sql_row['address']; ?></span>
                    </article>
                    <article><span style="font-weight: 600">Employee No.: </span><?php echo $sql_row['emp_id']; ?>
                    </article>

                </div>
                <div class="img-section"><img src="<?php echo $image; ?>" id="passport-photo" alt="passport-photo" />
                </div>
            </div>
            <p class="pt-3" style="font-weight: 600">History of Seizure/Paychological Disorderes/Chronic
                Disease/Congenenital abnormalities:- </p><br />
            <span class="ml-5" style="font-weight: 600">Details of Medical Examination</span> <br />
            <div class="examination-section mt-1">
                <div class="general_examination">
                    <table border="3" width="100%" style="font-weight: 600">
                        <thead align="center">
                            <th colspan="2">General Examination</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="300px">Pulse</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['pulse']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">B.P.</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['bp']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Height</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['height']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Weight</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['weight']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Pallor</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['pallor']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Edema</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['edema']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px" colspan="2"><b>Investigation</b></td>
                            </tr>
                            <tr>
                                <td width="300px">Hb</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['hb']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Blood Grouping/RH Factor</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['blood_grouping_rh_factor']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Blood Sugar</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['blood_sugar']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Sickling</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['sickling']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Other</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['other_1']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Urina R/M</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['urina_rm']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">X-Ray Chest</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['xray_chest']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">ECG</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['ecg']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Other</td>
                                <td align="center" width="25%"><?php echo $ge_sql_row['other_2']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="systemic_examination">
                    <table border="3" width="100%" style="font-weight: 600">
                        <thead align="center">
                            <th colspan="2">Systemic Examination</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="300px">Eye</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['eye']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Vision</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['vision']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Colour Vision</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['colour_vision']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Other</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['other_1']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">ENT</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['ent']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Hearing</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['hearing']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Other</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['other_2']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Orthopedic</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['orthopedic']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Gait</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['gait']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Abnormality</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['abnormality']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Medical</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['medical']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Gynae</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['gynae']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Surgical</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['surgical']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px">Dental</td>
                                <td align="center" width="25%"><?php echo $se_sql_row['dental']; ?></td>
                            </tr>
                            <tr>
                                <td width="300px" rowspan="2">Other</td>
                                <td align="center" width="25%" style="height: 25px;">
                                    <?php echo $se_sql_row['other_3']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" width="25%" height="25px"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mark-section" style="font-weight: 600">
                <!-- font-weight-bold -->
                <div>
                    <p>Identification mark:- <?php echo $sql_row['identification_mark']; ?></p>
                    <p>remarks:- <?php echo $sql_row['remark']; ?></p>
                </div>
                <div>
                    <!-- <p>sign</p> -->
                    <p class="mt-3">Signature/Thumbs of candidate</p>
                </div>
            </div>

            <p class="mt-5" style="margin-left: 6%; font-weight: 600;">In my/our opinion, he/she is physically &
                mentally fit/unfit <br /> for working att height/industry/for admission for School/Collage.</p>

            <div class="sign-section" style="font-weight: 600">
                <div>
                    <p>Medical Officer</p>
                    <p>Signature</p>
                </div>
                <div>
                    <p>Counter Signature</p>
                </div>
            </div>

        </div>
    </div>

    <div class="d-flex justify-content-center mb-3">
        <button align="center" class="mr-3 pt-0 pb-0"><a href="#" onclick="divPrint()">Print</a></button>
        <button align="center"><a href="certificate_form.php">Back</a></button>
    </div>

    <!-- add script code here -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function divPrint() {
            var printContent = document.getElementById('printDiv').innerHTML;
            var mywindow = window.open('', 'Print', 'height=600,width=1000');

            mywindow.document.write('<html><head><title>FitnessCertificate</title>');
            mywindow.document.write(
                '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">'
            );
            mywindow.document.write('<style type="text/css">' + document.querySelector('style').innerHTML + '</style>');
            mywindow.document.write('</head><body>');
            mywindow.document.write(printContent);
            mywindow.document.write('</body></html>');
            mywindow.document.close();

            var img = mywindow.document.getElementById('passport-photo');
            img.onload = function() {
                mywindow.print();
            };
            img.onerror = function() {
                console.error("Failed to load image.");
                mywindow.print();
            };
        }
    </script>
</body>

</html>