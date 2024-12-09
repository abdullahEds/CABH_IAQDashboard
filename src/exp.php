<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapbox Overlay</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
            position: relative;
        }

        .indoorx, .outdoorx {
            position: absolute;
            width: 18px;
            height: 18px;
            padding: 5px;
            border-radius: 3px;
            display: inline-block;
            z-index: 10;
        }

        .indoorx {
            top: 10px;
            left: 10px;
            background-color: #f00; /* Red */
        }

        .outdoorx {
            top: 10px;
            left: 60px;
            background-color: #0f0; /* Green */
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <span class="indoorx"></span> Indoor
    <span class="outdoorx"></span> Outdoor

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.css' rel='stylesheet' />
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2LW5pa3VuaiIsImEiOiJjbHMwYTNmdnowMDFxMmpyNTBteHoybTRwIn0.OEzenC6wBOTbqZXCUNoE7A';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-74.5, 40], // Set the center of the map
            zoom: 9
        });
    </script>
</body>
</html>
