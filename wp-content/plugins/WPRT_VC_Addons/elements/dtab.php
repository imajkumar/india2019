<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'title' => 'Tab',
	'content_padding' => '',
	'title_font_family' => 'Default',
	'title_font_weight' => 'Default',
	'title_font_size' => '',
	'title_line_height' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$title_font_size = intval( $title_font_size );
$title_line_height = intval( $title_line_height );

$cls = $css = $title_css = $title_inner_css = $content_css = $html = '';

if ( $title_font_weight != 'Default' ) $title_css .= 'font-weight:'. $title_font_weight .';';
if ( $title_font_size ) $title_css .= 'font-size:'. $title_font_size .'px;';
if ( $title_line_height ) $title_css .= 'line-height:'. $title_line_height .'px;';
if ( $title_font_family != 'Default' ) {
	wprt_enqueue_google_font( $title_font_family );
	$title_css .= 'font-family:'. $title_font_family .';';
}

if ( $content_padding ) $content_css .= 'padding:'. $content_padding .';';

if ( $title )
	$html .= sprintf(
		'<span class="item-title" style="%1$s">
			<span class="inner" style="%2$s">
				%3$s
			</span>
		</span>',
		esc_attr( $title_css ),
		esc_attr( $title_inner_css ),
		esc_html( $title )
	);

if ( $content )
	$html .= sprintf(
		'<div class="item-content" style="%1$s">%2$s</div>',
		$content_css,
		$content
	);

printf( '<div class="tab-content %1$s" style="%3$s">%2$s</div>', $cls, $html, $css );