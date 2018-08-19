<?php

extract(shortcode_atts(array(
    'pin_image'    => get_template_directory_uri().'/images/map-pin1.png',
    'latitude'     => '',
    'longitude'    => '',
    'content'      => 'You are here'
), $atts));

wp_enqueue_script( 'maps_js' , '//maps.google.com/maps/api/js?key=AIzaSyCRrJ_VQvTCWM0bv_ZpLfm8j5TW-yUhX9E', array('jquery'), null, true);

if (!empty($pin_image)){
    $img_url =  wp_get_attachment_url( $pin_image );
}

if(!empty($content)){
    $content = wp_kses_post( $content );
}
?>
<div class="contact-map">
    <div id="contactmap" data-position-latitude="<?php echo esc_attr($latitude); ?>" data-position-longitude="<?php echo esc_attr($longitude); ?>"></div>
</div>
<script>
    /* ==============================================
     Google map
     ============================================== */
    jQuery(document).ready(function($){
        "use strict";
        $.fn.contactmap = function(options) {

            var posLatitude = '<?php echo $latitude; ?>',
                posLongitude = '<?php echo $longitude; ?>',
                description = '<?php echo (!empty($content)) ? $content : ""; ?>',
                icon_url = '<?php echo $img_url; ?>';

            var settings = $.extend({
                home: {
                    latitude: posLatitude,
                    longitude: posLongitude
                },
                text: description,
                icon_url: icon_url,
                zoom: 14
            }, options);

            var coords = new google.maps.LatLng(settings.home.latitude, settings.home.longitude);

            return this.each(function() {
                var element = $(this);

                var options = {
                    zoom: settings.zoom,
                    center: coords,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: false,
                    scaleControl: false,
                    streetViewControl: false,
                    panControl: true,
                    disableDefaultUI: true,
                    scrollwheel:false,
                    draggable:true,
                    navigationControl:false,
                    zoomControlOptions: {
                        style: google.maps.ZoomControlStyle.DEFAULT
                    },
                    overviewMapControl: true,
                };

                var map = new google.maps.Map(element[0], options);

                var icon = {
                    url: settings.icon_url,
                    origin: new google.maps.Point(0, 0)
                };

                var marker = new google.maps.Marker({
                    position: coords,
                    map: map,
                    icon: icon_url,
                    draggable: false
                });

                var info = new google.maps.InfoWindow({
                    content: settings.text
                });

                google.maps.event.addListener(marker, 'click', function() {
                    info.open(map, marker);
                });
            });

        };
        $('#contactmap').contactmap();
    });
</script>