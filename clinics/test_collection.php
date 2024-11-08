<?php
session_start();
if (isset($_SESSION['SESS_USER_NAME'])) {
    include 'config.php';
?>

<!--Datepicker-->
<link href="paging.css" rel="stylesheet" type="text/css" />
<script>
//////////////subcat
function loadXMLDoc() {
    var xmlhttp;
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) { // alert(xmlhttp.responseText);
            document.getElementById("sub_cat").innerHTML = xmlhttp.responseText;
        }

    }
    var cat = document.getElementById('diagnosis').value;
    xmlhttp.open("POST", "sub_cat.php?cat=" + cat, true);

    xmlhttp.send();
}



///////////////////////////////search By Id
function searchById(Mode, Page) {
    try {
        var frdt = document.getElementById('frdt').value;
        var todt = document.getElementById('todt').value;

        var url = 'testcollectionrep.php';
        var pmeters = 'mode=' + Mode + '&Page=' + Page + '&frdt=' + frdt + '&todt=' + todt;

        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: pmeters
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById("search").innerHTML = data;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    } catch (exc) {
        alert(exc);
    }
}
</script>
<!-- end multiple selection -->


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

    border: 2px solid #ac0404;

    font-size: 1.2em;
    position: relative;
    margin: auto;
    width: 1200px;
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
    /* Position the close button float: right; */
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

#banner_box .button a {
    margin: 0 auto;
    background: url(images/button_02.png) no-repeat;
}

#banner_box .button a:hover {
    color: #f8e836;
}

#site_title_bar_wrapper_outter {
    width: 100%;
    height: 50px;
    margin: 0 auto;
    background: url(images/header_bg_wrapper_outter.gif) top repeat-x;
}
</style>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Health Clinic</title>

    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
    <script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

</head>

<body onLoad="searchById('Listing','1')">
    <div id="view_patient" class="login-popup">
        <div id="view_patient1">

            <!-- <h1 style="font-size:19px;" style="alin:center">Welcome to Health Clinic </h1> -->
            <h2>
                <p style="color:black" align="center">Welcome to Health Clinic</p>
            </h2>


            <a href="home.php"> <button class="submit formbutton" type="button"
                    onClick="javascript:location.href = 'home.php';">Go Back</button></a>&nbsp;&nbsp;&nbsp; <a
                href="home.php"> <button class="submit formbutton" type="button"
                    onClick="javascript:location.href = 'logout.php';">Log Out</button></a>





            <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Test Collections</p>
            <table>
                <tr>
                    <td><span><b>From date : </b></span><input id="frdt" name="frdt" type="date"
                            value="<?php echo date('d/m/Y'); ?>" /></td>
                    <td><span><b>To date : </b></span><input id="todt" name="todt" type="date"
                            value="<?php echo date('d/m/Y'); ?>" /></td>

                    <td>
                        <button type="button" onclick="searchById('Listing','1');">Search</button>
                    </td>
                </tr>
            </table>

            <div id="search"></div>




        </div>
    </div>
</body>

</html>
<?php
} else {
    header("location: index.html");
}
?>