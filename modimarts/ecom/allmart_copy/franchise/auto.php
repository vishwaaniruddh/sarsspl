<html>
    
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" />

        
        <script>
        
         var mobile=[];
    function AutoLoad(){alert("hi")
         $.ajax({
           type:'POST',
          url:'get_Auto_Suggetion.php',
          data:"",
          success:function(msg){
             // alert(msg);
               var jsr=JSON.parse(msg);
                for(var i=0;i<jsr.length;i++){
                           mobile.push(jsr[i]['mobile']);
                }
                         
                   test();    
             
          }
      })
    }
        
         
       function test(){alert(mobile[0])
  $("#RefMobile").autocomplete({
    source:mobile,
    minLength: 1
  });
}
</script>
    </head>
    <body onload="AutoLoad()">
       <input type="text" id="RefMobile" name="RefMobile"  class="form-control"  placeholder="Enter Reff. Mobile ">
       <!-- <form method="POST">
            
  <input type="text" name="txtpname" id="txtpname" size="30" class="form-control" placeholder="Please Enter City or ZIP code">
</form>-->
    </body>
</html>