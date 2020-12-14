/**
 * @namespace WPGMZA
 * @module DirectionsBox
 * @requires WPGMZA.EventDispatcher
 */
jQuery(function($) {

    WPGMZA.DirectionsBox.prototype = Object.create(WPGMZA.EventDispatcher);
    WPGMZA.DirectionsBox.prototype.constructor = WPGMZA.DirectionsBox;

    WPGMZA.DirectionsBox.STYLE_DEFAULT = "default";
    WPGMZA.DirectionsBox.STYLE_MODERN = "modern";

    WPGMZA.DirectionsBox.STATE_INPUT = "input";
    WPGMZA.DirectionsBox.STATE_DISPLAY = "display";

    WPGMZA.DirectionsBox.forceGoogleMaps = false;

    console.log(WPGMZA);
    $(document.body).on("click", ".wpgmza_gd, .wpgmza-directions-button", function(event) {
        WPGMZA.DirectionsBox.prototype.onGetDirections = function (event) {
            if (this.openExternal) {
                window.open(this.getExternalURL(), "_blank");
                return;
            }

            this.route();
        }

        var component;
        var marker, address, coords, map;

        component = $(event.currentTarget).closest("[data-wpgmza-marker-listing]");

        if (!component.length)
            component = $(event.currentTarget).closest(".wpgmza_modern_infowindow, [data-map-id]");

        if (!component.length)
            return; // NB: ProInfoWindow handles this

        if (component.length) {
            var element = component[0];

            if (element.wpgmzaMarkerListing) {
                map = element.wpgmzaMarkerListing.map;
                marker = map.getMarkerByID($(event.currentTarget).closest("[data-marker-id]").attr("data-marker-id"));
            }
            else if (element.wpgmzaInfoWindow) {
                marker = element.wpgmzaInfoWindow.mapObject;
                map = marker.map;
            }
            else if (element.wpgmzaMap) {
                map = element.wpgmzaMap;
                marker = element.wpgmzaMap.getMarkerByID($(event.currentTarget).attr("data-marker-id"));
            }
        }

        address = marker.address;
        coords = marker.getPosition().toString();

        if (map.directionsBox.openExternal)
            window.open(map.directionsBox.getExternalURL({marker: marker}));

    });

	
});