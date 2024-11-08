<?php
session_start();
if (isset($_SESSION['SESS_USER_NAME'])) {

    include 'config.php';
    ?>
<title>IPD BILL ENTRY</title>
<script src="https://code.jquery.com/jquery-3.6.4.min.js">
</script>
<script>
// Form submission
$("#invoiceForm").submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ipdbill_process.php",
        data: formData,
        success: function(response) {
            console.log(response);

        },
        error: function(error) {
            console.error(error);
        }
    });
});
</script>

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
#mask {
    display: none;
    background: #000;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 10;
    width: 100%;
    height: 100%;
    opacity: 0.8;
    z-index: 999;
}

/* You can customize to your needs  */
.login-popup {

    background: #00a4ae;
    padding: 10px;
    border: 2px solid #ac0404;
    float: left;
    font-size: 1.2em;
    position: relative;
    top: 0%;
    left: 3%;
    z-index: 99999;
    box-shadow: 0px 0px 20px #999;
    /* CSS3 */
    -moz-box-shadow: 0px 0px 20px #999;
    /* Firefox */
    -webkit-box-shadow: 0px 0px 20px #999;
    /* Safari, Chrome */
    border-radius: 3px 3px 3px 3px;
    -moz-border-radius: 3px;
    /* Firefox */
    -webkit-border-radius: 3px;
    /* Safari, Chrome */
}

img.btn_close {
    Position the close button float: right;
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
    border-bottom: 1px solid #ac0404;
    border-left: 1px solid #ac0404;
    border-right: 1px solid #ac0404;
    border-top: 1px solid #ac0404;
    color: #000;
    border-radius: 3px 3px 3px 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    font: 13px Arial, Helvetica, sans-serif;
    padding: 6px 6px 4px;
    width: 200px;
}

form.signin input:-moz-placeholder {
    color: #bbb;
    text-shadow: 0 0 2px #000;
}

form.signin input::-webkit-input-placeholder {
    color: #bbb;
    text-shadow: 0 0 2px #000;
}

