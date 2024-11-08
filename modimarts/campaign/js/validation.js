function _phonenumber(inputtxt) {
  var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
  if(inputtxt.match(phoneno)) {
    return 1;
  }  
  else {  
   // alert("message");
    return 0;
  }
}

function _pincode(inputtxt) {
  var pin = /([1-9]{1}[0-9]{5}|[1-9]{1}[0-9]{3})/;
  if(inputtxt.match(pin)) {
    return 1;
  }  
  else {  
    //alert("invalid");
    return 0;
  }
}

function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function validate(email,resultid) {
  const $result = $("#"+resultid);
 // const email = $("#email").val();
  $result.text("");

  if (validateEmail(email)) {
    $result.text(email + " is valid ");
    $result.css("color", "green");
  } else {
    $result.text(email + " is not valid ");
    $result.css("color", "red");
  }
  return false;
}

function ismob(inputid){  
    
            jQuery("#"+inputid).keypress(function (e) {
         var length = jQuery(this).val().length;
       if(length > 9) {
            return false;
       } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
       } else if((length == 0) && (e.which == 48)) {
            return false;
       }
      });
}

function isNumberKey(evt){  <!--Function to accept only numeric values-->
    //var e = evt || window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode != 46 && charCode > 31 
  && (charCode < 48 || charCode > 57))
        return false;
        return true;
  }
       
    function ValidateAlpha(evt)
    {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32 && keyCode != 188)
         
        return false;
            return true;

    }







function _blankspace(inputtxt) {
  var blank =/^$|\s+/;
  if(inputtxt.match(blank)) {
    return 1;
  }  
  else {  
    //alert("invalid");
    return 0;
  }
}

/*

function validateEmpty() {
  const bs = /^$|\s+/;
  return bs.test(email);
}

function validate(email) {
  const $result = $("#result");
 // const email = $("#email").val();
  $result.text("");

  if (validateEmail(email)) {
    $result.text(email + " is valid ");
    $result.css("color", "green");
  } else {
    $result.text(email + " is not valid ");
    $result.css("color", "red");
  }
  return false;
}

*/



