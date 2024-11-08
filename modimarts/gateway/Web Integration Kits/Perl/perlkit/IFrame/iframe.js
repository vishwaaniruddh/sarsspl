$(document).ready(function(){
	window.addEventListener('message', function(e) {
		$("#paymentFrame").css("height",e.data['newHeight']+'px'); 	 
	}, false);
 	
});
