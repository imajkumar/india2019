<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'style' => 'style-1',
	'number' => '',
	'grid' => 'grid1',
	'orderby' => 'post_date',
	'cat_slug' => '',
	'box_shadow' => ''
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

if ( ! shortcode_exists( 'campaigns' ) ) {
	echo "Charitable plugin not found.";
	return;
}

$number = intval( $number );

$cls = $style .' '. $grid;
if ( $box_shadow) $cls .= ' has-shadow';

$shortcode = 'button=0 columns=1 orderby='. $orderby;
if ( $cat_slug ) $shortcode .= ' category='. $cat_slug;
if ( $number ) $shortcode .= ' number='. $number;
$shortcode = '[campaigns '. $shortcode .']';

printf( '<div class="wprt-causes clearfix %2$s">%1$s</div>', do_shortcode($shortcode), $cls );