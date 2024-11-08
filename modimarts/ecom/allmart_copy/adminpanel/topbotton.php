<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function(){ 
	$(window).scroll(function(){ 
		if ($(this).scrollTop() > 100) { 
			$('#scroll').fadeIn(); 
		} else { 
			$('#scroll').fadeOut(); 
		} 
	}); 
	$('#scroll').click(function(){ 
		$("html, body").animate({ scrollTop: 0 }, 600); 
		return false; 
	}); 
});
</script>
<style>
#scroll {
position:fixed;
right:10px;
bottom:10px;
cursor:pointer;
width:40px;
height:40px;
background-color:#00a0e4;
text-indent:-9999px;
display:none;
-webkit-border-radius:60px;
-moz-border-radius:60px;
border-radius:60px
z-index:20;
}
#scroll span {
position:absolute;
top:50%;
left:50%;
margin-left:-8px;
margin-top:-12px;
height:0;
width:0;
border:8px solid transparent;
border-bottom-color:#ffffff
}
#scroll:hover {
background-color:#034ea2;
opacity:1;filter:"alpha(opacity=100)";
-ms-filter:"alpha(opacity=100)";}

</style>
<body>
<!-- BackToTop Button -->
<a href="#" id="scroll"  style="display: none; ">Top<span></span></a>
