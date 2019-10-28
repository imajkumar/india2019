<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
    'animation' => 'fadeInLeft',
    'duration' => '1',
    'delay' => '0.6',
    'position' => '90'
), $atts ) );

if ( $duration ) $duration = $duration .'s';
if ( $delay ) $delay = $delay .'s';
if ( $position ) $position = $position .'%';

printf(
	'<div class="wprt-animation-block" data-animate="%2$s" data-duration="%3$s" data-delay="%4$s" data-position="%5$s">
		%1$s
	</div>',
	do_shortcode($content),
	esc_attr( $animation ),
	esc_attr( $duration ),
	esc_attr( $delay ),
	esc_attr( $position )
);