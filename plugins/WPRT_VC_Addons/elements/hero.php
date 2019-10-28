<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'hero_height' => 'full-height',
	'hero_custom_height' => '',
	'showcase' => 'slideshow',
    'images' => '',
    'effect' => 'fade',
    'color_overlay' => '',
    'pattern_overlay' => 'style-1',
    'alignment' => 'text-center',
    'content_top' => '',
    'grid' => '',
    'video_link' => '',
    'scroll' => '',
    'arrow_style' => 'style-1',
    'scroll_id' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$content_top = intval( $content_top );

$count = $img_str = '';
$content_html = $arrow_html = '';
if ( ! empty( $images ) ) {
	$imgs = explode( ',', trim( $images ) );
	$count = count( $imgs );
	for ( $i=0; $i<$count; $i++ ) {
		$img_str .= wp_get_attachment_image_src( $imgs[$i], 'full' )[0] .'|';
	}
	$img_str = substr( $img_str, 0, -1 );
}

if ( $grid ) {
	$content_html = sprintf( '<div class="wprt-container"><div class="hero-content">%1$s</div></div>', do_shortcode($content) );
} else {
	$content_html = sprintf( '<div class="hero-content">%1$s</div>', do_shortcode($content) );
}

if ( $scroll ) {
	$arrow_html .= sprintf( '<a href="#%2$s" class="bounce infinite hero-arrow scroll-target %1$s"></a>', $arrow_style, esc_html( $scroll_id ) );
}

if ( $hero_height = 'custom-height' && $hero_custom_height )
	$hero_custom_height = intval( $hero_custom_height );

if ( $showcase == 'slideshow') {
	wp_enqueue_script( 'wprt-vegas' );
	printf(
		'<div class="hero-section slideshow %6$s" data-count="%2$s" data-image="%1$s" data-effect="%5$s" data-overlay="%3$s" data-poverlay="%4$s" data-content="%9$s" data-height="%10$s">
	    	%7$s %8$s
		</div>',
		$img_str,
		$count,
		$color_overlay,
		$pattern_overlay,
		$effect,
		$alignment,
		$content_html,
		$arrow_html,
		$content_top,
		$hero_custom_height
	);
}

if ( $showcase == 'video') {
	wp_enqueue_script( 'wprt-ytplayer' );

	$property = "{videoURL:'$video_link',containment:'.player', showControls:false, autoPlay:true, loop:true, mute:false, startAt:0, opacity:1, addRaster:'$pattern_overlay', quality:'default'}";

	printf(
		'<div class="hero-section video player %3$s" data-property="%1$s" data-overlay="%2$s" data-content="%6$s" data-height="%7$s">
		    %4$s %5$s
	    </div>',
		$property,
		$color_overlay,
		$alignment,
		$content_html,
		$arrow_html,
		$content_top,
		$hero_custom_height
	);
}

