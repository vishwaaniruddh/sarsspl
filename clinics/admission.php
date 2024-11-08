<?php
session_start();
if (isset($_SESSION['SESS_USER_NAME'])) {

        include 'config.php';

        $id = $_GET['id'];
        //$aid=$_GET['aid'];
        $sql = "select * from patient where no='$id'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);

?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js">
</script>
<!-- validation-->
<script type="text/javascript">
function advalidate(adform) {
    with(adform) {


        if (addate.value == "") {
            alert("Please select Admission Date");
            addate.focus();
            return false;
        }

        /*if(disdate.value=="")
        {
        	alert("Please select Discharge Date");
        	disdate.focus();
        	return false;
        }*/

    }
    return true;
}

/////////////////////////////
function chkroom() {
    var xmlhttp;
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            document.getElementById("room1").innerHTML = xmlhttp.responseText;
        }
    }
    //     var disdate = document.getElementById('disdate').value;
    var addate = document.getElementById('addate').value;

    xmlhttp.open("GET", 'room.php?&addate=' + addate, true);
    xmlhttp.send();
}
</script>
<!--end validation-->

<link rel="stylesheet" href="css/admission.css">
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<div id="" class="login-popup">



    <form method="post" class="signin" action="new_admission.php" onSubmit="return advalidate(this)" name="adform">
        <fieldset class="textbox">
            <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Admission</p>

            <input type="hidden" name="patient_id" value="<?php echo $id; ?>" />


            <table>
                <tr>
                    <td><label class="name"><span><b> Name: </b></span></label></td>
                    <td><input id="name" name="name" type="text" autocomplete="on" value="<?php echo $row[6]; ?>"
                            readonly style="background-color:#DCDCDC;"></td>

                    <?php

                                                $result = mysqli_query($con, "select doc_id,name from doctor ");
                                                ?>

                    <td><label class="doc"><span><b>Doctor:</b></span> </label></td>
                    <td>
                        <select name="doc" style="background:#fff;border:1px solid #ac0404;width:300px;height:27px;">
                            <?php while ($row = mysqli_fetch_row($result)) {  ?>
                            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><span><b>Ref Date</b></span></td>
                    <td><input id="refd" name="refd" type="date" /></td>
                    <td><span><b>Ref.No</b></span></td>
                    <td><input id="refno" name="refno" type="text" /></td>
                </tr>

                <tr>
                    <td><label class="addate"><span><b>Admitted on :</b></span></label></td>
                    <td><input id="addate" name="addate" type="date"></td>
                    <td><label class="time"><span><b>Admission Time: </b></span></label></td>
                    <td><input type="time" name="addtime" id="addtime"></td>

                </tr>

                <!--date difference-->
                <script>
                function formshowhide() {
                    var t1 = document.getElementById('addate').value;
                    //     var t2 = document.getElementById('disdate').value;
                    var one_day = 1000 * 60 * 60 * 24;

                    var x = t1.split("/");
                    var y = t2.split("/");
                    //date format(Fullyear,month,date) 

                    var date1 = new Date(x[2], (x[1] - 1), x[0]);

                    var date2 = new Date(y[2], (y[1] - 1), y[0])
                    var month1 = x[1] - 1;
                    var month2 = y[1] - 1;

                    //Calculate difference between the two dates, and convert to days

                    _Diff = Math.ceil((date2.getTime() - date1.getTime()) / (one_day));

                    document.getElementById('stay').value = _Diff;
                }
                </script>


                <tr>
                    <td><label for="Newroom" class="Newroom"><span><b>Room</b></span></label></td>
                    <td><select name="Newroom" id="Newroom" style="border:1px solid #ac0404;width:200px; height:23px"
                            required>
                            <option value="">Select</option>
                            <option value="normal">Normal</option>
                            <option value="private">Private</option>
                            <option value="semi">Semi-Private</option>
                        </select></td>
                    <td><label class="room"><span><b>Ward/Bed No. :</b></span> </label></td>
                    <td>
                        <select name="room1" id="room1" style="border:1px solid #ac0404;width:200px; height:23px">
                            <option value="">Select</option>
                            <?php
                                                                $roomQry = mysqli_query($con, "select * from room where no not in (select room from admission) ");
                                                                while ($room_sql_result = mysqli_fetch_assoc($roomQry)) { ?>
                            <option value="<?php echo $room_sql_result['no']; ?>"
                                <?php if ($state == $room_sql_result['no']) {
                                                                                                                                        echo 'selected';
                                                                                                                                } ?>>
                                <?php echo $room_sql_result['type']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><label class="final"><span><b>Final Diagnosis :</b></span> </label></td>
                    <td><textarea name="final" id="final" rows="3" cols="36" style="resize:none"></textarea></td>
                    <td><label class="allergies"><span><b>Allergies :</b></span> </label></td>
                    <td><textarea name="all" id="all" rows="3" cols="36" style="resize:none"></textarea></td>
                </tr>

                <tr>
                    <td><label class="present"><span><b>Symptoms of present illness :</b></span> </label></td>
                    <td><textarea name="present" id="present" rows="3" cols="36" style="resize:none"></textarea></td>
                    <td><label class="past"><span><b>Past illness :</b></span> </label></td>
                    <td><textarea name="past" id="past" rows="3" cols="36" style="resize:none"></textarea></td>
                </tr>

                <tr>
                    <td><label class="sys"><span><b>Systematic Examination :</b></span> </label></td>
                    <td><textarea name="sys" id="sys" rows="3" cols="36" style="resize:none"></textarea></td>
                    <td><label class="local"><span><b>Local Examination :</b></span> </label></td>
                    <td><textarea name="local" id="local" rows="3" cols="36" style="resize:none"></textarea></td>
                </tr>

                <tr>
                    <td><label class="pro"><span><b>Provisional Diagnosis :</b></span> </label></td>
                    <td><textarea name="pro" id="pro" rows="3" cols="36" style="resize:none"></textarea></td>
                    <td><label class="tre"><span><b>Treatment Type :</b></span> </label></td>
                    <td>
                        <select name="tre" id="tre" style="border:1px solid #ac0404;width:200px; height:23px">
                            <option value="0"> Select</option>
                            <option value="Gynaec">Gynaec</option>
                            <option value="Medicine">Medicine</option>
                            <option value="OBS">OBS</option>
                            <option value="Ortho">Ortho</option>
                            <option value="Paediatric">Paediatric</option>
                            <option value="Surgery">Surgery</option>
                            <option value="Opthalmo">Opthalmo</option>
                            <option value="ENT">ENT</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><label class="general"><span>
                                <h2><u> General Examination : </u></h2>
                            </span> </label></td>
                </tr>

                <tr>
                    <td> <label class="built"><span><b>Built :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="built" name="built" /></td>
                    <td> <label class="temp"><span><b>Temperature :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="temp" name="temp" /></td>
                </tr>

                <tr>
                    <td> <label class="nourish"><span><b>Nourishment :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="nour" name="nour" /></td>
                    <td> <label class="pulse"><span><b>Pulse :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="pulse" name="pulse" /></td>
                </tr>

                <tr>
                    <td> <label class="aneama"><span><b>Anaema :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="aneama" name="aneama" /></td>
                    <td> <label class="rspiration"><span><b>Respiration :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="resp" name="resp" /></td>
                </tr>

                <tr>
                    <td> <label class="cyanosis"><span><b>Cyanosis :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="cya" name="cya" /></td>
                    <td> <label class="lying"><span><b>Lying BP Down :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="lying" name="lying" /></td>
                </tr>

                <tr>
                    <td> <label class="oedema"><span><b>Oedema :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="oedema" name="oedema" /></td>
                    <td> <label class="bp"><span><b>BP Sitting :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="bp" name="bp" /></td>
                </tr>

                <tr>
                    <td> <label class="jaundice"><span><b>Jaundice :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="jau" name="jau" /></td>
                    <td> <label class="skin"><span><b>Skin :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="skin" name="skin" /></td>
                </tr>

                <tr>
                    <td> <label class="throat"><span><b>Throat :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="throat" name="throat" /></td>
                    <td> <label class="nails"><span><b>Nails :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="nail" name="nail" /></td>
                </tr>

                <tr>
                    <td> <label class="tongue"><span><b>Tongue :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="tongue" name="tongue" /></td>
                    <td> <label class="other"><span><b>Other :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="other" name="other" /></td>
                </tr>

                <tr>
                    <td> <label class="remarks"><span><b>Lymph Nodes :</b></span> </label></td>
                    <td> <input type="text" style="width:120px;" id="lymph" name="lymph" /></td>
                </tr>
            </table>

            <button class="submit formbutton" type="submit">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="home.php"> <button class="submit formbutton" type="button"
                    onClick="javascript:location.href = 'home.php';">Cancel</button></a>

        </fieldset>
    </form>


</div>
<?php
} else {
        header("location: index.html");
}

?>