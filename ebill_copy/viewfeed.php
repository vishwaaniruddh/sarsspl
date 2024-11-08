<?php

include ("access.php");

include ("config.php");

$id = $_GET['id'];



?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>



    <meta mysqli_quiv="Content-Type" content="text/html; charset=utf-8" />
    mysqli_
    <title>Feedback</title>

    <link href="style.css" rel="stylesheet" type="text/css" />

</head>



<body>

    <table border="1">

        <tr>
            <th>Sr No</th>
            <th>From</th>
            <th>Time</th>
            <th>Remarks</th>
        </tr>

        <?php

        $i = 0;

        $conf = mysqli_query($con, "select appid,appby,apptime,level,remarks from fundrequestapproval where reqid='" . $id . "' order by appid DESC");

        while ($row = mysqli_fetch_array($conf)) {

            ?>

            <tr>
                <td>
                    <?php echo $i = $i + 1; ?>
                </td>
                <td>
                    <?php echo $row[1]; ?>
                </td>
                <td>
                    <?php echo $row[2]; ?>
                </td>
                <td>
                    <?php echo $row[4]; ?>
                </td>
            </tr>

            <?php

        }

        ?>
    </table>

</body>

</html>