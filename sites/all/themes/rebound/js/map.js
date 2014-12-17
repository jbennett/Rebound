(function($){
    var map, geocoder;
    
    $(function(){
        if ($("body").hasClass("contact-us"))
        {
            init();
        }
    });
    
    function init()
    {
        $("<div id='gmap'></div>").insertAfter(".main-wrapper");
        
        
        var mapOptions = {
            zoom: 15
        }
        map = new google.maps.Map(document.getElementById('gmap'), mapOptions);
        
        geocoder = new google.maps.Geocoder();
        
        centerMap();
        showMarker();
        
        $(window).resize(centerMap);
    }
    
    function centerMap()
    {
        getAddressLatLng(address(), showMapLatLng);
    }
    function showMapLatLng(latlng)
    {
        map.setCenter(latlng);
    }
    
    function showMarker()
    {
        getAddressLatLng(address(), showMarkerLatLng);
    }
    function showMarkerLatLng(latlng, address)
    {
        var icon = {
            "url": "/sites/all/themes/rebound/img/map-marker.png",
            "origin": new google.maps.Point(0,0),
            "anchor": new google.maps.Point(19,38)
        };
        
        var marker = new google.maps.Marker({
            "map": map,
            "position": latlng,
            "icon": icon
        });
    }
    
    function address()
    {
        return "10 Lorne Cres., Sarnia, ON";
    }
    
    function getAddressLatLng(address, callback)
    {
        geocoder.geocode( { 'address':address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                callback(results[0].geometry.location, address);
            } else {
            }
        });
    }
})(jQuery);
