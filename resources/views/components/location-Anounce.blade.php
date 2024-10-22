<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" crossorigin=""></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css'
    rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>


<div id="Location_Selection" class="slide-in-blurred-top">
    <h1>Onde você está ?!</h1>
    <p>Podemos saber onde você está? Ficará mais fácil para recomendar seu produto para os usuários!</p>

    <div class="map_container" style="
        position:relative;
        display: flex;
        justify-content: center;
    ">

        <div id="map"></div>

        <div class="Seach_div" style="
            position:absolute;
            top:20px;
            justify-content: center;
            width:90%;

        ">
            <input type="text" id="search-input" autocomplete="off" placeholder="Procure por cidades ou endereços"
                style="
            border-radius: 100px;
            padding: 10px 30px;
            border:none;
            outline:none;
            box-shadow:0 0px 25px rgba(0,0,0,0.3);
            ">


            <div id="suggestions" style="

            z-index: 1000;
            width: 100%;
            border-radius: 10px;
            background: white;
            border-top: none;
            "></div>

        </div>
        @include('components.bottomLayoutAnounce')
    </div>
</div>

<style>

</style>

<script>



mapboxgl.accessToken = '{{env("MAP_BOX_TOKEN")}}';
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v12',
    center: [{{-46.0489936045044}}, -19.31092961060206],
    zoom: 14,
    pitch: 60,
    bearing: -17.6
});





var marker;
const addMarker = ({
    lng,
    lat
}) => {
    marker ? marker.setLngLat([lng, lat]) : marker = new mapboxgl.Marker().setLngLat([lng, lat]).addTo(map);
    [window.lat, window.long] = [lat, lng];
    $('#next_step').css('display', 'flex');
};


map.on('click', function(e) {
    addMarker(e.lngLat);
});


$('#search-input').on('input', function() {
    const query = $(this).val();
    const $suggestions = $('#suggestions');

    if (query.length > 2) {
        $.getJSON(
            `https://api.mapbox.com/geocoding/v5/mapbox.places/${query}.json?access_token=${mapboxgl.accessToken}`,
            function(data) {
                $suggestions.empty();
                data.features.forEach(({
                    place_name,
                    geometry: {
                        coordinates: [lng, lat]
                    }
                }) => {
                    const $item = $('<div>', {
                        text: place_name,
                        css: {
                            padding: '10px',
                            cursor: 'pointer'
                        },
                        click: function() {
                            map.setCenter([lng, lat]);
                            addMarker({
                                lng,
                                lat
                            });
                            $suggestions.empty();
                            $('#search-input').val(place_name);
                        }
                    });
                    $suggestions.append($item);
                });
            });
    } else {
        $suggestions.empty();
    }
});

$(document).ready(function(){
    map.resize()
})
</script>
