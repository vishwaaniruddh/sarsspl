<?php
session_start();

if (!isset($_SESSION['SESS_USER_NAME'])) {
    header("location: home.php");
    exit();
}

include 'config.php';

// $fid = filter_input(INPUT_POST, 'from', FILTER_VALIDATE_INT);
// $tid = filter_input(INPUT_POST, 'to', FILTER_VALIDATE_INT);

// $fid = $_POST['from']; 
$fid = '2024-06-12';

$tid = $_POST['to'];

// var_dump($_POST);
// die;

$nwords = array(
    "Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine",
    "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen",
    "Eighteen", "Nineteen", "Twenty", 30 => "Thirty", 40 => "Forty", 50 => "Fifty",
    60 => "Sixty", 70 => "Seventy", 80 => "Eighty", 90 => "Ninety"
);

function int_to_words($x)
{
    global $nwords;
    if (!is_numeric($x)) {
        return '#';
    }
    if (fmod($x, 1) != 0) {
        return '#';
    }

    $w = '';
    if ($x < 0) {
        $w = 'minus ';
        $x = -$x;
    }

    if ($x < 21) {
        $w .= $nwords[$x];
    } elseif ($x < 100) {
        $w .= $nwords[10 * floor($x / 10)];
        $r = fmod($x, 10);
        if ($r > 0) {
            $w .= '-' . $nwords[$r];
        }
    } elseif ($x < 1000) {
        $w .= $nwords[floor($x / 100)] . ' Hundred';
        $r = fmod($x, 100);
        if ($r > 0) {
            $w .= ' and ' . int_to_words($r);
        }
    } elseif ($x < 100000) {
        $w .= int_to_words(floor($x / 1000)) . ' Thousand';
        $r = fmod($x, 1000);
        if ($r > 0) {
            $w .= ' ';
            if ($r < 100) {
                $w .= 'and ';
            }
            $w .= int_to_words($r);
        }
    } elseif ($x < 10000000) {
        $w .= int_to_words(floor($x / 100000)) . ' Lakh';
        $r = fmod($x, 100000);
        if ($r > 0) {
            $w .= ' ';
            if ($r < 100) {
                $w .= 'and ';
            }
            $w .= int_to_words($r);
        }
    } else {
        $w .= int_to_words(floor($x / 10000000)) . ' Crore';
        $r = fmod($x, 10000000);
        if ($r > 0) {
            $w .= ' ';
            if ($r < 100) {
                $w .= 'and ';
            }
            $w .= int_to_words($r);
        }
    }
    return $w;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script>
    function popcontact(URL) {
        var popup_width = 900;
        var popup_height = 600;
        var day = new Date();
        var id = day.getTime();
        window.open(URL, id, 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width=' +
            popup_width + ',height=' + popup_height);
    }

    function pres() {
        var cond = document.getElementById('condi').value;
        var amtc = document.getElementById('amtc').value;
        var amtad = document.getElementById('amtad').value;
        var rem = document.getElementById('rem').value;
        var code = document.getElementsByClassName('code');
        var proc = document.getElementsByClassName('proc');
        var other = document.getElementsByClassName('other');
        var rate = document.getElementsByClassName('rate');
        var amt = document.getElementsByClassName('amt');
        var implan = document.getElementById('implan').value;
        var other_proc = document.getElementsByClassName('other_proc');
        var other_rate = document.getElementsByClassName('other_rate');

        var proc1 = "",
            other1 = "",
            code1 = "",
            rate1 = "",
            amt1 = "",
            other_proc1 = "",
            other_rate1 = "";

        for (var i = 0; i < proc.length; i++) {
            proc1 += proc[i].value + "<br>";
            other1 += other[i].value + "<br>";
            code1 += code[i].value + "<br>";
            rate1 += rate[i].value + "<br>";
            amt1 += amt[i].value + "<br>";
        }

        for (var r = 0; r < other_proc.length; r++) {
            other_proc1 += other_proc[r].value + "<br>";
            other_rate1 += other_rate[r].value + "<br>";
        }

        popcontact('esi_print.php?id=<?php echo $id; ?>&cond=' + cond + '&amtc=' + amtc + '&amtad=' + amtad + '&rem=' +
            rem + '&code1=' + code1 + '&proc1=' + proc1 + '&other1=' + other1 + '&rate1=' + rate1 + '&amt1=' +
            amt1 + '&implan=' + implan + '&other_proc1=' + other_proc1 + '&other_rate1=' + other_rate1);
    }

    function getXMLHttp() {
        var xmlHttp;
        try {
            xmlHttp = new XMLHttpRequest();
        } catch (e) {
            try {
                xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    alert("Your browser does not support AJAX!");
                    return false;
                }
            }
        }
        return xmlHttp;
    }

    function MakeRequest() {
        var xmlHttp = getXMLHttp();
        var cnt = document.getElementById('cnt').value;

        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4) {
                var str = xmlHttp.responseText.split("___///");
                document.getElementById('cnt').value = str[0];
                HandleResponse(str[1]);
            }
        };

        xmlHttp.open("GET", "getMore.php?cnt=" + cnt, false);
        xmlHttp.send(null);
    }

    function HandleResponse(response) {
        var ni = document.getElementById('detail');
        var numi = document.getElementById('theValue');
        var num = parseInt(document.getElementById('theValue').value) + 1;
        numi.value = num;

        var newdiv = document.createElement('tr');
        var divIdName = num;

        newdiv.setAttribute('id', divIdName);
        newdiv.innerHTML = response;
        ni.appendChild(newdiv);
    }

    function otherproc(src1) {
        var xmlHttp = getXMLHttp();
        var other_proc = document.getElementById('other_proc' + src1).value;

        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4) {
                var str = xmlHttp.responseText.split("#");
                document.getElementById('other_rate' + src1).value = str[0];
            }
        };

        xmlHttp.open("GET", "get_rate.php?other_proc=" + other_proc, false);
        xmlHttp.send(null);
    }

    function proce(src) {
        var xmlHttp = getXMLHttp();
        var proc = document.getElementById('proc' + src).value;

        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4) {
                var str = xmlHttp.responseText.split("#");
                document.getElementById('code' + src).value = document.getElementById('proc' + src).value;
                document.getElementById('rate' + src).value = str[0];
            }
        };

        xmlHttp.open("GET", "get_rate1.php?proc=" + proc, false);
        xmlHttp.send(null);
    }

    function proces(src) {
        var xmlHttp = getXMLHttp();
        var proc = document.getElementById('proc' + src).value;

        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4) {
                var str = xmlHttp.responseText.split("#");
                document.getElementById('code' + src).value = document.getElementById('proc' + src).value;
                document.getElementById('rate' + src).value = str[0];
            }
        };

        xmlHttp.open("GET", "get_rate2.php?proc=" + proc, false);
        xmlHttp.send(null);
    }

    function numbersonly(e) {
        var unicode = e.charCode ? e.charCode : e.keyCode;
        if (unicode != 8 && unicode != 9) {
            if (unicode < 48 || unicode > 57) {
                return false;
            }
        }
    }
    </script>
