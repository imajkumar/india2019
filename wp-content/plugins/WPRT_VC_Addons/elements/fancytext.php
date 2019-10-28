<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
    'alignment' => 'text-center',
    'animation' => 'scroll',
    'text1' => '',
    'text2' => '',
    'text3' => '',
    'text4' => '',
    'text5' => '',
    'prefix_text' => '',
    'suffix_text' => '',
    'font_min' => '22',
    'font_max' => '70',
    'text_color' => '',
    'prefix_color' => '',
    'suffix_color' => '',
    'tag' => 'h2',
    'font_family' => 'Default',
    'font_weight' => 'Default',
), $atts ) );
wp_enqueue_script( 'wprt-fittext' );

$text_css = $prefix_css = $suffix_css = '';
$fancy_html = $fancy_wrap_css = $fancy_css = $fancy_text = '';
$min = $max = '';

if ( $font_min ) $min = $font_min .'px';
if ( $font_max ) {
	$max = $font_max .'px';
	$fancy_css = 'font-size:'. $max .';height:'. $max .';line-height:'. $max .';';
	$fancy_wrap_css = 'height:'. $max .';';
}

if ( $text_color ) {
	$text_css .= 'color:'. $text_color .';';
	$fancy_css .= 'color:'. $text_color .';';
}

if ( $prefix_color ) $prefix_css .= 'color:'. $prefix_color .';';
if ( $suffix_color )$suffix_css .= 'color:'. $suffix_color .';';

if ( $font_weight != 'Default' )
	$fancy_css .= 'font-weight:'. $font_weight .';';
if ( $font_family != 'Default' ) {
	wprt_enqueue_google_font( $font_family );
	$fancy_css .= 'font-family:'. $font_family .';';
}

if ( $animation == 'typed' ) {
	wp_enqueue_script( 'wprt-typed' );

	if ( $text1 ) $fancy_text .= $text1 .',';
	if ( $text2 ) $fancy_text .= $text2 .',';
	if ( $text3 ) $fancy_text .= $text3 .',';
	if ( $text4 ) $fancy_text .= $text4 .',';
	if ( $text5 ) $fancy_text .= $text5 .',';
	$fancy_text = substr( $fancy_text, 0, -1 );

	printf(
		'<div class="wprt-fancy-text typed %10$s" data-fancy="%1$s" data-min="%2$s" data-max="%3$s">
	        <%11$s class="heading" style="%4$s"><span style="%8$s">%5$s</span> <span class="text" style="%7$s"></span> <span style="%9$s">%6$s</span></%11$s>
	    </div>',
		$fancy_text,
		$min,
		$max,
		$fancy_css,
		$prefix_text,
		$suffix_text,
		$text_css,
		$prefix_css,
		$suffix_css,
		$alignment,
		$tag
	);
}

if ( $animation == 'scroll' ) {
	if ( $text1 ) $fancy_text = '<'. $tag .' class="heading" style="'. $fancy_css .'">'. $text1 .'</'. $tag .'>';
	if ( $text2 ) $fancy_text .= '<'. $tag .' class="heading" style="'. $fancy_css .'">'. $text2 .'</'. $tag .'>';
	if ( $text3 ) $fancy_text .= '<'. $tag .' class="heading" style="'. $fancy_css .'">'. $text3 .'</'. $tag .'>';
	if ( $text4 ) $fancy_text .= '<'. $tag .' class="heading" style="'. $fancy_css .'">'. $text4 .'</'. $tag .'>';
	if ( $text5 ) $fancy_text .= '<'. $tag .' class="heading" style="'. $fancy_css .'">'. $text5 .'</'. $tag .'>';

	printf(
		'<div class="wprt-fancy-text scroll %5$s" data-min="%2$s" data-max="%3$s" style="%4$s">
	        %1$s
	    </div>',
	    $fancy_text,
		$min,
		$max,
		$fancy_wrap_css,
		$alignment
	);
}
