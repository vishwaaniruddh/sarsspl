<html>
	<head>
		<script language=javascript>
			var presentationLengthInMinute=1;
			var secondToGo=20;
			var timer,theTime,isPaused=false;
			
			function startTimer()
			{
				if (!isPaused)
				
				timer=setInterval("counter()",1000);
			}
			function resumeTimer()
			{
				isPaused=true;
				startTimer();
			}
			function pauseTimer()
			{
				isPaused=true;
				stopTimer();
			}
			function counter()
			{
				if (secondToGo>0)
				{
					secondToGo--;
					s=secondToGo % 60;
					m=(secondToGo-s) /60;
					theTime.innerHTML=m+":"+s;
				}
				else
				{	
				    alert("finished");
					stopTimer();
					isPaused=false;
				}
			}
			function stopTimer()
			{
				clearInterval(timer);
			}
			function init()
			{
				theTime=document.getElementById("theTime");
			}
		</script>
	</head>
	<body onload="init()">
		<div id="theTime"></div>
		<input type=button onclick="startTimer()" value="restart">
		<input type=button onclick="pauseTimer()" value="pause">
		<input type=button onclick="resumeTimer()" value="resume">
	</body>
</html>