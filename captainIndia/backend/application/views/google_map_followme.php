
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHx_0IxRG0ZMtykjswkH_F9uiWMIrcVj8&callback=myMap"></script>
<script type="text/javascript">
    // var markers = [
    //         {
    //             "title": '',
    //             // "lat": '18.641400',
    //             // "lng": '72.872200',
    //             "lat": '<?php echo $first_arr_lat; ?>',
    //             "lng": '<?php echo $first_arr_lng; ?>',
    //             "description": '',
    //             "icon": 'https://captainindia.anekalabs.com/backend/images/start.png'
    //         },
    //         {
    //             "title": '',
    //             // "lat": '18.964700',
    //             // "lng": '72.825800',
    //             "lat": '<?php echo $last_arr_lat; ?>',
    //             "lng": '<?php echo $last_arr_lng; ?>',
    //             "description": '',
    //             "icon": 'https://captainindia.anekalabs.com/backend/images/stop.png'
    //         }
    //     // ,
    //     //     {
    //     //         "title": 'Pune',
    //     //         "lat": '18.523600',
    //     //         "lng": '73.847800',
    //     //         "description": 'Pune is the seventh largest metropolis in India, the second largest in the state of Maharashtra after Mumbai.'
    //     //     }
    // ];
      var markers =<?php print_r($map_arr); ?>;
    window.onload = function () {
        var mapOptions = {
            center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
            zoom:2,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
        var infoWindow = new google.maps.InfoWindow();
        var lat_lng = new Array();
        var latlngbounds = new google.maps.LatLngBounds();
        for (i = 0; i < markers.length; i++) {
            var data = markers[i]
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            lat_lng.push(myLatlng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title,
                 icon: data.icon
            });
            latlngbounds.extend(marker.position);
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    infoWindow.setContent(data.description);
                    infoWindow.open(map, marker);
                });
            })(marker, data);
        }
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);
 
        //***********ROUTING****************//
 
        //Initialize the Path Array
        var path = new google.maps.MVCArray();
 
        //Initialize the Direction Service
        var service = new google.maps.DirectionsService();
 
        //Set the Path Stroke Color
        var poly = new google.maps.Polyline({ map: map, strokeColor: '#4986E7' });
 
        //Loop and Draw Path Route between the Points on MAP
        for (var i = 0; i < lat_lng.length; i++) {
            if ((i + 1) < lat_lng.length) {
                var src = lat_lng[i];
                var des = lat_lng[i + 1];
                path.push(src);
                poly.setPath(path);
                service.route({
                    origin: src,
                    destination: des,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                }, function (result, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
                            path.push(result.routes[0].overview_path[i]);
                        }
                    }
                });
            }
        }
    }
</script>
<div id="dvMap" style="width: 100%; height: 100%;">
</div>
