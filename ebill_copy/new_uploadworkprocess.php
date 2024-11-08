<?php
session_start();
include ("config.php");

$csv = array();

// check there are no errors
if ($_FILES['csv']['error'] == 0) {
    $name = $_FILES['csv']['name'];
    // $nm=$_FILES['csv']['name'];

    // $ext = strtolower(end(explode('.',$nm)));
    $type = $_FILES['csv']['type'];
    $tmpName = $_FILES['csv']['tmp_name'];

    // check the file is a csv
    if (($handle = fopen($tmpName, 'r')) !== FALSE) {
        // necessary if a large csv file
        set_time_limit(0);

        $row = 0;
        $errors = 0;

        mysqli_autocommit($con, FALSE);

        $sr = mysqli_query($con, "select srno from login where username='" . $_SESSION['user'] . "'");
        $srno = mysqli_fetch_row($sr);


        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // number of fields in the csv
            if ($row != 0) {
                $col_count = count($data);

                // get the values from the csv
//                echo $data[0];
                //$csv[$row]['col2'] = $data[1];

                $date = str_replace('/', '-', $_POST["dt"]);
                $dtt = date('Y-m-d', strtotime($date));

                $result1 = mysqli_query($con, "INSERT INTO `online_transaction_new`(`Customer`, `TRANS_ID`, `ATMID`, `BANK`, `BILL_AMOUNT`, `PAID_AMOUNT`, `PRIORITY`, `SUPERVISOR`,EXPENSE_ID, `CONSUMER_NO`, `BU`, `UPLOADED_BY`, `UPLOADED_DT`,PAID_DATE) VALUES ('" . $_POST["cid"] . "','" . addslashes($data[0]) . "','" . addslashes($data[1]) . "','" . addslashes($data[2]) . "','" . addslashes($data[3]) . "','" . addslashes($data[4]) . "','" . addslashes($data[5]) . "','" . addslashes($data[6]) . "','" . addslashes($data[7]) . "','" . addslashes($data[8]) . "','" . addslashes($data[9]) . "','" . $srno[0] . "','" . date('Y-m-d') . "','" . $dtt . "')");
                if (!$result1) {
                    echo mysqli_error();
                    $errors++;
                }
            }
            // inc the row
            $row++;
        }
        fclose($handle);
    }
}


if ($errors == 0) {
    mysqli_query($con, "COMMIT");

    ?>
    <script>
        alert("Upload successfull");
        window.open("new_uploadwork.php", "_self");
    </script>
    <?php
} else {

    mysqli_query($con, "ROLLBACK");
    ?>
    <script>
        alert("Error");
        window.open("new_uploadwork.php", "_self");
    </script>
    <?php
}
?>