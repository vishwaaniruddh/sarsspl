<html>
	<head>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	</head>
	<body>
	    <?php 
	      $code = $_GET['code'];
	      if($code==1){ ?>
	         <script>
	            swal({
					title: "Additional Promotional Voucher Code Issue!",
					text: "So Sorry, Member Not Created Due to Additional Promotional Voucher Code not yet created in master!",
					icon: "warning",
					// buttons: true,
					dangerMode: true,
				}).then((willDelete) => {
					if(willDelete) {
						window.open("prospect_view.php", "_self");
					}
				});
	         </script>
	          
	  <?php    }
	       if($code==2){ ?>
	         <script>
	            swal({
					title: "Additional Renewal Voucher Code Issue!",
					text: "So Sorry, Member Not Created Due to Additional Renewal Voucher Code not yet created in master!",
					icon: "warning",
					// buttons: true,
					dangerMode: true,
				}).then((willDelete) => {
					if(willDelete) {
						window.open("prospect_view.php", "_self");
					}
				});
	         </script>
	          
	  <?php    }
	    
	    ?>
	    
	
				
	</body>

	</html>