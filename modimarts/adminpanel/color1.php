<?php
include 'colorcss1.php';
?>
<html>
<body>
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
<div class="container">
	<h1 class="text-center">Checkbox/Radio - CSS Only</h1>
</div>

<div class="container">

	<div class="well well-sm text-center">

		<h3>Checkbox</h3>
		
		<div class="btn-group" data-toggle="buttons">
			
			<label class="btn btn-success active">
				<input type="checkbox" autocomplete="off" checked>
				<span class="glyphicon glyphicon-ok"></span>
			</label>

			<label class="btn btn-primary">
				<input type="checkbox" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>			
		
			<label class="btn btn-info">
				<input type="checkbox" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>			
		
			<label class="btn btn-default">
				<input type="checkbox" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>			

			<label class="btn btn-warning">
				<input type="checkbox" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>			
		
			<label class="btn btn-danger">
				<input type="checkbox" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>			
		
		</div>

	</div>

</div>


<div class="container">			

	<div class="well well-sm text-center">

		<h3>Radio</h3>
		
		<div class="btn-group" data-toggle="buttons">
			
			<label class="btn btn-success active">
				<input type="radio" name="options" id="option2" autocomplete="off" chacked>
				<span class="glyphicon glyphicon-ok"></span>
			</label>

			<label class="btn btn-primary">
				<input type="radio" name="options" id="option1" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>

			<label class="btn btn-info">
				<input type="radio" name="options" id="option2" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>

			<label class="btn btn-default">
				<input type="radio" name="options" id="option2" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>

			<label class="btn btn-warning">
				<input type="radio" name="options" id="option2" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>

			<label class="btn btn-danger">
				<input type="radio" name="options" id="option2" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>
		
		</div>


	</div>

</div>
</body>
</html>