<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'style' => '',
	'order' => 'nh',
	'alignment' => 'text-center',
	'number' => '',
	'number_color' => '',
	'number_prefix' => '',
	'prefix_color' => '',
	'number_suffix' => '',
	'suffix_color' => '',
	'time' => '5000',
	'heading_tag' => 'div',
    'heading' => '',
    'heading_color' => '',
	'separator' => '',
	'line_width' => '50',
	'line_height' => '2',
	'line_color' => '',
	'image' => '',
	'image_width' => '',
	'number_font_family' => 'Default',
	'number_font_weight' => 'Default',
	'number_font_size' => '',
	'number_line_height' => '',
	'heading_font_family' => 'Default',
	'heading_font_weight' => 'Default',
	'heading_font_size' => '',
	'heading_line_height' => '',
	'prefix_font_family' => 'Default',
	'prefix_font_weight' => 'Default',
	'prefix_font_size' => '',
	'prefix_line_height' => '',
	'suffix_font_family' => 'Default',
	'suffix_font_weight' => 'Default',
	'suffix_font_size' => '',
	'suffix_line_height' => '',
	'number_top_margin' => '',
	'number_bottom_margin' => '',
	'heading_top_margin' => '',
	'heading_bottom_margin' => '',
	'icon_type' => '',
	'icon' => '',
	'icon_color' => '',
	'icon_font_size' => '',
	'icon_right_margin' => '',
), $atts ) );

$image_width = intval( $image_width );
$line_width = intval( $line_width );
$line_height = intval( $line_height );
$icon_font_size = intval( $icon_font_size );
$icon_right_margin = intval( $icon_right_margin );

$heading_font_size = intval( $heading_font_size );
$heading_line_height = intval( $heading_line_height );
$number_font_size = intval( $number_font_size );
$number_line_height = intval( $number_line_height );

$prefix_font_size = intval( $prefix_font_size );
$prefix_line_height = intval( $prefix_line_height );
$suffix_font_size = intval( $suffix_font_size );
$suffix_line_height = intval( $suffix_line_height );

$heading_top_margin = intval( $heading_top_margin );
$heading_bottom_margin = intval( $heading_bottom_margin );
$number_top_margin = intval( $number_top_margin );
$number_bottom_margin = intval( $number_bottom_margin );

$cls = $style .' '. $alignment;
$icon_cls = $icon_css = $heading_css = $number_css = $suffix_cls = $prefix_cls = $suffix_css = $prefix_css = '';
$html = $icon_html = $heading_html = $number_html = $sep_html = '';
$line_cls = $line_css = $image_css = '';
$number_cls = '';

if ( $number_color == '#f57223' ) {
	$number_cls .= 'accent';
} else {
	if ( $number_color ) $number_css .= 'color:'. $number_color .';';
}

if ( $prefix_color == '#f57223' ) {
	$prefix_cls .= 'accent';
} else {
	if ( $prefix_color ) $prefix_css .= 'color:'. $prefix_color .';';
}

if ( $suffix_color == '#f57223' ) {
	$suffix_cls .= 'accent';
} else {
	if ( $suffix_color ) $suffix_css .= 'color:'. $suffix_color .';';
}

if ( $number_font_weight != 'Default' ) $number_css .= 'font-weight:'. $number_font_weight .';';
if ( $number_font_size ) $number_css .= 'font-size:'. $number_font_size .'px;';
if ( $number_line_height ) $number_css .= 'line-height:'. $number_line_height .'px;';
if ( $number_top_margin ) $number_css .= 'margin-top:'. $number_top_margin .'px;';
if ( $number_bottom_margin ) $number_css .= 'margin-bottom:'. $number_bottom_margin .'px;';
if ( $number_font_family != 'Default' ) {
	wprt_enqueue_google_font( $number_font_family );
	$number_css .= 'font-family:'. $number_font_family .';';
}

if ( $heading_font_weight != 'Default' ) $heading_css .= 'font-weight:'. $heading_font_weight .';';
if ( $heading_color ) $heading_css .= 'color:'. $heading_color .';';
if ( $heading_font_size ) $heading_css .= 'font-size:'. $heading_font_size .'px;';
if ( $heading_line_height ) $heading_css .= 'line-height:'. $heading_line_height .'px;';
if ( $heading_top_margin ) $heading_css .= 'margin-top:'. $heading_top_margin .'px;';
if ( $heading_bottom_margin ) $heading_css .= 'margin-bottom:'. $heading_bottom_margin .'px;';
if ( $heading_font_family != 'Default' ) {
	wprt_enqueue_google_font( $heading_font_family );
	$heading_css .= 'font-family:'. $heading_font_family .';';
}

