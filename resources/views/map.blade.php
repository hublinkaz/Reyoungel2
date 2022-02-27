<!DOCTYPE html>
<html>
<body>

<h1>My First Google Map</h1>

<div id="googleMap" style="width:100%;height:400px;"></div>
<br>
<br>
<br>
<br>
<a herf="https://www.google.com/maps/place/49.46800006494457,17.11514008755796">Yol Tarifi Al</a>

<script>
    function myMap() {
        var mapProp= {
            center:new google.maps.LatLng(40.37582126825932, 49.854471290941056),
            zoom:15,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        var marker = new google.maps.Marker({
           map: map,
            position: new google.maps.LatLng(40.37582126825932, 49.854471290941056)
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMDUMEGUsJ2KWO_S-CKvqYpdG_2DaOBb8&callback=myMap"></script>

</body>
</html>
