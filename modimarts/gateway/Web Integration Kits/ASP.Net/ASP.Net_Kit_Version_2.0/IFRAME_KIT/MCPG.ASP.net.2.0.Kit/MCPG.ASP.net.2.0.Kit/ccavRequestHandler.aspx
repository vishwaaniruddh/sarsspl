﻿<%@ Page Language="C#" AutoEventWireup="true" Inherits="SubmitData" Codebehind="ccavRequestHandler.aspx.cs" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>  
      <script type="text/javascript">
          $(document).ready(function () {
              $('iframe#paymentFrame').load(function () {
                  window.addEventListener('message', function (e) {
                      $("#paymentFrame").css("height", e.data['newHeight'] + 'px');
                  }, false);
              });
          });
       </script> 
    <title>
    </title>
</head>
<body>
    <form id="customerData" runat="server">
        <center>
         <iframe width="482" height="500" scrolling="no" frameborder="0"  id="paymentFrame" src="<%=iframeSrc%>">
	        </iframe>
            </center> 
    </form>
</body>
</html>
