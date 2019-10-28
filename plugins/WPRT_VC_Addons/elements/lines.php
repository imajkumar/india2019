<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'alignment' => 'left',
	'line1_height' => '2',
	'line2_height' => '2',
	'line1_width' => '70',
	'line2_width' => '170',
	'line1_color' => '',
	'line2_color' => '',
	'line_1_full' => 'no',
	'line_2_full' => 'no',
	'top_margin' => '',
	'bottom_margin' => ''
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$line1_height = intval( $line1_height );
if ( empty( $line1_height ) ) $line1_height = 2;

$line2_height = intval( $line2_height );
if ( empty( $line2_height ) ) $line2_height = 2;

$wrap_height = $line1_height > $line2_height ? $line1_height : $line2_height;

$line1_width = intval( $line1_width );
if ( empty( $line1_width ) ) $line1_width = 70;

$line2_width = intval( $line2_width );
if ( empty( $line2_width ) ) $line2_width = 170;

$top_margin = intval( $top_margin );
$bottom_margin = intval( $bottom_margin );

$wrap_cls = '';
$lines_cls = $alignment;
if ( $line_1_full == 'yes' ) {
	$line1_width = '100%';
	$lines_cls .= ' line1-full';
}

if ( $line_2_full == 'yes' ) {
	$line2_width = '100%';
	$lines_cls .= ' line2-full';
}

$line_1_left = $line1_width / 2;
$line_2_left = $line2_width / 2;

$line_1_top = $line1_height / 2;
$line_2_top = $line2_height / 2;

$margin1_left = '';
if ( $alignment == 'center' )
	$margin1_left = '; margin-left: -'. $line_1_left .'px';

$margin2_left = '';
if ( $alignment == 'center' )
	$margin2_left = '; margin-left: -'. $line_2_left .'px';

$css = 'height: '. $wrap_height .'px;'; $css1 = $css2 = '';

if ( $line_1_full == 'yes' ) {
	$css1 = 'height:' . $line1_height . 'px; width: '. $line1_width .'; background-color: '. $line1_color .'; margin-top: -'. $line_1_top .'px';
} else {
	$css1 = 'height:' . $line1_height . 'px; width: '. $line1_width .'px; background-color: '. $line1_color . $margin1_left .'; margin-top: -'. $line_1_top .'px';
}

if ( $line_2_full == 'yes' ) {
	$css2 = 'height:' . $line2_height . 'px; width: '. $line2_width .'; background-color: '. $line2_color .'; margin-top: -'. $line_2_top .'px';
} else {
	$css2 = 'height:' . $line2_height . 'px; width: '. $line2_width .'px; background-color: '. $line2_color . $margin2_left .'; margin-top: -'. $line_2_top .'px';
}

if ( $top_margin ) $css .= 'margin-top:'. $top_margin .'px;';
if ( $bottom_margin ) $css .= 'margin-bottom:'. $bottom_margin .'px;';

printf(
	'<div class="wprt-lines clearfix %4$s" style="%1$s">
		<div class="line-1" style="%2$s"></div>
		<div class="line-2" style="%3$s"></div>
	</div>', 
	$css, $css1, $css2, $lines_cls
);