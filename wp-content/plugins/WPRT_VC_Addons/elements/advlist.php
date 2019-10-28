<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'style' => 'icon-left',
	'icon_display' => 'icon-font',
	'image' => '',
	'image_width' => '',
	'icon_type' => '',
	'icon' => '',
	'icon_position' => 'middle',
	'icon_color' => '',
	'icon_font_size' => '',
	'content_color' => '',
	'content_left_padding' => '30',
	'content_padding' => '',
	'content_bottom_margin' => '10',
	'content_background_color' => '#f8f8f8',
	'content_border_style' => 'solid',
	'content_border_color' => '',
	'content_border_width' => '',
	'hyperlink' => '',
	'link_url' => '',
	'content_font_family' => 'Default',
	'content_font_weight' => 'Default',
	'content_font_size' => '',
	'content_line_height' => '',
), $atts ) );

$icon_font_size = intval( $icon_font_size );
$content_left_padding = intval( $content_left_padding );
$content_font_size = intval( $content_font_size );
$content_line_height = intval( $content_line_height );
$content_bottom_margin = intval( $content_bottom_margin );
$image_width = intval( $image_width );

$list_css = $inner_css = $inner_content_css = $icon_cls = $icon_css = $link_css = '';
$icon_html = $content_html = $image_css = '';

$cls = $style .' icon-'. $icon_position;

if ( $content_font_weight != 'Default' ) $inner_content_css .= 'font-weight:'. $content_font_weight .';';
if ( $content_font_size ) $inner_content_css .= 'font-size:'. $content_font_size .'px;';
if ( $content_line_height ) $inner_content_css .= 'line-height:'. $content_line_height .'px;';
if ( $content_font_family != 'Default' ) {
	wprt_enqueue_google_font( $content_font_family );
	$inner_content_css .= 'font-family:'. $content_font_family .';';
}

if ( $style == 'icon-left' && isset( $content_left_padding ) )
	$inner_css .= 'padding-left:'. $content_left_padding .'px;';
if ( $content_color ) {
	$inner_css .= 'color:'. $content_color;
	$link_css .= 'color:'. $content_color;
}

if ( isset( $content_padding ) ) $list_css .= 'padding:'. $content_padding .';';
if ( isset( $content_bottom_margin ) ) $list_css .= 'margin-bottom:'. $content_bottom_margin .'px;';

if ( $content_background_color ) $list_css .= 'background-color:'. $content_background_color .';';
if ( $content_border_color ) $list_css .= 'border-color:'. $content_border_color .';';
if ( $content_border_width ) $list_css .= 'border-style: solid; border-width:'. $content_border_width .';border-style:'. $content_border_style .';';

if ( $icon_display == 'icon-font' ) {
	vc_icon_element_fonts_enqueue( $icon_type );
	$icon = wprt_get_icon_class( $atts, 'icon' );

	if ( $icon_color == '#f57223' ) {
		$icon_cls .= ' accent';
	} else {
		if ( $icon_color ) $icon_css .= 'color:'. $icon_color .';';
	}
	
	if ( $icon_font_size ) $icon_css .= 'font-size:'. $icon_font_size .'px;';

	$icon_html = sprintf(
		'<span class="icon %3$s">
			<i class="%1$s" style="%2$s"></i>
		</span>',
		$icon,
		$icon_css,
		$icon_cls
	);
} else {
	if ( $image_width ) $image_css = 'width:'. $image_width .'px;';

	if ( $image )
	$icon_html = sprintf(
		'<span class="image" style="%2$s">
			<img alt="image" src="%1$s">
		</span>',
		wp_get_attachment_image_src( $image, 'full' )[0],
		$image_css
	);
}

if ( $content )
	$content_html = sprintf(
		'<span style="%2$s">%1$s</span>',
		$content,
		$inner_content_css
	);

if ( $hyperlink && $link_url ) {
	$icon_html = sprintf( '<a target="_blank" href="%2$s">%1$s</a>', $icon_html, $link_url );
	$content_html = sprintf( '<a target="_blank" href="%2$s" style="%3$s">%1$s</a>', $content_html, $link_url, $link_css );
}

printf(
	'<div class="wprt-list clearfix %1$s">
		<div style="%3$s">
			<span style="%2$s">%4$s %5$s</span>
		</div>
	</div>',
	esc_attr( $cls ),
	$inner_css,
	$list_css,
	$icon_html,
	$content_html
);