.formbutton {
    background: -moz-linear-gradient(center top, #ac0404, #dddddd);
    background: -webkit-gradient(linear, left top, left bottom, from(#ac0404), to(#dddddd));
    background: -o-linear-gradient(top, #ac0404, #dddddd);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#ac0404', EndColorStr='#dddddd');
    border-color: #ac0404;
    border-width: 1px;
    border-radius: 4px 4px 4px 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    padding: 6px 6px 4px;
    margin-top: 10px;
    font: 12px;
    width: 100px;
}

form.signin td {
    font-size: 12px;
}
</style>
<style>
/* Add some spacing */
.spacer {
    height: 20px;
}
</style>
<!--DisCharges form-->
<div class="login-popup">


    <form method="post" id="invoiceForm" action="editipddetails_process.php">

        <!-- <input type="hidden" name="myvar" value="0" id="theValue" /> -->
        <p style="color:#ac0404; font-weight:bold; font-size:20px;" align="center">IPD Bill Entry</p>

        <?php

            $id = $_GET['id'];
            $ipdsql = mysqli_query($con, "select * from ipdbill where id = '".$id."' ");
            $ipdbill_res = mysqli_fetch_row($ipdsql);
            $id = $ipdbill_res[0];
            ?>

        <table id="ds">

            <tr>
                <td><label class="fdiag">IPD Bill No. :</label></td>
                <td><input id="bill" name="bill" type="text" class="form-control" value="<?php if (isset($id)) {
                        echo $id;
                    } else
                        echo ""; ?>" readonly></td>
            </tr>

            <tr>
                <td>
                    <label for="obs">Observation</label>
                </td>
                <td>
                    <select class="form-control" name="observation" id="obs">
                        <option value="">Select</option>
                        <option value="yes" <?php if($ipdbill_res[21] == "yes") { echo "selected";} ?>>Yes</option>
                        <option value="no" <?php if($ipdbill_res[21] == "no") { echo "selected";} ?>>No</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td><label class="inv">Indoor Registration No. :</label></td>
                <td><input type="text" class="form-control" name="indoor_reg_no" value="<?php echo $ipdbill_res[8]; ?>"
                        id="indoor_reg_no" /></td>
            </tr>

            <tr>
                <td><label class="fdiag">Payment Method :</label></td>
                <td>
                    <select name="payment" id="payment" class="form-control">
                        <option value="">Select</option>
                        <option value="Cash" <?php if($ipdbill_res[7] == "Cash") { echo "selected";} ?>>Cash</option>
                        <option value="ESI" <?php if($ipdbill_res[7] == "ESI") { echo "selected";} ?>>ESI</option>
                        <option value="Ayushman" <?php if($ipdbill_res[7] == "Ayushman") { echo "selected";} ?>>Ayushman
                        </option>
                        <option value="Online" <?php if($ipdbill_res[7] == "Online") { echo "selected";} ?>>Online
                        </option>
                    </select>
                </td>
            </tr>

            <tr>
                <td width="306">Full Name :</td>
                <td width="168"><input id="name" name="name" value="<?php echo $ipdbill_res[1];?>" type="text"
                        class="form-control">
                </td>
            </tr>

            <tr>
                <td><label class="age">Age :</label></td>
                <td><input id="age" name="age" type="text" value="<?php echo $ipdbill_res[2];?>" class="form-control">
                </td>
            </tr>
            <tr>
                <td><label class="gender">Gender :</label></td>
                <td>
                    <input type="text" id="gender" name="gender" value="<?php echo $ipdbill_res[3];?>"
                        class="form-control">
                </td>
            </tr>
            <tr>
                <td><label class="pro_diag">Address :</label></td>
                <td><input type="text" name="address" class="form-control" value="<?php echo $ipdbill_res[5];?>">
                </td>
            </tr>

            <tr>
                <td><label>Contact No:</label></td>
                <td> <input id="contact_no" name="contact_no" type="text" class="form-control" maxlength="10"
                        value="<?php echo $ipdbill_res[4];?>"></td>
            </tr>


            <tr>
                <td><label>Date of Admission :</label></td>
                <td><input id="add_date" name="add_date" type="date" class="form-control"
                        value="<?php echo $ipdbill_res[9];?>">
                </td>
            </tr>

            <tr>
                <td><label>Time of Admission :</label></td>
                <td><input id="add_time" name="add_time" type="time" class="form-control"
                        value="<?php echo $ipdbill_res[10];?>">
                </td>
            </tr>

            <tr>
                <td><label>Primary Consultant Dr :</label></td>
                <td>
                    <select name="consult_doc" id="consult_doc" class="form-control">
                        <option value="">Select</option>
                        <?php
                            $sql = mysqli_query($con, "select doc_id,name from doctor");

                            while ($sql_result = mysqli_fetch_assoc($sql)) { ?>
                        <option value="<?php echo $sql_result['name']; ?>"
                            <?php if($sql_result['name'] == $ipdbill_res[6] ) { echo "selected";}   ?>>
                            <?php echo $sql_result['name']; ?>
                        </option>

                        <?php }

                            ?>
                    </select>
                </td>
            </tr>


            <tr>
                <td><label>Date of DisCharges :</label></td>
                <td><input id="datedis" name="datedis" type="date" class="form-control"
                        value="<?php echo $ipdbill_res[11];?>"></td>
            </tr>

            <tr>
                <td><label>Time of DisCharges :</label></td>
                <td><input id="timedis" name="timedis" type="time" class="form-control"
                        value="<?php echo $ipdbill_res[12];?>"></td>
            </tr>


        </table>
        <!-- <button id="printButton" name="printButton" class="btn btn-primary">Print</button> -->
        <input type="submit" value="Submit" name="submit" class="btn btn-success">
        <a href="home.php"> <input type="button" value="Cancel" name="cancel" class="btn btn-warning"> </a>
    </form>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</div>
<?php
} else {
    header("location: home.php");
}
?>