<?php
session_start();
if (isset($_SESSION['SESS_USER_NAME'])) {

    include 'config.php';
    // $id = $_GET['id'];
    $id = '';


    // $sql = "select * from appoint where app_id='$id'";
    // $result = mysqli_query($con, $sql);
    // $row = mysqli_fetch_row($result);

    // $sql1 = "select * from patient where no='$row[11]'";
    // $result1 = mysqli_query($con, $sql1);
    // $row1 = mysqli_fetch_row($result1);

    $sqlmax = "select max(billno) from servicebill";
    $resultmax = mysqli_query($con, $sqlmax);
    $rowmax = mysqli_fetch_row($resultmax);
    $bill_no = $rowmax[0];
    if($bill_no=='')
    {
        $_billno = '1';
    }
    else{
        $_billno = $bill_no + 1;
    }

?>
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
            var billno = document.getElementById('amtc').value;
            var name = document.getElementById('amtc').value;
            var agesex = document.getElementById('amtc').value;
            var address = document.getElementById('amtc').value;
            var contact = document.getElementById('amtc').value;

            var amtc = document.getElementById('amtc').value;
            var rem = document.getElementById('rem').value;
            var proc = document.getElementsByClassName('proc');
            var rate = document.getElementsByClassName('rate');
            var amt = document.getElementsByClassName('amt');
            var proc1 = "";
            var rate1 = "";
            var amt1 = "";
            var sr1 = "";   
            for (i = 0; i < proc.length; i++) {
                proc1 = proc1 + proc[i].value + "<br>";
                rate1 = rate1 + rate[i].value + "<br>";
                amt1 = amt1 + amt[i].value + "<br>";
            } 
            popcontact('serv_print.php?id=<?php echo $id; ?>&billno=' + billno + '&name=' + name + '&agesex=' + agesex + '&address=' + address + '&contact=' + contact + '&amtc=' + amtc  + '&rem=' + rem + '&proc1=' + proc1  + '&rate1=' + rate1 + '&amt1=' + amt1 );
        }

        var searchReq = getXMLHttp();
        function getXMLHttp(){

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

        function MakeRequest() {
            var xmlHttp = getXMLHttp();
            //alert("hi");
            xmlHttp.onreadystatechange = function() {

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
            xmlHttp.open("GET", "getServMore.php?cnt=" + cnt, false);

            xmlHttp.send(null);

        }

        function HandleResponse(response){
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
        function proce(src) {

            var xmlHttp = getXMLHttp();
            xmlHttp.onreadystatechange = function(){
                if (xmlHttp.readyState == 4)
                {
                    // alert(xmlHttp.responseText);  
                    var str = xmlHttp.responseText.split("#");
                    document.getElementById('rate' + src).value = str[0];
                    document.getElementById('amt' + src).value = str[0];
                }
            }
            var proc = document.getElementById('proc' + src).value;
            //alert(proc);
            xmlHttp.open("GET", "get_servrate.php?proc=" + proc, false);
            xmlHttp.send(null);
        }

        

        function getsum() {
            // alert("callme");
            var a1 = parseInt(document.getElementById('amtc').value);
            // alert(a1+a);
            document.getElementById('totalamt').value = a1 ;

        }

        function getSum1() {
            var cnt1 = parseInt(document.getElementById('cnt').value);
            // alert(cnt1);
            var tot = 0;
            for (var xy = 0; xy < cnt1; xy++) {
                if (document.getElementById('amt' + xy).value != "") {
                    tot += parseInt(document.getElementById('amt' + xy).value);
                   // alert(tot);
                }
                

            }
            document.getElementById('totalamt').value = tot;
        }

        function getSumDisc() {
            var cnt1 = parseInt(document.getElementById('cnt').value);
            // alert(cnt1);
            var tot = 0;
            for (var xy = 0; xy < cnt1; xy++) {
                if (document.getElementById('discount' + xy).value != "") {
                    tot += parseInt(document.getElementById('discount' + xy).value);
                   // alert(tot);
                }
                

            }
            document.getElementById('totaldiscamt').value = tot;
        }

        function getSum2() {
            var cnt1 = parseInt(document.getElementById('cnt1').value);
            // alert(cnt1);
            var tot = 0;
            for (var xy = 0; xy < cnt1; xy++) {
                if (document.getElementById('other_crate' + xy).value != "") {
                    tot += parseInt(document.getElementById('other_crate' + xy).value);
                    //alert(tot);
                }
                /* var a2 = parseInt(document.getElementById('amtcII').value);
                 var a3 = parseInt(document.getElementById('amtcIII').value);
                 var a4 = parseInt(document.getElementById('amtcIV').value);*/

            }
            document.getElementById('amtcII').value = tot;
        }

        function getSum3() {
            var cnt1 = parseInt(document.getElementById('cnts').value);
            // alert(cnt1);
            var tot = 0;
            for (var xy = 0; xy < cnt1; xy++) {
                if (document.getElementById('amts' + xy).value != "") {
                    tot += parseInt(document.getElementById('amts' + xy).value);
                    //alert(tot);
                }
                /* var a2 = parseInt(document.getElementById('amtcII').value);
                 var a3 = parseInt(document.getElementById('amtcIII').value);
                 var a4 = parseInt(document.getElementById('amtcIV').value);*/

            }
            document.getElementById('amtcIII').value = tot;
        }

        function getSum4() {
            var cnt1 = parseInt(document.getElementById('cntst').value);
            // alert(cnt1);
            var tot = 0;
            for (var xy = 0; xy < cnt1; xy++) {
                if (document.getElementById('amtst' + xy).value != "") {
                    tot += parseInt(document.getElementById('amtst' + xy).value);
                    //alert(tot);
                }
                /* var a2 = parseInt(document.getElementById('amtcII').value);
                 var a3 = parseInt(document.getElementById('amtcIII').value);
                 var a4 = parseInt(document.getElementById('amtcIV').value);*/

            }
            document.getElementById('amtcIV').value = tot;
        }

        function netamt1(xyz) {
            //alert(xyz+"--");
            var rate = document.getElementById('rate' + xyz).value;
            //alert(rate)
            var qty = document.getElementById('qty' + xyz).value;
            document.getElementById('amt' + xyz).value = parseInt(rate) * parseInt(qty);
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

    <!--Discharge form-->
    <div class="login-popup">


        <form method="post" class="signin" action="process_service.php">

            <input type="hidden" name="myvar" value="0" id="theValue" />
            <p align="right"><input id="cdate" name="cdate" type="text" value="<?php echo date( "d/m/Y H:i:s");?>" style="background-color:#00a4ae; border:none; text-align:right;"></p>

            <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Test Bill Format</p>

            <input type="hidden" name="ad_id" value="<?php echo $row[12]; ?>" />
            <input type="hidden" name="pid" value="<?php echo $row[11]; ?>" />

            <table id="ds">

                <tr>
                    <td><label class="fdiag">Bill no. :</label></td>
                    <td><input id="bill" name="bill" type="text" value ="<?php echo $_billno;?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>

                <tr>
                    <td width="306">Name :</td>
                    
                    <td width="168"><input id="name" name="name" type="text"  style="background-color:#DCDCDC;" autocomplete="off"></td>
                </tr>

                <tr>
                    <td><label class="fdiag">Age/Sex :</label></td>

                    <td><input id="fd" name="fd" type="text"  style="background-color:#DCDCDC;" autocomplete="off"  /></td>
                    
                </tr>

                <tr>
                    <td><label class="pro_diag">Address :</label></td>
                    <td><textarea name="inv" rows="3" cols="22" style="resize:none;background-color:#DCDCDC" autocomplete="off" ></textarea></td>
                </tr>

                <tr>
                    <td><label class="datead">Contact No:</label></td>
                   <td> <input id="datead" name="datead" type="text" style="background-color:#DCDCDC;" maxlength="10" autocomplete="off"/></td>
                </tr>

                

                

                <!-- <tr>
                    <td><label class="refno">Referral S.No.(Routine) /<br />
                            Emergency/ through SSMC/SMC :</label></td>
                    <td><input id="refno" name="refno" type="text" value="<?php echo $row[7]; ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr> -->

                <!-- <tr>
                    <td><label class="datead">Date of Referral :</label></td>
                    <td><input id="dateref" name="dateref" type="text" value="<?php if (isset($row[15]) and $row[15] != '0000-00-00') echo date('d/m/Y', strtotime($row[15])); ?>" style="background-color:#DCDCDC;"></td>
                </tr> -->

                <!-- <tr>
                    <td><label class="inv">Department:</label></td>
                    <td><input type="text" name="dept" id="dept" /></td>
                </tr> -->


                <tr>
                    <td colspan="4"> 

                        <table width="882" border="1" id="detail">
                            <tr>
                                <th width="27">Sr no</th>
                                <th width="122">Chargeable Procedure</th>
                                
                                <th width="84">Rate(₹)</th>
                                <th width="40">Qty</th>
                                <th width="50">Discount(₹)</th>
                                <th width="80">Amt. Claimed(₹)</th>
                                
                            </tr>

                            <?php
                            $cnt = 0;
                            for ($j = 0; $j <= 1; $j++) {
                                $cnt = $cnt + 1;
                            ?>
                                <tr>
                                    <td><input type="hidden" value="<?php echo $cnt; ?>" name="sr[]" id="sr" class="sr" /><?php echo $cnt; ?></td>
                                    <td>

                                        <select style="width:140px;" name="proc[]" id="proc<?php echo $j; ?>" class="proc" onchange="proce(<?php echo $j; ?>);">
                                            <option value="0">Select</option>
                                            <?php
                                            $sq = mysqli_query($con, "select * from service_master where serv_name<>'' order by id");
                                            while ($ro = mysqli_fetch_row($sq)) {
                                            ?>
                                                <option value="<?php echo $ro[0]; ?>"><?php echo $ro[1]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>

                                    

                                    <td><input type="text" name="rate[]" id="rate<?php echo $j; ?>" class="rate" style="width:140px;" readonly/></td>
                                    <td><input type="text" name="qty[]" id="qty<?php echo $j; ?>" value="1" class="rate" style="width:40px;" onchange="netamt1(<?php echo $j; ?>);" readonly/></td>
                                    <td><input type="text" name="discount[]" id="discount<?php echo $j; ?>" class="discount" style="width:140px;" /></td>                                    
                                    <td><input type="text" name="amt[]" id="amt<?php echo $j; ?>" class="amt" style="width:140px;" /></td>
                                  
                                </tr>

                            <?php  } ?><input type="hidden" name="cnt" id="cnt" value="<?php echo $cnt; ?>" />
                        </table>

                        <a href="#" id="add" style="color:#ac0404; font-weight:bold; font-size:16px;" onClick="MakeRequest();">Add More </a>
                    </td>
                </tr>

                <tr>
                    <td>Total Amount Claimed Rs.</td>
                    <td><input type="text" name="totalamt" id="totalamt" value=0 onfocus="getSum1();"> </td>
                    <td width="53"></td>
                    <td width="124"></td>
                    
                </tr>
                <tr>
                    <td>Total Amount Discounted Rs.</td>
                    <td><input type="text" name="totaldiscamt" id="totaldiscamt" value=0 onfocus="getSumDisc();"> </td>
                    <td width="53"></td>
                    <td width="124"></td>
                    
                </tr>

                <tr>
                    <td>Mode of Payment : </td>
                    <td><select type="text" name="paytype" id="paytype" style="width: 176px;">
                        <option value="cash">Cash</option>
                        <option value="credit">Credit</option>
	 <option value="online">Online</option>
                    </select> </td>
                    <td>Remarks : </td>
                    <td><input type="text" name="totalrem" id="totalrem"> </td>
                </tr>

                <tr>
                    <td colspan="2" align="center"><button class="submit formbutton" type="submit">Submit</button>&nbsp;&nbsp;
                        <a href="home.php"> <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                        <!-- <button class="submit formbutton" type="button" onClick="javascript:pres();">Print</button> -->
                        <!-- <button class="submit formbutton" type="button" onclick="divprint()">Print</button> -->
                    </td>
                </tr>
            </table>

        </form>
    </div>

    <script >
function divprint(){
var data = document.getElementById('login-popup').innerHTML;
//alert(data);
var mywindow = window.open('', 'GDH', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Test Bill</title>');       
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
		}
</script>

<?php
} else {
    header("location: index.html");
}
?>