</head>

<body>
    <div class="container" id="maindiv">
        <?php
        $y = $fid;
        $cc = 1;
        ?>
        <div>
            <table border="1" width="100%">
                <tr>
                    <td><img src="images\gdh.jpg" height="100" width="250" /></td>
                    <td align="center">
                        <div align="center"><b>GINDODI DEVI MEMORIAL CHARITABLE HOSPITAL & RESEARCH CENTER
                            </b> </div>
                        <p align="center">( Run By: Beena Health Care Charitable Trust )<br>G.E. ROAD, KHURSIPAR - 490
                            012 (C.G.)<br>PHONE: 0788-3594666 </p>
                    </td>
                </tr>
            </table>
        </div>
        <hr>
        <br>
        <input type="hidden" name="myvar" value="0" id="theValue" />
        <strong>GDH/ESIC/IPD/<?php echo date("Y"); ?>/<?php echo date("m"); ?>/<?php echo htmlspecialchars($cc); ?></strong>
        <p align="right"><strong>Dated: <?php echo htmlspecialchars(date('d/m/Y')); ?></strong></p>
        <div class="header-section">
            <table>
                <tr>
                    <td> <strong>
                            To, <br><br>
                            SMC Chattisgarh,<br>
                            Regional Office, ESIC, <br>
                            ESIC 107, JAGGANATH CHOWK <br>
                            RAM NAGAR ROAD KOTA, <br>
                            RAIPUR (CG) <br> </strong>
                    </td>
                </tr>
            </table><br>
            <table>
                <tr>
                    <td>
                        <strong>
                            Sub: REIMBURSEMENT OF MEDICAL BILLS
                        </strong>
                    </td>
                </tr>
            </table><br>
            <table>
                <tr>
                    <td>
                        <strong>
                            Ref: Agreement Letter No. SMC/Chattisgarh/5-2/2010 dated 08/01/2010
                        </strong>
                    </td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td>
                        <strong>
                            Dear Sir/Madam, <br> Please find enclosed herewith Bills for reimbursement as per details
                            given below:
                        </strong>
                    </td>
                </tr>
            </table>
            <br>
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>Bill No.</th>
                        <th>Registration No.</th>
                        <th>Employee Card No.</th>
                        <th>Employee Name</th>
                        <th>Patient Name</th>
                        <th>Date Of Admission</th>
                        <th>Date Of Discharge</th>
                        <th>Amount</th>
                    </tr>
                </thead>

                <?php
                $sum = '0';
                $sql = mysqli_query($con, "select * from admission where admit_date= '" . $y . "' limit 0,7 ");
                // echo $num_rows = mysqli_num_rows($sql);
                while ($sql_result = mysqli_fetch_assoc($sql)) {
                    $ad_id = $sql_result['ad_id'];
                    $patient_id = $sql_result['patient_id'];


                    $sql1 = "select * from patient where no='" . $patient_id . "' ";
                    $result1 = mysqli_query($con, $sql1);
                    $patient_result = mysqli_fetch_assoc($result1);
                    //  $patient_result['name'];

                    $disc_sql = mysqli_query($con, "select * from discharge where ad_id = '" . $ad_id . "' ");
                    $discharge_result = mysqli_fetch_assoc($disc_sql);

                    if ($sql_result && $patient_result && $discharge_result) {
                        $rt = $discharge_result['totalamt'];
                        $sum += $rt;


                ?>
                <tr>
                    <td><?= $cc; ?></td>
                    <td><?= $discharge_result['indoor_reg_no']; ?></td>
                    <td><?= $discharge_result['insurance_no']; ?></td>
                    <td><?= $discharge_result['pensioner_name']; ?></td>
                    <td><?= $patient_result['name']; ?></td>
                    <td><?= $sql_result['admit_date']; ?></td>
                    <td><?= $sql_result['dis_date']; ?></td>
                    <td><?= $discharge_result['totalamt']; ?></td>

                </tr>


                <?php
                    }
                    $y += 1;
                    $cc++;
                }

                ?>
                <tr>
                    <td colspan="6">&nbsp;</td>
                    <td>TOTAL</td>
                    <td><?php echo $sum; ?></td>
                </tr>
                </tbody>
            </table>
            <br>
            <table>
                <tr>
                    <td>
                        <strong>(Rs. <?php echo int_to_words($sum); ?> only)</strong>
                    </td>
                </tr>
            </table>
            <br><br>
            <table>
                <tr>
                    <td>
                        <strong>
                            Kindly do the needful as early as possible. <br><br>
                            Thanking You,<br><br>
                            Yours faithfully,<br><br>
                            For Gindodi Devi Memorial Charitable<br>
                            Hospital & Research Centre,<br>
                            (DIRECTOR) <br><br>
                            Encls : as above
                        </strong>
                    </td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td>
                        Certified that the treatment <b>/</b> procedure has been done/performed as per laid down norms
                        and the
                        charges in
                        the bill has/ have been claimed as per the Terms & Conditions laid down in the agreement
                        signed with ESIC.
                        <br><br>
                        Further certified that the treatment <b>/</b> procedure have been performed on cashless
                        basis.<br> No
                        money has been
                        received <b>/</b> demanded <b>/</b> charged from the patient <b>/</b> his <b>/</b> her relative.
                        <br><br>
                        The amount may be credited to our account ___________________ RTGS no ___________________ and
                        intimate the same through email/fax/hardcopy at the address.

                    </td>
                </tr>
            </table>
            <br>
            <table width="100%">
                <tr>
                    <td><b>Sign/Thumb Impression of Patient with date:</b></td>

                    <td align="right"><b>Signature of the Competemnt<br>Authority of Tie-up Hospital</b></td>

                </tr>
            </table><br>
            <table>
                <tr>
                    <td>
                        <b><u>Checklist:</u></b><br><br>
                        1. Duty filled up consolidated proforma. <br>
                        2. Duty filled up Individual Pt Bill proforma.
                    </td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td>
                        <strong>
                            <u>Certificate : </u>
                        </strong>
                        <br><br>
                        It is certified that the drugs used in the treatment are in the standard pharmacopeia
                        IP <b>/</b> BP <b>/</b> USP. <br>
                        It is certified that total amount of ₹ __________________ has been credited to your
                        account no.
                        __________________, RTGS no.__________________ on __________________ .
                    </td>
                </tr>
            </table>
            <br>
            <table width="100%">
                <tr>
                    <td class="bottom" colspan="30">Date:</td>

                    <td align="right" class="bottom">Signature of Competent Authority</td>

                </tr>
            </table>
            <b>To be filled by ESIC Official(s).</b>
        </div>
    </div>
    <p align="center"><a href="#" onclick="divprint()">Print</a></p>
    <p align="center"><a href="home.php">Back</a></p>
    </script>
    <script>
    function divprint() {
        var printContent = document.getElementById('maindiv').outerHTML;
        var mywindow = window.open('', 'GDH', 'height=400,width=600');
        mywindow.document.write('<html><head><title>ESI BILL</title>');
        mywindow.document.write('</head><body>');
        mywindow.document.write(printContent);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.print();
        // mywindow.close();

        return false;
    }
    </script>
</body>

</html>