<html>

<head>
    <title>FORM 21 Reports</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <!-- Datepicker -->
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
    <script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/jquery.dataTables.min.css">
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.2/js/jquery.dataTables.min.js"></script>
    
    <!-- DataTables Buttons CSS and JS (Optional) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>

    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    
    <script type="text/javascript">
        // function confirm_deletedis(id) {
        //     if (confirm("Are you sure you want to delete this entry?")) {
        //         document.location = "delete_discharge.php?id=" + id;
        //     }
        // }

        $(document).ready(function () {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf'
                ]
            });
        });
    </script>

    <style>
        /* Add this style for the Upload button */
        .upload-button {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #ac0404;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            z-index: 1000; /* Ensure it stays on top */
            display: flex;
            align-items: center;
        }

        .upload-button i {
            margin-right: 8px; /* Spacing between icon and text */
        }
        
        .upload-button {
            background: linear-gradient(to bottom, #0066cc, #e6f0ff);
            border: 1px solid #054ca3;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            z-index: 1000; /* Ensure it stays on top */
            display: flex;
            align-items: center;
        }

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
    <!-- Upload Button -->
    <button class="upload-button" onclick="location.href='pdf_upload.php';"><i class="fa fa-person"></i>Upload Form 21 PDFs</button>

    <?php
    include 'config.php';

    $sqlQuery = mysqli_query($con, "select * from report order by id desc ");

    ?>
    <div id="view_discharge">
        <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go Back</button>
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View FORM 21 Report</p><br />
        <table border="1" id="myTable" style="border:2px #ac0404 solid; text-align:left;">
            <thead>
                <tr>
                    <th>S.No.</th>
                    
                    <th>Name</th>
                    <th>Age/Gender</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th>Pulse</th>
                   
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($sqlQuery_result = mysqli_fetch_assoc($sqlQuery)) {
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        
                        <td><?= $sqlQuery_result['name'] ?></td>
                        <td><?= $sqlQuery_result['age'] ?>/<?= $sqlQuery_result['sex'] ?></td>
                        <td><?= $sqlQuery_result['height'] ?></td>
                        <td><?= $sqlQuery_result['weight'] ?></td>
                        <td><?= $sqlQuery_result['pulse'] ?></td>
                       
                       
                        <td>
                            <a href="editForm21.php?id=<?php echo $sqlQuery_result['id']; ?>" target="_new"><input
                                    type="button" value="Edit" class="form-control formbutton"></a>
                            <a href="updatedbillprint21.php?id=<?php echo $sqlQuery_result['id']; ?>" target="_new"><input
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
