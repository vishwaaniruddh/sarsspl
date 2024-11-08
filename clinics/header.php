<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Health Clinic</title>
    <meta name="keywords" content="#" />
    <meta name="description" content="#" />
    <link href="style.css" rel="stylesheet" type="text/css" />

    <!--Datepicker-->
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
    <script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

    <!--menu-->
    <style type="text/css">
    .sidebarmenu ul {
        margin: 0;
        padding: 0;
        list-style-type: none;
        font: bold 14px Verdana;
        width: 180px;
        /* Main Menu Item widths */
        border-bottom: 1px solid #ccc;
        border-radius: 10px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        -khtml-border-radius: 10px;
    }

    .sidebarmenu ul li {
        position: relative;
    }


    /* Top level menu links style */
    .sidebarmenu ul li a {
        display: block;
        overflow: auto;
        /*force hasLayout in IE7 */
        color: white;
        text-decoration: none;
        padding: 6px;
        border-bottom: 1px solid #fff;
        border-right: 1px solid #fff;
        border-radius: 10px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        -khtml-border-radius: 10px;
    }

    .sidebarmenu ul li a:link,
    .sidebarmenu ul li a:visited,
    .sidebarmenu ul li a:active {
        background-color: #01a3ae;
        /*background of tabs (default state)*/
    }

    .sidebarmenu ul li a:visited {
        color: white;
    }

    .sidebarmenu ul li a:hover {
        background-color: #ac0404;
    }

    /*Sub level menu items */
    .sidebarmenu ul li ul {
        position: absolute;
        width: 170px;
        /*Sub Menu Items width */
        top: 0;
        visibility: hidden;
    }

    .sidebarmenu a.subfolderstyle {
        background: url(images/right.gif) no-repeat 97% 50%;
    }


    /* Holly Hack for IE \*/
    * html .sidebarmenu ul li {
        float: left;
        height: 1%;
    }

    * html .sidebarmenu ul li a {
        height: 1%;
    }

    /* End */
    .pg-normal {
        color: black;
        font-weight: normal;
        text-decoration: none;
        cursor: pointer;
    }

    .pg-selected {
        color: #00F;
        font-weight: bold;
        text-decoration: underline;
        cursor: pointer;
    }
    </style>
    <!--month, year dropdown-->
    <script type="text/javascript">
    function createList() {

        year = document.getElementById('year');
        var i = 2000;
        for (i = 2000; i <= new Date().getFullYear(); i++) {
            var newOpt = year.appendChild(document.createElement('option'));
            newOpt.text = "" + i;
            newOpt.value = "" + i;
        }
    }

    function daysInMonth(month, year) {
        var dd = new Date(year, month, 0);
        return dd.getDate();
    }

    function setDayDrop(dyear, dmonth, dday) {
        var year = dyear.options[dyear.selectedIndex].value;
        var month = dmonth.options[dmonth.selectedIndex].value;
        var day = dday.options[dday.selectedIndex].value;

        if (day == ' ') {
            var days = (year == ' ' || month == ' ') ?
                31 : daysInMonth(month, year);
            dday.options.length = 0;
            dday.options[dday.options.length] = new Option(' ', ' ');

            for (var i = 1; i <= days; i++)
                dday.options[dday.options.length] = new Option(i, i);

        }
    }


    function setDay() {
        var year = document.getElementById('year');
        var month = document.getElementById('month');
        var day = document.getElementById('day');
        setDayDrop(year, month, day);
    }
    //document.getElementById('year').onchange = setDay;
    //document.getElementById('month').onchange = setDay;
    </script>
    <script type="text/javascript">
    //Nested Side Bar Menu (Mar 20th, 09)
    //By Dynamic Drive: http://www.dynamicdrive.com/style/

    var menuids = ["sidebarmenu1"] //Enter id(s) of each Side Bar Menu's main UL, separated by commas

    function initsidebarmenu() {
        for (var i = 0; i < menuids.length; i++) {
            var ultags = document.getElementById(menuids[i]).getElementsByTagName("ul")
            for (var t = 0; t < ultags.length; t++) {
                ultags[t].parentNode.getElementsByTagName("a")[0].className += " subfolderstyle"
                if (ultags[t].parentNode.parentNode.id == menuids[i]) //if this is a first level submenu
                    ultags[t].style.left = ultags[t].parentNode.offsetWidth +
                    "px" //dynamically position first level submenus to be width of main menu item
                else //else if this is a sub level submenu (ul)
                    ultags[t].style.left = ultags[t - 1].getElementsByTagName("a")[0].offsetWidth +
                    "px" //position menu to the right of menu item that activated it
                ultags[t].parentNode.onmouseover = function() {
                    this.getElementsByTagName("ul")[0].style.display = "block"
                }
                ultags[t].parentNode.onmouseout = function() {
                    this.getElementsByTagName("ul")[0].style.display = "none"
                }
            }
            for (var t = ultags.length - 1; t > -
                1; t--
            ) { //loop through all sub menus again, and use "display:none" to hide menus (to prevent possible page scrollbars
                ultags[t].style.visibility = "visible"
                ultags[t].style.display = "none"
            }
        }
    }

    if (window.addEventListener)
        window.addEventListener("load", initsidebarmenu, false)
    else if (window.attachEvent)
        window.attachEvent("onload", initsidebarmenu)
    </script>

    <!--end menu-->

    <script language="javascript" type="text/javascript">
    function clearText(field) {
        if (field.defaultValue == field.value) field.value = '';
        else if (field.value == '') field.value = field.defaultValue;
    }
    </script>

    <!-- multiple selection -->
    <script type="text/javascript">
    function addThem() {
        var a = document.opdform.diagnosis;
        var add = a.value + ',';
        document.opd.diag.value += add;
        return true;
    }

    function addThem1() {
        var a = document.opdform.rec;
        var add = a.value + ',';
        document.opd.recm.value += add;
        return true;
    }
    </script>
    <!-- end multiple selection -->

    <!-- Patient validation-->
    <script type='text/javascript'>
    function validate(form) {
        with(form) {
            if (fname.value === "") {
                alert("Please Enter Firstname");
                fname.focus();
                return false;
            }

            if (cn.value.search(/[0-9]+/) === -1) {
                alert("Please enter Telephone No. to continue.");
                cn.focus();
                return false;
            }

            if (city.value === "") {
                alert("Please Enter City");
                city.focus();
                return false;
            }
        }
        return true;
    }

    function getDate1() {
        var xmlhttp;
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("adate1").innerHTML = xmlhttp.responseText;
            }
        };
        var str = document.getElementById('adate').value;
        xmlhttp.open("GET", "getdate.php?adate=" + str, true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("fname=Henry&lname=Ford");
    }

    function caldays() {
        var m = parseInt(document.getElementById('month').value);
        var y = parseInt(document.getElementById('year').value);
        var dmax;

        if (m === 1 || m === 3 || m === 5 || m === 7 || m === 8 || m === 10 || m === 12) {
            dmax = 31;
        } else if (m === 4 || m === 6 || m === 9 || m === 11) {
            dmax = 30;
        } else {
            if ((y % 400 === 0) || (y % 4 === 0 && y % 100 !== 0)) {
                dmax = 29;
            } else {
                dmax = 28;
            }
        }

        document.getElementById('day1').value = dmax;
        return dmax;
    }
    </script>

    <!-- Medical Reports validation-->
    <script type='text/javascript'>
    function medvalidate(medform) {
        with(medform) {


            if (name.value == "") {
                alert("Please Enter Name");
                name.focus();
                return false;
            }

        }
        return true;
    }
    </script>
    <!--end validation-->

    <!--Telephone Directory validation-->
    <script type='text/javascript'>
    function telvalidate(telform) {
        with(telform) {


            if (name.value == "") {
                alert("Please Enter Name");
                name.focus();
                return false;
            }

            if (cn.value.search(/[0-9]+/) == -1) {
                alert("Please Enter Contact No. ");
                cn.focus();
                return false;
            }
            if (pin.value.search(/[0-9]+/) == -1) {
                alert("Please Enter Pincode ");
                pin.focus();
                return false;
            }

        }
        return true;
    }
    // <!--end validation--> 

    //  <!--Staff validation-->
    function staffvalidate(staffform) {
        with(staffform) {


            if (fname.value == "") {
                alert("Please Enter Name");
                fname.focus();
                return false;
            }

            if (dob4.value == "") {
                alert("Please select Birth Date");
                dob4.focus();
                return false;
            }

            if (add.value == "") {
                alert("Please Enter Address");
                add.focus();
                return false;
            }

            if (cn.value.search(/[0-9]+/) == -1) {
                alert("Please enter Telephone No. to continue.");
                cn.focus();
                return false;
            }

            if (post.value == "") {
                alert("Please enter Post");
                post.focus();
                return false;
            }

            if (bsal.value == "") {
                alert("Please enter Basic Salary");
                bsal.focus();
                return false;
            }

        }
        return true;
    }
    // <!--end validation-->

    //  <!--New doc validation-->

    function docvalidate(docform) {
        with(docform) {


            if (name.value == "") {
                alert("Please Enter Name");
                name.focus();
                return false;
            }


            if (city.value == "") {
                alert("Please Enter City");
                city.focus();
                return false;
            }
            if (cn.value.search(/[0-9]+/) == -1) {
                alert("Please Enter Contact No. ");
                cn.focus();
                return false;
            }

        }
        return true;
    }


    //////////////list
    var searchReq = getXMLHttp();

    function getXMLHttp() {

        var xmlHttp
        // alert("hi1");
        try {
            //Firefox, Opera 8.0+, Safari
            xmlHttp = new XMLHttpRequest();
        } catch (e) {
            //Internet Explorer
            try {
                xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");

            } catch (e) {
                try {
                    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
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

            if (xmlHttp.readyState == 4) {
                HandleResponse(xmlHttp.responseText);
            }
        }

        //alert("hi2");

        var str = document.getElementById('submit').value;
        var str1 = document.getElementById('search').value;
        var str2 = document.getElementById('searchtxt').value;
        // alert(str1);
        // alert(str2);
        xmlHttp.open("POST", "view.php");
        xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlHttp.send('code=' + str2 + '&search=' + str1);
        // alert('code='+str2+'&search='+str1)
        //xhr.open('POST', '/front/test');
        //xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //xhr.send('someNumber=12');
    }

    function HandleResponse(response) {

        document.getElementById('view_teldir1').innerHTML = response;

    }

    // <!--search doctor-->
    function MakeRequest1() {
        var xmlHttp = getXMLHttp();
        //alert("hi");
        xmlHttp.onreadystatechange = function() {

            if (xmlHttp.readyState == 4) {
                HandleResponse(xmlHttp.responseText);
            }
        }

        //alert("hi2");

        var str = document.getElementById('submit').value;
        var str1 = document.getElementById('docsearch').value;
        var str2 = document.getElementById('searchdoc').value;
        // alert(str1);
        // alert(str2);
        xmlHttp.open("POST", "view_doc.php");
        xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlHttp.send('code=' + str2 + '&docsearch=' + str1);
        // alert('code='+str2+'&search='+str1)
        //xhr.open('POST', '/front/test');
        //xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //xhr.send('someNumber=12');
    }

    function HandleResponse(response) {

        document.getElementById('view_doc1').innerHTML = response;

    }
    </script>
    <!--end validation-->

    <!-- popup window -->
    <style>
    #child td {
        border: 0;
    }

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
        display: none;
        background: #00a4ae;
        padding: 10px;
        border: 2px solid #ac0404;
        float: left;
        font-size: 1.1em;
        position: fixed;
        top: 50%;
        left: 40%;
        color: #FFF;
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
        /*Position the close button*/
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
        width: 220px;
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
        height: 40px;
    }

    td,
    th {
        padding-left: 3px;
        padding-right: 13px;
    }
    </style>
    <script type="text/javascript" src="popup/jquery-1.6.4.min.js"></script>
    <script>
    $(document).ready(function() {
        alert("hi");
        $('a.login-window').click(function() {

            //Getting the variable's value from a link 
            var loginBox = $(this).attr('href');

            //Fade in the Popup
            $(loginBox).fadeIn(300);

            //Set the center alignment padding + border see css style
            var popMargTop = ($(loginBox).height() + 24) / 2;
            var popMargLeft = ($(loginBox).width() + 24) / 2;

            $(loginBox).css({
                'margin-top': -popMargTop,
                'margin-left': -popMargLeft
            });

            // Add the mask to body
            $('body').append('<div id="mask"></div>');
            $('#mask').fadeIn(300);

            return false;
        });

        // When clicking on the button close or the mask layer the popup closed
        $('a.close, #mask').live('click', function() {
            $('#mask , .login-popup').fadeOut(300, function() {
                $('#mask').remove();
            });
            return false;
        });
    });

    ///////////////////////////////search By Id
    function searchById() {
        var xmlhttp;
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("search").innerHTML = xmlhttp.responseText;
            }
        }
        var id = document.getElementById('idd').value;
        var fname = document.getElementById('fname22').value;
        // alert(id);
        xmlhttp.open("GET", "get_ByID.php?id=" + id + "&fname=" + fname, true);
        //alert("get_ByID.php?id=" +  id+"&fname="+fname);
        xmlhttp.send();
    }


    ///////////////////////////////search Doctor
    function searchdoc1() {
        var xmlhttp;
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("docsearch1").innerHTML = xmlhttp.responseText;
            }
        }
        var id = document.getElementById('did').value;
        var dname = document.getElementById('dname').value;
        //var city=document.getElementById('city22').value;
        // alert(city);
        xmlhttp.open("GET", "get_docID.php?id=" + id + "&dname=" + dname, true);
        //alert("get_ByID.php?id=" +  id+"&fname="+fname);
        xmlhttp.send();
    }

    ///////////////////////////////search Surgery
    function searchsur() {
        var xmlhttp;
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("sursearch").innerHTML = xmlhttp.responseText;
            }
        }
        var type = document.getElementById('type').value;
        var head = document.getElementById('head').value;
        //var city=document.getElementById('city22').value;
        // alert(city);
        xmlhttp.open("GET", "get_surID.php?type=" + type + "&head=" + head, true);
        //alert("get_ByID.php?id=" +  id+"&fname="+fname);
        xmlhttp.send();
    }

    ///////////////////////////////search Appointments
    function searchapp() {
        var xmlhttp;
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("appsearch").innerHTML = xmlhttp.responseText;
            }
        }
        var pname = document.getElementById('pname').value;
        var adate = document.getElementById('adate').value;
        //var city=document.getElementById('city22').value;
        // alert(city);
        xmlhttp.open("GET", "get_appID.php?pname=" + pname + "&adate=" + adate, true);
        //alert("get_ByID.php?id=" +  id+"&fname="+fname);
        xmlhttp.send();
    }


    ///////////////////////////////search Telephone
    function searchtel() {
        var xmlhttp;
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("telsearch").innerHTML = xmlhttp.responseText;
            }
        }
        var tname = document.getElementById('tname').value;
        var tcon = document.getElementById('tcon').value;
        //var city=document.getElementById('city22').value;
        // alert(city);
        xmlhttp.open("GET", "get_telID.php?tname=" + tname + "&tcon=" + tcon, true);
        //alert("get_ByID.php?id=" +  id+"&fname="+fname);
        xmlhttp.send();
    }
    </script>

    <link rel="stylesheet" href="css/homestyle.css">

    <!-- end of popup window -->

</head>