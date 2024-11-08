<?php
session_start();
if (isset($_SESSION['SESS_USER_NAME'])) {

    include 'config.php';
    $billid = $_GET['billno'];

    $sql = mysqli_query($con, "select * from servicebill where billno = '" . $billid . "' ");
    $bill_detail = mysqli_fetch_assoc($sql);
    $_billno = $bill_detail['billno'];
    $name = $bill_detail['name'];
    $agesex = $bill_detail['agesex'];
    $address = $bill_detail['address'];
    $contact  = $bill_detail['contact'];
    $amount = $bill_detail['amt'];
    $discount = $bill_detail['discount'];
    $rem = $bill_detail['remark'];
    $paytype = $bill_detail['paytype'];

    $sql1 = mysqli_query($con, "select * from servicebill_details where billno = '" . $_billno . "' ");
    $bill_detail_res = mysqli_fetch_assoc($sql1);

?>
    <html>

    <head>
        <script>
            function popcontact(URL) {
                var popup_width = 900
                var popup_height = 600
                day = new Date();
                id = day.getTime();
                eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
            }
            ////for print
            function pres() {
                //alert ("isuhgf");
                var cond = document.getElementById('condi').value;
                var amtc = document.getElementById('amtc').value;
                var amtad = document.getElementById('amtad').value;
                var rem = document.getElementById('rem').value;
                var code = document.getElementsByClassName('code');
                var proc = document.getElementsByClassName('proc');
                var other = document.getElementsByClassName('other');
                var code = document.getElementsByClassName('code');
                var rate = document.getElementsByClassName('rate');
                var amt = document.getElementsByClassName('amt');
                var proc1 = "";
                var other1 = "";
                var code1 = "";
                var rate1 = "";
                var amt1 = "";
                var sr1 = "";
                var implan = document.getElementById('implan').value;
                var other_proc = document.getElementsByClassName('other_proc');
                var other_rate = document.getElementsByClassName('other_rate');
                var other_proc1 = "";
                var other_rate1 = "";

                for (i = 0; i < proc.length; i++) {

                    proc1 = proc1 + proc[i].value + "<br>";

                    other1 = other1 + other[i].value + "<br>";

                    code1 = code1 + code[i].value + "<br>";

                    rate1 = rate1 + rate[i].value + "<br>";

                    amt1 = amt1 + amt[i].value + "<br>";


                }

                for (r = 0; r < other_proc.length; r++) {

                    other_proc1 = other_proc1 + other_proc[r].value + "<br>";

                    other_rate1 = other_rate1 + other_rate[r].value + "<br>";
                }

                /*popcontact('esi_print.php?id=<?php //echo $id; 
                                                ?>&cond='+cond+'&impalnt='+implant+'&amtc='+amtc+'&amtad='+amtad+'&rem='+rem+'&proc1='+proc1+'&other1='+other1+'&code1='+code1+'&rate1='+rate1+'&amt1='+amt1);
                
                for(i=0;i<proc.length;i++) {
                	
                	
                    code1=code1+code[i].value+"<br>";
                	
                
                }*/
                popcontact('esi_print.php?id=<?php echo $id; ?>&cond=' + cond + '&amtc=' + amtc + '&amtad=' + amtad + '&rem=' + rem + '&code1=' + code1 + '&proc1=' + proc1 + '&other1=' + other1 + '&rate1=' + rate1 + '&amt1=' + amt1 + '&implan=' + implan + '&other_proc1=' + other_proc1 + '&other_rate1=' + other_rate1);
            }

            var searchReq = getXMLHttp();

            function getXMLHttp()

            {

                var xmlHttp

                // alert("hi1");

                try

                {

                    //Firefox, Opera 8.0+, Safari

                    xmlHttp = new XMLHttpRequest();

                } catch (e)

                {

                    //Internet Explorer

                    try

                    {

                        xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");

                    } catch (e)

                    {

                        try

                        {

                            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

                        } catch (e)

                        {

                            alert("Your browser does not support AJAX!")

                            return false;

                        }

                    }

                }

                return xmlHttp;

            }

            function MakeRequest()

            {

                var xmlHttp = getXMLHttp();

                //alert("hi");

                xmlHttp.onreadystatechange = function()

                {

                    if (xmlHttp.readyState == 4)

                    {
                        //alert(xmlHttp.responseText);
                        var str = xmlHttp.responseText.split("___///");
                        document.getElementById('cnt').value = str[0];
                        //alert(str[1]);
                        HandleResponse(str[1]);

                    }

                }

                // alert("hi2");
                var cnt = document.getElementById('cnt').value;
                xmlHttp.open("GET", "getMore.php?cnt=" + cnt, false);

                xmlHttp.send(null);

            }

            function HandleResponse(response)

            {
                //alert(response);
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
        </script>

        <script>
            ////////////get charges

            function otherproc(src1) {

                var xmlHttp = getXMLHttp();

                //alert("hi");

                xmlHttp.onreadystatechange = function()

                {

                    if (xmlHttp.readyState == 4)

                    {
                        //alert(xmlHttp.responseText);
                        var str = xmlHttp.responseText.split("#");
                        document.getElementById('other_rate' + src1).value = str[0];
                        //alert(str[1]);
                        HandleResponse(str[1]);

                    }

                }

                // alert("hi2");
                var other_proc = document.getElementById('other_proc' + src1).value;
                xmlHttp.open("GET", "get_rate.php?other_proc=" + other_proc, false);

                xmlHttp.send(null);

            }


            function proce(src) {

                var xmlHttp = getXMLHttp();

                //alert(src);

                xmlHttp.onreadystatechange = function()

                {

                    if (xmlHttp.readyState == 4)

                    {
                        //alert(xmlHttp.responseText);
                        var str = xmlHttp.responseText.split("#");
                        document.getElementById('code' + src).value = document.getElementById('proc' + src).value;
                        document.getElementById('rate' + src).value = str[0];
                        //alert(str[0]+"<>"+str[1]);
                        //  HandleResponse(str[1]);

                    }

                }

                // alert("hi2");
                var proc = document.getElementById('proc' + src).value;

                xmlHttp.open("GET", "get_rate1.php?proc=" + proc, false);

                xmlHttp.send(null);

            }

            function proces(src) {

                var xmlHttp = getXMLHttp();

                //alert(src);

                xmlHttp.onreadystatechange = function()

                {

                    if (xmlHttp.readyState == 4)

                    {
                        //alert(xmlHttp.responseText);
                        var str = xmlHttp.responseText.split("#");
                        document.getElementById('codes' + src).value = document.getElementById('procs' + src).value;
                        document.getElementById('rates' + src).value = str[0];
                        //alert(str[0]+"<>"+str[1]);
                        //  HandleResponse(str[1]);

                    }

                }

                // alert("hi2");
                var proc = document.getElementById('procs' + src).value;

                xmlHttp.open("GET", "get_rate1.php?proc=" + proc, false);

                xmlHttp.send(null);

            }


            function printDiv(divID) {
                //Get the HTML of div
                var divElements = document.getElementById(divID).innerHTML;
                //Get the HTML of whole page
                var oldPage = document.body.innerHTML;

                //Reset the page's HTML with div's HTML only
                document.body.innerHTML =
                    "<html><head><title></title></head><body>" +
                    divElements + "</body></html";

                //Print Page
                window.print();

                //Restore orignal HTML
                document.body.innerHTML = oldPage;


            }
        </script>
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
    </head>

    <body>
        <!--Discharge form-->
        <div class="login-popup" id="printme">            
            <DIV>
                <TABLE>
                    <TR>
                        <TD><IMG src="images\gdh1.png" height="100" width="250" /></TD>
                        <TD align="center">
                            <div align="center"> <b> GINDODI DEVI HOSPITAL
                                </b> </div>
                            <p align="center"> Owned By : Swargiya Gindodi Devi Charitable Trust <BR>G.E. ROAD, KHURSIPAR - 490 012 (C.G.)<BR>PHONE: 0788-4051001 </p>
                        </TD>
                    </TR>
                </TABLE>
            </DIV>

            <input type="hidden" name="myvar" value="0" id="theValue" />
            <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Test Bill</p>

            <!-- <input type="hidden" name="ad_id" value="<?php echo $row[12]; ?>" />
            <input type="hidden" name="pid" value="<?php echo $row[11]; ?>" /> -->

            <table id="ds">

                <tr>
                    <td><label class="fdiag">Bill no. :</label></td>
                    <td><label><?php echo $billid; ?></label></td>
                </tr>

                <tr>
                    <td width="306">Name :</td>
                    <td width="168"><label><?php echo ucwords($name); ?></label></td>
                </tr>

                <tr>
                    <td><label class="fdiag">Age/Sex :</label></td>
                    <td><label><?php echo $agesex; ?></label></td>
                </tr>

                <tr>
                    <td><label class="pro_diag">Address :</label></td>
                    <td><?php echo ucwords($address); ?></td>
                </tr>

                <tr>
                    <td><label class="datead">Contact No:</label></td>
                    <td><label><?php echo $contact; ?></label></td>
                </tr>

                

                <tr>
                    <td colspan="4"> 

                        <table width="882" border="1" id="detail">
                            <tr>
                                <th width="17">Sr no</th>
                                <th width="52">Chargeable Procedure</th>
                                <th width="54">Rate(₹)</th>                                
                            </tr>

                            <?php
                            $sqn = mysqli_query($con, "select * from servicebill_details where billno='$billid' and type=1");
                            $cnt = 0;
                            while ($ron = mysqli_fetch_row($sqn)) {
                                $cnt = $cnt + 1;
                            ?>
                                <tr>
                                    <td align="center"><?php echo $cnt; ?></td>
                                    <td align="center">
                                        <?php
                                        $sq = mysqli_query($con, "select * from service_master where id='".$ron[1]."' ");
                                        $ro = mysqli_fetch_row($sq);
                                        echo $ro[1]; ?>
                                    </td>

                                    <td align="center"><?php echo $ron[2]; ?></td>                                    
                                </tr>

                            <?php  } ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    
                    <td width="153">Amount Claimed : </td>
                    <td width="52"><?php echo '₹ '.$amount; ?></td>
                </tr>

                <tr>                    
                    <td width="153">Amount Discounted : </td>
                    <td width="52"><?php echo '₹ '.$discount; ?></td>
                </tr>

                <tr>                    
                    <td width="153">Remarks : </td>
                    <td width="124"><?php echo ucwords($rem); ?></td>
                </tr>

                <tr>                    
                    <td width="153">Mode of Payment : </td>
                    <td width="124"><?php echo ucwords($paytype); ?></td>
                </tr>


            </table>
            <div>
                <br><br><br>
                &nbsp;&nbsp;&nbsp;&nbsp; Sign/Thumb impression of patient with date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sign & Stamp of Authorized Signatory with date
                
            </div>
        <p align="right">Generated By :<?php echo $_SESSION['SESS_USER_NAME']; ?> </p>
        <p align="right"><input id="cdate" name="cdate" type="text" value="<?php echo date( "d/m/Y H:i:s");?>" style="background-color:#00a4ae; border:none; text-align:right;"></p>
                                
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button class="submit formbutton" type="button" onClick="javascript:printDiv('printme')">Print</button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="view_testbill.php"> <button class="submit formbutton" type="button" onClick="javascript:location.href = 'view_testbill.php';">Go Back</button></a>
    
    
    </body>

    </html>
<?php
} else {
    header("location: index.html");
}
?>