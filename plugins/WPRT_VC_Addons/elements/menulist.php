<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'background' => '#f8f8f8',
	'border_color' => '#f1f1f1',
	'border_width' => '1px',
	'border_style' => 'solid',
	'padding' => '',
	'bottom_margin' => '10',
	'text' => '',
	'text_color' => '',
	'text_padding' => '5px',
	'value_style' => 'background',
	'value' => '',
	'value_color' => '',
	'value_background' => '',
	'value_padding' => '',
	'value_rounded' => '',
	'text_font_family' => 'Default',
	'text_font_weight' => 'Default',
	'text_font_size' => '',
	'value_font_family' => 'Default',
	'value_font_weight' => 'Default',
	'value_font_size' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$border_width = intval( $border_width );
$bottom_margin = intval( $bottom_margin );
$text_padding = intval( $text_padding );
$value_rounded = intval( $value_rounded );
$text_font_size = intval( $text_font_size );

$html = $cls = $css = '';
$text_css = $value_css = '';

$cls = $value_style;
$css .= 'border-style:'. $border_style .';';
if ( $padding ) $css .= 'padding:'. $padding .';';

if ( $border_color && $border_width ) $css .= 'border-width: 0 0 '. $border_width .'px 0;border-color:'. $border_color .';';
if ( $background ) $css .= 'background-color:'. $background .';';
if ( $bottom_margin ) $css .= 'margin-bottom:'. $bottom_margin .'px;';

if ( $text_font_weight != 'Default' ) $text_css .= 'font-weight:'. $text_font_weight .';';
if ( $text_color ) $text_css .= 'color:'. $text_color .';';
if ( $text_font_size ) $text_css .= 'font-size:'. $text_font_size .'px;';
if ( $text_font_family != 'Default' ) {
	wprt_enqueue_google_font( $text_font_family );
	$text_css .= 'font-family:'. $text_font_family .';';
}

if ( $value_font_weight != 'Default' ) $value_css .= 'font-weight:'. $value_font_weight .';';
if ( $value_color ) $value_css .= 'color:'. $value_color .';';
if ( $value_font_size ) $value_css .= 'font-size:'. $value_font_size .'px;';
if ( $value_font_family != 'Default' ) {
	wprt_enqueue_google_font( $value_font_family );
	$value_css .= 'font-family:'. $value_font_family .';';
}

if ( $text ) {
	$html .= sprintf('
		<span class="text" style="%1$s">
			%2$s
		</span>',
		$text_css,
		$text
	);	
}

if ( $value_style == 'background' ) {
	if ( $text_padding ) $text_css .= 'padding-top:'. $text_padding .'px;';
	if ( $value_background ) $value_css .= 'background-color:'. $value_background .';';
	if ( $value_rounded ) $value_css .= 'border-radius:'. $value_rounded .'px;';
	if ( $value_padding ) $value_css .= 'padding:'. $value_padding .';';
}

if ( $value ) {
	$html .= sprintf('
		<span class="value" style="%1$s">
			%2$s
		</span>',
		$value_css,
		$value
	);	
}

printf(
	'<div class="wprt-menu-list clearfix %1$s" style="%2$s">%3$s</div>',
	$cls,
	$css,
	$html 
);