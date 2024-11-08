

$('#send').click(function(event){ 
   var mob_no = $('#register_number').val();
   var mob_res = _phonenumber(mob_no);
   
   var pin = $('#register_ticket').val();
   var pin_code = _pincode(pin);
   
   var bs = $('#register_email').val();
 //  var blank_space = _blankspace(bs);
   
   if(mob_res==0){
       alert("Invalid Mobile Number");
       return false;
   }
   if(pin_code==0){
       alert("Invalid pin Number");
       return false;
   }
   if(bs==""){
       alert("Invalid Email");
       return false;
   }
   
   
   
   $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'register-form.php',
        data: $('form').serialize(),
        success: function (msg) {
            if(msg==1){
                $(".register_success_box").css("display","block");
            }
        }
    }); 

   
   });
$('#getintouch').click(function(event){ 
    var mob_no = $('#contact_phone').val();
   var mob_res = _phonenumber(mob_no);
   
   var pin = $('#contact_ticket').val();
   var pin_code = _pincode(pin);
   
   var bs = $('#contact_email').val();
   var blank_space = _blankspace(bs);
   
   if(mob_res==0){
       alert("Invalid Mobile Number");
       return false;
   }
   if(pin_code==0){
       alert("Invalid pin Number");
       return false;
   }
   if(bs==0){
       alert("Invalid Email");
       return false;
   }
   
   
   $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'contact-form.php',
        data: $('form').serialize(),
        success: function (msg) {
            if(msg==1){
                $(".contact_success_box").css("display","block");
            }
        }
    });
});

$('#location').click(function(event){ 

 var mob_no = $('#location_number').val();
   var mob_res = _phonenumber(mob_no);
   
   var pin = $('#location_ticket').val();
   var pin_code = _pincode(pin);
   
   var bs = $('#location_email').val();
   var blank_space = _blankspace(bs);
   
   if(mob_res==0){
       alert("Invalid Mobile Number");
       return false;
   }
   if(pin_code==0){
       alert("Invalid pin Number");
       return false;
   }
   if(bs==0){
       alert("Invalid Email");
       return false;
   }

   $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'location-form.php',
        data: $('form').serialize(),
        success: function (msg) {
            if(msg==1){
                $(".location_success_box").css("display","block");
            }
        }
    });
});