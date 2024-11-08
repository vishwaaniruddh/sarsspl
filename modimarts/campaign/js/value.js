 
    $(document).ready(function(){
        
    
    setTimeout(function(){ 
        
        
    var value1;
    var theTotal1 = 0;
    $(".total_pos").each(function () {
    value1 = $(this).html();
    
    if(value1){
        console.log(value1);
    theTotal1 += parseInt(value1);
    $(".total").text(theTotal1);        
    }

});


    var value2;
    var theTotal2 = 0;
    $(".given_pos").each(function () {
    value2 = $(this).html();
    if(value2){
    theTotal2 += parseInt(value2);
    $(".given").text(theTotal2);        
    }

});


    var value4;
    var theTotal4 = 0;
    $(".available_pos").each(function () {
    value4 = $(this).html();
    if(value4){
    theTotal4 += parseInt(value4);
    $(".available").text(theTotal4);        
    }

});


   var value5;
    var theTotal5 = 0;
    $(".qualify").each(function () {
    value5 = $(this).html();
    if(value5){
    theTotal5 += parseInt(value5);
    $(".total_qualify").text(theTotal5);        
    }

});


        
    }, 1000);
    });