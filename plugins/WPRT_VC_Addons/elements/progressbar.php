<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'title' => 'Title',
	'percent' => '90',
	'percent_style' => 'pstyle-1',
	'per_color' => '',
	'space_between' => '10px',
	'height' => '10px',
	'rounded' => '',
	'bottom_margin' => '',
	'line_one' => '#636363',
	'line_two' => '#e5e5e5',
	'font_family' => 'Default',
	'font_weight' => 'Default',
	'title_color' => '',
	'font_size' => '',
	'per_font_family' => 'Default',
	'per_font_weight' => 'Default',
	'per_font_size' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$font_size = intval( $font_size );
$percent = intval( $percent );
$space_between = intval( $space_between );
$height = intval( $height );
$rounded = intval( $rounded );
$bottom_margin = intval( $bottom_margin );

$cls = $cls1 = $wrap_css = $css = $pcss = $css1 = $css2 = $tit = $per = '';
if ( $bottom_margin ) $wrap_css .= 'margin-bottom:'. $bottom_margin .'px;';
$cls = $percent_style;

if ( empty( $percent ) ) $percent = 90;
if ( empty( $height ) ) $height = 10;

if ( $line_one == '#f57223' ) {
	$cls1 .= ' accent';
} else {
	if ( $line_one ) $css1 = 'background-color:'. $line_one .';';
}

if ( $height ) $css1 .= 'height:'. $height .'px;';

if ( $line_two ) $css2 = 'background-color:'. $line_two .';';
if ( $rounded ) $css2 .= 'overflow:hidden;border-radius:'. $rounded .'px;';

if ( $percent ) $percent = $percent .'%';

if ( $font_weight != 'Default' ) $css .= 'font-weight:'. $font_weight .';';
if ( $title_color ) $css .= 'color:'. $title_color .';';
if ( $font_size ) $css .= 'font-size:'. $font_size .'px;';
if ( $font_family != 'Default' ) {
	wprt_enqueue_google_font( $font_family );
	$css .= 'font-family:'. $font_family .';';
}

if ( $per_color ) $pcss .= 'color:'. $per_color .';';

if ( ! empty( $title ) )
	$tit = '<h3 class="title" style="'. $css .'">'. esc_html( $title ) .'</h3>';
if ( ! empty( $percent ) )
	$per = '<div class="perc-wrap" style="'. $css .'"><div class="perc" style="'. $pcss .'"><span>'. $percent .'</span></div></div>';


if ( $space_between ) $css2 .= 'margin-top:'. $space_between .'px;';
printf( '
	<div class="wprt-progress clearfix %7$s" style="%6$s">%1$s %2$s
	    <div class="progress-bar" data-percent="%3$s" data-inviewport="yes" style="%4$s">
	        <div class="progress-animate %8$s" style="%5$s"></div>
	    </div>
    </div>', 
	$tit, $per, $percent, $css2, $css1, $wrap_css, $cls, $cls1
);
