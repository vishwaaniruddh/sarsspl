<html>

<head>
    <!-- <link href="style.css" rel="stylesheet" type="text/css" /> -->

    <!--Datepicker-->
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
    <script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
</head>

<body>
    <?php 
    include 'config.php'; 
    
    $result = mysqli_query($con,"select * from ipdbill");    
    ?>
    <div id="view_discharge" class="login-popup">
        <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go
            Back</button>
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View IPD Bill Details</p><br />
        <table border="1" id="myTable" style="border:2px #ac0404 solid; text-align:left;">
            <th>S.No.</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Mobile No.</th>
            <th>Address</th>
            <th>Consultation Doctor</th>
            <th>Payment Mode</th>
            <th>Indoor Reg. No.</th>
            <th>Duty Doctor</th>
            <th>Admission Date & Time</th>
            <th>Discharge Date & Time</th>
            <th>Total Amount </th>
            <th>Paid Amount </th>
            <?php 
                $i=1;
            while($row=mysqli_fetch_row($result))
            { 
            
            ?>

            <tr>
                <td><?=$i; ?></td>
                <td><?=$row[1]?></td>
                <td><?=$row[2]?></td>
                <td><?=$row[3]?></td>
                <td><?=$row[4]?></td>
                <td><?=$row[5]?></td>
                <td><?=$row[6]?></td>
                <td><?=$row[7]?></td>
                <td><?=$row[8]?></td>
                <td><?=$row[13]?></td>
                <td><?=$row[9]." ".$row[10]?></td>
                <td><?=$row[11]." ".$row[12]?></td>
                <td><?=$row[17]?></td>
                <td><?=$row[19]?></td>
                <!-- <td><?=$row[1]?></td> -->

            </tr>
            <?php $i++; } ?>
        </table>
    </div>

    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
</body>

</html>