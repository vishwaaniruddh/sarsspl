<html>
<head>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>


<style>

</style>
</head>
<body>
<form name="frm1" method="post">
<div align="center" style="padding:200px">
<table id="tab">
<tr>
  <td>
  Invoice NO:
  </td>
  
  <td>
  <input type="text" name="invno" id="invno"/>
  </td>
</tr>
<tr>
  <td>
  Invoice Date:
  </td>
  
  <td>
  <input type="text" name="date1" id="date1"  onclick="displayDatePicker('date1');"  />
  </td>
</tr>
<tr>
  <td>
  Courier Name:
  </td>
  
  <td>
  <input type="text" name="cname" id="cname"/>
  </td>
</tr>

<tr>
  <td>
  Docket No:
  </td>
  
  <td>
  <input type="text" name="dno" id="dno"/>
  </td>
</tr>

<tr>
  <td>
  Dispatch Date:
  </td>
  
  <td>
  <input type="text" name="date2" id="date2"  onclick="displayDatePicker('date2');"  />
  </td>
</tr>



</table>


</div>
</form>
</body>