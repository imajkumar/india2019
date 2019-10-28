<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'text' => 'Button Text',
	'style' => 'accent',
	'size' => '',
	'padding' => '',
	'background_color' => '',
	'border_color' => '',
	'text_color' => '',
	'rounded' => '',
	'border_width' => '',
	'border_style' => 'solid',
	'margin' => '',
	'full_width' => '',
	'icon_type' => '',
	'icon' => '',
	'icon_color' => '',
	'icon_font_size' => '',
	'icon_position' => 'icon-right',
	'icon_left_padding' => '',
	'icon_right_padding' => '',
	'separate' => '',
	'font_family' => 'Default',
	'font_weight' => 'Default',
	'font_size' => '',
	'line_height' => '',
	'link_url' => '',
	'new_tab' => 'yes'
), $atts ) );

$rounded = intval( $rounded );
$border_width = intval( $border_width );
$icon_font_size = intval( $icon_font_size );
$icon_right_padding = intval( $icon_right_padding );
$icon_left_padding = intval( $icon_left_padding );
$font_size = intval( $font_size );
$line_height = intval( $line_height );

$css = $icon_html = $icon_css = $wrap_css = $btn_html = $inner_css = '';
$cls = $size .' '. $border_style .' '. $style;

$wrap_cls = $icon_position;
if ( $separate ) $wrap_cls .= ' separate';
if ( $margin ) $wrap_css .= 'display:inline-block;margin:'. $margin .';';
if ( $full_width ) $css = $wrap_css .= 'display:block; text-align:center;';

if ( $style == 'dark' ) $cls .= ' dark';
if ( $style == 'light' ) $cls .= ' light';
if ( $style == 'very-light' ) $cls .= ' very-light';
if ( $style == 'white' ) $cls .= ' white';
if ( $style == 'outline' ) $cls .= ' outline ol-accent';
if ( $style == 'outline_dark' ) $cls .= ' outline dark';
if ( $style == 'outline_light' ) $cls .= ' outline light';
if ( $style == 'outline_very-light' ) $cls .= ' outline very-light';
if ( $style == 'outline_white' ) $cls .= ' outline white';

if ( $style == 'custom' ) {
	if ( $padding ) $css .= 'padding:'. $padding .';';
	if ( $background_color ) $css .= 'background-color:'. $background_color .';';
	if ( $border_color ) $css .= 'border-color:'. $border_color .';';
	if ( $text_color ) $css .= 'color:'. $text_color .';';
	if ( $icon_color ) $icon_css .= 'color:'. $icon_color .';';
}

$icon = wprt_get_icon_class( $atts, 'icon' );
if ( $icon && $icon_type != '' ) {
	$wrap_cls .= ' has-icon';
	vc_icon_element_fonts_enqueue( $icon_type );

	if ( $icon_font_size ) $icon_css .= 'font-size:'. $icon_font_size .'px;';
	$icon_html = sprintf('<span class="icon" style="%2$s"><i class="%1$s"></i></span>', $icon, $icon_css );
}

if ( $font_weight != 'Default' ) $css .= 'font-weight:'. $font_weight .';';
if ( $font_size ) $css .= 'font-size:'. $font_size .'px;';
if ( $line_height ) $css .= 'line-height:'. $line_height .'px;';
if ( $rounded ) $css .= 'border-radius:'. $rounded .'px;';
if ( $border_width ) $css .= 'border-width:'. $border_width .'px;';
if ( $font_family != 'Default' ) {
	wprt_enqueue_google_font( $font_family );
	$css .= 'font-family:'. $font_family .';';
}

if ( $icon_left_padding ) $inner_css = 'padding-right:'. $icon_left_padding .'px;';
if ( $icon_right_padding ) $inner_css = 'padding-left:'. $icon_right_padding .'px;';

$new_tab = $new_tab == 'yes' ? '_blank' : '_self';

$btn_html = sprintf(
	'<a href="%5$s" target="%6$s" class="wprt-button %1$s" style="%2$s">
		<span style="%4$s">%7$s %3$s</span>
	</a>',
	esc_attr( $cls ),
	esc_attr( $css ),
	$icon_html,
	esc_attr( $inner_css ),
	esc_attr( $link_url ),
	esc_attr( $new_tab ),
	esc_html( $text )
);

printf( '<div class="button-wrap %1$s" style="%2$s">%3$s</div>',
	esc_attr( $wrap_cls ),
	esc_attr( $wrap_css ),
	$btn_html
);
