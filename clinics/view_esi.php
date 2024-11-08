<html>

<head>
    <link href="style.css" rel="stylesheet" type="text/css" />

    <!-- Datepicker -->
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
    <script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

    <!-- jQuery and DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/jquery.dataTables.min.css">

    <!-- DataTables Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>

    <script type="text/javascript">
    function confirm_deletedis(id) {
        if (confirm("Are you sure you want to delete this entry?")) {
            document.location = "delete_discharge.php?id=" + id;
        }
    }

    $(document).ready(function() {
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ]
        });
    });
    </script>

    <style>
    #mask {
        display: none;
        background: #000;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 0.8;
        z-index: 999;
    }

    .login-popup {
        background: #00a4ae;
        border: 2px solid #ac0404;
        font-size: 1.2em;
        position: relative;
        margin: auto;
        z-index: 99999;
        box-shadow: 0px 0px 20px #999;
        border-radius: 3px;
    }

    img.btn_close {
        float: right;
        margin: -28px -28px 0 0;
    }

    fieldset {
        border: none;
    }

    form.signin .textbox label {
        display: block;
        padding-bottom: 7px;
    }

    form.signin .textbox span {
        display: block;
    }

    form.signin p,
    form.signin span {
        color: #fff;
        font-size: 13px;
        line-height: 18px;
    }

    form.signin .textbox input {
        background: #fff;
        border: 1px solid #ac0404;
        color: #000;
        border-radius: 3px;
        font: 13px Arial, Helvetica, sans-serif;
        padding: 6px 6px 4px;
        width: 300px;
    }

    form.signin input:-moz-placeholder {
        color: #bbb;
        text-shadow: 0 0 2px #000;
    }

    form.signin input::-webkit-input-placeholder {
        color: #bbb;
        text-shadow: 0 0 2px #000;
    }

    .formbutton,
    .formbutton_new {
        border-color: #ac0404;
        border-width: 1px;
        border-radius: 4px;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        padding: 6px 6px 4px;
        margin-top: 10px;
        font: 12px;
        width: 100px;
    }

    .formbutton {
        background: linear-gradient(to bottom, #ac0404, #dddddd);
    }

    .formbutton_new {
        background: linear-gradient(to bottom, #054ca3, #dddddd);
    }

    form.signin td {
        font-size: 12px;
    }

    #view_discharge {
        background: #00a4ae;
        overflow: auto;
        padding: 10px;
        width: 100%;
        box-sizing: border-box;
    }

    #myTable {
        width: 100%;
        border-collapse: collapse;
    }

    #myTable th,
    #myTable td {
        padding: 4px;
        text-align: left;
    }

    #myTable th {
        background-color: #00a4ae;
        color: white;
    }

    #myTable td {
        background-color: #fff;
    }

    #myTable thead {
        position: sticky;
        top: 0;
    }
    </style>

</head>

<body>
    <?php
    include 'config.php';

    $sqlQuery = mysqli_query($con, "select * from discharge ");

    ?>
    <div id="view_discharge">
        <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go
            Back</button>
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Discharge Summary</p><br />
        <table border="1" id="myTable" style="border:2px #ac0404 solid; text-align:left;">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Indoor Reg. No.</th>
                    <th>Name</th>
                    <th>Age/Gender</th>
                    <th>Mobile No.</th>
                    <th>City</th>
                    <th>Address</th>

                    <th>Consultation Doctor</th>
                    <th>Department</th>
                    <th>Payment Mode</th>
                    <th>Admission Date & Time</th>
                    <th>Discharge Date & Time</th>
                    <th>Discharge Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($sqlQuery_result = mysqli_fetch_assoc($sqlQuery)) {

                    $patient_id = $sqlQuery_result['id'];

                    $patientsql = mysqli_query($con, "select * from patient where no = '$patient_id' ");
                    $patientsql_result = mysqli_fetch_assoc($patientsql);


                    ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $sqlQuery_result['indoor_reg_no'] ?></td>
                    <td><?= $patientsql_result['name'] ?></td>
                    <td><?= $patientsql_result['age'] ?>/<?= $patientsql_result['sex'] ?></td>
                    <td><?= $patientsql_result['mobile'] ?></td>
                    <td><?= $patientsql_result['city'] ?></td>
                    <td><?= $patientsql_result['address'] ?></td>

                    <td><?= $sqlQuery_result['consultant'] ?></td>
                    <td><?= $sqlQuery_result['dept1'] ?></td>
                    <td><?= $sqlQuery_result['payment'] ?></td>
                    <td><?= $sqlQuery_result['add_date'] . " " . $sqlQuery_result['add_time'] ?></td>
                    <td><?= $sqlQuery_result['datedis'] . " " . $sqlQuery_result['timedis'] ?></td>
                    <td><?= $sqlQuery_result['discharge_type'] ?></td>
                    <td>
                        <a href="editdischargesummary.php?id=<?php echo $sqlQuery_result['id']; ?>" target="_new"><input
                                type="button" value="Edit" class="form-control formbutton"></a>
                        <a href="newprint.php?id=<?php echo $sqlQuery_result['id']; ?>" target="_new"><input
                                type="submit" class="form-control formbutton_new" value="Print"></a>
                    </td>
                </tr>
                <?php $i++;
                } ?>
            </tbody>
        </table>
    </div>
</body>

</html>