/**
 * Created by WEB on 9/24/2020.
 */
jQuery(function($) {
    //console.log(WPGMZA);
    var map_row_id = [];
    $('.wpgmaps_mlist_row').map(function (index) {
        var check_map = $(this).find('.map-wrap').length;
        //console.log(check_map);
        if( check_map >= 1 ){
            var id = this.id;
            map_row_id.push(id);
            //console.log(id);
        }

    });
    //console.log(map_row_id);
    function geoCodeAddress(ele) {

        var marker_id = $('#'+ele).attr('data-marker-id');
        var address = $('#'+ele).attr('data-address');
        address = address.replace(/\s/g, "+");
        address = address.trim();
        var store_title = $('#'+ele).attr('data-store-title');
        var zoom = $('#'+ele).attr('data-zoom');
        zoom = parseInt(zoom);
        //console.log(address);
        var geocoder = new WPGMZA.Geocoder.createInstance();
        geocoder.getLatLngFromAddress({
            address: address
        }, function (results, status) {
            //console.log(results);
            if (status === 'success') {
                var lat = results[0].lat;
                var lng = results[0].lng;
                var latlng = lat + ',' + lng;

                var $map_thumb = $('.map-thumb-' + marker_id);
                $map_thumb.attr('data-latlng', latlng);
                $map_thumb.find('.wpgmza-grid-footer .wpgmza_gd').attr('gps', latlng);

                var myLatLng = {
                    lat: lat,
                    lng: lng
                };

                var map = new google.maps.Map(document.getElementById("map-wrapper-" + marker_id), {
                    zoom: zoom,
                    center: myLatLng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    disableDefaultUI: true
                });
                new google.maps.Marker({
                    position: myLatLng,
                    icon: '/wp-content/plugins/wp-google-maps/images/spotlight-poi2.png',
                    map,
                    label: {
                        top: '0px',
                        color: '#a60d0d',
                        fontWeight: 'bold',
                        fontSize: '14px',
                        text: store_title
                    }
                });

            } else {
                console.log(status);
            }

        });
    }
    // $.each(map_row_id, function(index, value){
    //
    // });

    function geocode() {
        if (geoIndex < map_row_id.length) {
            geoCodeAddress(map_row_id[geoIndex]);
            ++geoIndex;
        }
        else {
            clearInterval(geoTimer);
        }
    }
    var geoIndex = 0;
    var geoTimer = setInterval(geocode, 200);  // 200 milliseconds (to try out)


    // for( var i = 0; map_row_id.length <= i; i++){
    //
    // }

    //var mapInterval = setInterval( geoCode, 2000);

    // setTimeout(function () {
    //     clearInterval(mapInterval);
    // },2000);

    // Try HTML5 geolocation.
    function getLocation(event) {

        var test = $( event.target ).attr('data-link');
        console.log(test);
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
    function showPosition(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        var curentLocation = latitude + ',' + longitude;

        //console.log(curentLocation);

    }

    $(document.body).on("click", ".footer-links", function(event) {
        https://www.google.com/maps/dir/Current+Location/44.277549,-78.338084

            var link = $(this).attr('data-link');
        if(link){
            switch(link){
                case '#':
                    return;
                    break;
                default:
                    window.location.href = link;
                    break;
            }

        }
    });

    //     var geocoder = new WPGMZA.Geocoder.createInstance();
    // geocoder.getLatLngFromAddress({
    //     address: '1600+Amphitheatre+Parkway,+Mountain+View,+CA'
    // }, function(results, status) {
    //     console.log(results);
    //     console.log(status);
    // });
});