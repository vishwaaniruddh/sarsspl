
    //$(document).ready(function(){
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        function modelnos() {
            $("#City").removeAttr("disabled");
            sumitfunc();
            if($('#zones').css('display')!='none'){ 
               $('#zones').hide();
            }
            var state=document.getElementById("State").value;
            $.ajax({
                    type:'POST',
                    url:'city1.php',
                     data:'state='+state,
                     datatype:'json',
                    success:function(msg){
                       var jsr=JSON.parse(msg);
                        var newoption=' <option value="">Select</option>' ;
                        var citydata='';
                        $('#City').empty();
                        for(var i=0;i<jsr.length;i++)
                        {
		                   newoption+= '<option id="'+ jsr[i]["ids"]+'" value="'+ jsr[i]["ids"]+'">'+jsr[i]["modelno"]+'</option> ';
                        }
                        if(jsr['citydata']){
                        for(var i=0;i<jsr['citydata'].length;i++)
                        {
                           citydata+= '<tr><td>'+jsr['citydata'][i]["city"]+'</td><td>'+jsr['citydata'][i]["district"]+'</td></tr>';
                        }
                        }
                          $("#cities").show();
 	                      $('#citidetails').append(citydata);  
                     	$('#City').append(newoption);
                    }
                })
            }
    
        function cities() {
            $("#District").removeAttr("disabled");
            sumitfunc();
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
               $('#cities').hide(); 
               $('#zones').hide();
            } 
            $("#cities").show();
            //$('#zones').hide();
            var city=document.getElementById("City").value;
            var State=document.getElementById("State").value;
            $.ajax({
                type:'POST',
                url:'district.php',
                data:'city='+city,
                datatype:'json',
                success:function(msg){
                   var jsr=JSON.parse(msg);
                    var newoption=' <option value="">Select</option>' ;
                    $('#District').empty();
                    for(var i=0;i<jsr.length;i++)
                    {
	                   newoption+= '<option id="'+jsr[i]["ids"]+'" value="'+jsr[i]["ids"]+'">'+jsr[i]["modelno"]+'</option> ';
                    }                       
                 	$('#District').append(newoption);
                }
            })
        }

        function taluka() {
            $("#talukaa").removeAttr("disabled");
            sumitfunc();
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
               $('#cities').hide(); 
               $('#zones').hide();
            }
              var Taluka=document.getElementById("District").value;
                $.ajax({
                    type:'POST',
                    url:'taluka.php',
                     data:'Taluka='+Taluka,
                     datatype:'json',
                    success:function(msg){
                       var jsr=JSON.parse(msg);
                        var newoption=' <option value="">Select</option>' ;
                        $('#talukaa').empty();
                        for(var i=0;i<jsr.length;i++)
                        {
                           newoption+= '<option id="'+ jsr[i]["ids"]+'" value="'+jsr[i]["ids"]+'">'+jsr[i]["modelno"]+'</option> ';
		                }                       
                     	$('#talukaa').append(newoption);
                    }
                })
            }
        function state() {
            $("#State").removeAttr("disabled");
            sumitfunc();
            var state=document.getElementById("State").value;
            var zone=document.getElementById("Zone").value;
                $.ajax({
                    type:'POST',
                    url:'state1.php',
                    data:'zone='+zone,
                    datatype:'json',
                    success:function(msg){
                       var jsr=JSON.parse(msg);
                        var newoption=' <option value="">Select</option>' ;
                        //var citydata='';
                        $('#State').empty();
                        for(var i=0;i<jsr[0].length;i++)
                        {
                           newoption+= '<option id="'+ jsr[0][i]["ids"]+'" value="'+ jsr[0][i]["ids"]+ '" >'+jsr[0][i]["modelno"]+'</option> ';
                           
		                }
                     	$('#State').append(newoption);
                     	 $("#zones").hide();
                    }
                })
            }

        /*function hide_feilds(feild){
            var f=['country','Zone','State','City','District','talukaa','Ward'];
            for(var i=0;i<f.length;i++){
                var f1="'#"+f[i]+"'";
                //alert(f1);
                if(feild!=f[i]){
                    $(f1).val('');
                }
            }
        }*/
        
        /*function get_selected_list(list){
            $.ajax({
                    type:'POST',
                    url:'search.php',
                    data:'list='+list,
                    datatype:'json',
                    success:function(msg){
                       var jsr=JSON.parse(msg);
                       //$('#hdState').val(jsr[0].state);
                       $('#country').val(jsr[0].country);
                       $('#Zone').val(jsr[0].zone);
                       state();
                        }
                    })
            
        }*/
        function sumitfunc(){
            var State= document.getElementById("State").value; 
            var City= document.getElementById("City").value;
            var District= document.getElementById("District").value;
            var talukaa= document.getElementById("talukaa").value;
            var Zone= document.getElementById("Zone").value;
            var country= document.getElementById("country").value;
            $.ajax({
               type: 'POST',    
               url:'member1_process.php',
                data:'State='+State+'&City='+City+'&District='+District+'&talukaa='+talukaa+'&Zone='+Zone+'&country='+country,
               success: function(msg){
                   //alert(msg);
                 document.getElementById('show').innerHTML=msg;
                } })
            }
            booldata=false;
        function checkmail(){
            var mail=document.getElementById('Gmail').value;
            $.ajax({
                    
                type:'POST',
                url:'check_mailip.php',
                
                 data:'mail='+mail, 
                 success:function(msg){
                    //alert(msg);
                    if(msg==1){
                        alert("Email Id already exist");
                         booldata= false;
                    }else{
                        //document.getElementById("myForm").submit();
                        booldata= true;
                    }
                 }
            })
            return booldata;
        }
  
        function finalval(){
            if( validation() && checkmail())
            {
                document.getElementById("myForm").submit();
                return true; 
            }
            else
            {
                return false; 
            }
        }

        function myFunction() {
          var input, filter, table, tr, td,td1, td2, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("zonedetail");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        }
        
        function searchCity() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("cityInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("citidetails");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
        }

        function zone() {
            $("#State").removeAttr("disabled");
            sumitfunc();
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
                 $('#cities').hide(); 
                   $('#zones').hide();
                }
                  var country=document.getElementById("country").value;
                    $.ajax({
                            type:'POST',
                            url:'zone.php',
                             data:'country='+country,
                             datatype:'json',
                            success:function(msg){
                               var jsr=JSON.parse(msg);
                                var newoption=' <option value="">Select</option>' ;
                                var zonedata='';
                                $('#Zone').empty();
                                for(var i=0;i<jsr[0].length;i++)
                                {
                                   newoption+= '<option id="'+ jsr[0][i]["ids"]+'" value="'+ jsr[0][i]["ids"]+ '" >'+jsr[0][i]["modelno"]+'</option> ';
        		                }  
        		                for(var i=0;i<jsr[1].length;i++)
                                {
                                   zonedata+= '<tr><td>'+jsr[1][i]["zone"]+'</td><td>'+jsr[1][i]["state"]+'</td></tr>';
        		                } 
                             	$('#Zone').append(newoption);
                                  $("#zones").show();
                             	$('#zonedetail').append(zonedata);
                            }
                        })
                    }

    //$(document).ready(function(){
    //State 
    var state ='';
   $("#State").prop("disabled", "disabled");
   $("#Zone").prop("disabled", "disabled");
   $("#City").prop("disabled", "disabled");
   $("#District").prop("disabled", "disabled");
   $("#talukaa").prop("disabled", "disabled");
   
   $( "#txtCountry").blur(function() {
        //clear feilds if selecetd
        //$('#txtCountry').val();
        $('#txtZone').val(null);
        $('#txtState').val(null);
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        $('#txtTaluka').val(null);
        $('#txtWard').val(null);
        //$('#country').val(null);
        $('#Zone').val(null);
        $('#State').val(null);
        $('#City').val(null);
        $('#District').val(null);
        $('#talukaa').val(null);
        $('#Ward').val(null);
        
        country1 = $(this).val();
       //$("#State").removeAttr("disabled");
       $("#Zone").removeAttr("disabled");
       //$("#City").removeAttr("disabled");
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'country='+country1,
                datatype:'json',
                success:function(msg){
                   var jsr=JSON.parse(msg);
                   //alert(jsr[0].country);
                   $('#hdCountry').val(jsr[0].country);
                   //$('#State').val(jsr[0].state);
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                   zone();
                    }
                })
    });
    
    $( "#txtState").blur(function() {
        //clear feilds if selecetd
        $('#txtCountry').val(null);
        $('#txtZone').val(null);
        //$('#txtState').val();
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        $('#txtTaluka').val(null);
        $('#txtWard').val(null);
        $('#country').val(null);
        $('#Zone').val(null);
        //$('#State').val(null);
        $('#City').val(null);
        $('#District').val(null);
        $('#talukaa').val(null);
        $('#Ward').val(null);
        
        state = $(this).val();
       $("#State").removeAttr("disabled");
       $("#Zone").removeAttr("disabled");
       $("#City").removeAttr("disabled");
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'state='+state,
                datatype:'json',
                success:function(msg){
                   var jsr=JSON.parse(msg);
                   $('#hdState').val(jsr[0].state);
                   $('#State').val(jsr[0].state);
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                  // modelnos();
                    },
                    complete: function () {
                      modelnos(); 
                     }
                })
    });
    
    //Zone 
    var zone ='';
    $( "#txtZone").blur(function() {
        //clear feilds if selecetd
        $('#txtCountry').val(null);
        //$('#txtZone').val();
        $('#txtState').val(null);
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        $('#txtTaluka').val(null);
        $('#txtWard').val(null);
        $('#country').val(null);
        //$('#Zone').val(null);
        $('#State').val(null);
        $('#City').val(null);
        $('#District').val(null);
        $('#talukaa').val(null);
        $('#Ward').val(null);
        
        zone = $(this).val();
        $("#State").removeAttr("disabled");
       $("#Zone").removeAttr("disabled");
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'zone='+zone,
                datatype:'json',
                success:function(msg){
                   var jsr=JSON.parse(msg);
                   //$('#hdState').val(jsr[0].state);
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                   state();
                    }
                })
        });
    
    //City 
    var city ='';
    $( "#txtCity").blur(function() {
        //clear feilds if selecetd
        $('#txtCountry').val(null);
        $('#txtZone').val(null);
        $('#txtState').val(null);
        //$('#txtCity').val();
        $('#txtDistrict').val(null);
        $('#txtTaluka').val(null);
        $('#txtWard').val(null);
        $('#country').val(null);
        $('#Zone').val(null);
        $('#State').val(null);
        //$('#City').val(null);
        $('#District').val(null);
        $('#talukaa').val(null);
        $('#Ward').val(null);
        city = $(this).val();
        $("#State").removeAttr("disabled");
       $("#Zone").removeAttr("disabled");
       
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'city='+city,
                datatype:'json',
                success:function(msg){
                   var jsr=JSON.parse(msg);
                   //alert(jsr[0].city);
                   $('#City').val(jsr[0].city);
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                   $('#State').val(jsr[0].state);
                   cities();
                    }
                })
    });
    //District
    var district ='';
    $( "#txtDistrict").blur(function() {
        //clear feilds if selecetd
        $('#txtCountry').val();
        $('#txtZone').val();
        $('#txtState').val();
        $('#txtCity').val();
        //$('#txtDistrict').val();
        $('#txtTaluka').val();
        $('#txtWard').val(null);
        $('#country').val(null);
        $('#Zone').val(null);
        $('#State').val(null);
        $('#City').val(null);
       // $('#District').val(null);
        $('#talukaa').val(null);
        $('#Ward').val(null);
        
        district = $(this).val();
        $("#State").removeAttr("disabled");
       $("#Zone").removeAttr("disabled");
       $("#City").removeAttr("disabled");
       $("#country").removeAttr("disabled");
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'district='+district,
                datatype:'json',
                success:function(msg){
                   var jsr=JSON.parse(msg);
                   //$('#hdState').val(jsr[0].state);
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                   $('#State').val(jsr[0].state);
                   $('#City').val(jsr[0].city);
                   $('#District').val(jsr[0].district);
                   taluka();
                    }
                })
    });
    
    //Taluka
    var taluka ='';
    $( "#txtTaluka").blur(function() {
        //clear feilds if selecetd
        $('#txtCountry').val(null);
        $('#txtZone').val(null);
        $('#txtState').val(null);
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        //$('#txtTaluka').val();
        $('#txtWard').val(null);
        $('#country').val(null);
        $('#Zone').val(null);
        $('#State').val(null);
        $('#City').val(null);
        $('#District').val(null);
       // $('#talukaa').val(null);
        $('#Ward').val(null);
        taluka = $(this).val();
        $("#State").removeAttr("disabled");
       $("#Zone").removeAttr("disabled");
       $("#City").removeAttr("disabled");
       $("#District").removeAttr("disabled");
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'taluka='+taluka,
                datatype:'json',
                success:function(msg){
                   var jsr=JSON.parse(msg);
                   //$('#hdState').val(jsr[0].state);
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                   $('#State').val(jsr[0].country);
                   $('#City').val(jsr[0].zone);
                   $('#District').val(jsr[0].district);
                    }
                })
    });
    
    $('#country').change(function(){
        $("#Zone").removeAttr("disabled");
        //clear feilds if selecetd
        
        $('#txtState').val(null);
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        $('#txtTaluka').val(null);
        $('#txtWard').val(null);
        //$('#country').val(null);
        $('#Zone').val(null);
        $('#State').val(null);
        $('#City').val(null);
        $('#District').val(null);
        $('#talukaa').val(null);
        $('#Ward').val(null);
        sumitfunc();
    });
    /* Country auto suggestion */
        var cn = <?php echo json_encode($cn); ?>
    // Constructing the suggestion engine
    var cn = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: cn
    });
    // Initializing the typeahead
    $('#txtCountry').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result */
    },
    {
        name: 'cn',
        source: cn,
    });
    
     /* Zone auto suggestion */
    // Defining the local dataset
        var z = <?php echo json_encode($z); ?>
    // Constructing the suggestion engine
    var z = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: z
    });
    // Initializing the typeahead
    $('#txtZone').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result*/
    },
    {
        name: 'z',
        source: z,
    });
    
     /* State auto suggestion */
    // Defining the local dataset
        var s = <?php echo json_encode($s); ?>
    // Constructing the suggestion engine
    var s = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: s
    });
    // Initializing the typeahead
    $('#txtState').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result */
    },
    {
        name: 's',
        source: s,
    });
    
     /* City auto suggestion */
    // Defining the local dataset
        var ct = <?php echo json_encode($ct); ?>
    // Constructing the suggestion engine
    var ct = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: ct
    });
    // Initializing the typeahead
    $('#txtCity').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result */
    },
    {
        name: 'ct',
        source: ct,
    });
    
     /* District auto suggestion */
    // Defining the local dataset
        var d = <?php echo json_encode($d); ?>
    // Constructing the suggestion engine
    var d = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: d
    });
    // Initializing the typeahead
    $('#txtDistrict').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result */
    },
    {
        name: 'd',
        source: d,
    });
    
     /* taluka auto suggestion */
    // Defining the local dataset
        var t = <?php echo json_encode($t); ?>
    // Constructing the suggestion engine
    var t = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: t
    });
    // Initializing the typeahead
    $('#txtTaluka').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result */
    },
    {
        name: 't',
        source: t,
    });
//});  
