<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'alignment' => 'left',
	'style' => 'outline',
	'width' => '60',
	'height' => '60',
	'rounded' => '',
	'background_color' => '',
	'border_color' => '',
	'border_width' => '2px',
	'border_style' => 'solid',
	'margin' => '',
	'icon_effect' => 'no',
	'icon_type' => '',
	'icon' => '',
	'icon_color' => '',
	'icon_font_size' => '',
	'color' => '',
	'font_size' => '',
	'hyperlink' => 'simple',
	'video_url' => '',
	'link_url' => '',
	'new_tab' => 'yes',
), $atts ) );

$icon_font_size = intval( $icon_font_size );
$rounded = intval( $rounded );
$width = intval( $width );
$height = intval( $height );
$border_width = intval( $border_width );

$css = $icon_html = $icon_cls = $icon_css = $icon_data = $line_height = '';
$cls = $style;

if ( $icon_effect == 'yes' ) $cls .= ' icon-effect pulse infinite';
$line_height = $height - ( $border_width * 2 );

$icon = wprt_get_icon_class( $atts, 'icon' );
if ( $icon && $icon_type != '' ) {
	vc_icon_element_fonts_enqueue( $icon_type );

	if ( $icon_font_size ) $icon_css .= 'font-size:'. $icon_font_size .'px;';
	if ( $width ) $icon_css .= 'width:'. $width .'px;';
	if ( $height ) $icon_css .= 'height:'. $height .'px;';
	if ( $icon_color == '#f57223' ) {
		$icon_cls .= ' accent';
	} else {
		if ( $icon_color ) $icon_css .= 'color:'. $icon_color .';';
	}
	if ( $rounded ) $icon_css .= 'border-radius:'. $rounded .'px;';
	if ( $margin ) $css .= 'margin:'. $margin .';';

	if ( $style == 'outline' ) {
		$icon_css .= 'border-style:'. $border_style .';';

		if ( $border_color ) $icon_css .= 'border-color:'. $border_color .';';

		if ( $border_width ) {
			$icon_css .= 'border-width:'. $border_width .'px;';
			$icon_css .= 'line-height:'. $line_height .'px;';
		}
	} else {

		if ( $background_color == '#f57223' ) {
			$icon_cls .= ' bg-accent';
		} else {
			if ( $background_color ) $icon_css .= 'background-color:'. $background_color .';';
		}
		
		$icon_css .= 'line-height:'. $height .'px;';
	}

	$icon_html = sprintf('<span class="icon %4$s" style="%2$s" %3$s><i class="%1$s"></i></span>', $icon, $icon_css, $icon_data, $icon_cls );
}

if ( $hyperlink == 'simple' ) {
	if ( $link_url ) {
		$new_tab = $new_tab == 'yes' ? '_blank' : '_self';
		$icon_html = sprintf( '<a class="icon-wrap" target="%3$s" href="%2$s">%1$s</a>', $icon_html, $link_url, $new_tab );
	}
} else {
	if ( $video_url ) {
		wp_enqueue_script( 'wprt-magnificpopup' );
		$icon_html = sprintf( '<a class="icon-wrap popup-video" href="%2$s">%1$s</a>', $icon_html, $video_url );
	}
}

if ( $alignment == 'center' ) $css .= 'display: block; text-align:center;';
if ( $alignment == 'right' ) $css .= 'display: block; text-align:right;';

printf( '<div class="wprt-icon clearfix %1$s" style="%3$s">%2$s</div>', $cls, $icon_html, $css );


