<!DOCTYPE html>
<html>
	<head>
		<title>Map</title>
	</head>
	<body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<div id="map" style="width:100%; height:600px;"></div>

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHx_0IxRG0ZMtykjswkH_F9uiWMIrcVj8&callback=myMap"></script>
	    <script>
	        var user_lat = old_user_lat = <?php echo $first_arr_lat; ?>;
			var user_long = old_user_long = <?php echo $first_arr_lng; ?>;
	    </script>
	    <script>
            function fetchdata() {
		                $.ajax({
                            type : "GET",
                            url  : "<?php echo base_url(); ?>index.php/user/getTrackingMapById/<?php echo $tracking_id; ?>/updated",
                            dataType: 'json',
                            contentType: 'application/json',
                            processData: false,
                            success: function( data, textStatus, jQxhr ){
                                // console.log(data);
                                if(data.first_arr_lat != "") {
                                    user_lat = parseFloat(data.first_arr_lat);
		                            user_long =parseFloat(data.first_arr_lng) ;
		                          //  console.log("old_user_lat = " + old_user_lat);
		                          //  console.log("user_lat = " + user_lat);
		                           if(user_lat != old_user_lat) {
    		                            var map_parameters = { center: {lat:user_lat, lng: user_long}, zoom: 19 };
                            			var map = new google.maps.Map(document.getElementById('map'), map_parameters);
                            			var position1 = { position: {lat: user_lat, lng:user_long}, map: map };
                            			var marker1 = new google.maps.Marker(position1);
                            			 old_user_lat = user_lat;
                            			 old_user_long = user_long;
		                            }
                                }
                            },
                            error: function( jqXhr, textStatus, errorThrown ){
                                console.log( errorThrown );
                            }
                        });
            }
            setInterval(function() {fetchdata( )}, 4000);
    // console.log("user_lat"+user_lat)
    // console.log("user_long"+user_long)
		</script>
		<script>
// 			var user_lat = <?php echo $map_center_point_lat; ?>;
// 			var user_long = <?php echo $map_center_point_long; ?>;
			//var map_parameters = { center: {lat: 47.490, lng: -117.585}, zoom: 8 };
			var map_parameters = { center: {lat:user_lat, lng: user_long}, zoom: 19 };
			var map = new google.maps.Map(document.getElementById('map'), map_parameters);

			// var position1 = { position: {lat: 47.490, lng: -117.585}, map: map };
			var position1 = { position: {lat: user_lat, lng:user_long}, map: map };
			//var position2 = { position: {lat: 47.661, lng: -117.404}, map: map };

			var marker1 = new google.maps.Marker(position1);
		//	var marker2 = new google.maps.Marker(position2);
		</script>
	</body>
</html>
