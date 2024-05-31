@extends('layouts.app')
@section('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-search@2.9.0/dist/leaflet-search.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />

<style>
  #mapid { min-height: 500px; }
</style>

@endsection

@section('content')
<div class="container">
    <div class="form-group">
        <input type="text" name="" id="textsearch" placeholder="Cari Rumah Sakit..." class="form-control">
    </div>
    <div id="mapid">
        <div class="card">
            <div class="card-body">
                <!-- Create a div for the map -->
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin="">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- Include Leaflet Search JS -->
<script src="https://unpkg.com/leaflet-search@2.9.0/dist/leaflet-search.min.js"></script>

<!-- Include Leaflet Draw JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
 // Initialize the map with coordinates for Pontianak
 var map = L.map('mapid').setView([0.0022, 109.3417], 13); // Adjust the zoom level as needed

 // Add a tile layer (you can use any tile provider)
 L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
     attribution: "&copy; <a href='https://www.openstreetmap.org/copyright'>OpenStreetMap</a> contributors"
 }).addTo(map);

 axios.get("{{ route('api.places.index') }}")
 .then(function (response) {
     L.geoJSON(response.data,{
         pointToLayer: function(geoJsonPoint,latlng) {
             return L.marker(latlng);
         }
     })
     .bindPopup(function(layer) {
         return ('<div class="my-2"><strong>Place Name</strong> :<br>'+layer.feature.properties.place_name+'</div> <div class="my-2"><strong>Jam Operasional</strong>:<br>'+layer.feature.properties.operasional+'</div><div class="my-2"><strong>Address</strong>:<br>'+layer.feature.properties.address+'</div>');
     }).addTo(map);
 })
 .catch(function (error) {
     console.log(error);
 });

 var data = [
     @foreach ($places as $place)
         {"id": "{{ $place->id }}", "loc":[{{ $place->latitude }}, {{ $place->longitude }}], "title": "{{ $place->place_name }}", "operasional": "{{ $place->operasional }}"},
     @endforeach
 ];

 var markersLayer = new L.LayerGroup();
 map.addLayer(markersLayer);
 var controlSearch = new L.Control.Search({
     position: 'topleft',
     layer: markersLayer,
     initial: false,
     zoom: 17,
     markerLocation: true
 });
 map.addControl(controlSearch);

 data.forEach(function(place) {
     var marker = new L.Marker(new L.latLng(place.loc), { title: place.title });
     marker.bindPopup('<div><strong>' + place.title + '</strong></div>' +
         '<div><strong>Jam Operasional: </strong>' + place.operasional + '</div>' +
         '<div><a href="{{ route("places.edit", ":id") }}'.replace(':id', place.id) + '">Edit</a></div>');
     markersLayer.addLayer(marker);
 });

 $('#textsearch').on('keyup', function(e) {
     controlSearch.searchText(e.target.value);
 });

 // Code for adding new objects to the map
 var drawnItems = new L.FeatureGroup();
 map.addLayer(drawnItems);

 var drawControl = new L.Control.Draw({
     position: 'topright',
     draw: {
         polygon: {
             shapeOptions: {
                 color: 'brown'
             },
             allowIntersection: false,
             drawError: {
                 color: 'orange',
                 timeout: 1000
             },
             showArea: true,
             metric: false,
             repeatMode: true
         },
         polyline: {
             shapeOptions: {
                 color: 'red'
             },
         },
         rectangle: {
             shapeOptions: {
                 color: 'green'
             },
         },
         circle: {
             shapeOptions: {
                 color: 'steelblue'
             },
         },
     },
     edit: {
         featureGroup: drawnItems
     }
 });
 map.addControl(drawControl);

 map.on('draw:created', function(e) {
     var type = e.layerType,
         layer = e.layer;
     drawnItems.addLayer(layer);
 });
</script>

@endpush
