<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
    'style' => 'style-1',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

printf( '
	<div class="wprt-accordions %2$s">%1$s</div>',
	do_shortcode($content),
	esc_attr( $style )
);