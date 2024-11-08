<?php
include 'config.php';
$strPage = $_REQUEST['Page'];

$frdt = $_POST['frdt'];
$todt = $_POST['todt'];


$query = "SELECT sb.*, sbd.* FROM servicebill sb INNER JOIN servicebill_details sbd ON sb.billno = sbd.billno";
//echo $query;



// echo $query;
// die;
$result = mysqli_query($con, $query);
if (!$result) {
    mysqli_error($con);
}

$Num_Rows = mysqli_num_rows($result);

$Per_Page = 15;   // Records Per Page

$Page = $strPage;
if (!$strPage) {
    $Page = 1;
}

$Prev_Page = $Page - 1;
$Next_Page = $Page + 1;


$Page_Start = (($Per_Page * $Page) - $Per_Page);
if ($Num_Rows <= $Per_Page) {
    $Num_Pages = 1;
} else if (($Num_Rows % $Per_Page) == 0) {
    $Num_Pages = ($Num_Rows / $Per_Page);
} else {
    $Num_Pages = ($Num_Rows / $Per_Page) + 1;
    $Num_Pages = (int)$Num_Pages;
}

if ($frdt) {

    // $frdt = date("Y-m-d", strtotime(str_replace("/", "-", $_REQUEST['frdt'])));
    $query .= " and created_at >='" . $frdt . "'";
}

if ($todt) {

    // $todt = date("Y-m-d", strtotime(str_replace("/", "-", $_REQUEST['todt'])));
    $query .= " and created_at<='" . $todt . "'";
}

$query .= " order  by NO ASC LIMIT $Page_Start , $Per_Page";
echo $query;
// die;
$result = mysqli_query($con, $query);
if (!$result) {
    mysqli_error($con);
}

?>
<table width="100%" border="1" id="results" cellpadding="4" cellspacing="0">


    <tr>
        <td width="10%" align="center" style="color:#ac0404; font-size:14px; font-weight:bold;">Sr No.</td>
        <td width="25%" align="center" style="color:#ac0404; font-size:14px; font-weight:bold;">Patient Name</td>
        <td width="20%" align="center" style="color:#ac0404; font-size:14px; font-weight:bold;">Date </td>
        <td width="20%" align="center" style="color:#ac0404; font-size:14px; font-weight:bold;">Amount </td>
    </tr>

    <?php
    $intRows = 0;
    $srno = 1;
    $totamt = 0;
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_row($result)) {            
            
        }
        ?>
        <tr>
            <td colspan="3"></td>
            <td align="center"><b>Total<b></td>
            <td align="right"><b><?php echo $totamt; ?></b></td>

        </tr>
</table>

<div class="pagination" style="width:100%;">
    <font size="4" color="#000">

        <?php
        if ($Prev_Page) {
            echo " <li><a href=\"JavaScript:searchById('Listing','$Prev_Page')\"> << Back</a> </li>";
        }

        for ($i = 1; $i <= $Num_Pages; $i++) {
            if ($i != $Page) {
                echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
            } else {
                echo "<li class='currentpage'><b> $i </b></li>";
            }
        }
        if ($Page != $Num_Pages) {
            echo " <li><a href=\"JavaScript:searchById('Listing','$Next_Page')\">Next >></a> </li>";
        }
        ?>
    </font>
</div>
<?php
        ############
    } else {
        echo "<div class='error'>No Records Found!</div>";
    }
?>