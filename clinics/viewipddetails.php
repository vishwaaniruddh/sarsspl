<html>

<head>
    <link href="style.css" rel="stylesheet" type="text/css" />

    <!--Datepicker-->
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
    <script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">

    <script type="text/javascript">
    function confirm_deletedis(id) {
        if (confirm("Are you sure you want to delete this entry?")) {
            document.location = "delete_discharge.php?id=" + id;
        }
    }
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
    </style>

    <style>
    /* Your existing styles here */
    #color_box {
        width: 100%;
        height: 20px;
        margin-bottom: 10px;
        background-color: lightyellow;

    }
    </style>

</head>

<body>
    <?php
    include 'config.php';
    ?>
    <div id="view_discharge" class="login-popup">

        <?php

        $result = mysqli_query($con, "select * from ipdbill");
        ?>

        <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go
            Back</button>

        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View IPD Bill Details</p><br />

        <table border="1" id="example" style="border:2px #ac0404 solid; text-align:center;">
            <th width="150" style="color:#ac0404; font-size:14px; font-weight:bold;">S.No.</th>
            <th width="150" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
            <th width="120" style="color:#ac0404; font-size:14px; font-weight:bold;">Age</th>
            <th width="150" style="color:#ac0404; font-size:14px; font-weight:bold;">Gender</th>
            <th width="150" style="color:#ac0404; font-size:14px; font-weight:bold;">Mobile No.</th>
            <th width="150" style="color:#ac0404; font-size:14px; font-weight:bold;">Address</th>
            <th width="150" style="color:#ac0404; font-size:14px; font-weight:bold;">Consultation Doctor</th>
            <th width="150" style="color:#ac0404; font-size:14px; font-weight:bold;">Payment Mode</th>
            <th width="150" style="color:#ac0404; font-size:14px; font-weight:bold;">Indoor Reg. No.</th>
            <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Admission Date & Time</th>
            <th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Discharge Date & Time</th>
            <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Total Amount (₹) </th>
            <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Paid Amount (₹)</th>
            <th width="150" style="color:#ac0404; font-size:14px; font-weight:bold;">Advance (₹)</th>
            <th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Action</th>

            <?php
            $i = 1;
            while ($row = mysqli_fetch_row($result)) {
                $observation = $row[21];
                $row_style = ($observation == 'yes') ? 'background-color: lightyellow;' : '';

            ?>

            <tr style="<?= $row_style ?>">
                <td><?= $i; ?></td>
                <td><?= $row[1] ?></td>
                <td><?= $row[2] ?></td>
                <td><?= $row[3] ?></td>
                <td><?= $row[4] ?></td>
                <td><?= $row[5] ?></td>
                <td><?= $row[6] ?></td>
                <td><?= $row[7] ?></td>
                <td><?= $row[8] ?></td>
                <td><?= $row[9] . " " . $row[10] ?></td>
                <td><?= $row[11] . " " . $row[12] ?></td>
                <td><?= $row[17] ?></td>
                <td><?= $row[19] ?></td>
                <td><?= $row[20] . ".00" ?></td>
                <td>
                    <a href="editipdbilldetails.php?id=<?php echo $row[0]; ?>" target="_new"><input type="button"
                            value="Edit" class="form-control formbutton"></a>
                    <a href="print_invoice.php?id=<?php echo $row[0]; ?>" target="_new"><input type="submit"
                            class="from-control formbutton_new" value="Printt"></a>
                </td>

            </tr>
            <?php $i++;
            }
            ?>
        </table>
    </div>

    <script>
    $(document).ready(function() {


        //Buttons examples
        var table = $('#example').DataTable({
            lengthChange: false,
            scrollX: true,
            buttons: ['copy', 'excel', 'pdf']

        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');


    });
    </script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>


</body>

</html>