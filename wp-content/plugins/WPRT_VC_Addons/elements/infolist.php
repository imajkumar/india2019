<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'bottom_padding' => '10px',
	'bottom_margin' => '10px',
	'border_color' => '',
	'border_width' => '',
	'border_style' => 'solid',
	'title' => '',
	'title_color' => '',
	'title_width' => '150px',
	'text_color' => '',
	'title_font_family' => 'Default',
	'title_font_weight' => 'Default',
	'title_font_size' => '',
	'text_font_family' => 'Default',
	'text_font_weight' => 'Default',
	'text_font_size' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$title_width = intval( $title_width );
$bottom_padding = intval( $bottom_padding );
$bottom_margin = intval( $bottom_margin );
$border_width = intval( $border_width );

$title_font_size = intval( $title_font_size );
$text_font_size = intval( $text_font_size );

$html = $cls = $css = '';
$title_css = $text_css = '';
$css .= 'border-style:'. $border_style .';';

if ( $border_color && $border_width ) $css .= 'border-width: 0 0 '. $border_width .'px 0;border-color:'. $border_color .';';
if ( $bottom_padding ) $css .= 'padding-bottom:'. $bottom_padding .'px;';
if ( $bottom_margin ) $css .= 'margin-bottom:'. $bottom_margin .'px;';

if ( $title_font_weight != 'Default' ) $title_css .= 'font-weight:'. $title_font_weight .';';
if ( $title_color ) $title_css .= 'color:'. $title_color .';';
if ( $title_font_size ) $title_css .= 'font-size:'. $title_font_size .'px;';
if ( $title_width ) $title_css .= 'width:'. $title_width .'px;';
if ( $title_font_family != 'Default' ) {
	wprt_enqueue_google_font( $title_font_family );
	$title_css .= 'font-family:'. $title_font_family .';';
}

if ( $text_font_weight != 'Default' ) $text_css .= 'font-weight:'. $text_font_weight .';';
if ( $text_color ) $text_css .= 'color:'. $text_color .';';
if ( $text_font_size ) $text_css .= 'font-size:'. $text_font_size .'px;';
if ( $text_font_family != 'Default' ) {
	wprt_enqueue_google_font( $text_font_family );
	$text_css .= 'font-family:'. $text_font_family .';';
}

if ( $title ) {
	$html .= sprintf('
		<div class="title" style="%1$s">
			%2$s
		</div>',
		$title_css,
		$title
	);	
}

if ( $content ) {
	$html .= sprintf('
		<div class="text" style="%1$s">
			%2$s
		</div>',
		$text_css,
		$content
	);	
}

printf(
	'<div class="wprt-info-list clearfix %1$s" style="%2$s">%3$s</div>',
	$cls,
	$css,
	$html 
);