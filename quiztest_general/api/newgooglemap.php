<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcifKsH5iq7sUOd_1kldvA8cZVqQtbl6M"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH6TKTe4pHbs_-Gk-2lyQ1R7nTtcV0rOE&callback=initMap">
</script>
</head> 
<body>
<div id="Map" style="width: 921px; height: 329px;">
</div>

<script type="text/javascript">
    var contentstring = [];
    var regionlocation = [];
    var markers = [];
    var iterator = 0;
    var areaiterator = 0;
    var map;
    var infowindow = [];
    geocoder = new google.maps.Geocoder();
    
    $(document).ready(function () {
        setTimeout(function() { initialize(); }, 400);
    });
    
    function initialize() {           
        infowindow = [];
        markers = [];
        GetValues();
        iterator = 0;
        areaiterator = 0;
        region = new google.maps.LatLng(regionlocation[areaiterator].split(',')[0], regionlocation[areaiterator].split(',')[1]);
        map = new google.maps.Map(document.getElementById("Map"), { 
            zoom: 4,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: region,
        });
        drop();
    }
    
    function GetValues() {
        //Get the Latitude and Longitude of a Point site : http://itouchmap.com/latlong.html
        contentstring[0] = "Ahmedabad, Gujarat, India";
        regionlocation[0] = '23.022505, 72.571362';
                    
        contentstring[1] = "Gandhinagar, Gujarat, India";
        regionlocation[1] = "23.224820, 72.646377";
        
        contentstring[2] = "Andheri East, Mumbai, india";
        regionlocation[2] = "19.115491, 72.872695";
        
        contentstring[3] = "Pune, india";
        regionlocation[3] = "18.520430, 73.856744";
        
        contentstring[4] = "Chennai, india";
        regionlocation[4] = "13.082680, 80.270718";
        
        contentstring[5] = "Visakhapatnam, Andhra Pradesh, india";
        regionlocation[5] = "17.686816, 83.218482";
        
    }
           
    function drop() {
        for (var i = 0; i < contentstring.length; i++) {
            setTimeout(function() {
                addMarker();
            }, 800);
        }
    }

    function addMarker() {
        var address = contentstring[areaiterator];
        var icons = 'https://maps.google.com/mapfiles/ms/icons/red-dot.png';
        var templat = regionlocation[areaiterator].split(',')[0];
        var templong = regionlocation[areaiterator].split(',')[1];
        var temp_latLng = new google.maps.LatLng(templat, templong);
        markers.push(new google.maps.Marker(
        {
            position: temp_latLng,
            map: map,
            icon: icons,
            draggable: false
        }));            
        iterator++;
        info(iterator);
        areaiterator++;
    }

    function info(i) {
        infowindow[i] = new google.maps.InfoWindow({
            content: contentstring[i - 1]
        });
        infowindow[i].content = contentstring[i - 1];
        google.maps.event.addListener(markers[i - 1], 'click', function() {
            for (var j = 1; j < contentstring.length + 1; j++) {
                infowindow[j].close();
            }
            infowindow[i].open(map, markers[i - 1]);
        });
    }
</script>
</body>
</html>