<?php ini_set( "display_errors", 0);



include("access.php");




mysqli_
// header('Location:managesite1.php?id='.$id); 

 



		

//$result2 = mysql_query("SELECT DISTINCT bank FROM sites");		

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Untitled Document</title>

<link href="style.css" rel="stylesheet" type="text/css" />

<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script type="text/javascript">

function getbank(val)

{

	if (window.XMLHttpRequest)

  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();

  }

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }

xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)

    {

		

//alert(xmlhttp.responseText);

document.getElementById('bank').innerHTML='';

	document.getElementById('bank').innerHTML=xmlhttp.responseText;

	

	

    }

  }

// alert("getcustbank.php?val="+val);

xmlhttp.open("GET","getcustbank.php?val="+val+"&type=ebill",true);

xmlhttp.send();



	

}

function searchById(a,b,perpg) {

//alert(a+" "+b+" "+perpg);

var ppg='';

if(perpg=='')

ppg='50';

else

ppg=document.getElementById(perpg).value;

document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";

		  HttPRequest = false;

		  if (window.XMLHttpRequest) { // Mozilla, Safari,...

			 HttPRequest = new XMLHttpRequest();

			 if (HttPRequest.overrideMimeType) {

				HttPRequest.overrideMimeType('text/html');

			 }

		  } else if (window.ActiveXObject) { // IE

			 try {

				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");

			 } catch (e) {

				try {

				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");

				} catch (e) {}

			 }

		  } 

 

		  if (!HttPRequest) {

			 alert('Cannot create XMLHTTP instance');

			 return false;

		  }

		 // var br=document.getElementById('br').value;

		  var cid=document.getElementById('cid').value;//alert(cid);

		//  var calltype=document.getElementById('calltype').value;

	

			 if(a!="Loading"){

			 ///var id=document.getElementById('atmid').value;//alert(id);

			 var atm=document.getElementById('atm').value;

			// var bank=document.getElementById('bank').value;//alert(bank);

			// var service=document.getElementById('service').value;

			 

			 

			 //var comp=document.getElementById('comp').value;

			  var dt=document.getElementById('date').value;

			 var dt2=document.getElementById('date2').value;

			  }

			 // alert(br);mysqli_

			//alertmysqli_; 
mysqli_
			var url = 'uploadedbimysqli_.php'; 
mysqli_
		//  }

 	//alert(br);

		    var pmeters="";

			//alert(url);

			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 

			if(a!="Loading"){ 

			 pmeters = 'cid='+cid+'&Page='+b+'&perpg='+ppg+"&dt="+dt+"&dt2="+dt2+"&atm="+atm;

			// alert(pmeters);

			}

			else

			{

				 pmeters = 'Page='+b+'&perpg='+ppg+'&cid='+cid;

			}

			//alert(pmeters);

			HttPRequest.open('POST',url,true);



			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

			HttPRequest.setRequestHeader("Content-length", pmeters.length);

			HttPRequest.setRequestHeader("Connection", "close");

			HttPRequest.send(pmeters);

 

//alert(pmeters); 

			HttPRequest.onreadystatechange = function()

			{

 

				 if(HttPRequest.readyState == 4) // Return Request

				  {

		var response = HttPRequest.responseText;

 

//alert(response);

				  document.getElementById("search").innerHTML = response;

			  }

		}

  }

  

  function approve(id,stat)

  {

  //alert(id+" "+stat);

  if (confirm('Are you sure you want to approve?')) {

    // Save it!



  	if (window.XMLHttpRequest)

  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();

  }

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }

xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)

    {

		

//alert(xmlhttp.responseText);

if(xmlhttp.responseText=='1')

document.getElementById(id).innerHTML='Approved';

else

alert("Some Error Occurred");

	

	

    }

  }

// alert("getcustbank.php?val="+val);

xmlhttp.open("GET","approveebill.php?id="+id+"&stat="+stat,true);

xmlhttp.send();

}

  }

</script>

</head>



<body onload="searchById('Listing','1','')">

<div class="fixed">

<center>

<?php include("menubar.php");

//echo $_SESSION['branch'];

include("config.php");

 $sql="select short_name,contact_first from contacts where type='c' and short_name in (select distinct(cust_id) from ebdetails)";

          // if($_SESSION['custid']!='all')

          // $sql.=" and customer_name='".$_SESSION['custid']."'";

           

     echo $sql;

 ?>

 </center>





<p align="center">

           <select name="cid" id="cid" onchange="searchById('Listing','1','');getbank(this.value);" ><option value="">select Client</option>

           <?php

echo $sql;

           $result1 = mysql_query($sql);

		   if(!$result)

		   echo mysql_error();

            while($row1 = mysql_fetch_row($result1)){

            //$custname=mysql_query("select contact_first from contacts where short_name='".$row1[0]."' and type='c'");

            //$name=mysql_fetch_row($custname);

           

             ?>

                                           <option value="<?php echo $row1[0]; ?>" ><?php echo $row1[1]; ?></option>

           <?php } ?>   </select>

          

          

        <!--  <select name="bank" id="bank" onchange="searchById('Listing','1','');" ><option value="">select Bank</option>

           </select>-->

                <input type="text" name="atm" id="atm" placeholder="ATM ID" onkeyup="searchById('Listing','1','');"  />

    

    <input type="text" name="date" id="date" placeholder="From date" onclick="displayDatePicker('date');"  />

      <input type="text" name="date2" id="date2" placeholder="To date" onclick="displayDatePicker('date2');"  />  

      <input type="button" onclick="searchById('Listing','1','');" value="Search by Date">

</p>

</div>



<div id="search">  </div>



<script type="text/javascript" src="1.7.2.jquery.min.js"></script>

<script type="text/javascript" src="script.js"></script>



</body>

</html>