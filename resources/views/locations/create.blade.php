@extends('partials.main')

@section('content')
    <div class="container">
        <br><br><br>
        <h2>{{ $title }} <a href="{{ route('locations.index') }}" class="btn btn-primary"> All Locations</a></h2>
        <form action="{{ route('locations.store') }}" method="POST">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
                @csrf
                <input class="form-control" type="text" id="address" name="address" value="">
            
            
            <input class="form-control" type="hidden" id="latitude" name="latitude" value="">
            <input class="form-control" type="hidden" id="longitude" name="longitude" value="">
            <input class="form-control" type="hidden" id="zoom" name="zoom" value="">
            
            <br>            <br>
            <input class="form-control btn btn-primary" type="submit"  value="Add">
        </form>
        <br><br><br>    
        <div id="google-maps" style="width:100%;height:450px;"></div>
    </div>
    <br> 
    @push('js')
        <script type="text/javascript">
            function triggerGoogleMaps() {
                var maps = new google.maps.Map(document.getElementById('google-maps'), {
                    center:{
                        lat: parseFloat('30.0444196'),
                        lng: parseFloat('31.23571160000006'),
                    },
                    zoom: 6
                });

                var marker = new google.maps.Marker({
                    position : {
                        lat: parseFloat('30.0444196'),
                        lng: parseFloat('31.23571160000006'),
                    },
                    map : maps,
                    draggable : true

                });

                var search = new google.maps.places.SearchBox(document.getElementById('address'));


                google.maps.event.addListener(search,'places_changed',function(){
                    var places = search.getPlaces();
                    var bounds = new google.maps.LatLngBounds();
                    var i, place;
                    for(i=0; place=places[i];i++){
                        bounds.extend(place.geometry.location);
                        marker.setPosition(place.geometry.location); //set marker position new...
                    }
                    maps.fitBounds(bounds);
                    maps.setZoom(8);
                });

                google.maps.event.addListener(marker,'position_changed',function(){
                    var lat = marker.getPosition().lat();
                    var lng = marker.getPosition().lng();

                    $("#latitude").val(lat);
                    $("#longitude").val(lng);
                });
                google.maps.event.addListener(maps,'zoom_changed', function() {
                            var zoom = maps.getZoom();
                            $("#zoom").val(zoom);
                        });
                    }
        
            triggerGoogleMaps()
        </script>
    @endpush
@endsection