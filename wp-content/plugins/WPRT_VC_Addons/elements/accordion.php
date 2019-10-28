<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'open' => '',
	'bottom_margin' => '10',
	'tag' => 'h3',
	'heading' => '',
	'heading_padding' => '',
	'heading_rounded' => '',
	'show_icon' => '',
	'icon_type' => '',
	'icon' => '',
	'icon_font_size' => '',
	'heading_left_padding' => '',
	'content_padding' => '',
	'heading_font_family' => 'Default',
	'heading_font_weight' => 'Default',
	'heading_font_size' => '',
	'heading_line_height' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$icon_font_size = intval( $icon_font_size );
$heading_left_padding = intval( $heading_left_padding );
$heading_font_size = intval( $heading_font_size );
$heading_line_height = intval( $heading_line_height );
$heading_rounded = intval( $heading_rounded );

$cls = $css = $icon_wrap_css = $icon_css = $heading_css = $heading_inner_css = $content_css = $html = $icon_html = '';
if ( $open ) $cls = ' active';
$css .= $bottom_margin == '0'
	? 'margin-bottom:0;'
	: 'margin-bottom:'. $bottom_margin .'px;';

if ( $show_icon ) {
	$icon = wprt_get_icon_class( $atts, 'icon' );
	if ( $icon && $icon_type != '' ) {
		$cls .= ' has-icon';
		vc_icon_element_fonts_enqueue( $icon_type );
		if ( $icon_font_size ) $icon_css .= 'font-size:'. $icon_font_size .'px;';
		$icon_html = sprintf('<span class="icon-wrap"><i class="%1$s" style="%2$s"></i></span>', $icon, $icon_css );
	}
} else { $cls .= ' no-icon'; }

if ( $heading_font_weight != 'Default' ) $heading_css .= 'font-weight:'. $heading_font_weight .';';
if ( $heading_font_size ) $heading_css .= 'font-size:'. $heading_font_size .'px;';
if ( $heading_line_height ) $heading_css .= 'line-height:'. $heading_line_height .'px;';
if ( $heading_padding ) $heading_css .= 'padding:'. $heading_padding .';';
if ( $heading_rounded ) $heading_css .= 'border-radius:'. $heading_rounded .'px;';
if ( $heading_font_family != 'Default' ) {
	wprt_enqueue_google_font( $heading_font_family );
	$heading_css .= 'font-family:'. $heading_font_family .';';
}

if ( $heading_left_padding ) $heading_inner_css .= 'padding-left:'. $heading_left_padding .'px;';
if ( $content_padding ) $content_css .= 'padding:'. $content_padding .';';

if ( $heading )
	$html .= sprintf(
		'<%4$s class="accordion-heading" style="%1$s">
			<span class="inner" style="%2$s">
				%5$s
				%3$s
			</span>
		</%4$s>',
		esc_attr( $heading_css ),
		esc_attr( $heading_inner_css ),
		esc_html( $heading ),
		$tag,
		$icon_html
	);

if ( $content )
	$html .= sprintf(
		'<div class="accordion-content" style="%1$s">%2$s</div>',
		$content_css,
		$content
	);

printf( '<div class="accordion-item %1$s" style="%3$s">%2$s</div>', esc_attr( $cls ), $html, esc_attr( $css ) );