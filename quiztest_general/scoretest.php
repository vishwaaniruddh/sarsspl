<?php include("includeinallpages.php");?>
  
<style>

// Grab some stuff
@import url(https://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,100,200,800,900);
@import url(//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);

@mixin animation-delay($delay) {
  animation-delay:$delay;
  -webkit-animation-delay:$delay;
}

body {
  background:#2C3E50;
  text-align:center;
}

.Score {
  display:inline-block;
  font:500 100px/2 "Raleway", sans-serif;
  color:#fff;
  position:relative;
  width:270px;
  height:200px;
  white-space:nowrap;
  
  .fa-arrow-up {
    font-size:50%;
    color:#27AE60;
    position:relative;
    top:-5px;
  }
}

.Score-added {
  @include animation(scoreOverlayFromBottom 2s ease-in-out 1);
  position:absolute;
  white-space:nowrap;
  text-align:center;
  width:400px;
  left:-80px;
  line-height:200px;
  opacity:0;
  
  i {
    color:orange;
    font-size:90%;
  }
}

.Score-multiplier {
  @include animation(scoreOverlayFromBottomMultiplier 1s ease-in-out 1);
  @extend .Score-added;
  @include animation-delay(1s);
  width:400px;
  left:-200px;
  
  i {
    color:red;
  }
}


@include keyframes(scoreOverlayFromBottom) {
 
  0% {
    font-size:50px;
    line-height:200px;
    top:200px;
    opacity:0;
  }
  
  15% {
    opacity:1;
    font-size:130px;
    line-height:200px;
    top:100px;
    left:-80px;
  }
  
  20% {
    font-size:100px;    
  }
  
  40% {
    left:-80px;
  }

  60% {
    opacity:1;
    font-size:100px;
    line-height:200px;
    top:100px;    
    left:10px;
  }
  
  90% {
    opacity:1;
    font-size:100px;
    line-height:200px;
    top:100px;    
    left:10px;
  }
  
  100% {
    opacity:0;
    font-size:0px;
    line-height:200px;
    top:-50px;
    left:-80px;
  }
}

@include keyframes(scoreOverlayFromBottomMultiplier) {
 
  0% {
    font-size:50px;
    line-height:200px;
    top:200px;
    opacity:0;
  }
  
  30% {
    opacity:1;
    font-size:130px;
    line-height:200px;
    top:100px;
  }
  
  40% {
    font-size:100px;
  }
  
  60% {
    opacity:1;
    font-size:100px;
    line-height:200px;
    top:100px;    
    left:-200px;    
  }

  80% {
    opacity:1;
    font-size:100px;
    line-height:200px;
    top:100px;    
    left:-200px; 
  }
  
  100% {
    opacity:0;
    font-size:0px;
    line-height:200px;
    top:-50px;
    left:-50px;
  }
}

@include keyframes(scoreOverlay) {
 
  0% {
    font-size:50px;
    line-height:200px;
    top:0px;
    opacity:0;
  }
  
  20% {
    opacity:1;
    font-size:100px;
    line-height:200px;
    top:100px;
  }

  90% {
    opacity:1;
    font-size:100px;
    line-height:200px;
    top:100px;    
  }
  
  100% {
    opacity:0;
    font-size:0px;
    line-height:200px;
    top:-400px;
  }
}

.ResetScore {
  @include position(absolute, 50% 20px auto auto auto);
  display:block;
  border-radius:10px;
  cursor:pointer;
  width:250px;
  text-align:center;
  margin-top:-20px;
  font:700 14px/40px "Railway", sans-serif;
  text-transform:uppercase;
  color:#fff;
  border:2px solid lighten(#2C3E50, 10%);
  @include transition(background .2s);
  
  &:hover {
    background:lighten(#2C3E50, 10%);
  }
}
html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}
</style>
<script>
(function ($) {
	$.fn.countTo = function (options) {
		options = options || {};

		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);

			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;

			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};

			$self.data('countTo', data);

			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);

			// initialize the element with the starting value
			render(value);

			function updateTimer() {
				value += increment;
				loopCount++;

				render(value);

				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}

				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;

					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}

			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.text(formattedValue);
			}
		});
	};

	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};

function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}($));

setTimeout(function() {
  $('.timer').countTo(); 
}, 1200);

$(function() {
    $( ".ResetScore" ).click( function() {
      
      $(".timer").text('9321');
      setTimeout(function() {
        $('.timer').countTo(); 
      }, 1200);
      
      var el = $( ".Score" );
      el.before( el.clone(true) ).remove();
      
    });
});
</script>

<div class="Score">
  <i class="fa fa-arrow-up"></i><span class="timer" data-from="9321" data-to="10121" data-speed="1000" data-refresh-interval="30">9,321</span>
  
  <div class="Score-added">
    <i class="fa fa-plus"></i>200
  </div>
  
  <div class="Score-multiplier">
    <i class="fa fa-times"></i>4
  </div>
</div>

<a class="ResetScore">Start that stuff over</div>