if ( $prefix_font_weight != 'Default' ) $prefix_css .= 'font-weight:'. $prefix_font_weight .';';
if ( $prefix_font_size ) $prefix_css .= 'font-size:'. $prefix_font_size .'px;';
if ( $prefix_line_height ) $prefix_css .= 'line-height:'. $prefix_line_height .'px;';
if ( $prefix_font_family != 'Default' ) {
	wprt_enqueue_google_font( $prefix_font_family );
	$prefix_css .= 'font-family:'. $prefix_font_family .';';
}

if ( $suffix_font_weight != 'Default' ) $suffix_css .= 'font-weight:'. $suffix_font_weight .';';
if ( $suffix_font_size ) $suffix_css .= 'font-size:'. $suffix_font_size .'px;';
if ( $suffix_line_height ) $suffix_css .= 'line-height:'. $suffix_line_height .'px;';
if ( $suffix_font_family != 'Default' ) {
	wprt_enqueue_google_font( $suffix_font_family );
	$suffix_css .= 'font-family:'. $suffix_font_family .';';
}

if ( $number )
	wp_enqueue_script( 'wprt-countto' );
	$number_html .= sprintf(
	'<div class="number-wrap font-heading" style="%2$s"><span class="prefix %10$s" style="%3$s">%5$s</span><span class="number %9$s" data-speed="%7$s" data-to="%8$s" data-inviewport="yes"> %1$s</span><span class="suffix %11$s" style="%4$s">%6$s</span></div>',
	$number,
	$number_css,
	$prefix_css,
	$suffix_css,
	$number_prefix,
	$number_suffix,
	$time,
	$number,
	$number_cls,
	$prefix_cls,
	$suffix_cls
);

if ( $heading ) $heading_html .= sprintf(
	'<%3$s class="heading" style="%2$s">
		%1$s
	</%3$s>',
	$heading,
	$heading_css,
	$heading_tag
);

if ( $separator == 'line' ) {
	if ( empty( $line_width ) ) $line_width = 50;
	if ( empty( $line_height ) ) $line_height = 2;

	if ( $line_color == '#f57223' ) {
		$line_cls .= 'accent';
	} else {
		if ( $line_color ) $line_css .= 'background-color:'. $line_color .';';
	}

	$line_css .= 'width:'. $line_width .'px;height:'. $line_height .'px;';

	$sep_html .= sprintf( '<div class="sep %2$s" style="%1$s"></div>', $line_css, $line_cls );
}

if ( $separator == 'image' ) {
	if ( $image_width ) $image_css = 'width:'. $image_width .'px;';

	if ( $image )
	$sep_html = sprintf(
		'<div class="sep image" style="%2$s">
			<img alt="image" src="%1$s">
		</div>',
		wp_get_attachment_image_src( $image, 'full' )[0],
		$image_css
	);
}

if ( $order == 'nh' ) {
	$html = $number_html . $sep_html . $heading_html;
} else {
	$html = $heading_html . $sep_html . $number_html;
}

if ( $style == 'icon-top' || $style == 'icon-left' ) {
	$icon = wprt_get_icon_class( $atts, 'icon' );
	if ( $icon && $icon_type != '' ) {
		vc_icon_element_fonts_enqueue( $icon_type );

		if ( $icon_font_size ) $icon_css .= 'font-size:'. $icon_font_size .'px; line-height: normal;';

		if ( $icon_color == '#f57223' ) {
			$icon_cls .= ' accent';
		} else {
			if ( $icon_color ) $icon_css .= 'color:'. $icon_color .';';
		}
		
		if ( $icon_right_margin ) $icon_css .= 'margin-right:'. $icon_right_margin .'px;';

		$icon_html = sprintf('<div class="icon %3$s" style="%2$s"><i class="%1$s"></i></div>', $icon, $icon_css, $icon_cls );
	}

	$html = '<div class="inner"><div class="icon-wrap">'. $icon_html .'</div><div class="text-wrap">'. $html .'</div></div>';
}

printf( '<div class="wprt-counter clearfix %2$s">%1$s</div>',
	$html,
	$cls
);