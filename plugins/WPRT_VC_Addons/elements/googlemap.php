<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
    'lat' => '',
    'lng' => '',
    'width' => '',
    'height' => '300',
    'zoom' => '14',
    'drag_mobile' => 'true',
    'drag_desktop' => 'true',
    'marker_type' => 'simple',
    'image' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$css = $dragging = '';
$width = intval( $width );
$height = intval( $height );

if ( $width ) $css .= 'width:'. $width .'px;';
if ( $height ) $css .= 'height:'. $height .'px;';

$id = "map_".uniqid();
if ( wp_is_mobile() ) { $dragging = $drag_mobile; }
else { $dragging = $drag_desktop; }

if ( $image && $marker_type == 'image' )
    $image = wp_get_attachment_image_src( $atts['image'], 'full' )[0];

$html = '
<script type="text/javascript">
    var places = [['.$lat.', '.$lng.']];

    function wprt_vc_gmap() {
        var mapOptions = {
            scrollwheel: false,
            draggable: '.$dragging.',
            zoom: '.$zoom.',
            center: new google.maps.LatLng('.$lat.', '.$lng.'),
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, "map_style"]
            }
        }

        var map = new google.maps.Map(document.getElementById("'.$id.'"), mapOptions);
       
        setMarkers(map, places);
    }

    function setMarkers(map, locations) {
        for (var i = 0; i < locations.length; i++) {
            var place = locations[i];
            var myLatLng = new google.maps.LatLng(place[0], place[1]);
            var marker = new google.maps.Marker( {
                position: myLatLng,
                map: map,
                icon: "'.$image.'",
                zIndex: place[2],
                animation: google.maps.Animation.DROP
            });

            google.maps.event.addListener(marker, "click", function () {
                infowindow.setContent(decodeURIComponent(this.html));
                infowindow.open(map, this);
            });
        }
    }

    google.maps.event.addDomListener(window, "load", wprt_vc_gmap);
</script>';

printf('%1$s<div id="%2$s" class="wprt-google-map" style="%3$s"></div>', $html, $id, $css );