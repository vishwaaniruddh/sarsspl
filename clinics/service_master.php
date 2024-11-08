<html>

<head>
    <link href="style.css" rel="stylesheet" type="text/css" />

    <!--Datepicker-->
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
    <script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

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
            width: 1100px;
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
            /* Position the close button */
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
    </style>
    <script>
        function MakeRequest()
        {
            var xmlHttp = getXMLHttp();
            //alert("hi");
            xmlHttp.onreadystatechange = function()
            {

                if (xmlHttp.readyState == 4)

                {
                    //alert(xmlHttp.responseText);
                    var str = xmlHttp.responseText; //.split("___///");
                    //document.getElementById('cnt').value=str[0];
                    //alert(str);
                    HandleResponse(str);

                }

            }

            // alert("hi2");
            var cnt = parseInt(document.getElementById('cnt').value) + 1;
            //alert(cnt);
            document.getElementById('cnt').value = cnt;
            xmlHttp.open("GET", "addmore.php?cnt=" + cnt, false);

            xmlHttp.send(null);

        }
    </script>
</head>
<title>Add Services</title>

<body>
    <?php
    include 'config.php';

    ?>

    <div  class="login-popup">

        <!-- <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a> -->

        <form method="post" action="service_details.php" name="form" enctype="multipart/form-data">

            <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Service</p>

            <p align="right"><input id="cdate" name="cdate" type="text" value="<?php echo date("d/m/Y"); ?>" style="background-color:#00a4ae; border:none; text-align:right;" readonly></p>

            <fieldset class="textbox">
                <table>

                    <tr>
                        <td><label class="fname"> Service Name: </label></td>
                        <td><input type="text" id="servname" name="servname" class="servname"> </td>
                    </tr>
                    <tr>
                        <td><label class="age"> Service Amount: </label></td>
                        <td><input type="text" id="servamt" name="servamt" class="servamt"></td>
                    </tr>
                </table>
                <!-- <a href="#" id="add" style="color:#ac0404; font-weight:bold; font-size:16px;" onClick="MakeRequest();">Add More </a><br> -->
                <button class="submit" class="btn btn-primary" type="submit" name="Submit">Submit</button>

                <br>
                <!-- <button class="submit" class="btn btn-secondary" type="delete" name="Delete">Delete</button> -->
                <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go Back</button>
            </fieldset>
        </form>
    </div>
</body>

</html>