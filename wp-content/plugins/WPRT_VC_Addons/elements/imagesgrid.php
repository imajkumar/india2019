<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'mode' => 'grid',
	'image_crop'	=> 'auto2',
	'images'	=> '',
	'column'		=> '4c',
	'column2'		=> '3c',
	'column3'		=> '2c',
	'column4'		=> '1c',
	'gapv'			=> '30',
	'gaph'			=> '30',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$column = intval( $column );
$column2 = intval( $column2 );
$column3 = intval( $column3 );
$column4 = intval( $column4 );
$gapv = intval( $gapv );
$gaph = intval( $gaph );

if ( empty( $gapv ) ) $gapv = 0;
if ( empty( $gaph ) ) $gaph = 0;


$html = '';
if ( ! empty( $images ) ) {
	wp_enqueue_script( 'wprt-cubeportfolio' );
	wp_enqueue_script( 'wprt-magnificpopup' );
	$images = explode( ',', trim($images) );

	$html  .= '<div class="wprt-images-grid" data-layout="'. $mode .'" data-column="'. esc_attr( $column ) .'" data-column2="'. esc_attr( $column2 ) .'" data-column3="'. esc_attr( $column3 ) .'" data-column4="'. esc_attr( $column4 ) .'" data-gaph="'. esc_html( $gaph ) .'" data-gaph="'. esc_html( $gaph ) .'" data-gapv="'. esc_html( $gapv ) .'">';

	$html .= '<div id="images-wrap" class="cbp">';

	for ( $i=0; $i<count($images); $i++ ) {
	    $img_size = 'wprt-small-auto';
	    if ( $image_crop == 'square' ) $img_size = 'wprt-square';
	    if ( $image_crop == 'rectangle' ) $img_size = 'wprt-rectangle';
	    if ( $image_crop == 'rectangle2' ) $img_size = 'wprt-rectangle2';
	    if ( $image_crop == 'auto1' ) $img_size = 'wprt-medium-auto';
	    if ( $image_crop == 'auto3' ) $img_size = 'wprt-xsmall-auto';
	    if ( $image_crop == 'full' ) $img_size = 'full';

		$img_b = wp_get_attachment_image_src( $images[$i], $img_size );
		$img_f = wp_get_attachment_image_src( $images[$i], 'full' );

		$html .= sprintf('<div class="cbp-item"><div class="item-wrap"><a class="zoom-popup" href="%2$s"><i class="inf-icon-magnifier8"></i></a><img src="%1$s" alt="image" /></div></div>',
			$img_b[0],
			$img_f[0]
		);
	}
	$html .= '</div></div>';
}
echo $html;
