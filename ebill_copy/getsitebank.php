<?php

include ("config.php");

$qry = mysqli_query($con, "Select distinct(bank) from " . $_GET['cid'] . "_sites where projectid='" . $_GET['proj'] . "'");

?>

<option value="">Select Bank</option>

<?php

while ($row = mysqli_fetch_array($qry)) {

    ?>

<option value="<?php echo $row[0]; ?>">
    <?php echo $row[0]; ?>
</option>

<?php

}

?>

<option value="">All</option>