<script>
    function a(){
       $("#Login").show();
       $("#Guest").hide();
       
       $('#L_username').val('');
        $('#L_pass').val('');
         $('#G_email').val('');
          $('#G_mob').val('');
       
    }
    function b(){
       $("#Guest").show();
       $("#Login").hide();
       
        $('#L_username').val('');
        $('#L_pass').val('');
         $('#G_email').val('');
          $('#G_mob').val('');
    }
    
    
   
    
</script>


<script>
    
 $(document).on("change","input[type=radio]",function(){
    var ac1=$('[name="chk_guest"]:checked').val();
   
    if(ac1=="OTP"){
       $('#EnterPass').val('');
        $('#EnterOTP').val('');
         $("#HD_Enter_opt").show();
         $("#HD_Enter_pass").hide();
       
    }
    else if(ac1=="Password"){
      $('#EnterPass').val('');
        $('#EnterOTP').val('');
        
         $("#HD_Enter_opt").hide();
         $("#HD_Enter_pass").show();
    }
});
    
    
</script>


<script>
 function LoginFunction(login){
//================= validation ===========================  
    if(login=="login"){
       var L_username=$("#L_username").val();
       var L_pass=$("#L_pass").val();   
        
        if(L_username==""){
            swal("Please enter Email-ID / Mobile Number")
        }
        else if(L_pass==""){
            swal("Please enter Password")
        }
    }
    
    if(login=="guest"){
    
     var G_email=$("#G_email").val();
       var G_mob=$("#G_mob").val();   
        
        
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        
        if(G_email==""){
            swal("Please enter Email-ID")
        }
        else if(G_mob==""){
            swal("Please enter Mobile Number")
        }
        else if(reg.test(G_email) == false) 
        {
            swal("Please enter valid Email-ID");
             G_email=  $("#G_email").val("");
        }
        else if (G_mob.length < 10)
        {
            G_email=  $("#G_mob").val("");
            swal("Please enter valid Mobile Number");
        }
        
        
        
    }
 //=================================================   
       var L_username=$("#L_username").val();
       var L_pass=$("#L_pass").val();   
       var G_email=$("#G_email").val();
       var G_mob=$("#G_mob").val();  
     
       if(L_username!="" && L_pass!="" || G_email!="" && G_mob!="" )
       {
       $.ajax({
        url: 'LoginProcess_Step1_pmntProc.php',
        type: 'post',
        data:'L_username='+L_username+'&L_pass='+L_pass+'&G_email='+G_email+'&G_mob='+G_mob,
        success: function(msg) {
          // alert(msg);
            if(msg==0){
                swal("Invalid Email-id or Password !");
            }
            else if(msg==1){
                 swal("Login Successfully!");
                  window.open(window.location.href,"_SELF");
             
            }
            else if(msg==2){
                swal("email-id exists!");
            }
            else if(msg==3){
                swal("Mobile Number exists!")
            }
            else{
                
                var arr=msg.split("@#");
   
                   document.getElementById("randomNo").value=arr[0];
                   document.getElementById("emailsend").value=arr[1];
                   document.getElementById("mobisend").value=arr[2];
                            
                
                popup(8);
                
            }
          }
       });
           
       }
    
 } 
 
 function registerfunction(){
     
    var EnterPass= $("#EnterPass").val(); 
    var randomNo= $("#randomNo").val(); 
    var EnterOTP= $("#EnterOTP").val(); 
    var ck=  $("input[name='chk_guest']:checked").val();
    
    if(ck=="OTP"){
        if(EnterOTP == randomNo){
            insertdata();
        }
    }
    if(ck=="Password"){
        if(EnterPass == randomNo){
            insertdata();
        }
    }
 }
 
 
 function insertdata(){
     var randomNo= $("#randomNo").val(); 
    var emailsend= $("#emailsend").val(); 
    var mobisend= $("#mobisend").val(); 
    
    $.ajax({
        url: 'LoginProcessReg_Step1_pmntProc.php',
        type: 'post',
        data:'randomNo='+randomNo+'&emailsend='+emailsend+'&mobisend='+mobisend,
        success: function(msg) {
          // alert(msg);
            if(msg==0){
                swal("Error !")
            }
            else if(msg==1){
                 swal("Registered Successfully!");
               //  document.getElementById('id01').style.display='none';
               window.open("paymentProcess.php","_SELF");
               
               //  $("#HD_address").show();
            }
                
            }
          
       });
    
 }
 
 
    
</script>




