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
            zoom: 15,
            scrollwheel: false
        }
        map = new google.maps.Map(document.getElementById('gmap'), mapOptions);
        
        geocoder = new google.maps.Geocoder();
        
        centerMap1();
        showMarkers();
        
        $(".address1").click(function(){
            centerMap1();
        });
        $(".address2").click(function(){
            centerMap2();
        })
        $(".address3").click(function(){
            centerMap3();
        });
    }
    
    function centerMap1()
    {
        getAddressLatLng(address1(), showMapLatLng);
    }
    function centerMap2()
    {
        getAddressLatLng(address2(), showMapLatLng);
    }
    function centerMap3()
    {
        getAddressLatLng(address3(), showMapLatLng);
    }
    function showMapLatLng(latlng)
    {
        map.setCenter(latlng);
    }
    
    function showMarkers()
    {
        getAddressLatLng(address1(), showMarkerLatLng);
        getAddressLatLng(address2(), showMarkerLatLng);
        getAddressLatLng(address3(), showMarkerLatLng);
    }
    function showMarkerLatLng(latlng, address)
    {
        var icon = {
            "url": "/sites/all/themes/rebound/img/map-marker.png",
            "origin": new google.maps.Point(0,0),
            "anchor": new google.maps.Point(21,63)
        };
        
        var marker = new google.maps.Marker({
            "map": map,
            "position": latlng,
            "icon": icon
        });
    }
    
    function address1()
    {
        return "10 Lorne Cres., Sarnia, ON";
    }
    function address2()
    {
        return "411 Wingfield Street, Petrolia, ON";
    }
    function address3()
    {
        return "59 King St W, Forest, ON";
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
