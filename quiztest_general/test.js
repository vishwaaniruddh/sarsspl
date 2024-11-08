setTimeout(function() {
    // $('div').fireworks();

  
    $('#on_all').click(function() { $('.fr').fireworks(); });
    $('#on_lose').click(function() { $('body').fireworks('destroy'); });
   
});
